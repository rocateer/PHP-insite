<html>
<script src="/js/jquery-1.12.4.min.js"></script>
<div style="border:1px solid #ddd; width:400px; height:320px;padding:40px 30px; background:#efefef; border-top:4px solid #49c5cb">
  <div style="font-size:18px; font-weight:600; text-align:center; margin-bottom:40px;">메일폼 UI 코딩 테스트 페이지</div>
  <div><a href="javascript:void(0)" onclick="email_view_fn()" style="text-decoration:none; color:#333; width:100%;">1. 이메일 작성 확인 [ Click ]</a></div>
  <input type="text" id="email_view" name="email_view" value="find_pw_to_email" placeholder="test_email" style="width:100%; height:35px; font-size:16px; margin:10px 0 30px; padding-left:6px;">
  <div><a href="javascript:void(0)" onclick="send_test()" style="text-decoration:none; color:#333;">2. 이메일 보내기 [ Click ]</a></div>
  <input type="text" id="email_address" name="email_address" placeholder="rocat@rocateer.com"style="width:100%; height:35px; font-size:16px; margin:10px 0; padding-left:6px;">
  <input type="text" id="email_address2" name="email_address2" placeholder="rocat@rocateer.com"style="width:100%; height:35px; font-size:16px; margin:10px 0; padding-left:6px;">
</div>

<script>
$(document).ready(function() {
  $('#email_view').focus();
});
function email_view_fn(){
  var email_view = $("#email_view").val();
  if(email_view==""){
    alert('이메일 작성폼 함수 페이지명을 입력해주세요.');
    return;
  }
  window.open('/emails_v_1_0_0/'+email_view, 'email_form');
}

function send_test(){

  var form_data = {
    'email_view' : $('#email_view').val(),
    'email_address' : $('#email_address').val(),
    'email_address2' : $('#email_address2').val()
  };

  $.ajax({
    url      : "/emails_v_1_0_0/emails_send_test",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      }
    }
  });
}

</script>
</html>
