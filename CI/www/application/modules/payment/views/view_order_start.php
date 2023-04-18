<form name="order_form" action="<?=$pg_url?>"  method="post">
  <input type="hidden" name="order_number" value="<?= $result->order_number?>">
  <input type="hidden" name="member_idx" value="<?= $result->member_idx ?>">
  <input type="hidden" name="order_name" value="<?= $result->order_name ?>">
  <input type="hidden" name="order_tel" value="<?= $result->order_tel ?>">
  <input type="hidden" name="order_email" value="<?= $result->order_email ?>">
  <input type="hidden" name="product_code" value="G_<?=date("YmdHis")?>">
  <input type="hidden" name="product_name" value="<?= $result->product_name ?>">
  <input type="hidden" name="product_price" value="<?= $result->product_price ?>">
</form>

<script>
  document.order_form.submit();
</script>
