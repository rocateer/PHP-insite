<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
|------------------------------------------------------------------------
*/

class Work_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

    $this->load->model(mapping('work').'/model_work');
    $this->load->model('common/model_common');
  }

  //인덱스
  public function index() {
    $this->work_detail();
  }

  //등록
  public function work_reg(){
    $work_list = $this->model_common->work_list();
		$info_detail = $this->model_common->info_detail();

		$response = new stdClass();

		$response->info_detail = $info_detail;
		$response->work_list = $work_list;

    $this->_view(mapping('work').'/view_work_reg', $response);
  }

  //이용약관 동의
  public function work_detail(){
    $type = $this->_input_check("type",array());

		$data['type'] = $type;

    $result = $this->model_work->work_detail($data); //약관 상세
    
    $response = new stdClass();

		$response->result = $result;

		$this->_view(mapping('work').'/view_work_detail',$response);
  }

  //인증 반려
  public function work_reject(){

		$this->_view(mapping('work').'/view_work_reject');
  }


}// 클래스의 끝
?>
