<!-- container-fluid : s -->
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="page-header">
    <h1>프로그램 상세</h1>
  </div>

  <!-- body : s -->
  <div class="bg_wh mt20">
    <div class="table-responsive">
      <section>
        <form name="form_default" id="form_default" method="post">
          <table class="table table-bordered td_left">
            <colgroup>
              <col style="width:15%">
              <col style="width:35%">
              <col style="width:15%">
              <col style="width:35%">
            </colgroup>
            <tbody>
              <tr>
                <th><span class="text-danger">* </span>배너 명</th>
                <td colspan="3">
                  <input type="text" name="title" id="title" value="<?=$result->title?>" class="form-control">
                </td>
              </tr>
              <tr>
                <th> <span class="text-danger">* </span>공지사항</th>
                <td  colspan="3">
                <select name="notice_idx" id="notice_idx" class="form-control">
                    <option value="">선택</option>
                    <?foreach($notice_list as $row){?>
                      <option value="<?=$row->notice_idx?>"  <?=($result->notice_idx==$row->notice_idx)?'selected':''?> ><?=$row->title?></option>
                    <?}?>
                  </select>
                </td>
              </tr>
              <tr>
                <th>노출 여부</th>
                <td colspan="3">
                    <label class="switch">
                      <input type="checkbox"  name="display_yn" id="display_yn" value="Y" <?=($result->display_yn=='Y')?'checked':''?> >
                      <span class="check_slider"></span>
                    </label>
                </td>
              </tr>
              <tr>
                  <th style="height:200px;">
                    <span class="text-danger">* </span>
                    모바일 이미지<br />(000x000)<br />
                    <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img0','image','1','150');" style="margin-bottom:10px"></p>
                  </th>
                  <td colspan="3">
                    <div class="view_img mg_btm_20">
                      <ul class="img_hz" id="img0">
                        <?php if($result->mobile_img != ""){ ?>
                          <li id="id_file_img0_0" style="display:inline-block;">
                            <img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img0_0')"/><br>
                            <img src="<?=$result->mobile_img?>" style="width:150px">
                            <input type="hidden" name="img0_path[]" id="img0_path[]" value="<?=$result->mobile_img?>"/>
                            <input type="checkbox" name="img" value="<?=$result->mobile_img?>" checked style="display:none">
                          </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th style="height:200px;">
                    <span class="text-danger">* </span>
                    PC web 이미지<br />(000x000)<br />
                    <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img1','image','1','150');" style="margin-bottom:10px"></p>
                  </th>
                  <td colspan="3">
                    <div class="view_img mg_btm_20">
                      <ul class="img_hz" id="img1">
                      <?php if($result->pc_img != ""){ ?>
                          <li id="id_file_img1_0" style="display:inline-block;">
                            <img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img1_0')"/><br>
                            <img src="<?=$result->pc_img?>" style="width:150px">
                            <input type="hidden" name="img1_path[]" id="img1_path[]" value="<?=$result->pc_img?>"/>
                            <input type="checkbox" name="img" value="<?=$result->pc_img?>" checked style="display:none">
                          </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th style="height:200px;">
                    <span class="text-danger">* </span>
                    인기 게시판 <br> PC web 이미지<br />(000x000)<br />
                    <p><input type="button" class="btn btn-xs btn-default" value="등록" onclick="file_upload_click('img','image','1','150');" style="margin-bottom:10px"></p>
                  </th>
                  <td colspan="3">
                    <div class="view_img mg_btm_20">
                      <ul class="img_hz" id="img">
                      <?php if($result->best_img != ""){ ?>
                          <li id="id_file_img_0" style="display:inline-block;">
                            <img src="/images/btn_del.gif" style="width:15px "onclick="file_upload_remove('img_0')"/><br>
                            <img src="<?=$result->best_img?>" style="width:150px">
                            <input type="hidden" name="img_path[]" id="img_path[]" value="<?=$result->best_img?>"/>
                            <input type="checkbox" name="img" value="<?=$result->best_img?>" checked style="display:none">
                          </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <input type="text" name="banner_idx" id="banner_idx" value="<?=$result->banner_idx?>" style="display: none;">
        </form>
      </section>

      <div class="row">
        <div class="col-lg-12 text-right">
          <a href="javascript:void(0)"  onClick="default_list()" class="btn btn-gray">목록</a>
          <a href="javascript:void(0)" onClick="default_del('<?=$result->banner_idx?>')" class="btn btn-danger">삭제</a>
          <a href="javascript:void(0)"  onClick="default_mod()" class="btn btn-info">수정</a>
        </div>
      </div>
    </div>
  </div>
  <!-- body : e -->
</div>
<!-- container-fluid : e -->

<input type="text" name="page_num" id="page_num" value="1" style="display: none;">

<script>
  
  // 배너관리 목록
  function default_list(){
    history.back(<?=$history_data?>);
  }

  // 배너관리 수정
  function default_mod(){

    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : $("#form_default").serialize(),
      success: function(result){
        if(result.code == "-1"){
          alert(result.code_msg);
        }
        if(result.code == "1"){
          alert(result.code_msg);
          history.back(-1);
        }
      }
    });
  }
  
  // 배너관리 삭제
  function default_del(banner_idx){

    if(!confirm("삭제하시겠습니까?")){
      return;
    }

    $.ajax({
      url      : "/<?=mapping('banner')?>/banner_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        "banner_idx" : banner_idx
      },
      success: function(result) {
        if(result.code == '-1') {
          alert(result.code_msg);
        }else{
          alert(result.code_msg);
          history.back(-1);
        }
      }
    });
  }


</script>
