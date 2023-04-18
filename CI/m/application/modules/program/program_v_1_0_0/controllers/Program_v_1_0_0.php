<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-09-28
| Memo : 프로그램
|------------------------------------------------------------------------
*/

class Program_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();
    
    $this->load->model(mapping('program').'/model_program');

  }

//인덱스
	public function index(){
		$this->program_list();

	}

  //카테고리 둘러보긴
	public function category_list(){
    $result_list = $this->model_program->category_list();

    $response = new stdClass();

    $response->result_list = $result_list;

		$this->_view2(mapping('program').'/view_category_list', $response);
  }

// 포스트 리스트
	public function program_list(){
    $category_idx = $this->_input_check("category_idx",array());
    $category_name = $this->_input_check("category_name",array());

    $response = new stdClass();

    $response->category_idx = $category_idx;
    $response->category_name = $category_name;

		$this->_view(mapping('program').'/view_program_list',$response);
	}
  
  // 포스트 리스트
  public function program_list_get(){
    $category_idx = $this->_input_check("category_idx",array());
    $member_idx=($this->member_idx=='')?'0':$this->member_idx;

    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $page_size = PAGESIZE;

    $data['category_idx'] = $category_idx;
    $data['page_no'] = ($page_num-1)*$page_size;
    $data['page_size'] = $page_size;

    $result_list = $this->model_program->program_list($data);
    $result_list_count = $this->model_program->program_list_count($data);

    $response = new stdClass();

    $response->member_idx = $member_idx;
    $response->result_list = $result_list;
    $response->result_list_count = $result_list_count;
    $response->total_block = ceil($result_list_count/$page_size);

    $this->_list_view(mapping('program').'/view_program_list_get', $response);
  }

// 포스트 상세
	public function program_detail(){
    $program_idx = $this->_input_check("program_idx",array("empty_msg"=>"키가 누락되었습니다."));
    $type = $this->_input_check("type",array());

		$data['program_idx'] = $program_idx;
		$data['type'] = $type; //'1'일때 운동 루틴

		$result = $this->model_program->program_detail($data);

		$response = new stdClass();

		$response->type = $type;
    $response->agent = $this->_user_agent();
		$response->result = $result['program_detail'];
		$response->exercise_list = $result['exercise_list'];
    
		$this->_view2(mapping('program').'/view_program_detail',$response);
	}

// 운동 상세
	public function excercise_detail(){
    $exercise_idx = $this->_input_check("exercise_idx",array("empty_msg"=>"키가 누락되었습니다."));
    $type = $this->_input_check("type",array());

		$data['exercise_idx'] = $exercise_idx;

		$result = $this->model_program->excercise_detail($data);

		$response = new stdClass();

		$response->type = $type;
		$response->result = $result;
    
		$this->_view2(mapping('program').'/view_excercise_detail',$response);
	}

// 운동 상세
	public function excercise_detail2(){
    $exercise_idx = $this->_input_check("exercise_idx",array("empty_msg"=>"키가 누락되었습니다."));
    $type = $this->_input_check("type",array());

		$data['exercise_idx'] = $exercise_idx;

		$result = $this->model_program->excercise_detail($data);

		$response = new stdClass();

		$response->type = $type;
		$response->result = $result;
    
		$this->_list_view(mapping('program').'/view_excercise_detail',$response);
	}

// 운동 상세
	public function excercise_modal_detail(){
    $exercise_idx = $this->_input_check("exercise_idx",array("empty_msg"=>"키가 누락되었습니다."));
    $type = $this->_input_check("type",array());

		$data['exercise_idx'] = $exercise_idx;

		$result = $this->model_program->excercise_detail($data);

		$response = new stdClass();

		$response->type = $type;
		$response->result = $result;
    
		$this->_view2(mapping('program').'/view_excercise_detail',$response);
	}

  // 운동 상세
	public function routine_reg(){
    $program_idx = $this->_input_check("program_idx",array("empty_msg"=>"키가 누락되었습니다."));
    $time=time();
    $now = date('Y-m-d');
    $now_end = date('Y-m-d',strtotime("+30 day", $time));
    $member_idx=($this->member_idx=='')?'0':$this->member_idx;

    $data['program_idx'] = $program_idx;
    $data['member_idx'] = $member_idx;

    $result = $this->model_program->routine_detail($data);

		$response = new stdClass();


		$response->result = $result;
		$response->program_idx = $program_idx;
		$response->now = $now;
		$response->now_end = $now_end;
    
		$this->_view2(mapping('program').'/view_routine_reg',$response);
	}

  //추가하기
  public function routine_reg_in(){

    $type = $this->_input_check("type",array("empty_msg"=>"타입이 누락되었습니다."));
    $program_idx = $this->_input_check("program_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));
    $yoil = $this->_input_check("yoil",array("empty_msg"=>"운동하실 요일을 선택해 주세요."));
    $s_date = $this->_input_check("s_date",array("empty_msg"=>"운동 기간을 지정해 주세요."));
    $member_program_idx = $this->_input_check("member_program_idx",array());
    $e_date = $this->_input_check("e_date",array());
    $e_date_yn = $this->_input_check("e_date_yn",array());
    $member_idx=$this->member_idx;
    $now = date('Y-m-d');
    $next_d = date("Y-m-d", strtotime("+1 day", strtotime($now))); 

    $response = new stdClass();

    if($type==0){
      if(strtotime($s_date) < strtotime($now) ){
        $response->code = "-1";
        $response->code_msg = "시작날짜는 오늘 이후로 입력해주세요.";
  
        echo json_encode($response);
        exit;
      }
    }else if($type==1){
      if(strtotime($s_date) < strtotime($next_d) ){
        $response->code = "-1";
        $response->code_msg = "시작날짜는 내일날짜 이후로 입력해주세요.";
  
        echo json_encode($response);
        exit;
      }
    }


    if($e_date_yn!='N'){
      if(strtotime($e_date) <= strtotime($s_date) ){
        $response->code = "-1";
        $response->code_msg = "마지막날짜는 시작날짜 이후로 입력해주세요.";
        
        echo json_encode($response);
        exit;
      }
    }

    $data['member_program_idx'] = $member_program_idx;
    $data['program_idx'] = $program_idx;
    $data['yoil'] = $yoil;
    $data['s_date'] = $s_date;
    $data['e_date'] = $e_date;
    $data['e_date_yn'] = ($e_date_yn=='N')?'N':'Y';
    $data['member_idx'] = $member_idx;

    $result = $this->model_program->routine_reg_in($data); // 1:1 질문 등록하기

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "스케줄이 등록 되었습니다.";
    }
    echo json_encode($response);
    exit;
  }

  //스크랩 담기
  public function scrap_mod_up(){

    $program_idx = $this->_input_check("program_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));
    $member_idx=$this->member_idx;
  
    $data['program_idx'] = $program_idx;
    $data['member_idx'] = $member_idx;

    $result = $this->model_program->scrap_mod_up($data); // 1:1 질문 등록하기

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
  
  //운동완료
  public function timer_mod_up(){

    $member_program_idx = $this->_input_check("member_program_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));
    $program_idx = $this->_input_check("program_idx",array("empty_msg"=>"프로그램을 키를 입력해 주세요."));
    $record_time = $this->_input_check("record_time",array("empty_msg"=>"운동시간을 입력해 주세요."));
  
    $data['member_program_idx'] = $member_program_idx;
    $data['program_idx'] = $program_idx;
    $data['record_time'] = '00:'.$record_time;

    $result = $this->model_program->timer_mod_up($data); // 1:1 질문 등록하기

    $response = new stdClass();

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "운동 완료!";
    }
    echo json_encode($response);
    exit;
  }

} // 클래스의 끝
?>
