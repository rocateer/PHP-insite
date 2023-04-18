<!-- container-fluid : s -->
<div class="container-fluid  wide">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>게시글 신고 관리</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
      <table class="search_table">
        <colgroup>
          <col style="width:120px">
          <col style="width:330px">
          <col style="width:120px">
          <col style="width:330px">
        </colgroup>
        <tbody>
          <tr>
            <th style="text-align:center;">신고한 회원 닉네임</th>
            <td>
              <input name="member_nickname" id="member_nickname" class="form-control" autocomplete="off">
            </td>
            <th style="text-align:center;">신고한 회원 아이디</th>
            <td>
              <input name="member_id" id="member_id" class="form-control" autocomplete="off">
            </td>
          </tr>
          <tr>
            <th style="text-align:center;">신고 받은 회원 닉네임</th>
            <td>
              <input name="reported_member_nickname" id="reported_member_nickname" class="form-control" autocomplete="off">
            </td>
            <th style="text-align:center;">신고 받은 회원 아이디</th>
            <td>
              <input name="reported_member_id" id="reported_member_id" class="form-control" autocomplete="off">
            </td>
          </tr>
          <tr>
            <th style="text-align:center;">분류</th>
            <td>
       
              <label class="checkbox-inline"><input type="radio" name="board_type"  value="" checked>전체</label>
              <label class="checkbox-inline"><input type="radio" name="board_type" value="1" >오늘의 운동 완료</label>
              <label class="checkbox-inline"><input type="radio" name="board_type" value="0" >고민상담</label>
           
            </td>
            <th style="text-align:center;">게시 상태</th>
            <td>
              <label class="checkbox-inline"><input type="radio" name="display_yn" id="display_yn" value="" checked>전체</label>
              <label class="checkbox-inline"><input type="radio" name="display_yn" value="Y" >게시중</label>
              <label class="checkbox-inline"><input type="radio" name="display_yn" value="N" >블라인드</label>
            </td>
          </tr>
          <tr>
            <th style="text-align:center;">신고유형</th>
            <td colspan="3">
       
              <label class="checkbox-inline"><input type="radio" name="report_type"  value="" checked>전체</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="0" >영리목적 홍보성</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="1" >불법 정보</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="2" >음란성, 선정성</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="3" >욕설, 인신공격</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="4" >개인정보 노출</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="5" >같은 내용의 반복 게시(도배)</label>
              <label class="checkbox-inline"><input type="radio" name="report_type" value="6" >기타</label>
           
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

    <div class="bg_wh mt20" id="list_ajax">

    </div>

  </div>
  <!-- body : e -->

</div>
<!-- container-fluid : e -->
<input type="text" name="page_num" id="page_num" value="1"  style="display:none">

<script>
  $(document).ready(function(){
    setTimeout("default_list_get($('#page_num').val())", 10);
  })

  function default_list_get(page){
    $('#page_num').val(page);

    var formData = {
      'member_nickname' :  $('#member_nickname').val(),
      'member_id' :  $('#member_id').val(),
      'reported_member_nickname' :  $('#reported_member_nickname').val(),
      'reported_member_id' :  $('#reported_member_id').val(),
      'board_type' :  $("input[name='board_type']:checked").val(),
      'report_type' :  $("input[name='report_type']:checked").val(),
      'display_yn' :  $("input[name='display_yn']:checked").val(),
      'page_num' : page,
    };

    $.ajax({
      url      : "/<?=mapping('board_report')?>/board_report_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  function board_display_yn_mod_up(board_idx, display_yn){

    var formData = {
      "board_idx" : board_idx,
      "display_yn" : display_yn
    };

    $.ajax({
      url      : "/<?=mapping('board')?>/board_display_yn_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success: function(result){
        if(result.code == "0"){
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          default_list();
        }
      }
    });
  }

  function page_detail(board_idx,board_type,board_del_yn){
    if(board_del_yn!='N'){
      alert("삭제된 게시글 입니다.");
      return;
    }else{
      location.href='/<?=mapping('board')?>/board_detail?board_idx='+board_idx+'&board_type='+board_type;
    }
  }

</script>
