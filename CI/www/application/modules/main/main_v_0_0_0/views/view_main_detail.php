<style media="screen">
.main_popup{border-radius: 14px 14px 0px 0px;width: 100%;overflow: hidden;height:351px; position: absolute; z-index: 200;bottom:0; left:50%; transform: translate(-50%,0); max-height: calc(100vh - 120px);}
.main_popup .img_box{width: 100%;height: 100%;}
.popup_bottom{z-index: 200;overflow: hidden; background: #fff;width: 100%; height: 44px; line-height: 44px; position: absolute; bottom:0;}
.popup_bottom .today_close{cursor: pointer;font-size: 14px;color:#464646;margin-left: 20px;}
.popup_bottom a.close{color: #000;float: right;margin-right: 20px;font-family: 'font-b'}
.main_popup_dim{top:0;left:0;width: 100%; height: 100%; background: rgba(0,0,0,0.4); position: absolute; z-index: 99;}
</style>
<!-- s_pop : s -->
<div id="main_popup" class="main_popup">
	<div class="img_box">
  	<img src="/p_images/s1.png">
	</div>
	<div class="popup_bottom">
		<input type="checkbox" id="chk_0" name="chk_0">
		<label onclick="todayClosePopup();" for="chk_0" class="today_close"><span></span> 오늘 하루 보지 않기</label>
		<a href="javascript:closePopup();" class="close">닫기</a>
	</div>
</div>
<div class="main_popup_dim" id="main_popup_dim"></div>
<!-- s_pop : e -->
<div class="view_main row">

  <div class="visual_swiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <a href="/<?=mapping('news')?>/news_detail">
          <div class="img_box">
            <img src="/p_images/s3.png" alt="">
          </div>
        </a>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s2.png" alt="">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s1.png" alt="">
        </div>
      </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="custom_pagination"><span class="stop">01</span><span class="total">05</span></div>
  </div>
  <div class="inner_wrap">
    <div class="title">지구와 공생하는 기업</div>
    <h3>어떤 제품을 살지 모르겠다면?</h3>
  </div>

  <div class="main_swiper1">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/p1.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">12</b>
          </div>
          <h5 class="text_overflow">bean works</h5>
          <p class="fs_16 text_overflow">당신이 자른 것이 당신이 얻는 것</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/p2.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">112</b>
          </div>
          <h5 class="text_overflow">La dens</h5>
          <p class="fs_16 text_overflow">트랜디함을 살린 업사이클링 제품</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/p3.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">112</b>
          </div>
          <h5 class="text_overflow">록시땅</h5>
          <p class="fs_16 text_overflow">산소 같은 여자</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/s3.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">8889</b>
          </div>
          <h5 class="text_overflow">록시땅</h5>
          <p class="fs_16 text_overflow">산소 같은 여자</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/p4.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">8889</b>
          </div>
          <h5 class="text_overflow">록시땅</h5>
          <p class="fs_16 text_overflow">산소 같은 여자</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/p5.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">8889</b>
          </div>
          <h5 class="text_overflow">록시땅</h5>
          <p class="fs_16 text_overflow">산소 같은 여자</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/s6.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">8889</b>
          </div>
          <h5 class="text_overflow">록시땅</h5>
          <p class="fs_16 text_overflow">산소 같은 여자</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="/<?=mapping('corp')?>/corp_detail">
          <div class="img_box">
            <img src="/p_images/s1.png" alt="">
          </div>
          <div class="font_gary_9 mt20">판매 상품
            <b class="point_color">1</b>
          </div>
          <h5 class="text_overflow">록시땅</h5>
          <p class="fs_16 text_overflow">산소 같은 여자</p>
        </a>
      </div>
    </div>
  </div>

  <div class="inner_wrap">
    <div class="title">지구와 공생하는 기업</div>
    <h3>어떤 제품을 살지 모르겠다면?</h3>
  </div>

  <div class="main_swiper2">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <a href="/<?=mapping('news')?>/news_detail">
          <div class="img_box">
            <img src="/p_images/s3.png" alt="">
          </div>
        </a>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s2.png" alt="">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s1.png" alt="">
        </div>
      </div>
    </div>
  </div>

  <div class="plan_title">가을 맞이 할인 상품</div>
  <div class="plan_sub_title">골칫거리 쓰레기가 아닌 자원으로, 플라스틱 업사이클링 브랜드입니다.</div>

  <div class="inner_wrap">
    <div class="title">지구와 공생하는 기업</div>
    <h3>어떤 제품을 살지 모르겠다면?</h3>
  </div>


  <div class="main_swiper2">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <a href="/<?=mapping('news')?>/news_detail">
          <div class="img_box">
            <img src="/p_images/s3.png" alt="">
          </div>
        </a>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s2.png" alt="">
        </div>
      </div>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="/p_images/s1.png" alt="">
        </div>
      </div>
    </div>
  </div>

  <div class="inner_wrap">
    <div class="title">시닙이 어서오고</div>
    <h3>오늘 신입은 누구인가?</h3>

    <ul class="main_new_ul">
      <li>
        <a href="">
          <div class="img_box">
            <img src="/p_images/s1.png" alt="">
          </div>
        </a>
      </li>
    </ul>
  </div>


</div>
<script type="text/javascript">
var slideTotalNum = $('.visual_swiper .swiper-slide').length;
$('.custom_pagination').find('span.total').html('0' + Number(Number(slideTotalNum)));

var visual_swiper = new Swiper(".visual_swiper", {
  slidesPerView: 1,
  centeredSlides: true,
  on: {
    activeIndexChange: function () {
      $('.custom_pagination').find('span.stop').html('0' + Number(Number(this.realIndex)+1));
    }
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

var main_swiper1 = new Swiper(".main_swiper1", {
  slidesPerView: 'auto',
  spaceBetween: 28,
});


var main_swiper2 = new Swiper(".main_swiper2", {
  slidesPerView: 'auto',
  spaceBetween: 28,
  centeredSlides: true,
});


var main_bn = new Swiper(".main_bn", {
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});
// 쿠키 만들기
function setCookie(name, value, expiredays) {
	var today = new Date();
  today.setDate(today.getDate() + expiredays);
  document.cookie = name + '=' + escape(value) + '; path=/; expires=' + today.toGMTString() + ';'
}
//하루동안 닫기
function todayClosePopup(){
  setCookie('notToday','Y', 1);
    $("#main_popup").css("display" ,"none");
    $("#main_popup_dim").css("display" ,"none");
    $('html, body, .wrap').css({
      height: "",
      overflow: ""
    });
}
// 그냥닫기
function closePopup(){

  $("#main_popup").css("display" ,"none");
  $("#main_popup_dim").css("display" ,"none");
  $('html, body, .wrap').css({
    height: "",
    overflow: ""
  });

}
// 쿠키 가져오기
function getCookie(name){
  var cName = name + "=";
  var x = 0;
	var i = 0;
  while ( i <= document.cookie.length ){
    var y = (x+cName.length);
    if ( document.cookie.substring( x, y ) == cName ){
      if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
        endOfCookie = document.cookie.length;
      return unescape( document.cookie.substring( y, endOfCookie ) );
    }
    x = document.cookie.indexOf( " ", x ) + 1;
    if ( x == 0 )
    break;
  }
  return "";
}
// 사용
$(function(){
  if(getCookie("notToday")!="Y"){
		$("#main_popup").css("display" ,"block");
		$("#main_popup_dim").css("display" ,"block");
		$('html, body, .wrap').css({
	    height: "100%",
	    overflow: "hidden"
	  });
	}else{
		$("#main_popup").css("display" ,"none");
		$("#main_popup_dim").css("display" ,"none");
	}
});
</script>
