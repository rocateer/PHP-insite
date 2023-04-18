<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2017-10-16
| Memo : 주문관련 API
|------------------------------------------------------------------------
*/
Class Model_order extends MY_Model {

  // 회원정보가져오기
	public function member_info($data) {
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							FN_AES_DECRYPT(member_id) AS member_email,
							FN_AES_DECRYPT(member_name) AS member_name,
							FN_AES_DECRYPT(member_phone) AS member_tel,
							FN_AES_DECRYPT(receiver_name) AS receiver_name,
							FN_AES_DECRYPT(receiver_tel) AS receiver_tel,
							FN_AES_DECRYPT(receiver_post_number) AS receiver_post_number,
							FN_AES_DECRYPT(receiver_addr) AS receiver_addr,
							FN_AES_DECRYPT(receiver_addr_detail) AS receiver_addr_detail,
							IFNULL((SELECT sum(point) from tbl_member_point where del_yn='N' and member_idx=a.member_idx),0) as member_enable_point
						FROM tbl_member as a
						where member_idx=?
		";

		return $this->query_row($sql, array($member_idx));


	} // end member_info


	// 바로구매 주문서 작성
	public function direct_order_reg_in($data) {

		$order_number = $data['order_number'];
		$member_idx = $data['member_idx'];
		$cart_session_id = $data['cart_session_id'];

		$site_type = $data['site_type'];
		$order_name = $data['order_name'];
		$order_tel = $data['order_tel'];
		$order_email = $data['order_email'];
		$receiver_name = $data['receiver_name'];
		$receiver_tel = $data['receiver_tel'];
		$receiver_post_number = $data['receiver_post_number'];
		$receiver_addr = $data['receiver_addr'];
		$receiver_addr_detail = $data['receiver_addr_detail'];


		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_order
							(
								order_number,
								site_type,
								order_date,
								order_state,
								member_idx,
								order_name,
								order_tel,
								order_email,
								receiver_name,
								receiver_tel,
								receiver_post_number,
								receiver_addr,
								receiver_addr_detail,
                product_idx,
								corp_idx,
								corp_name,
								product_b_category_idx,
								product_b_category_name,
								product_m_category_idx,
								product_m_category_name,
								product_s_category_idx,
								product_s_category_name,
								product_name,
								product_option_name,
								product_option_price,
								product_ea,
								product_price,
								delivery_price,
								product_img_path,
								ins_date,
								upd_date
							)
							select
								?,
								?,
								now(),
								'0',
								?,
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								a.product_idx,
								b.corp_idx,
								c.corp_name,
								b.product_b_category_idx,
								b.product_b_category_name,
								b.product_m_category_idx,
								b.product_m_category_name,
								b.product_s_category_idx,
								b.product_s_category_name,
								b.product_name,
								a.product_option_name,
								a.product_option_price,
								a.cart_ea,
								a.product_price,
								b.product_delivery,
								b.product_img_path,
								NOW(), -- ins_date
								NOW() -- upd_date
							 from tbl_cart as a
							 join tbl_product as b on b.product_idx=a.product_idx
							 join tbl_corp as c on c.corp_idx=b.corp_idx
							 where  cart_type='1'
							 and cart_session_id=?
						";

		$this->query($sql,array(
														$order_number,
														$site_type,
														$member_idx,
														$order_name,
														$order_tel,
														$order_email,
														$receiver_name,
														$receiver_tel,
														$receiver_post_number,
														$receiver_addr,
														$receiver_addr_detail,
														$cart_session_id
														));

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}

	} // end ::: 바로구매


  // 장바구니 주문서 작성
	public function cart_order_reg_in($data) {

		$order_number = $data['order_number'];
		$member_idx = $data['member_idx'];
	  $cart_idx = $data['cart_idx'];

		$site_type = $data['site_type'];
		$order_name = $data['order_name'];
		$order_tel = $data['order_tel'];
		$order_email = $data['order_email'];
		$receiver_name = $data['receiver_name'];
		$receiver_tel = $data['receiver_tel'];
		$receiver_post_number = $data['receiver_post_number'];
		$receiver_addr = $data['receiver_addr'];
		$receiver_addr_detail = $data['receiver_addr_detail'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_order
							(
								order_number,
								site_type,
								order_date,
								order_state,
								member_idx,
								order_name,
								order_tel,
								order_email,
								receiver_name,
								receiver_tel,
								receiver_post_number,
								receiver_addr,
								receiver_addr_detail,
                product_idx,
								corp_idx,
								corp_name,
								product_b_category_idx,
								product_b_category_name,
								product_m_category_idx,
								product_m_category_name,
								product_s_category_idx,
								product_s_category_name,
								product_name,
								product_option_name,
								product_option_price,
								product_ea,
								product_price,
								delivery_price,
								product_img_path,
								ins_date,
								upd_date
							)
							select
								?,
								?,
								now(),
								'0',
								?,
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								FN_AES_ENCRYPT(?),
								a.product_idx,
								b.corp_idx,
								c.corp_name,
								b.product_b_category_idx,
								b.product_b_category_name,
								b.product_m_category_idx,
								b.product_m_category_name,
								b.product_s_category_idx,
								b.product_s_category_name,
								b.product_name,
								a.product_option_name,
								a.product_option_price,
								a.cart_ea,
								a.product_price,
								b.product_delivery,
								b.product_img_path,
								NOW(), -- ins_date
								NOW() -- upd_date
							 from tbl_cart as a
							 join tbl_product as b on b.product_idx=a.product_idx
							 join tbl_corp as c on c.corp_idx=b.corp_idx
					where member_idx =?
					and cart_type='0'
					and cart_idx in($cart_idx)

		";
		$this->query($sql,array(
														$order_number,
														$site_type,
														$member_idx,
														$order_name,
														$order_tel,
														$order_email,
														$receiver_name,
														$receiver_tel,
														$receiver_post_number,
														$receiver_addr,
														$receiver_addr_detail,
														$member_idx
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
		$member_idx = $data['member_idx'];

		$sql = "SELECT
							order_date as order_date,
							member_idx as member_idx,
							FN_AES_DECRYPT(order_name) as order_name,
							FN_AES_DECRYPT(order_tel) as order_tel,
							FN_AES_DECRYPT(order_email) as order_email,
							FN_AES_DECRYPT(order_name) as receiver_name,
							FN_AES_DECRYPT(receiver_tel) as receiver_tel,
							FN_AES_DECRYPT(receiver_post_number) as receiver_post_number,
							FN_AES_DECRYPT(receiver_addr) as receiver_addr,
							FN_AES_DECRYPT(receiver_addr_detail) as receiver_addr_detail,
							IFNULL((SELECT sum(point) from tbl_member_point where del_yn='N' and member_idx=a.member_idx),0) as member_enable_point,
							order_msg as order_msg
						FROM tbl_order as a
						WHERE order_number=?
							and member_idx=?
							limit 1
		";

		return $this->query_row($sql, array($order_number,$member_idx));
	} // end 주문서 보기

	// 주문서 보기
	public function order_product_list($data) {
		$member_idx = $data['member_idx'];
		$order_number = $data['order_number'];

		$sql = "SELECT
		           a.product_idx,
							 a.product_name,
							 a.corp_idx,
							 a.corp_name as corp_name,
							 a.product_option_name,
							 a.product_img_path,
							 a.product_ea AS product_ea,
							 (a.product_ea*(a.product_price+ifnull(a.product_option_price,0))) AS sum_product_price,
							 (a.use_point) AS use_point,
							 (a.member_coupon_price) AS member_coupon_price,
							 (a.delivery_price) AS delivery_price,
							 (a.product_ea*(a.product_price+ifnull(a.product_option_price,0))+delivery_price -member_coupon_price- use_point) as sum_pay_price

						 FROM	tbl_order AS a
						 WHERE
							 a.del_yn = 'N'
							 and a.product_ea>0
							 AND a.member_idx = '$member_idx'
							 AND a.order_number = '$order_number'
		";

		return	$this->query_result($sql,array());

	} // end 주문서 보기



		// 주문서 보기(groupby)
	public function order_product_groupby_list($data) {
		$member_idx = $data['member_idx'];
		$order_number = $data['order_number'];

		$sql = "SELECT
							 a.corp_idx,
							 a.corp_name as corp_name,
							 SUM(a.product_ea) AS sum_ea,
							 SUM(a.product_ea*a.product_price) AS sum_product_price,
							 SUM(a.use_point) AS sum_use_point,
							 SUM(a.member_coupon_price) AS sum_member_coupon_price,
							 SUM(a.delivery_price) AS sum_delivery_price,
							 sum(a.product_ea*(a.product_price+a.product_option_price)+delivery_price -member_coupon_price- use_point) as sum_pay_price,
							 IFNULL((SELECT GROUP_CONCAT(order_idx,'^',product_idx,'^',product_name,'^',product_ea,'^',product_price,'^',product_ea*product_price,'^',delivery_price,'^',use_point,'^',member_coupon_price,'^',product_point,'^',product_st_price,'^',product_img_path) FROM tbl_order AS in_a  WHERE in_a.corp_idx=a.corp_idx and in_a.order_number=a.order_number),'' ) AS product_list
						 FROM	tbl_order AS a
						 WHERE
							 a.del_yn = 'N'
							 and a.product_ea>0
							 AND a.member_idx = '$member_idx'
							 AND a.order_number = '$order_number'
						 GROUP BY a.corp_idx
		";
		return	$this->query_result($sql,array());

	} // end 주문서 보기

	/*
	|------------------------------------------------------------------------
	| Memo : 배송정보수정
	|------------------------------------------------------------------------
	*/

	// 배송정보수정
	public function order_receiver_mod_up($data) {
		$member_idx = $data['member_idx'];
		$order_number = $data['order_number'];

		$receiver_name = $data['receiver_name'];
		$receiver_tel = $data['receiver_tel'];
		$receiver_post_number = $data['receiver_post_number'];
		$receiver_addr = $data['receiver_addr'];
		$receiver_addr_detail = $data['receiver_addr_detail'];
		$order_msg = $data['order_msg'];

		$this->db->trans_begin();


		//배송정보 업데이트
		$sql = "update
							tbl_order
            set
								receiver_name=FN_AES_ENCRYPT(?),
								receiver_tel=FN_AES_ENCRYPT(?),
								receiver_post_number=FN_AES_ENCRYPT(?),
								receiver_addr=FN_AES_ENCRYPT(?),
								receiver_addr_detail=FN_AES_ENCRYPT(?),
								order_msg=?
            WHERE order_number=? and member_idx=?
		";

		$this->query($sql,array(
														$receiver_name,
														$receiver_tel,
														$receiver_post_number,
														$receiver_addr,
														$receiver_addr_detail,
														$order_msg,
														$order_number,
														$member_idx,
														));
		//배송비계산
		//$this->cal_delivery_price($data);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	/*
	|------------------------------------------------------------------------
	| Memo : 포인트 체크
	|------------------------------------------------------------------------
	*/
	// 포인트 체크
public function member_point_check($data) {
	$member_idx = $data['member_idx'];
	$order_number = $data['order_number'];

	$sql = "SELECT
						sum(point) as enable_point,
						ifnull((select sum(use_point) from tbl_order where  del_yn='N' and order_number='$order_number'),0)as order_point
					 FROM	tbl_member_point AS a
					 WHERE del_yn='N' and  member_idx='$member_idx'

	";
	return	$this->query_row($sql,array());

} // end 주문서 보기



	// 포인트 적용
	public function order_point_mod_up($data) {
		$member_idx = $data['member_idx'];
		$order_number = $data['order_number'];
		$use_point = $data['use_point'];

		$this->db->trans_begin();

		$sql = "update	tbl_order as ta,
		        (
							select
						   min(order_idx) as order_idx
							from tbl_order
							where order_number='$order_number' and member_idx='$member_idx'
						) as tb
            set
								ta.use_point=?
            WHERE ta.order_idx=tb.order_idx
		";

		$this->query($sql,array(
														$use_point
														));

		//배송비계산
	//	$this->cal_delivery_price($data);

		if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}

	} // end 포인트 적용
















	/*
	|------------------------------------------------------------------------
	| Memo : 배송비계산
	|------------------------------------------------------------------------
	*/
	//배송비계산
	public function cal_delivery_price($data) {
		$member_idx = $data['member_idx'];
		$order_number = $data['order_number'];

		//배송비 계산
		$sql="SELECT
           ta.corp_idx,
					 ta.sum_product_price,
					 tb.corp_payment_limit,
					 tb.corp_baesongbi,
					 ifnull((select delivery_price  from tbl_corp_area_delivery_price where del_yn='N' and corp_idx=ta.corp_idx and addr=ta.receiver_addr),0) as corp_area_delivery_price
					from  (
						     select
								  corp_idx,
									sum(product_ea*product_price-use_point) as sum_product_price,
									ifnull((select FN_AES_DECRYPT(receiver_addr) from tbl_order  where order_number='$order_number' limit 1),'') as receiver_addr
								 from tbl_order
								 where order_number='$order_number'
								 group by corp_idx
						    ) as ta
					join tbl_corp as tb on tb.corp_idx=ta.corp_idx
		";
		$resultList = $this->query_result($sql,array());

		foreach($resultList as $row){
			$baesongbi =0;
			if($row->corp_area_delivery_price>0){
				$baesongbi = $row->corp_area_delivery_price;
			}else{
				if($row->sum_product_price<$row->corp_payment_limit){
					$baesongbi = $row->corp_baesongbi;
				}
			}
			if($baesongbi>0){
				$sql = "update 	tbl_order as ta,
								(
									select
									 min(order_idx) as order_idx
									from tbl_order
									where
									order_number=? and member_idx=? and corp_idx=?
								)as tb
								set
										delivery_price='$baesongbi'
								WHERE ta.order_number=? ta.and member_idx=?   and ta.order_idx=tb.order_idx
				";
				$this->query($sql,array(
																$order_number,
																$member_idx,
																$row->corp_idx,
																$order_number,
																$member_idx,
																));
			}

		}

	}







}	// 클래스의 끝
?>
