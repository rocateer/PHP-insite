<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
  <h1>아이디 찾기</h1>
</header>

<div class="body">
  <div class="inner_wrap">
    <form class="find_form">
			<ul class="input_ui row">
				<li>
					<label>이름<span class="essential"> *</span></label>
					<input type="text"id="member_name" name="member_name" placeholder="">
				</li>

				<li>
					<label>전화번호<span class="essential"> *</span></label>
					<input type="tel"  placeholder="'-' 를 제외한 숫자만 입력해 주세요" id="member_phone" name="member_phone" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
				</li>

				<div class="btn_space mt30">
					<a href="javascript:void(0)"  onclick="find_id_member()" class="btn_point btn_full_basic">아이디 찾기</a>
				</div>
			</ul>
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
					location.href= "/<?=mapping('find_id')?>/find_id_fail";
				}else{
					location.href= "/<?=mapping('find_id')?>/find_id_success?member_idx="+result.member_idx;
				}
			}
		}
	});
}

</script>
