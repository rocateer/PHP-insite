<header>
  <div class="btn_right" onclick="modal_close('category');">
    <img src="/images/head_btn_alarm_on.png" alt="">
  </div>
  <h1>
    커뮤니티
  </h1>
</header>

<div class="swiper main_bn main_bn_1">
  <div class="swiper-wrapper">
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
    <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
  </div>
  <div class="swiper-pagination"></div>
</div>

<script>
  var main_bn_1 = new Swiper(".main_bn_1", {
      pagination: {
        el: ".swiper-pagination",
      },
    });
</script>