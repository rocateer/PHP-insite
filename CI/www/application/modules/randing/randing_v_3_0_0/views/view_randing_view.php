<!doctype html>
<!--[if lt IE 7]><html lang="en" class="no-js ie6"><![endif]-->
<!--[if IE 7]><html lang="en" class="no-js ie7"><![endif]-->
<!--[if IE 8]><html lang="en" class="no-js ie8"><![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->

  <head>
      <meta charset="UTF-8">
      <title>Educube</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  	  <meta name="naver-site-verification" content="7cd7a6987b5b0d45a6cf5102193d65a2c7e1517b"/>
      <link rel="shortcut icon" href="favicon.png">

      <!-- Bootstrap 3.3.2 -->
      <link rel="stylesheet" href="<?=$version_path?>/css/bootstrap.min.css">

      <link rel="stylesheet" href="<?=$version_path?>/css/animate.css">
      <link rel="stylesheet" href="<?=$version_path?>/css/font-awesome.min.css">
      <link rel="stylesheet" href="<?=$version_path?>/css/slick.css">
      <link rel="stylesheet" href="<?=$version_path?>/js/rs-plugin/css/settings.css">

      <link rel="stylesheet" href="<?=$version_path?>/css/styles.css">

      <script type="text/javascript" src="<?=$version_path?>/js/modernizr.custom.32033.js"></script>

      <script src="<?=$version_path?>/js/jquery-1.11.1.min.js"></script>
      <!--
      <script type="text/javascript" src="js/froogaloop.min.js"></script>
      -->

      <!--
      [if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]
      -->

      <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-67009245-2', 'auto');
      ga('send', 'pageview');
      </script>

      <!-- Facebook Conversion Code for ����ť�� -->
      <script>(function() {
        var _fbq = window._fbq || (window._fbq = []);
        if (!_fbq.loaded) {
          var fbds = document.createElement('script');
          fbds.async = true;
          fbds.src = 'https://connect.facebook.net/en_US/fbds.js';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(fbds, s);
          _fbq.loaded = true;
        }
      })();
      window._fbq = window._fbq || [];
      window._fbq.push(['track', '6047222960942', {'value':'1.00','currency':'KRW'}]);
      </script>
      <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6047222960942&amp;cd[value]=1.00&amp;cd[currency]=KRW&amp;noscript=1" /></noscript>

  </head>

  <header>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="fa fa-bars fa-lg"></span>
          </button>
          <a class="navbar-brand" href="/">
            <img src="<?=$version_path?>/images/logo_new.png" alt="" class="logo">
          </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

          <ul class="nav navbar-nav navbar-right">
            <li><a href="#features">기능</a></li>
            <li><a href="#analysis">학습분석</a></li>
            <li><a href="#download">다운로드</a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-->
    </nav>


    <!--RevSlider-->
    <div class="tp-banner-container">
      <div class="tp-banner">
        <ul class="m_bg">
          <!-- SLIDE  -->
          <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" >
            <!-- MAIN IMAGE -->
            <div class="tp-caption lfl fadeout" data-x="left" data-y="bottom" data-hoffset="30" data-voffset="0" data-speed="500"
              data-start="700" data-easing="Power4.easeOut">
              <img src="<?=$version_path?>/images/main_visual.png" alt="">
            </div>
            <div class="tp-caption large_white_bold sft" data-x="550" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1200" data-easing="Power4.easeOut">중고생들을 위한  </div>
            <div class="tp-caption large_white_light sfr" data-x="950" data-y="center" data-hoffset="0" data-voffset="-80" data-speed="500" data-start="1400" data-easing="Power4.easeOut">No.1</div>
            <div class="tp-caption large_white_light sfb" data-x="550" data-y="center" data-hoffset="0" data-voffset="0" data-speed="1000" data-start="1500" data-easing="Power4.easeOut">
              학습관리 어플리케이션
            </div>
            <div class="tp-caption sfr hidden-xs" data-x="550" data-y="center" data-hoffset="0" data-voffset="85" data-speed="1500" data-start="1900" data-easing="Power4.easeOut">
              <a href="#modal-s" class="btn btn-default btn-lg"><i class="fa fa-play-circle-o fa-lg"></i> &nbsp;동영상 바로보기</a>
            </div>
          </li>
        </ul>
        <div class="mobile">
          <div class="mobile_txt">중고생들을 위한<br>No.1 학습관리 어플리케이션</div>
          <div class="mobile_btn"><a href="https://player.vimeo.com/video/156799840?autoplay=1&api=1&player_id=vimeoplayer"><i class="fa fa-play-circle-o fa-lg"></i> &nbsp;애듀큐브 동영상</a></div>
          <!-- <div class="tp-caption2"><img src="/images/mobile_main.png" alt=""></div> -->
        </div>
      </div>
    </div>


  </header>


  <!-- 모달팝업 -->
  <div class="remodal" data-remodal-id="modal-s">
  	<iframe id="video" src="https://player.vimeo.com/video/156799840?player_id=eduplayer" width="1024" height="575" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
  	<!-- <video preload="" src="https://player.vimeo.com/video/156799840?title=0&byline=0&portrait=0"></video> -->
  	<!-- <iframe src="https://player.vimeo.com/video/156799840?title=0&byline=0&portrait=0" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
  </div>

  <div class="wrapper" style="index:1000;">


      <section id="features">

      <div class="bg_gray">
        <div class="container">
          <div class="w-col-right">
            <div class="txt_right_wrap">
              <p class="analy_title">간편하게 세우는 학습계획</p>
              <p class="analy_con">교재를 등록하고, 기간과 범위만 입력하면 끝.<br>이제 터치 몇번으로 간편하게 학습계획을 세우세요.</p>
            </div>
          </div>
          <div class="w-col-right">
            <div class="img_wrap-1"><img src="<?=$version_path?>/images/analy_img_01.png" class="analy_img"></div>
          </div>
        </div>
      </div>

      <div class="bg_white">
        <div class="container analy_area">
          <div class="w-col-left">
            <div class="txt_right_wrap">
              <p class="analy_title">체계적으로 관리되는 학습 기록</p>
              <p class="analy_con">계획된 학습들을 실천하고 실제 학습한 결과를<br>기록하세요. 그리고 학습계획과 실제로 학습한<br>기록이 얼마나 일치하는지를 직접 눈으로 확인해 보세요.</p>
            </div>
          </div>
          <div class="w-col-left align-right">
            <div class="img_wrap-2"><img src="<?=$version_path?>/images/analy_img_02.png" class="analy_img"></div>
          </div>
        </div>
      </div>

      <div class="bg_gray h-m-2">
        <div class="container analy_area">
          <div class="w-col-right">
            <div class="txt_right_wrap">
              <p class="analy_title">에듀큐브만의 6가지 분석지표</p>
              <p class="analy_con">사용자의 학습기록들을 토대로 계획력, 학습시간, 집중력, 학습<br>속도, 학습균형, 지속력의 6가지 학습분석 통계를 제공합니다.<br>
              에듀큐브에서만 볼 수 있는 독특한 분석결과를 토대로 스스로의<br>학습상태를 분석하고, 학습방법을 개선해 보세요.</p>
              <p class="mt20">
              <a href="<?=$version_path?>/front/analysis.html" class="btn btn-primary">
                <b>자세히 보기</b>
              </a>
              </p>
            </div>
          </div>
          <div class="w-col-right">
            <div class="img_wrap-3"><img src="<?=$version_path?>/images/analy_img_03.png" class="analy_img"></div>
          </div>
        </div>
      </div>

      <div class="bg_white">
        <div class="container analy_area">
          <div class="w-col-left">
            <div class="txt_right_wrap">
              <p class="analy_title">내맘대로 꾸미는 <br>나만의 학습 매니저</p>
              <p class="analy_con">내가 좋아하는 사람의 사진을 매니저로 등록하고 여러가지<br>조언을 들어보세요. 학습능률도 덩달아 쑥쑥 오르겠죠?</p>
            </div>
          </div>
          <div class="w-col-left align-right">
            <div class="img_wrap-4"><img src="<?=$version_path?>/images/analy_img_04.png" class="analy_img"></div>
          </div>
        </div>
      </div>

      <div class="bg_gray h-m-3">
        <div class="container analy_area">
          <div class="w-col-right">
            <div class="txt_right_wrap">
              <p class="analy_title">실전에서 바로 활용할 수 있는<br> 공부법 동영상</p>
              <p class="analy_con">에듀플렉스에서 오랫동안 검증된 공부공식™을 바탕으로 제작된<br>검증된 에듀플렉스 강사진의 공부법 동영상을 경험해 보세요.</p>
            </div>
          </div>
          <div class="w-col-right">
            <div class="img_wrap-5"><img src="<?=$version_path?>/images/analy_img_05.png" class="analy_img"></div>
          </div>
        </div>
      </div>


      </section>


  <section id="download">
          <div class="container">

              <div class="row">
                  <div class="col-md-4 col-sm-4">
                      <div class="media text-right download">
                          <a class="" href="#">
                              <img src="<?=$version_path?>/images/dl_icon_01.png">
              <!-- <i class="fa fa-cogs fa-2x"></i> -->
                          </a>
                          <div class="media-body">
                              <h3 class="media-heading">중장기 학습계획</h3>
                              에듀큐브의 학습계획 기능을 이용하면<br>
              1개월 ~ 6개월 단위의 중장기 학습계획도<br>
              한눈에 보면서 쉽게 계획하고 관리할 수 있습니다.
                          </div>
                      </div>
                      <div class="media text-right download">
                          <a class="" href="#">
                              <img src="<?=$version_path?>/images/dl_icon_02.png">
                          </a>
                          <div class="media-body">
                              <h3 class="media-heading">공부 타이머</h3>
                              에듀큐브에 포함된 공부타이머를 사용해서<br>
              학습시간을 정확하게 기록하고 관리할 수 있습니다.
                          </div>
                      </div>
                  </div>
                  <div class="col-md-4 col-sm-4 download_img">
                      <img src="<?=$version_path?>/images/download_img.png" class="img-responsive" alt="">
                  </div>
                  <div class="col-md-4 col-sm-4">
                      <div class="media download">
                          <a class="" href="#">
                             <img src="<?=$version_path?>/images/dl_icon_03.png">
                          </a>
                          <div class="media-body">
                              <h3 class="media-heading">교재 관리</h3>
                              내가 가진 모든 학습교재들을 바코드로 <br>
              간편하게 등록해 두고, 각 교재별 학습기록들을 <br>
              지속적으로 관리할 수 있습니다.
                          </div>
                      </div>
                      <div class="media download">
                          <a class="" href="#">
                             <img src="<?=$version_path?>/images/dl_icon_04.png">
                          </a>
                          <div class="media-body">
                              <h3 class="media-heading">일정 관리</h3>
                              학습계획 뿐만 아니라, 매일의 간단한 일정계획도 <br>
              함께 입력하고 관리할 수 있습니다.
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>

  <section id="download" style="background:#f4f4f4;">
          <div class="container">
              <div class="section-heading">
                  <h1>Download</h1>
                  <p class="sub_txt">지금 바로 에듀큐브를 다운받고 더 많은 기능들을 직접 확인하세요.</p>
              </div>
      <div class="platforms" style="margin-top:-20px;">
        <a href="https://play.google.com/store/apps/details?id=com.rocat.nexcube&hl=ko" target="_blank" class="mr10"><img src="<?=$version_path?>/images/google_store.png" width="200"></a>
        <a href="https://itunes.apple.com/us/app/educube/id1065385948?l=ko&ls=1&mt=8" target="_blank"><img src="<?=$version_path?>/images/apple_store.png" width="200"></a>
      </div>
    </div>
  </section>
  <link rel="stylesheet" href="<?=$version_path?>/css/jquery.remodal.css">
  <footer>
    <div class="container">
        <!--
  				<a href="#" class="scrollpoint sp-effect3">
          <img src="assets/img/freeze/logo.png" alt="" class="logo">
          </a>
  			-->
  		<div class="footer_menu">
  			<ul>
  				<li><a href="<?=$version_path?>/rules/provision">서비스 이용약관</a></li>
  				<li><a href="<?=$version_path?>/rules/privacy">개인정보취급방침</a></li>
  			</ul>
  		</div>
  		<div class="social">
  		    <a href="mailto:support@educube.co.kr"><i class="fa fa-envelope fa-lg"></i></a>
  		    <a href="http://educubeapp.blog.me" target="_blank"><i class="fa fa-lg">b</i></a>
  		    <a href="https://www.facebook.com/educube.co.kr" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
  		</div>
  		<div class="rights">
  		  <p>넥스큐브코퍼레이션 주식회사: 고승재 서울특별시 금천구 가산동 371-37 에스티엑스브이타워10층 1006</p>
  		  <p>대표전화 :  02-555-0567 사업자등록번호: 120-86-61080</p>
  			<p>Copyright ⓒ Nexcube Corp. All rights reserved. </p>
  		</div>
  		<div class="rights2">
  		  <p>넥스큐브코퍼레이션 주식회사: 고승재</p>
  			<p>서울특별시 금천구 벚꽃로 234</p>
  			<p>에이스하이엔드타워6차 2층 214호 (가산동) 153-798</p>
  		  <p>대표전화 : 02-555-0567</p>
  			<p>사업자등록번호: 120-86-61080</p>
  			<p>Copyright ⓒ Nexcube Corp. All rights reserved. </p>
  		</div>
    </div>
  </footer>
  <script src="http://www.winkia.net/js/jquery-1.11.1.min.js"></script>

  <script src="<?=$version_path?>/js/jquery.remodal.js"></script>

      </div>
      <script src="<?=$version_path?>/js/jquery-1.11.1.min.js"></script>
  		<script src="<?=$version_path?>/js/froogaloop.min.js"></script>
      <script src="<?=$version_path?>/js/bootstrap.min.js"></script>
      <script src="<?=$version_path?>/js/slick.min.js"></script>
      <script src="<?=$version_path?>/js/placeholdem.min.js"></script>
      <script src="<?=$version_path?>/js/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
      <script src="<?=$version_path?>/js/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
      <script src="<?=$version_path?>/js/waypoints.min.js"></script>
      <script src="<?=$version_path?>/js/scripts.js"></script>

      <script>
          $(document).ready(function() {
              appMaster.preLoader();
          });
      </script>


  </body>

</html>
