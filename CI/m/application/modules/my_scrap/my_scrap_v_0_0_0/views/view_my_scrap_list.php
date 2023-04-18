<header>
  <div class="btn_back" onclick="COM_history_back_fn()">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
  스크랩
  </h1>
</header>
<div class="body footer_margin inner_wrap">
  <div class="">
    <ul class="tab_toggle_menu clearfix">
      <li class="active">
      프로그램
      </li>
      <li class="">
      매거진
      </li>
    </ul>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">
        <div class="no_data">
          <p>스크랩 된 게시물이 없습니다.</p>
        </div>
        <ul class="my_scrap_ul">
          <li>
            <img src="/images/btn_delete_2.png" alt="x" class="btn_delete_2">
            <a href="/<?= mapping('program') ?>/program_detail">
              <table class="tbl_1">
                <colgroup>
                  <col width="105px">
                  <col width="*">
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box">
                      <img src="/p_images/s1.png" alt="">
                    </div>
                  </th>
                  <td>
                    <div class="title">5회 반복 수축 운동 Part1</div>
                    <div class="level"><span>난이도</span>
                      <ul class="level_ul">
                        <li class="on"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>
                    </div>
                    <ul class="info_ul">
                      <li>
                        111
                      </li>
                      <li>
                        111
                      </li>
                    </ul>
                  </td>
                </tr>
              </table>
            </a>
          </li>
          <li>
            <img src="/images/btn_delete_2.png" alt="x" class="btn_delete_2">
            <a href="/<?= mapping('program') ?>/program_detail">
              <table class="tbl_1">
                <colgroup>
                  <col width="105px">
                  <col width="*">
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box">
                      <img src="/p_images/s1.png" alt="">
                    </div>
                  </th>
                  <td>
                    <div class="title">5회 반복 수축 운동 Part1</div>
                    <div class="level"><span>난이도</span>
                      <ul class="level_ul">
                        <li class="on"></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>
                    </div>
                    <ul class="info_ul">
                      <li>
                        111
                      </li>
                      <li>
                        111
                      </li>
                    </ul>
                  </td>
                </tr>
              </table>
            </a>
          </li>
        </ul>

      </div>
      <!-- 탭 영역 1 : e -->
      <!-- 탭 영역 2 : s -->
      <div class="">
        <ul class="my_scrap_ul">
          <li>
            <img src="/images/btn_delete_2.png" alt="x" class="btn_delete_2">
            <a href="/<?= mapping('program') ?>/program_detail">
              <table class="tbl_1">
                <colgroup>
                  <col width="105px">
                  <col width="*">
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box">
                      <img src="/p_images/s1.png" alt="">
                    </div>
                  </th>
                  <td>
                    <div class="title">5회 반복 수축 운동 Part1</div>
                    <div class="sub_title txt_overflow2">골반저근육이 과도한 긴장감을 지고 있다거나, 근육이 자주  </div>
                  </td>
                </tr>
              </table>
            </a>
          </li>
          <li class="blind">
            <table class="tbl_1">
              <colgroup>
                <col width="105px">
                <col width="*">
              </colgroup>
              <tr>
                <th>
                  <div class="img_box">
                    <img src="/p_images/s1.png" alt="">
                  </div>
                </th>
                <td>
                  <img src="/images/btn_delete_2.png" alt="x" class="btn_delete_2">
                  <p>숨긴 컨텐츠 입니다.</p>
                  <button>숨기기 해제</button>
                </td>
              </tr>
            </table>
          </li>
        </ul>
   
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
  function text_all_view(e){
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
  for(var i = 0; i < board_cnt; i++){
    let contents_txt = $('#today_board > li').eq(i).find('#today_contents_txt').height();
    if(contents_txt > 90){
    }else{
      $('#today_board > li').eq(i).find('#button_today').hide();
    }
  }
</script>