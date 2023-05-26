<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>내 정보 수정</h1>
  <!-- <span class="head_txt"><a href="#">등록</a></span> -->
</header>
<div class="vh_wrap relative">
  <div class="inner_wrap vh_body">
    <div class="box_line mt30">
      <table class="table_info">
        <tr>
          <th style="width:65px;">이름</th>
          <td>김공구</td>
        </tr>
        <tr>
          <th>아이디</th>
          <td><img class="w_16 middle" src="/images/naver_logo.png"> rocateer@gmail.com</td>
        </tr>
        <tr>
          <th>전화번호</th>
          <td>010 1237 5698 <a href="#" class="f_right point_color">변경</a></td>
        </tr>
      </table>
    </div>

    <ul class="input_ui row mt30">
      <li>
        <label>닉네임<span class="essential">*</span></label>
        <input type="text">
      </li>
      <li>
          <label class="region">지역선택<span class="essential">*</span></label>
          <a href="#" onclick="modal_open('region')" class="btn essential">선택하기</a>
          <input type="text" class="input_dark mt5" id="region_full_name" name="region_full_name" placeholder="주로 활동하는 지역을 선택해주세요">
        </li>
    </ul>

    <div class="vh_footer">

      <p>마케팅 활용동의 및 광고 수신 동의</p>
      <div class="mt10">
        <input type="checkbox" name="checkOne" id="marketing_agree_yn" value="Y" >
        <label for="marketing_agree_yn"><span></span>이메일 수신에 동의합니다.</label>
      </div>

      <div class="mt30 mb30">
        <a href="#" class="btn_point btn_full_basic">수정하기</a>
      </div>

    </div>

    

    
    
  </div>
    
</div>