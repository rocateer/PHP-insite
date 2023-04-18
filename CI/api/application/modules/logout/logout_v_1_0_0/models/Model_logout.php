<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-04
| Memo : 로그아웃
|------------------------------------------------------------------------
*/

class Model_logout extends MY_Model{

  // model gcm_key 삭제
  public function member_gcm_del($data){

    $member_idx = $data['member_idx'];

    $this->db->trans_begin();

    $sql = "UPDATE
            	tbl_member
            SET
            	gcm_key =  NULL,
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
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
  }

}
?>
