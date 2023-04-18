<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Login_v_0_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

	public function index(){
    $this->login_form();
	}

// 로그인 폼 이동
  public function login_form() {
    $this->_view2(mapping('login').'/view_login_list');
  }


}// 클래스의 끝
?>
