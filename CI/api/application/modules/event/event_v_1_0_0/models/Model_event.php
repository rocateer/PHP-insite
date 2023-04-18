<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2019-05-13
| Memo :  event
|------------------------------------------------------------------------
*/

Class Model_event extends MY_Model {

  // 이벤트 리스트
  public function event_list($data) {
    $page_size = (int)$data['page_size'];
    $page_no = (int)$data['page_no'];

    $sql = "SELECT
              event_idx,
              title,
              contents,
              img_path,     
              DATE_FORMAT(end_date, '%Y.%m.%d') as  start_date,
              DATE_FORMAT(end_date, '%Y.%m.%d') as  end_date,
              DATE_FORMAT(ins_date, '%Y.%m.%d') as  ins_date
            FROM
              tbl_event
            WHERE
              del_yn = 'N'
              AND end_date>=current_date
            ";

    $sql .=" ORDER BY ins_date DESC ";
    $sql .=" LIMIT ?, ? ";

    return $this->query_result($sql,
                                array(
                                $page_no,
                                $page_size
                              ),$data
                              );
  }

  // 이벤트 리스트 총 카운트
  public function event_list_count($data) {

    $sql = "SELECT
              COUNT(*) AS cnt
            FROM
              tbl_event
            WHERE
              del_yn = 'N'
            AND end_date>=current_date
          ";

    return $this->query_cnt($sql,
                            array(

                            )
                            );

  }

// 이벤트 상세보기
  public function event_detail($data) {
    $event_idx=$data['event_idx'];

    $sql = "SELECT
              event_idx,
              title,
              DATE_FORMAT(end_date, '%Y.%m.%d') as  start_date,
              DATE_FORMAT(end_date, '%Y.%m.%d') as  end_date,
              DATE_FORMAT(ins_date, '%Y.%m.%d') as  ins_date,
              contents,
              img_path,
              link_url
            FROM
              tbl_event
            WHERE
              del_yn = 'N'
              AND event_idx = ?
            ";

    return $this->query_row($sql,
                            array(
                            $event_idx
                            ),$data
                            );
  }

// 이벤트 상세 웹뷰
  public function event_web_view($data) {
    $event_idx = $data['event_idx'];

    $sql = "SELECT
              subject,
              comment,
              img_path,
              ins_date,
              start_date,
              end_date
            FROM
              tbl_event
            WHERE
              del_yn = 'N'
              AND event_idx = ?
            ";

    return $this->query_row($sql,
                            array(
                              $event_idx
                            ),$data
                            );
  }


  // 이벤트 리스트
  public function event_main_list() {

    $sql = "SELECT
              event_idx,
              title,
              contents,
              img_path,
              img_width,
              img_height,
              DATE_FORMAT(end_date, '%Y.%m.%d') as  start_date,
              DATE_FORMAT(end_date, '%Y.%m.%d') as  end_date,
              DATE_FORMAT(ins_date, '%Y.%m.%d') as  ins_date
            FROM
              tbl_event
            WHERE
              del_yn = 'N'
              AND end_date>=current_date
            ";

    $sql .=" ORDER BY ins_date DESC ";


    return $this->query_result($sql,
                                array(
                              )
                              );
  }


} // 클래스의 끝
?>
