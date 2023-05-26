<header>
	<div class="main_header">
    <a class="btn_left" href="/<?=mapping('mypage')?>"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
    <h1 class="head_title">스크랩</h1>
	</div>
</header>
<ul class="tab_1">
  <li><a href="/<?=mapping('my_scrap')?>">게시글</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_trade">중고거래</a></li>
  <li class="active"><a href="/<?=mapping('my_scrap')?>/scrap_list_recruit">구인 공고</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_profile">구직 프로필</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_product">공동구매</a></li>
  <li><a href="/<?=mapping('my_scrap')?>/scrap_list_edu">교육</a></li>
</ul>


  <div class="no_data_box" style="display:none;">검색 결과가 없습니다. <br> 다시 검색해 주세요.</div>

  <ul class="recruit_list">
    </li>
    <?php for ($i=0; $i < 6; $i++) {?>
    <li>
      <div class="item_1">
        <b>플랫폼로캣티어</b>
        <span class="f_right"><img src="/images/ic_point_delete.png" alt="" class="w_24"></span>
      </div>
      <div class="mt10 mb10">
        <span class="recruit_mark">목공</span>
        <span class="txt_title">주안자이 아파트 신규 건설 신입 채용</span>
      </div>
      <div class="item_2"><img src="/images/ic_time.png" class="info_ic">~2023.05.01 <span class="point_color">(D-13)</span></div>
      <div class="item_2"><img src="/images/ic_pin.png" class="info_ic">인천<img src="/images/ic_sm_arrow.png" class="w_16 middle">미추홀구<p class="f_right fs_14 font_gray_f"><span class="point_color">일급</span> 18만원</p></div>
    </li>
    <?php }?>
</ul>


<script>
  $( '.search_cnt span' ).click( function() {
    $(this).toggleClass("on");
  } );
</script>