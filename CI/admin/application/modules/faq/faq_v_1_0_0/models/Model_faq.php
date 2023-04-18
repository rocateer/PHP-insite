<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-09-29
| Memo : FAQ 관리
|------------------------------------------------------------------------
*/

Class Model_faq extends MY_Model{

	// faq 리스트 가져오기
	public function faq_list_get($data){

		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							a.faq_idx,
							a.title,
							a.del_yn,
							DATE_FORMAT(a.ins_date,'%Y-%m-%d') as ins_date
						FROM
							tbl_faq a
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

		$sql .=" ORDER BY a.ins_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															array(
															$page_no,
															$page_size
															),
															$data);
	}

	// faq 리스트 가져오기 총 카운트
	public function faq_list_count($data){

		$title = $data['title'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_faq a
						WHERE
							a.del_yn = 'N'
						";

		if($title != ""){
			$sql .= " AND a.title = '$title' ";
		}

		if($s_date != ""){
			$sql .= " AND DATE(a.ins_date) >= '$s_date' ";
		}

		if($e_date != ""){
			$sql .= " AND DATE(a.ins_date) <= '$e_date' ";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

	// faq 상세
	public function faq_detail($data){

		$faq_idx=$data['faq_idx'];

		$sql = "SELECT
							a.faq_idx,
							a.title,
							a.contents,
							a.display_yn,
							a.ins_date,
							a.upd_date,
							a.del_yn,
							a.ins_date
						FROM
							tbl_faq a
						WHERE
							a.faq_idx = ?
							AND a.del_yn = 'N'
						";

			return $this->query_row($sql,
															array(
													    $faq_idx
												    	),
															$data);
	}

	// faq 수정
	public function faq_mod_up($data){

		$faq_idx = $data['faq_idx'];
		$title = $data['title'];
		$contents = $data['contents'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_faq
						SET
							title = ?,
							contents = ?,
							upd_date = NOW()
						WHERE
							faq_idx = ?
						";

		$this->query($sql,array(
							   $title,
							   $contents,
							   $faq_idx
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

	// faq 삭제
	public function faq_del($data){

		$faq_idx = $data['faq_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_faq
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							faq_idx IN ($faq_idx)
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

	// faq 등록
	public function faq_reg_in($data){

		$title = $data['title'];
		$contents = $data['contents'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_faq
						(
							title,
							contents,
							display_yn,
							del_yn,
							ins_date,
							upd_date
						)VALUES(
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
								$display_yn
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
	
	// faq 상태 변경
	public function display_yn_mod_up($data){

		$faq_idx = $data['faq_idx'];
		$state = $data['state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_faq
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							faq_idx = ?
						";

		$this->query($sql,
								 array(
								 $state,
								 $faq_idx
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
