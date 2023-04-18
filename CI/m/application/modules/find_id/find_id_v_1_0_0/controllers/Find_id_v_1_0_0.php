<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-06-27
|------------------------------------------------------------------------
*/

class Find_id_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('find_id').'/model_find_id');
	}

	//인덱스
  public function index() {
    $this->find_id_detail();
  }

	//메인 화면
  public function find_id_detail(){
		$this->_view2(mapping('find_id').'/view_find_id_detail');
  }
	
	public function find_id_member(){
		$response = new StdClass();

		$member_name = $this->_input_check("member_name",array("empty_msg"=>"이름을 입력해주세요","focus_id"=>"member_name"));
		$member_phone = $this->_input_check("member_phone",array("empty_msg"=>"전화번호를 입력해주세요","focus_id"=>"member_phone"));

		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;

		$result = $this->model_find_id->find_id_member($data); // 아이디 찾기

		if(empty($result)){
			$response->code = "0";
			$response->code_msg = "일치하는 회원정보가 없습니다.";

		}else{
			$response->code = "1000";
			$response->code_msg = "정상";
			$response->member_id = $result->member_id;
		}

		echo json_encode($response);
		exit;
  }
	
	
}// 클래스의 끝
?>
