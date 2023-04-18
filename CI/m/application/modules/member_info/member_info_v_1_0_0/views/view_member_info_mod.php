<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>내 정보 수정</h1>
</header>
<!-- header : e -->
<div class="body">
  <div class="inner_wrap row">
    <div class="txt_center">
      <div class="mypage_profile_wrap img_box">
        <img id="member_img_src" src="<?=($result->member_img=='')?'/images/photo_default.png':$result->member_img?>" alt="">
        <img src="/images/btn_camera.png" alt="" class="btn_reg"  onclick="api_request_file_upload('member_img')">
      </div>
      <h4><?=$result->member_id?></h4>
    </div>
    <div class="label">성별</div>
    <h6><div id="birth"><?=($result->member_gender==0)?'남':'여'?></div></h6>
    <div class="label">전화번호</div>
    <h6><div id="phone"><?=$this->global_function->set_phone_number($result->member_phone);?></div></h6>
    <div class="label">본인인증</div>
    <div class="btn_full_weight btn_point_line" id="auth_div">
      <a href="javascript:void(0)" onclick="do_auth()" id="auth_btn">인증받기</a>
    </div>
    <div class="label">닉네임</div>
    <input type="text" value="<?=$result->member_nickname?>" id="member_nickname">
  </div>
  <hr class="space mt30">
  <div class="inner_wrap mt20">
    <h4>나의 추가정보</h4>
    <div class="label">운동 목표</div>
    <select id="exercise_goal_type" name="exercise_goal_type" onchange="select_exercise_goal_type(this.value)">
      <option value="" selected>선택해주세요.</option>
      <option value="0" <?=($result->exercise_goal_type==0)?'selected':''?> >체력 및 몸매 관리</option>
      <option value="1" <?=($result->exercise_goal_type==1)?'selected':''?> >근력 강화</option>
      <option value="2" <?=($result->exercise_goal_type==2)?'selected':''?> >살빼기</option>
      <option value="3" <?=($result->exercise_goal_type==3)?'selected':''?> >여성 성건강 관리</option>
      <option value="4" <?=($result->exercise_goal_type==4)?'selected':''?> >기타</option>
    </select>
    <input type="text" class="mt10" value="<?=($result->exercise_goal_type==4)?$result->exercise_goal:''?>" id="exercise_goal" style="display:<?=($result->exercise_goal_type==4)?'block':'none'?>;" placeholder="기타 운동목표를 적어주세요." >
    <div class="label">운동 시간대</div>
    <div class="flex_1">
      <select name="exercise_s_time" id="exercise_s_time">
        <option value="">선택</option>
        <? for($i=1;$i<25;$i++){?>
        <option value="<?=$i?>" <?=($result->exercise_s_time==$i)?'selected':''?> ><?=$i?>시</option>
        <?}?>
      </select>
      <span>~</span>
      <select name="exercise_e_time" id="exercise_e_time">
        <option value="">선택</option>
        <? for($j=1;$j<25;$j++){?>
        <option value="<?=$j?>" <?=($result->exercise_e_time==$j)?'selected':''?>><?=$j?>시</option>
        <?}?>
      </select>
    </div>
    <div class="label">관심 운동 부위</div>
    <select id="exercise_part_type" name="exercise_part_type" onchange="select_exercise_part_type(this.value)">
      <option value="" selected>선택해주세요.</option>
      <option value="0" <?=($result->exercise_part_type==0)?'selected':''?> >복근</option>
      <option value="1" <?=($result->exercise_part_type==1)?'selected':''?> >엉덩이</option>
      <option value="2" <?=($result->exercise_part_type==2)?'selected':''?> >전신</option>
      <option value="3" <?=($result->exercise_part_type==3)?'selected':''?> >기타</option>
    </select>
    <input type="text" class="mt10" value="<?=($result->exercise_part_type==3)?$result->exercise_part:''?>" id="exercise_part" style="display:<?=($result->exercise_part_type==3)?'block':'none'?>;" placeholder="기타 관심운동부위를 적어주세요." >
    <div class="label">목표 허리둘레</div>
    <div class="flex_1">
      <select name="waist_measurement" id="waist_measurement">
        <option value="" >선택</option>
        <? for($z=20;$z<51;$z++){?>
        <option value="<?=$z?>"  <?=($result->waist_measurement==$z)?'selected':''?> ><?=$z?></option>
        <?}?>
      </select><span style="padding-left:10px">(inch)</span>
    </div>
    <div class="btn_full_weight mt30 mb30 btn_point">
      <a href="javascript:(0)" onclick="default_mod_up()">내 정보 수정</a>
    </div>
  </div>
</div>

<input type="hidden" name="timer_yn" id="timer_yn" value="N">
<input type="hidden" name="timer_cnt" id="timer_cnt" value="0">

<input type="hidden" name="time_over_yn" id="time_over_yn" value="N">
<input type="hidden" name="verify_idx" id="verify_idx" value="">

<input type="hidden" name="device_os" id="device_os" value="">
<input type="hidden" name="gcm_key" id="gcm_key" value="">

<input type="text" name="member_img_path" id="member_img_path" value="<?=$result->member_img?>" placeholder="회원사진" style="display: none;">
<input type="text" name="member_name" id="member_name" value="<?=$result->member_name?>" placeholder="이름" style="display: none;">
<input type="text" name="member_phone" id="member_phone" value="<?=$result->member_phone?>" placeholder="핸드폰"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">
<input type="text" name="member_gender" id="member_gender" value="<?=$result->member_gender?>" placeholder="성별 0남 1여"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">
<input type="text" name="member_birth" id="member_birth" value="<?=$result->member_birth?>" placeholder="생년월일"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">

<input type="hidden" name="auth_yn" id="auth_yn" value="N"> 
<input type="text" name="member_idx" id="member_idx" value="<?=$result->member_idx?>" style="display: none;">

<script type="text/javascript">

function set_one_img(file_path){
    $('#member_img_src').attr("src", file_path);
    $('#member_img_path').val(file_path);

  }

function select_exercise_goal_type(idx){
    if(idx==4){
      // $("#exercise_goal").attr("disabled",false).attr("readonly",false);
      $("#exercise_goal").show(); 
    }else{
      // $("#exercise_goal").attr("disabled",true).attr("readonly",true);
      $("#exercise_goal").hide(); 
    }
  }

function select_exercise_part_type(idx){
    if(idx==3){
      // $("#exercise_part").attr("disabled",false).attr("readonly",false);
      $("#exercise_part").show(); 
    }else{
      // $("#exercise_part").attr("disabled",true).attr("readonly",true);
      $("#exercise_part").hide(); 

    }
  }
  
// 본인인증
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

function phoneFomatter(num,type){
  var formatNum = '';
  if(num.length==11){
      if(type==0){
          formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-****-$3');
      }else{
          formatNum = num.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
      }
  }else if(num.length==8){
      formatNum = num.replace(/(\d{4})(\d{4})/, '$1-$2');
  }else{
      if(num.indexOf('02')==0){
          if(type==0){
              formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-****-$3');
          }else{
              formatNum = num.replace(/(\d{2})(\d{4})(\d{4})/, '$1-$2-$3');
          }
      }else{
          if(type==0){
              formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-***-$3');
          }else{
              formatNum = num.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
          }
      }
  }
  return formatNum;
}

// 본인인증 완료 후 결과 데이터 받아오기 APP > WEB
function api_reponse_auth(member_name, member_phone, member_gender, member_birth, unique_key, auth_code){
  var member_phone_set = phoneFomatter(member_phone,1);

  $("#member_name").val(member_name);
  $("#member_phone").val(member_phone);
  $("#member_gender").val(member_gender);
  $("#member_birth").val(member_birth);
  $("#member_name").text(member_name);
  $("#member_phone").text(member_phone_set);
  $("#member_gender").text(member_gender);
  $("#member_birth").text(member_birth);

  if(member_gender=='0'){
    $("#birth").text('남');
  }else{
    $("#birth").text('여');
  }
  $("#phone").text(member_phone_set);
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

// 회원 정보 수정
function default_mod_up(){

  var formData = {
    'member_idx' :  $('#member_idx').val(),
    'member_img_path' :  $('#member_img_path').val(),
    'member_nickname' :  $('#member_nickname').val(),
    'member_gender' : $('#member_gender').val(),
    'member_name' :  $('#member_name').val(),
    'member_phone' :  $('#member_phone').val(),
    'member_birth' :  $('#member_birth').val(),
    'exercise_goal' :  $('#exercise_goal').val(),
    'exercise_part' :  $('#exercise_part').val(),
    'exercise_goal_type' :  $("select[name='exercise_goal_type']").val(),
    'exercise_part_type' :  $("select[name='exercise_part_type']").val(),
    'exercise_s_time' :  $("select[name='exercise_s_time']").val(),
    'exercise_e_time' :  $("select[name='exercise_e_time']").val(),
    'waist_measurement' :  $("select[name='waist_measurement']").val()
  };

	$.ajax({
		url      : "/<?=mapping('member_info')?>/member_info_mod_up",
		type     : 'POST',
		dataType : 'json',
		async    : true,
		data     : formData,
		success: function(result) {
			if(result.code == '-1'){
				alert(result.code_msg);
				return;
			}
			// 0:실패 1:성공
			if(result.code == 0) {
				alert(result.code_msg);
			} else {
				alert(result.code_msg);
				location.href="/<?=mapping('mypage')?>";
				
			}
		}
	});
}

</script>
