<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-10-28
| Memo : 프로그램
|------------------------------------------------------------------------
*/

Class Model_my_scrap extends MY_Model{

	// 포스트 리스트
	public function scrap_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];
		$member_idx = $data['member_idx'];
		$type = $data['type'];

		$sql = "SELECT
							a.scrap_idx,
							a.program_idx,
							a.news_idx,
							a.scrap_type,
							b.level, 
							b.title as program_title, 
							b.contents as program_contents, 
							b.img_path as program_img_path, 
							b.exercise_time, 
							b.view_cnt as program_view_cnt, 
							b.like_cnt as program_like_cnt, 
							c.news_idx, 
							c.title, 
							c.contents, 
							c.img_path, 
							c.view_cnt, 
							ifnull(d.display_yn,'Y') as display_yn
						FROM
							tbl_scrap as a
							left join tbl_program as b on b.program_idx=a.program_idx and b.del_yn='N'
							left join tbl_news as c on c.news_idx=a.news_idx and c.del_yn='N'
							and c.display_yn='Y'
							left join tbl_news_display as d on d.news_idx=c.news_idx and d.member_idx = $member_idx 
						WHERE
							a.del_yn='N'
							and a.scrap_yn='Y'
							and a.member_idx=$member_idx
						";

		if($type !=''){
				$sql .= " AND  a.scrap_type = '$type' ";
		}

		$sql .="ORDER BY a.upd_date DESC LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 포스트 리스트 총 카운트
	public function scrap_list_count($data){
		$member_idx = $data['member_idx'];
		$type = $data['type'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_scrap as a
							left join tbl_program as b on b.program_idx=a.program_idx and b.del_yn='N'
							left join tbl_news as c on c.news_idx=a.news_idx and c.del_yn='N'
							and c.display_yn='Y'
							left join tbl_news_display as d on d.news_idx=c.news_idx and d.member_idx = $member_idx 
						WHERE
							a.del_yn='N'
							and a.scrap_yn='Y'
							and a.member_idx=$member_idx
						";

		if($type !=''){
				$sql .= " AND  a.scrap_type = '$type' ";
		}

		return $this->query_cnt($sql,array());
	}

	// 조회수 up
	public function scrap_del($data){

		$key_idx = $data['key_idx'];
		$type = $data['type'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		if($type=='0'){
			$sql = "UPDATE
								tbl_scrap
							SET
								scrap_yn = 'N',
								upd_date = now()
							WHERE
								del_yn='N'
								and program_idx = ?
								and member_idx = $member_idx
							";

					$this->query($sql,
										array(
										$key_idx
										),
										$data);

		}else if($type=='1'){
			$sql = "UPDATE
								tbl_scrap
							SET
								scrap_yn = 'N',
								upd_date = now()
							WHERE
								del_yn='N'
								and news_idx = ?
								and member_idx = $member_idx
							";

					$this->query($sql,
										array(
										$key_idx
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


}	//클래스의 끝
?>
