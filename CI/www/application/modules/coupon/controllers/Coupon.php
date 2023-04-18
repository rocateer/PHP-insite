<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 조다솜
| Create-Date : 2018-10-16
| Memo : 공지사항
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

class Coupon extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('coupon/model_coupon');
	}

	// 인덱스
  public function index() {
		echo "쿠폰페이지 디자인 필요 합니다.";
    //$this->coupon_list();
  }

	// 쿠폰 리스트
  public function coupon_list(){
    $this->_view('coupon/view_coupon_list');
  }

	// 쿠폰 리스트 가져오기
  public function coupon_list_get(){
		$page_num = $this->_input_check("page_num ",array("ternary"=>'1'));
	  $page_size = PAGESIZE ;

		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_coupon->coupon_list($data); // 쿠폰 리스트 가져오기
		$result_list_count = $this->model_coupon->coupon_list_count(); // 쿠폰 리스트 가져오기 카운트

		$no = $result_list_count-($page_size*($page_num-1));
    $paging = $this->global_function->paging($result_list_count, $page_size, $page_num, "page_go");

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;

	  $this->_list_view('coupon/view_coupon_list_get',$response);
  }
}// 클래스의 끝
?>
