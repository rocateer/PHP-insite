<!-- header : s -->
<header>
  <a class="btn_left" href="">
    <img src="/images/head_btn_back.png" alt="">
  </a>
  <h1>마이페이지</h1>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body">
  <!-- <div class="mypage_head">
    <a href="/<?= mapping('login') ?>">로그인</a> 후 <br>
    더 많은 서비스를 이용하세요.
  </div> -->
  <div class="mypage_head">
    반갑습니다,<br>
    <span class="mypage_nickname">딸기바나나킥맛나</span>님 <br>
    <!-- <div>id@email.com</div> -->
    <div><img class="w_16 middle" src="/images/naver_logo.png"> 네이버</div>
  </div>
  <ul class="mypage_profile">
    <li>직종인증  <img src="/images/ic_result_success.png" alt="인증완료" class="w_16 middle ml10">
      <!-- <a href="/<?= mapping('notice') ?>" class="f_right">직종 인증 신청하기    <img class="w_16 middle" src="/images/btn_more.png">
      </a> -->
      <!-- <a href="#" class="f_right">직종 승인 대기중 입니다</a> -->
      <a href="/<?= mapping('work') ?>/work_reject" class="f_right">인증 신청이 반려 되었습니다 <img class="w_16 middle" src="/images/btn_more.png"></a>
    </li>
    <li>프로필 작성
      <a href="/<?= mapping('faq') ?>" class="f_right">직종 인증 후 작성 가능해요</a>
    </li>
  </ul>
  <p class="mypage_title"> 내 관리</p>
  <ul class="mypage_ul">
    <li>
      <a href="/<?= mapping('notice') ?>">내 정보 수정</a>
    </li>
    <li>
      <a href="/<?= mapping('faq') ?>">스크랩</a>
    </li>
    <li>
      <a href="/<?= mapping('faq') ?>">내가 작성한 글</a>
    </li>
    <li>
      <a href="/<?= mapping('faq') ?>">구인구직 관리</a>
    </li>
    <li>
      <a href="/<?= mapping('faq') ?>">공구/교육 관리</a>
    </li>
  </ul>
  <p class="mypage_title"> 고객 센터</p>
  <ul class="mypage_ul">
    <li>
      <a href="/<?= mapping('notice') ?>">공지사항</a>
    </li>
    <li>
      <a href="/<?= mapping('faq') ?>">FAQ</a>
    </li>
  </ul>
  <p class="mypage_title">이용약관</p>
  <ul class="mypage_ul">
    <li>
      <a href="/<?= mapping('terms') ?>/terms_detail?type=1"> 서비스 이용약관 </a>
    </li>
    <li>
      <a href="/<?= mapping('terms') ?>/terms_detail?type=2"> 개인정보 취급 방침 </a>
    </li>
  </ul>
</div>
<!-- body : e -->