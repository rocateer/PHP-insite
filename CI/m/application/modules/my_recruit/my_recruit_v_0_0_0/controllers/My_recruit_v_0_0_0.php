<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class My_recruit_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {
    $this->my_recruit_human_list();
  }

//구인 관리
public function my_recruit_human_list(){
  $this->_view(mapping('my_recruit').'/view_my_recruit_human_list');
}

//구직 관리
public function my_recruit_job_list(){
  $this->_view(mapping('my_recruit').'/view_my_recruit_job_list');
}

//지원자 리스트
public function my_recruit_applicant_list(){
  $this->_view(mapping('my_recruit').'/view_my_recruit_applicant_list');
}

}// 클래스의 끝
