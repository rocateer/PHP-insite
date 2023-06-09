  <!-- container-fluid : s -->
  <div class="container-fluid">
		<div class="page-header">
			<h1>회원 관리</h1>
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
                <th style="text-align:center">지역</th>
                <td>
                  <select name="city_name" id="city_name" class="form-control" style="width:40%;" onchange="region_list(this.value)">
                    <option value="">선택</option>
                    <?foreach($result_list as $row){?>
                      <option value="<?=$row->city_name?>"><?=$row->city_name?></option>
                    <?}?>
                  </select> >
                  <select name="region_code" id="region_code" class="form-control" style="width:40%;">
                  </select>
                </td>
              </tr>
              <tr>
                <th style="text-align:center">회원상태</th>
      					<td>
                  <label class="radio-inline"><input type="radio"  name="member_state" id="member_state_1"   value="" checked> 전체</label>
                  <label class="radio-inline"><input type="radio" name="member_state" id="member_state_2"  value="N">이용중</label>
                  <label class="radio-inline"><input type="radio" name="member_state" id="member_state_3"  value="P">이용정지</label>
                  <label class="radio-inline"><input type="radio" name="member_state" id="member_state_4"  value="Y">탈퇴</label>
                </td>
                <th style="text-align:center">가입유형</th>
      					<td>
                  <label class="radio-inline"><input type="radio"  name="member_join_type" id="member_join_type_1" value="" checked> 전체</label>
                  <label class="radio-inline"><input type="radio" name="member_join_type" id="member_join_type_2"  value="C">일반</label>
                  <label class="radio-inline"><input type="radio" name="member_join_type" id="member_join_type_3"  value="K">카카오</label>
                  <label class="radio-inline"><input type="radio" name="member_join_type" id="member_join_type_4" value="N">네이버</label>
                  <label class="radio-inline"><input type="radio" name="member_join_type" id="member_join_type_5" value="A">애플</label>
                </td>
              </tr>
              <tr>
                <th style="text-align:center">가입일</th>
                <td>
                  <input name="s_date" id="s_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;">&nbsp;<span class="material-icons">date_range</span>&nbsp;~&nbsp;
                  <input name="e_date" id="e_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;" >&nbsp;<span class="material-icons">date_range</span>
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
      'city_name' :  $('select[name="city_name"]').val(),
      'region_code' :  $('select[name="region_code"]').val(),
      'work' :  $('select[name="work"]').val(),
      'member_state' :  $('input[name="member_state"]:checked').val(),
      'member_join_type' :  $('input[name="member_join_type"]:checked').val(),
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

//시,구,군 가져오기
var region_list = function(city_name) {

$.ajax({
  url: "/common/region_list",
  type: 'POST',
  dataType: 'json',
  async: true,
  data: {
      "city_name" : city_name
  },
  success: function(dom){
    var selectStr = "";

    $('#region_code').html("<option value=''>선택</option>");
    if(dom.length != 0) {
      for(var i = 0; i < dom.length; i ++) {
        selectStr += "<option value='"+ dom[i].region_code  + "'>" + dom[i].region_name + "</option>";
      }
      $('#region_code').append(selectStr);
    }
  }
});
}


</script>
