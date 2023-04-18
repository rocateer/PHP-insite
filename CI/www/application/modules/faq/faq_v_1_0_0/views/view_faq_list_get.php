
<?php
    if(!empty($result_list)){
      foreach($result_list as $row){
  ?>
  <li class="accordion">
    <p class="trigger"><?=$row->title_0?></p>
    <div class="answer_wrap panel" style="display: none;">
      <p><?=$row->contents_0?></p>
    </div>
  </li>

<?php
      }
    }else{
  ?>
  <tr>
    <td colspan=11> 검색된 데이타가 없습니다.</td></tr>
  <?php
    }
  ?>


<?=$paging?>
