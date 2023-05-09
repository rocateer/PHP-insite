<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
  1:1 문의
  </h1>
  <p class="head_txt"><a href="javascript:void(0)" onclick="qa_reg_in();">등록</a></p>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="vh_wrap qa_reg_page">
  <div class="body">
    <form name="form_default" id="form_default">
      <input class="qa_title" type="text" id="qa_title" name="qa_title" placeholder="제목을 입력하세요.">
      <textarea class="qa_con" id="qa_contents" name="qa_contents" placeholder="내용을 입력하세요." style=""></textarea>
    </form>
  </div>
</div>
<!-- body : e -->

<script type="text/javascript">

function qa_reg_in(){

  $.ajax({
      url      : "/<?=mapping('qa')?>/qa_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $("#form_default").serialize(),
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
          location.href ='/<?=mapping('qa')?>';
     		}
      }
    });
}
</script>
