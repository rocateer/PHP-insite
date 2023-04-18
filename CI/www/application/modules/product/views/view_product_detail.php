<div class="body">
  <div class="inner_wrap">
    <p class="path"><a href="/">HOME</a>
      <span>&gt;</span><a href="/product?category_b=<?=$result->product_b_category_idx?>&category_m=<?=$result->product_m_category_idx?>"><?=$result->product_b_category_name?></a>
      <span>&gt;</span><a href="/product?category_b=<?=$result->product_b_category_idx?>&category_m=<?=$result->product_m_category_idx?>&category_s=<?=$result->product_s_category_idx?>"><?=$result->product_m_category_name?></a>
      <?php if($result->product_s_category_idx){?><span>&gt;</span><?=$result->product_s_category_name?><?php }?>
    </p>

    <!-- product_con_wrap : s -->
    <div class="product_con_wrap">

      <!-- product_top : s -->
      <div class="product_top">

        <!-- gallery_wrap : s -->
        <div class="gallery_wrap">
          <div class="swiper-container gallery-top">
            <ul class="swiper-wrapper">
              <?php foreach($product_img_list as $row){?>
              <li class="swiper-slide" style="background-image:url('<?=$row->product_img_path?>')"></li>
              <?php }?>

            </ul>
            <div class="swiper-button-next swiper-button-white"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
          </div>
          <div class="swiper-container gallery-thumbs">
            <ul class="swiper-wrapper">
              <?php foreach($product_img_list as $row){?>
              <li class="swiper-slide"  style="background-image:url('<?=$row->product_img_path?>')"><span></span></li>
              <?php }?>
              <!-- <li class="swiper-slide"  style="background-image:url(/images/product_sample_1.png)"><span></span></li>
              <li class="swiper-slide"  style="background-image:url(/images/product_sample_3.png)"><span></span></li>
              <li class="swiper-slide"  style="background-image:url(/images/product_sample_4.png)"><span></span></li>
              <li class="swiper-slide"  style="background-image:url(/images/product_sample_1.png)"><span></span></li>
              <li class="swiper-slide"  style="background-image:url(/images/product_sample_2.png)"><span></span></li>
              <li class="swiper-slide"  style="background-image:url(/images/product_sample_3.png)"><span></span></li> -->
            </ul>
          </div>
        </div>
        <!-- gallery_wrap : e -->
      </div>
      <!-- product_top : e -->

      <?php
      $product_halin_letter ="";
      if($result->product_st_price>0){
        $product_halin_letter = "[".number_format(($result->product_st_price-$result->product_price)/$result->product_st_price*100)." % ]";
      }

      $delivery_price_letter ="무료";
      if($result->product_delivery>0){
        $delivery_price_letter =  number_format($result->product_delivery) ." 원";
      }

			$option_count =count($product_option_list);

      ?>

      <!-- option_area_wrap : s -->
      <div class="option_area_wrap">
        <div class="product_info">
          <h2><?=$result->product_name?></h2>
          <table>
            <tr>
              <th>판매가</th>
              <td><?=number_format($result->product_st_price)?>원</td>
            </tr>
            <tr>
              <th>할인판매가</th>
              <td><?=number_format($result->product_price)?>원 <?=$product_halin_letter?></td>
            </tr>
            <tr>
              <th>배송비</th>
              <td><?=$delivery_price_letter?></td>
            </tr>
            <tr>
              <th>원산지</th>
              <td><?=$result->product_origin?></td>
            </tr>
            <tr>
              <th>재고수량</th>
              <td><?=$result->stock_amount?></td>
            </tr>
						<?php if($option_count<1){?>
						 <tr>
              <th>수량</th>
              <td><input name="product_ea" id="product_ea" type="text" value="1"></td>
            </tr>
						<?php }?>
          </table>
        </div>
        <form name="form_default" id="form_default" method="POST">
        <?php if($option_count>0){?>
				<div class="option_area">
          <strong>옵션선택</strong>
          <div class="select_option">
            <?php
            
            $i=1;
            foreach($product_option_list as $row){
            $temp = explode(",",$row->option_select);
            ?>
            <select name="opt_<?=$i?>" id="opt_<?=$i?>" <?php if($option_count ==$i){?> onChange="cart_option_reg_in();" <?php }?>>
              <option value=""><?=$row->product_option_name?> 선택</option>
              <?php
              for($j=0;$j<count($temp);$j++){
                $temp_opt = explode("^",$temp[$j]);
              ?>
              <option value="<?=$row->product_option_idx?>^<?=$row->product_option_name?>^<?=$temp[$j]?>"><?=$row->product_option_name?>:<?=$temp_opt[0]?>(<?=number_format($temp_opt[1])?> 원)</option>
              <?php }?>
            </select>
            <?php
             $i++;
             }
             ?>

          </div>
          <ul class="selected_options" id="option_list_ajax">

          </ul>
        </div>
				<?php }?>
        <input name="product_idx" id="product_idx" type="hidden" value="<?=$result->product_idx?>">
        <input name="product_code" id="product_code" type="hidden" value="<?=$result->product_code?>">
        <input name="cart_session_id" id="cart_session_id" type="hidden" value="<?=$cart_session_id?>">
        <input name="product_price" id="product_price" type="hidden" value="<?=$result->product_price?>">
        <input name="option_count" id="option_count" type="hidden" value="<?=$option_count?>">
        
        <?php if($option_count<2){?>
        <input name="opt_2" id="opt_2" type="hidden" value="">
        <?php }?>
        </form>
        <div class="option_bottom">
          <div class="order_sum">
            <span>주문금액</span>
            <span><strong id="product_total_price"><?=number_format($result->product_price)?></strong> 원</span>
          </div>
          <div class="btn_wrap">
            <span class="btn_m btn_basic"><a href="javascript:void(0)"  onClick="do_direct_order()">바로구매</a></span>
            <span class="btn_m btn_line"><a href="javascript:void(0)" onClick="do_cart()">장바구니</a></span>
            <span class="btn_m btn_line btn_like"><a href="javascript:void(0)" onclick="toggle_like(this)"><?=number_format($result->product_like_cnt)?></a></span>
          </div>
        </div>
      </div>
      <!-- option_area_wrap : e -->

      <!-- product_tab : s -->
      <div class="product_tab">
        <ul>
          <li><a class="active" href="#product_description">상품설명</a></li>
          <li><a href="#product_review">상품후기</a></li>
          <li><a href="#product_qa">Q&amp;A</a></li>
          <li><a href="#product_etc">배송/교환/환불</a></li>
        </ul>
      </div>
      <!-- product_tab : e -->

      <!-- product_tab_con : s -->
      <div class="product_tab_con">

        <!-- product_description : s -->
        <div class="product_description" id="product_description">
          <?=$result->product_contents?>
        </div>
        <!-- product_description : e -->

        <!-- product_review : s -->
        <div class="product_review" id="product_review">
          <h3>상품후기</h3>
          <div class="reg_btn_wrap">
            <span><?=number_format($result->product_reivew_cnt)?>개의 리뷰가 있습니다.</span>
          </div>

          <ul class="review_list">
        		<li>
              <div class="review_con_wrap">
                <p>
                  <span class="rating_view">
        						<i class="fa fa-star on"></i><i class="fa fa-star on"></i><i class="fa fa-star on"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        					</span>
        					<strong>개발왕</strong>
        					<span class="date">2018.05.24</span>
        				</p>
          			<p class="review_con" onclick="modal_review_open()">
                  아직 다른 소품들을 못 맞춰서 어색하지만 1인 소파와 보조 스툴 모두 만족하고 있어요!! 배송 기사님께서도 엄청친절하셨구 제품 자체가 너무 만족스러워요.. 이 가격에 이런 소파를 사다니 진짜 행복해요ㅠㅠ되게 단단한 폭신함이에요 푹신푹신 구름같은데 쿠션감이 튼튼해서 쉽게 볼륨이 죽거나 꺼질 것 같지않아요!! 세상에!! 1인소파랑 보조스툴 같이 사용하니 베드도 되고 좋아요 진짜 왕추천!
          			</p>
              </div>
              <a class="img_wrap" href="javascript:void(0)" onclick="modal_review_open()">
                <img src="/images/product_sample_4.png" alt="">
              </a>
        		</li>
            <li>
              <div class="review_con_wrap">
                <p>
                  <span class="rating_view">
          					<i class="fa fa-star on"></i><i class="fa fa-star on"></i><i class="fa fa-star on"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        					</span>
        					<strong>개발왕</strong>
        					<span class="date">2018.05.24</span>
        				</p>
                <p class="review_con" onclick="modal_review_open()">
                  생각보다 소파가 넓구, 폭신해서 좋아요💛남편이랑 같이앉아두 되는 사이즈ㅋㅋㅋ나무 받침있어서 소파밑 청소하기도 편하구 옮기는것두 편해용😍
                </p>
              </div>
              <a class="img_wrap" href="javascript:void(0)" onclick="modal_review_open()">
                <img src="/images/product_sample_3.png" alt="">
              </a>
        		</li>
            <li>
              <div class="review_con_wrap">
                <p>
                  <span class="rating_view">
        						<i class="fa fa-star on"></i><i class="fa fa-star on"></i><i class="fa fa-star on"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
        					</span>
        					<strong>개발왕</strong>
        					<span class="date">2018.05.24</span>
        				</p>
                <p class="review_con" onclick="modal_review_open()">
                  배송도 빠르고 기사님도 친절해서 아주 만족스럽습니다! 생각보다 크다고 해서 마음먹었는데도 크더라구요.ㅎㅎ 그게 더 좋은것도 같고.
                </p>
              </div>
              <a class="img_wrap" href="javascript:void(0)" onclick="modal_review_open()">
                <img src="/images/product_sample_2.png" alt="">
              </a>
        		</li>
        	</ul>

          <!-- paging : s -->
          <div class="paging">
            <ul>
              <li class="prev">
					 			<a href="javascript:page_go(1);"><img src="/images/icon_double_prev.png" alt=""></a>
              </li>
              <li class="prev">
                <a href="javascript:void(0)"><img src="/images/icon_prev.png" alt=""></a>
							</li>
							<li>
                <a class="on" href="javascript:void(0)">1</a>
              </li>
              <li>
                <a href="javascript:void(0)">2</a>
              </li>
              <li>
                <a href="javascript:void(0)">3</a>
              </li>
              <li>
                <a href="javascript:void(0)">4</a>
              </li>
              <li>
                <a href="javascript:void(0)">5</a>
              </li>
              <li class="next">
					 			<a href="javascript:void(0)"><img src="/images/icon_next.png" alt=""></a>
              </li>
              <li class="next">
                <a href="javascript:page_go(1);"><img src="/images/icon_double_next.png" alt=""></a>
					 		</li>
						</ul>
          </div>
          <!-- paging : e -->
        </div>
        <!-- product_review : e -->

        <!-- product_qa : s -->
        <div class="product_qa" id="product_qa">
          <h3>Q&amp;A</h3>
          <div class="reg_btn_wrap">
            <span><?=number_format($result->product_qa_cnt)?>개의 문의가 있습니다.</span>
            <span class="btn_form"><a href="javascript:void(0)" onclick="modal_qa_reg_open()">문의하기</a></span>
          </div>
        	<ul class="qa_list accordion mt20">
        		<li>
        			<div class="qa_top">
        				<p>[상품문의] <strong>rocateer</strong><span>2018.05.24</span></p>
        				<strong>답변완료</strong>
        			</div>
        			<div class="trigger">
        				<div class="question_wrap">
        					<span class="qa_mark">Q</span>
        					<p>
        						로캣티어 한가지 사이즈 밖에 없던데 작은 사이즈는 품절인가요?
        					</p>
        				</div>
        			</div>
        			<div class="panel">
        				<div class="answer_wrap">
        					<span class="qa_mark">A</span>
        					<p>안녕하세요. 로캣티어입니다. 고객님께 유선으로 안내드렸습니다. 불편을 드려 죄송합니다. 감사합니다. 안녕하세요. 로캣티어입니다. 고객님께 유선으로 안내드렸습니다. 불편을 드려 죄송합니다. 감사합니다.</p>
        				</div>
        			</div>
        		</li>
        		<li>
        			<div class="qa_top">
        				<p>[배송문의] <strong>rocateer</strong><span>2018.05.24</span></p>
        				<strong>답변완료</strong>
        			</div>
        			<div class="trigger">
        				<div class="question_wrap">
        					<span class="qa_mark">Q</span>
        					<p>
        						로캣티어 한가지 사이즈 밖에 없던데 작은 사이즈는 품절인가요?
        					</p>
        				</div>
        			</div>
        			<div class="panel">
        				<div class="answer_wrap">
        					<span class="qa_mark">A</span>
        					<p>안녕하세요. 로캣티어입니다. 고객님께 유선으로 안내드렸습니다. 불편을 드려 죄송합니다. 감사합니다. 안녕하세요. 로캣티어입니다. 고객님께 유선으로 안내드렸습니다. 불편을 드려 죄송합니다. 감사합니다.</p>
        				</div>
        			</div>
        		</li>
        	</ul>

          <!-- paging : s -->
          <div class="paging">
            <ul>
              <li class="prev">
					 			<a href="javascript:page_go(1);"><img src="/images/icon_double_prev.png" alt=""></a>
              </li>
              <li class="prev">
                <a href="javascript:void(0)"><img src="/images/icon_prev.png" alt=""></a>
							</li>
							<li>
                <a class="on" href="javascript:void(0)">1</a>
              </li>
              <li>
                <a href="javascript:void(0)">2</a>
              </li>
              <li>
                <a href="javascript:void(0)">3</a>
              </li>
              <li>
                <a href="javascript:void(0)">4</a>
              </li>
              <li>
                <a href="javascript:void(0)">5</a>
              </li>
              <li class="next">
					 			<a href="javascript:void(0)"><img src="/images/icon_next.png" alt=""></a>
              </li>
              <li class="next">
                <a href="javascript:page_go(1);"><img src="/images/icon_double_next.png" alt=""></a>
					 		</li>
						</ul>
          </div>
          <!-- paging : e -->
        </div>
        <!-- product_qa : e -->

        <!-- product_etc : s -->
        <div class="product_etc" id="product_etc">
          <h3>배송/교환/환불</h3>
          <div class="inner_wrap">
        		<h4>반품/교환 사유에 따른 요청 가능 기간</h4>
        		<p>반품 시 먼저 판매자와 연락하셔서 반품사유, 택배사, 배송비, 반품지 주소 등을 협의하신 후 반품상품을 발송해 주시기 바랍니다.</p>
        		<p class="fs_12 font_gray_6">1 구매자 단순 변심은 상품 수령 후 7일 이내 (구매자 반품배송비 부담)<br> 2 표시/광고와 상이, 상품하자의 경우 상품 수령 후 3개월 이내 혹은 표시/광고와 다른 사실을 안 날로부터 30일 이내. 둘 중 하나 경과 시 반품/교환 불가 (판매자 반품배송비 부담)</p>

        		<h4>반품/교환 불가능 사유</h4>
        		<p>아래와 같은 경우 반품/교환이 불가능합니다.</p>
        		<p class="fs_12 font_gray_6">1 반품요청기간이 지난 경우<br> 2 구매자의 책임 있는 사유로 상품 등이 멸실 또는 훼손된 경우 (단, 상품의 내용을 확인하기 위하여 포장을 훼손한 경우는 제외)<br> 3 포장을 개봉하였으나 포장이 훼손되어 상품가치가 현저히 상실된 경우 (예: 식품, 화장품)<br> 4 구매자의 사용 또는 일부 소비에 의하여 상품의 가치가 현저히 감소한 경우 (라벨이 떨어진 의류 또는 태그가 떨어진 명품관 상품인 경우)<br> 5 시간의 경과에 의하여 재판매가 곤란할 정도로 상품 등의 가치가 현저히 감소한 경우 (예: 식품, 화장품)<br> 6 고객주문 확인 후 상품제작에 들어가는 주문제작상품<br> 7 복제가 가능한 상품 등의 포장을 훼손한 경우 (CD/DVD/GAME/도서의 경우 포장 개봉 시)</p>
        	</div>
        </div>
        <!-- product_etc : e -->

      </div>
      <!-- product_tab_con : e -->

    </div>
    <!-- product_con_wrap : e -->

  </div>
</div>

<!-- 문의하기 : s -->
<div class="modal modal_qa_reg v_center" onclick="modal_qa_reg_close()">
	<div class="md_content" onclick="event.stopPropagation();">
    <h1>상품 질문하기</h1>
    <div>
      <h2>문의유형</h2>
      <select>
        <option>상품</option>
      </select>
    </div>
    <div>
      <h2>내용</h2>
      <textarea name="name"></textarea>
    </div>
    <div class="btn_wrap">
      <span class="btn_m btn_basic"><a href="#">등록하기</a></span>
      <span class="btn_m btn_line"><a href="#">취소하기</a></span>
    </div>
    <a class="btn_close" href="javascript:void(0)" onclick="modal_qa_reg_close()"><img src="/images/btn_close.png" alt="닫기"></a>
	</div>
</div>
<!-- 문의하기 : e -->

<!-- 리뷰상세 : s -->
<div class="modal modal_review" onclick="modal_review_close()">
	<div class="md_content" onclick="event.stopPropagation();">
    <div class="top_product_info">
      <h3 class="text_over">[보니애가구 ] 타미 1인 패브릭소파 3colors</h3>
      <span class="text_over">색상-스모키핑크</span>
    </div>
    <div class="review_rating">
      <strong>개발왕</strong><span>2018.05.24</span>
      <span class="rating_view">
        <i class="fa fa-star on"></i><i class="fa fa-star on"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
      </span>
    </div>
    <p class="mt30">
      아직 다른 소품들을 못 맞춰서 어색하지만 1인 소파와 보조 스툴 모두 만족하고 있어요!! 배송 기사님께
      서도 엄청 친절하셨구 제품 자체가 너무 만족스러워요.. 이 가격에 이런 소파를 사다니 진짜 행복해요
      ㅠㅠ되게 단단한 폭신함이에요 푹신푹신 구름같은데 쿠션감이 튼튼해서 쉽게 볼륨이 죽거나 꺼질 것
      같지않아요!! 세상에!! 1인소파랑 보조스툴 같이 사용하니 베드도 되고 좋아요 진짜 왕추천!
    </p>
    <div class="review_galley_wrap">
      <div class="swiper-container review_galley">
        <ul class="swiper-wrapper">
          <li class="swiper-slide" style="background-image:url(/images/product_sample_2.png)"></li>
          <li class="swiper-slide" style="background-image:url(/images/product_sample_1.png)"></li>
          <li class="swiper-slide" style="background-image:url(/images/product_sample_3.png)"></li>
          <li class="swiper-slide" style="background-image:url(/images/product_sample_4.png)"></li>
          <li class="swiper-slide" style="background-image:url(/images/product_sample_1.png)"></li>
          <li class="swiper-slide" style="background-image:url(/images/product_sample_2.png)"></li>
          <li class="swiper-slide" style="background-image:url(/images/product_sample_3.png)"></li>
        </ul>
      </div>
      <div class="swiper-button-next swiper-button-black"></div>
      <div class="swiper-button-prev swiper-button-black"></div>
    </div>

    <a class="btn_close" href="javascript:void(0)" onclick="modal_review_close()"><img src="/images/btn_close.png" alt="닫기"></a>
	</div>


</div>
<!-- 리뷰상세 : e -->

<script>
////////////////////////////////////////옵션
function cart_option_reg_in(){
  var product_idx=$('#product_idx').val();
  var cart_session_id=$('#cart_session_id').val();
  var option_count=$('#option_count').val();
  var opt_1=$('#opt_1').val();
  var opt_2=$('#opt_2').val();
  var product_price=$('#product_price').val();
  $.ajax({
      url: "/product/cart_option_reg_in",
      type: 'POST',
      dataType: 'json',
      async: false,
      data: {
        "product_idx" : product_idx,
        "product_price" : product_price,
        "cart_session_id" : cart_session_id,
        "option_count" : option_count,
        "opt_1" : opt_1,
        "opt_2" : opt_2
      },
      beforeSend:default_validate,
      success: function(result){
        if(result.code ==-1){
          //alert('수정에 실패 하였습니다.');
        }else{
          //alert('등록 되었습니다.');
          cart_option_list_get();
        }
      }
    });
}

var default_validate = function(){
  opt_count = $('#option_count').val();
  if(opt_count >0){
    if($('#opt_1').val()==""){
      alert("옵션을 선택 해주세요.");
      $('#opt_1').focus();
      return false;
    }
  }

  if(opt_count ==2){
    if($('#opt_2').val()==""){
      alert("옵션을 선택 해주세요.");
      $('#opt_2').focus();
      return false;
    }
  }
}

//list_get
function cart_option_list_get(){

  var product_idx=$('#product_idx').val();
  var cart_session_id=$('#cart_session_id').val();

  $.ajax({
    url      : "/product/cart_option_list_get",
    type     : "POST",
    dataType : "html",
    async    : true,
    data     : {
             "product_idx":product_idx,
             "cart_session_id": cart_session_id
    },
    success  : function(result) {
      $('#option_list_ajax').html(result);
    }
  });
}

//option_mod_up
function cart_option_mod_up(cart_idx,cart_ea){

  var cart_session_id=$('#cart_session_id').val();

  $.ajax({
    url      : "/product/cart_option_mod_up",
    type     : "POST",
    dataType : "json",
    async    : true,
    data     : {
             "cart_session_id":cart_session_id,
             "cart_idx":cart_idx,
             "cart_ea": cart_ea
    },
    success  : function(result) {

      cart_option_list_get();
    }
  });
}

//option_del
function cart_option_del(cart_idx){

var cart_session_id=$('#cart_session_id').val();
  $.ajax({
    url      : "/product/cart_option_del",
    type     : "POST",
    dataType : "json",
    async    : true,
    data     : {
			"cart_session_id":cart_session_id,
       "cart_idx":cart_idx
    },
    success  : function(result) {

      cart_option_list_get();
    }
  });
}


////////////////////////////////////////qa작성
////////////////////////////////////////상품좋아요

//option_del
function do_direct_order(){
	var cart_session_id=$('#cart_session_id').val();
  var option_count=$('#option_count').val();
  var product_ea=$('#product_ea').val();
  var product_idx=$('#product_idx').val();
	var product_price=$('#product_price').val();

	$.ajax({
		url      : "/cart/cart_reg_in",
		type     : "POST",
		dataType : "json",
		async    : true,
		data     : {
      "cart_type":"1",
			"cart_session_id":cart_session_id,
			"product_idx":product_idx,
			"product_ea":product_ea,
			"product_price":product_price,
			"option_count":option_count
		},
    beforeSend:default_validate,
		success  : function(result) {
     if(result.code =="-1"){
			 alert(result.msg);
		 }else{
		 <?php if($this->member_idx>0){?>
			 form_default.action ="/order/direct_order";
		   form_default.submit();
		 <?php }else{?>
			 location.href="/login?cart_type=1&return_url=/order/direct_order&cart_session_id="+cart_session_id;
		 <?php }?>
		 }
		}
	});

}

//cart_reg_in
function do_cart(){
	var cart_session_id=$('#cart_session_id').val();
  var option_count=$('#option_count').val();
  var product_ea=$('#product_ea').val();
  var product_idx=$('#product_idx').val();
	var product_price=$('#product_price').val();

	$.ajax({
		url      : "/cart/cart_reg_in",
		type     : "POST",
		dataType : "json",
		async    : true,
		data     : {
			"cart_type":"0",
			"cart_session_id":cart_session_id,
			"product_idx":product_idx,
			"product_ea":product_ea,
 			"product_price":product_price,
			"option_count":option_count
		},
    beforeSend:default_validate,
		success  : function(result) {
     if(result.code =="-1"){
			 alert(result.msg);
		 }else{
		 <?php if($this->member_idx>0){?>
			 location.href="/cart";
		 <?php }else{?>
			 location.href="/login?cart_type=0&return_url=/cart&cart_session_id="+cart_session_id;
		 <?php }?>
		 }
		}
	});

}
</script>
<script>

  //이미지 갤러리
  var galleryThumbs = new Swiper('.gallery-thumbs', {
      spaceBetween: 13.3,
      slidesPerView: 7,
      watchSlidesVisibility: true,
      watchSlidesProgress: true,
      allowTouchMove : false,
    });
  var galleryTop = new Swiper('.gallery-top', {
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      thumbs: {
        swiper: galleryThumbs
      }
    });


  //QA 문의 모달 open
  function modal_qa_reg_open(){
    $(".modal_qa_reg").css("visibility", "visible").animate({opacity: 1}, 100);
  }

  //QA 문의 모달 close
  function modal_qa_reg_close(){
    $(".modal_qa_reg").css("visibility", "hidden").animate({opacity: 0}, 100);
  }

  //리뷰 상세 모달 open
  function modal_review_open(){
    $(".modal_review").css("visibility", "visible").animate({opacity: 1}, 100);
  }

  //리뷰 상세 모달 close
  function modal_review_close(){
    $(".modal_review").css("visibility", "hidden").animate({opacity: 0}, 100);
  }

  //리뷰 상세 모달 안의 갤러리
  var review_galley = new Swiper('.review_galley', {
      loop: true,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    });


  $(document).ready(function(){

    //스크롤 거리별 tab, option 선택영역 위치
    var initial_distance = $(".product_top").offset().top;
  	var tab_distance = $(".product_tab").offset().top;

  	$(window).on("scroll", function(){

  		var scroll_distance = $(window).scrollTop();

  		if(initial_distance <= scroll_distance){
        $(".option_area_wrap").addClass("fix");
  		} else {
        $(".option_area_wrap").removeClass("fix");
  		}

      if(tab_distance <= scroll_distance){
  			$(".product_tab").addClass("fix");
  		} else {
  			$(".product_tab").removeClass("fix");
  		}

      var foot_distance = $(document).outerHeight() - $("footer").outerHeight();
      var full_height = $(window).scrollTop() + $(window).height();

      if(foot_distance <= full_height) {
  			$(".option_area_wrap").addClass("bottom");
  		} else {
        $(".option_area_wrap").removeClass("bottom");
      }
  	});


    //해당 섹션으로 스크롤, 메뉴 active
    var section_arr = ['#product_description', '#product_review', '#product_qa', '#product_etc'];
    var section_distance = [];
    var fix_height = 61; //상단 고정영역 높이값

    for (var i = 0; i < section_arr.length; i++) {
      section_distance.push(eval("$(" + "section_arr[i]" + ").offset().top"));
    }

		$(window).on('scroll', function(){
			var scroll = $(window).scrollTop() + fix_height;

      $('.product_tab a').removeClass('active');

			for(var i = 0; i < section_arr.length; i++){

        var section_end = section_distance[i] + $(section_arr[i]).outerHeight();

				if(i == 0){ //첫번째 섹션
					 if (scroll >= 0 && scroll < section_end) {
	  				 $('.product_tab a').eq(i).addClass('active');
	  			 }
        } else {
          if (scroll >= section_distance[i] && scroll < section_end) {
           $('.product_tab a').eq(i).addClass('active');
          }
        }
	 		}
	 	});

    //스크롤 애니메이션
    $('.product_tab a').click(function( event ) {
      event.preventDefault();
      $("html, body").animate({ scrollTop: $($(this).attr("href")).offset().top - 61 }, 300);
    });
  });

  // 수량변경
  function order_num_set(element, type,cart_idx){
    var wrap = $(element).closest(".order_num_control");
    var order_num_input = wrap.find("input");
    var order_num = Number(order_num_input.val());
    if (type == "plus"){
      order_num_input.val(order_num + 1);
    } else if (type == "minus") {
      if(order_num > 1){
        order_num_input.val(order_num - 1);
      } else {
        alert("주문 개수는 1개이상이어야 합니다.");
        return;
      }
    } else {
      if(order_num < 1){
        alert("주문 개수는 1개이상이어야 합니다.");
        order_num_input.val(1);
        return;
      }
    }
    cart_option_mod_up(cart_idx,order_num_input.val());
  }

  // 좋아요 토글버튼
  function toggle_like(element){
    var like_value = Number($(element).text());
    if($(element).hasClass("on")){
      $(element).removeClass("on");
      $(element).text(like_value - 1);
    } else {
      $(element).addClass("on");
      $(element).text(like_value + 1);
    }
  }

  //업로드된 사진 preview
  $(document).on("change", ".upload", function(e){
    var upload_box = $(this).siblings(".preview_box");
    var upload_btn = upload_box.find(".btn_img_upload");

    var limit_num = 8;

    if (upload_box.find(".preview").length == limit_num) {
      alert("파일은 " + limit_num + "개까지 등록 가능합니다.");
      return false;
    }

    var files = e.target.files,
      filesLength = files.length;
    for (var i = 0; i < filesLength; i++) {
      var target_file = files[i];
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("<span class='preview' style='background-image: url(" + e.target.result + ")'>" +
          "<img class='btn_delete' onclick='delete_img(this)' src='/images/btn_delete.png' alt='삭제'>" +
          "</span>").appendTo(upload_box);
        upload_btn.before(upload_btn.siblings(".preview"));
      });
      fileReader.readAsDataURL(target_file);
    }
  });

  //업로드된 사진 삭제
  function delete_img(element) {
    var parent_img = $(element).parent(".preview");
    if(confirm("삭제하시겠습니까?") == true){
      parent_img.remove();
      parent_img.find(".btn_img_upload").before(parent_img);
    }
  }
</script>
