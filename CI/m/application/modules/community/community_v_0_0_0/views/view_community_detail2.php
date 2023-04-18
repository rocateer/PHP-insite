<header>
  <div class="btn_close" onclick="modal_open_slide('more')">
    <img src="/images/i_dot_2.png" alt="">
  </div>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <div class="profile">
    <div class="img_box">
      <img src="/p_images/s1.png" alt="">
    </div>
    <span class="name">토마토</span>
  </div>
</header>
<div class="body community_detail_view">
  <div class="swiper community_swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s2.png"onclick="modal_open('swiper_img_view');idx(0)">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s2.png"onclick="modal_open('swiper_img_view');idx(1)">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s2.png"onclick="modal_open('swiper_img_view');idx(2)">
        </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <div class="p16">
    <div class="contents_txt">
      <p>이번주 운동을 5일 내내 했더니 너무 힘들다ㅠ 그래도 변하는 모습을 보니 뿌듯하다. 운동하는 재미를 느끼는 요즘ㅎㅎ 행복이란 이런 걸까 내일도 열심히 해</p>
    </div>
    <div class="date">2020.12.10 15:32</div>
    <div id="today_program_wrap">
      <ul class="today_program_ul">
        <li>
          <table>
            <colgroup>
              <col width='55px'>
              <col width='*'>
            </colgroup>
            <tr>
              <th>
                <div class="img_box">
                  <img src="/p_images/s1.png" alt="">
                </div>
              </th>
              <td>
                <table class="tbl_4_1">
                  <tr>
                    <th>
                      <span class="name">골반근육강화프로그램</span>
                      <span class="name f_right">13분 11초</span>
                    </th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <p class="date">토 / 일<span class="f_right">2022.08.01 ~ 2022.08.29</span></p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </li>
        <li>
          <table>
            <colgroup>
              <col width='55px'>
              <col width='*'>
            </colgroup>
            <tr>
              <th>
                <div class="img_box">
                  <img src="/p_images/s1.png" alt="">
                </div>
              </th>
              <td>
                <table class="tbl_4_1">
                  <tr>
                    <th>
                      <span class="name">골반근육강화프로그램</span>
                      <span class="name f_right">13분 11초</span>
                    </th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <p class="date">토 / 일<span class="f_right">2022.08.01 ~ 2022.08.29</span></p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </li>
        <li>
          <table>
            <colgroup>
              <col width='55px'>
              <col width='*'>
            </colgroup>
            <tr>
              <th>
                <div class="img_box">
                  <img src="/p_images/s1.png" alt="">
                </div>
              </th>
              <td>
                <table class="tbl_4_1">
                  <tr>
                    <th>
                      <span class="name">골반근육강화프로그램</span>
                      <span class="name f_right">13분 11초</span>
                    </th>
                  </tr>
                  <tr>
                    <td colspan="2">
                      <p class="date">토 / 일<span class="f_right">2022.08.01 ~ 2022.08.29</span></p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </li>
      </ul>
    </div>
    <div class="txt_center">
      <button class="btn_more_view" onclick="more_view()">더보기</button>
    </div>
  </div>  
  <hr class="space mb20">
  <div class="inner_wrap">
    <ul class="info_ul2">
      <li>
        <span class="wish_btn">
          <a class="" href="javascript:void(0)" onclick="wish_btn(this)"></a>
        </span>
        <b>99</b>
      </li>
      <li>
        <img src="/images/i_comment_3.png" alt="">
        111
      </li>
    </ul>
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
                  <img src="https://user-images.githubusercontent.com/61073999/149730993-4c749b1e-8cb2-4f60-8b2f-f8bce3a6ae2d.png" alt="">
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
                  <img src="https://user-images.githubusercontent.com/61073999/149730993-4c749b1e-8cb2-4f60-8b2f-f8bce3a6ae2d.png" alt="">
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
                  <img src="https://user-images.githubusercontent.com/61073999/149730993-4c749b1e-8cb2-4f60-8b2f-f8bce3a6ae2d.png" alt="">
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
      <spab class="btn_md_left">
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
    <span class="cnt">1/8</span>
  </header>
  <div class="wrap">
    <div class="swiper community_img_view_swiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="img_box">
            <img src="https://cdn.pixabay.com/photo/2021/12/08/05/13/gyeongbok-palace-6854763_960_720.jpg">
          </div>
        </div>
        <div class="swiper-slide">
          <div class="img_box">
            <img src="https://cdn.pixabay.com/photo/2021/12/08/05/13/gyeongbok-palace-6854763_960_720.jpg">
          </div>
        </div>
        <div class="swiper-slide">
          <div class="img_box">
            <img src="https://cdn.pixabay.com/photo/2021/12/08/05/13/gyeongbok-palace-6854763_960_720.jpg">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_swiper_img_view" onclick="javascript:modal_close('swiper_img_view')"></div>

<script>
    var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".swiper-pagination",
      dynamicBullets: true,
    },
  });
  function idx(idx){
  // 모달 슬라이더 이미지
    var community_img_view_swiper = new Swiper(".community_img_view_swiper", {
      initialSlide: idx,
      slidesPerView: 1,
      autoHeight: true,
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

// 민지 : 모달 슬라이드
window.onload = function(){
  let md_slide_height;
	for(var i = 0; i<$('.modal_slide').length;i++){ // 각 모달의 높이 값만큼 -
	  md_slide_height = $('.modal_slide').eq(i).outerHeight();
	  $('.modal_slide').eq(i).css('bottom',-md_slide_height);
	} //모든 모달슬라이드 숨기기
}
// 민지
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
  if($('#today_program_wrap').height() < 200){
    $('.btn_more_view').hide();
  };
  function more_view(){
    $('.btn_more_view').hide();
  }

</script>