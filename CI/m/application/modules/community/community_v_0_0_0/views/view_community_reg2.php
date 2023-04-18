<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
  게시글 등록
  </h1>
  <button>등록</button>
</header>
<div class="body reg_view">
  <div class="">
    <p class="inner_wrap mb10 mt20">오늘 완료한 프로그램을 선택해 주세요</p>
    <div class="today_complete_wrap">
      <ul>
        <li>
          <input type="checkbox" id="chk_1_1" name="chk_1">
          <label for="chk_1_1">
            <table>
              <tr>
                <th>
                  <div class="img_box">
                    <img src="/p_images/s1.png" alt="">
                  </div>
                </th>
                <td>
                  <div class="name">골반 근육 강화 프로그램</div>
                </td>
              </tr>
            </table>
          </label>
        </li>
        <li>
          <input type="checkbox" id="chk_1_2" name="chk_1">
          <label for="chk_1_2">
            <table>
              <tr>
                <th>
                  <div class="img_box">
                    <img src="/p_images/s1.png" alt="">
                  </div>
                </th>
                <td>
                  <div class="name">골반 근육 강화 프로그램</div>
                </td>
              </tr>
            </table>
          </label>
        </li>
        <li>
          <input type="checkbox" id="chk_1_2" name="chk_1">
          <label for="chk_1_2">
            <table>
              <tr>
                <th>
                  <div class="img_box">
                    <img src="/p_images/s1.png" alt="">
                  </div>
                </th>
                <td>
                  <div class="name">골반 근육 강화 프로그램</div>
                </td>
              </tr>
            </table>
          </label>
        </li>
      </ul>
    </div>
    <textarea placeholder="어떤 운동을 했는지 마음껏 자랑해 주세요!" id="" cols="" class="reg_textarea"></textarea>
  </div>
  <div class="label inner_wrap">사진 </div>
  <div class="x_scroll_img_reg">
    <div class="cnt_num">0/10</div>
    <ul class="img_reg_ul" id="">
      <li>
        <div class="img_box">
          <img src="/images/btn_photo.png" alt="">
        </div>
      </li>
      <li>
        <img src="/images/btn_delete.png" alt="x" class="btn_delete">
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
    </ul>
  </div>
</div>
<script>
  $(function(){
    const height = ($(window).height() - 440);
    $('.reg_textarea').css('height',height);
  })
</script>