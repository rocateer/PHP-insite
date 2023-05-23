<header>
	<div class="main_header">
    <a class="btn_left" href="javascript:history.go(-1)"><img class="w_100" src="/images/haed_btn_back.png" alt="뒤로가기"></a>
		<a href="#"><img src="/images/head_btn_search.png" class="main_search mr5"></a>
		<a href="#" class="btn_point btn_sm">글쓰기</a>
	</div>
</header>
<div class="body">
  <div class="community_head">
      <img src="/images/ic_cate_1.png">
      <p class="title">자유공간</p>
      <p class="sub_txt">자유공간은 인테리어 내용 뿐만 아니라 자유롭게 서로 소통하는 공간입니다.</p>
  </div>

  <ul class="community_list" id="list_ajax">
    <li>
      <a href="/<?=mapping('community')?>/community_detail">
        <div class="community_list_head">
          <div class="mark_hot">
            <img src="/images/ic_fire.png" alt="hot아이콘" class="w_16 middle">
            HOT
          </div>
          <p class="txt_nickname">딸기맛바나나킥1 · 서울 남부 <span class="f_right list_date">12.21</span></p>
          
        </div>
        <div class="community_list_body">
          <div class="thum_img relative">
            <div class="img_box">
              <img src="/p_images/s3.jpg">
            </div>
            <div class="img_cnt_box">3</div>
          </div>
          <div class="community_list_item">
            <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
          </div>
        </div>
        <div class="community_action_area mt15"> 
          <span><img src="/images/ic_board_heart_off.png">150</span>
          <span><img src="/images/ic_board_chat.png">10</span>
          <span><img src="/images/ic_board_visibility.png">1,523</span>
        </div>
      </a>
    </li>
    <li>
      <a href="/<?=mapping('community')?>/community_detail">  
        <p class="txt_nickname">드림꿈드림 · 목공 · 서울 남부 <span class="f_right list_date">12.21</span></p>
        <div class="community_list_body">
          <div class="community_list_item">
            <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
          </div>
        </div>
        <div class="community_action_area mt15"> 
          <span><img src="/images/ic_board_heart_off.png">150</span>
          <span><img src="/images/ic_board_chat.png">10</span>
          <span><img src="/images/ic_board_visibility.png">1,523</span>
        </div>
      </a>
    </li>
    <li class="community_noti">
      신고한 게시글입니다.
    </li>
    <li class="community_noti">
      차단한 게시글입니다.
      <a href="#">차단 해제</a>
    </li>
    <?php for ($i=0; $i < 6; $i++) {?>
    <li>
      <a href="/<?=mapping('community')?>/community_detail">  
      <p class="txt_nickname">딸기맛바나나킥 · 서울 남부 <span class="f_right list_date">2022.01.23</span></p>
        <div class="community_list_body">
          <div class="thum_img relative">
            <div class="img_box"><img src="/p_images/s3.jpg"></div>
            <div class="img_cnt_box">5</div>
          </div>
          <div class="community_list_item">
            <p class="community_list_title">월넛과 베이지로 차분하게, 무드있는 신혼집을 만들었어요.</p>
            <p class="community_list_con">33평에 양옆으로 크게 발코니가 있는 구조의 아파트였어요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요. 집을 다녀간 지인들 모두 평수보다 넓어 보인다고 이야기하네요.</p>
          </div>
        </div>
        <div class="community_action_area mt15"> 
          <span><img src="/images/ic_board_heart_off.png">150</span>
          <span><img src="/images/ic_board_chat.png">10</span>
          <span><img src="/images/ic_board_visibility.png">1,523</span>
        </div>
      </a>
    </li>
    <?php }?>
  </ul>
</div>
<a href="#"><img src="/images/floating_top.png" class="top_floating top"></a>
