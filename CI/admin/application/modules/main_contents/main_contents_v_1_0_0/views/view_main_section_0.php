<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>홈 화면 상품 관리</h1>
  </div>

  <!-- category table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <table class="table table-bordered td_left">
        <colgroup>
          <col style="width:20%">
          <col style="width:80%">
        </colgroup>
        <tbody>
          <tr>
            <th><span class="text-danger">*</span>상단 타이틀</th>
            <td>
              <input type="text" name="main_product_title" id="main_product_title" value="<?=$result->main_product_title?>" class="form-control f_left" >
            </td>
          </tr>

        </tbody>
      </table>

      <div class="text-right" >
          <a class="btn btn-success" href="javascript:void(0)" onclick="setting_mod_up('main_product_title')">수정</a>
      </div>

      <div class="bg_wh mb20" id="list_ajax"></div>
    </div>
  </div>
  <!-- category table : e -->
</div>
<!-- container-fluid : e -->
<script>

function setting_mod_up(item){
  var item_val =  $('#'+item).val();
  if(item_val ==""){
    alert('금액을 세팅해 주세요');
    return;
  }

  var form_data = {
  'item' : item,
  'item_val' :item_val,
  };


$.ajax({
    url      : "/common/setting_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
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
        location.reload();  
      }
    }
  });
}

// 수정
function default_mod(str) {

  var display_yn = $("input[name='display_yn_"+str+"']:checked").val();
  if(display_yn ==undefined){
    display_yn ="N";
  }
  var product_idx =$('#product_idx_'+str).val();

  if(product_idx ==""){ alert("상품을 선택해주세요");   return;  }


  var form_data = {
    'main_section_idx' :str,
    'product_idx' : product_idx,
    'guide_idx' : "",
    'display_yn' : display_yn,
    'menu_type' : "1"
  };
  $.ajax({
    url      : "/<?=mapping('main_contents')?>/main_section_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success : function(result) {
      if(result.code == '-1') {
        alert(result.code_msg);
      }else {
        alert("적용 되었습니다.");
        default_list_get();
      }
    }
  });
}

$(document).ready(function(){
   default_list_get();
})

function default_list_get(){

  var form_data = {
    'menu_type' :  "0",
  };

  $.ajax({
    url      : "/<?=mapping('main_contents')?>/main_section_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : form_data,
    success: function(result) {
      $('#list_ajax').html(result);
    }
  });
}


</script>
