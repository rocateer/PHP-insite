<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	조다솜, 김옥훈
| Create-Date : 2018-01-15
| Memo : 기초정보관리
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

class Terms_v_2_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('terms').'/model_terms');
	}

 //인덱스
	public function index(){
		$this->terms_list();
	}

//약관 리스트
	public function terms_list(){
		$result_list=$this->model_terms->terms_list(); //약관 리스트

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_view(mapping('terms').'/view_terms_list',$response);
	}

//약관 상세 보기
	public function terms_mod(){
		$terms_management_idx = $this->_input_check("terms_management_idx",array());

		$data['terms_management_idx'] = $terms_management_idx;

		$result=$this->model_terms->terms_detail($data);//약관 상세 보기

		$response = new stdClass();

		$response->result = $result;

		$this->_view(mapping('terms').'/view_terms_mod',$response);
	}

//약관 수정
	public function terms_mod_up(){

		ini_set('display_errors', '0'); // 재명:: 약관 내용이 많아졌을 시 "preg_replace(): Compilation failed: regular expression is too large at offset 49194" 에러 방지

		$terms_management_idx = $this->_input_check("terms_management_idx",array());
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해주세요."));
		$contents= $this->input->post("contents");

		$data['terms_management_idx']=$terms_management_idx;
		$data['contents']=$contents;

		$result=$this->model_terms->terms_mod_up($data);//약관 수정

		echo json_encode($result);
		exit;

	}
}	// 클래스의 끝
