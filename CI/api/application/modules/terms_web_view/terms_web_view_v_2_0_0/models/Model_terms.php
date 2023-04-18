<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_terms extends MY_Model {

  //약관 리스트
  public function terms_list(){

    $sql = "SELECT
              title,
              contents
    				FROM
    					tbl_terms_management
    				ORDER BY type ASC
              ";

      return $this->query_result($sql,array());
  }

}
?>
