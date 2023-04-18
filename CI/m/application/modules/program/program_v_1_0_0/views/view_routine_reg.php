<header>
  <div class="btn_back" onclick="javascript:history.go(-1)">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
    <?=(!empty($result))?'스케줄 수정':'스케줄 추가'?>
  </h1>
</header>
<div class="vh_wrap body relative inner_wrap">
  <div class="vh_body">
    <img src="/images/step_3.png" alt="" class="step">
    <h4 class="mb20 mt50 txt_center">일정을 선택하면 운동 루틴이 등록됩니다.</h4>
    <div class="label">운동하실 요일을 선택해 주세요.</div>
    <ul class="flex_week">
      <? 
      $type='0';
      if(!empty($result)){
        $yoil_arr = explode(',',$result->yoil);
        $type='1';
      }else{
        $yoil_arr = array();
      }
      ?>

      <li>
        <input type="checkbox" id="chk_3_1" name="chk_3" value="1" <?=(in_array(1, $yoil_arr))?'checked':''?> >
        <label for="chk_3_1">월</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_2" name="chk_3" value="2" <?=(in_array(2, $yoil_arr))?'checked':''?> >
        <label for="chk_3_2">화</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_3" name="chk_3" value="3" <?=(in_array(3, $yoil_arr))?'checked':''?> >
        <label for="chk_3_3">수</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_4" name="chk_3" value="4" <?=(in_array(4, $yoil_arr))?'checked':''?> >
        <label for="chk_3_4">목</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_5" name="chk_3" value="5" <?=(in_array(5, $yoil_arr))?'checked':''?> >
        <label for="chk_3_5">금</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_6" name="chk_3" value="6" <?=(in_array(6, $yoil_arr))?'checked':''?> >
        <label for="chk_3_6">토</label>
      </li>
      <li>
        <input type="checkbox" id="chk_3_7" name="chk_3" value="0" <?=(in_array(0, $yoil_arr))?'checked':''?> >
        <label for="chk_3_7">일</label>
      </li>
    </ul>
    <div class="label">운동 기간을 지정해 주세요.</div>
    <div class="flex_datepicker">
      <?if(!empty($result)){ //수정하기
       $e_date_yn=$result->e_date_yn; ?>
      <input type="text" value="<?=$result->s_date?>" class="datepicker" id="s_date_routine" readonly>
      <span>~</span>
      <input type="text" value="<?=$result->e_date?>" class="datepicker" id="e_date_routine" readonly>
      <?}else{
        $e_date_yn='Y';?>
        <input type="text" value="<?=$now?>" class="datepicker" id="s_date_1" readonly>
        <span>~</span>
        <input type="text" value="<?=$now_end?>" class="datepicker" id="e_date_1" readonly>
      <?}?>
    </div>

    <input type="checkbox" id="chk_2_1" name="chk_2" value="N" <?=($e_date_yn=='N')?'checked':''?> >
    <label for="chk_2_1"><span></span>종료일 지정 안함</label>
  </div>
  <div class="vh_footer btn_full_weight btn_point mt30 mb30">
    <a href="javascript:void(0)" onclick="default_reg_in('<?=$program_idx?>');"><?=(!empty($result))?'수정하기':'추가하기'?></a>
  </div>
</div>
<input type="text" name="member_program_idx" id="member_program_idx" value="<?=(!empty($result))?$result->member_program_idx:''?>" style="display: none;">

<script>

  var now_end='<?=$now_end?>';
  var type='<?=$type?>';

  $('#chk_2_1').click(function() {
      let checkList = $('#chk_2_1').prop('checked');

      if (checkList) {
        $("#e_date_routine").val("");
        $("#e_date_routine").prop("disabled", true);
      } else {
        $("#e_date_routine").val(now_end);
        $("#e_date_routine").prop("disabled", false);
      }
  });
    

function default_reg_in(program_idx){

  if(COM_login_check('<?=$this->member_idx?>','/<?=mapping('program')?>')){
    if(type=='0'){
      if(!confirm("스케줄을 등록 하시겠어요?")){
        return;
      }
    }else if(type=='1'){
      if(!confirm("스케줄을 수정 하시겠어요?")){
        return;
      }
    }
  }

  if(type=='0'){
      var s_date =  $('#s_date_1').val();
      var e_date =  $('#e_date_1').val();
    }else if(type=='1'){
      var s_date =  $('#s_date_routine').val();
      var e_date =  $('#e_date_routine').val();
    }

  var formData = {
      'yoil' :  get_checkbox_value('chk_3'),
      'type' : type,
      'program_idx' : program_idx,
      'member_program_idx' :  $('#member_program_idx').val(),
      's_date' : s_date,
      'e_date' : e_date,
      'e_date_yn' :  $('input[name="chk_2"]:checked').val()
    };

  $.ajax({
    url      : "/<?=mapping('program')?>/routine_reg_in",
    type     : "POST",
    dataType : "json",
    async    : true,
    data     : formData,
    success: function(result) {
      // -1:유효성 검사 실패
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == '0') {
        // alert(result.code_msg);
      } else if(result.code == '1') {
        if(type=='0'){
          alert(result.code_msg);
        }else if(type=='1'){
          alert("스케줄이 수정 되었습니다.");
        }

        // history.go(-1);
        location.href='/<?=mapping('member_program')?>';
        
      }
    }
  });
}

</script>