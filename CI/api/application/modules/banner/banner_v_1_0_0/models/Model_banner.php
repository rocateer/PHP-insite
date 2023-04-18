<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 배너
|------------------------------------------------------------------------
*/

Class Model_banner extends MY_Model {

  // 배너 리스트
  public function banner_list(){

		$sql = "SELECT
              banner_idx,
              title,
              img_path,
              link_url
            FROM tbl_banner
            WHERE del_yn='N'
             AND state=1
				  ";
		return $this->query_result($sql,
															array(

															)
														  );

  }


}
?>
