<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-10-28
|------------------------------------------------------------------------
*/

class My_scrap_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    $this->load->model(mapping('my_scrap').'/model_my_scrap');

	}

//인덱스
  public function index() {

    $this->my_scrap_list();
  }

//메인 화면
  public function my_scrap_list(){
		$this->_view2(mapping('my_scrap').'/view_my_scrap_list');
  }

  // 스크랩
  public function my_scrap_list_get(){
    $member_idx=$this->member_idx;

    $type = $this->_input_check("type",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $page_size = PAGESIZE;

    $data['type'] = $type;
    $data['member_idx'] = $member_idx;
    $data['page_no'] = ($page_num-1)*$page_size;
    $data['page_size'] = $page_size;

    $result_list = $this->model_my_scrap->scrap_list($data);
    $result_list_count = $this->model_my_scrap->scrap_list_count($data);

    $response = new stdClass();

    $response->type = $type;
    $response->member_idx = $member_idx;
    $response->result_list = $result_list;
    $response->result_list_count = $result_list_count;
    $response->total_block = ceil($result_list_count/$page_size);
    $response->loading_ok = (ceil($result_list_count/$page_size)>$page_num)?"Y":"N";

    $this->_list_view(mapping('my_scrap').'/view_my_scrap_list_get', $response);
  }

    //스크랩 담기
    public function scrap_del(){

      $key_idx = $this->_input_check("key_idx",array("empty_msg"=>"키가 누락되었습니다."));
      $type = $this->_input_check("type",array("empty_msg"=>"타입이 누락되었습니다."));
      $member_idx=$this->member_idx;
    
      $data['key_idx'] = $key_idx;
      $data['type'] = $type;
      $data['member_idx'] = $member_idx;
  
      $result = $this->model_my_scrap->scrap_del($data); // 1:1 질문 등록하기
  
      $response = new stdClass();
  
      if($result == "0") {
        $response->code = "0";
        $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
      } else {
        $response->code ="1";
        $response->code_msg = "스크랩 해제 하였습니다.";
      }
      echo json_encode($response);
      exit;
    }

}// 클래스의 끝
