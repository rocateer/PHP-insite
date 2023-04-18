
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
	<li>
		<p class="title">
			<a href="/<?=mapping('notice')?>/notice_detail?notice_idx=<?=$row->notice_idx?>">
				<?=$row->title?>
			</a>
			<br>
			<span class="date"><?=$this->global_function->date_Ymd_dot($row->ins_date)?></span>
		</p>
	</li>
<?php
		}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$(".no_data").css("display","<?=$display?>");

</script>
