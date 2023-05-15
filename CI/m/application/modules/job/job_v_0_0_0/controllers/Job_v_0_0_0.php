<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Job_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->job_list();
  }

  //메인 화면
  public function job_list(){
    $this->_view2(mapping('job').'/view_job_list');
  }

  // 
  public function job_detail(){
		$this->_view(mapping('job').'/view_job_detail');
  }

  // 구인구직 등록
  public function job_reg(){
		$this->_view(mapping('job').'/view_job_reg');
  }
}// 클래스의 끝
