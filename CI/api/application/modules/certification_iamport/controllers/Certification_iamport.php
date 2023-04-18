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

class Certification_iamport extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('Certification_iamport/model_certification_iamport');

    define("APP_YN","N");//Y:APP여부,N:모바일웹

  }

  public function index() {
		$this->certification_start();
	}

  //결제 모듈 시작
  public function certification_start() {

    $response = new stdClass();
    $this->_list_view("certification_iamport/view_certification_start",$response);
  }

  //결제 결과
  public function certification_end() {

    $P_STATUS =$_REQUEST['imp_success'];
	  $MERCHANT_UID =$_REQUEST['merchant_uid'];
	  $P_TID =$_REQUEST['imp_uid'];
    //인증 성공
    if($P_STATUS=="Y" ){
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

        curl_setopt ($ch, CURLOPT_URL,CERTIFICATIONS_INFO.$P_TID.'?_token='.$access_token); //접속할 URL 주소
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
				$data['member_name']=$payment_info_rt['response']['name'];
				$data['member_gender']=($payment_info_rt['response']['gender'] =="male")? "0":"1";
				$data['member_birth']=$payment_info_rt['response']['birthday'];
				$data['member_phone']=$payment_info_rt['response']['phone'];
				//$data['member_phone']="";
				$data['order_number']=$payment_info_rt['response']['merchant_uid'];
				$data['unique_key']=$payment_info_rt['response']['unique_key'];

        if($payment_info_rt['response']['certified'] > 0){
          $pg_result = 'Y';
        }else{
          $pg_result = 'N';
        }
        $data['auth_code']=$pg_result;

        $data['agent']=$this->_user_agent();

        $this->_list_view("certification_iamport/view_certification_end",array("data"=>$data));

		}else{
  		  $this->global_function->_alert("결제실패 되었습니다.","/");
		}

  }


} // 클래스의 끝
?>
