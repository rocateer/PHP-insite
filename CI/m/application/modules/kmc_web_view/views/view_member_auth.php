<?php
header("Content-type: text/html; charset=utf-8");
// KMC 본인인증 범용서비스 샘플소스 STEP02

	//01.입력값 변수로 받기
    $cpId       = $data['cpId'];        // 회원사ID
    $urlCode    = $data['urlCode'];     // URL 코드
    $certNum    = $data['reqNum'];     // 요청번호
    $date       = $data['CurTime'];        // 요청일시
    $certMet    = $data['certMet'];     // 본인인증방법
    $birthDay   = '';	// 생년월일
    $gender     = ''; // 성별
    // $name       =  iconv("utf-8","euc-kr",$_REQUEST['name']);        // 성명
    $name       = '';       // 성명
    $phoneNo    = '';		// 휴대폰번호
    $phoneCorp 	= '';	// 이동통신사
    $nation     = ''; // 내외국인 구분
    $plusInfo   = '';	// 추가DATA정보
   	$tr_url     = $data['tr_url'];      // 본인인증 결과수신 POPUP URL
    $extendVar  = "0000000000000000";       // 확장변수



	// [ 입력값 유효성 검증 ]----------------------------------------------------------------------------------
	// 비정상적인 호출, XSS공격, SQL Injection 방지를 위해 입력값 유효성 검증 후 서비스를 호출해야 함

	// 회원사ID (영문대문자+숫자만 8자리이상만 유효)
    if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9A-Z]/u', $cpId) || strlen($cpId) < 8 ){
       echo("회원사ID 비정상 ($cpId)");
       return;
    }

    // URL코드 (숫자 6자리만 유효)
    if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9]/u', $urlCode) || strlen($urlCode) <> 6 ){
       echo("URL코드 비정상 ($urlCode)");
       return;
    }

    // 요청번호 (최대 40byte까지 유효)
    if(strlen($certNum) > 40 ){
       echo("요청번호 비정상 ($certNum)");
       return;
    }
	else{
	    if(preg_match('/[<>]/', $certNum)){  //태그문자 금지
		   echo("요청번호 비정상 ($certNum)");
		   return;
		}
	}

    // 요청일시 (숫자 14자리만 유효)
    if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9]/u', $date) || strlen($date) <> 14 ){
       echo("요청일시 비정상 ($date)");
       return;
    }

    // 본인인증방법 (영문대문자 1자리만 유효)
    if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}A-Z]/u', $certMet) || strlen($certMet) <> 1 ){
       echo("본인인증방법 비정상 ($certMet)");
       return;
    }

    // 생년월일 (값이 있는 경우에는 숫자 8자리만 유효)
    if(strlen($birthDay) > 0 ){
      if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9]/u', $birthDay) || strlen($birthDay) <> 8 ){
         echo("생년월일 비정상 ($birthDay)");
         return;
      }
    }

    // 성별 (값이 있는 경우에는 숫자 1자리만 유효)
    if(strlen($gender) > 0 ){
      if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9]/u', $gender) || strlen($gender) <> 1 ){
         echo("성별 비정상 ($gender)");
         return;
      }
    }

    // 성명 (값이 있는 경우에는 최대 30byte까지만 유효)
    if(strlen($name) > 0 ){
      if(strlen($name) > 30 ){
         echo("성명 비정상 ($name)");
         return;
      }
	  else{
	    if(preg_match('/[<>]/', $name)){  //태그문자 금지
		   echo("성명 비정상1 ($name)");
		   return;
		}
	  }
    }

    // 휴대폰번호 (값이 있는 경우에는 숫자 10 또는 11자리까지만 유효)
    if(strlen($phoneNo) > 0 ){
      if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9]/u', $phoneNo) || strlen($phoneNo) < 10 || strlen($phoneNo) > 11){
         echo("휴대폰번호 비정상 ($phoneNo)");
         return;
      }
    }

    // 이동통신사 (값이 있는 경우에는 영문대문자 3자리만 유효)
    if(strlen($phoneCorp) > 0 ){
      if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}A-Z]/u', $phoneCorp) || strlen($phoneCorp) <> 3 ){
         echo("이동통신사 비정상 ($phoneCorp)");
         return;
      }
    }

    // 내외국인 (값이 있는 경우에는 숫자 1자리만 유효)
    if(strlen($nation) > 0 ){
      if(preg_match('/[^\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{AC00}-\x{D7AF}0-9]/u', $nation) || strlen($nation) <> 1 ){
         echo("내외국인 비정상 ($nation)");
         return;
      }
    }

    // 추가정보 (값이 있는 경우에는 최대 320byte까지만 유효)
    if(strlen($plusInfo) > 0 ){
      if(strlen($plusInfo) > 320 ){
         echo("추가정보 비정상 ($plusInfo)");
         return;
      }
	  else{
	    if(preg_match('/[<>]/', $plusInfo)){  //태그문자 금지
		   echo("추가정보 비정상1 ($plusInfo)");
		   return;
		}
	  }
    }

	//----------------------------------------------------------------------------------------------------------

	// [ certNum 주의사항 ]--------------------------------------------------------------------------------------
	// 1. 본인인증 결과값 복호화를 위한 키로 활용되므로 중요함.
	// 2. 본인인증 요청시 중복되지 않게 생성해야함. (예-시퀀스번호)
	// 3. certNum값 생성 후 쿠키 또는 Session에 저장한 후 본인인증 결과값 수신 후 복호화키로 사용함.
	// 4. 아래 샘플은 쿠키를 사용하지 않았음.
	//----------------------------------------------------------------------------------------------------------

    $name = str_replace(" ", "+", $name) ;  //성명에 space가 들어가는 경우 "+"로 치환하여 암호화 처리

	//02. certNum 쿠키 생성
	//setcookie("certNum", $certNum, time()+600);

	//03. tr_cert 데이터변수 조합 (서버로 전송할 데이터 "/"로 조합)
	$tr_cert	= $cpId . "/" . $urlCode . "/" . $certNum . "/" . $date . "/" . $certMet . "/" . $birthDay . "/" . $gender . "/" . $name . "/" . $phoneNo . "/" . $phoneCorp . "/" . $nation . "/" . $plusInfo . "/" . $extendVar;

    //암호화모듈 호출
	if (extension_loaded('ICERTSecu')) {

		//04. 1차암호화
		$enc_tr_cert = ICertSeed(1,0,'',$tr_cert);

		//05. 변조검증값 생성
		$enc_tr_cert_hash = ICertHMac($enc_tr_cert);

		//06. 2차암호화
		$enc_tr_cert = $enc_tr_cert . "/" . $enc_tr_cert_hash . "/" . "0000000000000000";

		$enc_tr_cert = ICertSeed(1,0,'',$enc_tr_cert);

	}else{
       echo("암호화모듈 호출 실패!!!");
       return;
	}

?>




<!-- 본인인증서비스 요청 form --------------------------->
<form name="reqKMCISForm" method="post" action="https://www.kmcert.com/kmcis/web/kmcisReq.jsp">
    <input type="hidden" name="tr_cert"     value = "<?php echo $enc_tr_cert ?>">
    <input type="hidden" name="tr_url"      value = "<?php echo $tr_url ?>">

</form>
<script type="text/javascript">
document.reqKMCISForm.submit();
</script>
