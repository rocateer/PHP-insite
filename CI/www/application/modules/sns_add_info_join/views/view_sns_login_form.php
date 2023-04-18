<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>
<script src="/js/sns_naver_login.js"></script>

<form name="sns_form" id="sns_form" action="/sns_add_info_join/sns_reg_view" method="post">
  <input type="hidden" name="sns_member_id" id="sns_member_id" value="">
  <input type="hidden" name="member_join_type" id="member_join_type" value="">
</form>

<script>
  //SNS 로그인 결과값 전송
  function sns_auth(){
    $('#sns_form').submit();
  }
</script>

<!-- 네이버 로그인 -->
<script>
  var naver_id_login = new naver_id_login("<?=NAVER_CLIENT_ID?>", "<?=NAVER_Call_URL?>");
  var state = naver_id_login.getUniqState();
  naver_id_login.setDomain("<?=NAVER_SET_DAMAIN?>");
  naver_id_login.setState(state);
  naver_id_login.setPopup();
  naver_id_login.init_naver_id_login();
</script>

<!-- 카카오 로그인-->
<script>
Kakao.init('<?=KAKAO_APP_KEY?>');
//Kakao.Auth.setAccessToken(Kakao.Auth.getAcceessToken(), true);
// 카카오 로그인 버튼을 생성합니다.
function loginWithKakao() {

  // 로그인 창을 띄웁니다.
  Kakao.Auth.login({
    success: function(authObj) {
      kakaoLoginAPI();
      // alert(JSON.stringify(authObj));
    },
    fail: function(err) {
      alert(JSON.stringify(err));
    }
  });
}

function kakaoLoginAPI() {

  kakaoLogout();

  Kakao.API.request({
    url: '/v2/user/me',
    success: function(res) {
      $.ajax({
      		url: "/sns_add_info_join/kakao_login_action",
      		type: 'POST',
      		dataType: 'json',
      		async: false,
      		data: {
            "member_email"     : res.id,
            "member_join_type" : 'K',
            "nickname"       : res.nickname
          },
          success: function(dom){
            if(dom.code == "-1"){
              alert(dom.code_msg);
            }else if(dom.code == "-2"){
              $('#sns_member_id').val(res.id);
              $('#member_join_type').val('K');
              sns_auth();
            }else if(dom.code =='1000'){
              location.href="/";
            }
          },
          error: function(request,status,error){
                alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
          }
      	});
    },
    fail: function(error) {
      if(error.code == '-401'){
        //alert("카카오톡 로그인을 다시 시도해주세요.")
        loginWithKakao();
      }
      else{
        alert(JSON.stringify(error));
      }
    }
  });
}

function kakaoLogout(){
  Kakao.Auth.logout();
}

</script>
