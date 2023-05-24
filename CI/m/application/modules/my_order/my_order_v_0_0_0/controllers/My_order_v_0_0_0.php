<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class My_order_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {
    $this->my_order();
  }

//메인
public function my_order(){
  $this->_view(mapping('my_order').'/view_my_order_view');
}

//신청내역_공동구매
public function order_product_list(){
  $this->_view(mapping('my_order').'/view_order_product_list');
}

//신청내역_공동구매_상세
public function order_product_detail(){
  $this->_view(mapping('my_order').'/view_order_product_detail');
}

//신청내역_교육
public function order_edu_list(){
  $this->_view(mapping('my_order').'/view_order_edu_list');
}

//신청내역_교육_상세
public function order_edu_detail(){
  $this->_view(mapping('my_order').'/view_order_edu_detail');
}

}// 클래스의 끝
