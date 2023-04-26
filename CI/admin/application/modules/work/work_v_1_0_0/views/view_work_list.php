  <!-- container-fluid : s -->
  <div class="container-fluid">
		<div class="page-header">
			<h1>직종 인증 신청 관리</h1>
		</div>

    <form id="form_default" name="form_default" >
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
                <th style="text-align:center">이름</th>
                <td>
                  <input class="form-control " name="member_name" id="member_name">
                </td>
              </tr>
      				<tr>
                <th style="text-align:center">닉네임</th>
                <td>
                  <input class="form-control " name="member_nickname" id="member_nickname">
                </td>
                <th style="text-align:center">직종</th>
                <td>
                  <select name="work" id="work" class="form-control w_auto">
                    <option value="">선택</option>
                    <?foreach($work_list as $row1){?>
                      <option value="<?=$row1->work_name?>"><?=$row1->work_name?></option>
                    <?}?>
                  </select>
                </td>
              </tr>
              <tr>
                <th style="text-align:center">요청일</th>
                <td>
                  <input name="s_date" id="s_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;">&nbsp;<span class="material-icons">date_range</span>&nbsp;~&nbsp;
                  <input name="e_date" id="e_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;" >&nbsp;<span class="material-icons">date_range</span>
                </td>
                <th style="text-align:center">상태</th>
      					<td>
                  <label class="radio-inline"><input type="radio"  name="state" id="state_1"   value="" checked> 전체</label>
                  <label class="radio-inline"><input type="radio" name="state" id="state_2"  value="0">승인요청</label>
                  <label class="radio-inline"><input type="radio" name="state" id="state_3"  value="2">거절</label>
                  <label class="radio-inline"><input type="radio" name="state" id="state_4"  value="1">승인</label>
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
      'member_name' :  $('#member_name').val(),
      'member_nickname' :  $('#member_nickname').val(),
      's_date' :  $('#s_date').val(),
      'e_date' :  $('#e_date').val(),
      'work' :  $('select[name="work"]').val(),
      'state' :  $('input[name="state"]:checked').val(),
      'history_data' : window.history.length,
      'page_num' : page_num
    };

    $.ajax({
      url      : "/<?=mapping('work')?>/work_list_get",
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
