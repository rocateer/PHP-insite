<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2022
|------------------------------------------------------------------------
*/

class Board_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}

//인덱스
  public function index() {

    $this->board_list();
  }

//메인 화면
  public function board_list(){
		$this->_view(mapping('board').'/view_board_list');
  }

// 
  public function board_detail(){
		$this->_view2(mapping('board').'/view_board_detail');
  }
}// 클래스의 끝
