<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
   header("Progma:no-cache");
   header("Cache-Control:no-cache,must-revalidate");
?>
<!doctype html>
<html lang="en" class="no-js">
  <head>
  	<meta charset="UTF-8">
  	<title>제주에서 작품을 만나다</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/common.css">

    <script type="text/javascript" src="/js/sns_naver_login.js"></script>
  	<script src="/js/jquery.js"></script>
    <script src="/js/p_common.js"></script>
    <script src="/js/timepicki.js"></script>
    <link href="/css/jquery-ui.css" rel="stylesheet">
    <link href="/css/timepicki.css" rel="stylesheet">
    <script src="/js/jquery-ui.js"></script>
    <link rel="shortcut icon" href="/images/favicon.png">
  </head>
  <body>
    <div id="naver_id_login" style="display:none;"></div>
  </body>
</html>

<script>

  var naver_id_login = new naver_id_login("FYcugk_VyT3avTTIy62Q", "http://www.jejuharu.net/login/login_null");

  var state = naver_id_login.getUniqState();
  naver_id_login.setDomain(".rocat.club");
  naver_id_login.setState(state);
  naver_id_login.setPopup();
  naver_id_login.init_naver_id_login();
// 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {
		// naver_id_login.getProfileData('프로필항목명');
		// 프로필 항목은 개발가이드를 참고하시기 바랍니다.
		member_email = naver_id_login.getProfileData('email');
		member_name = naver_id_login.getProfileData('nickname');
    naver_login(member_email, member_name);
	}

// 네이버 사용자 프로필 조회
	naver_id_login.get_naver_userprofile("naverSignInCallback()");

// 실제 네이버아이디 로그인
  function naver_login(member_email, member_name){

    $.ajax({
        url: "/login/naver_login_action",
        type: "POST",
        dataType: "json",
        async: true,
        data: {
          "member_email": member_email,
          "member_name": member_name,
          "member_join_type": "N"
        },
        success: function(dom){
          if(dom =='0'){ // 회원가입 실패
            alert("Join Failed");
            window.close();
          }else if(dom =='1'){ // 로그인 성공
            opener.location.href="/mypage";
            window.close();
          }else if(dom =='2') { // 로그인 실패
            alert("Login Failed");
            window.close();
          }
        },
        error: function(request,status,error){
          alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
          alert('왜에러?1');
        }
      });
  }

</script>
