<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <span class="head_txt"><a href="#">등록</a></span>
</header>
<div class="body">
    <div class="inner_wrap mt30">
        <h5>구직프로필</h5>
        <ul class="input_ui row mt20">
            <li>
                <label>연락처<span class="essential">*</span></label>
                <input type="tel" id="" name="" placeholder="연락받으실 전화번호를 입력해 주세요.">
            </li>
            <li>
                <label>성별</label>
                <select>
                    <option>선택안함</option>
                    <option>남</option>
                    <option>여</option>
                </select>
            </li>
            <li>
                <label>생년월일</label>
                <input type="number" id="" name="" placeholder="생년월일을 6자리로 입력해 주세요 ex) 000101">
            </li>
        </ul>
  </div>
  <hr class="space">
  <div class="inner_wrap mt30">
        <h5>지원 내용</h5>
        <table class="table_info mt20">
            <colgroup>
                <col width="80">
                <col width="*">
            </colgroup>
            <tr>
                <th>직종</th>
                <td>장판</td>
            </tr>
            <tr>
                <th>지역</th>
                <td>서울 동부</td>
            </tr>
        </table>
        <ul class="input_ui row mt20">
            <li>
                <label>경력</label>
                <select>
                    <option>1년 미만</option>
                </select>
            </li>
            <li>
                <label>희망 급여<span class="essential">*</span></label>
                <div class="flex_between">
                    <div class="w_half">
                    <select>
                        <option>일급</option>
                        <option>연봉</option>
                        <option>협의가능</option>
                    </select>
                    </div>
                    <div class="w_half relative">
                        <span class="input_right_txt">만원</span>
                        <input type="text" name="" id="">
                    </div>
                </div>
            </li>
        </ul>
  </div>
  <hr class="space">
  <div class="inner_wrap mt30">
    <ul class="input_ui row">
      <li>
        <label>제목<span class="essential">*</span></label>
        <input type="text" id="" name="" placeholder="">
      </li>
      <li>
        <label>상세내용</label>
        <textarea id="" cols="" class="reg_textarea"></textarea>
      </li>
      <li>
        <label>포트폴리오</label>
      </li>
    </ul>
  </div>
  <div class="reg_view">
    <div class="x_scroll_img_reg" style="margin-top:-20px;">
      <ul class="img_reg_ul pdl20" id="">
        <li>
          <div class="cnt_num"><span class="point_color">0</span>/10</div>
          <div class="img_box">
            <img src="/images/btn_photo.png" alt="">
          </div>
        </li>
        <?php for ($i=0; $i < 6; $i++) {?>
        <li>
          <img src="/images/btn_sm_delete.png" alt="x" class="btn_delete">
          <div class="img_box">
            <img src="/p_images/s7.jpg" alt="">
          </div>
        </li>
        <?php }?>
      </ul>
    </div>
   
  </div>

</div>