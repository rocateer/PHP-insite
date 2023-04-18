
<?php
$display =($result_list_count<1)? "block":"none";

if(!empty($result_list)){
  $j=0;
	foreach($result_list as $row){
    if($type=='0'){?>
    <li>
    <img src="/images/btn_delete_2.png" alt="x" class="btn_delete_2" onclick="scrap_del('<?=$row->program_idx?>','0');">
    <a href="javascript:void(0)" onclick="detail_url('/<?= mapping('program') ?>/program_detail?program_idx=<?=$row->program_idx?>')">
      <div class="scrap_img">
        <div class="img_box"><img src="<?=$row->program_img_path?>" alt="프로그램사진"></div>
      </div>
      <div class="scrap_list_right">
        <div class="title"><?=$row->program_title?></div>
          <div class="level"><span>난이도</span>
            <ul class="level_ul">
              <?for($i=1;$i<=5;$i++){
                if($i<=$row->level){?>
                  <li class="on"></li>
                <?}else{?>
                  <li></li>
                <?}?>
              <?}?>
            </ul>
          </div>
          <ul class="info_ul">
            <li>
              <?=$row->program_view_cnt?>
            </li>
            <li  class="">
              <?=$row->program_like_cnt?>
            </li>
          </ul>
        </div>
      </a>
    </li>
    
    <?}else if($type=='1'){
      if($row->display_yn=='Y'){?>

      <li>
        <img src="/images/btn_delete_2.png" alt="x" class="btn_delete_2" onclick="scrap_del('<?=$row->news_idx?>','1');">
        <a href="javascript:void(0)" onclick="detail_url('/<?= mapping('board') ?>/board_detail?news_idx=<?=$row->news_idx?>')">
          <div class="scrap_img">
            <div class="img_box"><img src="<?=$row->img_path?>" alt="프로그램사진"></div>
          </div>
          <div class="scrap_list_right">
            <div class="title mt10"><?=$row->title?></div>
            <div class="sub_title txt_overflow2"><?=strip_tags($row->contents)?></div>
          </div>
        </a>
      </li>
      
      <?}else{?>
        
        <li class="blind">
           <table class="tbl_1">
             <colgroup>
               <col width="105">
               <col width="*">
             </colgroup>
             <tr>
               <th>
                 <div class="img_box">
                   <img src="<?=$row->img_path?>" alt="">
                 </div>
               </th>
               <td>
                 <img src="/images/btn_delete_2.png" alt="x" class="btn_delete_2" onclick="scrap_del('<?=$row->news_idx?>','1');">
                 <p>숨긴 컨텐츠 입니다.</p>
                 <button onclick="display_mod_up('<?=$row->news_idx?>');">숨기기 해제</button>
               </td>
             </tr>
           </table>
         </li>
        
        <?}?>
    <?}?>

<?php
		$j++;}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data_<?=$type?>").css("display",'<?=$display?>'); 

  <?
  if(!empty($result_list)){
  ?>
    
    <?if($loading_ok =="Y"){?>
      page_num ++;
      scrollchk = true;
    <?}else{		?>
      scrollchk = false;
    <?}?>
    mutex = false;

    page_save(event);
  <?}?>
</script>





