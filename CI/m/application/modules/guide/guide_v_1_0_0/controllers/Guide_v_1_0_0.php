<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
|------------------------------------------------------------------------
*/

class Guide_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();
    
  }

  //인덱스
  public function index() {
    $this->guide_detail();
  }

  //이용약관 동의
  public function guide_detail(){
		$this->_view2(mapping('guide').'/view_guide_detail');
  }


}// 클래스의 끝
?>
