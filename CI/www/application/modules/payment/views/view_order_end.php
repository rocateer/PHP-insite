  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" />
  <link rel="apple-touch-icon" href=""/>
  <link rel="apple-touch-startup-image" href="" />
  <style type="text/css">
    .btn_red{background:#ed1746; color:#fff; border: none; width:100%; display: block; padding:12px; font-size: 14px;}
  </style>


	<div style="padding:100px 10px 0 10px; text-align:center;">
		<img src="/images/img_check.png" style="width:40px;">
		<p style="margin:20px 0 100px 0; font-size:14px;">결제가 성공적으로 이루어 졌습니다!</p>
    <input type="hidden" id="agent" value="<?=$agent?>"/>
		<!-- <input type="button" id="" value="확인" onclick="pay_ok();" class="btn_red"> -->
	</div>

<script>

var order_no = '<?= $order_no ?>';
var payment_type = '<?= $payment_type ?>';
var pg_date = '<?= $pg_date ?>';
var pg_price = '<?= $pg_price ?>';
var pg_result = '<?= $pg_result ?>';

$(document).ready(function(){
  send_success_msg();
});


// send_success_msg
function send_success_msg() {

  if($('#agent').val() == 'android') {

    window.rocateer.payResult(order_no, payment_type, pg_date, pg_price, pg_result);

  } else if ($('#agent').val() == 'ios') {

    var message = {
                   "order_no" : order_no,
                   "payment_type" : payment_type,
                   "pg_date" : pg_date,
                   "pg_price" : pg_price,
                   "pg_result" : pg_result
                  };

    window.webkit.messageHandlers.native.postMessage(message);

  }

}

</script>
