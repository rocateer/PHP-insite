<div class="body">
  <div class="inner_wrap">
    <p class="path"><a href="/">HOME</a>
      <span>&gt;</span><a href="/product?category_b=<?=$category_b?>&category_m=<?=$category_m?>"><?=$get_location->category_b_name?></a>
      <span>&gt;</span><a href="/product?category_b=<?=$category_b?>&category_m=<?=$category_m?>&category_s=<?=$category_s?>"><?=$get_location->category_m_name?></a>
      <?php if($category_s){?><span>&gt;</span><?=$get_location->category_s_name?><?php }?>
    </p>

    <div class="clearfix">
      <!-- left_menu : s -->
      <div class="left_menu">
        <h1><?=$get_location->category_b_name?></h1>
        <ul>
          <?php
          foreach($product_m_category_list as $row){
          ?>
          <li><a  <?php if(!empty($category_m)&&$category_m==$row->category_management_idx){?> class="active" <?php }?>  href="/product?category_b=<?=$category_b?>&category_m=<?=$row->category_management_idx?>"><?=$row->category_name?></a></li>
          <?php }?>
          <!-- <li><a class="active" href="#">소파/거실가구</a></li>
          <li><a href="#">침실가구</a></li>
          <li><a href="#">주방가구</a></li>
          <li><a href="#">수납가구</a></li>
          <li><a href="#">학생/서재가구</a></li>
          <li><a href="#">의자/스툴</a></li>
          <li><a href="#">테이블</a></li>
          <li><a href="#">유아동가구</a></li> -->
        </ul>
      </div>
      <!-- left_menu : e -->

      <!-- right_con : s -->
      <div class="right_con">
        <!-- top_menu : s -->
        <div class="top_menu">
          <h2><?=$get_location->category_m_name?></h2>
          <ul>
            <?php
            foreach($product_s_category_list as $row){
            ?>
            <li><a <?php if(!empty($category_s)&&$category_s==$row->category_management_idx){?> class="active" <?php }?>  href="/product?category_b=<?=$category_b?>&category_m=<?=$category_m?>&category_s=<?=$row->category_management_idx?>" ><?=$row->category_name?></a></li>
            <?php }?>
            <!-- <li><a href="#">빈백소파</a></li>
            <li><a href="#">소파스툴</a></li>
            <li><a href="#">패브릭소파</a></li>
            <li><a href="#">좌식소파</a></li>
            <li><a href="#">거실장/TV장</a></li>
            <li><a href="#">리클라이너소파</a></li>
            <li><a href="#">소파베드</a></li>
            <li><a href="#">거실/소파 테이블</a></li> -->
          </ul>
        </div>
        <!-- top_menu : e -->

        <div class="sort_menu">
          <a class="active" hhref="javascript:void(0)" onClick="set_orderby('')">전체 <img src="/images/icon_arrow_bt.png" alt=""></a>
          <a href="javascript:void(0)" onClick="set_orderby('1')" >신상품순 <img src="/images/icon_arrow_bt.png" alt=""></a>
          <a href="javascript:void(0)" onClick="set_orderby('2')">인기상품순 <img src="/images/icon_arrow_bt.png" alt=""></a>
          <a href="javascript:void(0)" onClick="set_orderby('3')">낮은가격순 <img src="/images/icon_arrow_bt.png" alt=""></a>
          <a href="javascript:void(0)" onClick="set_orderby('4')">높은가격순 <img src="/images/icon_arrow_bt.png" alt=""></a>
        </div>

        <!-- product_list : s -->
        <div id="list_ajax">

        </div>
      </div>
      <!-- right_con : e -->
    </div>
  </div>
</div>
 <input name="category_b" id="category_b" type="hidden" value="<?=$category_b?>">
 <input name="category_m" id="category_m" type="hidden" value="<?=$category_m?>">
 <input name="category_s" id="category_s" type="hidden" value="<?=$category_s?>">
 <input name="orderby" id="orderby" type="hidden" value="">
 <input name="page_num" id="page_num" type="hidden" value="1">
<script>

  $(function(){
    default_list_get();
  });

  //list_get
  function default_list_get(){

    var page_num = $('#page_num').val();
    var category_b = $('#category_b').val();
    var category_m = $('#category_m').val();
    var category_s = $('#category_s').val();
    var orderby = $('#orderby').val();

    $.ajax({
      url      : "/product/product_list_get",
      type     : "POST",
      dataType : "html",
      async    : true,
      data     : {
               "page_num":page_num,
               "category_b": category_b,
               "category_m": category_m,
               "category_s": category_s,
               "orderby": orderby
      },
      success  : function(result) {
        $('#list_ajax').html(result);
      }
    });
  }

  //페이지 이동
  var page_go=function(page){
    $('#page_num').val(page);
  	$(default_list());
  }

  //orderby
  var set_orderby = function(st) {
   $('#orderby').val(st);
   $(default_list());
  }



</script>
