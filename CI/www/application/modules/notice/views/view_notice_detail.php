<div class="body">
  <div class="inner_wrap">
    <div class="board_wrap">

      <!-- left_menu : s -->
      <div class="board_left_menu">
        <h1><a href="/cscenter">고객센터</a></h1>
        <ul>
          <li><a class="active" href="/notice">공지사항</a></li>
          <li><a href="/faq">FAQ</a></li>
        </ul>
        <div>
          <p><img src="/images/icon_phone.png" alt=""></p>
          <p><strong>1677-5644</strong></p>
          <p>customer@rocateer.com</p>
          <span>
            AM 09:00 ~ PM 06:00<br>
            (점심시간 : PM 12:00 ~ 01:00)<br>
            토, 일, 공휴일 휴무
          </span>
          <span class="btn_b btn_basic"><a href="#">1:1 문의하기</a></span>
        </div>
      </div>
      <!-- left_menu : e -->

      <!-- menu_right_con : s -->
      <div class="board_right_con">
        <p class="path">HOME<span>&gt;</span>고객센터<span>&gt;</span>공지사항<span></p>

        <div class="top_title">
          <h1>공지사항</h1>
          <p>즐거운 쇼핑이 될 수 있도록 정성을 다하겠습니다.</p>
        </div>

        <table class="board_table detail_view mt30">
          <tbody>
            <tr>
              <th>
                <p><?=$result->title?></p>
                <span class="date"><?=$result->ins_date?></span>
              </th>
            </tr>
            <tr>
              <td>
                <?=nl2br($result->contents)?>
              </td>
            </tr>
          </tbody>
        </table>

        <div class="text_right">
          <span class="btn_form btn_basic"><a href="/notice">목록</a></span>
        </div>

      </div>
      <!-- menu_right_con : e -->
    </div>
  </div>
</div>
