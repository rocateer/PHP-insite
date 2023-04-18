
<?php
$display =($result_list_count<1)? "block":"none";
$cmt_display =($total_block>1)? "block":"none";

if(!empty($result_list)){
  $j=0;
	foreach($result_list as $row){
   $member_s_img= $this->global_function->get_small_img($row['member_img']);
?>
    <li>  
    <?if($row['del_yn']!='N'){?>
        <div class="cmt_blind">
          삭제된 글입니다.
        </div>
    <?}else{?>
      <?if($row['display_yn']!='Y'){?>
          <div class="cmt_blind">
            관리자에 의해 블라인드 된 글입니다.
          </div>
      <?}else{?>
        <?if($row['report_yn']=='Y'){?>
              <div class="cmt_blind">
                신고한 글입니다.
              </div>
          <?}else{?>
            <?if($row['block_yn']=='Y'){?>
                  <div class="cmt_blind">
                    차단한 댓글 입니다<button class="button" onclick="block_mod('<?=$row['board_reply_idx']?>');">차단해제</button>
                  </div>
              <?}else{?>
                  <table class="tbl_cmt">
                    <tr>
                      <th class="relative">
                        <div class="img_box">
                          <?if($row['admin_idx']>0){?>
                              <img src="/images/admin_profile.png" alt="">
                          <?}else{?>
                              <?if($row['member_idx']==$row['board_member_idx']){?>
                                <img src="/images/i_eve.png" alt="">
                              <?}else{?>
                                <img src="<?=($row['member_img']=='')?'/images/photo_default.png':$member_s_img?>" alt="">
                              <?}?>
                          <?}?>
                        </div>
                        <span class="name">
                          <?if($row['admin_idx']>0){?>
                            <span class="pink">관리자</span>
                          <?}else{?>
                            <?if($row['member_idx']==$row['board_member_idx']){?>
                            <span class="blue"><?=($row['member_state']!=3)?'작성자':'탈퇴한 회원입니다.'?></span>
                            <?}else{ 
                              if($board_type==1){?>
                            <span class=""><?=($row['member_state']!=3)?$row['member_nickname']:'탈퇴한 회원입니다.'?></span>
                            <?}else{?>
                              <span class=""><?=($row['member_state']!=3)?'이브'.$row['member_idx']:'탈퇴한 회원입니다.'?></span>
                              <?}?>
                            <?}?>
                          <?}?>
                        </span>
                        <?if($row['admin_idx']==''){?>
                          <img src="/images/i_dot_2.png" onclick="set_btn_more('<?=$row['board_reply_idx']?>','<?=$row['member_idx']?>','<?=$row['reply_comment']?>');" alt="더보기" class="btn_more">
                          <?}?>

                      </th>
                    </tr>
                    <tr>
                      <td>
                        <p class="p"><?=$row['reply_comment']?></p>
                      </td>
                    </tr>
                    <tr>
                      <td><span class="date"><?=$row['ins_date_format']?></span>
                      <? if($board_type==1){?>
                        <span class="reg_reply" onclick="reg_reply('<?=$row['member_nickname']?>','<?=$row['board_reply_idx']?>')">답글 달기</span>
                        <?}else{?>
                          <span class="reg_reply" onclick="reg_reply('','<?=$row['board_reply_idx']?>')">답글 달기</span>
                          <?}?>
                      </td>
                    </tr>
                  </table>
                  <?}
                }
              }
            }?>
              <?if($row['board_reply_cnt']>0){?>
                <table class="tbl_reply">
                  <?foreach($row['board_reply'] as $row2){
                    $member_s_img2= $this->global_function->get_small_img($row2->member_img);?>
                    <?if($row2->del_yn!='N'){?>
                    <tr>
                      <td>
                        <p class="cmt_blind">삭제된 글입니다.</p>
                      </td>
                    </tr>
                    <?}else{?>
                      <?if($row2->display_yn!='Y'){?>
                        <tr>
                          <td>
                            <p class="cmt_blind">관리자에 의해 블라인드 된 글입니다.</p>
                          </td>
                        </tr>
                      <?}else{?>
                        <?if($row2->report_yn=='Y'){?>
                          <tr>
                            <td>
                              <p class="cmt_blind">신고한 글입니다.</p>
                            </td>
                          </tr>
                          <?}else{?>

                            <?if($row2->block_yn=='Y'){?>
                              <tr>
                                <td>
                                  <p class="cmt_blind">차단한 댓글 입니다.<button class="button" onclick="block_mod('<?=$row2->board_reply_idx?>');">차단해제</button></p>
                                </td>
                              </tr>
                              <?}else{?>
                                <tr>
                                  <th class="relative">
                                    <div class="img_box">
                                    <?if($row2->admin_idx>0){?>
                                      <img src="/images/admin_profile.png" alt="">
                                    <?}else{?>
                                      <?if($row2->member_idx==$row2->board_member_idx){?>
                                        <img src="/images/i_eve.png" alt="">
                                      <?}else{?>
                                        <img src="<?=($row2->member_img=='')?'/images/photo_default.png':$member_s_img2?>" alt="">
                                      <?}?>
                                    <?}?>
                                    </div>
                                    <span class="name">
                                      <?if($row2->admin_idx>0){?>
                                        <span class="pink">관리자</span>
                                      <?}else{?>
                                        <?if($row2->member_idx==$row2->board_member_idx){?>
                                          <span class="blue"><?=($row2->member_state!=3)?'작성자':'탈퇴한 회원입니다.'?></span>
                                          <?}else{
                                            if($board_type==1){?>
                                            <span class=""><?=($row2->member_state!=3)?$row2->member_nickname:'탈퇴한 회원입니다.'?></span>
                                            <?}else{?>
                                              <span class=""><?=($row2->member_state!=3)?'이브'.$row2->member_idx:'탈퇴한 회원입니다.'?></span>
                                              <?}?>
                                          <?}?>
                                    <?}?>
                                    </span>
                                    <?if($row2->admin_idx==''){?>
                                      <img src="/images/i_dot_2.png" onclick="set_btn_more('<?=$row2->board_reply_idx?>','<?=$row2->member_idx?>','<?=$row2->reply_comment?>');" alt="더보기" class="btn_more">
                                      <?}?>

                                  </th>
                                </tr>
                                <tr>
                                  <td>
                                    <p class="p"><?=$row2->reply_comment?></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td class="re_date">
                                    <span class="date"><?=$row2->ins_date_format?></span>
                                  </td>
                                </tr>
                                <?}
                                  }
                                }
                              }
                              
                            ?>
                    
                  <?}?>
                </table>
            <?}
            ?>
        </li>
<?php
		$j++;}
	}
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#total_block").val('<?=$total_block ?>');
	});

	$("#no_data").css("display","<?=$display?>");
	$("#btn_cmt_more").css("display","<?=$cmt_display?>");

</script>





