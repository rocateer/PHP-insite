<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)">
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
    <div class="mt10"><img class="w_16 middle" src="/images/naver_logo.png"> 네이버</div>
  </div>
  <ul class="mypage_ul mt30">
    <li>전기 <img src="/images/ic_result_success.png" alt="인증완료" class="w_16 middle ml10">
      <a href="/<?= mapping('certification') ?>" class="right_txt">직종 변경 신청하기 <img class="w_16 middle" src="/images/btn_more.png"></a>
    </li>
    <li>직종인증 
      <a href="/<?= mapping('certification') ?>" class="right_txt">직종 인증 신청하기 <img class="w_16 middle" src="/images/btn_more.png"></a>
    </li>
    <li>직종인증 
      <a href="#" class="right_txt">직종 승인 대기중 입니다</a>
    </li>
    <li>직종인증 
      <a href="javascript:void(0)" onclick="modal_open('reject')" class="right_txt">인증 신청이 반려 되었습니다 <img class="w_16 middle" src="/images/btn_more.png"></a>
    </li>
    <li>프로필 작성
      <a href="/<?= mapping('faq') ?>" class="right_txt">직종 인증 후 작성 가능해요</a>
    </li>
    <li>프로필 작성
    <a href="/<?= mapping('notice') ?>" class="right_txt">인증 신청이 반려 되었습니다</a>
    </li>
    <li>프로필 작성
      <a href="/<?= mapping('mypage') ?>/profile_reg" class="right_txt">작성하기 <img class="w_16 middle" src="/images/btn_more.png"></a>
    </li>
    <li>프로필 작성 <img src="/images/ic_result_success.png" alt="인증완료" class="w_16 middle ml10">
      <span class="right_switch_wrap">
        <a href="/<?= mapping('mypage') ?>/profile_reg">내 구직 프로필 확인하기</a>
        <label class="switch ml5 middle">
          <input type="checkbox" name="all_alarm_yn" id="all_alarm_yn" value="Y">
          <span class="check_slider"></span>
        </label>
      </span>
    </li>
  </ul>
  <p class="mypage_title"> 내 관리</p>
  <ul class="mypage_ul">
    <li>
      <a href="/<?= mapping('member_info') ?>">내 정보 수정</a>
    </li>
    <li>
      <a href="/<?= mapping('my_scrap') ?>">스크랩</a>
    </li>
    <li>
      <a href="/<?= mapping('my_community') ?>">내가 작성한 글</a>
    </li>
    <li>
      <a href="/<?= mapping('my_recruit') ?>">구인구직 관리</a>
    </li>
    <li>
      <a href="/<?= mapping('my_order') ?>">공구/교육 관리</a>
    </li>
    <li>
      직종 재인증 <img src="/images/ic_result_success.png" alt="인증완료" class="w_16 middle ml10">
      <a href="/<?= mapping('notice') ?>" class="right_txt">직종 재인증을 할 수 있습니다 <img class="w_16 middle" src="/images/btn_more.png"></a>
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
    <li>
      <a href="/<?= mapping('qa') ?>">1:1문의</a>
    </li>
  </ul>
  <p class="mypage_title">이용약관</p>
  <ul class="mypage_ul pdb30">
    <li>
      <a href="/<?= mapping('terms') ?>/terms_detail?type=1"> 서비스 이용약관 </a>
    </li>
    <li>
      <a href="/<?= mapping('terms') ?>/terms_detail?type=2"> 개인정보 취급 방침 </a>
    </li>
  </ul>
</div>
<!-- body : e -->

<!-- 반려사유 modal : s -->
<div class="modal modal_full modal_reject vh_wrap">
  <header>
    <a class="btn_left" href="#">
      <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('reject')" alt="뒤로가기">
    </a>
    <h1>반려사유</h1>
    <!-- <span class="head_txt"><a href="#">등록</a></span> -->
  </header>

  <div class="vh_body">

    <div class="work_body">
      <table>
        <colgroup>
          <col width="70px">
          <col width="*">
        </colgroup>
        <tr>
          <th>직종</th>
          <td>전기</td>
        </tr>
        <tr>
          <th>반려사유</th>
          <td>사진이 명확지 않아 정보를 알 수 없습니다. 글씨가 보이도록 사진을 다시 등록해 주세요.</td>
        </tr>
      </table>
      <img src="/media/commonfile/202304/19/5d347021c1913f481ce7cf8051f98185.jpg" class="img_block mt20">
      <img src="/media/commonfile/202304/19/5d347021c1913f481ce7cf8051f98185.jpg" class="img_block mt20">
      <img src="/media/commonfile/202304/19/5d347021c1913f481ce7cf8051f98185.jpg" class="img_block mt20">
    </div>
    
  </div>
  
  <div class="vh_footer mb30">
    <a href="/<?=mapping('certification')?>/certification_reg" class="btn_point_ghost btn_full_basic">재인증하기</a>
  </div>
</div>
<!-- 반려사유 modal : e -->