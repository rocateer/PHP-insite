<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-02
| Memo : 1:1 문의
|------------------------------------------------------------------------
*/

class Qa_v_1_0_0 extends MY_Controller {
  function __construct(){
    parent::__construct();

    // if(!$this->session->userdata("member_idx") ){
		// 	redirect("/".mapping('login')."?return_url=/".mapping('qa'));
		// 	exit;
		// }
    
	  $this->load->model(mapping('qa').'/model_qa');
  }

  // 인덱스
	public function index(){

		$this->qa_list();

	}

  // 1:1 질문 리스트
	public function qa_list(){

		$this->_view2(mapping('qa').'/view_qa_list');
	}

  // 1:1 질문 리스트 가져오기
	public function qa_list_get(){

    // $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"member_idx 코드 누락"));
    $member_idx = $this->member_idx;
    $page_num = $this->_input_check("page_num",array());
    $page_size = PAGESIZE;

    $data['member_idx'] = $member_idx;
		$data['page_no'] = ($page_num-1)*$page_size;
		$data['page_size'] = $page_size;

		$result_list = $this->model_qa->qa_list($data); // 1:1 질문 리스트 가져오기
		$result_list_count = $this->model_qa->qa_list_count($data); // 1:1 질문 개수 가져오기

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->total_block = ceil($result_list_count/$page_size);

		$this->_list_view(mapping('qa').'/view_qa_list_get', $response);
	}

  // 1:1 질문 상세보기
	public function qa_detail(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>"QA 코드 누락"));

    $data['qa_idx'] = $qa_idx;

    $result = $this->model_qa->qa_detail($data);

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('qa').'/view_qa_detail', $response);
	}

	// 1:1 질문 등록
	public function qa_reg(){
		$response = new stdClass();
		$response->agent = $this->_user_agent();

		$this->_view2(mapping('qa').'/view_qa_reg', $response);
	}

	// 1:1 질문 등록하기
  public function qa_reg_in(){
    // $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"member_idx 코드 누락"));
    $member_idx = $this->member_idx;
		$qa_type = $this->_input_check("qa_type",array("empty_msg"=>"필수 입력 정보가 입력 되지 않았습니다. 다시 한번 확인 해 주세요.","focus_id"=>"qa_type"));
		$qa_title = $this->_input_check("qa_title",array("empty_msg"=>"필수 입력 정보가 입력 되지 않았습니다. 다시 한번 확인 해 주세요.","focus_id"=>"qa_title"));
		$qa_contents = $this->_input_check("qa_contents",array("empty_msg"=>"필수 입력 정보가 입력 되지 않았습니다. 다시 한번 확인 해 주세요.","focus_id"=>"qa_contents"));
		$device_os = $this->_input_check("device_os",array());
		$app_version = $this->_input_check("app_version",array());
		$os_version = $this->_input_check("os_version",array());
		

    $data['member_idx'] = $member_idx;
    $data['qa_type'] = $qa_type;
    $data['qa_title'] = $qa_title;
		$data['qa_contents'] = $qa_contents;
		$data['device_os'] = $device_os;
		$data['app_version'] = $app_version;
		$data['os_version'] = $os_version;

		$result = $this->model_qa->qa_reg_in($data); // 1:1 질문 등록하기

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg 	= "문의등록 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code ="1000";
			$response->code_msg 	= "관리자가 문의 하신 내용 확인 후 답변 드리도록 하겠습니다.";
		}
		echo json_encode($response);
		exit;
	}

  // 삭제
  public function qa_del(){
		$qa_idx = $this->_input_check("qa_idx",array("empty_msg"=>"QA 코드 누락"));

		$data['qa_idx'] = $qa_idx;

		$result = $this->model_qa->qa_del($data);

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "삭제 실패!";
		} else {
			$response->code = 1;
			$response->code_msg 	= "게시글이 삭제 되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

} // 클래스의 끝
?>
