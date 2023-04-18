<div class="body">
  <div class="find_wrap">
    <div class="title">비밀번호 찾기</div>
    <form action="">
      <div class="label">아이디 <span class="essential">*</span></div>
      <input type="text" class="" placeholder="아이디">
      <div class="label">이름 <span class="essential">*</span></div>
      <input type="text" placeholder="'-' 를 제외한 숫자만 입력해 주세요">
      <div class="label">전화번호 <span class="essential">*</span></div>
      <input type="tel" placeholder="'-' 를 제외한 숫자만 입력해 주세요">
      <div class="btn_full_weight btn_point mt30">
        <a href="/<?=mapping('main')?>">비밀번호 찾기</a>
      </div>
      <div class="find_result">
        <p>주르륵...<br>
          회원님의 정보를 찾지 못했습니다.<br><br>
          가입 시 입력하신 회원 정보가 맞는지<br>다시 한번 확인해 주세요.</p>
      </div>
      <div class="find_result">
        <p>회원님의 이메일(아이디)로<br><span class="point">비밀번호 변경메일</span>을 발송했습니다.</p>
      </div>
    </form>
  </div>
</div>
