<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2020-05-11
| Memo : inApp 결제 모듈화
|------------------------------------------------------------------------
*/

class Payment_in_app extends MY_Controller {

  function __construct(){
    parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('global_function');

    $this->load->model('payment_in_app/model_payment_in_app');
  }

  // 결제끝
  public function order_end() {

    $pg_price = $this->_input_check("pg_price",array());
    $order_number = $this->_input_check("order_number",array());
    $payment_code = $this->_input_check("payment_code",array());

    $data['pg_price'] = $pg_price;
    $data['order_number'] = $order_number;
    $data['payment_code'] = $payment_code;

    if($payment_code=='I'){
      $data['pg_fee_rate'] = 30;//결제 수수료
    }else{
      $data['pg_fee_rate'] = 30;//결제 수수료
    }

    $result = $this->model_payment_in_app->order_end($data);

    if($result == '0') {

      $response = new stdClass;
      $response->code = "-1"; //저장에 실패 하였습니다.
      $response->code_msg =$this->global_msg->code_msg('-1');

      echo json_encode($response);
      exit;

    } else if($result == '1') {

      $response = new stdClass;
      $response->code = "1000"; //성공
      $response->code_msg =$this->global_msg->code_msg('1000');

      echo json_encode($response);
      exit;
    }

  }
} // 클래스의 끝
?>
