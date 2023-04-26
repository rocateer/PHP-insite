<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 명</div>
	<div class="col-lg-6 text-right" style="margin-bottom:10px">
		</div>

</div>

<table class="table table-bordered">
	<thead>
    <tr>		
		<th width="50">No</th>
		<th width="80">가입 유형</th>
		<th width="150">아이디(이메일)</th>
		<th width="80">이름</th>
		<th width="120">닉네임</th>
		<th width="100">지역</th>
		<th width="100">상세지역</th>
		<th width="80">직종</th>
		<th width="100">가입일</th>
		<th width="100">탈퇴일</th>
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
						<td><?=$this->global_function->get_join_type($row->member_join_type);?></td>
						<td class="td_left"><a href="/<?=mapping('member')?>/member_detail?member_idx=<?=$row->member_idx?>&history_data=<?=$history_data?>"><?=$row->member_id?></a></td>
						<td><?=$row->member_name?></td>
						<td><?=$row->member_nickname?></td>
						<td><?=$row->city_name?></td>
						<td><?=$row->region_name?></td>
						<td><?=($row->work_name !='')?$row->work_name:'-'?></td>
						<td><?=($row->ins_date !='')?$row->ins_date:'-'?></td>
						<td><?=($row->del_yn =='Y')?$row->member_leave_date:'-'?></td>
						<td>
							<?php if($row->del_yn == 'N'){ echo "이용중"; }
							else if($row->del_yn == 'P'){ echo "이용정지"; }
							else if($row->del_yn == 'Y'){echo "탈퇴";} 
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

