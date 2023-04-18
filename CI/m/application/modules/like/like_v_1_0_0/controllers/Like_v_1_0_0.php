<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-03-04
| Memo : 위시리스트
|------------------------------------------------------------------------
*/

class Like_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    $this->load->model(mapping('like').'/model_like');
	}

//인덱스
  public function index() {
    $this->like_list();
  }

//위시 리스트
  public function like_list(){
		$this->_view2(mapping('like').'/view_like_list');
  }

  	// 위시 상품 리스트
	public function like_list_get(){
		$like_type = $this->_input_check("like_type",array());		
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));		
		$member_idx = $this->member_idx;
		$page_size = PAGESIZE;
		
		$data['like_type'] = $like_type;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;
		$data['member_idx'] = $member_idx;
		
		$result = $this->model_like->like_list($data);
    $result_list_count = $this->model_like->like_list_count($data);
		
		$response = new stdClass();

    $response->like_type = $like_type;
    $response->member_idx = $member_idx;
		if($like_type==0){
			$response->result_list = $result['program_list'];
		}else if($like_type==1){
			$response->result_list = $result['board0_list'];
		}else if($like_type==2){
			$response->result_list = $result['board1_list'];
		}
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);
		$response->loading_ok = (ceil($result_list_count/$page_size)>$page_num)?"Y":"N";
		
		$this->_list_view(mapping('like').'/view_like_list_get', $response);
	}

  	// 위시 상품 삭제
	public function like_del(){
		$product_like_idx = $this->_input_check("product_like_idx",array("empty_msg"=>"위시상품키 누락"));		

    $data['product_like_idx'] = $product_like_idx;
		
		$result = $this->model_like->like_del($data);
    
    $response = new stdClass;
	
    if($result == "0") {
      $response->code = "0";
      $response->code_msg = " 실패 하였습니다. 다시 한번 시도해주세요.";
    }else{
      $response->code = "1";
      $response->code_msg = "삭제 되었습니다.";
    }
    echo json_encode($response);
    exit;
	}

}// 클래스의 끝
?>
