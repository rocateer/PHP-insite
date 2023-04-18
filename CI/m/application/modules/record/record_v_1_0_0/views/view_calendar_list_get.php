
<?php
$display =($result_list_count<1)? "block":"none";

$select_d = substr(str_replace("-",".",$date),-5);
$yoil = array("일","월","화","수","목","금","토");
$select_y = $yoil[date('w', strtotime($date))];

if(!empty($result_list)){
  $j=0;
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
?>
<li class="<?=($row->excercise_yn=='Y')?'complete':''?>">
    <a href="/<?= mapping('program') ?>/program_detail?program_idx=<?=$row->program_idx?>&type=1">
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
                  <p class="date"><?=substr($select_yoil,0,-1)?> 
                  <span class="f_right"><?=$row->s_date?> ~ <?=$row->e_date?></span>
                </p>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </a>
  </li>
        
<?php
		$j++;}
	}
?>

<script>

$("#select_date").html("<?=$select_d?> (<?=$select_y?>)");
$("#no_data").css("display","<?=$display?>");

</script>


