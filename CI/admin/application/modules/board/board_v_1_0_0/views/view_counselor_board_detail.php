<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>이브의 고민 상세</h1>
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
                <th> 닉네임</th>
                <td><?=$result->member_nickname?></td>
                <th> 상태</th>
                <td ><?php echo $result->display_yn == "Y"? "게시중":"블라인드"; ?></td>
              </tr>
              <tr>
                <th> 카테고리</th>
                <td ><?=$result->category_name ?></td>
                <th> 댓글&답글 수</th>
                <td ><?=$result->reply_cnt?></td>
              </tr>
              <tr>
                <th> 조회수</th>
                <td ><?=$result->view_cnt?></td>
                <th> 좋아요 수</th>
                <td ><?=$result->like_cnt?></td>
              </tr>
              <tr>
                <th> 제목</th>
                <td colspan="3"><?=$result->title?></td>
              </tr>
              <tr>
              <th>이미지</th>
                <td colspan="3" style="height: 150px;">
                  <div>
                    <ul class="img_hz" id="img">
                      <?php if($result->board_img != ""){ ?>
                        <?$img_arr = explode(",",$result->board_img);
                          $cnt = 0;
                            foreach($img_arr as $row){?>
                            <li id="id_file_img" style="display:inline-block;">
                              <img src="<?=$row?>" style="width:140px">
                              <input type="hidden" name="img_path[]" value="<?=$row?>"/>
                            </li>
                        <?$cnt++;}?>
                      <?php } ?>
                    </ul>
                  </div>
                </td>
              </tr>
              <tr>
                <th style="height:150px;"> 내용</th>
                <td colspan="3"><?=nl2br($result->contents)?></td>
              </tr>
              <tr>
                <th colspan="4">댓글 & 답글</th>
              </tr>
              <tr>
                <td colspan="4" >
                  <table class="table table-bordered td_left">
                    <colgroup>
                      <col style="width:15%">
                      <col style="width:35%">
                      <col style="width:15%">
                      <col style="width:35%">
                    </colgroup>
                    <tbody>
                      <tr>
                        <th>닉네임</th>
                        <td ><input name="member_nickname" id="member_nickname" class="form-control" autocomplete="off"></td>
                        <th>정렬 기준</th>
                        <td >
                          <select class="form-control" style="width:220px" id="orderby" name="orderby" >
                            <option value="0">등록일자 내림차순 정렬</option>
                            <option value="1">등록일자 올림차순 정렬</option>
                       </select>
                     </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="text-center mt20">
                    <a class="btn btn-success" href="javascript:void(0)" onclick="reply_list_get(1);">검색</a>
                  </div>
                  <div class="text-center mt20">
                  </div>
                  <div class="bg_wh mb20" id="reply_ajax">  <div>
                </td>
              </tr>
            </tbody>
          </table>

        </form>
      </section>

      <div class="row table_title">
        <div class="col-lg-4"><a class="btn btn-gray" href="javascript:void(0)" onclick="default_list();">목록</a></div>
        <div class="col-lg-8 text-right">
          <input name="reply_comment" id="reply_comment" class="form-control" style="width:300px" autocomplete="off">
          <a class="btn btn-info" href="javascript:void(0)" onclick="reply_reg_in('0');">댓글등록</a>
          <?if($result->member_state!=3){?>
            <a class="btn btn-danger" href="javascript:void(0)" onclick="board_display_yn_mod_up('<?=$result->board_idx?>', '<?php echo $result->display_yn == "Y"? "N":"Y"; ?>')"><?php echo $result->display_yn == "Y"? "블라인드":"블라인드 해제"; ?></a>
            <?}?>
          </div>
      </div>



    </div>
  </div>
  <!-- body : e -->
</div>



<!-- modal layerpop3 : s -->
<div class="modal fade" id="layerpop3" >
  <div class="modal-dialog" style="width:750px;">
    <div class="modal-content" style="width:750px;">
      <!-- header -->
      <div class="modal-header" >
        <!-- 닫기(x) 버튼 -->
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">답글등록하기</h4>
      </div>
      <!-- body -->
      <div class="modal-body">
        <div class="table-responsive">
          <table class="search_table">
            <colgroup>
              <col style="width:150px">
              <col style="width:250px">
              <col style="width:150px">
              <col style="width:250px">
            </colgroup>
            <tbody>
              <tr>
                <th style="text-align:center;">답글내용</th>
                <td colspan="3">
                  <textarea name="pop_reply_comment" id="pop_reply_comment" style="width:100%;height:50px;" placeholder="답글내용를 입력해주세요." class="form-control w_auto"></textarea>
                </td>
              </tr>
      			</tbody>
          </table>
          <div class="text-center mt20" style="">
            <a href="javascript:void(0)" class="btn btn-success" data-dismiss="modal" id="btn_cancel_3">취소</a>
            <a href="javascript:void(0)" onclick="reply_reg_in('1');" class="btn btn-success">답글작성</a>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
<!-- modal layerpop3 : e -->

<!-- container-fluid : e -->
<input type="text" name="board_idx" id="board_idx" value="<?=$result->board_idx?>" style="display:none;">
<input type="text" name="cmt_member_nickname" id="cmt_member_nickname" value="" style="display:none;">
<input type="text" name="board_type" id="board_type" value="<?=$board_type?>" style="display:none;">
<input type="text" name="board_reply_idx" id="board_reply_idx" value="" style="display:none;">
<input type="text" name="page_num" id="page_num" value="" style="display:none;">
<script>

  reply_list_get(1);

    // 댓글 등록type
    function reply_reg_in(type){
    var form_data = {
      'type' :  type,
      'board_idx' :  $('#board_idx').val(),
      'board_reply_idx' :  $('#board_reply_idx').val(),
      'reply_comment' :  $('#reply_comment').val(),
      'pop_reply_comment' :  $('#pop_reply_comment').val(),
      'cmt_member_nickname' :  $('#cmt_member_nickname').val(),
    };
    console.log(form_data);

    $.ajax({
      url      : "/<?=mapping('board')?>/board_comment_reg_in",
      type     : "POST",
      dataType : "json",
      async    : true,
      data     : form_data,
      success: function(result) {
        if(result.code == -1){
          alert(result.code_msg);
          return;
        }
        if(result.code == 0){
          alert(result.code_msg);
        }else{
          console.log(result);
          $('#btn_cancel_3').trigger('click');
          $('#board_reply_idx').val('');
          $('#reply_comment').val('');
          $('#pop_reply_comment').val('');
          reply_list_get($('#page_num').val());
        }
      }
    });
  }

  // 댓글:답글 댓글키 세팅
  function set_board_reply_idx(str,name){
   $('#board_reply_idx').val(str);
   $('#cmt_member_nickname').val(name);
  }

  function reply_list_get(page){

    var formData = {
      'board_idx' :  $('#board_idx').val(),
      'orderby' :  $('#orderby').val(),
      'board_type' :  $('#board_type').val(),
      'member_nickname' :  $('#member_nickname').val(),
      'page_num' : page
    };

    $.ajax({
      url      : "/<?=mapping('board')?>/reply_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {
        $('#reply_ajax').html(result);
      }
    });
  }

function board_display_yn_mod_up(board_idx, display_yn){

  var formData = {
    "board_idx" : board_idx,
    "display_yn" : display_yn
  };

  $.ajax({
    url      : "/<?=mapping('board')?>/board_display_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        location.reload();
        // default_list();
      }
    }
  });
}

// 댓글 노출여부 상태 수정
function display_yn_mod_up(board_reply_idx, display_yn){

  var page_num = $('#page_num').val();

  var formData = {
    "board_reply_idx" : board_reply_idx,
    "display_yn" : display_yn
  };

  $.ajax({
    url      : "/<?=mapping('board')?>/display_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success: function(result){
      if(result.code == "0"){
        alert(result.code_msg);
      }else{
        alert(result.code_msg);
        reply_list_get(page_num);
      }
    }
  });
}

function default_list(){
  history.back(<?=$history_data?>);
}
</script>
