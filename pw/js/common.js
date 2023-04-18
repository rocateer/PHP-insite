// 전체동의폼 ::민지
function allCheckFunc( obj ) {
  $("[name=checkOne]").prop("checked", $(obj).prop("checked") );
}

  /* 체크박스 체크시 전체선택 체크 여부 */
function oneCheckFunc( obj ){
  var allObj = $("[name=checkAll]");
  var objName = $(obj).attr("name");

  if( $(obj).prop("checked") ){
    checkBoxLength = $("[name="+ objName +"]").length;
    checkedLength = $("[name="+ objName +"]:checked").length;

    if( checkBoxLength == checkedLength ) {
        allObj.prop("checked", true);
    } else {
        allObj.prop("checked", false);
    }
  }
  else
  {
    allObj.prop("checked", false);
  }
}

$(function(){
  $("[name=checkAll]").click(function(){
    allCheckFunc( this );
  });
  $("[name=checkOne]").each(function(){
    $(this).click(function(){
      oneCheckFunc( $(this) );
    });
  });
});

// JavaScript Document
$(document).ready(function() {
  //클릭 이벤트
  $(".img_search").click(function(){
    $(".search_layer").stop().slideToggle(300);
    return false;
  });

});

//사이드 네비 토글
function side_nav_toggle(){
  $(".nav, .nav_dim").toggleClass("open");

  if($(".nav").hasClass("open")){

    $.lockBody();
  } else {
    $.unlockBody();
  }
}

$(document).ready(function() {

  //tab_1-------------------------------------------------------------------------------------

  $(".tab_1 .tab_menu a").click(function(){
    if($(this).hasClass("active")){
      return false;
    }

    $(".tab_1 .tab_menu a").removeClass("active");
    $(this).addClass("active");

    var tab_num = $(".tab_1 .tab_menu a").index(this); //클릭한 메뉴와 같은 순서의 탭 내용 show
    $(".tab_1 .tab_content").hide();
    $(".tab_1 .tab_content").eq(tab_num).fadeIn();
  });
  //------------------------------------------------------------------------------------------

});


//basic_modal-------------------------------------------------------------------------------------

function modal_open(element){
  $(".md_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 100);
  $(".modal_" + element).css({display: "block"});
}

function modal_close(element){
  $(".md_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".modal_" + element).css({display: "none"});
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
}

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

}

//아코디언
$(document).on("click",".accordion .trigger",function(){
  var my_trigger = $(this);
  var my_panel = $(this).siblings(".panel");
  var my_list_item = $(this).siblings(".list_item_title");

  var accordion_group = $(this).parents('.accordion'); //해당 아코디언 그룹

  if( my_trigger.hasClass('active') ){  //열려있을 때
    //해당 슬리아드 비활성화
    my_panel.stop().slideUp();
    my_trigger.removeClass('active');
  } else {  //닫혀있을 때
    accordion_group.find('.panel').stop().slideUp();
    accordion_group.find('.trigger').removeClass('active');


    //해당 슬라이드 활성화
    my_panel.stop().slideDown();
    my_trigger.addClass('active');
    my_list_item.addClass('active')
  }
});


//전체선택(함수는 lable에서 지정해야 합니다.)
function COM_check_box_all_fn(all_clase,select_class){
  var all_check = $('.'+all_clase); //전체 동의 체크박스
  var checkbox_num = $('.filter_wrap').find('.'+select_class).length; //체크 항목 개수
  var checkbox = $('.filter_wrap').find('.'+select_class); //전체동의를 제외한 체크박스

  //전체 동의 체크 했을 때
  all_check.click(function(){
    if(all_check.prop("checked") == true){
      checkbox.prop("checked",true);
    } else {
      checkbox.prop("checked",false);
    }
  });

  //전체동의 체크 해제 상태에서 모두 체크 되었을때, 전체동의 체크 상태에서 하나라도 해제 했을 때
  checkbox.click(function(){
    var checked_num = $("."+select_class+":checked").length; //체크된 박스 개수
    if(checked_num == checkbox_num){ //모두 체크 되었을 때
      all_check.prop("checked",true);
    } else {
      all_check.prop("checked",false);
    }
  });
}



//------------------------------------------------------------------------------------------

//지역코드 세팅------------------------------------------------------------------------------
var get_area_list = function(area_code,depth,db_val) {
$.ajax({
 url: "/p_common/get_area_list",
 type: 'POST',
 dataType: 'json',
 async: true,
 data: {
     "area_code" : area_code,
     "depth" : depth,
 },
 success: function(dom){

   var selectStr = "";
   var sel = "";
    //select 선택 세팅
   if(depth=="1"){
      $('#do_code').html("<option value=''>시/도선택</option>");
   }
   if(depth=="2"){
      $('#si_code').html("<option value=''>구/시선택</option>");
   }
   if(depth=="3"){
      $('#dong_code').html("<option value=''>읍/면/동선택</option>");
   }
   if(depth=="4"){
      $('#ri_code').html("<option value=''>리/선택</option>");
   }
   // option vaue 세팅
   if(dom.length != 0) {

     for(var i = 0; i < dom.length; i ++) {
      sel ="";
      if(depth=="1"){
        if(dom[i].do_code ==db_val){ sel ="selected";}
      selectStr += "<option value='"+ dom[i].do_code  + "'  "+sel+" >" + dom[i].do + "</option>";
      }
      if(depth=="2"){
        if(dom[i].si_code ==db_val){ sel ="selected";}
       selectStr += "<option value='"+ dom[i].si_code  + "' "+sel+" >" + dom[i].si + "</option>";
      }
      if(depth=="3"){
        if(dom[i].dong_code ==db_val){ sel ="selected";}
       selectStr += "<option value='"+ dom[i].dong_code  + "' "+sel+" >" + dom[i].dong + "</option>";
      }
      if(depth=="4"){
        if(dom[i].ri_code ==db_val){ sel ="selected";}
       selectStr += "<option value='"+ dom[i].ri_code  + "' "+sel+" >" + dom[i].ri + "</option>";
      }

     }
     if(depth=="1"){
        $('#do_code').append(selectStr);
     }
     if(depth=="2"){
        $('#si_code').append(selectStr);
     }
     if(depth=="3"){
        $('#dong_code').append(selectStr);
     }
     if(depth=="4"){
        $('#ri_code').append(selectStr);
     }

   }
 }
});
}
//------------------------------------------------------------------------------------------

// 숫자만 입력-------------------------------------------------------------------------------
// 숫자및 콤마사용(호출 ::onkeyup="return numkey_check(event)")
function numkey_check(evt) {
var _pattern = /^(\d{1,10}\)?)?$/;
var _value = event.srcElement.value;
if (!_pattern.test(_value)) {
  alert("숫자만 허용됩니다.");
  event.srcElement.value = event.srcElement.value.substring(0,event.srcElement.value.length - 1);
  event.srcElement.focus();
}
}

function numkey_comma_check(evt) {
var _pattern = /^(\d{1,5}([.]\d{0,2})?)?$/;
var _value = event.srcElement.value;
if (!_pattern.test(_value)) {
  alert("숫자만 입력가능하며,\n소수점 둘째자리까지만 허용됩니다.");
  event.srcElement.value = event.srcElement.value.substring(0,event.srcElement.value.length - 1);
  event.srcElement.focus();
}
}

//3자리 단위마다 콤마 생성
function addCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//모든 콤마 제거
function removeCommas(x) {
  if(!x || x.length == 0) return "";
  else return x.split(",").join("");
}
//------------------------------------------------------------------------------------------

// checkbox 쉼표로 가져오기-----------------------------------------------------------------
//checkbox 쉼표로 가져오기
function get_checkbox_value(name){

var selected_idx = "";
var num = 0;
$("input[name="+name+"]:checked").each(function() {
  if(num == 0){
    selected_idx += $(this).val();
  }else{
    selected_idx += ','+$(this).val();
  }
  num++;
});
return selected_idx;
}
//------------------------------------------------------------------------------------------

// 파일업로드-------------------------------------------------------------------------------
var file_cnt = 0;
// 이미지 업로드 함수 trigger(img_id:id,limit_cnt:파일갯수,file_type:(image:이미지,file:파일),width:이미지 넓이,height:이미지 높이,accept_file:확장자명체(ex:.jpg ,.png ,.gif),img_resize:이미지 리사이즈 넓이))
function file_upload_click(img_id,file_type,limit_cnt,width,height,accept_file,img_resize){
  $('body').append('<form id="file_form" method="post"></form>');
  var fileUpload = "<input type='hidden' id='member_img_path'><input type='file' name='file[]' id='ex_file' accept='"+accept_file+" ' onchange=\"file_upload('"+img_id+"','"+file_type+"','"+limit_cnt+"','"+width+"','"+height+"','"+accept_file+"','"+img_resize+"');\" style='display:none' ><input type='hidden' name='img_resize' id='img_resize' value='"+img_resize+"'>";
  $('#file_form').html(fileUpload);
  $('#ex_file').click();
}

//파일업로드함수
function file_upload(img_id,file_type,limit_cnt,width,height,accept_file,img_resize){
  var formdata = new FormData($("#file_form")[0]);
  //업로드 갯수 제한
  if(limit_cnt!=""){
    var check_id = 'id_file_'+img_id+'_';
    if($("[id^="+check_id+"]").length >= parseInt(limit_cnt)){
      alert('업로드는 '+limit_cnt+'개 까지만 등록 가능합니다.');
      return;
    }
  }

  //파일확장자 제한
  if(accept_file !="undefined" ){
    var file_check_arr = accept_file.split(',');
    //var temp_ext = $('#ex_file').val().split('.');
    var filename =$('#ex_file').val();
    var _fileLen = filename.length;
    var _lastDot = filename.lastIndexOf('.');
    var file_ext = filename.substring(_lastDot, _fileLen).toLowerCase();

    var enable_cnt = 0;
    for(var i = 0; i < file_check_arr.length; i ++) {
      //alert(file_check_arr[i]);
      if(file_ext ==file_check_arr[i].trim()){
        enable_cnt++;
      }
    }
    //alert(enable_cnt);
    if(enable_cnt ==0){
      alert("허용된 확장자("+accept_file+")가 아닌 파일입니다.");
      return;
    }
  }



  $.ajax({
    url         : "/common/multi_fileUpload",
    type        : 'post',
    dataType    : 'json',
    processData : false,
    contentType : false,
    data        : formdata,
    success     : function(img_list){
      var str="";

      for(var i = 0; i < img_list.length; i++){
       str="<li id='id_file_"+img_id+"_"+i+"_"+file_cnt+"' style='display:inline-block;padding-right:10px;'>"
       str+="<input type='hidden'  name='"+img_id+"_orig_name[]' id='"+img_id+"orig_name"+i+"' value='"+img_list[i].orig_name+"'/>";
       if(file_type !="file"){
         str+= " <img src='/images/btn_del.gif' style='width:15px;' onclick=\"file_upload_remove('"+img_id+"_"+i+"_"+file_cnt+"');\"/><br>";
         str+="<img style='width:"+width+"px;height:"+height+"px;' src='"+img_list[i].path+"'>";
       }else{
         str+= "<a href=\"javascript:void(0)\" onclick=\"file_download('"+img_id+"');\">"+img_list[i].orig_name+"</a>";
         str+= " <img src='/images/btn_del.gif' style='width:15px;' onclick=\"file_upload_remove('"+img_id+"_"+i+"_"+file_cnt+"');\"/><br>";
       }
       str+="<input type='hidden' name='"+img_id+"_path[]' id='"+img_id+"_"+i+"' value='"+img_list[i].path+"'/>";

       str+="<input type='checkbox' name='"+img_id+"'  value='"+img_list[i].path+"' checked style='display:none' />";
       str+="<input type='checkbox' name='"+img_id+"_org_name'  value='"+img_list[i].orig_name+"' checked style='display:none' />";
       str+="</li>";

        if (img_id=='img') {
          set_img(img_list[i].path);
          // set_member_img(img_list[i].path);
        }else if(img_id=='member_img'){
          set_one_img(img_list[i].path);          
        }else{
          $('#'+img_id).append(str);
        }

      }
      file_cnt++;
    }

  });

}

var file_upload_remove = function(file_no){
  $("#id_file_"+file_no).remove();
}


var img_id_val = "img";

//파일업로드요청:서버->앱
function api_request_file_upload(img_id, file_cnt){

  img_id_val = img_id;
  
  if (file_cnt) {
    if ($("."+img_id+"_div").length>=file_cnt) {
      alert("최대 "+file_cnt+"장까지만 등록 가능합니다.");
      return;
    }
  }

  if (app_yn != 'Y') {
    file_upload_click(img_id_val,'image','1','150');
    // set_member_img_test();
    return;
  }

	if(agent == 'android') {
		window.rocateer.api_file_upload();
	} else if (agent == 'ios') {
  	 var message = {
  	    "request_type" : "api_file_upload",
  	};
	 window.webkit.messageHandlers.native.postMessage(message);
	}
}

// 파일적용::앱->서버
function api_reponse_file_upload(file_path){
  if (img_id_val=='member_img') {
    set_one_img(file_path);
  }else {
    set_img(file_path);
  }
}

function set_one_img(file_path){
  $('#member_img_src').attr("src", file_path);
  $('#member_img_path').val(file_path);
}


var i = 0;
function set_img(file_path){
  //alert(file_path);
  var str = "";
  str += "<li class='"+img_id_val+"_div' id='id_file_0_"+i+"' >";
  str += "  <img src='/images/btn_delete.png' alt='X' onclick=\"file_img_remove('id_file_0_"+i+"')\" class='btn_delete'>";
  str += "  <div class='img_box'>";
  str += "    <img src='"+file_path+"' alt=''>";
  str += "  </div>";
  str += "  <input type='checkbox' name='"+img_id_val+"'  value='"+file_path+"' checked style='display:none' />";
  str += "</li>";

  $('#'+img_id_val).append(str);
  $('#'+img_id_val+'_cnt').html($("."+img_id_val+"_div").length+"/10");

  i++;
}

function file_img_remove(file_no){
  $("#"+file_no).remove();
  $('#'+img_id_val+'_cnt').html($("."+img_id_val+"_div").length+"/10");
}

// -------------------------------------------------------------------------------------

//3자리 단위마다 콤마 생성
function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

//3자리 실행 함수
//실행 방법 _input_check type=>pirce로 설정
//input tag에 onkeyup로 함수 실행
function COM_number_comma(id){
  $("#"+id).val(addCommas($("#"+id).val().replace(/[^0-9]/g,"")));
}

//뒤로 가기
function COM_history_back_fn(){
  if(window.history.length==1){
    location.href = "/<?=mapping('main')?>";
  }else{
    history.go(-1);
  }
}
