<div class="row table_title">
	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;검색결과 : <strong><?=$result_list_count?></strong> 건</div>
  <div  class="col-lg-6 text-right"> &nbsp;<a href="/<?=mapping('faq')?>/faq_reg" class="btn btn-success" >등록</a></div>

</div>

<table class="table table-bordered">
  <thead>
    <tr>
      <th width="50">No</th>
      <th width="*">제목</th>
      <th width="150">등록일</th>
    </tr>
  </thead>
  <tbody>
    <?
      if(!empty($result_list)){
        foreach($result_list as $row){
    ?>
    <tr>
      <td>
        <?=$no--?>
      </td>
      <td class="td_left">
        <a href="/<?=mapping('faq')?>/faq_detail?faq_idx=<?=$row->faq_idx?>&history_data=<?=$history_data?>"><?=$row->title?></a>
      </td>
      <td>
       <?=$row->ins_date?>
      </td>
    </tr>
    <?
        }
      }else{
    ?>
		<tr>
      <td colspan="3">
        <?=no_contents('0')?>
      </td>
    </tr>
    <?
      }
    ?>
  </tbody>
</table>

<?=$paging?>
