
<?php
$display =($result_list_count>0)? "none":"block";

if(!empty($result_list)){
  $j=0;
	foreach($result_list as $row){
    $yoil_arr = explode(',',$row->yoil);

    $select_yoil = "";

    if($row->yoil=='1,2,3,4,5,6,0'){
      $select_yoil = "매일 ";
    }else{
      foreach($yoil_arr as $row1){

        $str='';

        switch($row1) {
          case '1': $str = " 월 /"; break;
          case '2': $str = " 화 /"; break;
          case '3': $str = " 수 /"; break;
          case '4': $str = " 목 /"; break;
          case '5': $str = " 금 /"; break;
          case '6': $str = " 토 /"; break;
          case '0': $str = " 일 /"; break;
          default: $str = ""; break;
        }
        $select_yoil=$select_yoil.$str;
    }
  } 
?>
    <li>
      <img src="/images/i_dot_2.png" alt="" class="btn_more" onclick="set_program_idx('<?=$row->program_idx?>','<?=$row->member_program_idx?>');modal_open_slide('more')">
      <a href="/<?=mapping('program')?>/program_detail?program_idx=<?=$row->program_idx?>">
        <table class="tbl_fix tbl_2">
          <colgroup>
            <col width='58px'>
            <col width='*'>
          </colgroup>
          <tr>
            <th>
              <div class="img_box">
                <img src="<?=$this->global_function->get_small_img($row->img_path);?>" alt="">
              </div>
            </th>
            <td>
              <div class="title"><?=$row->title?></div>
              <p><?=substr($select_yoil,0,-1)?> <span><?=$row->s_date?> ~ <?=$row->e_date?></span></p>
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

</script>





