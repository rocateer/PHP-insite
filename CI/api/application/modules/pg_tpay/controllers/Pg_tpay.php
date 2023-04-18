<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	홍창규
| Create-Date : 2017-09-27
| Memo : PG 결제 (WebView)
|------------------------------------------------------------------------
*/

class Pg_tpay extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('global_function');
		require_once APPPATH.'/libraries/TPAY.LIB.php';
   // 	$this->load->library('TPAY.LIB');

	  // Real
		define("MID",	"hjc000001m");	// 상점키
    define("MERCHANTKEY",	"yoPaRhXyxb1+YWbfy49FmcYWQqkORTUa+jZB4vmB6FRXkzY/LjItE2qjm70BjG+59QR6f2YjVSIkxktyv4FNhQ==");

		// Test
		// define("MID",	"tpaytest0m");	 		// 상점키
		// define("MERCHANTKEY",	"VXFVMIZGqUJx29I/k52vMM8XG4hizkNfiapAkHHFxq0RwFzPit55D3J3sAeFSrLuOnLNVCIsXXkcBfYK1wv8kQ==");

    // $this->load->model('notice/model_notice');
	}

	public function index() {

		$this->mainPay();
	}

//tPay Main
  public function mainPay() {

		$moid = $_POST['order_no'];
		$amt = $_POST['product_price'];

		$order_data = array(
				'amt'	=> $amt,
				'moid'	=> $moid
		);

		$this->session->set_userdata($order_data);

	 $this->_view("pg_tpay/mainPay",array());

  }


	public function returnPay() {

		$payMethod = $_POST['payMethod'];
		$mid = $_POST['mid'];
		$tid = $_POST['tid'];
		$mallUserId = $_POST['mallUserId'];
		$amt = $_POST['amt'];
		$buyerName = $_POST['buyerName'];
		$buyerTel = $_POST['buyerTel'];
		$buyerEmail = $_POST['buyerEmail'];
		$mallReserved = $_POST['mallReserved'];
		$goodsName = $_POST['goodsName'];
		$moid = $_POST['moid'];
		$authDate = $_POST['authDate'];
		$authCode = $_POST['authCode'];
		$fnCd = $_POST['fnCd'];
		$fnName = $_POST['fnName'];
		$resultCd = $_POST['resultCd'];
		$resultMsg = $_POST['resultMsg'];
		//$errorCd = $_POST['errorCd'];
		//$errorMsg = $_POST['errorMsg'];
		$vbankNum = $_POST['vbankNum'];
		$vbankExpDate = $_POST['vbankExpDate'];
		$ediDate = $_POST['ediDate'];
		// $appPrefix = $_POST['appPrefix'];

		// var_dump($payMethod);// CARD
		// var_dump($mid); // hjc000001m
		// var_dump($tid); //hjc000001m0125171114191395734
		// var_dump($mallUserId); //8306
		// var_dump($buyerName); //진하늘
		// var_dump($buyerTel); //01029543982
		// var_dump($buyerEmail); //test@test.common
		// var_dump($mallReserved); //mallReserved
		// var_dump($goodsName); //천원상품
		// var_dump($moid); // #$%@#$#@!$
		// var_dump($authDate); //171114191218
		// var_dump($authCode); //62786030
		// var_dump($fnCd); // 01
		// var_dump($fnName); // ""
		// var_dump($resultCd); //3001
		// var_dump($resultMsg); //카드 결제 성공
		// var_dump($vbankNum); // ""
		// var_dump($vbankExpDate); //20171115
		// var_dump($ediDate); //20171114191220
		// exit;

		//회원사 DB에 저장되어있던 값

		$amtDb = $this->session->userdata('amt');						  //금액
		$moidDb =  $this->session->userdata('moid');					//moid
		$mKey = MERCHANTKEY;			//상점키

		$encryptor = new Encryptor($mKey, $ediDate);
		$decAmt = $encryptor->decData($amt);
		$decMoid = $encryptor->decData($moid);

		//echo "</p>";
		//echo " 금액:".$amtDb."</p>";
		//echo " 주문번호:".$moidDb."</p>";

		if( $decAmt != $amtDb || $decMoid != $moidDb ){
			echo "위변조 데이터를 오류입니다.";
			$_POST['pg_result']="FAIL";
		} else {
			//결제결과 수신 여부 알림
			ResultConfirm::send($tid, "000");
			//DB처리
			$_POST['pg_result'] = "SUCCESS";
		}

		$this->_view("pg_tpay/returnPay",array());

	}

}

?>
