<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	플랫폼로캣티어
| Create-Date : 2018-02-14
| Memo : 알람
|------------------------------------------------------------------------
*/

Class Model_alarm extends MY_Model {


// 공지사항 리스트 불러오기
	public function notice_list($data) {

		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$sql = "SELECT
							notice_idx,
							title,
							contents,
							img,
							ins_date
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
            ORDER BY
              ins_date DESC LIMIT ?, ?
						";

		return	$this->query_result($sql, array($page_no, $page_size));
	}

// 공지사항 리스트 총 카운트
	public function notice_list_count() {

		$sql = "SELECT
							count(*) AS cnt
						FROM
							tbl_notice
						WHERE
							del_yn = 'N'
				  ";

		return $this->query_cnt($sql, array());
	}

}// 클래스의 끝
?>
