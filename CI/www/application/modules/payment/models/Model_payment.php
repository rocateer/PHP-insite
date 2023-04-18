<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2018-01-20
| Memo : 결제 모듈
|------------------------------------------------------------------------
*/

Class Model_payment extends MY_Model {

  //주문 상세보기
	public function order_detail($data){
		$order_number = $data['order_number'];

		$sql = "SELECT
							ANY_VALUE(order_number) AS order_number,
							ANY_VALUE(product_name) AS product_name,
							(SUM(product_price*product_ea)-SUM(use_point) - SUM(member_coupon_price)+SUM(delivery_price)) AS product_price,
							ANY_VALUE(member_idx) AS member_idx,
							ANY_VALUE(FN_AES_DECRYPT(order_name)) AS order_name,
							ANY_VALUE(FN_AES_DECRYPT(order_tel)) AS order_tel,
							ANY_VALUE(FN_AES_DECRYPT(order_email)) AS order_email
						FROM
							tbl_order
						WHERE
							order_number = ?
						group by 	order_number
		       ";

		return $this->query_row($sql,
														array(
														$order_number
														),
														$data
														);
	}


  //결제값 적용
	public function order_end($data){
		$pg_date = $data['pg_date'];
		$pg_price = $data['pg_price'];
		$pg_fee_rate = $data['pg_fee_rate'];
		$pg_tid = $data['pg_tid'];
		$pg_type = $data['pg_type'];
		$order_number = $data['order_number'];

		$this->db->trans_begin();
		//결제 입력
		$sql = "INSERT INTO
							tbl_payment
						(
							order_yn,
							order_number,
							payment_code,
							pg_type,
							pg_type_name,
							pg_date,
							pg_price,
							pg_fee_rate,
							pg_tid,
							del_yn,
							ins_date,
							upd_date
						)values(
							'Y',
							?,
							'B',
							?,
							'',
							?,
							?,
							?,
							?,
							'N',
							now(),
							now()
						)

					";

		$this->query($sql,
								array(
								$order_number,
								$pg_type,
								$pg_date,
								$pg_price,
								$pg_fee_rate,
								$pg_tid,
								),
								$data
								);

		//오더 결제 update
		$sql = "UPDATE
							tbl_order
					  set
							real_yn='Y',
							order_state='1',
							account_st_price=(product_ea*(product_option_price+product_price)-use_point-member_coupon_price),
							account_supply=(account_st_price*(100-account_rate)/100),
							account_delivery=delivery_price,
							account_price=(account_delivery+account_supply),
							upd_date=now()
						WHERE
							order_number=?
					";

		$this->query($sql,
								array(
								$order_number
								),
								$data
								);

		// 쿠폰삭제 업데이트
		$this->order_member_copupon_update($data);

		/* 사용시 주석 해제하여 사용하시면 됩니다.*/
		// 포인트 사용업데이트
		//$this->order_member_point_update($data);

		// 장바구니 삭제
		//$this->order_member_cart_update($data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 포인트 사용업데이트
	function order_member_point_update($data){
		$order_number = $data['order_number'];

		$sql = "SELECT
		          member_idx,
							SUM(use_point) AS use_point
						FROM
						  tbl_order
						WHERE
							order_number=?
						GROUP BY member_idx
						";

		$rs = $this->query_row($sql, array($order_number));

		if(count($rs)>0){
			$member_idx =$rs->member_idx;
			$use_point =-$rs->use_point;
			$sql = "INSERT INTO
								tbl_member_point
							(
                member_idx,
								title,
								POINT,
								del_yn,
								ins_date,
								upd_date
							)VALUES(
								?,
								?,
								?,
								'N',
								NOW(),
								NOW()
							)
							";
      if($rs->use_point>0){
				$this->query($sql,
										array(
										$member_idx,
										'포인트 사용',
										$use_point,
										),
										$data
										);
			}
		}
	}

	// 쿠폰삭용 업데이트
	function order_member_copupon_update($data){
		$order_number = $data['order_number'];
		$sql = "UPDATE
							tbl_member_coupon
						SET
							use_yn = 'Y',
							upd_date=now()
						WHERE
							member_coupon_idx	IN (SELECT member_coupon_idx FROM tbl_order	WHERE	order_number=?)
						";

		$this->query($sql,
								array(
								$order_number
								)
								);
	}

	// 장바구니 삭제
	function order_member_cart_update($data){
		$order_number = $data['order_number'];

		$sql = "UPDATE
							tbl_cart
						SET
							del_yn = 'Y'
						WHERE
							cart_idx IN (SELECT	cart_idx FROM tbl_order	WHERE	order_number=?)
						";

		$this->query($sql,
								array(
								$order_number
								),
								$data
								);
	}
}	// 클래스의 끝
?>
