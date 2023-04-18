
<?php
$display =($result_list_count<1)? "block":"none";

if(!empty($result_list)){
  $j=0;
	foreach($result_list as $row){
?>

<li>
  <table class="tbl_5">
    <colgroup>
      <col width='58px'>
      <col width='*'>
    </colgroup>
    <tr>
      <th>
        <div class="img_box">
          <?if($row->last_month_cnt==0){?>
          <img src="/images/i_new.png" alt="new" class="i_new">
          <?}?>
          <img src="<?=$row->img_path?>" alt="">
        </div>
      </th>
      <td>
        <div class="title"><?=$row->title?></div>
        <table class="tbl_5_1">
          <colgroup>
            <col width='30px'>
            <col width='*'>
            <col width='60px'>
            <col width='70px'>
          </colgroup>
          <tr>
            <th><?=$row->month_cnt?>회</th>
            <td>
            <?if($row->last_month_cnt>0){?>

              <? $cnt =($row->month_cnt)-($row->last_month_cnt); 
              if($cnt!=0){?>
              <div class="<?=($cnt>0)?'blue':'red'?>"><?=$cnt?>회</div>
              <?}else{?>
                <div class="">-</div>
                <?}?>
              <?}?>
            </td>
            <?
            $hour=substr($row->month_record_time,0,2);
            $min=substr($row->month_record_time,3,2);
            $sec=substr($row->month_record_time,-2);
            
            if($row->pn=='p'){
            $r_hour=substr($row->range_record_time,0,2);
            $r_min=substr($row->range_record_time,3,2);
            $r_sec=substr($row->range_record_time,-2);
            }else{
              $r_hour=substr($row->range_record_time,1,2);
              $r_min=substr($row->range_record_time,4,2);
              $r_sec=substr($row->range_record_time,-2);
            }
            ?>
            <th>
              <?=($hour>0)?(int)$hour.'시':''?><?=($min>0)?(int)$min.'분 ':''?><?=($sec>0)?(int)$sec.'초':'0초'?>
            </th>
            <td class="txt_right">
              <?if(!empty($row->range_record_time)){?>
                <? if($row->range_record_time!='00:00:00'){?>
                <div class="<?=($row->pn=='p')?'blue':'red'?>">
                  <?=($r_hour>0)?(int)$r_hour.'시':''?><?=($r_min>0)?(int)$r_min.'분 ':''?><?=($r_sec>0)?(int)$r_sec.'초':'0초'?>
                </div>
                <?}else{?>
                  <div class="">-</div>
                  <?}?>
                <?}?>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</li>


<?php
		$j++;}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data").css("display","<?=$display?>");

</script>





