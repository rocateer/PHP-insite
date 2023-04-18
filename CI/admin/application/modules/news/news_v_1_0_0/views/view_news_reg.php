<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>매거진 등록</span></h1>
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
              <th><span class="text-danger">* </span>제목</th>
              <td colspan="3">
                <input type="text" name="title" id="title" value="" class="form-control">
              </td>
            </tr>
            <tr>
              <th style="height:200px;">
                <p>대표 이미지</p> (1장)<br />(670x560)<br />
                <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img','image','1','150');" style="margin-bottom:10px"></p>
              </th>
              <td colspan="3">
                <div class="view_img mg_btm_20">
                  <ul class="img_hz" id="img"></ul>
                </div>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>내용</th>
              <td class="td_left" colspan="3">
                <div class="editor_area btn-editor" style="width:100%">                
                  <textarea class="input-block-level" id = "contents" name="contents"></textarea>
                </div>
              </td>
            </tr>
            <tr>
              <th>노출여부</th>
              <td colspan="3">
              <label class="switch">
                <input type="checkbox" name="display_yn" id="display_yn" value="Y" checked>
                <span class="check_slider"></span>
              </label>
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
    history.back(<?=$history_data?>);
  }

  // 써머노트 셋팅
  var summernote_id = 'contents';

  // 이미지 업로드시 사용
  $(function() {
  $('#'+summernote_id).summernote({
    height:443,
    fontNames: [ 'NotoSansKR-Regular'],
    lang: 'ko-KR',
    dialogsInBody: false,
    callbacks: {
          onImageUpload: function(files, editor, welEditable) {
            for (var i = files.length - 1; i >= 0; i--) {
              sendFile(files[i], editor, welEditable);
            }
          }
        }
  });
  });

  //에디터 데이터 contents name에 전송
  var postForm = function() {
   var content = $('textarea[name="contents"]').html($('#contents').code());
  }

  //에디터 이미지 등록
  function sendFile(file,editor, welEditable) {
      var form_data = new FormData();
      form_data.append('file', file);
      form_data.append('id', 'id');
      form_data.append('device', 'image');
      $.ajax({
        data: form_data,
        dataType:'json',
        type: "POST",
        url: '/common/upload_file_json',
        cache: false,
        contentType: false,
        enctype: 'multipart/form-data',
        processData: false,
        success: function(result) {
          $('textarea[name="contents"]').summernote('insertImage',  result.path);
        }
      });
  }

  // post관리 등록하기
  function default_reg(){

    var display_yn = 'N';
    if(document.querySelector("input[name='display_yn']").checked){
      display_yn = 'Y';
    }

    var form_data = {
      "title" : $("#title").val(),
      "img_path" : $("input[name='img']:checked").val(),
      "contents" : $("#contents").val(),
      "display_yn" : display_yn
    };

    console.log(form_data);

    $.ajax({
      url      : "/<?=mapping('news')?>/news_reg_in",
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
          location.href ='/<?=mapping('news')?>/news_list';
        }
      }
    });
  }

</script>
