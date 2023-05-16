<ul class="tab_2">
  <li class="active"><a href="/<?=mapping('recruit')?>">구인</a></li>
  <li><a href="/<?=mapping('recruit')?>/job_list">구직</a></li>
</ul>
<div class="search_cnt mt20">필터 결과  <span class="point_color">12,345</span></div>
<ul class="recruit_list">
  <li>
    <a href="/<?=mapping('recruit')?>/human_detail">
      <div class="item_1">
        <b>플랫폼로캣티어</b>
        <span class="f_right date">2023.01.01</span>
      </div>
      <div class="mt10 mb10">
        <span class="recruit_mark">목공</span>
        <span class="txt_title">가디호텔 철거공사를 하는데 경력자 사람을 구하고 있습니다.</span>
      </div>
      <div class="item_2"><img src="/images/ic_time.png" class="info_ic">~2023.05.01 <span class="point_color">(D-13)</span></div>
      <div class="item_2"><img src="/images/ic_pin.png" class="info_ic">서울 동부<img src="/images/ic_sm_arrow.png" class="w_16 middle">강동구 <p class="f_right fs_14 font_gray_f"><span class="point_color">일급</span> 30만원</p></div>
    </a>
  </li>
  <li class="recruit_noti">
      신고한 게시글입니다.
  </li>
  <li class="recruit_noti">
      차단한 게시글입니다.
      <a href="#">차단 해제</a>
    </li>
  <?php for ($i=0; $i < 6; $i++) {?>
  <li>
    <div class="item_1">
      <b>플랫폼로캣티어</b>
      <span class="f_right date">2023.01.01</span>
    </div>
    <div class="mt10 mb10">
      <span class="recruit_mark">목공</span>
      <span class="txt_title">주안자이 아파트 신규 건설 신입 채용</span>
    </div>
    <div class="item_2"><img src="/images/ic_time.png" class="info_ic">~2023.05.01 <span class="point_color">(D-13)</span></div>
    <div class="item_2"><img src="/images/ic_pin.png" class="info_ic">인천<img src="/images/ic_sm_arrow.png" class="w_16 middle">미추홀구<p class="f_right fs_14 font_gray_f"><span class="point_color">일급</span> 18만원</p></div>
  </li>
  <?php }?>
</ul>

<a href="javascript:void(0)" onclick="modal_open('filter')"><img src="/images/floating_filter.png" class="top_floating top"></a>


<!-- modal : s -->
<div class="modal modal_full modal_filter vh_wrap">
  <header>
    <a class="btn_left" href="#">
      <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('filter')" alt="뒤로가기">
    </a>
    <h1>&nbsp;</h1>
    <span class="head_txt"><a href="#">초기화</a></span>
  </header>
  <div class="vh_body">
    <div class="inner_wrap">
      <div class="mt20">
        <input type="checkbox" name="vote_check" id="vote_check" value="Y">
        <label for="vote_check"><span></span>마감 공고 제외</label>
      </div>
      <ul class="input_ui row mt30">
        <li>
          <label>근무구분</label>
          <ul class="gride_4 checkbox_box row">
            <li>
              <input type="checkbox" id="checkAll" name="checkAll">
              <label for="checkAll">전체</label>
            </li>
            <li>
              <input type="checkbox" id="kind_0" name="kind">
              <label for="kind_0">철거</label>
            </li>
            <li>
              <input type="checkbox" id="kind_1" name="kind">
              <label for="kind_1">설비</label>
            </li>
            <li>
              <input type="checkbox" id="kind_2" name="kind">
              <label for="kind_2">전기</label>
            </li>
            <li>
              <input type="checkbox" id="kind_3" name="kind">
              <label for="kind_3">목공</label>
            </li>
            <li>
              <input type="checkbox" id="kind_4" name="kind">
              <label for="kind_4">타일</label>
            </li>
            <li>
              <input type="checkbox" id="kind_5" name="kind">
              <label for="kind_5">필름</label>
            </li>
            <li>
              <input type="checkbox" id="kind_6" name="kind">
              <label for="kind_6">도장</label>
            </li>
            <li>
              <input type="checkbox" id="kind_7" name="kind">
              <label for="kind_7">도배</label>
            </li>
            <li>
              <input type="checkbox" id="kind_8" name="kind">
              <label for="kind_8">마루</label>
            </li>
            <li>
              <input type="checkbox" id="kind_9" name="kind">
              <label for="kind_9">장판</label>
            </li>
            <li>
              <input type="checkbox" id="kind_10" name="kind">
              <label for="kind_10">가구</label>
            </li>
            <li>
              <input type="checkbox" id="kind_11" name="kind">
              <label for="kind_11">도기</label>
            </li>
            <li>
              <input type="checkbox" id="kind_12" name="kind">
              <label for="kind_12">샷시</label>
            </li>
            <li>
              <input type="checkbox" id="kind_13" name="kind">
              <label for="kind_13">유리</label>
            </li>
            <li>
              <input type="checkbox" id="kind_14" name="kind">
              <label for="kind_14">금속</label>
            </li>
          </ul>
        </li>
        <li>
          <label>근무지역</label>
          <div class="flex_between">
            <div class="w_half">
              <select>
                <option>서울 동부</option>
              </select>
            </div>
            <div class="w_half">
              <select>
                <option>시/구/군</option>
              </select>
            </div>
          </div>
          <div class="select_result_wrap mt15">
            <span class="select_result">서울 동부 > 강동구 <img src="/images/ic_xs_delete.png" class="select_del"></span>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="vh_footer mb30">
    <a href="#" class="btn_point btn_full_basic">필터 적용</a>
  </div>
</div>
<!-- modal : e -->

<script>
$('.select_del').click(function(){
$(".select_result").css({display: "none"});
})
</script>