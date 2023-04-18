<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2021-12-22
| Memo : 회원정보
|------------------------------------------------------------------------
*/

Class Model_member_info extends MY_Model {

	// 회원 정보
	public function member_info($data){
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.member_idx,
							a.member_nickname,
							a.member_img,
							a.member_gender,
							FN_AES_DECRYPT(a.member_id) as member_id,
							FN_AES_DECRYPT(a.member_name) as member_name,
							FN_AES_DECRYPT(a.member_birth) as member_birth,
							FN_AES_DECRYPT(a.member_phone) as member_phone,
							a.exercise_goal_type,
							a.exercise_part_type,
							a.exercise_goal,
							a.exercise_s_time,
							a.exercise_e_time,
							a.exercise_part,
							a.waist_measurement
						FROM
							tbl_member a
						WHERE
							a.del_yn = 'N'
						AND
							a.member_idx = ?
							";

		return $this->query_row($sql,
														array(
														$member_idx
														),
														$data
													);
	}

	// 회원 정보 체크
	public function member_info_check($data){
		$member_idx = $data['member_idx'];
		$member_phone = $data['member_phone'];
		
		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_member a
						WHERE
							a.del_yn = 'N'
							AND a.member_idx != ?
							and FN_AES_DECRYPT(a.member_phone)=?
							";

		return $this->query_cnt($sql,
														array(
														$member_idx,
														$member_phone
														),
														$data
													);
	}

	//닉네임 체크
	public function member_nickname_check($data){

		$member_idx = $data['member_idx'];
		$member_nickname = $data['member_nickname'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_nickname = ?
							AND member_idx != ?
		";

		return $this->query_cnt($sql,array(
														$member_nickname,
														$member_idx
													),
														$data);
	}

	// 회원 정보 수정
	public function member_info_mod_up($data){

		$member_idx = $data['member_idx'];
		$member_img_path = $data['member_img_path'];
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_birth = $data['member_birth'];
		$member_gender = $data['member_gender'];
		$member_nickname = $data['member_nickname'];
		$exercise_goal = $data['exercise_goal'];
		$exercise_part = $data['exercise_part'];
		$exercise_s_time = $data['exercise_s_time'];
		$exercise_e_time = $data['exercise_e_time'];
		$exercise_goal_type = $data['exercise_goal_type'];
		$exercise_part_type = $data['exercise_part_type'];
		$waist_measurement = $data['waist_measurement'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
							member_img = ?,
							member_name = FN_AES_ENCRYPT(?),
							member_phone = FN_AES_ENCRYPT(?),
							member_birth = FN_AES_ENCRYPT(?),
							member_gender = ?,
							member_nickname = ?,
							exercise_goal = ?,
							exercise_part = ?,
							exercise_s_time = ?,
							exercise_e_time = ?,
							exercise_goal_type = ?,
							exercise_part_type = ?,
							waist_measurement = ?,
							upd_date = NOW()
						WHERE
							member_idx = ?
					";

		$this->query($sql,
									array(
									$member_img_path,
									$member_name,
									$member_phone,
									$member_birth,
									$member_gender,
									$member_nickname,
									$exercise_goal,
									$exercise_part,
									$exercise_s_time,
									$exercise_e_time,
									$exercise_goal_type,
									$exercise_part_type,
									$waist_measurement,					
				 		 			$member_idx
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


}	// 클래스의 끝
?>
