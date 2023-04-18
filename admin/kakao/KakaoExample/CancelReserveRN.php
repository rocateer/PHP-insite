<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />
		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
<?php
  /**
  * 전송요청번호(requestNum)를 할당한 알림톡/친구톡 예약전송건을 취소합니다.
  * - 예약전송 취소는 예약시간 10분전까지만 가능합니다.
  */

	include 'common.php';

  // 팝빌 회원 사업자번호, "-"제외 10자리
	$testCorpNum = '1234567890';

	// 예약전송 요청시 할당한 전송요청번호
	$requestNum = '';

	try {
		$result = $KakaoService->CancelReserveRN($testCorpNum ,$requestNum);
		$code = $result->code;
		$message = $result->message;
	}
	catch (PopbillException $pe) {
		$code = $pe->getCode();
		$message = $pe->getMessage();
	}
?>
	<body>
		<div id="content">
			<p class="heading1">Response</p>
			<br/>
			<fieldset class="fieldset1">
				<legend>예약전송 취소 </legend>
				<ul>
					<li>Response.code : <?php echo $code ?></li>
					<li>Response.message : <?php echo $message ?></li>
				</ul>
			</fieldset>
		 </div>
	</body>
</html>
