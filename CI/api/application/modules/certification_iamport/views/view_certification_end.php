<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<script type="text/javascript" src="/js/scripts.js"></script>

<input type="hidden" name="agent" id="agent" value="<?=$data['agent'] ?>">

<script>
var member_name = '<?= $data['member_name'] ?>';
var member_phone = '<?= $data['member_phone'] ?>';
var member_gender = '<?= $data['member_gender'] ?>';
var member_birth = '<?= $data['member_birth'] ?>';
var unique_key = '<?= $data['unique_key'] ?>';
var auth_code = '<?= $data['auth_code'] ?>';

// 결제 결과 데이터 전송(웹 ->앱)
function api_request_certification_result(){

	if($('#agent').val()=='android'){
		window.rocateer.payResult(member_name, member_phone, member_gender, member_birth,unique_key, auth_code);

	}else if($('#agent').val()=='ios'){
		var message = {
			            "request_type":"request_certification_result",
      						"member_name" : member_name,
      						"member_phone" : member_phone,
      						"member_gender" : member_gender,
      						"member_birth" : member_birth,
      						"unique_key" : unique_key,
      						"auth_code" : auth_code
						};
		window.webkit.messageHandlers.native.postMessage(message);
	}
}

api_request_payment_result();

// 본인인증 완료 후 결과 데이터 받아오기(앱->웹)
function api_reponse_certification_result(member_name, member_phone, member_gender, member_birth,unique_key, auth_code){

	$("#member_name").val(member_name);
	$("#member_phone").val(member_phone);
	$("#member_gender").val(member_gender);
	$("#member_birth").val(member_birth);
	$("#unique_key").val(unique_key);
	if (auth_code==0) {
		$("#auth_yn").val("Y");
	}else {
		$("#auth_yn").val("N");
	}
}
</script>
