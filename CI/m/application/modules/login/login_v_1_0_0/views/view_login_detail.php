<!-- header : s -->
<div class="login_wrap">
  <header class="transparent">
    <a class="btn_back" href="/<?=mapping('main')?>">
      <img src="/images/head_btn_close.png" alt="닫기">
    </a>
  </header>
  <!-- header : e -->
  <img src="/images/logo_login.png" alt="<?=SERVICE_NAME?>" class="logo">
    <form action="">
    <input type="text" id="member_id" name="member_id" class="login_input_id" placeholder="아이디">
    <input type="password" id="member_pw" name="member_pw" class="login_input_pw" placeholder="비밀번호">

    
    <div class="btn_space mt30">
      <a href="#" class="btn_point btn_full_basic">선택</a>
    </div>

    <ul class="login_find_ul">
      <li style="border: 1px solid red;">
        <a href="/<?=mapping('find_id')?>">아이디 찾기</a>
      </li>
      <li>
        <a href="/<?=mapping('find_pw')?>">비밀번호 찾기</a>
      </li>
    </ul>
    <div class="or">또는</div>
     <div class="sns_ul">
        <a href="javascript:void(0)" onclick="$('#member_join_type').val('N');api_request_sns_login('N');">
          <img src="/images/naver_logo.png" alt="네이버로그인">
        </a>
    
        <a href="javascript:void(0)" onclick="$('#member_join_type').val('K');api_request_sns_login('K');">
          <img src="/images/kakao_logo.png" alt="카카오로그인">
        </a>
      <? if($agent=='ios'){ ?>
          <a href="javascript:void(0)" onclick="$('#member_join_type').val('A');api_request_sns_login('A');">
            <img src="/images/apple_logo.png" alt="Apple로그인">
          </a>
      <? } ?>
      </div>
      <ul class="login_find_ul">
        <li>
          아직 인사이트 회원이 아니신가요?
        </li>
        <a href="javascript:void(0)" onclick="$('#member_join_type').val('N');api_request_sns_login('N');"> 회원가입
        </a>
  
      </ul>
  </form>
</div>

<input type="hidden" name="sns_member_id" id="sns_member_id" value="">
<input type="hidden" name="member_join_type" id="member_join_type" value="C">
<input type="text" name="device_os" id="device_os" value="" style="display: none;">
<input type="text" name="gcm_key" id="gcm_key" value="" style="display:none;">
<input type="hidden" name="return_url" id="return_url" value="<?=$return_url?>">
<!-- <input type="hidden" name="return_url" id="return_url" value=""> -->

<form id="hidden_form" name="hidden_form"  method="get" >
	<?php
	foreach($_GET as $key => $value){
	if($key !="return_url"){
	?>
	<input type="hidden" name="<?=$key?>" id="<?=$key?>" value="<?=$value?>">
	<?php }}?>
</form>

<script>
//api sns 로그인 member_join_type : 회원 가입타입(C:일반,K:카카오톡,G:구글,N:네이버 )
function api_request_sns_login(member_join_type){

	if(agent == 'android') {
		window.rocateer.request_sns_login(member_join_type);
	} else if (agent == 'ios') {
		var message = {
									 "request_type" : "request_sns_login",
									 "member_join_type" : member_join_type,
									 "marketing_yn" : ''
									};
		window.webkit.messageHandlers.native.postMessage(message);
	}
}

// [브릿지] SNS 로그인  완료 시 :: 앱->웹
function api_response_sns_login(member_join_type, member_id, gcm_key, device_os){

  $("#gcm_key").val(gcm_key);
  $("#device_os").val(device_os);
  $("#member_join_type").val(member_join_type);
  $("#sns_member_id").val(member_id);

  sns_join_check(member_join_type, member_id, gcm_key, device_os);
}
// 소셜로그인 회원가입 체크
function sns_join_check(member_join_type, member_id, gcm_key, device_os){

  var form_data = {
    'member_join_type' : member_join_type,
    'member_id' : member_id,
    'device_os' : device_os,
    'gcm_key' : gcm_key
  };

  $.ajax({
    url      : "/<?=mapping('login')?>/sns_member_login",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){

      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }

      // 0:실패 1:성공
      if(result.code == "0") {
        //추가정보 입력필요
        // alert(result.code_msg);
        location.href ="/<?=mapping('join')?>/sns_add_info_reg_in?member_join_type="+member_join_type+"&member_id="+member_id+"&gcm_key="+gcm_key+"&device_os="+device_os;
      } else {
        if(app_yn=="Y"){
          api_request_login('C',result.member_idx,result.member_name);
          setTimeout(function() {
            member_login_url();
          }, 1000);
        }else{
          member_login_url();
        }
      }
    },
    error : function(request,status,error){
      alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
    }

  });

}
</script>


<script>
//일반로그인
var return_url = "<?=$return_url?>";
var agent ="<?=$agent?>";
var member_gender = 3;

function login_action_member(){

var form_data = {
  'device_os' : $('#device_os').val(),
  'gcm_key' : $('#gcm_key').val(),
  'member_id' : $('#member_id').val(),
  'member_pw' : $('#member_pw').val()
};

$.ajax({
  url      : "/<?=mapping('login')?>/login_action_member",
  type     : 'POST',
  dataType : 'json',
  async    : true,
  data     : form_data,
  success: function(result){

    member_gender = result.member_gender;

    if(result.code == '-1'){
      alert(result.code_msg);
      $("#"+result.focus_id).focus();
      return;
    }
    // 0:실패 1:성공
    if(result.code == "0") {
      alert(result.code_msg);
    } else {
      alert(result.code_msg);
      if(app_yn=="Y"){
        api_request_login('C',result.member_idx,result.member_name);
        setTimeout(function() {
          member_login_url();
         }, 1000);
      }else{
        member_login_url();
      }
    }
  }
});
}
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


<script>
//api로그인
function api_request_login(user_type,user_idx,user_name){
  if(agent == 'android') {
    window.rocateer.request_login(user_type,user_idx,user_name);
  } else if (agent == 'ios') {
    var message = {
                  "request_type" : "request_login",
                  "user_type" : user_type,
                  "user_idx" : String(user_idx),
                  "user_name" : user_name,
                  };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

// 로그인후  url
function member_login_url(){
<?if($return_url !=""){?>
  if(member_gender==1){
    $("#hidden_form")[0].action=return_url;
    $("#hidden_form")[0].submit();
  }else{
    if(return_url=="/<?=mapping('community')?>"){
      alert("죄송합니다. 커뮤니티는 여성 전용 서비스입니다. 다른 서비스를 이용해 주세요!");
      location.href ='/<?=mapping('main')?>';
    }else{
      $("#hidden_form")[0].action=return_url;
      $("#hidden_form")[0].submit();
    }
  }

<?}else{?>
location.href ='/<?=mapping('main')?>';
<?}?>
}

//history.back 금지
//history.replaceState({ data: 'testData2' }, null, document.referrer);
</script>


