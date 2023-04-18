<header>
  <a class="btn_back" href="/<?=mapping('main')?>"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
  내 스케줄
  </h1>
</header>

<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)" onclick="routine_reg();">스케줄 수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="default_del();">삭제</a>
    </li>
  </ul>
  <ul class="close">
    <li>
      <a href="javascript:modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->

<div class="body vh_wrap">
  <div class="no_data" id="no_data">
    <p>아직 내 스케줄이 없어요.</p>
  </div>
  <div class="vh_body inner_wrap">
    
    <ul class="my_schedule_ul" id="list_ajax">
    </ul>


    <div class="vh_footer btn_full_weight btn_point mt30 mb30">
      <a href="/<?=mapping('program')?>/category_list">새로운 스케줄 추가하기</a>
    </div>
</div>


<input type="hidden" name="total_block" id="total_block" value="1">
<input type="hidden" name="program_idx" id="program_idx" value="">
<input type="hidden" name="member_program_idx" id="member_program_idx" value="">
<script type="text/javascript">

function locationhref(page_num){
}

$(function(){
	setTimeout("default_list_get('1')", 10);
});

var page_num=1;

$(window).scroll(function(){
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();

	if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
		page_num++;
		default_list_get(page_num);
	}
});

function default_list_get(page_num){

	var total_block = parseInt($("#total_block").val());

	var formData = {
		'page_num' : page_num
	};

	$.ajax({
		url      : "/<?=mapping('member_program')?>/member_program_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(page_num == 1){
				 $("#list_ajax").html(result);

			}else{
				if(total_block < page_num){
				 page_num = 1;

				}else{
				 $("#list_ajax").append(result);
				}

			}
		}
	});
}

function set_program_idx(program_idx,member_program_idx){

	$("#program_idx").val(program_idx);
	$("#member_program_idx").val(member_program_idx);
}

function routine_reg(){

	var program_idx = $("#program_idx").val();
  location.href = "/<?=mapping('program')?>/routine_reg?program_idx="+program_idx;

}

function default_del(){

  if(!confirm("스케줄을 삭제할까요? 남은 일정은 알림이 가지 않습니다.")){
    return;
  }

  var member_program_idx = $("#member_program_idx").val();

  $.ajax({
    url      : "/<?=mapping('member_program')?>/member_program_del",
    type     : "POST",
    dataType : "json",
    async    : true,
    data     : {
      'member_program_idx':member_program_idx
    },
    success: function(result) {
      // -1:유효성 검사 실패
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      } else if(result.code == 1) {
        alert(result.code_msg);
        location.reload();
      }
    }
  });
}

</script>