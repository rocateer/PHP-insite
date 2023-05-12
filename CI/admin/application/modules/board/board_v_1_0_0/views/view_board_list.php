<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>게시판 관리</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
      <table class="search_table">
        <colgroup>
          <col style="width:15%">
          <col style="width:35%">
          <col style="width:15%">
          <col style="width:35%">
        </colgroup>
        <tbody>
          <tr>
            <th style="text-align:center;">게시판 명</th>
            <td>
              <input name="title" id="title" class="form-control" autocomplete="off">
            </td>
            <th style="text-align:center;">게시판 상태</th>
            <td>
              <label class="radio-inline"><input type="radio" name="display_yn" value="" checked> 전체</label>
              <label class="radio-inline"><input type="radio" name="display_yn" value="Y"> 활성화</label>
              <label class="radio-inline"><input type="radio" name="display_yn" value="N"> 비활성화</label>
            </td>
          </tr>
          <tr>
          <th style="text-align:center;">익명</th>
           <td>
              <label class="radio-inline"><input type="radio" name="anony_yn" value="" checked> 전체</label>
              <label class="radio-inline"><input type="radio" name="anony_yn" value="Y"> 익명</label>
              <label class="radio-inline"><input type="radio" name="anony_yn" value="N"> 공개</label>
            </td>
            <th style="text-align:center;">등록일</th>
            <td colspan="3">
              <input name="s_date" id="s_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;">&nbsp;<span class="material-icons">date_range</span>&nbsp;~&nbsp;
              <input name="e_date" id="e_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;" >&nbsp;<span class="material-icons">date_range</span>
            </td>
          </tr>
          <tr>
            <th style="text-align:center;">접근 권한</th>
            <td colspan="3">
            &nbsp;<label class="checkbox-inline" style="width: 10%;"><input type="checkbox" name="_work_right" value="">전체</label>
              <label class="checkbox-inline" style="width: 10%;"><input type="checkbox" name="work_yn" value="N" >제한없음</label>
              <?foreach($result_list as $row){?>
              <label class="checkbox-inline" style="width: 10%;"><input type="checkbox" name="_work_right" value="<?=$row->work_idx?>" ><?=$row->work_name?></label>
              <?}?>
            </td>
          </tr>
        </tbody>
      </table>
      </form>
      <div class="text-center mt20">
        <a class="btn btn-success" href="javascript:void(0)" onclick="default_list_get(1);">검색</a>
      </div>
    </div>
    <!-- search : e -->
    <div class="bg_wh" id="list_ajax"></div>
  </div>
</div>
<!-- container-fluid : e -->
<input type="text" name="page_num" id="page_num" value="1"  style="display:none">

<script>

  $(document).ready(function(){
    setTimeout("default_list_get($('#page_num').val())", 10);
  });

  // 커뮤니티 리스트 가져오기
  function default_list_get(page_num){
    $('#page_num').val(page_num);

    var formData = {
      'title' : $('#title').val(),
      'display_yn' :  $("input[name='display_yn']:checked").val(),
      'anony_yn' :  $("input[name='anony_yn']:checked").val(),
      'work_arr' : get_checkbox_value('_work_right'),
      's_date' : $('#s_date').val(),
      'e_date' : $('#e_date').val(),
      'history_data' : window.history.length,
      'page_num' : page_num,
    };

    $.ajax({
      url      : "/<?=mapping('board')?>/board_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {

        $('#list_ajax').html(result);
      }
    });
  }

  // 상태 수정
  function board_state_mod_up(board_idx, display_yn){

var formData = {
  "board_idx" : board_idx,
  "display_yn" : display_yn
};

$.ajax({
  url      : "/<?=mapping('board')?>/board_state_mod_up",
  type     : 'POST',
  dataType : 'json',
  async    : true,
  data     : formData,
  success: function(result){
    if(result.code == "0"){
      alert(result.code_msg);
    }else{
      alert(result.code_msg);
      location.reload();
    }
  }
});
}


</script>
