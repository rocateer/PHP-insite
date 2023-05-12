<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:document.referrer ? history.go(-1): location.href='/<?=mapping('main')?>';"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>
    1:1 문의
  </h1>
  <p class="btn_txt"><a href="javascript:void(0)" onclick="qa_reg_in();">삭제</a></p>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body type_2">
  <div class="qa_top_txt">
    <div class="qa_top_head">
      <span class="tag">미답변</span>
      <div class="title"> 그린필 전기자동차 충전에 대한 데이터 질문</div>
      <span class="qa_date">2023.01.12</span>
    </div>
    <div class="qa_top_con">
      <div class="qa_con" id="qa_contents" name="qa_contents" placeholder="내용을 입력하세요.">단순히 보면 우리는 Android + IOS + Web Cloud System 을 개발하고 만드는 사람 들일 뿐 입니다. ​하지만 우리는 당신의 새로운 "비즈니스 아이디어"를 최신 IT기술을 활용하 여 다양한 모바일 플랫폼을 구현하여 온라인, 오프라인을 연결하여 당신에게 다채로운 마케팅 활동이 가능하도록 플랫폼서비스를 구체화하여 실현하고 많은 사람들이 더 편리하고 스마트한 생활을 누릴수 있는 삶의 혜택을 만드는 일을 하는 사람들입니다.</div>
    </div>
  </div>
  <div class="qa_bottom_txt">
      <p>
        <?=nl2br($result->reply_contents)?>
        단순히 보면 우리는 Android + IOS + Web Cloud System 을 개발하고 만드는 사람 들일 뿐 입니다. ​하지만 우리는 당신의 새로운 "비즈니스 아이디어"를 최신 IT기술을 활용하 여 다양한 모바일 플랫폼을 구현하여 온라인, 오프라인을 연결하여 당신에게 다채로운 마케팅 활동이 가능하도록 플랫폼서비스를 구체화하여 실현하고 많은 사람들이 더 편리하고 스마트한 생활을 누릴수 있는 삶의 혜택을 만드는 일을 하는 사람들입니다.
      </p>
      <div class="date"><?=$result->reply_date?></div>
    </div>
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
