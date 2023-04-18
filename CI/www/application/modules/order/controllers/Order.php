<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 조다솜
| Create-Date : 2018-10-15
| Memo : 주문/결제
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

class Order extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('order/model_order');

		define("SITE_TYPE","1");//0:관리자,1:웹사아트,2:API
		define("DELIVERY_LIMIT",0);//배송비 제한금액
		define("DELIVERY_PRICE",5000);//배송비
	}

	// 인덱스
  public function index() {
    $this->order_list();
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


	//배송비
	function set_delivery_price($product_price) {
     $rt =0;
		 if($product_price< DELIVERY_LIMIT){
			 $rt = DELIVERY_PRICE;
		 }
		return $rt;
	}


  /*
  |------------------------------------------------------------------------
  | Memo : 바로구매
  |------------------------------------------------------------------------
  */


// 바로구매하기
  public function	direct_order(){
    $cart_session_id = $this->_input_check("cart_session_id",array());

    $data['member_idx'] = $this->member_idx;
    $data['cart_session_id'] = $cart_session_id;


	  $member_info = $this->model_order->member_info($data);

		$data['order_name'] = $member_info->member_name;
		$data['order_tel'] = $member_info->member_tel;
		$data['order_email'] = $member_info->member_email;

		$data['receiver_name'] = $member_info->receiver_name;
		$data['receiver_tel'] = $member_info->receiver_tel;

		$data['receiver_post_number'] = $member_info->receiver_post_number;
		$data['receiver_addr'] = $member_info->receiver_addr;
		$data['receiver_addr_detail'] =  $member_info->receiver_addr_detail;

		$data['order_number'] = $order_number =$this->set_reserve_no("S_".date('ymd'),9);
		$data['site_type'] = SITE_TYPE;

		//배송비
		$data['delivery_price'] = 0;

    $result = $this->model_order->direct_order_reg_in($data);

    redirect("/order/order_reg?order_number=$order_number");
		exit;


  } // end direct_order_reg_in


  /*
  |------------------------------------------------------------------------
  | Memo : 장바구니구매
  |------------------------------------------------------------------------
  */

	// 주문/결제 리스트
  public function order_list(){
    $this->_view('order/view_order_list');
  }

// 장바구니구매
  public function	cart_order_reg_in(){
    $cart_idx = $this->_input_check("cart_idx",array());

    $data['member_idx'] = $this->member_idx;
		$data['cart_idx'] = $cart_idx;

	  $member_info = $this->model_order->member_info($data);
		$data['order_name'] = $member_info->member_name;
		$data['order_tel'] = $member_info->member_tel;
		$data['order_email'] = $member_info->member_email;
		$data['receiver_name'] = $member_info->receiver_name;
		$data['receiver_tel'] = $member_info->receiver_tel;
		$data['receiver_post_number'] = $member_info->receiver_post_number;
		$data['receiver_addr'] = $member_info->receiver_addr;
		$data['receiver_addr_detail'] =  $member_info->receiver_addr_detail;
		$data['order_number'] = $order_number=$this->set_reserve_no("S_".date('ymd'),9);
		$data['site_type'] = SITE_TYPE;

		//배송비
		$data['delivery_price'] = 0;

    $result = $this->model_order->cart_order_reg_in($data);

		redirect("/order/order_reg?order_number=$order_number");
		exit;
  }

  //주문상세
	public function	order_reg(){
    $order_number = $this->_input_check("order_number",array());

		$data['member_idx'] = $this->member_idx;
    $data['order_number'] = $order_number;

    $result = $this->model_order->order_detail($data);

    if(count($result) <1) {
    	$this->global_function->_alert("요청한 데이타가 없습니다.", "/");
    } else {
			$response = new stdClass();

			$response->result = $result;

			$this->_view('order/view_order_reg',$response);
    }

  } // end order_view

	//주문상세
	public function	order_product_list_get(){
    $order_number = $this->_input_check("order_number",array());

		$data['member_idx'] = $this->member_idx;
    $data['order_number'] = $order_number;

	  $result_list = $this->model_order->order_product_list($data);

    if(count($result_list) <1) {
      $response = new stdClass;
      $response->code = "-1"; //저장에 실패 하였습니다.
      $response->code_msg = "불러오기 실패 하였습니다.";
      echo json_encode($response);
      exit;
    } else {
			$response = new stdClass();

			$response->result_list = $result_list;

			$this->_list_view('order/view_order_product_list_get',$response);
    }

  } // end order_view

/*
|------------------------------------------------------------------------
| Memo : 포인트적용
|------------------------------------------------------------------------
*/

	//주문 포인트 적용
	public function	order_point_mod_up(){
    header('Content-Type: application/json');

    $member_idx = ($this->input->post("member_idx", TRUE) != "")	?	$this->_escstr($this->input->post("member_idx", TRUE)) : "";
    $order_number = ($this->input->post("order_number", TRUE) != "")	?	$this->_escstr($this->input->post("order_number", TRUE)) : "";
    $use_point = ($this->input->post("use_point", TRUE) != "")	?	$this->_escstr($this->input->post("use_point", TRUE)) : "";
    $apply_yn = ($this->input->post("apply_yn", TRUE) != "")	?	$this->_escstr($this->input->post("apply_yn", TRUE)) : "";

		$data['member_idx'] =  $this->member_idx;
    $data['order_number'] = $order_number;
    $data['apply_yn'] = $apply_yn;

		if($apply_yn=="Y"){
			$enable_member_point =0;
			$check = $this->model_order->member_point_check($data);
			if(count($check)>0){
				$enable_member_point=$check->enable_point;
			}

			//보유포인트 point

			if($use_point>$enable_member_point){
				$response = new stdClass;
				$response->code = "-1"; //저장에 실패 하였습니다.
				$response->code_msg = "현재 회원님의 사용하고자 포인트는 보유포인트보다 큽니다.";

				echo json_encode($response);
				exit;
			}
			$data['use_point'] = $use_point;
		}else{
			$data['use_point'] = 0;
		}

	  $result = $this->model_order->order_point_mod_up($data);

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

      echo json_encode($response);
      exit;
    }

  } // end 주문 포인트 적용

	/*
	|------------------------------------------------------------------------
	| Memo : 쿠폰적용
	|------------------------------------------------------------------------
	*/
	//주문 쿠폰적용
	public function	order_coupon_mod_up(){
		header('Content-Type: application/json');

	  $order_number = $this->_input_check("order_number",array());
	  $order_idx = $this->_input_check("order_idx",array());
		$member_coupon_idx = $this->_input_check("member_coupon_idx",array());
		$member_coupon_price = $this->_input_check("member_coupon_price",array());

	  $data['member_idx'] = $this->member_idx;
		$data['order_number'] = $order_number;
		$data['order_idx'] = $order_idx;
		$data['member_coupon_idx'] = $member_coupon_idx;
		$data['member_coupon_price'] = $member_coupon_price;

		$result = $this->model_order->order_coupon_mod_up($data);

		if($result == '0') {

			$response = new stdClass;
			$response->code = "-1"; //저장에 실패 하였습니다.
			$response->code_msg = "저장에 실패 하였습니다.";

			echo json_encode($response);
			exit;

		} else {

			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = "성공";

			echo json_encode($response);
			exit;
		}

	} // end 주문 포인트 적용

	/*
	|------------------------------------------------------------------------
	| Memo : 배송지 정보수정
	|------------------------------------------------------------------------
	*/

	//주문 배송지 정보수정
	public function	order_receiver_mod_up(){
		header('Content-Type: application/json');

		$order_number = $this->_input_check("order_number",array());
		$receiver_name = $this->_input_check("receiver_name",array());
		$receiver_tel = $this->_input_check("receiver_tel",array());
		$receiver_post_number = $this->_input_check("receiver_post_number",array());
		$receiver_addr = $this->_input_check("receiver_addr",array());
		$receiver_addr_detail = $this->_input_check("receiver_addr_detail",array());
		$order_msg = $this->_input_check("order_msg",array());

		$data['member_idx'] = $this->member_idx;
		$data['order_number'] = $order_number;
		$data['receiver_name'] = $receiver_name;
		$data['receiver_tel'] = $receiver_tel;
		$data['receiver_post_number'] = $receiver_post_number;
		$data['receiver_addr'] = $receiver_addr;
		$data['receiver_addr_detail'] = $receiver_addr_detail;
		$data['order_msg'] = $order_msg;

		$result = $this->model_order->order_receiver_mod_up($data);

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

			echo json_encode($response);
			exit;
		}

	} // end 주문 포인트 적용


	//주문 배송지 정보수정
	public function	order_pay_mod_up(){
		header('Content-Type: application/json');

		$order_number = $this->_input_check("order_number",array());

		$data['member_idx'] = $this->member_idx;

		$result = $this->model_order->order_pay_mod_up($data);

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

			echo json_encode($response);
			exit;
		}

	} // end 주문 포인트 적용

}// 클래스의 끝
?>
