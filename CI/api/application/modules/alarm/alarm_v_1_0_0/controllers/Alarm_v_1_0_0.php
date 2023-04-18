<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김민정
| Create-Date : 2018-11-22
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

class Alarm_v_1_0_0 extends MY_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('alarm_v_1_0_0/model_alarm');
	}

	// 알림 리스트
  public function alarm_list(){
    header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드가 누락되었습니다."));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));

		$page_size = PAGESIZE;
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$data['member_idx'] = $member_idx;


		$result_list = $this->model_alarm->alarm_list_get($data); // 알림 리스트
		$result_list_count = $this->model_alarm->alarm_list_count($data); // 알림 리스트 카운트

		$total_page = ceil($result_list_count/$page_size);

		$x=0;
		$data_array = array();

		$today = date("Y.m.d");

		foreach($result_list as $row){
      $data_array[$x]['alarm_idx'] = $row->alarm_idx;
			$data_array[$x]['msg'] = $row->msg;
			$data_array[$x]['read_yn'] = $row->read_yn;
			$data_array[$x]['data']	 = json_decode($row->data);
			$data_array[$x]['del_yn'] = $row->del_yn;
			$data_array[$x]['ins_date'] = $row->ins_date;
			$data_array[$x]['ins_date'] = $this->global_function->date_Ymd_comma($row->ins_date);
		$x++;
		}

		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
  }

	// 새로온 알림 카운트
	public function new_alarm_count(){
		header('Content-Type: application/json');

    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드가 누락되었습니다."));

		$data['member_idx'] = $member_idx;

		$result = $this->model_alarm->new_alarm_count($data); //새로온 알림 카운트

		$response = new stdClass();
		$response->code = "1000";
		$response->code_msg = $this->global_msg->code_msg('1000');
		$response->new_alarm_conut = $result;
		echo json_encode($response);
		exit;
	}

	// 알람 설정보기
  public function alarm_toggle_view(){
    header('Content-Type: application/json');

    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드가 누락되었습니다."));

    $data['member_idx'] = $member_idx;

    $result = $this->model_alarm->alarm_toggle_view($data); //알람 설정보기

		$response = new stdClass();

		if(count($result)==0){
			$response->code = "-2"; //조회된 값이 없음
			$response->code_msg = $this->global_msg->code_msg('-2');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->bike_alarm_yn = $result->bike_alarm_yn;
			$response->timeline_alarm_yn = $result->timeline_alarm_yn;
			$response->follow_alarm_yn = $result->follow_alarm_yn;
		}

		echo json_encode($response);
		exit;
  }

	// 알람 설정
	public function alarm_toggle(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드가 누락되었습니다."));
    $alarm_yn = $this->_input_check("alarm_yn",array("empty_msg"=>"알람정보가 누락되었습니다."));

		$data['member_idx'] = $member_idx;
		$data['alarm_yn'] = $alarm_yn;

		$result = $this->model_alarm->alarm_toggle($data);

		$response = new stdClass;

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}

	// 알림 삭제
	public function alarm_del(){
		header('Content-Type: application/json');
    $alarm_idx = $this->_input_check("alarm_idx",array("empty_msg"=>"알람 코드가 누락되었습니다."));

		$data['alarm_idx'] = $alarm_idx;

		$result = $this->model_alarm->alarm_del($data); // 알림 삭제

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}

	// 알림 삭제
	public function alarm_all_del(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드가 누락되었습니다."));

		$data['member_idx'] = $member_idx;

		$result = $this->model_alarm->alarm_all_del($data); // 알림 삭제

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}

	// 알림 삭제
	public function alarm_reg_in(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 코드가 누락되었습니다."));
		$title = $this->_input_check("title",array("empty_msg"=>"제목이 누락되었습니다."));
		$index = $this->_input_check("index",array("empty_msg"=>"index가 누락되었습니다."));

		$alarm_data['title'] = $title;
		$member_idx = $member_idx;
		$this->_alarm_action2($member_idx,$index, $alarm_data);

		$response->code = "1000";
		$response->code_msg = $this->global_msg->code_msg('1000');

		echo json_encode($response);
		exit;
	}


}
