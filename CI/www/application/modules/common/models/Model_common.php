<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-02-29
| Memo : 공통 기능
|------------------------------------------------------------------------
*/

Class Model_common extends MY_Model {

//지역 시도 리스트
	public function city_list() {

		$sql = "
				SELECT
					city_cd,
					city_name,
					id_cd
				FROM
					tbl_city_cd
				ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,array());

	}

//구군 리스트
	public function region_list($data) {

		$city_cd=$data['city_cd'];

		$sql = "
				SELECT
					region_cd,
					region_name,
					city_cd
				FROM
					tbl_region_cd
				WHERE
					city_cd =?
				ORDER BY order_no ASC
				  ";

		return $this->query_result($sql,array($city_cd));

	}

//메인 카테고리 리스트
	public function keyword_list() {

		$sql = "
				SELECT
					keyword_name,
					keyword_code,
					keyword_memo
				FROM
					tbl_keyword
				WHERE
					del_yn ='N' ";
	//	if($auto_yn == 'Y'){
	//		$sql .= " AND auto_yn = 'Y'";
	//	}
		$sql .= " GROUP BY keyword_code
				ORDER BY order_no ";

		return $this->query_result($sql,array());

	}

//키워드 리스트
	public function keyword_sub_list($data) {
		//$auto_yn = $data['auto_yn'];

		$keyword_code=$data['keyword_code'];

		$sql = "
				SELECT
					keyword_idx,
					keyword_name_sub,
					keyword_code,
					keyword_code_sub,
					keyword_memo
				FROM
					tbl_keyword
				WHERE
					keyword_code =?	";
		//	if($auto_yn == 'Y'){
		//		$sql .= " AND auto_sub_yn = 'Y'";
	//		}
			$sql .= "	AND del_yn = 'N'
				ORDER BY keyword_code_sub ASC
				  ";

		return $this->query_result($sql,array($keyword_code));

	}


}
?>
