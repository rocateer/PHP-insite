<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_terms extends MY_Model {

  //약관 상세 보기
  public function terms_detail($data){
    $type = $data['type'];

    $sql = "SELECT
              title,
              contents
    				FROM
    					tbl_terms_management
    				WHERE
    					type = ?
              ";

      return $this->query_row($sql,array($type));
  }

}
?>
