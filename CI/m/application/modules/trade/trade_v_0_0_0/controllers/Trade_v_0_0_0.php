<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Trade_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->trade_list();
  }

  //메인 화면
  public function trade_list(){
    $this->_view2(mapping('trade').'/view_trade_list');
  }

  // 인기
  public function trade_hot(){
		$this->_view(mapping('trade').'/view_trade_hot_list');
  }
  // 
  public function trade_detail(){
		$this->_view(mapping('trade').'/view_trade_detail');
  }

  // 중고거래 등록
  public function trade_reg(){
		$this->_view(mapping('trade').'/view_trade_reg');
  }
}// 클래스의 끝
