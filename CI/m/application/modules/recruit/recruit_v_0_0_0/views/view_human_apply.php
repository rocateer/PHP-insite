<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_close.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <span class="head_txt"><a href="#">지원</a></span>
</header>
<div class="body">
  <div class="inner_wrap mt30">
    <h5>구직지원</h5>
    <ul class="input_ui row mt20">
      <li>
        <label>이름<span class="essential">*</span></label>
        <input type="text" id="" name="" value="김구직">
      </li>
      <li>
        <label>연락처</label>
        <input type="tel" id="" name="" placeholder="연락받으실 전화번호를 입력해 주세요.">
      </li>
      <li>
        <label>성별</label>
        <select>
          <option>선택안함</option>
          <option>남성</option>
          <option>여성</option>
        </select>
      </li>
      <li>
        <label>생년월일</label>
        <input type="text" id="" name="" placeholder="생년월일을 6자리로 입력해 주세요 ex) 000101">
      </li>
    </ul>
  </div>

  <hr class="space">

  <div class="inner_wrap mt30">
    <h5>지원내용</h5>
    <table class="mt30 table_info" >
      <colgroup>
        <col width='80px'>
        <col width='*'>
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
          <option>1년 이상 ~ 3년 미만</option>
          <option>3년 이상 ~ 5년 미만</option>
          <option>5년 이상 ~ 10년 미만</option>
          <option>10년 이상</option>
        </select>
      </li>
      <li>
        <label>희망 급여</label>
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
        <label>포트폴리오<span class="essential">*</span></label>
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

<!-- 지역선택 모달 : s -->
<div class="modal modal_full modal_region" id="region_ajax" style="display:none;">
  <header>
    <a class="btn_left" href="#">
      <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('region')" alt="뒤로가기">
    </a>
    <h1>근무 지역 선택</h1>
  </header>
  <div class="modal_body">
    <ul class="area_title">
      <li>지역구분</li>
      <li>시 · 군 · 구</li>
    </ul>
    <div class="region_ui">
      <ul class="area_item_1">
          <li>서울 동부</li>
      </ul>
      <ul class="area_item_2" name="region_idx" id="region_idx">
      </ul>
    </div>
  </div>
  <a href="javascript:void(0)" class="btn_point btn_floating" onclick="region_reg();">선택</a>
</div>
<!-- 지역선택 모달 : e -->

<!-- 성별차별금지 안내 모달 : s -->
<div class="modal modal_full modal_info_1" id="region_ajax" style="display:none;">
  <header>
    <img class="w_100 btn_left" src="/images/head_btn_close.png" onclick="modal_close('info_1')" alt="뒤로가기">

    <h1>성별차별금지 안내</h1>
  </header>
  <div class="modal_body">
    <div class="inner_wrap" id="edit">
      <p>성별차별금지 주요내용</p>
      <div>여기는 에디터가 들어가는 공간 입니다. </div>
    </div>
  </div>
  <a href="javascript:void(0)" class="btn_point btn_floating" onclick="region_reg();">선택</a>
</div>
<!-- 성별차별금지 안내 모달 : e -->

<!-- 연령차별금지 안내 모달 : s -->
<div class="modal modal_full modal_info_2" id="region_ajax" style="display:none;">
  <header>
    <img class="w_100 btn_left" src="/images/head_btn_close.png" onclick="modal_close('info_2')" alt="뒤로가기">
    <h1>연령차별금지 안내</h1>
  </header>
  <div class="modal_body">
    <div class="inner_wrap" id="edit">
      <p>연령차별금지 주요내용</p>
      <div>여기는 에디터가 들어가는 공간 입니다. </div>
    </div>
  </div>
  <a href="javascript:void(0)" class="btn_point btn_floating" onclick="region_reg();">선택</a>
</div>
<!-- 연령차별금지 안내 모달 : e -->

<script>


</script>