<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2023-04-25
| Memo : 직종 승인 관리
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

class Work_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('work').'/model_work');
		$this->load->model('common/model_common');
	}
	/* Index */
	public function index(){
		$this->work_list();
	}

// 회원 리스트 
	public function work_list(){
		$work_list=$this->model_common->work_list();

		$response = new stdClass();

		$response->work_list = $work_list;

		$this->_view(mapping('work').'/view_work_list',$response);
	}

//회원 리스트 가져오기
	public function work_list_get(){

		$member_id = $this->_input_check('member_id',array());
		$member_name = $this->_input_check('member_name',array());
		$member_nickname = $this->_input_check('member_nickname',array());
		$state = $this->_input_check('state',array());
		$work = $this->_input_check('work',array());
		$s_date = $this->_input_check('s_date',array());
		$e_date = $this->_input_check('e_date',array());
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$history_data = $this->_input_check("history_data",array());
		$page_size = PAGESIZE;//10

		$data["member_id"]=$member_id;
		$data["member_name"]=$member_name;
		$data["member_nickname"]=$member_nickname;
		$data["state"]=$state;
		$data["work"]=$work;
		$data["s_date"]=$s_date;
		$data["e_date"]=$e_date;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		# model, 기업 회원 리스트 get
		$result_list=$this->model_work->work_list($data);
		# model, 기업 회원 리스트 총 카운트
		$result_list_count=$this->model_work->work_list_count($data);
		#페이징
		$no=$result_list_count-($page_size*($page_num-1));
		$paging=$this->global_function->paging($result_list_count,$page_size,$page_num);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;
		$response->page_num = $page_num;
		$response->history_data = $history_data;

		$this->_list_view(mapping('work').'/view_work_list_get',$response);

	}

	// 회원 상세보기 
	public function work_detail(){
		
		$history_data = $this->_input_check("history_data",array());
		$work_confirm_idx = $this->_input_check("work_confirm_idx",array());

		$data['work_confirm_idx'] = $work_confirm_idx;

		$result = $this->model_work->work_detail($data); 

		$response = new stdClass();

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('work').'/view_work_detail',$response);
	}

	//회원 상태 
	public function state_mod_up(){
		$work_confirm_idx = $this->_input_check("work_confirm_idx",array("empty_msg"=>"키 누락"));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"키 누락"));
		$state = $this->_input_check("state",array("empty_msg"=>"상태 누락"));
		$reject_reason = $this->_input_check("reject_reason",array());

		$data['work_confirm_idx'] = $work_confirm_idx;
		$data['member_idx'] = $member_idx;
		$data['state'] = $state;
		$data['reject_reason'] = $reject_reason;

		$result = $this->model_work->state_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "정상적으로 처리되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	//메모
	public function memo_mod_up(){
		$work_confirm_idx = $this->_input_check("work_confirm_idx",array("empty_msg"=>"키 누락"));
		$memo = $this->_input_check("memo",array());

		$data['work_confirm_idx'] = $work_confirm_idx;
		$data['memo'] = $memo;

		$result = $this->model_work->memo_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "저장되었습니다.";
		}
		echo json_encode($response);
		exit;
	}


	

}
