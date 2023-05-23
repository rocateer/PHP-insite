<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class My_community_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->my_community_list();
  }

//게시판 게시글 리스트
public function my_community_list(){
  $this->_view(mapping('my_community').'/view_my_community_list');
}

//게시판 댓글 리스트
public function my_community_cnt_list(){
  $this->_view(mapping('my_community').'/view_my_community_cnt_list');
}

//중고거래 리스트
public function my_trade_list(){
  $this->_view(mapping('my_community').'/view_my_trade_list');
}

//중고거래 댓글 리스트
public function my_trade_cnt_list(){
  $this->_view(mapping('my_community').'/view_my_trade_cnt_list');
}

//사전투표 리스트
public function my_vote_list(){
  $this->_view(mapping('my_community').'/view_my_vote_list');
}


}// 클래스의 끝
