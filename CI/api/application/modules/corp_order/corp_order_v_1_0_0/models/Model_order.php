<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2022-01-10
| Memo : 메인(헬퍼)
|------------------------------------------------------------------------
*/

Class model_order extends MY_Model {

	// 미션 리스트
	public function order_list($data){
		$member_idx = $data['member_idx'];
		$order_state = $data['order_state'];
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];


				
		$sql = "UPDATE
							tbl_order AS a
							JOIN tbl_member AS b ON b.member_idx = a.member_idx
						SET
							a.cancel_yn = 'Y',
							a.cancel_reason = '선정실패로 인한 지원 취소',
							a.order_state = '4',
							a.upd_date = NOW()
						WHERE
						a.order_state = '0'
						AND 60 - TIMESTAMPDIFF(MINUTE,a.ins_date, NOW()) < 0

	";
$this->query($sql,array(

							),$data
						);  

		$sql = "SELECT
							z.order_idx,
							z.order_number,
							z.order_type,
							FN_AES_DECRYPT(z.order_id) AS order_id,
							FN_AES_DECRYPT(z.order_name) AS order_name,
							z.order_nickname,
							60 - DATE_FORMAT(TIMEDIFF(NOW(),z.ins_date),'%i') AS d_min,
							z.order_title,
							z.pay_price,
							DATE_FORMAT(z.ins_date, '%Y.%m.%d. %H:%i') as ins_date,
							a.choice_yn,
							a.cancel_yn
						FROM
							tbl_order_apply a
							join tbl_order z on z.order_idx = a.order_idx AND z.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
							AND a.member_idx = ?
						";

		if ($order_state == "0") {
			$sql .= " AND z.order_state IN (0) AND a.choice_yn = 'P' AND a.cancel_yn = 'N' ";

			$sql .=" ORDER BY a.ins_date DESC LIMIT ?, ? ";

		}elseif($order_state == "1"){
			$sql .= " AND z.order_state IN (1,2) AND a.choice_yn = 'Y' ";

			$sql .=" ORDER BY z.deposite_date DESC LIMIT ?, ? ";

		}elseif ($order_state == "3") {
			$sql .= " AND z.order_state IN (3) AND a.choice_yn = 'Y' ";

			$sql .=" ORDER BY z.order_end_date DESC LIMIT ?, ? ";


		}elseif ($order_state == "4") {
			$sql .= " AND (z.order_state IN (4) OR (a.choice_yn = 'N' OR a.cancel_yn = 'Y')) ";

			$sql .=" ORDER BY z.ins_date DESC LIMIT ?, ? ";

		}

		return $this->query_result($sql,array(
															 $member_idx,
															 $page_no,
															 $page_size
															 ),$data
														 );
	}

	// 미션 리스트 카운트
	public function order_list_count($data){
		$member_idx = $data['member_idx'];
		$order_state = $data['order_state'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_order_apply a
							join tbl_order z on z.order_idx = a.order_idx AND z.del_yn = 'N'
						WHERE
							a.del_yn = 'N'
							AND a.member_idx = ?
						";

		if($order_state == "1"){
			$sql .= " AND z.order_state IN (1,4) AND a.choice_yn = 'Y' ";

		}elseif ($order_state == "0") {
			$sql .= " AND z.order_state IN (0) AND a.choice_yn = 'P' AND a.cancel_yn = 'N' ";

		}elseif ($order_state == "2") {
			$sql .= " AND z.order_state IN (2) AND a.choice_yn = 'Y' ";

		}elseif ($order_state == "3") {
			$sql .= " AND (z.order_state IN (3) OR (a.choice_yn = 'N' OR a.cancel_yn = 'Y')) ";

		}

		return $this->query_cnt($sql,array(
																		$member_idx
																		),$data
																	);
	}

	// 미션 정보
	public function order_detail($data){
		$member_idx = $data['member_idx'];
		$order_idx = $data['order_idx'];

		$sql = "SELECT
							a.order_idx,
							a.order_state,
							a.order_number,
							a.order_type,						
							DATE_FORMAT(a.ins_date, '%Y.%m.%d. %H:%i') as ins_date,
							DATE_FORMAT(a.deposite_date, '%Y.%m.%d. %H:%i') as deposite_date,
							DATE_FORMAT(a.service_hope_date, '%Y.%m.%d. %H:%i') as service_hope_date,
							DATE_FORMAT(a.order_start_date, '%Y.%m.%d. %H:%i') as order_start_date,
							DATE_FORMAT(a.order_end_date, '%Y.%m.%d. %H:%i') as order_end_date,
							DATE_FORMAT(a.cancel_date, '%Y.%m.%d. %H:%i') as cancel_date,
							a.order_title,
							a.order_msg,
							a.cancel_reason,
							a.cancel_type,
							a.buy_confirm_yn,
							a.buy_confirm_date,
							a.pay_price,
							a.account_fee,
							a.account_price,					
							a.chatting_room_idx,
							a.img_paths,
							60 - DATE_FORMAT(TIMEDIFF(NOW(),a.ins_date),'%i') AS d_min,
							IF(a.corp_idx = ?, 'Y', 'N') AS accept_yn,
							b.member_idx,
							b.member_nickname,
							b.order_progressing_cnt,
							b.order_end_cnt,
							w.order_apply_idx,
							w.choice_yn,
							w.cancel_yn as apply_cancel_yn
						FROM
							tbl_order AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_order_apply AS w ON w.member_idx = ? AND w.order_idx = a.order_idx AND w.del_yn = 'N'
						WHERE
							a.order_idx = ?
						AND
							a.del_yn = 'N'
		";

		return $this->query_row($sql,array(
			$member_idx,
			$member_idx,
			$order_idx));

	}

	// 미션 지원 취소
	public function order_apply_cancel_mod_up($data){

		$order_apply_idx = $data['order_apply_idx'];
		$order_idx = $data['order_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_order_apply
						SET
							cancel_yn = 'Y',
							choice_yn = 'N',
							cancel_reason = '지원자 요청에 의해 취소되었습니다',
							upd_date = NOW()
						WHERE
							order_apply_idx = ?
		";

		$this->query($sql,array(
											$order_apply_idx,
									),$data
								);
    
		$sql = "UPDATE
								tbl_order
							SET
							   order_apply_cnt = order_apply_cnt-1,								
								 upd_date = NOW()
							WHERE
								order_idx = ?
		";
	
		$this->query($sql,array(												
												$order_idx,
										),$data
									);
	


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return '1';
		}

	}


	// 미션 취소요청
	public function order_cancel_mod_up($data){

		$order_idx = $data['order_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_order
						SET
						  order_state = '4',
							cancel_yn = 'Y',
							cancel_date = NOW(),
							cancel_type = '1',	
							upd_date = NOW()
						WHERE
						order_idx = ?
		";

		$this->query($sql,array(
											$order_idx,
									),$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return '1';
		}

	}




	// 미션 시작
	public function order_start_mod_up($data){

		$order_idx = $data['order_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_order
						SET
							order_state = '2',
							order_start_date = now(),
							upd_date = NOW()
						WHERE
						order_idx = ?
		";

		$this->query($sql,array(
											$order_idx,
									),$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return '1';
		}

	}


	// 미션 완료
	public function order_end_mod_up($data){

		$order_idx = $data['order_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_order
						SET
							order_state = '3',
							order_end_date = now(),
							upd_date = NOW()
						WHERE
						order_idx = ?
		";

		$this->query($sql,array(
											$order_idx,
									),$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return '1';
		}

	}
}	// 클래스의 끝
?>