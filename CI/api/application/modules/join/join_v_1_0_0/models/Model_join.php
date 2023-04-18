<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 일반 회원가입
|------------------------------------------------------------------------
*/

Class Model_join extends MY_Model {

	// 아이디 중복 체크
	public function member_id_check($data){

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

  // 닉네임 중복 체크
	public function member_nickname_check($data){

		$member_nickname = $data['member_nickname'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_nickname = ?
						";

		return $this->query_cnt($sql,array($member_nickname));
	}

	// 회원 가입
	public function member_reg_in($data){

    $member_id = $data['member_id'];
		$member_pw = $data['member_pw'];
		$member_nickname = $data['member_nickname'];
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_gender = $data['member_gender'];
		$member_birth = $data['member_birth'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member
							(
								member_id,
								member_pw,
								member_name,
								member_phone,
                member_nickname,
                member_birth,
								member_gender,
								member_join_type,
								del_yn,
								ins_date,
								upd_date
							)
							SELECT
								FN_AES_ENCRYPT(?),
								SHA2(?, 512),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								?,
								FN_AES_ENCRYPT(?),
								?,
								'C',
								'N',
								NOW(),
								NOW()
						";

		$this->query($sql,array(
								 $member_id,
							 	 $member_pw,
								 $member_name,
								 $member_phone,
							 	 $member_nickname,
                 $member_birth,
								 $member_gender
							   ),$data
							 );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
  		$member_idx = $this->db->insert_id();
			$this->db->trans_commit();
			return "1000";
		}
	}

}	// 클래스의 끝
?>
