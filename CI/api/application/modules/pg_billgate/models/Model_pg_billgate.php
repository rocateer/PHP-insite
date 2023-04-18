<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2018-01-20
| Memo : 결제 모듈
|------------------------------------------------------------------------
*/

Class Model_pg_billgate extends MY_Model {

	//결제 여부 체크
	public function pg_tid_check($data){
		$pg_tid=$data['pg_tid'];

		$sql = "
						SELECT
							order_number
						FROM tbl_order
						WHERE pg_tid=?
					";
		return $this->query_row($sql,array($pg_tid));
	}



}	// 클래스의 끝
?>
