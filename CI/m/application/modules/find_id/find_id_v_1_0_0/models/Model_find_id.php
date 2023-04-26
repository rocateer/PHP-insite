<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-06-27
|------------------------------------------------------------------------
*/

Class Model_find_id extends MY_Model {

  // 아이디 찾기
  public function find_id_member($data){
  
    $member_phone = $data['member_phone'];
    $member_name = $data['member_name'];

    $sql = "SELECT
              member_idx,
              FN_AES_DECRYPT(member_name) AS member_name,
              FN_AES_DECRYPT(member_id) AS member_id
            FROM
              tbl_member
            WHERE
              del_yn!='Y'
              and member_name = FN_AES_ENCRYPT(?)
              and member_phone = FN_AES_ENCRYPT(?)

    ";

    return $this->query_row($sql,array(
                            $member_name,
                            $member_phone,
                            ),$data
                          );
  }

  // 아이디 찾기
  public function find_id_detail($data){
  
    $member_idx = $data['member_idx'];

    $sql = "SELECT
              member_idx,
              FN_AES_DECRYPT(member_name) AS member_name,
              FN_AES_DECRYPT(member_id) AS member_id
            FROM
              tbl_member
            WHERE
            member_idx=?
    ";

    return $this->query_row($sql,array(
                            $member_idx,
                            ),$data
                          );
  }

}	// 클래스의 끝
?>
