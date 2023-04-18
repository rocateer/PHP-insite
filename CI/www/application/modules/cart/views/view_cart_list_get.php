<table class="order_table">
        <tr>
          <th width="600">상품정보</th>
          <th>수량</th>
          <th>상품금액</th>
          <th>배송비</th>
          <th>주문금액</th>
        </tr>

			 <?php
			    $count =count($result_list);
					$tot_sum_price=0;
					$tot_product_delivery=0;
					$tot_sum=0;
					if(!empty($result_list)){
						foreach($result_list as $row){
							$tot_sum_price +=$row->sum_price;
							$tot_product_delivery +=$row->product_delivery;
							$tot_sum +=$row->sum_price+$row->product_delivery;

					?>
				<tr>
          <td class="product_info">
            <input class="checkbox" type="checkbox" id="check_<?=$row->cart_idx?>" name="checkbox"  value="<?=$row->cart_idx?>" ><label for="check_<?=$row->cart_idx?>"><span></span></label>
						<div class="img_wrap">
							 <img src="<?=$row->product_img_path?>" alt="<?=$row->product_name?>">
						</div>
            <strong><?=$row->product_name?>(<?=$row->product_option_name?>)</strong>
          </td>
          <td>
            <div class="order_num_control">
              <a href="javascipt:void(0)" onclick="order_num_set(this, 'minus','<?=$row->cart_idx?>')">-</a><input type="text" name="cart_ea_<?=$row->cart_idx?>" id="cart_ea_<?=$row->cart_idx?>" value="<?=$row->cart_ea?>" onchange="order_num_set(this, 'text','<?=$row->cart_idx?>')"><a href="javascipt:void(0)" onclick="order_num_set(this, 'plus','<?=$row->cart_idx?>')">+</a>
            </div>
          </td>
          <td class="cost"><?=number_format($row->sum_price)?> 원</td>
          <td class="cost"><?=number_format($row->product_delivery)?> 원</td>
          <td class="cost"><?=number_format($row->sum_price+$row->product_delivery)?> 원</td>
        </tr>
					 <?php
							}
						}else{
					?>
					 <tr>
						<td colspan=11> 검색된 데이타가 없습니다.</td></tr>
					<?php
						}
					?>
        <!-- <tr>
          <td class="product_info">
            <input class="checkbox" type="checkbox" id="check_2" name="cart_idx[]"><label for="check_2"><span></span></label>
						<div class="img_wrap">
							<img src="/images/product_default.png" alt="">
						</div>
            <strong>색상: 레드(280) / 사이즈: 230</strong>
          </td>
          <td>
            <div class="order_num_control">
              <a href="javascipt:void(0)" onclick="order_num_set(this, 'minus')">-</a><input type="text" name="" value="1" onchange="order_num_set(this, 'text')"><a href="javascipt:void(0)" onclick="order_num_set(this, 'plus')">+</a>
            </div>
          </td>
          <td class="cost">105,000 원</td>
          <td class="cost">1,000 원</td>
          <td class="cost">0 원</td>
          <td class="cost">95,000 원</td>
        </tr>
        <tr>
          <td class="product_info">
            <input class="checkbox" type="checkbox" id="check_3" name="cart_idx[]"><label for="check_3"><span></span></label>
						<div class="img_wrap">
							<img src="/images/product_default.png" alt="">
						</div>
            <strong>색상: 핑크(280) / 사이즈: 230</strong>
          </td>
          <td>
            <div class="order_num_control">
              <a href="javascipt:void(0)" onclick="order_num_set(this, 'minus')">-</a><input type="text" name="" value="1" onchange="order_num_set(this, 'text')"><a href="javascipt:void(0)" onclick="order_num_set(this, 'plus')">+</a>
            </div>
          </td>
          <td class="cost">105,000 원</td>
          <td class="cost">1,000 원</td>
          <td class="cost">0 원</td>
          <td class="cost">95,000 원</td>
        </tr>
        <tr>
          <td colspan="6" class="title">[달팽이리빙]보온보냉 티포트</td>
        </tr>
        <tr>
          <td class="product_info">
            <input class="checkbox" type="checkbox" id="check_4" name="cart_idx[]"><label for="check_4"><span></span></label>
						<div class="img_wrap">
							<img src="/images/product_default.png" alt="">
						</div>
            <strong>색상: 핑크(280) / 사이즈: 230</strong>
          </td>
          <td>
            <div class="order_num_control">
              <a href="javascipt:void(0)" onclick="order_num_set(this, 'minus')">-</a><input type="text" name="" value="1" onchange="order_num_set(this, 'text')"><a href="javascipt:void(0)" onclick="order_num_set(this, 'plus')">+</a>
            </div>
          </td>
          <td class="cost">105,000 원</td>
          <td class="cost">1,000 원</td>
          <td class="cost">2,500 원</td>
          <td class="cost">95,000 원</td>
        </tr> -->
      </table>
      <div class="order_foot">

        <div>
          <span></span>
          <p><strong></strong> </p>

        </div>
				<div>
          <span>상품주문금액</span>
          <p><strong><?=number_format($tot_sum_price)?></strong> 원</p>
          <img src="/images/icon_plus.png" alt="+">
        </div>
        <div>
          <span>배송비</span>
          <p><strong><?=number_format($tot_product_delivery)?></strong> 원</p>
          <img src="/images/icon_equal.png" alt="=">
        </div>

        <div class="last">
          <span>결제예정금액</span>
          <p><strong><?=number_format($tot_sum)?></strong> 원</p>
        </div>
      </div>
<script>
$('#total_cnt').html('<?=number_format($count)?>');
</script>
