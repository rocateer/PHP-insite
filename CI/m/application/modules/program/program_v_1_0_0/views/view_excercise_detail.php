
<header class="transparent">
  <?if($type=='1'){?>
  <a class="btn_back" href="javascript:modal_close('program')"><img class="w_100" src="/images/head_btn_back_w.png" alt="닫기"></a>
  <?}else{?>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back_w.png" alt="닫기"></a>
  <?}?>
</header>
<div class="visual_img_wrap">
  <img src="<?=$result->img_path?>" alt="" class="img_block">
</div>
<div class="container_round product_detail_view">
  <div class="inner_wrap">
    <h2 class="txt_center"><?=$result->title?></h2>
    <table class="tbl_center">
      <tr>
        <th>
        <img src="/images/i_ready.png" class="i_time"> <?=$result->sports_equipment?>

        </th>
        <td>
        <?
          $min=(int)$result->exercise_min;
          $sec=$result->exercise_sec;
        ?>
        <img src="/images/i_time.png" class="i_time"> <?=($min==0)?'':$min.'분'?> <?=($sec=='00')?'':$sec.'초'?> 소요
        </td>
      </tr>
    </table>
    <!-- 관리자에서 등록한 영상 -->
    <?if(!empty($result->url_link)){?>
      <div class="contents_iframe_wrap">
        <iframe class="contents_iframe" src="<?=$result->url_link?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    <?}?>
    <!-- 에디터로 등록한 내용 -->
    <div id="edit" style="padding:20px 10px 80px 10px;">
    <?=nl2br($result->contents)?>
    </div>
  </div>
  
</div>
<script>
  $(function(){
  let ifr = $('#edit').find('iframe').parent();
  
  for(var i = 0; i < ifr.length; i++){
    ifr[i].classList.add('iframe_wrap');
  }
})

let criteria_scroll_top = 0;
$(window).on('scroll',function (){
	let scrollTop = $(this).scrollTop();
	if(scrollTop > criteria_scroll_top){
    $('header').addClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back.png');
		// $('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot.png');
	}else{
    $('header').removeClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back_w.png');
		// $('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot_w.png');

	}
})
</script>