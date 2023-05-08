<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Community_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->community_list();
  }

  //메인 화면
  public function community_list(){
    $this->_view(mapping('community').'/view_community_list');
  }

  //검색 화면
  public function search_list(){
    $this->_view(mapping('community').'/view_search_list');
  }

  public function search_list_get(){
    $this->_view(mapping('community').'/view_search_list_get');
  }

  public function search_list_trade(){
    $this->_view(mapping('community').'/view_search_list_trade');
  }

  public function search_list_product(){
    $this->_view(mapping('community').'/view_search_list_product');
  }

  public function search_list_study(){
    $this->_view(mapping('community').'/view_search_list_study');
  }

  // 인기
  public function community_hot(){
		$this->_view(mapping('community').'/view_community_hot_list');
  }
  // 
  public function community_detail(){
		$this->_view(mapping('community').'/view_community_detail');
  }

  // 
  public function community_reg1(){
		$this->_view2(mapping('community').'/view_community_reg1');
  }
  // 
  public function community_reg2(){
		$this->_view2(mapping('community').'/view_community_reg2');
  }
}// 클래스의 끝
