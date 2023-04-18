<!-- jQuery -->
 <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
 <!-- iamport.payment.js -->
 <script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>
<!-- 아임포트 결제-->
<script>

var IMP = window.IMP; // 생략가능
IMP.init('<?=IMP_CORP_CODE?>'); // 'iamport' 대신 부여받은 "가맹점 식별코드"를 사용

// var IMP = window.IMP; // 생략해도 괜찮습니다.
//  IMP.init("imp00000000"); // "imp00000000" 대신 발급받은 "가맹점 식별코드"를 사용합니다.


function certification_btn(){

	IMP.certification({
			merchant_uid   : "<?=time()?>", //상점에서 관리하시는 고유 주문번호를 전달
      app_scheme : 'empo://' //개발 중인 앱에 정의된 URL scheme을 지정합니다. ://는 포함하지 않습니다.
		},function(rsp) {
	    if (rsp.success) {
	        var msg = '결제가 완료되었습니다.';
					//alert(msg);
					location.href="/certification_iamport/certification_end?imp_success=Y&imp_uid="+rsp.imp_uid+"&merchant_uid="+rsp.merchant_uid;
	    } else {
	        var msg = '인증에 실패하였습니다.';
	        msg += '에러내용 :  ' + rsp.error_msg;
			    alert(msg);
					location.href="/certification_iamport/pay_failure";
	    }
	});
}


certification_btn();
</script>
