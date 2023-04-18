<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈	
| Create-Date : 2016-01-11
| Last-modify : 
| Description : 로그아웃
|------------------------------------------------------------------------
*/

class Logout extends MY_Controller {

	public function index() {
		$this->load->helper('url');	
		$this->load->library('session');
		
	
		$this->session->sess_destroy();
		redirect('/');
		//header("Location: /");
	}



}
?>