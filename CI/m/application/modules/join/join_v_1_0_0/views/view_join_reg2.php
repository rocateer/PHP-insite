<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
  <h1>회원가입</h1>
</header>
<!-- header : e -->
<div class="body row">
  <div class="inner_wrap">
    <form class="find_form">
      <div>
        <h2>계정 정보 입력
          <div class="step_ui">
            <span class="before"></span>
            <span class="active">2</span>
            <span></span>
          </div>
        </h2>
      </div>
      <ul class="input_ui row mt40">
        <li>
          <label>이릅<span class="essential">*</span></label>
          <input type="text" id="member_name" name="member_name" placeholder="이름을 입력해 주세요.">
        </li>
        <li>
          <label>닉네임<span class="essential">*</span></label>
          <input type="text" id="member_nickname" name="member_nickname" placeholder="닉네임을 입력해 주세요.">
        </li>
        <li>
          <label class="region">지역선택<span class="essential">*</span></label>
          <a href="#" onclick="modal_open('region')" class="btn essential">선택하기</a>
          <input type="text" class="input_dark mt5" id="work_confirm_idx" name="work_confirm_idx" placeholder="주로 활동하는 지역을 선택해주세요">
        </li>
      </ul>
      <div class="all_checkbox row mt40 mb30">
        <ul>
          <li>
            <input type="checkbox" name="checkAll" id="checkAll" >
            <label for="checkAll">
              <span></span>
              전체 약관 동의
            </label>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="checkOne_1" value="Y" >
            <label for="checkOne_1">
              <span></span>
              서비스 이용약관 
              <a href="#" class="essential">필수</a>
            </label>
            <a class="look" href="javascript:void(0)" onclick="modal_open('terms1')" >보기</a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="checkOne_2" value="Y" >
            <label for="checkOne_2">
              <span></span>
              개인정보 취급방침 
              <a href="#" class="essential">필수</a>
            </label>
            <a class="look" href="javascript:void(0)" onclick="modal_open('terms2')">보기</a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="email_recieved_agree_yn" value="P" >
            <label for="email_recieved_agree_yn">
              <span></span>
              마케팅 수신 동의
            </label>
            <a class="look" href="javascript:void(0)" onclick="modal_open('terms0')">보기</a>
          </li>
        </ul>
      </div>
      <div class="btn_space">
        <a href="#" class="btn_point btn_floating">다음</a>
      </div>
    </form>
  </div>
</div>

<?foreach($terms_list as $row){
    ?>
  <!-- modal : s -->
  <div class="modal modal_terms<?=$row->type?>">
    <header>
      <a class="btn_back" href="#">
        <img class="w_100" src="/images/haed_btn_back.png" onclick="modal_close('terms<?=$row->type?>')" alt="뒤로가기">
      </a>
      <h1><?=$row->title?></h1>
    </header>
    <!-- header : e -->
    <div class="body">
      <div id="edit">
      <?=$row->contents?>
      </div>
    </div>
  </div>
  <!-- modal : e -->
<?}?>

<!-- 지역선택 모달 -->
  <div class="modal modal_region" id="region_ajax" style="display:block">
    <header>
      <a class="btn_back" href="#">
        <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('region')" alt="뒤로가기">
      </a>
      <h1>근무 지역 선택</h1>
    </header>
    <!-- header : e -->
    <div class="modal_body">
      <ul class="area_title">
        <li>지역구분</li>
        <li>시 · 군 · 구</li>
      </ul>
      <div class="region_ui">
        <ul class="area_item_1">
          <li class="active">연습</li>
        <?foreach($city_list as $row){?>
          <li value="<?=$row->city_name?>"><?=$row->city_name?></li>
        <?}?>
        </ul>
        <ul class="area_item_2" name="region_code" id="region_code">
          <li class="active">연습</li>
          <li class="active">연습</li>
          <li class="active">연습</li>
          <li class="active">연습</li>
          <li class="active">연습</li>
          <li class="active">연습</li>
          <li class="active">연습</li>
          <li class="active">연습</li>
        </ul>
      </div>
    </div>
    <a href="#" class="btn_point btn_floating">선택</a>
  </div>
<!-- 지역 선택 모달 -->

<input type="text" name="member_name" id="member_name" value="" placeholder="이름" style="display: none;">
<input type="text" name="member_phone" id="member_phone" value="" placeholder="핸드폰"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">
<input type="text" name="member_gender" id="member_gender" value="" placeholder="성별 0남 1여"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">
<input type="text" name="member_birth" id="member_birth" value="" placeholder="생년월일"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">

<input type="hidden" name="device_os" id="device_os" value="">
<input type="hidden" name="gcm_key" id="gcm_key" value="">

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

//시,구,군 가져오기
var region_list = function(city_name) {

$.ajax({
  url: "/common/region_list",
  type: 'POST',
  dataType: 'json',
  async: true,
  data: {
      "city_name" : city_name
  },
  success: function(dom){
    var selectStr = "";

    $('#region_code').html("<li value=''>선택</li>");
    if(dom.length != 0) {
      for(var i = 0; i < dom.length; i ++) {
        selectStr += "<li value='"+ dom[i].region_code  + "'>" + dom[i].region_name + "</li>";
      }
      $('#region_code').append(selectStr);
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
