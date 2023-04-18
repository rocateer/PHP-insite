<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-02
| Memo : FAQ
|------------------------------------------------------------------------
*/

Class Model_faq extends MY_Model{

	// FAQ 리스트
	public function faq_list_get($data){

		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							a.faq_idx,
							a.title,
							a.del_yn,
							a.contents,
							a.ins_date
						FROM
							tbl_faq a
						WHERE
							a.del_yn = 'N'
						";


		$sql .=" ORDER BY a.faq_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															array(
															$page_no,
															$page_size
															),$data
															);
	}

	// FAQ 리스트 총 카운트
	public function faq_list_count($data){

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_faq a
						WHERE
							a.del_yn = 'N'
						";

		return $this->query_cnt($sql,array(),$data);
	}


}	//클래스의 끝
?>
