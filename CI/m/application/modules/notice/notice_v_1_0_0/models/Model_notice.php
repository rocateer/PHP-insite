<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-02
| Memo : 공지사항
|------------------------------------------------------------------------
*/

Class Model_notice extends MY_Model{

	// 공지사항 리스트
	public function notice_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$sql = "SELECT
							notice_idx,
							title,
							del_yn,
							ins_date,
							upd_date
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
							AND notice_state = 'Y'
						";

		$sql .=" ORDER BY notice_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 공지사항 리스트 총 카운트
	public function notice_list_count($data){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
							AND notice_state = 'Y'
						";

		return $this->query_cnt($sql,array());
	}

	// 공지사항 상세
	public function notice_detail($data){

		$notice_idx = $data['notice_idx'];

		$sql = "SELECT
	          	notice_idx,
							title,
							contents,
							img,
							ins_date,
							upd_date,
							del_yn
	        	FROM
	          	tbl_notice
	        	WHERE
	           	notice_idx = ?
							AND del_yn = 'N'
					";

   		return $this->query_row($sql,array(
														  $notice_idx
														  ),$data
														);
	}



}	//클래스의 끝
?>
