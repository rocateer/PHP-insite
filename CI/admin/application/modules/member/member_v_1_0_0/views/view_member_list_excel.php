<?php
  $filename="회원정보_".date('Ymd');
	header( "Content-type: application/vnd.ms-excel; charset=utf-8" );
	header( "Expires: 0" );
	header( "Cache-Control: must-revalidate, post-check=0,pre-check=0" );
	header( "Pragma: public" );
	header( "Content-Disposition: attachment; filename=$filename.xls" );
?>

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<table class="table table-bordered" border="1">
<thead>
    <tr>		
		<th width="50">No</th>
		<th width="100">개인/업체</th>
		<th width="100">아이디(이메일)</th>
		<th width="110">이름</th>
		<th width="80">닉네임</th>
		<th width="150">전화번호</th>
		<th width="90">신고받은 횟수</th>
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
						<td><?=($row->member_type=="0")?"개인":"업체"?></td>
						<td><?=$row->member_id?></a></td>
						<td><?=$row->member_name?></td>
						<td><?=$row->member_nickname?></td>
						<td><?=$this->global_function->format_phone($row->member_phone);?></td>
						<td><?=$row->member_reported_cnt?></td>
						<td><?=$this->global_function->date_Ymd_hyphen($row->ins_date);?></td>
						<td><?if($row->member_state ==3){?>
							<?=$this->global_function->date_Ymd_hyphen($row->member_leave_date);
							}?>
						
               
						<td>
							<?php if($row->member_state == '0'){ echo "이용중"; }
							else if($row->member_state == '1'){ echo "이용정지"; }
							else if($row->member_state == '2'){echo "가입대기";} 
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

