<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
  <h1>회원가입</h1>
</header>
<!-- header : e -->
<div class="body row">
  <div class="inner_wrap">
    <form class="find_form" name="form_default" id="form_default" method="post">
      <div>
        <h2>
          기본 정보 입력
          <div class="step_ui">
            <span class="active">1</span>
            <span></span>
            <span></span>
          </div>
        </h2>
      </div>
      <ul class="input_ui row mt40">
        <li>
          <label>이메일<span class="essential">*</span></label>
          <div class="flex_1">
            <input type="text" id="member_email" name="member_email" placeholder="이메일 주소를 입력해 주세요">
            <span>@</span>
            <select id="email_type" name="email_type">
              <option>선택하세요</option>
              <option>naver.com</option>
              <option>gmail.com</option>
              <option>hanmail.net</option>
              <option>nate.com</option>
              <option>daum.net</option>
              <option>icloud.com</option>
              <option>hotmail.com</option>
              <option>kakao.com</option>
              <option>직접 입력</option>
            </select>
          </div>
          <input type="text" id="member_addr" name="member_email" placeholder="이메일을 직접 입력해 주세요." style="display: none;">
        </li>
        <li>
          <label>비밀번호<span class="essential">*</span></label>
          <input type="password" id="member_pw" name="member_pw" placeholder="영문, 숫자, 특수문자 조합 8~15자리로 입력해 주세요.">
        </li>
        <li>
          <label>비밀번호 확인<span class="essential">*</span></label>
          <input type="password" id="member_pw" name="member_pw" placeholder="영문, 숫자, 특수문자 조합 8~15자리로 입력해 주세요.">
        </li>
      </ul>
      <div class="btn_space">
        <a href="#" class="btn_point btn_floating">다음</a>
      </div>
    </form>
  </div>
</div>

<input type="hidden" name="device_os" id="device_os" value="">
<input type="hidden" name="gcm_key" id="gcm_key" value="">

<script type="text/javascript">

// 가입하기
function default_reg_in(){

  $.ajax({
    url      : "/<?=mapping('join')?>/join_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : $("#form_default").serialize(),
    success: function(result){
      if(result.code == '-1'){

        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      } else {
        alert(result.code_msg);
        location.href ='/<?=mapping('join')?>/join_complete_detail';
      }
    }
  });
}

</script>

<script>
var agent ="<?=$agent?>";
//  요청 :: 디바이스 gcmkey
function api_request_device_gcmkey(){
  if(agent == 'android') {
    window.rocateer.request_device_gcmkey();
  } else if (agent == 'ios') {
    var message = {
           "request_type" : "request_device_gcmkey",
          };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

//  응답 :: 앱에서 받아서  데이타 처리
function api_reponse_device_gcmkey(device_os,gcm_key){
  $("#device_os").val(device_os);
  $("#gcm_key").val(gcm_key);
}

$(function(){
  if(agent!="pc"){
    setTimeout(function() {
          api_request_device_gcmkey();
     }, 2000);
  }
});

</script>
