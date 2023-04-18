<div class="row table_title">
  <div class="col-lg-6">
상품 코드 또는 상품명으로 검색해주세요.</br>
※ 미전시 상태이거나 품절된 상품은 검색되지 않습니다.
</div>
  <div class="col-lg-6 text-right"> &nbsp;

</div>

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
              $product_idx =  $row->product_idx;
              $display_yn =  $row->display_yn;
            ?>
          <tr>
            <th>추천상품. <?=$k+1?></th>
            <td class="td_left">
              <select class="form-control product_idx" style="width:550px" id="product_idx_<?=$main_section_idx?>" name="product_idx_<?=$main_section_idx?>" >
                  <option value="">전체</option>
                  <?php foreach($product_list as $row2){?>
                  <option value="<?=$row2->product_idx?>" <?=($row2->product_idx ==$product_idx)? "selected":"";?>>[<?=$row2->product_code?>]<?=$row2->product_name?> / <?=$row2->corp_name?></option>
                  <?php }?>
              </select>
            </td>
            <td  >
              <label class="switch">
              <input type="checkbox" id="display_yn_<?=$main_section_idx?>" name="display_yn_<?=$main_section_idx?>"  value="Y" <?php if($display_yn =="Y"){  echo "checked";  }?>  >
              <span class="check_slider"></span>
            </label>

            </td>
            <td  >
              <a class="btn btn-success" href="javascript:void(0)" onclick="default_mod('<?=$main_section_idx?>','checkbox_<?=$main_section_idx?>')">변경사항저장</a>

            </td>

          </tr>
          <?php
          $k++;
          }}
        ?>
        </tbody>
      </table>

<script>
 $(".product_idx").select2({
   placeholder: "선택하세요.",
   allowClear: true
 });

</script>
