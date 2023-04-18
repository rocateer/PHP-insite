<div class="modal modal_playlust_edit dom">
  <img src="/images/i_close.png" alt="x" class="btn_close" onclick="modal_close('playlust_edit');">
  <h4 class="inner">수록곡 순서 변경</h4>
  <ul class="order_change_ul mt20">
    <? for($i = 1; $i <=12; $i++){ ?>
    <li>
      <table class="tbl_4">
        <colgroup>
          <col width="32px">
          <col width="64px">
          <col width="*">
        </colgroup>
        <tr>
          <th>
            <input type="checkbox" id="chk_3_<?=$i?>" name="checkOne2">
            <label for="chk_3_<?=$i?>"><span></span></label>
          </th>
          <td>
            <div class="img_box">
              <img src="/p_images/s1.jpg" alt="">
            </div>
          </td>
          <td>
            <div class="fs_14"><?=$i?>회전목마 (Feat. Zion.T, 원슈타인)</div>
            <div class="name">BE'O (비오)</div>
          </td>
        </tr>
      </table>
    </li>
    <?}?>
  </ul>
  <div class="controller">
    <input type="checkbox" id="checkAll2" name="checkAll2">
    <label for="checkAll2"><span></span></label>
    <button class="btn_sort up"></button>
    <button class="btn_sort down"></button>
    <button class="btn_sort double_up"></button>
    <button class="btn_sort double_down"></button>
    <select name="" id="">
      <option value="">정렬</option>
    </select>
    <button class="btn_save">저장</button>
  </div>
</div>
<div class="md_overlay md_overlay_playlust_edit" onclick="modal_close('playlust_edit');"></div>
<div class="modal modal_playlust_mod">
  <img src="/images/i_close.png" alt="x" class="btn_close" onclick="modal_close('playlust_mod');">
  <h4>플레이리스트 수정</h4>
  <div class="img_reg_wrap">
    <div class="img_box">
      <img src="/p_images/s1.jpg" alt="">
    </div>
    <img src="/images/btn_camera.png" alt="등록" class="btn_reg">
  </div>
  <div class="label">플레이리스트 이름 <span class="essential">*</span></div>
  <input type="text" placeholder="플레이리스트명">
  <div class="label">소개글</div>
  <textarea name="" id=""></textarea>
  <ul class="open_rdo_ul row mt30">
    <li>
      <input type="radio" id="rdo_2_1" name="rdo_2" checked>
      <label for="rdo_2_1">공개</label>
    </li>
    <li>
      <input type="radio" id="rdo_2_2" name="rdo_2">
      <label for="rdo_2_2">비공개</label>
    </li>
  </ul>
  <div class="md_btn_wrap">
    <div class="md_btn_left">
      취소
    </div>
    <div class="md_btn_right">
      확인
    </div>
  </div>
</div>
<div class="md_overlay md_overlay_playlust_mod" onclick="modal_close('playlust_mod');"></div>

<div class="body">
<div class="mypage_top">
    <div class="inner_wrap">
      <table>
        <colgroup>
          <col width="74px">
          <col width="60px">
          <col width="50px">
          <col width="auto">
          <col width="50px">
          <col width="500px">
          <col width="190px">
          <col width="auto">
        </colgroup>
        <tr>
          <th>
            <div class="img_box">
              <img src="/p_images/s1.jpg" alt="">
            </div>
          </th>
          <td>
            <span class="name">Lampmusic</span>
          </td>
          <th>팔로워</th>
          <td class="pointer" onclick="modal_open('follower')">20.0K</td>
          <th>팔로잉</th>
          <td><span class="pointer" onclick="modal_open('follower')">154</span> 
            <span class="relative">
              <img src="/images/i_dot2.png" class="i_dot" onclick="open_more(this)">
              <div class="more_ele mypage">
                <ul class="dropdown_more-options">
                  <li class="option">
                    <p onclick="close_more();location.href='/<?=mapping("member_info")?>'">내 정보 수정</p>
                  </li>
                  <li class="option">
                    <p onclick="close_more();modal_open('password_change');">비밀번호 변경</p>
                  </li>
                  <li class="option">
                    <p onclick="close_more();location.href='/<?=mapping("qa")?>'">1:1 문의</p>
                  </li>
                  <li class="option">
                    <p onclick="close_more();location.href='/<?=mapping("login")?>'">로그아웃</p>
                  </li>
                </ul>
              </div>
            </span>
          </td>
          <th>보유중인 포인트(무료/유료)</th>
          <td>100P/200P</td>
        </tr>
      </table>
    </div>
  </div>

  <div class="inner_wrap">
    <table class="tbl_album mt30">
      <colgroup>
        <col width="310px">
        <col width="*">
      </colgroup>
      <tr>
        <th class="th_top">
          <div class="img_box">
            <img src="/p_images/s1.jpg" alt="">
          </div>
          <td>
            <h2>My Universe</h2>
            <div class="wish_btn mt10 mb20">
              <a class="" href="javascript:void(0)" onclick="wish_btn(this)"></a>
              21
            </div>
            <p class="album_info">정규 9집 ‘Music of the Spheres’ 공개를 앞두고 있는 밴드 콜드플레이. 이들은 올해 우주를 컨셉으로 한 신비로운 아트웍과 짜릿한 선공개곡 ‘Higher Power’를 공개해 여전히 건재함을 알렸는데요. 그런 그들이 이번에는 방탄소년단 그런 그들이 이번에는 방탄소년단 그런 그들이 이번에는 방탄소년단그런 그들이 이번에는 방탄소년단</p>
            <button class="btn_more" onclick="modal_open('album_info')">전체보기</button>
            <ul class="dot_ul">
              <li>4곡</li>
              <li>1시간 58분</li>
            </ul>
            <span class="btn_m f_left btn_gray detail_btns2">
              <a href="javascript:void(0)" onclick="modal_open('playlust_mod');">수정</a>
            </span>
          </td>
        </th>
      </tr>
    </table>
    <table class="tbl_0 mt60 mb20 tbl_2">
      <colgroup>
        <col width="56px">
        <col width="*">
        <col width="180px">
      </colgroup>
      <tr>
        <th>
          <input type="checkbox" name="checkAll" id="checkAll">
          <label for="checkAll"><span></span></label>
        </th>
        <td>
          <span class="btn_m f_left mr12 btn_gray">
            <a href=""><img src="/images/play_3.png"> 재생</a>
          </span>
          <span class="btn_m f_left mr12 btn_gray">
            <a href="javascript:void(0)" onclick="modal_open('add_playlist')"><img src="/images/play_4.png"> 추가</a>
          </span>
          <span class="btn_m f_left mr12 btn_gray">
            <a href="javascript:void(0)" onclick="modal_open('cart_playlist');"><img src="/images/play_1.png"> 담기</a>
          </span>
          <span class="btn_m f_left btn_gray">
            <a href="javascript:void(0)" onclick="modal_open('cart_playlist');"><img src="/images/play_2.png"> 삭제</a>
          </span>
        </td>
        <td>
          <button onclick="modal_open('playlust_edit');" class="btn_edit">편집하기</button>
          <div class="font_gray_8 fs_14 inline_block">1곡 선택</div>
        </td>
      </tr>
    </table>
    <ul class="chart_ul">
      <? for($i = 1; $i<=10; $i++){?>
      <li>
        <table class="tbl_0 tbl_2">
          <colgroup>
            <col width="56px">
            <col width="34px">
            <col width="*">
            <col width="200px">
            <col width="200px">
            <col width="90px">
          </colgroup>
          <tr>
            <th>
              <input type="checkbox" name="checkOne" id="checkOne">
              <label for="checkOne"><span></span></label>
            </th>
            <th>
              <a href="javascript:void(0)" onclick="btn_play(this,<?=$i?>)"><?=$i?></a>
            </th>
            <th>
              <div class="img_box">
                <img src="/p_images/s2.jpg" alt="">
              </div>
              <div class="title">Counting Stars (Feat. BeenzCounting Stars (Feat. BeenzCounting Stars (Feat. Beenz</div>
            </th>
            <th>
              <div class="font_gray_8">BE'O (비오)</div>
            </th>
            <th>
              <div class="font_gray_8"><img src="/images/i_like.png" class="i_like"> 40</div>
            </th>
            <td>
              <img src="/images/i_list1.png" alt="추가" class="icon" onclick="modal_open('add_playlist')">
              <img src="/images/i_list2.png" alt="담기" class="icon" onclick="modal_open('cart_playlist')">
            </td>
          </tr>
        </table>
      </li>
      <? }?>

    </ul>
  </div>
</div>
<div class="modal modal_album_info">
  <img src="/images/i_close.png" alt="x" class="btn_close" onclick="modal_close('album_info')">
  <h4>소개</h4>
  <p class="font_gray_8 mt20">정규 9집 ‘Music of the Spheres’ 공개를 앞두고 있는 밴드 콜드플레이. 이들은 올해 우주를 컨셉으로 한 신비로운 아트웍과 짜릿한 선공개곡 ‘Higher Power’를 공개해 여전히 건재함을 알렸는데요. 그런 그들이 이번에는 방탄소년단과의 콜라보로 돌아왔습니다. 오랫동안 사랑을 받아온 세계적인 록밴드와 화제의 팝 아이콘의 만남답게, 발매와 동시에 화제가 되고 있는 싱글 ‘My Universe’. 주목받는 두 그룹의 에너지 가득한 세계를 만나보세요. 켈리 클락슨 쇼(The Kelly Clarkson Show)에 출연한 밴드의 프론트맨 크리스 마틴(Chris Martin)은 ‘My Universe’에 대해 “누군가가 특정인을 사랑할 수 없다거나, 이 인종과 함께할 수 없다거나, 동성애자가 될 수 없다는 말을 듣는 일에 관한 노래”라고 소개했는데요. 서로 다른 영역에서 활동하는 두 그룹의 만남은 다소 낯설게 느껴질 수도 있지만, 크리스의 설명처럼 ‘차별과 경계를 초월한 사랑’이라는 곡의 주제와 맞물리며 각별함을 자아냅니다. 프로듀싱에는 수많은 팝 히트곡을 탄생시킨 맥스 마틴(Max Martin)이 참여해 대중적이고 캐치한 사운드를 선보였습니다.</p>

</div>
<div class="md_overlay md_overlay_album_info" onclick="modal_close('album_info')"></div>
<div class="more_back" onclick="close_more()"></div>

<script>

  function btn_play(el,idx){
    if($(el).children().is('img')){
      $(el).text(idx);
    }else{
      $(el).html('<img src="/images/play1.png" class="iw_16">')
    }
  }
  
  $('.more_back').hide();
  function open_more(idx){
    let more_ele = $(idx).siblings(".more_ele");
    close_more();
    more_ele.toggleClass("open");
    $('.more_back').show();
  }

  function close_more(){
    $('.more_ele').removeClass("open");
    $('.more_back').hide();

  }


  //리스트 업다운 순서 변경
  (function(){
    const doms = document.getElementsByClassName('dom');
    for(let dom of doms){
      dom.addEventListener('click', on_click_dom);
    }
  })();
  function on_click_dom(e){
    e = e || window.event;
    const target = e.target;
    switch(target.tagName){
      case "INPUT" :
        add_on_li(target);
        break;
      case "BUTTON" :
        set_up_down(target);
        break;
      default :
        break;
    }
  }

  function add_on_li(target){
    if(!target){return;}
    $("#checkAll2").change( function() {
      if($(this).is(":checked")){
        $('.order_change_ul >li').addClass('on')
      }else{
        $('.order_change_ul >li').removeClass('on')
      }
    });
    const parent = target.closest('li');
    parent.classList.toggle('on');
  }
  function set_up_down(target){
    let liON = []; 
    let ii;
    //선택된 li가 없으면 early return
    const this_ul = $('.order_change_ul');
    const all_li = $('.order_change_ul>li');
    for(i=0;i<all_li.length;i++){
      if(all_li.eq(i).hasClass('on')){
        ii = all_li.eq(i).index();
        liON.push(ii);
      }
      
    }
    if(!liON){return};
    //선택된 li의 index를 가져온다.
    const idx = liON;
    //const idx = get_li_idx(all_li,liON);
    //복사한 li
    const copyLI = copy_li_on(liON);

    //선택한 버튼에 따라 복사하고
    const final_idx = apply_li_on(target,idx,all_li,copyLI);

    //원본은 지운다
    delete_original(final_idx,liON,this_ul);

    //li.on 다시 붙임
    add_on_li(all_li[final_idx]);

  } 

  function get_li_idx(all_li,liON){
      const li_idx = Array.prototype.indexOf.call(all_li, liON);
      return li_idx;
  }
  
  function copy_li_on(liON){
    const copyLI = document.createElement('LI');
    let arr =[];
    for(var i = 0; i< liON.length; i++){
      arr = liON.splice(0,liON.length);
      //console.log(arr);
      //return arr;
    }
    console.log(arr+"?"+liON.innerHTML);
    copyLI.innerHTML = liON.innerHTML;
    return copyLI;    
  }
  
  function apply_li_on(target,idx,all_li,copyLI){
      if(target.classList.contains('up')){
          const final_idx = idx - 1;
          if(final_idx < 0){return;}
          all_li[final_idx].before(copyLI);
          return final_idx;
      }else{
          const final_idx = idx + 1;
          if(final_idx >= all_li.length){return;}
          all_li[final_idx].after(copyLI);
          return final_idx;
      }
  }
  
  function delete_original(final_idx,liON,this_ul){
      if(final_idx == undefined || final_idx == null){return;}
      all_li.removeChild(liON);
      //console.log(delete_original);
  }

</script>