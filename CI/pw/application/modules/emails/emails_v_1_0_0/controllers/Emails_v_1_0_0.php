<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-12-16
| Memo : 메일폼
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

class Emails_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();
	}

//인덱스
  public function index() {
    $this->emails_test();
  }

//리스트
  public function emails_test(){
    $this->_list_view('emails_v_1_0_0/view_emails_send_test');

  }
	//비밀번호 변경
  public function password(){
		$this->_list_view('emails_v_1_0_0/view_password');
  }
  //비밀번호 안내
  public function find_pw_to_email(){
		$this->_list_view('emails_v_1_0_0/view_find_pw_to_email');
  }
	public function emails_send_test(){
		header('Content-Type: application/json');
		$email_view = $this->_input_check("email_view",array("empty_msg"=>"이메일 작성폼 함수 페이지명을 입력해주세요."));
		$email_address = $this->_input_check("email_address",array("empty_msg"=>"보내실 이메일 주소를 입력해주세요."));
		$email_address2 = $this->_input_check("email_address2",array());
		if($email_address!=""){
			$member_id =$email_address;
			# 이메일 보내기
			$to = array();
			array_push($to, $member_id);

			$subject = "[".SERVICE_NAME."] 비밀번호 변경 메일입니다.";

			$message = $this->load->view('emails_v_1_0_0/view_'.$email_view, array(), true);

			$result = $this->_web_sendmail($to, $subject, $message);

		}
		if($email_address2!=""){
			$member_id =$email_address2;
			# 이메일 보내기
			$to = array();
			array_push($to, $member_id);

			$subject = "[".SERVICE_NAME."] 비밀번호 변경 메일입니다.";

			$message = $this->load->view('emails_v_1_0_0/view_'.$email_view, array(), true);

			$result = $this->_web_sendmail($to, $subject, $message);
		}

		$response = new stdClass();
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




}// 클래스의 끝
?>
