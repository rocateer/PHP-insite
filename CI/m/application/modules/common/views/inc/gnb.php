<style>
header{height:50px; box-sizing: border-box; position:fixed; top:0; left: 0; width:100%; background: #121212; z-index:20;}
header.transparent{background: transparent}
header.fixed.transparent{background:#fff;}
header .main_header{text-align: right; width:100%; padding:0 20px; top:50%; transform: translateY(-50%); position: absolute; box-sizing: border-box;}
header .main_header a{margin-left:5px;}
header .main_search{margin-top:2px;}
header .btn_right{position: absolute; right:5px; top:50%; transform: translateY(-50%); width: 24px; padding: 13px;line-height: 0;}
header img{width:24px; vertical-align:middle;}
header img.logo{width: 200px;position: absolute;z-index: 1;top:22px;left:20px;}
header .btn_back{position: absolute; left:5px; top:50%; transform: translateY(-50%); width: 24px; padding: 13px; line-height: 0;}
header h1{font-size:16px;font-family: 'font-b'; text-align: center; line-height:1; padding: 15px; color:#fff}
header .head_txt{color:#20BFA9;font-size:16px; position: absolute; z-index: 1; top:15px; right:20px;}

.gnb_wrap{-ms-overflow-style:none; /* IE and Edge */ scrollbar-width:none; padding:15px 20px; box-sizing:border-box; overflow-y:hidden; overflow-x:auto; width:auto; word-break: break-all; white-space: nowrap; margin-top:50px;}
.gnb_wrap li{display:inline-block; margin-right:20px; color:#A0A0A0;}
.gnb_wrap li.active{color:#fff;}

a.btn_gray_ghost{border:1px solid #444; color: #E2E2E2;}
a.btn_sm {border-radius:3px; display:inline-block; text-align:center; padding:8px 12px; font-size:12px; font-family:'font-b'; }
</style>

<header>
	<div class="main_header">
		<a href="#"><img src="/images/head_btn_search.png" class="main_search"></a>
		<a href="#" class="btn_gray_ghost btn_sm">로그인</a>
		<a href="#" class="btn_point btn_sm">글쓰기</a>
	</div>
</header>


<ul class="gnb_wrap">
	<li class="active"><a href="#">홈</a></li>
	<li><a href="#">중고거래</a></li>
	<li><a href="#">구인구직</a></li>
	<li><a href="#">공동구매</a></li>
	<li><a href="#">교육</a></li>
</ul>


<hr class="space">

