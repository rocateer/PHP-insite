<div class="row table_title">
  <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=number_format($result_list_count)?></strong> 건</div>
</div>

<!-- top  -->
<form name="checkedBox" id="checkedBox" method="post">
  <table class="table table-bordered check_wrap">
    <thead>
      <tr>
        <th width="50">No</th>
        <th width="100">카테고리</th>
        <th width="150">아이디</th>
        <th width="150">닉네임</th>
        <th width="*">제목</th>
        <th width="100">답변 상태</th>
        <th width="150">문의일</th>
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
          <td>
            <?=$this->global_function->get_qa_type($row->qa_type)?>
          </td>
          <td>
            <?=$row->member_id?>
          </td>
          <td>
            <?=$row->member_nickname?>
          </td>
          <td class="td_left">
            <a href="/<?=mapping('qa')?>/qa_detail?qa_idx=<?=$row->qa_idx?>&history_data=<?=$history_data?>"><?=$row->qa_title?></a>
          </td>
          <td>
            <?php
              if($row->reply_yn == "Y"){
                echo "<span class='state_03'>답변완료</span>";
              }else{
                echo "<span class='state_02'>미답변</span>";}
            ?>
          </td>
          <td>
            <?=$this->global_function->date_YmdHi_hyphen($row->ins_date)?>
          </td>
        </tr>
      <?php
          }
        }else{
      ?>
      <tr>
        <td colspan="6">
          <?=no_contents('0')?>
        </td>
      </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</form>

<?=$paging?>
