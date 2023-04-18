<header>
  <div class="btn_back" onclick="javascript:history.go(-1)">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
  <?=$category_name?>
  </h1>
</header>
<div class="body relative inner_wrap">
  <img src="/images/step_2.png" alt="" class="step">
  <h4 class="mb20 mt50 txt_center">프로그램을 선택해 주세요.</h4>
  <ul class="select_product_ul" id="list_ajax" style="margin-bottom: 80px;">
   
  </ul>
</div>

<input type="hidden" name="total_block" id="total_block" value="1">
<input type="hidden" name="category_idx" id="category_idx" value="<?=$category_idx?>">
<script type="text/javascript">

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
	var category_idx =$("#category_idx").val();

	var formData = {
		'page_num' : page_num,
		'category_idx' : category_idx
	};

	$.ajax({
		url      : "/<?=mapping('program')?>/program_list_get",
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

function default_reg_in(program_idx){


	$.ajax({
		url      : "/common/program_reg_in",
		type     : "POST",
		dataType : "json",
		async    : true,
		data     : {
			'program_idx':program_idx
		},
		success: function(result) {
			// -1:유효성 검사 실패
			if(result.code == '-1'){
				alert(result.code_msg);
				$("#"+result.focus_id).focus();
				return;
			}
			// 0:실패 1:성공
			if(result.code == '0') {
				alert(result.code_msg);
			} else if(result.code == '1') {
				// alert(result.code_msg);
				// location.reload();
				
			}
		}
	});
}

function set_community_idx(community_idx){
	$("#community_idx").val(community_idx);
}

</script>

