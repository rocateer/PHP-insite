<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
|------------------------------------------------------------------------
*/

class Terms_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

    $this->load->model(mapping('terms').'/model_terms');
    
  }

  //인덱스
  public function index() {
    $this->terms_detail();
  }

  //이용약관 동의
  public function terms_detail(){
    $type = $this->_input_check("type",array());

		$data['type'] = $type;

    $result = $this->model_terms->terms_detail($data); //약관 상세
    
    $response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('terms').'/view_terms_detail',$response);
  }


}// 클래스의 끝
?>
