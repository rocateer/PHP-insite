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
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="format-detection" content="telephone=no">

  <!--내부 기본 CSS : 내부에서 생성한 CSS만 사용-->
  <link rel="stylesheet" href="/css/common.css">
  <link rel="stylesheet" href="/css/p_common.css">
  <link rel="stylesheet" href="/css/style.css">

  <!--외부 CSS : 외부 모듈에서 제공된 CSS만 사용-->
  <link rel="stylesheet" href="/external_css/swiper-bundle.min.css">
  <link rel="stylesheet" href="/external_css/jquery.tag-editor.css">
  <!-- <link rel="stylesheet" href="/external_css/nouislider.min.css"> -->
  <link href="https://cdn.jsdelivr.net/gh/sunn-us/SUIT/fonts/static/woff2/SUIT.css" rel="stylesheet">
  <!--외부 CSS 커스텀 : 외부 모듈 적용 후 자체적으로 CSS변경 한 경우만 사용-->
  <link rel="stylesheet" href="/external_css/outside.css">

  <!--내부 기본 JS : 내부에서 생성한 JS 경우만 사용 하며. 이를 사용하기 위한 라이브러만사용(jquery.js) -->
  <script src="/js/jquery-1.12.4.min.js"></script>
  <script src="/js/jquery-ui.js"></script>
  <script src="/js/common.js"></script>

  <!--외부 JS : 외부 모듈에서 제공된 JS만 사용-->
  <script src="/external_js/swiper.jquery.js"></script>
  <script src="/external_js/swiper-bundle.min.js"></script>
  <script src="/external_js/jquery.tag-editor.js"></script>
  <script src="/external_js/nouislider.min.js"></script>
  <script src="/external_js/pinch-zoom.js"></script>
</head>
<script>
var member_idx ="<?=$this->member_idx?>";
var member_gender ="<?=$this->member_gender?>";
var app_yn ="<?=$this->app_yn?>";
var agent ="<?=$agent?>";

//로그인 체크
function COM_login_check(member_idx,return_url){
  if(member_idx>0){
    return true;
  }else{
    alert("로그인이 필요합니다.");
    location.href= "/<?=mapping('login')?>?return_url="+return_url;
    return false;
  }
}

// 외부링크 이동 :: 사업자 정보 확인 및 배너 링크 이동
function api_request_external_link(url){
 if(agent == 'android') {
   window.rocateer.request_external_link(url);
 } else if (agent == 'ios') {
   var message = {
                  "request_type" : "request_external_link",
                  "url" : url,
                 };
   window.webkit.messageHandlers.native.postMessage(message);
 }
}

// go top
function go_top(){
  $('body,html').animate({scrollTop:0},400);
  return false;
}

</script>
<body>


  <!-- wrap : s -->
  <div class="wrap">
