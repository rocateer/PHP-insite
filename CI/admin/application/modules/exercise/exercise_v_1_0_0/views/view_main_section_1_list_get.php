<div class="row table_title">
 
      <table class="table table-bordered">
        <colgroup>
          <col style="width:15%">
          <col style="width:55%">
          <col style="width:15%">
          <col style="width:15%">
        </colgroup>
        <tbody>
          <?php
            $k=0;
            if(!empty($result_list)){
              foreach($result_list as $row){

              $main_section_idx =  $row->main_section_idx;
              $program_idx =  $row->program_idx;
              $display_yn =  $row->display_yn;
            ?>
          <tr>
            <th>추천 프로그램 <?=$k+1?></th>
            <td class="td_left">
              <select class="form-control program_idx" style="width:550px" id="program_idx_<?=$main_section_idx?>" name="program_idx_<?=$main_section_idx?>" >
                  <option value="">전체</option>
                  <?php foreach($program_list as $row2){?>
                  <option value="<?=$row2->program_idx?>" <?=($row2->program_idx ==$program_idx)? "selected":"";?> ><?=$row2->title?></option>
                  <?php }?>
              </select>
            </td>
            <td  >
              <a class="btn btn-success" href="javascript:void(0)" onclick="default_mod('<?=$main_section_idx?>')">변경사항저장</a>

            </td>
            <td  >
              <?php if($display_yn == "N"){ ?>
                노출 안함 <label class="switch">
                  <input type="checkbox" onchange="display_mod_up(<?=$main_section_idx?>, 'Y');">
                  <span class="check_slider"></span>
                </label> 노출
              <?php }else if($display_yn == "Y"){ ?>
                노출 안함 <label class="switch">
                  <input type="checkbox" onchange="display_mod_up(<?=$main_section_idx?>, 'N');" checked>
                  <span class="check_slider"></span>
                </label> 노출
              <?php } ?>
            </td>
           

          </tr>
          <?php
          $k++;
          }}
        ?>
        </tbody>
      </table>

<script>
 $(".program_idx").select2({
   placeholder: "선택하세요.",
   allowClear: true
 });

</script>
