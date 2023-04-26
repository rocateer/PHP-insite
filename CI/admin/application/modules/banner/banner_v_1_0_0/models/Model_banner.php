<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2023-04-25
| Memo : 배너
|------------------------------------------------------------------------
*/

Class Model_banner extends MY_Model{

		// 공지사항 리스트
		public function notice_list(){
	
			$sql = "SELECT
								notice_idx,
								title,
								display_yn,
								del_yn,
								ins_date,
								DATE_FORMAT(upd_date,'%Y-%m-%d') as  upd_date
							FROM
								tbl_notice
							WHERE
								del_yn = 'N'
								and display_yn='Y'
							";
	
			$sql .=" ORDER BY ins_date DESC";
	
			return $this->query_result($sql,
																 array(
																 ));
		}

	// 배너관리 리스트
	public function banner_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							banner_idx, 
							notice_idx, 
							title, 
							mobile_img, 
							pc_img, 
							best_img, 
							display_yn, 
							del_yn, 
							DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS ins_date
						FROM
							tbl_banner as a
						WHERE
							a.del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND a.title LIKE '%$title%' ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(a.ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(a.ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}

		$sql .= " ORDER BY a.ins_date DESC LIMIT ?, ?";

  	return  $this->query_result($sql,
																array(
																$page_no,
																$page_size
																),
																$data
																);
	}

	// 배너관리 카운트
  public function banner_list_count($data){
		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_banner as a
						WHERE
							a.del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND a.title LIKE '%$title%' ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(a.ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(a.ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}

  	return  $this->query_cnt($sql,
														array(
														),
														$data
														);
  }

	// 배너관리 상세
	public function banner_detail($data){

		$banner_idx = $data['banner_idx'];

		$sql = "SELECT
							banner_idx, 
							notice_idx, 
							title, 
							mobile_img, 
							pc_img, 
							best_img, 
							display_yn, 
							del_yn, 
							ins_date, 
							upd_date
						FROM
							tbl_banner
						WHERE
							banner_idx = ?
		";

		return  $this->query_row($sql,
														array(
														$banner_idx
														),$data
														);
	}
	
	// 배너관리 상태 변경
	public function display_mod_up($data){

		$banner_idx  = $data['banner_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_banner
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							banner_idx = ?
						";

		$this->query($sql,array(
								 $display_yn,
								 $banner_idx
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

	// 배너관리 등록하기
	public function banner_reg_in($data){
		$title = $data['title'];
		$m_img = $data['m_img'];
		$pc_img = $data['pc_img'];
		$best_img = $data['best_img'];
		$notice_idx = $data['notice_idx'];
		$display_yn = $data['display_yn'];
		
		$this->db->trans_begin();
		
		$sql = "INSERT INTO
							tbl_banner
							(			
								notice_idx, 
								title, 
								mobile_img, 
								pc_img, 
								best_img, 
								display_yn, 
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
		
		$this->query($sql,
								array(
									$notice_idx,
									$title,
									$m_img,
									$pc_img,
									$best_img,
									$display_yn
								),
								$data
							);

		$banner_idx = $this->db->insert_id();
							
		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}
	
	// 배너관리 수정
	public function banner_mod_up($data){
		$banner_idx = $data['banner_idx'];
		$title = $data['title'];
		$m_img = $data['m_img'];
		$pc_img = $data['pc_img'];
		$best_img = $data['best_img'];
		$notice_idx = $data['notice_idx'];
		$display_yn = $data['display_yn'];
		
		$this->db->trans_begin();
		
		$sql = "UPDATE
							tbl_banner
						SET
							notice_idx=?,
							title=?,
							mobile_img=?,
							pc_img=?,
							best_img=?,
							display_yn=?,
							upd_date = NOW()
						WHERE
							banner_idx = ?
							";
		
		$this->query($sql,
								array(
								$notice_idx,
								$title,
								$m_img,
								$pc_img,
								$best_img,
								$display_yn,
								$banner_idx
								),
								$data
							);
							
		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}

	// 배너관리 삭제
	public function banner_del($data){

		$banner_idx = $data['banner_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_banner
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							banner_idx =$banner_idx
						";

		$this->query($sql,array(),$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		  return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

}	// 클래스의 끝

?>
