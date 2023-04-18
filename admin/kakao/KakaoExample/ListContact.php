<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />
		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
<?php
  /**
  * 연동회원의 담당자 목록을 확인합니다.
  */

	include 'common.php';

  // 팝빌회원 사업자번호, '-'제외 10자리
	$testCorpNum = '1234567890';

	try {
		$result = $KakaoService->ListContact($testCorpNum);
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
				<legend>담당자 목록 확인</legend>
				<ul>
					<?php
						if ( isset($code) ) {
					?>
						<li>Response.code : <?php echo $code ?> </li>
						<li>Response.message : <?php echo $message ?></li>
					<?php
						} else {
							for ($i = 0; $i < Count($result); $i++) {
					?>
							<fieldset class="fieldset2">
							<legend> 담당자 정보 [<?php echo $i+1?>]</legend>
							<ul>
								<li>id : <?php echo $result[$i]->id ?></li>
								<li>email : <?php echo $result[$i]->email ?></li>
								<li>hp : <?php echo $result[$i]->hp ?></li>
								<li>personName : <?php echo $result[$i]->personName ?></li>
								<li>searchAllAllowYN : <?php echo $result[$i]->searchAllAllowYN ?></li>
								<li>tel : <?php echo $result[$i]->tel ?></li>
								<li>fax : <?php echo $result[$i]->fax ?></li>
								<li>mgrYN : <?php echo $result[$i]->mgrYN ?></li>
								<li>regDT : <?php echo $result[$i]->regDT ?></li>
								<li>state : <?php echo $result[$i]->state ?></li>
							</ul>
							</fieldset>
					<?php
							}
						}
					?>
				</ul>
			</fieldset>
		 </div>
	</body>
</html>
