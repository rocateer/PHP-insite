<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈 
| Create-Date : 2018-10-16
| Memo : 이벤트
|------------------------------------------------------------------------
*/

class Model_coupon extends MY_Model{
  // 이벤트 리스트 가져오기
  public function coupon_list($data){
    $page_size=(int)$data['page_size'];
    $page_no=(int)$data['page_no'];

    $sql = "SELECT
              a.coupon_idx,
              a.title,
              a.contents,
              a.del_yn,
              DATE_FORMAT(ins_date, '%Y-%m-%d') as  ins_date
            FROM
              tbl_coupon a
            WHERE
              a.del_yn = 'N'
    ";
    $sql .="ORDER BY coupon_idx DESC limit ?, ?";

    return $this->query_result($sql,
                              array(
                                $page_no,
                                $page_size
                              ),$data
                            );
  }

  //카운트
  public function coupon_list_count(){

    $sql = "SELECT
            count(1) as cnt
            FROM
              tbl_coupon a
            WHERE
              a.del_yn = 'N'
    ";

    return $this->query_cnt($sql,
                              array(
                              )
                            );
  }

  // 리스트
  public function coupon_detail($data){
    $coupon_idx=$data['coupon_idx'];

    $sql = "SELECT
              a.coupon_idx,
              a.title,
              a.contents,
              a.del_yn,
              a.ins_date
            FROM
              tbl_coupon a
            WHERE
              a.del_yn = 'N'
              and coupon_idx=?
    ";

    return $this->query_row($sql,
                              array(
                                $coupon_idx
                              ),$data
                            );
  }

} // 클래스의 끝
?>
