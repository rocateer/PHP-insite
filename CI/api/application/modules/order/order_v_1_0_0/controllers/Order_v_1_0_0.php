<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2020-05-11
| Memo : 주문 하기
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
class Order_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('order_v_1_0_0/model_order');

  }

	  //주문번호
	function set_reserve_no($str,$length) {
		$characters  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rendom_str = "";
		$loopNum = $length;
		while ($loopNum--) {
			$rendom_str .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $str.$rendom_str;
	}

  /*
  |------------------------------------------------------------------------
  | Memo : 장바구니구매
  |------------------------------------------------------------------------
  */


  // 주문서 폼
  public function	order_form(){
    header('Content-Type: application/json');
    $response = new stdClass;

    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>" 회원키를 입력해주세요."));
    $corp_idx = $this->_input_check("corp_idx",array("empty_msg"=>" 셀럽키를 입력해주세요."));
    $product_type = $this->_input_check("product_type",array("empty_msg"=>" 상품타입을 입력해주세요."));
    $product_price = $this->_input_check("product_price",array("empty_msg"=>" 결제금액을 입력해주세요."));

    if($product_price<10000){
      $response->code = "-1"; //성공
      $response->code_msg = "결제금액은 1만원이상 이어야 합니다.";
      echo json_encode($response);
      exit;
    }

    $data['member_idx'] = $member_idx;
    $check = $this->model_order->member_info($data);
    if(count($check)<1){
      $response->code = "-1"; //성공
      $response->code_msg = "잘못된 회원키입니다.";
      echo json_encode($response);
      exit;
    }else{
      if($check->del_yn=="P"){
        $response->code = "-1"; //성공
        $response->code_msg = "구매정지회원입니다.";
        echo json_encode($response);
        exit;
      }

    }

    $response->code = "1000"; //성공
    $response->code_msg = "성공";

    echo json_encode($response);
    exit;
  }




// 장바구니구매
  public function	order_reg_in(){
    header('Content-Type: application/json');

    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>" 회원키를 입력해주세요."));
    $corp_idx = $this->_input_check("corp_idx",array("empty_msg"=>" 셀럽키를 입력해주세요."));
    $product_type = $this->_input_check("product_type",array("empty_msg"=>" 상품타입을 입력해주세요."));
    $product_price = $this->_input_check("product_price",array("empty_msg"=>" 결제금액을 입력해주세요."));
    $order_msg = $this->_input_check("order_msg",array("empty_msg"=>" 요청사항을 입력해주세요."));

    $data['member_idx'] = $member_idx;
    $data['corp_idx'] = $corp_idx;
    $data['product_type'] = $product_type;
    $data['product_price'] = $product_price;
		$data['order_msg'] = $order_msg;

    if($product_price<10000){
      $response->code = "-1"; //성공
      $response->code_msg = "결제금액은 1만원이상 이어야 합니다.";
      echo json_encode($response);
      exit;
    }

    $data['member_idx'] = $corp_idx;
    $result = $this->model_order->member_info($data);
    if(count($result)<1){
      $response->code = "-1"; //성공
      $response->code_msg = "잘못된 회원키입니다.";
      echo json_encode($response);
      exit;
    }else{
      if($result->del_yn!="N"){
        $response->code = "-1"; //성공
        $response->code_msg = "활동정지셀럽입니다.";
        echo json_encode($response);
        exit;
      }
    }

    $data['member_idx'] = $member_idx;
    $check = $this->model_order->member_info($data);
    if(count($check)<1){
      $response->code = "-1"; //성공
      $response->code_msg = "잘못된 회원키입니다.";
      echo json_encode($response);
      exit;
    }else{
      if($check->del_yn=="P"){
        $response->code = "-1"; //성공
        $response->code_msg = "구매정지회원입니다.";
        echo json_encode($response);
        exit;
      }
    }

    //정산공식
		$data['account_st_price'] = $product_price;
		$data['account_payment_rate'] = $account_payment_rate =$product_price*.034;
		$data['account_price'] = $this->global_function->get_account_price($product_price);

	  $member_info = $this->model_order->member_info($data);
		$data['order_name'] = $member_info->member_nickname;
		$data['order_tel'] = $member_info->member_tel;
		$data['order_email'] = $member_info->member_email;
		$data['order_id'] = $member_info->member_email;
    $data['corp_name'] = $result->member_nickname;

		$data['order_number'] = $this->set_reserve_no("S_".date('ymd'),9);

    $result = $this->model_order->order_reg_in($data);

    if($result == '0') {

      $response = new stdClass;
      $response->code = "-1"; //저장에 실패 하였습니다.
      $response->code_msg = "저장에 실패 하였습니다.";

      echo json_encode($response);
      exit;

    } else if($result == '1') {

      $response = new stdClass;
      $response->code = "1000"; //성공
      $response->code_msg = "성공";
	    $response->order_number = $data['order_number'];

      echo json_encode($response);
      exit;
    }

  }

  //주문상세
	public function	order_detail(){
    header('Content-Type: application/json');

    $order_number = $this->_input_check("order_number",array("empty_msg"=>" 주문번호키를 입력해주세요."));

    $data['order_number'] = $order_number;

    $result = $this->model_order->order_detail($data);


    if(count($result) <1) {
      $response = new stdClass;
      $response->code = "-1"; //저장에 실패 하였습니다.
      $response->code_msg = "불러오기 실패 하였습니다.";
		      echo json_encode($response);
      exit;
    } else {
      $response = new stdClass;
      $response->code = "1000"; //성공
      $response->code_msg = "성공";

			$response->order_number = $order_number;
			$response->order_idx = $result->order_idx;
			$response->order_date = $result->order_date;
			$response->corp_name = $result->corp_name;
			$response->member_img = $result->member_img ;
      $response->order_state = $result->order_state ;
      $response->member_width = $this->global_function->get_images_width($result->member_img);
      $response->member_height = $this->global_function->get_images_height($result->member_img);
			$response->pay_price = $result->product_price ;

      $response->order_name = $result->order_name;

      echo json_encode($response);
      exit;
    }

  } // end order_view




} // 클래스의 끝
?>
