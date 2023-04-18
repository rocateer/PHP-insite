<ul class="product_list column4" >
  <?php
    if(!empty($result_list)){
      foreach($result_list as $row){
        if($row->product_st_price>0){
          $product_halin_letter = number_format(($row->product_st_price-$row->product_price)/$row->product_st_price*100)." %";
        }
  ?>
  <li>
    <a href="/product/product_detail?product_idx=<?=$row->product_idx?>">
      <div class="img_wrap">
        <img src="<?=$row->product_img_path?>" alt="<?=$row->product_name?>">
      </div>
      <div class="text_wrap">
        <p class="text_over"><?=$row->product_name?></p>
        <p class="cost_wrap"><span><?=number_format($row->product_price)?>원</span><span class="discount"><?=$product_halin_letter?></span></p>
      </div>
    </a>
  </li>
  <?php
      }
    }else{
  ?>
  <li>
      등록된 게시물이 없습니다.
  </li>
  <?php
    }
  ?>
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
        <p class="text_over">[최저가] 아주 긴 제목 테스트 알망 EC패브릭 가죽 모듈형소파 3colors</p>
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
  </li> -->
</ul>
<!-- product_list : e -->

<!-- paging : s -->
<div class="paging">
<?=$paging?>
</div>
<!-- <div class="paging">
  <ul>
    <li class="prev">
      <a href="javascript:page_go(1);"><img src="/images/icon_double_prev.png" alt=""></a>
    </li>
    <li class="prev">
      <a href="javascript:void(0)"><img src="/images/icon_prev.png" alt=""></a>
    </li>
    <li>
      <a class="on" href="javascript:void(0)">1</a>
    </li>
    <li>
      <a href="javascript:void(0)">2</a>
    </li>
    <li>
      <a href="javascript:void(0)">3</a>
    </li>
    <li>
      <a href="javascript:void(0)">4</a>
    </li>
    <li>
      <a href="javascript:void(0)">5</a>
    </li>
    <li class="next">
      <a href="javascript:void(0)"><img src="/images/icon_next.png" alt=""></a>
    </li>
    <li class="next">
      <a href="javascript:page_go(1);"><img src="/images/icon_double_next.png" alt=""></a>
    </li>
  </ul>
</div> -->
<!-- paging : e -->
