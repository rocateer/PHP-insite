<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	송민지
| Create-Date : 2020-12-25
|------------------------------------------------------------------------
*/

class Join_v_0_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

//인덱스
	public function index(){

		$this->join_reg();

	}

// join
	public function join_reg(){

		$this->_view2(mapping('join').'/view_join_reg');
	}

// join
	public function join_social_reg(){

		$this->_view2(mapping('join').'/view_join_social_reg');
	}
// join
	public function join_complete_detail(){

		$this->_view2(mapping('join').'/view_join_complete_detail');
	}

} // 클래스의 끝
?>
