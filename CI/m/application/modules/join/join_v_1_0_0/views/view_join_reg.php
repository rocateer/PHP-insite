<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
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
            <input type="text" id="member_email" name="member_email" placeholder="이메일 주소를 입력해 주세요" value="psooin3356">
            <span>@</span>
            <select class="email_type" id="email_type" name="email_type">
              <option value="">선택하세요</option>
              <option value="1">naver.com</option>
              <option value="2" selected>gmail.com</option>
              <option value="3">hanmail.net</option>
              <option value="4">nate.com</option>
              <option value="5">daum.net</option>
              <option value="6">icloud.com</option>
              <option value="7">hotmail.com</option>
              <option value="8">kakao.com</option>
              <option value="0">직접 입력</option>
            </select>
          </div>
        </li>
        <li>
          <label>비밀번호<span class="essential">*</span></label>
          <input type="password" id="member_pw" name="member_pw" placeholder="영문, 숫자, 특수문자 조합 8~15자리로 입력해 주세요." value="qwer1234!">
        </li>
        <li>
          <label>비밀번호 확인<span class="essential">*</span></label>
          <input type="password" id="member_pw_confirm" name="member_pw_confirm" placeholder="영문, 숫자, 특수문자 조합 8~15자리로 입력해 주세요." value="qwer1234!">
        </li>
      </ul>
      <div class="btn_space">
        <a href="javascript:void(0)" class="btn_point btn_floating" onclick="default_reg_in()">다음</a>
      </div>
    </form>
  </div>
</div>

<script type="text/javascript">
// 가입하기
function default_reg_in(){

  var email = $("#email_type").val();
  var email_text = $("#email_type option:checked").text();
  var member_pw = $("#member_pw").val();
  var member_pw_confirm = $("#member_pw_confirm").val();
  
  var member_email = $("#member_email").val();

  if(member_email==''){
    alert("이메일 주소를 입력해주세요.");
    return;
  }
  
  if(email==''){
    alert("이메일 주소를 선택해주세요.");
    return;
  }else if(email!='0'){
    member_email+='@'+email_text;
  }

  if(member_pw==''){
    alert("비밀번호를 입력해주세요.");
    return;
  }
  
  if(member_pw!=member_pw_confirm){
    alert("비밀번호가 다릅니다. 비밀번호를 확인해주세요.");
    return;
  }

  var form_data = {
      'member_email' :  member_email,
      'member_pw' :  member_pw
    };

    console.log(form_data);

  $.ajax({
    url      : "/<?=mapping('join')?>/join_reg_in",
    type     : 'POST',
    dataType : 'html',
    async    : true,
    data     : form_data,
    success: function(result){
      // -1:유효성 검사 실패
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      }else{
        sessionStorage.member_email = member_email;
        sessionStorage.member_pw = member_pw;

        location.href = "/<?=mapping('join')?>/join_reg2";
      }
     
    }
  });
}

</script>
