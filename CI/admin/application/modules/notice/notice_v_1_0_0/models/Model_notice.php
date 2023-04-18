<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-10-13
| Memo : 공지사항 관리
|------------------------------------------------------------------------
*/

Class Model_notice extends MY_Model{

	// 공지사항 리스트
	public function notice_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							notice_idx,
							title,
							notice_state,
							del_yn,
							ins_date,
							DATE_FORMAT(upd_date,'%Y-%m-%d') as  upd_date
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
						";

		if($title != ""){
			$sql .= " AND title LIKE '%$title%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		$sql .=" ORDER BY ins_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// 공지사항 리스트 총 카운트
	public function notice_list_count($data){

		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
						";

		if($title != ""){
			$sql .= " AND title LIKE '%$title%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		return $this->query_cnt($sql,
													  array(
														));
	}

	// 공지사항 등록
	public function notice_reg_in($data){

		$title = $data['title'];
		$contents = $data['contents'];
		$img_path = $data['img_path'];
		$notice_state = $data['notice_state'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_notice
						(
							title,
							contents,
							img,
							notice_state,
							del_yn,
							ins_date,
							upd_date
						)VALUES(
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
								 $title,
								 $contents,
								 $img_path,
								 $notice_state,
							   ),
								 $data);

		$notice_idx = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return $notice_idx;
		}
	}

	// 공지사항 상세
	public function notice_detail($data){

		$notice_idx = $data['notice_idx'];

		$sql = "SELECT
	          	notice_idx,
							title,
							contents,
							img,
							DATE_FORMAT(ins_date,'%Y-%m-%d') AS ins_date,
							DATE_FORMAT(upd_date,'%Y-%m-%d') AS upd_date,
							notice_state,
							del_yn
	        	FROM
	          	tbl_notice
	        	WHERE
	           	notice_idx = ?
							AND del_yn = 'N'
					";

   		return $this->query_row($sql,
															array(
														  $notice_idx
														  ),
															$data);
	}

	// 공지사항 수정
	public function notice_mod_up($data){

		$notice_idx = $data['notice_idx'];
		$title = $data['title'];
		$contents = $data['contents'];
		$img_path = $data['img_path'];
		$notice_state = $data['notice_state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_notice
						SET
							title = ?,
							contents = ?,
							img = ?,
							notice_state = ?,
							upd_date = NOW()
						WHERE
							notice_idx = ?
						";

		$this->query($sql,
								 array(
							   $title,
							   $contents,
							   $img_path,
							   $notice_state,
							   $notice_idx
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

	// 공지사항 상태 변경
	public function notice_state_mod_up($data){

		$notice_idx  = $data['notice_idx'];
		$notice_state = $data['notice_state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_notice
						SET
							notice_state = ?,
							upd_date = NOW()
						WHERE
							notice_idx = ?
						";

		$this->query($sql,
								 array(
								 $notice_state,
								 $notice_idx
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

	// 공지사항 삭제
	public function notice_del($data){

		$notice_idx = $data['notice_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_notice
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							notice_idx IN ($notice_idx)
						";

		$this->query($sql,
								 array(
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

}	//클래스의 끝
?>
