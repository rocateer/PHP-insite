<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2020-05-11
| Memo : 주문관련 API
|------------------------------------------------------------------------
*/
Class Model_order extends MY_Model {

  // 회원정보가져오기
	public function member_info($data) {
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							FN_AES_DECRYPT(member_id) AS member_email,
							FN_AES_DECRYPT(member_phone) AS member_tel,
							member_type,
							member_nickname,
							member_img,
							del_yn
						FROM tbl_member
						where member_idx=?
		";

		return $this->query_row($sql, array($member_idx));


	}

  // 장바구니 주문서 작성
	public function order_reg_in($data) {

		$order_number = $data['order_number'];
		$corp_idx = $data['corp_idx'];
		$corp_name = $data['corp_name'];
		$member_idx = $data['member_idx'];
		$order_id = $data['order_id'];
		$order_name = $data['order_name'];
		$order_tel = $data['order_tel'];
		$order_email = $data['order_email'];
		$order_msg = $data['order_msg'];
		$product_type = $data['product_type'];
		$product_price = $data['product_price'];
		$account_st_price = $data['account_st_price'];
		$account_payment_rate = $data['account_payment_rate'];
		$account_price = $data['account_price'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
					tbl_order
					(
						order_number,
						order_date,
						order_state,
						corp_idx,
						corp_name,
						member_idx,
						order_id,
						order_name,
						order_tel,
						order_email,
						order_msg,
						product_type,
						product_name,
						product_ea,
						product_price,
						account_st_price,
						account_payment_rate,
						account_price,
						ins_date,
						upd_date
					)
					select
						'$order_number',
						now(),
						'0',
						$corp_idx,
						'$corp_name',
						'$member_idx',
						FN_AES_ENCRYPT(?),
						FN_AES_ENCRYPT(?),
						FN_AES_ENCRYPT(?),
						FN_AES_ENCRYPT(?),
						'$order_msg',
						'$product_type',
						'동영상제작구매',
						'1',
						'$product_price',
						'$account_st_price',
						'$account_payment_rate',
						'$account_price',
						now(),
						now()
					from tbl_member as a
					where member_idx =?
		";
		$this->query($sql,array(
													$order_id,
													$order_name,
													$order_tel,
													$order_email,
													$member_idx,
													));

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}

	} // end ::: 장바구니


	// 주문서 보기
	public function order_detail($data) {
		$order_number = $data['order_number'];

		$sql = "SELECT
							a.order_number,
							a.order_idx,
							a.product_name,
							a.product_price,
							a.member_idx AS member_idx,
							a.order_idx,
							a.corp_idx,
							a.corp_name,
							a.order_date,
							a.order_state,
							FN_AES_DECRYPT(a.order_name) AS order_name,
							FN_AES_DECRYPT(a.order_tel) AS order_tel,
							FN_AES_DECRYPT(a.order_email) AS order_email,
							b.member_img
						FROM
							tbl_order  as a
							join tbl_member as b on b.member_idx =a.corp_idx
						WHERE
							order_number = ?
   ";

		return $this->query_row($sql,
														array(
														$order_number
														),
														$data
														);


	} // end 주문서 보기






}	// 클래스의 끝
?>
