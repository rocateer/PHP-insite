<div class="login_wrap">
  <header class="transparent">
    <a href="javascript:history.go(-1)" class="btn_back">
      <img src="/images/head_btn_close.png" alt="x">
    </a>
  </header>
  <img src="/images/logo_login.png" class="logo" alt="<?=SERVICE_NAME?>">
  <form action="">
    <input type="text" class="login_input_id" placeholder="아이디">
    <input type="password" class="login_input_pw" placeholder="비밀번호">
    <div class="btn_full_weight btn_point mt30">
      <a href="/<?=mapping('main')?>">로그인</a>
    </div>
    <ul class="login_find_ul">
      <li>
        <a href="/<?=mapping('find_id')?>">아이디 찾기 · </a>
      </li>
      <li>
        <a href="/<?=mapping('find_pw')?>">비밀번호 찾기</a>
      </li>
      <li>
        <a href="/<?=mapping('join')?>">회원가입</a>
      </li>
    </ul>
    <div class="or">또는</div>
    <ul class="sns_ul">
      <li>
      <a href="/<?=mapping('join')?>/join_social_reg">
        <img src="/images/login_1.png" alt="">
      </a>
      </li>
      <li>
      <a href="/<?=mapping('join')?>/join_social_reg">
        <img src="/images/login_2.png" alt="">
      </a>
      </li>
      <li>
      <a href="/<?=mapping('join')?>/join_social_reg">
        <img src="/images/login_3.png" alt="">
      </a>
      </li>
      <li>
      <a href="/<?=mapping('join')?>/join_social_reg">
        <img src="/images/login_4.png" alt="">
      </a>
      </li>
    </ul>
  </form>
</div>
