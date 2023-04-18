<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-01-12
|------------------------------------------------------------------------
*/

Class Global_function {
	function _alert($str, $url="") {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		if(!empty($url)) $script .= "location.href='" . $url . "';";
		$script .= "</script>";

		echo $script;
		return;
	}

	function _alert_close($str) {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		$script .= "self.close();";
		$script .= "</script>";

		echo $script;
		return;
	}

	function dateYmdComma($str_date){
		$date = date("Y.m.d", strtotime( $str_date ) );
		return $date;
	}

	function dateYmdHyphen($str_date){
		$date = date("Y-m-d", strtotime( $str_date ) );
		return $date;
	}


	// function paging($totalCnt,$pageSize,$pageNum,$fn=""){
	//
	// 	$pagenumber=PAGENUMBER;
	//
	// 	$total_page=ceil($totalCnt/$pageSize);
	// 	$total_block=ceil($total_page/$pagenumber);
	//
	// 	if(($pageNum)% $pagenumber!=0){
	// 		$block=ceil(($pageNum+1)/$pagenumber);
	// 	}else{
	// 		$block=ceil(($pageNum+1)/$pagenumber)-1;
	// 	}
	// 	$first_page=($block-1)*$pagenumber;
	// 	$last_page=$block*$pagenumber;
	//
	// 	$prev=$first_page;
	// 	$next=$last_page+1;
	// 	$go_page=$first_page+1;
	//
	// 	if($fn==""){
	// 		$fn="page_go";
	// 	}
	//
	//
	//
	// 	if($total_block<=$block)
	// 		$last_page=$total_page;
	//
	// 	$page_html="";
	// 	if($totalCnt>0){
	// 		$page_html.="<div class='paging'>";
	//
	// 		if($block>1){
	// 			$page_html.="
	// 				 <span class='prev'>
	// 				 <a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href=javascript:".$fn."($prev);> <i class='fa fa-angle-left'></i> </a>
	// 				 </span>
	// 			";
	// 		}else{
	// 			$page_html.="
	// 				 <span class='prev'>
	// 				 <a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href='#'><i class='fa fa-angle-left'></i></a>
	// 				 </span>
	// 			";
	// 		}
	//
	// 		for($go_page;$go_page<=$last_page;$go_page++){
	// 			if($pageNum==$go_page)
	// 				$page_html.="<a href=javascript:".$fn."($go_page);  class='on'>$go_page</a>";
	// 			else
	// 				$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";
	//
	// 		}
	//
	// 		if($block<$total_block){
	// 			$page_html.="
	// 				 <span class='next'>
	// 				 <a href=javascript:".$fn."($next);> <i class='fa fa-angle-right'></i> </a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
	// 				 </span>
	// 				";
	// 		}else{
	// 			$page_html.="
	// 				 <span class='next'>
	// 				 <a href='#'><i class='fa fa-angle-right'></i></a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
	// 				 </span>
	// 				";
	//
	// 		}
	// 		$page_html.="</div>";
	// 	}else{
	// 		$page_html.="<div class='paging'></div>";
	// 	}
	//
	// 	return $page_html;
	//
	// }

function paging($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber=PAGENUMBER;

		$total_page=ceil($totalCnt/$pageSize);
		$total_block=ceil($total_page/$pagenumber);

		if(($pageNum)% $pagenumber!=0){
			$block=ceil(($pageNum+1)/$pagenumber);
		}else{
			$block=ceil(($pageNum+1)/$pagenumber)-1;
		}
		$first_page=($block-1)*$pagenumber;
		$last_page=$block*$pagenumber;

		$prev=$first_page;
		$next=$last_page+1;
		$go_page=$first_page+1;

		if($fn==""){
			$fn="page_go";
		}

		if($total_block<=$block)
			$last_page=$total_page;

		$page_html="";
		if($totalCnt>0){
			$page_html.="<div class='paging mt20'><ul class='btn_wrap'>";

			if($block>1){
				$page_html.="
					 <li class='prev'>
					 <a href=javascript:".$fn."(1);> <img src='/images/icon_double_prev.png' alt=''> </a>
					 </li>
					 <li class='prev'><a class='no_next' href=javascript:".$fn."($prev);>
					 <img src='/images/icon_double_prev.png' alt=''>
					 </li>
				";
			}else if($pageNum == "1"){
				$page_html.="
					 <li class='btn_prev'>
					 <a href='#".$pageNum."'> <img src='/images/icon_double_prev.png' alt=''></a>
					 </li>
					 <li class='btn_prev'><a class='no_next' href='#".$pageNum."'>
					 <img src='/images/icon_double_prev.png' alt=''></a>
					 </li>";
			}else{
				$page_html.="
					 <li class='btn_prev'>
					 <a href='javascript:".$fn."(1);'> <img src='/images/icon_double_prev.png' alt=''></a>
					 </li>
					 <li class='btn_prev'><a class='no_next' href='#".$pageNum."'>
					 <img src='/images/icon_double_prev.png' alt=''></a>
					 </li>";
			}

			for($go_page;$go_page<=$last_page;$go_page++){
				if($pageNum==$go_page)
					$page_html.="<li class='active'>$go_page</li>";
				else
					$page_html.="<li><a href=javascript:".$fn."($go_page);>$go_page</a></li>";

			}

			if($block<$total_block){
				$page_html.="
						<li class='btn_next'><a class='no_next' href=javascript:".$fn."($next);>
						<img src='/images/icon_next.png' alt=''></a>
						</li>
						<li class='btn_next'><a href='javascript:".$fn."($total_page);'>
						<img src='/images/icon_double_next.png' alt=''></a>
						</li>
				";
			}else if($total_page == $pageNum){
				$page_html.="
						<li class='btn_next'><a class='no_next' href='#".$pageNum."'>
						<img src='/images/icon_next.png' alt=''></a>
						</li>
						<li class='btn_next'><a href='#".$pageNum."'>
						<img src='/images/icon_double_next.png' alt=''></a>
						</li>";
			}else{
				$page_html.="
						<li class='btn_next'><a class='no_next' href='#".$pageNum."'>
						<img src='/images/icon_next.png' alt=''></a>
						</li>
						<li class='btn_next'><a href='javascript:".$fn."($total_page);'>
						<img src='/images/icon_double_next.png' alt=''></a>
						</li>";
			}
			$page_html.="</ul></div>";
		}

		return $page_html;

	}



	function paging1($totalCnt,$pageSize,$pageNum,$fn=""){

			$pagenumber=PAGENUMBER;

			$total_page=ceil($totalCnt/$pageSize);
			$total_block=ceil($total_page/$pagenumber);

			if(($pageNum)% $pagenumber!=0){
				$block=ceil(($pageNum+1)/$pagenumber);
			}else{
				$block=ceil(($pageNum+1)/$pagenumber)-1;
			}
			$first_page=($block-1)*$pagenumber;
			$last_page=$block*$pagenumber;

			$prev=$first_page;
			$next=$last_page+1;
			$go_page=$first_page+1;

			if($fn==""){
				$fn="page_go";
			}

			if($total_block<=$block)
				$last_page=$total_page;

			$page_html="";
			if($totalCnt>0){
				$page_html.="<div class='paging mt20'><ul class='btn_wrap'>";

				if($block>1){
					$page_html.="
						 <li class='btn_prev'>
						 <a href=javascript:".$fn."(1);> <i class='fa paging-double-left'></i> </a>
						 </li>
						 <li class='btn_prev'><a class='no_next' href=javascript:".$fn."($prev);>
						 <i class='fa paging-left'></i></a>
						 </li>
					";
				}else if($pageNum == "1"){
					$page_html.="
						 <li class='btn_prev'>
						 <a href='#".$pageNum."'> <i class='fa paging-double-left'></i></a>
						 </li>
						 <li class='btn_prev'><a class='no_next' href='#".$pageNum."'>
						 <i class='fa paging-left'></i></a>
						 </li>";
				}else{
					$page_html.="
						 <li class='btn_prev'>
						 <a href='javascript:".$fn."(1);'> <i class='fa paging-double-left'></i></a>
						 </li>
						 <li class='btn_prev'><a class='no_next' href='#".$pageNum."'>
						 <i class='fa paging-left'></i></a>
						 </li>";
				}

				for($go_page;$go_page<=$last_page;$go_page++){
					if($pageNum==$go_page)
						$page_html.="<li class='active'>$go_page</li>";
					else
						$page_html.="<li><a href=javascript:".$fn."($go_page);>$go_page</a></li>";

				}

				if($block<$total_block){
					$page_html.="
							<li class='btn_next'><a class='no_next' href=javascript:".$fn."($next);>
							<i class='fa paging-right'></i></a>
							</li>
							<li class='btn_next'><a href='javascript:".$fn."($total_page);'>
							<i class='fa paging-double-right'></i></a>
							</li>
					";
				}else if($total_page == $pageNum){
					$page_html.="
							<li class='btn_next'><a class='no_next' href='#".$pageNum."'>
							<i class='fa paging-right'></i></a>
							</li>
							<li class='btn_next'><a href='#".$pageNum."'>
							<i class='fa paging-double-right'></i></a>
							</li>";
				}else{
					$page_html.="
							<li class='btn_next'><a class='no_next' href='#".$pageNum."'>
							<i class='fa paging-right'></i></a>
							</li>
							<li class='btn_next'><a href='javascript:".$fn."($total_page);'>
							<i class='fa paging-double-right'></i></a>
							</li>";
				}
				$page_html.="</ul></div>";
			}

			return $page_html;

		}


	function paging2($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber=PAGENUMBER;

		$total_page=ceil($totalCnt/$pageSize);
		$total_block=ceil($total_page/$pagenumber);

		if(($pageNum)% $pagenumber!=0){
			$block=ceil(($pageNum+1)/$pagenumber);
		}else{
			$block=ceil(($pageNum+1)/$pagenumber)-1;
		}
		$first_page=($block-1)*$pagenumber;
		$last_page=$block*$pagenumber;

		$prev=$first_page;
		$next=$last_page+1;
		$go_page=$first_page+1;

		if($fn==""){
			$fn="page_go";
		}



		if($total_block<=$block)
			$last_page=$total_page;

		$page_html="";
		if($totalCnt>0){
			$page_html.="<div class='paging_area02'>";

			if($block>1){
				$page_html.="
					 <a href=javascript:".$fn."($prev); > <img src='/images/prev02.png' alt='이전' /> </a>
				";
			}else{
				$page_html.="
					 <a href='#".$pageNum."'> <img src='/images/prev02.png' alt='이전' /></a>
				";
			}

			for($go_page;$go_page<=$last_page;$go_page++){
				if($pageNum==$go_page)
					$page_html.="<a class='page_select'>$go_page</a>";
				else
					$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";

			}

			if($block<$total_block){
				$page_html.="
					 <a href=javascript:".$fn."($next); > <img src='/images/next02.png' alt='다음'/> </a> ";
			}else{
				$page_html.="
					 <a href='#".$pageNum."'> <img src='/images/next02.png' alt='다음'/></a>";
			}
			$page_html.="</div>";
		}

		return $page_html;

	}

	function read_clob($field){

		if(is_null($field)){
			return "";
		}else{
			return $field->read($field->size());
		}
	}

	function textEnter($str){
		$str=str_replace("\n","<br/>",$str);
        		return $str;
	}
	public function trimStr($str){
		$str=str_replace(" ","",$str);
		return $str;
	}

  //핸드폰 형식세팅
	function set_phone_number($str){

		if($str){
			$rt = substr($str,0,3)."-".substr($str,3,4)."-".substr($str,7,4);
		}else{
			$rt ="";
		}
		return $rt;
	}


	//날짜
	function change_add_date($date){
		$date =str_replace("-","",$date);
		if($date){
			$rt =substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
		}else{
			$rt ="";
		}
		return $rt;
	}

	//시간
	function change_add_hm($hm){
		$hs =str_replace(":","",$hm);
		if($hs){
			$rt =substr($hs,0,2).":".substr($hs,2,2);
		}else{
			$rt ="";
		}
		return $rt;
	}


	  //날짜
	function change_strip_date($date){
		if($date){
			$rt =str_replace("-","",$date);
	  }else{
      $rt="";
		}
		return $rt;
	}

	//시간
	function change_strip_hm($hm){
		if($hs){
			$rt =str_replace(":","",$hm);
		}else{
			$rt ="";
		}

		return $rt;
	}

	//전화번호 '-'기준으로 나누기
	function telnumNoneHypen($str){

		/*
		$tel_num[0] = 전체
		$tel_num[1] = 지역번호or(010/011 ...)
		$tel_num[2] = 중간번호
		$tel_num[3] = 마지막번호
		*/
		preg_match('/\(?(?<Num1>\d{2,3})\)?-?\s*(?<Num2>\d{3,4})-?\s*(?<Num3>\d{4})/', $str, $tel_num);
		return $tel_num;
	}

	// url에 http/https가 있으면 냅두고 없으면 url에 http/https 붙여서 반환
	function check_str_http($str) {

		$chk_http = stristr($str, "http");

		if($chk_http == false) {
			$str = "http://".$str;
			return $str;
		}else {
			return $str;
		}

	}

	// 여행기간(tour_term_type)값 #붙여서 한글변환
	function convert_tour_term_type($str) {

		$tour_term = "";

		switch($str) {
			case '1': $tour_term = "#1박2일"; break;
			case '2': $tour_term = "#2박3일"; break;
			case '3': $tour_term = "#3박4일"; break;
			case '4': $tour_term = "#4박5일"; break;
			case '5': $tour_term = "#기타"; break;
			default: $tour_term = "#당일치기"; break;
		}

		return $tour_term;
	}

	// 태그값 (,) 구분자로 나누어 #붙여서 출력
	function convert_tag_name($str) {

		$tag_name = explode(',', $str);

		for ($i=0; $i<count($tag_name); $i++) {
			$tag_name[$i] = "#".$tag_name[$i];
		}

		return $tag_name;
	}

//faq type 별 title 가져오기
	function get_faq_title($str){
    switch($str){
			case "1" : $rt ="회원관련" ; break;
			case "2" : $rt ="포인트관련" ; break;
			case "3" : $rt ="그 외" ; break;
			case "4" : $rt ="" ; break;
		}
    return $rt;
	}


	function get_order_state($str){

		switch ($str) {
			case '0' : $rt ='주문완료'; break;
			case '1' : $rt='입금완료'; break;
			case '2' : $rt='배송준비'; break;
			case '3' : $rt='배송보류'; break;
			case '4' : $rt='배송중'; break;
			case '5' : $rt='배송완료'; break;
			case '20' : $rt='주문취소신청'; break;
			case '21' : $rt='주문취소'; break;
			case '30' : $rt='주문환불신청'; break;
			case '31' : $rt='주문환불완료'; break;
			case '32' : $rt='주문환불불가'; break;
			case '40' : $rt='주문교환신청'; break;
			case '41' : $rt='주문교환완료'; break;
			case '42' : $rt='주문교환불가'; break;
			}
			return $rt;
	}

	// 텍스트를 바이트로 계산
	function str_to_byte($s){
		$s = iconv('UTF-8', 'EUC-KR', $s); // EUC-KR
	  $a = unpack('C*', $s);
	  $i = 0;
	  foreach ($a as $v) {
	    $h = strtoupper(dechex($v));
	    if (strlen($h)<2) $h = '0'.$h;
	    ++$i;
	  }
	  return $i;
	}

}// 클래스의 끝
?>
