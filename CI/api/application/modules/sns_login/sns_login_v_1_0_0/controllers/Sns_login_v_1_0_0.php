<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : SNS 로그인
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

class Sns_login_v_1_0_0 extends MY_Controller {

  /* 생성자 영역 */
  function __construct(){
    parent::__construct();

    $this->load->model('sns_login_v_1_0_0/model_sns_login');
  }

  // SNS 회원 로그인
  public function sns_member_login(){
    header('Content-Type: application/json');
    $member_id = $this->_input_check("member_id",array("empty_msg"=>"이메일(아이디)을 입력해주세요."));
    $member_join_type = $this->_input_check("member_join_type",array("empty_msg"=>"로그인 타입을 입력해주세요."));
    $gcm_key = $this->_input_check("gcm_key",array("empty_msg"=>"CM_KEY가 누락되었습니다."));
    $device_os = $this->_input_check("device_os",array("empty_msg"=>"device_OS가 누락되었습니다."));

    $data['member_id']  = $member_id;
    $data['member_join_type'] = $member_join_type;
		$data['gcm_key'] = $gcm_key;
		$data['device_os'] = $device_os;

    $sns_login_check = $this->model_sns_login->sns_login_check($data);//sns 로그인 체크

    $response = new stdClass;

    if(count($sns_login_check) == 0){

      $response->code = "-1";
      $response->code_msg = "회원가입이 되어 있지 않습니다.";

      echo json_encode($response);
      exit;
    }else{
      $data['member_idx'] = $sns_login_check->member_idx;

      $result = $this->model_sns_login->member_gcm_device_up($data);//gcm_key, device_os 업데이트

      $response->code = "1000";
      $response->code_msg = "성공";
      $response->member_idx = (string)$sns_login_check->member_idx;

      echo json_encode($response);
      exit;
   }
  }

}	// 클래스의 끝
?>
