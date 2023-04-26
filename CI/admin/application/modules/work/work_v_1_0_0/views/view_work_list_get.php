<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 명</div>
	<div class="col-lg-6 text-right" style="margin-bottom:10px">
		</div>

</div>

<table class="table table-bordered">
	<thead>
    <tr>		
		<th width="50">No</th>
		<th width="*">아이디(이메일)</th>
		<th width="120">이름</th>
		<th width="150">닉네임</th>
		<th width="150">전화번호</th>
		<th width="100">직종</th>
		<th width="150">요청일</th>
		<th width="120">회원상태</th>
		</tr>
	</thead>
	<tbody>
    <?php
			if(!empty($result_list)){
    		foreach ($result_list as $row){
    ?>
					<tr>
						<td><?=$no--?></td>
						<td class="td_left"><a href="/<?=mapping('work')?>/work_detail?work_confirm_idx=<?=$row->work_confirm_idx?>&history_data=<?=$history_data?>"><?=$row->member_id?></a></td>
						<td><?=$row->member_name?></td>
						<td><?=$row->member_nickname?></td>
						<td><?=$this->global_function->set_phone_number($row->member_phone);?></td>
						<td><?=($row->work_name !='')?$row->work_name:'-'?></td>
						<td><?=($row->ins_date !='')?$row->ins_date:'-'?></td>
						<td>
							<?php if($row->state == '0'){ echo "승인요청"; }
							else if($row->state == '1'){ echo "승인"; }
							else if($row->state == '2'){echo "거절";} 
							?>
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
		<?php
			}
	  ?>
	</tbody>
</table>

<?=$paging?>

