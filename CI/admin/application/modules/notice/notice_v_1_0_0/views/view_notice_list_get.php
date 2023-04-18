<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
    <div class="col-lg-6 text-right"><a class="btn btn-success" href="/<?=mapping('notice')?>/notice_reg">등록</a></div>
  </div>

  <form name="form_default" id="form_default" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="*">제목</th>
          <th width="200">노출 여부</th>
          <th width="150">등록일</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
        ?>
          <tr>
            <td>
              <?=$no--?>
            </td>
            <td class="td_left">
              <a href="/<?=mapping('notice')?>/notice_detail?notice_idx=<?=$row->notice_idx?>&history_data=<?=$history_data?>"><?=$row->title?></a>
            </td>
            <td>
              <?php if($row->notice_state == "N"){ ?>
                노출 안함 <label class="switch">
                  <input type="checkbox" onchange="notice_state_mod_up(<?=$row->notice_idx?>, 'Y');">
                  <span class="check_slider"></span>
                </label> 노출
              <?php }else if($row->notice_state == "Y"){ ?>
                노출 안함 <label class="switch">
                  <input type="checkbox" onchange="notice_state_mod_up(<?=$row->notice_idx?>, 'N');" checked>
                  <span class="check_slider"></span>
                </label> 노출
              <?php } ?>
            </td>
            <td>
              <?= $this->global_function->date_Ymd_hyphen($row->ins_date) ?>
            </td>
          </tr>
        <?php
            }
          }else{
        ?>
        <tr>
          <td colspan="15">
            <?=no_contents('0')?>
          </td>
        </tr>
        <?php } ?>

      </tbody>
    </table>
  </form>
  

	<?=$paging?>


</div>
