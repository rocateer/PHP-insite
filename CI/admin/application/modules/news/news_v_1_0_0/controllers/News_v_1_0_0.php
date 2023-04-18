<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-08-22
| Memo : POST관리
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

class News_v_1_0_0 extends MY_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model(mapping('news').'/model_news');
	}

 	// 인덱스
	public function index(){

		$this->news_list();
	}

	// post관리 리스트
	public function news_list(){

		$this->_view(mapping('news').'/view_news_list');
	}

	// post관리 리스트 가져오기
	public function news_list_get(){
		$title = $this->_input_check('title',array());
		$display_yn = $this->_input_check('display_yn',array());
		$s_date = $this->_input_check('s_date',array());
		$e_date = $this->_input_check('e_date',array());		
		$history_data = $this->_input_check('history_data',array());
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = PAGESIZE;
	
		$data['title'] = $title;
		$data['display_yn'] = $display_yn;
		$data['s_date'] = $s_date;
		$data['e_date'] = $e_date;		
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_news->news_list($data); // post관리 리스트
		$result_list_count = $this->model_news->news_list_count($data); // post관리 리스트 카운트

		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->history_data = $history_data;

		$this->_list_view(mapping('news').'/view_news_list_get',$response);
	}
	
	// post관리 등록
	public function news_reg(){
		$history_data = $this->_input_check("history_data",array());
		
		$response = new stdClass();
		
		$response->history_data = $history_data;
		
		$this->_view(mapping('news').'/view_news_reg', $response);
	}
	
	// post관리 등록하기
	public function news_reg_in(){
		$title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해 주세요.","focus_id"=>"title"));
		$img_path = $this->_input_check("img_path",array());
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요.","focus_id"=>"contents"));
		$contents = $this->input->post("contents");
		$display_yn = $this->_input_check("display_yn",array());
		
		$data['title'] = $title;
		$data['img_path'] = $img_path;
		$data['display_yn'] = $display_yn != 'Y'?'N':$display_yn;
		$data['contents'] = $contents;
		
		$result = $this->model_news->news_reg_in($data); // post관리 등록하기

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

	// post관리 상세
	public function news_detail(){
		$news_idx = $this->_input_check("news_idx",array());
		$history_data = $this->_input_check("history_data",array());

		$data['news_idx'] = $news_idx;

		$result = $this->model_news->news_detail($data); // post관리 상세

		$response = new stdClass();

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('news').'/view_news_detail',$response);
	}
	
	// post관리 상태 변경
	public function news_state_mod_up(){
		$news_idx = $this->_input_check("news_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$display_yn = $this->_input_check("display_yn",array("empty_msg"=>"상태 코드가 누락되었습니다."));

		$data['news_idx']  = $news_idx;
		$data['display_yn'] = $display_yn;

		$result = $this->model_news->news_state_mod_up($data);

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
	
	// post관리 수정
	public function news_mod_up(){
		$news_idx = $this->_input_check("news_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해 주세요.","focus_id"=>"title"));
		$img_path = $this->_input_check("img_path",array());
		$contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요.","focus_id"=>"contents"));
		$contents = $this->input->post("contents");
		
		$data['news_idx'] = $news_idx;
		$data['img_path'] = $img_path;
		$data['title'] = $title;
		$data['contents'] = $contents;
		
		$result = $this->model_news->news_mod_up($data); // post관리 수정

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
	
	// post관리 삭제
	public function news_del(){
		$news_idx = $this->_input_check("news_idx",array("empty_msg"=>"삭제 할 항목이 없습니다."));

		$data['news_idx'] = $news_idx;

		$result = $this->model_news->news_del($data);

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

		$this->_view(mapping('news').'/view_main_section_1', $response);

	}
	
	// get
	public function main_section_list_get(){
   	$menu_type = $this->_input_check("menu_type",array());
   	
		$data['menu_type'] = $menu_type;

		$result_list = $this->model_common->main_section_list($data);
		$news_list = $this->model_common->news_list();
		$response = new stdClass();

		$response->result_list = $result_list;
		$response->news_list = $news_list;

		$this->_list_view(mapping('news').'/view_main_section_1_list_get', $response);
	}


	// 수정
	public function main_section_mod_up(){
		$main_section_idx = $this->_input_check("main_section_idx",array("empty_msg"=>"키값을 입력해주세요.","focus_id"=>"main_section_idx"));
		$display_yn = $this->_input_check("display_yn",array("empty_msg"=>"노출여부를 입력해주세요.","focus_id"=>"display_yn"));
		$guide_idx = $this->_input_check("guide_idx",array());
		$product_idx = $this->_input_check("product_idx",array());

		$data['main_section_idx'] = $main_section_idx;
		$data['display_yn'] = $display_yn;
		$data['guide_idx'] = $guide_idx;
		$data['product_idx'] = $product_idx;

		$result = $this->model_news->main_section_mod_up($data);

		$response = new stdClass;

		if($result == "0") {
			$response->code = "0";
			$response->code_msg = "실패하였습니다.";
		}else{
			$response->code = "1";
			$response->code_msg = "정상적으로 처리되었습니다.";
		}

		echo json_encode($response);
		exit;
 }

}	// 클래스의 끝
