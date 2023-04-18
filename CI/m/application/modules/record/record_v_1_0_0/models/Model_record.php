<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-09-28
| Memo : 프로그램
|------------------------------------------------------------------------
*/

Class Model_record extends MY_Model{

	// 포스트 리스트
	public function record_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$now = date('Y-m-d');
		$month = date('Y-m');
		$last_month = date('Y-m',strtotime($now."-1 month"));

		$sql = "SELECT
							a.program_idx,
							b.title,
							b.img_path,
							a.month_cnt,
							a.month_record_time,
							SEC_TO_TIME(( TIME_TO_SEC(a.month_record_time)-TIME_TO_SEC(c.last_month_record_time) ) ) AS range_record_time,
							IF(TIME_TO_SEC(a.month_record_time)>=TIME_TO_SEC(c.last_month_record_time),'p','n') AS pn,
							IFNULL(c.last_month_cnt,0) AS last_month_cnt,
							c.last_month_record_time
						FROM
						(
						SELECT
							program_idx,
							COUNT(*) AS month_cnt,
							SEC_TO_TIME( SUM( TIME_TO_SEC(record_time) ) ) AS month_record_time
						FROM
						tbl_member_program_record
						WHERE
						del_yn='N'
							AND excercise_yn='Y'
							AND member_idx=$member_idx
							AND DATE_FORMAT(excercise_date, '%Y-%m')='$month'
							GROUP BY program_idx
						) AS a
							
							JOIN tbl_program as b ON b.program_idx=a.program_idx
							left join (
								SELECT
									in_a.program_idx,
									COUNT(*) AS last_month_cnt,
									SEC_TO_TIME( SUM( TIME_TO_SEC(in_a.record_time) ) ) AS last_month_record_time
								FROM (SELECT
												program_idx, 
												record_time, 
												del_yn, 
												excercise_date,
												ins_date, 
												upd_date
											FROM
												tbl_member_program_record
											WHERE
												del_yn='N'
												and excercise_yn='Y'
												AND DATE_FORMAT(excercise_date, '%Y-%m')='$last_month'
												AND member_idx =$member_idx) AS in_a
												GROUP BY in_a.program_idx
									) as c on c.program_idx=a.program_idx
						WHERE
							1=1
						";

		$sql .=" LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 포스트 리스트 총 카운트
	public function record_list_count($data){
		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$now = date('Y-m-d');
		$month = date('Y-m');
		$last_month = date('Y-m',strtotime($now."-1 month"));

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
						(
						SELECT
							program_idx,
							COUNT(*) AS month_cnt,
							SEC_TO_TIME( SUM( TIME_TO_SEC(record_time) ) ) AS month_record_time
						FROM
						tbl_member_program_record
						WHERE
						del_yn='N'
							AND excercise_yn='Y'
							AND member_idx=$member_idx
							AND DATE_FORMAT(excercise_date, '%Y-%m')='$month'
							GROUP BY program_idx
						) AS a
							
							JOIN tbl_program as b ON b.program_idx=a.program_idx
							left join (
								SELECT
									in_a.program_idx,
									COUNT(*) AS last_month_cnt,
									SEC_TO_TIME( SUM( TIME_TO_SEC(in_a.record_time) ) ) AS last_month_record_time
								FROM (SELECT
												program_idx, 
												record_time, 
												del_yn, 
												excercise_date,
												ins_date, 
												upd_date
											FROM
												tbl_member_program_record
											WHERE
												del_yn='N'
												and excercise_yn='Y'
												AND DATE_FORMAT(excercise_date, '%Y-%m')='$last_month'
												AND member_idx =$member_idx) AS in_a
												GROUP BY in_a.program_idx
									) as c on c.program_idx=a.program_idx
						WHERE
							1=1
						";

		return $this->query_cnt($sql,array());
	}

	// 포스트 상세
	public function record_detail(){

		// $this->minute_cron();

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$sql = "SELECT
							COUNT(*) as excercise_cnt,
							SEC_TO_TIME( SUM( TIME_TO_SEC(record_time))) as excercise_time
	        	FROM
							tbl_member_program_record
	        	WHERE
	           	member_idx = ?
							AND excercise_yn = 'Y'
							AND del_yn = 'N'
					";

		return $this->query_row($sql,array(
																		$member_idx
																		)
																	);
	}

	// 월이나 년이 바뀔때의 이벤트
	public function change_month(){

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;
		$now=date('Y-m-d');

		$result = array();

		$sql = "SELECT
							DATE_FORMAT(excercise_date, '%m/%d/%Y') as excercise_date
	        	FROM
							tbl_member_program_date as a
	        	WHERE
	           	a.member_idx = ?
							AND a.del_yn = 'N'
							and total_program_cnt>end_program_cnt
							and DATE_FORMAT(excercise_date, '%Y-%m-%d')< '$now';
					";

			$result['active_date']= $this->query_result($sql,array(
																		$member_idx
																		)
																	);
		$sql = "SELECT
							DATE_FORMAT(excercise_date, '%m/%d/%Y') as excercise_date
						FROM
							tbl_member_program_date as a
						WHERE
							a.member_idx = ?
							AND a.del_yn = 'N'
							and total_program_cnt<=end_program_cnt
							and DATE_FORMAT(excercise_date, '%Y-%m-%d')< '$now';
					";

			$result['active2_date']= $this->query_result($sql,array(
																				$member_idx
																		)
																	);

		return $result;
	}

	// 포스트 리스트
	public function calendar_list($data){

		$member_idx = $data['member_idx'];
		$date 	 = $data['date'];

		$sql = "SELECT
							member_program_record_idx, 
							member_program_idx, 
							member_idx, 
							program_idx, 
							title, 
							img_path, 
							yoil, 
							DATE_FORMAT(s_date, '%Y.%m.%d') AS s_date,
							DATE_FORMAT(e_date, '%Y.%m.%d') AS e_date,
							DATE_FORMAT(excercise_date, '%m.%d') AS format_excercise_date,
							excercise_date, 
							record_time, 
							excercise_yn, 
							del_yn, 
							ins_date, 
							upd_date
						FROM
							tbl_member_program_record
						WHERE
							del_yn='N'
							and member_idx = ?
							and excercise_date=?
							order by upd_date
						";

		return $this->query_result($sql,array(
															 $member_idx,
															 $date
															 ),$data
														 );
	}

	// 포스트 리스트 총 카운트
	public function calendar_list_count($data){
		$member_idx = $data['member_idx'];
		$date 	 = $data['date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member_program_record
						WHERE
							del_yn='N'
							and member_idx = ?
							and excercise_date=?
							order by upd_date
						";

		return $this->query_cnt($sql,array(
																		$member_idx,
																		$date
																	),$data);
	}

	// 포스트 리스트
	public function history_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_idx = $data['member_idx'];

		$result = array();

		$sql = "SELECT
							member_program_record_idx, 
							member_program_idx, 
							member_idx, 
							program_idx, 
							title, 
							img_path, 
							yoil, 
							DATE_FORMAT(s_date, '%Y.%m.%d') AS s_date,
							DATE_FORMAT(e_date, '%Y.%m.%d') AS e_date,
							DATE_FORMAT(excercise_date, '%m.%d') AS format_excercise_date,
							excercise_date, 
							record_time, 
							excercise_yn, 
							del_yn, 
							ins_date, 
							upd_date
						FROM
							tbl_member_program_record
						WHERE
							del_yn='N'
							and excercise_yn ='Y'
							and member_idx = $member_idx
							and excercise_date<=DATE_FORMAT(NOW(), '%Y-%m-%d')
							order by excercise_date DESC LIMIT ?, ? 
						";

		$result['history_list']= $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );

		$sql = "SELECT
							a.format_excercise_date,
							a.excercise_date
						FROM
							(
								SELECT
									member_program_record_idx, 
									member_program_idx, 
									member_idx, 
									program_idx, 
									title, 
									img_path, 
									yoil, 
									DATE_FORMAT(s_date, '%Y-%m-%d') AS s_date,
									DATE_FORMAT(e_date, '%Y-%m-%d') AS e_date,
									DATE_FORMAT(excercise_date, '%m.%d') AS format_excercise_date,
									excercise_date, 
									record_time, 
									excercise_yn, 
									del_yn, 
									ins_date, 
									upd_date
								FROM
									tbl_member_program_record
								WHERE
									del_yn='N'
									and excercise_yn ='Y'
									AND member_idx = $member_idx
									AND excercise_date<=DATE_FORMAT(NOW(), '%Y-%m-%d')
									ORDER BY excercise_date DESC LIMIT ?, ? 
							) AS a
						WHERE
						1=1
							GROUP BY a.format_excercise_date,a.excercise_date
							order by a.excercise_date DESC
						";

		$result['history_date']=$this->query_result($sql,array(
																$page_no,
																$page_size
																),$data
															);

		return $result;
	}

	// 포스트 리스트 총 카운트
	public function history_list_count($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member_program_record
						WHERE
							del_yn='N'
							and excercise_yn ='Y'
							and member_idx = $member_idx
							and excercise_date<=DATE_FORMAT(NOW(), '%Y-%m-%d')
						";

		return $this->query_cnt($sql,array(
																	),$data);
	}

	
	public function minute_cron1(){

		$now=date('Y-m-d');

		$this->db->trans_begin();

		$sql = "SELECT
							member_program_idx, 
							member_idx, 
							program_idx, 
							yoil, 
							DATE_FORMAT(s_date, '%Y-%m-%d') AS s_date,
							DATE_FORMAT(e_date, '%Y-%m-%d') AS e_date,
							e_date_yn, 
							del_yn, 
							ins_date, 
							upd_date
						FROM
							tbl_member_program
						WHERE
							e_date_yn = 'N'
							AND del_yn = 'N'
							AND ( e_date_yn='N' AND DATE_FORMAT(s_date, '%Y-%m-%d')<='$now' OR e_date_yn='Y' AND DATE_FORMAT(s_date, '%Y-%m-%d')<='$now' AND DATE_FORMAT(e_date, '%Y-%m-%d')>='$now') 
					";

		$program_list= $this->query_result($sql,array(
															)
														);

		foreach($program_list as $row){

		$yoil_arr=explode(',',$row->yoil);

		$excercise_date =$now;
									
		$daily = date( 'w', strtotime($now) ) ;

			if(in_array($daily,$yoil_arr)){
				$sql = "INSERT INTO
									tbl_member_program_record
								(
									member_program_idx, 
									member_idx, 
									program_idx, 
									title, 
									img_path, 
									yoil, 
									s_date, 
									e_date, 
									excercise_date, 
									excercise_yn, 
									del_yn, 
									ins_date, 
									upd_date
								)SELECT 
									a.member_program_idx,
									a.member_idx,
									a.program_idx,
									b.title,
									b.img_path,
									a.yoil,
									DATE_FORMAT(a.s_date, '%Y-%m-%d'),
									DATE_FORMAT(a.e_date, '%Y-%m-%d'),
									?,
									'N',
									'N',
									NOW(),
									NOW()
								from
									tbl_member_program as a
									JOIN tbl_program as b on b.program_idx=a.program_idx
								where
									a.del_yn='N'
									and a.member_program_idx=?
									ON DUPLICATE KEY UPDATE member_idx=?,member_program_idx=?,upd_date=NOW()
								";

					$this->query($sql,
										array(
										$excercise_date,
										$row->member_program_idx,
										$row->member_idx,
										$row->member_program_idx
										)
										);
					}
					
				}
			
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}


}	//클래스의 끝
?>
