<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-06-14
| Memo : 프로젝트 공통 기능
|------------------------------------------------------------------------
*/

Class Model_p_common extends MY_Model {

//국가 리스트 출력 -JAZZ
  public function nation_list(){

    $sql = "  SELECT
                  nation_idx,
                  nation_name,
                  ins_date,
                  upd_date
              FROM
                  tbl_nation
              WHERE
                  del_yn = 'N'
                  ORDER BY nation_name ASC
            ";

    return $this->query_result($sql,array());

  }

//도시 리스트 출력 -JAZZ
  public function city_list($data){

    $nation_idx = $data['nation_idx'];

    $sql = "  SELECT
                  nation_idx,
                  city_idx,
                  city_name,
                  ins_date,
                  upd_date
              FROM
                  tbl_city
              WHERE
                  del_yn = 'N'
                  AND nation_idx = ?
                  ORDER BY city_name ASC
            ";

    return $this->query_result($sql
                                    ,array(
                                            $nation_idx
                                    )
                              );

  }

//메인 추천 상품 카테고리 리스트 - JAZZ
  public function main_recom_catergory_list(){

    $sql = "  SELECT
                  main_recom_category_idx,
                  category_name
              FROM
                  tbl_main_recom_category
              WHERE
                  del_yn = 'N'
                  ORDER BY category_name ASC
            ";

    return $this->query_result($sql,array());

  }


  //공통 : 상품 브랜드 리스트
    public function product_brand_list(){

      $sql = "  SELECT
                    product_brand_idx,
                    brand_name
                FROM
                    tbl_product_brand
                WHERE
                    del_yn = 'N'
                    ORDER BY brand_name ASC
              ";

      return $this->query_result($sql,array());

    }



    //공통 : 상품 모델 리스트
      public function product_model_list($data){
        $product_brand_idx = $data['product_brand_idx'];

        $sql = "  SELECT
                      product_model_idx,
                      model_name
                  FROM
                      tbl_product_model
                  WHERE
                      del_yn = 'N'

                ";
          $sql .= "  and product_brand_idx =?   ";
          $sql .= "  order by model_name asc  ";

        return $this->query_result($sql,array($product_brand_idx));

      }






}
?>
