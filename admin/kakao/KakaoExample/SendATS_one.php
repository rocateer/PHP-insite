<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />
		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
<?php
/**
* 알림톡 전송을 요청합니다. (단건)
* 사전에 승인된 템플릿의 내용과 알림톡 전송내용(altMsg)이 다를 경우 전송실패 처리됩니다.
*/

	include 'common.php';

  // 팝빌 회원 사업자번호, "-"제외 10자리
	$testCorpNum = '5048619679';

  // 팝빌회원 사업자번호
  $testUserID = 'rentdream';

  // 템플릿 코드 - 템플릿 목록 조회 (ListATSTemplate API)의 반환항목 확인
  $templateCode = '018060000179';

  // 팝빌에 사전 등록된 발신번호
  $sender = '01083490706';

  // 알림톡 내용, 최대 1000자
	$content = '[테스트] 테스트 템플릿입니다.';

  // 대체문자 내용
  $altContent = '대체문자 내용';

  // 대체문자 전송유형 공백-미전송, A-대체문자내용 전송, C-알림톡내용 전송
  $altSendType = 'A';

  // 예약전송일시, yyyyMMddHHmmss
  $reserveDT = '20180302200000';

	// 전송요청번호
	// 파트너가 전송 건에 대해 관리번호를 구성하여 관리하는 경우 사용.
	// 1~36자리로 구성. 영문, 숫자, 하이픈(-), 언더바(_)를 조합하여 팝빌 회원별로 중복되지 않도록 할당.
	$requestNum = '';

  // 수신자 정보
  $receivers[] = array(
    // 수신번호
    'rcv' => '010111222',
    // 수신자명
    'rcvnm' => '수신자명'
  );

	try {
		$receiptNum = $KakaoService->SendATS($testCorpNum, $templateCode, $sender, $content, $altContent, $altSendType, $receivers, $reserveDT, $testUserID, $requestNum);
	} catch(PopbillException $pe) {
		$code = $pe->getCode();
		$message = $pe->getMessage();
	}
?>
	<body>
		<div id="content">
			<p class="heading1">Response</p>
			<br/>
			<fieldset class="fieldset1">
				<legend>알림톡 1건 전송</legend>
				<ul>
					<?php
						if ( isset($receiptNum) ) {
					?>
							<li>receiptNum(접수번호) : <?php echo $receiptNum?></li>
					<?php
						} else {
					?>
							<li>Response.code : <?php echo $code ?> </li>
							<li>Response.message : <?php echo $message ?></li>
					<?php
						}
					?>
				</ul>
			</fieldset>
		 </div>
	</body>
</html>
