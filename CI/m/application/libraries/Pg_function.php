<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2019-05-27
|------------------------------------------------------------------------
*/
//경고창
 define("CORP_NAME","로켓티어");//업체명
 define("ACCESS_TOKEN_URL","https://api.iamport.kr/users/getToken/");//인증 토큰 발행 URL
 define("PAYMENT_INFO","https://api.iamport.kr/payments/");//결재 내역 URL
 define("PAYMENT_CANCEL","https://api.iamport.kr/payments/cancel");//취소 URL

 // define("IMP_CORP_CODE","imp18765650");//가맹점 식별코드
 // define("IMP_KEY","5605690753716799");//REST API key
 // define("IMP_SECRET","IPuhwYu3CzEfxF142JfFv9FG2shB8OERD88a7CeJcSZJx1OAK3ffdVVfodQw1vnFEwQL94vlXu5vvT5f");//REST API secret key

Class Pg_function {


	function pg_cancel($order_number, $pg_tid, $pay_price,$reason){

		$merchant_uid =$order_number;
	  $imp_uid =$pg_tid;
	  $amount =$pay_price;
	  $reason ="";

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

		curl_setopt ($ch, CURLOPT_URL,PAYMENT_CANCEL.'?_token='.$access_token);//접속할 URL 주소
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
		// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_SSLVERSION,6); // SSL 버젼 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
		curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS,  'imp_uid='.$imp_uid.'&merchant_uid='.$merchant_uid.'&amount='.$amount.'&reason='.$reason); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
		$payment_info = curl_exec ($ch);
		curl_close ($ch);

		$payment_info_rt = json_decode($payment_info,true);
		$data['pg_tid']=$payment_info_rt['response']['imp_uid'];
		$pg_type ='C';
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
		$data['message']=$payment_info_rt['message'];

    return $data;

	}

}
?>
