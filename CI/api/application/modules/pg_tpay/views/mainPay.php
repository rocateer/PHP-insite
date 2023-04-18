<?
	// require_once dirname(__FILE__).'/TPAY.LIB.php';
  require_once APPPATH.'/libraries/TPAY.LIB.php';

  //상점id 테스트용 ID - 운용전환시 실제 발급받은 ID로 사용하여야함
	$mid = MID;

  // 가맹점 판매 상품에 대한 주문(order) ID
  $moid = $_POST['order_no'];
  // var_dump($_POST);

  //$tid -> 결제시 생성되는 거래 (transanction) ID
  //     -> 결제 테스트 진행 후 tid를 기록하여 결제 취소 테스트 시 사용하면 됨

  // 가명점 서명키
  // 가맹점 서명키는 결제 데이터의 위변조를 방지하기 위해 mid를 발급시에 설정되는 키
  // 서명키는 https://mms.tpay.co.kr 에서 확인 가능: 회원사 정보 -> 일반정보 -> KEY 관리
  $merchantKey = MERCHANTKEY;

  //결제금액
 // 	$amt = "1004";
  $amt = $_POST['product_price'];

  //$ediDate, $mid, $merchantKey, $amt
	$encryptor = new Encryptor($merchantKey);

	$encryptData = $encryptor->encData($amt.$mid.$moid);
	$ediDate = $encryptor->getEdiDate();
  $vbankExpDate = $encryptor->getVBankExpDate();

	$payActionUrl = "https://mtx.tpay.co.kr";
	$payLocalUrl = THIS_DOMAIN."/pg_tpay/returnPay";
  $payCancelUrl = THIS_DOMAIN."/pg_tpay/cancelPay";

  // $var_dump();

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-status-bar-style" content="black" />
<link rel="apple-touch-icon" href=""/>
<link rel="apple-touch-startup-image" href="" />
<style type="text/css">

	body{
		font-family:나눔고딕, 돋움, Tahoma, Geneva, sans-serif;
		font-size:13px;
		padding:0;
		margin:0;
		background: #fff;}

		a{text-decoration:none;}
		a:link		{color:#000; cursor:pointer;}
		a:visited 	{color:#000; cursor:pointer;}
		a:hover		{color:#c8c8c8; cursor:pointer;}
		a:active	{color:#000; cursor:pointer;}

	.TitleBar{font-size:17px; color:#000; font-weight:bold;}

	@-webkit-keyframes zoom {
	 from { opacity: 0.1; font-size: 100%;}
	 to {
	   opacity: 1.0;
	   font-size: 130%;
	 }
	}

	.selectBar{margin:10px;	}
  .selectBar label{font-size:12px; padding:3px; color:#999;}
	.selectBar label span{font-size:12px; font-weight: bold; color:#ed1746; }
	.selectBar span{font-size:14px;	padding:3px;}
	.selectBar input{font-family: 나눔고딕, Tahoma, Geneva, sans-serif;	font-size:14px;	padding:6px; margin:0px; text-align:left; background:#fff; width:90%;
  border-bottom:1px solid #fff; border-top:1px solid #fff; border-left:1px solid #fff; border-right:1px solid #fff; height:40px;}
	.selectBar .listInput{width:90px;	text-align:left;}
	.selectBar .largeInput{	width:95%;	text-align:left;}
	.selectBar div {float:right; padding:0;	margin:0;}
	.selectBar select{width:140px; font-size:15px;}
	.selectList ul{	list-style:none; margin:0px; padding:0;}
	.selectList ul li{position: relative; padding:10px 0 0 0px; margin: 0; border-bottom:1px solid #ccc;}
  .selectList ul li .r_txt{position: absolute; right:10px; bottom:10px;}

  .btn_red{background:#ed1746; color:#fff; border: none; width:100%; display: block; padding:12px; font-size: 14px;}
</style>

<script type="text/javascript">
	function changeAmt(){
		frm = document.transMgr;
		frm.action = "mainPay.php";
		frm.target = "_self";
		frm.submit();
	}

	function submitForm(){

		frm = document.transMgr;


    if(!regex_email_addr(frm.buyerEmail.value)) {
      alert('옳바른 이메일 형식을 입력해주세요.');
      frm.buyerEmail.focus();
      return false;
    }

    frm.prdtExpDate.value = '<?= date('Ymd', strtotime("+1 month", strtotime(date('Ymd')))) ?>';

		if(frm.transType[1].checked){

			if(frm.payMethod.value != "CARD" && frm.payMethod.value != "BANK" && frm.payMethod.value != "VBANK"){
				alert("에스크로에서 지원하지 않는 결제수단입니다.");
				return;
			}else{
				frm.action = "<?= $payActionUrl ?>/webTxInit";
				frm.submit();
			}

		}else{
			frm.action = "<?= $payActionUrl ?>/webTxInit";
			frm.submit();
		}
	}

function regex_email_addr(email) {
  var regEx = /\S+@\S+\.\S+/;
  return regEx.test(email);
}

</script>

<title>tPay::인터넷결제</title>
</head>
<body>
<form id="transMgr" name="transMgr" method="post">
	<!-- <p class="TitleBar">결제 상점 데모 프로그램</p> -->
	<div class="selectList" style="margin-top:20px;">

    <ul style="display:none;">
			<li class="selectBar">
				<label for="">결제수단</label>
				<select name="payMethod" id="payMethod">
					<option value="">[선택]</option>
					<option value="CARD" selected>[신용카드]</option>
					<option value="BANK">[계좌이체]</option>
					<option value="VBANK">[가상계좌]</option>
					<option value="CELLPHONE">[휴대폰결제]</option>
				</select>
				<!-- <input type="button" id="submitBtn" value="결제 전송" onclick="submitForm();"> -->
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">결제타입 <span>*</span></label>
				<label>일반</label><input type="radio" id="transTypeN" name="transType" value="0" checked="checked">
				<label>에스크로</label><input type="radio" id="transTypeE" name="transType" value="1">
			</li>
		</ul>

		<ul>
			<li class="selectBar">
				<label for="">상품명 <span>*</span></label><br>
				<!-- <input type="text" name="goodsName" value="mn_상품명" readonly> -->
        <input type="text" name="goodsName" value="<?=$_POST['product_name']?>" readonly>
			</li>
		</ul>

		<ul>
			<li class="selectBar">
				<label for="">상품가격 <span>*</span></label><br>
				<input type="tel" pattern="[0-9]*" name="amt" value="<?=$_POST['product_price']?>" readonly> <span class="r_txt">원</span>
				<!-- <input type="button" value="금액 변경" onclick="changeAmt();" /> -->
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">상품 주문번호 <span>*</span></label><br>
				<input type="text" name="moid" value="<?=$_POST['order_no']?>" readonly>
			</li>
		</ul>

		<ul>
			<li class="selectBar">
				<label for="">회원키 번호</label><br>
				<input type="text" name="mallUserId" value="<?=$_POST['member_idx']?>" readonly>
			</li>
		</ul>

		<ul>
			<li class="selectBar">
				<label for="">구매자명 <span>*</span></label><br>
				<input type="text" name="buyerName" value="<?=$_POST['order_name']?>" >
			</li>
		</ul>
		<ul>
			<li class="selectBar">
				<label for="">구매자연락처 (- 없이 입력)</label><br>
				<input type="tel" pattern="[0-9]*" maxlength="11" name="buyerTel" value="<?=$_POST['order_tel']?>" >
			</li>
		</ul>
		<ul>
			<li class="selectBar">
				<label for="">구매자 메일주소 <span>*</span></label><br>
				<input type="text" name="buyerEmail" value="<?=$_POST['order_email']?>" readonly>
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">제공기간</label><br>
				<input type="text" name="prdtExpDate" value="<?= date('Y년 m월 d일까지', strtotime("+1 month", strtotime(date('Ymd')))); ?>" readonly>
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">회원사아이디(*)</label><br>
				<input type="text" name="mid" value="<?=$mid ?>" readonly="readonly">
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">결제결과 전송 URL(*)</label><br>
 				<input type="text" name="returnUrl" class="largeInput" value="<?=$payLocalUrl?>" readonly="readonly">
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">결제취소 URL(*)</label><br>
 				<input type="text" name="cancelUrl" class="largeInput" value="<?=$payCancelUrl?>" readonly="readonly">
			</li>
		</ul>


		<ul style="display:none;">
			<li class="selectBar">
				<label for="">가상계좌입금기한(*)</label><br>
				<input type="text" name="vbankExpDate" value="<?=$vbankExpDate?>" readonly="readonly">
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">접속방식(*)</label><br>
				<select name="connType" id="connType">
					<option value="0">Web(M-browser)</option>
					<option value="1" selected>App(BaroBaro)</option>
					<option value="2">App(WebViewController)</option>
				</select>
			</li>
		</ul>

		<ul style="display:none;">
			<li class="selectBar">
				<label for="">앱 스키마</label><br>
				<input type="text" name="appPrefix" value="hjcultures">
			</li>
		</ul>

	</div>

  <div style="padding:20px 10px;">
  	<input type="hidden" name="payType" value="1"><!-- 결제형태 -->
  	<input type="hidden" name="ediDate"	value="<?=$ediDate?>"><!-- 결제일 -->
  	<input type="hidden" name="encryptData" value="<?=$encryptData?>"><!-- 암호화 검증 데이터 -->
  	<input type="hidden" name="userIp"	value="<?= $_SERVER['REMOTE_ADDR']; ?>"><!-- User IP Address -->
  	<input type="hidden" name="browserType" id="browserType" value="">
  	<input type="hidden" name="mallReserved" value="MallReserved">
    <input type="button" id="submitBtn" value="결제 전송" onclick="submitForm();" class="btn_red">
  </div>

</form>

</body>
</html>
