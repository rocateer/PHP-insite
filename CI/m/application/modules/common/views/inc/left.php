<!-- nav : s -->
<nav class="nav">
	<div class="nav_top">
		<a href="javascript:side_nav_toggle()"><img class="nav_close_btn" src="/images/btn_close.png" alt="nav"></a>
	</div>
	<!-- 로그인일 경우 : s -->
	<div class="side_head">
		<a href="/mypage">
			haroonagi
			<p>홍길동</p>
		</a>
	</div>
	<!-- 로그인일 경우 : e -->
	<!-- 로그아웃일 경우 : s -->
	<div class="side_head logout_state">
		<span><a href="/login">로그인</a></span>
		<span><a href="/member/member_join">회원가입</a></span>
	</div>
	<!-- 로그아웃일 경우 : e -->
	<hr>
	<ul class="side_nav accordion">
		<li><h2><a href="/event"><img src="/images/side_i_01.png" alt=""> 특가이벤트</a></h2></li>
		<li><h2><a href="#" data-panel-id="pane1" class="trigger"><img src="/images/side_i_02.png" alt=""> 커뮤니티 <img src="/images/btn_down.png" class="list_arrow" alt=""></a></h2>
			<ul class="panel pane1">
				<li><h3><a href="/notice">공지사항</a></h3></li>
				<li><h3><a href="#">자유게시판</a></h3></li>
			</ul>
		</li>
		<li>
			<h2><a href="#" data-panel-id="pane2" class="trigger"><img src="/images/side_i_03.png" alt="">고객센터 <img src="/images/btn_down.png" class="list_arrow" alt=""></a></h2>
			<ul class="panel pane2">
				<li><h3><a href="/faq">FAQ</a></h3></li>
				<li><h3><a href="/qa">문의하기</a></h3></li>
			</ul>
		</li>
		<li>
			<div class="menu_t_2">
				<a href="/ad/ad_inquiry">광고문의</a> <span>|</span>
				<a href="/partner/partner_inquiry">제휴문의</a> <span>|</span>
				<a href="#">공유하기</a>
			</div>
		</li>
		<li><h2><a href="/company/company" class="menu_t_3">회사소개</a></h2></li>
		<li><h2><a href="/agree/agree" class="menu_t_3">이용약관</a></h3></li>
		<li><h2><a href="/privercy/privercy" class="menu_t_3">개인정보보호정책</a></h3></li>
		<li><h2><a href="/agree/location_agree" class="menu_t_3">위치정보서비스 이용약관</a></h3></li>
		<!-- <li>
			<h2><a href="#" data-panel-id="panel2" class="trigger">Header</a><img src="/images/btn_down.png" class="list_arrow" alt=""></h2>
			<ul class="panel panel2">
				<li><h3><a href="#">main_header</a></h3></li>
				<li><h3><a href="#">sub_header</a></h3></li>
			</ul>
		</li> -->
	</ul>
</nav>
<!-- nav : e -->
<div class="nav_dim" onclick="side_nav_toggle()"></div>
