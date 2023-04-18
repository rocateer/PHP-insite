<div class="container-fluid">
  <div class="page-header">
    <h1>베스트 이브의 고민 큐레이션</h1>
  </div>

  <div class="bg_wh mt20">
    <div class="table-responsive">
      <b>게시글 검색 시, 제목 또는 작성자 닉네임으로 검색해 주세요.</b>
      <p>* 블라인드 또는 삭제된 게시글은 검색되지 않습니다.</p>

        <div class="table-responsive bg_wh mb20" id="list_ajax">
            <div class="row table_title">
        
              <table class="table table-bordered">
                <colgroup>
                  <col style="width:15%">
                  <col style="width:55%">
                  <col style="width:15%">
                  <col style="width:15%">
                </colgroup>
                <tbody>
                  <?php
                    $k=0;
                    if(!empty($result_list)){
                      foreach($result_list as $row){

                      $main_section_idx =  $row->main_section_idx;
                      $board_idx =  $row->board_idx;
                      $display_yn =  $row->display_yn;
                    ?>
                  <tr>
                    <th><?=$k+1?> 위</th>
                    <td class="td_left">
                      <select class="form-control board_idx" style="width:550px" id="board_idx_<?=$main_section_idx?>" name="board_idx_<?=$main_section_idx?>" >
                          <option  value="0" <?=($board_idx !='')?'selected':''?> >블라인드 된 게시물 입니다. 큐레이션을 수정해주세요.</option>
                          <?php foreach($board_list as $row2){?>
                          <option value="<?=$row2->board_idx?>" <?=($row2->board_idx ==$board_idx)? "selected":"";?> >[<?=$row2->category_name?>] <?=$row2->title?> / <?=$row2->member_nickname?></option>
                          <?php }?>
                      </select>
                    </td>
                    <td  >
                      <a class="btn btn-success" href="javascript:void(0)" onclick="default_mod('<?=$main_section_idx?>')">변경사항저장</a>

                    </td>
                    <td  >
                      <?php if($display_yn == "N"){ ?>
                        노출 안함 <label class="switch">
                          <input type="checkbox" onchange="display_mod_up(<?=$main_section_idx?>, 'Y');">
                          <span class="check_slider"></span>
                        </label> 노출
                      <?php }else if($display_yn == "Y"){ ?>
                        노출 안함 <label class="switch">
                          <input type="checkbox" onchange="display_mod_up(<?=$main_section_idx?>, 'N');" checked>
                          <span class="check_slider"></span>
                        </label> 노출
                      <?php } ?>
                    </td>
                  

                  </tr>
                  <?php
                  $k++;
                  }}
                ?>
                </tbody>
              </table>

          </div>
        </div>
      </div>
  </div>
</div>


<script>
 $(".board_idx").select2({
   allowClear: true
 });

 // 수정
function default_mod(main_section_idx) {

  var board_idx = $("select[name='board_idx_"+main_section_idx+"']").val();

  if(!(board_idx>0)){ alert("커뮤니티를 선택해주세요"); location.reload();  return;  }

  var form_data = {
    'main_section_idx' :main_section_idx,
    'board_idx' : board_idx,
    'news_idx' : '',
    'program_idx' : '',
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
        location.reload();
      }
    }
  });
}

// 상태 수정
function display_mod_up(main_section_idx, display_yn){

  var board_idx = $("select[name='board_idx_"+main_section_idx+"']").val();

  if(board_idx ==""){ 
    alert("커뮤니티를 선택해주세요"); 
    location.reload();  
    return;  
  }else if(board_idx =="0"){
    if(display_yn=='Y'){
      alert("블라인드 되어있는 글입니다. 다른 커뮤니티를 선택해주세요."); 
      location.reload();  
      return;
    }
  }

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
