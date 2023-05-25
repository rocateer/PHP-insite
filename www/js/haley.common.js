//요일명 지정
moment.locale('ko', {
  weekdaysShort: ["일","월","화","수","목","금","토"]
});

//세자리마다 콤마 넣기
function addComma(num) {
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//콤마 제거
function removeComma(str) {
  str = String(str);
  return str.replace(/[^\d]+/g, '');
}

// custom alert창 open
function rd_alert_open(contents, heading){
  $(".alert_con").html(contents);
  $(".alert_head").html(heading);
  $(".rd_alert_overlay").css("visibility", "visible").animate({opacity: 1}, 100);
  $(".rd_alert").addClass("open");
  $.lockBody();
}

// custom alert창 close
$(document).on("click", ".rd_alert .btn_modal a, .rd_alert_overlay", function(){
  $(".rd_alert_overlay").css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".rd_alert").removeClass("open");
  $.unlockBody();
});


//basic_modal-------------------------------------------------------------------------------------

function modal_open(element){
  $(".md_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 100);
  $(".madal_" + element).css({display: "block"});
}

function modal_close(element){
  $(".md_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".madal_" + element).css({display: "none"});
}

//------------------------------------------------------------------------------------------


//모달 백그라운드 스크롤 막기
var scrollTop;

$.lockBody = function() {

  if(window.pageYOffset) {
    scrollTop = window.pageYOffset;
    $(".wrap").css({
      top: - (scrollTop)
    });
  }

  $('html, body').css({
    height: "100%",
    overflow: "hidden"
  });
};

$.unlockBody = function() {
  $('html, body').css({
    height: "",
    overflow: ""
  });

  $(".wrap").css({
    top: ''
  });

  window.scrollTo(0, scrollTop);
  window.setTimeout(function () {
    scrollTop = null;
  }, 0);

};

//스크롤 방향에 따라 헤더 변경
(function () {
  var lastScrollTop = 0,
      delta = 15;
  $(window).scroll(function (event) {
    var st = $(this).scrollTop();
    if (Math.abs(lastScrollTop - st) <= delta) return;
    if ((st > lastScrollTop) && (lastScrollTop > 0)) { //스크롤
      $("header").addClass("scroll");
      $(".scroll_top").removeClass("back");
    } else { //백스크롤
      $("header").removeClass("scroll");
      if($(this).scrollTop() > delta){
        $(".scroll_top").addClass("back");
      } else {
        $(".scroll_top").removeClass("back");
      }
    }
    lastScrollTop = st;

  });
})();
