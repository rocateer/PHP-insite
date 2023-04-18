<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="/Example.css" media="screen" />

		<title>팝빌 SDK PHP 5.X Example.</title>
	</head>
	<body>
		<div id="content">

			<p class="heading1">팝빌 문자메시지 SDK PHP 5.X Example.</p>

			<br/>

			<fieldset class="fieldset1">
				<legend>팝빌 기본 API</legend>

				<fieldset class="fieldset2">
					<legend>회원사 정보</legend>
					<ul>
						<li><a href="CheckIsMember.php">checkIsMember</a> - 연동회원사 가입 여부 확인</li>
						<li><a href="CheckID.php">checkID</a> - 연동회원 아이디 중복 확인</li>
						<li><a href="JoinMember.php">joinMember</a> - 연동회원사 가입 요청</li>
            <li><a href="GetChargeInfo.php">getChargeInfo</a> - 과금정보 확인</li>
            <li><a href="GetBalance.php">getBalance</a> - 연동회원사 잔여포인트 확인</li>
            <li><a href="GetPopbillURL.php">getPopbillURL</a> - 팝빌 SSO URL 요청(로그인, 포인트 충전)</li>
            <li><a href="GetPartnerBalance.php">getPartnerBalance</a> - 파트너 잔여포인트 확인</li>
            <li><a href="GetPartnerURL.php">getPartnerURL</a> - 파트너 포인트충전 팝업 URL</li>
						<li><a href="RegistContact.php">registContact</a> - 담당자 추가</li>
						<li><a href="ListContact.php">listContact</a> - 담당자 목록 확인</li>
						<li><a href="UpdateContact.php">updateContact</a> - 담당자 정보 수정</li>
						<li><a href="GetCorpInfo.php">GetCorpInfo</a> - 회사정보 확인</li>
						<li><a href="UpdateCorpInfo.php">UpdateCorpInfo</a> - 회사정보 수정</li>
					</ul>
				</fieldset>

			</fieldset>

			<br />

			<fieldset class="fieldset1">
				<legend>문자메시지 관련 API</legend>

				<fieldset class="fieldset2">
					<legend>단문 문자 전송</legend>
					<ul>
						<li><a href="SendSMS.php">sendSMS</a> - 단문 문자메시지 1건 전송</li>
						<li><a href="SendSMS_Multi.php">sendSMS</a> - 단문 문자메시지 다량(최대1000건) 전송</li>
					</ul>
				</fieldset>

				<fieldset class="fieldset2">
					<legend>장문 문자 전송</legend>
					<ul>
						<li><a href="SendLMS.php">sendLMS</a> - 장문 문자메시지 1건 전송</li>
						<li><a href="SendLMS_Multi.php">sendLMS</a> - 장문 문자메시지 다량(최대1000건) 전송</li>
					</ul>
				</fieldset>

				<fieldset class="fieldset2">
					<legend>단/장문 문자 자동인식 전송</legend>
					<ul>
						<li><a href="SendXMS.php">sendXMS</a> - 단/장문 자동인식 문자메시지 1건 전송</li>
						<li><a href="SendXMS_Multi.php">sendXMS</a> - 단/장문 자동인식 문자메시지 다량(최대1000건) 전송</li>
					</ul>
				</fieldset>

				<fieldset class="fieldset2">
					<legend>포토 문자 전송</legend>
					<ul>
						<li><a href="SendMMS.php">sendMMS</a> - 포토 문자메시지 1건 전송</li>
						<li><a href="SendMMS_Multi.php">sendMMS</a> - 포토 문자메시지 (최대1000건) 전송</li>
					</ul>
				</fieldset>

				<fieldset class="fieldset2">
					<legend>전송내역조회/요약정보확인</legend>
					<ul>
						<li><a href="Search.php">search</a> - 문자전송 목록 조회</li>
            <li><a href="GetStates.php">getStates</a> - 문자메시지 전송결과 요약정보 확인</li>
					</ul>
				</fieldset>

				<fieldset class="fieldset2">
					<legend>접수번호 관련 기능 (요청번호 미할당)</legend>
					<ul>
						<li><a href="GetMessages.php">getMessages</a> - 문자메시지 전송결과 확인</li>
						<li><a href="CancelReserve.php">cancelReserve</a> - 예약문자 메시지 예약취소</li>
					</ul>
				</fieldset>

				<fieldset class="fieldset2">
					<legend>요청번호 할당 전송건 관련 기능</legend>
					<ul>
						<li><a href="GetMessagesRN.php">getMessagesRN</a> - 문자메시지 전송결과 확인</li>
						<li><a href="CancelReserveRN.php">cancelReserveRN</a> - 예약문자 메시지 예약취소</li>
					</ul>
				</fieldset>

				<fieldset class="fieldset2">
					<legend>기타</legend>
					<ul>
						<li><a href="GetURL.php">getURL</a> - 문자 API 관련 SSO URL 확인</li>
						<li><a href="GetUnitCost.php">getUnitCost</a> - 문자 전송 단가 확인</li>
						<li><a href="GetAutoDenyList.php">getAutoDenyList</a> - 080 수신거부 목록 확인</li>
            <li><a href="GetSenderNumberList.php">getSenderNumberList</a> - 문자 발신번호 목록 확인</li>
					</ul>
				</fieldset>

			</fieldset>
		 </div>
	</body>
</html>
