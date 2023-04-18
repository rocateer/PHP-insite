  <!-- container-fluid : s -->
  <div class="container-fluid">
		<div class="page-header">
			<h1>회원 관리</h1>
		</div>

    <form id="form_default" name="form_default" onkeypress="enter_form();" >
      <!-- body : s -->
      <div class="bg_wh mt20">
        <!-- search : s -->
      	<div class="table-responsive">
      		<table class="search_table">
            <colgroup>
              <col style="width:15%">
              <col style="width:35%">
              <col style="width:15%">
              <col style="width:35%">
            </colgroup>
      			<tbody>
      				<tr>
                <th style="text-align:center">아이디(이메일)</th>
                <td>
                  <input class="form-control " name="member_id" id="member_id">
                </td>
                <th style="text-align:center">닉네임</th>
                <td>
                  <input class="form-control " name="member_nickname" id="member_nickname">
                </td>
              </tr>
              <tr>
                <th style="text-align:center">회원상태</th>
      					<td>
                  <label class="radio-inline"><input type="radio"  name="member_state" id="member_state"   value="" checked> 전체</label>
                  <label class="radio-inline"><input type="radio" name="member_state" id="member_state"  value="0">이용중</label>
                  <label class="radio-inline"><input type="radio" name="member_state" id="member_state"  value="1">이용정지</label>
                  <label class="radio-inline"><input type="radio" name="member_state" id="member_state"  value="3">탈퇴</label>
                </td>
                <th style="text-align:center">가입일</th>
                <td>
                  <input name="s_date" id="s_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;">&nbsp;<span class="material-icons">date_range</span>&nbsp;~&nbsp;
                  <input name="e_date" id="e_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;" >&nbsp;<span class="material-icons">date_range</span>
                </td>
              </tr>
            
            </tbody>
      		</table>
      		<div class="text-center mt20">
      			<a href="#"  onclick = "default_list_get('1');" class="btn btn-success">검색</a>
      		</div>
      	</div>
        <!-- search : e -->

      	<div class="table-responsive">
      		<!-- top  -->
					<div id="list_ajax">
            <!--리스트-->
          </div>
        </div><!-- table-responsive -->
      </div>
      <!-- body : e -->
  </div>
  <!-- container-fluid : e -->


  <input type="hidden" name="page_num" id="page_num" value="1">

<script language="javascript">

$(document).ready(function(){
    setTimeout("default_list_get($('#page_num').val())", 10);
  });

  function default_list_get(page_num){
    $("#page_num").val(page_num);

    var formData = {
      'member_id' :  $('#member_id').val(),
      'member_nickname' :  $('#member_nickname').val(),
      's_date' :  $('#s_date').val(),
      'e_date' :  $('#e_date').val(),
      'member_state' :  $('input[name="member_state"]:checked').val(),
      'history_data' : window.history.length,
      'page_num' : page_num
    };

    $.ajax({
      url      : "/<?=mapping('member')?>/member_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }


//엑셀저장
var do_excel_down = function() {
  document.form_default.action ="/<?=mapping('member')?>/member_list_excel";
  document.form_default.submit();
}

</script>
