<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  .  ____  .    __________________________________________________________
  |/      \|   | Create-Date :  2018.05.31 | Author : 김광호
 [| ♥    ♥ |]  | Modify-Date :  2017.05.31 | Editor : 김광호
  |___==___|  V  Class-Name  :  Find_password
             / | Memo        :  비밀번호 찾기
               |__________________________________________________________
*/

Class Model_find_pw_to_email extends MY_Model {

	# model 회원이메일 체크
	public function member_id_check($data){

		$member_id = $data['member_id'];
		//$member_phone = $data['member_phone'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
						  	del_yn = 'N'
							AND member_id = FN_AES_ENCRYPT(?)
					  ";

		return $this->query_cnt($sql,array(
														$member_id
														),$data
													);
	}

  // 비밀번호 변경 인증키 발급
	public function pwd_change_key_up($data) {

		$member_id = $data['member_id'];
		$change_pw_key = $data['change_pw_key'];

		$this->db->trans_begin();

		$sql="UPDATE
						tbl_member
					SET
						change_pw_key = ?,
						upd_date = NOW()
					WHERE
						member_id = FN_AES_ENCRYPT(?)
				 ";

		$this->query($sql,array(
								$change_pw_key,
								$member_id
								),$data
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
