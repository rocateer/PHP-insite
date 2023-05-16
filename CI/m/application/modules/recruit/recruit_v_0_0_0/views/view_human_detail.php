<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <div class="btn_right">
    <a href="javascript:void(0)" class="btn_scrap ease" onclick="btn_scrap(this)"></a>
    <img src="/images/head_btn_more.png" alt="" onclick="modal_open_slide('more')">
  </div>
</header>
<div class="body pdb55">

  <!-- community head -->
  <div class="detail_head">
      <p class="detail_title">월넛과 베이지로 차분하게, 무드있는 신혼집</p>
      <p class="txt_nickname">플랫폼로캣티어  <span class="f_right detail_date">2022.12.21</span></p>
  </div>
  <div class="inner_wrap">
    <table class="mt30 table_info" >
      <colgroup>
        <col width='80px'>
        <col width='*'>
      </colgroup>
      <tr>
        <th>마감일</th>
        <td>2023.04.04 <span class="point_color">(D-13)</span></td>
      </tr>
      <tr>
        <th>근무지역</th>
        <td>경기<img src="/images/ic_sm_arrow.png" class="w_16 middle">성남시 분당구</td>
      </tr>
      <tr>
        <th>모집분야</th>
        <td>장판</td>
      </tr>
      <tr>
        <th>경력</th>
        <td>5년 이상</td>
      </tr>
      <tr>
        <th>성별</th>
        <td>성별무관</td>
      </tr>
      <tr>
        <th>연령</th>
        <td>20세 이상 35세 이하</td>
      </tr>
      <tr>
        <th>급여</th>
        <td><span class="point_color">일급</span> 300,000이하</td>
      </tr>
    </table>
  </div>
  <hr class="space mt20">
  <!-- community body -->
  <div class="inner_wrap mt20">
    근무형태 : 정규직 (수습 2개월)<br>
    근무요일 : 주 5일<br>
    근무시간 : 10시 00분 ~ 19시 00분<br><br>

    전형절차는 서류전형 후 최종합격 입니다.<br>
    많은 지원 바랍니다.
  
    <div class="community_img_view_swiper">
      <div class="swiper community_swiper">
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

  </div>

</div>

<div class="btn_floating float_half">
  <a href="tel:010-2806-6214" class="btn_point_ghost">전화하기</a>
  <a href="/<?=mapping('recruit')?>/human_apply" class="btn_point">지원하기</a>
  <!-- <a href="#" class="btn_disabled">지원한 공고</a> 지원 후 버튼 -->
</div>

<!-- 마감 버튼 
<div class="btn_floating">
  <a href="#" class="btn_disabled">마감되었어요</a>
</div> -->

<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul class="slide_modal_menu">
    <li>
      <a href="/<?=mapping('community')?>/community_mod">차단</a>
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

<!-- 신고하기 : s -->
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
<!-- 신고하기 : e -->

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

//이미지
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

  

</script>