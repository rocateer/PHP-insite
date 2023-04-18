<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2020-09-25
|------------------------------------------------------------------------
*/

class Find_pw_v_0_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

//인덱스
	public function index(){

		$this->find_pw_detail();

	}

// find
	public function find_pw_detail(){

		$this->_view2(mapping('find_pw').'/view_find_pw_detail');
	}

} // 클래스의 끝
?>
