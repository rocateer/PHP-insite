<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-10-10
| Memo : 설정
|------------------------------------------------------------------------

*/

Class Model_setting extends MY_Model {

	public function member_detail(){

		$sql = "SELECT
							a.member_idx,
							all_alarm_yn
						FROM
							tbl_member a
						WHERE
							a.member_idx = 1
						";

		return  $this->query_row($sql,
														array(
														$this->member_idx
														)
														);
	}

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
							type IN (0,1,2,3,4)
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
							contents,
							upd_date
						FROM
							tbl_terms_management
						WHERE
							terms_management_idx = ?
						";

		return $this->query_row($sql, array($terms_management_idx),$data);
	}

	public function all_alarm_yn_mod_up($data){

		$member_idx = $this->member_idx;
		$all_alarm_yn = $data['all_alarm_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							all_alarm_yn = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

		$this->query($sql,array(
									$all_alarm_yn,
									$member_idx
								 ),$data
							 );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

}
?>
