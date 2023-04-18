<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-02-17
| Memo : 업체 리스트 및 상세
|------------------------------------------------------------------------
*/

Class Model_corp extends MY_Model {

  // 업체 리스트
	public function corp_list($data){
		$search_text=$data['search_text'];
		$lat = $data['lat'];
		$lng = $data['lng'];

		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$sql = "SELECT
							a.corp_idx,
							a.corp_lat,
							a.corp_lng,
							a.corp_name,
							a.corp_tel,
							a.corp_open_time,
							a.corp_close_time,
							a.corp_addr,
							a.corp_addr_detail,
							a.corp_contents,
							ROUND((6371*ACOS(COS(RADIANS($lat))*COS(RADIANS(a.corp_lat))*COS(RADIANS(a.corp_lng)-RADIANS($lng))+SIN(RADIANS($lat))*SIN(RADIANS(a.corp_lat)))), 2) AS distance,
							(SELECT corp_img_path FROM tbl_corp_img WHERE corp_idx = a.corp_idx AND del_yn ='N' ORDER BY corp_img_order ASC LIMIT 1) AS corp_img_path
						FROM
							tbl_corp a
						";
		if($search_text != ""){
			$sql .= "corp_addr LIKE '%$search_text%' OR corp_name LIKE '%$search_text%'";
		}

		$sql.=" ORDER BY distance ASC";
		$sql.="	limit ?,? ";

		return $this->query_result($sql,
																array(
																$page_no,
																$page_size
																),$data
																);
	}

  // 업체 리스트 카운트
	public function corp_list_count($data){
		$search_text=$data['search_text'];

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_corp a
						";
		if($search_text != ""){
			$sql .= "corp_addr LIKE '%$search_text%' OR corp_name LIKE '%$search_text%'";
		}

		return $this->query_cnt($sql,
														array(

														),$data
														);
	}

  // 업체 상세보기
	public function corp_detail($data){
		$corp_idx=$data['corp_idx'];
		$lat = $data['lat'];
		$lng = $data['lng'];

		$sql = "SELECT
							a.corp_idx,
							a.corp_lat,
							a.corp_lng,
							a.corp_name,
							a.corp_tel,
							a.corp_open_time,
							a.corp_close_time,
							a.corp_addr,
							a.corp_addr_detail,
							a.corp_contents,
							ROUND((6371*ACOS(COS(RADIANS($lat))*COS(RADIANS(a.corp_lat))*COS(RADIANS(a.corp_lng)-RADIANS($lng))+SIN(RADIANS($lat))*SIN(RADIANS(a.corp_lat)))), 2) AS distance
						FROM
							tbl_corp a
						WHERE
							corp_idx = ?
						";

		return $this->query_row($sql,
														array(
														$corp_idx
														),$data
														);
	}

  //업체 이미지 리스트
	public function corp_img_list($data){
		$corp_idx=$data['corp_idx'];

		$sql = "SELECT
							corp_img_path
						FROM
							tbl_corp_img
						WHERE
							corp_idx =?
							AND del_yn ='N'
						ORDER BY corp_img_order ASC
						";

		return $this->query_result($sql,
																array(
																$corp_idx
																),$data
																);
	}

}
?>
