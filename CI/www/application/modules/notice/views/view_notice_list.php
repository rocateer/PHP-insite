<div class="body">
  <div class="inner_wrap">
    <div class="board_wrap">

      <!-- left_menu : s -->
      <div class="board_left_menu">
        <h1><a href="/cscenter">고객센터</a></h1>
        <ul>
          <li><a class="active" href="/notice">공지사항</a></li>
          <li><a href="/faq">FAQ</a></li>
        </ul>
        <div>
          <p><img src="/images/icon_phone.png" alt=""></p>
          <p><strong>1677-5644</strong></p>
          <p>customer@rocateer.com</p>
          <span>
            AM 09:00 ~ PM 06:00<br>
            (점심시간 : PM 12:00 ~ 01:00)<br>
            토, 일, 공휴일 휴무
          </span>
          <span class="btn_b btn_basic"><a href="#">1:1 문의하기</a></span>
        </div>
      </div>
      <!-- left_menu : e -->

      <!-- menu_right_con : s -->
      <div class="board_right_con">
        <p class="path">HOME<span>&gt;</span>고객센터<span>&gt;</span>공지사항<span></p>

        <div class="top_title">
          <h1>공지사항</h1>
          <p>즐거운 쇼핑이 될 수 있도록 정성을 다하겠습니다.</p>
        </div>

        <div id="list_ajax">  </div>

      </div>
      <!-- menu_right_con : e -->
    </div>
  </div>
</div>

<input name="page_num" id="page_num" type="hidden" value="1">
<script>

  $(function(){
    default_list_get();
  });

  //list_get
  function default_list_get(){

    var page_num = $('#page_num').val();

    $.ajax({
      url      : "/notice/notice_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : {
               "page_num":page_num
      },
      success  : function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  //페이지 이동
  var page_go=function(page){
    $('#page_num').val(page);
  	$(default_list_get());
  }

  </script>
