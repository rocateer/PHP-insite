<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>프로그램 등록</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <section>
        <table class="table table-bordered td_left">
          <colgroup>
            <col style="width:15%">
            <col style="width:35%">
            <col style="width:15%">
            <col style="width:35%">
          </colgroup>
          <tbody>
          <tr>
              <th> <span class="text-danger">* </span>프로그램 카테고리</th>
              <td>
              <select name="category_management_idx" id="category_management_idx" class="form-control">
                  <option value="">선택</option>
                  <?foreach($result_list as $row){?>
                    <option value="<?=$row->category_management_idx?>"><?=$row->category_name?></option>
                  <?}?>
                </select>
              </td>
              <th ><span class="text-danger">* </span>난이도</th>
                <td>
                <label class="radio-inline"><input type="radio" name="level" value="1"> 1</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="2"> 2</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="3" checked> 3</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="4"> 4</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="5"> 5</label>
                </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>프로그램 명</th>
              <td colspan="3">
                <input type="text" name="title" id="title" value="" class="form-control">
              </td>
            </tr>
            <tr>
              <th style="height:200px;">
                <span class="text-danger">* </span>
                대표 이미지<br />(000x000)<br />
                <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img','image','1','150');" style="margin-bottom:10px"></p>
              </th>
              <td colspan="3">
                <div class="view_img mg_btm_20">
                  <ul class="img_hz" id="img"></ul>
                </div>
              </td>
            </tr>
            <tr>
              <th>영상 url</th>
              <td colspan="3">
                <input type="text" name="url_link" id="url_link" value="" class="form-control">
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>운동 선택</th>
              <td colspan="3">
              <select name="exercise_idx" id="exercise_idx" class="form-control mt10" style="width:60%">
                  <option value="">선택</option>
                  <?foreach($exercise_list as $row){?>
                    <option value="<?=$row->exercise_idx?>"><?=$row->title?></option>
                  <?}?>
                </select>
                <a href="javascript:void(0)"  onClick="exercise_reg()" class="btn btn-success mt10">등록</a>
                <div id="list_ajax" class="mt10"></div>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>내용</th>
              <td colspan="3">
              <textarea name="contents" style="width:100%; height:200px;" id="contents" placeholder="내용" class="input_default"></textarea>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <div class="row">
        <div class="col-lg-12 text-right">
          <a href="javascript:void(0)"  onClick="default_list()" class="btn btn-gray">목록</a>
          <a href="javascript:void(0)"  onClick="default_reg()" class="btn btn-success">등록</a>
        </div>
      </div>
    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->

<input type="text" id="temporary_idx" name="temporary_idx" value="<?=$temporary_idx?>" style="display: none;">

<script>
  // 프로그램 목록
  function default_list(){
    location.href ='/<?=mapping('program')?>/program_list';
  }

  $(document).ready(function(){
     setTimeout("default_list_get()", 10);
  })

  // 관리 리스트 불러오기
  function default_list_get() {

    var form_data = {
      'program_idx' : $('#temporary_idx').val(),
    };

    $.ajax({
      url: "/<?=mapping('program')?>/program_reg_list_get",
      type: 'POST',
      dataType : 'html',
      async: true,
      data: form_data,
      success: function(result) {
        $('#list_ajax').html(result);
      }
  });
}


  // 프로그램 등록하기
  function default_reg(){

    var exercise_time=$("#exercise_time").val();

    if(exercise_time==0){
      alert("운동을 등록해주세요.");
      return;
    }

    var form_data = {
      "title" : $("#title").val(),
      "category_management_idx" : $("select[name='category_management_idx']").val(),
      "level" : $("input[name='level']:checked").val(),
      "img_path" : $("input[name='img']:checked").val(),
      "url_link" : $("#url_link").val(),
      "temporary_idx" : $("#temporary_idx").val(),
      "exercise_time" : $("#exercise_time").val(),
      "contents" : $("#contents").val()
    };

    $.ajax({
      url      : "/<?=mapping('program')?>/program_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        } else {
         alert(result.code_msg);
          location.href ='/<?=mapping('program')?>/program_list';
        }
      }
    });
  }

  // 운동 등록
  function exercise_reg(){

    var exercise_idx = $("select[name='exercise_idx']").val();

    if(exercise_idx==''){
      alert("운동을 선택해주세요.");
      return;

    }

    var form_data = {
      "program_idx" : $("#temporary_idx").val(),
      "exercise_idx" : exercise_idx,
    };

    $.ajax({
      url      : "/<?=mapping('program')?>/exercise_reg",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        } else {
          alert(result.code_msg);
          default_list_get();
        }
      }
    });
  }

  // 운동 삭제
  function exercise_del(program_exercise_idx){

    var form_data = {
      "program_exercise_idx" : program_exercise_idx
    };

    $.ajax({
      url      : "/<?=mapping('program')?>/exercise_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        } else {
          alert(result.code_msg);
          default_list_get();
        }
      }
    });
  }

</script>
