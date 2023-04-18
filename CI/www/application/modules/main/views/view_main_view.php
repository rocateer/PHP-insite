<div class="body">
  <!-- main_banner : s -->
  <section class="main_banner_wrap">
    <div class="swiper-container main_banner">
      <ul class="swiper-wrapper">
        <?php foreach($banner_list as $row){?>
        <li class="swiper-slide"><a href="<?=$row->link_url?>"><img src="<?=$row->img_path?>" alt="<?=$row->title?>"></a></li>
        <?php }?>

        <!-- <li class="swiper-slide"><img src="/images/img_main_banner.png" alt="배너이미지"></li> -->
      </ul>
    </div>
    <!-- paging 버튼 -->
    <div class="swiper-pagination"></div>
  </section>
  <!-- main_banner : e -->

  <section>
    <div class="inner_wrap">
      <h2 class="section_title">MD's Pick</h2>
      <!-- product_list : s -->
      <ul class="product_list">
        <?php
        foreach($md_product_list as $row){
        $product_halin_letter="";
        if($row->product_st_price>0){
          $product_halin_letter = number_format(($row->product_st_price-$row->product_price)/$row->product_st_price*100)." %";
        }
        ?>
          <li>
            <a href="/product/product_detail?product_idx=<?=$row->product_idx?>">
              <div class="img_wrap">
                <img src="<?=$row->product_img_path?>" alt="상품이미지">
              </div>
              <div class="text_wrap">
                <p class="text_over"><?=$row->product_name?></p>
                <p class="cost_wrap"><span><?=number_format($row->product_price)?>원</span> <span class="discount"><?=$product_halin_letter?></span>
                </p>
              </div>
            </a>
          </li>
        <?php }?>

        <!-- <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_2.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_3.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_4.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_default.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li> -->
      </ul>
      <!-- product_list : e -->
    </div>
  </section>

  <section>
    <div class="inner_wrap">
      <div class="single_banner_wrap">
        <a href="#">
          <img src="/images/img_sub_banner.png" alt="서브배너이미지">
        </a>
        <a href="#">
          <img src="/images/img_sub_banner.png" alt="서브배너이미지">
        </a>
      </div>
    </div>
  </section>

  <section>
    <div class="inner_wrap">
      <!-- product_list : s -->
      <ul class="product_list">

      <?php
      foreach($new_product_list as $row){
        $product_halin_letter="";
        if($row->product_st_price>0){
          $product_halin_letter = number_format(($row->product_st_price-$row->product_price)/$row->product_st_price*100)." %";
        }


      ?>
          <li>
            <a href="/product/product_detail?product_idx=<?=$row->product_idx?>">
              <div class="img_wrap">
                <img src="<?=$row->product_img_path?>" alt="상품이미지">
              </div>
              <div class="text_wrap">
                <p class="text_over"><?=$row->product_name?></p>
                <p class="cost_wrap"><span><?=number_format($row->product_price)?>원</span> <span class="discount"><?=$product_halin_letter?></span>
              </div>
            </a>
          </li>
      <?php }?>

        <!-- <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_2.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_3.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_4.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_default.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_1.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_2.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_3.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_4.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li>
        <li>
          <a href="/product/product_detail">
            <div class="img_wrap">
              <img src="/images/product_sample_2.png" alt="상품이미지">
            </div>
            <div class="text_wrap">
              <p class="text_over">[최저가] 알망 EC패브릭 가죽 모듈형소파 3colors</p>
              <p class="cost_wrap"><span>259,000원</span><span class="discount">63%</span></p>
            </div>
          </a>
        </li> -->
      </ul>
      <!-- product_list : e -->
    </div>
  </section>
</div>



<script>
  var full_banner = new Swiper('.main_banner', {
    pagination: {
				el: '.main_banner_wrap .swiper-pagination', // paging 버튼 class명
        clickable: true,
			},
    slidesPerView: 1, //한 화면에 보여줄 슬라이드 개수
    loop: true, //반복여부
    autoplay: 5000,
    speed: 1000,
  });
</script>
