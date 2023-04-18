<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-06-27
| Memo : 포스트
|------------------------------------------------------------------------
*/

Class Model_board extends MY_Model{

	// 포스트 리스트
	public function board_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$sql = "SELECT
							a.news_idx, 
							a.title, 
							a.contents, 
							a.img_path, 
							a.display_yn, 
							a.view_cnt, 
							a.del_yn, 
							ifnull(b.display_yn,'Y') as display_yn,
							DATE_FORMAT(a.ins_date, '%Y.%m.%d') AS ins_date,
							a.upd_date
						FROM
							tbl_news as a
							left join tbl_news_display as b on b.news_idx=a.news_idx and b.member_idx =$member_idx
						WHERE
							a.del_yn='N'
							and a.display_yn='Y'
							order by a.ins_date DESC
						";

		$sql .=" LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 포스트 리스트 총 카운트
	public function board_list_count($data){

		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_news as a
							left join tbl_news_display as b on b.news_idx=a.news_idx and b.member_idx =$member_idx
						WHERE
							a.del_yn='N'
							and a.display_yn='Y'
						";

		return $this->query_cnt($sql,array());
	}

	// 포스트 상세
	public function board_detail($data){

		$news_idx = $data['news_idx'];
		$member_idx=($this->member_idx=='')?'0':$this->member_idx;

		$this->cnt_mod_up($data);

		$sql = "SELECT
	          	a.news_idx,
							a.title, 
							a.contents, 
							a.img_path, 
							a.display_yn, 
							a.view_cnt, 
							a.del_yn, 
							ifnull(b.scrap_yn,'N') as scrap_yn,
							ifnull(c.display_yn,'Y') as display_yn,
							DATE_FORMAT(a.ins_date, '%Y.%m.%d %H:%i') AS ins_date,
							a.upd_date
	        	FROM
							tbl_news as a
							LEFT JOIN tbl_scrap as b ON b.news_idx=a.news_idx and b.member_idx =$member_idx
							left join tbl_news_display as c on c.news_idx=a.news_idx and c.member_idx =$member_idx
	        	WHERE
	           	a.news_idx = ?
							AND a.del_yn = 'N'
					";

   		return $this->query_row($sql,array(
														  $news_idx
														  ),$data
														);
	}

		// 조회수 up
		public function cnt_mod_up($data){

			$news_idx = $data['news_idx'];
			$member_idx=($this->member_idx=='')?'0':$this->member_idx;
	
			$this->db->trans_begin();
	
			$sql = "UPDATE
								tbl_news
							SET
								view_cnt = view_cnt+1
							WHERE
								news_idx = ?
							";
	
			$this->query($sql,
									 array(
									 $news_idx
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
	

	// 프로그램 담기
	public function scrap_mod_up($data){

		$news_idx=$data['news_idx'];
		$member_idx=$data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_scrap
						(
						member_idx,
						news_idx,
						scrap_yn,
						scrap_type,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						'Y',
						1,
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,news_idx=?,scrap_yn=if(scrap_yn='N','Y','N'),upd_date=NOW()
		";
	
		$this->query($sql,array(
									$member_idx,
									$news_idx,
									$member_idx,
									$news_idx,
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
