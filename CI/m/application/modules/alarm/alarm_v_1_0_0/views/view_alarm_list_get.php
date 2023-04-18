<?php
$display =($alarm_list_count<1)? "block":"none";

if(!empty($alarm_list)){
	foreach($alarm_list as $row){

?>

		<li id="alarm_idx_<?=$row->alarm_idx?>" class="alarm_li">
			<a href="javascript:void(0)"  onClick="alarm_read_mod_up('<?=$row->alarm_idx?>'); go_url(<?=str_replace("\"","'", $row->data)?>);">
				<p class="msg"><?=$row->msg?></p>
				<span class="date"><?= $row->ins_date?> <?= $row->ins_date_hm?></span>
			</a>
			<i><a href="javascript:void(0)" onClick="alarm_del('<?=$row->alarm_idx?>')"><img src="/images/btn_delete_2.png" class="btn_del"></a></i>
		</li>
<?php
		}
	}
?>

<script type="text/javascript">

	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data").css("display","<?=$display?>");

</script>
