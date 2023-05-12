<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>게시글 관리</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <!-- search : s -->
    <div class="table-responsive">
      <form name="form_default" id="form_default">
        <table class="search_table">
          <colgroup>
            <col style="width:15%">
            <col style="width:35%">
            <col style="width:15%">
            <col style="width:35%">
          </colgroup>
          <tbody>
            <tr>
              <th style="text-align:center;">닉네임</th>
              <td>
                <input class="form-control" name="member_nickname" id="member_nickname">
              </td>
              <th style="text-align:center;">직종</th>
              <td>
                <select name="work_idx" id="work_idx" class="form-control ">
                   <option value="">선택</option>
                  <?foreach($work_list as $row1){?>
                    <option value="<?=$row1->work_name?>"><?=$row1->work_name?></option>
                  <?}?>
                </select>
              </td>
            </tr>
            <tr>
              <th style="text-align:center">지역</th>
              <td>
                <select name="city_name" id="city_name" class="form-control" style="width:40%;" onchange="region_list(this.value)">
                  <option value="">선택</option>
                  <?foreach($result_list as $row){?>
                    <option value="<?=$row->city_name?>"><?=$row->city_name?></option>
                  <?}?>
                </select> >
                <select name="region_code" id="region_code" class="form-control" style="width:40%;">
                </select>
              </td>
              <th style="text-align:center;">게시판</th>
              <td>
                <select name="work_idx" id="work_idx" class="form-control ">
                  <option value="">선택</option>
                  <?foreach($board_list as $row2){?>
                      <option value="<?=$row2->board_idx?>"><?=$row2->title?></option>
                    <?}?>
                </select>
              </td>
            </tr>
            <tr>
              <th style="text-align:center;">정렬</th>
              <td>
                <select name="work_idx" id="work_idx" class="form-control ">
                  <option value="">최신등록순</option>
                  <option value="">신고수 많은 순</option>
                  <option value="">댓글&대댓글 많은 순</option>
                </select>
              </td>
              <th style="text-align:center;">제목</th>
              <td>
                <input class="form-control" name="title" id="title">
              </td>
            </tr>
            <tr>
              <th style="text-align:center;">내용</th>
              <td>
                <input class="form-control" name="title" id="title">
              </td>
              <th></th>
              <td></td>
            </tr>
            <tr>
              <th style="text-align:center;">상태</th>
              <td>
                <label class="radio-inline"><input type="radio" name="display_yn" value="" checked> 전체</label>
                <label class="radio-inline"><input type="radio" name="display_yn" value="Y"> 게시중</label>
                <label class="radio-inline"><input type="radio" name="display_yn" value="N"> 블라인드</label>
              </td>
              <th style="text-align:center;">등록일</th>
              <td>
              <input name="s_date" id="s_date" class="form-control datepicker" style="width:130px"  placeholder="" autocomplete="off" readonly>&nbsp;<span class="material-icons">calendar_month</span>&nbsp;~&nbsp;
              <input name="e_date" id="e_date" class="form-control datepicker" style="width:130px"  placeholder="" autocomplete="off" readonly>&nbsp;<span class="material-icons">calendar_month</span>
              </td>
            </tr>
          </tbody>
        </table>
      </form>

      <div class="text-center mt20">
        <a href="javascript:void(0)" class="btn btn-success" onclick="default_list_get('1');">검색</a>
      </div>

    </div>
    <!-- search : e -->

    <div class="table-responsive">
      <!-- list_get : s -->
      <div id="list_ajax">
        <!--리스트-->
      </div>
      <!-- list_get : e -->
    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->
<input type="text" name="page_num" id="page_num" value="1" style="display:none">

<script language="javascript">

  $(document).ready(function(){
     setTimeout("default_list_get($('#page_num').val())", 10);
  })

  // 동행 관리 리스트 불러오기
  var default_list_get = function(page_num) {
    $('#page_num').val(page_num);

    var form_data = {
      'title' : $('#title').val(),
      'display_yn' : $('input[name="display_yn"]:checked').val(),
      's_date' : $('#s_date').val(),
      'e_date' : $('#e_date').val(),
      'history_data' : window.history.length,
      'page_num' : page_num
    };

    $.ajax({
      url: "/<?=mapping('community')?>/community_list_get",
      type: 'POST',
      dataType : 'html',
      async: true,
      data: form_data,
      success: function(result) {
        $('#list_ajax').html(result);
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

    $('#region_code').html("<option value=''>선택</option>");
    if(dom.length != 0) {
      for(var i = 0; i < dom.length; i ++) {
        selectStr += "<option value='"+ dom[i].region_code  + "'>" + dom[i].region_name + "</option>";
      }
      $('#region_code').append(selectStr);
    }
  }
});
}


</script>
