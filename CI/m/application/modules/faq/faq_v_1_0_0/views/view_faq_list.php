<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    FAQ
  </h1>
</header>
<!-- header : e -->

<!-- body : s -->
<div >
  
  <ul class="faq_list mt50" id="list_ajax">

  </ul>
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
    url      : "/<?=mapping('faq')?>/faq_list_get",
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

</script>
