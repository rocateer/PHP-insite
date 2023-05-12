<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>게시판 등록</span></h1>
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
              <th><span class="text-danger">* </span>게시판 명</th>
              <td colspan="3">
                <input type="text" name="title" id="title" value="" class="form-control">
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>접근 권한</th>
              <td colspan="3">
                <label class="radio-inline"><input type="radio" name="work_yn" value="Y" checked> 선택</label>
                <div style="margin-left: 20px;">
                  <?foreach($result_list as $row){?>
                  <label class="checkbox-inline" style="width: 10%;"><input type="checkbox" name="_work_right" value="<?=$row->work_idx?>" ><?=$row->work_name?></label>
                  <?}?>
                </div>
                <div class="mt10" style="text-align: right;">
                  비회원/비인증 회원 상세 보기 권한
                  <label class="radio-inline"><input type="radio" name="detail_yn" value="Y" checked> 가능</label>
                  <label class="radio-inline"><input type="radio" name="detail_yn" value="N"> 불가</label>
                </div>

                <div style="width:100%;">
                  <label class="radio-inline"><input type="radio" name="work_yn" value="N"> 제한없음 (인증하지 않은 회원 포함)</label>
                </div>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>익명</th>
              <td colspan="3">
                <label class="radio-inline"><input type="radio" name="anony_yn" value="Y" checked> 익명</label>
                <label class="radio-inline"><input type="radio" name="anony_yn" value="N"> 공개</label>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>소개글</th>
              <td colspan="4" class="table_left" colspan="3">
                <textarea class="input_default textarea_box" name="contents" id="contents" placeholder="내용"></textarea>
              </td>
            </tr>
            <tr style="height:200px;">
              <th><span class="text-danger">* </span>아이콘
                <p>(000x000)</p>
                <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img','image','1','150');" style="margin-bottom:10px"></p>
              </th>
              <td colspan="3">
                <div class="view_img mg_btm_20">
                  <ul class="img_hz" id="img"></ul>
                </div>
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

<script>
  // post관리 목록
  function default_list(){
    history.back(-1);
  }
  // post관리 등록하기
  function default_reg(){

    var work_yn =  $("input[name='work_yn']:checked").val();
    var work_arr =  get_checkbox_value('_work_right');

    if(work_yn=='Y'){
      if(work_arr==''){
        alert("접근권한 직업을 선택해주세요.");
        return;
      }
    }

    var form_data = {
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
      url      : "/<?=mapping('board')?>/board_reg_in",
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
