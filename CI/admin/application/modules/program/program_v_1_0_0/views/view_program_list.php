<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>프로그램 관리</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <!-- search : s -->
    <div class="table-responsive">
      <form name="form_default" id="form_default">
        <table class="search_table">
          <colgroup>
            <col style="width:15%">
            <col style="width:35%">
            <col style="width:15%">
            <col style="width:35%">
          </colgroup>
          <tbody>
            <tr>
              <th style="text-align:center">프로그램명</th>
              <td>
                <input class="form-control" name="title" id="title">
              </td>
              <th style="text-align:center">노출 여부</th>
              <td>
                <label class="radio-inline"><input type="radio" name="display_yn" value="" checked> 전체</label>
                <label class="radio-inline"><input type="radio" name="display_yn" value="Y"> 게시중</label>
                <label class="radio-inline"><input type="radio" name="display_yn" value="N"> 노출 안함</label>
              </td>
            </tr>
            <tr>
              
              <th style="text-align:center">프로그램 카테고리</th>
              <td>
              <select name="category_management_idx" id="category_management_idx" class="form-control">
                  <option value="">선택</option>
                  <?foreach($result_list as $row){?>
                    <option value="<?=$row->category_management_idx?>"><?=$row->category_name?></option>
                  <?}?>
                </select>
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
        <a href="javascript:void(0)" class="btn btn-success" onclick="default_list_get('1');">검색</a>
      </div>

    </div>
    <!-- search : e -->

    <div class="table-responsive">
      <!-- list_get : s -->
      <div id="list_ajax">
        <!--리스트-->
      </div>
      <!-- list_get : e -->
    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->
<input type="text" name="page_num" id="page_num" value="1" style="display:none">

<script language="javascript">

  $(document).ready(function(){
     setTimeout("default_list_get($('#page_num').val())", 10);
  })

  // 동행 관리 리스트 불러오기
  var default_list_get = function(page_num) {
    $('#page_num').val(page_num);

    var form_data = {
      'title' : $('#title').val(),
      'display_yn' : $('input[name="display_yn"]:checked').val(),
      'category_management_idx' : $('select[name="category_management_idx"]').val(),
      's_date' : $('#s_date').val(),
      'e_date' : $('#e_date').val(),
      'history_data' : window.history.length,
      'page_num' : page_num
    };

    $.ajax({
      url: "/<?=mapping('program')?>/program_list_get",
      type: 'POST',
      dataType : 'html',
      async: true,
      data: form_data,
      success: function(result) {
        $('#list_ajax').html(result);
      }
  });
}

  // 상태 수정
  function program_state_mod_up(program_idx, display_yn){

    var formData = {
      "program_idx" : program_idx,
      "display_yn" : display_yn
    };

    $.ajax({
      url      : "/<?=mapping('program')?>/program_state_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success: function(result){
        if(result.code == "0"){
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          default_list_get($('#page_num').val());
        }
      }
    });
    }

</script>
