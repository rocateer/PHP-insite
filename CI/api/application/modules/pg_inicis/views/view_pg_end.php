<form name="form1" action="/payment/order_end"  method="post">
  <input type="hidden" name="pg_tid" value="<?=$data['pg_tid'];?>">
  <input type="hidden" name="pg_type" value="<?=$data['pg_type'];?>">
  <input type="hidden" name="pg_date" value="<?=$data['pg_date'];?>">
  <input type="hidden" name="pg_price" value="<?=$data['pg_price'];?>">
  <input type="hidden" name="pg_result" value="<?=$data['pg_result'];?>">
  <input type="hidden" name="order_number" value="<?=$data['order_number'];?>">
</form>
<script>
  document.form1.submit();
</script>
