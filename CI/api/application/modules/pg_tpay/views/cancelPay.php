<script>

$(document).ready(function () {
  redirect_to_mobile();
});

function redirect_to_mobile() {

  // var member_addr = $("#member_address").val();
  //
  // if($('#agent').val() == 'android') {
  //
  //   window.rocateer.addr(member_addr);
  //
  // } else if($('#agent').val() == 'ios') {
  //
  //   var message = {"member_addr" : member_addr};
  //
  //   window.webkit.messageHandlers.native.postMessage(message);
  //
  // }
  // window.webkit.messageHandlers.native.postMessage();
  window.rocateer.cancelPay();
}

</script>
