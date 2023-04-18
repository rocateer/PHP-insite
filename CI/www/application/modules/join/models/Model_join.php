<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  .  ____  .    __________________________________________________________
  |/      \|   | Create-Date :  2018.05.31 | Author : 서민규
 [| ♥    ♥ |]  | Modify-Date :  2017.05.31 | Editor : 서민규
  |___==___|  V  Class-Name  :  Member
             / | Memo        :  회원가입
               |__________________________________________________________
*/

Class Model_join extends MY_Model {

	// 1. 아이디 중복 체크
	public function member_id_check($data) {

		$member_id = $data['member_id'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_id = FN_AES_ENCRYPT(?)
						";

		return $this->query_cnt($sql,array($member_id));
	}

	// 2. 회원 가입
	public function member_reg_in($data){

		$member_id = $data['member_id'];
    $member_pw = $data['member_pw'];
    $member_join_type = $data['member_join_type'];
    $device_os = $data['device_os'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member
							(
								member_id,
								member_pw,
								member_join_type,
								del_yn,
								ins_date,
								upd_date
							)
							SELECT
								FN_AES_ENCRYPT(?),
								SHA2(?, 512),
								?,
								'N',
								'N',
								NOW(),
								NOW()
						";

		$this->query($sql,array(
								 $member_id,
							 	 $member_pw,
							 	 $member_join_type
							   ),$data
							 );

		$this->query($sql,array());


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return $member_idx;
		}
	}

	// 5. 회원 탈퇴
	public function member_withdraw($data){

		$member_idx = $data['member_idx'];
		$withdraw_state = $data['withdraw_state'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							member_state = 3,
							withdraw_state = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
						";

		$this->query($sql,array(
								 $withdraw_state,
								 $member_idx
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






}	// 클래스의 끝
?>
