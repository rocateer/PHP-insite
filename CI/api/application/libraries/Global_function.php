<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-01-12
|------------------------------------------------------------------------
*/

Class Global_function {

	// URL / Email에 대해 자동링크(A태그로 변경)
	function alink($data){

		// https
		$data = preg_replace("/https:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"https://\\1\" target='_blank'>https://\\1</a>", $data);
		// http
		$data = preg_replace("/http:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"http://\\1\" target='_blank'>http://\\1</a>", $data);
		// ftp
		$data = preg_replace("/ftp:\/\/([0-9a-z-.\/@~?&=_]+)/i", "<a href=\"ftp://\\1\" target='_blank'>ftp://\\1</a>", $data);
		// email
		$data = preg_replace("/([_0-9a-z-]+(\.[_0-9a-z-]+)*)@([0-9a-z-]+(\.[0-9a-z-]+)*)/i", "<a href=\"mailto:\\1@\\3\">\\1@\\3</a>", $data);

		return $data;
	}

	// Ymd <br> his
	function Ymd_br_his($date){
		if($date != ""){
			$explode_date = explode(' ', $date);
			$str = $explode_date[0].'<br>'.$explode_date[1];
		}else{
			$str = '-';
		}

		return $str;
	}

	// alert 띄우고 url로 이동 (string, string)
	function alert($str, $url=""){
		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		if(!empty($url)) $script .= "location.href='" . $url . "';";
		$script .= "</script>";

		echo $script;
		return;
	}

	// alert 띄우고 창 닫기 (string)
	function alert_close($str){
		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		$script .= "self.close();";
		$script .= "</script>";

		echo $script;
		return;
	}

	// YYYY.mm.dd 포맷으로 출력 (datetime)
	function date_Ymd_comma($str_date){
		$date = date("Y.m.d", strtotime($str_date ));

		return $date;
	}

	// YYYY.mm.dd HH:ii 포맷으로 출력 (datetime)
	function date_YmdHi_comma($str_date){
		$date = date("Y.m.d H:i", strtotime($str_date));

		return $date;
	}

	// YYYY-mm-dd 포맷으로 출력 (datetime)
	function date_Ymd_hyphen($str_date){
		$date = date("Y-m-d", strtotime($str_date));

		return $date;
	}

	// YYYY-mm-dd HH:ii 포맷으로 출력 (datetime)
	function date_YmdHi_hyphen($str_date){
		$date = date("Y-m-d H:i", strtotime($str_date));

		return $date;
	}

// 기본 페이징 출력
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
			$page_html.="<div class='paging'>";

			if($block>1){
				$page_html.="
					 <span class='prev'>
					 <a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href=javascript:".$fn."($prev);> <i class='fa fa-angle-left'></i> </a>
					 </span>
				";
			}else{
				$page_html.="
					 <span class='prev'>
					 <a href='javascript:".$fn."(1);'><i class='fa fa-angle-double-left'></i></a><a href='#'><i class='fa fa-angle-left'></i></a>
					 </span>
				";
			}

			for($go_page;$go_page<=$last_page;$go_page++){
				if($pageNum==$go_page)
					$page_html.="<a href=javascript:".$fn."($go_page);  class='on'>$go_page</a>";
				else
					$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";

			}

			if($block<$total_block){
				$page_html.="
					 <span class='next'>
					 <a href=javascript:".$fn."($next);> <i class='fa fa-angle-right'></i> </a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
					 </span>
					";
			}else{
				$page_html.="
					 <span class='next'>
					 <a href='#'><i class='fa fa-angle-right'></i></a><a href='javascript:".$fn."($total_page);'> <i class='fa fa-angle-double-right'></i> </a>
					 </span>
					";

			}
			$page_html.="</div>";
		}else{
			$page_html.="<div class='paging'></div>";
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

	// 엔터라인(\n)을 HTML br태그로 변환 (string)
	function text_enter($str) {
		$str = str_replace("\n", "<br/>", $str);

    return $str;
	}

	// 엔터라인 Trim (string)
	function text_enter_trim($str) {
		$arr = array("\r\n", "\r", "\n");
		$str = str_replace($arr, "", $str);

    return $str;
	}

	// 스페이스 Trim
	public function trim_str($str) {
		$str = str_replace(" ", "", $str);

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

	// datetime 형식을 날짜 형식으로 변경 YYYY-mm-dd
	function change_add_date($date){
		$date =str_replace("-","",$date);
		if($date){
			$rt =substr($date,0,4)."-".substr($date,4,2)."-".substr($date,6,2);
		}else{
			$rt ="";
		}

		return $rt;
	}

	//datetime 형식을 시간 형식으로 변경 h:m
	function change_add_hm($hm){
		$hs =str_replace(":","",$hm);
		if($hs){
			$rt =substr($hs,0,2).":".substr($hs,2,2);
		}else{
			$rt ="";
		}

		return $rt;
	}

//날짜 '-' 제거
	function change_strip_date($date){
		if($date){
			$rt =str_replace("-","",$date);
	  }else{
      $rt="";
		}

		return $rt;
	}

//시간 ':' 제거
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

	//주문번호생성하기
	function set_reserve_no($str,$length) {
		$characters  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rendom_str = "";
		$loopNum = $length;
		while ($loopNum--) {
			$rendom_str .= $characters[mt_rand(0, strlen($characters)-1)];
		}

		return $str.$rendom_str;
	}

	/*
	// 난수 발생 시키기 (string, int)
		$type -
			verify  : 휴대폰인증번호
			coupon : 쿠폰번호
			order : 주문번호
		$howlong -
			난수의 길이(int)
	*/
	function create_verify_num($type, $howlong){
		if($type == 'verify'){
			$characters = "0123456789";	// 발생시킬 문자 바운더리
		}else if($type == 'coupon'){
			$characters  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";	// 발생시킬 문자 바운더리
		}else if($type == 'order'){
			$characters  = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";	// 발생시킬 문자 바운더리
		}else{
			$characters  = "0123456789";	// 발생시킬 문자 바운더리
		}

		$rendom_str = "";
		$loopNum = $howlong;	// 자리수

		while ($loopNum--) {
			$rendom_str .= $characters[mt_rand(0, strlen($characters)-1)];
		}

		if($type == 'order'){
			$now_date = date("Ymd");
			$rendom_str = $now_date."-".$rendom_str;
		}

		return $rendom_str;
	}

  // 추천인 아이디 난수 발생시키기
	public function create_recommender_id(){
		$characters  = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rendom_str = "";
		$loopNum = 10;

		while ($loopNum--) {
			$tmp = mt_rand(0, strlen($characters)-1);
			$rendom_str .= substr($characters,$tmp,1);
		}

		return $rendom_str;
	}

  // 휴대폰 형식세팅
	function set_tel_num($str){
		if($str){
			$rt = substr($str,0,3)."-".substr($str,3,4)."-".substr($str,7,4);
		}else{
			$rt ="";
		}

		return $rt;
	}

	/*
	// 10년단위 나이를 연도로 치환 (int, int)
				x대 이상 ~ y대 이하
				이상일 경우 날짜는 1월 1일, 이하일 경우 12월 31일 세팅
		$age -
			10, 20, 30 ...
		$type -
			0 : ~대 이상
			1 : ~대 이하
	*/
	function age_to_yyyy($age, $type){
		if($age == '-1') {
			return '-1';
		}

		$yyyy = "";
		$str = "";

		switch($type){
			case 0 :
				$yyyy = date("Y") - $age + 1;
				$str .= $yyyy."-01-01 00:00:00";
				break;
			case 1 :
				$yyyy = date("Y") - $age - 8;
				$str .= $yyyy."-12-31 00:00:00";
				break;
		}

		$Ymd = date($str);

		return $Ymd;
	}

	// 10년단위 년도->나이대로 변환 (datetime)
	function yyyy_to_age($yyyy){
		if($yyyy == '-1') {

			return false;
		}

		$now = date("Y");
		$yyyy = explode('-', $yyyy);
		$temp = $now - $yyyy[0] + 1;
		$age = floor($temp / 10) * 10;

		return $age;
	}

	// Hyphen 기준 날짜를 한글 년월일로 치환 (datetime)
	function hyphen_to_str($date){
		$str = explode('-', $date);
		$rt = $str[0]."년  ".$str[1]."월  ".$str[2]."일";

		return $rt;
	}

	// 거리 km를 m로 변환
	function km_to_m($distance){
		$distance = round($distance*1000);

		return $distance;
	}

	// 나이를 연도로 변환 (int)
	function age_to_Ymd($age){
		$yyyy = date("Y") - $age + 1;
		$str = $yyyy."-01-01 00:00:00";
		$Ymd = date($str);;

		return $Ymd;
	}

	// 연도를 나이로 변환 (datetime)
	function Ymd_to_age($ymd) {

		$strTok = explode('-', $ymd);
		$yyyy = date('Y') - $strTok[0] + 1;

		return $yyyy;
	}

	// 핸드폰 번호 -> '-' 형식세팅 (string)
	function set_hyphen_telnum($str) {
		$tel_convert = preg_replace("/[^0-9]/", "", $str);  // 번호 hyphen 제거

		if($tel_convert){
			$rt = substr($tel_convert,0,3)."-".substr($tel_convert,3,4)."-".substr($tel_convert,7,4);
		}else{
			$rt ="";
		}

		return $rt;
	}

	// 핸드폰 번호 -> '-' 제외 배열 (string)
	function none_hyphen_telnum($str){
		/*
		$tel_num[0] = 전체
		$tel_num[1] = 지역번호or(010/011 ...)
		$tel_num[2] = 중간번호
		$tel_num[3] = 마지막번호
		*/
		preg_match('/\(?(?<Num1>\d{2,3})\)?-?\s*(?<Num2>\d{3,4})-?\s*(?<Num3>\d{4})/', $str, $tel_num);

		return $tel_num;
	}

	// 수수료계산 (int, float)
	function calculate_commission($price, $rate){
		$rate = $rate/100;
		$commission = round($price*$rate, -1);
		return $commission;
	}

	// 예상환급액 계산 (int, float)
	function expected_point($request_point, $rate){
		$rate = 1 - ($rate/100);
		$expected_point = round($request_point*$rate, -1);

		return $expected_point;
	}

	// 요율 퍼센티지 변환
	function decimal_to_percent($decimal){
		$rt = $decimal / 100;
		$rt .= '%';

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

	// 이미지 가로 사이즈 가져오기
	function get_images_width($url){
		if($url !=""){
			$result = getimagesize($url);
			return $result[0];
		}else{
			return 0;
		}
	}

	// 이미지 세로 사이즈 가져오기
	function get_images_height($url){
		if($url !=""){
			$result = getimagesize($url);
			return $result[1];
		}else{
			return 0;
		}
	}

	//정산 금액 계산
	function get_account_price($product_price){
		$rt=0;

		$account_payment_rate =$product_price*.034;
    $account_price =floor(($product_price -$account_payment_rate)*.7/100)*100;
		$rt =$account_price;

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
	
	//이미지 (,)를 배열로 가져오기
	function get_img_array($imgs){
		$x = 0;
		$data_array = array();
		if($imgs !=""){
			$img_arr =explode(",",$imgs);
			foreach($img_arr as $row){
				$data_array[$x]['img_path']	= $row;
				$x++;
			}
		}
		return $data_array;
	}
	
	// 문자별표표시
	function set_hidden_str($str) {
		$str_len = mb_strlen($str); 

		if($str_len<4){
			switch ($str_len) {			
				case '2' : $rt=mb_substr($str,0,1, 'utf-8')."*"; break;
				case '3' : $rt=mb_substr($str,0,1, 'utf-8')."**"; break;
				default : $rt=''; break;
			}
		}else{
			 $rt=mb_substr($str,0,1, 'utf-8')."**".mb_substr($str,3,($str_len-3), 'utf-8'); 
		}
		
		return $rt;

	}

}	// 클래스의 끝
?>
