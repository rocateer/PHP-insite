<form name="form1" action="/payment/order_end"  method="post">
  <input type="hidden" name="pg_tid" value="<?=$_POST['tid'];?>">
  <input type="hidden" name="payment_type" value="C">
  <input type="hidden" name="pg_date" value="<?=$_POST['authDate'];?>">
  <input type="hidden" name="pg_price" value="<?=$_POST['amt'];?>">
  <input type="hidden" name="pg_result" value="<?=$_POST['pg_result'];?>">
</form>

<script>
  document.form1.submit();
</script>
