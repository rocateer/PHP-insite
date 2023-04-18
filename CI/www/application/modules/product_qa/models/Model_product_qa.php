<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2017-10-14
| Memo : 상품 관련 API Model
|------------------------------------------------------------------------
*/
Class Model_product_qa extends MY_Model {

  //대분류리스트
  public function product_b_category_list() {
		$sql = "SELECT
              category_management_idx,
              category_name,
              ifnull((select category_management_idx from tbl_category_management  WHERE  del_yn='N' and parent_category_management_idx=a.category_management_idx and category_depth='2' ORDER BY order_no  limit 1),'') as category_m
            FROM
              tbl_category_management as a
            WHERE  del_yn='N'
            and category_depth='1'
            ORDER BY order_no
    ";
    return $this->query_result($sql, array());
  }

  //중분류리스트
  public function product_m_category_list($data) {
		$parent_category_management_idx = $data['category_b'];

		$sql = "SELECT
              parent_category_management_idx,
              category_management_idx,
              category_name
            FROM
              tbl_category_management
            WHERE  del_yn='N'
            and category_depth='2'
						and parent_category_management_idx='$parent_category_management_idx'
            ORDER BY order_no
    ";

    return $this->query_result($sql, array());
  }

  //소분류리스트
  public function product_s_category_list($data) {
		$parent_category_management_idx = $data['category_m'];

		$sql = "SELECT
              category_management_idx,
              category_name
            FROM
              tbl_category_management
            WHERE  del_yn='N'
            and category_depth='3'
						and parent_category_management_idx='$parent_category_management_idx'
            ORDER BY order_no
    ";

    return $this->query_result($sql, array());
  }

  //현재위치
  public function get_location($data) {
		$category_b = $data['category_b'];
		$category_m = $data['category_m'];
		$category_s = $data['category_s'];

		$sql = "SELECT
              category_name as category_b_name,
              ifnull((select category_name from tbl_category_management  WHERE  del_yn='N' and category_management_idx='$category_m' ),'') as category_m_name,
              ifnull((select category_name from tbl_category_management  WHERE  del_yn='N' and category_management_idx='$category_s' ),'') as category_s_name
            FROM
              tbl_category_management
            WHERE  del_yn='N'
						and category_management_idx='$category_b'
            ORDER BY order_no
    ";

    return $this->query_row($sql, array());
  }

  public function product_list($data) {
    $page_size = (int)$data['page_size'];
    $page_no = (int)$data['page_no'];

    $category_b = $data['category_b']; //대분류
    $category_m = $data['category_m']; //중분류
    $category_s = $data['category_s']; //소분류
    $orderby = $data['orderby'];//정렬(0:상품순,1:인기상품순,2:낮은가격순,3:높은가격순)

    $sql = "SELECT
              a.product_idx,
              a.product_b_category_idx,
              a.product_b_category_name,
              a.product_m_category_idx,
              a.product_m_category_name,
              a.product_s_category_idx,
              a.product_s_category_name,
              a.product_name,
              a.product_st_price,
              a.product_price,
              a.product_ea,
              a.product_point,
							a.product_contents,
							a.product_img_path
            FROM
              tbl_product as a
            WHERE a.del_yn='N'
							AND a.product_state='1'
							AND a.auth_status='1'
              AND a.product_ea > 0

    ";
    if ($category_b != "") {
			$sql .= "AND product_b_category_idx= '$category_b' ";
		}
    if ($category_m != "") {
			$sql .= "AND product_m_category_idx= '$category_m' ";
		}
    if ($category_s != "") {
			$sql .= "AND product_s_category_idx= '$category_s' ";
		}
		// if ($product_name != "") {
		// 	$sql .= "AND product_name LIKE '%$product_name%' ";
		// }
    //정렬(0:상품순,1:인기상품순,2:낮은가격순,3:높은가격순)
    if($orderby){
      if($orderby==0){
        $sql .=" order by product_name desc  ";
      }
      if($orderby==1){
        $sql .=" order by sale_amount desc  ";
      }
      if($orderby==2){
        $sql .=" order by product_price asc  ";
      }
      if($orderby==0){
        $sql .=" order by product_price desc  ";
      }
    }
    $sql .="LIMIT ?, ? ";
    return $this->query_result($sql,array( $page_no,$page_size));
  }


//리스트 총 카운트
	public function product_list_count($data)
	{
    $category_b = $data['category_b']; //대분류
    $category_m = $data['category_m']; //중분류
    $category_s = $data['category_s']; //소분류

    $sql = "SELECT
             count(*) AS cnt
            FROM
            tbl_product as a
            WHERE a.del_yn='N'
							AND a.product_state='1'
							AND a.auth_status='1'
              AND a.product_ea > 0
    ";
    if ($category_b != "") {
			$sql .= "AND product_b_category_idx= '$category_b' ";
		}
    if ($category_m != "") {
			$sql .= "AND product_m_category_idx= '$category_m' ";
		}
    if ($category_s != "") {
			$sql .= "AND product_s_category_idx= '$category_s' ";
		}
		// if ($product_name != "") {
		// 	$sql .= "AND product_name LIKE '%$product_name%' ";
		// }
		return $this->query_cnt($sql, array());
	}


  // 상품정보
  public function product_detail($data) {
    $product_idx = $data['product_idx'];

    $sql = "SELECT
              a.product_idx,
              a.product_code,
              a.product_b_category_idx,
              a.product_b_category_name,
              a.product_m_category_idx,
              a.product_m_category_name,
              a.product_s_category_idx,
              a.product_s_category_name,
              a.product_name,
              a.product_st_price,
					    a.product_ea,
							a.product_point,
							a.product_price,
							a.product_contents,
							a.product_info_img_path,
							a.product_origin,
							a.stock_amount,
							a.product_delivery,
              ifnull((select group_concat(product_option_idx,'^',product_option_name) from tbl_product_option  WHERE  del_yn='N' and  product_code=a.product_code ORDER BY product_option_idx ASC limit 2 ),'') as product_option,
              ifnull((select count(1) as cnt from tbl_product_review  WHERE  del_yn='N' and  product_idx=a.product_idx  ),'') as product_reivew_cnt,
              ifnull((select count(1) as cnt from tbl_product_qa  WHERE  del_yn='N' and   product_idx=a.product_idx),'') as product_qa_cnt
            FROM
              tbl_product as a
            WHERE
              product_idx = ?
    ";

    return $this->query_row($sql, array($product_idx));
  } // end product_view


   //이미지::가져오기
  public function product_img_list($data) {
		$product_idx = $data['product_idx'];

    $sql = "SELECT
							product_img_type,
							product_img_path
						FROM tbl_product_img AS a
						WHERE a.del_yn='N'
							AND product_idx=?
						ORDER BY product_img_order ASC
    ";

    return $this->query_result($sql,array( $product_idx));
  } // end product_list


  //옵션::가져오기
 public function product_option_list($data) {
   $product_code = $data['product_code'];

   $sql = "SELECT
             product_option_idx,
             product_option_name,
             ifnull((select group_concat(product_option_detail,'^',product_option_price) from tbl_product_option_detail  WHERE  del_yn='N' and  product_option_idx=a.product_option_idx ORDER BY product_option_detail_idx ASC  ),'') as option_select
           FROM tbl_product_option AS a
           WHERE a.del_yn='N'
             AND product_code=?
           ORDER BY product_option_idx   ASC
           limit 2
   ";

   return $this->query_result($sql,array( $product_code));
 } // end product_list




} // end class
?>
