<header>
    <a class="btn_left" href="/<?=mapping('mypage')?>"><img class="w100" src="/images/head_btn_close.png" alt="뒤로가기"></a>
    <h1>직종 인증</h1>
  </header>
  <!-- header : e -->
  <div class="body">
  <div class="inner_wrap">
    <form class="find_form">
      <div class="mt30">
        <h2>직종 인증 신청</h2>
        <span class="subtext mt10">
          내 직종을 인증하세요! <br>
          나와 같은 직종에서 일하는 사람들과 공유할 수 있어요.
        </span>
      </div>
      <ul class="input_ui row mt40">
        <li>
          <label>직종 선택<span class="essential">*</span></label>
          <span class="subtext">
            현재 일하고 계신 직종을 선택해 주세요. 기타 직종은 '일반'
          </span>
          <select class="mt10">
              <option value="">직종을 선택해주세요.</option>
            <?foreach($work_list as $row){?>
              <option value="<?=$row->work_idx?>"><?=$row->work_name?></option>
            <?}?>
          </select>
        </li>
        <li>
          <label class="">인증<span class="essential">*</span>
            <img src="/images/ic_info.png" alt="" class="btn" style="width: 15px;" onclick="modal_open('info')">
          </label>
          <span class="subtext">
            명함 또는 현장 사진을 첨부해 주세요.
          </span>
          <div class="x_scroll_img_reg mt5">
          <ul class="img_reg_ul">
            <li>
              <p class="cnt_num"><span>1</span>/2</p>
              <div class="img_box" onclick="api_request_file_upload('img','2');">
                <img src="/images/btn_photo.png" alt="">
              </div>
            </li>
            <li>
              <img src="/images/btn_sm_delete.png" alt="x" class="btn_delete">
              <div class="img_box">
                <img src="/media/commonfile/202304/25/5017636a1dcca7d903bcc859893d0754.jpg" alt="">
              </div>
            </li>
          </ul>
        </div>
        </li>
      </ul>
    </form>
    <div class="btn_space">
      <a href="javascript:void(0)" class="btn_point btn_full_basic" onclick="default_work()">직종 인증 신청</a>
    </div>
  </div>
  </div>

  <!--  modal : s -->
<div class="modal modal_full modal_info vh_wrap">
  <header>
    <a class="btn_left" href="#">
      <img class="w_100" src="/images/head_btn_close.png" onclick="modal_close('info')" alt="닫기">
    </a>
    <h1>인증 안내</h1>
    <!-- <span class="head_txt"><a href="#">등록</a></span> -->
  </header>
    <div class="body">
      <div id="edit" class="inner_wrap">
        <img src="/media/commonfile/202304/19/5d347021c1913f481ce7cf8051f98185.jpg" class="img_block mt20">
        <img src="/media/commonfile/202304/19/5d347021c1913f481ce7cf8051f98185.jpg" class="img_block mt20">
        <img src="/media/commonfile/202304/19/5d347021c1913f481ce7cf8051f98185.jpg" class="img_block mt20">
      </div>
    </div>
    

  
</div>
<!--  modal : e -->