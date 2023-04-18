
<?php
$display =($result_list_count<1)? "block":"none";

if(!empty($result_list)){
  $j=0;
	foreach($result_list as $row){
?>
 <li>
    <a href="javascript:void(0)" onclick="COM_login_check('<?=$member_idx?>','/<?=mapping('program')?>');default_mod_up();">
    <?if($row->del_yn=='N'){?>
      <img src="/images/i_success.png" alt="" class="i_plus">
      <?}else{?>
        <img src="/images/i_plus_2.png" alt="" class="i_plus" onclick="routine_reg('<?=$row->program_idx?>');">
        <?}?>
    </a>
    <a href="/<?=mapping('program')?>/program_detail?program_idx=<?=$row->program_idx?>">
      <div class="img_box">
        <img src="<?=$row->img_path?>" alt="">
      </div>
      <h2><?=$row->title?></h2>
      <table class="mt10 tbl_0">
        <tr>
          <th>
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
          </th>
          <td>            
            <ul class="info_ul">
              <li>
              <?=$row->view_cnt?>
              </li>
              <li class="<?=($row->like_yn=='Y')?'on':''?>">
              <?=$row->like_cnt?>
              </li>
            </ul>
          </td>
        </tr>
      </table>
    </a>
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

  function routine_reg(program_idx){

      location.href ="/<?=mapping('program')?>/routine_reg?program_idx="+program_idx;
  }


</script>





