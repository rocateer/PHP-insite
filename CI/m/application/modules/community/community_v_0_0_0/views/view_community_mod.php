<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <span class="head_txt"><a href="#">수정</a></span>
</header>
<div class="body">
  <div class="community_head">
      <img src="/images/ic_cate_1.png">
      <p class="title">자유공간</p>
      <p class="sub_txt">자유공간은 인테리어 내용 뿐만 아니라 자유롭게 서로 소통하는 공간입니다.</p>
  </div>
  <div class="reg_view">
    <input type="text" placeholder="제목을 입력하세요.">
    <div class="textarea_wrap">
      <p class="placeholder">
      건전한 게시글를 위해 불쾌감을 주는 게시물 또는 욕설 등은 자제해 주세요.<br><br>
      이용약관 및 관련 법률에 의하여 표시가 제한되거나 사전 예고 없이 삭제될 수 있습니다.
      </p>
      <textarea id="" cols="" class="reg_textarea"></textarea>
    </div>
    <!-- 투표 등록 : s -->
    <div class="vote_area mod_type" style="display:block">
      <hr class="space">
      <input type="text" value="저정도 스크래치면 교환하러 간다?" disabled>
      <div class="inner_wrap">
        <p class="fs_12 txt_red mt20">※ 글 등록 후 투표는 수정할 수 없습니다.</p>
        <div class="mt20">
          <input type="checkbox" name="vote_check" id="vote_check" value="Y" disabled>
          <label for="vote_check"><span></span>복수 선택 가능</label>
        </div>
        <ul class="reg_vote_list mt20 mb20">
          <li>
            <p>모루유리가 들어간 짙은 우드 중문</p>
          </li>
          <li>
            <p>모루유리가 들어간 짙은 우드 중문</p>
          </li>
          <!-- <li class="btn_add">
            <a href="#"><img src="/images/btn_add_full.png" class="w_100p"></a>
          </li> -->
        </ul>
      </div>
    </div>
      
    <!-- 투표 등록 : e -->
    
    <ul class="reg_img_list">
      <li>
        <img src="/images/btn_sm_delete.png" class="btn_delete">
        <img src="/p_images/s3.jpg">
      </li>
      <li>
        <img src="/images/btn_sm_delete.png" class="btn_delete">
        <img src="/p_images/s7.jpg">
      </li>
    </ul>
    
  </div>
  
  
</div>
<div class="reg_btn_bottom">
  <img src="/images/ic_reg_picture.png">
  <span id="btn_vote" class="btn_vote"><img src="/images/ic_reg_vote.png"></span>
</div>
<script>
  //투표 열기
  $(function(){
  $('#btn_vote').click(function(){
    $('.vote_area').toggleClass('active');
    $('.btn_vote').toggleClass('active');
    $(this).toggleClass('active');
    $(this).toggleClass('active');
  });
});


  // ios placeholder not showing
  for(var i =0; i < $('.textarea_wrap textarea').length; i++){
    if ($('.textarea_wrap').eq(i).find('textarea').val().length === 0) {
      $('.textarea_wrap').eq(i).find('textarea').siblings('.placeholder').css('display','block');
    }else{
      $('.textarea_wrap').eq(i).find('textarea').siblings('.placeholder').css('display','none');
    }
  }
  $(".textarea_wrap textarea").on("propertychange change keyup paste input", function(){
    if ($(this).val().length === 0) {
      $(this).siblings('.placeholder').css('display','block');
      }else{
      $(this).siblings('.placeholder').css('display','none');
    };
  });
  
</script>