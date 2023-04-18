<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2017-11-04
| Memo : cart api
|------------------------------------------------------------------------
*/

Class Model_cart extends MY_Model {

  // 리스트
	public function member_cart_count($data) {
		$member_idx 			= $data['member_idx'];

		$sql = "SELECT
						  count(*) as cnt
						FROM
							tbl_cart a
							JOIN tbl_product AS b ON b.product_idx =a.product_idx AND b.del_yn ='N'
						WHERE	a.del_yn = 'N'
						AND a.cart_type = '0'
						AND a.member_idx = ?
    ";

	  return	$this->query_cnt($sql,array(
																				$member_idx
																			  ));
	}


	//$cart_session_id 카운트
 public function cart_session_count($data) {
	 $cart_session_id 			= $data['cart_session_id'];

	 $sql = "SELECT
									 count(*) as cnt
					 FROM
						 tbl_cart a
					 WHERE
								 a.del_yn = 'N'
								 AND a.cart_session_id = ?
					 ";
	 return	$this->query_cnt($sql,array(
																			 $cart_session_id
																			 ));
 }

  // 장바구니 리스트 가져오기
 	public function cart_list_get($data) {
 		$member_idx 			= $data['member_idx'];

 		$sql = "SELECT
 							a.cart_idx,
 							a.cart_ea,
 							a.product_idx,
 							b.product_name,
 							a.product_option_name,
 							a.product_price,
 							a.product_option_price,
 							b.product_delivery,
							b.product_img_path,
 							(a.cart_ea*(a.product_price+IFNULL(a.product_option_price,0))) AS sum_price
 						FROM
 							tbl_cart a
 							JOIN tbl_product AS b ON b.product_idx =a.product_idx AND b.del_yn ='N'
 						WHERE
 									a.del_yn = 'N'
 									AND a.cart_type = '0'
 									AND a.member_idx = ?
 						ORDER BY a.cart_idx desc
 				    ";

 	  return	$this->query_result($sql,array(
 																						$member_idx
 																				   ));
 	}


    //리스트 총 카운트
 	public function cart_list_count($data) {
 		$member_idx 			= $data['member_idx'];

 		$sql = "SELECT
 							count(*) as cnt
 						FROM
 							tbl_cart a
 							JOIN tbl_product AS b ON b.product_idx =a.product_idx AND b.del_yn ='N'
 						WHERE
							a.del_yn = 'N'
							AND a.cart_type = '0'
							AND a.member_idx = ?
 		";

		return	$this->query_cnt($sql,array(
 																				$member_idx
 																				));
 	}


	//장바구니등록
  public function cart_reg_in($data) {

		$member_idx								= $data['member_idx'];
		$product_idx		 					= (int)$data['product_idx'];
		$product_ea   								= $data['product_ea'];
		$cart_session_id			    = $data['cart_session_id'];
		$cart_type			    = $data['cart_type'];
		$product_price			    = $data['product_price'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
									tbl_cart
									(
										member_idx,
										product_idx,
										cart_type,
										cart_ea,
										product_price,
										cart_session_id,
										del_yn,
										ins_date,
										upd_date
									)
								VALUES
									(
										?,
										?,
										?,
										?,
										?,
										?,
										'N',
										NOW(),
										NOW()
									)
								";

				$this->query($sql, array(
																	$member_idx,
																	$product_idx,
																	$cart_type,
																	$product_ea,
																	$product_price,
																	$cart_session_id
																));


		if($this->db->trans_status() === FALSE) {
		 $this->db->trans_rollback();
		 return "0";
		} else {
		 $this->db->trans_commit();
		 return "1";
		}
	}//end 장바구니등록



	// 장바구니 수량 수정
	public function cart_ea_up($data) {
		$member_idx = $data['member_idx'];
		$cart_idx   = $data['cart_idx'];
		$cart_ea    = $data['cart_ea'];

		$this->db->trans_begin();

		$sql = "UPDATE
						 		tbl_cart
						SET
								cart_ea=?,
								upd_date =now()
					  where
									member_idx=?
						and cart_idx=?
					 ";

		$this->query($sql, array(
															 $cart_ea,
															 $member_idx,
															 $cart_idx
														));

		if($this->db->trans_status() === FALSE) {
		 $this->db->trans_rollback();
		 return "0";
		} else {
		 $this->db->trans_commit();
		 return "1";
		}
	}

	// 장바구니 삭제
	public function cart_del_up($data) {
		$member_idx = $data['member_idx'];
		$cart_idx = $data['cart_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
						 	tbl_cart
						set
							del_yn='Y',
							upd_date =now()
					  where
							cart_idx in($cart_idx)
					 ";

		$this->query($sql, array(

														));

		if($this->db->trans_status() === FALSE) {
		 $this->db->trans_rollback();
		 return "0";
		} else {
		 $this->db->trans_commit();
		 return "1";
		}
	}

}
?>
