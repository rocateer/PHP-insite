<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>내가 작성한 글</h1>
</header>

<ul class="gnb_wrap">
	<li><a href="/<?=mapping('my_community')?>">게시판</a></li>
	<li><a href="/<?=mapping('my_community')?>/my_trade_list">중고거래</a></li>
	<li class="active"><a href="/<?=mapping('my_community')?>/my_vote_list">사전투표</a></li>
</ul>
<hr class="space">


<div class="no_data">
  <p><span class="message_box">작성한 댓글이 없어요.</span></p>
</div>

<ul class="community_list" id="list_ajax">
  <?php for ($i=0; $i < 6; $i++) {?>
  <li>
    <p class="date">교육 사전투표 <span class="f_right"><img src="/images/ic_more.png" class="w_16" onclick="modal_open_slide('more')"></span></p>
      <a href="/<?=mapping('community')?>/community_detail">
      <div class="community_list_body">
        <div class="community_list_item">
          <p class="community_list_title"><span class="mark">진행중</span> 월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
          <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
        </div>
      </div>
      <p class="date mt10">2023.02.01 10:00 </p>
    </a>
  </li>
  <?php }?>
</ul>


<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)">삭제</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->

<script>
// 모달 슬라이드
window.onload = function(){
  let md_slide_height;
	for(var i = 0; i<$('.modal_slide').length;i++){ // 각 모달의 높이 값만큼 -
	  md_slide_height = $('.modal_slide').eq(i).outerHeight();
	  $('.modal_slide').eq(i).css('bottom',-md_slide_height);
	} //모든 모달슬라이드 숨기기
}
//
function modal_open_slide(element){
	$(".md_slide_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 200);
	$(".modal_slide_" + element).animate({bottom: 0},200);
	$.lockBody();
}

function modal_close_slide(element){
  md_slide_height2 = $(".modal_slide_" + element).outerHeight();
	$(".md_slide_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 200);
	$(".modal_slide_" + element).animate({bottom: -md_slide_height2},200);
	$.unlockBody();
}
</script>