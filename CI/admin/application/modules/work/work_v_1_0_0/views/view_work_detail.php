<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>직종인증 신청 상세</h1>
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
            <th style="text-align:center">아이디</th>
            <td><?=$result->member_id?></td>
            <th style="text-align:center">이름</th>
            <td><?=$result->member_name?></td>
          </tr>
          <tr>
            <th style="text-align:center">닉네임</th>
            <td><?=$result->member_nickname?></td>
            <th style="text-align:center">전화번호</th>
            <td><?=$this->global_function->format_phone($result->member_phone);?></td>
          </tr>
          <tr>
            <th style="text-align:center">직종</th>
            <td><?=$result->work_name?></td>
            <th style="text-align:center">인증 상태</th>
            <td>
              <?php if($result->state == '0'){ echo "승인요청"; }
              else if($result->state == '1'){ echo "승인"; }
              else if($result->state == '2'){echo "거절";} 
              ?>
            </td>
          </tr>
          <tr>
            <th style="text-align:center">요청일자</th>
            <td><?=$result->ins_date?></td>
            <th style="text-align:center">승인일자</th>
            <td><?=($result->state==1)?$result->admission_date:'-'?></td>
          </tr>
          <tr>
            <th style="text-align:center">인증 사진</th>
            <td colspan="3" style="height: 150px;">
              <? if($result->img!=''){
                $img_arr=explode(',',$result->img);?>
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
        </tbody>
      </table>
      <br>
      
      <div class="row table_title">
        <div class="col-lg-6"> &nbsp;<strong>메모</strong></div>
      </div>

      <table class="table table-bordered td_left">
        <colgroup>
          <col style="width:15%">
          <col style="width:35%">
          <col style="width:35%">
          <col style="width:15%">
        </colgroup>
        <tbody>
          <tr>
            <td colspan=3>
              <textarea name="memo" style="width:100%; height:200px;" id="memo" placeholder="내용" class="input_default"><?=$result->memo?></textarea>
            </td>
            <th><a href="javascript:void(0)"  onClick="memo_mod_up('<?=$result->work_confirm_idx?>')" class="btn btn-info">저장</a></th>
          </tr>
       </tbody>
      </table>
     
      <div class="col-lg-12 text-right">
        <a href="javascript:history.go(-1)" class="btn btn-gray">목록</a>

      <?if($result->state == 0){?>
      <a class="btn btn-danger" data-toggle="modal" data-target="#myModal">거절</a>
      <a class="btn btn-success" href="javascript:void(0)" data-toggle="modal" data-target="#blind"  onclick="state_mod_up('<?=$result->work_confirm_idx?>','1','인증을 승인');">승인</a>
      <?}?>
      </div>
    <!-- -->
    </div>
  </div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="top:175px">
    <div class="modal-dialog" role="document" style="width:200px">
      <div class="modal-content">
        <div class="table-responsive">
          <div>
          인증를 거절 하시겠어요? <br> 거절 사유를 입력해주세요.
          </div>
          <input name="reject_reason" style="width:100%; height:200px;" id="reject_reason" placeholder="사유를 입력해주세요.">
            <div class="text-center mt20">
              <a href="javascript:void(0)" class="btn btn-success" onclick="state_mod_up('<?=$result->work_confirm_idx?>','2','인증을 거절');">확인</a>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
<!-- container-fluid : e -->
<input type="hidden" name="member_idx" id="member_idx" value="<?=$result->member_idx?>">
<input type="text" name="page_num" id="page_num" value="1" style="display:none">

<script>

  function state_mod_up(work_confirm_idx,state,str){

    if (!confirm(str+' 하시겠습니까?')) {
      return;
    }

    var form_data = {
      'member_idx' :  $('#member_idx').val(),
      'reject_reason' :  $('#reject_reason').val(),
      'work_confirm_idx' :  work_confirm_idx,
      'state' :  state
    };

    $.ajax({
      url      : "/<?=mapping('work')?>/state_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result) {
        if(result.code == "0"){
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          location.href = '/<?=mapping('work')?>';
        }
      }
    });
  }

  function memo_mod_up(work_confirm_idx){

    var form_data = {
      'memo' :  $('#memo').val(),
      'work_confirm_idx' :  work_confirm_idx
    };

    $.ajax({
      url      : "/<?=mapping('work')?>/memo_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : form_data,
      success: function(result) {
        if(result.code == "0"){
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          location.reload();
        }
      }
    });
  }

</script>
