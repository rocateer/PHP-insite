<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Favicon -->
<link rel="shortcut icon" href="#">

<title><?=SERVICE_NAME?></title>
<style>
  .pw_bg{background-size:100%; background: #ededed;}
  .w_box{width:300px; height:350px; background:#fff; border-radius:10px; position:absolute;left:50%;top:50%;transform:translate(-50%, -50%); padding:20px; border: 1px solid #ededed;}
  .pw_h1{font-size: 24px;}
  .pw_area{margin:20px 0 0 0; padding:0;}
  .pw_area li{display:block; list-style:none; margin:0; padding:10px 0;}
  .pw_area li label{display:block; font-size:14px; color:#ccc; padding:10px 0;}
  .pw_area li input{border:1px solid #ddd; border-radius:5px; height:45px; width:100%; text-indent:10px;}
  .pw_area li.txt-right{text-align:right;}
  .pw_logo{width: 120px; position:absolute;left:50%;top:9vw;transform:translate(-50%, -2vw);}
  h2{text-align: center;}
  button { overflow: visible;}
  .btn {
    display: inline-block;
    margin-bottom:0;
    font-weight:400;
    text-align:center;
    vertical-align: middle;
    touch-action: manipulation;
    cursor:pointer;
    text-decoration: none;
    border: 1px solid transparent; white-space:nowrap; padding: 10px 0; width:100%; font-size:17px; line-height: 1.42857143; border-radius:3px; background:#777; color:#fff;
    font-weight: bold;
    margin-top: 10px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
</style>
</head>

<body class="pw_bg">
  <form name="form1" method="post">
    <input type="hidden" name="p_code" id="p_code" value="<?=$data['p_code']?>">
    <div class="centered">
      <!-- <h2><img src="http://www.pitchfit.co.kr/images/logo.png" class="pw_logo" alt="logo"/></h2> -->

      <div class="w_box">
        <div class="pw_con">

          <h1 class="pw_h1"> 비밀번호 변경</h1>
          <ul class="pw_area">
            <li>
              <label>새 비밀번호</label>
              <input type="password" name="member_pw" id="member_pw" placeholder="비밀번호">
            </li>
            <li>
              <label>비밀번호 확인</label>
              <input type="password" name="member_pw_check" id="member_pw_check" placeholder="비밀번호확인">
            </li>
              <li class="txt-right">
              <a href="javascript:void(0);" class="btn" onclick="javascript:saveFn();">확인</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </form>

  <script src="/js/jquery-1.12.4.min.js"></script>
  <script>

    function saveFn(){

      var formData = {
        "p_code" : $('#p_code').val(),
        "member_pw" : $('#member_pw').val(),
        "member_pw_check" : $('#member_pw_check').val()
      };

      $.ajax({
        url : "/find_pw_to_email/corp_pw_reset_up",
        type : "post",
        dataType : "json",
        data: formData,
        success : function(data){
          if(data.code == '-1'){
            alert(data.code_msg);
          }else{
            alert(data.code_msg);
            location.href="/find_pw_to_email/member_pw_complete";
          }
        }
      });
    }

  </script>
</body>
</html>
