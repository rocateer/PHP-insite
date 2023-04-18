<header>
  <div class="btn_close" onclick="modal_open_slide('more')">
    <img src="/images/i_dot_2.png" alt="">
  </div>
  <a class="btn_back" href="javascript:document.referrer ? history.go(-1): location.href='/<?=mapping('main')?>';"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>

  <?if($result->board_type=='1'){
    $member_s_img= $this->global_function->get_small_img($result->member_img);?>
  <div class="profile">
    <div class="img_box">
      <img src="<?=($result->member_img=='')?'/images/photo_default.png':$member_s_img?>" alt="">
    </div>
    <span class="name"><?=$result->member_nickname?></span>
  </div>
  <?}?>
 
</header>
<div class="body community_detail_view">
  <?if($result->board_type=='0'){?>
  <div class="inner_wrap mb20">
    <div class="title"><span><?=$result->category_name?> </span><?=$result->title?></div>
    <span class="date"><?=$result->ins_date?> ·</span>
    <ul class="info_ul4">
      <li><?=$result->view_cnt?>
      </li>
    </ul>
  </div>
  <?}?>
  <? if(!empty($result->board_img)){?>
  <div class="swiper community_swiper">
    <div class="swiper-wrapper">
      <?$img_arr = explode(',',$result->board_img);
      foreach($img_arr as $img){?>
      <div class="swiper-slide">
        <div class="img_box">
          <img src="<?=$img?>"onclick="modal_open('swiper_img_view');idx(0)">
        </div>
      </div>
      <?}?>
    </div>
    <div class="swiper-pagination"></div>
    <?}?>
  </div>
  <div class="p16_2">
    <div class="contents_txt">
      <p><?=nl2br($result->contents)?></p>
    </div>

  <?if($result->board_type=='1'){?>
    <div class="date"><?=$result->ins_date?></div>
    <div id="today_program_wrap">
      <? if(count($result_list)>0){?>
        <ul class="today_program_ul">
        <?foreach($result_list as $row1){
          $min=(int)substr( $row1->record_time, 3,2 ); 
          $sec=(int)substr( $row1->record_time, -2 );
          $yoil_arr = explode(',',$row1->yoil);

            $select_yoil = "";

            if($row1->yoil=='1,2,3,4,5,6,0'){
              $select_yoil = "매일 ";
            }else{
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
            }
          ?>
            <li>
              <?if($row1->program_del_yn=='Y' || $row1->program_display_yn=='N'){?>
                <a href="javascript:void(0)">
                  <?}else{?>
                    <a href="/<?= mapping('program') ?>/program_detail?program_idx=<?=$row1->program_idx?>">
              <?}?>
                <table class="tbl_fix tbl_2">
                  <colgroup>
                    <col width='55px'>
                    <col width='*'>
                  </colgroup>
                  <tr>
                    <th>
                      <div class="img_box">
                        <img src="<?=$this->global_function->get_small_img($row1->img_path);?>" alt="">
                      </div>
                    </th>
                    <td>
                      <table class="tbl_4_1">
                        <tr>
                          <th>
                            <span class="name"><?=$row1->title?></span>
                            <span class="name f_right"><?=($min=='00')?'':$min.'분'?> <?=$sec?>초</span>
                          </th>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <p class="date"><?=substr($select_yoil,0,-1)?> <span class="f_right"><?=$row1->s_date?> ~ <?=$row1->e_date?></span></p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </a>
            </li>
          <?}?>
        </ul>
      <?}?>
    </div>
    <!-- <div class="txt_center">
      <button class="btn_more_view" onclick="more_view()">더보기</button>
    </div> -->

  <?}?>
  </div>  
  <hr class="space mb20">
  <div class="inner_wrap">
    <ul class="info_ul2">
      <li onclick="like_reg_in('<?=$result->board_idx?>');">
        <span class="wish_btn">
          <a class="<?=($result->like_yn=='Y')?'on':''?>" href="javascript:void(0)" onclick="wish_btn(this)"></a>
        </span>
        <b id="like_cnt"><?=$result->like_cnt?></b>
      </li>
      <li>
        <img src="/images/i_comment_3.png" alt="">
        <?=$result->reply_cnt?>
      </li>
    </ul>
  </div>
    
  <!-- 댓글:s -->
  <div class="cmt_wrap">
    <div class="cmt_area">
      <div class="no_data" id="no_data" style="display: none;">
        <p>아직 댓글이 없습니다.<br>댓글을 달아주세요!</p>
      </div>
      <!-- 댓글: tbl_cmt, 답글: tbl_reply, etc: cmt_blind -->
      <ul class="cmt_ul" id="list_ajax"></ul>
    </div>

      <button class="btn_cmt_more" id="btn_cmt_more" onclick="next_page();" style="display: none;">댓글 더보기</button>
      
    <div class="cmt_reg">
      <div class="tag"> <span id="cmt_member_nickname" style=""></span>님에게 답글 남기는 중</div>
      <input type="text" class="input" id="cmt_contents" placeholder="매너있는 댓글을 입력해 주세요.">
      <img src="/images/btn_send.png" alt="등록" class="btn_send" id="btn_send" onclick="cmt_reg_in()">
    </div>
  </div>
  <div id="reply_back" onclick="reply_back_close()"></div>
  <!-- 댓글:e -->
</div>


<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_cmt_more" id="md_cmt_more" style="display:none;">
  <ul>
    <li id="cmt_btn1">
      <a href="javascript:void(0)" onclick="mod_reply();">수정</a>
    </li>
    <li  id="cmt_btn2">
      <a href="javascript:void(0)" onclick="cmt_del();">삭제</a>
    </li>
    <li  id="cmt_btn3">
      <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('cmt_more')">신고</a>
    </li>
    <li  id="cmt_btn4">
      <a href="javascript:void(0)" onclick="block_reg_in('<?=$result->board_idx?>');">차단</a>
    </li>
  </ul>
  <ul class="close">
    <li>
      <a href="javascript:modal_close_slide('cmt_more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_cmt_more" onclick="modal_close_slide('cmt_more')"></div>
<!-- modal_open_slide : e -->

<!-- modal_open_slide : s -->
<div class="modal_slide modal_slide_more" id="md_more" style="display:none;">
  <ul>
    <?if($member_idx==$result->member_idx){?>
      <li>
        <a href="/<?=mapping('community')?>/community_mod?board_idx=<?=$result->board_idx?>">수정</a>
      </li>
      <li>
        <a href="javascript:void(0)" onclick="default_del('<?=$result->board_idx?>');">삭제</a>
      </li>
    <?}else{?>
      <li>
        <a href="javascript:void(0)" onclick="modal_open('report');modal_close_slide('more')">신고</a>
      </li>
      <li>
        <a href="javascript:void(0)" onclick="block_reg_in('<?=$result->board_idx?>');">차단</a>
      </li>
    <?}?>
  </ul>
  <ul class="close">
    <li>
      <a href="javascript:modal_close_slide('more')">취소</a>
    </li>
  </ul>
</div>
<div class="md_slide_overlay md_slide_overlay_more" onclick="modal_close_slide('more')"></div>
<!-- modal_open_slide : e -->

<div class="modal modal_report">
  <div class="md_container">
    <div class="title">부적절한 내용인가요?<br>모두가 즐길 수 있는 컨텐츠를<br>만들기 위해서는 신고가 필요합니다.</div>
    <select name="report_type" id="report_type">
      <option value="">선택</option>
      <option value="0">영리목적 홍보성</option>
      <option value="1">불법 정보</option>
      <option value="2">음란성, 선정성</option>
      <option value="3">욕설, 인신공격</option>
      <option value="4">개인정보 노출</option>
      <option value="5">같은 내용의 반복 게시(도배)</option>
      <option value="6">기타</option>
    </select>
    <div class="label">신고 사유 입력 <span class="essential">*</span></div>
    <textarea name="report_contents" id="report_contents" cols="" rows=""></textarea>
    <div class="btn_md_wrap">
      <span class="btn_md_left" onclick="modal_close('report')">
        취소
      </span>
      <span class="btn_md_right" onclick="report_reg_in('<?=$result->board_idx?>')">
        확인
      </span>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_report" onclick="modal_close('report')"></div>

<!-- modal : s -->
<div class="modal modal_swiper_img_view">
  <header class="transparent">
    <div class="btn_back"><img src="/images/head_btn_close_w.png" onclick="javascript:modal_close('swiper_img_view')"></div>
    <span class="cnt" id="modal_img_cnt">1</span>
  </header>
  <div class="wrap">
    <div class="swiper community_img_view_swiper">
      <div class="swiper-wrapper">
        <?foreach($img_arr as $img){?>
          <div class="swiper-slide">
            <div class="img_box">
              <img src="<?=$img?>">
            </div>
          </div>
        <?}?>
      </div>
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_swiper_img_view" onclick="javascript:modal_close('swiper_img_view')"></div>

<input type="hidden" name="total_block" id="total_block" value="1">
<input type="hidden" name="board_idx" id="board_idx" value="<?=$result->board_idx?>">
<input type="hidden" name="board_type" id="board_type" value="<?=$result->board_type?>">
<input type="text" name="board_reply_idx" id="board_reply_idx" value="0" style="display:none;">
<input type="text" name="cmt_member_idx" id="cmt_member_idx" value="0" style="display:none;">
<input type="text" name="comment_comments" id="comment_comments" value="" style="display:none;">

<script>
    var agent ="<?=$agent?>";
    var mymember_idx = '<?=$this->member_idx?>';

    var swiper = new Swiper(".community_swiper", {
    pagination: {
      el: ".swiper-pagination",
      dynamicBullets: true,
    },
  });

  function idx(idx){
  // 모달 슬라이더 이미지
    var index_tot='<?=(!empty($result->board_img))?count($img_arr):''?>';
    $('#modal_img_cnt').html( '1/'+index_tot);

    var community_img_view_swiper = new Swiper(".community_img_view_swiper", {
      initialSlide: idx,
      slidesPerView: 1,
      autoHeight: true,
      navigation: {
        nextEl: ".modal_swiper_img_view .swiper-button-next",
        prevEl: ".modal_swiper_img_view .swiper-button-prev",
      },
      on: {
          slideChangeTransitionEnd: function () {
            var index_no=this.activeIndex+1;
            $('#modal_img_cnt').html( index_no+'/'+index_tot);
          },
        },
    });
  }

  function text_all_view(e){
    const siblings = e.previousElementSibling;
    e.style.display = 'none';
    siblings.style.display = 'block';
  }
// 민지 : 모달 슬라이드
window.onload = function(){
  let md_slide_height;
	for(var i = 0; i<$('.modal_slide').length;i++){ // 각 모달의 높이 값만큼 -
	  md_slide_height = $('.modal_slide').eq(i).outerHeight();
	  $('.modal_slide').eq(i).css('bottom',-md_slide_height);
	} //모든 모달슬라이드 숨기기
}
// 민지
function modal_open_slide(element){
	$(".md_slide_overlay_" + element).css("visibility", "visible").animate({opacity: 1}, 200);
	$(".modal_slide_" + element).animate({bottom: 0},200);
	$("#md_" + element).css('display','block');
	$.lockBody();
}

function modal_close_slide(element){
  md_slide_height2 = $(".modal_slide_" + element).outerHeight();
	$(".md_slide_overlay_" + element).css("visibility", "hidden").animate({opacity: 0}, 200);
	$(".modal_slide_" + element).animate({bottom: -md_slide_height2},200);
	$.unlockBody();
}

  // 답글달기
  function reg_reply(member_nickname,cmt_board_reply_idx){
    $('#cmt_member_nickname').html(member_nickname);
    $('#board_reply_idx').val(cmt_board_reply_idx);
    $('.cmt_reg .tag').css('display','block');
    $('#reply_back').css('display','block');
    $('#input').focus();
  }

  function mod_reply(){
    var cmt_comments = $('#comment_comments').val();
    $('#cmt_contents').val(cmt_comments);
    $('#btn_send').attr('onclick','cmt_mod_up();');

    modal_close_slide('cmt_more');
    $('#reply_back').css('display','block');
    $('#input').focus();
  }

  // 답글닫기
  function reply_back_close(){
    $('#input').val('');
    $('.comment_reg .tag').css('display','none');
    $('#reply_back').css('display','none');
    $('.cmt_reg .tag').css('display','none');
    $('.btn_send').css('display','none');
  }

  // 댓글 입력되면 버튼 노출/토글
  $(".input").on("propertychange change keyup paste input", function(){
    if ($(this).val().length === 0) {
      $('.btn_send').css('display','none');
    }else{
      $('.btn_send').css('display','block');
    };
  })

    // 더보기
  function set_btn_more(board_reply_idx,cmt_member_idx,comments){

    $('#board_reply_idx').val(board_reply_idx);
    $('#cmt_member_idx').val(cmt_member_idx);
    $('#comment_comments').val(comments);

    // alert(comments);

    if(mymember_idx==cmt_member_idx){
      $('#cmt_btn1').css('display','block');
      $('#cmt_btn2').css('display','block');
      $('#cmt_btn3').css('display','none');
      $('#cmt_btn4').css('display','none');
    }else{
      $('#cmt_btn1').css('display','none');
      $('#cmt_btn2').css('display','none');
      $('#cmt_btn3').css('display','block');
      $('#cmt_btn4').css('display','block');
    }

    modal_open_slide('cmt_more');
  }
  
  var page_num=1;

  $(function(){
    setTimeout("default_list_get('1')", 10);
  });

  function next_page(){
    page_num++;
    default_list_get(page_num);
  }

  function default_list_get(page_num){

    var total_block = parseInt($("#total_block").val());
    var board_idx =$("#board_idx").val();
    var board_type =$("#board_type").val();

    var formData = {
      'page_num' : page_num,
      'board_idx' : board_idx,
      'board_type' : board_type
    };

	$.ajax({
		url      : "/<?=mapping('community')?>/comment_list_get",
		type     : "POST",
		dataType : "html",
		async    : true,
		data     : formData,
		success: function(result) {

			if(page_num == 1){
				 $("#list_ajax").html(result);

			}else{
				if(total_block < page_num){
          if(total_block>0){
            $('#btn_cmt_more').css('display','none');
          }
				 page_num = 1;

				}else{
				 $("#list_ajax").append(result);
				}

			}
		}
	});
}

// 댓글 등록
function cmt_reg_in(){

  var formData = {
    'board_idx' :$('#board_idx').val(),
    'board_reply_idx' : $('#board_reply_idx').val(),
    'cmt_contents' : $('#cmt_contents').val()
  }

  $.ajax({
      url      : "/<?=mapping('community')?>/cmt_reg_in",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success : function(result){
        console.log(result);
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == '0') {
          alert(result.code_msg);
        }else if(result.code == '1'){
          alert(result.code_msg);
          $('#board_reply_idx').val('0');
          $('#cmt_contents').val('');
          reply_back_close();
          default_list_get(1);
          // history.go(-1);
        }
      }
  });
}

//댓글 수정
function cmt_mod_up(){

  var formData = {
    'board_idx' :$('#board_idx').val(),
    'board_reply_idx' : $('#board_reply_idx').val(),
    'cmt_contents' : $('#cmt_contents').val()
  }

  $.ajax({
      url      : "/<?=mapping('community')?>/cmt_mod_up",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success : function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        }else {
          alert(result.code_msg);
          $('#board_reply_idx').val('0');
          $('#cmt_contents').val('');
          reply_back_close();
          default_list_get(1);
          // history.go(-1);
        }
      }
  });
}

//댓글 삭제
function cmt_del(){

  var formData = {
    'board_idx' : $('#board_idx').val(),
    'board_reply_idx' : $('#board_reply_idx').val()
  }

  $.ajax({
      url      : "/<?=mapping('community')?>/cmt_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success : function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        }else {
          alert(result.code_msg);
          modal_close_slide('cmt_more')
          default_list_get(1);
        }
      }
  });
}

//댓글 삭제
function cmt_del(){

  var formData = {
    'board_idx' : $('#board_idx').val(),
    'board_reply_idx' : $('#board_reply_idx').val()
  }

  $.ajax({
      url      : "/<?=mapping('community')?>/cmt_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : formData,
      success : function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        }else {
          alert(result.code_msg);
          modal_close_slide('cmt_more');
          default_list_get(1);
        }
      }
  });
}

// 삭제
function default_del(board_idx){

  if(!confirm("삭제 하시겠습니까?")){
      return;
    }

  $.ajax({
      url      : "/<?=mapping('community')?>/community_del",
      type     : 'POST',
      dataType : 'json',
      async    : true,
      data     : {
        'board_idx':board_idx
      },
      success : function(result){
        if(result.code == '-1'){
          alert(result.code_msg);
          $("#"+result.focus_id).focus();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.code_msg);
        }else {
          alert(result.code_msg);
          location.href="/<?=mapping('community')?>";
        }
      }
  });
}

function block_mod(board_reply_idx){

  $('#board_reply_idx').val(board_reply_idx);
  var board_idx = $('#board_idx').val();

  block_reg_in(board_idx);
}

// 차단등록/해제
function block_reg_in(board_idx){

  var board_reply_idx = $('#board_reply_idx').val();

  if(!confirm("차단 등록/해제 하시겠습니까?")){
        return;
      }

  var return_url="<?=mapping('community')?>";
  if(COM_login_check(member_idx,return_url,'로그인 후에 사용 가능합니다.')==false){ return;}


  var formData = {
    'board_idx' : board_idx,
    'board_reply_idx' : board_reply_idx,
  }

  console.log(formData);

$.ajax({
    url      : "/common/block_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success : function(result){
      if(result.code == '-1'){
         alert(result.code_msg);
         $("#"+result.focus_id).focus();
         return;
       }
       // 0:실패 1:성공
       if(result.code == 0) {
         alert(result.code_msg);
       }else {
        if(board_reply_idx<1){
          location.href="<?=mapping('community')?>";
        }else{
          // alert(result.code_msg);
          modal_close_slide('cmt_more');
          default_list_get(1);
        }
       }
    }
  });
}

// 신고
function report_reg_in(board_idx){
  var board_reply_idx = $('#board_reply_idx').val();

  var return_url="<?=mapping('community')?>";
  if(COM_login_check(member_idx,return_url,'로그인 후에 사용 가능합니다.')==false){ return;}


  var formData = {
    'board_idx' : board_idx,
    'board_reply_idx' : board_reply_idx,
    'report_type' : $("select[name='report_type']").val(),
    'report_contents' : $('#report_contents').val()
  }

$.ajax({
    url      : "/<?=mapping('community')?>/report_reg_in",
    type     : 'POST',
    dataType : 'json',
    async    : true,
    data     : formData,
    success : function(result){
      if(result.code == '-1'){
         alert(result.code_msg);
         $("#"+result.focus_id).focus();
         return;
       }
       // 0:실패 1:성공
       if(result.code == 0) {
         alert(result.code_msg);
       }else {
        if(board_reply_idx<1){
          location.href="<?=mapping('community')?>";
        }else{
          alert(result.code_msg);
          modal_close('report');
          default_list_get(1);
        }
       }
    }
  });
}

function like_reg_in(board_idx){

  $.ajax({
    url      : "/<?=mapping('community')?>/like_reg_in",
    type     : "POST",
    dataType : "json",
    async    : true,
    data     : {
      'board_idx':board_idx
    },
    success: function(result) {
      // -1:유효성 검사 실패
      if(result.code == '-1'){
        alert(result.code_msg);
        $("#"+result.focus_id).focus();
        return;
      }
      // 0:실패 1:성공
      if(result.code == 0) {
        alert(result.code_msg);
      } else if(result.code == 1) {
        document.getElementById("like_cnt").innerHTML = result.like_cnt;
        $("#like_cnt").html(result.like_cnt);
        // alert(result.code_msg);
        // location.reload();
      }
    }
  });
}

</script>