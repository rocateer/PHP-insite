<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2017-04-12
| Memo : 이니시스 모바일 결제
|------------------------------------------------------------------------
*/

class Pg_inicis extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('pg_inicis/model_pg_inicis');
    /*
    세팅 순서
    1. 모듈 ftp로 upload(log(R),key(R) chmod 777 권한설정 필요)
    2. 상수 세팅(INICIS_MID,INICIS_SIGNKEY,INICIS_HOME,INICIS_PAY_DOMAIN,APP_YN,CORP_NAME)
    3. 모델(model_pg_inicis)에 pg_tid_check 함수 table명 수정
    */

  	define("INICIS_MID",	"INIpayTest");//업체키
    define("INICIS_SIGNKEY",	"SU5JTElURV9UUklQTEVERVNfS0VZU1RS");//업체 인증키
  	define("INICIS_HOME","/home/biralmarket/pg_inicis");//서버 설치 경로
    define("INICIS_PAY_DOMAIN",THIS_DOMAIN."/pg_inicis");//도메인
    define("APP_YN","N");//Y:APP여부,N:모바일웹

    define("CORP_NAME","바이럴마켓");//업체명

  }

  public function index() {
		$this->pg_start();
	}


  //결제 모듈 시작
  public function pg_start() {
	 $this->_view("pg_inicis/view_pg_start",array());
  }

  //결제 결과
  public function pg_end() {

    $P_STATUS =$_REQUEST['P_STATUS'];
	  $P_REQ_URL =$_REQUEST['P_REQ_URL'];
	  $P_TID =$_REQUEST['P_TID'];
	  $P_MID = INICIS_MID;


		//중복체크
		$data['pg_tid']=$P_TID;
		if($_REQUEST['P_TID']){
      //결제확인
			$chk_tid =$this->model_pg_inicis->pg_tid_check($data);
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
    if($P_STATUS=="00" ){

      $ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL,$P_REQ_URL); //접속할 URL 주소
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
			// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
			curl_setopt ($ch, CURLOPT_SSLVERSION,3); // SSL 버젼 (https 접속시에 필요)
			curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
			curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
			curl_setopt ($ch, CURLOPT_POSTFIELDS,  "P_TID=$P_TID&P_MID=$P_MID"); // Post 값 Get 방식처럼적는다.
			curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
			$doc = curl_exec ($ch);
			curl_close ($ch);

			$rt = $this->parseData($doc);
      //결제성공
			if($rt['P_STATUS']=="00"){
				$data['pg_tid']=$rt['P_TID'];
				$data['pg_type']=$rt['P_TYPE'];
				$data['pg_price']=$rt['P_AMT'];
				$data['order_number']=$rt['P_OID'];
				$data['pg_date']=substr($rt['P_AUTH_DT'],0,4)."-".substr($rt['P_AUTH_DT'],4,2)."-".substr($rt['P_AUTH_DT'],6,2)." ".substr($rt['P_AUTH_DT'],8,2).":".substr($rt['P_AUTH_DT'],10,2).":".substr($rt['P_AUTH_DT'],12,2);
        $data['pg_result']="Y";

        $this->_view("pg_inicis/view_pg_end",array("data"=>$data));

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

		}else{
      if(APP_YN =="Y"){
        $response = new stdClass;
        $response->code = "-1"; //
        $response->code_msg = "인증실패 되었습니다";
        echo json_encode($response);
        exit;
      }else{
  			$this->global_function->_alert("인증실패 되었습니다.","/");
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

    $pg_tid = ($this->input->post("pg_tid", TRUE) != "")	?	$this->_escstr($this->input->post("pg_tid", TRUE)) : "";
    $msg = ($this->input->post("msg", TRUE) != "")	?	$this->_escstr($this->input->post("msg", TRUE)) : "";
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
