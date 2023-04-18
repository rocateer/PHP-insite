<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2018-11-05
| Memo : 대시보드
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

class Main_contents_v_0_6_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

	}

	/* Index */
	public function index(){
		$this->main_contents_list();
	}

	// 메인콘텐츠
	public function main_contents_list(){

    $this->_view(mapping('main_contents').'/view_main_contents_list');

	}

	// 레시피 섹션
		public function recipe_section(){

	    $this->_view(mapping('main_contents').'/view_recipe_section');

		}

	// 레시피 섹션
		public function shop_main(){

			$this->_view(mapping('main_contents').'/view_shop_main');

		}

	// 레시피 섹션
		public function shop_section(){

			$this->_view(mapping('main_contents').'/view_shop_section');

		}

}
