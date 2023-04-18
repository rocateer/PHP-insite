<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
| Memo : 알람
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

class Alarm_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		if(!$this->session->userdata("member_idx") ){
			redirect("/".mapping('login')."?return_url=/".mapping('alarm'));
			exit;
		}

		$this->load->model(mapping('alarm').'/model_alarm');
	}

	//인덱스
  public function index() {
    $this->alarm_list();
  }

	//메인 화면
  public function alarm_list(){
		$this->_view2(mapping('alarm').'/view_alarm_list');
  }

	//메인 화면
  public function alarm_setting(){
		$member_idx = $this->member_idx;

		$data['member_idx'] = $member_idx;

		$result = $this->model_alarm->alarm_toggle_view($data);

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('alarm').'/view_alarm_setting',$response);
  }

	//알람리스트
	public function alarm_list_get(){

    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$alarm_list = $this->model_alarm->alarm_list($data); //  알람리스트
		$alarm_list_count = $this->model_alarm->alarm_list_count(); //  알람리스트
    $no = $alarm_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($alarm_list_count, $page_size, $page_num);

		$response = new stdClass();

		$response->alarm_list = $alarm_list;
    $response->alarm_list_count = $alarm_list_count;
    $response->total_block = ceil($alarm_list_count/$page_size);

		$this->_list_view(mapping('alarm').'/view_alarm_list_get',$response);
	}

  //변경
	public function all_alarm_yn_mod_up(){
		$response = new stdClass();

	  $type = $this->_input_check("type",array());
	  $alarm_yn = $this->_input_check("alarm_yn",array());
	  $member_idx = $this->member_idx;

		$data['type'] = $type;
		$data['alarm_yn'] = $alarm_yn;
		$data['member_idx'] = $member_idx;

		$result = $this->model_alarm->all_alarm_yn_mod_up($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "오류를 발생하였습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "정상적으로 처리되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

  //알림 시간등록
	public function alarm_reg_in(){
		$response = new stdClass();

	  $alarm_hour = $this->_input_check("alarm_hour",array());
	  $alarm_min = $this->_input_check("alarm_min",array());
	  $member_idx = $this->member_idx;

		$data['excercise_alarm_time'] = sprintf('%02d',$alarm_hour).':'.sprintf('%02d',$alarm_min);
		$data['member_idx'] = $member_idx;

		$result = $this->model_alarm->alarm_reg_in($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "오류를 발생하였습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "저장되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

  //삭제하기
	public function alarm_del(){
		$response = new stdClass();

	  $alarm_idx = $this->_input_check("alarm_idx",array());

		$data['alarm_idx'] = $alarm_idx;

		$result = $this->model_alarm->alarm_del($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "오류를 발생하였습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "정상적으로 처리되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

  //삭제하기
	public function all_alarm_del(){
		$response = new stdClass();

		$result = $this->model_alarm->all_alarm_del();

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "오류를 발생하였습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "정상적으로 처리되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

	public function alarm_read_mod_up(){
		header('Content-Type: application/json');

		$alarm_idx = $this->_input_check("alarm_idx",array("empty_msg"=>"코드가 누락되었습니다."));

		$data['alarm_idx'] = $alarm_idx;

		$result = $this->model_alarm->alarm_read_mod_up($data); //새로온 알림 카운트

		$response = new stdClass();

		$response->code = "1000";
		$response->code_msg = "";

		echo json_encode($response);
		exit;
	}
}// 클래스의 끝
