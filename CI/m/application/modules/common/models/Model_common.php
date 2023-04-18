<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-02-29
| Memo : 공통 기능
|------------------------------------------------------------------------
*/

Class Model_common extends MY_Model {

	// 차단
	public function block_reg_in($data){

		$type=$data['type'];
		$board_idx=$data['board_idx'];
		$board_reply_idx=$data['board_reply_idx'];
		$member_idx=$data['member_idx'];

		$this->db->trans_begin();

		if($type=='0'){

			$sql = "INSERT INTO tbl_board_block
								(
								member_idx,
								board_idx,
								block_yn,
								ins_date,
								upd_date
								)
								VALUES
								(
								?,
								?,
								'Y',
								NOW(),
								NOW()
								)
								ON DUPLICATE KEY UPDATE member_idx=?,board_idx=?,block_yn=if(block_yn='N','Y','N'),upd_date=NOW()
					";

					$this->query($sql,array(
											$member_idx,
											$board_idx,
											$member_idx,
											$board_idx,
										),$data
									);
									
			}else if($type=='1'){
			
						$sql = "INSERT INTO tbl_board_reply_block
											(
											member_idx,
											board_reply_idx,
											block_yn,
											ins_date,
											upd_date
											)
											VALUES
											(
											?,
											?,
											'Y',
											NOW(),
											NOW()
											)
											ON DUPLICATE KEY UPDATE member_idx=?,board_reply_idx=?,block_yn=if(block_yn='N','Y','N'),upd_date=NOW()
								";
			
								$this->query($sql,array(
														$member_idx,
														$board_reply_idx,
														$member_idx,
														$board_reply_idx,
													),$data
												);

		}
	
	
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 프로그램 담기
	public function program_reg_in($data){

		$program_idx=$data['program_idx'];
		$member_idx=$data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_member_program
						(
						member_idx,
						program_idx,
						del_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,program_idx=?,del_yn=if(del_yn='N','Y','N'),upd_date=NOW()
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

	// 프로그램 담기
	public function like_reg_in($data){

		$program_idx=$data['program_idx'];
		$member_idx=$data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_program_like
						(
						member_idx,
						program_idx,
						like_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,program_idx=?,like_yn=if(like_yn='N','Y','N'),upd_date=NOW()
		";
	
		$this->query($sql,array(
									$member_idx,
									$program_idx,
									$member_idx,
									$program_idx,
								 ),$data
							 );

		$sql = "UPDATE
							tbl_program
						SET
							like_cnt =(select count(*) from tbl_program_like where del_yn='N' and program_idx=$program_idx and like_yn='Y')
						WHERE
							program_idx = ?
						";

		$this->query($sql,
									array(
									$program_idx
									),
									$data);

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_program_like
						WHERE
						 del_yn='N' 
						 and program_idx=$program_idx 
						 and like_yn='Y'
						";

		$like_cnt = $this->query_cnt($sql,
																	array(
																	),
																	$data);
	
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return $like_cnt;
		}
	}

	// 프로그램 담기
	public function display_mod_up($data){

		$news_idx=$data['news_idx'];
		$member_idx=$data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_news_display
						(
						member_idx,
						news_idx,
						display_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'N',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,news_idx=?,display_yn=if(display_yn='N','Y','N'),upd_date=NOW()
		";
	
		$this->query($sql,array(
									$member_idx,
									$news_idx,
									$member_idx,
									$news_idx,
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

	// 알림 리스트 총 카운트
	public function new_alarm_count(){

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_alarm
						WHERE
							del_yn = 'N'
							AND read_yn = 'N'
							AND member_idx = ?
		";

		return $this->query_cnt($sql,array($this->member_idx));
	}


//지역 시도 리스트
	public function city_list() {

		$sql = "
				SELECT
					city_cd,
					city_name,
					id_cd
				FROM
					tbl_city_cd
				ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,array());

	}

//구군 리스트
	public function region_list($data) {

		$city_cd=$data['city_cd'];

		$sql = "
				SELECT
					region_cd,
					region_name,
					city_cd
				FROM
					tbl_region_cd
				WHERE
					city_cd =?
				ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,array($city_cd));

	}

//메인 카테고리 리스트
	public function keyword_list() {

		$sql = "
				SELECT
					keyword_name,
					keyword_code,
					keyword_memo
				FROM
					tbl_keyword
				WHERE
					del_yn ='N' ";
	//	if($auto_yn == 'Y'){
	//		$sql .= " AND auto_yn = 'Y'";
	//	}
		$sql .= " GROUP BY keyword_code
				ORDER BY order_no ";

		return $this->query_result($sql,array());

	}

//키워드 리스트
	public function keyword_sub_list($data) {
		//$auto_yn = $data['auto_yn'];

		$keyword_code=$data['keyword_code'];

		$sql = "
				SELECT
					keyword_idx,
					keyword_name_sub,
					keyword_code,
					keyword_code_sub,
					keyword_memo
				FROM
					tbl_keyword
				WHERE
					keyword_code =?	";
		//	if($auto_yn == 'Y'){
		//		$sql .= " AND auto_sub_yn = 'Y'";
	//		}
			$sql .= "	AND del_yn = 'N'
				ORDER BY keyword_code_sub ASC
				  ";

		return $this->query_result($sql,array($keyword_code));

	}


}
?>
