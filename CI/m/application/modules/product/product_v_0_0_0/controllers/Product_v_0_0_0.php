<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Product_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {
    $this->product_list();
  }

//공동구매 리스트
public function product_list(){
  $this->_view2(mapping('product').'/view_product_list');
}

//공동구매 사전투표 리스트
public function product_vote_list(){
  $this->_view(mapping('product').'/view_product_vote_list');
}

//공동구매 사전투표 상세
public function product_vote_detail(){
  $this->_view(mapping('product').'/view_product_vote_detail');
}

//공동구매 상세
public function product_detail(){
  $this->_view(mapping('product').'/view_product_detail');
}

//공동구매 신청
public function product_app(){
  $this->_view(mapping('product').'/view_product_app');
}

}// 클래스의 끝
