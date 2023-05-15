<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
  게시글 등록
  </h1>
  <span class="head_txt"><a href="#">등록</a></span>
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
  </div>
  <div class="label inner_wrap">사진 </div>
  <div class="x_scroll_img_reg">
    <div class="cnt_num">0/10</div>
    <ul class="img_reg_ul" id="">
      <li>
        <div class="img_box">
          <img src="/images/btn_photo.png" alt="">
        </div>
      </li>
      <li>
        <img src="/images/btn_delete.png" alt="x" class="btn_delete">
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
      <li>
        <div class="img_box">
          <img src="/p_images/p2.png" alt="">
        </div>
      </li>
    </ul>
  </div>
</div>
<script>
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