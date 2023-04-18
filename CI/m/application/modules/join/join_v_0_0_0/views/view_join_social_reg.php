<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>회원가입</h1>
</header>
<!-- header : e -->
<div class="body row">
  <div class="inner_wrap">
    <form class="">
      <p class="label">본인인증<span class="essential"> *</span></p>
      <div class="btn_full_weight btn_point_line">
        <a href="">인증받기</a>
      </div>
      <p class="label">닉네임<span class="essential"> *</span></p>
      <input type="text" placeholder="2~8자리의 닉네임을 입력해 주세요.">
      <div class="all_checkbox row mt40 mb30">
        <ul>
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
              <p>서비스 이용약관 <i class="essential">*</i></p>
            </label>
            <a class="arrow" href="javascript:void(0)" onclick="modal_open('terms')"></a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="checkOne_2" value="Y">
            <label for="checkOne_2">
              <span></span>
              <p>개인정보 이용방침 <i class="essential">*</i></p>
            </label>
            <a class="arrow" href="javascript:void(0)" onclick="modal_open('terms')"></a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="checkOne_2" value="Y">
            <label for="checkOne_2">
              <span></span>
              <p>이메일 알림 동의</p>
            </label>
            <a class="arrow" href="javascript:void(0)" onclick="modal_open('terms')"></a>
          </li>
        </ul>
      </div>
      <div class="btn_point btn_full_weight mb30">
        <a href="/<?=mapping('join')?>/join_complete_detail">회원가입</a>
      </div>
    </form>
  </div>
</div>

<!-- modal : s -->
<div class="modal modal_terms">
  <header>
    <a class="btn_close" href="javascript:void(0)" onclick="modal_close('terms')"><img src="/images/head_btn_close.png" alt="닫기"></a>
    <h1>개인정보 처리 방침</h1>
  </header>
  <!-- header : e -->
  <div class="body">
    <div id="edit">
      귀하는 서비스 내에서 적용되는 모든 정책을 준수해야 합니다. Google 서비스의 오용을 삼가시기 바랍니다. 예를 들어 서비스를 방해하거나 Google이 제공하는 인터페이스 및 안내사항 이외의 다른 방법을 사용하여 액세스를 시도하지 않아야 합니다. 귀하는 관련 수출 및 재수출 통제 법규 및 규정 등 오직 법률상 허용되는 범위에서만 Google 서비스를 이용할 수 있습니다. 귀하가 Google 약관이나 정책을 준수하지 않거나 Google이 부정행위 혐의를 조사하고 있는 경우, Google 서비스 제공이 일시 중지 또는 중단될 수 있습니다. Google 서비스를 사용한다고 해서 Google 서비스 또는 액세스하는 콘텐츠의 지적재산권을 소유하게 되는 것은 아닙니다.
  	</div>
  </div>
</div>
<!-- modal : e -->
<script>
$(function(){
  if($('.modal').css('display') === 'block'){
  	history.pushState(null, document.title, location.href);  // push
  	window.addEventListener('popstate', function(event) {    //  뒤로가기 이벤트 등록
  		$('.modal header a').click();
  	});
  }
})

</script>
