<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2016-06-14
| Memo : 프로젝트 공통 기능
|------------------------------------------------------------------------
*/

class P_common extends MY_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('p_common/model_p_common');
	}

//도시 리스트 출력
	public function city_list() {

		header('Content-Type: application/json');
		$nation_idx=($this->input->POST("nation_idx", TRUE) != "")	?	$this->_escstr($this->input->POST("nation_idx", TRUE)) : "";

		$data['nation_idx'] = $nation_idx;

		$result = $this->model_p_common->city_list($data);

		echo json_encode(array("list_data"=>$result));
		exit;

	}


	//도시 리스트 출력
		public function product_model_list() {

			header('Content-Type: application/json');
			$product_brand_idx=($this->input->POST("product_brand_idx", TRUE) != "")	?	$this->_escstr($this->input->POST("product_brand_idx", TRUE)) : "";

			$data['product_brand_idx'] = $product_brand_idx;

			$result = $this->model_p_common->product_model_list($data);

			echo json_encode(array("list_data"=>$result));
			exit;

		}


}
