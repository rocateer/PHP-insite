
<?php
$display =($result_list_count<1)? "block":"none";

if(!empty($result_list)){
	foreach($result_list as $row){
    if($board_type=='0'){?>

        <li>
        <a href="javascript:void(0)" onclick="detail_url('/<?= mapping('community') ?>/community_detail?board_idx=<?=$row->board_idx?>')">
            <div class="title"><span><?=$row->category_name?> </span><?=$row->title?></div>
            <ul class="info_ul4">
              <li>
              <?=$row->view_cnt?>
              </li>
              <li>
              <?=$row->like_cnt?>
              </li>
              <li>
              <?=$row->reply_cnt?>
              </li>
            </ul>
          </a>
        </li>
    <?}else if($board_type=='1'){?>
          <li>
            <div class="board_shadow_box">
              <div class="p16">
                <table class="tbl_fix tbl_3">
                  <colgroup>
                  <col width='44px'>
                  <col width='*'>
                  <col width='20px'>
                </colgroup>
                  <tr>
                  <a href="javascript:void(0)" onclick="detail_url('/<?= mapping('community') ?>/community_detail?board_idx=<?=$row->board_idx?>')">
                      <th>
                        <div class="img_box">
                          <img src="<?=($row->member_img=='')?'/p_images/s1.png':$row->member_img?>" alt="">
                        </div>
                      </th>
                      <td>
                        <div class="name"><?=$row->member_name?></div>
                        <div class="date"><?=$row->ins_date?></div>
                      </td>
                    </a>
                      <td>
                        <img src="/images/i_dot_2.png" alt="..." class="btn_more" onclick="set_board_idx('<?=$row->board_idx?>');">
                      </td>
                    </tr>
                  </table>
                </div>
                <?if(!empty($row->board_img)){
                  $img_arr = explode(',',$row->board_img); ?>
                  <a href="javascript:void(0)" onclick="detail_url('/<?= mapping('community') ?>/community_detail?board_idx=<?=$row->board_idx?>')">
                    <div class="swiper community_swiper">
                      <div class="swiper-wrapper">
                      <?foreach($img_arr as $img){?>
                        <div class="swiper-slide">
                          <div class="img_box">
                            <img src="<?=$img?>" alt="">
                          </div>
                        </div>
                        <?}?>
                      </div>
                      <div class="swiper-pagination"></div>
                    </div>
                  <?}?>
                    <div class="p16">
                      <div class="contents_txt">
                        <p id="today_contents_txt">
                          <?=$row->contents?>
                        </p>
                      </a>
                      <button onclick="text_all_view(this)" id="button_today">전체보기</button>
                    </div>
                <?if(!empty($row->program_record)){?>
                  <a href="javascript:void(0)" onclick="detail_url('/<?= mapping('community') ?>/community_detail?board_idx=<?=$row->board_idx?>')">
                  <ul class="my_schedule_ul">
                    <?foreach($row->program_record as $row1){
                      $min=(int)substr( $row1->record_time, 3,2 ); 
                      $sec=(int)substr( $row1->record_time, -2 );
                      $yoil_arr = explode(',',$row1->yoil);

                        $select_yoil = '';

                        foreach($yoil_arr as $row2){

                          $str='';

                          switch($row2) {
                            case '1': $str = " 월 /"; break;
                            case '2': $str = " 화 /"; break;
                            case '3': $str = " 수 /"; break;
                            case '4': $str = " 목 /"; break;
                            case '5': $str = " 금 /"; break;
                            case '6': $str = " 토 /"; break;
                            case '0': $str = " 일 /"; break;
                            default: $str = ""; break;
                          }
                          $select_yoil=$select_yoil.$str;
                      }
                      
                      ?>
                      <li>
                        <table class="tbl_fix tbl_2">
                          <colgroup>
                            <col width='58px'>
                            <col width='*'>
                          </colgroup>
                          <tr>
                            <th>
                              <div class="img_box">
                                <img src="<?=$row1->img_path?>" alt="">
                              </div>
                            </th>
                            <td>
                              <div class="title"><?=$row1->title?><span class="f_right"><?=($min=='00')?'':$min.'분'?> <?=$sec?>초</span></div>
                              <p><?=substr($select_yoil,0,-1)?> <span><?=$row1->s_date?> ~ <?=$row1->e_date?></span></p>
                            </td>
                          </tr>
                        </table>
                      </li>
                    <?}?>
                  </ul>
                  </a>
                <?}?>
                <ul class="info_ul2">
                  <li  onclick="like_reg_in('<?=$row->board_idx?>');">
                    <span class="wish_btn">
                      <a class="<?=($row->like_yn=='Y')?'on':''?>" href="javascript:void(0)"  onclick="wish_btn(this)"></a>
                    </span>
                    <b  id="like_cnt_<?=$row->board_idx?>"><?=$row->like_cnt?></b>
                  </li>
                  <li>
                    <img src="/images/i_comment_3.png" alt="">
                    <?=$row->reply_cnt?>
                  </li>
                </ul>
              </div>
            </div>
          </li>
      <?}?>

    <?php
        }
      }
    ?>

<script type="text/javascript">
	$("#no_data_<?=$board_type?>").css("display",'<?=$display?>'); 

    <?
    if(!empty($result_list)){
    ?>
      
      <?if($loading_ok =="Y"){?>
        page_num ++;
        scrollchk = true;
      <?}else{		?>
        scrollchk = false;
      <?}?>
      mutex = false;

      page_save(event);
    <?}?>
</script>

<script>
    var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".swiper-pagination",
      dynamicBullets: true,
    },
  });

  function text_all_view(e) {
    const siblings = e.previousElementSibling;
    e.style.display = 'none';
    siblings.style.display = 'block';
  }

    // 3줄 이하 체크
    let board_cnt = $('.contents_txt').length;
  for (var i = 0; i < board_cnt; i++) {
    let contents_txt = $('.today_board > li').eq(i).find('#today_contents_txt').height();
    if (contents_txt > 90) {} else {
      $('.today_board > li').eq(i).find('#button_today').hide();
    }
  }
</script>




