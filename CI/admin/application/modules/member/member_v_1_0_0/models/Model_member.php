<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2022-08-22
| Memo : 회원 관리
|------------------------------------------------------------------------
*/

Class Model_member extends MY_Model {

//회원 리스트
	public function member_list($data) {
		
		$page_size=(int)$data['page_size'];
    $page_no=(int)$data['page_no'];

		$member_id=$data['member_id'];
		$member_nickname=$data['member_nickname'];
		$member_state=$data['member_state'];
		$s_date=$data['s_date'];
		$e_date=$data['e_date'];
	
		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
							member_nickname,
							member_join_type,
							member_gender,
							member_state,
							member_reported_cnt,
							DATE_FORMAT(ins_date, '%Y-%m-%d') AS ins_date,
							DATE_FORMAT(member_leave_date, '%Y-%m-%d') AS member_leave_date
						FROM
							tbl_member 
						WHERE
							member_idx!=2
					";
				
		if($member_id !=""){
			$sql .= " 	AND FN_AES_DECRYPT(member_id) LIKE '%$member_id%' ";
		}
		if($member_nickname !=""){
			$sql .= " 	AND member_nickname LIKE '%$member_nickname%' ";
		}
		if($member_state !=""){
			$sql .= " 	AND member_state LIKE '%$member_state%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
	

   $sql.="	ORDER BY ins_date DESC limit ?,? ";

    return $this->query_result($sql,
                                array(
																	$page_no,
                                  $page_size
																),
																$data
                              );

	}

	public function member_list_count($data) {
		
		$member_id=$data['member_id'];
		$member_nickname=$data['member_nickname'];
		$member_state=$data['member_state'];
		$s_date=$data['s_date'];
		$e_date=$data['e_date'];
	
		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member 
						WHERE
							member_idx!=2
					";
				
		if($member_id !=""){
			$sql .= " 	AND FN_AES_DECRYPT(member_id) LIKE '%$member_id%' ";
		}
		if($member_nickname !=""){
			$sql .= " 	AND member_nickname LIKE '%$member_nickname%' ";
		}
		if($member_state !=""){
			$sql .= " 	AND member_state LIKE '%$member_state%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(ins_date, '%Y-%m-%d') <= '$e_date' ";
		}
	
		return $this->query_cnt($sql,
                                array(
																),
																$data
                              );
	}

// 회원 상세보기 
public function member_detail($data){

	$member_idx = $data['member_idx'];		
	
	$sql = "SELECT
						a.member_idx,
						b.cnt,
						b.month_record_time,
						FN_AES_DECRYPT(a.member_id) AS member_id,
						FN_AES_DECRYPT(a.member_name) AS member_name,
						FN_AES_DECRYPT(a.member_phone) AS member_phone,
						a.member_gender,
						a.member_nickname,
						a.member_join_type,
						a.member_type,
						a.member_state,
						a.ins_date,
						a.exercise_goal, 
						a.exercise_goal_type, 
						a.exercise_s_time, 
						a.exercise_e_time, 
						a.exercise_part, 
						a.exercise_part_type, 
						a.waist_measurement, 
						DATE_FORMAT(a.member_leave_date, '%Y-%m-%d') AS member_leave_date,
						a.member_leave_cnt,
						a.member_reported_cnt,
						a.member_leave_reason,
						a.del_yn
				FROM
						tbl_member as a
						LEFT JOIN 
						(
						SELECT 
						member_idx,
						COUNT(*) AS cnt,
						SEC_TO_TIME( SUM( TIME_TO_SEC(record_time) ) ) AS month_record_time
						FROM
						tbl_member_program_record 
						WHERE
						del_yn='N'
						AND excercise_yn='Y'
						GROUP BY member_idx) as b ON b.member_idx =a.member_idx
				WHERE
				a.member_idx = ?
					";

	return  $this->query_row($sql,
													array(
													$member_idx
													),$data
													);
}

public function member_state_mod_up($data){

	$member_idx  = $data['member_idx'];
	$member_state = $data['member_state'];

	$this->db->trans_begin();

	$sql = "UPDATE
						tbl_member
					SET
						member_state = ?,
						upd_date = NOW()
					WHERE
						member_idx = ?
					";

	$this->query($sql,array(
							 $member_state,
							$member_idx
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


//회원 이용정지
	public function del_yn_mod_up($data){

		$member_idx = (int)$data['member_idx'];
		$member_state = $data['member_state'];
		$del_yn = $data['del_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							member_state =?,
							member_leave_cnt =if($member_state=1,member_leave_cnt+1,member_leave_cnt),
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

	$this->query($sql,
														array(
														$member_state,
														$member_idx
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


}
?>
