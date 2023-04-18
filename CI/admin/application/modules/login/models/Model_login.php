<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :  김옥훈
| Create-Date : 2017-07-24
| Memo : 관리자
|------------------------------------------------------------------------
*/

Class Model_login extends MY_Model {

//로그인
	public function login_check($data) {
		$admin_id=$data['admin_id'];
		$admin_pw=$data['admin_pw'];

		$sql = "SELECT
							admin_idx,
							FN_AES_DECRYPT(admin_id) AS admin_id,
							admin_name,
							admin_right
						FROM
							tbl_admin
						WHERE
							admin_id = FN_AES_ENCRYPT(?)
							AND admin_pw = SHA2(?,512)
					";

		return $this->query_row($sql,
														array(
														$admin_id,
														$admin_pw
														),
														$data
														);
	}


}
?>
