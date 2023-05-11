<header>
	<div class="main_header">
    <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <h1 class="head_title">스크랩</h1>
	</div>
</header>
<ul class="search_gnb_wrap">
  <li><a href="/<?=mapping('my_scrap')?>">게시글</a></li>
  <li class="active"><a href="/<?=mapping('my_scrap')?>/scrap_list_trade">중고거래</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_job">구인 공고</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_profile">구직 프로필</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_product">공동구매</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_study">교육</a></li>
</ul>

<div class="search_list">
  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>
  <ul class="trade_list" style="display:none1;">
    <li>
      <img class="btn_close" src="/images/head_btn_close.png" alt="">
      <a href="/<?=mapping('community')?>/community_detail">
      <p class="txt_nickname">드림꿈드림 · 목공 · 서울 남부 
        <span class="f_right list_date">12.21</span></p>
        <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_con">아이폰 12pro 랑 에어팟 세트로 팝니다.</p>
          <p class="trade_list_price">100,000원 
            <span class="trade_state">예약</span>
          </p>
          <div class="trade_action_area mt10"> 
            <span><img src="/images/ic_board_heart_off.png">150</span>
            <span><img src="/images/ic_board_chat.png">10</span>
            <span><img src="/images/ic_board_visibility.png">1,523</span>
          </div>
        </div>
      </div>
      </a>
    </li>
    <li>
      <img class="btn_close" src="/images/head_btn_close.png" alt="">
      <a href="/<?=mapping('community')?>/community_detail">
      <p class="txt_nickname">딸기맛바나나킥 · 목공 · 서울 남부 <span class="f_right list_date">12.21</span></p>
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s8.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_con">아이폰 11pro(11프로) 사생활 보호 필름 2매입</p>
          <p class="trade_list_price">75,000원
            <!-- <span class="trade_state_end">거래 완료</span> -->
          </p>
          <div class="trade_action_area mt10"> 
            <span><img src="/images/ic_board_heart_off.png">150</span>
            <span><img src="/images/ic_board_chat.png">10</span>
            <span><img src="/images/ic_board_visibility.png">1,523</span>
          </div>
        </div>
      </div>
      </a>
    </li>
    <?php for ($i=0; $i < 3; $i++) {?>
    <li>
      <img class="btn_close" src="/images/head_btn_close.png" alt="">
      <a href="/<?=mapping('community')?>/community_detail">
      <p class="txt_nickname">딸기맛바나나킥 · 목공 · 서울 남부 <span class="f_right list_date">12.21</span></p>
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s4.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_con">아이폰 11pro(11프로) 사생활 보호 필름 2매입</p>
          <p class="trade_list_price">75,000원
             <span class="trade_state_end">거래 완료</span>
          </p>
          <div class="trade_action_area mt10"> 
            <span><img src="/images/ic_board_heart_off.png">150</span>
            <span><img src="/images/ic_board_chat.png">10</span>
            <span><img src="/images/ic_board_visibility.png">1,523</span>
          </div>
        </div>
      </div>
      </a>
    </li>
    <?php }?>
  </ul>
</div>

<script>
  $( '.search_cnt span' ).click( function() {
    $(this).toggleClass("on");
  } );
</script>