<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
| Memo : 약관
|------------------------------------------------------------------------

*/

Class Model_terms extends MY_Model {

	public function terms_list() {

		$sql = "SELECT
							terms_management_idx,
							title,
							type,
							contents,
							upd_date
						FROM
							tbl_terms_management
						WHERE
							member_type = '0'
						";


		return $this->query_result($sql,
																array(
																)
															);

	}

	// 약관 상세
	public function terms_detail($data){

		$type = $data['type'];

		$sql = "SELECT
							title,
							member_type,
							contents
	        	FROM
	          	tbl_terms_management
	        	WHERE
	           	type = ?
							AND member_type ='0'
					";

   		return $this->query_row($sql,array(
														  $type
														  ),$data
														);
	}
}
?>
