<header>
	<div class="main_header">
    <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <input class="search_txt" type="text" placeholder="검색어를 입력해 주세요." value="아이폰" id="search_input">
		<a href="#"><img src="/images/btn_sm_delete.png" class="mr5 btn_del"></a>
		<a href="#"><img src="/images/head_btn_search.png" class="main_search"></a>
	</div>
</header>
<ul class="tab_1">
  <li class="active"><a href="/<?=mapping('search')?>/search_list_community">게시글 <span>12,345</span></a></li>
  <li><a href="/<?=mapping('search')?>/search_list_trade">중고거래 <span>0</span></a></li>
  <li><a href="/<?=mapping('search')?>/search_list_product">공동구매 <span>12</span></a></li>
  <li><a href="/<?=mapping('search')?>/search_list_edu">교육 <span>7</span></a></li>
</ul>

<ul class="community_category">
  <li><img src="/images/ic_cate_1.png"> 자유공간</li>
  <li><img src="/images/ic_cate_2.png"> 인사이트</li>
  <li><img src="/images/ic_cate_3.png"> 비밀공간</li>
</ul>

<div class="search_list">
  <div class="search_cnt mt20">검색 결과  <span class="point_color">12,345</span></div>
  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>
  <ul class="community_list" style="display:none1;">
    <li>
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
    <li>
      <a href="/<?=mapping('community')?>/community_detail">
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
      </a>
    </li>
    <?php for ($i=0; $i < 3; $i++) {?>
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

<script>
  $( '.search_gnb_wrap li' ).click( function() {
    $('.search_gnb_wrap li').removeClass("active");
    $(this).addClass("active");
    // function
  } );

//검색어 삭제
$('.btn_del').click(function(){
$('#search_input').val('');
$('#search_input').focus();
})
</script>