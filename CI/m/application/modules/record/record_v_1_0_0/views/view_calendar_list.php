<style>
  .ui-widget-content {width: 100%;}
  .ui-datepicker-calendar {border: 0;}
  .ui-datepicker .ui-datepicker-header {border: 0; background-color: #fff; width: 160px; margin: 10px auto;}
  .ui-datepicker .ui-datepicker-title {font-size: 20px; font-weight: 800;}
  .ui-widget-header .ui-datepicker-next {top: 15px; width: 14px;}
  .ui-widget-header .ui-datepicker-prev {top: 15px; width: 14px;}
  .ui-widget-header .ui-icon {width: 14px; height: 14px; background-size: 14px;}
  .ui-datepicker-calendar th {font-size: 12px; font-weight: 800; background-color: #fff;}
  .ui-datepicker-calendar th span {font-weight: 800;}
  .ui-state-default,
  .ui-widget-content .ui-state-default,
  .ui-widget-header .ui-state-default,
  .ui-button,
  html .ui-button.ui-state-disabled:hover,
  html .ui-button.ui-state-disabled:active {font-size: 13px; color: #000;}
  .ui-state-active,
  .ui-widget-content .ui-state-active,
  .ui-widget-header .ui-state-active,
  a.ui-button:active,
  .ui-button:active,
  .ui-button.ui-state-active:hover {color: #000!important}

  .ui-state-highlight,
  .ui-widget-content .ui-state-highlight,
  .ui-widget-header .ui-state-highlight {color: #fff!important; background:url('/images/cal_point_2.png') no-repeat top center; background-size:75% auto; list-style: 16px;}

.ui-state-active, .ui-widget-content .ui-state-active, 
.ui-widget-header .ui-state-active, a.ui-button:active, 
.ui-button:active, .ui-button.ui-state-active:hover{color: #fff!important; background:url('/images/cal_point_1.png') no-repeat top center; background-size:75% auto; border:none;}
.ui-datepicker td span, .ui-datepicker td a{padding-top:10px; align-items:unset; }
.ui-datepicker td.active{background:url('/images/cal_dot_1.png') no-repeat 22px 38px; background-size:6px; height:6px;}
.ui-datepicker td.active2{background:url('/images/cal_dot_2.png') no-repeat 22px 38px; background-size:6px; height:6px;}
/* .ui-datepicker td::before{content:''; position:absolute; top:10px; width:5px; height:5px; background:#333; display:block; border-radius:10px;} */
</style>

<header>
  <div class="btn_back">
  <a href="/<?=mapping('main')?>">
      <img src="/images/head_btn_back.png" alt="">
    </a>
  </div>
  <h1>
    운동 기록
  </h1>
  <a href="/<?= mapping('record') ?>/history_list" class="head_txt">전체 기록</a>
</header>
<div class="body view_history">
  <div class="">
    <ul class="tab_menu clearfix">
      <li class="" onclick="record_list();">
      월간리포트
      </li>
      <li class="active" onclick="calendar_list();">
        캘린더
      </li>
    </ul>
    <div class="inner_wrap">
      
    <div id="datepicker" class="datepicker"></div>

    <div class="legend_wrap">
      <span class="dot_1"></span> 운동을 완료 했어요.👍 <span class="dot_2"></span> 운동을 완료하지 않았어요.😓
    </div>
      <div class="calendar_info_wrap">
        <a href="javascript:trigger()" class="area_trigger"></a>
        <div class="date_trigger"></div>
        <?
        $now = date('m.d');
        $yoil = array("일","월","화","수","목","금","토");
        $now_yoil = $yoil[date('w', strtotime(date('Y-m-d')))];
        ?>
        <h2 id="select_date"><?=$now?> (<?=$now_yoil?>)</h2>
        <div class="no_schedule" id="no_data">스케줄 된 프로그램이 없습니다.</div>
        <ul id="list_ajax">
        </ul>
      </div>
    </div>
  </div>
</div>
<script>

const calendar_info_height = ($(window).outerHeight() - $('.calendar_info_wrap').offset().top +55);
$('.calendar_info_wrap').css('height', calendar_info_height)
$('.view_history').css('padding-bottom', calendar_info_height)



let trigger_state = 'N';
function trigger(){
  if(trigger_state == 'N'){
    $('.calendar_info_wrap').css('height','calc(100vh - 100px)');
    trigger_state = 'Y';
    return;
  }else{
    $('.calendar_info_wrap').css('height',calendar_info_height);
    trigger_state = 'N';
    return;
  }
}


$(function(){
	setTimeout("default_list_get('<?=$today?>')", 10);
});
  
var active_date = [
  <?
			if (count($active_date)>0) {
				foreach ($active_date as $row) {
		?>
				{ Date: new Date("<?=$row?>") },
		<?
				}
			}
		?>

];
var active2_date = [

  <?
			if (count($active2_date)>0) {
				foreach ($active2_date as $row2) {
		?>
				{ Date: new Date("<?=$row2?>") },
		<?
				}
			}
		?>
];

$("#datepicker").datepicker({
  defaultDate:"+0w",
  dateFormat: "yy-mm-dd",
  prevText: '이전 달',
  nextText: '다음 달',
  // setDate: queryDate,
  monthNames: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
  monthNamesShort: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
  dayNames: ['일', '월', '화', '수', '목', '금', '토'],
  dayNamesShort: ['일', '월', '화', '수', '목', '금', '토'],
  dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
  showMonthAfterYear: true,
  changeMonth: false,
  changeYear: false,
  numberOfMonths: 1,
  beforeShowDay: function(date) {
    // showday(date);
    var result = [true, '', null];
    var matching = $.grep(active_date, function(event) {
      return event.Date.valueOf() === date.valueOf();
    });
    var matching2 = $.grep(active2_date, function(event) {
      return event.Date.valueOf() === date.valueOf();
    });
    if (matching.length) {
      result = [true, 'active', null];
    }
    if (matching2.length) {
      result = [true, 'active2', null];
    }
    return result;
  },
  onSelect:function(date){
    default_list_get(date);
  }
  
});
    
  function default_list_get(date){

    var formData = {
      'date' : date,
    };

    $.ajax({
      url      : "/<?=mapping('record')?>/calendar_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : formData,
      success: function(result) {

          $("#list_ajax").html(result);
          

      }
    });
  }

  function record_list(){
    location.href="/<?= mapping('record')?>";
  }

  function calendar_list(){
    location.href="/<?= mapping('record') ?>/calendar_list";
  }

</script>