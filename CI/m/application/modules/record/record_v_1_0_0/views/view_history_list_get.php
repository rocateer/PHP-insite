
<?php
$display =($result_list_count<1)? "block":"none";

if(!empty($history_date_list)){

  $d_day='';
  $n_day ='';
  foreach($history_date_list as $date_row){
    $n_day = $date_row->excercise_date;
    $yoil = array("일","월","화","수","목","금","토");
    $select_y = $yoil[date('w', strtotime($n_day))];

    if($d_day!=$n_day){?>

      <h2><?= $date_row->format_excercise_date?> (<?=$select_y?>)</h2>
        <div class="shadow_box">
          <ul>

    <?}
      foreach($result_list as $row){

        $min=substr( $row->record_time, 3,2 ); 
        $sec=substr( $row->record_time, -2 );

        $yoil_arr = explode(',',$row->yoil);

        $select_yoil = "";

        if($row->yoil=='1,2,3,4,5,6,0'){
          $select_yoil = "매일 ";
        }else{
          foreach($yoil_arr as $row1){

            $str='';

            switch($row1) {
              case '1': $str = "월/"; break;
              case '2': $str = "화/"; break;
              case '3': $str = "수/"; break;
              case '4': $str = "목/"; break;
              case '5': $str = "금/"; break;
              case '6': $str = "토/"; break;
              case '0': $str = "일/"; break;
              default: $str = ""; break;
            }
            $select_yoil=$select_yoil.$str;
          }
        }
          if($n_day==$row->excercise_date){
    ?>
          <li>
          <a href="/<?= mapping('program') ?>/program_detail?program_idx=<?=$row->program_idx?>">
              <table>
                <colgroup>
                  <col width='55px'>
                  <col width='*'>
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box">
                      <img src="<?=$row->img_path?>" alt="">
                    </div>
                  </th>
                  <td>
                    <table class="tbl_4_1">
                      <tr>
                        <th>
                          <span class="name"><?=$row->title?></span>
                          <span class="name f_right">
                          <?if($row->excercise_yn=='Y'){?>
                            <?=($min=='00')?'':(int)$min.'분'?> <?=(int)$sec?>초
                            <?}?>
                          </span>
                        </th>
                      </tr>
                      <tr>
                        <td colspan="2">
                        <p class="date">
                          <?=substr($select_yoil,0,-1)?> 
                          <p class="date"><?=$row->s_date?> ~ <?=$row->e_date?></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </a>
          </li>
    <?php
          }
        }
      ?>
<?

    if($d_day!=$n_day){?>
          </ul>
      </div>
    <?}
    $d_day=$n_day;
  }
}
?>


<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data").css("display","<?=$display?>");

</script>


