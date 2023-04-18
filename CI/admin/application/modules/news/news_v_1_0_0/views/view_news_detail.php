<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>매거진 상세</h1>
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
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </td>
            </tr>
            <tr>
              <th><span class="text-danger">* </span>내용</th>
              <td class="td_left" colspan="3">
                <div class="editor_area btn-editor" style="width:100%">                
                  <textarea class="input-block-level" id = "contents" name="contents"><?=$result->contents?></textarea>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </section>

      <div class="row">
        <div class="col-lg-12 text-right">
          <a href="javascript:void(0)"  onClick="default_list()" class="btn btn-gray">목록</a>
          <a href="javascript:void(0)" onClick="default_del('<?=$result->news_idx?>')" class="btn btn-danger">삭제</a>
          <a href="javascript:void(0)"  onClick="default_mod()" class="btn btn-info">수정</a>
        </div>
      </div>
    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->

<input type="text" name="page_num" id="page_num" value="1" style="display: none;">
<input type="text" name="news_idx" id="news_idx" value="<?=$result->news_idx?>" style="display: none;">

<script>
  
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
  
  // post관리 목록
  function default_list(){
    if(!confirm("목록으로 이동 시 변경된 내용은 삭제됩니다.이동하시겠습니까?")){
      return;
    }
    history.back(<?=$history_data?>);
  }

  // post관리 수정
  function default_mod(){
    
    var form_data = {
      "news_idx" : $("#news_idx").val(),
      "img_path" : $("input[name='img_path[]']").val(),
      "title" : $("#title").val(),
      "contents" : $("#contents").val(),
    };

    $.ajax({
      url      : "/<?=mapping('news')?>/news_mod_up",
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
  
  // post관리 삭제
  function default_del(news_idx){

    if(!confirm("삭제하시겠습니까?")){
      return;
    }

    $.ajax({
      url      : "/<?=mapping('news')?>/news_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "news_idx" : news_idx
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
</script>
