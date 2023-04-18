<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-10-27
| Memo : 회원가입
|------------------------------------------------------------------------
*/

Class Model_join extends MY_Model {

	//약관 리스트
	public function terms_list() {

		$sql = "SELECT
							terms_management_idx,
							title,
							type,
							member_type,
							contents,
							upd_date
						FROM
							tbl_terms_management
						WHERE
							member_type = '0'
          	";

  	return $this->query_result($sql,
                                array(
																)
                              );

	}

	//상세
  public function terms_detail($data){

    $type = $data['type'];

    $sql = "SELECT
              terms_management_idx,
              title,
              contents
            FROM
              tbl_terms_management
            WHERE member_type = '0'
						and type =?
    ";

    return $this->query_row($sql,
                            array(
                            $type
                            )
                            );
  }

	// 아이디 중복 체크
	public function member_id_check($data){

		$member_id = $data['member_id'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_id = FN_AES_ENCRYPT(?)
		";

		return $this->query_cnt($sql,array($member_id), $data);
	}

	public function member_email_check($data){

		$member_email = $data['member_email'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_email = FN_AES_ENCRYPT(?)
		";

		return $this->query_cnt($sql,array($member_email), $data);
	}

	public function member_phone_check($data){

		$member_phone = $data['member_phone'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_phone = FN_AES_ENCRYPT(?)
							and del_yn='N'
		";

		return $this->query_cnt($sql,array(
														$member_phone),
														$data);
	}

	public function member_nickname_check($data){

		$member_nickname = $data['member_nickname'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_member
						WHERE
							member_nickname = ?
							and del_yn='N'
		";

		return $this->query_cnt($sql,array(
														$member_nickname),
														$data);
	}

	
	 //sns 로그인 
	 public function sns_member_reg_in($data) {

		$member_id=$data['member_id'];;
		$gcm_key=$data['gcm_key'];
		$device_os=$data['device_os'];
		$member_join_type=$data['member_join_type'];
		$marketing_agree_yn=$data['marketing_agree_yn'];

		$this->db->trans_begin();

		$sql="INSERT INTO
						tbl_member
					(
						member_id,        
						gcm_key,
						device_os,
            member_join_type,
            marketing_agree_yn,
						del_yn,
						ins_date,
						upd_date
					)VALUES(
						FN_AES_ENCRYPT(?),
						?,
						?,
						?,					
						?,					
						'N',
						NOW(),
						NOW()
					);
   			 ";

		$this->query($sql
                ,array(
                $member_id,              
                $gcm_key,
                $device_os,
                $member_join_type,
                $marketing_agree_yn
                ),
                $data);
                
    $member_idx = $this->db->insert_id();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $member_idx;
		}
	}

	// 회원 가입
	public function member_reg_in($data){

		$member_id = $data['member_id'];
		$member_email = $data['member_email'];
		$member_pw = $data['member_pw'];
		$member_nickname = $data['member_nickname'];
		$member_name = $data['member_name'];
		$member_phone = $data['member_phone'];
		$member_gender = $data['member_gender'];
		$member_birth = $data['member_birth'];
		$email_recieved_agree_yn = $data['email_recieved_agree_yn'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_member
							(
								member_id,
								member_pw,
								member_email,
								member_name,
								member_phone,
								member_gender,
								member_birth,
								member_nickname,
								email_recieved_agree_yn,
								member_join_type,
								del_yn,
								add_info_yn,
								ins_date,
								upd_date
							) VALUES (
								FN_AES_ENCRYPT(?),
								SHA2(?, 512),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								?,
								FN_AES_ENCRYPT(?),
								?,
								?,
								'C',
								'N',
								'Y',
                NOW(),
                NOW()
              )
    ";

		$this->query($sql,array(
                  $member_id,
                  $member_pw,
									$member_email,
									$member_name,
									$member_phone,
									$member_gender,
									$member_birth,
									$member_nickname,
									$email_recieved_agree_yn
							   ),$data
							 );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
  		$member_idx = $this->db->insert_id();
			$this->db->trans_commit();
			return "1";
		}
	}

	// 소셜 로그인 추가정보 입력
	public function sns_add_info_mod_up($data) {
		$member_join_type=$data['member_join_type'];
		$member_id=$data['member_id'];
		$gcm_key=$data['gcm_key'];
		$device_os=$data['device_os'];
		$member_name=$data['member_name'];
		$member_phone=$data['member_phone'];
		$member_gender = $data['member_gender'];
		$member_birth = $data['member_birth'];
		$member_nickname = $data['member_nickname'];
		$sms_recieved_agree_yn = $data['sms_recieved_agree_yn'];
 
		$this->db->trans_begin();
 
		$sql = "INSERT INTO
							tbl_member
							(
								member_id,
								member_name,
								member_phone,
								member_gender,
								member_birth,
								member_nickname,
								sms_recieved_agree_yn,
								member_join_type,
								gcm_key,
								device_os,
								del_yn,
								add_info_yn,
								ins_date,
								upd_date
							) VALUES (
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								?,
								FN_AES_ENCRYPT(?),
								?,
								?,
								?,
								?,
								?,
								'N',
								'Y',
                NOW(),
                NOW()
              )
    ";

		$this->query($sql,array(
                  $member_id,
									$member_name,
									$member_phone,
									$member_gender,
									$member_birth,
									$member_nickname,
									$sms_recieved_agree_yn,
									$member_join_type,
								$gcm_key,
								$device_os
							   ),$data
							 );

		$member_idx = $this->db->insert_id();
 
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return $member_idx;
		}
	 }

}	// 클래스의 끝
?>
