  <header>
    <a class="btn_back" href="#">
      <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('region')" alt="뒤로가기">
    </a>
    <h1>근무 지역 선택</h1>
  </header>
  <!-- header : e -->
  <div class="body">
    <ul>
      <li>1</li>
      <li>1</li>
      <li>1</li>
      <li>1</li>
      <li>1</li>
      <li>1</li>
      <li>1</li>
      <li>1</li>
      <li>1</li>
    </ul>
    <ul>
      <li>2</li>
      <li>2</li>
      <li>2</li>
      <li>2</li>
      <li>2</li>
      <li>2</li>
      <li>2</li>
      <li>2</li>
      <li>2</li>
    </ul>
  </div>

<script type="text/javascript">


function do_auth(){

  if ($("#auth_yn").val()!='N') {
    alert("본인인증이 완료되었습니다.");
    return;
  }

  var url = "<?=THIS_DOMAIN?>/kmc_web_view/member_auth";

  if(agent =="pc"){
    // location.href =url;
    iamport_window = window.open(url, 'iamport_window', 'width=425, height=550, resizable=0, scrollbars=no, status=0, titlebar=0, toolbar=0, left=435, top=250' );
  }else{
    api_request_open_window(url);
  }
}

// 새창 열기
function api_request_open_window(url){

	 if(agent == 'android') {
		 window.rocateer.request_open_window(url);
	 } else if (agent == 'ios') {
		 var message = {
				'request_type' : 'request_open_window',
				'url' : url,
				};
		 window.webkit.messageHandlers.native.postMessage(message);
	}
}

// 본인인증 완료 후 결과 데이터 받아오기 APP > WEB
function api_reponse_auth(member_name, member_phone, member_gender, member_birth, unique_key, auth_code){

	$("#member_name").val(member_name);
	$("#member_phone").val(member_phone);
	$("#member_gender").val(member_gender);
	$("#member_birth").val(member_birth);
	// $("#unique_key").val(unique_key);
  // alert(auth_code);
	if(auth_code=='Y'){
    $("#auth_btn").html('본인인증 완료');
    $("#auth_yn").val('Y');
    // document.getElementById('auth_div').classList.replace('btn_point', 'btn_deactive');
	}else {
    alert("이미 등록된 번호이거나 기타 사유로 문제가 발생했습니다. 관리자에게 문의해주세요.");
    $("#auth_div").css('background', '#C45654');
		$("#auth_yn").val("N");
    document.getElementById('auth_div').classList.replace('btn_gray_line2', 'btn_point_line');
	}
}

// 가입하기
function default_reg_in(){
  var selected_idx = get_checkbox_value('checkOne');

  if(selected_idx !="Y,Y,P" && selected_idx !="Y,Y"){
    alert("필수 약관 동의에 체크해주세요.");
    return  false;
  }

  var auth_yn = $('#auth_yn').val();
  if (auth_yn!='Y') {
    alert("본인인증을 완료해주세요.");
    return;
  }

  var formData = {
    'gcm_key' :  $('#gcm_key').val(),
    'device_os' :  $('#device_os').val(),
    'member_id' :  $('#member_id').val(),
    'member_pw' :  $('#member_pw').val(),
    'member_pw_confirm' :  $('#member_pw_confirm').val(),
    'member_nickname' :  $('#member_nickname').val(),
    'member_name' :  $('#member_name').val(),
    'member_phone' :  $('#member_phone').val(),
    'member_birth' :  $('#member_birth').val(),
    'member_gender' : $('#member_gender').val(),
    'email_recieved_agree_yn' : $("input[id='email_recieved_agree_yn']:checked").val()
  };

  $.ajax({
    url      : "/<?=mapping('join')?>/join_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
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
