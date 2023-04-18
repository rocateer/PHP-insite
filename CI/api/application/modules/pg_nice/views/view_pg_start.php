<!DOCTYPE html>
<html>
<head>
<title>NICEPAY PAY REQUEST(UTF-8)</title>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes, target-densitydpi=medium-dpi"/>
<link rel="stylesheet" type="text/css" href="<?=LIB_WEB_PATH?>/css/import.css"/>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
//스마트폰 결제 요청
function goPay(form) {
    document.getElementById("vExp").value = getTomorrow();
    document.tranMgr.submit();
    document.charset = "euc-kr";
}
//가상계좌 입금만료일 설정 (today +1)
function getTomorrow(){
    var today = new Date();
    var yyyy = today.getFullYear().toString();
    var mm = (today.getMonth()+1).toString();
    var dd = (today.getDate()+1).toString();
    if(mm.length < 2){mm = '0' + mm;}
    if(dd.length < 2){dd = '0' + dd;}
    return (yyyy + mm + dd);
}
</script>
</head>
<body>
<form name="tranMgr" method="post" target="_self" action="https://web.nicepay.co.kr/v3/smart/smartPayment.jsp" accept-charset="euc-kr">
  <input type="hidden" name="PayMethod" value="CARD">
  <input type="hidden" name="GoodsName" value="<?=$_POST['product_name']?>">
  <input type="hidden" name="GoodsCnt" value="1">

  <input type="hidden" name="Amt" value="<?=$_POST['product_price']?>">
  <input type="hidden" name="BuyerName" value="<?=$_POST['order_name']?>">
  <input type="hidden" name="BuyerTel" value="<?=$_POST['order_tel']?>">
  <input type="hidden" name="Moid" value="<?=$_POST['order_number']?>">
  <input type="hidden" name="MID" value="<?=MID?>">

  <!-- 옵션 -->
  <input type="hidden" name="ReturnURL" value="<?=$ReturnURL?>"/>       <!-- Return URL -->
  <input type="hidden" name="CharSet" value="<?=$CharSet?>"/>           <!-- 인코딩 설정 -->
  <input type="hidden" name="GoodsCl" value="1"/>                       <!-- 상품구분 실물(1), 컨텐츠(0) -->
  <input type="hidden" name="VbankExpDate" id="vExp"/>                  <!-- 가상계좌입금만료일 -->
  <input type="hidden" name="BuyerEmail" value="<?=$_POST['order_email']?>"/>     <!-- 구매자 이메일 -->

  <!-- 변경 불가능 -->
  <input type="hidden" name="EncryptData" value="<?=$hashString?>"/>    <!-- 해쉬값 -->
  <input type="hidden" name="ediDate" value="<?=$ediDate?>"/>           <!-- 전문 생성일시 -->
  <input type="hidden" name="AcsNoIframe" value="Y"/>					<!-- 나이스페이 결제창 프레임 옵션 (변경불가) -->
</form>
<script>
$(document).ready(function(){
   setTimeout("goPay()", 10);
})
</script>
