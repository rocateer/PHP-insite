<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Mypage_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}


	//인덱스
  public function index() {
    $this->mypage_list();
  }
	
  public function mypage_list(){

		$this->_view(mapping('mypage').'/view_mypage_list');
  }

}// 클래스의 끝
?>
