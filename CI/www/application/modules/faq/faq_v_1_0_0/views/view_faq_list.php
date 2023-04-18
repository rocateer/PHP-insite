<div class="body">

  <div class="inner_wrap">
    <h2 class="title txt_center">FAQ</h2>

    <div>
      <ul id="list_ajax" class="faq_list mt40"></ul>
    </div>

  </div>
</div>

<input name="page_num" id="page_num" type="hidden" value="1">
<script>

  $(function(){
    default_list_get();
  });

  //list_get
  function default_list_get(){

    var page_num = $('#page_num').val();

    $.ajax({
      url      : "/<?=mapping('faq')?>/faq_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : {
               "page_num":page_num
      },
      success  : function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  //페이지 이동
  var page_go=function(page){
    $('#page_num').val(page);
  	$(default_list_get());
  }

  </script>
