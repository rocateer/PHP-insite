<div class="body">
  <div class="notice_title"><?=$result->title?></div>
  <div class="notice_date"><?=$this->global_function->date_YmdHi_Hyphen($result->ins_date)?></div>

  <img src="<?=$result->img_path?>" class="img_block">

  <p class="notice_content">
    <?=nl2br($result->contents)?>
  </p>
</div>
