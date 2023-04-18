<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>비밀번호 변경</h1>
</header>
<!-- header : e -->
<div class="vh_wrap row">
	<div class="vh_body body">
		<div class="form inner_wrap">
			<p class="label">기존 비밀번호 <span class="essential">*</span></p>
			<input type="password" placeholder="기존 비밀번호를 입력해 주세요" id="member_pw" name="member_pw">
			<p class="label">새 비밀번호 <span class="essential">*</span></p>
			<input type="password" id="member_pw_new" name="member_pw_new" placeholder="영문, 숫자, 특수문자 조합 8~15자리로 입력">
			<p class="label">새 비밀번호 확인 <span class="essential">*</span></p>
			<input type="password" id="member_pw_new_confirm" name="member_pw_new_confirm" placeholder="영문, 숫자, 특수문자 조합 8~15자리로 입력">
		</div>
	</div>
	<div class="vh_footer btn_full_weight btn_point mt30 mb30">
		<a href="javascript:void(0)" onclick="member_pw_mod_up()">비밀번호 변경</a>
	</div>
</div>



<script type="text/javascript">

function enterkey() {
  if (window.event.keyCode == 13) {
    // 엔터키가 눌렸을 때 실행할 내용
    member_pw_mod_up();
  }
}

function member_pw_mod_up(){

	var form_data = {
		'member_pw' : $('#member_pw').val(),
		'member_pw_new' : $('#member_pw_new').val(),
		'member_pw_new_confirm' : $('#member_pw_new_confirm').val()
	};

	$.ajax({
		url: "/<?=mapping('member_pw_change')?>/member_pw_mod_up",
		type: 'POST',
		dataType: 'json',
		async: true,
		data: form_data,
		success: function(result){

			if(result.code == '-1'){
				alert(result.code_msg);
				$("#"+result.focus_id).focus();
				return;
			}
			// -1000:실패 1000:성공
			if(result.code == '1000') {
				alert(result.code_msg);
	      location.href ='/<?=mapping('mypage')?>';
			} else {
				alert(result.code_msg);
			}
		}
	});
}

</script>

