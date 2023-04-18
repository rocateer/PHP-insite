<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2022-01-13
| Memo : 이용내역(사용자)
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

class My_order_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    $this->load->model('my_order_v_1_0_0/model_my_order');
	}


  // 미션 리스트
  public function my_order_list(){
    header('Content-Type: application/json');

    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>'주문서키가 누락되었습니다.'));
    $order_state = $this->_input_check("order_state",array("empty_msg"=>'주문서키가 누락되었습니다.'));
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

    $data['member_idx'] = $member_idx;
		$data['order_state'] = $order_state;
    $data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

    $result_list = $this->model_my_order->my_order_list($data);
    $result_list_count = $this->model_my_order->my_order_list_count($data);

		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
      $data_array[$x]['order_idx']	= $row->order_idx;
      $data_array[$x]['order_number']	= $row->order_number;
      $data_array[$x]['order_type']	= $row->order_type;
      $data_array[$x]['order_state']	= $row->order_state;       
      $data_array[$x]['corp_id']	= $row->corp_id;       
      $data_array[$x]['corp_nickname']	= $row->corp_nickname;  
      $data_array[$x]['corp_img']	= $row->corp_img;  
      $data_array[$x]['d_min']	= $row->d_min;  
      $data_array[$x]['apply_cnt']	= $row->apply_cnt;  
      $data_array[$x]['order_title']	= $row->order_title;  
      $data_array[$x]['order_msg']	= $row->order_msg;  
      $data_array[$x]['service_hope_date']	= $row->service_hope_date;  
      $data_array[$x]['cancel_type']	= $row->cancel_type;  
      $data_array[$x]['pay_price']	= $row->pay_price;  
      $data_array[$x]['ins_date']	= $row->ins_date;  
			$x++;
		}

    $response = new stdClass();

    if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
      
			$response->page_num = (int)$page_num;			
      $response->total_cnt = (int)$result_list_count;
			$response->total_page =	$total_page;
      
			$response->list_cnt = $x;
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


  // 미션 상세
  public function order_detail(){
    header('Content-Type: application/json');

    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>'주문서키가 누락되었습니다.'));
    $order_idx = $this->_input_check("order_idx",array("empty_msg"=>'주문서키가 누락되었습니다.'));

    $data['member_idx'] = $member_idx;
    $data['order_idx'] = $order_idx;

    $result = $this->model_my_order->order_detail($data); // 미션 정보
    $result_list = $this->model_my_order->apply_list($data); //신청자 리스트

    $response = new stdClass();

		if(empty($result)){
			$response->code = "-2"; //조회된 값이 없음
			$response->code_msg = $this->global_msg->code_msg('-2');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->corp_idx = $result->corp_idx;
			$response->order_idx = $result->order_idx;
			$response->order_state = $result->order_state;
			$response->order_number = $result->order_number;
			$response->order_type = $result->order_type;
			$response->buy_confirm_yn = $result->buy_confirm_yn;
      $response->service_hope_date = $this->global_function->date_ymd_comma($result->service_hope_date);
			$response->pay_price = $result->pay_price;
			$response->order_title = $result->order_title;
			$response->order_msg = $result->order_msg;
			$response->img_paths = $result->img_paths;
			$response->accept_yn = $result->accept_yn;
			$response->member_idx = $result->member_idx;
			$response->member_nickname = $result->member_nickname;
      $response->order_progressing_cnt = $result->order_progressing_cnt;
      $response->order_end_cnt = $result->order_end_cnt;

      $response->btn_cancal_yn = ($result->order_state=="0" ) ? "Y" :"N" ;
      $response->btn_corder_confirm_yn = ($result->order_state=="3" && $result->buy_confirm_yn=="N" ) ? "Y" :"N" ;
      $response->btn_review_yn = ($result->order_state=="3" && $result->buy_confirm_yn=="Y" ) ? "Y" :"N" ;


      $x = 0;
      $data_array = array();  
      foreach($result_list as $row){
        $data_array[$x]['order_idx']	= $row->order_idx;
        $data_array[$x]['apply_msg']	= $row->apply_msg;  
        $data_array[$x]['btn_choice_yn']	=($result->order_state=="0" && $row->cancel_yn=="N" ) ? "Y" :"N" ;
        
        $data_array[$x]['corp_idx']	= $row->corp_idx;
        $data_array[$x]['member_idx']	= $row->member_idx;
        $data_array[$x]['member_img']	= $row->member_img;
        $data_array[$x]['member_nickname']	= $row->member_nickname;
        $data_array[$x]['helper_review_star']	= $row->helper_review_star;
        $data_array[$x]['helper_order_end_cnt']	= $row->helper_order_end_cnt;

        $x++;
      }

      $response->apply_list_cnt = $x;
      $response->apply_list_data_array = $data_array;
    }
  echo json_encode($response);
  exit;
  }


  // 미션 취소
  public function order_cancel_mod_up(){
    $order_idx = $this->_input_check("order_idx",array());
    $cancel_reason = $this->_input_check("cancel_reason",array("empty_msg"=>"취소 사유를 입력해 주세요."));

    $data['order_idx'] = $order_idx;
    $data['cancel_reason'] = $cancel_reason;

    // 취소
    // $pg = $this->pg_function->pg_cancel($order_detail->payment_order_number, $order_detail->pg_tid, $order_detail->product_price, "12시간 이전 멘티 취소");
    // if($pg['pg_result'] !="Y"){
    //   $response = new stdClass();
    //   $response->code = "-1";
    //   $response->code_msg = "[실패사유]".$pg['message'];
    //   echo json_encode($response);
    //   exit;
    // }

    $result = $this->model_my_order->order_cancel_mod_up($data); // 미션 취소

    $response = new stdClass();

    if($result == 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('1');
    } else {
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
    }

    echo json_encode($response);
    exit;

  }


  // 미션 완료확인
  public function order_confirm_mod_up(){
    $response = new stdClass();
    $order_idx = $this->_input_check("order_idx",array());

    $data['order_idx'] = $order_idx;

    // $check = $this->model_my_order->order_summary($data); // 미션 취소

    // if(empty($check)){
    //   $response->code = '-1';
    //   $response->code_msg = '조회한 주문이 없습니다.';
    //   echo json_encode($response);
    //   exit;
    // }


    // if($check->order_state=="3" && $check->buy_confirm_yn=="N"){

    // }else{
    //   $response->code = '-1';
    //   $response->code_msg = '잘못된 상태입니다.';
    //   echo json_encode($response);
    //   exit;
    // }

    
    $result = $this->model_my_order->order_confirm_mod_up($data);


    if($result == 0){
      $response->code = "-1";
      $response->code_msg = $this->global_msg->code_msg('1');
    } else {

      if($result == -2){
        $response->code = '-1';
        $response->code_msg = '조회한 주문이 없습니다';
      }

      if($result == -3){
        $response->code = '-1';
        $response->code_msg = '잘못된 상태입니다';
      }

      if($result == 1){
        $response->code = "1000";
        $response->code_msg = $this->global_msg->code_msg('1000');
      }

    }

    echo json_encode($response);
    exit;

  }



  // 헬퍼 선정
  public function order_corp_mod_up(){
    $order_idx = $this->_input_check("order_idx",array("empty_msg"=>"미션키 누락"));
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"헬퍼키 누락"));

    $data['order_idx'] = $order_idx;
    $data['member_idx'] = $member_idx;

    $response = new stdClass();

    $result = $this->model_my_order->order_corp_mod_up($data); // 헬퍼 선정

    if($result == 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
    } else {
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
    }

    echo json_encode($response);
    exit;

  }
}// 클래스의 끝
?>