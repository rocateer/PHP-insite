<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
  </div>

  <form name="form_default" id="form_default" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="40">No</th>
          <th width="120">분류</th>
          <th width="100">신고 한 회원 닉네임<br />신고 한 회원 아이디</th>
          <th width="100">신고 받은 회원 닉네임<br />신고 받은 회원 아이디</th>
          <th width="150">신고 유형</th>
          <th width="100">신고 대상 게시글</th>
          <th width="*">신고 사유</th>
          <th width="100">신고일</th>
          <th width="80">게시 상태</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
        ?>
          <tr>
            <td><?=$no--?></td>
            <td><?=($row->board_type==0)?'이브의 고민':'오늘의 운동 완료'?></td>
            <td class="td_left">
              <?=$row->member_nickname?><br>
              <?=$row->member_id?>
            </td>
            <td class="td_left">
              <?=$row->reported_member_nickname?><br>
              <a href="/<?=mapping('member')?>/member_detail?member_idx=<?=$row->reported_member_idx?>"><?=$row->reported_member_id?></a>
            </td>
            <td><?=$this->global_function->get_report_type($row->report_type)?></td>
            <td>
              <!-- <a href="#">원글 보기</a> -->
              <button type="button" class="btn-sm btn-primary" onclick="page_detail('<?=$row->board_idx?>','<?=$row->board_type?>','<?=$row->board_del_yn?>');">원글 보기</button>
            </td>
            <td><?=$row->report_contents?></td>
            <td><?=$this->global_function->date_Ymd_hyphen($row->ins_date)?></td>
            <td><?=($row->display_yn=='Y')?'게시중':'블라인드'?></td>
          </tr>

        <?php
            }
          }else{
        ?>
        <tr>
          <td colspan="9">
            <?=no_contents('0')?>
          </td>
        </tr>
        <?php } ?>

      </tbody>
    </table>
  </form>
	<?=$paging?>
</div>
