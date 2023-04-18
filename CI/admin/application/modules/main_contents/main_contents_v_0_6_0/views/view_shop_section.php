<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>쇼핑 테마 섹션 관리</h1>
  </div>

  <!-- category table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <h6 class="w_auto f_left">테마 섹션</h6>
      <div class="mb20 f_right">
        <a href="#" class="btn btn-success">변경사항 저장</a>
      </div>
      <table class="table table-bordered">
        <colgroup>
          <col style="width:10%">
          <col style="width:50%">
          <col style="width:10%">
          <col style="width:40%">
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
            <th><span class="text-danger">*</span> 배경 색상 코드</th>
            <td colspan="3">
              <input type="text" name="" value="" class="form-control" placeholder="#f5a200">
            </td>
          </tr>
          <tr>
            <th>
              <span class="text-danger">*</span>
              노출 개수 타입
            </th>
            <td colspan="3" class="text_left">
              <label for="own" class="radio-inline">
                <input type="radio" name="exposures_num" value="" checked id="own">
                1개씩 표시하기
              </label>
              <label for="two" class="radio-inline">
                <input type="radio" name="exposures_num" value="" id="two">
                2개씩 표시하기
              </label>
              <label for="three" class="radio-inline">
                <input type="radio" name="exposures_num" value="" id="three">
                3개씩 표시하기
              </label>
              <label for="four" class="radio-inline">
                <input type="radio" name="exposures_num" value="" id="four">
                4개씩 표시하기
              </label>
            </td>
          </tr>
          <tr>
            <th colspan="4">노출 상품 선택<input type="button" name="" value="선택" class="btn btn-choice" style="margin-left:4px"></th>
          </tr>
          <tr>
            <td colspan="4">
              <div class="view_img mg_btm_20">
                <ul class="img_hz" id="img"></ul>
              </div>
            </td>
          </tr>
        </tbody>
      </table>

      </div>

    </div>
  </div>
  <!-- category table : e -->
</div>
<!-- container-fluid : e -->
