<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 일반 로그인
|------------------------------------------------------------------------
*/

class Model_login extends MY_Model{

  // 회원 로그인
  public function member_login_check($data){

    $member_id = $data['member_id'];
    $member_pw = $data['member_pw'];

    $sql = "SELECT
              member_idx,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              del_yn
            FROM
              tbl_member
            WHERE
              member_id = FN_AES_ENCRYPT(?)
              AND member_pw = SHA2(?, 512)
              and del_yn='N'
            ";

    return $this->query_row($sql,array(
                            $member_id,
                            $member_pw
                            ),$data
                            );
  }

  // gcm_key,device_os 업데이트
  public function member_gcm_device_up($data) {
    $member_idx=$data['member_idx'];
    $gcm_key=$data['gcm_key'];
    $device_os=$data['device_os'];

    $this->db->trans_begin();

    $sql="UPDATE
            tbl_member
          SET
            gcm_key = ?,
            device_os = ?,
            upd_date = NOW()
          WHERE
            member_idx = ?
           ";

    $this->query($sql,
                array(
                $gcm_key,
                $device_os,
                $member_idx
                ),
                $data);

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    }else{
      $this->db->trans_commit();
      return "1";
    }
  }

} // 클래스의 끝
?>
