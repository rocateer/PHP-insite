<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back_w.png" alt="닫기"></a>
  <h1>
  내 스케줄
  </h1>
</header>

<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)">스케줄 수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more')">삭제</a>
    </li>
  </ul>
  <ul class="close">
    <li>
      <a href="javascript:modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->

<div class="body vh_wrap">
  <div class="no_data">
    <p>아직 내 스케줄이 없어요.</p>
  </div>
  <div class="vh_body inner_wrap">
    
    <ul class="my_schedule_ul">
      <li>
        <img src="/images/i_dot_2.png" alt="" class="btn_more" onclick="modal_open_slide('more')">
        <a href="/<?=mapping('main')?>/product_detail">
          <table class="tbl_fix tbl_2">
            <colgroup>
              <col width='58px'>
              <col width='*'>
            </colgroup>
            <tr>
              <th>
                <div class="img_box">
                  <img src="/p_images/s1.png" alt="">
                </div>
              </th>
              <td>
                <div class="title">골반 근육 강화 프로그램</div>
                <p>토 / 일 <span>2022.08.01 ~</span></p>
              </td>
            </tr>
          </table>
        </a>
      </li>
      <li>
        <img src="/images/i_dot_2.png" alt="" class="btn_more" onclick="modal_open_slide('more')">
        <a href="/<?=mapping('main')?>/product_detail">
          <table class="tbl_fix tbl_2">
            <colgroup>
              <col width='58px'>
              <col width='*'>
            </colgroup>
            <tr>
              <th>
                <div class="img_box">
                  <img src="/p_images/s1.png" alt="">
                </div>
              </th>
              <td>
                <div class="title">골반 근육 강화 프로그램</div>
                <p>토 / 일 <span>2022.08.01 ~ 2022.08.29</span></p>
              </td>
            </tr>
          </table>
        </a>
      </li>
    </ul>
    <div class="vh_footer btn_full_weight btn_point mt30 mb30">
      <a href="/<?=mapping('main')?>/category_list">새로운 스케줄 추가하기</a>
    </div>
</div>