<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
	<div class="col-lg-6 text-right"><a class="btn btn-success" href="/program_v_1_0_0/program_reg?history_data=<?=$history_data?>">등록</a></div>
</div>

<table class="table table-bordered">
	<thead>
    <tr>
			<th width="50">No</th>
			<th width="150">프로그램 카테고리</th>
      <th width="*">프로그램 명</th>
			<th width="200">노출 여부</th>
			<th width="150">등록일</th>
    </tr>
	</thead>
	<tbody>
    <?php
			if(!empty($result_list)){
    		foreach ($result_list as $row){
				
    ?>
			<tr>
				<td>
					<?=$no--?>
				</td>
				<td>
				<?=$row->category_name?>
				</td>
				<td>
					<a href="/<?=mapping('program')?>/program_detail?program_idx=<?=$row->program_idx?>&history_data=<?=$history_data?>"><?=$row->title?></a>
				</td>
				<td>
				<?php if($row->display_yn == "N"){ ?>
						노출 안함 <label class="switch">
							<input type="checkbox" onchange="program_state_mod_up(<?=$row->program_idx?>, 'Y');">
							<span class="check_slider"></span>
						</label> 노출
					<?php }else if($row->display_yn == "Y"){ ?>
						노출 안함 <label class="switch">
							<input type="checkbox" onchange="program_state_mod_up(<?=$row->program_idx?>, 'N');" checked>
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













