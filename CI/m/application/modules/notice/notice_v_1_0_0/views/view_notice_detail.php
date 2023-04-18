<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1 class="head_title">공지사항</h1>
</header>
<!-- header : e -->
<div class="body">
  <div class="notice_title"><?=$result->title?>
    <div class="date"><?=$this->global_function->date_YmdHi_dot($result->ins_date)?></div>
  </div>

  <img src="<?=$result->img?>" class="img_block">

  <p class="notice_content">
    <?=nl2br($result->contents)?>
  </p>
</div>
