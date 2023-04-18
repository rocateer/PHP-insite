<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:document.referrer ? history.go(-1): location.href='/<?=mapping('main')?>';"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    1:1 문의
  </h1>
  <p class="qa_title btn_del"><a href="javascript:void(0)" onclick="qa_del()">삭제</a></p>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body">
  <div class="qa_top_txt">
  <img src="/images/i_question.png" alt="" class="question">
    <span class="category">카테고리</span>
    <div class="txt_wrap mt10">
      <div class="title"><?=$result->qa_title?></div>
      <div  class="contents mt10">
        <?=nl2br($result->qa_contents)?>
      </div>
      <div class="date"><?=$result->ins_date?></div>
    </div>
   
  </div>
  <? if($result->reply_yn=='Y'){ ?>
    <div class="qa_bottom_txt">
      <p>
        <?=nl2br($result->reply_contents)?>
      </p>
      <div class="date"><?=$result->reply_date?></div>
    </div>
  <? } ?>
</div>
<!-- body : e -->



<input name="qa_idx" id="qa_idx" type="hidden" value="<?=$result->qa_idx?>">

<script type="text/javascript">

// 댓글 삭제
function qa_del(){

  if(confirm("해당 문의글을 삭제 하시겠습니까?\n삭제 하시면 해당 글은 다시 복구 할 수 없습니다.")){

    $.ajax({
      url      : "/<?=mapping('qa')?>/qa_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "qa_idx" : $('#qa_idx').val()
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
          location.href ='/<?=mapping('qa')?>/qa_list';
     		}
      }
    });
  }
}

</script>
