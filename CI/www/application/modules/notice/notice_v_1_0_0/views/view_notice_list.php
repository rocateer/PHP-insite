<div class="row body">
  <div class="no_data">
    <img src="/images/i_no_notice.png">
    <p>새로운 공지사항이 없습니다.</p>
  </div>

  <ul class="notice_ul" id="list_ajax">

  </ul>
</div>
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


	var formData = {
		'page_num' : page_num
	};

	$.ajax({
		url      : "/<?=mapping('notice')?>/notice_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(page_num == 1){
				 $("#list_ajax").html(result);

			}
		}
	});
}

</script>
