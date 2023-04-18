<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	정수범
| Create-Date : 2017-01-17
|------------------------------------------------------------------------
*/

class Model_mypage extends MY_Model{

  // 주문내역 연도 리스트
  public function order_years_list($data){
    $member_idx=$data['member_idx'];
    $order_gubun='0'; // 탭구분 (0:자동주문, 1:주문문의)

    $sql = "SELECT
               DISTINCT DATE_FORMAT(a.order_date,'%Y') AS order_year
            FROM tbl_order a
            JOIN tbl_corp b ON b.corp_idx = a.corp_idx
            WHERE a.del_yn='N'
                AND a.order_gubun='$order_gubun'
                AND a.order_state >= IF(a.order_gubun='$order_gubun',1,0)
                AND a.real_yn='Y'
                AND a.member_idx=?
            GROUP BY a.order_number,a.corp_idx,a.order_state,a.truman_state,a.order_date
            ORDER BY order_year DESC
						";

		return $this->query_result($sql,array(
																						$member_idx
																					));
  }

  // 주문내역 월 리스트
  public function order_months_list($data){
    $member_idx=$data['member_idx'];
    $order_gubun='0'; // 탭구분 (0:자동주문, 1:주문문의)

    $sql = "SELECT
               DISTINCT DATE_FORMAT(a.order_date,'%m') AS order_month
            FROM tbl_order a
            JOIN tbl_corp b ON b.corp_idx = a.corp_idx
            WHERE a.del_yn='N'
                AND a.order_gubun='$order_gubun'
                AND a.order_state >= IF(a.order_gubun='$order_gubun',1,0)
                AND a.real_yn='Y'
                AND a.member_idx=?
            GROUP BY a.order_number,a.corp_idx,a.order_state,a.truman_state,a.order_date
            ORDER BY order_month ASC
						";

		return $this->query_result($sql,array(
																						$member_idx
																					));
  }

  // 주문내역
  public function order_list_get($data){

    $member_idx=$data['member_idx'];
    $search_year=$data['search_year'];
    $search_month=$data['search_month'];

    $page_size=(int)$data['page_size'];
    $page_no=(int)$data['page_no'];

    $sql = "SELECT
                a.order_number,
                a.corp_idx,
                FN_AES_DECRYPT(b.corp_name) AS corp_name,
                COUNT(order_number) AS order_total_cnt,
                '카드결제' AS payment_type,
                (SELECT product_name FROM tbl_order WHERE order_number = a.order_number LIMIT 1) AS product_name,
                a.order_state,
                a.truman_state,
                SUM(((a.product_price+IFNULL(a.product_option_1_price,0)+IFNULL(a.product_option_2_price,0))*a.product_ea) + IFNULL(a.delivery_price,0)) AS total_price,
                DATE_FORMAT(a.order_date,'%Y.%m.%d') AS order_date
          FROM tbl_order a
          JOIN tbl_corp b ON b.corp_idx = a.corp_idx
          WHERE a.del_yn='N'
              AND a.order_gubun='0'
              AND a.order_state >= 1
              AND a.real_yn='Y'
              AND a.member_idx=?
						";

		if($search_year != ""){
			$sql .= " AND DATE_FORMAT(a.order_date,'%Y') = '$search_year' ";
		}

    if($search_month != ""){
			$sql .= " AND DATE_FORMAT(a.order_date,'%m') = '$search_month' ";
		}

    $sql.="	GROUP BY a.order_number,a.corp_idx,a.order_state,a.truman_state,a.order_date ";
    $sql.="	ORDER BY a.order_date DESC ";
		$sql.="	limit ?,? ";

    return $this->query_result($sql,array(
                                            $member_idx,
                                            $page_no,
                                            $page_size
                                          ));
  }

  // 주문내역 카운트
  public function order_list_get_count($data){

    $member_idx=$data['member_idx'];
    $search_year=$data['search_year'];
    $search_month=$data['search_month'];

    $sql="SELECT COUNT(*) AS cnt
          FROM (
                SELECT
                      a.member_idx
                FROM tbl_order a
                JOIN tbl_corp b ON b.corp_idx = a.corp_idx
                WHERE a.del_yn='N'
                    AND a.order_gubun='0'
                    AND a.order_state >= 1
                    AND a.real_yn='Y'
                    AND a.member_idx=$member_idx
         ";

    if($search_year != ""){
 			$sql .= " AND DATE_FORMAT(a.order_date,'%Y') = '$search_year' ";
 		}

     if($search_month != ""){
 			$sql .= " AND DATE_FORMAT(a.order_date,'%m') = '$search_month' ";
 		}

     $sql.="	GROUP BY a.order_number,a.corp_idx,a.order_state,a.truman_state,a.order_date ) ta ";

    return $this->query_cnt($sql,array());

  }

  // 주문내역 상세정보 가져오기
  public function order_view($data){

    $order_number = $data['order_number'];

    $sql="SELECT
            	a.order_number,
            	DATE_FORMAT(a.order_date,'%Y.%m.%d') AS order_date,
            	a.order_state,
            	a.corp_idx,
            	FN_AES_DECRYPT(b.corp_name) AS corp_name,
            	a.truman_idx,
              c.truman_img,
            	FN_AES_DECRYPT(c.truman_name) AS truman_name,
            	FN_AES_DECRYPT(c.truman_phone) AS truman_phone,
            	FN_AES_DECRYPT(a.receiver_post_number) AS receiver_post_number,
            	FN_AES_DECRYPT(a.receiver_addr) AS receiver_addr,
            	FN_AES_DECRYPT(a.receiver_addr_detail) AS receiver_addr_detail,
            	a.truman_state,
            	SUM(a.delivery_prearranged_time) AS delivery_prearranged_time,
            	CASE
            	WHEN a.order_gubun='0' THEN '카드결제'
            	END payment_type,
            	SUM(a.delivery_price) AS delivery_price,
              a.account_price,
            	a.delivery_msg,
              a.order_msg,
              ROUND(SUM(a.delivery_distance),1) AS delivery_distance,
            	SUM((product_price+IFNULL(product_option_1_price,0)+IFNULL(product_option_2_price,0))*product_ea) AS total_product_price
          FROM tbl_order a
              JOIN tbl_corp b ON b.corp_idx = a.corp_idx
              LEFT OUTER JOIN tbl_truman c ON c.truman_idx = a.truman_idx AND c.del_yn='N'
          WHERE a.order_number = ?
          GROUP BY a.order_number,a.order_date,a.order_state,a.corp_idx,a.truman_idx,a.receiver_post_number,a.receiver_addr,a.receiver_addr_detail,a.truman_state,a.delivery_msg,a.order_msg,a.order_gubun,a.account_price
          ";

    return $this->query_row($sql, array(
                                          $order_number
                                        ));
  }

  // 주문정보 메뉴 목록
  public function order_menu_list($data){
    $order_number = $data['order_number'];

    $sql="SELECT
            	a.product_name,
            	a.product_option_1_name,
            	a.product_option_2_name,
            	a.product_ea,
            	(product_price+IFNULL(product_option_1_price,0)+IFNULL(product_option_2_price,0))*product_ea AS tot_product_price
          FROM tbl_order a
          WHERE order_number = ?
          ";

    return $this->query_result($sql,array(
    																				$order_number
    																			));
  }

  // 내정보 가져오기
  public function get_my_info($data) {

    $member_idx = $data['member_idx'];

    $sql = "SELECT
              FN_AES_DECRYPT(a.member_addr) AS member_addr,
              FN_AES_DECRYPT(a.member_addr_detail) AS member_addr_detail,
              FN_AES_DECRYPT(a.member_addr_postcode) AS member_addr_postcode,
              FN_AES_DECRYPT(a.member_phone) AS member_phone
            FROM
              tbl_member a
            WHERE
              a.member_idx = ?
            ";

    return $this->query_row($sql, array($member_idx));
  }

  // 마이페이지 내 정보수정 비밀번호 체크
  public function checkPwd($data) {

      $member_idx = $data['member_idx'];
      $member_pwd = $data['member_pwd'];

      $sql = "SELECT
                COUNT(*) AS cnt
              FROM
                tbl_member
              WHERE
                member_pw = SHA2(?,512)
                AND member_idx = ?
              ";

      return $this->query_cnt($sql, array($member_pwd, $member_idx));
  }

  // 내 정보 수정(비밀번호)
  public function member_change_pwd($data) {

    $member_idx = $data['member_idx'];
    $member_pwd = $data['new_pwd'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
            SET
              member_pw = SHA2(?,512),
              upd_date = NOW()
            WHERE
              member_idx = ?
            ";

    $this->query($sql,array(
                              $member_pwd,
                              $member_idx
                            ));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    }else{

      $this->db->trans_commit();
      return "1";
    }

  }

  // 내 정보 수정(주소)
  public function member_change_addr($data) {

    $member_idx = $data['member_idx'];
    $member_addr_postcode = $data['member_addr_postcode'];
    $member_addr = $data['member_addr'];
    $member_addr_detail = $data['member_addr_detail'];
    $member_lat = $data['member_lat'];
    $member_lng = $data['member_lng'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
            SET
              member_addr_postcode = FN_AES_ENCRYPT(?),
              member_addr = FN_AES_ENCRYPT(?),
              member_addr_detail = FN_AES_ENCRYPT(?),
              member_lat = ?,
              member_lng = ?,
              upd_date = NOW()
            WHERE
              member_idx = ?
            ";

    $this->query($sql,array(
                              $member_addr_postcode,
                              $member_addr,
                              $member_addr_detail,
                              $member_lat,
                              $member_lng,
                              $member_idx
                            ));

    if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{

			$this->db->trans_commit();
			return "1";
		}

  }

  // 회원탈퇴
  public function member_withdrawal($data) {

    $member_idx = $data['member_idx'];
    $member_memo = $data['member_memo'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
            SET
              member_memo = ?,
              member_state = '2',
              del_yn = 'Y',
              upd_date = NOW()
            WHERE
              member_idx = ?
            ";

    $this->query($sql,array(
                              $member_memo,
                              $member_idx
                            ));

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    }else{

      $this->db->trans_commit();
      return "1";
    }

  }

  // 업체 단골(좋아요) 목록
	public function like_store_list_get($data){

		$member_idx=$data['member_idx'];

		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$sql = "SELECT
									a.corp_idx,
									FN_AES_DECRYPT(a.corp_name) AS corp_name,
                  FN_AES_DECRYPT(a.corp_addr) AS corp_addr, -- 매장주소
                  FN_AES_DECRYPT(a.corp_addr_detail) AS corp_addr_detail, -- 매장상세주소
									a.corp_contents,
									IFNULL(a.corp_like_cnt,0) AS corp_like_cnt,
									a.corp_open_time,
									a.corp_close_time,
									a.corp_gubun,
									ROUND(6371*ACOS(COS(RADIANS(c.member_lat))*COS(RADIANS(a.corp_lat))*COS(RADIANS(a.corp_lng)-RADIANS(c.member_lng))+SIN(RADIANS(c.member_lat))*SIN(RADIANS(a.corp_lat))),2) AS distance,
									(SELECT ROUND((SUM(review_star) / COUNT(corp_idx)),1) FROM tbl_product_review WHERE del_yn = 'N' AND corp_idx=a.corp_idx) AS star_avg,
									(SELECT corp_img_path FROM tbl_corp_img WHERE del_yn = 'N' AND corp_idx = a.corp_idx AND corp_img_status=0 AND corp_img_order=0) AS corp_img_path,
									a.ins_date,
									CASE
									WHEN DATEDIFF(DATE_FORMAT(SYSDATE(), '%Y%m%d'), DATE_FORMAT(CONVERT(a.ins_date, DATE), '%Y%m%d')) <= 20 THEN 'Y'
									ELSE 'N'
									END new_corp,
									(SELECT GROUP_CONCAT(corp_holidays) FROM tbl_corp_holiday WHERE corp_idx=a.corp_idx AND del_yn = 'N') AS holidays,
									CASE
									WHEN DATE_FORMAT(SYSDATE(),'%H:%i') >= a.corp_open_time && DATE_FORMAT(SYSDATE(),'%H:%i') <= a.corp_close_time && (CASE INSTR(IFNULL((SELECT GROUP_CONCAT(corp_holidays) FROM tbl_corp_holiday WHERE corp_idx=a.corp_idx AND del_yn = 'N'),8),WEEKDAY(SYSDATE())) WHEN 0 THEN '0' ELSE '1' END) = 0 THEN 'Y'
									ELSE 'N'
									END opening_yn,
									b.corp_like_idx,
									b.like_yn -- 좋아요 여부(1:좋아요 , -1:좋아요 취소)
						FROM tbl_corp AS a
									JOIN tbl_corp_like b ON b.corp_idx = a.corp_idx AND b.del_yn='N'
									JOIN tbl_member c ON c.member_idx = b.member_idx
						WHERE a.del_yn='N'
									AND a.corp_state = '0'
									AND b.like_yn = 1
									AND b.member_idx = ?
						";

		$sql.=" ORDER BY corp_like_idx DESC";

		$sql.="	limit ?,? ";

		return $this->query_result($sql,array(
																						$member_idx,
																						$page_no,
																						$page_size
																					));
	}

	// 업체 단골(좋아요) 목록 카운트
	public function like_store_list_get_count($data){

		$member_idx=$data['member_idx'];

		$sql = "SELECT
								COUNT(*) AS cnt
						FROM tbl_corp AS a
									JOIN tbl_corp_like b ON b.corp_idx = a.corp_idx AND b.del_yn='N'
									JOIN tbl_member c ON c.member_idx = b.member_idx
						WHERE a.del_yn='N'
									AND a.corp_state = '0'
									AND b.like_yn = 1
									AND b.member_idx = ?
						";

		return $this->query_cnt($sql,array(
																				$member_idx
																			));
	}

  // 회원 review 리스트
	public function review_list_get($data){

		$member_idx=$data['member_idx'];

		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$sql = "SELECT
								a.product_review_idx,
								a.corp_idx,
								FN_AES_DECRYPT(b.corp_name) AS corp_name,
								a.member_idx,
								a.review_star,
								a.title,
								a.contents,
								a.reply_yn,
                a.reply_contents,
								DATE_FORMAT(a.reply_date,'%Y.%m.%d') AS reply_date,
								DATE_FORMAT(a.ins_date,'%Y.%m.%d') AS ins_date
						FROM tbl_product_review a
						JOIN tbl_corp b ON b.corp_idx=a.corp_idx
						WHERE a.del_yn = 'N'
							AND a.member_idx=?
						";

		$sql.=" ORDER BY product_review_idx DESC";

		$sql.="	limit ?,? ";

		return $this->query_result($sql,array(
																						$member_idx,
																						$page_no,
																						$page_size
																					));
	}

	// 회원 review 리스트 카운트
	public function review_list_get_count($data){

		$member_idx=$data['member_idx'];

		$sql = "SELECT
								COUNT(*) AS cnt
						FROM tbl_product_review a
						JOIN tbl_corp b ON b.corp_idx=a.corp_idx
						WHERE a.del_yn = 'N'
							AND a.member_idx=?
						";

		return $this->query_cnt($sql,array(
																				$member_idx
																			));
	}

  // 회원리뷰 삭제
  public function review_del_up($data){

    $product_review_idx = $data['product_review_idx'];

    $this->db->trans_begin();

    $sql = "  UPDATE
                tbl_product_review
							SET
								del_yn='Y',
                upd_date=NOW()
							WHERE
								product_review_idx=?
            ";

    $this->query($sql,array(
															$product_review_idx
														));

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{

			$this->db->trans_commit();
			return "1";
		}

  }

  // 재인증 회원 check
  public function member_re_auth_check($data){
    $member_name=$data['member_name'];
		$member_phone=$data['member_phone'];
		$member_gender=$data['member_gender'];
		$member_birthDay=$data['member_birthDay'];
    $member_idx=$this->member_idx;

    $sql = "SELECT
                COUNT(1) AS cnt
            FROM tbl_member
            WHERE FN_AES_DECRYPT(member_name)=?
                AND FN_AES_DECRYPT(member_birth)=?
                AND member_idx=?
            ";

    return $this->query_cnt($sql,array(
          															$member_name,
                                        $member_birthDay,
                                        $member_idx
          														));

  }

  // 재인증을 통한 휴대폰번호 수정
  public function member_phone_mod_up($data){

    $member_name=$data['member_name'];
		$member_phone=$data['member_phone'];
		$member_gender=$data['member_gender'];
		$member_birthDay=$data['member_birthDay'];
    $member_idx=$this->member_idx;

    $this->db->trans_begin();

    $sql = "  UPDATE
                tbl_member
							SET
								member_phone=FN_AES_ENCRYPT(?),
                upd_date=NOW()
              WHERE FN_AES_DECRYPT(member_name)=?
                AND FN_AES_DECRYPT(member_birth)=?
                AND member_idx=?
            ";

    $this->query($sql,array(
															$member_phone,
                              $member_name,
                              $member_birthDay,
                              $member_idx
														));

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}

  }

}// 클래스의 끝
?>
