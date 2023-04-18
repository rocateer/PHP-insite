<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
    알림 설정
  </h1>
</header>
<!-- header : e -->
<!-- body : s -->
<div class="body row vh_wrap">
  <div class="inner_wrap">
    <div class="vh_body">
      <ul class="alarm_setting_ul">
        <li>
          알림
          <?php if($result->all_alarm_yn == "N"){ ?>
            <label class="f_right switch">
              <input type="checkbox" name="all_alarm_yn" id="all_alarm_yn" onchange="all_alarm_yn_mod_up('0', 'Y');">
              <span class="check_slider"></span>
            </label>
          <?php }else if($result->all_alarm_yn == "Y"){ ?>
            <label class="f_right switch">
              <input type="checkbox" name="all_alarm_yn" id="all_alarm_yn" onchange="all_alarm_yn_mod_up('0', 'N');" checked>
              <span class="check_slider"></span>
            </label>
          <?php } ?>
        </li>
        <li>
          운동 알림
          <?php if($result->excercise_alarm_yn == "N"){ ?>
            <label class="f_right switch">
              <input type="checkbox" name="excercise_alarm_yn" id="excercise_alarm_yn" onchange="all_alarm_yn_mod_up('1', 'Y');">
              <span class="check_slider"></span>
            </label>
          <?php }else if($result->excercise_alarm_yn == "Y"){ ?>
            <label class="f_right switch">
              <input type="checkbox" name="excercise_alarm_yn" id="excercise_alarm_yn" onchange="all_alarm_yn_mod_up('1', 'N');" checked>
              <span class="check_slider"></span>
            </label>
          <?php } ?>
        </li>
      </ul>
      <hr>
      <div class="alarm_time">
        운동 알림 시간
        <div class="flex_2">
          <select name="alarm_hour" id="alarm_hour">
            <?
            $alarm_time = (int)$result->alarm_time;
            for($i=0;$i<24;$i++){?>
            <option value="<?=$i?>" <?=($alarm_time==$i)?'selected':''?>><?=$i?>시</option>
            <?}?>
          </select>
          <select name="alarm_min" id="alarm_min">
            <? for($i=1;$i<61;$i++){?>
            <option value="<?=$i?>" <?=((int)$result->alarm_min==$i)?'selected':''?> ><?=$i?>분</option>
            <?}?>
          </select>
          <select name="alarm_min1" id="alarm_min1" style="display: none;">
            <option value="00" <?=($result->alarm_min=='00')?'selected':''?> >00분</option>
            <option value="30" <?=($result->alarm_min=='30')?'selected':''?> >30분</option>
          </select>
        </div>
      </div>
    </div>
    <div class="vh_footer btn_full_weight btn_point mt30 mb30">
      <a href="javascript:void(0)" onclick="alarm_reg_in();">저장</a>
    </div>
  </div>
</div>
<!-- body : e -->

<script>

  //알림변경
  function all_alarm_yn_mod_up(type,alarm_yn){

  var form_data = {
      'type' : type,
      'alarm_yn' : alarm_yn
  };

  $.ajax({
    url      : "/<?=mapping('alarm')?>/all_alarm_yn_mod_up",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success : function(result){
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      } else {
      }
    }
  });
  }

  //시간저장
  function alarm_reg_in(){

  var form_data = {
      'alarm_hour' : $("select[name='alarm_hour']").val(),
      'alarm_min' : $("select[name='alarm_min']").val(),
  };

  $.ajax({
    url      : "/<?=mapping('alarm')?>/alarm_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success : function(result){
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
        history.go(-1);
      }
    }
  });
  }
</script>