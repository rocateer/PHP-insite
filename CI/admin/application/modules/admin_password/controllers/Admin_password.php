<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김민정
| Create-Date : 2018-03-23
| Memo : 비밀번호 변경
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

class Admin_password extends MY_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('admin_password/model_admin_password');
	}

	// 인덱스
	public function index(){
		$this->pw_mod();
	}

	// 비밀번호 변경 폼
	public function pw_mod(){
		$this->_view('admin_password/view_pw_mod');
	}

	// 비밀번호 변경
	public function pw_mod_up(){
		$admin_pw = $this->_input_check("admin_pw",array());
		$admin_new_pw = $this->_input_check("admin_new_pw",array());
		$admin_re_pw = $this->_input_check("admin_re_pw",array());

		$data['admin_idx'] = $this->admin_idx;
		$data['admin_pw'] = $admin_pw;
		$data['admin_new_pw'] = $admin_new_pw;
		$data['admin_re_pw'] = $admin_re_pw;

    if($data['admin_pw'] == "" || $data['admin_new_pw'] == "" || $data['admin_re_pw'] == ""){
      echo json_encode(2);
  		exit;
    }elseif($data['admin_new_pw'] != $data['admin_re_pw']){
			echo json_encode(3);
			exit;
		}

		$pw_check = $this->model_admin_password->pw_check($data); // 비밀번호 체크
		if($pw_check <1){
			echo json_encode(4);
			exit;
		}

		$result = $this->model_admin_password->pw_mod_up($data); // 비밀번호 변경
		echo json_encode($result);
		exit;
	}

}
