<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-03
| Memo : 커뮤니티 관리
|------------------------------------------------------------------------
*/

Class Model_board extends MY_Model{

	// 커뮤니티 리스트
	public function board_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$title = $data['title'];
		$member_nickname = $data['member_nickname'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$display_yn = $data['display_yn'];
		$board_type = $data['board_type'];
		$orderby = $data['orderby'];

		$sql = "SELECT
							a.board_idx,
							b.member_nickname,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							b.member_state,
							c.category_name,
							a.title,
							a.like_cnt,
							a.contents,
							a.view_cnt,
							a.reply_cnt,
							a.report_cnt,
							a.display_yn,
							a.ins_date,
							a.upd_date,
							a.del_yn
						FROM
							tbl_board a
							left JOIN tbl_member b ON b.member_idx = a.member_idx
							left join tbl_category_management c on c.category_management_idx=a.category_idx 
						WHERE
							a.del_yn = 'N'
							and a.board_type=$board_type
		";

		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		
		if($member_nickname != ""){
			$sql .= " AND b.member_nickname LIKE '%$member_nickname%'";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($orderby != ""){
			if($orderby == "0"){
					$sql .= " ORDER BY a.ins_date DESC LIMIT ?, ?";
			}
			if($orderby == "1"){
					$sql .= " ORDER BY a.report_cnt DESC LIMIT ?, ?";
			}
			if($orderby == "2"){
					$sql .= " ORDER BY a.reply_cnt DESC LIMIT ?, ?";
			}

 	 }else{
		 $sql .= " ORDER BY a.ins_date DESC LIMIT ?, ?";
	 }



		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// 커뮤니티 리스트 총 카운트
	public function board_list_count($data){

		$title = $data['title'];
		$member_nickname = $data['member_nickname'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$display_yn = $data['display_yn'];
		$board_type = $data['board_type'];
		$orderby = $data['orderby'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board a
							left JOIN tbl_member b ON b.member_idx = a.member_idx
							left join tbl_category_management c on c.category_management_idx=a.category_idx 
						WHERE
							a.del_yn = 'N'
							and a.board_type=$board_type
		";
		
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}

		if($member_nickname != ""){
			$sql .= " AND b.member_nickname LIKE '%$member_nickname%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

	// 이브의 고민 관리 리스트
	public function counselor_board_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$title = $data['title'];
		$category = $data['category'];
		$member_nickname = $data['member_nickname'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$display_yn = $data['display_yn'];
		$board_type = $data['board_type'];
		$orderby = $data['orderby'];

		$sql = "SELECT
							a.board_idx,
							b.member_nickname,
							b.member_state,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							c.category_management_idx,
							c.category_name,
							a.title,
							a.like_cnt,
							a.contents,
							a.view_cnt,
							a.reply_cnt,
							a.report_cnt,
							a.display_yn,
							a.ins_date,
							a.upd_date,
							a.del_yn
						FROM
							tbl_board a
							left JOIN tbl_member b ON b.member_idx = a.member_idx
							left join tbl_category_management c on c.category_management_idx=a.category_idx and c.del_yn='N'
						WHERE
							a.del_yn = 'N'
							and a.board_type=$board_type
		";

		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		
		if($member_nickname != ""){
			$sql .= " AND b.member_nickname LIKE '%$member_nickname%'";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($category != ""){
			$sql .= " AND a.category_idx = '$category' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
		if($orderby != ""){
			if($orderby == "0"){
					$sql .= " ORDER BY a.ins_date DESC LIMIT ?, ?";
			}
			if($orderby == "1"){
					$sql .= " ORDER BY a.report_cnt DESC LIMIT ?, ?";
			}
			if($orderby == "2"){
					$sql .= " ORDER BY a.reply_cnt DESC LIMIT ?, ?";
			}

 	 }else{
		 $sql .= " ORDER BY a.ins_date DESC LIMIT ?, ?";
	 }



		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// 이브의 고민 관리 리스트 총 카운트
	public function counselor_board_list_count($data){

		$title = $data['title'];
		$category = $data['category'];
		$member_nickname = $data['member_nickname'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];
		$display_yn = $data['display_yn'];
		$board_type = $data['board_type'];
		$orderby = $data['orderby'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board a
							left JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							a.del_yn = 'N'
							and a.board_type=$board_type
		";
		
		if($title != ""){
			$sql .= " AND a.title LIKE '%$title%' ";
		}
		if($member_nickname != ""){
			$sql .= " AND b.member_nickname LIKE '%$member_nickname%' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}
		if($category != ""){
			$sql .= " AND a.category_idx = '$category' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

	// 상태 변경
	public function board_state_mod_up($data){

		$board_idx  = $data['board_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							display_yn = ?,
							report_cycle = if('$display_yn'='Y',0,report_cycle),
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								 array(
								 $display_yn,
								 $board_idx
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


	public function board_reg_in($data){

		$title 		= $data['title'];
		$contents = $data['contents'];
		$board_img 			= $data['board_img'];
		$board_img_detail 			= $data['board_img_detail'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board
						(
							board_type,
							title,
							contents,
							board_img,
							board_img_detail,
							del_yn,
							ins_date,
							upd_date
						) VALUES (
							1,
							?, -- title
							?, -- contents
							?, -- img_path
							?, -- img_path
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,array(
								 $title,
								 $contents,
								 $board_img,
								 $board_img_detail,
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


	public function board_mod_up($data){
		$board_idx 		= $data['board_idx'];
		$title 		= $data['title'];
		$contents = $data['contents'];
		$board_img 			= $data['board_img'];
		$board_img_detail 			= $data['board_img_detail'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							title =?,
							contents =?,
							board_img =?,
							board_img_detail =?,
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								 array(
								 $title,
								 $contents,
								 $board_img,
								 $board_img_detail,
								 $board_idx,
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}



	// 커뮤니티 상세
	public function board_detail($data){

		$board_idx = $data['board_idx'];

		$sql = "SELECT
							a.board_idx,
							a.board_type,
							a.program_record,
							b.member_nickname,
							b.member_state,
							FN_AES_DECRYPT(b.member_name) as  member_name,
							c.category_management_idx,
							c.category_name,
							a.title,
							a.contents,
							a.like_cnt,
							a.view_cnt,
							a.scrap_cnt,
							a.reply_cnt,
						  a.report_cnt,
							a.display_yn,
							a.ins_date,
							a.upd_date,
							a.url_link,
							a.board_img
						FROM
							tbl_board a
							left JOIN tbl_member b ON b.member_idx = a.member_idx
							left join tbl_category_management c on c.category_management_idx=a.category_idx and c.del_yn='N'
						WHERE
							a.del_yn = 'N'
							and board_idx=?
		";

   	return $this->query_row($sql,
														array(
														$board_idx
														),
														$data);
	}

	// 댓글 상세
  public function board_reply_detail($data){
    $board_reply_idx = $data['board_reply_idx'];

    $sql = "SELECT
              a.board_reply_idx,
              a.board_idx,
              a.member_idx,
              a.parent_board_reply_idx,
              a.depth,
              (a.depth+1) as next_depth
            FROM
              tbl_board_reply a
            WHERE
              board_reply_idx = ?
      ";

      return $this->query_row($sql,
                              array(
                              $board_reply_idx
                              ),
                              $data
                              );
  }


	// 댓글 등록
	public function	board_comment_reg_in($data){
		$admin_idx     = $data['admin_idx'];
		$board_idx     = $data['board_idx'];
		$reply_comment = $data['reply_comment'];
		$parent_board_reply_idx        = $data['parent_board_reply_idx'];
		$depth         = $data['depth'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board_reply
							(
								admin_idx,
								board_idx,
								reply_comment,
								parent_board_reply_idx,
								depth,
								del_yn,
								ins_date,
								upd_date
							) values (
								?, -- admin_idx
								?, -- board_idx
								?, --
								?, -- depth
								?, -- depth
								'N',
								NOW(),
								NOW()
							)
			";

			$this->query($sql,
									array(
									$admin_idx,
									$board_idx,
									$reply_comment,
									$parent_board_reply_idx,
									$depth
									),
									$data
									);

			$sql = "UPDATE
								tbl_board
							SET
								reply_cnt = (select count(*) from tbl_board_reply where board_idx=$board_idx and del_yn='N' and display_yn='Y'),
								upd_date = NOW()
							WHERE
								board_idx = ?
							";

			$this->query($sql,
									array(
									$board_idx
									),
									$data
									);



		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 댓글 리스트  count
	public function cmt_detail($data){

		$type = $data['type']; //1번 답글 0번 댓글
		$board_idx = $data['board_idx'];
		$board_reply_idx = $data['board_reply_idx'];

		if($type=='0'){

			$sql = "SELECT
							member_idx
					FROM
						tbl_board
					WHERE
						board_idx = $board_idx
		";
		}else if($type=='1'){

			$sql = "SELECT
						member_idx
					FROM
						tbl_board_reply
					WHERE
						board_reply_idx = $board_reply_idx
		";
		}

		return $this->query_row($sql,
								array(
								),
								$data
								);
	}

	// 커뮤니티 댓글 리스트
	public function reply_list($data){
		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$board_idx = $data['board_idx'];
	  $member_nickname = $data['member_nickname'];
		$orderby = $data['orderby'];

		$sql = "SELECT
							a.board_reply_idx,
							a.admin_idx,
							b.member_nickname,
							d.member_nickname as parent_member_nickname,
							a.img_path,
							a.report_cnt,
							a.reply_comment,
							a.parent_board_reply_idx,
							a.depth,
							a.ins_date,
							a.upd_date,
							a.del_yn,
							a.display_yn
						FROM
							tbl_board_reply a
							left JOIN tbl_member b ON b.member_idx = a.member_idx
							LEFT JOIN tbl_board_reply c ON c.board_reply_idx=a.parent_board_reply_idx  AND 	c.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = c.member_idx AND d.del_yn = 'N'
						WHERE a.del_yn = 'N'
							AND a.board_idx = $board_idx
		";
		if($member_nickname != ""){
			$sql .= " AND (b.member_nickname LIKE '%$member_nickname%' OR d.member_nickname LIKE '%$member_nickname%')";
		}
		if($orderby != ""){
			if($orderby=="0"){
					$sql .= " ORDER BY a.ins_date DESC LIMIT ?, ?";
			}
			if($orderby=="1"){
					$sql .= " ORDER BY a.ins_date ASC LIMIT ?, ?";
			}
		}

		return $this->query_result($sql,
															 array(
															 $page_no,
															 $page_size
															 ),
															 $data);
	}

	// 댓글 답글 리스트 count
	public function reply_list_count($data){

		$board_idx = $data['board_idx'];
		$member_nickname = $data['member_nickname'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							left JOIN tbl_member b ON b.member_idx = a.member_idx
							LEFT JOIN tbl_board_reply c ON c.board_reply_idx=a.parent_board_reply_idx  AND 	c.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = c.member_idx AND d.del_yn = 'N'
						WHERE a.del_yn = 'N'
							AND a.board_idx = $board_idx
		";
		if($member_nickname != ""){
			$sql .= " AND (b.member_nickname LIKE '%$member_nickname%' OR d.member_nickname LIKE '%$member_nickname%')";
		}

		return $this->query_cnt($sql,
														array(
														),
														$data);
	}

	// 노출여부 상태 변경
	public function display_yn_mod_up($data){

		$board_reply_idx  = $data['board_reply_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board_reply
						SET
							display_yn = ?,
							report_cycle = if('$display_yn'='Y',0,report_cycle),
							upd_date = NOW()
						WHERE
							board_reply_idx = ?
						";

		$this->query($sql,
								 array(
								 $display_yn,
								 $board_reply_idx
							   ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	public function board_display_yn_mod_up($data){

		$board_idx  = $data['board_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							display_yn = ?,
							report_cycle = if('$display_yn'='Y',0,report_cycle),
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								 array(
								 $display_yn,
								 $board_idx
							   ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	//board_del
	public function board_del($data){

		$board_idx  = $data['board_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								 array(
								 $board_idx
								 ),
								 $data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

}	//클래스의 끝
?>
