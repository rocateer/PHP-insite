<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Search_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {
    $this->search_view();
  }

  //검색 화면
  public function search_view(){
    $this->_view(mapping('search').'/view_search_view');
  }

  public function search_list_community(){
    $this->_view(mapping('search').'/view_search_list_community');
  }

  public function search_list_trade(){
    $this->_view(mapping('search').'/view_search_list_trade');
  }

  public function search_list_product(){
    $this->_view(mapping('search').'/view_search_list_product');
  }

  public function search_list_edu(){
    $this->_view(mapping('search').'/view_search_list_edu');
  }

}// 클래스의 끝
