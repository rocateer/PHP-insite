<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=SERVICE_NAME;?> 관리자</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="/images/favicon.png">

    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.css" rel="stylesheet">

    <!-- Common CSS -->
    <link href="/css/jquery-ui.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">

    <!-- Plugin -->
    <link href="/css/jquery.fancybox.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/p_common.css" rel="stylesheet">
    <link href="/css/summernote.css" rel="stylesheet">
    <!-- tag-editor -->
    <link rel="stylesheet" href="/css/jquery.tag-editor.css">
    <!-- select2 -->
    <link href="/css/select2.min.css" rel="stylesheet">
    <!-- <link href="/css/summernote-lite.css" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Common JS -->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.fancybox.pack.js"></script>

    <!-- custom -->
    <script src="/js/datepicker_set.js"></script>
    <script src="/js/common.js"></script>
    <script src="/js/jazz.common.js"></script>
    <script src="/js/summernote.js"></script>
    <script src="/lang/summernote-ko-KR.js"></script>
    <!-- tag-editor -->
    <script src="/js/jquery.caret.min.js"></script>
    <script src="/js/jquery.tag-editor.js"></script>
    <!-- select2 -->
    <script src="/js/select2.min.js"></script>

</head>

<body>
  <!-- loader -->
  <div class="loader" style="opacity: 1;"></div>

<script>

  $(window).scroll(function(){
      var scrollValueTop = $(document).scrollTop();
      var scrollValueLeft = $(document).scrollLeft();
      $("#hiddenDivLoading").css({
        top: scrollValueTop + 'px',
        left: scrollValueLeft + 'px'
      });
  });

</script>
