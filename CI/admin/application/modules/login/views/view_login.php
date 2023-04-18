<!DOCTYPE html>
<html lang="kor">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=SERVICE_NAME;?> 관리자</title>
    <link rel="shortcut icon" href="/images/favicon.png">
    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/common.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script src="/js/jquery.js"></script>

</head>

<body class="login">
<form method="post" name="form1">
  <div class="login_bg">
    <div class="login_head text-center">
      <h1><?=SERVICE_NAME;?> 중앙관리시스템12</h1>
    </div>
    <!-- panel : s -->
    <div class="panel">
    	<div class="panel-body">
    		<div class="form-group">
          <input class="form-control" placeholder="아이디" name="admin_id" id="admin_id">
        </div>
    		<div class="form-group">
          <input class="form-control" placeholder="비밀번호" type="password" name="admin_pw" id="admin_pw">
        </div>
    		<a href="javascript:void(0)" class="btn btn-success login_btn" onclick="loginOk();">로그인</a>
    	</div>
    </div>
    <!-- panel : e -->
  </div>
</form>

</body>

<script>
//로그인
var loginOk=function(){
    var admin_id = $('#admin_id').val();
    var admin_pw = $('#admin_pw').val();

    $.ajax({
      url: "/login/login_action",
      type: "POST",
      dataType: "json",
      async: true,
      beforeSend: validate,//체크함수
      data: {
        "admin_id": admin_id,
        "admin_pw": admin_pw
      },
      success: function(result) {

        if(result > 0) {
          console.log(result);
          location.href = "/<?=mapping('member')?>";
        } else {
          alert('잘못된 ID 또는 비밀번호입니다. 다시 시도해 주십시오');
          $('#admin_pw').focus();
          return false;
        }
      } // end sucess
    })
  }
  //체크함수
  var validate = function(){
    if($('#admin_id').val()==""){
      alert("아이디를 입력해 주세요");
      $('#admin_id').focus();
      return false;
    }
    if($('#admin_pw').val()==""){
      alert( "비밀번호를 입력하세요.");
      $('#admin_pw').focus();
      return false;
    }
  }

  $(document).ready(function(){
    $("#admin_id").focus();
    $("#admin_id").keyup(function(e) {
      if(e.keyCode == 13) {
        $('#admin_pw').focus();
      }
    });
    $("#admin_pw").keyup(function(e) {
      if(e.keyCode == 13) {
        loginOk();
      }
    });

  });
</script>

</html>
