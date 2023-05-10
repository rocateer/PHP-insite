<header style="background: none;">
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <div class="btn_right">
    <a href="javascript:void(0)" class="btn_scrap ease" onclick="btn_scrap(this)"></a>
    <img src="/images/head_btn_more.png" alt="" onclick="modal_open_slide('more')">
  </div>
</header>
<div class="body" style="padding-top: 0px;">

  <!-- community head -->
  <div class="trade_detail_head">
    <img class="head_img" src="/p_images/s4.jpg">

    <div class="detail_info">
      <!-- <div class="trade_state">예약</div> -->
      <div class="trade_state_end">거래완료</div>
      <p class="trade_title">월넛과 베이지로 차분하게, 무드있는 신혼집</p>
      <p class="txt_nickname">드림꿈드림임 · 목공 · 서울 남부  <span class="f_right detail_date">2022.12.21</span></p>

      <div class="trade_price">180,000원</div>

      <table class="mt30 trade_info" >
        <colgroup>
          <col width='80px'>
          <col width='*'>
        </colgroup>
        <tr>
          <th>거래방법</th>
          <td>직거래</td>
        </tr>
        <tr>
          <th>장소</th>
          <td>가산디지털단지역 2번 출구 앞</td>
        </tr>
      </table>
    </div>
  </div>
  <!-- community body -->
  <div class="trade_detail_body">
    33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기를 했지만 발코니가 과하게 넓고 활용도도 떨어져 거실 쪽 발코니만 확장 하였답니다. 그 외 욕실, 주방, 중문, 타일, 도배 및 장판등을 진행하였어요.

    <div>
    비닐만 벗겨놓은 상태입니다. 직거래시 직접 확인하시고 구매하셔도 되요. 사이즈가 큰 편이어서 SUV 정도의 차량 아니면 들어가지 않아요. 01012345678 로 문자 남겨주세요.
    </div>
  
    <a href="#" class="btn_point btn_full_thin mt20">전화번호 확인</a>

  </div>
  <!-- community action -->
  <ul class="detail_action">
    <li><a href="javascript:void(0)" onclick="detail_btn_like(this)" class="detail_btn_like ease">좋아요 120</a></li>
    <li><img src="/images/ic_chat_white.png"> 댓글 23</li>
    <li><img src="/images/ic_visibility_white.png"> 524</li>
  </ul>

    
  <!-- 댓글:s -->
  <div class="cmt_wrap">
      <!-- <div class="no_data">
        <p><span class="message_box">작성된 댓글이 없습니다.</span></p>
      </div> -->
      <!-- 댓글: tbl_cmt, 답글: tbl_reply, etc: cmt_blind -->
    <ul class="cmt_ul">
      <li>
        <div class="cmt_item_1">벚꽃보러가요 · 서울 동부<span class="f_right"><img src="/images/ic_more.png" onclick="modal_open_slide('cmt_more')" alt="더보기" class="w_16"></span></div>
        <div class="cmt_item_2">월넛과 베이지의 조화가 넘 멋지네요. 집도 따뜻해 보이면서도 안정감이 들어 집에만 있고 싶어질거 같아요!</div>
        <div class="cmt_action">
          <span>00:00</span>
          <span><a href="javascript:void(0)" onclick="cmt_btn_like(this)" class="cmt_btn_like ease">120</a></span>
          <span onclick="reg_reply()">대댓글</span>
        </div>
      </li>
      <li>
        <div class="cmt_item_1">분홍색개구리 · 인천 미추홀구<span class="f_right"><img src="/images/ic_more.png" onclick="modal_open_slide('cmt_more')" alt="더보기" class="w_16"></span></div>
        <div class="cmt_item_2">세상 살다보니 이러기도 하네요.</div>
        <div class="cmt_action">
          <span>00:00</span>
          <span><a href="javascript:void(0)" onclick="cmt_btn_like(this)" class="cmt_btn_like ease">120</a></span>
          <span onclick="reg_reply()">대댓글</span>
        </div>
      </li>
      <li class="cmt_re">
        <div class="cmt_item_1"><span class="name_active">책방주인</span> · 제주 서귀포<span class="f_right"><img src="/images/ic_more.png" onclick="modal_open_slide('cmt_more')" alt="더보기" class="w_16"></span></div>
        <div class="cmt_item_2">무슨 뜬금없는 소린가요?</div>
        <div class="cmt_action">
          <span>00:00</span>
          <span><a href="javascript:void(0)" onclick="cmt_btn_like(this)" class="cmt_btn_like ease">120</a></span>
          <span onclick="reg_reply()">대댓글</span>
        </div>
      </li>
      <li class="cmt_re">  
        <div class="item_blind">관리자에 의해 블라인드 된 글입니다.</div>
      </li>
      <li class="cmt_re">  
        <div class="item_blind">삭제된 글입니다.</div>
      </li>
      <li>  
        <div class="item_blind">관리자에 의해 블라인드 된 글입니다.</div>
      </li>
      <li>  
        <div class="item_blind">삭제된 글입니다.</div>
      </li>
      <li>  
        <div class="item_blind">차단한 글입니다. <a href="#" class="blind_clear">차단 해제</a></div>
      </li>
    </ul>
    
    <div class="cmt_reg">
      <!-- <div class="tag">분홍색개구리님에게 답글 남기는 중</div> -->
      <input type="text" class="input" id="input" placeholder="댓글을 입력하여 주세요.">
      <img src="/images/btn_send.png" alt="등록" class="btn_send">
    </div>
  </div>
  <!-- <div id="reply_back" onclick="reply_back_close()"></div> -->
  <!-- 댓글:e -->
</div>

<a href="#"><img src="/images/floating_top.png" class="top_floating type_1 top"></a>

<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_cmt_more">
  <ul class="slide_modal_menu">
    <li>
      <a href="javascript:void(0)" onclick="modal_open_slide('report');modal_close_slide('cmt_more')">신고</a>
    </li>
    <li>
      <a href="javascript:void(0)">삭제</a>
    </li>
    <li>
    <a href="javascript:modal_close_slide('cmt_more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_cmt_more" onclick="modal_close_slide('cmt_more')"></div>
<!-- modal_open_slide : e -->
<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul class="slide_modal_menu">
    <li>
      <a href="/<?=mapping('community')?>/community_mod">수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open_slide('report');modal_close_slide('more')">신고</a>
    </li>
    <li>
      <a href="javascript:modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->
<div class="modal_slide modal_slide_report" style="bottom: 0px;">
  <div class="">
    <div class="modal_title">신고</div>
    <p class="modal_txt">부적절한 내용이 포함되어 있나요?<br>신고하는 이유를 선택해주세요.</p>
    <select name="" id="">
      <option value="">선택</option>
      <option value="">선택</option>
    </select>
    <div class="label">신고 사유 입력 <span class="essential">*</span></div>
    <textarea name="" id="" cols="" rows=""></textarea>
    <div class="btn_report">
      <span onclick="modal_close_slide('report')">
        취소
      </span>
      <span class="txt_red">
        신고
      </span>
    </div>
  </div>
</div>
<div class="md_slide_overlay md_slide_overlay_report" onclick="modal_close_slide('report')"></div>

<!-- modal : s -->
<div class="modal modal_swiper_img_view">
  <header class="transparent">
    <div class="btn_left"><img src="/images/head_btn_close_w.png" onclick="javascript:modal_close('swiper_img_view')"></div>
  </header>
  <div class="wrap">
    <div class="swiper img_big_swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="img_box">
            <img src="/p_images/s1.jpg">
          </div>
        </div>
        <div class="swiper-slide">
          <div class="img_box">
            <img src="/p_images/s2.jpg">
          </div>
        </div>
        <div class="swiper-slide">
          <div class="img_box">
            <img src="/p_images/s3.jpg">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_swiper_img_view" onclick="javascript:modal_close('swiper_img_view')"></div>

<script>
// 스크랩 토글버튼
function btn_scrap(element){
    if($(element).hasClass("on")){
      $(element).removeClass("on");
    } else {
      $(element).addClass("on");
    }
  }

// 좋아요 토글버튼
function detail_btn_like(element){
    if($(element).hasClass("on")){
      $(element).removeClass("on");
    } else {
      $(element).addClass("on");
    }
  }
  var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".community_swiper .swiper-pagination",
    },
  });

// 댓글 좋아요 토글버튼
function cmt_btn_like(element){
    if($(element).hasClass("on")){
      $(element).removeClass("on");
    } else {
      $(element).addClass("on");
    }
  }
  var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".community_swiper .swiper-pagination",
    },
  });


  function idx(idx){
  // 모달 슬라이더 이미지
    var img_big_swiper = new Swiper(".img_big_swiper", {
      initialSlide: idx,
      slidesPerView: 1,
      autoHeight: true,
      pagination: {
      el: ".swiper-pagination",
    },
      navigation: {
        nextEl: ".modal_swiper_img_view .swiper-button-next",
        prevEl: ".modal_swiper_img_view .swiper-button-prev",
      },
    });
  }

  function text_all_view(e){
    const siblings = e.previousElementSibling;
    e.style.display = 'none';
    siblings.style.display = 'block';
  }

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

  // 답글달기
  function reg_reply(){
    $('.tag').css('display','block');
    $('#reply_back').css('display','block');
    $('#input').focus();
  }
  // 답글닫기
  function reply_back_close(){
    $('#input').val('');
    $('.tag').css('display','none');
    $('#reply_back').css('display','none');
  }

  // 댓글 입력되면 버튼 노출/토글
  $(".input").on("propertychange change keyup paste input", function(){
    if ($(this).val().length === 0) {
      $('.btn_send').css('display','none');
    }else{
      $('.btn_send').css('display','block');
    };
  })

// top
$( document ).ready( function() {
$( window ).scroll( function() {
    if ( $( this ).scrollTop() > 200 ) {
    $( '.top' ).fadeIn();
    } else {
    $( '.top' ).fadeOut();
    }
} );
$( '.top' ).click( function() {
    $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
    return false;
} );
} );
</script>