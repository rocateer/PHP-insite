
<?php
$display =(count($result_list)<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
?>
	<? if($row->reply_yn == 'Y'){ ?>
		<li>
			<img src="/images/i_question.png" alt="" class="question">
			<span class="category">
				<?if($row->qa_type == 0){?>
					불편 신고
				<?}else if($row->qa_type == 1){?>
					제안 및 건의
					<?}else if($row->qa_type == 2){?>
						기타
						<?}?>
			</span>
			<a href="/<?=mapping('qa')?>/qa_detail?qa_idx=<?=$row->qa_idx?>" class="block">
				<div class="f_left">
					<div class="title"><?=$row->qa_title?></div>
					<span  class="qa_date"><?=$this->global_function->date_Ymd_dot($row->ins_date)?></span>
				</div>
				<img src="/images/btn_answer.png" alt="답변" class="i_answer">
      </a>
			
		</li>
	<? } else {?>
		<li>
		<img src="/images/i_question.png" alt="" class="question">
			<span class="category">
			<?if($row->qa_type == 0){?>
					불편 신고
				<?}else if($row->qa_type == 1){?>
					제안 및 건의
					<?}else if($row->qa_type == 2){?>
						기타
						<?}?>
			</span>
      <a href="/<?=mapping('qa')?>/qa_detail?qa_idx=<?=$row->qa_idx?>" class="block">
				<div class="f_left">
					<div class="title"><?=$row->qa_title?></div>
					<span class="qa_date"><?=$this->global_function->date_Ymd_dot($row->ins_date)?></span>
				</div>
				<img src="/images/btn_no_answer.png" alt="답변" class="i_answer">
      </a>
		</li>
	<? } ?>


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
