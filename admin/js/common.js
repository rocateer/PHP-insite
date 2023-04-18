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
  form.setAttribute("id", form_name); // id
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

// 탭메뉴 토글기능
$(document).ready(function() {
  $(".tab_area_wrap > div").hide();
  $(".tab_area_wrap > div").first().show();
  $(".tab_toggle_menu li").click(function() {
    var list = $(this).index();
    $(".tab_toggle_menu li").removeClass("active");
    $(this).addClass("active");

    $(".tab_area_wrap > div").hide();
    $(".tab_area_wrap > div").eq(list).show();
  });
});
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


//지역코드 세팅------------------------------------------------------------------------------
var get_area_list = function(area_code,depth,db_val="") {
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

function get_checkbox_value_with_others(name,other_id){

  var selected_idx = "";
  var num = 0;
  $("input[name="+name+"]:checked").each(function() {
    if(num == 0){
      selected_idx += $(this).val()+"^"+$('#'+other_id+'_'+$(this).val()).val();
    }else{
      selected_idx += ','+$(this).val()+"^"+$('#'+other_id+'_'+$(this).val()).val();
    }
    num++;
  });
  return selected_idx;
}
//------------------------------------------------------------------------------------------

// 파일업로드-------------------------------------------------------------------------------
var file_cnt = 0;
// 이미지 업로드 함수 trigger(img_id:id,limit_cnt:파일갯수,file_type:(image:이미지,file:파일,이미지 넓이,이미지 높이)
function file_upload_click(img_id,file_type,limit_cnt,width,height){
  $('body').append('<form id="file_form" method="post"></form>');
  var fileUpload = "<input type='file' name='file[]' id='ex_file' onchange=\"file_upload('"+img_id+"','"+file_type+"','"+limit_cnt+"','"+width+"',"+height+");\" style='display:none' >";
  $('#file_form').html(fileUpload);
  $('#ex_file').click();
}

//파일업로드함수
function file_upload(img_id,file_type,limit_cnt,width,height){
  var formdata = new FormData($("#file_form")[0]);
  if(limit_cnt!=""){
    var check_id = 'id_file_'+img_id+'_';
    if($("[id^="+check_id+"]").length >= parseInt(limit_cnt)){
      alert('업로드는 '+limit_cnt+'개 까지만 등록 가능합니다.');
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
         str+= img_list[i].orig_name;
         str+= " <img src='/images/btn_del.gif' style='width:15px;' onclick=\"file_upload_remove('"+img_id+"_"+i+"_"+file_cnt+"');\"/><br>";
       }
       str+="<input type='hidden' name='"+img_id+"_path[]' id='"+img_id+"_"+i+"' value='"+img_list[i].path+"'/>";
       str+="<input type='checkbox' name='"+img_id+"'  value='"+img_list[i].path+"' checked style='display:none' />";
       str+="<input type='checkbox' name='"+img_id+"_org_name'  value='"+img_list[i].orig_name+"' checked style='display:none' />";
       str+="</li>";

       $('#'+img_id).append(str);
      }
      file_cnt++;
    }

  });

}

var file_upload_remove = function(file_no){
  $("#id_file_"+file_no).remove();
}
// -------------------------------------------------------------------------------------

//엔터키
	function COM_enter_form(fn_name){
		if(window.event.keyCode == 13){
			window[fn_name](1);
		}
	}

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

//summernote 에디터 tag 제거
function COM_summernote_to_string(){
  var str = $('#contents').text().replace(/<\/p>/gi, "\n").replace(/<br\/?>/gi, "\n").replace(/<\/?[^>]+(>|$)/g, "");
  return str;
}

// 민지 :: 써머노트 플러그인 모둘
(function(){
  $.fn.summernote = function(options){
    var defaults = {
      height:400,
      lang: 'ko-KR',
      dialogsInBody: false,
      fontNames : [ 'NotoSansKR-Regular' ,'Arial', 'Helvetica', 'Verdana'] ,
      fontNamesIgnoreCheck : [ 'NotoSansKR-Regular' ],
      fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36'],
      callbacks: {
        onImageUpload: function(files, editor, welEditable) {
          for (var i = files.length - 1; i >= 0; i--) {
            sendFile(files[i], editor, welEditable);
          }
        }
      }
    };
    var options = $.extend({},defaults, options);
  }
})(jQuery);

//summernote editor contents parts
var postForm = function() {
   var content = $('textarea[name="+summernote_id+"]').html($('#'+summernote_id).code());
}

//에디터 이미지 등록
function sendFile(file,editor, welEditable) {
      var form_data = new FormData();
      form_data.append('file', file);
      form_data.append('id', 'id');
      form_data.append('device', 'image');
      $.ajax({
        data: form_data,
        dataType:'json',
        type: "POST",
        url: '/common/upload_file_json',
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function(result) {
          $('textarea[name="+summernote_id+"]').summernote('insertImage',  result.url);
        }
    });
 }


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
