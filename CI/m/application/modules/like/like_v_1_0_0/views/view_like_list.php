<header>
  <div class="btn_back" onclick="COM_history_back_fn()">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
    좋아요
  </h1>
</header>
<div class="body footer_margin view_community inner_wrap">
  <div class="tab_3">
    <ul class="tab_toggle_menu clearfix">
      <li class="active" id="li_0" onclick="set_like_type('0');">
        프로그램
      </li>
      <li class="" id="li_1" onclick="set_like_type('1');">
        이브의 고민
      </li>
      <li class="" id="li_2" onclick="set_like_type('2');">
        오늘의 운동 완료
      </li>
    </ul>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">
        <div class="no_data" id="no_data_0">
          <p>좋아요한 프로그램이 없습니다.</p>
        </div>
        <ul class="like_ul" id="list_ajax_0">
        </ul>

      </div>
      <!-- 탭 영역 1 : e -->
      <!-- 탭 영역 2 : s -->
      <div class="">
      <div class="no_data" id="no_data_1">
          <p>좋아요한 게시글이 없습니다.</p>
        </div>
        <ul class="community_ul0" id="list_ajax_1">
        </ul>

      </div>
      <!-- 탭 영역 2 : e -->
      <!-- 탭 영역 3 : s -->
      <div class="">
        <div class="no_data" id="no_data_2">
          <p>좋아요한 게시글이 없습니다.</p>
        </div>
        <ul class="mb20_ul mt20 today_board" id="list_ajax_2">
        </ul>

      </div>
      <!-- 탭 영역 3 : e -->
    </div>
  </div>
</div>

<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more">
  <ul>
    <li>
      <a href="javascript:void(0)" onclick="block_reg_in('');">차단</a>
    </li>
    <li>
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more')">신고</a>
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


<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_mymore">
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
      <a href="javascript:modal_close_slide('mymore')">취소</a>
      </li>
    </ul>
  </div>
<div class="md_slide_overlay md_slide_overlay_mymore" onclick="modal_close_slide('mymore')"></div>
<!-- modal_open_slide : e -->
  
<!-- modal_open_slide : s -->
<div class="modal modal_report">
  <div class="md_container">
    <div class="title">부적절한 내용인가요?<br>모두가 즐길 수 있는 컨텐츠를<br>만들기 위해서는 신고가 필요합니다.</div>
    <select name="report_type" id="report_type">
      <option value="">선택</option>
      <option value="0">영리목적 홍보성</option>
      <option value="1">불법 정보</option>
      <option value="2">음란성, 선정성</option>
      <option value="3">욕설, 인신공격</option>
      <option value="4">개인정보 노출</option>
      <option value="5">같은 내용의 반복 게시(도배)</option>
      <option value="6">기타</option>
    </select>
    <div class="label">신고 사유 입력 <span class="essential">*</span></div>
    <textarea name="report_contents" id="report_contents" cols="" rows=""></textarea>
    <div class="btn_md_wrap">
      <span class="btn_md_left" onclick="modal_close('report')">
        취소
      </span>
      <span class="btn_md_right" onclick="report_reg_in()">
        확인
      </span>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_report" onclick="modal_close('report')"></div>
<!-- modal_open_slide : e -->

<input type="text" name="like_type" id="like_type" value="0" style="display:none">
<input type="text" name="board_idx" id="board_idx" value="" style="display:none">

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
function set_like_type(str){
  page_num=1; 
  scrollchk =true;
  mutex = false;

  $(".tab_toggle_menu li").removeClass("active");

  if(str==0){
    $('#li_0').addClass("active");
  }else if(str==1){
    $('#li_1').addClass("active");
  }else if(str==2){
    $('#li_2').addClass("active");
  }

  $("#like_type").val(str);
  $("#list_ajax_0").html("");
  $("#list_ajax_1").html("");
  $("#list_ajax_2").html("");
  
  page_ui_setting(str);
  default_list_get();
}

//카테고리 세팅
function set_board_idx(board_idx){
  $("#board_idx").val(board_idx);
}

//페이지::ui세팅
function page_ui_setting(str){

  $("#li_0").removeClass("active");
  $("#li_1").removeClass("active");
  $("#li_2").removeClass("active");
  $(".no_data").css("display","none");

  if(str =="0"){
    $(".tab_area_wrap > div").first().show();
    $(".tab_area_wrap > div:nth-child(2)").hide();
    $(".tab_area_wrap > div").last().hide();

    $("#li_0").addClass("active");

  }else if(str =="1"){
    $(".tab_area_wrap > div").first().hide();
    $(".tab_area_wrap > div:nth-child(2)").show();
    $(".tab_area_wrap > div").last().hide();

    $("#li_1").addClass("active");
  }else if(str =="2"){
    $(".tab_area_wrap > div").first().hide();
    $(".tab_area_wrap > div:nth-child(2)").hide();
    $(".tab_area_wrap > div").last().show();

    $("#li_2").addClass("active");

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
  var like_type = $("#like_type").val();

  var formData = {
		'page_num' : page_num,
		'like_type' : like_type
	}; 

	$.ajax({
		url      : "/<?=mapping('like')?>/like_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {  
   
      if(result.length <10){
        mutex = true;
        scrollchk = false;
        $("#list_ajax_"+like_type).html('');
       
        return;
      }else{

        if(page_num == 1){
          $("#list_ajax_"+like_type).html(result);
        }else{
          $("#list_ajax_"+like_type).append(result);
          $(".float"+like_type).css("display","block");
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
  var state ={'list_data_0':$("#list_ajax_0").html() ,'list_data_1':$("#list_ajax_1").html(),'list_data_2':$("#list_ajax_2").html() ,current_page:page_num};
  history.replaceState(state, '', '/<?=mapping('like')?>/like_list');
}

//페이지 로딩
function page_load(event){
  //ui 세팅
  var type = $('#like_type').val();
  page_ui_setting(type);

  if ((window.performance && window.performance.navigation.type == 2)){

    if (history.state){
      var data = history.state;
      $("#list_ajax_0").html(data.list_data_0);      
      $("#list_ajax_1").html(data.list_data_1);
      $("#list_ajax_2").html(data.list_data_2);

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


// 차단등록/해제
function block_reg_in(board){
  var board_idx = $('#board_idx').val();

  if(!confirm("해당 글을 차단/해제 하시겠습니까?")){
        return;
      }

  var return_url="<?=mapping('community')?>";
  if(COM_login_check(member_idx,return_url,'로그인 후에 사용 가능합니다.')==false){ return;}

  if(board==''){

    var formData = {
      'board_idx' : board_idx,
      'board_reply_idx' : 0,
    }
  }else{

    var formData = {
      'board_idx' : board,
      'board_reply_idx' : 0,
    }

  }

  $.ajax({
      url      : "/common/block_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
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
          default_list_get();
          modal_close_slide('more');
        }
      }
    });
  }


// 신고
function report_reg_in(){
  var board_idx = $('#board_idx').val();

  var formData = {
    'board_idx' : board_idx,
    'board_reply_idx' : 0,
    'report_type' : $("select[name='report_type']").val(),
    'report_contents' : $('#report_contents').val()
  }

  $.ajax({
      url      : "/<?=mapping('community')?>/report_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
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
          modal_close('report');
          location.reload();
        }
      }
    });
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
          modal_close_slide('mymore');
          location.reload();
        }
      }
  });

}

function board_mod_up(){
  var board_idx = $('#board_idx').val();

  location.href ="/<?=mapping('community')?>/community_mod?board_idx="+board_idx;
}



</script>