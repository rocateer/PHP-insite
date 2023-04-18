<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>FAQ 관리</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <!-- search : s -->
  	<div class="table-responsive">
      <form name="form_default" id="form_default" onkeypress="enter_form();">
    		<table class="search_table">
          <colgroup>
            <col style="width:15%;">
            <col style="width:35%;">
            <col style="width:15%;">
            <col style="width:35%;">
          </colgroup>
          <tbody>
            <tr>
              <th style="text-align:center">제목</th>
              <td>
                <input name="title" id="title" class="form-control" placeholder="">
              </td>
              <th style="text-align:center">등록일</th>
              <td>
                <input name="s_date" id="s_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;">&nbsp;<span class="material-icons">date_range</span>&nbsp;~&nbsp;
                <input name="e_date" id="e_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;" >&nbsp;<span class="material-icons">date_range</span>
              </td>
            </tr>
          </tbody>
        </table>
      </form>
      <div class="text-center mt20">
        <a href="javascript:void(0)" onclick="default_list_get(1);" class="btn btn-success" id="btn_search">검색</a>
      </div>
    </div>
    <!-- search : e -->

    <div class="bg_wh mb20">
      <div class="table-responsive">
        <div id="list_ajax"></div>
      </div>
    </div>
  </div>
</div>

<input type="text" name="page_num" id="page_num" value="1" style="display:none">

<script>

  
//엔터키 시 검색
window.addEventListener('keydown', function(event){
  if (window.event.keyCode == 13) {
    // 엔터키가 눌렸을 때 실행할 내용
    default_list_get(1);
  }
})

  $(document).ready(function(){
    setTimeout("default_list_get($('#page_num').val())", 10);
  });

  // faq 리스트 가져오기
  function default_list_get(page_num){
    $('#page_num').val(page_num);

    var formData = {
      'history_data' : window.history.length,
      'title' : $('#title').val(),
      's_date' : $('#s_date').val(),
      'e_date' : $('#e_date').val(),
      'page_num' : page_num
    };

    $.ajax({
      url      : "/<?=mapping('faq')?>/faq_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

</script>
