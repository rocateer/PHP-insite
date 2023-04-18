<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 패스워드 변경
|------------------------------------------------------------------------
*/

Class Model_member_pw_change extends MY_Model {

  // 1. 현재 비밀번호 확인
  public function member_pw_check($data){

    $member_idx = $data['member_idx'];
    $member_pw = $data['member_pw'];

    $sql = "SELECT
              COUNT(*) AS cnt
            FROM
              tbl_member
            WHERE
              member_idx = ?
              AND member_pw = SHA2(?, 512)
            ";

    return $this->query_cnt($sql,array(
                            $member_idx,
                            $member_pw
                            ),$data
                          );
  }

  // 2. 회원비밀번호 변경
  public function member_pw_mod_up($data){

    $member_idx = $data['member_idx'];
    $new_member_pw = $data['new_member_pw'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
						SET
							member_pw = SHA2(?, 512),
              upd_date = NOW()
						WHERE
							member_idx = ?
          ";

    $this->query($sql,array(
						 	   $new_member_pw,
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

}
?>
