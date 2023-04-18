<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
   header("Progma:no-cache");
   header("Cache-Control:no-cache,must-revalidate");
?>
<!doctype html>
<html lang="en" class="no-js">

  <head>
    <meta charset="UTF-8">
    <title>와츠키친</title>

    <!-- meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=1240"/>
    <!-- meta -->

    <!--sns login-->
    <script src="/js/SDK.js"></script>
    <script type="text/javascript" src="/js/sns_naver_add_info_login.js"></script>
    <!--sns login-->

    <script type="text/javascript" src="/js/jquery.js"></script>
    <script type="text/javascript">
      jQuery.browser = {};
      (function () {
          jQuery.browser.msie = false;
          jQuery.browser.version = 0;
          if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
              jQuery.browser.msie = true;
              jQuery.browser.version = RegExp.$1;
          }
      })();
    </script>
  </head>

  <body>
    <div id="naver_id_login" style="display:none;"></div>
  </body>
</html>

<script>

  var naver_id_login = new naver_id_login("<?=NAVER_CLIENT_ID?>", "<?=NAVER_Call_URL?>");
  var state = naver_id_login.getUniqState();
  naver_id_login.setDomain("<?=NAVER_SET_DAMAIN?>");
  naver_id_login.setState(state);
  naver_id_login.setPopup();
  naver_id_login.init_naver_id_login();

  // 네이버 사용자 프로필 조회 이후 프로필 정보를 처리할 callback function
	function naverSignInCallback() {

		// naver_id_login.getProfileData('프로필항목명');

		member_email = naver_id_login.getProfileData('email');
		member_name  = naver_id_login.getProfileData('name');

		// member_name  = naver_id_login.getProfileData('nickname');

    naver_login(member_email, member_name);
	}

  // 네이버 사용자 프로필 조회
  naver_id_login.get_naver_userprofile("naverSignInCallback()");

  // 실제 네이버아이디 로그인
  function naver_login(member_email, member_name){

    $.ajax({
        url: "/sns_add_info_join/naver_login_action",
        type: "POST",
        dataType: "json",
        async: true,
        data: {
          "member_email"     : member_email,
          "member_name"      : member_name,
          "member_join_type" : "N"
        },
        success: function(dom){
          if(dom.code == "-1"){
            alert(dom.code_msg);
          }else if(dom.code =='1000'){
              window.close();
              opener.location.href="/";
          }else if(dom.code == "-2"){
              opener.document.getElementById("sns_member_id").value = member_email;
              opener.document.getElementById("member_join_type").value ="N";
              self.close();
              opener.sns_auth();
          }
        },
        error: function(request,status,error){
          alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
        }
      });
  }

</script>
