<header>
  <div class="btn_back" onclick="COM_history_back_fn()">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
  전체기록
  </h1>
</header>

<div class="body view_history_all inner_wrap">
  <div class="no_data" id="no_data" style="display: none;">
    <p>프로그램 기록이 없습니다.</p>
  </div>
	<div id="list_ajax"></div>
</div>

<input type="hidden" name="total_block" id="total_block" value="1">
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

	var formData = {
		'page_num' : page_num
	};

	$.ajax({
		url      : "/<?=mapping('record')?>/history_list_get",
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

</script>

