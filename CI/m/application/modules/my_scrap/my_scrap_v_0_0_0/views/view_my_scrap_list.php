<header>
	<div class="main_header">
    <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <h1 class="head_title">스크랩</h1>
	</div>
</header>
<ul class="tab_1">
  <li class="active"><a href="/<?=mapping('my_scrap')?>">게시글</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_trade">중고거래</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_recruit">구인 공고</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_profile">구직 프로필</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_product">공동구매</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_edu">교육</a></li>
</ul>


  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>
  <ul class="community_list" style="display:none1;">
    <li>
      <img class="btn_delete" src="/images/ic_point_delete.png" alt="">
      <a href="/<?=mapping('community')?>/community_detail">
      <div class="community_list_head">
        <img src="/images/ic_cate_2.png" class="list_cate_img">
        <div class="right_area">
          <p class="txt_cate">자유공간</p>
          <p class="txt_nickname">딸기맛바나나킥 · 서울 남부 <span class="f_right list_date">12.21</span></p>
        </div>
      </div>
      <div class="community_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s9.jpg"></div>
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
      </a>
    </li>
    <li>
      <img class="btn_delete" src="/images/ic_point_delete.png" alt="">
      <a href="/<?=mapping('community')?>/community_detail">
      <div class="community_list_head">
        <img src="/images/ic_cate_3.png" class="list_cate_img">
        <div class="right_area">
          <p class="txt_cate">자유공간</p>
          <p class="txt_nickname">딸기맛바나나킥 · 서울 남부 <span class="f_right list_date">12.21</span></p>
        </div>
      </div>
      <div class="community_list_body">
       <!-- <div class="thum_img">
          <div class="img_box"><img src="/p_images/s6.jpg"></div>
        </div> -->
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
      </a>
    </li>
    <?php for ($i=0; $i < 3; $i++) {?>
    <li>
      <img class="btn_delete" src="/images/ic_point_delete.png" alt="">
      <a href="/<?=mapping('community')?>/community_detail">
      <div class="community_list_head">
        <img src="/images/ic_cate_3.png" class="list_cate_img">
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
      </a>
    </li>
    <?php }?>
  </ul>


<script>
  $( '.search_gnb_wrap li' ).click( function() {
    $('.search_gnb_wrap li').removeClass("active");
    $(this).addClass("active");
    // function
  } );
</script>