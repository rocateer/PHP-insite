  <!-- container-fluid : s -->
   <div class="container-fluid narrow">
		<!-- Page Heading -->
		<div class="page-header">
			<h1>차별금지 안내 관리</h1>
		</div>
    <form name="form_default" id="form_default" method="post">
    <!-- body : s -->
    <div class="bg_wh mt20">
    	<div class="table-responsive">
        <!-- list_get : s -->
        <div id="list_ajax">
        <div><h3>연령차별금지 안내</h3></div>
          <table class="table table-bordered check_wrap" style="height:300px;">
            <colgroup>
            	<col style="width:30%">
            	<col style="width:20%">
            	<col style="width:15%">
            	<col style="width:35%">
            </colgroup>
            <tr>
              <th>
                <p>내용</p>
              </th>
              <td colspan="3">
                <textarea name="age_contents" style="width:100%; height:100%;" id="age_contents" placeholder="내용" class="input_default"><?=$age_detail->contents?></textarea>
              </td>
            </tr>
          </table>
          <div>
            <a class="btn btn-info" href="javascript:void(0)" onclick="default_mod('<?=$age_detail->info_idx?>','<?=$age_detail->type?>')" style="float:right;">저장</a>
          </div>
          <br>
          <div class="mt20"><h3>성별차별금지 안내</h3></div>
          <table class="table table-bordered check_wrap"  style="height:300px;">
            <colgroup>
              <col style="width:30%">
            	<col style="width:20%">
            	<col style="width:15%">
            	<col style="width:35%">
            </colgroup>
            <tr>
              <th>
                <p>내용</p>
              </th>
              <td colspan="3" style="text-align: left;">
                <textarea name="gender_contents" style="width:100%; height:100%;" id="gender_contents" placeholder="내용" class="input_default"><?=$gender_detail->contents?></textarea>
              </td>
            </tr>
          </table>
          <div>
            <a class="btn btn-info" href="javascript:void(0)" onclick="default_mod('<?=$gender_detail->info_idx?>','<?=$gender_detail->type?>')" style="float:right;">저장</a>
          </div>
        </div>
        <!-- list_get : e -->

    	</div>
    </div>
    <!-- body : e -->
    </form>
  </div>
  <!-- container-fluid : e -->
  <script>

    // 저장
    function default_mod(info_idx, type){

      if(type==2){
        var contents = $("#age_contents").val();
      }else if(type==3){
        var contents = $("#gender_contents").val();
      }

      var formData = {
        "info_idx" : info_idx,
        "contents" : contents
      };

      $.ajax({
        url      : "/<?=mapping('info')?>/ban_mod_up",
        type     : 'POST',
        dataType : 'json',
        async    : true,
        data     : formData,
        success: function(result){
           // -1:유효성 검사 실패
          if(result.code == '-1'){
            alert(result.code_msg);
            $("#"+result.focus_id).focus();
            return;
          }
          // 0:실패 1:성공
          if(result.code == 0) {
            alert(result.code_msg);
          } else if(result.code == 1) {
            alert(result.code_msg);
            location.reload();
          }
        }
      });
    }
</script>
