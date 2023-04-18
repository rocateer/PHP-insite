<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2019-02-07
| Memo : 아이디찾기
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

class Find_id_v_1_0_0 extends MY_Controller {

	/* 생성자 영역 */
  function __construct(){
    parent::__construct();

    $this->load->model('find_id_v_1_0_0/model_find_id');
  }

	/* Index */
	public function index(){
		$this->member_id_find();
	}

	/* 이메일(아이디) 찾기 */
	public function member_id_find(){
		header('Content-Type: application/json');
    $member_nickname = $this->_input_check("member_nickname",array("empty_msg"=>"닉네임을 입력해주세요."));
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"핸드폰번호를 입력해주세요."));

    $special = array("-", ",", ".", " ", "시");
		$member_phone = str_replace($special, "", $member_phone);

		$data['member_nickname'] = $member_nickname;
		$data['member_phone'] = $member_phone;

		# model. 아이디 찾기
		$result = $this->model_find_id->member_id_find($data);

		$response = new stdClass;

		if(count($result) == 0){
      $response->code = "-2";
			$response->code_msg = $this->global_msg->code_msg('-2');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->member_id = $result->member_id;
		}

		echo json_encode($response);
		exit;
	}

}
