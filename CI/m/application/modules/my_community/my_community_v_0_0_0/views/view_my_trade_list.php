<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>내가 작성한 글</h1>
</header>

<ul class="gnb_wrap">
	<li><a href="/<?=mapping('my_community')?>">게시판</a></li>
	<li class="active"><a href="/<?=mapping('my_community')?>/my_trade_list">중고거래</a></li>
	<li><a href="/<?=mapping('my_community')?>/my_vote_list">사전투표</a></li>
</ul>
<hr class="space">
<ul class="tab_2">
  <li class="active"><a href="/<?=mapping('my_community')?>/my_trade_list">게시글</a></li>
  <li><a href="/<?=mapping('my_community')?>/my_trade_cnt_list">댓글</a></li>
</ul>

<div class="no_data">
  <p><span class="message_box">작성한 게시글이 없어요.</span></p>
</div>

<ul class="trade_list">
    <li>
      <p class="date">05.24 <span class="f_right"><img src="/images/ic_more.png" class="w_16" onclick="modal_open_slide('more')"></span></p>
      <a href="/<?=mapping('trade')?>/trade_detail">
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_title">아이폰 12pro 랑 에어팟 세트로 팝니다.</p>
          <p class="trade_list_price">100,000원 <span class="trade_state">예약</span></p>
          <div class="trade_action_area mt10"> 
            <span><img src="/images/ic_board_heart_off.png">150</span>
            <span><img src="/images/ic_board_chat.png">10</span>
            <span><img src="/images/ic_board_visibility.png">1,523</span>
          </div>
        </div>
      </div>
      </a>
    </li>
    <li>
    <p class="date">05.24 <span class="f_right"><img src="/images/ic_more.png" class="w_16" onclick="modal_open_slide('more')"></span></p>
      <a href="/<?=mapping('trade')?>/trade_detail">
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_title">아이폰 11pro(11프로) 사생활 보호 필름 2매입</p>
          <p class="trade_list_price">75,000원</p>
          <div class="trade_action_area mt10"> 
            <span><img src="/images/ic_board_heart_off.png">150</span>
            <span><img src="/images/ic_board_chat.png">10</span>
            <span><img src="/images/ic_board_visibility.png">1,523</span>
          </div>
        </div>
      </div>
      </a>
    </li>
    <?php for ($i=0; $i < 3; $i++) {?>
    <li>
    <p class="date">05.24 <span class="f_right"><img src="/images/ic_more.png" class="w_16" onclick="modal_open_slide('more')"></span></p>
      <a href="/<?=mapping('trade')?>/trade_detail">
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_con">아이폰 11pro(11프로) 사생활 보호 필름 2매입</p>
          <p class="trade_list_price">50,000원 <span class="trade_state_end">거래 완료</span></p>
          <div class="trade_action_area mt10"> 
            <span><img src="/images/ic_board_heart_off.png">150</span>
            <span><img src="/images/ic_board_chat.png">10</span>
            <span><img src="/images/ic_board_visibility.png">1,523</span>
          </div>
        </div>
      </div>
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