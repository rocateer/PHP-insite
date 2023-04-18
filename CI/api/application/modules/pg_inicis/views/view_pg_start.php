<!DOCTYPE html>
<html>
<head>
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
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />
<script type="application/x-javascript">

    addEventListener("load", function()
    {
        setTimeout(updateLayout, 0);
    }, false);

    var currentWidth = 0;

    function updateLayout()
    {
        if (window.innerWidth != currentWidth)
        {
            currentWidth = window.innerWidth;

            var orient = currentWidth == 320 ? "profile" : "landscape";
            document.body.setAttribute("orient", orient);
            setTimeout(function()
            {
                window.scrollTo(0, 1);
            }, 100);
        }
    }

    setInterval(updateLayout, 400);

</script>

<script language=javascript>
window.name = "BTPG_CLIENT";

var width = 330;
var height = 480;
var xpos = (screen.width - width) / 2;
var ypos = (screen.width - height) / 2;
var position = "top=" + ypos + ",left=" + xpos;
var features = position + ", width=320, height=440";
var date = new Date();
var date_str = "testoid_"+date.getFullYear()+""+date.getMinutes()+""+date.getSeconds();
if( date_str.length != 16 )
{
    for( i = date_str.length ; i < 16 ; i++ )
    {
        date_str = date_str+"0";
    }
}
function setOid()
{
    document.ini.P_OID.value = ""+date_str;
}

function on_app()
{
       	var order_form = document.ini;
		var paymethod;
		if(order_form.paymethod.value == "wcard")
			paymethod = "CARD";
		else if(order_form.paymethod.value == "mobile")
			paymethod = "HPP";
		else if(order_form.paymethod.value == "vbank")
			paymethod = "VBANK";
		else if(order_form.paymethod.value == "culture")
			paymethod = "CULT";
		else if(order_form.paymethod.value == "hpmn")
			paymethod = "HPMN";

       	param = "";
       	param = param + "mid=" + order_form.P_MID.value + "&";
       	param = param + "oid=" + order_form.P_OID.value + "&";
       	param = param + "price=" + order_form.P_AMT.value + "&";
       	param = param + "goods=" + order_form.P_GOODS.value + "&";
       	param = param + "uname=" + order_form.P_UNAME.value + "&";
       	param = param + "mname=" + order_form.P_MNAME.value + "&";
       	param = param + "mobile=" + order_form.P_MOBILE.value + "&";
       	param = param + "paymethod=" + paymethod + "&";
       	param = param + "noteurl=" + order_form.P_NOTEURL.value + "&";
       	param = param + "ctype=1" + "&";
       	param = param + "returl=" + "&";
       	param = param + "reqtype=WEB&";
       	param = param + "email=" + order_form.P_EMAIL.value;
		var ret = location.href="INIpayMobile://" + encodeURI(param);

		setTimeout
            (
                function()
                {
                    if(confirm("INIpayMobile이 설치되어 있지 않아 App Store로 이동합니다. 수락하시겠습니까?"))
                    {
                        document.location="http://phobos.apple.com/WebObjects/MZStore.woa/wa/viewSoftware?id=351845229&;mt=8";
                    }
                    return;
                }
            )

}

function on_web()
{
	var order_form = document.ini;
	var paymethod = order_form.paymethod.value;
	/*
	var wallet = window.open("", "BTPG_WALLET", features);

	if (wallet == null)
	{
		if ((webbrowser.indexOf("Windows NT 5.1")!=-1) && (webbrowser.indexOf("SV1")!=-1))
		{    // Windows XP Service Pack 2
			alert("팝업이 차단되었습니다. 브라우저의 상단 노란색 [알림 표시줄]을 클릭하신 후 팝업창 허용을 선택하여 주세요.");
		}
		else
		{
			alert("팝업이 차단되었습니다.");
		}
		return false;
	}
	*/

	if (( paymethod == "bank")||(paymethod == "wcard"))
		order_form.P_APP_BASE.value = "";
	//order_form.target = "BTPG_WALLET";
	order_form.target = "_self";
	order_form.action = "https://mobile.inicis.com/smart/" + paymethod + "/";
	order_form.submit();
}

function onSubmit()
{

	var order_form = document.ini;
	var inipaymobile_type = order_form.inipaymobile_type.value;
	var paymethod = order_form.paymethod.value;
/*
	if( inipaymobile_type == "app" && paymethod == "bank" )
		return false;
*/
	if( inipaymobile_type == "app" )
		return on_app();
	else if( inipaymobile_type == "web" )
		return on_web();
}

</script>
<form id="form1" name="ini" method="post" action="" accept-charset="euc-kr" >
<input type="hidden" name="inipaymobile_type"  value="web" >
<input type="hidden" name="paymethod"          value="wcard" >
<input type="hidden" name="P_MID"              value="<?=INICIS_MID?>" /><!--업체키 -->
<input type="hidden" name="P_MNAME"            value="<?=CORP_NAME?>" /><!--업체명 -->

<input type="hidden" name="P_OID"              value="<?=$_POST['order_number']?>" /><!--주문번호 -->
<input type="hidden" name="P_GOODS"            value="<?=$_POST['product_name']?>"  /><!--상품명-->
<input type="hidden" name="P_AMT"              value="<?=$_POST['product_price']?>"  /><!--상품가격:결제금액 -->

<input type="hidden" name="P_UNAME"            value="<?=$_POST['order_name']?>"  /> <!--주문자이름 -->
<input type="hidden" name="P_MOBILE"           value="<?=$_POST['order_tel']?>" /><!--주문자연락처 -->
<input type="hidden" name="P_EMAIL"            value="<?=$_POST['order_email']?>"  /><!--주문자이메일 -->

<input type=hidden name="P_NEXT_URL"          value="<?=INICIS_PAY_DOMAIN?>/pg_end"><!--결제적용 -->
<input type=hidden name="P_RETURN_URL"         value="<?=INICIS_PAY_DOMAIN?>">
<input type=hidden name="P_NOTI_URL"           value="<?=INICIS_PAY_DOMAIN?>">
<input type=hidden name="P_CANCEL_URL"         value="<?=THIS_DOMAIN?>">
<input type=hidden name="P_HPP_METHOD"         value="1">
<input type=hidden name="P_APP_BASE"           value="">
<input type=hidden name="P_RESERVED"           value="ismart_use_sign=Y&block_isp=Y&twotrs_isp=Y&twotrs_isp_noti=N&apprun_check=Y";>
</form>
<!---//이니시스 결제 end-->
<!---//이니시스 결제 end-->
<!---//이니시스 결제 end-->



<div class="selectList" style="margin-top:20px;">
  <ul style="display:none;">
    <li class="selectBar">
      <label for="">상품 주문번호 <span>*</span></label><br>
      <?=$_POST['order_no']?>
    </li>
  </ul>
    <ul style="display:none;">
			<li class="selectBar">
				<label for="">결제수단</label>
			  [신용카드]

			</li>
		</ul>
		<ul>
			<li class="selectBar">
				<label for="">상품명 <span>*</span></label><br>
        <?=$_POST['product_name']?>
			</li>
		</ul>

		<ul>
			<li class="selectBar">
				<label for="">상품가격 <span>*</span></label><br>
				<?=$_POST['product_price']?>
			</li>
		</ul>
		<ul>
			<li class="selectBar">
				<label for="">구매자명 <span>*</span></label><br>
				<?=$_POST['order_name']?>
			</li>
		</ul>
		<ul>
			<li class="selectBar">
				<label for="">구매자연락처 (- 없이 입력)</label><br>
				<?=$_POST['order_tel']?>
			</li>
		</ul>
		<ul>
			<li class="selectBar">
				<label for="">구매자 메일주소 <span>*</span></label><br>
				<?=$_POST['order_email']?>
			</li>
		</ul>

	</div>

  <div style="padding:20px 10px;">
    <input type="button" id="submitBtn" value="결제 전송" onclick="onSubmit();" class="btn_red">
  </div>
