<!-- header : s -->
<header>
	<a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/head_btn_back.png" alt="뒤로가기"></a>
  <h1>공동구매 사전 투표</h1>
</header>

<div class="body">
    <ul class="product_list mt10" style="display:none1;">
        <?php for ($i=0; $i < 3; $i++) {?>
        <li>
            <span class="mark">진행중</span>
            <a href="/<?=mapping('product')?>/product_vote_detail">
            <div class="img_box relative">
                <img src="/p_images/s6.jpg">
            </div>
            <div class="product_list_body">
                <p class="product_list_title">초급반 / 중급반 중 참여하고 싶은 클래스는?</p>
                <div class="product_list_item">
                    12,345명 참여중
                </div>
            </div>
            </a>
        </li>
        <?php }?>
        <li class="noti_bar">
        숨긴 게시물 입니다.
        <a href="#">숨김 해제</a>
        </li>
            
    </ul>
</div>


  


<script>

</script>