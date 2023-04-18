<header>
  <a class="btn_back" href="/<?=mapping('community')?>"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
  게시글 등록
  </h1>
  <button onclick="default_reg();">등록</button>
</header>
<div class="body reg_view">
  <div class="">
    <p class="inner_wrap mb10 mt20">오늘 완료한 프로그램을 선택해 주세요</p>
    <div class="today_complete_wrap">
      <ul>
        <?
        if(!empty($result_list)){
          foreach($result_list as $row){?>
            <li>
              <input type="checkbox" id="chk_1_<?=$row->member_program_record_idx?>" name="chk_1" value="<?=$row->member_program_record_idx?>">
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
          }else{?>
            <li class="no_today_sc">오늘 완료한 스케줄이  없습니다.</li>
          <?}?>
      </ul>
    </div>
    <textarea placeholder="어떤 운동을 했는지 마음껏 자랑해 주세요!" id="contents" cols="contents" class="reg_textarea"></textarea>
  </div>
  <div class="label inner_wrap">사진 </div>
  <div class="x_scroll_img_reg">
  <div class="cnt_num">
      <span id="img_cnt">0</span>/10
    </div>
    <ul class="img_reg_ul" id="img">
      <li>
        <div class="img_box" onclick="api_request_file_upload('img','10');">
          <img src="/images/btn_photo.png" alt="">
        </div>
      </li>
    </ul>
  </div>
</div>
<script>
  $(function(){
    const height = ($(window).height() - 440);
    $('.reg_textarea').css('height',height);
  })

  
function default_reg(){
  var program_record = get_checkbox_value('chk_1');

  if(program_record==''){
    alert("오늘 완료한 프로그램을 선택해 주세요.");
    return;
  }

  var formData = {
    'title' : $('#title').val(),
    'category_idx' : $("select[name='category_idx']").val(),
    'contents' : $('#contents').val(),
    'imgs_path' : get_checkbox_value('img_path'),
    'program_record' : program_record,
    'board_type' : 1
  }

  $.ajax({
    url      : "/<?=mapping('community')?>/community_reg_in",
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