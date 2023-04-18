<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2016-01-12
|------------------------------------------------------------------------
*/

Class Global_function {

	/**
	 * 델피콤 안심번호 api -> 번호등록
	 * API 		::	 https://api.050bizcall.co.kr/link/auto_mapp.do
	 * IID 		::	 plenwzvnaakenc936mzq 토큰개념인듯, 리사에만 사용
	 * rn  		::	 안심번호에 매칭시킬 실제 번호, 숫자로만 전달(ex.01093283101)
	 * memo		::	 메모(옵션)
	 * memo2	::	 메모2(옵션)
	 * auth 	::	 iid + rn 을 MD5 암호화 한후 Base64 인코딩
	 *
	 * rt			:: 		결과 0 -> 성공, 그외 실패사유 참고
	 * rs			:: 		실패시 사유
	 * vn			::		Virtual Number 가상번호
	 */
	function auto_mapp($phone){

		$url = "https://api.050bizcall.co.kr/link/auto_mapp.do";
		$iid = "plenwzvnaakenc936mzq";

		$data = array(
			'iid' => $iid,
			'rn' => $phone,
			'auth' => base64_encode(md5($iid.$phone))
		);

		$query = http_build_query($data, '', '&');

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $query,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded'
			),
		));

		$result = curl_exec($curl);

		curl_close($curl);

		$rt = json_decode($result); // Return the received data

		// * 주의 :: 델피콤 안심번호 api에선 true -> 0, false -> 1 입니다..!
		if (!empty($rt)) {
		 if($rt->rt == '0'){
			 return $rt->vn;
		 }else{
			 return '0';
		 }
	 }else {
		 return "0";
	 }
	}

	/**
	 * 델피콤 안심번호 api -> 자동해지 등록
	 * API 					::	 https://api.050bizcall.co.kr/link/auto_mapp.do
	 * IID 					::	 plenwzvnaakenc936mzq 토큰개념인듯, 리사에만 사용
	 * rn  					::	 안심번호에 매칭시킬 실제 번호, 숫자로만 전달(ex.01093283101)
	 * expire_hour	::	 해지 만료 시간
	 * auth 				::	 iid + rn 을 MD5 암호화 한후 Base64 인코딩
	 *
	 * rt						:: 		결과 0 -> 성공, 그외 실패사유 참고
	 * rs						:: 		실패시 사유
	 * vn						::		Virtual Number 가상번호
	 */
	function auto_expire_mapp($phone){

		$url = "https://api.050bizcall.co.kr/link/auto_expire_mapp.do";
		$iid = "plenwzvnaakenc936mzq";
		$expire_hour = 1; // 해지 만료 시간

		$data = array(
			'iid' => $iid,
			'rn' => $phone,
			'expire_hour' => $expire_hour,
			'auth' => base64_encode(md5($iid.$phone))
		);

		$query = http_build_query($data, '', '&');

		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $query,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded'
			),
		));

		$result = curl_exec($curl);

		curl_close($curl);

		$rt = json_decode($result); // Return the received data

		// * 주의 :: 델피콤 안심번호 api에선 true -> 0, false -> 1 입니다..!
		if (!empty($rt)) {
			if($rt->rt == '0'){
				return $expire_hour;
			}else{
				return '0';
			}
		}else {
			return "0";
		}

	}

	//경고창
	function alert($str, $url="") {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		if(!empty($url)) $script .= "location.href='" . $url . "';";
		$script .= "</script>";

		echo $script;
		return;
	}

	//경고창 후 닫기
	function alert_close($str) {

		header('Content-Type: text/html; charset=UTF-8');

		$script = "<script type=\"text/javascript\">";
		$script .= "alert('" . $str . "');";
		$script .= "self.close();";
		$script .= "</script>";

		echo $script;
		return;
	}

	function array_to_str($arr_data){
		$str="";
		if (!empty($arr_data)) {
			for ($i=0; $i < count($arr_data); $i++) {
				if ($i==0) {
					$str = $arr_data[$i];
				} else {
					$str = $str.",".$arr_data[$i];
				}
			}
		}
		return $str;
	}

	function date_Hi($str_date){
		$date = date("H:i", strtotime( $str_date ) );
		return $date;
	}

	function date_YmdHi_hyphen($str_date){
		$date = date("Y-m-d H:i", strtotime( $str_date ) );
		return $date;
	}

	function date_YmdHi_dot($str_date){
		$date = date("Y.m.d H:i", strtotime( $str_date ) );
		return $date;
	}

	function date_Ymd_hyphen($str_date){
		$date = date("Y-m-d", strtotime( $str_date ) );
		return $date;
	}

	function date_Ymd_dot($str_date){
		$date = date("Y.m.d", strtotime( $str_date ) );
		return $date;
	}


	// 시:분 하이픈
	function dateHi($str_date){
		$date = date("H:i", strtotime( $str_date ) );
		return $date;
	}



	// 년-월-일 시:분 하이픈
	function dateYmdHiHyphen($str_date){
		$date = date("Y-m-d H:i", strtotime( $str_date ) );
		return $date;
	}



	// 년.월.일 콤마
	function dateYmdComma($str_date){
		$date = date("Y.m.d", strtotime( $str_date ) );
		return $date;
	}

	// 년-월-일 하이픈
	function dateYmdHyphen($str_date){
		$date = date("Y-m-d", strtotime( $str_date ) );
		return $date;
	}

	//기본 페이징 디자인
	function paging($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber = PAGENUMBER;

		$total_page  = ceil($totalCnt/$pageSize);
		$total_block = ceil($total_page/$pagenumber);

		if(($pageNum)%$pagenumber != 0){
			$block = ceil(($pageNum+1)/$pagenumber);
		}else{
			$block = ceil(($pageNum+1)/$pagenumber)-1;
		}

		$first_page = ($block-1)*$pagenumber;
		$last_page  = $block*$pagenumber;

		$prev=$pageNum-1;
		$next=$pageNum+1;
		$go_page = $first_page+1;

		if($fn==""){
			$fn = "default_list_get";
		}

		if($total_block<=$block)
			$last_page=$total_page;

		$page_html="";

		if($totalCnt>0){
			$page_html.="<div class='paging'>";

			if($pageNum == "1"){
				$page_html.="<span class='prev'>
											<a href='javascript:void(0)' onclick='".$fn."(1);'><span class='material-icons'>keyboard_double_arrow_left</span></a><a href='javascript:void(0)'><span class='material-icons'>
keyboard_arrow_left</span></a>
										 </span>";
			}else{
				$page_html.="<span class='prev'>
											 <a href='javascript:void(0)' onclick='".$fn."(1);'><span class='material-icons'>keyboard_double_arrow_left</span></a><a href='javascript:void(0)' onclick='".$fn."($prev);'> <span class='material-icons'>
 keyboard_arrow_left</span> </a>
										</span>";
			}

			for($go_page;$go_page<=$last_page;$go_page++){
				if($pageNum==$go_page)
					$page_html.="<a href=javascript:".$fn."($go_page);  class='on'>$go_page</a>";
				else
					$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";
			}

			if($total_page == $pageNum){
				$page_html.="<span class='next'>
											<a href='javascript:void(0)' ><span class='material-icons'>keyboard_arrow_right</span></a><a href='javascript:void(0)' > <span class='material-icons'>
keyboard_double_arrow_right</span> </a>
										 </span>";
			}else{
				$page_html.="<span class='next'>
											 <a href='javascript:void(0)' onclick='".$fn."($next);'> <span class='material-icons'>keyboard_arrow_right</span> </a><a href='javascript:void(0)' onclick='".$fn."($last_page);'> <span class='material-icons'>
 keyboard_double_arrow_right</span> </a>
										 </span>";
			}
			$page_html.="</div>";
		}else{
			$page_html.="<div class='paging'></div>";
		}

		return $page_html;

	}


	function paging_2($totalCnt,$pageSize,$pageNum,$fn=""){

		$pagenumber=PAGENUMBER;

		$total_page  = ceil($totalCnt/$pageSize);
		$total_block = ceil($total_page/$pagenumber);

		if(($pageNum)%$pagenumber != 0){
			$block = ceil(($pageNum+1)/$pagenumber);
		}else{
			$block = ceil(($pageNum+1)/$pagenumber)-1;
		}

		$first_page = ($block-1)*$pagenumber;
		$last_page  = $block*$pagenumber;

		$prev    = $first_page;
		$next    = $last_page+1;
		$go_page = $first_page+1;

		if($fn == ""){
			$fn = "page_go_2";
		}

		if($total_block <= $block)
			$last_page = $total_page;

		$page_html="";
		if($totalCnt>0){
			$page_html.="<div class='paging'>";

			if($block>1){
				$page_html.="<span class='prev'>
										 	<a href='javascript:".$fn."(1);'><span class='material-icons'>keyboard_double_arrow_left</span></a><a href=javascript:".$fn."($prev);> <span class='material-icons'>
keyboard_arrow_left</span> </a>
										 </span>";
			}else{
				$page_html.="<span class='prev'>
										 	<a href='javascript:".$fn."(1);'><span class='material-icons'>keyboard_double_arrow_left</span></a><a href='#'><span class='material-icons'>
keyboard_arrow_left</span></a>
										 </span>";
			}

			for($go_page;$go_page<=$last_page;$go_page++){

				if($pageNum==$go_page)
					$page_html.="<a href=javascript:".$fn."($go_page);  class='on'>$go_page</a>";
				else
					$page_html.="<a href=javascript:".$fn."($go_page);>$go_page</a>";

			}

			if($block<$total_block){
				$page_html.="<span class='next'>
										 	<a href=javascript:".$fn."($next);> <span class='material-icons'>keyboard_arrow_right</span> </a><a href='javascript:".$fn."($total_page);'> <span class='material-icons'>
keyboard_double_arrow_right</span> </a>
										 </span>";
			}else{
				$page_html.="<span class='next'>
										 	<a href='#'><span class='material-icons'>keyboard_arrow_right</span></a><a href='javascript:".$fn."($total_page);'> <span class='material-icons'>
keyboard_double_arrow_right</span> </a>
										 </span>";
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

	//엔터 \n을 <br>로 변경
	function textEnter($str){
		$str = str_replace("\n","<br/>",$str);

    return $str;
	}

  //엔터라인 제거
	function textEnterTrim($str){
		$arr = array("\r\n", "\r","\n");
		$str = str_replace($arr,"",$str);

		return $str;
	}

	// 띄어 쓰기 제거
	public function trimStr($str){
		$str = str_replace(" ","",$str);
		return $str;
	}

  // 핸드폰 형식세팅
	function set_phone_number($str){

		if($str){
			$rt = substr($str,0,3)."-".substr($str,3,4)."-".substr($str,7,4);
		}else{
			$rt ="";
		}
		return $rt;
	}

	// 전화번호 '-'기준으로 나누기
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

	// 서버 디렉토리와 파일명 조합
	function make_filename($sub_domain, $log_date) {

		$date = date("Y-m-d", strtotime($log_date));

		$str = "/home/krakenbeat/CI/".$sub_domain."/application/logs/log-".$date.".php";

		return $str;
	}

	// 서브도메인, 파일 있는지 체크
	function check_validation($sub_domain, $log_date) {

		$dir = "/home/krakenbeat/CI/".$sub_domain;

		if(!is_dir($dir)) {
			return false;
		}

		$dir .= "/application/logs";

		$handle  = opendir($dir);

		$files = array();
		while (false !== ($filename = readdir($handle))) {
	    if($filename == "." || $filename == ".."){
	        continue;
	    }
	    // 파일인 경우만 목록에 추가한다.
	    if(is_file($dir . "/" . $filename)) {
        $files[] = $filename;
	    }
		}

		closedir($handle);

		$files = implode(' ', $files);

		if(strpos($files, $log_date) !== false) {
			return true;
		}
	}

	// 핸드폰번호 하이폰 추가
	function format_phone($phone){
    $phone = preg_replace("/[^0-9]/", "", $phone);
    $length = strlen($phone);

    switch($length){
      case 11 :
          return preg_replace("/([0-9]{3})([0-9]{4})([0-9]{4})/", "$1-$2-$3", $phone);
          break;
      case 10:
          return preg_replace("/([0-9]{3})([0-9]{3})([0-9]{4})/", "$1-$2-$3", $phone);
          break;
      default :
          return $phone;
          break;
    }
	}

  //숫자 자릿수 한글로 변경
	function price_trans($number){

		$num = array('', '일', '이', '삼', '사', '오', '육', '칠', '팔', '구');
		$unit4 = array('', '만', '억', '조', '경');
		$unit1 = array('', '십', '백', '천');

		$res = array();

		$number = str_replace(',','',$number);
		$split4 = str_split(strrev((string)$number),4);

		for($i=0;$i<count($split4);$i++){

			$temp = array();

			$split1 = str_split((string)$split4[$i], 1);

			for($j=0;$j<count($split1);$j++){

				$u = (int)$split1[$j];

				if($u > 0) $temp[] = $num[$u].$unit1[$j];

			}
			if(count($temp) > 0) $res[] = implode('', array_reverse($temp)).$unit4[$i];

		}

		echo implode('', array_reverse($res));
		echo "원";
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

	function get_join_type($str){

		switch ($str) {
			case 'C' : $rt =''; break;
			case 'K' : $rt='(카카오톡)'; break;
			case 'A' : $rt='(애플)'; break;
			case 'N' : $rt='(네이버)'; break;
			case 'G' : $rt='(구글)'; break;
			}
			return $rt;
	}

	function get_report_type($str){

		switch ($str) {
			case '0' : $rt ='영리목적 홍보성'; break;
			case '1' : $rt='불법 정보'; break;
			case '2' : $rt='음란성, 선정성'; break;
			case '3' : $rt='욕설, 인신공격'; break;
			case '4' : $rt='개인정보 노출'; break;
			case '5' : $rt='같은 내용의 반복 게시(도배)'; break;
			case '6' : $rt='기타'; break;
			}
			return $rt;
	}

	function get_qa_type($str){

		$rt='';

		switch ($str) {
			case '0' : $rt ='불편 신고'; break;
			case '1' : $rt='제안 및 건의'; break;
			case '2' : $rt='기타'; break;
			}
			return $rt;
	}

	function get_exercise_goal_type($str){

		$rt='';

		switch ($str) {
			case '0' : $rt ='체력 및 몸매 관리'; break;
			case '1' : $rt='근력 강화'; break;
			case '2' : $rt='살빼기'; break;
			case '3' : $rt='여성 성건강 관리'; break;
			case '4' : $rt='기타'; break;
			}
			return $rt;
	}
	
	function get_exercise_part_type($str){

		$rt='';

		switch ($str) {
			case '0' : $rt ='복근 '; break;
			case '1' : $rt='엉덩이 '; break;
			case '2' : $rt='전신 '; break;
			case '3' : $rt='기타'; break;
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

	//상품 카테고리
	function get_product_category($str){

		switch ($str) {
			case '0' : $rt ='드라이버'; break;
			case '1' : $rt='우드,유틸리티'; break;
			case '2' : $rt='아이언'; break;
			case '3' : $rt='웨지'; break;
			case '4' : $rt='퍼터'; break;
			case '5' : $rt='기타'; break;
			case '6' : $rt='골프용품'; break;
			case '7' : $rt='골프의류'; break;
		
			}
			return $rt;
	}

	//거래 상태
	function get_product_state($str){

		switch ($str) {
			case '0' : $rt ='판매중'; break;
			case '1' : $rt='예약'; break;
			case '2' : $rt='거래완료'; break;
			case '3' : $rt='삭제'; break;
		}
			return $rt;
	}
//판매원
	function get_product_vendor($str){

		switch ($str) {
			case '0' : $rt ='국내정품'; break;
			case '1' : $rt='해외병행수입'; break;
			case '2' : $rt='모름'; break;
			case '3' : $rt='기타'; break;
		}
			return $rt;
	}

	//제조국가
	function get_manufacturing_country($str){

		switch ($str) {
			case '0' : $rt ='미국'; break;
			case '1' : $rt='일본'; break;
			case '2' : $rt='한국'; break;
		}
			return $rt;
	}

// 샤프트 강도 
	function get_shaft_strength($str){

		switch ($str) {
			case '0' : $rt ='X'; break;
			case '1' : $rt='S'; break;
			case '2' : $rt='SR'; break;
			case '3' : $rt='R'; break;
			case '4' : $rt='L'; break;
			case '5' : $rt='시니어'; break;
			case '6' : $rt='기타'; break;
		}
			return $rt;
	}

	//상품 상태 
	function get_goods_state($str){

		switch ($str) {
			case '0' : $rt ='A++ 미사용 신품'; break;
			case '1' : $rt='A+ 신동품'; break;
			case '2' : $rt='시타'; break;
			case '3' : $rt='A- 필드 3회, 연습장 1회 이하'; break;
			case '4' : $rt='B++ 2~3개월 사용'; break;
			case '5' : $rt='B+ 6개월 이상 1년 미만 사용'; break;
			case '6' : $rt='B 1년 이상 2년 미만 사용'; break;
			case '7' : $rt='B- 2년 이상 3년 미만 사용'; break;
			case '8' : $rt='C+ 3년 이상 5년 미만 사용'; break;
			case '9' : $rt='C 5년 이상 10년 미만 사용'; break;
			case '10' : $rt='C- 10년 이상 사용'; break;
		}
			return $rt;
	}

		//검수 상태 
		function get_inspect_state($str){

			switch ($str) {
				case '0' : $rt ='검수요청'; break;
				case '1' : $rt='재검수 요청'; break;
				case '2' : $rt='검수중'; break;
				case '3' : $rt='취소'; break;
				case '4' : $rt='검수완료'; break;
				case '5' : $rt='구매자 발송 대기'; break;
				case '6' : $rt='판매자 발송대기'; break;
				case '7' : $rt='발송완료'; break;
			}
				return $rt;
		}

		//게시물 신고 관리 -> 신고 유형
		function get_member_report_type($str){

			switch ($str) {
				case '0' : $rt ='불법정보'; break;
				case '1' : $rt='욕설,인신공격'; break;
				case '2' : $rt='사기'; break;
				case '3' : $rt='영리목적 홍보성'; break;
				case '4' : $rt='음란성,선정성'; break;
				case '5' : $rt='거래/환불분쟁'; break;
				case '6' : $rt='기타'; break;
			}
				return $rt;
		}

		//qa 카테고리
		function get_qa_category($str){

			switch ($str) {
				case '0' : $rt ='앱 서비스'; break;
				case '1' : $rt='검수'; break;
				case '2' : $rt='배송'; break;
				case '3' : $rt='건의사항'; break;
				case '4' : $rt='기타'; break;
			}
				return $rt;
		}
}
?>
