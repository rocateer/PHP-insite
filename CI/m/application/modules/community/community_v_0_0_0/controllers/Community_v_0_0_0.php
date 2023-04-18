<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
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

// 
  public function community_detail1(){
		$this->_view2(mapping('community').'/view_community_detail1');
  }
// 
  public function community_detail2(){
		$this->_view2(mapping('community').'/view_community_detail2');
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
