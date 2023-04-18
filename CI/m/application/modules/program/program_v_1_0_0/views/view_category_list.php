<header>
  <div class="btn_back" onclick="javascript:history.go(-1)">
    <img src="/images/head_btn_back.png" alt="">
  </div>
  <h1>
  스케쥴 추가
  </h1>
</header>
<div class="body relative inner_wrap">
  <img src="/images/step_1.png" alt="" class="step">
  <h4 class="mb20 mt50 txt_center">카테고리를 선택하세요.</h4>
  <ul class="category_ul">
    <?foreach($result_list as $row){?>
    <li>
      <a href="/<?=mapping('program')?>/program_list?category_idx=<?=$row->category_management_idx?>&category_name=<?=$row->category_name?>">
      <div class="img_dim"></div>
        <div class="img_box">
          <img src="<?=$row->img_path?>" alt="">
        </div>
        <h3><?=$row->category_name?></h3>
      </a>
    </li>
    <?}?>
  </ul>
</div>