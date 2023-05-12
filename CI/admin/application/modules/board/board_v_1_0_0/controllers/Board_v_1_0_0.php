<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2023-05-12
| Memo : 커뮤니티 관리
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

class Board_v_1_0_0 extends MY_Controller{

	// 생성자 영역
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('board').'/model_board');
		$this->load->model('common/model_common');
	}

	// Index
	public function index(){
		$this->board_list();
	}

	// 커뮤니티 리스트
	public function board_list(){
		$result_list = $this->model_common->work_list();

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_view(mapping('board').'/view_board_list', $response);
	}

	// 커뮤니티 리스트 가져오기
	public function board_list_get(){

		$title = $this->_input_check("title",array());
		$display_yn = $this->_input_check("display_yn",array());
		$anony_yn = $this->_input_check("anony_yn",array());
		$work_arr = $this->_input_check("work_arr",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$history_data = $this->_input_check("history_data",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['title'] = $title;
		$data['display_yn'] = $display_yn;
		$data['anony_yn'] = $anony_yn;
		$data['work_arr'] = $work_arr;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_board->board_list($data);
		$result_list_count = $this->model_board->board_list_count($data);

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->history_data = $history_data;

		$this->_list_view(mapping('board').'/view_board_list_get', $response);
	}

	// 커뮤니티 상세
	public function board_detail(){
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티 키가 누락되었습니다."));
		$history_data = $this->_input_check("history_data",array());

		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_detail($data);
		$result_list = $this->model_common->work_list();

		$response = new stdClass();

		$response->result_list = $result_list;

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('board').'/view_board_detail',$response);
	}

	public function board_mod_up(){
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"게시판키를 입력해주세요."));
		$title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해주세요."));
		$work_yn = $this->_input_check("work_yn",array("empty_msg"=>"접근권한을 선택해주세요."));
		$detail_yn = $this->_input_check("detail_yn",array("empty_msg"=>"상세보기권한을 선택해주세요."));
		$anony_yn = $this->_input_check("anony_yn",array("empty_msg"=>"익명을 선택해주세요."));
		$img_path = $this->_input_check("img_path",array("empty_msg"=>"이미지를 등록해주세요."));
		$contents = $this->_input_check("contents",array("empty_msg"=>"소개글을 입력해주세요."));
		$work_arr = $this->_input_check("work_arr",array());

		$data['board_idx'] = $board_idx;
		$data['title'] = $title;
		$data['work_yn'] = $work_yn;
		$data['detail_yn'] = $detail_yn;
		$data['anony_yn'] = $anony_yn;
		$data['img_path'] = $img_path;
		$data['work_arr'] = $work_arr;
		$data['contents'] = $contents;

		$result = $this->model_board->board_mod_up($data);

		$response = new stdClass;

		if($result == "0") {
			$response->code = "0";
			$response->code_msg = "정보를 불러오지 못했습니다. 다시 한번 시도해주세요.";
		}else{
			$response->code = "1";
			$response->code_msg = "등록되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

	// 노출여부 상태 변경
	public function display_yn_mod_up(){
		$board_idx = $this->_input_check("board_idx",array());
		$display_yn = $this->_input_check("display_yn",array());

		$data['board_idx']  = $board_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_board->display_yn_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "상태변경 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 커뮤니티 상태변경
	public function board_del(){
		$board_idx = $this->_input_check("board_idx",array());
		$data['board_idx']  = $board_idx;

		$result = $this->model_board->board_del($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "상태변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else{
			$response->code = 1;
			$response->code_msg 	= "상태변경 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 등록
	public function board_reg(){

		$result_list = $this->model_common->work_list();
		$response = new stdClass();
		$response->result_list = $result_list;
		
		$this->_view(mapping('board').'/view_board_reg', $response);
	}

	public function board_reg_in(){
		$title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해주세요."));
		$work_yn = $this->_input_check("work_yn",array("empty_msg"=>"접근권한을 선택해주세요."));
		$detail_yn = $this->_input_check("detail_yn",array("empty_msg"=>"상세보기권한을 선택해주세요."));
		$anony_yn = $this->_input_check("anony_yn",array("empty_msg"=>"익명을 선택해주세요."));
		$img_path = $this->_input_check("img_path",array("empty_msg"=>"이미지를 등록해주세요."));
		$contents = $this->_input_check("contents",array("empty_msg"=>"소개글을 입력해주세요."));
		$work_arr = $this->_input_check("work_arr",array());

		$data['title'] = $title;
		$data['work_yn'] = $work_yn;
		$data['detail_yn'] = $detail_yn;
		$data['anony_yn'] = $anony_yn;
		$data['img_path'] = $img_path;
		$data['work_arr'] = $work_arr;
		$data['contents'] = $contents;

		$result = $this->model_board->board_reg_in($data);

		$response = new stdClass;

		if($result == "0") {
			$response->code = "0";
			$response->code_msg = "정보를 불러오지 못했습니다. 다시 한번 시도해주세요.";
		}else{
			$response->code = "1";
			$response->code_msg = "등록되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

		/*
	|------------------------------------------------------------------------
	| 큐레이션
	|------------------------------------------------------------------------
	*/

	public function main_section_2(){
		$data['menu_type'] = 2;

		$result_list = $this->model_common->main_section_list($data);
		$board_list = $this->model_common->board_list();
		$response = new stdClass();

		$response->result_list = $result_list;
		$response->board_list = $board_list;

		$this->_view(mapping('board').'/view_main_section_2_list', $response);

	}
	
}
