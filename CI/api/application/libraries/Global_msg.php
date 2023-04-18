<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2017-12-22
| memo : 결과 메시지 관리
|------------------------------------------------------------------------
*/

Class Global_msg {

	//결과 메시지
	function code_msg($code){
		if(strpos($code, '-') !== false){
			//에러 메시지 -1 ~
			$return_msg_arr =  array(
				'-1' => '실패 하였습니다.',
				'-2' => '조회된 값이 없습니다.'
			);
			$return_msg = $return_msg_arr[$code];
		}else{
			//성공 메시지 1000~
			$return_msg_arr =  array(
				'1000' => '정상적으로 처리되었습니다.',
				'1001' => '정상적으로 로그아웃 되었습니다.',
				'2000' => '조회된 리스트가 없습니다.'
			);
			$return_msg = $return_msg_arr[$code];
		}

		return $return_msg;
	}

}	// 클래스의 끝
?>
