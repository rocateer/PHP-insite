<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-06-2
| Memo : 로그아웃
|------------------------------------------------------------------------
*/

class Logout extends MY_Controller {
  function __construct(){
    parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('global_function');
    
    $this->load->model(mapping('logout').'/model_logout');

  }

	public function index(){
    $this->logout();
	}

	public function logout() {
		// type 0:main 1:login
		$type= $this->_input_check("type",array());

		$data['member_idx'] = $this->member_idx;

		$result = $this->model_logout->member_gcm_del($data);//gcm_key 삭제

		$this->sess_destroy($type);

  }

	public function sess_destroy() {
		$type= $this->_input_check("type",array());

		$member_data = array(
			"member_idx" => "",
			"member_id" =>  "",
			"member_gender" =>  "",
			"app_yn" =>  $this->app_yn
		);

		$this->session->set_userdata($member_data);

		set_cookie('member_idx', "", 3600*24*365);
		set_cookie('member_id', "", 3600*24*365);
		set_cookie('member_gender', "", 3600*24*365);
		set_cookie('block_check_array', "", 3600*24*365);
		set_cookie('app_yn', $this->app_yn, 3600*24*365);

		if($type==0){
			redirect(mapping('main'));
		}else{
			redirect(mapping('login'));
		}

  }

}// 클래스의 끝
?>
