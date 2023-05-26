<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class My_scrap_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->my_scrap_list();
  }

//메인 화면
  public function my_scrap_list(){
		$this->_view(mapping('my_scrap').'/view_my_scrap_list');
  }

  public function scrap_list_trade(){
		$this->_view(mapping('my_scrap').'/view_my_scrap_list_trade');
  }

  public function scrap_list_recruit(){
		$this->_view(mapping('my_scrap').'/view_my_scrap_list_recruit');
  }

  public function scrap_list_profile(){
		$this->_view(mapping('my_scrap').'/view_my_scrap_list_profile');
  }

  public function scrap_list_product(){
		$this->_view(mapping('my_scrap').'/view_my_scrap_list_product');
  }

  public function scrap_list_edu(){
		$this->_view(mapping('my_scrap').'/view_my_scrap_list_edu');
  }

}// 클래스의 끝
