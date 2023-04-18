<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2021-01-15
|------------------------------------------------------------------------
*/

class Alarm_v_0_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

//인덱스
	public function index(){

		$this->alarm_list();

	}


//알람 리스트
	public function alarm_list(){
    $this->_view2(mapping('alarm').'/view_alarm_list');
	}



} // 클래스의 끝
?>
