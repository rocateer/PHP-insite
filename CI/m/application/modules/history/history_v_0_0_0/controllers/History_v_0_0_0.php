<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class History_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->history_list();
  }

//메인 화면
  public function history_list(){
		$this->_view2(mapping('history').'/view_history_list');
  }

// 
  public function calendar_list(){
		$this->_view2(mapping('history').'/view_calendar_list');
  }

// 
  public function history_all_list(){
		$this->_view2(mapping('history').'/view_history_all_list');
  }
}// 클래스의 끝
