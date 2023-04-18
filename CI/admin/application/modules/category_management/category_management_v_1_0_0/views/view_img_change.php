<div>
  <!-- Page Heading -->


  <!-- body : s -->
  <form name="form_default" id="form_default">
    <input type="hidden" name="category_management_idx" id="category_management_idx" value="<?=$result->category_management_idx?>">

    <div class="bg_wh mt20">
      <!-- search : s -->
      <div class="table-responsive">
        <table class="search_table">
          <colgroup>
            <col style="width:100px">
          </colgroup>
          <tbody>
            <tr>
              <th style="text-align:center">이미지<br><input type="button" class="btn btn-xs btn-default" id="file1" value="사진등록" onclick="file_upload_click('img','image','1',150);">
              </th>
              <td>
                <div class="view_img mg_btm_20">
                  <ul class="img_hz" id="img">
                <?php if($result->img_path != ""){ ?>
                <li id="id_file_img_0" style="display:inline-block;width:150px;padding-right:10px">
                 <img src="/images/btn_del.gif" style="width:15px; cursor: pointer;" onclick="file_upload_remove('img_0')"/><br>
                 <img class="preview_img" src="<?=$result->img_path?>" >
                 <input type="hidden" name="img_path[]" id="img_0" value="<?=$result->img_path?>"/>
                </li>
                <?php } ?>
                     </ul>
                </div>

              </td>
            </tr>

          </tbody>
        </table>


        <div class="text-right mt20">
          <a href="javascript:void(0);" onclick="img_cancel();" class="btn btn-gray">취소</a>
          <a href="javascript:void(0);" onclick="img_change_mod_up();" class="btn btn-success">저장</a>
        </div>
      </div>

  </form>
  <!-- list_get : e -->
</div>

<script>

  // 이미지 저장하기
  function img_change_mod_up(){
    var form_data = {
      'category_management_idx' : $('#category_management_idx').val(),
      'img_path' : $('#img_0').val(),
    };

    $.ajax({
      url      : "/<?=mapping('category_management')?>/img_change_mod_up",
      type     : "POST",
      dataType : "json",
      async    : true,
      data     :form_data,
      success  : function(result) {
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
     			opener.img_set($('#category_management_idx').val(),$('#img_0').val());
          opener.location.reload();
          self.close();
   		  }
      }
    });
  }
  
  // 이미지 취소
  function img_cancel(){
    self.close();
  }



</script>
