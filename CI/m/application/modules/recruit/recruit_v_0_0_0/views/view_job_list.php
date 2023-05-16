<ul class="tab_2">
  <li><a href="/<?=mapping('recruit')?>">구인</a></li>
  <li class="active"><a href="/<?=mapping('recruit')?>/job_list">구직</a></li>
</ul>

<div class="search_cnt mt20">필터 결과  <span class="point_color">12,345</span></div>
<ul class="community_list" id="list_ajax">
    <li>
      <a href="/<?=mapping('recruit')?>/job_detail">
        <div class="community_list_head">
          <p class="txt_nickname">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right list_date">15:11</span></p>
          
        </div>
        <div class="community_list_body">
          <div class="thum_img relative">
            <div class="img_box">
              <img src="/p_images/s3.jpg">
            </div>
            <div class="img_cnt_box">3</div>
          </div>
          <div class="community_list_item">
            <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
          </div>
        </div>
        <p class="mt15"><span class="point_color">일급</span> 30만원</p>
      </a>
    </li>
    <li class="community_noti">
      신고한 게시글입니다.
    </li>
    <li class="community_noti">
      차단한 게시글입니다.
      <a href="#">차단 해제</a>
    </li>
    <li>
      <a href="/<?=mapping('recruit')?>/job_detail">
        <div class="community_list_head">
          <p class="txt_nickname">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right list_date">15:11</span></p>
        </div>
        <div class="community_list_body">
          <div class="community_list_item">
            <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
          </div>
        </div>
        <p class="mt15"><span class="point_color">일급</span> 30만원</p>
      </a>
    </li>
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
$( '.search_cnt span' ).click( function() {
  $(this).toggleClass("on");
} );

//필터
$('.select_del').click(function(){
$(".select_result").css({display: "none"});
})
</script>