<header class="transparent fixed">
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back_w.png" alt="닫기"></a>
</header>
<div class="visual_img_wrap">
  <img src="/p_images/s1.png" alt="" class="img_block">
</div>
<div class="container_round product_detail_view">
  <div class="inner_wrap">
    <h2 class="txt_center">프로그램명</h2>
    <table class="tbl_center">
      <tr>
        <th>

          <div class="level"><span>난이도</span>
            <ul class="level_ul">
              <li class="on"></li>
              <li></li>
              <li></li>
              <li></li>
              <li></li>
            </ul>
          </div>
        </th>
        <td>
          <img src="/images/i_time.png" class="i_time"> 15분 소요
        </td>
      </tr>
    </table>
    <p class="color7">골반저근육은 방광을 조절하고 골반 장기를 지탱합니다. 골반저근육은 레바토르 아니(Levator Ani), 코시게우스 (Coccygeus)라는 근육과 관련 조직으로 구성되어 있습니다.</p>
    <ul class="info_ul row">
      <li>
        111
      </li>
      <li>
        <span class="wish_btn" onclick="wish_btn(this)">
          <a class="" href="javascript:void(0)"></a>
          111
        </span>
      </li>
    </ul>
    <ul class="mb14_ul product_detail_ul">
      <li>
        <a href="javascript:modal_open('contents_detail')">

          <table>
            <tr>
              <th>
                <div class="img_box">
                  <img src="/p_images/s1.png" alt="">
                </div>
              </th>
              <td>
                <h4>5회 반복 수축 운동 Part1</h4>
                <p class="line_txt">목, 어깨, 등 통증의 원인은 매우 다양하지만, 대부분은 잘못된 자...</p>
              </td>
            </tr>
          </table>
        </a>
      </li>
    </ul>
    <div class="flex_3">
      <div class="btn_full_weight btn_scrap">
        <input type="checkbox" id="chk_2_1" name="chk_1">
        <label for="chk_2_1">
          <span></span>
          스크랩
        </label>
      </div>
      <div class="btn_full_weight btn_point">
        <a href="/<?= mapping('main') ?>/routine_reg">스케줄 추가</a>
      </div>
    </div>
  </div>

</div>
<div class="modal modal_contents_detail">

  <header class="transparent fixed">
    <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_close_w.png" alt="닫기"></a>
  </header>
  <div class="inner_scroll">
    <div class="visual_img_wrap">
      <img src="/p_images/s1.png" alt="" class="img_block">
    </div>
    <div class="container_round program_detail_view product_detail_view">
      <div class="inner_wrap">
        <h2 class="txt_center">프로그램명</h2>
        <table class="tbl_center">
          <tr>
            <th>
              <img src="/images/i_ready.png" class="i_time"> 요가매트

            </th>
            <td>
              <img src="/images/i_time.png" class="i_time"> 15분 소요
            </td>
          </tr>
        </table>
        <div class="contents_iframe_wrap">
          <iframe class="contents_iframe" src="https://www.youtube.com/embed/PA1M_VYdF_E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div id="edit"></div>
      </div>

    </div>
  </div>
</div>
<div class="flex_3 floating">
  <div class="btn_full_weight btn_scrap">
    <input type="checkbox" id="chk_2_1" name="chk_1">
    <label for="chk_2_1">
      <span></span>
      스크랩
    </label>
  </div>
  <div class="btn_full_weight btn_point" id="btn_program_start">
    <a href="javascript:program_start()">운동 시작</a>
  </div>
  <div class="btn_full_weight btn_point" id="btn_program_end">
    <img src="/images/i_stop.png" onclick="timer()" class="i_player">
    <span class="time">00:03</span>
    <a href="">운동 완료</a>
  </div>
</div>
<script>
  $('#btn_program_end').hide();

  function program_start() {
    $('#btn_program_start').hide();
    $('#btn_program_end').show();
  }

  function timer() {
    if ($('.i_player').attr('src') == '/images/i_stop.png') {
      $('.i_player').attr('src', '/images/i_play.png')
    } else {
      $('.i_player').attr('src', '/images/i_stop.png')
    }
  }
</script>