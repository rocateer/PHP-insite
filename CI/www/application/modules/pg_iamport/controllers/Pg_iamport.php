<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-05-02
| Memo : 결제 모듈화 : 아임포트
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

class Pg_iamport extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('pg_iamport/model_pg_iamport');
    /*
    세팅 순서
    1. 모듈 ftp로 upload(log(R),key(R) chmod 777 권한설정 필요)
    2. 상수 세팅(INICIS_MID,INICIS_SIGNKEY,INICIS_HOME,INICIS_PAY_DOMAIN,APP_YN,CORP_NAME)
    3. 모델(model_pg_inicis)에 pg_tid_check 함수 table명 수정
    */

    define("APP_YN","Y");//Y:APP여부,N:모바일웹
  }

  public function index() {
		$this->pg_start();
	}

  //결제 모듈 시작
  public function pg_start() {
	 $this->_view("pg_iamport/view_pg_start",array());
  }

  //결제 결과
  public function pg_end() {

    $P_STATUS =$_REQUEST['imp_success'];
	  $MERCHANT_UID =$_REQUEST['merchant_uid'];
	  $P_TID =$_REQUEST['imp_uid'];

		//중복체크
		$data['pg_tid']=$P_TID;
		if($P_TID){
      //결제확인
			$chk_tid =$this->model_pg_iamport->pg_tid_check($data);//결제 여부 체크
			if(count($chk_tid)>0){
        if(APP_YN =="Y"){
          $response = new stdClass;
          $response->code = "-1"; //
          $response->code_msg = "이미 결제된 주문입니다";
          echo json_encode($response);
          exit;

        }else{
          $this->global_function->_alert("이미 결제된 주문입니다.","/");
          exit;
        }
			}
		}
    //인증 성공
    if($P_STATUS=="true" ){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL,ACCESS_TOKEN_URL); //접속할 URL 주소
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
        // default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
        curl_setopt ($ch, CURLOPT_SSLVERSION,6); // SSL 버젼 (https 접속시에 필요)
        curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
        curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
        curl_setopt ($ch, CURLOPT_POSTFIELDS,  "imp_key=".IMP_KEY."&imp_secret=".IMP_SECRET); // Post 값 Get 방식처럼적는다.
        curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
        $doc = curl_exec ($ch);

        $rt = json_decode($doc,true);
        $access_token = $rt['response']['access_token'];

        curl_setopt ($ch, CURLOPT_URL,PAYMENT_INFO.$P_TID.'?_token='.$access_token); //접속할 URL 주소
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
        // default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
        curl_setopt ($ch, CURLOPT_SSLVERSION,6); // SSL 버젼 (https 접속시에 필요)
        curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
        curl_setopt ($ch, CURLOPT_POST, 0); // Post Get 접속 여부
        curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
        $payment_info = curl_exec ($ch);
        curl_close ($ch);
        $payment_info_rt = json_decode($payment_info,true);

				$data['pg_tid']=$payment_info_rt['response']['imp_uid'];
        if($payment_info_rt['response']['pay_method']=='card'){
          $pg_type ='C';
        }
				$data['pg_type']=$pg_type;
				$data['pg_price']=$payment_info_rt['response']['amount'];
				$data['order_number']=$payment_info_rt['response']['merchant_uid'];
				$data['pg_date']=date("Y-m-d H:i:s",$payment_info_rt['response']['paid_at']);
        if($payment_info_rt['response']['paid_at'] > 0){
          $pg_result = 'Y';
        }else{
          $pg_result = 'N';
        }
        $data['pg_result']=$pg_result;

        $this->_view("pg_iamport/view_pg_end",array("data"=>$data));

		}else{
      if(APP_YN =="Y"){
        $response = new stdClass;
        $response->code = "-1"; //
        $response->code_msg = "결제실패 되었습니다";
        echo json_encode($response);
        exit;
      }else{
  			$this->global_function->_alert("결제실패 되었습니다.","/");
  			exit;
     }

		}

  }

  public function do_pg_cancel($pg_tid) {
    header("Content-type: text/html; charset=utf-8");
    ini_set('error_reporting', '0');

    $msg ="[m]자동취소";

		require_once(INICIS_HOME.'/libs/INILib.php');

		/* * *************************************
		 * 2. INIpay41 클래스의 인스턴스 생성 *
		 * ************************************* */
		$inipay = new INIpay50;

		/* * *******************
		 * 3. 취소 정보 설정 *
		 * ******************* */
		$inipay->SetField("inipayhome", INICIS_HOME); // 이니페이 홈디렉터리(상점수정 필요)
		$inipay->SetField("type", "cancel");                            // 고정 (절대 수정 불가)
		$inipay->SetField("debug", "true");                             // 로그모드("true"로 설정하면 상세로그가 생성됨.)
		$inipay->SetField("mid", INICIS_MID);                                 // 상점아이디
		/* * ************************************************************************************************
		 * admin 은 키패스워드 변수명입니다. 수정하시면 안됩니다. 1111의 부분만 수정해서 사용하시기 바랍니다.
		 * 키패스워드는 상점관리자 페이지(https://iniweb.inicis.com)의 비밀번호가 아닙니다. 주의해 주시기 바랍니다.
		 * 키패스워드는 숫자 4자리로만 구성됩니다. 이 값은 키파일 발급시 결정됩니다.
		 * 키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오.
		 * ************************************************************************************************ */
		$inipay->SetField("admin", "1111");
		$inipay->SetField("tid", $pg_tid);                                 // 취소할 거래의 거래아이디
		$inipay->SetField("cancelmsg", $msg);                           // 취소사유

		/* * **************
		 * 4. 취소 요청 *
		 * ************** */
		$inipay->startAction();

    if($inipay->getResult('ResultCode')=="00"){
      $response = new stdClass;
      $response->code = "1"; // 이미 등록된 휴대폰번호 입니다.
      $response->code_msg = "취소 성공";
      echo json_encode($response);
      exit;
		}else{
      $response = new stdClass;
      $response->code = "-1"; // 이미 등록된 휴대폰번호 입니다.
      $response->code_msg = "취소실패";
      echo json_encode($response);
      exit;
		}

  }



  public function api_pg_cancel() {
    header("Content-type: text/html; charset=utf-8");
    ini_set('error_reporting', '0');

    $pg_tid = ($this->input->post("pg_tid", TRUE) != "")	?	$this->escstr($this->input->post("pg_tid", TRUE)) : "";
    $msg = ($this->input->post("msg", TRUE) != "")	?	$this->escstr($this->input->post("msg", TRUE)) : "";
		//망취소 process
		require_once(INICIS_HOME.'/libs/INILib.php');

		/* * *************************************
		 * 2. INIpay41 클래스의 인스턴스 생성 *
		 * ************************************* */
		$inipay = new INIpay50;

		/* * *******************
		 * 3. 취소 정보 설정 *
		 * ******************* */
		$inipay->SetField("inipayhome", INICIS_HOME); // 이니페이 홈디렉터리(상점수정 필요)
		$inipay->SetField("type", "cancel");                            // 고정 (절대 수정 불가)
		$inipay->SetField("debug", "true");                             // 로그모드("true"로 설정하면 상세로그가 생성됨.)
		$inipay->SetField("mid", INICIS_MID);                                 // 상점아이디
		/* * ************************************************************************************************
		 * admin 은 키패스워드 변수명입니다. 수정하시면 안됩니다. 1111의 부분만 수정해서 사용하시기 바랍니다.
		 * 키패스워드는 상점관리자 페이지(https://iniweb.inicis.com)의 비밀번호가 아닙니다. 주의해 주시기 바랍니다.
		 * 키패스워드는 숫자 4자리로만 구성됩니다. 이 값은 키파일 발급시 결정됩니다.
		 * 키패스워드 값을 확인하시려면 상점측에 발급된 키파일 안의 readme.txt 파일을 참조해 주십시오.
		 * ************************************************************************************************ */
		$inipay->SetField("admin", "1111");
		$inipay->SetField("tid", $pg_tid);                                 // 취소할 거래의 거래아이디
		$inipay->SetField("cancelmsg", $msg);                           // 취소사유

		/* * **************
		 * 4. 취소 요청 *
		 * ************** */
		$inipay->startAction();

    if($inipay->getResult('ResultCode')=="00"){
      $response = new stdClass;
      $response->code = "1"; // 이미 등록된 휴대폰번호 입니다.
      $response->code_msg = "취소 성공";
      echo json_encode($response);
      exit;
		}else{
      $response = new stdClass;
      $response->code = "-1"; // 이미 등록된 휴대폰번호 입니다.
      $response->code_msg = "취소실패";
      echo json_encode($response);
      exit;
		}

  }

  //문자 parse
  function parseData($receiveMsg) { //승인결과 Parse
    $rt = explode("&",$receiveMsg);
    foreach($rt as $value){
      $tmpArr = explode("=",$value);
      $returnArr[$tmpArr[0]] = $tmpArr[1];
    }
    return $returnArr;
  }

} // 클래스의 끝
?>
