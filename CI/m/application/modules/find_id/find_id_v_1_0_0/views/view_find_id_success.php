<!-- header : s -->
<header>
  <h1>아이디 찾기</h1>
</header>

<div class="body">
  <div class="inner_wrap">
		<div class="find_result mt30">
			<img src="/images/ic_result_success.png" alt="조회아이콘">
			<div class="mt30">
				<h2>회원 조회 완료</h2>
			</div>
			<div class="mt20 text">
				<span class="point_color"><?=$result->member_name?></span> 님의 아이디는 <br>
				<span class="point_color"><?=$result->member_id?></span> 입니다.
			</div>
		</div>
		<div class="flex_between mt30">
			<div class="w_half btn_space">
				<a href="/<?=mapping('find_pw')?>" class="btn_point_ghost btn_full_basic">비밀번호 찾기</a>
			</div>
			<div class="w_half btn_space">
				<a href="/<?=mapping('login')?>" class="btn_point btn_full_basic">로그인</a>
			</div>
		</div>
		
  </div>
</div>

