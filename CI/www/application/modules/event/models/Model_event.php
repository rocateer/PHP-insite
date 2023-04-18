<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-12-23
| Memo : 이벤트
|------------------------------------------------------------------------
*/

class Model_event extends MY_Model{
  // 리스트
  public function event_list($data){
    $page_size=(int)$data['page_size'];
    $page_no=(int)$data['page_no'];

    $sql = "SELECT
              a.event_idx,
              a.title,
              a.contents,
              a.del_yn,
              DATE_FORMAT(ins_date, '%Y-%m-%d') as  ins_date
            FROM
              tbl_event a
            WHERE
              a.del_yn = 'N'
    ";
    $sql .="ORDER BY event_idx DESC limit ?, ?";

    return $this->query_result($sql,
                              array(
                                $page_no,
                                $page_size
                              ),$data
                            );
  }

  //카운트
  public function event_list_count(){

    $sql = "SELECT
            count(1) as cnt
            FROM
              tbl_event a
            WHERE
              a.del_yn = 'N'
    ";

    return $this->query_cnt($sql,
                              array(
                              )
                            );
  }

  // 리스트
  public function event_detail($data){
    $event_idx=$data['event_idx'];

    $sql = "SELECT
              a.event_idx,
              a.title,
              a.contents,
              a.del_yn,
              a.ins_date
            FROM
              tbl_event a
            WHERE
              a.del_yn = 'N'
              and event_idx=?
    ";

    return $this->query_row($sql,
                              array(
                                $event_idx
                              ),$data
                            );
  }

} // 클래스의 끝
?>
