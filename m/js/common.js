
/**
 * @param {string} wrap_cl 메뉴탭 감싸는 태그 클래스명 
 * @param {string} menu_cl 메뉴탭 태그 클래스명
 * @param {function} fn 클릭 시 실행함수
 * @returns {void} 
 * 
 * @description form 생성 후 post 요청
 * 
 * @author 재명 <mingo@rocateer.com>
 */
function set_menu_toggle(wrap_cl, menu_cl, fn){
  const menu_arr = [...document.querySelectorAll(`.${wrap_cl} .${menu_cl}`)];
  
  // 클릭 시 탭 활성화
  menu_arr.map(menu_el => {
    menu_el.addEventListener('click', e=>{
      menu_arr.map(el=>el.classList.remove('active'));
      menu_el.classList.add('active');
    })
  })

  // 클릭 시 실행 함수
  if (fn !=null && typeof fn == 'function') {
    fn();
  }
}

/**
 * @param {string} form_name form name 속성명
 * @param {object} form_data input 태그 데이터(단순 key:value 객체 형식) 
 * @param {string} url form action url 
 * @return {HTMLElement} 선택된 form 태그.
 * 
 * @description form 생성 후 post 요청
 * 
 * @author 재명 <mingo@rocateer.com>
 */
 function post_action(form_name, form_data, url){

  const form = document.createElement("form");

  form.setAttribute("charset", "UTF-8");
  form.setAttribute("method", "Post");  //Post 방식
  form.setAttribute("name", form_name); // 이름
  form.setAttribute("id", form_name); // 이름
  form.setAttribute("action", url); //요청 보낼 주소

  for(key in form_data)  {
    const hiddenField = document.createElement("input");

    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", key);
    hiddenField.setAttribute("value", form_data[key]);
    form.appendChild(hiddenField);
  }

  document.body.appendChild(form);
  return form;
}


// 텍스트 내 링크 추출해 a태그로 변환
function autolink(id) {
  var container = document.getElementById(id);        
  var doc = container.innerHTML;        
  var regURL = new RegExp("(http|https|ftp|telnet|news|irc)://([-/.a-zA-Z0-9_~#%$?&=:200-377()]+)","gi");        
  var regEmail = new RegExp("([xA1-xFEa-z0-9_-]+@[xA1-xFEa-z0-9-]+\.[a-z0-9-]+)","gi");       
  container.innerHTML = doc.replace(regURL,`<a href='javascript:void(0)' onclick="api_request_external_link('$1://$2')" style="color:#3A9DD9;font-weight:bold" >$1://$2</a>`);
}


$(function(){
  // faq list ::민지
  $('.faq_list li p').click(function(){
    $(this).children('img').toggleClass('rotate');
    $(this).next('.answer_wrap').toggleClass('display');
  });

  // 탭메뉴 토글기능
  // $(".tab_area_wrap > div").hide();
  // $(".tab_area_wrap > div").first().show();
  // $(".tab_toggle_menu li").click(function() {
  //   var list = $(this).index();
  //   $(this).siblings('li').removeClass("active");
  //   $(this).addClass("active");
  //   $(this).parents('.tab_toggle_menu').siblings('.tab_area_wrap').find('>div').hide();
  //   $(this).parents('.tab_toggle_menu').siblings('.tab_area_wrap').find('>div').eq(list).show();
  // });

  //기본 토글 이벤트
  $(".simple_toggle_trigger").click(function(){
    $(".simple_toggle_layer").stop().slideToggle(300);
    return false;
  });
});

//------------------------------------------------------------------------------------------

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


// 전체동의폼::재명 수정
function checkall_func(checkAll, checkOne){

  function allCheckFunc(obj) {
    $("."+checkOne).prop("checked", $(obj).prop("checked") );
  }

  /* 체크박스 체크시 전체선택 체크 여부 */
  function oneCheckFunc( obj ){
    var allObj = $("."+checkAll);
    var objName = $(obj).attr("name");

    if( $(obj).prop("checked") ){
      checkBoxLength = $("."+ objName ).length;
      checkedLength = $("."+ objName +":checked").length;

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
    $("."+checkAll).click(function(){
      allCheckFunc( this );
    });
    $("."+checkOne).each(function(){
      $(this).click(function(){
        oneCheckFunc( $(this) );
      });
    });
  });
}

//사이드 네비 토글
function side_nav_toggle(){
  $(".nav, .nav_dim").toggleClass("open");

  if($(".nav").hasClass("open")){

    $.lockBody();
  } else {
    $.unlockBody();
  }
}

//basic_modal-------------------------------------------------------------------------------------
function modal_open(element){
  $(".md_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 100);
  $(".modal_" + element).css({display: "block"});
  $.lockBody();
}

function modal_close(element){
  $(".md_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 100);
  $(".modal_" + element).css({display: "none"});
  $.unlockBody();
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
        }else if(img_id=='product_img'){
          set_img(img_list[i].path);
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
var type = '';

//파일업로드요청:서버->앱
function api_request_file_upload(img_id, file_cnt){

  img_id_val = img_id;
  if(img_id=='member_img') {
    type = '1'; //회원 이미지 1:1 크롭
  }

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
		window.rocateer.request_file_upload();
	} else if (agent == 'ios') {
  	 var message = {
       "request_type": "request_file_upload",
       "type":type,
  	};
	 window.webkit.messageHandlers.native.postMessage(message);
	}
}

// 파일적용::앱->서버
function api_reponse_file_upload(file_path) {

  if (img_id_val=='member_img') {
    set_one_img(file_path);
  }else {
    set_img(file_path);
  }
}

var i = 0;
function set_img(file_path) {
  
  var _img = file_path.split('.');
  var file_path_s = _img[0] + "_s." + _img[1];

  var str = `
    <li class="${img_id_val}_div" id="${img_id_val}_file_0_${i}">
      <a href="javascript:file_img_remove('${img_id_val}_file_0_${i}')"> <img src="/images/btn_delete.png" alt="x" class="btn_delete"></a>
      <div class="img_box">
        <img src="${file_path_s}" alt="">
      </div>
      <input type='checkbox' name='${img_id_val}_path'  value='${file_path}' checked style='display:none' />
    </li>
  `;


  $('#'+img_id_val).append(str);
  $('#'+img_id_val+'_cnt').html($("."+img_id_val+"_div").length);

  i++;
}

function file_img_remove(file_no){
  $("#"+file_no).remove();
  $('#'+img_id_val+'_cnt').html($("."+img_id_val+"_div").length);
}

// -------------------------------------------------------------------------------------

//달력 세팅
$(document).ready(function() {
  for (var i = 0; i < 100; i++) {

    $("#s_date_"+i).datepicker({
      defaultDate: "+0w",
      minDate:0,
      dateFormat: "yy-mm-dd",
      prevText: '이전 달',
      nextText: '다음 달',
      monthNames: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
      monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
      dayNames: ['일', '월', '화', '수', '목', '금', '토'],
      dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
      dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
      showMonthAfterYear: true,
      changeMonth: true,
      changeYear: true,
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function(selectedDate) {
        $("#e_date_"+i).datepicker("option", "minDate", selectedDate);
      }
    });

    $("#e_date_"+i).datepicker({
      defaultDate: "+0w",
      dateFormat: "yy-mm-dd",
      minDate:0,
      prevText: '이전 달',
      nextText: '다음 달',
      monthNames: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
      monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
      dayNames: ['일', '월', '화', '수', '목', '금', '토'],
      dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
      dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
      showMonthAfterYear: true,
      changeMonth: true,
      changeYear: true,
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function(selectedDate) {
        $("#s_date_"+i).datepicker("option", "maxDate", selectedDate);
      }
    });
  }

  $("#s_date_routine").datepicker({
    defaultDate: "+0w",
    minDate:1,
    dateFormat: "yy-mm-dd",
    prevText: '이전 달',
    nextText: '다음 달',
    monthNames: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
    monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
    dayNames: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
    showMonthAfterYear: true,
    changeMonth: true,
    changeYear: true,
    changeMonth: true,
    numberOfMonths: 1,
    onClose: function(selectedDate) {
      $("#e_date_routine").datepicker("option", "minDate", selectedDate);
    }
  });

  $("#e_date_routine").datepicker({
    defaultDate: "+0w",
    dateFormat: "yy-mm-dd",
    minDate:1,
    prevText: '이전 달',
    nextText: '다음 달',
    monthNames: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
    monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
    dayNames: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
    dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
    showMonthAfterYear: true,
    changeMonth: true,
    changeYear: true,
    changeMonth: true,
    numberOfMonths: 1,
    onClose: function(selectedDate) {
      $("#s_date_routine").datepicker("option", "maxDate", selectedDate);
    }
  });

});

  

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

// 민지:s

// 이미지줌(확대/축소)
function set_modal_open(img){
  $("#zoom_img").attr('src', img);
  modal_open('img_origin');
  image_zoom();
}
function image_zoom(){
  var el = document.querySelector('#box_id');
  var pz = new PinchZoom.default(el, {
    draggableUnzoomed: false,
  });
}

// 위시리스트 토글버튼
function wish_btn(element){
  if($(element).hasClass("on")){
    $(element).removeClass("on");
  } else {
    $(element).addClass("on");
  }
}


// 사업자정보확인 js
function license_check(){
  var url = "http://www.ftc.go.kr/bizCommPop.do?wrkr_no="+form_license.license_no.value;
  window.open(url, "bizCommPop", "width=750, height=700;");
}

// ios용 placeholder (enter)
for(var i =0; i < $('.place_wrap textarea').length; i++){
	if ($('.place_wrap').eq(i).find('textarea').val().length === 0) {
		$('.place_wrap').eq(i).find('textarea').siblings('.place_p').css('display','block');
	}else{
		$('.place_wrap').eq(i).find('textarea').siblings('.place_p').css('display','none');
	}
}
$(".place_wrap textarea").on("propertychange change keyup paste input", function(){
	if ($(this).val().length === 0) {
		$(this).siblings('.place_p').css('display','block');
	 }else{
		$(this).siblings('.place_p').css('display','none');
	};
});

// 에디터로 보여주는 화면 UI 보정 js
$("#edit").find('*').each(function(){
  $("#edit").find('iframe').parent().addClass('iframe_wrap');
});

function gotop(){
  $('body,html').animate({
    scrollTop:0
  },200,'linear')
}

// 민지 : 모달 슬라이드
window.onload = function(){
  let md_slide_height;
	for(var i = 0; i<$('.modal_slide').length;i++){ // 각 모달의 높이 값만큼 -
	  md_slide_height = $('.modal_slide').eq(i).outerHeight();
	  $('.modal_slide').eq(i).css('bottom',-md_slide_height);
	} //모든 모달슬라이드 숨기기
}
// 민지
function modal_open_slide(element){
	$(".md_slide_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 200);
	$(".modal_slide_" + element).animate({bottom: 30},200);
	$.lockBody();
}

function modal_close_slide(element){
  md_slide_height2 = $(".modal_slide_" + element).outerHeight();
	$(".md_slide_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 200);
	$(".modal_slide_" + element).animate({bottom: -md_slide_height2},200);
	$.unlockBody();
}
