<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김민정
| Create-Date : 2018-03-23
| Memo : 비밀번호 변경
|------------------------------------------------------------------------
*/

Class Model_admin_password extends MY_Model {

	// 패스워드 변경
	public function pw_mod_up($data) {

		$admin_idx = $data['admin_idx'];
		$admin_pw = $data['admin_pw'];
		$admin_new_pw = $data['admin_new_pw'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_admin
						SET
							admin_pw = SHA2(?,512),
							upd_date = NOW()
						WHERE
							admin_idx = ?
						AND
							admin_pw = SHA2(?,512)
						";

		$this->query($sql,
								array(
								$admin_new_pw,
								$admin_idx,
								$admin_pw
								),
								$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 비밀번호 체크
	public function pw_check($data) {

		$admin_pw = $data['admin_pw'];
		$admin_idx = $data['admin_idx'];

		$sql = "SELECT
							count(1) AS cnt
						FROM
							tbl_admin
						WHERE
							admin_idx = ? AND
							admin_pw = SHA2(?,512)
						";

		return $this->query_cnt($sql,
														array(
															$admin_idx,
															$admin_pw
														),
														$data
														);
	}

}
?>
