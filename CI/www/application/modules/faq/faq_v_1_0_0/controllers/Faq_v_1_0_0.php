<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 송민지
| Create-Date : 2022
| Memo : FAQ
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

class Faq_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model(mapping('faq').'/model_faq');
	}

	// 인덱스
  public function index() {
    $this->faq_list();
  }

	// FAQ 리스트
  public function faq_list(){
		$this->_view(mapping('faq').'/view_faq_list');
  }

	// FAQ 리스트 가져오기
  public function faq_list_get(){
		$title_0 = $this->_input_check("title_0",array());
		$contents_0 = $this->_input_check("contents_0",array());
		$display_yn = $this->_input_check("display_yn",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$page_num = $this->_input_check("page_num ",array("ternary"=>'1'));
	  $page_size = PAGESIZE ;
		$history_data = $this->_input_check("history_data",array());

		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['title_0'] = $title_0;
		$data['contents_0'] = $contents_0;
		$data['display_yn'] = $display_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;

		$result_list = $this->model_faq->faq_list_get($data); // FAQ 리스트 가져오기
		$result_list_count = $this->model_faq->faq_list_count($data); // FAQ 리스트 카운트 가져오기

		$no = $result_list_count-($page_size*($page_num-1));
    $paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->history_data = $history_data;

	  $this->_list_view(mapping('faq').'/view_faq_list_get',$response);
  }

}// 클래스의 끝
?>
