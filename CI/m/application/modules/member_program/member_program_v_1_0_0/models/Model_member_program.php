<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-09-28
| Memo : 프로그램
|------------------------------------------------------------------------
*/

Class Model_member_program extends MY_Model{

	// 포스트 리스트
	public function member_program_list($data){

		$page_size = (int)$data['page_size'];
		$page_no 	 = (int)$data['page_no'];

		$member_idx=$data['member_idx'];

		$sql = "SELECT
							a.member_program_idx, 
							a.member_idx, 
							a.program_idx, 
							b.img_path, 
							b.title, 
							a.yoil, 
							DATE_FORMAT(a.s_date, '%Y-%m-%d') AS s_date,
							DATE_FORMAT(a.e_date, '%Y-%m-%d') AS e_date,
							a.e_date_yn, 
							a.del_yn, 
							a.ins_date, 
							a.upd_date
						FROM
							tbl_member_program as a
							JOIN tbl_program as b ON b.program_idx=a.program_idx and b.del_yn='N' and b.display_yn='Y'
						WHERE
							a.del_yn='N'
							and a.member_idx=$member_idx
						";

		$sql .="ORDER BY a.s_date LIMIT ?, ? ";

		return $this->query_result($sql,array(
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 포스트 리스트 총 카운트
	public function member_program_list_count($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member_program as a
							JOIN tbl_program as b ON b.program_idx=a.program_idx and b.del_yn='N' and b.display_yn='Y'
						WHERE
							a.del_yn='N'
							and a.member_idx=$member_idx
						";

		return $this->query_cnt($sql,array());
	}


	// 삭제하기
	public function member_program_del($data){

		$member_program_idx = $data['member_program_idx'];
		$now = date('Y-m-d');

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member_program
						SET
							del_yn='Y',
							upd_date=now()
						WHERE
							member_program_idx = ?
						";

		$this->query($sql,
									array(
									$member_program_idx
									),
									$data);

		$sql = "UPDATE
							tbl_member_program_record
						SET
							del_yn='Y',
							upd_date=now()
						WHERE
							member_program_idx = ?
							and del_yn='N'
							and DATE_FORMAT(excercise_date, '%Y-%m-%d')>=$now;
						";

		$this->query($sql,
									array(
									$member_program_idx
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
