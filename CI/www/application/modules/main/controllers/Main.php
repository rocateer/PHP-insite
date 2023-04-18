<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	정수범
| Create-Date : 2017-01-15
| Memo : 메인
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

class Main extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('main/model_main');
	}

//인덱스
  public function index() {
    $this->test_view();
  }

//메인 화면
  public function test_view(){

    $this->_list_view('main/view_test_view');
  }

//메인 화면
  public function preview_view(){

    $this->_list_view('main/view_preview_view');
  }

//메인 화면
  public function main_view(){
		$banner_list = $this->model_main->banner_list();
		$md_product_list = $this->model_main->md_product_list();
		$new_product_list = $this->model_main->new_product_list();

		$response = new stdClass();

		$response->banner_list = $banner_list;
		$response->md_product_list = $md_product_list;
		$response->new_product_list = $new_product_list;

    $this->_view('main/view_main_view',$response);
  }

}// 클래스의 끝
?>
