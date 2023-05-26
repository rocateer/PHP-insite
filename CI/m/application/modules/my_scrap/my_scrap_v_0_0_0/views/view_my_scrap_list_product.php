<header>
	<div class="main_header">
    <a class="btn_left" href="/<?=mapping('mypage')?>"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <h1 class="head_title">스크랩</h1>
	</div>
</header>
<ul class="tab_1">
  <li><a href="/<?=mapping('my_scrap')?>">게시글</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_trade">중고거래</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_recruit">구인 공고</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_profile">구직 프로필</a></li>
  <li class="active"><a href="/<?=mapping('my_scrap')?>/scrap_list_product">공동구매</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_edu">교육</a></li>
</ul>

<ul class="product_list" style="display:none1;">
<?php for ($i=0; $i < 6; $i++) {?>
  <li>
    <span class="mark">D-11</span>
    <img class="btn_delete" src="/images/ic_point_delete.png" alt="">
    <a href="/<?=mapping('product')?>/product_detail">
      <div class="img_box relative">
          <img src="/p_images/s3.jpg">
      </div>
      <div class="product_list_body">
        <p class="product_list_title">'봄의 향' 심신안정 방향효과 인센스스틱</p>
        <div class="product_list_item">
          공동구매가 <b class="font_gray_f">75,000원</b>
          <span class="point_color f_right">80% 달성</span>
        </div>
      </div>
    </a>
  </li>
  <?php }?>
</ul>

<script>

</script>