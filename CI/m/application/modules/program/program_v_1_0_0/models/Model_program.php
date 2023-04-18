<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-09-28
| Memo : 프로그램
|------------------------------------------------------------------------
*/

Class Model_program extends MY_Model{

	// 포스트 리스트
	public function category_list(){

		$sql = "SELECT
							category_management_idx, 
							category_name, 
							img_path, 
							upd_date
						FROM
							tbl_category_management
						WHERE
							del_yn='N'
							and state='1'
							and type=0
							order by order_no
						";

		return $this->query_result($sql,array(
															 )
														 );
	}

	// 포스트 리스트
	public function program_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];
		$category_idx = $data['category_idx'];

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$sql = "SELECT
							category_management_idx, 
							a.program_idx,
							level, 
							title, 
							contents, 
							img_path, 
							DATE_FORMAT(exercise_time, '%i') AS exercise_min,
							DATE_FORMAT(exercise_time, '%s') AS exercise_sec,
							exercise_time, 
							display_yn, 
							view_cnt, 
							like_cnt, 
							ifnull(b.del_yn,'Y') as del_yn,
							ifnull(c.like_yn,'N') as like_yn,
							DATE_FORMAT(a.ins_date, '%Y.%m.%d') AS ins_date,
							a.upd_date
						FROM
							tbl_program as a
							LEFT JOIN tbl_member_program as b ON b.program_idx=a.program_idx and b.member_idx=$member_idx
							left join tbl_program_like as c on c.program_idx=a.program_idx and c.member_idx=$member_idx and c.del_yn='N'
						WHERE
							a.del_yn='N'
							and display_yn='Y'
							and category_management_idx=$category_idx
						";

		$sql .=" LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 포스트 리스트 총 카운트
	public function program_list_count($data){
		$category_idx = $data['category_idx'];

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$sql = "SELECT
							COUNT(*) AS cnt
							FROM
							tbl_program as a
							LEFT JOIN tbl_member_program as b ON b.program_idx=a.program_idx and b.member_idx=$member_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
							and display_yn='Y'
							and category_management_idx=$category_idx
						";

		return $this->query_cnt($sql,array());
	}

	// 포스트 상세
	public function program_detail($data){

		$program_idx = $data['program_idx'];
		$type = $data['type'];
		$now =date('Y-m-d');

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$result = array();

		if($type!='1'){
			$this->cnt_mod_up($data);
		}

		$sql = "SELECT
							a.program_idx, 
							a.category_management_idx, 
							a.level, 
							a.title, 
							a.contents, 
							a.img_path, 
							a.url_link, 
							DATE_FORMAT(a.exercise_time, '%i') AS exercise_min,
							DATE_FORMAT(a.exercise_time, '%s') AS exercise_sec,
							a.exercise_time, 
							a.display_yn, 
							a.view_cnt, 
							a.like_cnt, 
							a.del_yn, 
							(select member_program_idx from tbl_member_program where program_idx=a.program_idx and member_idx=$member_idx and del_yn='N') as add_cnt,
							(select record_time from tbl_member_program_record where program_idx=a.program_idx and member_idx=$member_idx and del_yn='N' and excercise_date ='$now') as record_time,
							ifnull(c.like_yn,'N') as like_yn,
							ifnull(b.scrap_yn,'N') as scrap_yn,
							DATE_FORMAT(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							a.upd_date
	        	FROM
							tbl_program as a
							left join tbl_scrap as b ON b.program_idx=a.program_idx and b.member_idx=$member_idx
							left join tbl_program_like as c ON c.program_idx=a.program_idx and c.member_idx=$member_idx and c.del_yn='N'
	        	WHERE
	           	a.program_idx = ?
							AND a.del_yn = 'N'
					";

			$result['program_detail']= $this->query_row($sql,array(
																		$program_idx
																		),$data
																	);
		$sql = "SELECT
							a.program_exercise_idx, 
							a.program_idx, 
							a.exercise_idx, 
							b.title, 
							b.contents, 
							b.img_path
	        	FROM
							tbl_program_exercise as a
							left join tbl_exercise as b ON b.exercise_idx=a.exercise_idx and b.del_yn='N'
	        	WHERE
	           	a.program_idx = ?
							AND a.del_yn = 'N'
							order by a.ins_date
					";

			$result['exercise_list']= $this->query_result($sql,array(
																		$program_idx
																		),$data
																	);

		return $result;
	}

	// 포스트 상세
	public function excercise_detail($data){

		$exercise_idx = $data['exercise_idx'];

		$sql = "SELECT
							a.exercise_idx, 
							a.title, 
							a.contents, 
							a.sports_equipment, 
							DATE_FORMAT(a.exercise_time, '%i') AS exercise_min,
							DATE_FORMAT(a.exercise_time, '%s') AS exercise_sec,
							a.exercise_time, 
							a.url_link, 
							a.img_path
	        	FROM
							tbl_exercise as a
	        	WHERE
	           	a.exercise_idx = ?
							AND a.del_yn = 'N'
							AND a.display_yn = 'Y'
					";

		return $this->query_row($sql,array(
																	$exercise_idx
																	),$data
																);
	}

	// 조회수 up
	public function cnt_mod_up($data){

		$program_idx = $data['program_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_program
						SET
							view_cnt = view_cnt+1
						WHERE
							program_idx = ?
						";

		$this->query($sql,
									array(
									$program_idx
									),
									$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 프로그램 담기
	public function scrap_mod_up($data){

		$program_idx=$data['program_idx'];
		$member_idx=$data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_scrap
						(
						member_idx,
						program_idx,
						scrap_yn,
						scrap_type,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						0,
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,program_idx=?,scrap_yn=if(scrap_yn='N','Y','N'),upd_date=NOW()
		";
	
		$this->query($sql,array(
									$member_idx,
									$program_idx,
									$member_idx,
									$program_idx,
									),$data
								);
	
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 포스트 상세
	public function routine_detail($data){

		$program_idx = $data['program_idx'];
		$member_idx = $data['member_idx'];

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
								program_idx = ?
							AND del_yn = 'N'
							AND member_idx = ?
					";

		return $this->query_row($sql,array(
																	$program_idx,
																	$member_idx
																	),$data
																);
	}

	// 프로그램 추가
	public function routine_reg_in($data){

		$member_program_idx=$data['member_program_idx'];
		$program_idx=$data['program_idx'];
		$yoil=$data['yoil'];
		$s_date=$data['s_date'];
		$e_date=$data['e_date'];
		$e_date_yn=$data['e_date_yn'];
		$member_idx=$data['member_idx'];
		$now=date('Y-m-d');

		$this->db->trans_begin();

		if($member_program_idx>0){

			$sql = "UPDATE
								tbl_member_program
							SET
								yoil=?,
								s_date=?,
								e_date=?,
								e_date_yn=?,
								upd_date=now()
							WHERE
								member_program_idx=?
							";

					$this->query($sql,
										array(
											$yoil,
											$s_date,
											$e_date,
											$e_date_yn,
											$member_program_idx
										),
										$data);		
			
		}else{

			$sql = "INSERT INTO tbl_member_program
								(
								member_idx,
								program_idx,
								yoil,
								s_date,
								e_date,
								e_date_yn,
								del_yn,
								ins_date,
								upd_date
								)
								VALUES
								(
								?,
								?,
								?,
								?,
								?,
								?,
								'N',
								NOW(),
								NOW()
								)
			";
		
			$this->query($sql,array(
										$member_idx,
										$program_idx,
										$yoil,
										$s_date,
										$e_date,
										$e_date_yn
										),$data
									);
	
			$member_program_idx = $this->db->insert_id();

		}
		
		$sql = "UPDATE
							tbl_member_program_record
						SET
							excercise_yn = 'N',
							del_yn = 'Y',
							upd_date=now()
						WHERE
							del_yn='N'
							and member_program_idx = ?
							AND DATE_FORMAT(excercise_date, '%Y-%m-%d') > ?
						";

		$this->query($sql,
									array(
										$member_program_idx,
										$now
									),
									$data);		


		$yoil_arr=explode(',',$yoil);

		$excercise_date =$s_date;
		if($e_date_yn=='Y'){

			for($i=0;$excercise_date<=$e_date;$i++){
				$plus='+'.$i.' days';
				$daily = date( 'w', strtotime($s_date.$plus ) ) ;
				$excercise_date = date( 'Y-m-d', strtotime($s_date.$plus ) ) ;
	
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
									";
	
						$this->query($sql,
											array(
											$excercise_date,
											$member_program_idx
											),
											$data);
				}
			}

		}else{

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
									";
	
						$this->query($sql,
											array(
											$now,
											$member_program_idx
											),
											$data);

		}					
	
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 운동완료
	public function timer_mod_up($data){

		$member_program_idx = $data['member_program_idx'];
		$program_idx = $data['program_idx'];
		$record_time = $data['record_time'];
		$member_idx = $this->member_idx;
		$date = date('Y-m-d');
		$yoil = date('w');

		$sql = "UPDATE
							tbl_member_program_record
						SET
							record_time = ?,
							excercise_yn = 'Y',
							upd_date=now()
						WHERE
							del_yn='N'
							and member_idx = ?
							and member_program_idx=?
							AND DATE_FORMAT(excercise_date, '%Y-%m-%d') = ?
						";

		$this->query($sql,
									array(
									$record_time,
									$member_idx,
									$member_program_idx,
									$date
									),
									$data);


		$sql = "SELECT
							COUNT(*) AS total_program_cnt,
							COUNT(CASE WHEN excercise_yn='Y' THEN 1 END) AS end_program_cnt,
							GROUP_CONCAT(program_idx) AS program_arr
						FROM
							tbl_member_program_record AS a
						WHERE
							a.del_yn='N'
							AND excercise_date='$date'
							and a.member_idx= $member_idx
					";

		$result= $this->query_row($sql,array(
																	),$data
																);

		$sql = "INSERT INTO tbl_member_program_date
							(
							member_idx,
							program_arr,
							excercise_date,
							total_program_cnt,
							end_program_cnt,
							del_yn,
							ins_date,
							upd_date
							)
							VALUES
							(
							?,
							?,
							?,
							?,
							?,
							'N',
							NOW(),
							NOW()
							)
							ON DUPLICATE KEY UPDATE total_program_cnt=?,end_program_cnt=?,upd_date=NOW()
			";
		
			$this->query($sql,array(
										$member_idx,
										$result->program_arr,
										$date,
										$result->total_program_cnt,
										$result->end_program_cnt,
										$result->total_program_cnt,
										$result->end_program_cnt
										),$data
									);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

}	//클래스의 끝
?>
