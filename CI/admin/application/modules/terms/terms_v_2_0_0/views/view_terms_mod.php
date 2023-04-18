<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1><?=$result->title?> 관리</h1>
  </div>
  <form name="form_default" id="form_default" method="post">
    <!-- body : s -->
    <div class="bg_wh mt20">
      <div class="table-responsive">
        <!-- top -->
        <div class="row table_title">
          <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;<?=$result->title?></div>
        </div>
        <!-- top  -->
        <section>
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th class="th_left">약관 내용</th>
              </tr>
              <tr>
                <td class="td_left">
                  <div class="editor_area btn-editor" style="width:100%">
                    <input type="hidden" name="terms_management_idx" id="terms_management_idx" value="<?=$result->terms_management_idx?>">
                    <textarea class="input-block-level" id = "contents" name="contents"><?=$result->contents?></textarea>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </section>

        <div class="row">
          <div class="col-lg-12 text-right">
            <a href="javascript:history.go(-1)" class="btn btn-gray">취소</a>
            <a href="javascript:void(0)" onclick="default_mod();" class="btn btn-info">수정</a>
          </div>
        </div>
      </div>
    </div>
    <!-- body : e -->
  </form>
</div>
<!-- container-fluid : e -->
<script>
// 써머노트 셋팅
var summernote_id = 'contents';
$('#'+summernote_id).summernote({
height: 440,
fontNames: [ 'NotoSansKR-Regular']
});
function default_mod() {

 $.ajax({
   url: "/<?=mapping('terms')?>/terms_mod_up",
   type: 'POST',
   dataType: 'json',
   async: true,
   data: $("#form_default").serialize(),
   success: function(result) {
     if (result == 0) {
       alert('수정에 실패 하였습니다.');
     } else {
       alert('수정 되었습니다.');
       location.href = '/<?=mapping('terms')?>';
     }
   }
 });
}

</script>
