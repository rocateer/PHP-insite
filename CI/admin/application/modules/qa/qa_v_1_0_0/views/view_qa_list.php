<!-- container-fluid : s -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="page-header">
		<h1>1:1 문의 관리</h1>
	</div>

  <!-- body : s -->
  <div class="bg_wh mt20">
  	<div class="table-responsive">
      <form name="form_default" id="form_default" method="post">
    		<table class="search_table">
					<colgroup>
						<col style="width:15%">
						<col style="width:35%">
						<col style="width:15%">
						<col style="width:35%">
					</colgroup>
    			<tbody>
            <tr>
              <th width="150" style="text-align:center;">닉네임</th>
                <td>
                  <input name="member_nickname" id="member_nickname" class="form-control" placeholder="" autocomplete="off" >
                </td>
                <th width="150" style="text-align:center;">아이디</th>
              <td>
                <input name="member_id" id="member_id" class="form-control" placeholder="">
              </td>
            </tr>
            <tr>
              <th width="150" style="text-align:center;">제목</th>
                <td>
                  <input name="qa_title" id="qa_title" class="form-control" placeholder="" autocomplete="off" >
                </td>
              <th width="150" style="text-align:center;">문의일</th>
                <td>
                  <input name="s_date" id="s_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;">&nbsp;<span class="material-icons">date_range</span>&nbsp;~&nbsp;
                  <input name="e_date" id="e_date" class="form-control datepicker" autocomplete="off" readonly style="width: 40%;" >&nbsp;<span class="material-icons">date_range</span>
                </td>
            </tr>
            <tr>
              <th width="150" style="text-align:center;">답변 상태</th>
              <td>
                <label class="radio-inline"><input type="radio" name="reply_yn" id="reply_yn_1" checked value=""> 전체</label>
								<label class="radio-inline"><input type="radio" name="reply_yn" id="reply_yn_3" value="N"> 미답변</label>
                <label class="radio-inline"><input type="radio" name="reply_yn" id="reply_yn_3" value="Y"> 답변완료</label>
              </td>
              <th width="150" style="text-align:center;">카테고리</th>
              <td>
                <label class="radio-inline"><input type="radio" name="qa_type" id="qa_type" checked value=""> 전체</label>
								<label class="radio-inline"><input type="radio" name="qa_type" id="qa_type_0" value="0"> 불편 신고</label>
                <label class="radio-inline"><input type="radio" name="qa_type" id="qa_type_1" value="1"> 제안 및 건의</label>
                <label class="radio-inline"><input type="radio" name="qa_type" id="qa_type_1" value="2"> 기타</label>
              </td>
            </tr>
    			</tbody>
    		</table>
      </form>

  		<div class="text-center mt20">
  			<a href="javascript:void(0)" class="btn btn-success" onclick="default_list_get(1);">검색</a>
  		</div>

  	</div>
    <!-- search : e -->

  	<div class="table-responsive">
      <div id="list_ajax"></div>
  	</div>
  </div>
  <!-- body : e -->
</div>
<input type="text" name="page_num" id="page_num" value="1" style="display:none">

<script>

  
//엔터키 시 검색
window.addEventListener('keydown', function(event){
  if (window.event.keyCode == 13) {
    // 엔터키가 눌렸을 때 실행할 내용
    default_list_get(1);
  }
})

	$(document).ready(function(){
		setTimeout("default_list_get($('#page_num').val())", 10);
	});

	// qa 리스트 가져오기
  function default_list_get(page_num){

    $('#page_num').val(page_num);

		var form_data = {
			's_date' : $('#s_date').val(),
			'e_date' : $('#e_date').val(),
			'member_id' : $('#member_id').val(),
			'member_nickname' : $('#member_nickname').val(),
			'qa_title' : $('#qa_title').val(),
			'reply_yn' :  $("input[name='reply_yn']:checked").val(),
			'qa_type' :  $("input[name='qa_type']:checked").val(),
			'history_data' : window.history.length,
			'page_num' : page_num
		};

    $.ajax({
      url      : "/<?=mapping('qa')?>/qa_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : form_data,
      success: function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

</script>
