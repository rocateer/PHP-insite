
<div class="vh_wrap">

    <div class="vh_body complete_wrap">
       <img src="/images/ic_result_success.png">
       <h3 class="text_center">공동구매 신청 완료</h3>
       <div class="text_center font_gray_A0 mt20">입금 확인된 후 배송이 진행됩니다.<br><span class="b">“MY > 공구/교육 관리”</span> 에서 확인하실 수 있습니다.</div>   
    </div>
    <div class="vh_footer">
        <div class="account_box mt10">
            <p>인사이트</p>
            <p>국민은행  111-111-1111 <span class="fs_12 point_color"><img src="/images/ic_copy.png" class="ic_copy">복사</span></p>
        </div>
        <p class="txt_red mt10 fs_12">※ 빠른 입금 확인을 위해 예금주명과 연락처 뒤 4자리를 입력하여 입금해 주세요.</p>
        <div class="mt30 mb20">
            <a href="/<?=mapping('product')?>" class="btn_point_ghost btn_full_basic">목록으로 가기</a>
        </div>
    </div>

</div>



<!-- 입금안내 : s -->
<div class="modal_slide modal_slide_info">
    <div>
        <b>입금 안내</b>
        <div class="f_right"><img src="/images/head_btn_close_w.png" class="w_24" onclick="javascript:modal_close('info')"></div>
    </div>
    <div class="mt20">
     <img src="/p_images/s8.jpg" class="w_100p">
    </div>
</div>
<div class="md_slide_overlay md_slide_overlay_info" onclick="modal_close_slide('info')"></div>
<!-- 입금안내 : e -->

<script>
 // 모달 슬라이드
window.onload = function(){
  let md_slide_height;
	for(var i = 0; i<$('.modal_slide').length;i++){ // 각 모달의 높이 값만큼 -
	  md_slide_height = $('.modal_slide').eq(i).outerHeight();
	  $('.modal_slide').eq(i).css('bottom',-md_slide_height);
	} //모든 모달슬라이드 숨기기
}
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