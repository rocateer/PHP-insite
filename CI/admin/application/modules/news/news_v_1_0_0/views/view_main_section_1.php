<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>매거진 큐레이션</h1>
  </div>

  <!-- category table : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <b>매거진 검색시, 제목으로 검색해 주세요.</b>
      <p>* '노출 안함' 상태인 매거진은 검색되지 않습니다.</p>
      <table class="search_table">
        <colgroup>
          <col style="width:20%">
          <col style="width:80%">
        </colgroup>
        <tbody>
          <tr>
            <th>타이틀</th>
            <td>
              <input type="text" name="main_news_title" id="main_news_title" value="<?=$result->main_news_title?>" class="form-control f_left" style="width:80%">&nbsp;&nbsp;
              <a class="btn btn-success" href="javascript:void(0)" onclick="setting_mod_up('0')">수정</a>
            </td>
          </tr>

        </tbody>
      </table>

      <div class="table-responsive bg_wh mb20" id="list_ajax"></div>
    </div>
  </div>
  <!-- category table : e -->
</div>
<!-- container-fluid : e -->
<script>

function setting_mod_up(type){
  var main_news_title =  $('#main_news_title').val();
  if(main_news_title ==""){
    alert('타이틀을 입력해주세요.');
    return;
  }

  var form_data = {
  'type' : type,
  'main_program_title' :'',
  'main_news_title' :main_news_title,
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
function default_mod(main_section_idx) {

  var news_idx = $("select[name='news_idx_"+main_section_idx+"']").val();

  if(news_idx ==""){ alert("큐레이션을 선택해주세요"); location.reload();  return;  }


  var form_data = {
    'main_section_idx' :main_section_idx,
    'program_idx' : '',
    'board_idx' : '',
    'news_idx' : news_idx,
  };

  $.ajax({
    url      : "/common/main_section_mod_up",
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
    'menu_type' :  "1",
  };

  $.ajax({
    url      : "/<?=mapping('news')?>/main_section_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : form_data,
    success: function(result) {
      $('#list_ajax').html(result);
    }
  });
}

  // 상태 수정
  function display_mod_up(main_section_idx, display_yn){

    var news_idx = $("select[name='news_idx_"+main_section_idx+"']").val();

    if(news_idx ==""){ alert("큐레이션을 선택해주세요"); location.reload();  return;  }


    var formData = {
      "main_section_idx" : main_section_idx,
      "display_yn" : display_yn
    };

    $.ajax({
      url      : "/common/display_mod_up",
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
        }
      }
    });
    }
</script>
