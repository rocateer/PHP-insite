<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>지원자</h1>
</header>

<div class="body">
  <div class="no_data">
    <p><span class="message_box">지원자가 없습니다.</span></p>
  </div>

  <ul class="community_list" id="list_ajax">
    <li>
      <a href="/<?=mapping('recruit')?>/job_detail">
        <div class="community_list_head">
          <p class="txt_nickname">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right list_date">15:11</span></p>
          
        </div>
        <div class="community_list_body">
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
          <p class="txt_nickname">딸기맛바나나킥1 · 목공 · 서울 남부 <span class="f_right list_date">15:11</span></p>
        </div>
        <div class="community_list_body">
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








<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)">삭제</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->

<script>
// 모달 슬라이드
window.onload = function(){
  let md_slide_height;
	for(var i = 0; i<$('.modal_slide').length;i++){ // 각 모달의 높이 값만큼 -
	  md_slide_height = $('.modal_slide').eq(i).outerHeight();
	  $('.modal_slide').eq(i).css('bottom',-md_slide_height);
	} //모든 모달슬라이드 숨기기
}
//
function modal_open_slide(element){
	$(".md_slide_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 200);
	$(".modal_slide_" + element).animate({bottom: 0},200);
	$.lockBody();
}

function modal_close_slide(element){
  md_slide_height2 = $(".modal_slide_" + element).outerHeight();
	$(".md_slide_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 200);
	$(".modal_slide_" + element).animate({bottom: -md_slide_height2},200);
	$.unlockBody();
}
</script>