<div class="body">
  <div class="member_wrap">
    <h1 class="page_title">Login</h1>
    <form class="form1" id="form1" method="post" action="<?=$return_url?>">
      <input name="cart_type" id="cart_type" type="hidden" value="<?=$cart_type?>">
      <input name="cart_session_id" id="cart_session_id" type="hidden" value="<?=$cart_session_id?>">
    <table>
  		<tr>
  			<th>ID</th>
  			<td><input type="text" id="member_id" name="member_id" placeholder="아이디"></td>
  		</tr>
  		<tr>
  			<th>pw</th>
  			<td><input type="password" id="member_pw" name="member_pw" placeholder="비밀번호"></td>
  		</tr>
  	</table>
    </form>
    <span class="btn_full btn_basic"><a class="mt30" href="javascript:login_action();">Login</a></span>

  	<div class="login_bottom">
  		<span>
  			<a href="/find_id">아이디 찾기</a> / <a href="/find_pw_to_email">비밀번호 찾기</a>
  		</span>
  		<a href="/join">회원가입</a>
  	</div>

  	<div class="sns_login">
  		<a href="#" id ="login"><img class="w100" src="/images/icon_facebook.png" alt="facebook"></a>
  		<a href="#" onClick="javascript:loginWithKakao();"><img class="w100" src="/images/icon_kakao.png" alt="kakao"></a>
  		<a href="#" id="naver_id_login"><img class="w100" src="/images/icon_naver.png" alt="naver"></a>
  	</div>

  </div>

</div>



<script>

  $(function () {
  	$("#login img").on("click", function () {
  		FB.login(function(response) {
        console.log(response);
  			if (response.authResponse) {
            facebookLoginAPI(response);
  			}
  		});
  	});
  });

// 일반 이메일 로그인
  var login_action = function(){

    var member_id = $.trim($("#member_id").val());

    if(member_id == ""){
      $("#member_id").focus();
      alert("유효하지 않은 이메일 양식입니다.");
      return false;
    }

    var regEmail = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;

    if(!regEmail.test($.trim(member_id))){
       alert("유효하지 않은 이메일 양식입니다.");
       $("#member_id").focus();
       return false;
    }

    $.ajax({
      url: "/login/login_action",
      type: "POST",
      dataType: "json",
      async: true,
      data: $("#form1").serialize(),
      success: function(data){
        if(data == "0"){
          // alert("Login Error");
          location.reload();
        }else if(data == "1") {
          // alert("Welcome");
          $("#form1").submit();
        }else if(data == "2") {
          // alert("Check your id and password");
          alert("아이디와 비밀번호를 확인해주세요");
        }
      }
    });

  }

// 네이버아이디로 로그인
  var naver_id_login = new naver_id_login("FYcugk_VyT3avTTIy62Q", "http://www.jejuharu.net/login/login_null");

  var state = naver_id_login.getUniqState();
  naver_id_login.setDomain(".rocat.club");
  naver_id_login.setState(state);
  naver_id_login.setPopup();
  naver_id_login.init_naver_id_login();

</script>
