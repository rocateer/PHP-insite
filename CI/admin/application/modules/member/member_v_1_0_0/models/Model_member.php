<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2023-04-19
| Memo : 회원 관리
|------------------------------------------------------------------------
*/

Class Model_member extends MY_Model {

//회원 리스트
	public function member_list($data) {
		
		$page_size=(int)$data['page_size'];
    $page_no=(int)$data['page_no'];

		$member_id=$data['member_id'];
		$member_name=$data['member_name'];
		$member_nickname=$data['member_nickname'];
		$member_state=$data['member_state'];
		$member_join_type=$data['member_join_type'];
		$city_name=$data['city_name'];
		$region_code=$data['region_code'];
		$work=$data['work'];
		$s_date=$data['s_date'];
		$e_date=$data['e_date'];
	
		$sql = "SELECT
							a.member_idx,
							FN_AES_DECRYPT(a.member_id) AS member_id,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							FN_AES_DECRYPT(a.member_phone) AS member_phone,
							a.member_nickname,
							a.member_join_type,
							a.member_gender,
							a.del_yn,
							b.work_name,
							c.city_name,
							c.region_name,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS ins_date,
							DATE_FORMAT(a.member_leave_date, '%Y-%m-%d') AS member_leave_date
						FROM
							tbl_member as a
							LEFT JOIN tbl_work_confirm as b on b.work_confirm_idx=a.work_confirm_idx and b.del_yn='N' and b.state=1
							LEFT JOIN tbl_region as c on c.region_code=a.region_code
						WHERE
							1=1
					";
				
		if($work !=""){
			$sql .= " 	AND b.work_name LIKE '%$work%' ";
		}
		if($member_join_type !=""){
			$sql .= " 	AND a.member_join_type = '$member_join_type' ";
		}
		if($city_name !=""){
			$sql .= " 	AND c.city_name LIKE '%$city_name%' ";
		}
		if($region_code !=""){
			$sql .= " 	AND a.region_code = $region_code ";
		}
		if($member_name !=""){
			$sql .= " 	AND FN_AES_DECRYPT(a.member_name) LIKE '%$member_name%' ";
		}
		if($member_id !=""){
			$sql .= " 	AND FN_AES_DECRYPT(a.member_id) LIKE '%$member_id%' ";
		}
		if($member_nickname !=""){
			$sql .= " 	AND a.member_nickname LIKE '%$member_nickname%' ";
		}
		if($member_state !=""){
			$sql .= " 	AND a.del_yn LIKE '%$member_state%' ";
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

	public function member_list_count($data) {
		
		$member_id=$data['member_id'];
		$member_name=$data['member_name'];
		$member_nickname=$data['member_nickname'];
		$member_state=$data['member_state'];
		$member_join_type=$data['member_join_type'];
		$city_name=$data['city_name'];
		$region_code=$data['region_code'];
		$work=$data['work'];
		$s_date=$data['s_date'];
		$e_date=$data['e_date'];
	
		$sql = "SELECT
							COUNT(*) AS cnt
							FROM
							tbl_member as a
							LEFT JOIN tbl_work_confirm as b on b.work_confirm_idx=a.work_confirm_idx and b.del_yn='N' and b.state=1
							LEFT JOIN tbl_region as c on c.region_code=a.region_code
						WHERE
							1=1
					";
				
		if($work !=""){
			$sql .= " 	AND b.work_name LIKE '%$work%' ";
		}
		if($member_join_type !=""){
			$sql .= " 	AND a.member_join_type = '$member_join_type' ";
		}
		if($city_name !=""){
			$sql .= " 	AND c.city_name LIKE '%$city_name%' ";
		}
		if($region_code !=""){
			$sql .= " 	AND a.region_code = $region_code ";
		}
		if($member_name !=""){
			$sql .= " 	AND FN_AES_DECRYPT(a.member_name) LIKE '%$member_name%' ";
		}
		if($member_id !=""){
			$sql .= " 	AND FN_AES_DECRYPT(a.member_id) LIKE '%$member_id%' ";
		}
		if($member_nickname !=""){
			$sql .= " 	AND a.member_nickname LIKE '%$member_nickname%' ";
		}
		if($member_state !=""){
			$sql .= " 	AND a.del_yn LIKE '%$member_state%' ";
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
public function member_detail($data){

	$member_idx = $data['member_idx'];		
	
	$sql = "SELECT
						a.member_idx,
						FN_AES_DECRYPT(a.member_id) AS member_id,
						FN_AES_DECRYPT(a.member_name) AS member_name,
						FN_AES_DECRYPT(a.member_phone) AS member_phone,
						FN_AES_DECRYPT(a.member_birth) AS member_birth,
						a.member_nickname,
						a.member_join_type,
						a.member_gender,
						a.del_yn,
						a.work_yn,
						a.profile_yn,
						b.work_name,
						d.pay_type,
						d.career,
						d.title,
						d.contents,
						d.display_yn,
						d.report_cnt,
						d.img as profile_img,
						c.city_name,
						c.region_name,
						DATE_FORMAT(b.admission_date, '%Y-%m-%d') AS admission_date,
						DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS ins_date,
						DATE_FORMAT(a.member_leave_date, '%Y-%m-%d') AS member_leave_date
					FROM
						tbl_member as a
						LEFT JOIN tbl_work_confirm as b on b.work_confirm_idx=a.work_confirm_idx and b.del_yn='N' and b.state=1
						LEFT JOIN tbl_region as c on c.region_code=a.region_code
						LEFT JOIN tbl_profile as d on d.member_idx=a.member_idx and d.del_yn='N'
					WHERE
						a.member_idx = ?
					";

	return  $this->query_row($sql,
													array(
													$member_idx
													),$data
													);
}

public function display_mod_up($data){

	$member_idx  = $data['member_idx'];

	$this->db->trans_begin();

	$sql = "UPDATE
						tbl_profile
					SET
						display_yn = if(display_yn='N','Y','N'),
						upd_date = NOW()
					WHERE
						member_idx = ?
					";

	$this->query($sql,array(
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
		$del_yn = $data['del_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							del_yn =?,
							upd_date = NOW()
						WHERE
							member_idx = ?
		";

	$this->query($sql,
														array(
														$del_yn,
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
