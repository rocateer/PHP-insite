<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-06-27
| Memo : 포스트
|------------------------------------------------------------------------
*/

class Board_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();
    
    $this->load->model(mapping('board').'/model_board');

  }

//인덱스
	public function index(){
		$this->board_list();

	}

// 포스트 리스트
	public function board_list(){
    $response = new stdClass();
    
    $response->agent = $this->_user_agent();

		$this->_view(mapping('board').'/view_board_list',$response);
	}
  
  
  // 포스트 리스트
  public function board_list_get(){
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $page_size = PAGESIZE;

    $data['page_no'] = ($page_num-1)*$page_size;
    $data['page_size'] = $page_size;

    $result_list = $this->model_board->board_list($data);
    $result_list_count = $this->model_board->board_list_count($data);

    $response = new stdClass();

    $response->result_list = $result_list;
    $response->result_list_count = $result_list_count;
    $response->total_block = ceil($result_list_count/$page_size);

    $this->_list_view(mapping('board').'/view_board_list_get', $response);
  }

// 포스트 상세
	public function board_detail(){
    $news_idx = $this->_input_check("news_idx",array("empty_msg"=>"키가 누락되었습니다."));
    $type = $this->_input_check("type",array());

		$data['news_idx'] = $news_idx;

		$result = $this->model_board->board_detail($data);

		$response = new stdClass();

		$response->result = $result;
		$response->type = ($type=='')?'0':$type;
    
		$this->_view2(mapping('board').'/view_board_detail',$response);
	}

    //프로그램 담기
    public function scrap_mod_up(){
  
      $news_idx = $this->_input_check("news_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));
      $member_idx=($this->member_idx=='')?'0':$this->member_idx;
    
      $data['news_idx'] = $news_idx;
      $data['member_idx'] = $member_idx;

      $result = $this->model_board->scrap_mod_up($data); // 1:1 질문 등록하기
  
      $response = new stdClass();
  
      if($result == "0") {
        $response->code = "0";
        $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
      } else {
        $response->code ="1";
        $response->code_msg = "정상적으로 처리되었습니다.";
      }
      echo json_encode($response);
      exit;
    }


} // 클래스의 끝
?>
