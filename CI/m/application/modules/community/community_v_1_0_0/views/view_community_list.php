<header>
  <a class="btn_close" href="/<?=mapping('alarm')?>">
    <? if($new_alarm_cnt>0){ ?>
      <img src="/images/head_btn_alarm_on.png" alt="알람">
    <? } else {?>
      <img src="/images/head_btn_alarm_off.png" alt="알람">
    <? } ?>
  </a>
  <h1>
    커뮤니티
  </h1>
</header>
<div class="body view_community footer_margin inner_wrap">
  <div class="tab_fix_wrap">
    <div class="fix_menu_wrap">
      <ul class="tab_toggle_menu clearfix">
        <li class="active" id="li_0" onclick="set_board_type('0');">
          이브의 고민
        </li>
        <li class="" id="li_1" onclick="set_board_type('1');">
          오늘의 운동 완료
        </li>
      </ul>
    </div>
    <div class="tab_area_wrap">
      <!-- 탭 영역 1 : s -->
      <div class="">
        <?if(count($best_community_list)>0){?>
          <div class="best_wrap" id="best_0">
            <h4>이브의 베스트 고민</h4>
            <div class="swiper-container best_swiper">
              <div class="swiper-wrapper">
               
                <?
                foreach($best_community_list as $row){?>
                  <?if($row->del_yn=='Y'){?>
                     <!-- 베스트 삭제 -->
                      <div class="swiper-slide">
                        <a href="#">
                          <div class="i_lank"><?=$row->rank?></div>
                          <div class="title"><p>삭제된 글 입니다.</p></div>
                        </a>
                      </div>
                    <?}else{
                      if($row->display_yn=='N'){?>
                      <div class="swiper-slide">
                        <a href="#">
                          <div class="i_lank"><?=$row->rank?></div>
                          <div class="title"><p>블라인드 된 게시글 입니다.</p></div>
                        </a>
                      </div>
                      <?}
                      }?>
                    <?if($row->del_yn!='Y'&& $row->display_yn=='Y'){?>
                      <div class="swiper-slide">
                        <a href="/<?= mapping('community') ?>/community_detail?board_idx=<?=$row->board_idx?>">
                          <div class="i_lank"><?=$row->rank?></div>
                          <div class="title"><span><?=$row->category_name?> </span><?=$row->title?></div>
                          <ul class="info_ul4">
                            <li>
                              <?=$row->view_cnt?>
                            </li>
                            <li>
                              <?=$row->like_cnt?>
                            </li>
                            <li>
                              <?=$row->reply_cnt?>
                            </li>
                          </ul>
                        </a>
                      </div>
                      <?}?>
                <?}?>
              </div>
            </div>
          </div>
        <?}?>
        <div class="community_filter_ul_wrap">
          
          <div class="swiper-wrapper" onchange="set_category()">
            <div class="swiper-slide">
              <input type="radio" name="rdo_1" id="rdo_1_0" value="0" checked >
              <label for="rdo_1_0" >전체</label>
            </div>
              <?
              $j=1;
              foreach($category_list as $row1){?>
              
              <div class="swiper-slide"> 
                <input type="radio" name="rdo_1" id="rdo_1_<?=$j?>" value="<?=$row1->category_management_idx?>" >
                <label for="rdo_1_<?=$j?>"><?=$row1->category_name?></label>
              </div>
              <?
              $j++;}?>
              
          </div>  
        </div>  
        <div class="no_data" id="no_data_0" style="display: none;">
          <p> 작성된 커뮤니티 글이 없습니다.</p>
        </div>

        <ul class="community_ul0" id="list_ajax_0"></ul>

        <div class="float_margin"></div>
          <img src="/images/float_top.png" onclick="gotop()" class="float0" style="display: none;">
          <a href="/<?= mapping('community') ?>/community_reg1"><img src="/images/float_plus.png" alt="" class="float2"></a>
        </div>
      <!-- 탭 영역 1 : e -->

      <!-- 탭 영역 2 : s -->
      <div class="">
        <div class="no_data" id="no_data_1" style="display: none;">
          <p> 작성된 커뮤니티 글이 없습니다.</p>
        </div>
        <ul class="mb20_ul mt20 today_board" id="list_ajax_1">
        </ul>

        <div class="float_margin"></div>
          <img src="/images/float_top.png" onclick="gotop()" class="float1"  style="display: none;">
          <a href="/<?= mapping('community') ?>/community_reg2"><img src="/images/float_plus.png" alt="" class="float2"></a>
        </div>
      <!-- 탭 영역 2 : e -->
    </div>
  </div>
</div>

<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more" id="md_more" style="display: none;">
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
<div class="modal_slide modal_slide_mymore" id="md_mymore" style="display: none;">
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


<input type="text" name="board_idx" id="board_idx" value="0" style="display:none;">
<input type="text" name="board_reply_idx" id="board_reply_idx" value="0" style="display:none;">

<script>

  var best_swiper = new Swiper('.best_swiper', {
    slidesPerView: 1.1,
    spaceBetween: 20,
  });

</script>

<script type="text/javascript">

// window.onpageshow = function(event) {
// 	if ( event.persisted || (window.performance && window.performance.navigation.type == 2)) {
// 	// Back Forward Cache로 브라우저가 로딩될 경우 혹은 브라우저 뒤로가기 했을 경우
//   console.log("뒤로가기로 왔음");
// 		$(".tab_area_wrap > div").hide();
//     $(".tab_area_wrap > div").last().show();
//     $(".tab_toggle_menu li").click(function() {
//       var list = $(this).index();
//       $(".tab_toggle_menu li").removeClass("active");
//       $(this).addClass("active");

//     });
// 	}else{
//     console.log("뒤로가기로 온게 아님");
// 		$(".tab_area_wrap > div").hide();
//     $(".tab_area_wrap > div").first().show();
//     $(".tab_toggle_menu li").click(function() {
//       var list = $(this).index();
//       $(".tab_toggle_menu li").removeClass("active");
//       $(this).addClass("active");

//     });
// 	}
// }

</script>

<input type="text" name="total_block" id="total_block" value="1" style="display:none">
<input type="text" name="board_type" id="board_type" value="0" style="display:none">
<input type="text" name="scrollPosition" id="scrollPosition" value="0" style="display:none">

<script type="text/javascript">
var page_num=1;
var scrollchk =true;//스크롤 체크
var mutex = false;//lock 
var tab = '<?=$tab?>'; 

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
function set_category(){
  page_num=1; 
  scrollchk =true;
  mutex = false; 

  default_list_get();
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
  var documentHeight = $('.community_ul0').height();

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
		'board_type' : board_type,
		'category' : $("input[name='rdo_1']:checked").val()
	}; 

	$.ajax({
		url      : "/<?=mapping('community')?>/community_list_get",
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

//상세보기
function detail_url(url){
  var scrollHeightPosition = (document.documentElement && document.documentElement.scrollTop) || document.body.scrollTop;
  $("#scrollPosition").val(scrollHeightPosition);
  
  location.href=url;
} 

//페이지 저장
function page_save(event){
  var state ={'list_data_0':$("#list_ajax_0").html() ,'list_data_1':$("#list_ajax_1").html(),current_page:page_num};
  // console.log(state);
  history.replaceState(state, '', '/<?=mapping('community')?>/community_list');
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

var agent ="<?=$agent?>";

$(function(){
  setTimeout("page_load(event)", 10);
  if(tab=='1'){
    setTimeout("tab_click();", 200);
  }

  setTimeout("api_request_main_menu('M')", 100);
});

  //  요청 :: 디바이스 
  function api_request_main_menu(tab){
    // alert(tab);
  if(agent == 'android') {
    window.rocateer.request_main_menu(tab);
  } 
}


function tab_click(){

  $('#li_1').trigger('click');
}

function set_board_idx(board_idx,md_type){

  $('#board_idx').val(board_idx);
  $('#md_'+md_type).css('display','block');

  modal_open_slide(md_type);
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

const community_scroll_top = $('.community_filter_ul_wrap').offset().top;
$(window).on('scroll',function (){
	let scrollTop = $(this).scrollTop();
  console.log(scrollTop + 100 <= community_scroll_top);
	if(scrollTop + 100 <= community_scroll_top){
    $('.community_filter_ul_wrap').removeClass('fixed');
    
  }else{
    $('.community_filter_ul_wrap').addClass('fixed');
 

	}
})

var community_filter_ul_wrap = new Swiper(".community_filter_ul_wrap", {
  slidesPerView: "auto",
  spaceBetween: 24,

});
</script>
