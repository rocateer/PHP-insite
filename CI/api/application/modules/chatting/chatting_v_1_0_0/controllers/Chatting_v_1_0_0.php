<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-11-05
| Memo : 자유 게시판 관리
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

class Chatting_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

		$this->load->model('chatting_v_1_0_0/model_chatting');
	}


	// 1-1.  리스트
	public function chatting_list(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check('user_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"user_idx"));
		$chatting_room_idx = $this->_input_check('chatting_room_idx',array("empty_msg"=>"채팅방키을 입력해주세요.","focus_id"=>"chatting_room_idx"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = 4;

		$data['member_idx'] = $member_idx;
		$data['chatting_room_idx'] = $chatting_room_idx;
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result = $this->model_chatting->chatting_room_detail($data);//model 1.  리스트
		$result_list = $this->model_chatting->chatting_list($data);//model 1.  리스트
		$result_list_count = $this->model_chatting->chatting_list_count($data);//model 1-1.  리스트 총 카운트

		$total_page = ceil($result_list_count/$page_size);

		$x =count($result_list);
		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $result_list;
			$response->state = $result->state;

		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $result_list;
			$response->state = $result->state;
    }
		echo json_encode($response);
		exit;
  }

		// 등록
	public function chatting_reg_in(){
		header('Content-Type: application/json');
    $response = new stdClass();

		$member_idx = $this->_input_check('user_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"user_idx"));
		$chatting_room_idx = $this->_input_check('chatting_room_idx',array("empty_msg"=>"채팅방키을 입력해주세요.","focus_id"=>"chatting_room_idx"));
		$img_path = $this->_input_check('img_path',array());
		$comment = $this->_input_check('comment',array());

		$data['member_idx'] = $member_idx;
    $data['chatting_room_idx'] = $chatting_room_idx;
    $data['img_path'] = $img_path;
    $data['comment'] = $comment;

    $check = $this->model_chatting->chatting_room_detail($data);//
		if(count($check) < 1){
			$response->code = "-1";
			$response->code_msg = "잘못된 경로 입니다.";
			echo json_encode($response);
			exit;
		}

		if($check->state == 2 ){
			$response->code = "-2";
			$response->code_msg = "상대방이 채팅방을 종료되었습니다.";

			echo json_encode($response);
			exit;
		}

		if($img_path =="" && $comment ==""){
			$response->code = "-1";
			$response->code_msg = "이미지나 내용을 등록하셔야 합니다.";
			echo json_encode($response);
			exit;
		}


		$result = $this->model_chatting->chatting_reg_in($data);//

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{

			if($img_path !="" && $comment ==""){
					$comment ="사진을 보냈습니다";
			}

			 //알림발송(205)
			 $check =$this->model_chatting->chatting_room_detail($data);

			 $index="900";
       $alarm_data['order_schedule_idx'] = $check->order_schedule_idx;
       $alarm_data['chatting_room_idx'] = $chatting_room_idx;

			 $corp_idx = $check->partner_member_idx;
			 $member_idx=0;

 			$this->_alarm_action($member_idx,$corp_idx,$index, $alarm_data);

			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
    }
		echo json_encode($response);
		exit;
	}

	// new 표시
	public function member_read_count() {
		header('Content-Type: application/json');
		$response = new stdClass;

		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원키가 누락되었습니다."));

		$data['member_idx'] = $member_idx;

		$check=$this->model_chatting->member_read_count($data);

		$response->code = "1000";
		$response->code_msg = $this->global_msg->code_msg('1000');
		$response->not_read_cnt = $check;
		$response->red_dot_yn = ($check>0)? "Y":"N";

		echo json_encode($response);
		exit;
	}



}	//클래스의 끝
?>
