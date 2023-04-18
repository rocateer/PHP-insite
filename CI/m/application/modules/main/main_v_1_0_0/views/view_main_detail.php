<header class="transparent">
  
<a href="/<?=mapping('alarm')?>" class="btn_close">
<? if($new_alarm_cnt>0){ ?>
      <img src="/images/head_btn_alarm_on_w.png" alt="알람">
    <? } else {?>
      <img src="/images/head_btn_alarm_off_w.png" alt="알람">
    <? } ?>
</a>
</header>
<div class="footer_margin row view_main">
  <div class="main_bn">
    <img src="/images/top_img.png" alt="">
    <div class="position_wrap">
      <?if($member_idx>0){?>
        <div class="date"><?=$now?> <?=$now_yoil?>요일</div>
        <div class="title"><?=$my->member_nickname?>님,<br><b>건강한 하루 보내세요</b></div>
        <?}else{?>
          <div class="title">건강한 일상의 시작, <br><b>나만의 운동루틴 추가</b></div>
          <a href="/<?=mapping('login')?>" class="btn_join">회원가입</a>
      <?}?>
    </div>
  </div>
  <div class="container_round inner_wrap">
    <?if($member_idx>0){?>
      <ul class="main_login_ul w_100 clearfix">
        <li>
          <a href="/<?= mapping('member_program') ?>">
            <img src="/images/i_main_1.png" alt="">
            <div class="title">내 스케줄</div>
            <div class="sub_title">추가한 프로그램 일정</div>
          </a>
        </li>
        <li>
          <a href="/<?= mapping('record') ?>">
            <img src="/images/i_main_2.png" alt="">
            <div class="title">운동기록</div>
            <div class="sub_title">완료한 운동 기록</div>
          </a>
        </li>
      </ul>
      <h5>오늘 스케줄 (<?=count($my_program_list)?>)</h5>
      <h2>건강한 나를 위한 오늘의 운동 루틴</h2>
      <? if(!empty($my_program_list)){?>
        <div class="shadow_box main_today_box">
          <ul class="main_routine_ul">
            <?foreach($my_program_list as $row){
              $min=(int)substr( $row->record_time, 3,2 ); 
              $sec=(int)substr( $row->record_time, -2 );?>
              <li class="<?=($row->excercise_yn=='Y')?'complete':''?>">
                <a href="/<?=mapping('program')?>/program_detail?program_idx=<?=$row->program_idx?>&type=1">
                <div class="routine_img">
                  <div class="img_box">
                    <img src="<?=$this->global_function->get_small_img($row->img_path);?>" alt="">
                  </div>
                </div>
                <div class="routine_right">
                  <span class="name"><?=$row->title?></span>
                  <span class="main_date">
                    <?if(!empty($row->record_time)){?>
                    <?=($min=='00')?'':$min.'분'?> <?=$sec?>초
                    <?}?>
                  </span>
                </div>
                </a>
              </li>
            <?}?>
          </ul>
        </div>
        <?}else{?>
        <a href="/<?=mapping('program')?>/category_list">
          <div class="box">
            <img src="/images/img_schedule.png" class="img">
            <h4>
            <img src="/images/i_plus.png" alt="" class="i_plus">스케줄 추가</h4>
            <div class="date">오늘은 운동 스케줄이 없어요. 프로그램을 추가해 보세요.</div>
          </div>
        </a>
      <?}?>
    <?}?>

    <h5 style="<?=($member_idx>0)?'margin-top:50px':'margin-top:0'?>;" >추천운동</h5>
    <h2><?=$title->main_program_title?> <a href="/<?=mapping('program')?>/category_list"><span class="title_all">운동 둘러보기</span></a></h2>
    <div class="main_grid_row_swiper">
      <div class="swiper-wrapper">
        <? foreach($program_list as $row1){?>
          <div class="swiper-slide">
            <a href="/<?= mapping('program') ?>/program_detail?program_idx=<?=$row1->program_idx?>">
              <table class="tbl_1" style="table-layout:fixed">
                <colgroup>
                  <col width="105px">
                  <col width="*">
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box" style="margin-right:13px;">
                      <img src="<?=$row1->img_path?>" alt="프로그램사진">
                    </div>
                  </th>
                  <td>
                    <div class="title"><?=$row1->title?></div>
                    <div class="level"><span>난이도</span>
                      <ul class="level_ul">
                        <?for($i=1;$i<=5;$i++){
                          if($i<=$row1->level){?>
                            <li class="on"></li>
                          <?}else{?>
                            <li></li>
                          <?}?>
                        <?}?>
                      </ul>
                    </div>
                    <ul class="info_ul">
                      <li>
                        <?=$row1->view_cnt?>
                      </li>
                      <li class="">
                        <?=$row1->like_cnt?>
                      </li>
                    </ul>
                  </td>
                </tr>
              </table>
            </a>
          </div>
        <?}?>
      </div>
    </div>

    <h5>매거진</h5>
    <h2><?=$title->main_news_title?></h2>
    <div class="main_magazine_swiper">
      <div class="swiper-wrapper">
        <?foreach($news_list as $row2){?>
          <?if($row2->display_yn=='Y'){?>
            <div class="swiper-slide ">
              <a href="/<?=mapping('board')?>/board_detail?news_idx=<?=$row2->news_idx?>">
                <div class="img_box">
                  <img src="<?=$row2->img_path?>" alt="">
                </div>
                <div class="title"><?=$row2->title?></div>
                <div class="sub_title"><?=strip_tags($row2->contents)?></div>
              </a>
            </div>
          <?}else{?>
            <div class="swiper-slide blind">
              <a href="">
                <div class="img_box">
                  <img src="<?=$row2->img_path?>" alt="">
                  <div class="txt_wrap">
                    <p>숨긴 컨텐츠입니다.</p>
                  </div>
                </div>
              </a>
            </div>
          <?}?>
        <?}?>
      </div>
    </div>

    <h5>커뮤니티</h5>
    <h2>당당한 여성들의 지식 나눔 공간</h2>
    <div class="shadow_box">
      <?if(count($board_list)>0){
        foreach($board_list as $row3){?>
          <ul class="community_ul0">
            <?if($row3->block_yn=='N'&&$row3->report_yn=='N'){?>
                <li>
                  <a href="javascript:void(0)" onclick="community_detail('<?=$row3->board_idx?>');">
                    <div class="title"><span><?=$row3->category_name?></span>  <?=$row3->title?></div>
                    <ul class="info_ul4">
                      <li>
                        <?=$row3->view_cnt?>
                      </li>
                      <li>
                        <?=$row3->like_cnt?>
                      </li>
                      <li>
                        <?=$row3->reply_cnt?>
                      </li>
                    </ul>
                  </a>
                </li>
              <?}else if($row3->block_yn=='Y'){?>
                <li class="blind">
                  <p>차단한 게시글입니다.</p>
                  <button>차단해제</button>
                </li>
              <?}else if($row3->report_yn=='Y'){?>
                <li class="blind">
                  <p class="mt10">신고한 게시물 입니다.</p>
                </li>
              <?}?>
        </ul>
      <?}
      }else{?>
        <div class="no_data">
          <p>등록된 커뮤니티 글이 없습니다.</p>
        </div>
      <?}?>
    </div>
    <div class="main_footer accordion">
      <div class="biz_trigger trigger">인사이트 사업자 정보</div>
      <ul class="terms_ul clearfix">
        <li>
          <a href="/<?=mapping('terms')?>/terms_detail?type=1">
            서비스 이용약관
          </a>
        </li>
        <li>
        <a href="/<?=mapping('terms')?>/terms_detail?type=0">
          개인정보 취급방침
        </a>
        </li>
        <li>
        </li>
      </ul>
      <div class="panel">
      주식회사 더프리다 | 대표이사 : 김혜빈<br>
        주소 : 서울시 동작구 노량진로 10, 4층 F-405호(스페이스살림)<br>
        사업자 등록번호 : 246-81-02296<br>
        <!-- 통신판매업 신고 : <br> -->
        <!-- 대표전화 : <br> -->
        <!-- 고객센터 : (평일 : 오전 시 ~ 오후 시, 점심시간: 오후 12시 ~ 오후 1시)<br> -->
        이메일 : evescore.service@gmail.com<br>
        개인정보관리책임자 : 김혜빈(lienkim93@thefrida.co.kr)
      </div>
    </div>
  </div>
</div>
<script>
  var agent ="<?=$agent?>";

  $('.panel').hide();
  var main_grid_row_swiper = new Swiper(".main_grid_row_swiper", {
    slidesPerView: 1.05,
    grid: {
      rows: 2
    },
    spaceBetween: 20,
    slideToClickedSlide :false,
  });

  var main_magazine_swiper = new Swiper(".main_magazine_swiper", {
    slidesPerView: 'auto',
    loop: true,
    spaceBetween: 10,
  });

  function community_detail(board_idx){

    if(member_gender==1){
      location.href ="/<?=mapping('community')?>/community_detail?board_idx="+board_idx;
    }else if(member_gender==0){
      alert("죄송합니다. 커뮤니티는 여성 전용 서비스입니다. 다른 서비스를 이용해 주세요!");
            return;
    }else{
      var return_url="<?=mapping('main')?>";
      if(COM_login_check(member_idx,return_url,'로그인 후에 사용 가능합니다.')==false){ return;}
    }
}

  $(function(){
    setTimeout("api_request_main_menu('M')", 10);
  });

  //  요청 :: 디바이스 
  function api_request_main_menu(tab){
  if(agent == 'android') {
    window.rocateer.request_main_menu(tab);
  } 
}


</script>

