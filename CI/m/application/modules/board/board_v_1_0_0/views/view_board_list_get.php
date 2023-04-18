
<?php
$display =($result_list_count<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>

  <?if($row->display_yn=='Y'){?>
    <li class="mb30">
      <a href="/<?=mapping('board')?>/board_detail?news_idx=<?=$row->news_idx?>">
        <div class="img_box">
          <img src="<?=$row->img_path?>" alt="커뮤니티 이미지">
        </div>
        <h2 class="title"><?=$row->title?></h2>
        <!-- <h6 class="mt10">$row->contents</h6> -->
        <div class="date mt5">
          <span><?=$row->ins_date?></span>
          <ul class="info_ul5">
            <li>
            <?=$row->view_cnt?>
            </li>
          </ul>
        </div>
      </a>
    </li>
  <?}else{?>
    <li class="mb30 blind">
      <a href="javascript:void(0)">
        <div class="img_box">
          <img src="<?=$row->img_path?>" alt="커뮤니티 이미지">
        </div>
        <div class="blind_wrap">
          <div class="blind_txt">숨긴 컨텐츠 입니다.</div>
          <button class="btn_blind" onclick="display_mod_up('<?=$row->news_idx?>');">숨기기 해제</button>
        </div>
      </a>
    </li>
<?php
      }
		}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data").css("display","<?=$display?>");

</script>





