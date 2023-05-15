<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <span class="head_txt"><a href="#">등록</a></span>
</header>
<div class="body">
  <div class="inner_wrap mt30">
    <h5>구인공고</h5>
    <ul class="input_ui row mt20">
      <li>
        <label>회사 또는 팀 이름<span class="essential">*</span></label>
        <input type="text" id="" name="" placeholder="회사명 또는 팀명을 입력해 주세요.">
      </li>
      <li>
        <label>담당자 연락처</label>
        <input type="tel" id="" name="" placeholder="">
      </li>
    </ul>
  </div>

  <hr class="space">

  <div class="inner_wrap mt30">
    <h5>모집내용</h5>
    <ul class="input_ui row mt20">
      <li>
        <label>마감일<span class="essential">*</span></label>
        <select>
          <option>마감일 선택</option>
          <option>채용 시까지</option>
          <option>마감일 선택</option>
        </select>
        <input type="text" name="s_date_1" id="s_date_1" class="input_calendar" autocomplete="off" readonly>
      </li>
      <li>
        <label class="region">지역 선택<span class="essential">*</span></label>
        <a href="javascript:void(0)" onclick="modal_open('region')" class="btn essential">선택하기</a>
        <input type="text" class="input_dark mt5" id="region_full_name" name="region_full_name" placeholder="주로 활동하는 지역을 선택해주세요">
      </li>
      <li>
        <label>근무구분<span class="essential">*</span></label>
        <select>
          <option>철거</option>
          <option>설비</option>
          <option>전기 </option>
          <option>..</option>
        </select>
      </li>
      <li>
        <label>경력</label>
        <select>
          <option>선택 안함</option>
          <option>경력무관</option>
          <option>경력 </option>
        </select>
        <select>
          <option>1년 미만</option>
          <option>1년 이상 ~ 3년 미만</option>
          <option>3년 이상 ~ 5년 미만</option>
        </select>
      </li>
      <li>
        <label class="label_left">성별</label>
        <a href="javascript:void(0)" onclick="modal_open('info_1')"><img src="/images/ic_info.png" class="w_16 f_right"></a>
        <select>
          <option>선택 안함</option>
          <option>성별무관</option>
          <option>남성 </option>
          <option>여성</option>
        </select>
      </li>
      <li>
        <label class="label_left">연령</label>
        <a href="javascript:void(0)" onclick="modal_open('info_2')"><img src="/images/ic_info.png" class="w_16 f_right"></a>
        <select>
          <option>선택 안함</option>
          <option>연령무관</option>
          <option>연령제한 </option>
        </select>
        <div class="flex_between">
          <div class="w_half relative">
            <span class="input_right_txt">이상</span>
            <input type="text" name="" id="">
          </div>
          <div class="w_half relative">
            <span class="input_right_txt">이하</span>
            <input type="text" name="" id="">
          </div>
        </div>
      </li>
      <li>
        <label>급여 <span class="essential">*</span></label>
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
        <label>공고 제목<span class="essential">*</span></label>
        <input type="text" id="" name="" placeholder="회사명 또는 팀명을 입력해 주세요.">
      </li>
      <li>
        <label>세부사항</label>
        <textarea id="" cols="" class="reg_textarea"></textarea>
      </li>
      <li>
        <label>사진<span class="essential">*</span></label>
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