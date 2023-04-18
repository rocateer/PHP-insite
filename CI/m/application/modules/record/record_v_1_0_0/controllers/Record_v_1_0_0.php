<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-09-28
| Memo : 프로그램
|------------------------------------------------------------------------
*/

class Record_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();
    
    $this->load->model(mapping('record').'/model_record');

  }

//인덱스
	public function index(){
		$this->record_list();

	}

// 포스트 리스트
	public function record_list(){
    $result = $this->model_record->record_detail();
    $date = date('Y.m');

    $response = new stdClass();

    $response->result = $result;
    $response->date = $date;

		$this->_view2(mapping('record').'/view_record_list', $response);
	}
  
  // 포스트 리스트
  public function record_list_get(){
    $member_idx=($this->member_idx=='')?'0':$this->member_idx;
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $page_size = PAGESIZE;

    $data['page_no'] = ($page_num-1)*$page_size;
    $data['page_size'] = $page_size;

    $result_list = $this->model_record->record_list($data);
    $result_list_count = $this->model_record->record_list_count($data);

    $response = new stdClass();

    $response->member_idx = $member_idx;
    $response->result_list = $result_list;
    $response->result_list_count = $result_list_count;
    $response->total_block = ceil($result_list_count/$page_size);

    $this->_list_view(mapping('record').'/view_record_list_get', $response);
  }

// 포스트 상세
	public function record_detail(){
    $record_idx = $this->_input_check("record_idx",array("empty_msg"=>"키가 누락되었습니다."));
    $type = $this->_input_check("type",array());

		$data['record_idx'] = $record_idx;
		$data['type'] = $type; //'1'일때 운동 루틴

		$result = $this->model_record->record_detail($data);

		$response = new stdClass();

		$response->type = $type;
		$response->result = $result['record_detail'];
		$response->exercise_list = $result['exercise_list'];
    
		$this->_view2(mapping('record').'/view_record_detail',$response);
	}

  
// 포스트 리스트
	public function calendar_list(){
    $result = $this->model_record->record_detail();
    $change = $this->model_record->change_month();
    $date = date('Y.m');
    $today = date('Y-m-d');

    $response = new stdClass();

    $active_arr = array();
    $active2_arr = array();

    $i=0;
    foreach($change['active_date'] as $row){

      $active_arr[$i]=$row->excercise_date;

      $i++;
    }

    $j=0;
    foreach($change['active2_date'] as $row2){

      $active2_arr[$j]=$row2->excercise_date;

      $j++;
    }

    $response->active_date = $active_arr;
    $response->active2_date = $active2_arr;

    $response->result = $result;
    $response->date = $date;
    $response->today = $today;

		$this->_view2(mapping('record').'/view_calendar_list', $response);
	}
  
  // 포스트 리스트
  public function calendar_list_get(){
    $member_idx=($this->member_idx=='')?'0':$this->member_idx;
    $date = $this->_input_check("date",array());

    $data['date'] = $date;
    $data['member_idx'] = $member_idx;

    $result_list = $this->model_record->calendar_list($data);
    $result_list_count = $this->model_record->calendar_list_count($data);

    $response = new stdClass();

    $response->member_idx = $member_idx;
    $response->result_list = $result_list;
    $response->result_list_count = $result_list_count;
    $response->date = $date;

    $this->_list_view(mapping('record').'/view_calendar_list_get', $response);
  }

  // 포스트 리스트
	public function history_list(){

		$this->_view2(mapping('record').'/view_history_list');
	}
  
  // 포스트 리스트
  public function history_list_get(){
    $member_idx=($this->member_idx=='')?'0':$this->member_idx;
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $page_size = PAGESIZE;

    $data['page_no'] = ($page_num-1)*$page_size;
    $data['page_size'] = $page_size;
    $data['member_idx'] = $member_idx;

    $result = $this->model_record->history_list($data);
    $result_list_count = $this->model_record->history_list_count($data);

    $response = new stdClass();

    $response->member_idx = $member_idx;
    $response->history_date_list = $result['history_date'];
    $response->result_list = $result['history_list'];
    $response->result_list_count = $result_list_count;
    $response->total_block = ceil($result_list_count/$page_size);

    $this->_list_view(mapping('record').'/view_history_list_get', $response);
  }



} // 클래스의 끝
?>
