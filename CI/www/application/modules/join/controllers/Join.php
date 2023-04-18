<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 조다솜
| Create-Date : 2018-10-05
| Memo : 회원 가입
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

class Join extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('join/model_join');
	}


	// 인덱스
  public function index() {
    $this->join_reg();
  }

	// 회원가입
  public function join_reg(){
    $this->_view('join/view_join_reg');
  }

	// 2. 회원 가입
  public function join_reg_in(){
    header('Content-Type: application/json');
    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","regular_msg"=>"이메일 형식으로 입력해주세요.","type"=>"email"));
    $member_pwd = $this->_input_check("member_pwd",array("empty_msg"=>"비밀번호를 입력해주세요.","regular_msg"=>"비밀번호는 영어,숫자 조합으로 8자~20자내로 입력해주세요.","type"=>"custom","custom"=>"/^[0-9A-Za-z]{8,20}$/"));
    $member_pwd_check = $this->_input_check("member_pwd_check",array("empty_msg"=>"비밀번호 확인을 입력해주세요."));

    $response = new stdClass();

    // 비밀번호 체크
    if($member_pwd != $member_pwd_check){
      $response->code = "-1";
      $response->code_msg = "입력한 두 비밀번호가 상이해요. 다시 한번 확인해주세요.";

      echo json_encode($response);
      exit;
    }

    $data['member_id'] = $member_id;
    $data['member_pwd'] = $member_pwd;
    $data['member_join_type'] = "C";

    $member_id_check = $this->model_join->member_id_check($data);//model 1. 아이디 중복 체크

    if($member_id_check != 0){
      $response->code = "-1";
			$response->code_msg = "이미 사용중인 아이디에요.";

      echo json_encode($response);
      exit;
    }

    $result = $this->model_join->member_reg_in($data); // model 2. 회원 가입

    if($result < 0){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했어요! 다시 한번 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "성공적으로 회원가입이 완료되었어요. 앞으로 약속을 잘 지켜봐요!";
		}

    echo json_encode($response);
    exit;
  }

}// 클래스의 끝
?>
