<table class="board_table mt30">
  <thead>
    <tr>
      <th class="text_center">제목</th>
      <th class="text_center" width="120">일자</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(!empty($result_list)){
    foreach($result_list as $row){
    ?>
    <tr>
      <td><a href="/notice/notice_detail?notice_idx=<?=$row->notice_idx?>"><?=$row->title?></a></td>
      <td class="text_center"><?=$row->ins_date?></td>
    </tr>
    <?php
         }
       }else{
     ?>
      <tr>
       <td colspan=11> 검색된 데이타가 없습니다.</td></tr>
     <?php
       }
     ?>
    <!-- <tr>
      <td><a href="/notice/notice_detail">로캣티어 오프라인 매장에 대해 궁금해요.!</a></td>
      <td class="text_center">2018.10.23</td>
    </tr>
    <tr>
      <td><a href="/notice/notice_detail">로캣티어 오프라인 매장에 대해 궁금해요.!</a></td>
      <td class="text_center">2018.10.23</td>
    </tr> -->
  </tbody>
</table>

<!-- paging : s -->
<div class="paging">
<?=$paging?>
</div>
<!-- paging : e -->
