<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-02-22
| Memo : 키즈해빛 랜딩
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

class Randing_v_5_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

	}

	/* Index */
  public function index() {
    $this->main_view();
  }

	// 1. 메인 화면
  public function main_view(){
		$version_path ="/assets_randing/randing_v_5_0_0/";

		$response = new stdClass();

		$response->version_path = $version_path;

		$this->_list_view('randing_v_5_0_0/view_randing_view',$response);
  }


	public function contact_reg_in(){

		$request_gubun = $this->input_check("request_gubun", ["제휴문의 구분 값 누락."], true, true);

		if($request_gubun == '0'){ // request_gubun = '0' -> 상담사 제휴문의
			$request_name = $this->input_check("request_name", ["상담사명을 입력해주세요."], true, true);
			$request_corp_name = $this->input_check("request_corp_name");
		}else{ // request_gubun = '1' -> 포인트몰 제휴문의
			$request_name = $this->input_check("request_name", ["당담자명을 입력해주세요."], true, true);
			$request_corp_name = $this->input_check("request_corp_name", ["업체명을 입력해주세요."], true, true);
		}

		$request_email = $this->input_check("request_email", ["메일을 입력해주세요."], true, true);
		$request_phone = $this->input_check("request_phone", ["전화번호를 입력해주세요."], true, true);
		$request_comment = $this->input_check("request_comment", ["삼당내용을 입력해주세요."], true, true);

		$response = new stdClass();

		if(!preg_match("/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $request_email)) {

			$response->code = "-1";
			$response->code_msg = "아이디를 이메일 형식으로 입력해주세요.";
			echo json_encode($response);
			exit;
		}

		$special = array("-", ",", ".", " ", "시");
		$request_phone = str_replace($special, "", $request_phone);

		$data['request_name'] = $request_name;
		$data['request_corp_name'] = $request_corp_name;
		$data['request_email'] = $request_email;
		$data['request_phone'] = $request_phone;
		$data['request_comment'] = $request_comment;
		$data['request_gubun'] = $request_gubun;

		# model 상담사 제휴문의 등록
		$result = $this->model_main->contact_reg_in($data);

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = "정보를 불러오지 못했습니다.";
		}else{
			$response->code = "1000";
			$response->code_msg = "정상";
		}

		echo json_encode($response);
		exit;
	}
}// 클래스의 끝
?>
