<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>게시판 상세</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <section>
        <form name="form_default" id="form_default" method="post">
          <table class="table table-bordered td_left">
            <colgroup>
            	<col style="width:15%">
            	<col style="width:35%">
            	<col style="width:15%">
            	<col style="width:35%">
            </colgroup>
            <tbody>
             <tr>
              <th><span class="text-danger">* </span>게시판 명</th>
              <td colspan="3">
                <input type="text" name="title" id="title" value="<?=$result->title?>" class="form-control">
              </td>
            </tr>
            <tr>
              <? $work_arr = explode(',',$result->work_arr); ?>
              <th><span class="text-danger">* </span>접근 권한</th>
              <td colspan="3">
                <label class="radio-inline"><input type="radio" name="work_yn" value="Y" <?=($result->work_yn=='Y')?'checked':''?> > 선택</label>
                <div style="margin-left: 20px;">
                  <?foreach($result_list as $row){?>
                    <label class="checkbox-inline" style="width: 10%;"><input type="checkbox" name="_work_right" value="<?=$row->work_idx?>" <?=(in_array($row->work_idx,$work_arr))?'checked':''?> <?=($result->work_yn=='N')?'disabled':''?> ><?=$row->work_name?></label>
                  <?}?>
                </div>
                <div class="mt10" style="text-align: right;">
                  비회원/비인증 회원 상세 보기 권한
                  <label class="radio-inline"><input type="radio" name="detail_yn" value="Y" <?=($result->detail_yn=='Y')?'checked':''?>> 가능</label>
                  <label class="radio-inline"><input type="radio" name="detail_yn" value="N" <?=($result->detail_yn=='N')?'checked':''?>> 불가</label>
                </div>

                <div style="width:100%;">
                  <label class="radio-inline"><input type="radio" name="work_yn" value="N" <?=($result->work_yn=='N')?'checked':''?> > 제한없음 (인증하지 않은 회원 포함)</label>
                </div>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>익명</th>
              <td colspan="3">
                <label class="radio-inline"><input type="radio" name="anony_yn" value="Y" <?=($result->anony_yn=='Y')?'checked':''?>> 익명</label>
                <label class="radio-inline"><input type="radio" name="anony_yn" value="N" <?=($result->anony_yn=='N')?'checked':''?>> 공개</label>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>소개글</th>
              <td colspan="4" class="table_left" colspan="3">
                <textarea class="input_default textarea_box" name="contents" id="contents" placeholder="내용"><?=$result->contents?></textarea>
              </td>
            </tr>
              <tr  style="height:200px;">
              <th><span class="text-danger">* </span>아이콘
                <p>(000x000)</p>
                <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img','image','1','150');" style="margin-bottom:10px"></p>
              </th>
                <td colspan="3">
                  <div>
                   <ul class="img_hz" id="img">
                      <?php if($result->img != ""){ ?>
                        <li id="id_file_img_0" style="display:inline-block;">
                          <img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img_0')"/><br>
                          <img src="<?=$result->img?>" style="width:150px">
                          <input type="hidden" name="img_path[]" id="img_path[]" value="<?=$result->img?>"/>
                          <input type='checkbox' name='img' value='<?=$result->img?>' checked style='display:none' />
                        </li>
                      <?php } ?>
                    </ul>
                  </div>
                </td>
              </tr>
             
            </tbody>
          </table>

        </form>
      </section>

      <div class="row">
        <div class="col-lg-12 text-right">
          <a href="javascript:void(0)" onclick="default_list()" class="btn btn-gray">목록</a>
          <?if($result->display_yn=='Y'){?>
          <a href="javascript:void(0)" onclick="display_mod_up('N')" class="btn btn-info">비활성화</a>
          <?}else{?>
            <a href="javascript:void(0)" onclick="display_mod_up('Y')" class="btn btn-info">활성화</a>
            <?}?>
          <a href="javascript:void(0)" onclick="default_mod_up()" class="btn btn-success">수정</a>
        </div>
      </div>
    </div>
  </div>
  <!-- body : e -->
</div>

<!-- container-fluid : e -->
<input type="text" name="board_idx" id="board_idx" value="<?=$result->board_idx?>" style="display:none;">
<script>

  // 공지사항 목록
  function default_list(){
    history.back(<?=$history_data?>);
  }

// 노출여부 상태 수정
function display_mod_up(display_yn){

  var board_idx = $("#board_idx").val();

  var formData = {
    "board_idx" : board_idx,
    "display_yn" : display_yn
  };

  $.ajax({
    url      : "/<?=mapping('board')?>/display_yn_mod_up",
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

function default_list(){
  history.back(<?=$history_data?>);
}

function default_mod_up(){

  var work_yn =  $("input[name='work_yn']:checked").val();
  var work_arr =  get_checkbox_value('_work_right');

  if(work_yn=='Y'){
    if(work_arr==''){
      alert("접근권한 직업을 선택해주세요.");
      return;
    }
  }

  var form_data = {
    "board_idx" : $("#board_idx").val(),
    "title" : $("#title").val(),
    "work_yn" : work_yn,
    "detail_yn" : $("input[name='detail_yn']:checked").val(),
    "anony_yn" : $("input[name='anony_yn']:checked").val(),
    "img_path" : $("input[name='img']:checked").val(),
    "work_arr" : work_arr,
    "contents" : $("#contents").val(),
  };

  console.log(form_data);

  $.ajax({
    url      : "/<?=mapping('board')?>/board_mod_up",
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
        alert("등록 실패!");
      } else {
        alert("등록 되었습니다.");
        location.href ='/<?=mapping('board')?>/board_list';
      }
    }
  });
}

  $("input[name='work_yn']").click(function(){
    if($(this).val()=='N'){
      $("input[name='_work_right']").attr("disabled",true);
      $("input[name='_work_right']").prop("checked",false);
    }else{
      $("input[name='_work_right']").attr("disabled",false);
    }
  });

</script>
