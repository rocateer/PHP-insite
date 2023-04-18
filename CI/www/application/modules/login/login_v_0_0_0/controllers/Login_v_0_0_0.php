<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Login_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->login_detail();
  }

//메인 화면
  public function login_detail(){
		$this->_view(mapping('login').'/view_login_detail');
  }
}// 클래스의 끝
?>
