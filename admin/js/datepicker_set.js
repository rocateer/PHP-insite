$(document).ready(function(){


  for (var i = 0; i < 100; i++) {

    $("#s_date_"+i).datepicker({
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
      changeMonth: true,
      changeYear: true,
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function(selectedDate) {
        console.log(selectedDate);
        $("#e_date_"+i).datepicker("option", "minDate", selectedDate);
      }
    });

    $("#e_date_"+i).datepicker({
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
      changeMonth: true,
      changeYear: true,
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function(selectedDate) {
        $("#s_date_"+i).datepicker("option", "maxDate", selectedDate);
      }
    });
  }

  $("#s_date").datepicker({
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
    changeMonth: true,
    changeYear: true,
    changeMonth: true,
    numberOfMonths: 1,
    onClose: function(selectedDate) {
      $("#e_date").datepicker("option", "minDate", selectedDate);
    }
  });

  $("#e_date").datepicker({
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
    changeMonth: true,
    changeYear: true,
    changeMonth: true,
    numberOfMonths: 1,
    onClose: function(selectedDate) {
      $("#s_date").datepicker("option", "maxDate", selectedDate);
    }
  });

  $("#s_use_e_date").datepicker({
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
    changeMonth: true,
    changeYear: true,
    changeMonth: true,
    numberOfMonths: 1,
    onClose: function(selectedDate) {
      $("#e_use_e_date").datepicker("option", "minDate", selectedDate);
    }
  });

  $("#e_use_e_date").datepicker({
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
    changeMonth: true,
    changeYear: true,
    changeMonth: true,
    numberOfMonths: 1,
    onClose: function(selectedDate) {
      $("#s_use_e_date").datepicker("option", "maxDate", selectedDate);
    }
  });

  $(".select_date").datepicker({
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
    changeMonth: true,
    changeYear: true,
    changeMonth: true,
    numberOfMonths: 1,
  });

});
