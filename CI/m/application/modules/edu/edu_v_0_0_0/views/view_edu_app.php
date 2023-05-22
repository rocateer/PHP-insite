<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>교육 신청</h1>
</header>

<div class="body">

    <div class="inner_wrap">
        <!-- 상품 썸네일 : s -->
        <div class="product_view_box mt30">
            <div class="product_view_img">
                <div class="img_box"><img src="/p_images/s3.jpg"></div>
            </div>
            <div class="product_view_info">
                <span class="mark">삿시</span>
                <p class="txt_title mt20">23SS 꼼데가르송 컨버스 척테일러 1970S 블랙로우 스니커즈 블랙로우 스니커즈</p>
            </div>
        </div>
        <!-- 상품 썸네일 : e -->

        <h5 class="mt30">교육 정보</h5>
        <ul class="input_ui row mt20">
            <li>
                <label>항목 선택<span class="essential">*</span></label>
                <div class="radio_select">
                    <input type="radio" id="radio_0" name="radio" checked="">
                    <label for="radio_0" class="mr15"><span></span>1차 2023.01.01 00:00<p>5/20명</p></label>

                    <input type="radio" id="radio_1" name="radio">
                    <label for="radio_1" class="mr15"><span></span>2차 2023.01.01 00:00<p>5/20명</p></label>

                    <input type="radio" id="radio_2" name="radio" disabled>
                    <label for="radio_2" class="mr15"><span></span>3차 2023.01.01 00:00<p>20/20명</p></label>
                </div>
            </li>
            <li>
                <label>교육 받는 분<span class="essential">*</span></label>
                <input type="text" id="" name="" placeholder="교육 받으시는 분의 이름을 입력해 주세요.">
            </li>
            <li>
                <label>연락처<span class="essential">*</span></label>
                <input type="tel" id="" name="" placeholder="교육 받으시는 분의 연락처를 입력해 주세요.">
            </li>
            <li>
                <label>예금주명<span class="essential">*</span></label>
                <p class="fs_12 font_gray_63">빠른 입금 확인을 위해 예금주명과 연락처 뒤 4자리를 입력하여 입금해 주세요.</p>
                <input type="text" id="" name="" placeholder="송금하실 계좌의 예금주명을 입력해 주세요.">
            </li>
            <li>
                <label>현금영수증<span class="essential">*</span></label>
                <p class="fs_12 font_gray_63">현금영수증 발급을 원하시는 경우, 휴대폰번호 또는 현금영수증 전용 카드 번호를 입력해주세요.</p>
                <input type="text" id="" name="" placeholder="">
            </li>
        </ul>
    </div>
    <hr class="space">
    <div class="inner_wrap">
        <h5 class="mt30">환불 계좌 정보</h5>
        <ul class="input_ui row mt20">
            <li>
                <label>은행<span class="essential">*</span></label>
                <select>
                    <option>은행을 선택해 주세요.</option>
                </select>
            </li>
            <li>
                <label>예금주명<span class="essential">*</span></label>
                <input type="text" id="" name="" placeholder="">
            </li>
            <li>
                <label>계좌번호<span class="essential">*</span></label>
                <input type="text" id="" name="" placeholder="">
            </li>
        </ul>
    </div>
    <hr class="space">
    <div class="inner_wrap">

        <h5 class="mt30">교육 신청 예약금</h5>

        <div class="view_price mt30">
            결제금액
            <span>175,200원</span>
        </div>

        <div class="txt_right fs_12 mt30" onclick="modal_open_slide('info')">
            <img src="/images/ic_info.png" class="w_16 middle">
            입금 안내
        </div>
        <div class="account_box mt10">
            <p>인사이트</p>
            <p>국민은행  111-111-1111 <span class="fs_12 point_color"><img src="/images/ic_copy.png" class="ic_copy">복사</span></p>
        </div>

        <div class="mt30 pdb30">
            <a href="/<?=mapping('edu')?>/edu_app_complete" class="btn_point btn_full_basic">신청하기</a>
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