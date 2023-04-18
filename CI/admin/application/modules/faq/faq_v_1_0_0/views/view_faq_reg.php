<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>FAQ 등록</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
  	<div class="table-responsive">

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
              <th><span class="text-danger">*</span> 제목 </th>
              <td colspan=3>
                <input name="title" id="title" type="text" class="form-control">
              </td>
            </tr>
            <tr>
              <th colspan="4">
                <span class="text-danger" >*</span> 내용
              </th>
            </tr>
            <tr>
              <th colspan="4" style="background-color: white;">
                <textarea name="contents" id="contents" style="width:100%; height:100px;" placeholder="내용" class="input_default"></textarea>
              </th>
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
        <div class="mt15">
          <a href="javascript:void(0)" onclick="default_list();" class="btn btn-gray">목록</a>
          <a href="javascript:void(0)" onclick="default_reg();" class="btn btn-success" style="float:right;">등록</a>
        </div>
      </form>
    </div>
  </div>
  <!-- body : e -->

</div>
<!-- container-fluid : e -->

<script>

  // 등록하기
  function default_reg(){

    $.ajax({
  		url      : "/<?=mapping('faq')?>/faq_reg_in",
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
          alert("등록이 실패하였습니다.");
        } else {
          alert("등록되었습니다.");
          location.href ='/<?=mapping('faq')?>/faq_list';
        }
      }
    });
  }

  // 뒤로가기
  function default_list(){
      location.href ="/<?=mapping('faq')?>/faq_list";
  }

</script>
