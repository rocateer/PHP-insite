<header>
  <div class="btn_left"><img src="/images/head_btn_back.png" alt=""></div>
  <h1>인기</h1>
</header>
<div class="body">
  <div class="swiper main_bn main_bn_1">
    <div class="swiper-wrapper">
      <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
      <div class="swiper-slide"><img src="/p_images/b_sample_1.png"></div>
    </div>
    <div class="swiper-pagination"></div>
  </div>

  <ul class="community_list">
    <li>
      <div class="community_list_head">
        <img src="/images/ic_cate_2.png" class="list_cate_img">
        <div class="right_area">
          <p class="txt_cate">자유공간</p>
          <p class="txt_nickname">딸기맛바나나킥 · 서울 남부 <span class="f_right list_date">12.21</span></p>
        </div>
      </div>
      <div class="community_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="community_list_item">
          <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
          <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
        </div>
      </div>
      <div class="community_action_area mt15"> 
        <span><img src="/images/ic_board_heart_off.png">150</span>
        <span><img src="/images/ic_board_chat.png">10</span>
        <span><img src="/images/ic_board_visibility.png">1,523</span>
      </div>
    </li>
    <li>
      <div class="community_list_head">
        <img src="/images/ic_cate_3.png" class="list_cate_img">
        <div class="right_area">
          <p class="txt_cate">자유공간</p>
          <p class="txt_nickname">딸기맛바나나킥 · 서울 남부 <span class="f_right list_date">12.21</span></p>
        </div>
      </div>
      <div class="community_list_body">
        <div class="community_list_item">
          <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
          <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
        </div>
      </div>
      <div class="community_action_area mt15"> 
        <span><img src="/images/ic_board_heart_off.png">150</span>
        <span><img src="/images/ic_board_chat.png">10</span>
        <span><img src="/images/ic_board_visibility.png">1,523</span>
      </div>
    </li>
    <li class="community_noti">
      신고한 게시글입니다.
    </li>
    <li class="community_noti">
      차단한 게시글입니다.
      <a href="#">차단 해제</a>
    </li>
    <?php for ($i=0; $i < 6; $i++) {?>
    <li>
      <div class="community_list_head">
        <img src="/images/ic_cate_1.png" class="list_cate_img">
        <div class="right_area">
          <p class="txt_cate">자유공간</p>
          <p class="txt_nickname">딸기맛바나나킥 · 서울 남부 <span class="f_right list_date">12.21</span></p>
        </div>
      </div>
      <div class="community_list_body">
        <div class="community_list_item">
          <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
          <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
        </div>
      </div>
      <div class="community_action_area mt15"> 
        <span><img src="/images/ic_board_heart_off.png">150</span>
        <span><img src="/images/ic_board_chat.png">10</span>
        <span><img src="/images/ic_board_visibility.png">1,523</span>
      </div>
    </li>
    <?php }?>
  </ul>
</div>
<a href="#"><img src="/images/floating_top.png" class="top_floating top"></a>


<script>
var main_bn_1 = new Swiper(".main_bn_1", {
    pagination: {
      el: ".swiper-pagination",
    },
  });

// top
$( document ).ready( function() {
$( window ).scroll( function() {
    if ( $( this ).scrollTop() > 200 ) {
    $( '.top' ).fadeIn();
    } else {
    $( '.top' ).fadeOut();
    }
} );
$( '.top' ).click( function() {
    $( 'html, body' ).animate( { scrollTop : 0 }, 400 );
    return false;
} );
} );

</script>

