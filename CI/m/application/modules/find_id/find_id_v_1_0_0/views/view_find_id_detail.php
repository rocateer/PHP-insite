<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>아이디 찾기</h1>
</header>

<div class="body">
  <div class="inner_wrap">
    <form class="find_form">
      <p class="label">이름<span class="essential"> *</span></p>
      <input type="text" id="member_name" name="member_name" placeholder="이름을 입력해 주세요">
      <p class="label">전화번호<span class="essential"> *</span></p>
      <input type="tel" placeholder="'-' 를 제외한 숫자만 입력해 주세요" id="member_phone" name="member_phone" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
      <div class="btn_point btn_full_weight mt30 mb30">
        <a href="javascript:void(0)"  onclick="find_id_member()">아이디 찾기</a>
      </div>
      <div class="find_result" id="span_result_false" style="display:none;">
        일치하는 회원정보가 없습니다.
      </div>
      <div class="find_result" id="span_result" style="display:none;">
        회원님의 아이디입니다.
        <p class="point" id="span_member_id"></p>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">

function find_id_member(){

	var form_data = {
		'member_name' : $('#member_name').val(),
		'member_phone' : $('#member_phone').val(),
	};

	$.ajax({
		url      : "/<?=mapping('find_id')?>/find_id_member",
		type     : "POST",
		dataType : "json",
		async    : true,
		data     : form_data,
		success  : function(result) {
			if(result.code == '-1'){
				alert(result.code_msg);
				$("#"+result.focus_id).focus();
				return;
			}else {
				if(result.code == '0'){
					$("#span_result").css("display","none");
					$("#span_result_false").css("display","block");
				}else{
					$("#span_result_false").css("display","none");
					$("#span_result").css("display","block");
					$("#span_member_id").html(result.member_id);
				}

			}
		}
	});
}

</script>
