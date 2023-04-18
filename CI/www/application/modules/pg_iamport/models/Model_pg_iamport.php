<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-05-02
| Memo : 아임포트 결제 모듈
|------------------------------------------------------------------------
*/

Class Model_pg_iamport extends MY_Model {

	//결제 여부 체크
	public function pg_tid_check($data){
		$pg_tid=$data['pg_tid'];

		$sql = "SELECT
							order_number
						FROM
							tbl_payment
						WHERE
						 	pg_tid=?
				  	";
		return $this->query_row($sql,
														array(
														$pg_tid
														),
														$data
														);
	}
}	// 클래스의 끝
?>
