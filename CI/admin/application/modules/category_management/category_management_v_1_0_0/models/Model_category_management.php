<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2020-10-25
| Memo : 카테고리 관리
|------------------------------------------------------------------------
*/

Class Model_category_management extends MY_Model{

	// 상품 카테고리 목록
	public function category_management_list($data){
		$category_depth = $data["category_depth"];
		$parent_category_management_idx = $data["parent_category_management_idx"];
		$type = $data["type"];

		$where_condition = array();
		$sql = "SELECT
							category_management_idx,
							parent_category_management_idx,
							category_depth,
							state,
							url,
							img_path,
							category_name
						FROM
							tbl_category_management
						WHERE	del_yn = 'N'
						and type='$type'
		";

		if($category_depth != ""){
			$sql .= " AND category_depth = ? ";
			array_push($where_condition, $category_depth);
		}
		if($parent_category_management_idx != ""){
			$sql .= " AND parent_category_management_idx = ? ";
			array_push($where_condition, $parent_category_management_idx);
		}
		$sql .= "ORDER BY order_no ASC";

		$result = $this->query_result($sql,
																	$where_condition);

		return $result;
	}

	// 상세
	public function category_management_detail($data){
		$category_management_idx = $data["category_management_idx"];

		$where_condition = array();

		$sql = "SELECT
							category_management_idx,
							parent_category_management_idx,
							category_depth,
							state,
							img_path,
							category_name
						FROM
							tbl_category_management
						WHERE	del_yn = 'N'
						and category_management_idx='$category_management_idx'
		";

		$result = $this->query_row($sql,
															 $where_condition);

		return $result;
	}

	// 상품 카테고리 등록
	public function category_management_reg_in($data){
		$parent_category_management_idx = $data['parent_category_management_idx'];
		$category_depth = $data['category_depth'];
		$category_name = $data['category_name'];
		$type = $data["type"];
		$url = $data["url"];

		$sql = "SELECT
							category_name
						FROM
							tbl_category_management
						WHERE
							category_name = ?
							AND category_depth = ?
							and type='$type'
						";

		$result = $this->query_result($sql,
																	array(
																	$category_name,
																	$category_depth));

		$sql = "SELECT
							MAX(order_no) as cnt
						FROM
							tbl_category_management
						WHERE
						  category_depth = $category_depth
							and type='$type'

					 ";
		if($category_depth !=1){
			$sql.="AND parent_category_management_idx = $parent_category_management_idx";
		}
		$last_order_no = $this->query_cnt($sql,
																			array(
																			));

		$this->db->trans_begin();

		$sql="INSERT INTO
						tbl_category_management
					(
						parent_category_management_idx,
						type,
						url,
						category_depth,
						category_name,
						order_no,
						del_yn,
						ins_date,
						upd_date
					)VALUES(
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

		$this->query($sql,
								 array(
								 $parent_category_management_idx,
								 $type,
								 $url,
								 $category_depth,
								 $category_name,
								 $last_order_no+1
								 ));

		$insert_id = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
		}

		return $insert_id;
	}

	// 상품 카테고리 삭제
	public function category_management_del($data){
		$category_management_idx = $data['category_management_idx'];

		$this->db->trans_begin();

		$sql="UPDATE
						tbl_category_management
					SET
						del_yn = 'Y'
					WHERE
						category_management_idx = ?
					";

		$this->query($sql,
								 array(
								 $category_management_idx
								 ));


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	// 상품 카테고리 수정
	public function category_management_mod_up($data){
		$category_management_idx = $data['category_management_idx'];
		$category_name = $data['category_name'];
		$url = $data['url'];

		$this->db->trans_begin();

		$sql="UPDATE
						tbl_category_management
					SET
						category_name = ?,
						url = ?
					WHERE
						category_management_idx = ?
					";

		$this->query($sql,
									array(
									$category_name,
									$url,
									$category_management_idx
									));

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

  //이미지 수정하기
	public function img_change_mod_up($data){
		$category_management_idx = $data['category_management_idx'];
		$img_path = $data['img_path'];

		$this->db->trans_begin();

		$sql="UPDATE
						tbl_category_management
					SET
						img_path = ?
					WHERE
						category_management_idx = ?
		";

		$this->query($sql,
									array(
									$img_path,
									$category_management_idx
									));

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	public function product_check($data){
		$category_management_idx = $data["category_management_idx"];
		$category_depth = $data["category_depth"];

		switch($category_depth){
			case "1" : $category_idx ="product_b_category_idx";break;
			case "2" : $category_idx ="product_m_category_idx";break;
			case "3" : $category_idx ="product_s_category_idx";break;
			case "4" : $category_idx ="product_f_category_idx";break;
		}

		$sql = "SELECT
							a.corp_product_idx
						FROM	tbl_corp_product as a
						 join tbl_product as b on b.product_idx =a.product_idx and b.del_yn='N' and $category_idx ='$category_management_idx'
						WHERE	a.del_yn = 'N' and a.sales_yn='Y'
						limit 1
		";

		return	$this->query_row($sql,
														 array(
														 ),
														 $data
														 );
	}

	// 카테고리  활성 / 활성화
	public function category_state_up($data){
		$category_management_idx = $data['category_management_idx'];

		$this->db->trans_begin();

		$sql="UPDATE
						tbl_category_management
					SET state= IF(state = 0,'1','0')
					WHERE
						category_management_idx = ?
					";

		$this->query($sql,
								  array(
									$category_management_idx
									));

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

	public function program_list_count($data){
		$category_management_idx = $data['category_management_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_program a
						WHERE
							a.del_yn = 'N'
							AND a.category_management_idx = '$category_management_idx'
		";

		return $this->query_cnt($sql,
													  array(
														),
														$data);
	}

	public function board_list_count($data){
		$category_management_idx = $data['category_management_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_board a
						WHERE
							a.del_yn = 'N'
							AND a.board_type =0
							AND a.category_idx = '$category_management_idx'
		";

		return $this->query_cnt($sql,
													  array(
														),
														$data);
	}

	// 상품 카테고리 순서 변경
	public function category_order_set($data){
		$first_cate_list_idx = $data['first_cate_list_idx'];
		$second_cate_list_idx = $data["second_cate_list_idx"];
		$third_cate_list_idx = $data["third_cate_list_idx"];
		$fourth_cate_list_idx = $data["fourth_cate_list_idx"];
		$select_depth = $data["select_depth"];
		$parent_category_management_idx = $data["parent_category_management_idx"];

		$this->db->trans_begin();
		if($select_depth == 0){
			for ($i=0; $i < count($first_cate_list_idx) ; $i++) {
				$sql="UPDATE
								tbl_category_management
							SET
								order_no = ?
							WHERE
								category_management_idx = ?
							";

				$this->query($sql,
										  array(
											$i+1,
											$first_cate_list_idx[$i]
											));
			}
	  }else if($select_depth == 1){
			for ($i=0; $i < count($second_cate_list_idx) ; $i++) {
				$sql="UPDATE
								tbl_category_management
							SET
								order_no = ?
							WHERE
								category_management_idx = ?
								AND parent_category_management_idx = ?
							";

				$this->query($sql,
										  array(
											$i+1,
											$second_cate_list_idx[$i],
											$parent_category_management_idx
											));
			}
		}else if($select_depth == 2){
			for ($i=0; $i < count($third_cate_list_idx) ; $i++) {
				$sql="UPDATE
								tbl_category_management
							SET
								order_no = ?
							WHERE
								category_management_idx = ?
								AND parent_category_management_idx = ?
							";

				$this->query($sql,
										  array(
											$i+1,
											$third_cate_list_idx[$i],
											$parent_category_management_idx
											));
			}
		}else if($select_depth == 3){
			for ($i=0; $i < count($fourth_cate_list_idx) ; $i++) {
				$sql="UPDATE
								tbl_category_management
							SET
								order_no = ?
							WHERE
								category_management_idx = ?
								AND parent_category_management_idx = ?
							";

				$this->query($sql,
										  array(
											$i+1,
											$fourth_cate_list_idx[$i],
											$parent_category_management_idx
											));
			}
		}
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

}	//클래스의 끝
?>
