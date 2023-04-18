<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 일반 로그인
|------------------------------------------------------------------------

input_check 가이드
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

class Login_v_1_0_0 extends MY_Controller {

  /* 생성자 영역 */
  function __construct(){
    parent::__construct();

    $this->load->model('login_v_1_0_0/model_login');
  }

	// 회원 로그인
	public function member_login(){
		header('Content-Type: application/json');
    $member_id = $this->_input_check("member_id",array("empty_msg"=>"이메일을 입력해주세요.","regular_msg" => "이메일 형식이 올바르지 않습니다","type" => "email"));
    $member_pw = $this->_input_check("member_pw",array("empty_msg"=>"비밀번호를 입력해주세요."));
    $gcm_key = $this->_input_check("gcm_key",array("empty_msg"=>"CM_KEY가 누락되었습니다."));
    $device_os = $this->_input_check("device_os",array("empty_msg"=>"device_OS가 누락되었습니다."));

    $data['member_id']  = $member_id;
		$data['member_pw'] = $member_pw;
		$data['gcm_key']    = $gcm_key;
		$data['device_os']  = $device_os;

		$member_login_check = $this->model_login->member_login_check($data);//회원 로그인

		$response = new stdClass;

    # 로그인 체크
    if(count($member_login_check) == 0){
      $response->code = "-1";
      $response->code_msg = "로그인 정보가 일치하지 않습니다.";

      echo json_encode($response);
      exit;
    }

    # 탈뢰한 회원 체크
    if($member_login_check->del_yn == "Y"){
      $response->code = "-1";
      $response->code_msg = "이미 탈퇴된 회원입니다.";

      echo json_encode($response);
      exit;
    }

		$data['member_idx'] = $member_login_check->member_idx;

		$result = $this->model_login->member_gcm_device_up($data);//gcm_key, device_os 업데이트

    if($result < 0){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "정상";
			$response->member_idx = $member_login_check->member_idx;
      $response->member_id = $member_login_check->member_id;
      $response->member_name = $member_login_check->member_name;
		}

    echo json_encode($response);
    exit;
	}
}	// 클래스의 끝
?>
