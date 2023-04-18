<header>
  <div class="btn_back" onclick="COM_history_back_fn()">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
    내 커뮤니티
  </h1>
</header>
<div class="body view_community footer_margin inner_wrap">
  <div class="">
    <ul class="tab_toggle_menu clearfix">
      <li class="active">
        이브의 고민
      </li>
      <li class="">
        오늘의 운동 완료
      </li>
    </ul>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">
        <div class="no_data">
          <p>작성한 게시물이 없습니다.</p>
        </div>
        <ul class="community_ul0">
          <li>
            <a href="/<?= mapping('community') ?>/community_detail1">
              <div class="title"><span>성지식 </span>제가 이해해야 되는 부분일까요?</div>
              <ul class="info_ul4">
                <li>
                  111
                </li>
                <li>
                  111
                </li>
                <li>
                  160
                </li>
              </ul>
            </a>
          </li>
        </ul>

      </div>
      <!-- 탭 영역 1 : e -->
      <!-- 탭 영역 2 : s -->
      <div class="">

        <ul class="mb20_ul mt20" id="today_board">
          <li>
            <div>
              <div class="board_shadow_box">
                <div class="p16" onclick='location.href="/<?= mapping('community') ?>/community_detail2"'>
                  <table class="tbl_fix tbl_3">
                    <colgroup>
                      <col width='44px'>
                      <col width='*'>
                      <col width='20px'>
                    </colgroup>
                    <tr>
                      <th>
                        <div class="img_box">
                          <img src="/p_images/s1.png" alt="">
                        </div>
                      </th>
                      <td>
                        <div class="name">토마토</div>
                        <div class="date">1일 전</div>
                      </td>
                      <td>
                        <img src="/images/i_dot_2.png" alt="..." onclick="modal_open_slide('more')" class="btn_more">
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="swiper community_swiper" onclick='location.href="/<?= mapping('community') ?>/community_detail2"'>
                  <div class="swiper-wrapper">
                    <div class="swiper-slide">
                      <div class="img_box">
                        <img src="/p_images/s2.png" alt="">
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="img_box">
                        <img src="/p_images/s2.png" alt="">
                      </div>
                    </div>
                    <div class="swiper-slide">
                      <div class="img_box">
                        <img src="/p_images/s2.png" alt="">
                      </div>
                    </div>
                  </div>
                  <div class="swiper-pagination"></div>
                </div>
                <div class="p16">
                  <div class="contents_txt" onclick='location.href="/<?= mapping('community') ?>/community_detail2"'>
                    <p id="today_contents_txt">이번주 운동을 5일 내내 했더니 너무 힘들다ㅠ 그래도 변하는 모습을 보니 뿌듯하다. 운동하는 재미를 느끼는 요즘ㅎㅎ 행복이란 이런 걸까 내일도 열심히 해</p>

                    <button onclick="text_all_view(this)" id="button_today">전체보기</button>
                  </div>
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
              </div>
            </div>
          </li>
          <li>
            <div class="board_shadow_box">
              <div class="p16">
                <table class="tbl_fix tbl_3">
                  <colgroup>
                    <col width='44px'>
                    <col width='*'>
                    <col width='20px'>
                  </colgroup>
                  <tr>
                    <th>
                      <div class="img_box">
                        <img src="/p_images/s1.png" alt="">
                      </div>
                    </th>
                    <td>
                      <div class="name">토마토</div>
                      <div class="date">1일 전</div>
                    </td>
                    <td>
                      <img src="/images/i_dot_2.png" alt="..." class="btn_more">
                    </td>
                  </tr>
                </table>
              </div>
              <div class="swiper community_swiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <div class="img_box">
                      <img src="/p_images/s2.png" alt="">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="img_box">
                      <img src="/p_images/s2.png" alt="">
                    </div>
                  </div>
                  <div class="swiper-slide">
                    <div class="img_box">
                      <img src="/p_images/s2.png" alt="">
                    </div>
                  </div>
                </div>
                <div class="swiper-pagination"></div>
              </div>
              <div class="p16">
                <div class="contents_txt">
                  <p id="today_contents_txt">이번주 운동을 5일 내내 했더니 너무 힘들다ㅠ 그래도 변하는 모습을 보니 뿌듯하다. 운동하는 재미를 느끼는 요즘ㅎㅎ 행복이란 이런 걸까 내일도 열심히 해</p>

                  <button onclick="text_all_view(this)" id="button_today">전체보기</button>
                </div>
                <ul class="my_schedule_ul">
                  <li>
                    <a href="/<?= mapping('product') ?>/product_detail">
                      <table class="tbl_fix tbl_2">
                        <colgroup>
                          <col width='58px'>
                          <col width='*'>
                        </colgroup>
                        <tr>
                          <th>
                            <div class="img_box">
                              <img src="/p_images/s1.png" alt="">
                            </div>
                          </th>
                          <td>
                            <div class="title">골반 근육 강화 프로그램 <span class="f_right">13분 48초</span></div>
                            <p>토 / 일 <span>2022.08.01 ~ 2022.08.29</span></p>
                          </td>
                        </tr>
                      </table>
                    </a>
                  </li>
                  <li>
                    <a href="/<?= mapping('product') ?>/product_detail">
                      <table class="tbl_fix tbl_2">
                        <colgroup>
                          <col width='58px'>
                          <col width='*'>
                        </colgroup>
                        <tr>
                          <th>
                            <div class="img_box">
                              <img src="/p_images/s1.png" alt="">
                            </div>
                          </th>
                          <td>
                            <div class="title">골반 근육 강화 프로그램<span class="f_right">13분 48초</span></div>
                            <p>토 / 일 <span>2022.08.01 ~ 2022.08.29</span></p>
                          </td>
                        </tr>
                      </table>
                    </a>
                  </li>
                </ul>
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
            </div>
          </li>
          <li>
            <div class="board_shadow_box">
              <div class="p16">
                <table class="tbl_fix tbl_3">
                  <colgroup>
                    <col width='44px'>
                    <col width='*'>
                    <col width='20px'>
                  </colgroup>
                  <tr>
                    <th>
                      <div class="img_box">
                        <img src="/p_images/s1.png" alt="">
                      </div>
                    </th>
                    <td>
                      <div class="name">토마토</div>
                      <div class="date">1일 전</div>
                    </td>
                    <td>
                      <img src="/images/i_dot_2.png" alt="..." class="btn_more">
                    </td>
                  </tr>
                </table>
                <div class="contents_txt">
                  <p id="today_contents_txt">이번주 운동을 5일 내내 했더니 너무 힘들다ㅠ 그래도 변하는 모습을 보니 뿌듯하다. 운동하는 재미를 느끼는 요즘ㅎㅎ </p>

                  <button onclick="text_all_view(this)" id="button_today">전체보기</button>
                </div>
                <ul class="my_schedule_ul">
                  <li>
                    <a href="/<?= mapping('product') ?>/product_detail">
                      <table class="tbl_fix tbl_2">
                        <colgroup>
                          <col width='58px'>
                          <col width='*'>
                        </colgroup>
                        <tr>
                          <th>
                            <div class="img_box">
                              <img src="/p_images/s1.png" alt="">
                            </div>
                          </th>
                          <td>
                            <div class="title">골반 근육 강화 프로그램<span class="f_right">13분 48초</span></div>
                            <p>토 / 일 <span>2022.08.01 ~ 2022.08.29</span></p>
                          </td>
                        </tr>
                      </table>
                    </a>
                  </li>
                  <li>
                    <a href="/<?= mapping('product') ?>/product_detail">
                      <table class="tbl_fix tbl_2">
                        <colgroup>
                          <col width='58px'>
                          <col width='*'>
                        </colgroup>
                        <tr>
                          <th>
                            <div class="img_box">
                              <img src="/p_images/s1.png" alt="">
                            </div>
                          </th>
                          <td>
                            <div class="title">골반 근육 강화 프로그램<span class="f_right">13분 48초</span></div>
                            <p>토 / 일 <span>2022.08.01 ~ 2022.08.29</span></p>
                          </td>
                        </tr>
                      </table>
                    </a>
                  </li>
                </ul>
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
            </div>
          </li>
          <li class="blind">
            <div class="board_shadow_box">
              <p>차단한 게시글입니다.</p>
              <button>차단해제</button>
            </div>
          </li>
          <li class="blind">
            <div class="board_shadow_box">
              <p>신고한 게시물 입니다.</p>
            </div>
          </li>
        </ul>

        <div class="float_margin"></div>
        <img src="/images/float_top.png" onclick="gotop()" class="float1">
        <a href="/<?= mapping('community') ?>/community_reg2"><img src="/images/float_plus.png" alt="" class="float2"></a>
      </div>
      <!-- 탭 영역 2 : e -->
    </div>
  </div>
</div>
<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)">스케줄 수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more')">삭제</a>
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

<script>
  var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".swiper-pagination",
      dynamicBullets: true,
    },
  });

  function text_all_view(e) {
    const siblings = e.previousElementSibling;
    e.style.display = 'none';
    siblings.style.display = 'block';
  }

  var best_swiper = new Swiper('.best_swiper', {
    slidesPerView: 1.1,
    spaceBetween: 20,
  });
  // 3줄 이하 체크
  let board_cnt = $('.contents_txt').length;
  for (var i = 0; i < board_cnt; i++) {
    let contents_txt = $('#today_board > li').eq(i).find('#today_contents_txt').height();
    if (contents_txt > 90) {} else {
      $('#today_board > li').eq(i).find('#button_today').hide();
    }
  }
</script>