<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>쇼핑 메인 관리</h1>
  </div>

  <!-- category table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <h6 class="w_auto f_left">쇼핑 퀵 네비게이션 관리</h6>
      <div class="mb20 f_right">
        <a href="#" class="btn btn-success">변경사항 저장</a>
      </div>
      <table class="table table-bordered">
        <colgroup>
          <col style="width:10%">
          <col style="width:50%">
          <col style="width:10%">
          <col style="width:30%">
        </colgroup>
        <tbody>
          <tr>
            <th><span class="text-danger">*</span> 제목</th>
            <td>
              <input type="text" name="" value="" class="form-control" >
            </td>
            <th><span class="text-danger">*</span> 노출 여부</th>
            <td class="text_left">
              <label class="switch"><input type="checkbox" ><span class="check_slider"></span></label>
            </td>
          </tr>
          <tr>
            <th><span class="text-danger">*</span> url</th>
            <td colspan="3">
              <input type="text" name="" value="" class="form-control">
            </td>
          </tr>
          <tr>
            <th><span class="text-danger">*</span>
              이미지<br>
              (1장)<br>
              (100x100)
              <input type="button" class="btn btn-xs btn-default" id="file1" value="사진등록" onclick="file_upload_click('img','image','1','100');">
            </th>
            <td colspan="3" class="td_left">
              <div class="view_img mg_btm_20">
                <ul class="img_hz" id="img"></ul>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <!-- category table : e -->
</div>
<!-- container-fluid : e -->
