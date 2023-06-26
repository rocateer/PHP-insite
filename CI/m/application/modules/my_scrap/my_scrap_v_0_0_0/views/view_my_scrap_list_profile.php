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
          <p class="txt_nickname font_gray_A0">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right"><img src="/images/ic_point_delete.png" alt="" class="w_24"></span></p> 
        </div>
        <div class="community_list_body mt0 relative">
          <div class="thum_img relative">
            <div class="img_box">
              <img src="/p_images/s3.jpg">
            </div>
            <div class="img_cnt_box">3</div>
          </div>
          <div class="community_list_item ">
            <p class="community_list_title2">언제나 준비되어 있는 노력하고 항상 발전하는 인재입니다. 제목이 길어졌을 때도 표현해봅니다.</p>
            <p class="mt15 bottom_txt"><span class="point_color">일급</span> 30만원</p>
          </div>
        </div>
        
      </a>
    </li>
    <li>
      <a href="/<?=mapping('recruit')?>/job_detail">
        <div class="community_list_head">
          <p class="txt_nickname font_gray_A0">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right"><img src="/images/ic_point_delete.png" alt="" class="w_24"></span></p>
        </div>
        <div class="community_list_body mt0 relative">
          <div class="community_list_item">
            <p class="community_list_title2">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="mt15 bottom_txt"><span class="point_color">일급</span> 30만원</p>
          </div>
        </div>
        
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