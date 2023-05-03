<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
| Memo : 약관
|------------------------------------------------------------------------

*/

Class Model_work extends MY_Model {

	public function work_list() {

		$sql = "SELECT
							work_management_idx,
							title,
							type,
							contents,
							upd_date
						FROM
							tbl_work_management
						WHERE
							member_type = '0'
						";


		return $this->query_result($sql,
																array(
																)
															);

	}

	// 약관 상세
	public function work_detail($data){

		$type = $data['type'];

		$sql = "SELECT
							title,
							contents
	        	FROM
	          	tbl_work_management
	        	WHERE
	           	type = ?
					";

   		return $this->query_row($sql,array(
														  $type
														  ),$data
														);
	}
}
?>
