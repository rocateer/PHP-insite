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

  // 인기
  public function community_hot(){
		$this->_view(mapping('community').'/view_community_hot_list');
  }
  // 
  public function community_detail(){
		$this->_view(mapping('community').'/view_community_detail');
  }

  // 커뮤니티 글쓰기
  public function community_reg(){
		$this->_view(mapping('community').'/view_community_reg');
  }

  // 커뮤니티 글쓰기 수정
  public function community_mod(){
		$this->_view(mapping('community').'/view_community_mod');
  }

}// 클래스의 끝
