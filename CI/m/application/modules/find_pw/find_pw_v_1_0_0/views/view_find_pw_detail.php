<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
  <h1>비밀번호 찾기</h1>
</header>
<!-- header : e -->
<div class="body row">
  <div class="inner_wrap">
    <form class="find_form">
      <p class="label">아이디<span class="essential"> *</span></p>
      <input type="text" id="member_id" name="member_id"  placeholder="이메일을 입력해 주세요">
      <p class="label">이름<span class="essential"> *</span></p>
      <input type="text" id="member_name" name="member_name" placeholder="이름을 입력해 주세요">
      <p class="label">전화번호<span class="essential"> *</span></p>
      <input type="tel" id="member_phone" name="member_phone" placeholder="'-' 를 제외한 숫자만 입력해 주세요" id="member_phone" name="member_phone" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
    	<div class="btn_space mt30">
        <a href="javascript:void(0)"  onclick="find_pw_member()" class="btn_point btn_full_basic">비밀번호 찾기</a>
      </div>

      <div class="find_result mt30" id="span_result_false" style="display:none;">
        <img src="/images/ic_result_failed.png" alt="불가아이콘">
        <div class="mt30">
          <h2>회원 조회 불가</h2>
        </div>
        <div class="mt20 text">
          일치하는 회원정보를 찾을 수 없습니다. <br>
          다시 한번 확인해주세요.
        </div>
      </div>

      <div class="find_result mt30" id="span_result" style="display:none;">
        <img src="/images/ic_result_success.png" alt="조회아이콘">
        <div class="mt30">
          <h2>회원 조회 완료</h2>
        </div>
        <div class="mt20 text">
          <span class="point_color">김사이</span> 님의 이메일로 <br>
          비밀번호 변경 메일을 발송하였습니다. <br>
          비밀번호 변경 후 로그인 해주세요.
        </div>
      </div>
     
    </form>
  </div>
</div>

<script type="text/javascript">

var email_send_yn ="N";

function find_pw_member(){
  if(email_send_yn =="Y"){
    alert("메일을 발송중입니다.");
    return;
  }
  email_send_yn ="Y";
  
  $("#span_result").css("display","none");
  $("#span_result_false").css("display","none");
 
	var form_data = {
		'member_id' : $('#member_id').val(),
		'member_name' : $('#member_name').val(),
		'member_phone' : $('#member_phone').val()
	};

	$.ajax({
		url      : "/<?=mapping('find_pw')?>/find_pw_member",
		type     : "POST",
		dataType : "json",
		async    : true,
		data     : form_data,
		success  : function(result) {
			//alert(result);
			if(result.code == '-1'){
        $("#span_result").css("display","none");
        $("#span_result_false").css("display","block");

        $("#find_pw_btn").attr("onclick", "find_pw_member()");
        email_send_yn ="N";
				return;
			}else {
				//find_modal_open();
				if(result.code == '0'){
					$("#span_result").css("display","none");
					$("#span_result_false").css("display","block");
          email_send_yn ="N";
				}else{
					$("#span_result_false").css("display","none");
					$("#span_result").css("display","block");
          $("#find_pw_btn").attr("onclick", "");
				}
			}
      
		}
	});
}

</script>
