<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>회원가입</h1>
</header>
<!-- header : e -->
<div class="body row">
  <div class="inner_wrap">
    <form class="find_form">
      <p class="label">본인인증<span class="essential"> *</span></p>
      <div class="btn_full_weight btn_point_line" id="auth_div">
        <a href="javascript:void(0)" onclick="do_auth()" id="auth_btn">본인인증</a>
      </div>
      <p class="label">닉네임<span class="essential"> *</span></p>
      <input type="text" id="member_nickname" name="member_nickname" placeholder="2~8자리의 닉네임을 입력해 주세요.">
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
              <p>서비스 이용약관 <i class="essential">*</i></p>
            </label>
            <a class="arrow" href="javascript:void(0)" onclick="modal_open('terms1')"></a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="checkOne_2" value="Y" >
            <label for="checkOne_2">
              <span></span>
              <p>개인정보 이용방침 <i class="essential">*</i></p>
            </label>
            <a class="arrow" href="javascript:void(0)" onclick="modal_open('terms0')"></a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="sms_recieved_agree_yn" value="P" >
            <label for="sms_recieved_agree_yn">
              <span></span>
              <p>마케팅 활용 동의, SMS 수신동의</p>
            </label>
            <a class="arrow" href="javascript:void(0)" onclick="modal_open('terms5')"></a>
          </li>
        </ul>
      </div>
      <div class="btn_point btn_full_weight mb30">
        <a href="javascript:(0)" onclick="default_reg_in()">회원가입</a>
      </div>
    </form>
  </div>
</div>

<?foreach($terms_list as $row){
    ?>
  <!-- modal : s -->
  <div class="modal modal_terms<?=$row->type?>">
    <header>
      <a class="btn_close" href="javascript:void(0)" onclick="modal_close('terms<?=$row->type?>')"><img src="/images/head_btn_close.png" alt="닫기"></a>
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


<input type="text" name="member_name" id="member_name" value="" placeholder="이름" style="display: none;">
<input type="text" name="member_phone" id="member_phone" value="" placeholder="핸드폰"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">
<input type="text" name="member_gender" id="member_gender" value="" placeholder="성별 0남 1여"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">
<input type="text" name="member_birth" id="member_birth" value="" placeholder="생년월일"  onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="display: none;">

<input type="hidden" name="auth_yn" id="auth_yn" value="N">

<input type="hidden" name="timer_yn" id="timer_yn" value="N">
<input type="hidden" name="timer_cnt" id="timer_cnt" value="0">

<input type="hidden" name="time_over_yn" id="time_over_yn" value="N">
<input type="hidden" name="verify_idx" id="verify_idx" value="">

<input type="text" name="member_join_type" id="member_join_type" value="<?=$member_join_type?>" style="display:none;">
<input type="text" name="member_id" id="member_id" value="<?=$member_id?>" style="display:none;">
<input type="text" name="gcm_key" id="gcm_key" value="<?=$gcm_key?>" style="display:none;">
<input type="text" name="device_os" id="device_os" value="<?=$device_os?>" style="display:none;">

<script>
  function do_auth(){

    if ($("#auth_yn").val()=='Y') {
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
    'member_join_type' :  $('#member_join_type').val(),
    'member_id' :  $('#member_id').val(),
    'gcm_key' :  $('#gcm_key').val(),
    'device_os' :  $('#device_os').val(),
    'sms_recieved_agree_yn' :  $("input[id='sms_recieved_agree_yn']:checked").val(),
    'member_nickname' :  $('#member_nickname').val(),
    'member_name' :  $('#member_name').val(),
    'member_phone' :  $('#member_phone').val(),
    'member_birth' :  $('#member_birth').val(),
    'member_gender' : $('#member_gender').val()
  };

  $.ajax({
    url      : "/<?=mapping('join')?>/sns_add_info_mod_up",
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
        // alert(result.code_msg);
        location.href ='/<?=mapping('join')?>/join_complete_detail2';
      }
    }
  });
}


</script>


