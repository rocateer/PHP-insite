<div class="swiper main_bn main_bn_1">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<div class="before_vote_bar">
<a href="/<?=mapping('product')?>/product_vote_list">
  공동구매 사전투표
  <img src="/images/btn_more.png">
</a>
</div>

<div class="search_cnt mt30 row">
  <p class="f_right on ease"> 진행중만 보기</p>
</div>
<div class="no_data">
  <p><span class="message_box">공동구매 상품을 준비 중입니다.</span></p>
</div>


  <ul class="product_list mt20" style="display:none1;">
    <li>
      <span class="mark">D-11</span>
      <div class="scrap ease"></div>
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
    <li>
      <span class="mark">D-1</span>
      <div class="scrap on ease"></div>
      <a href="/<?=mapping('product')?>/product_detail">
        <div class="img_box relative">
          <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">친환경 포스트잇 처럼 쉽게 붙이고 떼는 벽지</p>
          <div class="product_list_item">
            공동구매가 <b class="font_gray_f">75,000원</b>
            <span class="point_color f_right">80% 달성</span>
          </div>
        </div>
      </a>
    </li>
    <li>
      <span class="mark">마감</span>
      <div class="scrap ease"></div>
      <a href="/<?=mapping('product')?>/product_detail">
        <div class="img_box relative">
            <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">온돌방 같은 쇼파 상상해 봤니? BONEST 히딩 쇼파</p>
          <div class="product_list_item">
            공동구매가 <b class="font_gray_f">75,000원</b>
            <span class="point_color f_right">80% 달성</span>
          </div>
        </div>
      </a>
    </li>
   
  </ul>


<script>
  //배너
  var main_bn_1 = new Swiper(".main_bn_1", {
      pagination: {
        el: ".swiper-pagination",
      },
    });

  $( '.search_cnt p' ).click( function() {
    $(this).toggleClass("on");
  } );

  $( '.scrap' ).click( function() {
    $(this).toggleClass("on");
  } );


</script>