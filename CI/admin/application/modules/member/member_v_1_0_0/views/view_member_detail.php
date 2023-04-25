<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1><span>회원정보</h1>
  </div>

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
          <th style="text-align:center">가입 유형</th>
            <td><?=$this->global_function->get_join_type($result->member_join_type);?></td>
          <th style="text-align:center">아이디(이메일)</th>
            <td><?=$result->member_id?></td>
          </tr>
          <tr>
          <th style="text-align:center">이름</th>
            <td><?=$result->member_name?></td>
          <th style="text-align:center">닉네임</th>
            <td><?=$result->member_nickname?></td>
          </tr>
          <tr>
          <th style="text-align:center">전화번호</th>
            <td><?=$this->global_function->format_phone($result->member_phone);?></td>
          <th style="text-align:center">지역</th>
            <td><?=$result->city_name?> > <?=$result->region_name?></td>
          </tr>
          <tr>
          <th style="text-align:center">회원 상태</th>
          <td>
              <?php if($result->del_yn == 'N'){ echo "이용중"; }
              else if($result->del_yn == 'P'){ echo "이용정지"; }
              else if($result->del_yn == 'Y'){echo "탈퇴";} 
              ?>
            </td>
          <th style="text-align:center">가입일</th>
            <td><?=$this->global_function->date_Ymd_hyphen($result->ins_date);?></td>
          </tr>
          <tr>
          <th style="text-align:center">탈퇴일</th>
            <td>
              <?=($result->member_leave_date=='')?'-':$result->member_leave_date?>
            </td>
          <th style="text-align:center">탈퇴사유</th>
            <td colspan="3">
            <?if($result->del_yn =='Y'){?>
              <?=($result->member_leave_reason=='')? '-':$result->member_leave_reason;?>
              <?}?>
          </td>
          </tr>
        </tbody>
      </table>
      <br>
      
      <div class="row table_title">
        <div class="col-lg-6"> &nbsp;<strong>인증 정보</strong></div>
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
          <?if($result->work_yn=='Y'){?>
            <th style="text-align:center">인종 직증</th>
            <td><?=$result->work_name?></td>
            <th style="text-align:center">승인일</th>
            <td><?=$result->admission_date?></td>
            <?}else{?>
              <td colspan="4" style="text-align:center">승인된 직종 정보가 없습니다.</td>
              <?}?>
          </tr>
        </tbody>
      </table>
      <br>

      <div class="row table_title">
        <div class="col-lg-6"> &nbsp;<strong>프로필 정보</strong>&nbsp;&nbsp;
        <?if($result->display_yn!=''&&$result->del_yn=='N'){?>
          <a href="javascript:void(0)"  onClick="display_mod_up()" class="btn-sm btn-info"><?=($result->display_yn=='Y')?'블라인드':'블라인드 해제'?></a>
        <?}?>
        </div>
      </div>

      <table class="table table-bordered td_left">
        <colgroup>
          <col style="width:15%">
          <col style="width:35%">
          <col style="width:15%">
          <col style="width:35%">
        </colgroup>
        <tbody>
        <?if($result->profile_yn=='Y'){?>
          <?if($result->del_yn=='N'){?>
            <tr>
              <th style="text-align:center">노출 여부</th>
              <td><?=($result->display_yn=='Y')?'노출중':'노출 안함'?></td>
              <th style="text-align:center">신고받은 횟수</th>
              <td><?=($result->report_cnt=='')?'0':$result->report_cnt?></td>
            </tr>
          <?}?>
          <tr>
            <th style="text-align:center">성별</th>
            <td><?=($result->member_gender<1)?'남':'여'?></td>
            <th style="text-align:center">생년월일</th>
            <td><?=$result->member_birth?></td>
          </tr>
          <tr>
            <th style="text-align:center">희망급여</th>
            <td>
              <?=$this->global_function->get_pay_type($result->pay_type)?>
            </td>
            <th style="text-align:center">경력</th>
            <td>
              <?=$this->global_function->get_career_type($result->career)?>
            </td>
          </tr>
          <tr>
            <th style="text-align:center">구직 프로필 제목</th>
            <td colspan="3"><?=$result->title?></td>
          </tr>
          <tr>
            <th style="text-align:center">포트폴리오</th>
            <td colspan="3" style="height: 150px;">
              <? if($result->profile_img!=''){
                $img_arr=explode(',',$result->profile_img);?>
                <ul id="img">
                  <?php foreach($img_arr as $row){ ?>
                    <li id="id_file_img_0" style="display:inline-block;">
                      <img src="<?=$row?>" style="width:160px">
                    </li>
                  <?php } ?>
                </ul>
              <?}?>
            </td>
          </tr>
          <tr>
            <th style="text-align:center">상세 내용</th>
            <td colspan="3" style="height: 200px;">
              <?=nl2br($result->contents)?>
            </td>
          </tr>
          <?}else{?>
            <tr>
              <td colspan="4" style="text-align:center">등록된 프로필 정보가 없습니다.</td>
            </tr>
          <?}?>
        </tbody>
      </table>
    
      
      <div class="col-lg-12 text-right">
        <a href="javascript:history.go(-1)" class="btn btn-gray">목록</a>

      <?if($result->del_yn == 'N'){?>
      <a class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#blind"  onClick="del_yn_mod_up('<?=$result->member_idx?>','P','해당 계정을 이용정지 처리');">이용정지</a>
      <?}?>

      <?if($result->del_yn == 'P'){?>
      <a class="btn btn-info" href="javascript:void(0)" onClick="del_yn_mod_up('<?=$result->member_idx?>','N','이용정지 해제');">이용정지해제</a>
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
  function del_yn_mod_up(member_idx,del_yn,str){

    if (!confirm(str+' 하시겠습니까?')) {
      return;
    }

    var form_data = {
      'member_idx' :  member_idx,
      'del_yn' :  del_yn
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

  function display_mod_up(){

    var formData = {
      "member_idx" : $('#member_idx').val()
    };

    $.ajax({
      url      : "/<?=mapping('member')?>/display_mod_up",
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
