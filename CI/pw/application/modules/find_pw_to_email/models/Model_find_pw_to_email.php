<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  .  ____  .    __________________________________________________________
  |/      \|   | Create-Date :  2018.05.31 | Author : 서민규
 [| ♥    ♥ |]  | Modify-Date :  2017.05.31 | Editor : 서민규
  |___==___|  V  Class-Name  :  Find_password
             / | Memo        :  비밀번호 찾기
               |__________________________________________________________
*/


Class Model_find_pw_to_email extends MY_Model {

  // 1. member비밀번호 변경 요청 인증키 확인
	public function member_pw_change_key_check($data) {

		$p_code = $data['p_code'];

		$sql = "SELECT
							member_idx
						FROM
							tbl_member
						WHERE
							change_pw_key = ?
				  ";

		return $this->query_row($sql,array(
														$p_code
												  	)
												  );

	}

	// 2. 회원 비밀번호 재설정
	public function member_pw_reset_up($data){

		$p_code = $data['p_code'];
		$member_pw = $data['member_pw'];

		$this->db->trans_begin();

		$sql = "UPDATE
						   tbl_member
						SET
							 member_pw = SHA2(?, '512'),
							 change_pw_key = NULL
						WHERE
							 change_pw_key = ?
				";

		$this->query($sql,array(
								 $member_pw,
								 $p_code
								)
							);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}

	}


	// 1. member비밀번호 변경 요청 인증키 확인
	public function corp_pw_change_key_check($data) {

		$p_code = $data['p_code'];

		$sql = "SELECT
							corp_idx
						FROM
							tbl_corp
						WHERE
							change_pw_key = ?
					";

		return $this->query_row($sql,array(
														$p_code
														)
													);

	}

	// 2. 회원 비밀번호 재설정
	public function corp_pw_reset_up($data){

		$p_code = $data['p_code'];
		$member_pw = $data['member_pw'];

		$this->db->trans_begin();

		$sql = "UPDATE
							 tbl_corp
						SET
							 corp_pw = SHA2(?, '512'),
							 change_pw_key = NULL
						WHERE
							 change_pw_key = ?
				";

		$this->query($sql,array(
								 $member_pw,
								 $p_code
								)
							);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}

	}

}
?>
