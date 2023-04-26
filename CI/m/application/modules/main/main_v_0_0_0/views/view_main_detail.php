
<!-- 인기 : s -->
<div class="main_list_wrap">
	<div class="main_list_head">
		<img src="/images/ic_cate_5.png">인기
		<a href="#"><img src="/images/btn_more.png" class="f_right"></a>
	</div>
	<ul class="main_list">
		<li>
			<div class="list_category"><img src="/images/ic_cate_1.png"> 자유공간</div>
			<div class="best_title mt5">
				<img src="/images/ic_img.png" class="w_16"> 
				<span> 월넛과 베이지로 차분하게, 무드있는 신혼집 제목이 길어지면 어떻게 될까요? </span>
				<img src="/images/ic_vote.png" class="w_16">
			</div> 
			<ul class="action_ui mt10">
				<li><img src="/images/ic_board_chat.png">10</li>
				<li><img src="/images/ic_board_visibility.png">1,523</li>
			</ul>
		</li>
		<li>
			<div class="list_category"><img src="/images/ic_cate_3.png"> 비밀공간</div>
			<div class="best_title mt5">
				<span> 무드있는 신혼집 </span>
				<img src="/images/ic_vote.png" class="w_16">
			</div> 
			<ul class="action_ui mt10">
				<li><img src="/images/ic_board_chat.png">10</li>
				<li><img src="/images/ic_board_visibility.png">1,523</li>
			</ul>
		</li>
		<li>
			<div class="list_category"><img src="/images/ic_cate_2.png"> 인사이트</div>
			<div class="best_title mt5">
				<span> 설비 소장님들 보세요~ </span>
			</div> 
			<ul class="action_ui mt10">
				<li><img src="/images/ic_board_chat.png">10</li>
				<li><img src="/images/ic_board_visibility.png">1,523</li>
			</ul>
		</li>
	</ul>
</div>
<!-- 인기 : e -->

<div class="swiper main_bn main_bn_1">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<!-- 자유공간 : s -->
<div class="main_list_wrap">
	<div class="main_list_head">
		<img src="/images/ic_cate_1.png">자유공간
		<a href="#"><img src="/images/btn_more.png" class="f_right"></a>
	</div>
	<ul class="main_list">
    <?php for ($i=0; $i < 5; $i++) {?>
		<li>
			<div class="best_title">
				<span class="type_2 f_left"> 월넛과 베이지로 차분하게, 무드있는 신혼집 제목이 길어지면 어떻게 될까요? </span>
        <ul class="action_ui f_right">
          <li><img src="/images/ic_board_visibility.png">1,523</li>
        </ul>
			</div> 
		</li>
    <?php }?>
	</ul>
</div>
<!-- 자유공간 : e -->

<!-- 인사이트 : s -->
<div class="main_list_wrap mt50">
	<div class="main_list_head">
		<img src="/images/ic_cate_2.png">인사이트
		<a href="#"><img src="/images/btn_more.png" class="f_right"></a>
	</div>
	<ul class="main_list">
    <?php for ($i=0; $i < 5; $i++) {?>
		<li>
			<div class="best_title">
				<span class="type_2 f_left"> 월넛과 베이지로 차분하게, 무드있는 신혼집 제목이 길어지면 어떻게 될까요? </span>
        <ul class="action_ui f_right">
          <li><img src="/images/ic_board_visibility.png">1,523</li>
        </ul>
			</div> 
		</li>
    <?php }?>
	</ul>
</div>
<!-- 인사이트 : e -->

<div class="swiper main_bn main_bn_2">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="/p_images/b_sample_2.png"></div>
    <div class="swiper-slide"><img src="/p_images/b_sample_2.png"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<!-- 비밀공간 : s -->
<div class="main_list_wrap">
	<div class="main_list_head">
		<img src="/images/ic_cate_3.png">비밀공간
		<a href="#"><img src="/images/btn_more.png" class="f_right"></a>
	</div>
	<ul class="main_list">
    <?php for ($i=0; $i < 5; $i++) {?>
		<li>
			<div class="best_title">
				<span class="type_2 f_left"> 월넛과 베이지로 차분하게, 무드있는 신혼집 제목이 길어지면 어떻게 될까요? </span>
        <ul class="action_ui f_right">
          <li><img src="/images/ic_board_visibility.png">1,523</li>
        </ul>
			</div> 
		</li>
    <?php }?>
	</ul>
</div>
<!-- 비밀공간 : e -->

<div class="swiper main_bn main_bn_3">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="/p_images/b_sample_3.png"></div>
    <div class="swiper-slide"><img src="/p_images/b_sample_3.png"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

  <script>
    var main_bn_1 = new Swiper(".main_bn_1", {
      pagination: {
        el: ".swiper-pagination",
      },
    });

    var main_bn_2 = new Swiper(".main_bn_2", {
      pagination: {
        el: ".swiper-pagination",
      },
    });

    var main_bn_3 = new Swiper(".main_bn_3", {
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>