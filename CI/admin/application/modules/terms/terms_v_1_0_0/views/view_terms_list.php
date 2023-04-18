  <!-- container-fluid : s -->
   <div class="container-fluid">
		<!-- Page Heading -->
		<div class="page-header">
			<h1>약관 관리</h1>
		</div>
    <form name="form_default" id="form_default" method="post">
    <!-- body : s -->
    <div class="bg_wh mt20">
    	<div class="table-responsive">
    		<!-- top -->
    		<div class="row table_title">
          <div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;약관 목록</div>
    		</div>
    		<!-- top  -->

        <!-- list_get : s -->
        <div id="list_ajax">
          <table class="table table-bordered check_wrap">
          	<thead>
          		<tr>
                <th width="30">NO</th>
          			<th width="*">약관명</th>
                <th width="120">수정일</th>
          		</tr>
          	</thead>
          	<tbody>
              <?php
                $no = count($result_list);
                foreach ($result_list as $row) {?>
            		<tr>
            			<td><?=$no--?></td>
            			<td>
                    <a href="/<?=mapping('terms')?>/terms_mod?terms_management_idx=<?=$row->terms_management_idx?>"><?=$row->title;?></a>
                  </td>
                  <td><?=$this->global_function->dateYmdComma($row->upd_date)?></td>
            		</tr>
              <?php }?>
          	</tbody>
          </table>
        </div>
        <!-- list_get : e -->

    	</div>
    </div>
    <!-- body : e -->
    </form>
  </div>
  <!-- container-fluid : e -->
