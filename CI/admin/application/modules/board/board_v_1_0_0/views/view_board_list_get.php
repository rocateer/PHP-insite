<div class="table-responsive">

  <div class="row table_title">
    <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
    <div class="col-lg-6 text-right"> &nbsp;
      </div>
  </div>

  <form name="form_default" id="form_default" method="post">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="150">작성자 닉네임</th>
          <th style="">내용</th>
          <th width="100">댓글&답글 수</th>
          <th width="100">받은 신고 수</th>
          <th width="80">상태</th>
          <th width="130">등록일</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach ($result_list as $row) {

        ?>
          <tr>
            <td><?=$no--?></td>
            <td><?=($row->member_state==3)?'(탈퇴회원)':''?> <?=$row->member_nickname?></td>
            <td class="td_left"><div class="list_title_1"><a href="/<?=mapping('board')?>/board_detail?board_idx=<?=$row->board_idx?>&history_data=<?=$history_data?>&board_type=<?=$board_type?>" title="<?=$row->contents?>"><?=$row->contents?></a></div></td>
            <td><?=$row->reply_cnt?></td>
            <td><?=$row->report_cnt?></td>
            <td><?=($row->display_yn =="Y")? "게시중" :"블라인드";?></td>
            <td><?=$this->global_function->date_YmdHi_hyphen($row->ins_date)?></td>
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
