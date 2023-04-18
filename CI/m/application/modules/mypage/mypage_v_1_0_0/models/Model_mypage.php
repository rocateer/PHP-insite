<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-06-28
| Memo : 마이 페이지
|------------------------------------------------------------------------
*/

Class Model_mypage extends MY_Model {

	// 회원 정보
	public function member_info(){

		$result = array();

		$sql = "SELECT
							a.member_idx,
							a.member_join_type,
							FN_AES_DECRYPT(a.member_id) AS member_id,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							a.member_img,
							a.member_nickname
						FROM
							tbl_member a
						WHERE
							a.del_yn = 'N'
						AND
							a.member_idx = ?
							";

		$result['member_info']= $this->query_row($sql,
																array(
																$this->member_idx
																)
															);
		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_alarm a
						WHERE
							a.del_yn = 'N'
						AND
							a.read_yn = 'N'
						AND
							a.member_idx = ?
							";

		$result['alarm_new_cnt']= $this->query_cnt($sql,
																array(
																$this->member_idx
																)
															);

		return $result;
	}

	//사진 update
	public function member_img_mod_up($data) {
		$member_idx=$data['member_idx'];
		$member_img=$data['member_img'];
	
		$this->db->trans_begin();
	
		$sql="UPDATE
						tbl_member
					SET
						member_img = ?,
						upd_date = NOW()
					WHERE
						member_idx = ?
		";
	
		$this->query($sql,
								array(
								$member_img,
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

}	// 클래스의 끝
?>
