<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-05
| Memo : 회원 탈퇴
|------------------------------------------------------------------------
*/

Class Model_member_out extends MY_Model {

  // 회원 탈퇴하기
  public function member_out_up($data){

    $member_idx = (int)$data['member_idx'];
		$member_state = $data['member_state'];
		$member_leave_type = $data['member_leave_type'];
    $member_leave_reason = $data['member_leave_reason'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_member
						SET
              del_yn='Y',
							member_leave_type = ?,
							member_leave_reason = ?,
							alarm_yn = 'N',
							gcm_key = NULL,
							upd_date = NOW()
						WHERE
							member_idx = ?
						";

		$this->query($sql,array(
								$member_leave_type,
								$member_leave_reason,
								$member_idx
								),$data
								);
    $this->member_data_del($data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
  }

  //회원 관련 정보 삭제
  function member_data_del($data){
    $member_idx =$data['member_idx'];

    $sql = "UPDATE tbl_alarm SET del_yn='Y' WHERE member_idx='$member_idx'";
    $this->query($sql,array(),$data);

    $sql = "UPDATE tbl_qa SET del_yn='Y' WHERE member_idx='$member_idx'";
    $this->query($sql,array(),$data);

  }

}
?>
