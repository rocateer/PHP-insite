<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김용덕
| Create-Date : 2019-03-07
| Memo : 메인컨텐츠관리
|------------------------------------------------------------------------
*/


Class Model_main_contents extends MY_Model {


	//리스트
	public function product_list($data){

		$sql = "SELECT
							a.product_idx,
							a.product_code,
							a.product_main_img_path,
							a.product_name,
							b.corp_name,
							a.product_state,
							a.product_display_yn,
							a.ins_date
						FROM tbl_product as a
						 join tbl_corp as b on b.corp_idx=a.corp_idx
						WHERE a.del_yn='N'
						and a.product_display_yn='Y'
						and a.product_state='1'
						order by a.product_name asc

		";

		return $this->query_result($sql,array());
	}


	//리스트
	public function guide_list($data){

		$sql = "SELECT
							a.guide_idx,
							a.guide_type,
						  	title
						FROM tbl_guide as a
						WHERE a.del_yn='N'
						and a.display_yn='Y'
						order by a.title asc

		";

		return $this->query_result($sql,array());
	}

	//리스트
	public function main_section_list($data){
    $menu_type= $data['menu_type'];

		$sql = "SELECT
							main_section_idx,
							menu_type,			
							display_yn,
							guide_idx,	
							product_idx,	
							ins_date
							FROM tbl_main_section
							WHERE del_yn='N'
							AND  menu_type=?
		";
		return $this->query_result($sql,array($menu_type));


	}

	//수정
	public function main_section_mod_up($data){

		$main_section_idx = $data['main_section_idx'];
		$display_yn = $data['display_yn'];
		$guide_idx 			= $data['guide_idx'];
		$product_idx 			= $data['product_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_main_section
						SET
						
							display_yn = ?,
							guide_idx = ?,
							product_idx = ?,						
							upd_date = NOW()
						WHERE
							main_section_idx = ?
		";

		$this->query($sql,array(
								 $display_yn,
								 $guide_idx,
								 $product_idx,							
								 $main_section_idx
								 ),$data
							 );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	
	}







}
?>
