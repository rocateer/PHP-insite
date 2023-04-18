<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-10-31
| Memo : 위시리스트
|------------------------------------------------------------------------
*/

Class Model_like extends MY_Model {

	
	// 포스트 리스트
	public function like_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];
		$like_type = $data['like_type'];
		$member_idx = $data['member_idx'];

		$result = array();

		$sql = "SELECT
							a.program_like_idx,
							a.program_idx,
							b.level, 
							b.title as program_title, 
							b.contents as program_contents, 
							b.img_path as program_img_path, 
							b.exercise_time, 
							b.view_cnt as program_view_cnt, 
							b.like_cnt as program_like_cnt
						FROM
							tbl_program_like as a
							left join tbl_program as b on b.program_idx=a.program_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
							and a.like_yn='Y'
							and a.member_idx=$member_idx
						";

		$sql .="order by a.upd_date desc LIMIT ?, ? ";

		$result['program_list'] =  $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
														 
		$sql = "SELECT
							a.board_like_idx,
							a.board_idx,
							b.member_idx,
							c.category_name,
							b.title,
							b.view_cnt,
							b.like_cnt,
							b.reply_cnt,
							b.display_yn,
							b.del_yn,
							d.board_report_idx,
							ifnull(block_yn,'N') as block_yn
						FROM
							tbl_board_like as a
							join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N'
							left JOIN tbl_category_management as c ON c.category_management_idx=b.category_idx
							left join tbl_board_report as d on d.board_idx=a.board_idx and d.del_yn='N' and d.member_idx=$member_idx
							left join tbl_board_block as e on e.board_idx=a.board_idx and e.member_idx=$member_idx
						WHERE
							a.del_yn='N'
							and a.like_yn='Y'
							and a.member_idx=$member_idx
							AND b.board_type=0
						";

		$sql .="order by a.upd_date desc LIMIT ?, ? ";

		$result['board0_list'] =  $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );

		$sql = "SELECT
							a.board_like_idx,
							a.board_idx,
							FN_AES_DECRYPT(f.member_name) AS member_name,
							f.member_nickname, 
							f.member_img, 
							DATE_FORMAT(b.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							c.category_name,
							b.member_idx,
							b.title,
							b.contents,
							b.board_img, 
							b.view_cnt,
							b.like_cnt,
							b.reply_cnt,
							b.display_yn,
							b.program_record, 
							'Y' AS like_yn,
							b.del_yn,
							d.board_report_idx,
							ifnull(block_yn,'N') as block_yn
						FROM
							tbl_board_like as a
							join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N'
							left JOIN tbl_category_management as c ON c.category_management_idx=b.category_idx
							left join tbl_board_report as d on d.board_idx=a.board_idx and d.del_yn='N' and d.member_idx=$member_idx
							left join tbl_board_block as e on e.board_idx=a.board_idx and e.member_idx=$member_idx
							left join tbl_member as f on f.member_idx = b.member_idx 
						WHERE
							a.del_yn='N'
							and a.like_yn='Y'
							and a.member_idx=$member_idx
							AND b.board_type=1
						";

		$sql .="order by a.upd_date desc LIMIT ?, ? ";

		$result_list =  $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );

		$i=0;
		foreach($result_list as $row){
			if(!empty($row->program_record)){

			$sql = "SELECT
								a.member_program_record_idx, 
								a.member_program_idx, 
								a.member_idx, 
								a.program_idx, 
								a.title, 
								a.img_path, 
								a.yoil, 
								DATE_FORMAT(a.s_date, '%Y.%m.%d') AS s_date,
								DATE_FORMAT(a.e_date, '%Y.%m.%d') AS e_date,
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

			$result_list[$i]->program_record= $this->query_result($sql,array(
																																		),$data
																														);
			}
		$i++;}

		$result['board1_list']=$result_list;

		return $result;
	}

	// 포스트 리스트 총 카운트
	public function like_list_count($data){
		$member_idx = $data['member_idx'];
		$like_type = $data['like_type'];

		if($like_type==0){

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_program_like as a
								left join tbl_program as b on b.program_idx=a.program_idx and b.del_yn='N'
							WHERE
								a.del_yn='N'
								and a.like_yn='Y'
								and a.member_idx=$member_idx
							";

		return  $this->query_cnt($sql,array(
													),$data
												);

		}else if($like_type==1){

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_board_like as a
								join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N'
								left JOIN tbl_category_management as c ON c.category_management_idx=b.category_idx
								left join tbl_board_report as d on d.board_idx=a.board_idx and d.del_yn='N' and d.member_idx=$member_idx
								left join tbl_board_block as e on e.board_idx=a.board_idx and e.member_idx=$member_idx
							WHERE
								a.del_yn='N'
								and a.like_yn='Y'
								and a.member_idx=$member_idx
								AND b.board_type=0
						";

			return $this->query_cnt($sql,array(
															 ),$data
														 );

		}else if($like_type==2){

			$sql = "SELECT
								count(*) as cnt
							FROM
								tbl_board_like as a
								join tbl_board as b on b.board_idx=a.board_idx and b.del_yn='N'
								left JOIN tbl_category_management as c ON c.category_management_idx=b.category_idx
								left join tbl_board_report as d on d.board_idx=a.board_idx and d.del_yn='N' and d.member_idx=$member_idx
								left join tbl_board_block as e on e.board_idx=a.board_idx and e.member_idx=$member_idx
							WHERE
								a.del_yn='N'
								and a.like_yn='Y'
								and a.member_idx=$member_idx
								AND b.board_type=1
						";

		 return $this->query_cnt($sql,array(
															 ),$data
														 );

		}

	}
}
?>
