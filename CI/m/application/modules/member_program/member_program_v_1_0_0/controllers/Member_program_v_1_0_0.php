<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
| Memo : 회원탈퇴
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

class Member_program_v_1_0_0 extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->model(mapping('member_program').'/model_member_program');
	}

	//인덱스
	public function index()
	{
		$this->member_program_list();
	}

	//
	public function member_program_list()
	{
		$this->_view2(mapping('member_program') . '/view_my_schedule_list');
	}

	// 포스트 리스트
	public function member_program_list_get(){
		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_idx'] = $member_idx;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_member_program->member_program_list($data);
		$result_list_count = $this->model_member_program->member_program_list_count($data);

		$response = new stdClass();

		$response->member_idx = $member_idx;
		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_list_view(mapping('member_program').'/view_my_schedule_list_get', $response);
	}

	//삭제하기
	public function member_program_del(){

		$member_program_idx = $this->_input_check("member_program_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));

		$data['member_program_idx'] = $member_program_idx;

		$response = new stdClass();

		$result = $this->model_member_program->member_program_del($data); // 1:1 질문 등록하기

		if($result == "0") {
			$response->code = "0";
			$response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code ="1";
			$response->code_msg = "스케줄이 삭제 되었습니다.";
		}
		echo json_encode($response);
		exit;
	}


		
}// 클래스의 끝
