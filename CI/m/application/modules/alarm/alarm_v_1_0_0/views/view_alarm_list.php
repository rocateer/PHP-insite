<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
    알림
  </h1>
</header>
<!-- header : e -->
<!-- body : s -->
<div class="body row">
  <div class="inner_wrap">
    <div class="no_data" id="no_data">
      <p>새로운 알림이 없습니다</p>
    </div>
    <ul class="alarm_ul" id="list_ajax"></ul>
  </div>
</div>
<!-- body : e -->


<input type="text" name="total_block" id="total_block" value="1" style="display:none">
<input type="text" name="scrollPosition" id="scrollPosition" value="0" style="display:none">

<script type="text/javascript">

$(function(){
	setTimeout("get_list()", 200);
});

function get_list(){ 
 default_list_get('1');
}

var page_num=1;
var tab_click_yn="N";//탭클릭 여부
var loading_ok ="Y";//로딩여부
$(window).scroll(function(){
	var scrollHeight = $(document).height();
	var scrollPosition = $(window).height() + $(window).scrollTop();

	if((scrollHeight - scrollPosition) / scrollHeight <=0.018){
	  if(loading_ok =="Y"){
      page_num++;
		  default_list_get(page_num);
    }   
	}
  
  $("#scrollPosition").val(scrollPosition);
  
});

function default_list_get(page_num){

	var total_block = parseInt($("#total_block").val());
	loading_ok ="N";

	var formData = {
		'page_num' : page_num
	};

	$.ajax({
    url      : "/<?=mapping('alarm')?>/alarm_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(tab_click_yn =="N" && window.Performance && window.performance.navigation.type == 2){         
          var data = history.state;          
          if(data){
              $('#list_ajax').html(data.list);   //저장된 데이터를 뿌려준다.              
              $('html, body').animate({scrollTop : $("#scrollPosition").val()});//스크롤
              
          }
          history.replaceState({list:$("#list_ajax").html()},'', '');    
          loading_ok ="Y"; 
					tab_click_yn="";           
      }else{
        if(page_num == 1){
			  	 $("#list_ajax").html(result);

        }else{
          if(total_block < page_num){
         	 page_num = 1;
          }else{
         	 $("#list_ajax").append(result);
          }

        }
        history.replaceState({list:$("#list_ajax").html()},'', '');
        loading_ok ="Y";           

      }   
		}
	});
}

//알림읽음
function alarm_read_mod_up(alarm_idx){

  var form_data = {
      'alarm_idx' : alarm_idx,
  };

  $.ajax({
    url      : "/<?=mapping('alarm')?>/alarm_read_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success : function(result){
      if(result.code == '-1'){
  			alert(result.code_msg);
  			$("#"+result.focus_id).focus();
  			return;
		  }
		  // 0:실패 1:성공
		  if(result.code == 0) {
			  alert(result.code_msg);
		  } else {

    	}
		}
  });
}

function alarm_del(alarm_idx){

	var form_data = {
      'alarm_idx' : alarm_idx,
  };

	$.ajax({
    url      : "/<?=mapping('alarm')?>/alarm_del",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success : function(result){
      if(result.code == '-1'){
  			alert(result.code_msg);
  			$("#"+result.focus_id).focus();
  			return;
		  }
		  // 0:실패 1:성공
		  if(result.code == 0) {
			  alert(result.code_msg);
		  } else {
        $('#alarm_idx_'+alarm_idx).remove();
				if ($('.alarm_li').length==0) {
					$("#no_data").css("display","block");
				}
				// new_alarm_count();
      }
    }
  });
}

function all_alarm_del(){

	$.ajax({
    url      : "/<?=mapping('alarm')?>/all_alarm_del",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : 1,
    success : function(result){
      if(result.code == '-1'){
  			alert(result.code_msg);
  			$("#"+result.focus_id).focus();
  			return;
		  }
		  // 0:실패 1:성공
		  if(result.code == 0) {
			  alert(result.code_msg);
		  } else {
        alert(result.code_msg);
        location.reload();
      }
    }
  });
}

//페이지바로가기
function go_url(alarm_data){

  var go_url ="";

  switch (alarm_data.index) {
    case "101": go_url="/<?=mapping('community')?>/community_detail?board_idx="+alarm_data.board_idx;break;
    case "102": go_url="/<?=mapping('community')?>/community_detail?board_idx="+alarm_data.board_idx;break;
    case "103": go_url="/<?=mapping('main')?>";break;
    case "104": go_url="/<?=mapping('main')?>";break;
    case "105": go_url="/<?=mapping('qa')?>/qa_detail?qa_idx="+alarm_data.qa_idx;break;
  }

  if(go_url !=""){
    location.href=go_url;
  }

}

</script>
