<!-- header : s -->
<header>
  <a class="btn_left" href="/<?=mapping('mypage')?>"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    1:1 문의
  </h1>
  <p class="head_txt"><a href="/<?=mapping('qa')?>/qa_reg">등록</a></p>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body">
  <div class="no_data" id="no_data" style="display: none;">
    <p><span class="message_box">FAQ으로는 해결이 어려우신가요?<br>문의 글을 작성하시면확인 후에 답변을 드립니다.</span></p>
  </div>
	<ul class="qa_ul" id="list_ajax">
		<li>
			<a href="/<?=mapping('qa')?>/qa_detail?qa_idx=1" class="block">
				<div>
					<span class="tag">미답변</span>
					<div class="title"> 그린필 전기자동차 충전에 대한 데이터 질문</div>
					<span class="qa_date">2023.01.12</span>
				</div>
			</a>
		</li>
		<li>
			<a href="/<?=mapping('qa')?>/qa_detail?qa_idx=1" class="block">
				<div>
					<span class="tag point_color">답변완료</span>
					<div class="title"> 그린필 전기자동차 충전에 대한 데이터 질문</div>
					<span class="qa_date">2023.01.12</span>
				</div>
			</a>
		</li>
	</ul>
</div>
<!-- body : e -->
<input type="text" name="total_block" id="total_block" value="1" style="display:none">
<input type="text" name="scrollPosition" id="scrollPosition" value="0" style="display:none">
<script type="text/javascript">

// $(function(){
// 	setTimeout("get_list()", 200);
// });

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
		url      : "/<?=mapping('qa')?>/qa_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(tab_click_yn =="N" && window.Performance && window.performance.navigation.type == 2){
         // console.log(history.state);
          var data = history.state;          
          if(data){
              $('#list_ajax').html(data.list);   //저장된 데이터를 뿌려준다.              
              $('html, body').animate({scrollTop : $("#scrollPosition").val()});
              
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