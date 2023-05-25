<header>
    <a class="btn_left" href="/<?=mapping('my_order')?>"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
    <h1>교육 신청 완료</h1>
</header>

<div class="body">
    <div class="inner_wrap">
        <!-- 상품 썸네일 : s -->
        <div class="product_view_box relative mt30">
        <span class="mark">삿시</span>
            <div class="product_view_img">
                <div class="img_box"><img src="/p_images/s2.jpg"></div>
            </div>
            <div class="product_view_info">
                <p class="txt_title">실내건축설계 디자인 캐드(Auto CAD), 스케치업 인테리어 제목이 길어지면 </p>
                <p class="fs_12 font_gray_A0 mt30">1차 2023.01.01 00:00</p>
            </div>
        </div>
        <!-- 상품 썸네일 : e -->
    </div>

    <div class="inner_wrap">
        <h5 class="mt30">취소 정보</h5>
        <table class="table_info mt30">
            <colgroup>
                <col width="80">
                <col width="*">
            </colgroup>
            <tr>
                <th>취소 신청</th>
                <td>2023.01.01 00:00</td>
            </tr>
            <tr>
                <th>취소 완료</th>
                <td>2023.01.03 00:00</td>
            </tr>
        </table>
    </div>
    <hr class="space mt30">

    <div class="inner_wrap">
        <h5 class="mt30">상품 정보</h5>
        <table class="table_info mt30">
            <colgroup>
                <col width="80">
                <col width="*">
            </colgroup>
            <tr>
                <th>교육 항목</th>
                <td>1차 2023.01.01 00:00</td>
            </tr>
            <tr>
                <th>교육 확정</th>
                <td>2023.01.03 00:00</td>
            </tr>
        </table>
    </div>
    <hr class="space mt30">

    <div class="inner_wrap">
        <h5 class="mt30">신청인 정보</h5>
        <table class="table_info mt30">
            <colgroup>
                <col width="80">
                <col width="*">
            </colgroup>
            <tr>
                <th>예금주명</th>
                <td>김공구</td>
            </tr>
            <tr>
                <th>연락처</th>
                <td>01012348585</td>
            </tr>
            <tr>
                <th>현금영수증</th>
                <td>01012348585</td>
            </tr>
        </table>
    </div>
    <hr class="space mt30">


    <div class="inner_wrap">
        <h5 class="mt30">환불 계좌 정보</h5>
        <table class="table_info mt30">
            <colgroup>
                <col width="80">
                <col width="*">
            </colgroup>
            <tr>
                <th>은행</th>
                <td>신한은행</td>
            </tr>
            <tr>
                <th>예금주명</th>
                <td>김공구</td>
            </tr>
            <tr>
                <th>계좌번호</th>
                <td>01012348585</td>
            </tr>
        </table>
    </div>
    <hr class="space mt30">
    <div class="inner_wrap">
        <h5 class="mt30">결제정보</h5>
        <div class="view_price mt30">
            결제금액
            <span>175,200원</span>
        </div>
        <div class="view_price mt30">
            예약금
            <span>175,200원</span>
        </div>
    </div>
    <div class="inner_wrap">
        <div class="txt_right fs_12 mt30" onclick="modal_open_slide('info')">
            <img src="/images/ic_info.png" class="w_16 middle">
            입금 안내
        </div>
        <div class="account_box mt10">
            <p>인사이트</p>
            <p>국민은행  111-111-1111 <span class="fs_12 point_color"><img src="/images/ic_copy.png" class="ic_copy">복사</span></p>
        </div>
        <p class="txt_red mt10 fs_12">※ 빠른 입금 확인을 위해 예금주명과 연락처 뒤 4자리를 입력하여 입금해 주세요.</p>
        <div class="mt30 pdb30">
            <a href="#" class="btn_point btn_full_basic">교육 취소 신청</a>
        </div>
    </div>  
    
</div>


<!-- 입금안내 : s -->
<div class="modal_slide modal_slide_info">
    <div>
        <b>입금 안내</b>
        <div class="f_right"><img src="/images/head_btn_close_w.png" class="w_24" onclick="javascript:modal_close_slide('info')"></div>
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