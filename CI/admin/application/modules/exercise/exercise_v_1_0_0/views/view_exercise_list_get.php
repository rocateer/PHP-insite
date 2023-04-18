<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
	<div class="col-lg-6 text-right"><a class="btn btn-success" href="/exercise_v_1_0_0/exercise_reg?history_data=<?=$history_data?>">등록</a></div>
</div>

<table class="table table-bordered">
	<thead>
    <tr>
			<th width="50">No</th>
      <th width="*">운동명</th>
			<th width="100">운동 시간</th>
			<th width="200">프로그램 관리 노출 여부</th>
			<th width="150">등록일</th>
    </tr>
	</thead>
	<tbody>
    <?php
			if(!empty($result_list)){
    		foreach ($result_list as $row){
					$min=(int)$row->exercise_min;
					$sec=$row->exercise_sec;
    ?>
			<tr>
				<td>
					<?=$no--?>
				</td>
				<td>
					<a href="/<?=mapping('exercise')?>/exercise_detail?exercise_idx=<?=$row->exercise_idx?>&history_data=<?=$history_data?>"><?=$row->title?></a>
				</td>
				<td>
					<?=($min=='0')?'':$min.'분'?>
					<?=($sec=='00')?'':$sec.'초'?>
				</td>
				<td>
				<?php if($row->display_yn == "N"){ ?>
						노출 안함 <label class="switch">
							<input type="checkbox" onchange="exercise_state_mod_up(<?=$row->exercise_idx?>, 'Y');">
							<span class="check_slider"></span>
						</label> 노출
					<?php }else if($row->display_yn == "Y"){ ?>
						노출 안함 <label class="switch">
							<input type="checkbox" onchange="exercise_state_mod_up(<?=$row->exercise_idx?>, 'N');" checked>
							<span class="check_slider"></span>
						</label> 노출
					<?php } ?>
				</td>
				<td>
					<?=$row->ins_date?>
				</td>
			</tr>
		<?php
		    }
			}else{
		?>
		<tr>
      <td colspan="5">
        <?=no_contents('0')?>
      </td>
    </tr>
		<?php
			}
	  ?>
	</tbody>
</table>

<?=$paging?>













