<style>
  .ui-state-highlight { height: 3em; line-height: 1.2em; }
</style>

  <!-- container-fluid : s -->
  <div class="container-fluid " >
    <!-- Page Heading -->
    <div class="page-header">
      <h1>
      <?=($cate_type==0)?'프로그램 카테고리 관리':'이브의 고민 카테고리 관리'?>
      </h1>
      <span style="font-size:14px; color:#333; float:right; padding-top:10px;">
      </span>
    </div>
    <form id="form_default" name="form_default" method="post">
      <!-- body : s -->
      <input type="hidden" name ="select_depth" id="select_depth" value="">
      <input type="hidden" name ="cate_type" id="cate_type" value="<?=$cate_type?>">
      <input type="hidden" name ="select_category_management_idx_1" id="select_category_management_idx_1">
      <input type="hidden" name ="select_category_management_idx_2" id="select_category_management_idx_2">
      <input type="hidden" name ="select_category_management_idx_3" id="select_category_management_idx_3">
      <input type="hidden" name ="select_category_management_idx_4" id="select_category_management_idx_4">

      <div class="bg_wh mt20" style="width:50%">
        <div class="table-responsive">

          <div class="row category_col">
            <div class="col-md-12">
              <!-- <p style="height:5px"></p> -->

              <ul class="category sortable" style="height:700px;width:100%;margin-bottom:50px;" >
              <?php
                $i = 0;
                foreach($first_cate_list as $row){
                $img_path = ($row->img_path)? $row->img_path :"/images/btn_del.gif";
               ?>
                <li style='height:70px;' <?php if($i==0){ echo 'class="active"'; } ?> >
                  <? if($cate_type==0){?>
                    <? if (!empty($row->img_path)) {?>
                      <img src='<?=$img_path?>' style='width:60px; height:50px;' id='img_<?=$row->category_management_idx?>' onClick="img_change('<?=$row->category_management_idx?>')">
                    <?}else {?>
                      <a href="javascript:void(0)" onClick="img_change('<?=$row->category_management_idx?>')" class="btn-sm btn-gray" style='width:60px;'>이미지</a>
                    <?}?>
                  <?}?>
                  <input type="text" id="category_name_<?=$row->category_management_idx?>" value="<?=$row->category_name?>" readonly style="margin-top:10px;">
                  
                  <input type="hidden" class="category_management_idx" name="first_cate_list_idx[]" value="<?=$row->category_management_idx?>">
                  <span class="category_btn" style="width:200px; margin-top:10px;">
                    <?php if($row->state == 1) {?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">블라인드</a>
                    <?php } else { ?>
                      <a href="javascript:void(0)" class="btn-sm btn-info">블라인드해제</a>
                    <?php } ?>

                    <a href="javascript:void(0)" class="btn-sm btn-default">수정</a>
                    <a href="javascript:void(0)" class="btn-sm btn-danger">삭제</a>
                  </span>
                </li>
                <?php
                  $i++;
                }
              ?>
              </ul>

              <input type="text" name="category_name" class="form-control add_item_val_1" style="width:80%;float:left;" placeholder="카테고리명">
              <a href="#" class="btn btn-success" onclick="category_management_reg_in(0)" > 추가</a>

            </div>

          </div>

        </div>
      </div>
    </form>
  </div>
  <!-- container-fluid : e -->
<script>

  //리스트 클릭 노출
  $(document).on("click",".category li",function(){
    // 선택된 인증 마크 표시
    $(this).siblings("li").removeClass("active");
    $(this).addClass("active");

    // 클릭한 인증 마크의 뎁스

    var category_depth = $(".category").index($(this).parent()) + 1;
    req_category_depth = category_depth +1;
    var category_management_idx = null;
    category_management_idx = $(this).find('input[type="text"]').attr('id');
    $("#select_category_management_idx_"+category_depth).val(category_management_idx);
    $("#select_depth").val(category_depth-1);

    if(category_depth > 0){

      if(category_depth == 1){
        $(".category").eq(1).html("");
        $(".category").eq(2).html("");
        $(".category").eq(3).html("");
      }else if(category_depth == 2){
        $(".category").eq(2).html("");
        $(".category").eq(3).html("");
      }else if(category_depth == 3){
        $(".category").eq(3).html("");
      }

      category_management_list(category_management_idx, category_depth,req_category_depth);
    }
  });

  //삭제, 수정 기능
  $(document).on("click",".category_btn a",function(){
    var $item = $(this).parents("li");
    var category_depth = $('.category').index($item.parent()) + 1;
    var category_management_idx = $item.find('.category_management_idx').val();

		if($(this).hasClass("btn-danger")){ //삭제버튼
			var result = confirm("삭제하시겠습니까?");
			if(result){
				category_management_del(category_management_idx);
				if($item.hasClass('active')){
					if(category_depth == 1){
						$(".category").eq(1).html("");
						$(".category").eq(2).html("");
						$(".category").eq(3).html("");
					}else if(category_depth == 2){
						$(".category").eq(2).html("");
						$(".category").eq(3).html("");
          }else if(category_depth == 3){
						$(".category").eq(3).html("");
					}
				}
				$item.remove();
			}
    } else if($(this).hasClass("btn-info")){ // 노출안함
      var result = confirm("상태를 변경하시겠습니까?");
			if(result){
        var category_depth = $('.category').index($item.parent()) + 1;
        var state = "";
        var rt = "";

        if($(this).text()=='블라인드'){
          state ='1';
          $(this).text("블라인드해제");
        }else{
          state ='0';
          $(this).text("블라인드");
        }
        $.ajax({
          url: "/<?=mapping('category_management')?>/category_state_up",
          type: "POST",
          dataType: "json",
          async: false,
          data: {
            'category_management_idx': category_management_idx,
            'category_depth': category_depth,
            'state': state

          },
          success: function(result) {
            if(result.code == '1'){
              rt ="1";
            }else{
              alert(result.msg);
              rt ="0";
            }
          },
          error: function(request,status,error){
            alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
          }
        });

        if(rt =="0"){
          if($(this).text()=='블라인드'){
            $(this).text("블라인드해제");
          }else{
            $(this).text("블라인드");
          }
        }


			}
    } else {
      if($(this).hasClass("btn-confirm")){ //수정 후 확인버튼
				var result = confirm("수정된 내용을 저장 하시겠습니까?");
				if(result){
					$item.find("input").attr("readonly",true)
					$(this).text("수정").removeClass("btn-confirm");

					var category_name = $("#category_name_"+category_management_idx).val();
					var url_str = $("#url_"+category_management_idx).val();

					category_management_mod_up(category_management_idx, category_name, url_str);
				}
      } else { //수정 버튼
        $item.find("input").attr("readonly",false).focus();
        $(this).text("확인").addClass("btn-confirm");
      }
    }
  });

// 인증 마크 리스트 가져오기
  function category_management_list(parent_category_management_idx, category_depth,req_category_depth){
    var cate_type = 	$("#cate_type").val();

    $.ajax({
  		url: "/<?=mapping('category_management')?>/category_management_list",
  		type: "post",
  		data : {parent_category_management_idx: parent_category_management_idx,category_depth: req_category_depth,cate_type: cate_type},
  		dataType: 'json',
  		async: true,
  		success: function(result){
        if(result.category_management_list){
          for(var i=0; i<result.category_management_list.length; i++){
            var category_management_idx = result.category_management_list[i].category_management_idx;
            var category_name = result.category_management_list[i].category_name;
            var url_str = result.category_management_list[i].url;
            var parent_category_management_idx = result.category_management_list[i].parent_category_management_idx;
            var state = result.category_management_list[i].state;
            var img_path = result.category_management_list[i].img_path;
            add_item(category_management_idx, category_name, url_str, category_depth + 1, parent_category_management_idx,state,img_path);
          }
        }
  		}
  	});
  }

  // 분류 추가 기능
  function category_management_reg_in(order){
    var target_list = $(".category").eq(order);
    var category_name = $(".add_item_val_1").eq(order).val();
    var url_str = $(".add_item_val_2").eq(order).val();
    var category_depth = order + 1;
    var parent_category_management_idx = $("#select_category_management_idx_"+order).val();
    var select_depth = $("#select_depth").val();
    var cate_type = 	$("#cate_type").val();

    if(category_name == ""){
      alert("분류명을 입력해주세요.");
      return;
    }

    if(category_depth != 1 && !parent_category_management_idx){
      alert("상위 인증 마크를 선택한 후 등록해주세요.");
      return;
    }

    $.ajax({
      url: "/<?=mapping('category_management')?>/category_management_reg_in",
      type: "POST",
      dataType: "json",
      async: true,
      data: {
        "category_depth": category_depth,
        "parent_category_management_idx": parent_category_management_idx,
        "cate_type": cate_type,
        "category_name": category_name,
        "url": url_str
      },
      success: function(result) {
        if(result.code == 1){
          var category_management_idx = result.category_management_idx;
          add_item(category_management_idx, category_name, url_str, category_depth,'','1','');
          $(".add_item_val_1").eq(order).val("");
          $(".add_item_val_2").eq(order).val("");
					// alert("카테고리 추가되었습니다.");
          location.reload();
        }else{
          alert(result.msg);
        }
      },
      error: function(request,status,error){
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }
    });
  }

// 상품 인증 마크 삭제
  function category_management_del(category_management_idx){
    var cate_type = 	$("#cate_type").val();

    $.ajax({
      url: "/<?=mapping('category_management')?>/category_management_del",
      type: "POST",
      dataType: "json",
      async: true,
      data: {
        "category_management_idx": category_management_idx,
        "cate_type": cate_type
      },
      success: function(result) {
           // -1:유효성 검사 실패
           if(result.code == '-1'){
          alert(result.msg);
          location.reload();
          return;
        }
        // 0:실패 1:성공
        if(result.code == 0) {
          alert(result.msg);
          location.reload();
        } else if(result.code == 1) {
          alert(result.msg);
          location.reload();
        }
      },
      error: function(request,status,error){
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }
    });
  }

// 상품 인증 마크 수정
  function category_management_mod_up(category_management_idx, category_name, url_str){
    $.ajax({
      url: "/<?=mapping('category_management')?>/category_management_mod_up",
      type: "POST",
      dataType: "json",
      async: true,
      data: {
        category_management_idx: category_management_idx,
        category_name: category_name,
        url: url_str,
      },
      success: function(result) {
        console.log(result);
      },
      error: function(request,status,error){
        alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
      }
    });
  }

  // 카테고리 화면에서 추가
  function add_item(category_management_idx, category_name, url_str, category_depth,parent_category_management_idx,state,img_path){

    var cate_list_idx="";
    var cate_img_path="";
    if(category_depth==1){
      if(img_path !=""){
        cate_img_path = "<img src='"+img_path+"' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }else{
        cate_img_path = "<a href='javascript:void(0)' onClick=\"img_change('"+ category_management_idx +"')\"  style='width:60px;'>이미지</a>";
        // cate_img_path = "<img src='/images/btn_del.gif' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }
      cate_list_idx = "<input type='hidden' class='category_management_idx' name='first_cate_list_idx[]' value='" + category_management_idx + "'>";
    }else  if(category_depth == 2){
      if(img_path !=""){
        cate_img_path = "<img src='"+img_path+"' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }else{
        cate_img_path = "<a href='javascript:void(0)' onClick=\"img_change('"+ category_management_idx +"')\"  style='width:60px;'>이미지</a>";
        // cate_img_path = "<img src='/images/btn_del.gif' style='width:15px;' id='img_"+category_management_idx+"'  onClick=img_change('"+category_management_idx+"')>";
      }
      cate_list_idx = " <input type='hidden' id='category_management_idx' name='second_cate_list_idx[]' value='" + category_management_idx + "'>";
    }else if(category_depth ==3){
      cate_list_idx = " <input type='hidden' id='category_management_idx' name='third_cate_list_idx[]' value='" + category_management_idx + "'>";
    }else if(category_depth ==4){
      cate_list_idx = " <input type='hidden' id='category_management_idx' name='fourth_cate_list_idx[]' value='" + category_management_idx + "'>";
    }

    var category_state ="";

		if( state == 0){
			category_state = "<a href='javascript:void(0)' class='btn-sm btn-info'>블라인드해제</a> ";
		} else {
			category_state = "<a href='javascript:void(0)' class='btn-sm btn-info'>블라인드</a> ";
		}

		var $item = $("<li>" +
									 cate_img_path +
									"<input type='text' name='name' id='category_name_" + category_management_idx + "'value='" + category_name + "' readonly style='width:30%; margin-left:50px;' >" +
                  // "<input type='text' id='url_" + category_management_idx + "' value='" + url_str + "' readonly style='width:300px' >" +
									cate_list_idx +
									" <input type='hidden' name='parent_category_management_idx' id='" + category_management_idx + " value='" + parent_category_management_idx + "'>" +
									" <span class='category_btn'>" +
									category_state +
									"   <a href='#' class='btn-sm btn-default'>수정</a>" +
									// "   <a href='#' class='btn-sm btn-danger'>삭제</a>" +
									" </span>" +
									"</li>");

    $('.category').eq(category_depth - 1).append($item);
  }

  var category_order_set = function (){

    $.ajax({
      url: "/<?=mapping('category_management')?>/category_order_set",
      type: "POST",
      dataType: "json",
      async: true,
      data: $("#form_default").serialize(),
      success: function(result) {
        if(result.code == 0){
          alert(result.msg);
        }
      }

    });
  }

  //이미지 팝업
  function img_change(category_management_idx){
    openWin = window.open("/<?=mapping('category_management')?>/img_change?category_management_idx="+category_management_idx,"CLIENT_WINDOW", "width=500, height=350, resizable = no, scrollbars = no");
    openWin.focus();
  }

  //이미지 세팅
  function img_set(category_management_idx,img_path){
    $("#img_"+category_management_idx).attr("src", img_path);
  }

  $( function() {
    $( ".sortable" ).sortable({
      placeholder: "ui-state-highlight",
      axis: "y",
      update: function() {
          $("#select_depth").val($(this).index('.sortable'));
          category_order_set();

      }

    });
    $( ".sortable" ).disableSelection();
  } );
</script>
