<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />
		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
<?php
  /**
  * 담당자의 정보를 수정합니다
  */

	include 'common.php';

  // 팝빌회원 사업자번호, '-' 제외 10자리
	$testCorpNum = '1234567890';

  // 팝빌회원 아이디
	$testUserID = 'testkorea';


  // 담당자 정보 객체 생성
	$ContactInfo = new ContactInfo();

  // 담당자명
	$ContactInfo->personName = '담당자_수정';

  // 담당자 아이디
	$ContactInfo->id = 'testkorea';

  // 담당자 연락처
	$ContactInfo->tel = '070-4304-2991';

  // 핸드폰 번호
	$ContactInfo->hp = '010-1234-1234';

  // 이메일 주소
	$ContactInfo->email = 'test@test.com';

  // 팩스번호
	$ContactInfo->fax = '070-111-222';

  // 전체조회 여부, false-개인조회, true-전체조회
	$ContactInfo->searchAllAllowYN = true;

	try {
		$result = $MessagingService->UpdateContact($testCorpNum, $ContactInfo, $testUserID);
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
				<legend>담당자 정보 수정</legend>
				<ul>
					<li>Response.code : <?php echo $code ?></li>
					<li>Response.message : <?php echo $message ?></li>
				</ul>
			</fieldset>
		 </div>
	</body>
</html>
