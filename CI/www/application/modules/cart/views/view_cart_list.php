<div class="body">
  <div class="inner_wrap">
    <div class="page_top_title">
      <h1>장바구니</h1>
      <p class="path">HOME<span>&gt;</span>장바구니<span></p>
    </div>

    <div class="cart_list checkbox_list">
      <div class="select_table_top">
        <p>
          <input class="all_check" type="checkbox" id="all_check" name="cart_idx[]" onclick="chkBox(this.checked)"><label for="all_check"><span></span>전체선택</label>&nbsp;&nbsp;|&nbsp;&nbsp;총 상품 <span id="total_cnt">3</span>개
        </p>
        <span class="btn_s btn_line"><a href="javascript:default_select_del();">선택삭제</a></span>
      </div>
      <div id="list_ajax">

      </div>

      <div class="btn_wrap">
        <span class="btn_m btn_basic"><a href="javascript:default_select_buy();">주문하기</a></span>
        <span class="btn_m btn_line"><a href="/">쇼핑하기</a></span>
      </div>
    </div>

  </div>
</div>
<form method="post" name="default_form" id="default_form">
	<input name="cart_idx" id="cart_idx" type="hidden" value="">
</form>

<script>


  $(function(){
    default_list_get();
  });

  //list_get
  function default_list_get(){

		$.ajax({
      url      : "/cart/cart_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : {

      },
      success  : function(result) {
        $('#list_ajax').html(result);
      }
    });
  }


  function chkBox(bool) {
    var obj = document.getElementsByName("checkbox");
    for (var i=0; i<obj.length; i++) {
      obj[i].checked = bool;
    }
  }

  // 선택주문
  var default_select_buy = function(){

    var selected_idx = "";
    var num = 0;

    $("input[name=checkbox]:checked").each(function() {
      if(num == 0){
        selected_idx += $(this).val();
      }else{
        selected_idx += ','+$(this).val();
      }
      num++;
    });

    if(num < 1){
      alert("선택된 항목이 없습니다.");
      return;
    }

    if(!confirm("선택된 항목를 주문하시겠습니까?")){
      return;
    }

		$('#cart_idx').val(selected_idx);

		default_form.action="/order/cart_order_reg_in";
    default_form.submit();

  }

  // 선택삭제
  var default_select_del = function(){

    var selected_idx = "";
    var num = 0;

    $("input[name=checkbox]:checked").each(function() {
      if(num == 0){
        selected_idx += $(this).val();
      }else{
        selected_idx += ','+$(this).val();
      }
      num++;
    });

    if(num < 1){
      alert("선택된 항목이 없습니다.");
      return;
    }

    if(!confirm("선택된 항목를 삭제하시겠습니까?")){
      return;
    }

    $.ajax({
      url      : "/cart/cart_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "cart_idx" : selected_idx
      },
      success: function(result) {
        if(result.code == "-1"){
          alert(result.code_msg);
        }else{
          alert("삭제가 완료되었습니다.");
          location.reload();
        }
      }
    });

  }

  // 수량변경
  function order_num_set(element, type,cart_idx){
    var wrap = $(element).closest(".order_num_control");
    var order_num_input = wrap.find("input");
    var order_num = Number(order_num_input.val());
    if (type == "plus"){
      order_num_input.val(order_num + 1);
    } else if (type == "minus") {
      if(order_num > 1){
        order_num_input.val(order_num - 1);
      } else {
        alert("주문 개수는 1개이상이어야 합니다.");
        return;
      }
    } else {
      if(order_num < 1){
        alert("주문 개수는 1개이상이어야 합니다.");
        order_num_input.val(1);
        return;
      }
    }
    cart_ea_up(cart_idx,order_num_input.val());
  }

  // 수량변경
  var cart_ea_up = function(cart_idx,cart_ea){

    $.ajax({
      url      : "/cart/cart_ea_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "cart_idx" : cart_idx,
        "cart_ea" : cart_ea
      },
      success: function(result) {
        if(result.code == "-1"){
          alert(result.code_msg);
        }else{
          alert("수정 되었습니다.");
          location.reload();
        }
      }
    });

  }

</script>
