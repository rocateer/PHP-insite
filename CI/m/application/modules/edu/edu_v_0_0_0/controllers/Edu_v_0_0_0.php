<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Edu_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {
    $this->edu_list();
  }

//교육 리스트
public function edu_list(){
  $this->_view2(mapping('edu').'/view_edu_list');
}

//교육 사전투표 리스트
public function edu_vote_list(){
  $this->_view(mapping('edu').'/view_edu_vote_list');
}

//교육 사전투표 상세
public function edu_vote_detail(){
  $this->_view(mapping('edu').'/view_edu_vote_detail');
}

//교육 상세
public function edu_detail(){
  $this->_view(mapping('edu').'/view_edu_detail');
}

//교육 신청
public function edu_app(){
  $this->_view(mapping('edu').'/view_edu_app');
}

//교육 완료
public function edu_app_complete(){
  $this->_view(mapping('edu').'/view_edu_app_complete');
}


}// 클래스의 끝
