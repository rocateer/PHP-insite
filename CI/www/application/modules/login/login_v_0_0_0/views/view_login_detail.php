<div class="body">
  <div class="login_wrap">
    <img src="/images/login_logo.png" class="logo" alt="<?=SERVICE_NAME?>">
    <div class="fs_16 txt_center mb40">얼스유와 함께 지구를 흥겹게! 얼-쑤!</div>
    <form action="">
      <input type="text" class="" placeholder="아이디">
      <input type="password" class="login_input_pw" placeholder="비밀번호">
      <div class="btn_full_weight btn_point mt30">
        <a href="/<?=mapping('main')?>">로그인</a>
      </div>
      <ul class="login_find_ul">
        <li>
          <a href="/<?=mapping('find_pw')?>">비밀번호 찾기</a>
        </li>
        <li>
          <a href="/<?=mapping('find_id')?>">아이디 찾기</a>
        </li>
        <li>
          <a href="/<?=mapping('join')?>">회원가입</a>
        </li>
      </ul>

    </form>
  </div>
</div>
