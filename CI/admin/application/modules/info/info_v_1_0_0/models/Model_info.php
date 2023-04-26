<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2023-04-19
| Memo : 안내 관리
|------------------------------------------------------------------------
*/

Class Model_info extends MY_Model {

//안내 리스트
	public function join_detail(){

		$sql = "SELECT
							info_idx,
							type,
							img,
							contents,
							upd_date
						FROM
							tbl_info
						WHERE
							type=0
          	";

  	return $this->query_row($sql,
                                array(
																)
                              );
	}

	public function pay_detail(){

		$sql = "SELECT
							info_idx,
							type,
							img,
							contents,
							upd_date
						FROM
							tbl_info
						WHERE
							type=1
          	";

  	return $this->query_row($sql,
                                array(
																)
                              );
	}

//안내 상세 보기
	public function info_detail($data) {
		$info_idx = $data['info_idx'];

		$sql = "SELECT
							info_idx,
							img,
							type,
							contents,
							upd_date
						FROM
							tbl_info
						WHERE
							info_idx = ?
						";

		return $this->query_row($sql, array($info_idx),$data);
	}

//안내 수정
	public function info_mod_up($data) {
		$info_idx = $data['info_idx'];
		$img = $data['img'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_info
						SET
							img = ?,
							upd_date = NOW()
						WHERE
							info_idx = ?
						";

		$this->query($sql,
	                array(
										$img,
										$info_idx
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

//안내 수정
	public function ban_mod_up($data) {
		$info_idx = $data['info_idx'];
		$contents = $data['contents'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_info
						SET
							contents = ?,
							upd_date = NOW()
						WHERE
							info_idx = ?
						";

		$this->query($sql,
	                array(
										$contents,
										$info_idx
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

	//안내 리스트
	public function age_detail(){

		$sql = "SELECT
							info_idx,
							type,
							img,
							contents,
							upd_date
						FROM
							tbl_info
						WHERE
							type=2
          	";

  	return $this->query_row($sql,
                                array(
																)
                              );
	}

	public function gender_detail(){

		$sql = "SELECT
							info_idx,
							type,
							img,
							contents,
							upd_date
						FROM
							tbl_info
						WHERE
							type=3
          	";

  	return $this->query_row($sql,
                                array(
																)
                              );
	}



}	// 클래스의 끝

?>
