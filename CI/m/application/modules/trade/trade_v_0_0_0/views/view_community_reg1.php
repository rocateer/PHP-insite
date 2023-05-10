<header>
  <a class="btn_back" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="닫기"></a>
  <h1>
  게시글 등록
  </h1>
  <button>등록</button>
</header>
<div class="body reg_view">
  <div class="">
    <select name="" id="">
      <option value="">카테고리를 선택해주세요</option>
    </select>
    <input type="text" placeholder="제목을 입력해 주세요.">
    <textarea placeholder="나누고 싶은 고민을 적어 주세요!" id="" cols="" class="reg_textarea"></textarea>
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
  $(function(){
    const height = ($(window).height() - 290);
    $('.reg_textarea').css('height',height);
  })
</script>