<header>
  <div class="btn_back" onclick="COM_history_back_fn()">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
  스크랩
  </h1>
</header>
<div class="body footer_margin inner_wrap">
  <div class="">
    <ul class="tab_toggle_menu clearfix" id="type" onchange="">
      <li class="active" id="li_0" onclick="set_scrap_type('0');"> 
      프로그램
      </li>
      <li class="" id="li_1" onclick="set_scrap_type('1');">
      매거진
      </li>
    </ul>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">
        <div class="no_data" id="no_data_0" style="display: none;">
          <p>스크랩 된 프로그램이 없습니다.</p>
        </div>
        <ul class="my_scrap_ul" id="list_ajax_0"></ul>

      </div>
      <!-- 탭 영역 1 : e -->
      <!-- 탭 영역 2 : s -->
      <div class="">
        <div class="no_data" id="no_data_1"  style="display: none;">
          <p>스크랩 된 매거진이 없습니다.</p>
        </div>
        <ul class="my_scrap_ul" id="list_ajax_1"></ul>
   
      </div>
      <!-- 탭 영역 2 : e -->
    </div>
  </div>
</div>
<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)">스케줄 수정</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more')">삭제</a>
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

<input type="text" name="scrap_type" id="scrap_type" value="0" style="display:none">

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

var page_num=1;
var scrollchk =true;//스크롤 체크
var mutex = false;//lock 

//탭클릭시
function set_scrap_type(str){
  page_num=1; 
  scrollchk =true;
  mutex = false;

  $(".tab_toggle_menu li").removeClass("active");

  if(str==0){
    $('#li_0').addClass("active");
  }else if(str==1){
    $('#li_1').addClass("active");
  }

  $("#scrap_type").val(str);
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
  var scrap_type = $("#scrap_type").val();

  var formData = {
		'page_num' : page_num,
		'type' : scrap_type
	}; 

	$.ajax({
		url      : "/<?=mapping('my_scrap')?>/my_scrap_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {  
   
      if(result.length <10){
        mutex = true;
        scrollchk = false;
        $("#list_ajax_"+scrap_type).html('');
       
        return;
      }else{

        if(page_num == 1){
          $("#list_ajax_"+scrap_type).html(result);
        }else{
          $("#list_ajax_"+scrap_type).append(result);
          $(".float"+scrap_type).css("display","block");
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
  history.replaceState(state, '', '/<?=mapping('my_scrap')?>/my_scrap_list');
}

//페이지 로딩
function page_load(event){
  //ui 세팅
  var type = $('#scrap_type').val();
  page_ui_setting(type);

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

function scrap_del(key_idx,type){
  //0:프로그램 ,1:매거진

  var formData = {
		'key_idx' : key_idx,
		'type' : type
	}; 

  $.ajax({
  url      : "/<?=mapping('my_scrap')?>/scrap_del",
  type     : "POST",
  dataType : "json",
  async    : true,
  data     : formData,
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
      alert(result.code_msg);
      page_load(event);
    }
  }
  });
}

function display_mod_up(news_idx){

  if(!confirm("컨텐츠를 노출하시겠어요?")){
    return;
  }

  $.ajax({
  url      : "/common/display_mod_up",
  type     : "POST",
  dataType : "json",
  async    : true,
  data     : {
    'news_idx':news_idx
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
      alert(result.code_msg);
      page_load(event);
    }
  }
  });
}

</script>