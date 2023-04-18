<header>
  <a class="btn_back" href="/<?=mapping('community')?>"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
  게시글 수정
  </h1>
  <button onclick="default_mod();">수정</button>
</header>
<div class="body reg_view">
  <div class="">
    <p class="inner_wrap mb10 mt20">오늘 완료한 프로그램을 선택해 주세요</p>
    <div class="today_complete_wrap">
      <ul>
        <?if(count($result_list)>0){
          foreach($result_list as $row){
            $program_arr = explode(',',$result->program_record);?>
            <li>
              <input type="checkbox" id="chk_1_<?=$row->member_program_record_idx?>" name="chk_1" value="<?=$row->member_program_record_idx?>" <?=(in_array($row->member_program_record_idx,$program_arr))?'checked':''?> >
              <label for="chk_1_<?=$row->member_program_record_idx?>">
                <table>
                  <tr>
                    <th>
                      <div class="img_box">
                        <img src="<?=$row->img_path?>" alt="">
                      </div>
                    </th>
                    <td>
                      <div class="name"><?=$row->title?></div>
                    </td>
                  </tr>
                </table>
              </label>
            </li>
          <?}
          }?>
      </ul>
    </div>
    <textarea placeholder="어떤 운동을 했는지 마음껏 자랑해 주세요!" id="contents" cols="contents" class="reg_textarea"><?=$result->contents?></textarea>
  </div>
  <div class="label inner_wrap">사진 </div>
  <div class="x_scroll_img_reg">
  <div class="cnt_num">
  <? $img_arr = explode(',',$result->board_img); ?>
      <span id="img_cnt"><?=count($img_arr)?></span>/10
    </div>
    <ul class="img_reg_ul" id="img">
      <li>
        <div class="img_box" onclick="api_request_file_upload('img','10');">
          <img src="/images/btn_photo.png" alt="">
        </div>
      </li>
      <? $i=11;
        if(!empty($result->board_img)){
        foreach($img_arr as $img){?>
          <li class="img_div" id="img_file_0_<?=$i?>">
            <a href="javascript:file_img_remove('img_file_0_<?=$i?>')">
              <img src="/images/btn_delete.png" alt="x" class="btn_delete">
            </a>
            <div class="img_box">
              <img src="<?=$img?>" alt="">
            </div>
            <input type='checkbox' name='img_path'  value='<?=$img?>' checked style='display:none' />
          </li>
        <?
        $i++;}
      }?>
    </ul>
  </div>
</div>

<input type="hidden" id="board_idx" name="board_idx" value="<?=$result->board_idx?>">

<script>
  $(function(){
    const height = ($(window).height() - 440);
    $('.reg_textarea').css('height',height);
  })

function default_mod(){

  var board_idx = $('#board_idx').val();

  var formData = {
    'board_idx' : board_idx,
    'title' : $('#title').val(),
    'category_idx' : $("select[name='category_idx']").val(),
    'contents' : $('#contents').val(),
    'imgs_path' : get_checkbox_value('img_path'),
    'program_record' : get_checkbox_value('chk_1'),
    'board_type' : 1
  }

  $.ajax({
    url      : "/<?=mapping('community')?>/community_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
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
        location.href="/<?=mapping('community')?>/community_list?tab=1";
      }
    }
  });
}

</script>