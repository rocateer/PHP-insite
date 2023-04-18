<div class="body">
  <!-- visual_title : s -->
  <div class="title">
    SNS 회원가입
  </div>
  <!-- visual_title : e -->
  <div class="inner_wrap">

    <!-- tab_content_wrap : s -->
    <div class="body_sm">
			 <form name="form_default" id="form_default">
       <input type="hidden" name="member_join_type" id="member_join_type" value="<?=$member_join_type?>">
      <div class="login_wrap form_wrap">
        <ul>
          <li>
            <label for="login_email">이메일</label>
            <input type="text" class="input_1" id="member_id" name="member_id" value="<?=$member_id?>" readonly>
          </li>
         <li>
            <label for="login_email">이름</label>
            <input type="text" class="input_1" id="member_name" name="member_name">
          </li>
          <li>
            <label for="login_email">휴대폰 번호</label>
            <input type="text" class="input_1" id="member_phone" name="member_phone">
          </li>
        </ul>

        <div class="member_reg_agree">
          <span class="agree_1">
            <input type="checkbox" id="agree_1" name="join_check" class="agree">
            <label for="agree_1" class="mt10"><span></span>개인정보수집 및 이용동의</label>
          </span>
          <div>추가정보<br><br><br><br><br><br><br><br><br><br></div>
        </div>

        <div class="member_reg_agree">
          <span class="agree_1">
            <input type="checkbox" id="agree_2" name="join_check" class="agree">
            <label for="agree_2" class="mt10"><span></span>서비스 이용 약관 동의</label>
          </span>
          <div>추가정보<br><br><br><br><br><br><br><br><br><br></div>
        </div>

        <div class="member_reg_agree">
          <span class="agree_1">
            <input type="checkbox" id="agree_3" name="join_check" class="agree">
            <label for="agree_3" class="mt10"><span></span>이벤트 정보 수신 동의</label>
          </span>
          <div>추가정보<br><br><br><br><br><br><br><br><br><br></div>
        </div>

        <div class="btn btn_basic_full mt20"><a href="javascript:void(0)" onclick="default_reg();">회원가입 신청</a></div>
      </div>
    </div>
    <!-- tab_content_wrap : e -->

  </div>
</div>

<script>
function default_reg(){
  // 약관 동의 여부 확인
  var termsChk = 0;
  var terms_arr = document.getElementsByName("join_check");

  for(var i=0; i<terms_arr.length; i++){
    if(terms_arr[i].checked == true) {
      termsChk += 1;
    }
  }

  if(termsChk != 3){
    alert("회원가입을 위해서는 추가정보 이용약관 동의 및 개인정보 수집 및 이용에 대한 정책 확인 후, 동의여부를 체크하셔야만 회원가입이 완료됩니다.");
    return false;
  }

  $.ajax({
    url      : "/sns_add_info_join/sns_reg_in",
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
      location.href ='/<?=mapping('member')?>/info_add';
      }
    }
  });
}
</script>
