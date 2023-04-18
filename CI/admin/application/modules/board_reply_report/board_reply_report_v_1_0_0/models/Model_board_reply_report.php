<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2020-06-22
| Memo : 댓글 및 답글 관리
|------------------------------------------------------------------------
*/

Class Model_board_reply_report extends MY_Model{

	// 공지사항 리스트
	public function board_reply_report_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_nickname = $data['member_nickname'];
		$member_id = $data['member_id'];
		$reported_member_nickname = $data['reported_member_nickname'];
		$reported_member_id = $data['reported_member_id'];
		$report_type = $data['report_type'];
		$display_yn = $data['display_yn'];

		$sql = "SELECT
							a.board_reply_report_idx,
							b.member_idx as reported_member_idx,
							c.member_nickname,
							FN_AES_DECRYPT(c.member_id) as member_id,
							d.member_idx as reported_member_idx,
							d.member_nickname as reported_member_nickname,
							FN_AES_DECRYPT(d.member_id) as reported_member_id,
							a.report_type,
							a.report_position,
							a.report_contents,
							b.reply_comment,
							b.board_idx,
							e.title,
							e.board_type,
							e.display_yn,
							DATE_FORMAT(a.ins_date,'%Y-%m-%d %H:%i') as ins_date,
							DATE_FORMAT(a.upd_date,'%Y.%m.%d') as  upd_date,
							e.del_yn as board_del_yn,
							a.del_yn
						FROM
							tbl_board_reply_report a
							LEFT JOIN tbl_board_reply b ON b.board_reply_idx = a.board_reply_idx AND b.del_yn = 'N'
							LEFT JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_member d ON d.member_idx = b.member_idx
							LEFT JOIN tbl_board e ON e.board_idx = b.board_idx
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
		if($display_yn != ""){
			$sql .= " AND e.display_yn = '$display_yn' ";
		}

		$sql .=" ORDER BY board_reply_report_idx DESC LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 공지사항 리스트 총 카운트
	public function board_reply_report_list_count($data){

		$member_nickname = $data['member_nickname'];
		$member_id = $data['member_id'];
		$reported_member_nickname = $data['reported_member_nickname'];
		$reported_member_id = $data['reported_member_id'];
		$report_type = $data['report_type'];
		$display_yn = $data['display_yn'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board_reply_report a
							LEFT JOIN tbl_board_reply b ON b.board_reply_idx = a.board_reply_idx AND b.del_yn = 'N'
							LEFT JOIN tbl_member c ON c.member_idx = a.member_idx
							LEFT JOIN tbl_member d ON d.member_idx = b.member_idx
							LEFT JOIN tbl_board e ON e.board_idx = b.board_idx
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
		if($display_yn != ""){
			$sql .= " AND e.display_yn = '$display_yn' ";
		}
		return $this->query_cnt($sql,array(), $data);
	}



}	//클래스의 끝
?>
