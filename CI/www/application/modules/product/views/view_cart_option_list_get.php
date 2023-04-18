  <?php
    $tot_price =0;
    foreach($result_list as $row){
      $tot_price +=$row->cart_row_price;
  ?>
  <li>
    <p><?=$row->product_option_name?></p>
    <div>
      <div class="order_num_control">
        <a href="javascipt:void(0)" onclick="order_num_set(this, 'minus','<?=$row->cart_idx?>')">-</a><input type="text" name="cart_ea_<?=$row->cart_idx?>" id="cart_ea_<?=$row->cart_idx?>" value="<?=$row->cart_ea?>" onchange="order_num_set(this, 'text','<?=$row->cart_idx?>')"><a href="javascipt:void(0)" onclick="order_num_set(this, 'plus','<?=$row->cart_idx?>')">+</a>
      </div>
      <strong><?=number_format($row->cart_row_price)?>원</strong>
    </div>
    <a class="btn_delete" href="javascipt:void(0)" onclick="cart_option_del('<?=$row->cart_idx?>')" ><img src="/images/btn_close.png" alt=""></a>
  </li>
  <?php
      }

  ?>
  <script>
    $('#product_total_price').html("<?=number_format($tot_price)?>");
  </script>
  <!-- <li>
    <p>사이즈:전기방석 1인용 / 색상:대리석</p>
    <div>
      <div class="order_num_control">
        <a href="javascipt:void(0)" onclick="order_num_set(this, 'minus')">-</a><input type="text" name="" value="1" onchange="order_num_set(this, 'text')"><a href="javascipt:void(0)" onclick="order_num_set(this, 'plus')">+</a>
      </div>
      <strong>14,900원</strong>
    </div>
    <a class="btn_delete" href="#"><img src="/images/btn_close.png" alt=""></a>
  </li>
   -->
