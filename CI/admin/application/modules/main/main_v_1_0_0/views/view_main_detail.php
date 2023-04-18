<div class="container-fluid">
  <section>
    <div class="row mt35">
      <div class="col-md-3">
        <div class="main_box pink text-center" onclick="#">
          <h3>
            <i class="fa fa-user" aria-hidden="true"></i> &nbsp;전체회원 수
          </h3>
          <div>
            <h1><?=number_format($member_total_count)?></h1>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="main_box mint text-center" onclick="#">
          <h3><i class="fa fa-user" aria-hidden="true"></i> &nbsp;금일 가입 회원 수</h3>
          <div>
            <h1><?=number_format($today_member_count)?></h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="table-responsive bg_wh">
    <!-- 신규회원 : s -->
    <section>
      <div class="row table_title">
      	<div class="col-lg-6"> &nbsp;<i class="fa fa-check" aria-hidden="true"></i> &nbsp;신규회원</div>
      	<p class="col-lg-6 text-right">
          <a href="/<?=mapping('member')?>" class="a_link">더보기 <i class="fa fa-angle-right" aria-hidden="true"></i></a>
        </p>
      </div>

      <table class="table table-bordered">
      	<thead>
          <tr>
            <th width="50">No</th>
            <th width="100">이름</th>
            <th width="200">아이디</th>
            <th width="150">닉네임</th>
            <th width="*">주소</th>
            <th width="100">회원구분</th>
      			<th width="100">가입일자</th>
          </tr>
      	</thead>
      	<tbody>

          <?php
            $no = count($member_list_get);
      			if(!empty($member_list_get)){
          		foreach($member_list_get as $row){
          ?>

      			<tr>
      				<td>
      					<?=$no--?>
      				</td>
              <td>
                <?=$row->member_name?>
              </td>
      				<td>
      					<a href="/<?=mapping('member')?>/member_detail?member_idx=<?=$row->member_idx?>"><?=$row->member_id?></a>
      				</td>
      				<td>
      					<?=$row->member_nickname?>
      				</td>
      	      <td>
      					<?=$row->city_name?>
      				</td>
      				<td>
      					<?php
      						switch($row->member_join_type) {
      							case "C":
      								echo "일반";
      								break;
      							default:
      								echo "소셜로그인"; break;
      						}
      					?>
      				</td>
      	      <td>
      					<?=$this->global_function->dateYmdComma($row->ins_date);?>
      				</td>
      			</tr>

      		<?php
      		    }
      			}else{
      		?>

      			<tr>
      				<td colspan="7">
      					등록된 회원이 없습니다.
      				</td>
      			</tr>

      		<?php
      	  	}
      	 	?>

        </tbody>
      </table>
    </section>
    <!-- 신규회원 : e -->
  </div>

</div>
<!-- container-fluid : e -->
