<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : faq
|--------------
*/

Class Model_faq extends MY_Model {

  //faq 리스트
  public function faq_list($data){
    $page_size = (int)$data['page_size'];
    $page_no = (int)$data['page_no'];

    $sql = "SELECT
              faq_idx,
              title,
              contents
            FROM
              tbl_faq
            WHERE
              del_yn = 'N'
            ORDER BY ins_date DESC LIMIT ?, ? ";

    return $this->query_result($sql,
                              array(
                              $page_no,
                              $page_size
                              ),$data
                              );

  }

  //faq 리스트 총 카운트
  public function faq_list_count(){

    $sql = "SELECT
              COUNT(*) AS cnt
            FROM
              tbl_faq
            WHERE
              del_yn = 'N'
            ";

    return $this->query_cnt($sql,array());
  }

} // 클래스의 끝
?>
