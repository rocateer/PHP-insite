<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-10-27
|------------------------------------------------------------------------
*/

class My_community_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    $this->load->model(mapping('my_community').'/model_community');

	}

//인덱스
  public function index() {

    $this->my_community_list();
  }

//메인 화면
  public function my_community_list(){
		$this->_view2(mapping('my_community').'/view_my_community_list');
  }

  public function my_community_list_get(){
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $board_type = $this->_input_check("board_type",array());
    $member_idx = $this->member_idx;
    $page_size = PAGESIZE;
  
    $data['board_type'] = $board_type;
    $data['member_idx'] = $member_idx;
    $data['page_no'] = ($page_num-1)*$page_size;
    $data['page_size'] = $page_size;

    $result = $this->model_community->community_list($data);
    $result_list_count = $this->model_community->community_list_count($data);
  
    $response = new stdClass();

    $response->member_idx = $member_idx;
    $response->board_type = $board_type;
    $response->result_list = $result['community_list'];
    $response->result_list_count = $result_list_count;
    $response->total_block = ceil($result_list_count/$page_size);
    $response->loading_ok = (ceil($result_list_count/$page_size)>$page_num)?"Y":"N";

		$this->_list_view(mapping('my_community').'/view_my_community_list_get',$response);
  }

}// 클래스의 끝
