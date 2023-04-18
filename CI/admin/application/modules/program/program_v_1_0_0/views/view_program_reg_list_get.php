
 <div style="max-height:200px;width:550px" class="overscroll_wrap">
	<table class="table table-bordered  overscroll td_center">
		<thead>
			<tr>
				<th width="50">No</th>
				<th width="*">운동 명</th>
				<th width="100">운동 시간</th>
				<th width="80"></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no=1;
			$exercise_time='';
				if(!empty($result_list)){
					foreach ($result_list as $row){
						$min=(int)$row->exercise_min;
						$sec=(int)$row->exercise_sec;
						if($no==1){
							$exercise_time=$row->exercise_time;
						}else{
							$exercise_time = date("H:i:s", (strtotime($exercise_time) + $sec + (60*$min)));
						}
			?>
				<tr>
					<td>
						<?=$no++;?>
					</td>
					<td>
						<?=$row->title?>
					</td>
					<td>
						<?=($min=='0')?'':$min.'분'?>
						<?=($sec=='00')?'':$sec.'초'?>
					</td>
					<td>
					<a href="javascript:void(0)"  onClick="exercise_del('<?=$row->program_exercise_idx?>')" class="btn btn-danger">삭제</a>
					</td>
					</tr>
			<?php
					}
				}else{
			?>
			<tr>
				<td colspan="4">
					<?=no_contents('0')?>
				</td>
			</tr>
			<?php
				}
			?>
			<input type="text" id="exercise_time" name="exercise_time" value="<?=$exercise_time?>" style="display:none;">
		</tbody>
	</table>
</div>













