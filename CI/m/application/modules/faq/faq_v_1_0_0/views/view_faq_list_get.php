
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
<li class="accordion">
	<p class="trigger">
		<img src="/images/i_question.png" alt="질문" class="question">
		<?=$row->title?>
	</p>
	<div class="answer_wrap panel">
		<div class="mb10">
			<?=$this->global_function->textEnter($row->contents)?>
		</div>
			<span class="date mt20"><?=$this->global_function->date_Ymd_dot($row->ins_date)?></span>
	</div>
</li>
<?php
		}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

</script>
