<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-12
| Memo : 앱 시작시 팝업
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

class Start_popup_v_1_0_0 extends MY_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('start_popup_v_1_0_0/model_start_popup');
	}

  // 앱시작 팝업 보기
  public function start_popup_detail(){
    header('Content-Type: application/json');

		$result=$this->model_start_popup->start_popup_detail();// 앱시작 팝업 보기

		if(count($result)==0){
			$response = new stdClass;
			$response->code = "-2";
			$response->code_msg = $this->global_msg->code_msg('-2');

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->title = $result->title;
			$response->contents = $result->contents;
			$response->img_path = $result->img_path;

			$response->link_url = $result->link_url;

			echo json_encode($response);
			exit;
		}
  }


	// 앱시작 팝업 보기
	public function start_popup_list(){
    header('Content-Type: application/json');
	  $device_os = $this->_input_check('device_os', array());

		$data['device_os'] = $device_os;

		$result_list = $this->model_start_popup->start_popup_list($data);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['start_popup_idx']	= $row->start_popup_idx;
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['link_url']	= $row->link_url;
			$data_array[$x]['contents']	= $row->contents;
			$data_array[$x]['img_path']	= $row->img_path;
		  $x++;
		}

		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
	}

}
