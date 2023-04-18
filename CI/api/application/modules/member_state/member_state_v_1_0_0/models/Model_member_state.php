<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2020-04-13
| Memo : 회원 상태 체크
|------------------------------------------------------------------------
*/

class Model_member_state extends MY_Model{

  // 회원 상태 체크
  public function member_state_detail($data){

    $member_idx = $data['member_idx'];

    $sql = "SELECT
              del_yn
            FROM
              tbl_member
            WHERE
              member_idx = ?
            ";

    return $this->query_row($sql,array(
                            $member_idx
                            ),$data
                            );
  }

  // 회원 상태 체크
  public function corp_state_detail($data){

    $corp_idx = $data['corp_idx'];

    $sql = "SELECT
              corp_state
            FROM
              tbl_corp
            WHERE
              corp_idx = ?
            ";

    return $this->query_row($sql,array(
                            $corp_idx
                            ),$data
                            );
  }

} // 클래스의 끝
?>
