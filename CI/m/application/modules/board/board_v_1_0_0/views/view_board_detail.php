<header class="transparent">
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back_w.png" alt="닫기"></a>
  <div class="btn_close" onclick="md_open();">
    <img src="/images/head_btn_dot_w.png" alt="">
  </div>
</header>
<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more" id="md_more" style="display: none;">
  <ul>
    <li>
      <?if($result->display_yn=='Y'){?>
      <a href="javascript:void(0)" onclick="display_mod_up('<?=$result->news_idx?>');">숨기기</a>
      <?}else{?>
        <a href="javascript:void(0)" onclick="display_mod_up('<?=$result->news_idx?>');">숨기기 해제</a>
      <?}?>
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
<div class="board_detail_view">
  <div class="visual_img_wrap">
    <img src="<?=$result->img_path?>" alt="" class="img_block">
  </div>
  <div class="container_round">
    <div class="inner_wrap dh_detail_title">
      <h2 class="txt_center"><?=$result->title?></h2>
      <div class="date">
        <span><?=$result->ins_date?></span>
        <ul class="info_ul5">
          <li>
          <?=$result->view_cnt?>
          </li>
        </ul>
      </div>
    </div>
    <div class="mt20 inner_wrap row mb20">
      <div id="edit">
        <?=nl2br($result->contents)?>
      </div>
      <div class="btn_scrap mt30" >
        <input type="checkbox" id="chk_2_1" name="chk_1" <?=($result->scrap_yn=='Y')?'checked':''?> onclick="default_scrap('<?=$result->news_idx?>');"> 
        <label for="chk_2_1">
          <span></span>
            스크랩
        </label>
      </div>
    </div>
  </div>
</div>
<script>

  function md_open(){
    $("#md_more").css('display','block');
    modal_open_slide('more');

  }

// 에디터로 보여주는 화면 UI 보정 js
$("#edit").find('*').each(function(){
  $("#edit").find('iframe').parent().addClass('iframe_wrap');
});

  var display_yn='<?=$result->display_yn?>';

function display_mod_up(news_idx){

  if(COM_login_check('<?=$this->member_idx?>','/<?=mapping('board')?>')){
    if(display_yn=='Y'){
      if(!confirm("컨텐츠를 숨기시겠어요?")){
        return;
      }
    }else{
      if(!confirm("컨텐츠를 노출하시겠어요?")){
        return;
      }
      
    }
  }

$.ajax({
  url      : "/common/display_mod_up",
  type     : "POST",
  dataType : "json",
  async    : true,
  data     : {
    'news_idx':news_idx
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
      // alert(result.code_msg);
    } else if(result.code == 1) {
      alert(result.code_msg);
      history.go(-1);
    }
  }
});
}

function default_scrap(news_idx){

  COM_login_check('<?=$this->member_idx?>','/<?=mapping('board')?>') 

$.ajax({
  url      : "/<?=mapping('board')?>/scrap_mod_up",
  type     : "POST",
  dataType : "json",
  async    : true,
  data     : {
    'news_idx':news_idx
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
      // alert(result.code_msg);
    }
  }
});
}

let criteria_scroll_top = 0;
$(window).on('scroll',function (){
	let scrollTop = $(this).scrollTop();
	if(scrollTop > criteria_scroll_top){
    $('header').addClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back.png');
		$('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot.png');
	}else{
    $('header').removeClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back_w.png');
		$('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot_w.png');

	}
})

</script>