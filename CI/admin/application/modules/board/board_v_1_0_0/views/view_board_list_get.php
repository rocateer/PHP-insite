<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
    <div class="col-lg-6 text-right"><a class="btn btn-success" href="/board_v_1_0_0/board_reg?history_data=<?=$history_data?>">등록</a></div>
  </div>

  <form name="form_default" id="form_default" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th style="">게시판명</th>
          <th width="200">게시판 상태</th>
          <th width="200">익명</th>
          <th width="300">접근 권한</th>
          <th width="200">등록일</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach ($result_list as $row) {
              $work_arr = explode(',',$row->work_arr);
        ?>
          <tr>
            <td><?=$no--?></td>
            <td><div class="list_title_1"><a href="/<?=mapping('board')?>/board_detail?board_idx=<?=$row->board_idx?>&history_data=<?=$history_data?>" ><?=$row->title?></a></div></td>
            <td><?=($row->display_yn =="Y")? "활성화" :"비활성화";?></td>
            <td><?=($row->anony_yn =="Y")? "익명" :"공개";?></td>
            <td>
              <? $x=0;
                if($row->work_arr=='Y'){
                foreach($work_arr as $row2){ 
                  if($x!=0){
                    echo ",";
                  } echo $this->global_function->get_work_type($row2);
              ?>
                <? $x++;}
                }else{?>
                  제한없음
                <?}?>
            </td>
            <td><?=$this->global_function->date_Ymd_dot($row->ins_date);?></td>
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
