<div class="body">
  <div class="inner_wrap">
    <div class="page_top_title">
      <h1>주문/결제</h1>
      <p class="path">HOME<span>&gt;</span>주문/결제<span></p>
    </div>

    <div class="cart_list" >
      <div id="list_ajax">  </div>


      <!-- order_info_wrap : s -->
      <div class="order_info_wrap">

        <!-- delivery_info : s -->
        <div class="delivery_info">
          <h2>배송지 정보</h2>
          <table>
            <tr>
              <th>배송지선택</th>
              <td>
                <input type="radio" id="basic_address" name="address_chk" checked onClick="check_address('Y')"><label for="basic_address"><span></span>기본배송지</label>
                <input type="radio" id="new_address" name="address_chk"  onClick="check_address('N')"><label for="new_address"><span></span>신규배송지</label>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="address_view">
                  <?=$result->receiver_name?><br>
                  <?=$result->receiver_tel?><br>
                  <?=$result->receiver_addr?> <?=$result->receiver_addr_detail?>
                </div>
              </td>
            </tr>
            <tr>
              <th>수령인</th>
              <td><input class="s_input" type="text" name="receiver_name" id="receiver_name" value="<?=$result->receiver_name?>"></td>
            </tr>
            <tr>
              <th>연락처</th>
              <td><input class="m_input" type="text" name="receiver_tel" id="receiver_tel" value="<?=$result->receiver_tel?>"></td>
            </tr>
            <tr>
              <th>배송지 주소</th>
              <td>
                <div class="input_btn_wrap">
                  <input class="s_input" type="text"  name="receiver_post_number" id="receiver_post_number" value="<?=$result->receiver_post_number?>">
                  <span class="btn_form"><a href="#">우편번호</a></span>
                  <input type="checkbox" id="basic_address_chk" name="basic_address_chk" value="Y"><label for="basic_address_chk"><span></span>기본배송지로 선택</label>
                </div>
                <input type="text"  name="receiver_addr" id="receiver_addr" value="<?=$result->receiver_addr?>">
                <input type="text"  name="receiver_addr_detail" id="receiver_addr_detail" value="<?=$result->receiver_addr_detail?>">
              </td>
            </tr>
            <tr>
              <th>배송메모</th>
              <td><input type="text" name=""></td>
            </tr>
          </table>

          <h2 class="mt45"> 포인트 사용</h2>
          <table>
           <tr>
              <th>포인트</th>
              <td>
                <div class="input_btn_wrap">
                  <input class="s_input" type="text" name="use_point" id="use_point">
                  <span class="btn_form"><a href="javascript:point_all_apply()">전체사용</a> <a href="javascript:point_apply('Y')">사용</a> <a href="javascript:point_apply('N')">취소</a></span>
                  <span class="fs_12">(사용가능 포인트: <strong><?=number_format($result->member_enable_point)?></strong>원)</span>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <!-- delivery_info : e -->

        <!-- order_info : s -->
        <div class="order_info">
          <strong>주문자 정보</strong>
          <input type="text" name="" value="<?=$result->order_name?>" placeholder="성함" readonly>
          <input type="text" name="" value="<?=$result->order_tel?>" placeholder="연락처" readonly>
          <input type="text" name="" value="<?=$result->order_email?>" placeholder="이메일" readonly>

          <input type="hidden" name="tot_product_price" id="tot_product_price" value="" placeholder="" >
          <input type="hidden" name="tot_delivery_price"  id="tot_delivery_price" value="" placeholder="" >
          <input type="hidden" name="tot_member_coupon_price"  id="tot_member_coupon_price" value="" placeholder="" >
          <input type="hidden" name="tot_payment_price"  id="tot_payment_price" value="" placeholder="" >
          <input type="hidden" name="db_member_enable_point"  id="db_member_enable_point" value="<?=$result->member_enable_point?>" placeholder="" >

          <input type="hidden" name="db_receiver_name"  id="db_receiver_name" value="<?=$result->receiver_name?>" placeholder="" >
          <input type="hidden" name="db_receiver_tel"  id="db_receiver_tel" value="<?=$result->receiver_tel?>" placeholder="" >
          <input type="hidden" name="db_receiver_post_number"  id="db_receiver_post_number" value="<?=$result->receiver_post_number?>" placeholder="" >
          <input type="hidden" name="db_receiver_addr"  id="db_receiver_addr" value="<?=$result->receiver_addr?>" placeholder="" >
          <input type="hidden" name="db_receiver_addr_detail"  id="db_receiver_addr_detail" value="<?=$result->receiver_addr_detail?>" placeholder="" >


          <table>
            <tr>
              <th>총 상품금액</th>
              <td><span id="span_product_price">0</span> 원</td>
            </tr>
            <tr>
              <th>배송비</th>
              <td><span id="span_delivery_price">0</span> 원</td>
            </tr>
            <tr>
              <th>쿠폰</th>
              <td><span id="span_member_coupon_price"></span> 원</td>
            </tr>
            <tr>
              <th>포인트</th>
              <td><span id="span_use_point"></span> 원</td>
            </tr>
          </table>

          <div class="total_pay_price">
            <p>결제예정금액</p>
            <span><strong id="span_payment_price">0</strong>원</span>
          </div>
        </div>
        <!-- order_info : e -->

      </div>
      <!-- order_info_wrap : e -->

      <div class="btn_wrap">
        <span class="btn_m btn_basic"><a href="javascript:do_order();">결제하기</a></span>
        <span class="btn_m btn_line"><a href="/">취소</a></span>
      </div>
    </div>

  </div>
</div>

<script>

  $(function(){
    default_list_get();
  });

  //상품정보
  function default_list_get(){

    $.ajax({
      url      : "/order/order_product_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : {
        "order_number" : "<?=$order_number?>"
      },
      success  : function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  //check_address
  function check_address(str){
    receiver_name =$('#db_receiver_name').val();
    receiver_tel =$('#db_receiver_tel').val();
    receiver_post_number =$('#db_receiver_post_number').val();
    receiver_addr =$('#db_receiver_addr').val();
    receiver_addr_detail =$('#db_receiver_addr_detail').val();

   if(str =="Y"){
     $('#receiver_name').val(receiver_name);
     $('#receiver_tel').val(receiver_tel);
     $('#receiver_post_number').val(receiver_post_number);
     $('#receiver_addr').val(receiver_addr);
     $('#receiver_addr_detail').val(receiver_addr_detail);
   }else{
     $('#receiver_name').val('');
     $('#receiver_tel').val('');
     $('#receiver_post_number').val('');
     $('#receiver_addr').val('');
     $('#receiver_addr_detail').val('');
   }
  }

  //포인트적용
  function point_all_apply(){
    member_enable_point =  $('#db_member_enable_point').val();
    $('#use_point').val(member_enable_point);
  }

  //포인트적용::취소
  function point_apply(apply_yn){
    use_point=  $('#use_point').val();
    if(apply_yn=="Y"){
      if(!$('#use_point').val()){
        alert('사용 포인트를 입력하세요!!');
        $('#use_point').focus();
        return;
      }
    }else{
      $('#use_point').val(0);
    }
    $.ajax({
      url      : "/order/order_point_mod_up",
      type     : "POST",
      dataType : "json",
      async    : true,
      data     : {
        "order_number" : "<?=$order_number?>",
        "use_point" :use_point,
        "apply_yn" :apply_yn,
      },
      success  : function(result) {
				if(result.code ==-1){
          alert(result.msg);
        }else{
          default_list_get();
        }

      }
    });
  }

  //쿠폰적용
  function coupon_apply(order_idx,member_coupon_idx,member_coupon_price){
    $.ajax({
      url      : "/order/coupon_apply",
      type     : "POST",
      dataType : "json",
      async    : true,
      data     : {
        "order_number" : "<?=$order_number?>",
        "use_point" :use_point,
        "member_coupon_idx" :member_coupon_idx,
        "member_coupon_price" :member_coupon_price,
      },
      success  : function(result) {
       	if(result.code ==-1){
          alert(result.msg);
        }else{
          default_list_get();
        }
      }
    });
  }

  //결제전확인
  function do_order(){
    receiver_name =$('#receiver_name').val();
    receiver_tel =$('#receiver_tel').val();
    receiver_post_number =$('#receiver_post_number').val();
    receiver_addr =$('#receiver_addr').val();
    receiver_addr_detail =$('#receiver_addr_detail').val();
    order_msg =$('#order_msg').val();

    if(!confirm("주문하시겠습니까?")){
      return;
    }

    $.ajax({
      url      : "/order/order_receiver_mod_up",
      type     : "POST",
      dataType : "json",
      async    : true,
      data     : {
        "order_number" : "<?=$order_number?>",
        "receiver_name" : receiver_name,
        "receiver_tel" : receiver_tel,
        "receiver_post_number" : receiver_post_number,
        "receiver_addr" : receiver_addr,
        "receiver_addr_detail" : receiver_addr_detail,
        "order_msg" : order_msg
      },
      success  : function(result) {
        if(result.code ==-1){
          alert(result.msg);
        }else{
          do_pay();
        }
      }
    });
  }

	//결제
  //결제전확인
  function do_pay(){

    $.ajax({
      url      : "/order/order_pay_mod_up",
      type     : "POST",
      dataType : "json",
      async    : true,
      data     : {
        "order_number" : "<?=$order_number?>",
      },
      success  : function(result) {
        if(result.code ==-1){
          alert(result.msg);
        }else{
          alert("결제왼료되었습니다.");
        }
      }
    });

  }
  </script>
