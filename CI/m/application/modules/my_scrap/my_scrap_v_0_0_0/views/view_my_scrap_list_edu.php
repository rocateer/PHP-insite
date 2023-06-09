<header>
	<div class="main_header">
    <a class="btn_left" href="/<?=mapping('mypage')?>"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <h1 class="head_title">스크랩</h1>
	</div>
</header>
<ul class="tab_1">
  <li><a href="/<?=mapping('my_scrap')?>">게시글</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_trade">중고거래</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_recruit">구인 공고</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_profile">구직 프로필</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_product">공동구매</a></li>
  <li class="active"><a href="/<?=mapping('my_scrap')?>/scrap_list_edu">교육</a></li>
</ul>


  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>
  <ul class="product_list" style="display:none1;">
    <li>
      <img class="btn_delete" src="/images/ic_point_delete.png" alt="">
      <div class="img_box relative">
        <a href="/<?=mapping('product')?>/product_detail">
          <img src="/p_images/s6.jpg">
        </a>
        <div class="dday">샷시</div>
      </div>
      <a href="/<?=mapping('product')?>/product_detail">
        <div class="product_list_body">
          <p class="product_list_title">'봄의 향' 심신안정 방향효과 인센스스틱</p>
          <div class="product_list_item">서울특별시 금천구
              <span class="point_color f_right">모집중</span>
          </div>
        </div>
      </a>
    </li>
    <li>
      <img class="btn_delete" src="/images/ic_point_delete.png" alt="">
      <div class="img_box relative">
        <a href="/<?=mapping('product')?>/product_detail">
          <img src="/p_images/s9.jpg">
        </a>
        <div class="dday">샷시</div>
      </div>
      <a href="/<?=mapping('product')?>/product_detail">
        <div class="product_list_body">
          <p class="product_list_title">친환경 포스트잇 처럼 쉽게 붙이고 떼는 벽지</p>
          <div class="product_list_item">서울특별시 금천구
              <span class="f_right font_gray_63">마감</span>
          </div>
        </div>
      </a>
    </li>
    <li> 
      <img class="btn_delete" src="/images/ic_point_delete.png" alt="">
      <div class="img_box relative">
        <a href="/<?=mapping('product')?>/product_detail">
          <img src="/p_images/s3.jpg">
        </a>
        <div class="dday">샷시</div>
      </div>
        <a href="/<?=mapping('product')?>/product_detail">
        <div class="product_list_body">
          <p class="product_list_title">온돌방 같은 쇼파 상상해 봤니? BONEST 히딩 쇼파</p>
          <div class="product_list_item">서울특별시 금천구
              <span class="point_color f_right">모집중</span>
          </div>
        </div>
      </a>
    </li>
   
  </ul>

