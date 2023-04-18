<style>
#work_check span{display: block; width:100%; text-align: center; line-height:30px; font-weight: 500;}
#work_check .work_state_bgcolor_0{color: #fff; background: #ef6767}
#work_check .work_state_bgcolor_1{color: #fff; background: #5b84c1}
#work_check .work_state_bgcolor_2{color: #fff; background: #3ecfdc}
#work_check .work_state_bgcolor_3{color: #fff; background: #d8873e}
#work_check .work_state_bgcolor_4{color: #fff; background: #5eb054}
.work_state_check_memo{display: block; width:270px; padding: 5px; border: 1px solid #ccc; background: #fff; position: fixed; left: calc(100% - 370px); top: calc(100vh - 300px); z-index: 10; font-weight: 500;}
.work_state_check_memo p.placeholder{padding: 5px; color: #999; margin-bottom: 0; font-size: 11px}
.work_state_check_memo input{border: 1px solid #ddd; height: 36px; width: 100%; font-size: 11px}
.work_state_check_memo textarea{width:100%; min-height: 60px; padding:5px; margin-top: 5px; border: 1px solid #ddd;font-size: 11px}
.work_state_check_memo select{width: 135px; border: 1px solid #ddd; height: 36px; color: #666; margin-right: 2px}
.work_state_check_memo ::placeholder{color: #999;}
.work_state_check_memo .memo_btn{display: inline-block; font-size: 14px; padding: 6px 12px; margin: 0 2px; text-align: center; vertical-align: middle; background: #34acad; color: #fff; border-radius: 3px}
.work_check_wrap{font-size: 14px;width:0; height:100%; background:#fff; border-left:1px solid #ddd; position:fixed; z-index:5; right:0; top:0; padding:15px 0 0 0; z-index: 9999999;}
.work_check_wrap .f_left{float: left;}
.work_check_wrap .work_check_btn{width:20px; height:50px; background:#fff; color:#000; margin:-15px 0 0 -20px; line-height:50px; text-align:center; position: absolute; border-bottom: 1px solid #ddd; border-left: 1px solid #ddd;}
.work_check_wrap .work_check_btn:hover{background: #f6f6f6;}
.work_check_wrap .work_check_btn a{display: block; color:#000;}
.work_check_wrap .login_form{overflow: hidden;}
.work_check_wrap .login_form input{box-sizing: border-box;}
.work_check_wrap .guide_txt{font-size: 11px; color:#999; margin:12px 0;}
.work_check_wrap .position{display: block; width:100%; max-width:269px; min-width:269px; height: 40px; margin-top:15px; color:#aaa;}
.work_check_wrap .position label{cursor: pointer; position: relative; width:20%; height:40px; line-height: 40px;font-size: 12px;float: left; text-align: right; padding-right: 12px; box-sizing: border-box;margin-bottom: 0; color: #fff; font-weight: 300;}
.work_check_wrap .position label input{margin: 0; position: absolute; top:15px; left:3px; width:11px; height:11px;}
.work_check_wrap .position label[for="all"]{background-color:#ef6767;}
.work_check_wrap .position label[for="ui"]{background-color:#ffa800;}
.work_check_wrap .position label[for="web"]{background-color:#5b84c1;}
.work_check_wrap .position label[for="design"]{background-color:#5eb054; font-size: 11px; padding-right: 8px;}
.work_check_wrap .position label[for="plan"]{background-color:#3ecfdc;}
.work_check_wrap .comments.list{clear: both; display: block; line-height:30px; border-bottom:1px solid #ddd; margin-bottom:15px;color: #aaa; font-size: 12px;}
.work_check_wrap input{font-size: 16px;display:block;appearance: checkbox!important;-webkit-appearance:checkbox!important; width:13px; height:13px; margin-top: 10px; height:40px; padding: 5px; box-sizing: border-box; border: 1px solid #ddd; vertical-align: middle;}
.project_state{overflow: hidden; margin: 5px 0 10px;}
.project_state.comments{overflow: inherit;}
.project_state select{border:1px solid #ddd; box-sizing: border-box;font-size: 16px;width:135px; height: 30px; padding-left:10px; vertical-align: middle; float:left;}
.project_state .btn_save{display:block; width:69px; height: 30px; line-height: 30px; text-align: center; background:#222; color:#fff; vertical-align: middle; float:left}
.project_state .btn_save:hover{background: #000;}
.project_state .btn_list{display:block; width:65px; height: 30px; line-height: 30px; text-align: center; background:#555; color:#fff; vertical-align: middle; float:left;}
.project_state .btn_list:hover{background: #333;}
.comments_delete{color:#aaa; display:block;float:right;font-size:9px;text-align:center;width:13px;height:13px;line-height:10px;border:1px solid #aaa;border-radius:15px; cursor: pointer;}
.comments_delete:hover{color:#666; border:1px solid #666;}
</style>
<!-- 작업 완료 내역 워터마크 -->
<?php
  $this->work_check_member_idx = $this->session->userdata("work_check_member_idx");
  $this->work_check_member_name = $this->session->userdata("work_check_member_name");
  $this->work_check_member_id = $this->session->userdata("work_check_member_id");
?>
<?php $url_site_type = explode('.',$_SERVER["HTTP_HOST"]);?>
<?php if($_SERVER['REMOTE_ADDR'] =='211.118.222.133' || $_SERVER['REMOTE_ADDR'] =='211.118.222.130' ||  $_SERVER['REMOTE_ADDR'] =='222.233.62.100' && $this->uri->uri_string() !="work_check/work_check_list"){ ?>

  <div class="work_check_wrap" style="display:block;">

    <input type="hidden" id="work_check_idx" name="work_check_idx">
    <!-- <div class="work_check_btn" id="onoff"><a href="javascript:void(0)" onclick="menu_on('2')"><</a></div> -->
    <?php if($this->work_check_member_idx==""){?>
      <div class="login_form">
        아이디 : <input type="text" name="work_check_member_id" id="work_check_member_id" style="width:100%; height:40px;"><br><br>
        패스워드 : <input type="password" name="work_check_member_pw" id="work_check_member_pw" style="width:100%; height:40px;">
        <div class="project_state">
          <a href="javascript:void(0)" onclick="work_check_login_check()" id="login_btn" class="btn_save">로그인</a>
        </div>
      </div>
    <?php }else{ ?>
      <div>
        <div class="f_left" style="line-height:30px; margin-right:5px; font-size:16px;"><?=$this->work_check_member_name?> 님</div>
        <div class="project_state">
          <a href="/work_check_api/login_out" class="btn_save" style="float:right; font-size:12px">로그아웃</a>
        </div>
        <div class="guide_txt">
          N(대메뉴 순서)-N(중메뉴순서)/대 메뉴명-중 메뉴명
        </div>
        <input type="text" id = "menu_name" placeholder="ex) 2-1/정산관리-정산예정관리" style="width:100%">
        <input type="hidden" id="url" value="<?=$_SERVER['HTTP_HOST'].'/'.$this->uri->uri_string()?>">
        <input type="hidden" id="full_url" value="<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>">
        <div class="project_state">
          <select id="state" value="state">
            <option value="0">미진행</option>
            <option value="1" selected>퍼블리싱완료</option>
            <option value="2">개발추가</option>
            <option value="3">디자인추가</option>
            <option value="4">완료</option>
          </select>
          <a href="javascript:void(0)" onclick="work_check_save()" class="btn_save" style="font-size:12px">저장</a>
          <a href="javascript:void(0)" onclick="work_check_view()" class="btn_list" style="font-size:12px">바로가기</a>
        </div>

        <span class="position">
          <label for="all">
            <input type="checkbox" onclick="chk_box(this.checked)" id="all">전체
          </label>
          <label for="web">
            <input type="checkbox" name="work_checkbox" value="w" id="web">웹
          </label>
          <label for="ui">
            <input type="checkbox" name="work_checkbox" value="u" id="ui">UI
          </label>
          <label for="design">
            <input type="checkbox" name="work_checkbox" value="d" id="design">디자인
          </label>
          <label for="plan">
            <input type="checkbox" name="work_checkbox" value="f" id="plan">기획
          </label>
        </span>
        <textarea class="project_state "id="new_memo" name = "new_memo" placeholder="코멘트를 입력해주세요" style="clear:both; width:190px; height:50px; background:#f2f2f2; border:none; resize:none; float:left;font-size:16px;" onkeydown="work_check_resize(this)" onfocus="work_check_resize(this)" onkeyup="work_check_resize(this)"></textarea>
        <div class="project_state comments">
          <a href="javascript:void(0)" onclick="memo_add_reg()" id="btnSave" class="btn_save" style="width:78px;height:50px; line-height:50px;font-size:12px">추가</a>
        </div>
        <span class="comments list">코멘트 리스트</span>
        <div id="memo_list_ajax" style="overflow-y:scroll; height:500px; padding-right:10px" class="memo_list_ajax"></div>
      </div>
    <?php } ?>
  </div>

<?php }?>
<script>
function work_check_login_check(){
  var form_data = {
    'work_check_member_id' : $('#work_check_member_id').val(),
    'work_check_member_pw' : $('#work_check_member_pw').val()
  };

  $.ajax({
    url      : "/work_check_api/login_action",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : form_data,
    success: function(result){
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
      location.reload();
      }
    }
  });
}
// menu_on(2)
// 나중에 지울 것 .
function menu_on(type){
  if(type =='2'){
    $('.work_check_wrap').css('width','300px');
    $('.work_check_wrap').css('padding','15px');
    $('.work_check_wrap').css('box-sizing','border-box');
    $('.work_check_btn').css('margin','-15px 0 0 -36px');
    $('.work_check_wrap').css('margin-right','0px');
    $('#onoff').html('<a href="javascript:void(0)" onclick="menu_on(1)">></a>');
  }else{
    $('.work_check_wrap').css('width','-10px');
    $('.work_check_wrap').css('padding-right','0px');
    $('.work_check_wrap').css('padding-left','0px');
    $('.work_check_wrap').css('margin-right','-20px');
    $('#onoff').html('<a href="javascript:void(0)" onclick="menu_on(2)"><</a>');
  }
}
// 매모 숨김
function work_memo_visible(){
//  $("").hide();
  $("#work_memo_view" ).toggle( "slow" );
  if($("#work_memo_view_yn").val()==0) {
    $("#work_memo_view_yn").val(1);
    work_memo_status_up();
  }else{
    $("#work_memo_view_yn").val(0);
    work_memo_status_up();
  }
}
$( "#work_state_check_memo" ).draggable({
  stop: function() {
    work_memo_status_up()
  }
});
function work_memo_status_up (){
  var work_state_check_memo_x = $( "#work_state_check_memo" ).offset().left;
  var work_state_check_memo_y = $( "#work_state_check_memo" ).offset().top;
  var work_memo_view_yn = $( "#work_memo_view_yn" ).val();
  $.ajax({
    url: "/work_check_api/work_state_check_memo_xy_up",
    type: 'POST',
    dataType: 'json',
    data : {"work_state_check_memo_x":work_state_check_memo_x,
            "work_state_check_memo_y":work_state_check_memo_y,
            "work_memo_view_yn":work_memo_view_yn
           },
    async: true,
    success: function(){
    }
  });
}
var work_check_resize = function(obj) {
  // console.log(obj.scrollHeight);
  // obj.style.height = "1px";
  // obj.style.height = (17+obj.scrollHeight)+"px";
}
// 메모 등록
var memo_add_reg = function(){
  var new_memo = $("#new_memo").val();
  var work_check_idx = $("#work_check_idx").val();

  var selected_value =  get_checkbox_value('work_checkbox');

  if(selected_value.length<1){
    alert("선택된 분야가 없습니다.");
    return  false;
  }

  if(work_check_idx==""){
    alert('먼저 메뉴명을 등록 후에 추가를 할 수 있습니다.');
    return;
  }

  $.ajax({
    url: "/work_check_api/memo_add_reg_in",
    type: "post",
    data : {
            "new_memo":new_memo,
            "work_check_idx":work_check_idx,
            "tag" : selected_value
           },
    dataType: 'json',
    async: true,
    success: function(dom){
      //console.log();
      if(dom.code == '-1'){
      alert(dom.code_msg);
      return;
      }
      if(dom === "1"){
      //  console.log('등록이 완료 되었습니다. ');
        work_check_state(1);
        var new_memo = $("#new_memo").val('');
        $("input[name=work_checkbox]:checkbox").each(function() {
          $(this).attr("checked", false);
        });
      }
    }
  });
}
// 메모 리스트
var work_memo_list = function(){
  var work_check_idx = $("#work_check_idx").val();
  $.ajax({
    url: "/work_check_api/work_memo_list",
    type: "post",
    data : {
            "work_check_idx":work_check_idx
           },
    dataType: 'json',
    async: true,
    success: function(dom){

      html ="";
      for (var i = 0; i < dom.length; i++) {
        var tag_arr = '';
        if(dom[i].tag!=null){
          tag_arr = dom[i].tag.split(",");
        }
        html +="<li style='display:inline;color:#aaa;font-size: 14px;'>"+dom[i].work_check_member_name+"</li>";
        html +="<ul style='display:inline;'>";

        for (var  j= 0; j < tag_arr.length; j++) {
          if(tag_arr[j]=='w'){
            html +=" <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#5b84c1;border-radius:10px;margin:0 2px; color:#fff; font-size:5px; font-weight:600; text-align:center;'></li>";
          }
          if(tag_arr[j]=='u'){
            html +="  <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#ffa800;border-radius:10px;margin:0 2px; color:#fff; font-size:5px; font-weight:600;text-align:center;'></li>";
          }
          if(tag_arr[j]=='d'){
            html +="  <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#5eb054;border-radius:10px;margin:0 2px; color:#fff; font-size:5px; font-weight:600;text-align:center;'></li>";
          }
          if(tag_arr[j]=='f'){
            html +="  <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#3ecfdc;border-radius:10px;margin:0 2px; color:#fff; font-size:5px; font-weight:600;text-align:center;'></li>";
          }
          if(tag_arr[j]=='w_e'){
            html +=" <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#5b84c1;border-radius:10px;margin:0 2px; color:#fff; font-size:5px; font-weight:600; text-align:center;'>v</li>";
          }
          if(tag_arr[j]=='u_e'){
            html +="  <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#ffa800;border-radius:10px;margin:0 2px; color:#fff; font-size:5px; font-weight:600;text-align:center;'>v</li>";
          }
          if(tag_arr[j]=='d_e'){
            html +="  <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#5eb054;border-radius:10px;margin:0 2px; color:#fff; font-size:5px; font-weight:600;text-align:center;'>v</li>";
          }
          if(tag_arr[j]=='f_e'){
            html +="  <li style='cursor:pointer; display:inline-block;width:13px;height:13px;background-color:#3ecfdc;border-radius:5px;margin:0 2px; color:#fff; font-size:5px; font-weight:600;text-align:center;'>v</li>";
          }
        }
        html +="</ul>";
        if('<?=$this->work_check_member_idx?>'==dom[i].work_check_member_idx){
          html +="<li style='display:inline;float:right;width:20px;margin-top:2px' onclick='work_meme_del("+dom[i].work_check_memo_idx+")'>"+"<span class='comments_delete'>"+"x"+"</span>"+"</li>";
        }
        html +="<li style='display:inline;float:right;color:#aaa;font-size: 12px;'>"+dom[i].ins_date+"</li>";
        html +="<li style='list-style:none;border-bottom:1px solid #ddd;padding:7px 0;margin:4px 0 10px 0;font-size: 12px;  word-break: break-all;'>"+dom[i].memo.replace(/\n/g, "<br />"); + "</li>";
        html +="</br>";
      }
      $('#memo_list_ajax').html(html);
    }
  });
}
function work_meme_del(work_check_memo_idx){
  if (!confirm("정말 삭제 하실건가요?")){
    return;
  }
  $.ajax({
    url: "/work_check_api/work_check_memo_del",
    type: "post",
    data : {"work_check_memo_idx":work_check_memo_idx
           },
    dataType: 'json',
    async: true,
    success: function(dom){
      if(dom === "1"){
        //console.log('삭제가 완료 되었습니다. ');
        work_check_state(1);
      }else{
        //console.log('삭제에 실패 하였습니다.');
      }
    }
  });
}
// 작업 내역 저장
var work_check_save = function(){
  var url = $("#url").val();
  var full_url = $("#full_url").val()
  var state = $("#state").val();
  var memo = $("#memo").val();
  var menu_name = $("#menu_name").val();

  if(menu_name=="" && state!=""){
    alert('메뉴명을 작성해 주세요.');
    return;
  }else if(menu_name !="" && menu_name.search("/") < 0){
    alert('메뉴명을 형식에 맞춰 작성해 주세요.\n [ex) 1(대메뉴 순서)-1(중메뉴 순서)-/(대메뉴 시작)회원관리(대메뉴)-일반회원(중메뉴)]');
    return;
  }

  $.ajax({
    url: "/work_check_api/work_check_reg_in",
    type: "post",
    data : {"url":url,
            "full_url":full_url,
            "state":state,
            "memo":memo,
            "menu_name":menu_name
           },
    dataType: 'json',
    async: true,
    success: function(dom){
      if(dom === "1"){
        //console.log('등록이 완료 되었습니다. ');
        work_check_state(1);
      }else{
        //console.log('등록을 실패 하였습니다.');
      }
    }
  });
}
// 작업 완료 상태
var work_check_state = function(save_state) {
  var url = $("#url").val();
  var html ="";
  var save_txt ="";
  var work_state_check_memo_x = "<?=$this->session->userdata('work_state_check_memo_x')?>";
  var work_memo_view_yn = "<?=$this->session->userdata('work_memo_view_yn')?>";
  $("#work_memo_view_yn").val(work_memo_view_yn);
  if(work_memo_view_yn != 1){
    $("#work_memo_view").hide();
  }
  if(work_state_check_memo_x != ""){
    $("#work_state_check_memo").offset({left: work_state_check_memo_x});
    $("#work_state_check_memo").offset({top: '<?=$this->session->userdata('work_state_check_memo_y')?>'});
  }
  if(save_state ==1){
    save_txt ="(저장되었습니다.)";
  }
	$.ajax({
		url: "/work_check_api/work_check_state",
		type: 'POST',
		dataType: 'json',
    data : {"url":url},
		async: true,
		success: function(dom){
      if(dom != null){
        $("#state option:eq("+dom.state+")").prop("selected", "selected");
        $("#memo").val(dom.memo);
        $("#menu_name").val(dom.menu_name);
        $("#work_check_idx").val(dom.work_check_idx);
        if(dom.state == 0){
          html +="<span class='work_state_bgcolor_0'>미진행"+save_txt+"</span>";
        }else if(dom.state == 1){
          html +="<span class='work_state_bgcolor_1'>퍼블리싱 완료"+save_txt+"</span>";
        }else if(dom.state == 2){
          html +="<span class='work_state_bgcolor_2'>개발추가"+save_txt+"</span>";
        }else if(dom.state == 3){
          html +="<span class='work_state_bgcolor_3'>디자인추가"+save_txt+"</span>";
        }else if(dom.state == 4){
          html +="<span class='work_state_bgcolor_4'>완료"+save_txt+"</span>";
        }
      }else{
        html ="<span class='work_state_bgcolor_0'>미진행</span>";
      }
      $('#work_check').html(html);
      work_memo_list();
		}
	});
}
work_check_state();
/*
setTimeout(function() {
  var state = $("#state").val();
  if($("#state").val()==0){
    work_check_save();
  }
}, 5000);
*/

function chk_box(bool) {
  var obj = document.getElementsByName("work_checkbox");
  for (var i=0; i<obj.length; i++) {
    obj[i].checked = bool;
  }
}

function work_check_view(){
  window.open("http://p.admin.rocateerdev.co.kr/work_check/work_check_list?project_idx=<?=PROJECT_IDX?>&url_site_type=<?=$url_site_type[0]?>", "work_check_view");
}
</script>
