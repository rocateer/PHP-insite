// JavaScript Document

  var templates = $("#templates");
  var tpl_select_index = "";
  var btn_add_index = "";
  var tpl_cnt = "";
  var ex_area = "";
  var etc_area = "";
  var ex_cnt = "";
  var ex_total_cnt = "";
  var max_ex = 5; //최대 보기 개수(기타 포함)

  var ex_array = new Array();

  //보기 배열
  function array_in(){

    tpl_cnt_check();
    ex_array = new Array(); //보기 배열

    for(var i = 0; i < tpl_cnt ; i++){
      var target_tpl = templates.find(".template").eq(i);
      var ex_cnt = target_tpl.find(".ex_area li").length;
      var etc_cnt = target_tpl.find(".etc_area").length;
      var star_cnt = target_tpl.find(".star_area input").length;

      ex_array.push(ex_cnt + etc_cnt + star_cnt);
    }
  }

  //배열로 넘버링
  function set_num(){

    tpl_cnt_check();

    //템플릿 넘버링
    for (var i = 0; i < tpl_cnt; i++){
      var tpl_num_span = templates.find(".tpl_num").eq(i);
      var tpl_input = templates.find(".tpl_input").eq(i);

      tpl_num_span.text(i + 1);
      tpl_input.attr("id", "tpl_" + (i + 1) );

      //보기 넘버링
      for (var j = 0; j < ex_array[i]; j++){
        var tpl_num = templates.find(".template").eq(i);
        var ex_num_span = tpl_num.find(".ex_num, .etc_num").eq(j);
        var ex_input = tpl_num.find(".ex_area, .etc_area").find("input").eq(j);
        var star_input = tpl_num.find(".star_area").find("input").eq(j);

        ex_num_span.text(j + 1);
        ex_input.attr("id", "tpl_" + (i + 1) + "_ex_" + (j + 1) );
        star_input.attr("id", "tpl_" + (i + 1) + "_ex_" + (j + 1) );

      }
    }
  }

  //템플릿 선택창 띄우기
  $(document).on("click",".btn_add",function(){
    $(".tpl_select").css({bottom : 0});
    btn_add_index = $("#templates .btn_add").index(this);

    tpl_cnt_check();
  });

  //템플릿 선택창 닫기
  $(document).on("click",".tpl_close",function(){
    $(".tpl_select li").removeClass("active");
    $(".tpl_select").css({bottom : '-255px'});
  });

  //템플릿 선택창 안에서 액션
  $(document).on("click",".tpl_select li",function(){
    $(".tpl_select li").removeClass("active");
    $(this).addClass("active");
  });

  //선택 템플릿 확인
  function tpl_check_val(num){
    $("#tpl_check_val").val(num);
  }

  //추가된 템플릿 개수 체크
  function tpl_cnt_check(){
    tpl_cnt = $(".template").length;
  }

  // 템플릿 추가 함수
  function add_template(){

    var tpl_select_index = $("#tpl_check_val").val(); //템플릿 선택창에서 가져온 값

    $(".tpl_select li").removeClass("active");
    $(".tpl_select").css({bottom : '-255px'});

    $.ajax({
      url: "/poll/add_template_" + tpl_select_index, //해당 템플릿 view와 연결
      type: 'POST',
      dataType: 'html',
      async: false,
      success: function(dom) {

        if(tpl_cnt === 0){  //초기 화면일 때
          templates.append(dom);
          templates.append($(".btn_add_wrap"));
        } else if (tpl_cnt > 0) { //템플릿이 하나라도 추가된 상황일 때

          if (tpl_cnt == (btn_add_index + 1)) { //마지막 버튼 누를 때
            templates.append(dom);
            templates.append("<div class='btn_add_wrap'><hr><a class='btn_add' href='javascript:void(0)'></a><hr></div>");
          } else {    //중간 버튼 누를 때
            var click_btn = $(".btn_add_wrap").eq(btn_add_index);
            click_btn.after(dom);

            var new_tpl_num = $(".template").eq(btn_add_index + 1);
            new_tpl_num.after("<div class='btn_add_wrap'><hr><a class='btn_add' href='javascript:void(0)'></a><hr></div>");
          }
        }
        array_in();
        set_num();
      }
    });
  }

  //템플릿 선택창에서 확인 눌렀을 때 액션
  function checkfn(){
    var tpl_select_index = $("#tpl_check_val").val();
    $(".tpl_select li").removeClass("active");
    $(".tpl_select").css({bottom : '-255px'});

    add_template(tpl_select_index);
  }

  //템플릿 삭제
  $(document).on("click",".delete_tpl",function(){
    var del_tpl = $(this).parents(".template");

    tpl_cnt_check();

    //추가된 템플릿이 하나일때 (템플릿만 삭제)
    if(tpl_cnt === 1){

      del_tpl.remove();

    } else if(tpl_cnt > 1) { //두 개 이상일때 (버튼도 삭제)

      var del_tpl_index = $("#templates .template").index(del_tpl);
      var del_btn = $(".btn_add_wrap").eq(del_tpl_index);

      del_tpl.remove();
      del_btn.remove();

    }
    array_in();
    set_num();
  });

  //보기 추가
  $(document).on("click",".add_ex", function(){
    var last_ex =  $(this).parent(".template").find(".ex_area > li:last");

    etc_area = $(this).parent(".template").find(".etc_area");
    ex_cnt = $(this).parent(".template").find(".ex_area li").length;
    ex_total_cnt = ex_cnt + etc_area.length;

    $.ajax({
      url: "/poll/add_ex",
      type: 'POST',
      dataType: 'html',
      async: false,
      success: function(dom) {

        if(ex_total_cnt < max_ex){
          last_ex.after(dom);
        } else {
          alert("보기는 " + max_ex + "개까지 추가할 수 있습니다.");
        }

      }
    });

    array_in();
    set_num();
  });

  //보기 기타 추가
  $(document).on("click",".add_etc", function(){
    var etc_cnt = etc_area.length;

    ex_cnt = $(this).parent(".template").find(".ex_area li").length;
    ex_area =  $(this).parent(".template").find(".ex_area");

    $.ajax({
      url: "/poll/add_etc",
      type: 'POST',
      dataType: 'html',
      async: false,
      success: function(dom) {

        if( etc_cnt ) {
          alert("보기 기타는 하나만 등록할 수 있습니다.");
        } else if ( ex_cnt < max_ex ) {
          ex_area.after(dom);
        } else {
          alert("보기는 " + max_ex + "개까지 추가할 수 있습니다.");
        }

      }
    });
    array_in();
    set_num();
  });

  //보기, 기타 삭제
  $(document).on("click",".delete_ex", function(){
    var del_ex = $(this).parent();

    del_ex.remove();

    array_in();
    set_num();
  });
