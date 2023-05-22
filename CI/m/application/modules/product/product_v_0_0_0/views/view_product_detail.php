<header class="transparent ease">
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <div class="btn_right">
    <a href="javascript:void(0)" class="btn_scrap ease" onclick="btn_scrap(this)"></a>
    <img src="/images/head_btn_more.png" alt="" onclick="modal_open_slide('more')">
  </div>
</header>

<div class="row">
  <div class="swiper detail_img_swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s1.jpg" onclick="modal_open('swiper_img_view');idx(0)">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s2.jpg" onclick="modal_open('swiper_img_view');idx(1)">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s3.jpg" onclick="modal_open('swiper_img_view');idx(2)">
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</div>

  
  <!-- community head -->
  <div class="detail_head">
      <!-- <div class="trade_state">예약</div> -->
      <div class="mb20">
        <span class="state_1">D-11</span>
      </div>
      <p class="txt_title">월넛과 베이지로 차분하게, 무드있는 신혼집</p>

      <div class="font_gray_f mt30"><b class="point_color fs_20">88% </b>달성</div>
      <div class="txt_price">180,000원</div>
      <table class="mt25 table_info">
        <colgroup>
          <col width='130px'>
          <col width='*'>
        </colgroup>
        <tr>
          <th>판매기간</th>
          <td>9월 18일(일) 까지</td>
        </tr>
        <tr>
          <th>1인 최소 구매</th>
          <td>2</td>
        </tr>
        <tr>
          <th>1인 최대 구매 가능</th>
          <td>5</td>
        </tr>
      </table>
  </div>
  <ul class="tab_2">
    <li class="active"><a href="#">상품정보</a></li>
    <li><a href="#qna">Q&A</a></li>
  </ul>
  <!-- community body -->
  <div class="detail_body">
    <img src="/p_images/s2.jpg">
    3비닐만 벗겨놓은 상태입니다.<br>직거래시 직접 확인하시고 구매하셔도 되요.<br><br>
    사이즈가 큰 편이어서 SUV 정도의 차량 아니면 들어가지 않아요. 01012345678 로 문자 남겨주세요.
    <div id="qna"></div>
  </div>
  <hr>
 
  <!-- Q&A : s -->
  <div class="row">
    <div class="inner_wrap">
      <h5 class="mt30">Q&A</h5>
      <a href="javascript:void(0)" onclick="modal_open('qa_reg')" class="btn_point_ghost btn_full_basic mt20">문의하기</a>
    </div>
  </div>
  <!-- Q&A : e -->

  <div class="no_data">
    <p><span class="message_box">작성된 문의글이 없습니다.</span></p>
  </div>

  <ul class="detail_qna_list pdb55">
    <li class="accordion">
      <div class="inner_wrap trigger">
        <p class="fs_12 point_color">답변완료</p>
        <div class="fs_12 mt5">벚꽃보러가요 <span class="f_right date">2023.01.01 09:20</span></div>
        <p class="txt_q">이거 언제 보내주실 거에요??</p>
      </div>
      
      <div class="panel qa_answer_wrap">
          <div class="fs_12 mb10">답변<span class="f_right date">2023.01.01 09:20</span></div>
          안녕하세요 고객님.<br>
          최근 주문량 증가로 인해 순차적으로 출고 진행이<br>
          되고 있으니 조금만 양해 부탁드립니다.<br>
      </div>
    </li>
    <li class="accordion">
      <div class="inner_wrap"><!-- 비밀글일 경우 trigger를 삭제한다 -->
        <p class="fs_12 font_gray_A0">미답변</p>
        <div class="fs_12 mt5">벚꽃보러가요 <span class="f_right date">2023.01.01 09:20</span></div>
        <p class="txt_q"><img src="/images/ic_login_lock.png">비밀글 입니다.</p>
      </div>
    </li>
  </ul>


  <div class="btn_floating">
    <a href="#" class="btn_point">구매하기</a>
  </div>

<!-- 문의 작성 modal : s -->
<div class="modal modal_full modal_qa_reg vh_wrap">
  <header>
    <a class="btn_left" href="#">
      <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('qa_reg')" alt="뒤로가기">
    </a>
    <h1>&nbsp;</h1>
    <span class="head_txt"><a href="#">등록</a></span>
  </header>
  <div class="vh_body">
    <div class="community_head">
      <p class="fs_12 font_gray_A0">공동구매와 관련없는 문의는 플랫폼 내 1:1 문의를 이용해주세요.<br>
      작성하신 문의는 <span class="font_gray_f fs_12">‘마이페이지 > 문의 내역’</span> 에서 확인 할 수 있습니다.</p>
    </div>
    <div class="mt20 inner_wrap">
      <textarea class="ghost" placeholder="문의 내용"></textarea>
    </div>
    
  </div>
  
  <div class="vh_footer mb30">
    <div class="mt20">
        <input type="checkbox" name="check" id="check_0" value="Y">
        <label for="check_0"><span></span><b>나만 보기</b></label>
      </div>
  </div>
</div>
<!-- 문의 작성 modal : e -->
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

//이미지 배너
var swiper = new Swiper(".detail_img_swiper", {
  pagination: {
    el: ".detail_img_swiper .swiper-pagination",
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

// header scroll
let criteria_scroll_top = 0;
$(window).on('scroll',function (){
	let scrollTop = $(this).scrollTop();
	if(scrollTop > criteria_scroll_top){
    $('header').addClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back.png');
		$('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot.png');
	}else{
    $('header').removeClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back_w.png');
		$('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot_w.png');

	}
})

</script>