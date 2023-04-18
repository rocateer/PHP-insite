<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2019-02-07
| Memo : 비밀번호 찾기
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

class Find_pw_to_email_v_1_0_0 extends MY_Controller {

	/* 생성자 영역 */
  function __construct(){
    parent::__construct();

    $this->load->model('find_pw_to_email_v_1_0_0/model_find_pw_to_email');

  }

	/* Index */
	public function index(){
		$this->member_pw_reset_send_email();
	}

	// 일반회원 비밀번호 재설정 메일전송
	public function member_pw_reset_send_email(){
		header('Content-Type: application/json');
    //$member_phone = $this->_input_check("member_phone",array("empty_msg"=>"이름을 입력해주세요."));
    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요."));


    //$member_phone = str_replace($special, "", $member_phone);

		//$data['member_phone'] = $member_phone;
		$data['member_id'] = $member_id;

		# model. 회원 이메일 체크
		$member_email_check = $this->model_find_pw_to_email->member_id_check($data);

		$response = new stdClass;

		if($member_email_check < 1) {
		 	$response->code = "-2";
		 	$response->code_msg = "일치하는 회원정보가 없습니다.";

		 	echo json_encode($response);
		 	exit;
		 }

		# change_pw_key 생성
		$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rendom_str = "";
		$loopNum = 32;

		while($loopNum--){
			$tmp = mt_rand(0, strlen($characters));
			$rendom_str .= substr($characters,$tmp,1);
		}

		$data['change_pw_key'] = $rendom_str;

		# model. 비밀번호 변경 인증키 발급
		$result = $this->model_find_pw_to_email->pwd_change_key_up($data);
    //$member_id ="rladhrgns@rocateer.com";
		# 이메일 보내기
		$to = array();
		array_push($to, $member_id);

		$subject = "[".SERVICE_NAME."] 비밀번호 변경 메일입니다."; # 메일 제목
		$message = $this->load->view('find_pw_to_email_v_1_0_0/view_pwd_reset_email', array("data"=>$data), true);

    $result = $this->_web_sendmail($to, $subject, $message);

		if($result == '0'){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했습니다. 다시 한번 시도해주세요.";

		}else if($result == '1'){
			$response->code = "1000";
			$response->code_msg = "회원님의 E-mail 주소로 비밀번호 변경 메일이 발송되었습니다.";
		}

		echo json_encode($response);
		exit;
	}


  public function emails_send_test2(){
		header('Content-Type: application/json');
		//$member_phone = $this->_input_check("member_phone",array("empty_msg"=>"이름을 입력해주세요."));
		$member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요."));

		$data['change_pw_key'] = "12313123";

    $response = new stdClass;

		# 이메일 보내기
		$to = array();
		array_push($to, $member_id);

		$subject = "[".SERVICE_NAME."] 메일 발송 모듈 테스트입니다."; # 메일 제목
    $message = $this->load->view('find_pw_to_email_v_1_0_0/view_pwd_reset_email', array("data"=>$data), true);

		$result = $this->_web_sendmail($to, $subject, $message);

		if($result == '0'){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했습니다. 다시 한번 시도해주세요.";

		}else if($result == '1'){

			$response->code = "1000";
			$response->code_msg = "회원님의 E-mail 주소로 비밀번호 변경 메일이 발송되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

  public function emails_send_test3(){
		header('Content-Type: application/json');
		//$member_phone = $this->_input_check("member_phone",array("empty_msg"=>"이름을 입력해주세요."));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"키를 입력해주세요."));

    $response = new stdClass;

    //알림발송(101)
    $index="101";
    $smtp_data['change_pw_key'] = "12313123";
    $smtp_data['corp_idx'] = 0;

    $this->_smtp_action($member_idx,$index,$smtp_data);

    $result = '1';

		if($result == '0'){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했습니다. 다시 한번 시도해주세요.";

		}else if($result == '1'){

			$response->code = "1000";
			$response->code_msg = "회원님의 E-mail 주소로 비밀번호 변경 메일이 발송되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

}
