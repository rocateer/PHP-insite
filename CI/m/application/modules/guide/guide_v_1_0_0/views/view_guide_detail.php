<style>
  .guide_wrap{max-width:375px; padding: 20px 20px 70px 20px; box-sizing: border-box; margin: 0 auto;}
  .btn_space{overflow: hidden;}
  .btn_space a{margin: 10px 0;}       
  .btn_space a.btn_floating{margin: 0px 0;}
</style>
<!-- header : s -->
<header>
	<a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>가이드</h1>
</header>
<!-- header : e -->

<!-- wrap : s -->
<div class="guide_wrap">
    
    <label>폼</label><br><br>
    <!-- form -->
    <ul class="input_ui row">
      <li>
        <label>이름<span class="essential">*</span></label>
        <input type="text">
      </li>
      <li>
        <label>선택<span class="essential">*</span></label>
        <select>
          <option>선택하세요.</option>
        </select>
      </li>
      <li>
        <label>이메일<span class="essential">*</span></label>
        <div class="flex_1">
          <input type="text" id="member_nickname" name="member_nickname" placeholder="닉네임을 입력해 주세요.">
          <span>@</span>
          <select>
            <option>선택하세요.</option>
            <option>gmail.com</option>
          </select>
        </div>
      </li>
      <li>
        <label>캘린더<span class="essential">*</span></label>
        <input type="text" class="input_calendar">
      </li>
      <li>
        <label>체크박스<span class="essential">*</span></label>
        <ul class="ul_2_ui">
          <li>
            <input type="checkbox" name="check" id="check_1">
            <label for="check_1">
              <span></span>택배
            </label>
          </li>
          <li>
            <input type="checkbox" name="check" id="check_2">
            <label for="check_2">
              <span></span>직거래
            </label>
          </li>
        </ul>
      </li>
      <li>
        <label>라디오 버튼<span class="essential">*</span></label>
        <ul class="ul_3_ui">
          <li>
            <input type="radio" id="radio_1" name="radio" checked="">
            <label for="radio_1" class="mr15">
              <span></span>서울
            </label>
          </li>
          <li>
            <input type="radio" id="radio_2" name="radio">
            <label for="radio_2" class="mr15">
              <span></span>부천
            </label>
          </li>
          <li>
            <input type="radio" id="radio_3" name="radio">
            <label for="radio_3" class="mr15">
              <span></span>인천
            </label>
          </li>
        </ul>
      </li>
      <li>
        <label>사진<span class="essential">*</span></label>
        <div class="x_scroll_img_reg">
          <ul class="img_reg_ul">
            <li>
              <p class="cnt_num"><span>1</span>/3</p>
              <div class="img_box">
                <img src="images/btn_photo.png" alt="">
              </div>
            </li>
            <li>
              <img src="images/btn_sm_delete.png" alt="x" class="btn_delete">
              <div class="img_box">
                <img src="p_images/s1.jpg" alt="">
              </div>
            </li>
          </ul>
        </div>
      </li>
    </ul>

    <!-- button -->

    <div class="btn_space">
      <label>버튼</label>
      <a href="#" class="btn_point btn_floating">다음</a>
      <a href="#" class="btn_point btn_full_basic">선택</a>
      <a href="#" class="btn_disabled btn_full_basic">마감된 공고</a>
      <a href="#" class="btn_point_ghost btn_full_basic">재인증하기</a>
    </div>
    

  </div>
