<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>프로그램 상세</h1>
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
                    <option value="<?=$row->category_management_idx?>" <?=($result->category_management_idx==$row->category_management_idx)?'selected':''?> ><?=$row->category_name?></option>
                  <?}?>
                </select>
              </td>
              <th ><span class="text-danger">* </span>난이도</th>
                <td>
                <label class="radio-inline"><input type="radio" name="level" value="1" <?=($result->level==1)?'checked':''?> > 1</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="2" <?=($result->level==2)?'checked':''?> > 2</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="3" <?=($result->level==3)?'checked':''?> > 3</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="4" <?=($result->level==4)?'checked':''?> > 4</label>&nbsp;&nbsp;&nbsp;
                <label class="radio-inline"><input type="radio" name="level" value="5" <?=($result->level==5)?'checked':''?> > 5</label>
                </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>운동명</th>
              <td colspan="3">
                <input type="text" name="title" id="title" value="<?=$result->title?>" class="form-control">
              </td>
            </tr>
            <tr>
              <th>
              <span class="text-danger">* </span> 대표 이미지<br />(000x000)<br />
                <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img','image','1','150');" style="margin-bottom:10px"></p>
              </th>
              <td colspan="3">
                <div class="view_img mg_btm_20">
                  <ul class="img_hz" id="img">
                    <?php if($result->img_path != ""){ ?>
                      <li id="id_file_img_0" style="display:inline-block;">
                        <img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img_0')"/><br>
                        <img src="<?=$result->img_path?>" style="width:150px">
                        <input type="hidden" name="img_path[]" id="img_path[]" value="<?=$result->img_path?>"/>
                        <input type="checkbox" name="img" value="<?=$result->img_path?>" checked style="display:none">
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </td>
            </tr>
            <tr>
              <th>영상 url</th>
              <td colspan="3">
                <input type="text" name="url_link" id="url_link" value="<?=$result->url_link?>" class="form-control">
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
              <textarea name="contents" style="width:100%; height:200px;" id="contents" placeholder="내용" class="input_default"><?=$result->contents?></textarea>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

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
              <th> 조회수</th>
              <td>
              <?=$result->view_cnt?>
              </td>
              <th >좋아요 수</th>
                <td>
                <?=$result->like_cnt?>
                </td>
            </tr>
            <tr>
              <th> 총 운동시간</th>
              <td id="total_time">
              </td>
              <th >난이도</th>
                <td>
                <?=$result->level?>
                </td>
            </tr>
           
          </tbody>
        </table>
      </section>

      <div class="row">
        <div class="col-lg-12 text-right">
          <a href="javascript:void(0)"  onClick="default_list()" class="btn btn-gray">목록</a>
          <a href="javascript:void(0)" onClick="default_del('<?=$result->program_idx?>')" class="btn btn-danger">삭제</a>
          <a href="javascript:void(0)"  onClick="default_mod()" class="btn btn-info">수정</a>
        </div>
      </div>
    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->

<input type="text" name="page_num" id="page_num" value="1" style="display: none;">
<input type="text" name="program_idx" id="program_idx" value="<?=$result->program_idx?>" style="display: none;">

<script>
  
  $(document).ready(function(){
     setTimeout("default_list_get()", 10);
  })

  function set_time(){
    var time = $('#exercise_time').val();
    var min = time.substr(3,2);
    var sec = time.substr(6);
    var time_str='';
    if(min=='00'){
      time_str = sec+'초';
    }else{
      time_str = min+'분 '+sec+'초';
    }
    $('#total_time').text(time_str);
  }

  // 관리 리스트 불러오기
  function default_list_get() {

    var form_data = {
      'program_idx' : $('#program_idx').val(),
    };

    $.ajax({
      url: "/<?=mapping('program')?>/program_reg_list_get",
      type: 'POST',
      dataType : 'html',
      async: true,
      data: form_data,
      success: function(result) {
        $('#list_ajax').html(result);
        set_time();
      }
  });
}
  
  // 운동관리 목록
  function default_list(){
    history.back(<?=$history_data?>);
  }

  // 운동관리 수정
  function default_mod(){
    
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
      "program_idx" : $("#program_idx").val(),
      "exercise_time" : $("#exercise_time").val(),
      "contents" : $("#contents").val()
    };

    $.ajax({
      url      : "/<?=mapping('program')?>/program_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result){
        if(result.code == "-1"){
          alert(result.code_msg);
        }
        if(result.code == "1"){
          alert(result.code_msg);
          history.back(-1);
        }
      }
    });
  }
  
  // 운동관리 삭제
  function default_del(program_idx){

    if(!confirm("삭제하시겠습니까?")){
      return;
    }

    $.ajax({
      url      : "/<?=mapping('program')?>/program_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "program_idx" : program_idx
      },
      success: function(result) {
        if(result.code == '-1') {
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          history.back(-1);
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
      "program_idx" : $("#program_idx").val(),
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
