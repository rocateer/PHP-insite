<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
  <h1>회원가입</h1>
</header>
<!-- header : e -->
<div class="body row">
  <div class="inner_wrap">
    <form class="find_form">
      <div>
        <h2>인증
          <div class="step_ui">
            <span class="before"></span>
            <span class="active">2</span>
          </div>
        </h2>
      </div>
      <ul class="input_ui row mt40">
        <li>
          <label>번호인증<span class="essential">*</span></label>
          <div style="border-bottom: 1px solid #444">
            <input class="mt5" type="number" id="member_phone" name="member_phone" placeholder="휴대폰 번호를 입력해 주세요" style="width:65%;border-bottom:none;" pattern="\d*">
            <div class="btn_ghost" style="padding-top:5px;">
              <span style="display:;" onclick="tel_verify_setting();">
                인증번호 전송
              </span> 
              <span style="display:none;" onclick="tel_verify_confirm();">
                인증번호 재전송
              </span> 
            </div>
          </div>
          <div class="mt5" style="border-bottom: 1px solid #444">
            <input type="text" id="member_email" name="member_email" placeholder="인증번호를 입력해주세요" style="width:65%;border-bottom:none;" pattern="\d*">
            <div class="btn_ghost">
              <span>
                인증하기
              </span> 
            </div>
          </div>
        </li>
        <li>
          <label class="region">직종인증</label>
          <a href="#" onclick="modal_open('region')" class="btn essential">인증하기</a>
          <input type="text" class="input_dark mt5" id="work_confirm_idx" name="work_confirm_idx" placeholder="인증 후 많은 전문가들과 소통하세요">
        </li>
      </ul>
      <div class="btn_space">
        <a href="javascript:void(0)" class="btn_point btn_floating" onclick="default_reg_in()">시작하기</a>
      </div>
    </form>
  </div>
</div>

<!-- 모달 -->
<div class="modal modal_region">
  <header>
    <a class="btn_left" href="#">
      <img class="w_100" src="/images/haed_btn_back.png" onclick="modal_close('region')" alt="뒤로가기">
    </a>
    <h1>직종 인증</h1>
  </header>
  <!-- header : e -->
  <div class="body">
  <div class="inner_wrap">
    <form class="find_form">
      <div>
        <h2>직종 인증 신청</h2>
        <span class="subtext mt10">
          내 직종을 인증하세요! <br>
          나와 같은 직종에서 일하는 사람들과 공유할 수 있어요.
        </span>
      </div>
      <ul class="input_ui row mt40">
        <li>
          <label>직종 선택<span class="essential">*</span></label>
          <span class="subtext">
            현재 일하고 계신 직종을 선택해 주세요. 기타 직종은 '일반'
          </span>
          <select class="mt10">
              <option value="">직종을 선택해주세요.</option>
            <?foreach($work_list as $row){?>
              <option value="<?=$row->work_idx?>"><?=$row->work_name?></option>
            <?}?>
          </select>
        </li>
        <li>
          <label class="">인증<span class="essential">*</span>
            <img src="/images/ic_info.png" alt=""  class="btn" style="width: 15px;" onclick="modal_open('confirm')">
          </label>
          <span class="subtext">
            명함 또는 현장 사진을 첨부해 주세요.
          </span>
          <div class="x_scroll_img_reg mt5">
          <ul class="img_reg_ul">
            <li>
              <p class="cnt_num"><span>1</span>/2</p>
              <div class="img_box" onclick="api_request_file_upload('img','2');">
                <img src="/images/btn_photo.png" alt="">
              </div>
            </li>
            <li>
              <img src="/images/btn_sm_delete.png" alt="x" class="btn_delete">
              <div class="img_box">
                <img src="/media/commonfile/202304/25/5017636a1dcca7d903bcc859893d0754.jpg" alt="">
              </div>
            </li>
          </ul>
        </div>
        </li>
      </ul>
    </form>
    <div class="btn_space">
      <a href="javascript:void(0)" class="btn_point btn_full_basic" onclick="default_work()">직종 인증 신청</a>
    </div>
  </div>
  </div>
</div>
<!-- 모달 -->

<!-- 지역선택 모달 -->
<div class="modal modal_confirm">
  <header>
    <a class="btn_left" href="#">
      <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('confirm')" alt="뒤로가기">
    </a>
    <h1>인증 안내</h1>
  </header>
  <!-- header : e -->
  <div class="body">
    <div id="edit">
    <img src="<?=$info_detail->img?>" alt="">
    </div>
  </div>
</div>
<!-- 지역 선택 모달 -->

<input type="hidden" name="auth_yn" id="auth_yn" value="N">

<input type="hidden" name="timer_yn" id="timer_yn" value="N">
<input type="hidden" name="timer_cnt" id="timer_cnt" value="0">

<input type="hidden" name="time_over_yn" id="time_over_yn" value="N">
<input type="hidden" name="verify_idx" id="verify_idx" value="">

<script type="text/javascript">

// 가입하기
function default_reg_in(){

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

  // 인증 체크
  function auth_check(){
    var auth_yn = document.querySelector('#auth_yn').value;

    var res = auth_yn == 'Y' ? 'Y' : 'N';

    return res;
  }
  
//인증요청
  function tel_verify_setting(){

    alert("발송 중입니다. 잠시만 기다려주세요.");

    var member_phone = $('#member_phone_input').val();

    var form_data = {
      'member_phone' : member_phone
    };

    $.ajax({
      url: "/<?=mapping('tel_verify')?>/tel_verify_setting",
      type: 'POST',
      dataType: 'json',
      async: true,
      data: form_data,
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

        $("#verify_idx").val(result.verify_idx);
        if ($('#timer_yn').val()=='N') {
          COM_set_timer(5,'span_auth_number');
          $('#timer_yn').val('Y');
        }else {
          $('#timer_cnt').val('1');
          COM_set_timer(5,'span_auth_number');
        }
        //  $('#btn_auth_ok').text('확인');
        $('#span_auth_number').css('display','block');
        $("#verify_check").removeClass('deactive');
        $("#verify_check").addClass('active');
        $('#member_phone').val(member_phone);
        }
      }
    });
  }

  function tel_verify_confirm(){
    var form_data = {
      'verify_idx' : $('#verify_idx').val(),
      'verify_num' : $('#verify_num').val(),
      'time_over_yn' : $('#time_over_yn').val(),
    };

    $.ajax({
      url: "/<?=mapping('tel_verify')?>/tel_verify_confirm",
      type: 'POST',
      dataType: 'json',
      async: true,
      data: form_data,
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
        $('#auth_yn').val("Y");
        $('#span_auth_number').css('display','none');
        // modal_open('join');
        }
      }
    });
  }

</script>