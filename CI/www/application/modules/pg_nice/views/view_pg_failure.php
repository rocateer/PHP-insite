<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<input type="hidden" name="agent" id="agent" value="<?=$agent?>">

<script>
var order_number = '<?= $order_number ?>';
var payment_type = 'C';
var pg_date = '';
var pg_price = '';
var pg_result = 'N';


// 결제 결과 데이터 전송(웹 ->앱)
function api_request_payment_result(){

	if($('#agent').val()=='android'){
		window.rocateer.payResult(order_number, payment_type, pg_date, pg_price, pg_result);

	}else if($('#agent').val()=='ios'){
		var message = {
			      "request_type":"payResult",
						"order_number" : order_number,
						"payment_type" : payment_type,
						"pg_date" : pg_date,
						"pg_price" : pg_price,
						"pg_result" : pg_result
						};
		window.webkit.messageHandlers.native.postMessage(message);
	}
}
api_request_payment_result();

</script>
