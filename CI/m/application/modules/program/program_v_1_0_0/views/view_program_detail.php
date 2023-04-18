<header class="transparent">
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back_w.png" alt="닫기"></a>
</header>
<div class="visual_img_wrap">
  <img src="<?=$result->img_path?>" alt="" class="img_block">
</div>
<div class="container_round product_detail_view">
  <div class="inner_wrap">
    <h2 class="txt_center"><?=$result->title?></h2>
    <table class="tbl_center">
      <tr>
        <th>
          <div class="level"><span>난이도</span>
            <ul class="level_ul">
            <?for($i=1;$i<=5;$i++){
                if($i<=$result->level){?>
                  <li class="on"></li>
                <?}else{?>
                  <li></li>
                <?}?>
              <?}?>
            </ul>
          </div>
        </th>
        <td>
        <?
          $min=(int)$result->exercise_min;
          $sec=$result->exercise_sec;
        ?>
          <img src="/images/i_time.png" class="i_time"> <?=($min==0)?'':$min.'분'?> <?=($sec=='00')?'':$sec.'초'?> 소요
        </td>
      </tr>
    </table>

    <?if(!empty($result->url_link)){?>
      <div class="contents_iframe_wrap">
        <iframe class="contents_iframe" src="<?=$result->url_link?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      </div>
    <?}?>

    <p class="mt20"><?=nl2br($result->contents)?></p>


    <ul class="info_ul row">
      <li>
        <?=$result->view_cnt?>
      </li>
      <li>
        <span class="wish_btn  <?=($result->like_yn=='Y')?'on':''?>" onclick="wish_btn(this)">
          <a class="" href="javascript:void(0)" onclick="like_reg_in('<?=$result->program_idx?>')"></a>
          <span id="like_cnt"><?=$result->like_cnt?></span>
        </span>
      </li>
    </ul>

    <ul class="mb14_ul product_detail_ul">
      <?foreach($exercise_list as $row){?>
      <li>
        <?if($type=='1'){?>
        <a onclick="default_list_get('<?=$row->exercise_idx?>');">
        <?}else{?>
          <a href="/<?= mapping('program') ?>/excercise_detail?exercise_idx=<?=$row->exercise_idx?>">
        <?}?>
          <table>
            <tr>
              <th style="width: 136px;">
                <div class="img_box">
                  <img src="<?=$row->img_path?>" alt="">
                </div>
              </th>
              <td>
                <h4><?=$row->title?></h4>
                <span class="line_txt">
                  <?=strip_tags($row->contents)?>
                </span>
              </td>
            </tr>
          </table>
        </a>
      </li>
      <?}?>
    </ul>

    <?if($type!='1'){?>
      <div class="flex_3">
        <div class="btn_full_weight btn_scrap">
          <input type="checkbox" id="chk_2_1" name="chk_1"  <?=($result->scrap_yn=='Y')?'checked':''?> onclick="default_scrap('<?=$result->program_idx?>');">
          <label for="chk_2_1">
            <span></span>
            스크랩
          </label>
        </div>
        <div class="btn_full_weight btn_point">
          <a href="/<?= mapping('program')?>/routine_reg?program_idx=<?=$result->program_idx?>"><?=($result->add_cnt>0)?'스케줄 수정':'스케줄 추가'?></a>
        </div>
      </div>
    <?}?>

  </div>
</div>

  <?if($type=='1'){?>
    <div style="height: 20px;"></div>
      <div class="flex_3 floating">
        <div class="btn_full_weight btn_scrap">
          <input type="checkbox" id="chk_2_1" name="chk_1" <?=($result->scrap_yn=='Y')?'checked':''?> onclick="default_scrap('<?=$result->program_idx?>');">
          <label for="chk_2_1">
            <span></span>
            스크랩
          </label>
        </div>
        <div class="btn_full_weight btn_point" id="btn_program_start">
          <a href="javascript:program_start()">운동 시작</a>
        </div>
        <div class="btn_full_weight btn_point" id="btn_program_end">
          <img src="/images/i_stop.png" onclick="timer()" class="i_player">
          <span class="time" id="stopwatch"><?=($result->record_time=='')?'00:00':$result->record_time?></span>
          <a href="javascript:void(0)" onclick="timer_mod_up('<?=$result->add_cnt?>')">운동 완료</a>
        </div>
      </div>
  <?}?>

  <!-- excercise_list -->
  <div class="modal modal_program" id="excercise_ajax"></div>

  <input type="hidden" id="member_program_idx" name="member_program_idx" value="<?=$result->add_cnt?>">
  <input type="hidden" id="program_idx" name="program_idx" value="<?=$result->program_idx?>">

<script>
  var agent ="<?=$agent?>";
  var type ="<?=$type?>";
  var record_time ="<?=$result->record_time?>";
  var record_exercise = 0;

  if(record_time!=''){
    var record_min =(parseInt)(record_time.substr(3,2));
    var record_sec =(parseInt)(record_time.substr(6,2));

    if(record_min>0){
      record_exercise = record_min*60;
    }
    if(record_sec>0){
      record_exercise = record_exercise+record_sec;
    }
  }

  if(type=='1'){
    $(document).ready(function(){
      setTimeout("api_request_exercise('0')", 10);
    });
  }

  // 운동상태 전달 0:운동안함 1:운동중
  function api_request_exercise(state){
  if(agent == 'android') {
    window.rocateer.request_exercise(state);
  } 
}

  //  응답 :: 앱에서 받아서  데이타 처리
  function api_reponse_device_gcmkey(device_os,gcm_key){
    $("#device_os").val(device_os);
    $("#gcm_key").val(gcm_key);
  }


  $('#btn_program_end').hide();

  function program_start() {
    api_request_exercise('1');

    $('#btn_program_start').hide();
    $('#btn_program_end').show();
    startClock();
  }

  function timer() {
    if ($('.i_player').attr('src') == '/images/i_stop.png') {
      $('.i_player').attr('src', '/images/i_play.png')
      stopClock();
    } else {
      $('.i_player').attr('src', '/images/i_stop.png')
      startClock();
    }
  }

  let timerId;
  let time = record_exercise;
  const stopwatch = document.getElementById("stopwatch");
  let  hour, min, sec;

  function printTime() {
      time++;
      stopwatch.innerText = getTimeFormatString();
  }

  //시계 시작 - 재귀호출로 반복실행
  function startClock() {
      printTime();
      stopClock();
      timerId = setTimeout(startClock, 1000);
  }

  //시계 중지
  function stopClock() {
      if (timerId != null) {
          clearTimeout(timerId);
      }
  }

  // 시계 초기화
  function resetClock() {
      stopClock()
      stopwatch.innerText = '00:00';
      time = 0;
  }

  // 시간(int)을 시, 분, 초 문자열로 변환
  function getTimeFormatString() {
    console.log(time);
      hour = parseInt(String(time / (60 * 60)));
      min = parseInt(String((time - (hour * 60 * 60)) / 60));
      sec = time % 60;

      return String(min).padStart(2, '0') + ":" + String(sec).padStart(2, '0');
  }

  //모달로 운동프로그램 열기
  function default_list_get(exercise_idx){

    var formData = {
      'exercise_idx' : exercise_idx,
      'type':1
    };

    $.ajax({
      url      : "/<?=mapping('program')?>/excercise_detail2",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {

          $("#excercise_ajax").html(result);
          modal_open('program')
      }
    });
  }

  //운동완료
  function timer_mod_up(member_program_idx){

    if(!confirm("운동을 완료 하셨나요?")){
      return;
    }

    var record_time=$('#stopwatch').text();
    var program_idx =$("#program_idx").val();

    var formData = {
      'member_program_idx' : member_program_idx,
      'record_time' : record_time,
      'program_idx' : program_idx
    };

    $.ajax({
      url      : "/<?=mapping('program')?>/timer_mod_up",
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
        if(result.code == 0) {
          alert(result.code_msg);
        } else if(result.code == 1) {
          alert(result.code_msg);
          api_request_exercise('0');
          location.href = '/<?=mapping('main')?>';
        }
      }
    });
  }

  function default_scrap(program_idx){

    COM_login_check('<?=$this->member_idx?>','') 

    $.ajax({
    url      : "/<?=mapping('program')?>/scrap_mod_up",
    type     : "POST",
    dataType : "json",
    async    : true,
    data     : {
      'program_idx':program_idx
    },
    success: function(result) {
      // -1:유효성 검사 실패
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        // alert(result.code_msg);
      } else if(result.code == 1) {
        // alert(result.code_msg);
      }
    }
    });
  }

  function like_reg_in(program_idx){

    COM_login_check('<?=$this->member_idx?>','') 

    $.ajax({
    url      : "/common/like_reg_in",
    type     : "POST",
    dataType : "json",
    async    : true,
    data     : {
      'program_idx':program_idx
    },
    success: function(result) {
      // -1:유효성 검사 실패
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        // alert(result.code_msg);
      } else if(result.code == 1) {
        document.getElementById("like_cnt").innerHTML = result.like_cnt
        // alert(result.code_msg);
        // location.reload();
      }
    }
    });
  }

let criteria_scroll_top = 0;
$(window).on('scroll',function (){
	let scrollTop = $(this).scrollTop();
	if(scrollTop > criteria_scroll_top){
    $('header').addClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back.png');
		// $('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot.png');
	}else{
    $('header').removeClass('fixed');
		$('header').find('.btn_back').find('img').attr('src','/images/head_btn_back_w.png');
		// $('header').find('.btn_close').find('img').attr('src','/images/head_btn_dot_w.png');

	}
})
</script>