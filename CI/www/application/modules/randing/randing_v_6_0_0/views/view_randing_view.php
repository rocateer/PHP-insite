<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<?php
   header("Progma:no-cache");
   header("Cache-Control:no-cache,must-revalidate");
?>
<!DOCTYPE html>
<html lang="ko">

<head>

  <meta charset="utf-8">

  <title>Plan A</title>

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">



  <!-- Meta -->
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="">


  <!-- Open graph -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="Plan A">
  <meta property="og:site_name" content="Plan A">
  <meta property="og:locale" content="ko">
  <meta property="og:description" content="">


  <!-- 네이버 신디케이터 & 다음 -->
  <!-- 서버 및 도메인 연결시 작업 -->


  <link href="<?=$version_path?>/css/bootstrap.min.css" rel="stylesheet">
   <link href="<?=$version_path?>/css/swiper.min.css" rel="stylesheet">
  <link href="<?=$version_path?>/css/fancySelect.css" rel="stylesheet">
  <link href="<?=$version_path?>/css/style.css" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <!--[if lt IE 8]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
  <![endif]-->
  <!--[if lt IE 7]>
    <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js"></script>

  <![endif]-->
</head>

<body id="page-top">
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="/randing_v_6_0_0"><div class="main_logo"></div>Plan A</a>
      <div class="row right">
        <select class="select_box" id="language_select">
          <option>한국어</option>
          <option>English</option>
          <option>日本語</option>
          <option>汉语</option>
        </select>
      </div>
    </div>
  </nav>


  <section class="keyvisual dark_bg scroll_tg of-hidden">
    <!-- Swiper -->
  <div class="swiper-container kv-bg">
      <div class="swiper-wrapper">
        <div class="swiper-slide"></div>
        <div class="swiper-slide"></div>
        <div class="swiper-slide"></div>
        <div class="swiper-slide"></div>
        <div class="swiper-slide"></div>
      </div>
    </div>
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-md-12 my-auto">
          <div class="header-content">
            <div class="text_wrap">
              <h1>나만의<br>
                  여행일정<br>
                  레시피,</h1>
              <p class="en">Plan A</p>
            </div>
            <div class="badges">
              <a class="badge-link" href="#"><img src="<?=$version_path?>/images/google-play-badge.svg" alt=""></a>
              <a class="badge-link" href="#"><img src="<?=$version_path?>/images/app-store-badge.svg" alt=""></a>
            </div>

            <div class="kv-img">
              <img class="kv_hand_img mo_none" src="<?=$version_path?>/images/kv_hand_mo.png" data-parallax data-speed="0.05" data-direction="up">
              <img class="kv_hand_img pc_none" src="<?=$version_path?>/images/kv_hand.png" data-parallax data-speed="0.05" data-direction="up">
            </div>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- 브랜드 의미 -->
  <section class="brand_page of-hidden scroll_tg" id="brand_page">

    <div class="container">
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="row">
            <div class="col-md-4 col-sm-4 my-auto launcher_icon">
              <img class="mw-img" src="<?=$version_path?>/images/about_brand_icon.png">
            </div>
            <div class="col-md-8 col-sm-8 my-auto launcher_text">
             <h3>Plan A는 자유여행일정 추천 앱입니다. </h3>
             <p>여행지에 따라 가장 인기있는 여행일정을 추천해주고,
               내 상황에 맞게 수정 할 수 있어요.
               완성된 일정을 바탕으로 가이드도 해드려요.
                </p>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <div class="container">
   <hr class="line">
  </div>
 <!-- 포토맵 -->
 <section class="section-01 of-hidden scroll_tg" id="section-01">
  <img class="mw-img parallax-item" src="<?=$version_path?>/images/bg-map-graphic.png" data-parallax data-speed="0.1" data-direction="up">
  <div class="container z-2">
    <div class="section-heading text-center">
      <div class="section-count en">01</div>
      <h2>자유여행 일정추천</h2>
      <p>어디 가야할지 고민 이세요?<br>더 이상 긴 시간 계획 세우지 마세요.<br>
        가장 인기있는 자유여행일정을 추천해드려요.</p>
    </div>
  <div class="position_ab">
    <div class="container">
      <div class="row">
          <div class="phone_item">
          <img class="" src="<?=$version_path?>/images/feature-01-screen.png" data-parallax data-speed="0.05" data-direction="up">
          </div>
      </div>
    </div>
  </div>
</section>

<!-- 실시간 가이드 -->
<section class="section-02 of-hidden dark_bg scroll_tg" id="section-02">
  <div class="container">
    <div class="row">
        <div class="section-heading text-left col-md-6">
            <div class="section-count en">02</div>
          <h2>실시간 가이드</h2>
          <p>여행지에서 더 이상 방황하지 마세요.<br>
              완성된 일정을 바탕으로 실시간으로 가이드 해드릴게요!
              </p>
        </div>
        <div class="col-md-6">
          <div class="phone_item">
            <img class="" src="<?=$version_path?>/images/feature-02-screen.png" data-parallax data-speed="0.05">
          </div>
          </div>
    </div>
  </div>
</section>

<!-- 공유, 채팅 페이지 -->
<section class="section-03 of-hidden scroll_tg" id="section-03">
  <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="phone_item">
              <img class="" src="<?=$version_path?>/images/feature-03-screen.png" data-parallax data-speed="0.05">
            </div>
        </div>
      <div class="section-heading text-right my-auto col-md-6">
          <div class="section-count en">03</div>
        <h2>여행 일정 공유</h2>
        <p>친구들과 가족들에게 내 여행 일정을 공유해보세요.<br>
          걱정하지 않게, 같이 여행을 즐길 수 있도록 도와드릴게요.</p>
            <div class="feature-03-bg">
                <img class="" src="<?=$version_path?>/images/feature-03-airplane.png" data-parallax data-speed="0.05">
                <img class="" src="<?=$version_path?>/images/feature-03-bg.png" data-parallax data-speed="0.1">
            </div>
      </div>
    </div>
  </div>
</section>
<footer>
  <div class="container">
    <div class="row footer_top">
      <div class="col-md-8">
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="mailto:">제휴제안</a>
          </li>
          <li class="list-inline-item">
            <a href="/randing_v_6_0_0/policy_view">이용약관</a>
          </li>

        </ul>
      </div>
      <div class="col-md-4">

      </div>
    </div>
    <hr class="w_line">
    <div class="row footer_bottom">
      <div class="col-md-2 text-left">
        <div class="footer_logo"></div>
      </div>
      <div class="col-md-8">
        <p>상호 : 언박스 주식회사 사업자등록번호 : 144-81-31011 통신판매업신고번호 : 제2015-경기성남-1714호 대표이사 : 이승호 주소 : 경기도 성남시 분당구 대왕판교로645번길12 판교공공지원센터 스마트 오피스 2014-37호 대표전화 : 0505-993-9999</p>
        <p class="copyright">Copyright &copy; 2019 Plan A Inc. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>

<script src="<?=$version_path?>/js/jquery.min.js"></script>
<script src="<?=$version_path?>/js/bootstrap.bundle.js"></script>

<script src="<?=$version_path?>/js/jquery.easing.min.js"></script>
<script src="<?=$version_path?>/js/fancySelect.js"></script>
<script src="<?=$version_path?>/js/swiper.min.js"></script>
<script src="<?=$version_path?>/js/custom.js"></script>



</body>
</html>
