<header>
  <h1>매거진</h1>
</header>
<div class="body">
  <div class="inner_wrap row">
		<div class="no_data"  id="no_data" style="display: none;"> 
			<p>매거진이 준비중입니다.</p>
		</div>
		 <ul class="board_ul mb30_ul mt20" id="list_ajax" style="margin-bottom:80px;"></ul>

  </div>
</div>

<input type="hidden" name="total_block" id="total_block" value="1">
<input type="hidden" name="community_idx" id="community_idx" value="">
<script type="text/javascript">
	var agent ="<?=$agent?>";

$(function(){
	setTimeout("default_list_get('1')", 10);
	setTimeout("api_request_main_menu('M')", 100);
});

//  요청 :: 디바이스 
function api_request_main_menu(tab){
  if(agent == 'android') {
    window.rocateer.request_main_menu(tab);
  } 
}

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
		url      : "/<?=mapping('board')?>/board_list_get",
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

function display_mod_up(news_idx){

	if(COM_login_check('<?=$this->member_idx?>','/<?=mapping('board')?>')){
		if(!confirm("컨텐츠를 노출하시겠어요?")){
			return;
		}
  }

	$.ajax({
	url      : "/common/display_mod_up",
	type     : "POST",
	dataType : "json",
	async    : true,
	data     : {
		'news_idx':news_idx
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

function set_community_idx(community_idx){
	$("#community_idx").val(community_idx);
}

</script>

