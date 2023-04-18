<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-09-05
| Memo : 비밀번호 변경
|------------------------------------------------------------------------
*/

Class Model_member_pw_change extends MY_Model {

	// 회원 정보 확인
	public function member_pw_confirm($data) {

	  $member_idx=$data['member_idx'];
		$member_pw=$data['member_pw'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							del_yn
						FROM
							tbl_member
						WHERE
							member_idx = ?
							AND member_pw = SHA2(?,512)
		";

		return $this->query_row($sql, array($member_idx, $member_pw));
	}

	// 비밀번호 변경
	public function member_pw_mod_up($data) {

		$member_idx = $data['member_idx'];
		$member_pw_new = $data['member_pw_new'];

		$this->db->trans_begin();

		$sql="UPDATE
						tbl_member
					SET
						member_pw = SHA2(?, 512),
						upd_date = NOW()
					WHERE
						member_idx =?
				 ";

		$this->query($sql,array(
								$member_pw_new,
								$member_idx
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


}	// 클래스의 끝
?>
