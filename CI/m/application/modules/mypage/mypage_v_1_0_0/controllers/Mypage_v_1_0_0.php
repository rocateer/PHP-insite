<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-06-28
| Memo : 마이 페이지
|------------------------------------------------------------------------
*/

class Mypage_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();
		
		if(!$this->session->userdata("member_idx") ){
			redirect("/".mapping('login')."?return_url=/".mapping('mypage'));
			exit;
		}

		$this->load->model(mapping('mypage').'/model_mypage');
	}

	//인덱스
	  public function index() {

	    $this->mypage_list();
	  }

	//마이페이지
  public function mypage_list(){

		$result = $this->model_mypage->member_info(); // 회원 정보

		$response = new stdClass();

		$response->agent = $this->_user_agent();
		$response->result = $result['member_info'];
		$response->alarm_new_cnt = $result['alarm_new_cnt'];

		$this->_view(mapping('mypage').'/view_mypage_list', $response);
  }

	// 사업자 번호 중복확인
	public function member_img_mod_up() {
		$member_idx = $this->_input_check("member_idx",array());
		$member_img = $this->_input_check("member_img",array());

		$data['member_idx'] = $member_idx;
		$data['member_img'] = $member_img;

		$result = $this->model_mypage->member_img_mod_up($data);

		$response = new stdClass();

		if($result == '0'){
			$response->code = "0";
			$response->code_msg = "실패하였습니다.";
		}else{
			$response->code = "1";
			$response->code_msg = "확인 되었습니다.";
		}
		
		echo json_encode($response);
		exit;
	}


}// 클래스의 끝
?>
