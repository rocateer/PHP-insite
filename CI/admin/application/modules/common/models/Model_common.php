<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  .  ____  .    ________________________________________________________
  |/      \|   | Create-Date :  2017.08.05 | Author : 김옥훈
 [| ♥    ♥ |]  | Modify-Date :  2017.??.?? | Editor : 서욘두
  |___==___|  V  Class-Name  :  common
             / | Memo        :  공통 영역 관리
               |________________________________________________________
*/

Class Model_common extends MY_Model {

		/*
	|------------------------------------------------------------------------
	| 큐레이션
	|------------------------------------------------------------------------
	*/

		//고민 큐레이션
		public function board_list(){

			$sql = "SELECT
								a.board_idx,
								a.title,
								a.contents,
								b.category_name,
								c.member_nickname,
								FN_AES_DECRYPT(c.member_name) AS member_name,
								a.display_yn
							FROM tbl_board AS a
							JOIN tbl_category_management as b ON b.category_management_idx=a.category_idx
							JOIN tbl_member as c ON c.member_idx=a.member_idx 
							WHERE a.del_yn='N'
							AND a.display_yn='Y'
							ORDER BY a.ins_date DESC
			";
	
			return $this->query_result($sql,array());
		}

		//프로그램
		public function program_list(){

			$sql = "SELECT
								program_idx,
								title,
								contents,
								display_yn
							FROM tbl_program AS a
							WHERE a.del_yn='N'
							AND a.display_yn='Y'
							ORDER BY a.ins_date DESC
			";

	
			return $this->query_result($sql,array());
		}
	
		//매거진
		public function news_list(){
	
			$sql = "SELECT
								news_idx,
								title,
								contents,
								display_yn
							FROM tbl_news AS a
							WHERE a.del_yn='N'
							AND a.display_yn='Y'
							ORDER BY a.ins_date DESC
			";
	
			return $this->query_result($sql,array());
		}
	
		//고민상담 카테고리
		public function counselor_list(){
	
			$sql = "SELECT
								category_management_idx,
								category_name,
								ins_date
							FROM 
								tbl_category_management
							WHERE 
								del_yn='N'
								AND  type=1
								AND  state=1
								order by order_no
			";
			return $this->query_result($sql,array());
		}
	
		//리스트
		public function main_section_list($data){
			$menu_type= $data['menu_type'];
	
			$sql = "SELECT
								main_section_idx,
								menu_type,			
								display_yn,
								news_idx,	
								program_idx,	
								board_idx,	
								ins_date
								FROM tbl_main_section
								WHERE del_yn='N'
								AND  menu_type=?
			";
			return $this->query_result($sql,array($menu_type));
	
	
		}
	
		//수정
		public function display_mod_up($data){
	
			$main_section_idx = $data['main_section_idx'];
			$display_yn = $data['display_yn'];
	
			$this->db->trans_begin();
	
			$sql = "UPDATE
								tbl_main_section
							SET
								display_yn = ?,
								upd_date = NOW()
							WHERE
								main_section_idx = ?
			";
	
			$this->query($sql,array(
									 $display_yn,
									 $main_section_idx
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

		//수정
		public function main_section_mod_up($data){
	
			$main_section_idx = $data['main_section_idx'];
			$news_idx 			= $data['news_idx'];
			$program_idx 			= $data['program_idx'];
			$board_idx 			= $data['board_idx'];
	
			$this->db->trans_begin();
	
			$sql = "UPDATE
								tbl_main_section
							SET
								news_idx = ?,
								program_idx = ?,						
								board_idx = ?,						
								upd_date = NOW()
							WHERE
								main_section_idx = ?
			";
	
			$this->query($sql,array(
									 $news_idx,
									 $program_idx,							
									 $board_idx,							
									 $main_section_idx
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
		//수정
		public function setting_mod_up($data){
	
			$type = $data['type'];
			$main_news_title 			= $data['main_news_title'];
			$main_program_title 			= $data['main_program_title'];
	
			$this->db->trans_begin();
			if($type=='0'){

				$sql = "UPDATE
									tbl_setting
								SET
									main_news_title = ?,
									upd_date = NOW()
								WHERE
								setting_idx = 1
				";
		
				$this->query($sql,array(
										 $main_news_title,
										 ),$data
									 );
									 
			}else if($type=='1'){
				
				$sql = "UPDATE
									tbl_setting
								SET
									main_program_title = ?,
									upd_date = NOW()
								WHERE
								setting_idx = 1
				";
		
				$this->query($sql,array(
											$main_program_title,
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

		// 세팅값
		public function setting_detail() {

			$sql = "SELECT 	
								setting_idx, 
								main_news_title,
								main_program_title
							FROM 
							 tbl_setting 					 
			";
	
			return $this->query_row($sql,array());
	
		}
	

	// 지역 시도 리스트
	public function city_list() {

		$sql = "SELECT
							city_cd,
							city_name,
							id_cd

						FROM
							tbl_city_cd

						ORDER BY
							order_no ASC
				  ";

		return $this->query_result($sql,array());

	}

	// 구군 리스트
	public function region_list($data) {

		$city_cd = $data['city_cd'];

		$sql = "SELECT
							region_cd,
							region_name,
							city_cd

						FROM
							tbl_region_cd

						WHERE
							city_cd = ?

						ORDER BY
							order_no ASC
				  ";

		return $this->query_result($sql
																	,array(
																					$city_cd
																				)
																			);

	}

  // smtp 조회
  public function smtp_detail2(){

    $sql = "SELECT
              smtp_email_idx,
              smtp_host,
              smtp_user,
              smtp_pass,
              smtp_port,
              from_email,
              from_name
            FROM
              tbl_smtp_email
            WHERE
              del_yn = 'N'
              ORDER BY last_send_date ASC,smtp_email_idx ASC LIMIT 1
            ";

  return $this->query_row($sql,array(
                            )
                            );
  }

  //마지막 stmp 발송일 수정
  public function smtp_last_date_mod_up($data){

		$smtp_email_idx = $data['smtp_email_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_smtp_email
						SET
              send_cnt = CASE WHEN DATE_FORMAT(last_send_date,'%Y%m%d') <> DATE_FORMAT(NOW(),'%Y%m%d') THEN 1 ELSE send_cnt+1 END,
              last_send_date	= NOW(),
							upd_date = NOW()
						WHERE
							smtp_email_idx = ?
						";

		$this->query($sql,array(
									$smtp_email_idx
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

}
?>
