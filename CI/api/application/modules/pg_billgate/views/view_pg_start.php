<?php header('Content-Type: text/html; charset=euc-kr'); ?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN""http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko" >
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=euc-kr"/>
<meta http-equiv="cache-control" content="private"/>
<meta http-equiv="content-language" content="euc-kr"/>
<meta name="language" content="ko" />
<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />
<!--Header시작-->
<head>
<style type="text/css">
html,
body {
	height: 100%;
	margin: 0;
	padding: 0;
}
#head {
	height: 68px;
	background-image: url(img/bg01.png);
	background-repeat: repeat-x;
}
#body {
	min-height:100%;
	margin: -68px 0px -35px 0px;
}
* html #body {
	height: 100%;
}
#content-area {
	padding: 68px 0px 35px 0px;
}
#foot {
	height:35px;
	background-image: url(img/bg12.png);
}
body,td,th {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #666666;
	min-height: 100%;
}
</style>
<title></title>
<script language="javascript">
	window.addEventListener('load', function() { setTimeout(scrollTo, 0,0,1); }, false);

function checkSubmit()	{
	var HForm = document.payment;
	HForm.target = "payment";
	HForm.action = 'http://tpay.billgate.net/credit/smartphone/certify.jsp';  //test
	//HForm.action = 'https://pay.billgate.net/credit/smartphone/certify.jsp';  //real
	HForm.submit();
}

function getTime() {
	// 시간과 관련된 변수 초기화
    var now = new Date();
    var year = now.getFullYear();
    var month = now.getMonth()+1;
    var day = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    now = null

    month = (month < 10) ? "0" + month : month ;
    day = (day < 10) ? "0" + day : day;
    hour = (hour < 10) ? "0" + hour : hour;
    second = (second < 10) ? "0" + second : second;


    if (minute < 10)
        minute = "0" + minute ;// do not parse this number!

    	// 시간 문자열 반환
    return year + "" + month + "" + day + "" + hour + "" + minute + "" + second;
}

function getOid()
{
    var HForm = document.payment;
    HForm.ORDER_ID.value = 'test_' + getTime();
    HForm.ORDER_DATE.value = getTime();
}
</script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onload="getOid()">
<form name="payment" method="post">
<table align="center">
	<tr>
	  <th> 결제 요청 테스트 - 신용카드 </th>
	<!--히스토리-->
	<!--title-->
	<tr>
	</tr>
	<tr>
		<td align="center"><!--본문테이블 시작--->

		<table width="290" border="0" cellpadding="5" cellspacing="1" bgcolor="#B0B0B0">
			<tr>
				<td colspan="4" height="30" align="left" bgcolor="#F6F6F6">
				<b>공통정보 정보입력</b></td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">가맹점코드</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text"	name="SERVICE_ID" value="glx_api">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">주문번호</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text" name="ORDER_ID"class="input"  value="<?=$_POST['order_number']?>">
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">주문일시</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text"	name="ORDER_DATE" class="input" value="<?=date("Y-m-d H:i:s")?>" >
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">고객 아이디</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text" name="USER_ID" class="input" value="<?=$_POST['member_idx']?>">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">고객명</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text" name="USER_NAME" class="input" value="<?=$_POST['order_name']?>">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">고객이메일</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text" name="USER_EMAIL" class="input" value="<?=$_POST['order_email']?>">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">상품코드</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text" name="ITEM_CODE" class="input" value="<?=$_POST['product_code']?>">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">상품명</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text" name="ITEM_NAME" class="input" value="<?=$_POST['product_name']?>">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">결제 금액</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text" name="AMOUNT" class="input" value="<?=$_POST['product_price']?>">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">Return Url</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text"	name="RETURN_URL" class="input" value="<?=PAY_URL?>/pg_end">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">카드사선택</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<select name="CARD_TYPE" >
                        <option value="0000">---카드사 선택---</option>
                            <option value="0052">비씨카드</option>
                            <option value="0050">국민카드</option>
                            <option value="0073">현대카드</option>
                            <option value="0054">삼성카드</option>
                            <option value="0053">신한(LG)카드</option>
                            <option value="0055">롯데카드</option>
                            <option value="0089">저축은행</option>
                            <option value="0051">외환카드</option>
                            <option value="0076">하나</option>
                            <option value="0079">제주</option>
                            <option value="0080">광주</option>
                            <option value="0073">신협(현대)</option>
                            <option value="0075">수협</option>
                            <option value="0081">전북</option>
                            <option value="0078">농협</option>
                            <option value="0084">씨티</option>
        			</select>
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">할부개월수</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text"	name="INSTALLMENT_PERIOD" class="input" value="0:3">
				</td>
			</tr>
			<tr>
				<td width="100" align="center" bgcolor="#F6F6F6">appname</td>
				<td width="200" bgcolor="#FFFFFF" align="left">&nbsp;
					<input type="text"	name="APPNAME" class="input" value="WEB">
			</td>
			</tr>
			<tr>
				<td align="center" bgcolor="#FFFFFF" colspan="4">
					<img src="/pg_billgate/img/bt_submit01.gif" OnClick="javascript:checkSubmit();" style="cursor: hand;">
				</td>
			</tr>
		</table>
		<br>
		<!--본문테이블 끝--->
		</td>
	</tr>
	<tr>
		<td align="center">
		</td>
	</tr>
</table>
</form>
</body>
</html>
