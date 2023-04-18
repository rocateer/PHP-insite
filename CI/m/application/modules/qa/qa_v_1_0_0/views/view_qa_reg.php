<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
  1:1 문의
  </h1>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="vh_wrap qa_reg_page">
  <div class="body">
    <form name="form_default" id="form_default">
    
    <div class="vh_body">
      <div class="inner_wrap">
        <div class="label">카테고리 <span class="essential">*</span></div>
          <select name="qa_type" id="qa_type" class="form-control w_auto">
            <option value="0">불편 신고</option>
            <option value="1">제안 및 건의</option>
            <option value="2">기타</option>
          </select>
        <div class="label">제목 <span class="essential">*</span></div>
        <input type="text" id="qa_title" name="qa_title" placeholder="제목을 입력하세요.">
        <div class="label">내용 <span class="essential">*</span></div>
        <textarea id="qa_contents" name="qa_contents" placeholder="내용을 입력하세요."></textarea>
        <p class="date">※ 답변은 24시간 이상 소요될 수 있습니다. 조금만 기다려 주세요. <br> <br>
Tip. 시스템 오류 등의 기술적인 문제를 겪으셨다면?  <br>
정확한 답변을 위해 휴대폰 기종, 문제 발생 일시, 상세내용을 함께 기입해 주세요. </p>
      </div>
    </div>
    <div class="vh_footer btn_full_weight mt30 mb30 btn_point">
      <a href="javascript:(0)" onclick="qa_reg_in();">등록</a>
    </div>
    <input type="text" name="device_os" id="device_os" value="" style="display: none;">
    <input type="text" name="app_version" id="app_version" value="" style="display:none;">
    <input type="text" name="os_version" id="os_version" value="" style="display:none;">
  </form>
    
  </div>
</div>
<!-- body : e -->

<script type="text/javascript">
  var agent ="<?=$agent?>";

  $(document).ready(function(){
    setTimeout("api_request_device_data()", 10);
  });

  //  요청 :: 디바이스 
function api_request_device_data(){
  // alert("!000000");
  if(agent == 'android') {
    window.rocateer.request_device_data();
  } else if (agent == 'ios') {
    var message = {
           "request_type" : "request_device_data",
          };
    window.webkit.messageHandlers.native.postMessage(message);
  }
}

//  응답 :: 앱에서 받아서  데이타 처리
function api_reponse_device_data(device_os,app_version,os_version){
  $("#device_os").val(device_os);
  $("#app_version").val(app_version);
  $("#os_version").val(os_version);
}

// $(function(){
//   if(agent!="pc"){
//     setTimeout(function() {
//       api_request_device_data();
//      }, 1000);
//   }
// });
  

function qa_reg_in(){

  var formData = {
    'qa_type' : $("select[name='qa_type']").val(),
    'qa_contents' : $('#qa_contents').val(),
    'qa_title' : $('#qa_title').val(),
    'device_os' : $('#device_os').val(),
    'app_version' : $('#app_version').val(),
    'os_version' : $('#os_version').val()
  }

  $.ajax({
      url      : "/<?=mapping('qa')?>/qa_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $("#form_default").serialize(),
      success : function(result){
        if(result.code == '-1'){
     			alert(result.code_msg);
     			$("#"+result.focus_id).focus();
     			return;
   		  }
   		  // 0:실패 1:성공
   		  if(result.code == 0) {
     			alert(result.code_msg);
   		  }else {
          alert(result.code_msg);
          location.href ='/<?=mapping('qa')?>/qa_list';
     		}
      }
    });
}
</script>
