<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2018-03-05
| Memo : 빌게이트
|------------------------------------------------------------------------
*/

class Pg_billgate extends MY_Controller {

  function __construct(){
    parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('global_function');

    $this->load->model('pg_billgate/model_pg_billgate');
    /*
    세팅 순서
    1. 모듈 ftp로 upload(log(R),key(R) chmod 777 권한설정 필요)
    2. 상수 세팅(SERVICE_ID,MODULE_HOME,PAY_URL)
    3. 모델(model_pg_billgate)에 pg_tid_check 함수 table명 수정
    */


  	define("SERVICE_ID",	"glx_api");//업체키
  	define("MODULE_HOME","/home/turtlesmiracle/pg_billgate/");//서버 설치 경로
    define("PAY_URL",THIS_DOMAIN."/pg_billgate");//웹 결제url

  }

  public function index() {
		$this->pg_start();
	}


  //결제 모듈 시작
  public function pg_start() {
	 $this->_view("pg_billgate/view_pg_start",array());
  }

  //결제 결과
  public function pg_end() {
    @extract($_REQUEST);
    header('Content-Type: text/html; charset=euc-kr');

    //---------------------------------------
    // Include Class(don't modify)
    //---------------------------------------
    include MODULE_HOME."config.php";
    include MODULE_HOME."class/Message.php";
    include MODULE_HOME."class/MessageTag.php";
    include MODULE_HOME."class/ServiceCode.php";
    include MODULE_HOME."class/Command.php";
    include MODULE_HOME."class/ServiceBroker.php";

    //---------------------------------------
    // Create Instance
    //---------------------------------------
    $reqMsg = new Message(); //요청 메시지
    $resMsg = new Message(); //응답 메시지
    $tag = new MessageTag(); //태그
    $svcCode = new ServiceCode(); //서비스 코드
    $cmd = new Command(); //Command
    //---------------------------------------
    // Create Service Broker
    //---------------------------------------
    $broker = new ServiceBroker($ENCRYPT_COMMAND, $CONFIG_FILE); //통신 모듈
    //---------------------------------------
    //Set Header
    //---------------------------------------
    $reqMsg->setVersion("0100"); //버전 (0100)
    $reqMsg->setMerchantId($SERVICE_ID); //가맹점 아이디
    $reqMsg->setServiceCode($svcCode->CREDIT_CARD); //서비스코드
    $reqMsg->setCommand($cmd->ID_AUTH_REQUEST); //승인 요청 Command
    $reqMsg->setOrderId($ORDER_ID); //주문번호
    $reqMsg->setOrderDate($ORDER_DATE); //주문일시(YYYYMMDDHHMMSS)

    //---------------------------------------
    //Check RESPONSE_CODE
    //---------------------------------------
    $isSuccess = false;
    if(!strcmp($RESPONSE_CODE, "0000")) { // 인증 성공인 경우 결제(승인)요청
    	//---------------------------------------
    	// Request
    	//---------------------------------------
    	$broker->invokeMessage($svcCode->CREDIT_CARD, $MESSAGE); //응답 요청
    	$resMsg = $broker->getResMsg(); //응답 메시지 확인

    	//---------------------------------------
    	// Response
    	//---------------------------------------
    	$RESPONSE_CODE = $resMsg->get($tag->RESPONSE_CODE);
    	$RESPONSE_MESSAGE = $resMsg->get($tag->RESPONSE_MESSAGE);
    	$DETAIL_RESPONSE_CODE = $resMsg->get($tag->DETAIL_RESPONSE_CODE);
    	$DETAIL_RESPONSE_MESSAGE = $resMsg->get($tag->DETAIL_RESPONSE_MESSAGE);

    	if(!strcmp($resMsg->get($tag->RESPONSE_CODE), "0000")) {
    		$TRANSACTION_ID = $resMsg->get($tag->TRANSACTION_ID);
    	  $AUTH_AMOUNT = $resMsg->get($tag->AUTH_AMOUNT);
    		$AUTH_NUMBER = $resMsg->get($tag->AUTH_NUMBER);
    		$AUTH_DATE = $resMsg->get($tag->AUTH_DATE);

    		$isSuccess = true;

        $data['pg_tid']=$TRANSACTION_ID;
				$data['pg_type']="C";
				$data['pg_price']=$AUTH_AMOUNT;
				$data['order_number']=$ORDER_ID;
				$data['pg_date']=$AUTH_DATE;
        $data['pg_result']="Y";

        $this->_view("pg_billgate/view_pg_end",array("data"=>$data));


    	}else {
    		$TRANSACTION_ID = $resMsg->get($tag->TRANSACTION_ID);
    		$AUTH_AMOUNT = "";
    		$AUTH_DATE = "";
    		$AUTH_NUMBER = "";

        $data['pg_tid']=$TRANSACTION_ID;
        $data['pg_type']="C";
        $data['pg_price']=$AUTH_AMOUNT;
        $data['order_number']=$ORDER_ID;
        $data['pg_date']=$AUTH_DATE;
        $data['pg_result']="N";

        $this->_view("pg_billgate/view_pg_end",array("data"=>$data));
    	}
    }

  }




  public function do_pg_cancel() {
    header('Content-Type: text/html; charset=UTF-8');


    @extract($_REQUEST);

    //---------------------------------------
    // Include Class(don't modify)
    //---------------------------------------
    include MODULE_HOME."config.php";
    include MODULE_HOME."class/Message.php";
    include MODULE_HOME."class/MessageTag.php";
    include MODULE_HOME."class/ServiceCode.php";
    include MODULE_HOME."class/Command.php";
    include MODULE_HOME."class/ServiceBroker.php";



    $today_time = date('YmdHis');

    //parameter
    $serviceId	=  SERVICE_ID;
    $orderDate 	= $today_time;
    $orderId 		= $_POST['order_number'];
    $transactionId = $_POST['pg_tid'];	//취소건의 거래번호



    //---------------------------------------
    //Create Instance
    //---------------------------------------
    $reqMsg = new Message();
    $resMsg = new Message();
    $tag = new MessageTag();
    $svcCode = new ServiceCode();
    $cmd = new Command();
    $broker = new ServiceBroker($COMMAND, $CONFIG_FILE);

    //---------------------------------------
    //Header
    //---------------------------------------
    $reqMsg->setVersion("0100");
    $reqMsg->setMerchantId($serviceId);
    $reqMsg->setServiceCode($svcCode->CREDIT_CARD);
    $reqMsg->setCommand($cmd->CANCEL_SMS_REQUEST);
    $reqMsg->setOrderId($orderId);
    $reqMsg->setOrderDate($orderDate);

    //---------------------------------------
    //Body
    //---------------------------------------
    if($transactionId != NULL)
    	$reqMsg->put($tag->TRANSACTION_ID, $transactionId);

    //---------------------------------------
    //Request
    //---------------------------------------
    $broker->setReqMsg($reqMsg);
    $broker->invoke($svcCode->CREDIT_CARD);
    $resMsg = $broker->getResMsg();

    //---------------------------------------
    //Response
    //---------------------------------------
    $msg = $resMsg->get($tag->RESPONSE_MESSAGE);

    $RESPONSE_CODE = $resMsg->get($tag->RESPONSE_CODE);
    $RESPONSE_MESSAGE = $resMsg->get($tag->RESPONSE_MESSAGE);
    $DETAIL_RESPONSE_CODE = $resMsg->get($tag->DETAIL_RESPONSE_CODE);
    $DETAIL_RESPONSE_MESSAGE = $resMsg->get($tag->DETAIL_RESPONSE_MESSAGE);


    if($RESPONSE_CODE=="0000"){
      $response = new stdClass;
      $response->code = "1"; //
      $response->code_msg = "취소완료";
      echo json_encode($response);
      exit;
		}else{
      $response = new stdClass;
      $response->code = "-1"; //
      $response->code_msg = "취소중 오류";
      echo json_encode($response);
      exit;
		}

  }








} // 클래스의 끝
?>
