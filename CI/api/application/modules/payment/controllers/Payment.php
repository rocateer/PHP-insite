<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2017-10-16
| Memo : 결제 모듈화 1: tpay
|------------------------------------------------------------------------
*/

class Payment extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('payment/model_payment');
  }

  // 결제시작
  public function order_start() {

    // header('Content-Type: application/json');
    $pg_gate = ($this->input->get("pg_gate", TRUE) != "")	?	$this->_escstr($this->input->get("pg_gate", TRUE)) : "";
    $order_number = ($this->input->get("order_number", TRUE) != "")	?	$this->_escstr($this->input->get("order_number", TRUE)) : "";

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
      case 'bank':
        $pg_url = '/pg_bank';
        break;
      case 'nice':
        $pg_url = '/pg_nice';
        break;  
    }

    $result = $this->model_payment->order_detail($data); //주문 상세보기

    $this->_view("payment/view_order_start",array("result"=>$result,"pg_url"=>$pg_url));
  } // end chk_rural_region

  // 결제끝
  public function order_end() {
    $pg_date = ($this->input->post("pg_date", TRUE) != "")	?	$this->_escstr($this->input->post("pg_date", TRUE)) : "";
    $pg_price = ($this->input->post("pg_price", TRUE) != "")	?	$this->_escstr($this->input->post("pg_price", TRUE)) : ""; // PG 사 암호화된 상품가격
    $pg_tid = ($this->input->post("pg_tid", TRUE) != "")	?	$this->_escstr($this->input->post("pg_tid", TRUE)) : "";
    $pg_type = ($this->input->post("pg_type", TRUE) != "")	?	$this->_escstr($this->input->post("pg_type", TRUE)) : "";
    $pg_result = ($this->input->post("pg_result", TRUE) != "")	?	$this->_escstr($this->input->post("pg_result", TRUE)) : "";
    $order_number = ($this->input->post("order_number", TRUE) != "")	?	$this->_escstr($this->input->post("order_number", TRUE)) : "";
    $payment_code = ($this->input->post("payment_code", TRUE) != "")	?	$this->_escstr($this->input->post("payment_code", TRUE)) : "";

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

    $this->_view("payment/view_order_end",array("agent" => $agent,"pg_date" => $pg_date,"pg_price" => $pg_price,"pg_type" => $pg_type,"pg_result" => $pg_result,"order_number" => $order_number));
  }
} // 클래스의 끝
?>
