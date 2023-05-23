<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2023-05-03
|------------------------------------------------------------------------
*/

class Mypage_v_0_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

	}


	//인덱스
  public function index() {
    $this->mypage_list();
  }
	
  public function mypage_list(){
		$this->_view(mapping('mypage').'/view_mypage_list');
  }

  // 구직 프로필 등록
  public function profile_reg(){
		$this->_view(mapping('mypage').'/view_profile_reg');
  }

}// 클래스의 끝
?>
