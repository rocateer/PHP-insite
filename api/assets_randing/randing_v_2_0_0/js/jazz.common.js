// 나이 계산
function calcAgeGlobal(birth) {

    var date = new Date();
    var year = date.getFullYear();
    var month = (date.getMonth() + 1);
    var day = date.getDate();
    if (month < 10) month = '0' + month;
    if (day < 10) day = '0' + day;
    var monthDay = month + day;

    birth = birth.replace('-', '').replace('-', '');
    var birthdayY = birth.substr(0, 4);
    var birthdayMD = birth.substr(4, 4);

    var age = monthDay < birthdayMD ? year - birthdayY - 1 : year - birthdayY;

    return age;
}

// javascript date를 'Y,m,d' object로 돌려주기
function dateToObjectGlobal(date) {

    var year = date.getFullYear();
    var month = (date.getMonth() + 1);
    var day = date.getDate();
    if (month < 10) month = '0' + month;
    if (day < 10) day = '0' + day;

    var dateObj = {
      "year" : year,
      "month" : month,
      "day" : day
    };

    return dateObj;
}


function calcAge(birth) {

    var date = new Date();
    var year = date.getFullYear();

    birth = birth.substr(0,4);

    var age = year-birth +1;

    return age;
}

// 숫자 3자리 comma 양식
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


// 자동 validate
function validateCheck(frm){

  // 해당 폼의 데이터를 Object Array로 변환
  var formData = $(frm).serializeArray();

  var validateObj = {};
  var validateElements = [];

  var n = 0;
  var validateMsg = "";
  var validateName = "";
  var checkName = ""; // 체크박스 네임체크
  var reObj = false; // delete된 object 요소 존재 시 true로 변환

  // 유효성 검사.
  for(var i=0; i<formData.length; i++){

    // input 의 name
    var key = formData[i].name;
    // 해당 input의 value
    var value = formData[i].value

    // 해당 form 객체에서, 값이 담긴 객체의 name을 가진 객체를 선택함
    var selector = frm[key];

    // 체크박스인지 확인
    if(selector.length > 1){
      var inputType = selector[0].getAttribute("type");

      // 체크박스일 경우
      if(inputType == "checkbox" || inputType == "radio"){

        var checkVal = ""; // 체크박스의 체크한 값이 담길 변수

        // 체크박스의 네임이 이전 객체와 동일하지 않을 때
        if(checkName != key){

          // 체크된 체크박스의 값들을 담음
          for(var j=0; j<selector.length; j++){
            // 체크된 값인지 확인
            if(selector[j].checked){

              if(checkVal != ""){
                checkVal += ",";
              }

              checkVal += selector[j].value;
            }
          }

          checkName = key;
          formData[i].value = checkVal;
          validateElements[n] = key;

          n++;
        }
        // 체크박스의 네임이 이전 객체와 동일 할 때
        else{
          delete formData[i];
          reObj = true;
        }
        continue;
      }
      else{
        continue;
      }
    }

    var alertMsg = typeof(selector.getAttribute("data-alert")) != "undefined" ? selector.getAttribute("data-alert") :""; // 빈값 메세지
    var dataEmpty = typeof(selector.getAttribute("data-empty")) != "undefined" ? selector.getAttribute("data-empty") :"";  // 빈값 체크여부
    var dataType = typeof(selector.getAttribute("data-type")) != "undefined" ? selector.getAttribute("data-type") :"";  // 정규표현식 타입
    var dataTypeAlert = typeof(selector.getAttribute("data-type-alert")) != "undefined" ? selector.getAttribute("data-type-alert") :""; // 정규표현식 메세지

    // 빈값 확인
    if(dataEmpty == 1 && value == ""){

      if(validateMsg == ""){
        validateMsg = alertMsg;
        validateName = key;
        // selector.focus();
      }

      validateElements[n] = key;
      n++;
    }
    // 정규표현식 검사
    else if(dataType != ""){

      var typeCheck = jazzRegExp(value,dataType);

      if(!typeCheck){

        if(validateMsg == ""){
          validateMsg = dataTypeAlert;
          validateName = key;
          // selector.focus();
        }

        validateElements[n] = key;
        n++;
      }

    }

  }

   // radio버튼 존재여부
   if (!document.querySelector) {
    var radioElement = frm.querySelector("input[type=radio]");

    // radio 버튼 존재 여부 확인
    if(radioElement != null && typeof radioElement != "undefined" && radioElement){

      // radio버튼 체크한값
      var radioChecked = frm.querySelector("input[type=radio]:checked");

      // radio 버튼 존재 시 체크한 값 존재 여부 확인
      if(radioChecked == null && !radioChecked){
        var aletMSg = radioElement.getAttribute("data-alert");
        var radioName = radioElement.getAttribute("name");

        if(validateMsg == ""){
          validateMsg = aletMSg;
          radioElement.focus();
        }


        validateElements[n] = radioName;
        n++;
      }

    }
  }

  // 유효성검사 실패 시 담기는 메세지
  validateObj.validateMsg = validateMsg;
  validateObj.validateName = validateName;

  // form안에서 잡힌 모든 값의 name 태그
  validateObj.validateElements = validateElements;

  // 재조립 용도
  var n = 0;
  var formData2 = [];

  // delete된 object 요소가 존재 시 재조립
  if(reObj){
    for(var i=0; i<formData.length; i++){
      if(typeof formData[i] == "undefined"){
        continue;
      }
      formData2[n] = formData[i];
      n++;
    }
  }
  else{
    formData2 = formData;
  }

  // formData의 값들
  validateObj.formData = formData2;

  return validateObj;

}


var NumTest = /[^0-9]/gi;
var EmailTest = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
var PwdTest = /^.*(?=.{6,12})(?=.*[0-9])(?=.*[a-zA-Z]).*$/;
var IdTest = /([\w-\.]+){6,10}$/;

var ExTest = /^[a-zA-z][a-zA-Z0-9]{5,10}$/gi;

//타입별 정규표현식 확인
function jazzRegExp(val, dataType){

  var returnCheck = true;

  switch(dataType){

    case "id" :
      if(!IdTest.test(val)){
        returnCheck = false;
      }
      break;

    case "password" :
      if(!PwdTest.test(val)){
        returnCheck = false;
      }
      break;

    case "email" :
      if(!EmailTest.test(val)){
        returnCheck = false;
      }
      break;

    case "number" :
      if(NumTest.test(val)){
        returnCheck = false;
      }
      break;

    default:
      break;

  }

  return returnCheck;

}


// bootstrap Dialog - alert
function bootAlert(msg, fn1){

  var dialogMsg = new BootstrapDialog({
    title: '확인해주세요.',
    message: msg,
    size: BootstrapDialog.SIZE_SMALL,
    buttons: [{
      label: '확인',
      action: function(dialog) {
        dialogMsg.close();
      }
    }],
    onhidden: fn1
  }).open();

}

// bootstrap Dialog - Confirm
function bootConfirm(msg, fn1, fn2){

  var dialogConfirm = new BootstrapDialog.confirm({
    title: '확인해주세요.',
    message: msg,
    type: BootstrapDialog.TYPE_PRIMARY, // <-- Default value is BootstrapDialog.TYPE_PRIMARY,
    size: BootstrapDialog.SIZE_SMALL,
    closable: false, // <-- Default value is false
    draggable: false, // <-- Default value is false
    btnCancelLabel: '취소', // <-- Default value is 'Cancel',
    btnOKLabel: '확인', // <-- Default value is 'OK',
    // btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
    callback: function(result) {
      if(result) {
        fn1();
      }else {
        fn2();
      }
      dialogConfirm.close();
    }
  }).open();

}
