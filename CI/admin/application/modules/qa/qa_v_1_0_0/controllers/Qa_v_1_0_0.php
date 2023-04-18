<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2021-10-06
| Memo : QnA 관리
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

class Qa_v_1_0_0 extends MY_Controller{

	// 생성자 영역
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('qa').'/model_qa');
	}

	// Index
	public function index(){
		$this->qa_list();
	}

	// qa 리스트
	public function qa_list(){

		$total_qa = $this->model_qa->total_qa();

		$response = new stdClass();

		$response->total_qa = $total_qa;

		$this->_view(mapping('qa').'/view_qa_list', $response);
	}

	// qa 리스트 가져오기
	public function qa_list_get(){
		$member_nickname = $this->_input_check("member_nickname",array());
		$member_id = $this->_input_check("member_id",array());
		$qa_title = $this->_input_check("qa_title",array());
		$reply_yn = $this->_input_check("reply_yn",array());
		$qa_type = $this->_input_check("qa_type",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$page_num = $this->_input_check('page_num ',array("ternary"=>'1'));
		$page_size = PAGESIZE;
		$history_data = $this->_input_check("history_data",array());

		$data['member_nickname'] = $member_nickname;
		$data['member_id'] = $member_id;
		$data['qa_title'] = $qa_title;
		$data['reply_yn'] = $reply_yn;
		$data['qa_type'] = $qa_type;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_qa->qa_list($data);	// qa 리스트 가져오기
		$result_list_count = $this->model_qa->qa_list_count($data); // qa 리스트 가져오기 총 카운트
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num, "default_list_get");

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->history_data = $history_data;

		$this->_list_view(mapping('qa').'/view_qa_list_get', $response);
	}

	// qa 상세
	public function qa_detail(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>"QA 코드 누락"));
		$history_data = $this->_input_check("history_data",array());

		$data['qa_idx'] = $qa_idx;

		$result = $this->model_qa->qa_detail($data); // qa 상세

		$response = new stdClass();

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('qa').'/view_qa_detail', $response);
	}

	// qa 댓글 삭제
	public function qa_reply_del(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>"QA 코드 누락"));

		$data['qa_idx'] = $qa_idx;

		$result = $this->model_qa->qa_reply_del($data); // qa 댓글 삭제

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "답변삭제 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "답변삭제 성공하였습니다.";
		}
		echo json_encode($response);
		exit;

	}

	// qa 답변 등록하
	public function qa_reply_reg_in(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>"QA 코드 누락"));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드 누락"));
		$reply_contents = $this->_input_check("reply_contents",array("empty_msg"=>"답변 내용을 작성 후 답변 등록 버튼을 눌러주세요."));

		$data['qa_idx'] = $qa_idx;
		$data['reply_contents'] = $reply_contents;

		$result = $this->model_qa->qa_reply_reg_in($data); // qa 답변 등록하기

		$response = new stdClass();

		if($result == "-1") {
			$response->code = 0;
			$response->code_msg 	= "답변등록 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1000") {
			$response->code = 1;
			$response->code_msg 	= "답변등록 성공하였습니다.";

			$index="105";
			$alarm_data['qa_idx'] = $qa_idx;
			$member_idx = $member_idx;
			$this->_alarm_action($member_idx,'0',$index, $alarm_data);

		}
		echo json_encode($response);
		exit;
	}

	// qa 삭제
	public function qa_del(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>"QA 코드 누락"));

		$data['qa_idx'] = $qa_idx;

		$result = $this->model_qa->qa_del($data); // qa 삭제

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "삭제 실패!";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "삭제 성공!";
		}
		echo json_encode($response);
		exit;
	}

}	// 클래스의 끝
