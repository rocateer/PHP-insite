<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : QA
|------------------------------------------------------------------------

input_check 가이드
_________________________________________________________________________________
|  !!. 변수설명
| $key       : 파라미터로 받을 변수명
| $empty_msg : 유효성검사 실패 시 전송할 메세지,
|              ("empty_msg" => "유효성검사 메세지") 로 구분하며 list 타입임.
| $focus_id  : 유효성검사 실패 시 foucus 이동 ID,
|              ("focus_id" => "foucus 대상 ID")
| $ternary  : 삼항 연산자 받을 변수명
|              ("ternary" => "1")
| $esc       : 개행문자 제거 요청시 true, 아닐시 false
|              false를 요청하는 경우-> (ex. 장문의 글 작성 시 false)
|           	 값이 array 형태일 경우 false로 적용
| $regular_msg : 정규표현식 검사 실패 시 전송할 메세지,
|              ("regular_msg" => "정규표현식 메세지","type" => "number")
| $type    	: 유효성검사할 타입
|           	 number   : 숫자검사
|            	email    : 이메일 양식 검사
|            	password : 비밀번호 양식 검사
|            	tel1     : 전화번호 양식 검사 (- 미포함)
|            	tel2     : 전화번호 양식 검사 (- 포함)
|            	custom   : 커스텀 양식, $custom의 양식으로 검사함
|            	default  : default, 검사를 안합니다.
| $custom 	: 유효성검사 custom으로 진행 시 받을 값 (정규표현식)
|
|  !!!. 값이 array형태로 들어올 경우
| $this->input_chkecu("파라미터로 받을 변수명[]");
| 형태로 받는다.
|_________________________________________________________________________________
*/

class qa_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('qa_v_1_0_0/model_qa');
  }

	//QA 리스트
	public function qa_list(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size=PAGESIZE;

		$data['member_idx']=$member_idx;
		$data['page_size']=$page_size;
		$data['page_no']=($page_num-1)*$page_size;

		$result_list=$this->model_qa->qa_list($data);// QA 리스트
		$result_list_count=$this->model_qa->qa_list_count($data);// QA 리스트 카운트

		$total_page=ceil($result_list_count/$page_size);
		$x=0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['qa_idx']	= $row->qa_idx;
			$data_array[$x]['qa_title']	= $row->qa_title;
			$data_array[$x]['reply_yn']	= $row->reply_yn;
			$data_array[$x]['ins_date']	= $this->global_function->date_Ymd_hyphen($row->ins_date);
		$x++;
		}

		if($x==0){
			$response = new stdClass;
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;

			echo json_encode($response);
			exit;
		}
	}

	//QA 상세
	public function qa_detail(){
		header('Content-Type: application/json');

		$qa_idx = $this->_input_check("qa_idx",array());

		$data['qa_idx']=$qa_idx;

		$result=$this->model_qa->qa_detail($data);// QA 상세

		if(count($result)==0){
			$response = new stdClass;
			$response->code = "-2";
			$response->code_msg = $this->global_msg->code_msg('-2');

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->qa_idx =	$result->qa_idx;
			$response->qa_title =	$result->qa_title;
			$response->qa_contents =	$result->qa_contents;
			$response->reply_yn =	$result->reply_yn;
			$response->reply_contents =	$result->reply_contents;

			if (!empty($result->reply_date)) {
				$response->reply_date =	$this->global_function->date_Ymd_hyphen($result->reply_date);
			}else {
				$response->reply_date =	"";
			}
			$response->ins_date =	$this->global_function->date_Ymd_hyphen($result->ins_date);

			echo json_encode($response);
			exit;
		}
	}

  //문의등록
	public function qa_reg_in(){
		header('Content-Type: application/json');
    $member_idx = $this->_input_check("member_idx",array());
    $qa_title = $this->_input_check("qa_title",array());
    $qa_contents = $this->_input_check("qa_contents",array());

		$data['member_idx'] = $member_idx;
		$data['qa_title'] = $qa_title;
		$data['qa_contents'] = $qa_contents;

		$result = $this->model_qa->qa_reg_in($data);//문의등록

		if($result != "0"){
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}
	}

  //문의삭제
	public function qa_del(){
		header('Content-Type: application/json');

		$qa_idx = $this->_input_check("qa_idx",array());

		$data['qa_idx'] = $qa_idx;

		$result = $this->model_qa->qa_del($data);//문의등록

		if($result != "0"){
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;

		}else{
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}
	}
}
