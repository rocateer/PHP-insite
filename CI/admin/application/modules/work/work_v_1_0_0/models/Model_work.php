<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2023-04-25
| Memo : 직종 승인 관리
|------------------------------------------------------------------------
*/

Class Model_work extends MY_Model {

//회원 리스트
	public function work_list($data) {
		
		$page_size=(int)$data['page_size'];
    $page_no=(int)$data['page_no'];

		$member_id=$data['member_id'];
		$member_name=$data['member_name'];
		$member_nickname=$data['member_nickname'];
		$state=$data['state'];
		$work=$data['work'];
		$s_date=$data['s_date'];
		$e_date=$data['e_date'];
	
		$sql = "SELECT
							a.work_confirm_idx,
							a.member_idx,
							a.state,
							a.work_name,
							FN_AES_DECRYPT(b.member_id) AS member_id,
							FN_AES_DECRYPT(b.member_name) AS member_name,
							FN_AES_DECRYPT(b.member_phone) AS member_phone,
							b.member_nickname,
							b.del_yn,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS ins_date
						FROM
							tbl_work_confirm as a
							JOIN tbl_member as b on b.member_idx=a.member_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
					";
				
		if($work !=""){
			$sql .= " 	AND a.work_name LIKE '%$work%' ";
		}
		if($member_name !=""){
			$sql .= " 	AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($member_id !=""){
			$sql .= " 	AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}
		if($member_nickname !=""){
			$sql .= " 	AND b.member_nickname LIKE '%$member_nickname%' ";
		}
		if($state !=""){
			$sql .= " 	AND a.state LIKE '%$state%' ";
		}
		if($s_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE_FORMAT(a.ins_date, '%Y-%m-%d') <= '$e_date' ";
		}

   $sql.="	ORDER BY a.ins_date DESC limit ?,? ";

    return $this->query_result($sql,
                                array(
																	$page_no,
                                  $page_size
																),
																$data
                              );

	}

	public function work_list_count($data) {
		
		$member_id=$data['member_id'];
		$member_name=$data['member_name'];
		$member_nickname=$data['member_nickname'];
		$state=$data['state'];
		$work=$data['work'];
		$s_date=$data['s_date'];
		$e_date=$data['e_date'];
	
		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_work_confirm as a
							JOIN tbl_member as b on b.member_idx=a.member_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
					";
				
		if($work !=""){
			$sql .= " 	AND a.work_name LIKE '%$work%' ";
		}
		if($member_name !=""){
			$sql .= " 	AND FN_AES_DECRYPT(b.member_name) LIKE '%$member_name%' ";
		}
		if($member_id !=""){
			$sql .= " 	AND FN_AES_DECRYPT(b.member_id) LIKE '%$member_id%' ";
		}
		if($member_nickname !=""){
			$sql .= " 	AND b.member_nickname LIKE '%$member_nickname%' ";
		}
		if($state !=""){
			$sql .= " 	AND a.state LIKE '%$state%' ";
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
																$data
                              );
	}

// 회원 상세보기 
public function work_detail($data){

	$work_confirm_idx = $data['work_confirm_idx'];		
	
	$sql = "SELECT
						a.work_confirm_idx,
						a.work_idx,
						a.member_idx,
						a.state,
						a.memo,
						a.img,
						a.work_name,
						FN_AES_DECRYPT(b.member_id) AS member_id,
						FN_AES_DECRYPT(b.member_name) AS member_name,
						FN_AES_DECRYPT(b.member_phone) AS member_phone,
						b.member_nickname,
						b.del_yn,
						DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS ins_date,
						DATE_FORMAT(a.admission_date, '%Y-%m-%d') AS admission_date
					FROM
						tbl_work_confirm as a
						JOIN tbl_member as b on b.member_idx=a.member_idx and b.del_yn='N'
					WHERE
						a.work_confirm_idx = ?
					";

	return  $this->query_row($sql,
													array(
													$work_confirm_idx
													),$data
													);
}

//회원 이용정지
	public function state_mod_up($data){

		$member_idx = (int)$data['member_idx'];
		$work_confirm_idx = (int)$data['work_confirm_idx'];
		$state = $data['state'];
		$reject_reason = $data['reject_reason'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_work_confirm
						SET
							state =?,
							admission_date = if($state=1,now(),admission_date)
						WHERE
							work_confirm_idx = ?
		";

		$this->query($sql,
										array(
										$state,
										$work_confirm_idx
										),$data
										);

			if($state==1){

				$sql = "UPDATE
									tbl_member
								SET
									work_confirm_idx =?,
									work_yn ='Y'
								WHERE
									member_idx = ?
					";

				$this->query($sql,
											array(
												$work_confirm_idx,
												$member_idx
											),$data
											);
				
			}else if($state==2){
				
			$sql = "UPDATE	
								tbl_work_confirm
							SET
								reject_reason =?
							WHERE
								work_confirm_idx = ?
						";

						$this->query($sql,
											array(
											$reject_reason,
											$work_confirm_idx
											),$data
											);
			}

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

//회원 메모
	public function memo_mod_up($data){

		$work_confirm_idx = (int)$data['work_confirm_idx'];
		$memo = $data['memo'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_work_confirm
						SET
							memo =?
						WHERE
							work_confirm_idx = ?
		";

		$this->query($sql,
										array(
										$memo,
										$work_confirm_idx
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
