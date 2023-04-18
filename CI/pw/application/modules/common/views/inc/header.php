<!DOCTYPE html>
<html lang="kor">
<head>
  <!--타이틀 :	title 태그와 파비콘만 사용-->
	<title>제목</title>
	<link rel="shortcut icon" href="/images/favicon.png">

	<!--메타 : 메타 태그만 사용-->
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
  <meta name="apple-mobile-web-app-capable" content="yes">

	<!--내부 기본 CSS : 내부에서 생성한 CSS만 사용-->
	<link rel="stylesheet" href="/css/common.css">
	<link rel="stylesheet" href="/css/p_common.css">
	<link rel="stylesheet" href="/css/style.css">

	<!--외부 CSS : 외부 모듈에서 제공된 CSS만 사용-->

	<!--외부 CSS 커스텀 : 외부 모듈 적용 후 자체적으로 CSS변경 한 경우만 사용-->
	<link rel="stylesheet" href="/external_css/outside.css">

	<!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
	<script src="/js/jquery-1.12.4.min.js"></script>
	<script src="/js/jquery-ui.js"></script>
	<script src="/js/common.js"></script>

	<!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->

</head>
<body>
  <!-- wrap : s -->
  <div class="wrap">

    <!-- header : s -->
    <header>
      <div class="gnb_top">
        <div class="inner_wrap">
          <h1 class="logo"><a href="/main"><img src="/images/logo.png"></a></h1>
          <div class="head_input_wrap">
            <input type="text">
            <a href="#"><img src="/images/btn_search.png" alt="검색"></a>
          </div>
          <ul>
             <?php if(!$this->member_idx){?>
             <li><a href="/login">로그인</a><span class="text_bar">|</span></li>
             <li><a href="/member">회원가입<span class="text_bar">|</span></a></li>
            <?php }else{?>
            <li><a href="/logout">로그아웃</a><span class="text_bar">|</span></li>
            <li><a href="/mypage">마이페이지</a><span class="text_bar">|</span></li>
            <?php }?>
            <!-- 로그인 후 : s -->
            <li><a href="/mypage">주문배송</a> <span class="text_bar">|</span></li>
            <li><a href="/cscenter">고객센터</a> </li>
            <li><a href="/cart"><img src="/images/btn_cart.png" alt="장바구니"><span class="cart_cnt"><?=number_format($member_cart_count)?></span></a></li>
          </ul>
        </div>
      </div>

      <div class="gnb">
        <div class="inner_wrap">
          <ul>
            <?php  foreach($product_b_category_list as $row){?>
            <li><a  <?php if(!empty($_GET['category_b'])&&$_GET['category_b']==$row->category_management_idx){?> class="active" <?php }?>  href="/product?category_b=<?=$row->category_management_idx?>&category_m=<?=$row->category_m?>"><?=$row->category_name?></a></li>
            <?php }?>
            <!-- <li><a href="#">패브릭</a></li>
            <li><a href="#">홈데코/조명</a></li>
            <li><a href="#">수납/생활</a></li>
            <li><a href="#">매트리스</a></li>
            <li><a href="#">주방</a></li>
            <li><a href="#">플라워/가드닝</a></li>
            <li><a href="#">가전</a></li> -->
          </ul>
          <ul class="right_menu">
            <li><a href="/coupon">쿠폰</a></li>
            <li><a href="/event">이벤트</a></li>
          </ul>
        </div>
      </div>
    </header>
    <!-- header : e -->
