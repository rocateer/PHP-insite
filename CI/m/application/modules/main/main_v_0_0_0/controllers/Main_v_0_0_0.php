<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Main_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->main_detail();
  }

//메인 화면
  public function main_detail(){
		$this->_view(mapping('main').'/view_main_detail');
  }

// 
  public function my_schedule_list(){
		$this->_view2(mapping('main').'/view_my_schedule_list');
  }
// 
  public function category_list(){
		$this->_view2(mapping('main').'/view_category_list');
  }
// 
  public function select_product(){
		$this->_view2(mapping('main').'/view_select_product');
  }
// 
  public function product_detail(){
		$this->_view2(mapping('main').'/view_product_detail');
  }
// 
  public function contents_detail(){
		$this->_view2(mapping('main').'/view_contents_detail');
  }
// 
  public function routine_reg(){
		$this->_view2(mapping('main').'/view_routine_reg');
  }
}// 클래스의 끝
