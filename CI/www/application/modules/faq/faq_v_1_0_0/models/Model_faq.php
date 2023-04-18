<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 조다솜
| Create-Date : 2018-10-16
| Memo : FAQ
|------------------------------------------------------------------------
*/

class Model_faq extends MY_Model{

  public function faq_list_get($data){

		$title_0 = $data['title_0'];
    $contents_0 = $data['contents_0'];
    $display_yn = $data['display_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$sql = "SELECT
							a.faq_idx,
							a.title_0,
              a.contents_0,
							a.del_yn,
              a.display_yn,
							a.ins_date
						FROM
							tbl_faq a
						WHERE
							a.del_yn = 'N' and a.display_yn = 'Y'
						";

		if($title_0 != ""){
			$sql .= " AND a.title_0 = '$title_0' ";
		}
    if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}

    if($contents_0 != ""){
			$sql .= " AND a.contents_0 = '$contents_0' ";
		}

		if($s_date != ""){
			$sql .= " AND DATE(a.ins_date) >= '$s_date' ";
		}

		if($e_date != ""){
			$sql .= " AND DATE(a.ins_date) <= '$e_date' ";
		}

		$sql .=" ORDER BY a.ins_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															array(
															$page_no,
															$page_size
															),$data
															);
	}

	// FAQ 리스트 총 카운트
	public function faq_list_count($data){

		$title_0 = $data['title_0'];
    $display_yn = $data['display_yn'];
    $contents_0 = $data['contents_0'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_faq a
						WHERE
							a.del_yn = 'N'
						";

		if($title_0 != ""){
			$sql .= " AND a.title_0 = '$title_0' ";
		}
    if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}

    if($contents_0 != ""){
			$sql .= " AND a.title_0 = '$contents_0' ";
		}

		if($s_date != ""){
			$sql .= " AND DATE(a.ins_date) >= '$s_date' ";
		}

		if($e_date != ""){
			$sql .= " AND DATE(a.ins_date) <= '$e_date' ";
		}

		return $this->query_cnt($sql,array(),$data);
	}







} // 클래스의 끝
?>
