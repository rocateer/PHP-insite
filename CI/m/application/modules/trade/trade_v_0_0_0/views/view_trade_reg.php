<header>
  <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>&nbsp;</h1>
  <span class="head_txt"><a href="#">등록</a></span>
</header>
<div class="body">
  <div class="community_head">
    <p class="fs_12 font_gray_A0">사기 및 불법, 범죄 행위에 의심되는 거래 발견 시 사전 예고 없이 삭제 및 이용정지 처리 될 수 있습니다.  인사이트는 판매자와 구매자 간의 거래에 관여하지 않으며 어떠한 의무와 책임도 부담하지 않습니다. 거래 시 각별히 주의하시기 바랍니다.</p>
  </div>
  <div class="reg_view">
    <input type="text" placeholder="제목을 입력하세요.">
    <input type="tel" placeholder="연락처를 입력해주세요.">
    <input type="number" placeholder="가격단위 (원)">
    <div class="input_wrap">
      <ul class="gride_2">
        <li>
          <input type="checkbox" name="delivery" id="delivery_0" value="Y">
          <label for="delivery_0"><span></span>택배</label>
        </li>
        <li>
          <input type="checkbox" name="delivery" id="delivery_1" value="Y">
          <label for="delivery_1"><span></span>직거래</label>
        </li>
      </ul>
    </div>
    <input type="text" placeholder="직거래 장소를 입력해 주세요.">

    <div class="x_scroll_img_reg mt20">
      
      <ul class="img_reg_ul pdl20" id="">
        <li>
          <div class="cnt_num"><span class="point_color">0</span>/10</div>
          <div class="img_box">
            <img src="/images/btn_photo.png" alt="">
          </div>
        </li>
        <?php for ($i=0; $i < 6; $i++) {?>
        <li>
          <img src="/images/btn_sm_delete.png" alt="x" class="btn_delete">
          <div class="img_box">
            <img src="/p_images/s7.jpg" alt="">
          </div>
        </li>
        <?php }?>
      </ul>
    </div>
    <div class="textarea_wrap">
      <p class="placeholder">
      브랜드, 색상, 사용감 등의 자세한 정보를 입력하시면<br> 판매 확률이 높아져요!
      </p>
      <textarea id="" cols="" class="reg_textarea"></textarea>
    </div>
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