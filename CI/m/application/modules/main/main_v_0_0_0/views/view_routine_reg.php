<style>
  .ui-state-highlight, .ui-widget-content .ui-state-highlight, .ui-widget-header .ui-state-highlight{border-radius: 50%;}
</style>
<header>
  <div class="btn_back" onclick="javascript:history.go(-1)">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
    스케쥴 추가
  </h1>
</header>
<div class="vh_wrap body relative inner_wrap">
  <div class="vh_body">
    <img src="/images/step_3.png" alt="" class="step">
    <h4 class="mb20 mt50 txt_center">일정을 선택하면 운동 루틴이 등록됩니다.</h4>
    <div class="label">운동하실 요일을 선택해 주세요.</div>
    <ul class="flex_week">
      <li>
        <input type="checkbox" id="chk_3_1" name="chk_3">
        <label for="chk_3_1">월</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_2" name="chk_3">
        <label for="chk_3_2">화</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_3" name="chk_3">
        <label for="chk_3_3">수</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_4" name="chk_3">
        <label for="chk_3_4">목</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_5" name="chk_3">
        <label for="chk_3_5">금</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_6" name="chk_3">
        <label for="chk_3_6">토</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_7" name="chk_3">
        <label for="chk_3_7">일</label>
      </li>
    </ul>
    <div class="label">운동 기간을 지정해 주세요.</div>
    <div class="flex_datepicker">
      <input type="text" value="2020-06-01" class="datepicker" id="s_date_1">
      <span>~</span>
      <input type="text" value="2020-06-02" class="datepicker" id="e_date_1">

    </div>
    <input type="checkbox" id="chk_2_1" name="chk_2">
    <label for="chk_2_1"><span></span>종료일 지정 안함</label>
  </div>
  <div class="vh_footer btn_full_weight btn_point mt30 mb30">
    <a href="/<?= mapping('main') ?>">추가하기</a>
  </div>
</div>