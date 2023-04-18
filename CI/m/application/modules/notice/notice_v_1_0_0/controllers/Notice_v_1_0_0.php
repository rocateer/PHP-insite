<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-02
| Memo : 공지사항
|------------------------------------------------------------------------
*/

class Notice_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('notice').'/model_notice');
	}

	//인덱스
  public function index() {
    $this->notice_list();
  }

	//리스트
	public function notice_list(){
		$this->_view2(mapping('notice').'/view_notice_list');
	}

	// notice_list_get
	public function notice_list_get(){

		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_notice->notice_list($data);
		$result_list_count = $this->model_notice->notice_list_count($data);

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_list_view(mapping('notice').'/view_notice_list_get', $response);
	}
	//상세
	public function notice_detail(){
		$notice_idx = $this->_input_check("notice_idx",array("empty_msg"=>"공지사항 키가 누락되었습니다."));

		$data['notice_idx'] = $notice_idx;

		$result = $this->model_notice->notice_detail($data);

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('notice').'/view_notice_detail',$response);
	}

}// 클래스의 끝
?>
