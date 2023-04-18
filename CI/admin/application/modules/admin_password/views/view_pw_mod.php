
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="page-header">
			<h1>비밀번호 설정</h1>
		</div>

    <!-- body : s -->
    <div class="bg_wh mt20">
      <div class="table-responsive">
        <form name="form_default" id="form_default" method="post">
          <section>
            <!-- top -->
            <div class="row table_title">
              <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;비밀번호 수정</div>
            </div>
            <!-- top  -->
            <table class="table table-bordered td_left">
  						<tbody>
  							<tr>
  								<th width="150">현재 비밀번호</th>
  								<td colspan="3"><div class="form-group"><input class="form-control" type="password" name="admin_pw" id="admin_pw"></div></td>
  							</tr>
                <tr>
  								<th width="150">새 비밀번호</th>
  								<td colspan="3"><div class="form-group"><input class="form-control" type="password" name="admin_new_pw" id="admin_new_pw"></div></td>
  							</tr>
                <tr>
  								<th width="150">새 비밀번호 확인</th>
  								<td colspan="3"><div class="form-group"><input class="form-control" type="password" name="admin_re_pw" id="admin_re_pw"></div></td>
  							</tr>
  						</tbody>
  					</table>
          </section>
        </form>

        <div class="row">
          <div class="col-lg-12 text-right">
            <a onclick="COM_history_back_fn()" class="btn btn-gray">취소</a>
            <a href="javascript:void(1)" class="btn btn-success" onclick="default_mod()">수정</a>
          </div>
        </div>
      </div>
    </div>
    <!-- body : e -->
  </div>
  <!-- container-fluid : e -->
<script>

function default_mod() {
  $.ajax({
    url: "/admin_password/pw_mod_up",
    type: 'POST',
    dataType: 'json',
    async: true,
    data: $("#form_default").serialize(),
    beforeSend:default_validate,
    success: function(result) {
      if(result==0){
        alert('비밀번호 변경되지않었습니다.');
      }else if(result==2){
        alert('비밀번호를 입력해주세요.');
      }else if(result==3){
        alert('비밀번호가 다릅니다. 다시입력해주세요');
      }else if(result==4){
        alert('현재 비밀번호가 다릅니다. 다시입력해주세요');
      }else{
        alert('비밀번호가 변경되었습니다.');
        location.href ='/main';
      }
    }
  });
}
//유효성 체크
var default_validate = function() {

}

</script>
