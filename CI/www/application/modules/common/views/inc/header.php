<!DOCTYPE html>
<html lang="kor">
<head>
  <!--타이틀 :	title 태그와 파비콘만 사용-->
	<title><?=SERVICE_NAME?></title>
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
	<link rel="stylesheet" href="/external_css/font-awesome.css">
	<link rel="stylesheet" href="/external_css/swiper-bundle.min.css">

	<!--외부 CSS 커스텀 : 외부 모듈 적용 후 자체적으로 CSS변경 한 경우만 사용-->
	<link rel="stylesheet" href="/external_css/outside.css">

	<!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
	<script src="/js/jquery-1.12.4.min.js"></script>
	<script src="/js/jquery-ui.js"></script>
	<script src="/js/common.js"></script>

	<!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->
	<script src="/external_js/swiper.jquery.js"></script>
	<script src="/external_js/swiper-bundle.min.js"></script>

</head>
<body>
  <!-- wrap : s -->
  <div class="wrap">
