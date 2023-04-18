<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-06-14
| Memo : 프로젝트 공통 기능
|------------------------------------------------------------------------
*/

Class Model_p_common extends MY_Model {

  //카테고리
  public function category_list($data){
    $parent_category_management_idx = $data["parent_category_management_idx"];
    $type = $data["type"];

    $sql = "SELECT
							category_management_idx,
							parent_category_management_idx,
							category_depth,
							state,
							category_name
						FROM
							tbl_category_management
						WHERE	del_yn = 'N'
						and type='$type'
		";
    if($parent_category_management_idx !=""){
      $sql .= "  AND parent_category_management_idx = '$parent_category_management_idx' ";
    }else{
      $sql .= "  AND category_depth = '1' ";
    }
		$sql .= "ORDER BY order_no ASC";

    return $this->query_result($sql,array());

  }


  //  시도리스트
  public function city_list(){

    $sql = "SELECT
              city_code,
              city_name
            FROM tbl_city
            WHERE del_yn='N'
            ORDER BY order_no ASC
  ";

  return $this->query_result($sql,array(

                            )
                            );
  }

  //  시,구군 리스트
  public function region_list($data){
    $city_code = $data['city_code'];

    $sql = "SELECT
              region_code,
              region_name
            FROM tbl_region
            WHERE del_yn='N'
            AND city_code='$city_code'
            ORDER BY region_name ASC
  ";

  return $this->query_result($sql,array(

                            )
                            );
  }


  //  동리스트
  public function dong_list($data){
    $region_code = $data['region_code'];

    $sql = "SELECT
              dong_idx,
              dong_code,
              dong_name,
              lat,
              lng
            FROM tbl_dong
            WHERE del_yn='N'
            AND region_code='$region_code'
            ORDER BY dong_name ASC
    ";

    return $this->query_result($sql,array(

                            )
                            );
  }






}
?>
