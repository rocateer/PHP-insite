<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {

	function __construct() {

		parent::__construct();
		$this->load->database();
		date_default_timezone_set('Asia/Seoul');
		//$this->load->driver('cache',array('adapter'=>'file'));


	}

	///결과 값이 하나 일 때
	function query_row($sql,$array,$data='') {
		$result = $this->db->query($sql,$array)->row();
		$query_log = $this->db->last_query();

		ob_start();
		var_dump($data);
		$data_log = ob_get_clean();
		$error_msg = "<pre>".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']." \r\n  <br> ^ address=>".$_SERVER['REMOTE_ADDR']." \r\n <br> ^ agent=>".$_SERVER['HTTP_USER_AGENT']."^ \r\n".print_r($data_log, TRUE) ."\r\n <br> ^".$query_log."</pre>";

    log_message('error',"query :  '$error_msg \r\n <br /> ' ");
		return	$result ;
	}

	//등록 , 수정, 삭제 시
	function query($sql,$array,$data='') {
		$result = $this->db->query($sql,$array);
		$query_log = $this->db->last_query();

		ob_start();
		var_dump($data);
		$data_log = ob_get_clean();
		$error_msg = "<pre>".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']." \r\n  <br> ^ address=>".$_SERVER['REMOTE_ADDR']." \r\n <br> ^ agent=>".$_SERVER['HTTP_USER_AGENT']."^ \r\n".print_r($data_log, TRUE) ."\r\n <br> ^".$query_log."</pre>";

    log_message('error',"query :  '$error_msg \r\n <br /> ' ");
		return	$result ;
	}

	//카운트로 조회 할 때
	function query_cnt($sql,$array,$data='') {
		$result  = $this->db->query($sql,$array)->row()->cnt;
		$query_log = $this->db->last_query();

		ob_start();
		var_dump($data);
		$data_log = ob_get_clean();
		$error_msg = "<pre>".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']." \r\n  <br> ^ address=>".$_SERVER['REMOTE_ADDR']." \r\n <br> ^ agent=>".$_SERVER['HTTP_USER_AGENT']."^ \r\n".print_r($data_log, TRUE) ."\r\n <br> ^".$query_log."</pre>";

    log_message('error',"query :  '$error_msg \r\n <br /> ' ");
		return	$result ;
	}

	//리스트로 조회 할 때
	function query_result($sql,$array,$data='') {
		$result  = $this->db->query($sql,$array)->result();
    $query_log = $this->db->last_query();

		ob_start();
		var_dump($data);
		$data_log = ob_get_clean();
		$error_msg = "<pre>".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']." \r\n  <br> ^ address=>".$_SERVER['REMOTE_ADDR']." \r\n <br> ^ agent=>".$_SERVER['HTTP_USER_AGENT']."^ \r\n".print_r($data_log, TRUE) ."\r\n <br> ^".$query_log."</pre>";

    log_message('error',"query :  '$error_msg \r\n <br /> ' ");
		return	$result ;
	}
}
?>
