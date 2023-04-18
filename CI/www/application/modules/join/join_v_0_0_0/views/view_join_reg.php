<div class="body">
  <div class="join_wrap">
    <div class="title">회원가입</div>
    <form action="">
      <div class="flex_join">
        <div class="left">
          <ul class="all_checkbox">
            <li>
              <input type="checkbox" name="checkAll" id="checkAll">
              <label for="checkAll">
                <span></span>
                전체 약관 동의
              </label>
            </li>
            <li>
              <input type="checkbox" name="checkOne" id="checkOne_1" value="Y">
              <label for="checkOne_1">
                <span></span>
                <p>서비스 이용약관 <b class="essential">*</b></p>
              </label>
              <span><a href="javascript:void(0)" onclick="modal_open('terms')">약관 보기</a></span>
            </li>
            <li>
              <input type="checkbox" name="checkOne" id="checkOne_2" value="Y">
              <label for="checkOne_2">
                <span></span>
                <p>개인정보 이용방침 <b class="essential">*</b></p>
              </label>
              <span><a href="javascript:void(0)" onclick="modal_open('terms')">약관 보기</a></span>
            </li>
            <li>
              <input type="checkbox" name="checkOne" id="checkOne_3" value="Y">
              <label for="checkOne_3">
                <span></span>
                <p>전자금융거래 이용약관 * <b class="essential">*</b></p>
              </label>
              <span><a href="javascript:void(0)" onclick="modal_open('terms')">약관 보기</a></span>
            </li>
          </ul>
        </div>
        <div class="right">
          <div class="label" style="margin-top:0">아이디 <span class="essential">*</span></div>
          <input type="text" placeholder="아이디로 사용하실 이메일 주소를 입력해 주세요.">
          <div class="label">비밀번호 <span class="essential">*</span></div>
          <input type="password" placeholder="영문, 숫자, 특수문자 조합 8~15자리 이내로 입력해 주세요.">
          <div class="label">비밀번호 확인 <span class="essential">*</span></div>
          <input type="password" placeholder="영문, 숫자, 특수문자 조합 8~15자리 이내로 입력해 주세요.">
          <div class="label">전화번호 <span class="essential">*</span></div>
          <div class="btn_full_weight btn_point_line">
            <a href="">본인인증</a>
          </div>
          <div class="btn_full_weight mt40 btn_point">
            <a href="/<?=mapping('join')?>/join_complete_detail">회원 가입</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
#edit span{color:inherit;font-size: inherit}
#edit a{color:inherit;font-size: inherit}
#edit h1{color:inherit;font-family: inherit; font-weight: inherit;}
#edit h2, #edit h3, #edit h4, #edit h5, #edit h6{color:inherit;font-family: inherit; font-weight: inherit;}
#edit body, #edit div, #edit dl, #edit dt, #edit dd, #edit ul, #edit ol, #edit li, #edit h1, #edit h2, #edit h3, #edit h4, #edit h5, #edit h6, #edit pre, #edit code,
#edit form, #edit fieldset, #edit legend, #edit textarea, #edit p, #edit blockquote, #edit th, #edit td, #edit input, #edit select, #edit textarea, #edit button{padding:revert;}
#edit dl, #edit ul, #edit ol, #edit menu, #edit li{list-style: revert;}
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td{border:1px solid #ddd; vertical-align: middle;}
#edit .table > thead > tr > th, #edit .table > tbody > tr > th,
#edit .table > tfoot > tr > th, #edit .table > thead > tr > td, #edit .table > tbody > tr > td, #edit .table > tfoot > tr > td{padding: 8px 12px;line-height: 1.5;}
#edit iframe, #edit img{max-width: 100%}
</style>
<!-- modal : s -->
<div class="modal modal_terms">
  <a class="btn_del" href="javascript:void(0)" onclick="modal_close('terms')"><img class="w_100" src="/images/i_popup_close.png" alt="닫기"></a>
  <h1 id="modal_title">
    서비스 이용약관
  </h1>

  <div class="mt50"  id="edit">
    귀하는 서비스 내에서 적용되는 모든 정책을 준수해야 합니다. Google 서비스의 오용을 삼가시기 바랍니다. 예를 들어 서비스를 방해하거나 Google이 제공하는 인터페이스 및 안내사항 이외의 다른 방법을 사용하여 액세스를 시도하지 않아야 합니다. 귀하는 관련 수출 및 재수출 통제 법규 및 규정 등 오직 법률상 허용되는 범위에서만 Google 서비스를 이용할 수 있습니다. 귀하가 Google 약관이나 정책을 준수하지 않거나 Google이 부정행위 혐의를 조사하고 있는 경우, Google 서비스 제공이 일시 중지 또는 중단될 수 있습니다. Google 서비스를 사용한다고 해서 Google 서비스 또는 액세스하는 콘텐츠의 지적재산권을 소유하게 되는 것은 아닙니다.
	</div>
</div>
<div class="md_overlay md_overlay_terms" onclick="modal_close('terms')"></div>
