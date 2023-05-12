<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-24
| Memo : POST관리
|------------------------------------------------------------------------
*/

Class Model_community extends MY_Model{

	// post관리 리스트
	public function community_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							community_idx,
							title,
							display_yn,
							ins_date
						FROM
							tbl_community
						WHERE
							del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND title LIKE '%$title%' ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND display_yn = '$display_yn' ";
		}

		$sql .= " ORDER BY ins_date DESC LIMIT ?, ?";

  	return  $this->query_result($sql,
																array(
																$page_no,
																$page_size
																),
																$data
																);
	}

	// post관리 카운트
  public function community_list_count($data){
		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_community
						WHERE
							del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND title LIKE '%$title%' ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND display_yn = '$display_yn' ";
		}

  	return  $this->query_cnt($sql,
														array(
														),
														$data
														);
  }

	// post관리 상세
	public function community_detail($data){

		$community_idx = $data['community_idx'];

		$sql = "SELECT
							community_idx,
							display_yn,						
							img_path,
							title,
							ins_date,
							contents
						FROM
							tbl_community
						WHERE
							community_idx = ?
		";

		return  $this->query_row($sql,
														array(
														$community_idx
														),$data
														);
	}
	
	// post관리 상태 변경
	public function community_state_mod_up($data){

		$community_idx  = $data['community_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_community
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							community_idx = ?
						";

		$this->query($sql,array(
								 $display_yn,
								 $community_idx
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
	
	// post관리 등록하기
	public function community_reg_in($data){
		$title = $data['title'];
		$img_path = $data['img_path'];
		$contents = $data['contents'];
		$display_yn = $data['display_yn'];
		
		$this->db->trans_begin();
		
		$sql = "INSERT INTO
							tbl_community
							(			
								title,
								img_path,
								contents,
								display_yn,
								ins_date,
								upd_date,
								del_yn
							)
						VALUES
							(
								?,
								?,
								?,
								?,
								NOW(),
								NOW(),
								'N'
							)							
		";
		
		$this->query($sql,
								array(
								$title,
								$img_path,
								$contents,
								$display_yn
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
	
	// post관리 수정
	public function community_mod_up($data){
		$community_idx = $data['community_idx'];
		$img_path = $data['img_path'];
		$title = $data['title'];
		$contents = $data['contents'];
		
		$this->db->trans_begin();
		
		$sql = "UPDATE
							tbl_community
						SET
							img_path = ?,
							title = ?,
							contents = ?,
							upd_date = NOW()
						WHERE
						 community_idx = ?
							";
		
		$this->query($sql,
								array(
								$img_path,
								$title,
								$contents,
								$community_idx
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

	// post관리 삭제
	public function community_del($data){

		$community_idx = $data['community_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_community
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							community_idx IN ($community_idx)
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
