<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2023-04-19
| Memo : 공통모듈
|------------------------------------------------------------------------
*/

Class Model_common extends MY_Model {

		//직종
		public function work_list(){

			$sql = "SELECT
								a.work_idx,
								a.work_name
							FROM tbl_work AS a
							ORDER BY a.work_idx
			";
	
			return $this->query_result($sql,array());
		}

	// 지역 시도 리스트
	public function city_list() {

		$sql = "SELECT
							city_code,
							city_name
						FROM
							tbl_region
						group by city_code,city_name
						order by region_idx
				  ";

		return $this->query_result($sql,array());

	}

	// 구군 리스트
	public function region_list($data) {

		$city_name = $data['city_name'];

		$sql = "SELECT
							city_code,
							city_name,
							region_code,
							region_name
						FROM
							tbl_region
						WHERE
							city_name = ?
						order by region_idx
				  ";

		return $this->query_result($sql
																	,array(
																					$city_name
																				)
																			);

	}

	public function board_list() {

		$sql = "SELECT
							board_idx, 
							hot_community_idx, 
							title, 
							contents, 
							img, 
							work_yn, 
							work_arr, 
							detail_yn, 
							anony_yn, 
							display_yn, 
							del_yn, 
							ins_date, 
							upd_date
						FROM
							tbl_board
							where
						del_yn='N'
						order by board_idx
				  ";

		return $this->query_result($sql,array());

	}

  // smtp 조회
  public function smtp_detail2(){

    $sql = "SELECT
              smtp_email_idx,
              smtp_host,
              smtp_user,
              smtp_pass,
              smtp_port,
              from_email,
              from_name
            FROM
              tbl_smtp_email
            WHERE
              del_yn = 'N'
              ORDER BY last_send_date ASC,smtp_email_idx ASC LIMIT 1
            ";

  return $this->query_row($sql,array(
                            )
                            );
  }

  //마지막 stmp 발송일 수정
  public function smtp_last_date_mod_up($data){

		$smtp_email_idx = $data['smtp_email_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_smtp_email
						SET
              send_cnt = CASE WHEN DATE_FORMAT(last_send_date,'%Y%m%d') <> DATE_FORMAT(NOW(),'%Y%m%d') THEN 1 ELSE send_cnt+1 END,
              last_send_date	= NOW(),
							upd_date = NOW()
						WHERE
							smtp_email_idx = ?
						";

		$this->query($sql,array(
									$smtp_email_idx
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
