<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2022-08-22
| Memo : 회원 관리
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

class Member_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('member').'/model_member');
	}
	/* Index */
	public function index(){
		$this->member_list();
	}

// 회원 리스트 
	public function member_list(){
		$this->_view(mapping('member').'/view_member_list');
	}


//회원 리스트 가져오기
	public function member_list_get(){

		$member_id = $this->_input_check('member_id',array());
		$member_nickname = $this->_input_check('member_nickname',array());
		$member_state = $this->_input_check('member_state',array());
		$s_date = $this->_input_check('s_date',array());
		$e_date = $this->_input_check('e_date',array());
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$history_data = $this->_input_check("history_data",array());
		$page_size = PAGESIZE;//10

		$data["member_id"]=$member_id;
		$data["member_nickname"]=$member_nickname;
		$data["member_state"]=$member_state;
		$data["s_date"]=$s_date;
		$data["e_date"]=$e_date;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;


		# model, 기업 회원 리스트 get
		$result_list=$this->model_member->member_list($data);
		# model, 기업 회원 리스트 총 카운트
		$result_list_count=$this->model_member->member_list_count($data);
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

		$this->_list_view(mapping('member').'/view_member_list_get',$response);

	}

	// 회원 리스트 excel 
	public function member_list_excel(){

		$member_type = $this->_input_check('member_type',array());
		$member_id = $this->_input_check('member_id',array());
		$member_name = $this->_input_check('member_name',array());
		$member_nickname = $this->_input_check('member_nickname',array());
		$member_phone = $this->_input_check('member_phone',array());
		$member_state = $this->_input_check('member_state',array());
	
		$data["member_type"]=$member_type;
		$data["member_id"]=$member_id;
		$data["member_name"]=$member_name;
		$data["member_nickname"]=$member_nickname;
		$data["member_phone"]=$member_phone;
		$data["member_state"]=$member_state;
	
		$result_list = $this->model_member->member_list_excel($data); // 고객 리스트
		
		$response = new stdClass();
		$response->result_list = $result_list;
		$response->no = count($result_list);

		$this->_list_view(mapping('member').'/view_member_list_excel',$response);
	}

	// 회원 상세보기 
	public function member_detail(){
		
		$history_data = $this->_input_check("history_data",array());
		$member_idx = $this->_input_check("member_idx",array());

		$data['member_idx'] = $member_idx;

		$result = $this->model_member->member_detail($data); 

		$response = new stdClass();

		$response->result = $result;
		$response->history_data = $history_data;

		$this->_view(mapping('member').'/view_member_detail',$response);

	}

	// 기업회원 수정
	public function corp_mod_up(){

		$corp_idx = $this->_input_check("corp_idx",array("empty_msg"=>"공지사항 키가 누락되었습니다."));
		$corp_worker = $this->_input_check("corp_worker",array("empty_msg"=>"당담자 이름을 입력해주세요."));
		$corp_name = $this->_input_check("corp_name",array("empty_msg"=>"사업자명을 입력해주세요."));
		$corp_ceo = $this->_input_check("corp_ceo",array("empty_msg"=>"대표자명을 입력해주세요."));
		$corp_account_bank_name = $this->_input_check("corp_account_bank_name",array("empty_msg"=>"은행명을 입력해주세요."));
		$corp_account_owner = $this->_input_check("corp_account_owner",array("empty_msg"=>"계좌주를 입력해주세요."));
		$corp_account_bank_number = $this->_input_check("corp_account_bank_number",array("empty_msg"=>"계좌번호를 입력해주세요."));
		$corp_reg_no = $this->_input_check("corp_reg_no",array("empty_msg"=>"사업자 등록번호를 입력해주세요."));
		$account_fee = $this->_input_check("account_fee",array("empty_msg"=>"정산 수수료를 입력해주세요."));
		$corp_state = $this->_input_check("corp_state",array());
		$corp_addr = $this->_input_check("corp_addr",array("empty_msg"=>"주소를 입력해주세요."));
		$corp_addr_detail = $this->_input_check("corp_addr_detail",array("empty_msg"=>"주소 상세를 입력해주세요."));
		$corp_addr_postcode = $this->_input_check("corp_addr_postcode",array());
		$corp_lat = $this->_input_check("corp_lat",array());
		$corp_lng = $this->_input_check("corp_lng",array());

		$data['corp_idx'] = $corp_idx;
		$data['corp_worker'] = $corp_worker;
		$data['corp_name'] = $corp_name;
		$data['corp_ceo'] = $corp_ceo;
		$data['corp_account_bank_name'] = $corp_account_bank_name;
		$data['corp_account_owner'] = $corp_account_owner;
		$data['corp_account_bank_number'] = $corp_account_bank_number;
		$data['corp_reg_no'] = $corp_reg_no;
		$data['account_fee'] = $account_fee;
		$data['corp_state'] = $corp_state;

		$data['corp_addr'] = $corp_addr;
		$data['corp_addr_detail'] = $corp_addr_detail;
		$data['corp_addr_postcode'] = $corp_addr_postcode;
		$data['corp_lat'] = $corp_lat;
		$data['corp_lng'] = $corp_lng;


		# model. 기업회원 수정
		$result = $this->model_corp->corp_mod_up($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "수정 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "수정 성공하였습니다.";
		}
		echo json_encode($response);
		exit;
	}

	// 회원 상태 변경
	public function member_state_mod_up(){

		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$member_state = $this->_input_check("member_state",array());
		
		$data['member_idx']  = $member_idx;
		$data['member_state'] = $member_state;

		$result = $this->model_member->member_state_mod_up($data);

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

	//회원 상태 - 이용정지
	public function del_yn_mod_up(){
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"키 누락"));
		$del_yn = $this->_input_check("del_yn",array("empty_msg"=>"yn 누락"));
		$member_state = $this->_input_check("member_state",array("empty_msg"=>"yn 누락"));

		$data['member_idx'] = $member_idx;
		$data['del_yn'] = $del_yn;
		$data['member_state'] = $member_state;

		$result = $this->model_member->del_yn_mod_up($data);

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


	

}
