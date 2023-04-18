<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-05-06
| Memo : 설정
|------------------------------------------------------------------------

_input_check 가이드
_________________________________________________________________________________
|  !!. 변수설명
| $key       : 파라미터로 받을 변수명
| $empty_msg : 유효성검사 실패 시 전송할 메세지,
|              ("empty_msg" => "유효성검사 메세지") 로 구분하며 list 타입임.
| $focus_id  : 유효성검사 실패 시 foucus 이동 ID,
|              ("focus_id" => "foucus 대상 ID")
| $ternary  : 삼항 연산자 받을 변수명
|              ("ternary" => "1")
| $esc       : 개행문자 제거 요청시 true, 아닐시 false
|              false를 요청하는 경우-> (ex. 장문의 글 작성 시 false)
|           	 값이 array 형태일 경우 false로 적용
| $regular_msg : 정규표현식 검사 실패 시 전송할 메세지,
|              ("regular_msg" => "정규표현식 메세지","type" => "number")
| $type    	: 유효성검사할 타입
|           	 number   : 숫자검사
|            	email    : 이메일 양식 검사
|            	password : 비밀번호 양식 검사
|            	tel1     : 전화번호 양식 검사 (- 미포함)
|            	tel2     : 전화번호 양식 검사 (- 포함)
|            	custom   : 커스텀 양식, $custom의 양식으로 검사함
|            	default  : default, 검사를 안합니다.
| $custom 	: 유효성검사 custom으로 진행 시 받을 값 (정규표현식)
|
|  !!!. 값이 array형태로 들어올 경우
| $this->input_chkecu("파라미터로 받을 변수명[]");
| 형태로 받는다.
|_________________________________________________________________________________
*/

class Setting_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();
		
		// if(!$this->session->userdata("member_idx") ){
		// 	redirect("/".mapping('login')."?return_url=/".mapping('setting'));
		// 	exit;
		// }

		$this->load->model(mapping('setting').'/model_setting');

	}

	//인덱스
  public function index() {

    $this->setting_list();
  }

	//메인 화면
  public function setting_list(){
		
		$result = $this->model_setting->member_detail();
		$terms_list = $this->model_setting->terms_list();

		$response = new stdClass();

		$response->result = $result;
		$response->terms_list = $terms_list;
		$response->agent = $this->_user_agent();
		
		$this->_view2(mapping('setting').'/view_setting_list', $response);
  }
	
	public function all_alarm_yn_mod_up(){
		$response = new stdClass();

	  $all_alarm_yn = $this->_input_check("all_alarm_yn",array());

		$data['all_alarm_yn'] = $all_alarm_yn;

		$result = $this->model_setting->all_alarm_yn_mod_up($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "오류를 발생하였습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "정상적으로 처리되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

}// 클래스의 끝
?>
