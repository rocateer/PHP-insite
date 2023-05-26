<header>
	<div class="main_header">
    <a class="btn_left" href="/<?=mapping('mypage')?>"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <h1 class="head_title">스크랩</h1>
	</div>
</header>
<ul class="tab_1">
  <li><a href="#">게시글</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_trade">중고거래</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_recruit">구인 공고</a></li>
  <li class="active"><a href="/<?=mapping('my_scrap')?>/scrap_list_profile">구직 프로필</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_product">공동구매</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_edu">교육</a></li>
</ul>


  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>
  <ul class="community_list" id="list_ajax">
    <li>
      <a href="/<?=mapping('recruit')?>/job_detail">
        <div class="community_list_head">
          <p class="txt_nickname">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right"><img src="/images/ic_point_delete.png" alt="" class="w_24"></span></p> 
        </div>
        <div class="community_list_body mt5">
          <div class="thum_img relative">
            <div class="img_box">
              <img src="/p_images/s3.jpg">
            </div>
            <div class="img_cnt_box">3</div>
          </div>
          <div class="community_list_item">
            <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
          </div>
        </div>
        <p class="mt15"><span class="point_color">일급</span> 30만원</p>
      </a>
    </li>
    <li>
      <a href="/<?=mapping('recruit')?>/job_detail">
        <div class="community_list_head">
          <p class="txt_nickname">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right"><img src="/images/ic_point_delete.png" alt="" class="w_24"></span></p>
        </div>
        <div class="community_list_body mt5">
          <div class="community_list_item">
            <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
          </div>
        </div>
        <p class="mt15"><span class="point_color">일급</span> 30만원</p>
      </a>
    </li>
  </ul>
</div>

<script>
  $( '.search_gnb_wrap li' ).click( function() {
    $('.search_gnb_wrap li').removeClass("active");
    $(this).addClass("active");
    // function
  } );
</script>