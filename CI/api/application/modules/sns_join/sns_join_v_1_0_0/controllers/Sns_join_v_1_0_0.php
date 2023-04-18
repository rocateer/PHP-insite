<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : SNS 회원가입
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

class Sns_join_v_1_0_0 extends MY_Controller {

  /* 생성자 영역 */
  function __construct(){
    parent::__construct();

    $this->load->model('sns_join_v_1_0_0/model_sns_join');
  }

  //SNS회원 가입
  public function sns_member_reg_in(){
		header('Content-Type: application/json');

    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","regular_msg" => "이메일이 올바르지 않습니다.","type" => "email"));
    $member_name = $this->_input_check("member_name",array());
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"이름을 입력해주세요."));
    $member_nickname = $this->_input_check("member_nickname",array("empty_msg"=>"닉네임은 입력해주세요.","regular_msg" => "닉네임는 한글,영어 조합으로 2자~10자내로 입력해주세요.","type" => "custom","custom" => "/^[a-zA-Z가-힣]{2,10}$/"));
    $member_birth = $this->_input_check("member_birth",array("empty_msg"=>"생년월일를 입력해주세요."));
    $member_gender = $this->_input_check("member_gender",array("empty_msg"=>"성별을 선택해주세요."));
    $member_join_type = $this->_input_check("member_join_type",array());
    $device_os = $this->_input_check("device_os",array());

		$data['member_id']=$this->global_function->trim_str($member_id);
		$data['member_join_type']=$member_join_type;
		$data['device_os']=$device_os;
    $data['member_name'] = $member_name;
    $data['member_phone'] = $member_phone;
    $data['member_nickname'] = $member_nickname;
    $data['member_gender'] = $member_gender;
    $data['member_birth'] = $member_birth;

		$sns_member_login_check=$this->model_sns_join->sns_member_login_check($data);//SNS회원 가입 체크

		if (count($sns_member_login_check) > 0) {

			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "이미 가입 되어 있습니다.";

			echo json_encode($response);
			exit;
		}

		$result = $this->model_sns_join->sns_member_reg_in($data); // gcm_key,device_os 업데이트

		if($result =='0'){
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "회원가입에 실패 하였습니다.";

			echo json_encode($response);
			exit;
		}else{

			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = "정상";
			$response->member_idx = $result;

			echo json_encode($response);
			exit;
		}
	}

} // 클래스의 끝
?>
