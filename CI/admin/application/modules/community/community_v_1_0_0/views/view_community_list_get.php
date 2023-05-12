<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
	<div class="col-lg-6 text-right"><a class="btn btn-success" href="/community_v_1_0_0/community_reg?history_data=<?=$history_data?>">등록</a></div>
</div>

<table class="table table-bordered">
	<thead>
    <tr>
			<th width="50">No</th>
      <th width="*">제목</th>
			<th width="200">상태</th>
			<th width="200">등록일</th>
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
							<a href="/<?=mapping('community')?>/community_detail?community_idx=<?=$row->community_idx?>&history_data=<?=$history_data?>"><?=$row->title?></a>
						</td>
						<td>
							<?php if($row->display_yn=='Y'){
								echo '게시중';
							}elseif($row->display_yn=='N'){
								echo '노출 안함';
							}?>
						</td>
						<td>
						<?=$this->global_function->dateYmdHiHyphen($row->ins_date)?>
						</td>
					</tr>
		<?php
		    }
			}else{
		?>
		<tr>
      <td colspan="3">
        <?=no_contents('0')?>
      </td>
    </tr>
		<?php
			}
	  ?>
	</tbody>
</table>

<?=$paging?>













