<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-10-19
| Memo : 커뮤니티
|------------------------------------------------------------------------
*/

Class Model_community extends MY_Model{
	
	// 베스트 고민 리스트
	public function best_community_list(){

		$sql = "SELECT
							a.main_section_idx,
							a.board_idx,
							a.rank,
							c.category_name,
							b.title,
							b.view_cnt,
							b.like_cnt,
							b.reply_cnt,
							b.display_yn,
							b.del_yn
						FROM
							tbl_main_section as a
							JOIN tbl_board as b ON b.board_idx =a.board_idx
							JOIN tbl_category_management as c ON c.category_management_idx=b.category_idx
						WHERE
							a.del_yn = 'N'
							and a.menu_type=2
							and a.display_yn='Y'
			";

			return $this->query_result($sql,
															array(
															)
															);
	}

	// 완료한 프로그램
	public function complete_program_list(){
		$date = date('Y-m-d');
		$member_idx = $this->member_idx;

		$sql = "SELECT
							a.member_program_record_idx,
							a.member_program_idx,
							b.program_idx,
							b.title,
							b.img_path,
							b.exercise_time,
							a.excercise_yn,
							a.record_time
						FROM
							tbl_member_program_record as a
							JOIN tbl_program as b ON b.program_idx = a.program_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
							and a.excercise_yn='Y'
							and DATE_FORMAT(a.excercise_date, '%Y-%m-%d')='$date'
							and a.member_idx= $member_idx
						ORDER BY a.ins_date
		";

		return $this->query_result($sql, array());
	}

	// 카테고리 리스트
	public function category_list(){

		$sql = "SELECT
							a.category_management_idx,
							a.category_name
						FROM
							tbl_category_management as a
						WHERE
							a.del_yn = 'N'
							and a.type=1
							and a.state=1
			";

			return $this->query_result($sql,
															array(
															)
															);
	}

	//  리스트
	public function community_list($data){
		$board_type = $data['board_type'];
		$member_idx = $data['member_idx'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$result = array();

		$sql = "SELECT
							a.board_idx, 
							a.board_type, 
							a.member_idx, 
							a.category_idx, 
							b.category_name, 
							c.board_report_idx,
							(select block_yn from tbl_board_block where member_idx=$member_idx and board_idx=a.board_idx) as block_yn,
							FN_AES_DECRYPT(d.member_name) AS member_name,
							d.member_img, 
							a.tag, 
							a.title, 
							a.contents, 
							a.board_img, 
							a.url_link, 
							a.repliable_yn, 
							a.display_yn, 
							a.del_yn, 
							DATE_FORMAT(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							IFNULL(t.like_yn, 'N') AS like_yn,
							a.upd_date, 
							a.program_record, 
							a.like_cnt, 
							a.view_cnt, 
							a.reply_cnt, 
							a.report_cnt, 
							a.scrap_cnt
						FROM
							tbl_board a
							join tbl_member d on d.member_idx=a.member_idx and d.del_yn='N'
							left JOIN tbl_category_management b on b.category_management_idx =a.category_idx and b.del_yn='N'
							left join tbl_board_report as c on c.board_idx=a.board_idx and c.member_idx=$member_idx and c.del_yn='N'
							LEFT JOIN tbl_board_like t ON t.member_idx = '$member_idx' AND t.board_idx = a.board_idx and t.del_yn = 'N'
						WHERE
							a.board_type = $board_type
							AND a.del_yn = 'N'
							AND a.display_yn = 'Y'
							and a.member_idx = $member_idx
			";

		$sql .= " ORDER BY a.ins_date DESC limit ?,? ";

		$community_list= $this->query_result($sql,
														array(
															$page_no,
															$page_size
														));

		$i=0;
		foreach($community_list as $row){
			if(!empty($row->program_record)){

			$sql = "SELECT
								a.member_program_record_idx, 
								a.member_program_idx, 
								a.member_idx, 
								a.program_idx, 
								a.title, 
								a.img_path, 
								a.yoil, 
								DATE_FORMAT(a.s_date, '%Y-%m-%d') AS s_date,
								DATE_FORMAT(a.e_date, '%Y-%m-%d') AS e_date,
								a.excercise_date, 
								a.record_time, 
								a.excercise_yn, 
								a.del_yn, 
								a.ins_date, 
								a.upd_date
							FROM
								tbl_member_program_record as a 
							WHERE
								a.member_program_record_idx in ($row->program_record)
								AND a.del_yn = 'N'
					";

			$community_list[$i]->program_record= $this->query_result($sql,array(
																																		),$data
																														);
			}
		$i++;}

		$result['community_list']=$community_list;

		return $result;
	}
	//  리스트 카운트
	public function community_list_count($data){
		$board_type = $data['board_type'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							count(*) as cnt
				FROM
					tbl_board a
					join tbl_member d on d.member_idx=a.member_idx and d.del_yn='N'
					left JOIN tbl_category_management b on b.category_management_idx =a.category_idx and b.del_yn='N'
					left join tbl_board_report as c on c.board_idx=a.board_idx and c.member_idx=$member_idx and c.del_yn='N'
					LEFT JOIN tbl_board_like t ON t.member_idx = '$member_idx' AND t.board_idx = a.board_idx and t.del_yn = 'N'
				WHERE
					a.board_type = $board_type
					AND a.del_yn = 'N'
					AND a.display_yn = 'Y'
					and a.member_idx = $member_idx
			";

		return	$this->query_cnt($sql,array());
	}

	// 상세
	public function community_detail($data){
		$board_idx = $data['board_idx'];
		$member_idx = $this->member_idx;

		$result = array();

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_board
						SET
							view_cnt =view_cnt+1,
							upd_date = NOW()
						WHERE
							board_idx = ?
					";

		$this->query($sql,array(
										$board_idx,
									),$data
								);	

		$sql = "SELECT
							a.board_idx,
							a.board_type,
							a.member_idx,
							a.category_idx,
							a.title,
							a.contents,
							a.board_img,
							a.program_record,
							a.display_yn,
							DATE_FORMAT(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							DATE_FORMAT(a.ins_date, '%H') AS ins_time,
							DATE_FORMAT(a.ins_date, '%i') AS ins_min,
							a.del_yn,
							a.like_cnt,
							a.view_cnt,
							a.reply_cnt,
							a.report_cnt,
							b.member_img,
							b.member_nickname,
							d.category_name,
							if(b.member_idx='$member_idx', 'Y', 'N') as my_board_yn,
							IF(r.board_report_idx>0, 'Y', 'N') AS report_yn,
							IFNULL(t.like_yn, 'N') AS like_yn,
							IF(a.member_idx='$member_idx', 'Y', 'N') AS my_board_yn,
							ifnull((SELECT block_yn  FROM tbl_board_block WHERE board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS block_yn						
						FROM
							tbl_board a
							LEFT JOIN tbl_member b ON b.member_idx = a.member_idx
							LEFT JOIN tbl_category_management d ON d.category_management_idx = a.category_idx
							LEFT JOIN tbl_board_report r ON r.member_idx = '$member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'
							LEFT JOIN tbl_board_like t ON t.member_idx = '$member_idx' AND t.board_idx = a.board_idx and t.del_yn = 'N'
						WHERE
							a.board_idx = ?
			";

		$result['community_detail']= $this->query_row($sql,
															array(
															$board_idx
															),
															$data
															);

		$result['program_record'] = array();

		if($result['community_detail']->program_record!=''){

			$program_record = $result['community_detail']->program_record;

			$sql = "SELECT
								a.member_program_record_idx, 
								a.member_program_idx, 
								a.member_idx, 
								a.program_idx, 
								a.title, 
								a.img_path, 
								a.yoil, 
								DATE_FORMAT(a.s_date, '%Y-%m-%d') AS s_date,
								DATE_FORMAT(a.e_date, '%Y-%m-%d') AS e_date,
								a.excercise_date, 
								a.record_time, 
								a.excercise_yn, 
								a.del_yn, 
								a.ins_date, 
								a.upd_date
							FROM
								tbl_member_program_record as a 
							WHERE
								a.member_program_record_idx in ($program_record)
								AND a.del_yn = 'N'
					";

			$result['program_record']= $this->query_result($sql,array(
																																		),$data
																														);
		}

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $result;
		}
	}

	public function community_mod_detail($data){
		$board_idx = $data['board_idx'];
		$member_idx = $this->member_idx;

		$result = array();

		$sql = "SELECT
							a.board_idx,
							a.board_type,
							a.member_idx,
							a.category_idx,
							a.title,
							a.contents,
							a.board_img,
							a.display_yn,
							DATE_FORMAT(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS excercise_date,
							DATE_FORMAT(a.ins_date, '%H') AS ins_time,
							DATE_FORMAT(a.ins_date, '%i') AS ins_min,
							a.del_yn,
							a.like_cnt,
							a.view_cnt,
							a.reply_cnt,
							a.report_cnt,
							a.program_record,
							b.member_img,
							b.member_nickname,
							d.category_name,
							if(b.member_idx='$member_idx', 'Y', 'N') as my_board_yn,
							IF(r.board_report_idx>0, 'Y', 'N') AS report_yn,
							IFNULL(t.like_yn, 'N') AS like_yn,
							IF(a.member_idx='$member_idx', 'Y', 'N') AS my_board_yn,
							ifnull((SELECT block_yn  FROM tbl_board_block WHERE board_idx = a.board_idx AND member_idx = '$member_idx'),'N') AS block_yn						
						FROM
							tbl_board a
							LEFT JOIN tbl_member b ON b.member_idx = a.member_idx
							LEFT JOIN tbl_category_management d ON d.category_management_idx = a.category_idx
							LEFT JOIN tbl_board_report r ON r.member_idx = '$member_idx' AND r.board_idx = a.board_idx and r.del_yn = 'N'
							LEFT JOIN tbl_board_like t ON t.member_idx = '$member_idx' AND t.board_idx = a.board_idx and t.del_yn = 'N'
						WHERE
							a.board_idx = ?
			";

		$result['community_detail']= $this->query_row($sql,
															array(
															$board_idx
															),
															$data
															);

		$result['program_record'] = array();

		if($result['community_detail']->program_record!=''){

			$excercise_date = $result['community_detail']->excercise_date;

			$sql = "SELECT
								a.member_program_record_idx, 
								a.member_program_idx, 
								a.member_idx, 
								a.program_idx, 
								a.title, 
								a.img_path, 
								a.yoil, 
								DATE_FORMAT(a.s_date, '%Y-%m-%d') AS s_date,
								DATE_FORMAT(a.e_date, '%Y-%m-%d') AS e_date,
								a.excercise_date, 
								a.record_time, 
								a.excercise_yn, 
								a.del_yn, 
								a.ins_date, 
								a.upd_date
							FROM
								tbl_member_program_record as a 
							WHERE
								a.excercise_date='$excercise_date'
								and a.excercise_yn='Y'
								AND a.del_yn = 'N'
					";

			$result['program_record']= $this->query_result($sql,array(
																																		),$data
																														);
		}
		
		return $result;
	}

	// 커뮤니티 수정
	public function community_mod_up($data){
		$board_idx = $data['board_idx'];
		$board_type = $data['board_type'];
		$title = $data['title'];
		$contents = $data['contents'];
		$img_path = $data['img_path'];
		$category_idx = $data['category_idx'];
		$member_idx = $data['member_idx'];
		$program_record = $data['program_record'];
	
		$this->db->trans_begin();
	
		$sql = "UPDATE
							tbl_board
						SET
							title = ?,
							contents = ?,
							board_img = ?,
							category_idx = ?,
							program_record = ?,
							upd_date = NOW()
						WHERE
							board_idx = ?
		";
	
		$this->query($sql,
								array(
									$title,
									$contents,
									$img_path,
									$category_idx,
									$program_record,
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

	// 커뮤니티 등록
	public function community_reg_in($data){

		$board_type = $data['board_type'];
		$title = $data['title'];
		$contents = $data['contents'];
		$img_path = $data['img_path'];
		$category_idx = $data['category_idx'];
		$program_record = $data['program_record'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_board
						(
							board_type,
							member_idx,
							category_idx,
							title,
							contents,
							board_img,
							program_record,
							display_yn,
							del_yn,
							ins_date,
							upd_date
						)VALUES(
							?, 
							?, 
							?, 
							?, 
							?, 
							?, 
							?, 
							'Y', 
							'N',
							NOW(),
							NOW()
						)
						";

		$this->query($sql,
								 array(
								 $board_type,
								 $member_idx,
								 $category_idx,
								 $title,
								 $contents,
								 $img_path,
								 $program_record
							   ),
								 $data);

		$board_idx = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return $board_idx;
		}
	}

	// 커뮤니티 삭제
	public function community_del($data){
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
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 신고 등록
	public function report_reg_in($data){

		$type = $data['type'];
		$board_idx = $data['board_idx'];
		$board_reply_idx = $data['board_reply_idx'];
		$report_type = $data['report_type'];
		$report_contents = $data['report_contents'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		if($type=='0'){

			$sql = "INSERT INTO
								tbl_board_report
							(
								board_idx,
								member_idx,
								report_type,
								report_contents,
								del_yn,
								ins_date,
								upd_date
							)VALUES(
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
									$board_idx,
									$member_idx,
									$report_type,
									$report_contents
									),
									$data);

			}else if($type=='1'){

				$sql = "INSERT INTO
									tbl_board_reply_report
								(
									board_reply_idx,
									member_idx,
									report_type,
									report_contents,
									del_yn,
									ins_date,
									upd_date
								)VALUES(
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
										$board_reply_idx,
										$member_idx,
										$report_type,
										$report_contents
										),
										$data);
			}

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
	   	return "1";
		}
	}

	// 댓글 등록
	public function cmt_reg_in($data){

		$type = $data['type']; //1번 답글 0번 댓글
		$board_idx = $data['board_idx'];
		$board_reply_idx = $data['board_reply_idx'];
		$cmt_contents = $data['cmt_contents'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		if($type=='0'){

			$sql = "INSERT INTO
								tbl_board_reply
							(
								board_idx,
								member_idx,
								reply_comment,
								depth,
								display_yn,
								del_yn,
								ins_date,
								upd_date
							)VALUES(
								?, 
								?, 
								?, 
								0, 
								'Y',
								'N',
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
									$board_idx,
									$member_idx,
									$cmt_contents
									),
									$data);

			}else if($type=='1'){

				$sql = "INSERT INTO
									tbl_board_reply
								(
									board_idx,
									member_idx,
									parent_board_reply_idx,
									reply_comment,
									depth,
									display_yn,
									del_yn,
									ins_date,
									upd_date
								)VALUES(
									?, 
									?, 
									?, 
									?, 
									1, 
									'Y',
									'N',
									NOW(),
									NOW()
								)
								";

					$this->query($sql,
										array(
											$board_idx,
											$member_idx,
											$board_reply_idx,
											$cmt_contents
										),
										$data);
			}

			$sql = "UPDATE
								tbl_board	as a
							SET
								a.reply_cnt = (select count(*) from tbl_board_reply where del_yn='N' and board_idx=a.board_idx),
								a.upd_date = NOW()
							WHERE
								a.board_idx = ?
			";
		
			$this->query($sql,
									array(
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

	// 댓글 수정
	public function cmt_mod_up($data){

		$board_idx = $data['board_idx'];
		$board_reply_idx = $data['board_reply_idx'];
		$cmt_contents = $data['cmt_contents'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

			$sql = "UPDATE
								tbl_board_reply	as a
							SET
								a.reply_comment = ?,
								a.upd_date = NOW()
							WHERE
								a.board_reply_idx = ?
			";
		
			$this->query($sql,
									array(
									$cmt_contents,
									$board_reply_idx
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

	// 댓글 삭제
	public function cmt_del($data){

		$board_idx = $data['board_idx'];
		$board_reply_idx = $data['board_reply_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

			$sql = "UPDATE
								tbl_board_reply	as a
							SET
								a.del_yn='Y',
								a.upd_date = NOW()
							WHERE
								a.board_reply_idx = ?
			";
		
			$this->query($sql,
									array(
									$board_reply_idx
									),
									$data
									);

			$sql = "UPDATE
								tbl_board	as a
							SET
								a.reply_cnt = (select count(*) from tbl_board_reply where del_yn='N' and board_idx=a.board_idx),
								a.upd_date = NOW()
							WHERE
								a.board_idx = ?
			";
		
			$this->query($sql,
									array(
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

	/*
	  | --------------------------------------------------------
	  |  댓글 및 답글
	  |________________________________________________________
	*/

	// 댓글 리스트
	public function board_comment_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.board_idx,
							a.admin_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.reply_comment,
							a.report_cnt,
							a.like_cnt,
							a.img_path,
							a.display_yn,
							a.del_yn,
							date_format(a.ins_date, '%Y.%m.%d. %H:%i') AS ins_date,
							date_format(a.ins_date, '%Y.%m.%d') AS ins_date_format,
							DATE_FORMAT(a.ins_date, '%H') AS ins_time,
							DATE_FORMAT(a.ins_date, '%i') AS ins_min,
							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.member_idx,
							b.member_nickname,
							d.member_idx AS reply_member_idx,
							d.member_nickname as reply_member_nickname,
							b.member_img,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_reply_yn,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							ifnull((SELECT like_yn  FROM tbl_board_reply_like WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = '$member_idx'),'N') AS like_yn,
							ifnull((SELECT block_yn  FROM tbl_board_reply_block WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = '$member_idx'),'N') AS block_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$this->member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = r.member_idx
						WHERE
							 a.board_idx = ?
							 AND a.depth = '0'
		";

		$sql.=" ORDER BY a.ins_date DESC limit ?, ? ";

		$result_list = $this->query_result($sql,
															array(
															$board_idx,
															$page_no,
															$page_size
															),
															$data
															);

		$x = 0;
		$data_array = array();

		foreach ($result_list as $row) {

			$data['parent_board_reply_idx'] = $row->board_reply_idx;
			$data['member_idx'] = $member_idx;

			$data_array[$x]['board_reply_idx']	= $row->board_reply_idx;
			$data_array[$x]['board_idx']	= $row->board_idx;
			$data_array[$x]['admin_idx']	= $row->admin_idx;
			$data_array[$x]['parent_board_reply_idx']	= $row->board_reply_idx;
			$data_array[$x]['depth']	= $row->depth;
			$data_array[$x]['reply_comment']	= $row->reply_comment;
			$data_array[$x]['like_cnt']	= $row->like_cnt;
			$data_array[$x]['display_yn']	= $row->display_yn;
			$data_array[$x]['del_yn']	= $row->del_yn;
			$data_array[$x]['member_idx']	= $row->member_idx;
			$data_array[$x]['member_nickname']	= $row->member_nickname;
			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['like_yn']	= $row->like_yn;
			$data_array[$x]['member_del_yn']	= $row->member_del_yn;
			$data_array[$x]['board_member_reply_yn']	= $row->board_member_reply_yn;
			$data_array[$x]['my_reply_yn']	= $row->my_reply_yn;
			$data_array[$x]['report_yn']	= $row->report_yn;
			$data_array[$x]['block_yn']	= $row->block_yn;
			$data_array[$x]['ins_date']	= $row->ins_date;
			$data_array[$x]['ins_date_format']	= $row->ins_date_format;
			$data_array[$x]['ins_time']	= $row->ins_time;
			$data_array[$x]['ins_min']	= $row->ins_min;
			$data_array[$x]['reply_member_idx']	= $row->reply_member_idx;
			$data_array[$x]['reply_member_nickname']	= $row->reply_member_nickname;
			$data_array[$x]['board_reply'] = $this->board_comment_reply_list($data);
			$data_array[$x]['board_reply_cnt'] = $this->board_comment_reply_list_count($data);
			$x++;
		}

		return $data_array;
	}

	// 댓글 리스트  count
	public function board_comment_list_count($data){

		$board_idx = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
             	COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							 a.board_idx = ?
		";

		return $this->query_cnt($sql,
															array(
															$board_idx,
															),
															$data
															);
	}

	// 답변 리스트
	public function board_comment_reply_list($data){

		$parent_board_reply_idx = $data['parent_board_reply_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.parent_board_reply_idx,
							a.board_idx,
							a.admin_idx,
							a.depth,
							a.reply_comment,
							a.like_cnt,
							a.display_yn,
							a.del_yn,
							date_format(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							date_format(a.ins_date, '%Y.%m.%d') AS ins_date_format,
							DATE_FORMAT(a.ins_date, '%H') AS ins_time,
							DATE_FORMAT(a.ins_date, '%i') AS ins_min,
							b.member_idx,
							b.member_nickname,
							d.member_idx AS reply_member_idx,
							d.member_nickname as reply_member_nickname,
							b.member_img,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_reply_yn,
							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							ifnull((SELECT like_yn  FROM tbl_board_reply_like WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = $this->member_idx),'N') AS like_yn,
							ifnull((SELECT block_yn  FROM tbl_board_reply_block WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = $this->member_idx),'N') AS block_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = $this->member_idx AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = r.member_idx
						WHERE
							 a.parent_board_reply_idx = ?
		";

		$sql.=" ORDER BY a.board_reply_idx ASC ";

		return $this->query_result($sql,array(
																$parent_board_reply_idx),
																$data);

	}

	public function board_comment_reply_list_more($data){

		$parent_board_reply_idx = $data['board_reply_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.board_reply_idx,
							a.parent_board_reply_idx,
							a.depth,
							a.reply_comment,
							a.like_cnt,
							a.display_yn,
							a.del_yn,
							date_format(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							b.member_idx,
							b.member_nickname,
							d.member_nickname as reply_member_nickname,
							b.member_img,
							if(a.member_idx='$this->member_idx', 'Y', 'N') as my_reply_yn,

							if(c.member_idx=b.member_idx, 'Y', 'N') as board_member_reply_yn,
							b.del_yn as member_del_yn,
							if(r.board_reply_report_idx>0, 'Y', 'N') as report_yn,
							ifnull((SELECT like_yn  FROM tbl_board_reply_like WHERE del_yn = 'N' AND board_reply_idx = a.board_reply_idx AND member_idx = '$member_idx'),'N') AS like_yn
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx 
							JOIN tbl_board c ON c.board_idx = a.board_idx and c.del_yn='N'
							LEFT JOIN tbl_board_reply_report r ON r.member_idx = '$member_idx' AND r.board_reply_idx = a.board_reply_idx and r.del_yn = 'N'
							LEFT JOIN tbl_member d ON d.member_idx = r.member_idx
						WHERE
							 a.depth = 1
							AND a.parent_board_reply_idx = ?
		";

		$sql.=" ORDER BY a.board_reply_idx ASC";

		return $this->query_result($sql,array(
																$parent_board_reply_idx),
																$data);

	}

	// 리스트  count
	public function board_comment_reply_list_count($data){

		$parent_board_reply_idx = $data['parent_board_reply_idx'];
		$member_idx = $data['member_idx'];

		$sql = "SELECT
             	COUNT(*) AS cnt
						FROM
							tbl_board_reply a
							JOIN tbl_member b ON b.member_idx = a.member_idx
						WHERE
							 a.depth = 1
							AND a.parent_board_reply_idx = ?
		";


		return $this->query_cnt($sql,
															array(
															$parent_board_reply_idx,

															),
															$data
															);

	}

		/*
	  | --------------------------------------------------------
	  |  좋아요
	  |________________________________________________________
	*/
	

		// 좋아요
		public function like_reg_in($data){

			$board_idx=$data['board_idx'];
			$member_idx=$data['member_idx'];
	
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
	
			$sql = "UPDATE
								tbl_board
							SET
								like_cnt =(select count(*) from tbl_board_like where del_yn='N' and board_idx=$board_idx and like_yn='Y')
							WHERE
								board_idx = ?
							";
	
			$this->query($sql,
										array(
										$board_idx
										),
										$data);
	
			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_board_like
							WHERE
							 del_yn='N' 
							 and board_idx=$board_idx 
							 and like_yn='Y'
							";
	
			$like_cnt = $this->query_cnt($sql,
																		array(
																		),
																		$data);
		
			if($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return "-1";
			}else{
				$this->db->trans_commit();
				return $like_cnt;
			}
		}
	

}	//클래스의 끝
?>
