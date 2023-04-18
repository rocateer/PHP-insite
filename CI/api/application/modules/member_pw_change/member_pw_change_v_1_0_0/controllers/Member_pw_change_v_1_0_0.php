<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 패스워드 변경
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

class Member_pw_change_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('member_pw_change_v_1_0_0/model_member_pw_change');
  }

  public function member_pw_mod_up(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드가 누락되었어요!."));
    $member_pw = $this->_input_check("member_pw",array("empty_msg"=>"현재 비밀번호를 입력해주세요!."));
    $new_member_pw = $this->_input_check("new_member_pw",array("empty_msg"=>"비밀번호를 입력해주세요.","regular_msg" => "비밀번호는 영어,숫자 조합으로 6자~16자내로 입력해주세요.","type" => "custom","custom" => "/^[a-zA-Z](?=.{0,16}[0-9])[0-9a-zA-Z]{6,16}$/"));
    $new_member_pw_check = $this->_input_check("new_member_pw_check",array("empty_msg"=>"비밀번호 확인을 입력해주세요!."));

		$data['member_idx'] = $member_idx;
		$data['member_pw'] = $member_pw;
		$data['new_member_pw'] = $new_member_pw;
    $data['new_member_pw_check'] = $new_member_pw_check;

    $pwd_check_result = $this->model_member_pw_change->member_pw_check($data);//현재 비밀번호 확인

    $response = new stdClass;

    if($pwd_check_result == 0){
      $response->code = "-1";
      $response->code_msg = "현재 비밀번호가 일치하지 않아요!";

      echo json_encode($response);
      exit;
    }

		if($new_member_pw != $new_member_pw_check){
			$response->code = "-1";
			$response->code_msg = "변경하실 비밀번호가 서로 일치하지 않아요!";

			echo json_encode($response);
			exit;
		}

		$result = $this->model_member_pw_change->member_pw_mod_up($data);//회원 비밀번호 변경

    if($result < 0){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했어요! 다시 한번 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "비밀번호가 변경되었어요!";
		}

		echo json_encode($response);
		exit;
	}

} // 클래스의 끝
?>
