<header class="transparent">
	<a class="btn_back" href="javascript: location.href='/<?=mapping('mypage')?>';"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>설정</h1>
</header>
<div class="body">
    <div class="st_body">
      <div class="st_title mt10">고객지원</div>
      <ul class="st_ul mt10">
        <li onclick='location.href="/<?=mapping('notice')?>"'>
        공지사항
        </li>
        <li onclick='location.href="/<?=mapping('faq')?>"'>
          FAQ
        </li>
        <li onclick='location.href="/<?=mapping('qa')?>"'>
          1:1 문의
        </li>
    </ul>
    <div class="st_title mt30">약관</div>
    <ul class="st_ul mt10">
      <li onclick='location.href="/<?=mapping('terms')?>/terms_detail?type=1"'>
        서비스 이용약관
      </li>
      <li onclick='location.href="/<?=mapping('terms')?>/terms_detail?type=0"'>
        개인정보 취급 방침
      </li>
      <li onclick='location.href="/<?=mapping('terms')?>/terms_detail?type=5"'>
        마케팅 정보 수신 동의
      </li>
    </ul>
    <div class="st_title mt30">기타</div>
    <ul class="st_ul mt10">
    <li onclick="logout_action()">
        로그아웃
      </li>
      <li onclick='location.href="/<?=mapping('member_out')?>"'>
        회원탈퇴
      </li>
    </ul>
  </div>
</div>

<script type="text/javascript">
//로그아웃
function logout_action(){

  if (!confirm("로그아웃 하시겠습니까?")) {
    return;
  }

  if(app_yn=="Y"){
    api_request_logout();
    setTimeout(function() {
      logout_url();
     }, 1000);
  }else{
    logout_url();
  }
}

//브릿지::로그아웃
function api_request_logout(){
  if( agent == 'android') {
    window.rocateer.request_logout();
  } else if ( agent == 'ios') {
    var message = {
                   "request_type" : "request_logout"
                  };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

//로그아웃
function logout_url(){
  location.href="/logout/logout?type=0";
}

// 외부링크 이동 :: 사업자 정보 확인
function api_request_external_link(url){
  if(agent == 'android') {
    window.rocateer.request_external_link(url);
  } else if (agent == 'ios') {
    var message = {
                   "request_type" : "request_external_link",
                   "url" : url,
                  };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

// 알림 설정
function all_alarm_yn_mod_up(all_alarm_yn){

  var formData = {
    "all_alarm_yn" : all_alarm_yn
  };

  $.ajax({
    url      : "/<?=mapping('setting')?>/all_alarm_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert("상태변경 성공하였습니다.");
        location.reload();
      }
    }
  });
}
</script>

