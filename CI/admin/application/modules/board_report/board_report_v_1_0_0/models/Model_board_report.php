<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-03
| Memo : 신고 관리
|------------------------------------------------------------------------
*/

Class Model_board_report extends MY_Model{

	// 신고관리 리스트
	public function board_report_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_nickname = $data['member_nickname'];
		$member_id = $data['member_id'];
		$reported_member_nickname = $data['reported_member_nickname'];
		$reported_member_id = $data['reported_member_id'];
		$report_type = $data['report_type'];
		$display_yn = $data['display_yn'];
		$board_type = $data['board_type'];

		$sql = "SELECT
							a.board_report_idx,
							b.board_type,
							b.member_idx as reported_member_idx,
							c.member_nickname,
							FN_AES_DECRYPT(c.member_id) as member_id,
							d.member_idx as reported_member_idx,
							d.member_nickname as reported_member_nickname,
							FN_AES_DECRYPT(d.member_id) as reported_member_id,
							b.title,
							b.del_yn as board_del_yn,
							a.report_type,
							a.report_contents,
							a.board_idx,
							a.ins_date,
							b.display_yn,
							a.del_yn
						FROM
							tbl_board_report a
							JOIN tbl_board b ON b.board_idx = a.board_idx 
							JOIN tbl_member c ON c.member_idx = a.member_idx
							JOIN tbl_member d ON d.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
		";

		if($member_nickname != ""){
			$sql .= " AND c.member_nickname LIKE '%$member_nickname%' ";
		}
		if($member_id != ""){
			$sql .= " AND	FN_AES_DECRYPT(c.member_id) LIKE '%$member_id%' ";
		}
		if($reported_member_nickname != ""){
			$sql .= " AND d.member_nickname LIKE '%$reported_member_nickname%' ";
		}
		if($reported_member_id != ""){
			$sql .= " AND FN_AES_DECRYPT(d.member_id) LIKE '%$reported_member_id%' ";
		}
		if($report_type != ""){
			$sql .= " AND a.report_type IN ($report_type) ";
		}
		if($board_type != ""){
			$sql .= " AND b.board_type = '$board_type' ";
		}
		if($display_yn != ""){
			$sql .= " AND b.display_yn = '$display_yn' ";
		}

		$sql .=" ORDER BY board_report_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// 신고관리 리스트 총 카운트
	public function board_report_list_count($data){

		$member_nickname = $data['member_nickname'];
		$member_id = $data['member_id'];
		$reported_member_nickname = $data['reported_member_nickname'];
		$reported_member_id = $data['reported_member_id'];
		$report_type = $data['report_type'];
		$display_yn = $data['display_yn'];
		$board_type = $data['board_type'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board_report a
							JOIN tbl_board b ON b.board_idx = a.board_idx 
							JOIN tbl_member c ON c.member_idx = a.member_idx
							JOIN tbl_member d ON d.member_idx = b.member_idx
						WHERE
							a.del_yn = 'N'
		";

		if($member_nickname != ""){
			$sql .= " AND c.member_nickname LIKE '%$member_nickname%' ";
		}
		if($member_id != ""){
			$sql .= " AND c.member_id LIKE '%$member_id%' ";
		}
		if($reported_member_nickname != ""){
			$sql .= " AND d.member_nickname LIKE '%$reported_member_nickname%' ";
		}
		if($reported_member_id != ""){
			$sql .= " AND d.member_id LIKE '%$reported_member_id%' ";
		}
		if($report_type != ""){
			$sql .= " AND a.report_type IN ($report_type) ";
		}
		if($display_yn != ""){
			$sql .= " AND b.display_yn = '$display_yn' ";
		}
		if($board_type != ""){
			$sql .= " AND b.board_type = '$board_type' ";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

}	//클래스의 끝
?>
