<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	정수범
| Create-Date : 2017-01-15
| Memo : 제주왕플랫폼 메인
|------------------------------------------------------------------------
*/

class Model_main extends MY_Model{
	// 1. banner_list
  public function banner_list(){

		$sql = "SELECT
              banner_idx,
              title,
              img_path,
              link_url
            FROM tbl_banner
            WHERE del_yn='N'
             AND state=1
				  ";
		return $this->query_result($sql,
															array(
															)
														  );

  }


	// 2. md_product_list
	public function md_product_list(){

		$sql = "SELECT
							product_idx,
							product_name,
							product_img_path,
							product_st_price,
							product_price
						FROM	tbl_product as a
            join tbl_corp as b on b.corp_idx=a.corp_idx and b.del_yn='N' and b.corp_state='1'
						WHERE a.del_yn='N'
							AND a.product_state='1'
							AND a.auth_status='1'
							AND a.main_view_yn='Y'
              and e_date>=current_date
							ORDER BY product_idx DESC
						LIMIT 5
		";

		return	$this->query_result($sql,
																array(
																)
																);

	}

	// 3. new_product_list
	public function new_product_list(){

		$sql = "SELECT
							product_idx,
							product_name,
							product_img_path,
							product_st_price,
							product_price
          FROM	tbl_product as a
            join tbl_corp as b on b.corp_idx=a.corp_idx and b.del_yn='N' and b.corp_state='1'
          WHERE a.del_yn='N'
            AND a.product_state='1'
            AND a.auth_status='1'
            and e_date>=current_date
  				ORDER BY product_idx DESC
					LIMIT 10
		";

		return	$this->query_result($sql,
																array(
																)
																);

	}

}// 클래스의 끝
?>
