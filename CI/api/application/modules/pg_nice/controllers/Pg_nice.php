<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-05-02
| Memo : 결제 모듈화 : 아임포트
|------------------------------------------------------------------------
*/

class Pg_nice extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('pg_nice/model_pg_nice');

    define("LIB_HOME",'/home/dambi/api/pg_module/nice');
    define("LIB_WEB_PATH",'/pg_module/nice');
    define("MERCHANTKEY",'EYzu8jGGMfqaDEp76gSckuvnaHHu+bC4opsSN6lHv3b2lurNYkVXrZ7Z1AoqQnXI3eLuaUFyoRNC6FkrzVjceg==');
    define("MID",'nicepay00m');
    // define("MERCHANTKEY",'EVimhcU8mGX0X6UNN/QEAHy83wNc2/5y2ne12mAB2vKNwLKnk6OegYj94Zu3B2hzq5uAE4tKoBeKSdcaa1IgGg==');
    // define("MID",'dambi0001m');

    require(LIB_HOME."/lib/NicepayLite.php");
  }

  public function index() {
		$this->pg_start();
	}

  //결제 모듈 시작
  public function pg_start() {
    $order_number = $this->_input_check("order_number",array());
    $order_name = $this->_input_check("order_name",array());
    $order_tel = $this->_input_check("order_tel",array());
    $order_email = $this->_input_check("order_email",array());
    $product_name = $this->_input_check("product_name",array());
    $product_price = $this->_input_check("product_price",array());

    $merchantKey      = MERCHANTKEY ;   // 상점키
    $merchantID       = MID;                                     // 상점아이디
    $goodsCnt         = "1";                                     // 결제상품개수
    $goodsName        = $product_name;                           // 결제상품명
    $price            = $product_price;                          // 결제상품금액
    $buyerName        = $order_name;                             // 구매자명
    $buyerTel         = $order_tel;                              // 구매자연락처
    $buyerEmail       = $order_email;                            // 구매자메일주소
    $moid             = $order_number;                           // 상품주문번호
    $ReturnURL        = THIS_DOMAIN."/pg_nice/pg_end";           // Return URL
    $CharSet          = "utf-8";                                 // 결과값 인코딩 설정
    /*
    *******************************************************
    * <해쉬암호화> (수정하지 마세요)
    * SHA-256 해쉬암호화는 거래 위변조를 막기위한 방법입니다.
    *******************************************************
    */
    $ediDate = date("YmdHis");
    $hashString = bin2hex(hash('sha256', $ediDate.$merchantID.$price.$merchantKey, true));

    $response = new stdClass();

    $response->ReturnURL = $ReturnURL;
    $response->CharSet = $CharSet;
    $response->hashString = $hashString;
    $response->ediDate = $ediDate;

	 $this->_view("pg_nice/view_pg_start",$response);
  }

  //결제 결과
  public function pg_end() {
    $Amt = $this->_input_check("Amt",array());
    $BuyerName = $this->_input_check("BuyerName",array());
    $BuyerEmail = $this->_input_check("BuyerEmail",array());
    $BuyerTel = $this->_input_check("BuyerTel",array());
    $GoodsName = $this->_input_check("GoodsName",array());
    $m_GoodsCnt = $this->_input_check("m_GoodsCnt",array());
    $GoodsCl = $this->_input_check("GoodsCl",array());
    $Moid = $this->_input_check("Moid",array());
    $MallUserID = $this->_input_check("MallUserID",array());
    $MID = $this->_input_check("MID",array());
    $MallIP = $this->_input_check("MallIP",array());
    $MerchantKey = $this->_input_check("MerchantKey",array());
    $TransType = $this->_input_check("TransType",array());
    $TrKey = $this->_input_check("TrKey",array());
    $PayMethod = $this->_input_check("PayMethod",array());

    $BuyerAddr = $this->_input_check("BuyerAddr",array());
    $VbankAccountName = $this->_input_check("VbankAccountName",array());

    $authResultCode          = $_REQUEST['AuthResultCode'];  // 인증결과 : 0000(성공)
    $authResultMsg           = $_REQUEST['AuthResultMsg'];   // 인증결과 메시지

    if($authResultCode == '0000'){
      /*
      *******************************************************
      * <결제 결과 설정>
      * 사용전 결과 옵션을 사용자 환경에 맞도록 변경하세요.
      * 로그 디렉토리는 꼭 변경하세요.
      *******************************************************
      */
      $nicepay                  = new NicepayLite;
      $MerchantKey              = MERCHANTKEY ; // 상점키
      $nicepay->m_NicepayHome   = LIB_HOME."/logs";               // 로그 디렉토리 설정
      $nicepay->m_ActionType    = "PYO";                  // ActionType
      $nicepay->m_charSet       = "UTF8";                 // 인코딩
      $nicepay->m_ssl           = "true";                 // 보안접속 여부
      $nicepay->m_Price         = $Amt;                   // 금액
      $nicepay->m_NetCancelAmt  = $Amt;                   // 취소 금액
      $nicepay->m_NetCancelPW   = "123456";               // 결제 취소 패스워드 설정

      /*
      *******************************************************
      * <결제 결과 필드>
      *******************************************************
      */
      $nicepay->m_BuyerName     = $BuyerName;             // 구매자명
      $nicepay->m_BuyerEmail    = $BuyerEmail;            // 구매자이메일
      $nicepay->m_BuyerTel      = $BuyerTel;              // 구매자연락처
      //$nicepay->m_EncryptedData = $EncryptedData;         // 해쉬값
      $nicepay->m_GoodsName     = $GoodsName;             // 상품명
      $nicepay->m_GoodsCnt      = $m_GoodsCnt;            // 상품개수
      $nicepay->m_GoodsCl       = $GoodsCl;               // 실물 or 컨텐츠
      $nicepay->m_Moid          = $Moid;                  // 주문번호
      $nicepay->m_MallUserID    = $MallUserID;            // 회원사ID
      $nicepay->m_MID           = $MID;                   // MID
      $nicepay->m_MallIP        = $MallIP;                // Mall IP
      $nicepay->m_MerchantKey   = $MerchantKey;           // 상점키
      $nicepay->m_LicenseKey    = $MerchantKey;           // 상점키
      $nicepay->m_TransType     = $TransType;             // 일반 or 에스크로
      $nicepay->m_TrKey         = $TrKey;                 // 거래키
      $nicepay->m_PayMethod     = $PayMethod;             // 결제수단

      $nicepay->m_BuyerAddr     = $BuyerAddr;             // 결제수단
      $nicepay->m_VbankAccountName     = $VbankAccountName;             // 결제수단

      $nicepay->startAction();

      /*
      *******************************************************
      * <결제 성공 여부 확인>
      *******************************************************
      */
      $resultCode = $nicepay->m_ResultData["ResultCode"];
  	  $payMethod = $nicepay->m_ResultData["PayMethod"];

      $paySuccess = false;
      if($PayMethod == "CARD"){
          if($resultCode == "3001") $paySuccess = true;   // 신용카드(정상 결과코드:3001)
      }else if($PayMethod == "BANK"){
          if($resultCode == "4000") $paySuccess = true;   // 계좌이체(정상 결과코드:4000)
      }else if($PayMethod == "CELLPHONE"){
          if($resultCode == "A000") $paySuccess = true;   // 휴대폰(정상 결과코드:A000)
      }else if($PayMethod == "VBANK"){
          if($resultCode == "4100") $paySuccess = true;   // 가상계좌(정상 결과코드:4100)
      }else if($payMethod == "SSG_BANK"){
  		if($resultCode == "0000") $paySuccess = true;	// SSG은행계좌(정상 결과코드:0000)
  	}

    //중복체크
  	$data['pg_tid']=$TrKey;
  	if($TrKey !=""){
      //결제확인
  		$chk_tid =$this->model_pg_nice->pg_tid_check($data);//결제 여부 체크
  		if(count($chk_tid)>0){

        $this->global_function->_alert("이미 결제된 주문입니다.","");

        $agent = $this->_user_agent();

        $response = new stdClass();

        $response->agent = $agent;
        $response->pg_date = "";
        $response->pg_price = "";
        $response->pg_type = "";
        $response->pg_result ="N";
        $response->order_number = $Moid;

        $this->_list_view("pg_nice/view_pg_failure",$response);

  		}
    }

    $data['pg_tid']=$TrKey;
    $data['pg_type']=$PayMethod;
    $data['pg_date']="";
    $data['pg_price']=$Amt;
    $data['order_number']=$Moid;
    $data['pg_result']='Y';

    $this->_view("pg_nice/view_pg_end",array("data"=>$data));

  }else{
      $resultCode = $authResultCode;
      $resultMsg = $authResultMsg;

      $this->global_function->_alert($nicepay->m_ResultData["ResultMsg"],"");

      $agent = $this->_user_agent();

      $response = new stdClass();

      $response->agent = $agent;
      $response->pg_date = "";
      $response->pg_price = "";
      $response->pg_type = "";
      $response->pg_result ="N";
      $response->order_number = $P_TID;

      $this->_list_view("pg_nice/view_pg_failure",$response);
   }
 }

} // 클래스의 끝
?>
