<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-04
| Memo : SNS 회원 가입
|------------------------------------------------------------------------
*/

class Model_sns_join extends MY_Model{

	// gcm_key,device_os 업데이트
  public function member_gcm_device_up($data) {
  	$member_idx=$data['member_idx'];
  	$gcm_key=$data['gcm_key'];
  	$device_os=$data['device_os'];

  	$this->db->trans_begin();

  	$sql="UPDATE
  					tbl_member
  				SET
  					gcm_key = ?,
  					device_os = ?,
  					upd_date = NOW()
  				WHERE
  					member_idx = ?
     			 ";

  	$this->query($sql,
                array(
                $gcm_key,
                $device_os,
                $member_idx
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

  //SNS회원 로그인 체크
	public function sns_member_login_check($data) {

		$member_id=$data['member_id'];
		$member_join_type=$data['member_join_type'];

		$sql = "SELECT
							member_idx
						FROM
              tbl_member
						WHERE
              del_yn ='N'
							AND FN_AES_DECRYPT(member_id) = ?
							AND member_join_type = ?
						";

		return $this->query_row($sql,
                            array(
                            $member_id,
                            $member_join_type
                            ),
                            $data);
	}

  //SNS 회원가입
	public function sns_member_reg_in($data) {

		$member_id=$data['member_id'];;
		$device_os=$data['device_os'];
		$member_join_type=$data['member_join_type'];
    $member_name = $data['member_name'];
    $member_birth = $data['member_birth'];
    $member_phone = $data['member_phone'];
		$member_nickname = $data['member_nickname'];
    $member_gender = $data['member_gender'];

		$this->db->trans_begin();

		$sql="INSERT INTO
						tbl_member
					(
						member_id,
            member_name,
            member_phone,
            member_birth,
						device_os,
            member_join_type,
						member_nickname,
						del_yn,
						ins_date,
						upd_date
					)VALUES(
						FN_AES_ENCRYPT(?),
						FN_AES_ENCRYPT(?),
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
                $member_name,
                $member_phone,
                $member_birth,
                $device_os,
                $member_join_type,
								$member_nickname
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

} // 클래스의 끝
?>
