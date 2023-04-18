<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 심정민
| Create-Date : 2022-01-13
| Memo : 이용내역(사용자)
|------------------------------------------------------------------------
*/

Class Model_my_order extends MY_Model {

	// 미션 리스트
	public function my_order_list($data){
		$page_no = (int)$data['page_no'];
		$page_size = (int)$data['page_size'];

		$member_idx = $data['member_idx'];
		$order_state = $data['order_state'];

											
		$sql = "SELECT
							a.order_idx,
							a.order_number,
							a.order_type,
							a.order_state,
							FN_AES_DECRYPT(b.member_id) AS corp_id,
							b.member_nickname AS corp_nickname,
							b.member_img AS corp_img,
							60 - DATE_FORMAT(TIMEDIFF(NOW(),a.ins_date),'%i') AS d_min,
							(SELECT	COUNT(1) FROM tbl_order_apply WHERE order_idx = a.order_idx AND cancel_yn = 'N' AND choice_yn != 'N' AND del_yn = 'N') AS apply_cnt,
							a.order_title,
							a.order_msg,
							a.service_hope_date,				
							a.cancel_type,
							a.pay_price,
							a.ins_date
						FROM
							tbl_order AS a
							JOIN tbl_member AS b ON b.member_idx = a.member_idx
						WHERE
							a.member_idx = ?
						AND
							a.del_yn = 'N'
						";

		if($order_state == "0"){
			$sql .= " AND a.order_state IN (0)";

			$sql .=" ORDER BY a.ins_date DESC LIMIT ?, ? ";


		}else if ($order_state == "1") {
			$sql .= " AND a.order_state IN (1,2)";

			$sql .=" ORDER BY a.deposite_date DESC LIMIT ?, ? ";

		}elseif ($order_state == "3") {
			$sql .= " AND a.order_state IN (3)";

			$sql .=" ORDER BY a.order_end_date DESC LIMIT ?, ?";


		}elseif ($order_state == "4") {
			$sql .= " AND a.order_state IN (4) ";

			$sql .=" ORDER BY a.ins_date DESC LIMIT ?, ? ";

		}
		
		
		return	$this->query_result($sql,array(
																$member_idx,
																$page_no,
																$page_size
																),$data
															);

	}
	// 미션 리스트 카운트
	public function my_order_list_count($data){
		$member_idx = $data['member_idx'];
		$order_state = $data['order_state'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_order AS a
							LEFT JOIN tbl_member AS b ON a.corp_idx = b.member_idx
						WHERE
							a.member_idx = ?
						AND
							a.del_yn = 'N'
						";

		if($order_state == "0"){
			$sql .= " AND a.order_state IN (0)";
		}else if ($order_state == "1") {
			$sql .= " AND a.order_state IN (1,2)";
		}elseif ($order_state == "2") {
			$sql .= " AND a.order_state IN (3)";
		}elseif ($order_state == "3") {
			$sql .= " AND a.order_state IN (4)";
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
							a.corp_idx,
							a.order_idx,
							a.order_state,
							a.order_number,
							a.order_type,				
							a.buy_confirm_yn,				
							a.service_hope_date,
							a.pay_price,					
							a.order_title,
							a.order_msg,
							a.img_paths,
							IF(a.corp_idx = ?, 'Y', 'N') AS accept_yn,
							b.member_idx,
							b.member_nickname,
							b.order_progressing_cnt,
							b.order_end_cnt
						FROM
							tbl_order AS a
							JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.order_idx = ?
						AND
							a.del_yn = 'N'
		";

		return $this->query_row($sql,array($member_idx, $order_idx));

	}

	// 지원자 리스트
	public function apply_list($data){
		$order_idx = $data['order_idx'];
		
		$sql = "SELECT
							a.order_idx,
							a.cancel_yn,
							c.order_state,
							b.member_idx,
							b.member_nickname,
							b.member_img,
							b.helper_review_star,
							b.helper_order_end_cnt,
							c.corp_idx,
							a.apply_msg
						FROM 
							tbl_order_apply AS a
							LEFT JOIN tbl_member AS b ON a.member_idx = b.member_idx
							LEFT JOIN tbl_order AS c ON a.order_idx = c.order_idx
						WHERE
							a.order_idx = ?
						AND
							a.cancel_yn = 'N'
						AND
							a.del_yn = 'N'
		";

		return $this->query_result($sql,array($order_idx));

	}

	// 지원자 리스트 카운트
	public function apply_list_count($data){
		$order_idx = $data['order_idx'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM 
							tbl_order_apply AS a
							LEFT JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.order_idx = ?
						AND
							a.cancel_yn = 'N'
						AND
							a.del_yn = 'N'
		";

		return $this->query_cnt($sql,array($order_idx));

	}


	// 미션상태체크
	public function order_summary($data){
		$order_idx = $data['order_idx'];

		$sql = "SELECT
							a.order_idx,
							a.order_state,	
							a.buy_confirm_yn
						FROM
							tbl_order AS a
						WHERE
							a.order_idx = ?
						AND
							a.del_yn = 'N'
		";

		return $this->query_row($sql,array($order_idx));

	}


	// 선정된 지원자 상세
	public function corp_detail($data){
		$order_idx = $data['order_idx'];
		
		$sql = "SELECT
							a.order_idx,
							b.member_idx,
							b.member_nickname,
							b.member_img,
							b.helper_review_star,
							b.helper_order_end_cnt,
							a.apply_msg
						FROM 
							tbl_order_apply AS a
							LEFT JOIN tbl_member AS b ON a.member_idx = b.member_idx
						WHERE
							a.order_idx = ?
						AND
							a.cancel_yn = 'N'
						AND
							a.choice_yn = 'Y'
						AND
							a.del_yn = 'N'
		";

		return $this->query_row($sql,array($order_idx));

	}

	// 미션  취소
	public function order_cancel_mod_up($data){

		$order_idx = $data['order_idx'];
		$cancel_reason = $data['cancel_reason'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_order
						SET
							order_state = '4',
							cancel_yn = 'Y',
							cancel_date = NOW(),
							cancel_type = '0',							
							cancel_reason = ?,
							upd_date = NOW()
						WHERE
							order_idx = ?
		";

		$this->query($sql,array(
											$cancel_reason,
											$order_idx,
									),$data
								);

		$sql = "UPDATE
							tbl_order_apply
						SET
							cancel_yn = 'Y',
							choice_yn = 'N',
							cancel_reason = '고객의 미션 취소로 인한 지원 취소',
							upd_date = NOW()
						WHERE
							order_idx = ?
						AND
							del_yn = 'N'
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

	// 헬퍼 선정
	public function order_corp_mod_up($data){

    $member_idx = $data['member_idx'];
    $order_idx = $data['order_idx'];

		$this->db->trans_begin();

		// 요청에 헬퍼 정보 업데이트
		$sql = "UPDATE
							tbl_order AS a JOIN tbl_order_apply as b ON a.order_idx = b.order_idx
						SET						
							a.corp_idx = ?,						
							a.upd_date = NOW()
						WHERE
							a.order_idx = ?
						AND b.cancel_yn = 'N'
		";

		$this->query($sql,array(
											$member_idx,
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


	// 미션 완료확인
	public function order_confirm_mod_up($data){

		$order_idx = $data['order_idx'];		

		$sql = "SELECT
							a.order_idx,
							a.order_state,	
							a.buy_confirm_yn
					FROM
						tbl_order AS a
					WHERE
						a.order_idx = ?
					AND
						a.del_yn = 'N'
		";

    $result = $this->query_row($sql,array($order_idx));
		if(empty($result)){
			return -2;
		}

		if($result->order_state=="3" && $result->buy_confirm_yn=="N"){
			
		}else{
			return -3;
		}


		// 요청에 헬퍼 정보 업데이트
		$sql = "UPDATE
							tbl_order AS a JOIN tbl_member AS b ON a.member_idx = b.member_idx
						SET						
							a.buy_confirm_yn ='Y',						
							a.buy_confirm_date = NOW(),						
							a.account_yn ='N',						
							a.upd_date = NOW(),
							b.order_end_cnt = b.order_end_cnt + 1
						WHERE
							a.order_idx = ?
		";

		$this->query($sql,array(											
											$order_idx,
									),$data
								);
		// 임무 완료 후 헬퍼 미션완료 수 +1
		$sql = "UPDATE
							tbl_order AS a JOIN tbl_member AS b ON a.corp_idx = b.member_idx
						SET						
							b.helper_order_end_cnt = b.helper_order_end_cnt + 1
						WHERE
							a.order_idx = ?
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