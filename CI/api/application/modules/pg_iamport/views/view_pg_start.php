<!-- 아임포트 결제-->
<script type="text/javascript" src="https://service.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<!-- 아임포트 결제-->
<script>

var IMP = window.IMP; // 생략가능
IMP.init('<?=IMP_CORP_CODE?>'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

function payment_btn(){

	IMP.request_pay({
			pg             : 'kcp', //아임포트 관리자에서 danal_tpay를 기본PG로 설정하신 경우는 생략 가능
			pay_method     : 'card', //card(신용카드), trans(실시간계좌이체), vbank(가상계좌), phone(휴대폰소액결제)
			merchant_uid   : "<?=$_POST['order_number']?>", //상점에서 관리하시는 고유 주문번호를 전달
			name           : "<?=$_POST['product_name']?>", // 주문 상품명
			amount         : "<?=$_POST['product_price']?>", // 주문 가격
			buyer_email    : "<?=$_POST['order_email']?>", // 구매자 이메일
			buyer_name     : "<?=$_POST['order_name']?>", // 구매자 성명
			buyer_tel      : "<?=$_POST['order_tel']?>", // 구매자 번호 (누락되면 카드사 인증에 실패할 수 있으니 기입해주세요)
      m_redirect_url : '<?=THIS_DOMAIN?>/pg_iamport/pg_end',
      app_scheme : 'iamport_tagier' //개발 중인 앱에 정의된 URL scheme을 지정합니다. ://는 포함하지 않습니다.
		},function(rsp) {
			//다날PG의 경우 아래 조건으로 결제 화면이 이동됨
	    if (rsp.success) {
	        var msg = '결제가 완료되었습니다.';
					location.href ='<?=THIS_DOMAIN?>/pg_iamport/pg_end?imp_uid='+rsp.imp_uid+'&merchant_uid='+rsp.merchant_uid+'&imp_success='+rsp.success;
	    } else {
	        var msg = '결제에 실패하였습니다.';
	        msg += '에러내용 :  ' + rsp.error_msg;
					alert(msg);

					var order_no = '';
					var payment_type = '';
					var pg_date = '';
					var pg_price = '';
					var pg_result = 'fail';

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
	});
}


payment_btn();
</script>
