<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <div class="btn_right">
    <a href="javascript:void(0)" class="btn_scrap" onclick="btn_scrap(this)"></a>
    <img src="/images/head_btn_more.png" alt="" onclick="modal_open_slide('more')">
  </div>
</header>
<div class="body">

  <!-- community head -->
  <div class="community_detail_head">
    <div class="detail_info">
      <span class="detail_category"><img src="/images/ic_cate_1.png">자유공간</span>
      드림꿈드림임 · 목공 · 서울 남부
      <span class="detail_date">2023.01.01</span>
    </div>
    <div class="detail_title">월넛과 베이지로 차분하게, 무드있는 <img src="/images/ic_vote.png" class="w_24 middle"></div>
  </div>

  <!-- community body -->
  <div class="community_detail_body">
    33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기를 했지만 발코니가 과하게 넓고 활용도도 떨어져 거실 쪽 발코니만 확장 하였답니다. 그 외 욕실, 주방, 중문, 타일, 도배 및 장판등을 진행하였어요.
    
    <div class="community_img_view_swiper">
      <div class="swiper community_swiper">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="img_box">
              <img src="/p_images/s1.png" onclick="modal_open('swiper_img_view');idx(0)">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="img_box">
              <img src="/p_images/s2.png" onclick="modal_open('swiper_img_view');idx(1)">
            </div>
          </div>
          <div class="swiper-slide">
            <div class="img_box">
              <img src="/p_images/s3.png" onclick="modal_open('swiper_img_view');idx(2)">
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
    

  </div>
  
    
  <!-- 댓글:s -->
  <div class="cmt_wrap">
    <div class="cmt_area">
      <div class="no_data">
        <p>아직 댓글이 없습니다.<br>댓글을 달아주세요!</p>
      </div>
      <!-- 댓글: tbl_cmt, 답글: tbl_reply, etc: cmt_blind -->
      <ul class="cmt_ul">
        <li>
          <table class="tbl_cmt">
            <tr>
              <th class="relative">
                <div class="img_box">
                  <img src="/p_images/p1.png" alt="">
                </div>
                <span class="name">HELLOWORLD</span>

                <img src="/images/i_dot_2.png" onclick="modal_open_slide('cmt_more')" alt="더보기" class="btn_more">
              </th>
            </tr>
            <tr>
              <td>
                <p class="p">이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</p>
              </td>
            </tr>
            <tr>
              <td>
                <span class="date">2020.01.01</span>
                <span class="reg_reply" onclick="reg_reply()">답글 달기</span>
              </td>
            </tr>
          </table>
        </li>
        <li>  
          <div class="cmt_blind">
            삭제된 글입니다.
          </div>
        </li>
        <li>
          <table class="tbl_cmt">
            <tr>
              <th class="relative">
                <div class="img_box">
                  <img src="/p_images/p1.png" alt="">
                </div>
                <span class="name"><span class="blue">작성자</span></span>

                <img src="/images/i_dot_2.png" onclick="modal_open_slide('cmt_more')" alt="더보기" class="btn_more">

              </th>
            </tr>
            <tr>
              <td>
                <p class="p">이사 온 지 얼마 안 됐는데 담비한테 친구들이 생겨서 다행이에요 매주 모이면 좋겠어요!</p>
              </td>
            </tr>
            <tr>
              <td><span class="date">2020.01.01</span>
                <span class="reg_reply" onclick="reg_reply()">답글 달기</span>
              </td>
            </tr>
          </table>
          
          <table class="tbl_reply">
            <tr>
              <th class="relative">
                <div class="img_box">
                  <img src="/p_images/p1.png" alt="">
                </div>
                <span class="name"><span class="pink">관리자</span>슈퍼맨 </span>

                <img src="/images/i_dot_2.png" onclick="modal_open_slide('cmt_more')" alt="더보기" class="btn_more">
              </th>
            </tr>
            <tr>
              <td>
                <p class="cmt_blind">차단한 댓글 입니다<button class="button">차단해제</button></p>
              </td>
            </tr>
          </table>
        </li>
      </ul>
    </div>
    <button class="btn_cmt_more">댓글 더보기</button>
    <div class="cmt_reg">
      <div class="tag">왕이로다님에게 답글 남기는 중</div>
      <input type="text" class="input" id="input" placeholder="매너있는 댓글을 입력해 주세요.">
      <img src="/images/btn_send.png" alt="등록" class="btn_send">
    </div>
  </div>
  <div id="reply_back" onclick="reply_back_close()"></div>
  <!-- 댓글:e -->
</div>
<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_cmt_more">
  <ul>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('cmt_more')">신고</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('cmt_more')">삭제</a>
    </li>
  </ul>
  <ul class="close">
    <li>
      <a href="javascript:modal_close_slide('cmt_more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_cmt_more" onclick="modal_close_slide('cmt_more')"></div>
<!-- modal_open_slide : e -->
<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="/<?=mapping('community')?>/community_mod">수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more')">신고</a>
    </li>
  </ul>
  <ul class="close">
    <li>
      <a href="javascript:modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->
<div class="modal modal_report">
  <div class="md_container">
    <div class="title">부적절한 내용인가요?<br>모두가 즐길 수 있는 컨텐츠를<br>만들기 위해서는 신고가 필요합니다.</div>
    <select name="" id="">
      <option value="">선택</option>
    </select>
    <div class="label">신고 사유 입력 <span class="essential">*</span></div>
    <textarea name="" id="" cols="" rows=""></textarea>
    <div class="btn_md_wrap">
      <spab class="btn_md_left" onclick="modal_close('report')">
        취소
      </spab>
      <spab class="btn_md_right">
        확인
      </spab>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_report" onclick="modal_close('report')"></div>

<!-- modal : s -->
<div class="modal modal_swiper_img_view">
  <header class="transparent">
    <div class="btn_back"><img src="/images/head_btn_close_w.png" onclick="javascript:modal_close('swiper_img_view')"></div>
  </header>
  <div class="wrap">
    <div class="swiper community_img_view_swiper">
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

  var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".swiper-pagination",
    },
  });
  function idx(idx){
  // 모달 슬라이더 이미지
    var community_img_view_swiper = new Swiper(".community_img_view_swiper", {
      initialSlide: idx,
      slidesPerView: 1,
      autoHeight: true,
      pagination: {
      el: ".swiper-pagination",
    },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
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
    $('.comment_reg .tag').css('display','block');
    $('#reply_back').css('display','block');
    $('#input').focus();
  }
  // 답글닫기
  function reply_back_close(){
    $('#input').val('');
    $('.comment_reg .tag').css('display','none');
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


</script>