<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2020-05-11
| Memo : 결제 모듈
|------------------------------------------------------------------------
*/

Class Model_payment_in_app extends MY_Model {

  //결제값 적용
	public function order_end($data){
		$pg_price = $data['pg_price'];
		$pg_fee_rate = $data['pg_fee_rate'];
		$order_number = $data['order_number'];
		$payment_code = $data['payment_code'];

		$this->db->trans_begin();
		//결제 입력
		$sql = "INSERT INTO
							tbl_payment
						(
							order_yn,
							order_number,
							payment_code,
							pg_date,
							pg_price,
							pg_fee_rate,
							del_yn,
							ins_date,
							upd_date
						)values(
							'Y',
							?,
							?,
							NOW(),
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
								$payment_code,
								$pg_price,
								$pg_fee_rate,
								),
								$data
								);

		//오더 결제 update
		$sql = "UPDATE
							tbl_order
					  set
							real_yn='Y',
              deposit_yn='Y',
							payment_code = ?,
							upd_date=now()
						WHERE
							order_number=?
					";

		$this->query($sql,
								array(
								$payment_code,
								$order_number
								),
								$data
								);

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
