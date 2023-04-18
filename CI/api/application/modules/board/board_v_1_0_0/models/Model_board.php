<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2020-07-07
| Memo : 포토게시판
|------------------------------------------------------------------------

*/

Class Model_board extends MY_Model{

	// 1. 포토게시판리스트
	public function board_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$member_idx= $data['member_idx'];
		$category = $data['category'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							a.title,
							a.contents,
							a.category,
							a.ins_date,
							TIMESTAMPDIFF(MINUTE ,a.ins_date,NOW()) AS diff,
							a.ins_date,
							a.board_img,
							a.like_cnt,
							a.scrap_cnt,
							a.reply_cnt,
							b.member_nickname,
							b.member_img,
							ifnull((SELECT like_yn  FROM tbl_board_like WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_like_yn,
							ifnull((SELECT scrap_yn  FROM tbl_board_scrap WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_scrap_yn,
							ifnull((SELECT COUNT(*) AS cnt FROM tbl_board_report WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),0) AS my_report_cnt
						FROM	tbl_board as a
						JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE		a.del_yn = 'N'
							and a.display_yn='Y'
		";

		if($category !=""){
			$sql .=" AND a.category ='$category' ";
		}

		$sql .=" ORDER BY a.board_idx desc limit ?, ?";

		return	$this->query_result($sql,
																array(
																$page_no,
																$page_size
																),
																$data
																);

	}

	// 1-1. 포토게시판리스트 총 카운트
	public function board_list_count($data){
		$member_idx= $data['member_idx'];
		$category = $data['category'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM	tbl_board as a
						JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE		a.del_yn = 'N'
							and a.display_yn='Y'

		";

		if($category !=""){
			$sql .=" AND a.category ='$category' ";
		}
		return	$this->query_cnt($sql,
															array(
															),$data
															);

	}

	// 2. 포토게시판상세
	public function board_detail($data){
		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							a.category,
							a.title,
							a.contents,
							a.board_img,
							a.ins_date,
							a.view_cnt,
							a.like_cnt,
							a.scrap_cnt,
							a.reply_cnt,
							a.report_cnt,
							b.member_nickname,
							b.member_img,
							ifnull((SELECT scrap_yn  FROM tbl_board_scrap WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_scrap_yn,
							ifnull((SELECT like_yn  FROM tbl_board_like WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_like_yn,
							ifnull((SELECT COUNT(*) AS cnt FROM tbl_board_report WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),0) AS my_report_cnt
						FROM
							tbl_board a
							JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE
							a.del_yn = 'N'
							and a.display_yn='Y'
							AND a.board_idx = ?
			";

			return $this->query_row($sql,
															array(
															$board_idx
															),
															$data
															);
	}


	// 2. 원글 체크
	public function board_check($data){
		$board_idx = $data['board_idx'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx
						FROM
							tbl_board a
						WHERE
							a.del_yn = 'N'
							AND board_idx = ?

			";

			return $this->query_row($sql,
															array(
															$board_idx
															),
															$data
															);
	}

	// 3. 포토게시판댓글 리스트
	public function board_comment_list_get($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.member_idx,
							a.board_idx,
							a.reply_comment,
							a.parent_board_reply_idx,
							a.depth,
							a.display_yn,
							a.ins_date,
							TIMESTAMPDIFF(MINUTE ,a.ins_date,NOW()) AS date_diff,
							a.del_yn,
							b.member_img,
							b.member_nickname,
							ifnull((SELECT like_yn  FROM tbl_board_reply_like WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = '$member_idx'),'N') AS my_like_yn,
							ifnull((SELECT COUNT(*) AS cnt FROM tbl_board_reply_report WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = '$member_idx'),0) AS my_report_cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE
							 a.depth = 0
							AND a.board_idx = ?
		";

		$sql.=" ORDER BY a.board_reply_idx asc  limit ?, ? ";

		return $this->query_result($sql,
															array(
															$board_idx,
															$page_no,
															$page_size
															),
															$data
															);

	}


	// 3. 리스트  count
	public function board_comment_list_count($data){

		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
             	COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE
							 a.depth = 0
							AND a.board_idx = ?

		";
		return $this->query_cnt($sql,
															array(
															$board_idx,

															),
															$data
															);

	}

	// 4. 포토게시판대댓글 리스트
	public function board_comment_reply_list_get($data){
		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.member_idx,
							a.board_idx,
							a.reply_comment,
							a.grand_parent_board_reply_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.display_yn,
							a.del_yn,
							a.ins_date,
							TIMESTAMPDIFF(MINUTE ,a.ins_date,NOW()) AS date_diff,
							b.member_img,
							ifnull((SELECT like_yn  FROM tbl_board_reply_like WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = '$member_idx'),'N') AS my_like_yn,
							ifnull((SELECT COUNT(*) AS cnt FROM tbl_board_reply_report WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = '$member_idx'),0) AS my_report_cnt,
							b.member_nickname
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE
							 a.depth > 0
							AND a.board_idx = ?
		";
		$sql.=" ORDER BY a.reply_depth ASC,a.parent_board_reply_idx ASC, a.board_reply_idx ASC ";

		return $this->query_result($sql,
															array(
															$board_idx
															),
															$data
															);

	}

	// 2. 포토게시판댓글 상세
	public function board_reply_detail($data){
		$board_reply_idx = $data['board_reply_idx'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							a.parent_board_reply_idx,
							a.grand_parent_board_reply_idx,
							a.reply_depth,
							(a.reply_depth+1) as next_depth ,
							ifnull((select max(reply_depth)+1 from tbl_board_reply where depth=1 and parent_board_reply_idx='$board_reply_idx'),1) as next_reply_depth
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


	// 5. 포토게시판등록
	public function	board_reg_in($data){
		$member_idx     = $data['member_idx'];
		$title = $data['title'];
		$contents        = $data['contents'];
		$board_img         = $data['board_img'];
		$category         = $data['category'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board
							(
								member_idx,
								title,
								contents,
								board_img,
								category,
								del_yn,
								ins_date,
								upd_date
							) values (
								 ?,
								 ?,
								 ?,
								 ?,
								 ?,
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
										$member_idx,
										$title,
										$contents,
										$board_img,
										$category,
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

	// 6. 포토게시판수정
	public function board_mod_up($data){
		$board_idx     = $data['board_idx'];
		$title = $data['title'];
		$contents        = $data['contents'];
		$board_img         = $data['board_img'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							title = ?,
							contents = ?,
							board_img = ?,
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								array(
								$title,
								$contents,
								$board_img,
								$board_idx,
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

	// 6. 포토게시판수정
	public function board_repliable_mod_up($data){
		$board_idx     = $data['board_idx'];
		$repliable_yn         = $data['repliable_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							repliable_yn = ?,
							upd_date = NOW()
						WHERE
							board_idx = ?
						";

		$this->query($sql,
								array(
								$repliable_yn,
								$board_idx,
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

	// 5. 포토게시판댓글 등록
	public function	board_comment_reg_in($data){
		$member_idx     = $data['member_idx'];
		$board_idx     = $data['board_idx'];
		$reply_comment = $data['reply_comment'];
		$parent_board_reply_idx        = $data['parent_board_reply_idx'];
		$grand_parent_board_reply_idx        = $data['grand_parent_board_reply_idx'];
		$depth         = $data['depth'];
		$reply_depth         = $data['reply_depth'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board_reply
							(
								member_idx,
								board_idx,
								reply_comment,
								grand_parent_board_reply_idx,
								parent_board_reply_idx,
								depth,
								reply_depth,
								del_yn,
								ins_date,
								upd_date
							) values (
								?, -- admin_idx
								?, -- board_idx
								?, -- board_idx
								?, -- reply_comment
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
									$member_idx,
									$board_idx,
									$reply_comment,
									$grand_parent_board_reply_idx,
									$parent_board_reply_idx,
									$depth,
									$reply_depth,
									),
									$data
									);

			$sql = "UPDATE
								tbl_board
							SET
								reply_cnt = reply_cnt+1,
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



  //게시물신고
	public function	board_report_reg_in($data){
		$member_idx     = $data['member_idx'];
		$board_idx     = $data['board_idx'];
		$report_contents = $data['report_contents'];
		$img_path = $data['img_path'];
		$report_type = $data['report_type'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board_report
							(
								member_idx,
								board_idx,
								report_contents,
								img_path,
								report_type,
								del_yn,
								ins_date,
								upd_date
							) values (
								?, -- admin_idx
								?, -- board_idx
								?, -- reply_comment
								?, -- reply_comment
								?, -- reply_comment
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
									$member_idx,
									$board_idx,
									$report_contents,
									$img_path,
									$report_type,
									),
									$data
									);

		$sql = "UPDATE
							tbl_board
						SET
							report_cnt = report_cnt+1,
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


	//대글신고
	public function	board_reply_report_reg_in($data){
		$member_idx     = $data['member_idx'];
		$board_reply_idx     = $data['board_reply_idx'];
		$report_contents = $data['report_contents'];
		$report_type = $data['report_type'];
		$img_path = $data['img_path'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board_reply_report
							(
								member_idx,
								board_reply_idx,
								report_contents,
								img_path,
								report_type,
								board_type,
								del_yn,
								ins_date,
								upd_date
							) values (
								?, -- admin_idx
								?, -- board_idx
								?, -- reply_comment
								?, -- reply_comment
								?, -- reply_comment
								'0',
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
									$member_idx,
									$board_reply_idx,
									$report_contents,
									$img_path,
									$report_type,
									),
									$data
									);

			$sql = "UPDATE
								tbl_board_reply
							SET
								report_cnt = report_cnt+1,
								upd_date = NOW()
							WHERE
								board_reply_idx = ?
							";
			$this->query($sql,
									array(
									$board_reply_idx
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

	// 6. 포토게시판댓글 삭제
	public function reply_comment_del($data){
		$board_reply_idx = $data['board_reply_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board_reply
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							board_reply_idx = ?
						";

		$this->query($sql,
								array(
								$board_reply_idx
								),
								$data
								);

		// $sql = "UPDATE
		// 					tbl_board
		// 				SET
		// 					reply_cnt = reply_cnt-1,
		// 					upd_date = NOW()
		// 				WHERE
		// 					board_idx  in (select board_idx  from tbl_board_reply where board_reply_idx='$board_reply_idx' )
		// ";
		//
		// $this->query($sql,
		// 						array(
		// 						),
		// 						$data
		// 						);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}

	// 7. 게시물 삭제
	public function board_del($data){
		$board_idx = $data['board_idx'];

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


	// 내작성:: 게시판 리스트
	public function my_board_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							b.member_nickname,
							b.member_img,
							a.category,
							a.title,
							a.contents,
							a.board_img,
							a.like_cnt,
							a.scrap_cnt,
							a.reply_cnt,
							a.ins_date,
							TIMESTAMPDIFF(MINUTE ,a.ins_date,NOW()) AS diff,
							ifnull((SELECT like_yn  FROM tbl_board_like WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_like_yn,
							ifnull((SELECT scrap_yn  FROM tbl_board_scrap WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_scrap_yn,
							ifnull((SELECT COUNT(*) AS cnt FROM tbl_board_report WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),0) AS my_report_cnt
						FROM
							tbl_board a
						JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE		a.del_yn = 'N'
						and a.display_yn='Y'
						and a.member_idx='$member_idx'
		";

		$sql .=" ORDER BY a.board_idx desc limit ?, ?";

		return	$this->query_result($sql,
																array(
																	$page_no,
																	$page_size
																),
																$data
																);

	}

	// 내작성:: 리스트 총 카운트
	public function my_board_list_count($data){
	  $member_idx = $data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board a
						JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE	a.del_yn = 'N'
						and a.display_yn='Y'
						and a.member_idx='$member_idx'
		";

		return	$this->query_cnt($sql,
															array(
															),$data
															);

	}


	// 내가단 댓글 리스트
	public function my_reply_board_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_idx,
							a.member_idx,
							a.title,
							a.contents,
							a.category,
							a.ins_date,
							TIMESTAMPDIFF(MINUTE ,a.ins_date,NOW()) AS diff,
							a.ins_date,
							a.board_img,
							a.like_cnt,
							a.scrap_cnt,
							a.reply_cnt,
							b.member_nickname,
							b.member_img,
							ifnull((SELECT like_yn  FROM tbl_board_like WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_like_yn,
							ifnull((SELECT scrap_yn  FROM tbl_board_scrap WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS my_scrap_yn,
							ifnull((SELECT COUNT(*) AS cnt FROM tbl_board_report WHERE del_yn = 'N' AND board_idx = a.board_idx AND member_idx = '$member_idx'),0) AS my_report_cnt
						FROM tbl_board a
						JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE		a.del_yn = 'N'
						and a.display_yn='Y'
						and a.board_idx in (select board_idx from tbl_board_reply where del_yn='N' and member_idx ='$member_idx')


		";

		$sql .=" ORDER BY a.board_idx desc limit ?, ?";

		return	$this->query_result($sql,
																array(
																$page_no,
																$page_size
																),
																$data
																);

	}


	// 댓글 단 포토:: 리스트 총 카운트
	public function my_reply_board_list_count($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM tbl_board a
						JOIN tbl_member b ON b.member_idx = a.member_idx and b.del_yn='N'
						WHERE		a.del_yn = 'N'
						and a.display_yn='Y'
						and a.board_idx in (select board_idx from tbl_board_reply where del_yn='N' and member_idx ='$member_idx')

		";

		return	$this->query_cnt($sql,
															array(
															),$data
															);

	}


	// 좋아요::리스트
	public function board_like_list($data){
		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_like_idx,
							a.board_idx,
							a.member_idx,
							a.ins_date,
							b.board_img,
							b.title,
							b.category,
							b.contents,
							b.view_cnt,
							b.reply_cnt,
							b.scrap_cnt,
							b.like_cnt,
							b.report_cnt,
							b.display_yn,
							c.member_nickname,
							c.member_img
						FROM  tbl_board_like as a
							join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N'  and b.display_yn='Y'
							join tbl_member as c on c.member_idx=b.member_idx and c.del_yn='N'
						WHERE a.like_yn='Y'
							and a.del_yn='N'
							AND a.member_idx =?

		";
		$sql .=" ORDER BY a.board_like_idx DESC  limit ?, ?";

		return $this->query_result($sql,
															array(
																$member_idx,
																$page_no,
																$page_size
															),$data
														);
	}

	//카운트
	public function board_like_list_count($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							count(1) as cnt
						FROM  tbl_board_like as a
							join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N'  and b.display_yn='Y'
							join tbl_member as c on c.member_idx=b.member_idx and c.del_yn='N'
						WHERE a.like_yn='Y'
							and a.del_yn='N'
							AND a.member_idx =?

		";

		return $this->query_cnt($sql,
															array(
																$member_idx,
															),$data
														);
	}

	//등록
	public function board_like_reg_in($data){

		$board_idx  = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_like
						(
						member_idx,
						board_idx,
						like_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_idx=?,like_yn=if(like_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_idx,
									$member_idx,
									$board_idx,
								 ),$data
							 );

		$sql="UPDATE tbl_board as a,
					(
					 select
						$board_idx as board_idx,
						 count(*) as cnt
					 from tbl_board_like
					 where del_yn='N'
					 and board_idx='$board_idx'
					 and like_yn='Y'
					) as b
					set
						like_cnt =b.cnt
					where a.board_idx=b.board_idx
		";
		$this->query($sql,array(

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


	// scrap::리스트
	public function board_scrap_list($data){
		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_scrap_idx,
							a.board_idx,
							a.member_idx,
							a.ins_date,
							b.board_img,
							b.title,
							b.category,
							b.contents,
							b.view_cnt,
							b.reply_cnt,
							b.scrap_cnt,
							b.like_cnt,
							b.report_cnt,
							b.display_yn,
							c.member_nickname,
							c.member_img
						FROM  tbl_board_scrap as a
							join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N'  and b.display_yn='Y'
							join tbl_member as c on c.member_idx=b.member_idx and c.del_yn='N'
						WHERE a.scrap_yn='Y'
							and a.del_yn='N'
							AND a.member_idx =?

		";
		$sql .=" ORDER BY a.board_scrap_idx DESC  limit ?, ?";

		return $this->query_result($sql,
															array(
																$member_idx,
																$page_no,
																$page_size
															),$data
														);
	}

	//카운트
	public function board_scrap_list_count($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							count(1) as cnt
						FROM  tbl_board_scrap as a
							join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N' and b.display_yn='Y'
							join tbl_member as c on c.member_idx=b.member_idx and c.del_yn='N'
						WHERE a.scrap_yn='Y'
							and a.del_yn='N'
							AND a.member_idx =?
		";

		return $this->query_cnt($sql,
															array(
																$member_idx,
															),$data
														);
	}




	//scrap 등록
	public function board_scrap_reg_in($data){

		$board_idx  = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_scrap
						(
						member_idx,
						board_idx,
						scrap_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_idx=?,scrap_yn=if(scrap_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_idx,
									$member_idx,
									$board_idx,
								 ),$data
							 );

		$sql="UPDATE tbl_board as a,
					(
					 select
						$board_idx as board_idx,
						 count(*) as cnt
					 from tbl_board_scrap
					 where del_yn='N'
					 and board_idx='$board_idx'
					 and scrap_yn='Y'
					) as b
					set
						scrap_cnt =b.cnt
					where a.board_idx=b.board_idx
		";
		$this->query($sql,array(

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


	// 댓글좋아요 등록
	public function board_reply_like_reg_in($data){

		$board_reply_idx  = $data['board_reply_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_reply_like
						(
						member_idx,
						board_reply_idx,
						like_yn,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_reply_idx=?,like_yn=if(like_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_reply_idx,
									$member_idx,
									$board_reply_idx,
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

}	//클래스의 끝
?>
