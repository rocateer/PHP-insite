<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2021-10-13
| Memo : 공지사항 관리
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

class Notice_v_1_0_0 extends MY_Controller{

	// 생성자 영역
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('notice').'/model_notice');
	}

	// Index 
	public function index(){
		$this->notice_list();
	}

	// 공지사항 리스트
	public function notice_list(){
		$this->_view(mapping('notice').'/view_notice_list');
	}

	// 공지사항 리스트 가져오기
	public function notice_list_get(){
		$title = $this->_input_check("title",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;
		$history_data = $this->_input_check("history_data",array());

		$data['title'] = $title;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_notice->notice_list($data); // 공지사항 리스트
		$result_list_count = $this->model_notice->notice_list_count($data); // 공지사항 리스트 가져오기 총 카운트
		
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->history_data = $history_data;

		$this->_list_view(mapping('notice').'/view_notice_list_get', $response);
	}

	// 공지사항 등록
	public function notice_reg(){
		$this->_view(mapping('notice').'/view_notice_reg',array());
	}

	// 공지사항 등록하기
	public function notice_reg_in(){
		$img_path = $this->_input_check("img_path[]",array());
		$title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해 주세요."));
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요."));
		$notice_state = $this->_input_check("notice_state",array("ternary"=>'N'));

		$data['title'] = $title;
		$data['contents'] = $contents;
		$data['img_path'] = $img_path;
		$data['notice_state'] = $notice_state;

		$result = $this->model_notice->notice_reg_in($data); // 공지사항 등록하기

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "등록 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "등록 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 공지사항 상세
	public function notice_detail(){
		$notice_idx = $this->_input_check("notice_idx",array("empty_msg"=>"공지사항 키가 누락되었습니다."));
		$history_data = $this->_input_check("history_data",array());

		$data['notice_idx'] = $notice_idx;

		$result = $this->model_notice->notice_detail($data); // 공지사항 상세

		$response = new stdClass();

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('notice').'/view_notice_detail',$response);
	}

	// 공지사항 수정하기
	public function notice_mod_up(){
		$notice_idx = $this->_input_check("notice_idx",array("empty_msg"=>"공지사항 키가 누락되었습니다."));
		$title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해 주세요."));
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요."));
		$img_path = $this->_input_check("img_path[]",array());
		$notice_state = $this->_input_check("notice_state",array("ternary"=>'N'));

		$data['notice_idx'] = $notice_idx;
		$data['title'] = $title;
		$data['contents'] = $contents;
		$data['img_path'] = $img_path;
		$data['notice_state'] = $notice_state;

		$result = $this->model_notice->notice_mod_up($data); // 공지사항 수정하기

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "수정 실패하였습니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "수정 되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 공지사항 상태 변경
	public function notice_state_mod_up(){
		$notice_idx = $this->_input_check("notice_idx",array("empty_msg"=>"공지사항 키가 누락되었습니다."));
		$notice_state = $this->_input_check("notice_state",array("empty_msg"=>"공지사항 상태 코드가 누락되었습니다."));

		$data['notice_idx']  = $notice_idx;
		$data['notice_state'] = $notice_state;

		$result = $this->model_notice->notice_state_mod_up($data); // 공지사항 상태 변경

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "노출여부 변경하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 공지사항 삭제
	public function notice_del(){
		$notice_idx = $this->_input_check("notice_idx",array("empty_msg"=>"삭제 할 항목이 없습니다."));

		$data['notice_idx'] = $notice_idx;

		$result = $this->model_notice->notice_del($data); // 공지사항 삭제

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "삭제 실패하였습니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "삭제 되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

}
