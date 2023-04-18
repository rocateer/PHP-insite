<!-- header : s -->
<header>
  <a class="btn_back" href="javascript:void(0)" >
    <img src="/images/head_btn_share.png" alt="" onclick="api_request_sharing('<?=THIS_DOMAIN.'/'.mapping('share')?>');">
  </a>
  <h1>마이페이지</h1>
  <a class="btn_setting" href="/<?=mapping('setting')?>">
    <img src="/images/head_btn_setting.png" alt="">
  </a>
  <a class="btn_close" href="/<?=mapping('alarm')?>">
    <img src="/images/head_btn_alarm_<?=($alarm_new_cnt>0)?'on':'off'?>.png" alt="">
  </a>
</header>
<!-- header : e -->

<!-- body : s -->
<div class="body inner_wrap footer_margin">
  <div class="txt_center">
    <div class="mypage_profile_wrap img_box">
      <?$member_s_img= $this->global_function->get_small_img($result->member_img);?>
      <img id="member_img_src" src="<?=($result->member_img=='')?'/images/photo_default.png':$member_s_img?>" alt="">
      <img src="/images/btn_camera.png" class="btn_reg" onclick="api_request_file_upload('member_img')">
      <input type="hidden" name="member_img_path" id="member_img_path" value="">
      <input type="hidden" name="member_idx" id="member_idx" value="<?=$result->member_idx?>">
    </div>
    <h2><?=$result->member_nickname?></h2>
    <div class="date"><?=$result->member_id?></div>
  </div>
  <ul class="mypage_ul">
    <li>
      <a href="/<?= mapping('my_community') ?>">
      <img src="/images/i_my_1.png" alt="">
        내 커뮤니티
      </a>
    </li>
    <li>
      <a href="/<?= mapping('my_scrap') ?>">
      <img src="/images/i_my_2.png" alt="">
        스크랩
      </a>
    </li>
    <li>
      <a href="/<?= mapping('like') ?>">
      <img src="/images/i_my_3.png" alt="">
        좋아요
      </a>
    </li>
  </ul>
  <p class="mypage_title">내 정보 관리</p>
  <ul class="mypage_ul2">
    <li>
      <a href="/<?= mapping('member_info') ?>">
        내 정보 수정
      </a>
    </li>
    <?if($result->member_join_type=='C'){?>
    <li>
      <a href="/<?= mapping('member_pw_change') ?>">
        비밀번호 변경
      </a>
    </li>
    <?}?>
    <li>
      <a href="/<?= mapping('alarm') ?>/alarm_setting">
        알림 설정
      </a>
    </li>
  </ul>
</div>
<!-- body : e -->

<script>
  var agent ="<?=$agent?>";

  $(function(){
    setTimeout("api_request_main_menu('M')", 10);
  });

  //  요청 :: 디바이스 
  function api_request_main_menu(tab){
    // alert(tab);
  if(agent == 'android') {
    window.rocateer.request_main_menu(tab);
  } 
}

  function set_one_img(file_path){
    $('#member_img_src').attr("src", file_path);
    $('#member_img_path').val(file_path);

    default_mod();
  }
  	// 회원 정보 수정
	function default_mod(){
		var form_data = {
			'member_idx' : $('#member_idx').val(),
			'member_img' : $('#member_img_path').val()
		};

		$.ajax({
			url      : "/<?=mapping('mypage')?>/member_img_mod_up",
			type     : 'POST',
			dataType : 'json',
			async    : true,
			data     : form_data,
			success: function(result) {
				if(result.code == '-1'){
					alert(result.code_msg);
					return;
				}
				// 0:실패 1:성공
				if(result.code == 0) {
					alert(result.code_msg);
				} else {
					// alert(result.code_msg);
					location.href="/<?=mapping('mypage')?>";

				}
			}
		});
	}

  function api_request_sharing(sharing_text){
	if(agent == 'android') {
		window.rocateer.request_sharing(sharing_text);
	} else if (agent == 'ios') {
		var message = {
		"request_type" : "request_sharing",
		"sharing_text" : sharing_text,
	};
	window.webkit.messageHandlers.native.postMessage(message);
	}
}

</script>