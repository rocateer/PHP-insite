<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>회원 탈퇴</h1>
</header>
<!-- header : e -->
<div class="member_out_body">
  <div class="inner_wrap row">
  	<div class="member_out_page">
      <h2 class="mt30">회원탈퇴 전에 아래 내용을 확인해주세요.</h2>
  		<ul class="circle_ul mt20 mb30">
        <li>
        진행 중인 공구/교육이 있는 경우, <br> 회원 탈퇴가 불가합니다.
        </li>
        <li>
        고객님의 계정에 저장된 정보가 삭제될 예정입니다. <br> 삭제된 정보는 추후에 복원할 수 없습니다.
        </li>
        <li>
        같은 아이디로 재가입이 불가합니다.
        </li>
  		</ul>

      <p class="member_out_q" class="mb10">서비스 이용 중 어떤 부분이 불편하셨나요?<span class="essential"> *</span></p>
      <div class="place_wrap">
        <textarea id="member_leave_reason" name="member_leave_reason" class="" placeholder="" class="textarea mb20" ></textarea>
      </div>
  		<input type="checkbox" name="chk_1" id="chk_1_1">
      <label class="font_gray_3" for="chk_1_1">
        <span></span>
        안내사항을 모두 확인하였으며, 이에 동의합니다.
      </label>
      <div class="btn_space">
        <a href="#" class="btn_point_ghost btn_full_basic f_left" style="width:28%">탈퇴하기</a>
        <a href="#" class="btn_point btn_full_basic f_right" style="width:70%">계속 이용하기</a>
      </div>
  	</div>
  </div>
</div>

<script>

//탈퇴
function member_out(){

  var member_leave_reason = $("#member_leave_reason").val();
  if (!member_leave_reason) {
    alert("탈퇴 사유를 입력해주세요.");
    return;
  }

  // 체크여부 확인
  if($("input:checkbox[name=chk_1]").is(":checked") != true) {
    alert("동의에 체크해주세요.");
    return;
  }
  var form_data = {
    'member_leave_reason' :  member_leave_reason
  };
  $.ajax({
    url      : "/<?=mapping('member_out')?>/member_out_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
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
      location.href="/logout";
      }
    }
  });
}

</script>

<script>
$(".place_wrap textarea").on("propertychange change keyup paste input", function(){
  if ($(this).val().length === 0) {
    $(this).siblings('.place_p').css('display','block');
   }else{
    $(this).siblings('.place_p').css('display','none');
  };
});
</script>
