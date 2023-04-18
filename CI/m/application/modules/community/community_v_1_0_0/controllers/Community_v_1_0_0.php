<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-10-19
| Memo : 커뮤니티
|------------------------------------------------------------------------
*/

class Community_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    if(!$this->session->userdata("member_idx") ){
			redirect("/".mapping('login')."?return_url=/".mapping('community'));
			exit;
		}

		// model_community 이름으로 공통 사용
		$this->load->model(mapping('community').'/model_community');
		$this->load->model('common/model_common');

	}

//인덱스
  public function index() {

    $this->community_list();
  }

//메인 화면
  public function community_list(){
    $tab = $this->_input_check("tab",array()); //1 : 운동완료

    $best_community_list = $this->model_community->best_community_list();
    $category_list = $this->model_community->category_list();
    $new_alarm_cnt = $this->model_community->new_alarm_cnt();

    $response = new stdClass();
    
    $response->agent = $this->_user_agent();
		$response->tab = $tab;
		$response->best_community_list = $best_community_list;
		$response->category_list = $category_list;
		$response->new_alarm_cnt = $new_alarm_cnt;

		$this->_view(mapping('community').'/view_community_list',$response);
  }

  public function community_list_get(){

    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $category = $this->_input_check("category",array());
    $board_type = $this->_input_check("board_type",array());
    $member_idx = $this->member_idx;
    $page_size = PAGESIZE;
  
    $data['category'] = $category;
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
  
    $this->_list_view(mapping('community').'/view_community_list_get', $response);
  }

// 커뮤니티 상세
  public function community_detail(){
    $board_idx = $this->_input_check("board_idx",array());
  
    $data['board_idx'] = $board_idx;

    $result = $this->model_community->community_detail($data);
  
    $response = new stdClass();

    $response->agent = $this->_user_agent();
    $response->member_idx = $this->member_idx;
    $response->result = $result['community_detail'];
    $response->result_list = $result['program_record'];

		$this->_view2(mapping('community').'/view_community_detail',$response);
  }

  public function comment_list_get(){

    $board_idx = $this->_input_check("board_idx",array());
    $board_type = $this->_input_check("board_type",array());
    $page_num = $this->_input_check("page_num",array("ternary"=>'1'));
    $member_idx = $this->member_idx;
    $page_size = PAGESIZE;
  
    $data['board_idx'] = $board_idx;
    $data['member_idx'] = $this->member_idx;
    $data['page_no'] = ($page_num-1)*$page_size;
    $data['page_size'] = $page_size;

    $result_list = $this->model_community->board_comment_list($data);
    $result_list_count = $this->model_community->board_comment_list_count($data);

    $response = new stdClass();

    $response->member_idx = $member_idx;
    $response->board_type = $board_type;
    $response->result_list = $result_list;
    $response->result_list_count = $result_list_count;
    $response->total_block = ceil($result_list_count/$page_size);

    $this->_list_view(mapping('community').'/view_comment_list_get', $response);
  }

// 커뮤니티 등록
  public function community_reg1(){
    $category_list = $this->model_community->category_list();

    $response = new stdClass();

    $response->category_list = $category_list;

		$this->_view2(mapping('community').'/view_community_reg1',$response);
  }

   //커뮤니티 등록
   public function community_reg_in(){

    $board_type = $this->_input_check("board_type",array());
    if($board_type=='1'){
      $title = $this->_input_check("title",array());
      $category_idx = $this->_input_check("category_idx",array());
    }else{
      $title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해 주세요."));
      $category_idx = $this->_input_check("category_idx",array("empty_msg"=>"카테고리를 선택해 주세요."));
    }
    $contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요."));
    $img_path = $this->_input_check("imgs_path",array());
    $program_record = $this->_input_check("program_record",array());
    $member_idx=$this->member_idx;

    $data['board_type'] = $board_type;
    $data['title'] = $title;
    $data['category_idx'] = $category_idx;
    $data['contents'] = $contents;
    $data['img_path'] = $img_path;
    $data['program_record'] = $program_record;
    $data['member_idx'] = $member_idx;

    $result = $this->model_community->community_reg_in($data); 
    
    $response = new stdClass();

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "커뮤니티가 등록 되었습니다.";
    }
    echo json_encode($response);
    exit;
  }

  //커뮤니티 삭제
  public function community_del(){

    $board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티 키가 누락되었습니다."));

    $data['board_idx'] = $board_idx;

    $result = $this->model_community->community_del($data); 
    
    $response = new stdClass();

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "커뮤니티가 삭제 되었습니다.";
    }
    echo json_encode($response);
    exit;
  }
  
  // 커뮤니티 수정
  public function community_mod(){
    $board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티 키가 누락되었습니다."));

    $data['board_idx'] = $board_idx;

    $result = $this->model_community->community_mod_detail($data); 
    $category_list = $this->model_community->category_list();

    $response = new stdClass();

    $response->result = $result['community_detail'];
    $response->result_list = $result['program_record'];
    $response->category_list = $category_list;

    if($result['community_detail']->board_type=='0'){
      $this->_view2(mapping('community').'/view_community_mod1',$response);
    }else if($result['community_detail']->board_type=='1'){
      $this->_view2(mapping('community').'/view_community_mod2',$response);
    }
  }

  // 커뮤니티 수정
  public function community_mod_up(){
    $board_type = $this->_input_check("board_type",array());
    if($board_type=='1'){
      $title = $this->_input_check("title",array());
      $category_idx = $this->_input_check("category_idx",array());
    }else{
      $title = $this->_input_check("title",array("empty_msg"=>"제목을 입력해 주세요."));
      $category_idx = $this->_input_check("category_idx",array("empty_msg"=>"카테고리를 선택해 주세요."));
    }
    $board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티 키가 누락되었습니다."));
    $contents = $this->_input_check("contents",array("empty_msg"=>"내용을 입력해 주세요."));
    $program_record = $this->_input_check("program_record",array());
    $img_path = $this->_input_check("imgs_path",array());
    $member_idx=$this->member_idx;
    
    $data['board_idx'] = $board_idx;
    $data['board_type'] = $board_type;
    $data['title'] = $title;
    $data['category_idx'] = $category_idx;
    $data['contents'] = $contents;
    $data['img_path'] = $img_path;
    $data['program_record'] = $program_record;
    $data['member_idx'] = $member_idx;

    $result = $this->model_community->community_mod_up($data); 
    
    $response = new stdClass();

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "커뮤니티가 수정 되었습니다.";
    }
    echo json_encode($response);
    exit;
  }

  // 커뮤니티 신고
  public function report_reg_in(){
    $board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티 키가 누락되었습니다."));
    $board_reply_idx = $this->_input_check("board_reply_idx",array());
    $report_type = $this->_input_check("report_type",array("empty_msg"=>"신고 유형을 선택해주세요."));
    $report_contents = $this->_input_check("report_contents",array("empty_msg"=>"신고사유를 입력해주세요."));
    $member_idx=$this->member_idx;
    
    $data['type'] = ($board_reply_idx>0)?'1':'0';
    $data['board_idx'] = $board_idx;
    $data['board_reply_idx'] = $board_reply_idx;
    $data['report_type'] = $report_type;
    $data['report_contents'] = $report_contents;
    $data['member_idx'] = $member_idx;

    $result = $this->model_community->report_reg_in($data); 
    
    $response = new stdClass();

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "신고 되었습니다.";
    }
    echo json_encode($response);
    exit;
  }

   //댓글 등록
   public function cmt_reg_in(){

    $board_idx = $this->_input_check("board_idx",array());
    $cmt_contents = $this->_input_check("cmt_contents",array("empty_msg"=>"제목을 입력해 주세요."));
    $board_reply_idx = $this->_input_check("board_reply_idx",array());
    $member_idx=$this->member_idx;
    $type = ($board_reply_idx>0)?'1':'0'; //1번 답글 0번 댓글

    $data['type'] = $type;
    $data['board_idx'] = $board_idx;
    $data['cmt_contents'] = $cmt_contents;
    $data['board_reply_idx'] = $board_reply_idx;
    $data['member_idx'] = $member_idx;

    $result = $this->model_community->cmt_reg_in($data); 
    $alarm_detail = $this->model_community->cmt_detail($data); 
    $alarm_detail_list = $this->model_community->cmt_list($data); 
    
    $response = new stdClass();

    
    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    }else{
      $response->code ="1";
      $response->code_msg = "댓글이 등록 되었습니다.";
      
      if($type=='0'){
        
        $index="101";
        $alarm_data['board_idx'] = $board_idx;
        $member_idx = $alarm_detail->member_idx;
        $this->_alarm_action($member_idx,'0',$index, $alarm_data);
        
      }else if($type=='1'){

        $index="102";
        $alarm_data['board_idx'] = $board_idx;
        $member_idx = $alarm_detail->member_idx;
        $this->_alarm_action($member_idx,'0',$index, $alarm_data);
        
        if(count($alarm_detail_list)>0){
          foreach($alarm_detail_list as $row){

            $member_idx = $row->member_idx;
            $this->_alarm_action($member_idx,'0',$index, $alarm_data);

          }
        }
      }

    }
    echo json_encode($response);
    exit;
  }

   //댓글 수정
   public function cmt_mod_up(){

    $board_idx = $this->_input_check("board_idx",array());
    $cmt_contents = $this->_input_check("cmt_contents",array("empty_msg"=>"제목을 입력해 주세요."));
    $board_reply_idx = $this->_input_check("board_reply_idx",array());
    $member_idx=$this->member_idx;

    $data['board_idx'] = $board_idx;
    $data['cmt_contents'] = $cmt_contents;
    $data['board_reply_idx'] = $board_reply_idx;
    $data['member_idx'] = $member_idx;

    $result = $this->model_community->cmt_mod_up($data); 
    
    $response = new stdClass();

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "댓글이 수정 되었습니다.";
    }
    echo json_encode($response);
    exit;
  }

   //댓글 삭제
   public function cmt_del(){

    $board_idx = $this->_input_check("board_idx",array("empty_msg"=>"키를 입력해 주세요."));
    $board_reply_idx = $this->_input_check("board_reply_idx",array("empty_msg"=>"키를 입력해 주세요."));
    $member_idx=$this->member_idx;

    $data['board_idx'] = $board_idx;
    $data['board_reply_idx'] = $board_reply_idx;
    $data['member_idx'] = $member_idx;

    $result = $this->model_community->cmt_del($data); 
    
    $response = new stdClass();

    if($result == "0") {
      $response->code = "0";
      $response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
    } else {
      $response->code ="1";
      $response->code_msg = "댓글이 삭제 되었습니다.";
    }
    echo json_encode($response);
    exit;
  }
// 
  public function community_reg2(){
    $result_list = $this->model_community->complete_program_list();

    $response = new stdClass();

    $response->result_list = $result_list;

		$this->_view2(mapping('community').'/view_community_reg2',$response);
  }
  
	//좋아요
	public function like_reg_in(){
	
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티키를 입력해 주세요."));
		$member_idx=$this->member_idx;
	
		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_community->like_reg_in($data); // 1:1 질문 등록하기

		$response = new stdClass();

		if($result == "-1") {
			$response->code = "0";
			$response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code ="1";
			$response->code_msg = "적용되었습니다.";
			$response->like_cnt = $result;
		}
		echo json_encode($response);
		exit;
	}

}// 클래스의 끝
