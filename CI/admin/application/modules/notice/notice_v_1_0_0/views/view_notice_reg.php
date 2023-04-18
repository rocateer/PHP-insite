<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>공지사항 등록</h1>
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
                <th> <span class="text-danger">*</span> 제목</th>
                <td colspan="3">
                  <input name="title" id="title" type="text" class="form-control" style="width:100%">
                </td>
              </tr>
              <tr>
                <th>
                  <p>사진</p>
                  <p>(750xauto)</p>
                  <input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img','image','1','150');" style="margin-bottom:10px">
                </th>
                <td colspan="3">
                  <div class="view_img mg_btm_20">
                    <ul class="img_hz" id="img"></ul>
                  </div>
                </td>
              </tr>
              <tr>
                <th colspan="4">
                  <span class="text-danger">*</span> 내용
                </th>
              </tr>
              <tr>
                <td colspan="4" class="table_left" colspan="3">
                  <textarea class="input_default textarea_box" name="contents" id="contents" placeholder="내용"></textarea>
                </td>
              </tr>
              <tr>
               <th>노출 여부</th>
                 <td colspan="3">
                     <label class="switch">
                       <input type="checkbox"  name="notice_state" id="notice_state" value="Y" checked>
                       <span class="check_slider"></span>
                     </label>
                 </td>
               </tr>
            </tbody>
          </table>
        </form>
      </section>

      <div class="row">
        <div class="col-lg-12">
          <a href="javascript:void(0)" onclick="default_list()" class="btn btn-gray">목록</a>
          <a href="javascript:void(0)" onclick="default_reg();" class="btn btn-success" style="float:right;">등록</a>
        </div>
      </div>

    </div>
  </div>
  <!-- body : e -->

</div>
<script>

  // 공지사항 목록
  function default_list(){
      location.href ="/<?=mapping('notice')?>/notice_list";
  }

  // 공지사항 등록
  function default_reg(){

    $.ajax({
      url      : "/<?=mapping('notice')?>/notice_reg_in",
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
          alert("등록에 실패하였습니다.");
        } else {
          alert("등록 되었습니다.");
          location.href ='/<?=mapping('notice')?>/notice_list';
        }
      }
    });
  }

</script>
