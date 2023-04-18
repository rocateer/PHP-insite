<header>
  <div class="btn_back" onclick="COM_history_back_fn()">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
    내 커뮤니티
  </h1>
</header>
<div class="body view_community footer_margin inner_wrap">
  <div class="">
    <ul class="tab_toggle_menu clearfix">
      <li class="active"  id="li_0" onclick="set_board_type('0');">
        이브의 고민
      </li>
      <li class="" id="li_1" onclick="set_board_type('1');">
        오늘의 운동 완료
      </li>
    </ul>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">
        <div class="no_data" id="no_data_0" style="display:none;">
          <p>작성한 게시물이 없습니다.</p>
        </div>

        <ul class="community_ul0" id="list_ajax_0"></ul>

      </div>
      <!-- 탭 영역 1 : e -->
      <!-- 탭 영역 2 : s -->
      <div class="">
        <div class="no_data" id="no_data_1" style="display:none;">
          <p>작성한 게시물이 없습니다.</p>
        </div>
        <ul class="mb20_ul mt20 today_board" id="list_ajax_1">
        </ul>

      </div>
      <!-- 탭 영역 2 : e -->
    </div>
  </div>
</div>
<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)" onclick="board_mod_up();">수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="default_del();">삭제</a>
    </li>
  </ul>
  <ul class="close">
    <li>
      <a href="javascript:modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->


<input type="text" name="total_block" id="total_block" value="1" style="display:none">
<input type="text" name="board_type" id="board_type" value="0" style="display:none">
<input type="text" name="board_idx" id="board_idx" value="0" style="display:none">
<input type="text" name="scrollPosition" id="scrollPosition" value="0" style="display:none">

<script>
  var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".swiper-pagination",
      dynamicBullets: true,
    },
  });

  function text_all_view(e) {
    const siblings = e.previousElementSibling;
    e.style.display = 'none';
    siblings.style.display = 'block';
  }

  var best_swiper = new Swiper('.best_swiper', {
    slidesPerView: 1.1,
    spaceBetween: 20,
  });
  // 3줄 이하 체크
  let board_cnt = $('.contents_txt').length;
  for (var i = 0; i < board_cnt; i++) {
    let contents_txt = $('.today_board > li').eq(i).find('#today_contents_txt').height();
    if (contents_txt > 90) {} else {
      $('.today_board > li').eq(i).find('#button_today').hide();
    }
  }
</script>

<script type="text/javascript">

// 탭메뉴 토글기능
// $(document).ready(function() {
// 	$(".tab_area_wrap > div").hide();
// 	$(".tab_area_wrap > div").first().show();
// 	$(".tab_toggle_menu li").click(function() {
// 		var list = $(this).index();
// 		$(".tab_toggle_menu li").removeClass("active");
// 		$(this).addClass("active");

// 	});
// });

</script>


<script type="text/javascript">
var page_num=1;
var scrollchk =true;//스크롤 체크
var mutex = false;//lock 

//탭클릭시
function set_board_type(str){
  page_num=1; 
  scrollchk =true;
  mutex = false;

  $(".tab_toggle_menu li").removeClass("active");

  if(str==0){
    $('#li_0').addClass("active");
  }else if(str==1){
    $('#li_1').addClass("active");
  }

  $("#board_type").val(str);
  $("#list_ajax_0").html("");
  $("#list_ajax_1").html("");
  
  page_ui_setting(str);
  default_list_get();
}

//카테고리 세팅
function set_board_idx(board_idx){
  $("#board_idx").val(board_idx);
  modal_open_slide('more');
}

// //카테고리 세팅
// function set_orderby(){
//   page_num=1; 
//   scrollchk =true;
//   mutex = false; 

//   default_list_get();
// }

//페이지::ui세팅
function page_ui_setting(str){

  $("#li_0").removeClass("active");
  $("#li_1").removeClass("active");
  $(".no_data").css("display","none");

  if(str =="0"){
    $("#best_0").css("display","block");
    $("#category_0").css("display","block");
    $(".tab_area_wrap > div").first().show();
    $(".tab_area_wrap > div").last().hide();

    $("#li_0").addClass("active");

  }else{
    $("#best_0").css("display","none");
    $("#category_0").css("display","none");
    $(".tab_area_wrap > div").first().hide();
    $(".tab_area_wrap > div").last().show();

    $("#li_1").addClass("active");
  }
}

//페이지 스크롤시
$(window).scroll(function(){

  var $window = $(this);
  var scrollTop = $window.scrollTop();
  var windowHeight = $window.height();
  var documentHeight = $(document).height();

  if(scrollchk){
    if( scrollTop  + windowHeight >= documentHeight){    
      if(mutex){
        return;
      }        
      mutex = true ;
      default_list_get();
    } 
  }  
});

function default_list_get(){
  var board_type = $("#board_type").val();

  var formData = {
		'page_num' : page_num,
		'board_type' : board_type
	}; 

	$.ajax({
		url      : "/<?=mapping('my_community')?>/my_community_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {  
   
      if(result.length <10){
        mutex = true;
        scrollchk = false;
        $("#list_ajax_"+board_type).html('');
       
        return;
      }else{

        if(page_num == 1){
          $("#list_ajax_"+board_type).html(result);
        }else{
          $("#list_ajax_"+board_type).append(result);
          $(".float"+board_type).css("display","block");
        }  
      }      
		}
	});
}

//상세보기
function detail_url(url){
  var scrollHeightPosition = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
  $("#scrollPosition").val(scrollHeightPosition);
  
  location.href=url;
} 


//페이지 저장
function page_save(event){
  var state ={'list_data_0':$("#list_ajax_0").html() ,'list_data_1':$("#list_ajax_1").html(),current_page:page_num};
  history.replaceState(state, '', '/<?=mapping('my_community')?>/my_community_list');
}


//페이지 로딩
function page_load(event){
  //ui 세팅
  page_ui_setting( $('#board_type').val());

  if ((window.performance && window.performance.navigation.type == 2)){

    if (history.state){
      var data = history.state;
      $("#list_ajax_0").html(data.list_data_0);      
      $("#list_ajax_1").html(data.list_data_1);  

      page_num =  data.current_page;   
    } 
   // $('html, body').animate({scrollTop : $("#scrollPosition").val()});
    window.scroll(0, $("#scrollPosition").val());

    //scrollchk = true;
	  mutex = false;
  }else{

    default_list_get();
  }
}

$(function(){
  setTimeout("page_load(event)", 10);
});

function like_reg_in(board_idx){

$.ajax({
  url      : "/<?=mapping('community')?>/like_reg_in",
  type     : "POST",
  dataType : "json",
  async    : true,
  data     : {
    'board_idx':board_idx
  },
  success: function(result) {
    // -1:유효성 검사 실패
    if(result.code == '-1'){
      alert(result.code_msg);
      $("#"+result.focus_id).focus();
      return;
    }
    // 0:실패 1:성공
    if(result.code == 0) {
      alert(result.code_msg);
    } else if(result.code == 1) {
      $("#like_cnt_"+board_idx).html(result.like_cnt);
      // alert(result.code_msg);
      // location.reload();
    }
  }
});
}

//수정
function board_mod_up(){
  var board_idx = $('#board_idx').val();

  location.href ="/<?=mapping('community')?>/community_mod?board_idx="+board_idx;
}

// 삭제
function default_del(){
  var board_idx = $('#board_idx').val();

  if(!confirm("삭제 하시겠습니까?")){
      return;
    }

  $.ajax({
      url      : "/<?=mapping('community')?>/community_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        'board_idx':board_idx
      },
      success : function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        }else {
          alert(result.code_msg);
          modal_close_slide('more');
          location.reload();
        }
      }
  });

}

</script>
