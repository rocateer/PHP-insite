<div class="swiper main_bn main_bn_1">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<div class="before_vote_bar">
<a href="/<?=mapping('edu')?>/edu_vote_list">
교육 사전투표 전체보기
  <img src="/images/btn_more.png">
</a>
</div>

<div class="search_cnt mt30 row">
  <p class="f_right on ease"> 모집중만 보기</p>
</div>
<div class="no_data">
  <p><span class="message_box">교육 상품을 준비 중입니다.</span></p>
</div>


  <ul class="product_list mt20">
    <li>
      <span class="mark">삿시</span>
      <div class="scrap ease"></div>
      <a href="/<?=mapping('edu')?>/edu_detail">
        <div class="img_box relative">
            <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">도배실무 및 자격증취득과정</p>
          <div class="product_list_item">
            서울특별시 금천구
            <span class="point_color f_right">모집중</span>
          </div>
        </div>
      </a>
    </li>
    <li>
      <span class="mark">삿시</span>
      <div class="scrap ease"></div>
      <a href="/<?=mapping('edu')?>/edu_detail">
        <div class="img_box relative">
            <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">도배실무 및 자격증취득과정</p>
          <div class="product_list_item">
            서울특별시 금천구
            <span class="point_color f_right">모집중</span>
          </div>
        </div>
      </a>
    </li>
    <li>
      <span class="mark">삿시</span>
      <div class="scrap ease"></div>
      <a href="/<?=mapping('edu')?>/edu_detail">
        <div class="img_box relative">
            <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">도배실무 및 자격증취득과정</p>
          <div class="product_list_item">
            서울특별시 금천구
            <span class="font_gray_63 f_right">마감</span>
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