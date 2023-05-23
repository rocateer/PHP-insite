<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>구인구직 관리</h1>
</header>

<div class="body">
  <ul class="tab_2">
    <li class="active"><a href="/<?=mapping('my_recruit')?>/my_recruit_human_list">구인</a></li>
    <li><a href="/<?=mapping('my_recruit')?>/my_recruit_job_list">구직</a></li>
  </ul>

  <div class="no_data">
    <p><span class="message_box">작성한 구인 공고가 없습니다.</span></p>
  </div>

  <ul class="recruit_list">
    <li>
      <a href="/<?=mapping('recruit')?>/human_detail">
        <div class="item_1">
          <b>플랫폼로캣티어</b>
          <span class="f_right date">2023.01.01</span>
        </div>
        <div class="mt10 mb10">
          <span class="recruit_mark">목공</span>
          <span class="txt_title">가디호텔 철거공사를 하는데 경력자 사람을 구하고 있습니다.</span>
        </div>
        <div class="item_2"><img src="/images/ic_time.png" class="info_ic">~2023.05.01 <span class="point_color">(D-13)</span></div>
        <div class="item_2"><img src="/images/ic_pin.png" class="info_ic">서울 동부<img src="/images/ic_sm_arrow.png" class="w_16 middle">강동구</div>
        <div class="item_2"><img src="/images/ic_view.png" class="info_ic">1,234 <p class="f_right fs_14 font_gray_f">협의가능</p></div>
      </a>
    </li>
    <li class="recruit_noti">
      블라인드 된 게시글입니다.
    </li>
    <?php for ($i=0; $i < 6; $i++) {?>
    <li>
      <div class="item_1">
        <b>플랫폼로캣티어</b>
        <span class="f_right date">2023.01.01</span>
      </div>
      <div class="mt10 mb10">
        <span class="recruit_mark">목공</span>
        <span class="txt_title">주안자이 아파트 신규 건설 신입 채용</span>
      </div>
      <div class="item_2"><img src="/images/ic_time.png" class="info_ic">~2023.05.01 <span class="point_color">(D-13)</span></div>
      <div class="item_2"><img src="/images/ic_pin.png" class="info_ic">서울 동부<img src="/images/ic_sm_arrow.png" class="w_16 middle">강동구</div>
        <div class="item_2"><img src="/images/ic_view.png" class="info_ic">1,234 <p class="f_right fs_14 font_gray_f"><span class="point_color">일급</span> 30만원</p></div>
    </li>
    <?php }?>
  </ul>

</div>








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