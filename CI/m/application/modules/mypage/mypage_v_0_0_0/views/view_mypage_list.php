<!-- header : s -->
<header>
  <a class="btn_back" href="">
    <img src="/images/head_btn_share.png" alt="">
  </a>
  <h1>마이페이지</h1>
  <a class="btn_setting" href="/<?=mapping('setting')?>">
    <img src="/images/head_btn_setting.png" alt="">
  </a>
  <a class="btn_close" href="/<?=mapping('alarm')?>">
    <img src="/images/head_btn_alarm_on.png" alt="">
  </a>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body inner_wrap footer_margin">
  <div class="txt_center">
    <div class="mypage_profile_wrap img_box">
      <img src="/p_images/s1.png" alt="">
      <img src="/images/btn_camera.png" class="btn_reg">
    </div>
    <h2>더프리다</h2>
    <div class="date">id@email.com</div>
  </div>
  <ul class="mypage_ul">
    <li>
      <a href="/<?= mapping('my_community') ?>">
      <img src="/images/i_my_1.png" alt="">
        내 커뮤니티
      </a>
    </li>
    <li>
      <a href="/<?= mapping('my_scrap') ?>">
      <img src="/images/i_my_2.png" alt="">
        스크랩
      </a>
    </li>
    <li>
      <a href="/<?= mapping('like') ?>">
      <img src="/images/i_my_3.png" alt="">
        좋아요
      </a>
    </li>
  </ul>
  <p class="mypage_title">내 정보 관리</p>
  <ul class="mypage_ul2">
    <li>
      <a href="/<?= mapping('member_info') ?>">
        내 정보 수정
      </a>
    </li>
    <li>
      <a href="/<?= mapping('member_pw_change') ?>">
        비밀번호 변경
      </a>
    </li>
    <li>
      <a href="/<?= mapping('alarm') ?>/alarm_setting">
        알림 설정
      </a>
    </li>
  </ul>
</div>
<!-- body : e -->