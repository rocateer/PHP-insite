
<?php

if(!empty($result_list)){
	foreach($result_list as $row){
?>
	<li>
		<p class="title">
			<a href="/<?=mapping('notice')?>/notice_detail?notice_idx=<?=$row->notice_idx?>">
				<?=$row->title?>
			</a>
			<span class="date"><?=$this->global_function->dateYmdHyphen($row->ins_date)?></span>
		</p>
	</li>
<?php
		}
	}
?>
