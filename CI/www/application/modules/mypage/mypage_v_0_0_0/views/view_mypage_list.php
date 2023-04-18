
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
    <div class="tab_mypage">
      <ul class="tab_toggle_menu clearfix">
        <li class="active">
          <a href="#1">
            <h4>플레이리스트</h4>
            <div class="box">
              <p class="title">플레이리스트</p>
              <p class="num arrow">42</p>
            </div>
          </a>
        </li>
        <li>
          <a href="#2">
            <h4>이용권</h4>
            <div class="box">
              <p class="title">이용권 잔여일</p>
              <p class="num">7일</p>
              <div class="bubble_date">21.12.03 ~ 22.01.10</div>
            </div>
            <p class="history">구매내역 <img src="/images/arrow_right2.png" alt=">"></p>
          </a>
        </li>
        <li>
          <a href="#2">
            <h4>선물함</h4>
            <div class="box">
              <p class="title">받은 선물함</p>
              <p class="arrow num">54곡</p>
            </div>
          </a>
        </li>
      </ul>
      <div class="tab_area_wrap">
        <!-- 탭 영역 1 : s -->
        <div class="">
          <h4 class="mt60">전체 42</h4>
          <div class="row">
            <span class="btn_m f_left mr12 btn_gray">
              <a href="javascript:void(0)" onclick="modal_open('add_playlist')"><img src="/images/play_4.png"> 새로 만들기</a>
            </span>
          </div>
          <div class="no_data">
            <p>등록된 플레이리스트가 없습니다.</p>
          </div>
          <div class="row">
            <ul class="dots_ul mb20 f_right">
              <li>
                <input type="radio" name="rdo_2" id="rdo_2_1" checked="">
                <label for="rdo_2_1">등록순</label>
              </li>
              <li>
                <input type="radio" name="rdo_2" id="rdo_2_2">
                <label for="rdo_2_2">등록순</label>
              </li>
            </ul>
          </div>
          <ul class="newest_ul full">
            <? for($i=0;$i<12;$i++){?>
            <li>
              <div class="album_wrap hide">
                <a href="/<?=mapping('mypage')?>/mypage_playlist_detail">
                  <div class="img_box">
                    <img src="/p_images/s1.jpg" alt="">
                  </div>
                </a>
                <img src="/images/play2.png" alt="play" class="btn_play" onclick="modal_open('repurchase')">
              </div>
              <div class="album_info">
                <a href="/<?=mapping('mypage')?>/mypage_playlist_detail">
                  <p class="text_overflow">AAIVLE School Episode 1AIVLE School Episode 1IVLE School Episode 1</p>
                  <div class="fs_14 font_gray_8">14곡</div>
                  <div class="row">
                  <p class="album_info mt10">정규 9집 ‘Music of the Spheres’ 공개를 앞두고 있는 밴드 콜드플레이. 이들은 올해 우주를 컨셉으로 한 신비로운 아트웍과 짜릿한 선공개곡 ‘Higher Power’를 공개해 여전히 건재함을 알렸는데요. 그런 그들이 이번에는 방탄소년단 그런 그들이 이번에는 방탄소년단 그런 그들이 이번에는 방탄소년단그런 그들이 이번에는 방탄소년단</p>
                  </div>
                </a>
                <div class="wish_btn mt10 mb20">
                  <a class="" href="javascript:void(0)" onclick="wish_btn(this)"></a>
                  21
                </div>
              </div>
            </li>
            <? }?>
          </ul>
        </div>
        <!-- 탭 영역 1 : e -->
        <!-- 탭 영역 2 : s -->
        <div class="">
          <ul class="order_ul mt30">
            <li>
              <table>
                <colgroup>
                  <col width="*">
                  <col width="200px">
                  <col width="200px">
                  <col width="150px">
                </colgroup>
                <tr>
                  <th>7일 이용권</th>
                  <td>2021.03.10 20:45</td>
                  <td>이용권 구매</td>
                  <td>10 P</td>
                </tr>
              </table>

            </li>
            <li>
              <table>
                <colgroup>
                  <col width="*">
                  <col width="200px">
                  <col width="200px">
                  <col width="150px">
                </colgroup>
                <tr>
                  <th>7일 이용권</th>
                  <td>2021.03.10 20:45</td>
                  <td>이용권 구매</td>
                  <td>10 P</td>
                </tr>
              </table>

            </li>
            <li>
              <table>
                <colgroup>
                  <col width="*">
                  <col width="200px">
                  <col width="200px">
                  <col width="150px">
                </colgroup>
                <tr>
                  <th>7일 이용권</th>
                  <td>2021.03.10 20:45</td>
                  <td>이용권 구매</td>
                  <td>10 P</td>
                </tr>
              </table>

            </li>
          </ul>
          <!-- paging : s -->
          <div class="paging_wrap">
            <div class="paging">
              <ul class="btn_wrap">
                <li class="btn_prev">
                  <a href="#1">
                    <img src="/images/i_double_prev.png" alt="">
                  </a>
                </li>
                <li class="btn_prev">
                  <a class="no_next" href="#1">
                    <img src="/images/i_prev.png" alt="">
                  </a>
                </li>
                <li class="active"><a href="">1</a></li>
                <li>
                  <a href="javascript:default_list_get(2);">2</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(3);">3</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(4);">4</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(5);">5</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(6);">6</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(7);">7</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(8);">8</a>
                </li>
                <li class="btn_next">
                  <a class="no_next" href="#1">
                    <img src="/images/i_next.png" alt="">
                  </a>
                </li>
                <li class="btn_next">
                  <a href="javascript:default_list_get(2);">
                    <img src="/images/i_double_next.png" alt="">
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- 탭 영역 2 : e -->
        <!-- 탭 영역 3 : s -->
        <div class="">
          <ul class="chart_ul mt30">
            <table class="tbl_0 tbl_4">
              <colgroup>
                <col width="*">
                <col width="200px">
                <col width="120px">
                <col width="60px">
              </colgroup>
              <tr>
                <th></th>
                <th>받은 일시</th>
                <td>잔여</td>
                <th></th>
              </tr>
            </table>
            <? for($i = 1; $i<=10; $i++){?>
            <li>
              <table class="mypage tbl_0 tbl_2">
                <colgroup>
                  <col width="64px">
                  <col width="*">
                  <col width="200px">
                  <col width="200px">
                  <col width="120px">
                  <col width="60px">
                </colgroup>
                <tr>
                  <th>
                    <div class="img_box">
                      <img src="/p_images/s2.jpg" alt="">
                    </div>
                  </th>
                  <th>
                    
                    <div class="title">Counting Stars (Feat. BeenzCounting Stars (Feat. BeenzCounting Stars (Feat. Beenz</div>
                  </th>
                  <th>
                    <div class="font_gray_8">BE'O (비오)</div>
                  </th>
                  <th>
                  2021.03.10 20:45
                  </th>
                  <td>
                  10회
                  </td>
                  <th>
                    <a href="javascript:void(0)"><img src="/images/play1.png" class="iw_16"></a>
                  </th>
                </tr>
              </table>
            </li>
            <? }?>

          </ul>
            <!-- paging : s -->
          <div class="paging_wrap">
            <div class="paging">
              <ul class="btn_wrap">
                <li class="btn_prev">
                  <a href="#1">
                    <img src="/images/i_double_prev.png" alt="">
                  </a>
                </li>
                <li class="btn_prev">
                  <a class="no_next" href="#1">
                    <img src="/images/i_prev.png" alt="">
                  </a>
                </li>
                <li class="active"><a href="">1</a></li>
                <li>
                  <a href="javascript:default_list_get(2);">2</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(3);">3</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(4);">4</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(5);">5</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(6);">6</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(7);">7</a>
                </li>
                <li>
                  <a href="javascript:default_list_get(8);">8</a>
                </li>
                <li class="btn_next">
                  <a class="no_next" href="#1">
                    <img src="/images/i_next.png" alt="">
                  </a>
                </li>
                <li class="btn_next">
                  <a href="javascript:default_list_get(2);">
                    <img src="/images/i_double_next.png" alt="">
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- 탭 영역 3 : e -->
      </div>
    </div>
    
  </div>
</div>
<div class="more_back" onclick="close_more()"></div>

<script>
  $(function(){
  var link = document.location.href;
  var tab = link.split('#').pop(); 
  var tab_hash = '#'+tab;
  var hash = $(".tab_toggle_menu > li a[href='"+tab_hash+"']").selector;
  
  $(hash).addClass('active'); 
  var exit = 0;

  $(".tab_toggle_menu > li").each(function(){
    var idx = $(this).index();
    if($(this).find("a").hasClass('active')){
      // active클래스가 존재하면
      $('.tab_toggle_menu > li').eq(idx).children('a').addClass('active');
      $('.tab_area_wrap > div').hide();
      $('.tab_area_wrap > div').eq(idx).show();
    }
    exit = exit+1;
    if(exit == idx){
      return false;
    }
  });
  if(!$(this).find("a").hasClass('active')){
    // #이 붙어있지 않으면.
    $('.tab_toggle_menu > li').children('a').removeClass('active');
    $('.tab_area_wrap > div').hide();
    $('.tab_toggle_menu > li').eq(0).children('a').addClass('active');
    $('.tab_area_wrap > div').eq(0).show();
  };

  $('.tab_toggle_menu > li a').click(function(){
    $('.tab_toggle_menu > li a').removeClass('active');
    $(this).addClass('active');
    var list = $(this).parent('li').index();  
    $(".tab_area_wrap > div").hide();
    $(".tab_area_wrap > div").eq(list).show();
  })
})

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
</script>