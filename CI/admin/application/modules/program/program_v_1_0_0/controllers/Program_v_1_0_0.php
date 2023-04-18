<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-08-22
| Memo : 운동관리
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

class Program_v_1_0_0 extends MY_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model(mapping('program').'/model_program');
	}

 	// 인덱스
	public function index(){

		$this->program_list();
	}

	// 운동관리 리스트
	public function program_list(){
		$result_list = $this->model_program->category_list(); 

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_view(mapping('program').'/view_program_list',$response);
	}

	// 운동관리 리스트 가져오기
	public function program_list_get(){
		$title = $this->_input_check('title',array());
		$display_yn = $this->_input_check('display_yn',array());
		$category_management_idx = $this->_input_check('category_management_idx',array());
		$s_date = $this->_input_check('s_date',array());
		$e_date = $this->_input_check('e_date',array());		
		$history_data = $this->_input_check('history_data',array());
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = PAGESIZE;
	
		$data['title'] = $title;
		$data['category_management_idx'] = $category_management_idx;
		$data['display_yn'] = $display_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;		
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_program->program_list($data); // 운동관리 리스트
		$result_list_count = $this->model_program->program_list_count($data); // 운동관리 리스트 카운트

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->history_data = $history_data;

		$this->_list_view(mapping('program').'/view_program_list_get',$response);
	}
	
	// 운동관리 등록
	public function program_reg(){
		$result_list = $this->model_program->category_list(); 
		$exercise_list = $this->model_program->exercise_list(); 

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->exercise_list = $exercise_list;
		$response->temporary_idx = time();
		
		$this->_view(mapping('program').'/view_program_reg', $response);
	}

	// 프로그램 운동 가져오기
	public function program_reg_list_get(){
		$program_idx = $this->_input_check('program_idx',array());
	
		$data['program_idx'] = $program_idx;

		$result_list = $this->model_program->program_reg_list_get($data); // 운동관리 리스트

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_list_view(mapping('program').'/view_program_reg_list_get',$response);
	}
	
	// 운동 등록하기
	public function exercise_reg(){
		
		$program_idx = $this->_input_check("program_idx",array());
		$exercise_idx = $this->_input_check("exercise_idx",array());
		
		$data['program_idx'] = $program_idx;
		$data['exercise_idx'] = $exercise_idx;
		
		$result = $this->model_program->exercise_reg($data); // 운동관리 등록하기

		$response = new stdClass();
		
		if($result == '0'){
			$response->code = "-1";
			$response->code_msg = "등록 실패 했습니다. 잠시 후 다시 시도 해주세요.";
		} else {
			$response->code = "1";
			$response->code_msg = "등록 되었습니다.";
		}
		echo json_encode($response);
		exit;		
	}

	// 운동 삭제
	public function exercise_del(){
		
		$program_exercise_idx = $this->_input_check("program_exercise_idx",array());

		$data['program_exercise_idx'] = $program_exercise_idx;
		
		$result = $this->model_program->exercise_del($data); // 운동관리 등록하기

		$response = new stdClass();
		
		if($result == '0'){
			$response->code = "-1";
			$response->code_msg = "삭제 실패 했습니다. 잠시 후 다시 시도 해주세요.";
		} else {
			$response->code = "1";
			$response->code_msg = "삭제 되었습니다.";
		}
		echo json_encode($response);
		exit;		
	}

	// 운동관리 등록하기
	public function program_reg_in(){
		$category_management_idx = $this->_input_check("category_management_idx",array("empty_msg"=>"카테고리를 선택해주세요"));
		$level = $this->_input_check("level",array("empty_msg"=>"난이도를 선택해주세요.","focus_id"=>"level"));
		$title = $this->_input_check("title",array("empty_msg"=>"프로그램명을 입력해주세요.","focus_id"=>"title"));
		$img_path = $this->_input_check("img_path",array("empty_msg"=>"이미지를 등록해주세요"));
		$url_link = $this->_input_check("url_link",array());
		$exercise_time = $this->_input_check("exercise_time",array("empty_msg"=>"운동을 등록해주세요."));
		$temporary_idx = $this->_input_check("temporary_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요.","focus_id"=>"contents"));
		
		$data['title'] = $title;
		$data['img_path'] = $img_path;
		$data['url_link'] = $url_link;
		$data['category_management_idx'] = $category_management_idx;
		$data['level'] = $level;
		$data['exercise_time'] = $exercise_time;
		$data['temporary_idx'] = $temporary_idx;
		$data['contents'] = $contents;
		
		$result = $this->model_program->program_reg_in($data); // 운동관리 등록하기

		$response = new stdClass();
		
		if($result == '0'){
			$response->code = "-1";
			$response->code_msg = "등록 실패 했습니다. 잠시 후 다시 시도 해주세요.";
		} else {
			$response->code = "1";
			$response->code_msg = "등록 성공.";
		}
		echo json_encode($response);
		exit;		
	}

	// 운동관리 상세
	public function program_detail(){
		$program_idx = $this->_input_check("program_idx",array());
		$history_data = $this->_input_check("history_data",array());

		$data['program_idx'] = $program_idx;

		$result = $this->model_program->program_detail($data); // 운동관리 상세
		$result_list = $this->model_program->category_list(); 
		$exercise_list = $this->model_program->exercise_list(); 

		$response = new stdClass();

		$response->result = $result;
		$response->result_list = $result_list;
		$response->exercise_list = $exercise_list;
		$response->history_data = $history_data;

		$this->_view(mapping('program').'/view_program_detail',$response);
	}
	
	// 운동관리 상태 변경
	public function program_state_mod_up(){
		$program_idx = $this->_input_check("program_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$display_yn = $this->_input_check("display_yn",array("empty_msg"=>"상태 코드가 누락되었습니다."));

		$data['program_idx']  = $program_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_program->program_state_mod_up($data);

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
	
	// 운동관리 수정
	public function program_mod_up(){
		$program_idx = $this->_input_check("program_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$category_management_idx = $this->_input_check("category_management_idx",array("empty_msg"=>"카테고리를 선택해주세요"));
		$level = $this->_input_check("level",array("empty_msg"=>"난이도를 선택해주세요.","focus_id"=>"level"));
		$title = $this->_input_check("title",array("empty_msg"=>"프로그램명을 입력해주세요.","focus_id"=>"title"));
		$img_path = $this->_input_check("img_path",array("empty_msg"=>"이미지를 등록해주세요"));
		$exercise_time = $this->_input_check("exercise_time",array("empty_msg"=>"운동을 등록해주세요."));
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요.","focus_id"=>"contents"));
		$url_link = $this->_input_check("url_link",array());
		
		$data['program_idx'] = $program_idx;
		$data['title'] = $title;
		$data['img_path'] = $img_path;
		$data['category_management_idx'] = $category_management_idx;
		$data['level'] = $level;
		$data['exercise_time'] = $exercise_time;
		$data['contents'] = $contents;
		$data['url_link'] = $url_link;
		
		$result = $this->model_program->program_mod_up($data); // 운동관리 수정

		$response = new stdClass();
		
		if($result == '0'){
			$response->code = "-1";
			$response->code_msg = "수정 실패 했습니다. 잠시 후 다시 시도 해주세요.";
		} else {
			$response->code = "1";
			$response->code_msg = "수정 되었습니다.";
		}
		echo json_encode($response);
		exit;		
	}
	
	// 운동관리 삭제
	public function program_del(){
		$program_idx = $this->_input_check("program_idx",array("empty_msg"=>"삭제 할 항목이 없습니다."));

		$data['program_idx'] = $program_idx;

		$result = $this->model_program->program_del($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "삭제 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "삭제 되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	/*
	|------------------------------------------------------------------------
	| 큐레이션
	|------------------------------------------------------------------------
	*/

	public function main_section_1(){
		$result = $this->model_common->setting_detail();
	
		$response = new stdClass();

		$response->result = $result;	

		$this->_view(mapping('program').'/view_main_section_1', $response);

	}
	
	// get
	public function main_section_list_get(){
   	$menu_type = $this->_input_check("menu_type",array());
   	
		$data['menu_type'] = $menu_type;

		$result_list = $this->model_common->main_section_list($data);
		$program_list = $this->model_common->program_list();
		$response = new stdClass();

		$response->result_list = $result_list;
		$response->program_list = $program_list;

		$this->_list_view(mapping('program').'/view_main_section_1_list_get', $response);
	}

}	// 클래스의 끝
