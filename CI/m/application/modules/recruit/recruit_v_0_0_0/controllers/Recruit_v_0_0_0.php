<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Recruit_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {
    $this->human_list();
  }

  //구인 리스트
  public function human_list(){
    $this->_view2(mapping('recruit').'/view_human_list');
  }

  //구인 상세
  public function human_detail(){
		$this->_view(mapping('recruit').'/view_human_detail');
  }

   //구인 지원하기
   public function human_apply(){
		$this->_view(mapping('recruit').'/view_human_apply');
  }

  // 
  public function job_detail(){
		$this->_view(mapping('recruit').'/view_job_detail');
  }

  // 구인구직 등록
  public function job_reg(){
		$this->_view(mapping('recruit').'/view_job_reg');
  }

  //메인 화면
  public function job_list(){
    $this->_view2(mapping('recruit').'/view_job_list');
  }

}// 클래스의 끝
