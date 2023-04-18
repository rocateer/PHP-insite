<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	홍창규
| Create-Date : 2017-10-12
| Memo : KCP 본인인증 Controller
|------------------------------------------------------------------------
*/


class Kcp_cert extends MY_Controller {
	function __construct(){
		parent::__construct();

	}

	public function index() {
		$this->smartcert_start();
	}

  // kcp 시작
	public function smartcert_start() {
		$this->_view('kcp_cert/smartcert_start',array());
    // $this->_view("join/view_search_addr", array("agent"=>$agent));
	}

	// kcp 요청
	public function smartcert_proc_req() {
		$this->_view('kcp_cert/smartcert_proc_req',array());
	}

	// kcp 결과
	public function smartcert_proc_res() {
		$mobile_agent = $this->user_agent();

		$this->_view('kcp_cert/smartcert_proc_res',array("mobile_agent"=>$mobile_agent));
	}

} // end class Kcp_cert

?>
