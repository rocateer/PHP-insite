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
    $faq_category_idx=$data['faq_category_idx'];

    $sql = "SELECT
              a.faq_idx,
              a.title,
              a.contents,
              b.faq_category_name
            FROM
              tbl_faq a
              LEFT JOIN tbl_faq_category b ON b.faq_category_idx = a.faq_category_idx
            WHERE
              a.del_yn = 'N'";

    if($faq_category_idx!=""){
      $sql .= " AND a.faq_category_idx = $faq_category_idx";
    }
    $sql .= " ORDER BY a.ins_date DESC LIMIT ?, ? ";

    return $this->query_result($sql,
                              array(
                              $page_no,
                              $page_size
                              ),$data
                              );

  }

  //faq 리스트 총 카운트
  public function faq_list_count($data){

    $faq_category_idx=$data['faq_category_idx'];

    $sql = "SELECT
              COUNT(*) AS cnt
            FROM
              tbl_faq a
              LEFT JOIN tbl_faq_category b ON b.faq_category_idx = a.faq_category_idx
            WHERE
              a.del_yn = 'N'
            ";

    if($faq_category_idx!=""){
      $sql .= " AND a.faq_category_idx = $faq_category_idx";
    }
    return $this->query_cnt($sql,array());
  }

  // FAQ 카테고리 리스트
  	public function faq_category_list() {

  		$sql = "SELECT
  							faq_category_idx,
  							faq_category_name
  						FROM
  							tbl_faq_category
  						WHERE
  							del_yn = 'N'
  						ORDER BY faq_category_idx ASC
  						";
  		return $this->query_result($sql,
  															array(

  															)
  															);

  	}

} // 클래스의 끝
?>
