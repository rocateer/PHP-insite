<!-- container-fluid : s -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="page-header">
    <h1>1:1 문의 상세</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
  	<div class="table-responsive">

      <!-- top -->
      <div class="row table_title">
        <div class="col-lg-12"><strong> 회원질문</strong>
        <span class="f_right" style="line-height:35px;">
          등록일: <?=$this->global_function->date_YmdHi_hyphen($result->ins_date)?>
        </span>
        </div>
      </div>
      <!-- top  -->
      <section>
      	<table class="table table-bordered td_left">
          <colgroup>
        	<col style="width:15%">
        	<col style="width:35%">
        	<col style="width:15%">
        	<col style="width:35%">
          </colgroup>
      		<tbody>
      			<tr>
              <th>닉네임</th>
              <td>
                <?=$result->member_nickname?>
              </td>
              <th>아이디</th>
              <td>
                <?=$result->member_id?>
              </td>
            </tr>
            <tr>
              <th>카테고리</th>
              <td>
                <?=$this->global_function->get_qa_type($result->qa_type)?>
              </td>
              <th>디바이스 정보</th>
              <td>
                <?=$result->device_os?> (version:<?=$result->os_version?>)  &nbsp;&nbsp;&nbsp;   [evescore앱 버전:<?=$result->app_version?>]
              </td>
            </tr>
            <tr>
              <th>제목</th>
              <td colspan="3">
                <?=$result->qa_title?>
              </td>
            </tr>
            <tr>
              <th>질문내용</th>
              <td colspan="3">
                <div class="board_box">
                  <?=nl2br($result->qa_contents)?>
                </div>
              </td>
            </tr>
            
          </tbody>
      	</table>
      </section>

      <!-- top -->
      <div class="row table_title">
        <div class="col-lg-6"> <strong> 답변 등록</strong></div>
      </div>

      <!-- top  -->
      <section>
      	<table class="table table-bordered td_left">
          <colgroup>
          	<col style="width:15%">
          	<col style="width:35%">
          	<col style="width:15%">
          	<col style="width:35%">
          </colgroup>
      		<tbody>
            <tr>
              <th>답변내용</th>
              <td colspan=3>
                <textarea name="reply_contents" style="width:100%; height:200px;" id="reply_contents" placeholder="내용" class="input_default"><?=$result->reply_contents?></textarea>
              </td>
            </tr>
          </tbody>
      	</table>
      </section>
      <div class="text-right">
        <a href="javascript:void(0)" onclick="default_list()" class="btn btn-gray" style="float:left;">목록</a>
        <a href="javascript:void(0)" onclick="reply_del()" class="btn btn-danger">답글 삭제</a>
        <a href="javascript:void(0)" onclick="reply_reg();" class="btn btn-success">답글 등록</a>
      </div>
  	</div>
  </div>
  <!-- body : e -->

</div>
<!-- container-fluid : e -->

<input name="qa_idx" id="qa_idx" type="hidden" value="<?=$result->qa_idx?>">
<input name="member_idx" id="member_idx" type="hidden" value="<?=$result->member_idx?>">

<script>


  // qa 목록
  function default_list(){
    history.back(<?=$history_data?>);
  }
 
  // qa 답변 등록
  function reply_reg(){

    var formData = {
      'qa_idx' : $('#qa_idx').val(),
      'member_idx' : $('#member_idx').val(),
      'reply_contents' : $('#reply_contents').val()
    }

    $.ajax({
    		url      : "/<?=mapping('qa')?>/qa_reply_reg_in",
    		type     : 'POST',
    		dataType : 'json',
    		async    : true,
    		data     : formData,
    		success : function(result){
          if(result.code == "-1"){
            alert(result.code_msg);
          }else{
            alert('답변이 등록되었습니다.');
            default_list();
          }
    		}
    	});
  }

  // qa 답변 삭제
  function reply_del(){

    if(confirm("답변을 삭제하시겠습니까? 답변을 삭제하시면, 미답변 상태로 변경됩니다.")){

      $.ajax({
        url      : "/<?=mapping('qa')?>/qa_reply_del",
        type     : 'POST',
        dataType : 'json',
        async    : true,
        data     : {
          "qa_idx" : $('#qa_idx').val()
        },
        success : function(result){
          if(result.code == "-1") {
            alert(result.code_msg);
          }else{
            alert('답변이 삭제되었습니다.');
            location.reload();
          }
        }
      });
    }
  }

</script>
