<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-03
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
	}

	// Index
	public function index(){
		$this->board_list();
	}

	// 커뮤니티 리스트
	public function board_list(){
		$board_type = 1;

		$response = new stdClass();

		$response->board_type = $board_type;

		$this->_view(mapping('board').'/view_board_list', $response);
	}

	// 고민상담 커뮤니티 리스트
	public function counselor_board_list(){
		$result_list = $this->model_common->counselor_list();

		$board_type = 0;

		$response = new stdClass();

		$response->board_type = $board_type;
		$response->result_list = $result_list;

		$this->_view(mapping('board').'/view_counselor_board_list', $response);
	}

	// 커뮤니티 리스트 가져오기
	public function counselor_board_list_get(){

		$title = $this->_input_check("title",array());
		$member_nickname = $this->_input_check("member_nickname",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$category = $this->_input_check("category",array());
		$display_yn = $this->_input_check("display_yn",array());
		$board_type = $this->_input_check("board_type",array());
		$orderby = $this->_input_check("orderby",array());
		$history_data = $this->_input_check("history_data",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['title'] = $title;
		$data['member_nickname'] = $member_nickname;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['display_yn'] = $display_yn;
		$data['category'] = $category;
		$data['board_type'] = $board_type;
		$data['orderby'] = $orderby;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_board->counselor_board_list($data);
		$result_list_count = $this->model_board->counselor_board_list_count($data);

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->board_type = $board_type;
		$response->history_data = $history_data;

		$this->_list_view(mapping('board').'/view_counselor_board_list_get', $response);

	}

	// 커뮤니티 리스트 가져오기
	public function board_list_get(){

		$title = $this->_input_check("title",array());
		$member_nickname = $this->_input_check("member_nickname",array());
		$s_date = $this->_input_check("s_date",array());
		$e_date = $this->_input_check("e_date",array());
		$display_yn = $this->_input_check("display_yn",array());
		$board_type = $this->_input_check("board_type",array());
		$orderby = $this->_input_check("orderby",array());
		$history_data = $this->_input_check("history_data",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['title'] = $title;
		$data['member_nickname'] = $member_nickname;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;
		$data['display_yn'] = $display_yn;
		$data['board_type'] = $board_type;
		$data['orderby'] = $orderby;
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
		$response->board_type = $board_type;
		$response->history_data = $history_data;

		$this->_list_view(mapping('board').'/view_board_list_get', $response);

	}

	// 커뮤니티 상세
	public function board_detail(){
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티 키가 누락되었습니다."));
		$board_type = $this->_input_check("board_type",array("empty_msg"=>"커뮤니티 타입키가 누락되었습니다."));
		$history_data = $this->_input_check("history_data",array());

		$data['board_idx'] = $board_idx;

		$result = $this->model_board->board_detail($data);

		$response = new stdClass();

		$response->result = $result;
		$response->board_type = $board_type;
		$response->history_data = $history_data;

		if($board_type=='0'){
			$this->_view(mapping('board').'/view_counselor_board_detail', $response);
		}if($board_type=='1'){
			$this->_view(mapping('board').'/view_board_detail', $response);
		}
	}

	public function board_mod_up(){
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"키를 입력해주세요."));
		$title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해주세요."));
		$board_img = $this->_input_check("board_img",array("empty_msg"=>"대표이미지를 입력해주세요."));
		$board_img_detail = $this->_input_check("board_img_detail",array("empty_msg"=>"이미지를 입력해주세요."));
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해주세요."));
	  $contents =$this->input->post("contents");

		$data['board_idx'] = $board_idx;
		$data['title'] = $title;
		$data['board_img'] = $board_img;
		$data['board_img_detail'] = $board_img_detail;
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

	// 댓글 등록
	public function board_comment_reg_in(){
		$board_idx = $this->_input_check('board_idx',array("empty_msg"=>"게시판키을 입력해주세요.","focus_id"=>"board_idx"));
		$board_reply_idx = $this->_input_check('board_reply_idx',array());
		$cmt_member_nickname = $this->_input_check('cmt_member_nickname',array());
		$type =  $this->_input_check('type',array()); //1번 답글 0번 댓글
		$reply_comment = $this->_input_check('reply_comment',array());
		$pop_reply_comment = $this->_input_check('pop_reply_comment',array());
		
		if($type=='0'){
			if($reply_comment==''){

				$response = new stdClass();
				$response->code = -1;
				$response->code_msg 	= "댓글을 입력해주세요.";
				echo json_encode($response);
				exit;
			}
			$depth=0;
			$board_reply_idx=0;
			$parent_board_reply_idx=0;
		}else{
			if($pop_reply_comment==''){

				$response = new stdClass();
				$response->code = -1;
				$response->code_msg 	= "답글을 입력해주세요.";
				echo json_encode($response);
				exit;
			}
			$depth=1;
			$parent_board_reply_idx=$board_reply_idx;
			$reply_comment = '['.$cmt_member_nickname.'] '.$pop_reply_comment;
		}

		$data['type'] = $type;
		$data['admin_idx'] = "1";
		$data['board_idx'] = $board_idx;
		$data['reply_comment'] = $reply_comment;
		$data['parent_board_reply_idx'] = $parent_board_reply_idx;
		$data['depth']  = $depth;
		$data['board_reply_idx']  = $board_reply_idx;

		$result = $this->model_board->board_comment_reg_in($data);//# model 5. 댓글 등록
		$alarm_detail = $this->model_board->cmt_detail($data); 

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code = 1;
			$response->code_msg 	= "정상적으로 처리되었습니다.";

			if($type=='0'){

				$index="101";
				$alarm_data['board_idx'] = $board_idx;
				$member_idx = $alarm_detail->member_idx;
				$this->_alarm_action($member_idx,'0',$index, $alarm_data);
		
			  }else if($type=='1'){
		
				$index="102";
				$alarm_data['board_idx'] = $board_idx;
				$member_idx = $alarm_detail->member_idx;
				$this->_alarm_action($member_idx,'0',$index, $alarm_data);
			  }
		}
		echo json_encode($response);
		exit;
	}

	// 커뮤니티 댓글 리스트 가져오기
	public function reply_list_get(){
		$board_idx = $this->_input_check("board_idx",array());
		$member_nickname = $this->_input_check("member_nickname",array());
		$board_type = $this->_input_check("board_type",array());
		$orderby = $this->_input_check("orderby",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['board_idx'] = $board_idx;
		$data['member_nickname'] = $member_nickname;
		$data['board_type'] = $board_type;
		$data['orderby'] = $orderby;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_board->reply_list($data);
		$result_list_count = $this->model_board->reply_list_count($data);

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num, 'reply_list_get');

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->board_type = $board_type;
		$response->paging = $paging;
		$response->page_num = $page_num;

		$this->_list_view(mapping('board').'/view_reply_list_get', $response);
	}

	// 상태 변경
	public function board_state_mod_up(){
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$display_yn = $this->_input_check("display_yn",array("empty_msg"=>"상태 코드가 누락되었습니다."));

		$data['board_idx']  = $board_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_board->board_state_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "노출변경 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "상태변경 되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 노출여부 상태 변경
	public function board_display_yn_mod_up(){
		$board_idx = $this->_input_check("board_idx",array());
		$display_yn = $this->_input_check("display_yn",array());

		$data['board_idx']  = $board_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_board->board_display_yn_mod_up($data);

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

	// 댓글 노출여부 상태 변경
	public function display_yn_mod_up(){
		$board_reply_idx = $this->_input_check("board_reply_idx",array());
		$display_yn = $this->_input_check("display_yn",array());

		$data['board_reply_idx']  = $board_reply_idx;
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
