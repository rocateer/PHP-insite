<!DOCTYPE html>
	<html lang="kor">
	<head>
		<meta property="og:type" content="website">
		<meta property="og:url" content="<?=THIS_DOMAIN?>">
		<meta property="og:title" content="EVE'S SCORE">
		<meta property="og:description" content="안녕하세요. 이브와 함께해보아요.">
		<meta property="og:image" content='/images/top_img.png' >

		<script src="/js/jquery-1.12.4.min.js"></script>
		<script src="/js/jquery-ui.js"></script>
		<script src="/js/common.js"></script>
	</head>

	<script>

		$(function(){
			setTimeout("do_download()", 10);
		});

			// 공유하기
		function do_download(){
			var userAgent = navigator.userAgent;
			if(userAgent.match(/iPhone|iPad|iPod/)){
				setTimeout( function() {
					window.open("");
				}, 1000);
				location.href="evescore://";
			}

			if(userAgent.match(/Android/)){

				// 안드로이드의 크롬에서는 intent만 동작하기 때문에 intent로 호출해야함
				// setTimeout( function() {
				// 	 window.open("https://play.google.com/store/search?q=%EC%95%8C%EC%98%A8&c=apps");
				// }, 1000);
				if(userAgent.match(/Chrome/)){
						location.href = "intent://evescore/#Intent;scheme=evescore;package=rocateer.evescore;end";
				}else{

					var iframe = document.createElement('iframe');
					iframe.style.visibility = 'hidden';
					location.href = "intent://evescore/#Intent;scheme=evescore;package=rocateer.evescore;end";

					document.body.appendChild(iframe);
					document.body.removeChild(iframe); // back 호출시 캐싱될 수 있으므로 제거

				}
			}
		}
	</script>
</html>