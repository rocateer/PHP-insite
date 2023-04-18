<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1><span>회원정보</h1>
  </div>

  <!-- body : s -->
 
      <!-- body : s -->
      <div class="bg_wh mt20">
        <!-- search : s -->
      	<div class="table-responsive">
      		<table class="table table-bordered td_left">
            <colgroup>
              <col style="width:15%">
              <col style="width:35%">
              <col style="width:15%">
              <col style="width:35%">
            </colgroup>
      			<tbody>
      				<tr>
              <th style="text-align:center">아이디(이메일)</th>
      					<td><?=$this->global_function->get_join_type($result->member_join_type);?> <?=$result->member_id?></td>
              <th style="text-align:center">닉네임</th>
                <td><?=$result->member_nickname?></td>
              </tr>
      				<tr>
              <th style="text-align:center">이름</th>
                <td><?=$result->member_name?></td>
              <th style="text-align:center">성별</th>
                <td><?=($result->member_gender=="0")?"남":"여"?></td>
              </tr>
              <tr>
              <th style="text-align:center">전화번호</th>
                <td><?=$this->global_function->format_phone($result->member_phone);?></td>
              <th style="text-align:center">가입일</th>
                <td><?=$this->global_function->date_Ymd_hyphen($result->ins_date);?></td>
              </tr>
              <tr>
              <th style="text-align:center">회원 상태</th>
                <td>
                  <?php if($result->member_state == '0'){ echo "이용중"; }
                  else if($result->member_state == '1'){ echo "이용정지"; }
                  else if($result->member_state == '2'){echo "가입대기";} 
                  else if($result->member_state == '3'){echo "탈퇴";} 
                  ?>
                </td>
                <th style="text-align:center">신고 받은 횟수</th>
                <td>
                  <?=$result->member_reported_cnt?>
                </td>
              </tr>
              
              <tr>
              <th style="text-align:center">이용정지 이력</th>
                <td><?=$result->member_leave_cnt?>
                </td>
              <th style="text-align:center">탈퇴일</th>
                <td>
                  <?=($result->member_leave_date=='')?'-':$result->member_leave_date?>
                </td>
              </tr>
              <tr>
              <th style="text-align:center">탈퇴사유</th>
               <td colspan="3">
               <?if($result->member_state ==3){?>
                  <?=($result->member_leave_reason=='')? '-':$result->member_leave_reason;?>
                 <?}?>
              </td>
              </tr>
            </tbody>
      		</table>
          <br>
          
          <div class="row table_title">
            <div class="col-lg-6"> &nbsp;<strong>나의 추가 정보</strong></div>
          </div>

          <table class="table table-bordered td_left">
            <colgroup>
              <col style="width:15%">
              <col style="width:35%">
              <col style="width:15%">
              <col style="width:35%">
            </colgroup>
      			<tbody>
            <tr>
                <th style="text-align:center">운동 목표</th>
                  <td colspan="3"><?=$this->global_function->get_exercise_goal_type($result->exercise_goal_type)?><?=($result->exercise_goal_type==4)?' : '.$result->exercise_goal:''?></td>
              </tr>
            <tr>
                <th style="text-align:center">관심 운동 부위</th>
                  <td colspan="3"><?=$this->global_function->get_exercise_part_type($result->exercise_part_type)?><?=($result->exercise_part_type==3)?' : '.$result->exercise_part:''?></td>
              </tr>
            <tr>
                <th style="text-align:center">운동 시간대</th>
                  <td><?=($result->exercise_s_time!='')?$result->exercise_s_time.'시 ':''?><?=($result->exercise_e_time!='')?'~ '.$result->exercise_e_time.'시':''?> </td>
                <th style="text-align:center">목표 허리둘레</th>
                  <td><?=($result->waist_measurement!='')?$result->waist_measurement.' 인치':''?></td>
              </tr>
            </tbody>
          </table>
          <br>

          <div class="row table_title">
            <div class="col-lg-6"> &nbsp;<strong>회원 운동 기록</strong></div>
          </div>

          <table class="table table-bordered td_left">
            <colgroup>
              <col style="width:15%">
              <col style="width:35%">
              <col style="width:15%">
              <col style="width:35%">
            </colgroup>
      			<tbody>
            <tr>
                <th style="text-align:center">완료한 프로그램 횟수</th>
                  <td><?=($result->cnt=='')?'0':$result->cnt?> 회</td>
                <th style="text-align:center">누적 운동시간</th>
                <?
                $hour =(int)substr( $result->month_record_time, 0,2 ); 
                 $min=(int)substr( $result->month_record_time, 3,2 ); 
                 $sec=(int)substr( $result->month_record_time, -2 );
                ?>
                  <td><?=($hour>0)?(int)$hour.'시 ':''?><?=($min>0)?(int)$min.'분 ':''?><?=($sec>0)?(int)$sec.'초 ':'0초'?></td>
              </tr>
            </tbody>
          </table>

          
          <div class="col-lg-12 text-right">
            <a href="javascript:history.go(-1)" class="btn btn-gray">목록</a>

          <?if($result->member_state == '0'){?>
          <a class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#blind"  onClick="del_yn_mod_up('<?=$result->member_idx?>','P','해당 계정을 이용정지 처리','1');">이용정지</a>
          <?}?>

          <?if($result->member_state == '1'){?>
          <a class="btn btn-info" href="javascript:void(0)" onClick="del_yn_mod_up('<?=$result->member_idx?>','N','이용정지 해제','0');">이용정지해제</a>
          <?}?>
          </div>
        <!-- -->
        </div>
      </div>
<!-- container-fluid : e -->
<input type="hidden" name="member_idx" id="member_idx" value="<?=$result->member_idx?>">
<input type="text" name="page_num" id="page_num" value="1" style="display:none">

<script>

//이용정지
function del_yn_mod_up(member_idx,del_yn,str,member_state){

if (!confirm(str+' 하시겠습니까?')) {
  return;
}

var form_data = {
  'member_idx' :  member_idx,
  'del_yn' :  del_yn,
  'member_state' :  member_state, 
};

$.ajax({
  url      : "/<?=mapping('member')?>/del_yn_mod_up",
  type     : 'POST',
  dataType : 'json',
  async    : true,
  data     : form_data,
  success: function(result) {
    if(result.code == "0"){
      alert(result.code_msg);
    }else{
      alert(result.code_msg);
      location.href = '/<?=mapping('member')?>';
    }
  }
});

}


// 기업 상태 변경 수정
function member_state_mod_up( member_idx, member_state){

  if(!confirm("가입 승인 완료 처리를 하시겠습니까?")){
      return;
    }

    var formData = {

  "member_idx" : member_idx,
  "member_state" : member_state,
};

$.ajax({
  url      : "/<?=mapping('member')?>/member_state_mod_up",
  type     : 'POST',
  dataType : 'json',
  async    : true,
  data     : formData,
  success: function(result){
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
      location.reload();
    }
  }
});
}



</script>
