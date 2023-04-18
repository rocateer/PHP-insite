<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-01-31
| Memo : 약관 관리
|------------------------------------------------------------------------
*/

Class Model_terms extends MY_Model {

//약관 리스트
	public function terms_list() {

		$sql = "SELECT
							terms_management_idx,
							title,
							type,
							member_type,
							contents,
							upd_date
						FROM
							tbl_terms_management
          	";


  	return $this->query_result($sql,
                                array(
																)
                              );

	}

//약관 상세 보기
	public function terms_detail($data) {
		$terms_management_idx = $data['terms_management_idx'];

		$sql = "SELECT
							terms_management_idx,
							title,
							type,
							member_type,
							contents,
							upd_date
						FROM
							tbl_terms_management
						WHERE
							terms_management_idx = ?
						";

		return $this->query_row($sql, array($terms_management_idx),$data);
	}

//약관 수정
	public function terms_mod_up($data) {
		$terms_management_idx = $data['terms_management_idx'];
		$contents = $data['contents'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_terms_management
						SET
							contents = ?,
							upd_date = NOW()
						WHERE
							terms_management_idx = ?
						";

		$this->query($sql,
	                array(
										$contents,
										$terms_management_idx
	                ),
									$data
	              );

		if($this->db->trans_status() === FALSE){

			$this->db->trans_rollback();
			return "0";
		}else{

			$this->db->trans_commit();
			return "1";
		}
	}




}	// 클래스의 끝

?>
