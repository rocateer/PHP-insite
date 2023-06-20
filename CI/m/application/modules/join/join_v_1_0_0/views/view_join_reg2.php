<!-- header : s -->
<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
  <h1>회원가입</h1>
</header>

<!-- header : e -->
<div class="body row">
  <div class="inner_wrap">
    <form class="find_form">
      <div>
        <h2>계정 정보 입력
          <div class="step_ui">
            <span class="before"></span>
            <span class="active">2</span>
            <span></span>
          </div>
        </h2>
      </div>
      <ul class="input_ui row mt40">
        <li>
          <label>이름<span class="essential">*</span></label>
          <input type="text" id="member_name" name="member_name" placeholder="이름을 입력해 주세요.">
        </li>
        <li>
          <label>닉네임<span class="essential">*</span></label>
          <input type="text" id="member_nickname" name="member_nickname" placeholder="닉네임을 입력해 주세요.">
        </li>
        <li>
          <label class="region">지역선택<span class="essential">*</span></label>
          <a href="#" onclick="modal_open('region')" class="btn essential">선택하기</a>
          <input type="text" class="input_dark mt5" id="region_full_name" name="region_full_name" placeholder="주로 활동하는 지역을 선택해주세요">
        </li>
      </ul>
      <div class="all_checkbox row mt40 mb30">
        <ul>
          <li>
            <input type="checkbox" name="checkAll" id="checkAll" >
            <label for="checkAll">
              <span></span>
              전체 약관 동의
            </label>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="checkOne_1" value="Y" >
            <label for="checkOne_1">
              <span></span>
              서비스 이용약관 
              <a href="#" class="essential">필수</a>
            </label>
            <a class="look" href="javascript:void(0)" onclick="modal_open('terms1')" >보기</a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="checkOne_2" value="Y" >
            <label for="checkOne_2">
              <span></span>
              개인정보 취급방침 
              <a href="#" class="essential">필수</a>
            </label>
            <a class="look" href="javascript:void(0)" onclick="modal_open('terms2')">보기</a>
          </li>
          <li>
            <input type="checkbox" name="checkOne" id="marketing_agree_yn" value="Y" >
            <label for="marketing_agree_yn">
              <span></span>
              마케팅 수신 동의
            </label>
            <a class="look" href="javascript:void(0)" onclick="modal_open('terms0')">보기</a>
          </li>

        </ul>
      </div>
      <div class="btn_space">
        <a href="javascript:void(0)" class="btn_point btn_floating" onclick="default_reg_in()">다음</a>
      </div>
    </form>
  </div>
</div>

<?foreach($terms_list as $row){
    ?>
  <!-- modal : s -->
  <div class="modal modal_full modal_terms<?=$row->type?>">
    <header>
      <a class="btn_left" href="#">
        <img class="w_100" src="/images/haed_btn_back.png" onclick="modal_close('terms<?=$row->type?>')" alt="뒤로가기">
      </a>
      <h1><?=$row->title?></h1>
    </header>
    <!-- header : e -->
    <div class="body">
      <div id="edit">
      <?=$row->contents?>
      </div>
    </div>
  </div>
  <!-- modal : e -->
<?}?>

<!-- 지역선택 모달 -->
  <div class="modal modal_full modal_region" id="region_ajax" style="display:none;">
    <header>
      <a class="btn_left" href="#">
        <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('region')" alt="뒤로가기">
      </a>
      <h1>근무 지역 선택</h1>
    </header>
    <!-- header : e -->
    <div class="modal_body">
      <ul class="area_title">
        <li>지역구분</li>
        <li>시 · 군 · 구</li>
      </ul>
      <div class="region_ui">
        <ul class="area_item_1">
          <?foreach($city_list as $row){?>
            <li><?=$row->city_name?></li>
          <?}?>
        </ul>
        <ul class="area_item_2" name="region_idx" id="region_idx">
        </ul>
      </div>
    </div>
    <a href="javascript:void(0)" class="btn_point btn_floating" onclick="region_reg();">선택</a>
  </div>
<!-- 지역 선택 모달 -->

<input type="text" name="city_name" id="city_name" value="" style="display: none;">
<input type="text" name="region_name" id="region_name" value="" style="display: none;">
<input type="text" name="region_code" id="region_code" value="" style="display: none;">

<script type="text/javascript">

// 가입하기
function default_reg_in(){
  var selected_idx = get_checkbox_value('checkOne');

  if(selected_idx !="Y,Y,Y" && selected_idx !="Y,Y"){
    alert("필수 약관 동의에 체크해주세요.");
    return  false;
  }

  var member_name = $("#member_name").val();
  var member_nickname = $("#member_nickname").val();
  var region_code = $("#region_code").val();
  var marketing_agree_yn = $("input[id='marketing_agree_yn']:checked").val();

  var formData = {
    'member_name' :  member_name,
    'member_nickname' :  member_nickname,
    'region_code' : region_code,
    'marketing_agree_yn' : marketing_agree_yn
  };

  $.ajax({
    url      : "/<?=mapping('join')?>/join_reg_in2",
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
      }else{
        sessionStorage.member_name = member_name;
        sessionStorage.member_nickname = member_nickname;
        sessionStorage.region_code = region_code;
        sessionStorage.marketing_agree_yn = marketing_agree_yn;

        location.href = "/<?=mapping('join')?>/join_reg3";
      }
    }
  });
}

//시,구,군 가져오기
var region_list = function(city_name) {

$.ajax({
  url: "/common/region_list",
  type: 'POST',
  dataType: 'json',
  async: true,
  data: {
      "city_name" : city_name
  },
  success: function(dom){
    var selectStr = "";
    var func = "onclick='region_func(this)'";

    $('#region_idx').html("");
    if(dom.length != 0) {
      for(var i = 0; i < dom.length; i ++) {
        selectStr += "<li value='"+ dom[i].region_code  + "' "+func+">" + dom[i].region_name + "</li>";
      }
      $('#region_idx').append(selectStr);
    }
  }
});
}

//시도 선택시
$('.area_item_1 li').click(function(){
      $('.area_item_1 li').removeClass( 'active' );
      $(this).addClass( 'active' );
      $("#city_name").val($(this).text());
      region_list($(this).text());
})

//시군구 선택시
function region_func(element){
    $('.area_item_2 li').removeClass( 'active' );
    element.classList.add("active");
    $('#region_code').val(element.value);
    $('#region_name').val(element.innerHTML);
}

//근무지역선택
function region_reg(){
    var region_name = $("#region_name").val();
    var city_name = $("#city_name").val();
    var region_full_name = city_name+' > '+region_name;

    if(region_name==''||city_name==''){
      alert("근무 지역을 선택해주세요.");
      return;
    }

    $('#region_full_name').val(region_full_name);
    modal_close('region')
}

</script>
