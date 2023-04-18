<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2017-10-16
| Memo : 결제 모듈화 1: tpay
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

class Payment extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('payment/model_payment');
  }

  // 결제시작
  public function order_start() {
    $pg_gate = $this->_input_check("pg_gate",array());
    $order_number = $this->_input_check("order_number",array());

    $data['order_number'] = $order_number;
    switch ($pg_gate) {
      case 'tpay':
        $pg_url = '/pg_tpay';
        break;
      case 'inicis':
        $pg_url = '/pg_inicis';
        break;
      case 'uplus':
        $pg_url = '/pg_uplus'; //아직 없음
        break;
      case 'danal':
        $pg_url = '/pg_danal'; //아직 없음
        break;
      case 'kcp':
        $pg_url = '/pg_kcp'; //아직 없음
        break;
      case 'billgate':
        $pg_url = '/pg_billgate';
        break;
      case 'iamport':
        $pg_url = '/pg_iamport';
        break;
      case 'nice':
        $pg_url = '/pg_nice';
        break;
    }

    $result = $this->model_payment->order_detail($data); //주문 상세보기

    $response = new stdClass();

    $response->result = $result;
    $response->pg_url = $pg_url;

    $this->_view("payment/view_order_start",$response);
  } // end chk_rural_region

  // 결제끝
  public function order_end() {
    $pg_date = $this->_input_check("pg_date",array());
    $pg_price = $this->_input_check("pg_price",array()); // PG 사 암호화된 상품가격
    $pg_tid = $this->_input_check("pg_tid",array());
    $pg_type = $this->_input_check("pg_type",array());
    $pg_result = $this->_input_check("pg_result",array());
    $order_number = $this->_input_check("order_number",array());
    $payment_code = $this->_input_check("payment_code",array());

    $data['pg_date'] = $pg_date;
    $data['pg_price'] = $pg_price;
    $data['pg_tid'] = $pg_tid;
    $data['pg_type'] = $pg_type;
    $data['pg_result'] = $pg_result;
    $data['order_number'] = $order_number;
    $data['payment_code'] = $payment_code;
    $data['pg_fee_rate'] = 3.65;//결제 수수료

    if($pg_result == 'Y') {
      $result = $this->model_payment->order_end($data);
    }

    $agent = $this->_user_agent();

    $response = new stdClass();

    $response->agent = $agent;
    $response->pg_date = $pg_date;
    $response->pg_price = $pg_price;
    $response->pg_type = $pg_type;
    $response->pg_result = $pg_result;
    $response->order_number = $order_number;

    $this->_view("payment/view_order_end",$response);
  }
} // 클래스의 끝
?>
