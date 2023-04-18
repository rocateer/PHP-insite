<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-11-05
| Memo : 비밀번호 찾기
|------------------------------------------------------------------------
*/

Class Model_find_pw extends MY_Model {

  // 회원 체크
	public function member_check($data){

		$member_id = $data['member_id'];
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];

		$sql = "SELECT
							member_idx,
              FN_AES_DECRYPT(member_id) as member_id,
              FN_AES_DECRYPT(member_id) as member_email
						FROM
							tbl_member
						WHERE
							member_id = FN_AES_ENCRYPT(?)
							AND member_name = FN_AES_ENCRYPT(?)
							AND member_phone = FN_AES_ENCRYPT(?)
		 ";

		return $this->query_row($sql,array(
														$member_id,
														$member_name,
														$member_phone,
														),$data
													);
	}


  // 비밀번호 변경 인증키 발급
	public function pw_change_key_up_member($data) {

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
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 펀드매니저
	// 회원 체크
	public function corp_check($data){

	  $corp_id = $data['corp_id'];
	  $corp_name = $data['corp_name'];
	  $corp_tel = $data['corp_tel'];

	  $sql = "SELECT
	            corp_idx,
	            FN_AES_DECRYPT(corp_id) as corp_id
	          FROM
	            tbl_corp
	          WHERE
	            del_yn='N'
	            and corp_tel = ?
	            and corp_name = ?
	            AND corp_id = FN_AES_ENCRYPT(?)
	   ";

	  return $this->query_row($sql,array(
	                          $corp_tel,
	                          $corp_name,
	                          $corp_id,
	                          ),$data
	                        );
	}


	// 비밀번호 변경 인증키 발급
	public function pw_change_key_up_corp($data) {

	  $corp_id = $data['corp_id'];
	  $change_pw_key = $data['change_pw_key'];

	  $this->db->trans_begin();

	  $sql="UPDATE
	          tbl_corp
	        SET
	          change_pw_key = ?,
	          upd_date = NOW()
	        WHERE
	          corp_id = FN_AES_ENCRYPT(?)
	  ";

	  $this->query($sql,array(
	              $change_pw_key,
	              $corp_id
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
