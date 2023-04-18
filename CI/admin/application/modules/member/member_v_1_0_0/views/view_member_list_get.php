<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 명</div>
	<div class="col-lg-6 text-right" style="margin-bottom:10px">
		</div>

</div>

<table class="table table-bordered">
	<thead>
    <tr>		
		<th width="50">No</th>
		<th width="100">아이디(이메일)</th>
		<th width="110">닉네임</th>
		<th width="80">성별</th>
		<th width="100">가입일</th>
		<th width="100">탈퇴일</th>
		<th width="90">신고받은 횟수</th>
		<th width="80">회원상태</th>
		</tr>
	</thead>
	<tbody>
    <?php
			if(!empty($result_list)){
    		foreach ($result_list as $row){
    ?>
					<tr>
						<td><?=$no--?></td>
						<td class="td_left"><a href="/<?=mapping('member')?>/member_detail?member_idx=<?=$row->member_idx?>&history_data=<?=$history_data?>"><?=$this->global_function->get_join_type($row->member_join_type);?> <?=$row->member_id?></a></td>
						<td><?=$row->member_nickname?></td>
						<td><?=($row->member_gender=="0")?"남":"여"?></td>
						<td><?=$row->ins_date?></td>
						<td>
							<?=($row->member_state ==3)?$row->member_leave_date:'-'?>
						</td>
						<td>
						<?($row->member_reported_cnt=='')?'-':$row->member_reported_cnt?>
						</td>
						<td>
							<?php if($row->member_state == '0'){ echo "이용중"; }
							else if($row->member_state == '1'){ echo "이용정지"; }
							else if($row->member_state == '3'){echo "탈퇴";} 
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

