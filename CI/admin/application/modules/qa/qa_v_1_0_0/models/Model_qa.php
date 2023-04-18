<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-10-06
| Memo : qa 관리
|------------------------------------------------------------------------
*/

Class Model_qa extends MY_Model {

	// qa 총 카운트
	public function total_qa(){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_qa
						WHERE
							del_yn ='N'
					";

		return $this->query_cnt($sql,
														array(
														)
														);
	}

	// qa 리스트 가져오기
	public function qa_list($data) {

		$member_id = $data['member_id'];
		$qa_title = $data['qa_title'];
		$member_nickname = $data['member_nickname'];
		$reply_yn = $data['reply_yn'];
		$qa_type = $data['qa_type'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							a.qa_idx,
							FN_AES_DECRYPT(b.member_id) AS member_id,
							b.member_nickname,
							a.qa_title,
							a.ins_date,
							a.reply_yn,
							a.qa_type,
							a.del_yn
						FROM
							tbl_qa a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							a.del_yn ='N'
						";

		if($member_id != ""){
  		$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}

		if($member_nickname != ""){
  		$sql .= " AND b.member_nickname LIKE '%$member_nickname%' ";
		}

		if($qa_title != ""){
  		$sql .= " AND a.qa_title LIKE '%$qa_title%' ";
		}

		if($reply_yn != ""){
  		$sql .= " AND a.reply_yn LIKE '%$reply_yn%' ";
		}
		if($qa_type != ""){
  		$sql .= " AND a.qa_type LIKE '%$qa_type%' ";
		}

		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}

		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		$sql .= " ORDER BY a.ins_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// qa 리스트 가져오기 총 카운트
	public function qa_list_count($data){

		$member_id = $data['member_id'];
		$qa_title = $data['qa_title'];
		$member_nickname = $data['member_nickname'];
		$reply_yn = $data['reply_yn'];
		$qa_type = $data['qa_type'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_qa a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							a.del_yn ='N'
							";

		if($member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}

		if($member_nickname != ""){
			$sql .= " AND b.member_nickname LIKE '%$member_nickname%' ";
		}

		if($qa_title != ""){
			$sql .= " AND a.qa_title LIKE '%$qa_title%' ";
		}

		if($reply_yn != ""){
			$sql .= " AND a.reply_yn LIKE '%$reply_yn%' ";
		}
		if($qa_type != ""){
			$sql .= " AND a.qa_type LIKE '%$qa_type%' ";
		}

		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}

		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		return	$this->query_cnt($sql,
														array(
														),
														$data);
	}

	// qa 상세
	public function qa_detail($data){

		$qa_idx = $data['qa_idx'];

		$sql = "SELECT
							a.qa_idx,
							a.member_idx,
							FN_AES_DECRYPT(b.member_id) AS member_id,
							b.member_nickname,
							a.qa_title,
							a.qa_type,
							a.qa_contents,
							a.reply_contents,
							a.device_os,
							a.app_version,
							a.os_version,
							a.ins_date,
							a.upd_date
						FROM
							tbl_qa a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							a.del_yn = 'N'
							AND a.qa_idx = ?
						";

		return $this->query_row($sql,
														array(
														$qa_idx
														),
														$data);
	}

	// qa 댓글 삭제
	public function qa_reply_del($data){

		$qa_idx = $data['qa_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_qa
						SET
							reply_contents = '',
							reply_yn = 'N',
							upd_date = NOW()
						WHERE
							qa_idx = ?
					";

		$this->query($sql,
								 array(
					 		 	 $qa_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// qa 답변 등록하기
	public function qa_reply_reg_in($data){

		$qa_idx = $data['qa_idx'];
		$reply_contents = $data['reply_contents'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_qa
						SET
							reply_contents = ?,
							reply_yn = 'Y',
							reply_date = NOW(),
							upd_date = NOW()
						WHERE
							qa_idx = ?
						";

		$this->query($sql,
								 array(
								 $reply_contents,
								 $qa_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// qa 삭제
	public function qa_del($data){

		$qa_idx = $data['qa_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_qa
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							qa_idx = ?
					";

		$this->query($sql,
								 array(
						 		 $qa_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}
}	// 클래스의 끝
?>
