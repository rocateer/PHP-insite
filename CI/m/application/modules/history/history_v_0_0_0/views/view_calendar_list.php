<style>
  .ui-widget-content {
    width: 100%;
  }

  .ui-datepicker-calendar {
    border: 0;
  }

  .ui-datepicker .ui-datepicker-header {
    border: 0;
    background-color: #fff;
    width: 160px;
    margin: 10px auto;
  }

  .ui-datepicker .ui-datepicker-title {
    font-size: 20px;
    font-weight: 800;
  }

  .ui-widget-header .ui-datepicker-next {
    top: 15px;
    width: 14px;
  }

  .ui-widget-header .ui-datepicker-prev {
    top: 15px;
    width: 14px;
  }

  .ui-widget-header .ui-icon {
    width: 14px;
    height: 14px;
    background-size: 14px;
  }

  .ui-datepicker-calendar th {
    font-size: 12px;
    font-weight: 800;
    background-color: #fff;
  }

  .ui-datepicker-calendar th span {
    font-weight: 800;
  }

  .ui-state-default,
  .ui-widget-content .ui-state-default,
  .ui-widget-header .ui-state-default,
  .ui-button,
  html .ui-button.ui-state-disabled:hover,
  html .ui-button.ui-state-disabled:active {
    font-size: 13px;
    color: #000
  }

  .ui-state-active,
  .ui-widget-content .ui-state-active,
  .ui-widget-header .ui-state-active,
  a.ui-button:active,
  .ui-button:active,
  .ui-button.ui-state-active:hover {
    color: #000!important
  }

  .ui-state-highlight,
  .ui-widget-content .ui-state-highlight,
  .ui-widget-header .ui-state-highlight {
    color: #fff!important; background:url('/images/cal_point_2.png') no-repeat top center; background-size:75% auto; list-style: 16px;;
  }

.ui-state-active, .ui-widget-content .ui-state-active, 
.ui-widget-header .ui-state-active, a.ui-button:active, 
.ui-button:active, .ui-button.ui-state-active:hover{
  color: #fff!important; background:url('/images/cal_point_1.png') no-repeat top center; background-size:75% auto; border:none;
  }
.ui-datepicker td span, .ui-datepicker td a{padding-top:10px; align-items:unset; }
.ui-datepicker td.active{background:url('/images/cal_dot_1.png') no-repeat 22px 38px; background-size:6px; height:6px;}
.ui-datepicker td.active2{background:url('/images/cal_dot_2.png') no-repeat 22px 38px; background-size:6px; height:6px;}
/* .ui-datepicker td::before{content:''; position:absolute; top:10px; width:5px; height:5px; background:#333; display:block; border-radius:10px;} */
</style>
<header>
  <div class="btn_back" onclick="COM_history_back_fn()">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
    운동 기록
  </h1>
  <a href="/<?= mapping('history') ?>/history_all_list" class="head_txt">전체 기록</a>
</header>
<div class="body view_history">
  <div class="">
    <ul class="tab_menu clearfix">
      <li class="" onclick="location.href='/<?= mapping("history") ?>'">
      월간리포트
      </li>
      <li class="active" onclick="location.href='/<?= mapping("history") ?>/calendar_list'">
        캘린더
      </li>
    </ul>
    <div class="inner_wrap">
      <div id="datepicker" class="datepicker"></div>
      <div class="calendar_info_wrap">
        <a href="javascript:trigger()" class="area_trigger"></a>
        <div class="date_trigger"></div>
        <h2>01.13 (일)</h2>
        <ul>
          <li class="complete">
            <a href="/<?= mapping('main') ?>/product_detail">

              <table>
                <colgroup>
                  <col width='55px'>
                  <col width='*'>
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box">
                      <img src="/p_images/s1.png" alt="">
                    </div>
                  </th>
                  <td>
                    <table class="tbl_4_1">
                      <tr>
                        <th>
                          <span class="name">골반근육강화프로그램</span>
                          <span class="name f_right">13분 11초</span>
                        </th>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <p class="date">토 / 일<span class="f_right">2022.08.01 ~ 2022.08.29</span></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </a>
          </li>
          <li>
            <a href="/<?= mapping('main') ?>/product_detail">

              <table>
                <colgroup>
                  <col width='55px'>
                  <col width='*'>
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box">
                      <img src="/p_images/s1.png" alt="">
                    </div>
                  </th>
                  <td>
                    <table class="tbl_4_1">
                      <tr>
                        <th>
                          <span class="name">골반근육강화프로그램</span>
                          <span class="name f_right">13분 11초</span>
                        </th>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <p class="date">토 / 일<span class="f_right">2022.08.01 ~ 2022.08.29</span></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<script>
  var active_date = [
    {
      Title: "",
      Date: new Date("09/08/2022")
    }, 
    {
      Title: "",
      Date: new Date("10/12/2022")
    }, 
  ];
  var active2_date = [{
    Title: "",
    Date: new Date("09/09/2022")
  }, ];

  $("#datepicker").datepicker({
    defaultDate: "+0w",
    dateFormat: "yy-mm-dd",
    prevText: '이전 달',
    nextText: '다음 달',
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
  });

  const calendar_info_height = ($(window).outerHeight() - $('.calendar_info_wrap').offset().top - 30);
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
</script>