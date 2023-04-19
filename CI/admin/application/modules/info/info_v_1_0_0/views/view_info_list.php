  <!-- container-fluid : s -->
   <div class="container-fluid narrow">
		<!-- Page Heading -->
		<div class="page-header">
			<h1>안내 관리</h1>
		</div>
    <form name="form_default" id="form_default" method="post">
    <!-- body : s -->
    <div class="bg_wh mt20">
    	<div class="table-responsive">
        <!-- list_get : s -->
        <div id="list_ajax">
        <div><h3>회원가입 인증 안내</h3></div>
          <table class="table table-bordered check_wrap" style="height:300px;">
            <colgroup>
            	<col style="width:30%">
            	<col style="width:20%">
            	<col style="width:15%">
            	<col style="width:35%">
            </colgroup>
            <tr>
              <th>
                <p>이미지</p>
                <input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img0','image','1','150');" style="margin-bottom:10px">
              </th>
              <td colspan="3" style="text-align: left;">
                <div>
                  <ul class="img_hz" id="img0">
                    <?php if(!empty($join_detail) && $join_detail->img != ""){ ?>
                      <li id="id_file_img0_0" style="display:inline-block;">
                        <img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img0_0')"/><br>
                        <img src="<?=$join_detail->img?>" style="width:300px">
                        <input type="hidden" name="img0_path[]" id="img0_path[]" value="<?=$join_detail->img?>"/>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </td>
            </tr>
          </table>
          <div>
            <a class="btn btn-info" href="javascript:void(0)" onclick="default_mod('<?=$join_detail->info_idx?>','<?=$join_detail->type?>')" style="float:right;">저장</a>
          </div>
          <br>
          <div class="mt20"><h3>공구/교육 입금 안내</h3></div>
          <table class="table table-bordered check_wrap"  style="height:300px;">
            <colgroup>
              <col style="width:30%">
            	<col style="width:20%">
            	<col style="width:15%">
            	<col style="width:35%">
            </colgroup>
            <tr>
              <th>
                <p>이미지</p>
                <input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img1','image','1','150');" style="margin-bottom:10px">
              </th>
              <td colspan="3" style="text-align: left;">
                <div>
                  <ul class="img_hz" id="img1">
                    <?php if(!empty($pay_detail) &&$pay_detail->img != ""){ ?>
                      <li id="id_file_img1_0" style="display:inline-block;">
                        <img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img1_0')"/><br>
                        <img src="<?=$pay_detail->img?>" style="width:300px">
                        <input type="hidden" name="img1_path[]" id="img1_path[]" value="<?=$pay_detail->img?>"/>
                      </li>
                    <?php } ?>
                  </ul>
                </div>
              </td>
            </tr>
          </table>
          <div>
            <a class="btn btn-info" href="javascript:void(0)" onclick="default_mod('<?=$pay_detail->info_idx?>','<?=$pay_detail->type?>')" style="float:right;">저장</a>
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

      var formData = {
        "info_idx" : info_idx,
        "img" :  $("input[name='img"+type+"_path[]']").val(),
        "type" : type
      };

      $.ajax({
        url      : "/<?=mapping('info')?>/info_mod_up",
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
