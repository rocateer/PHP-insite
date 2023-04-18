<div class="body">
  <div class="find_wrap">
    <div class="title">아이디 찾기</div>
    <form action="">
      <div class="label">이름 <span class="essential">*</span></div>
      <input type="text" class="" placeholder="아이디">
      <div class="label">전화번호 <span class="essential">*</span></div>
      <input type="tel" placeholder="'-' 를 제외한 숫자만 입력해 주세요">
      <div class="btn_full_weight btn_point mt30">
        <a href="/<?=mapping('main')?>">아이디 찾기</a>
      </div>
      <div class="find_result">
        <p>주르륵...<br>
          회원님의 정보를 찾지 못했습니다.<br><br>
          가입 시 입력하신 회원 정보가 맞는지<br>다시 한번 확인해 주세요.</p>
      </div>
      <div class="find_result">
        <p>얼-쑤!<br>회원님의 아이디를 찾았습니다.</p>
        <p class="point">example@email.com</p>
      </div>
    </form>
  </div>
</div>
