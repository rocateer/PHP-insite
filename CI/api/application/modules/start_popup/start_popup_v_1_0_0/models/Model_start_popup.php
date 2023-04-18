<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-12
| Memo : 앱 시작시 팝업
|------------------------------------------------------------------------
*/

Class Model_start_popup extends MY_Model {

  // 앱시작 팝업 보기
  public function start_popup_detail(){

		$sql = "SELECT
              start_popup_idx,
              title,
              contents,
              img_path,
              link_url,
              contents
            FROM
              tbl_start_popup
            WHERE
              del_yn = 'N'
              AND state = '1'
              AND start_date <= DATE_FORMAT(NOW(), '%Y-%m-%d')
              AND end_date >= DATE_FORMAT(NOW(), '%Y-%m-%d')
				  ";

		return $this->query_row($sql,array());

  }


  // 앱시작 팝업 보기
  public function start_popup_list($data){
	  $device_os = $data['device_os'];

    $sql = "SELECT
              start_popup_idx,
              title,
              contents,
              img_path,
              link_url,
              contents
            FROM
              tbl_start_popup
            WHERE
              del_yn = 'N'
              AND state = '1'
    ";
    if($device_os !=""){
      $sql .=" AND device_os = '$device_os' ";
    }
    $sql .=" order by upd_date desc limit 1";

    return $this->query_result($sql,array());

  }

}
?>
