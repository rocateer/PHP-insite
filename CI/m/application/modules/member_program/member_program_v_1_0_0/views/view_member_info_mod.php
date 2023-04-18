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
        <img src="/p_images/s1.png" alt="">
        <img src="/images/btn_camera.png" alt="" class="btn_reg">
      </div>
      <h4>id@email.com</h4>
    </div>
    <div class="label">성별</div>
    <h6>여</h6>
    <div class="label">전화번호</div>
    <h6>여</h6>
    <div class="label">본인인증</div>
    <div class="btn_full_weight btn_point_line">
      <a href="">인증받기</a>
    </div>
    <div class="label">닉네임</div>
    <input type="text">
  </div>
  <hr class="space mt30">
  <div class="inner_wrap mt20">
    <h4>나의 추가정보</h4>
    <div class="label">운동 목표</div>
    <input type="text">
    <div class="label">운동 시간대</div>
    <div class="flex_1">
      <select name="" id="">
        <option value="">선택</option>
      </select>
      <span>~</span>
      <select name="" id="">
        <option value="">선택</option>
      </select>
    </div>
    <div class="label">관심 운동 부위</div>
    <input type="text">
    <div class="label">목표 허리둘레</div>
    <div class="flex_1">
      <select name="" id="">
        <option value="">선택</option>
      </select><span style="padding-left:10px">(inch)</span>
    </div>
    <div class="btn_full_weight mt30 mb30 btn_point">
      <a href="">내 정보 수정</a>
    </div>
  </div>
</div>

<script>
  //탈퇴
  function member_out() {

    var member_leave_reason = $("#member_leave_reason").val();
    if (!member_leave_reason) {
      alert("탈퇴 사유를 입력해주세요.");
      return;
    }

    // 체크여부 확인
    if ($("input:checkbox[name=chk_1]").is(":checked") != true) {
      alert("동의에 체크해주세요.");
      return;
    }
    var form_data = {
      'member_leave_reason': member_leave_reason
    };
    $.ajax({
      url: "/<?= mapping('member_out') ?>/member_out_mod_up",
      type: 'POST',
      dataType: 'json',
      async: true,
      data: form_data,
      success: function(result) {
        if (result.code == '-1') {
          alert(result.code_msg);
          $("#" + result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if (result.code == 0) {
          alert(result.code_msg);
        } else {
          alert(result.code_msg);
          location.href = "/logout";
        }
      }
    });
  }
</script>

<script>
  $(".place_wrap textarea").on("propertychange change keyup paste input", function() {
    if ($(this).val().length === 0) {
      $(this).siblings('.place_p').css('display', 'block');
    } else {
      $(this).siblings('.place_p').css('display', 'none');
    };
  });
</script>