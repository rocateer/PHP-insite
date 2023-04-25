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
                <th><span class="text-danger">* </span>배너 명</th>
                <td colspan="3">
                  <input type="text" name="title" id="title" value="" class="form-control">
                </td>
              </tr>
              <tr>
                <th> <span class="text-danger">* </span>공지사항</th>
                <td colspan="3">
                <select name="notice_idx" id="notice_idx" class="form-control">
                    <option value="">선택</option>
                    <?foreach($notice_list as $row){?>
                      <option value="<?=$row->notice_idx?>"><?=$row->title?></option>
                    <?}?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>노출 여부</th>
                <td colspan="3">
                    <label class="switch">
                      <input type="checkbox"  name="display_yn" id="display_yn" value="Y" checked>
                      <span class="check_slider"></span>
                    </label>
                </td>
              </tr>
              <tr>
                <th style="height:200px;">
                  <span class="text-danger">* </span>
                  모바일 이미지<br />(000x000)<br />
                  <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img0','image','1','150');" style="margin-bottom:10px"></p>
                </th>
                <td colspan="3">
                  <div class="view_img mg_btm_20">
                    <ul class="img_hz" id="img0"></ul>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="height:200px;">
                  <span class="text-danger">* </span>
                  PC web 이미지<br />(000x000)<br />
                  <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img1','image','1','150');" style="margin-bottom:10px"></p>
                </th>
                <td colspan="3">
                  <div class="view_img mg_btm_20">
                    <ul class="img_hz" id="img1"></ul>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="height:200px;">
                  <span class="text-danger">* </span>
                  인기 게시판 <br> PC web 이미지<br />(000x000)<br />
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
        </form>
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
  // 프로그램 목록
  function default_list(){
    location.href ='/<?=mapping('banner')?>/banner_list';
  }

  // 프로그램 등록하기
  function default_reg(){

    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $("#form_default").serialize(),
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
         default_list();
        }
      }
    });
  }

</script>
