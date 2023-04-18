<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2022-01-12
| Memo : 이용내역(헬퍼)
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

class Corp_order_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    $this->load->model('corp_order_v_1_0_0/model_order');

	}

 
  // 미션 리스트
  public function corp_order_list(){
    header('Content-Type: application/json');

    $member_idx = $this->_input_check("member_idx",array());
    $order_state = $this->_input_check("order_state",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

    $data['member_idx'] = $member_idx;
    $data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		$data['order_state'] = $order_state;

    $result_list = $this->model_order->order_list($data);
    $result_list_count = $this->model_order->order_list_count($data);


		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
      $data_array[$x]['order_idx']	= $row->order_idx;
      $data_array[$x]['order_number']	= $row->order_number;
      $data_array[$x]['order_type']	= $row->order_type;
      $data_array[$x]['order_id']	= $row->order_id;       
      $data_array[$x]['order_name']	= $row->order_name;       
      $data_array[$x]['order_nickname']	= $row->order_nickname;  
      $data_array[$x]['d_min']	= $row->d_min;  
      $data_array[$x]['order_title']	= $row->order_title;  
      $data_array[$x]['pay_price']	= $row->pay_price;  
      $data_array[$x]['choice_yn']	= $row->choice_yn;  
      $data_array[$x]['cancel_yn']	= $row->cancel_yn;  
      $data_array[$x]['ins_date']	= $row->ins_date;  
			$x++;
		}

    $response = new stdClass();

    if($x==0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('2000');
      
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->list_cnt = $x;
			$response->total_cnt = (int)$result_list_count;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->page_num = (int)$page_num;
      $response->total_page =	$total_page;
			$response->list_cnt = $x;
			$response->total_cnt = (int)$result_list_count;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
    echo json_encode($response);
		exit;
  }

  // 요청 상세
  public function corp_order_detail(){
    header('Content-Type: application/json');

    $order_idx = $this->_input_check("order_idx",array("empty_msg"=>'미션 키가 누락되었습니다.'));

    $data['order_idx'] = $order_idx;

    $result = $this->model_order->order_detail($data); // 미션 정보

    $response = new stdClass();


		if(empty($result)){
			$response->code = "-2"; //조회된 값이 없음
			$response->code_msg = $this->global_msg->code_msg('-2');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->order_idx = $result->order_idx;
			$response->order_state = $result->order_state;
			$response->order_number = $result->order_number;
			$response->order_type = $result->order_type;
      $response->deposite_date = $this->global_function->date_ymd_comma($result->deposite_date);
      $response->ins_date = $this->global_function->date_ymd_comma($result->ins_date);
      $response->service_hope_date = $this->global_function->date_ymd_comma($result->service_hope_date);
      $response->order_start_date = $this->global_function->date_ymd_comma($result->order_start_date);
      $response->order_end_date = $this->global_function->date_ymd_comma($result->order_end_date);
      $response->cancel_date = $this->global_function->date_ymd_comma($result->cancel_date);
			$response->order_title = $result->order_title;
			$response->order_msg = $result->order_msg;
			$response->cancel_reason = $result->cancel_reason;
			$response->cancel_type = $result->cancel_type;
			$response->buy_confirm_yn = $result->buy_confirm_yn;
			$response->buy_confirm_date = $result->buy_confirm_date;
			$response->pay_price = $result->pay_price;
      $response->account_fee = $result->account_fee;
      $response->account_price = $result->account_price;
      $response->chatting_room_idx = $result->chatting_room_idx;
      $response->img_paths = $result->img_paths;
      $response->d_min = $result->d_min;
      $response->accept_yn = $result->accept_yn;
      $response->member_idx = $result->member_idx;
      $response->member_nickname = $result->member_nickname;
      $response->order_progressing_cnt = $result->order_progressing_cnt;
      $response->order_end_cnt = $result->order_end_cnt;
      $response->order_apply_idx = $result->order_apply_idx;
      $response->choice_yn = $result->choice_yn;
      $response->apply_cancel_yn = $result->apply_cancel_yn;
    }
  echo json_encode($response);
  exit;
  }


    // 미션 지원 취소
    public function order_apply_cancel_mod_up(){
      header('Content-Type: application/json');

      $order_apply_idx = $this->_input_check("order_apply_idx",array("empty_msg"=>'지원 키가 누락되었습니다.'));
      $order_idx = $this->_input_check("order_idx",array("empty_msg"=>'주문서키가 누락되었습니다.'));
  
      $data['order_idx'] = $order_idx;
      $data['order_apply_idx'] = $order_apply_idx;
  
      $result = $this->model_order->order_apply_cancel_mod_up($data); // 미션 지원
  
      $response = new stdClass();
  
      if($result == '0') {
        $response->code = "0";
        $response->code_msg = "문제가 발생하였습니다. 관리자에게 문의해주세요.";
      } else{
        $response->code = "1";
        $response->code_msg = "지원 취소 되었습니다.";
      }
  
      echo json_encode($response);
      exit;
    }
  
  
    // 미션 취소
    public function order_cancel_mod_up(){
      header('Content-Type: application/json');

      $order_idx = $this->_input_check("order_idx",array("empty_msg"=>'주문서키가 누락되었습니다.'));
  
      $data['order_idx'] = $order_idx;
  
      $result = $this->model_order->order_cancel_mod_up($data); // 미션 지원
  
      $response = new stdClass();
  
      if($result == '0') {
        $response->code = "0";
        $response->code_msg = "문제가 발생하였습니다. 관리자에게 문의해주세요.";
      } else{
        $response->code = "1";
        $response->code_msg = "미션취소요청 되었습니다.";
      }
  
      echo json_encode($response);
      exit;
    }
  
  
    // 미션 시작
    public function order_start_mod_up(){
      header('Content-Type: application/json');

      $order_idx = $this->_input_check("order_idx",array("empty_msg"=>'주문서키가 누락되었습니다.'));
      
      $data['order_idx'] = $order_idx;
  
      $result = $this->model_order->order_start_mod_up($data); // 미션 지원
  
      $response = new stdClass();
  
      if($result == '0') {
        $response->code = "0";
        $response->code_msg = "문제가 발생하였습니다. 관리자에게 문의해주세요.";
      } else{
        $response->code = "1";
        $response->code_msg = " 미션 시작 되었습니다.";
      }
  
      echo json_encode($response);
      exit;
    }
  
  
    // 미션 완료
    public function order_end_mod_up(){
      header('Content-Type: application/json');

      $order_idx = $this->_input_check("order_idx",array("empty_msg"=>'주문서키가 누락되었습니다.'));
      
      $data['order_idx'] = $order_idx;
  
      $result = $this->model_order->order_end_mod_up($data); // 미션 종료
  
      $response = new stdClass();
  
      if($result == '0') {
        $response->code = "0";
        $response->code_msg = "문제가 발생하였습니다. 관리자에게 문의해주세요.";
      } else{
        $response->code = "1";
        $response->code_msg = " 미션 종료 되었습니다.";
      }
  
      echo json_encode($response);
      exit;
    }
}// 클래스의 끝
?>