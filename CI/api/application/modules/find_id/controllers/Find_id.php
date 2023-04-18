<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-03-05
| Memo : ID 찾기
|------------------------------------------------------------------------
*/

class Find_id extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('find_id/model_find_id');

  }

  //이메일(아이디) 찾기
	public function member_id_find(){
		header('Content-Type: application/json');
		$member_name	= ($this->input->post("member_name", TRUE) != "")	?	$this->_escstr($this->input->post("member_name", TRUE)) : "";
		$member_phone	= ($this->input->post("member_phone", TRUE) != "")	?	$this->_escstr($this->input->post("member_phone", TRUE)) : "";

		$data['member_name']=$this->global_function->trim_str($member_name);
		$data['member_phone']=$this->global_function->trim_str($member_phone);

		if($member_name==""){

			$response = new stdClass;
			$response->code = "-1"; //닉네임을 입력해주세요.
			$response->code_msg = "이름을 입력해주세요.";

			echo json_encode($response);
			exit;
		}

		if($member_phone==""){

			$response = new stdClass;
			$response->code = "-1"; //휴대폰 번호를 입력해주세요.
			$response->code_msg = "휴대폰 번호를 입력해주세요.";

			echo json_encode($response);
			exit;
		}

		$result=$this->model_find_id->member_id_find($data); // 이메일(아이디) 찾기

		if(count($result) =='0'){
			$response = new stdClass;
			$response->code = "-2"; //일치하는 회원이 없습니다
			$response->code_msg = "일치하는 회원이 없습니다.";

			echo json_encode($response);
			exit;
		}else {

			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = "정상";
			$response->member_id = $result->member_id;

			echo json_encode($response);
			exit;
		}

	}

}
