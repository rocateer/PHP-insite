<header>
	<div class="main_header">
    <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <input class="search_txt " type="text" placeholder="검색어를 입력해 주세요." value="아이폰">
		<a href="#"><img src="/images/btn_sm_delete.png" class="mr5"></a>
		<a href="#"><img src="/images/head_btn_search.png" class="main_search"></a>
	</div>
</header>
<ul class="tab_1">
  <li><a href="/<?=mapping('search')?>/search_list_community">게시글 <span>12,345</span></a></li>
  <li class="active"><a href="/<?=mapping('search')?>/search_list_trade">중고거래 <span>0</span></a></li>
  <li><a href="/<?=mapping('search')?>/search_list_product">공동구매 <span>12</span></a></li>
  <li><a href="/<?=mapping('search')?>/search_list_edu">교육 <span>7</span></a></li>
</ul>

<div class="search_list">
  <div class="search_cnt mt30">
    검색 결과 <span class="point_color">8</span>
    <p class="f_right on"> 판매중만 보기</p>
  </div>
  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>
  <ul class="trade_list" style="display:none1;">
    <li>
      <a href="/<?=mapping('community')?>/community_detail">
      <p class="txt_nickname">드림꿈드림 · 목공 · 서울 남부 <span class="f_right list_date">12.21</span></p>
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_con">아이폰 12pro 랑 에어팟 세트로 팝니다.</p>
          <p class="trade_list_price">100,000원 <span class="trade_state">예약</span></p>
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
      <a href="/<?=mapping('community')?>/community_detail">
      <p class="txt_nickname">딸기맛바나나킥 · 목공 · 서울 남부 <span class="f_right list_date">12.21</span></p>
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_con">아이폰 11pro(11프로) 사생활 보호 필름 2매입</p>
          <p class="trade_list_price">75,000원</p>
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
      <a href="/<?=mapping('community')?>/community_detail">
      <p class="txt_nickname">테헤란 · 서울 동부 <span class="f_right list_date">12.21</span></p>
      <div class="trade_list_body">
        <div class="thum_img">
          <div class="img_box"><img src="/p_images/s3.jpg"></div>
        </div>
        <div class="trade_list_item">
          <p class="trade_list_con">아이폰 11pro(11프로) 사생활 보호 필름 2매입</p>
          <p class="trade_list_price">50,000원 <span class="trade_state_end">거래 완료</span></p>
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
  $( '.search_cnt p' ).click( function() {
    $(this).toggleClass("on");
  } );
</script>