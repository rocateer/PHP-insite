<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-02-29
| Memo : 공통 기능
|------------------------------------------------------------------------
*/

Class Model_common extends MY_Model {

	// 알림 리스트 총 카운트
	public function new_alarm_count(){

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_alarm
						WHERE
							del_yn = 'N'
							AND read_yn = 'N'
							AND member_idx = ?
		";

		return $this->query_cnt($sql,array($this->member_idx));
	}

  //cart_count
	public function cart_count(){

		$sql = "SELECT
							count(*) as cnt
						FROM
							tbl_cart
						WHERE
							del_yn = 'N'
							AND member_idx = ?
		";

		return $this->query_cnt($sql,array($this->member_idx));
	}

	//차단 리스트
	public function member_block_detail() {

		$sql = "SELECT
				     group_concat(member_idx) as member_idxs
						FROM
							tbl_member
						WHERE del_yn='N'
						and member_idx in (select partner_member_idx from tbl_member_block where del_yn='N' and member_idx=? )
		";
		return $this->query_row($sql,array($this->member_idx));

	}


	//차단등록
	public function member_block_reg_in($data){
		$partner_member_idx  = $data['partner_member_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_member_block
						(
						member_idx,
						partner_member_idx,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,partner_member_idx=?,del_yn=if(del_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$partner_member_idx,
									$member_idx,
									$partner_member_idx,
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


	//게시판 차단 리스트
	public function board_block_detail() {

		$sql = "SELECT
							group_concat(board_idx) as board_idxs
						FROM
							tbl_board_block
						WHERE del_yn='N'
						and member_idx=?
		";				
		return $this->query_row($sql,array($this->member_idx));

	}
	


	//차단등록
	public function board_block_reg_in($data){
		$board_idx  = $data['board_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_block
						(
						member_idx,
						board_idx,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_idx=?,del_yn=if(del_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_idx,
									$member_idx,
									$board_idx,
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

	//게시판 댓글 차단 리스트
	public function board_reply_block_detail() {

		$sql = "SELECT
							ifnull(group_concat(board_reply_idx),'') as board_reply_idxs
						FROM
							tbl_board_reply_block
						WHERE del_yn='N'
						and member_idx=?
		";				
		return $this->query_row($sql,array($this->member_idx));

	}


	//차단등록
	public function board_reply_block_reg_in($data){
		$board_reply_idx  = $data['board_reply_idx'];
		$member_idx = $data['member_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO tbl_board_reply_block
						(
						member_idx,
						board_reply_idx,
						ins_date,
						upd_date
						)
						VALUES
						(
						?,
						?,
						NOW(),
						NOW()
						)
						ON DUPLICATE KEY UPDATE member_idx=?,board_reply_idx=?,del_yn=if(del_yn='N','Y','N'),upd_date=NOW()
		";

		$this->query($sql,array(
									$member_idx,
									$board_reply_idx,
									$member_idx,
									$board_reply_idx,
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


	//회원정보
	public function member_summary(){

		$sql="SELECT
						member_idx,
						FN_AES_DECRYPT(member_id) AS member_id,
						FN_AES_DECRYPT(member_name) AS member_name,
						DATEDIFF(NOW(),a.ins_date) AS date_diff,
						DATE_FORMAT(ins_date, '%Y.%m.%d') as ins_date
			
					FROM	tbl_member as a
					WHERE	member_idx='$this->member_idx'

		";

		return $this->query_row($sql,array());
	}



}
?>
