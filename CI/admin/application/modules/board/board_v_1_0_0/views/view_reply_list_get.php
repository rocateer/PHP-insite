
    <table class="table table-bordered">
      <thead>
        <tr>
          <th width="50">No</th>
          <th width="100">작성자 닉네임</th>
          <th width="*">내용</th>
          <th width="50">종류</th>
          <th width="100">답글작성</th>
          <th width="100">원 댓글 작성자</th>
          <th width="80">신고수</th>
          <th width="150">등록일시</th>
          <th width="120">상태</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if(!empty($result_list)){
            foreach($result_list as $row){
              $reply_idx = 0;
              if($row->depth == 0){
                $reply_idx=$row->board_reply_idx;
              }else if($row->depth == 1){
                $reply_idx=$row->parent_board_reply_idx;
              }
        ?>
          <tr>
            <td style="text-align:center;"><?=$no--?></td>
            <td style="text-align:center;">
              <?=($row->admin_idx > 0)?'관리자':$row->member_nickname?>
            </td>
            <td class="td_left"><?=$row->reply_comment?></td>
            <td style="text-align:center;"><?php echo $row->depth == 0? "댓글":"답글"; ?></td>
            <td style="text-align:center;"><a class="btn-sm btn-info" data-target="#layerpop3" data-toggle="modal"  onclick="set_board_reply_idx('<?=$reply_idx?>','<?=$row->member_nickname?>');">답글작성</a></td>
            <td style="text-align:center;"><?=$row->parent_member_nickname?></td>
            <td style="text-align:center;"><?=$row->report_cnt?></td>
            <td style="text-align:center;"><?=$this->global_function->date_YmdHi_hyphen($row->ins_date)?></td>
            <td style="text-align:center;">
              <a class="btn-sm btn-success" href="javascript:void(0)" onclick="display_yn_mod_up('<?=$row->board_reply_idx?>', '<?=($row->display_yn == 'Y')? 'N':'Y'; ?>');"><?php echo $row->display_yn == "Y"? "블라인드":"블라인드 해제"; ?></a>
            </td>
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

	<?=$paging?>
