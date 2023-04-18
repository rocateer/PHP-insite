
      <table class="order_table">
        <tr>
          <th width="600">상품정보</th>
          <th>수량</th>
          <th>상품금액</th>
          <th>포인트</th>
          <th>쿠폰</th>
          <th>배송비</th>
          <th>주문금액</th>
        </tr>
        <?php
          $tot_product_price=0;
          $tot_delivery_price=0;
          $tot_use_point=0;
          $tot_member_coupon_price=0;
          $tot_payment_price=0;

          if(!empty($result_list)){
            foreach($result_list as $row){
            $product_img_path="/images/product_default.png";
            if(!empty($row->product_img_path)){
              $product_img_path = $row->product_img_path;
            }

            $tot_product_price +=$row->sum_product_price;
            $tot_delivery_price+=$row->delivery_price;
            $tot_use_point+=$row->use_point;
            $tot_member_coupon_price+=$row->member_coupon_price;
            $tot_payment_price+=$row->sum_pay_price;
        ?>
        <tr>
          <td class="product_info">
						<div class="img_wrap">
							<img src="<?=$product_img_path?>" alt="">
						</div>
            <strong>[<?=$row->corp_name?>]<?=$row->product_name?></strong>
            <div> ( <?=$row->product_option_name?> )</div>
          </td>
          <td><?=$row->product_ea?></td>
          <td class="cost"><?=number_format($row->sum_product_price)?> 원</td>
          <td class="cost"><?=number_format($row->use_point)?> 원</td>
          <td class="cost"><?=number_format($row->member_coupon_price)?> 원</td>
          <td class="cost"><?=number_format($row->delivery_price)?> 원</td>
          <td class="cost"><?=number_format($row->sum_pay_price)?> 원</td>
        </tr>
        <?php
            }
          }else{
        ?>
         <tr>
          <td colspan=11> 등록된 게시물이 없습니다.
          </td>
          </tr>
        <?php
          }
        ?>

      </table>

      <script>
        $('#span_product_price').html("<?=number_format($tot_product_price)?>");
        $('#span_delivery_price').html("<?=number_format($tot_delivery_price)?>");
        $('#span_use_point').html("<?=number_format(-1*$tot_use_point)?>");
        $('#span_member_coupon_price').html("<?=number_format(-1*$tot_member_coupon_price)?>");
        $('#span_payment_price').html("<?=number_format($tot_payment_price)?>");

        $('#tot_product_price').val("<?=$tot_product_price?>");
        $('#tot_delivery_price').val("<?=$tot_delivery_price?>");
        $('#tot_use_point').val("<?=$tot_use_point?>");
        $('#tot_member_coupon_price').val("<?=$tot_member_coupon_price?>");
        $('#tot_payment_price').val("<?=$tot_payment_price?>");

      </script>
