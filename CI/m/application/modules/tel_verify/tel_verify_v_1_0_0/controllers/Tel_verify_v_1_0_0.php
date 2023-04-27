<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : 휴대폰 번호 인증
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

class Tel_verify_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('tel_verify_v_1_0_0/model_tel_verify');
  }

  /*
  
  https://sms.net.bd/signup/

  --개발자 계정
  ID: dreamct925@gmail.com
  Pass: Sususoft0514!

  --테스트 전화번호
  test mobile no : +8801311104634

  --API 키
  API Key :W09zZI1dXXDFWIs7I9ZbNNR4bKAmTu8FsKbH0Ey5
  
  */
  function bd_sms_send() {
    header('Content-Type: application/json');
    $msg = $this->_input_check("msg",array());
    $member_phone = $this->_input_check("member_phone",array());

    $response = new stdClass;

    $url = "https://api.sms.net.bd/sendsms?api_key=".SMS_KEY."&msg=".$msg."&to=".$member_phone;

    $method = "POST";
    $data = '{"api_key":"'.SMS_KEY.'","msg":"'.$msg.'","to":"'.$member_phone.'"}';
    $response->data_info = $data;
    
    try {
      $oCurl = curl_init();
      $url =  "https://api.sms.net.bd/sendsms";
      $aPostData['api_key'] =SMS_KEY;
      $aPostData['msg'] = $msg;
      $aPostData['to'] = $member_phone;

      curl_setopt($oCurl, CURLOPT_URL, $url);
      curl_setopt($oCurl, CURLOPT_POST, 1);
      curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aPostData);
      curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, 0);
      $result = curl_exec($oCurl);
      curl_close($oCurl);

      $response->result_code = "1";
      $response->result = $result;
      
    } catch (Exception $err) {

      $response->result_code = "0";
      $response->err = $err;
    }
    
    return $response;
    // echo json_encode($response);
    // exit;
  }

  // 휴대전화 인증키 발급
  public function tel_verify_setting(){
    header('Content-Type: application/json');

    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"전화번호를 입력해주세요.","focus_id"=>"member_phone"));
    $verify_num = $this->global_function->create_verify_num('verify',6);//휴대폰 인증 번호 생성

    $data['member_phone'] = preg_replace("/[^0-9]/", "", $member_phone);
    $data['verify_num'] = $verify_num;

    $tel_convert = preg_replace("/[^0-9]/", "", $member_phone);  // 번호 hyphen 제거
    $tel_check = preg_match("/^01[0-9]{8,9}$/", $tel_convert);  // 휴대폰번호 유효성검사
    $tel_overlap_check = $this->model_tel_verify->tel_verify_initial($data); // 휴대폰번호 초기화

    $result = $this->model_tel_verify->tel_verify_setting($data); // 휴대폰번호 인증을 위한 insert

    if($result == 0) {
			$response = new stdClass;
			$response->code = "-1"; // 인증번호 발급 실패
			$response->code_msg = "인증번호 발급 실패";
			echo json_encode($response);
			exit;
		}else if($result == 1) {
			// 입력한 휴대폰번호로 인증번호 SMS 전송
      $msg ="[".SERVICE_NAME."]휴대전화 인증번호는 ".$verify_num."입니다. 정확히 입력해 주세요.";
      $send_result = $this->bd_sms_send($msg, $member_phone);

      // insert된 인증정보 가져오기
      $get_verify_info = $this->model_tel_verify->verify_info_get($data);
			$response = new stdClass;
			$response->code = "1000"; // 가입성공
			$response->code_msg = "인증번호가 발송되었습니다.";
			$response->verify_idx = $get_verify_info->verify_idx;
			// $response->verify_num = $get_verify_info->verify_num;
			// $response->msg = $msg;
			echo json_encode($response);
			exit;
		}
  }

  // 휴대전화 인증키 재발급
  public function tel_verify_resetting(){
    $verify_idx = $this->_input_check("verify_idx",array());
    $member_phone = $this->_input_check("member_phone",array());
    $verify_num = $this->global_function->create_verify_num('verify',6);//휴대폰 인증 번호 생성

    $data['verify_idx'] = $verify_idx;
    $data['member_phone'] = preg_replace("/[^0-9]/", "", $member_phone);
    $data['verify_num'] = $verify_num;

    $tel_convert = preg_replace("/[^0-9]/", "", $member_phone);  // 번호 hyphen 제거
    $tel_check = preg_match("/^01[0-9]{8,9}$/", $tel_convert);  // 휴대폰번호 유효성검사

    if($tel_check == 0) {
      $response = new stdClass;
			$response->code = "-1"; // 휴대폰 번호가 올바르지 않습니다.
			$response->code_msg = "휴대폰 번호가 올바르지 않습니다.";
			echo json_encode($response);
			exit;
    }

    $result = $this->model_tel_verify->tel_verify_resetting($data); // 휴대폰번호 인증을 위한 update

    if($result == 0) {
			$response = new stdClass;
			$response->code = "-1"; // 인증번호 발급 실패
			$response->code_msg = "인증번호 발급 실패";
			echo json_encode($response);

		}else if($result == 1) {
			// 입력한 휴대폰번호로 인증번호 SMS 전송
      // 여기에!!!!!!!!!!!!!!!
      $verify_info_get = $this->model_tel_verify->verify_info_get($data);//insert된 인증정보 가져오기
			$response = new stdClass;
			$response->code = "1000"; // 가입성공
			$response->code_msg = "재발급된 인증번호를 입력해주세요";
			$response->verify_idx = $verify_info_get->verify_idx;
			$response->verify_num = $verify_info_get->verify_num;
			echo json_encode($response);
			exit;
		}
  }

  // 휴대전화 인증키 확인
  public function tel_verify_confirm(){
    $verify_idx = $this->_input_check("verify_idx",array());
    $verify_num = $this->_input_check("verify_num",array());
    $time_over_yn = $this->_input_check("time_over_yn",array());

    $data['verify_idx'] = $verify_idx;
    $data['verify_num'] = $verify_num;

    $verify_num_check = is_numeric($verify_num);  // 인증번호에 대한 유효성 검사
    $response = new stdClass;
    if($verify_idx == "") {
     $response->code = "-1"; // 잘못된 인증번호 입니다.
     $response->code_msg = "인증요청을 해주세요";
     echo json_encode($response);
     exit;
    }

    if($time_over_yn == "Y") {
     $response->code = "-1"; // 잘못된 인증번호 입니다.
     $response->code_msg = "인증 확인 시간을 초과 하였습니다.";
     echo json_encode($response);
     exit;
    }

    if($verify_num_check == 0) {
			$response->code = "-1"; // 잘못된 인증번호 입니다.
			$response->code_msg = "잘못된 인증번호 입니다.";
			echo json_encode($response);
			exit;
    }

    $result = $this->model_tel_verify->tel_verify_confirm($data); // 인증번호 일치여부 확인

    if($result == 0) {

			$response->code = "-1"; // 인증 실패
			$response->code_msg = "인증 실패";
			echo json_encode($response);
			exit;
		}else if($result == 1) {
      $change_verify_yn = $this->model_tel_verify->change_verify_yn($data);
      if($change_verify_yn == 0) {
  			$response->code = "-1"; // 관리자에게 문의해 주세요.  ->> 인증번호는 일치하는데 인증값 변경이 실패하는 경우.
  			$response->code_msg = "관리자에게 문의해 주세요.";
  			echo json_encode($response);
  			exit;
      }else {
        $tel_get = $this->model_tel_verify->tel_get($data); // 인증여부, 전화번호 가져오기
  			$response->code = "1000"; // 인증 성공
  			$response->code_msg = "인증되었습니다.";
  			$response->verify_yn = $tel_get->verify_yn;
  			echo json_encode($response);
  			exit;
      }
		}
  }

} // 클래스의 끝
?>
