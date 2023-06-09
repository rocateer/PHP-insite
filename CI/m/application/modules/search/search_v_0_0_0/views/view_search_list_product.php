<header>
	<div class="main_header">
    <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <input class="search_txt" type="text" placeholder="검색어를 입력해 주세요." value="아이폰" id="search_input">
		<a href="#"><img src="/images/btn_sm_delete.png" class="mr5 btn_del"></a>
		<a href="#"><img src="/images/head_btn_search.png" class="main_search"></a>
	</div>
</header>
<ul class="tab_1">
  <li><a href="/<?=mapping('search')?>/search_list_community">게시글 <span>12,345</span></a></li>
  <li><a href="/<?=mapping('search')?>/search_list_trade">중고거래 <span>0</span></a></li>
  <li class="active"><a href="/<?=mapping('search')?>/search_list_product">공동구매 <span>12</span></a></li>
  <li><a href="/<?=mapping('search')?>/search_list_edu">교육 <span>7</span></a></li>
</ul>

<div class="search_list">
  <div class="search_cnt mt30">
    검색 결과 <span class="point_color">8</span>
    <p class="f_right ease"> 진행중만 보기</p>
  </div>
  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>
  <ul class="product_list mt20" style="display:none1;">
    <li>
      <span class="mark">D-11</span>
      <div class="scrap ease"></div>
      <a href="/<?=mapping('product')?>/product_detail">
        <div class="img_box relative">
            <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">'봄의 향' 심신안정 방향효과 인센스스틱</p>
          <div class="product_list_item">
            공동구매가 <b class="font_gray_f">75,000원</b>
            <span class="point_color f_right">80% 달성</span>
          </div>
        </div>
      </a>
    </li>
    <li>
      <span class="mark">D-1</span>
      <div class="scrap on ease"></div>
      <a href="/<?=mapping('product')?>/product_detail">
        <div class="img_box relative">
          <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">친환경 포스트잇 처럼 쉽게 붙이고 떼는 벽지</p>
          <div class="product_list_item">
            공동구매가 <b class="font_gray_f">75,000원</b>
            <span class="point_color f_right">80% 달성</span>
          </div>
        </div>
      </a>
    </li>
    <li>
      <span class="mark">마감</span>
      <div class="scrap ease"></div>
      <a href="/<?=mapping('product')?>/product_detail">
        <div class="img_box relative">
            <img src="/p_images/s3.jpg">
        </div>
        <div class="product_list_body">
          <p class="product_list_title">온돌방 같은 쇼파 상상해 봤니? BONEST 히딩 쇼파</p>
          <div class="product_list_item">
            공동구매가 <b class="font_gray_f">75,000원</b>
            <span class="point_color f_right">80% 달성</span>
          </div>
        </div>
      </a>
    </li>
   
  </ul>
</div>

<script>
  $( '.search_cnt p' ).click( function() {
    $(this).toggleClass("on");
  } );

  $( '.img_box .scrap' ).click( function() {
    $(this).toggleClass("on");
  } );

//검색어 삭제
$('.btn_del').click(function(){
$('#search_input').val('');
$('#search_input').focus();
})
</script>