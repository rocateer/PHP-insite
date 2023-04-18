<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2016-06-23
| Memo : HOME
|------------------------------------------------------------------------
*/

Class Model_home extends MY_Model {

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


	// member비밀번호 변경 요청 인증키 확인
	public function member_detail($data) {

		$member_idx = $data['member_idx'];

		$sql = "SELECT
							a.member_idx,
							FN_AES_DECRYPT(member_id)  AS member_id,
							a.del_yn
						FROM
							tbl_member as a
						WHERE
							a.member_idx = ?
		";

		return $this->query_row($sql,array(
														$member_idx,
														)
													);

	}





}
?>
