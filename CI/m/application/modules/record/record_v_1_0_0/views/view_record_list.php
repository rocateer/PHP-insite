<header>
  <div class="btn_back">
    <a href="/<?=mapping('main')?>">
      <img src="/images/head_btn_back.png" alt="">
    </a>
  </div>
  <h1>
    운동 기록
  </h1>
</header>
<div class="body view_history">
  <div class="">
    <ul class="tab_menu clearfix">
      <li class="active" onclick="record_list();">
      월간리포트
      </li>
      <li class="" onclick="calendar_list();">
        캘린더
      </li>
    </ul>
    <div class="">
      <ul class="main_login_ul">
        <li>
          <div class="title"><?=$result->excercise_cnt?>회</div>
          <div class="sub_title">총 프로그램 완료</div>
        </li>
        <li>
          <?if(!empty($result->excercise_time)){?>
          <? 
          $hour=substr($result->excercise_time,0,2);
          $min=substr($result->excercise_time,3,2);
          $sec=substr($result->excercise_time,-2);
          ?>
          <div class="title"><?=($hour>0)?(int)$hour.'시 ':''?><?=($min>0)?(int)$min.'분 ':''?><?=($sec>0)?(int)$sec.'초 ':'0초'?></div>
          <div class="sub_title">총 운동 완료 시간</div>
          <?}else{?>
            <div class="title">-</div>
            <div class="sub_title">총 운동 완료 시간</div>
          <?}?>
        </li>
      </ul>
      <div class="inner_wrap">
        <h2><?=$date?></h2>
        <div class="no_data" id="no_data">
          <p>프로그램 기록이 없습니다.</p>
        </div>
        <ul class="program_ul" id="list_ajax">
        </ul>
      </div>
    </div>
  </div>
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
		'page_num' : page_num,
	};

	$.ajax({
		url      : "/<?=mapping('record')?>/record_list_get",
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

function record_list(){
  location.href="/<?= mapping('record')?>";
}

function calendar_list(){
  location.href="/<?= mapping('record') ?>/calendar_list";
}

</script>

