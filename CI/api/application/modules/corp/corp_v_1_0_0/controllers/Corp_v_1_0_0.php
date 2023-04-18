<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2019-06-10
| Memo : 업체 리스트 및 상세
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

class Corp_v_1_0_0 extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('corp_v_1_0_0/model_corp');

  }

	//업체 리스트
	public function corp_list(){
		header('Content-Type: application/json');

    $search_text = $this->_input_check('search_text',array());
    $lat = $this->_input_check('lat',array("ternary"=>"37.5662108"));
    $lng = $this->_input_check('lng',array("ternary"=>"126.976532"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size=PAGESIZE;

		$data['search_text']=$search_text;
    $data['lat']=$lat;
		$data['lng']=$lng;
		$data['page_size']=$page_size;
		$data['page_no']=($page_num-1)*$page_size;

		$result_list=$this->model_corp->corp_list($data);// 업체 리스트
		$result_list_count=$this->model_corp->corp_list_count($data);// 업체 리스트 카운트
		$total_page=ceil($result_list_count/$page_size);

		$x=0;
		$data_array = array();
		foreach($result_list as $row){
      $data_array[$x]['corp_idx']	= $row->corp_idx;
      $data_array[$x]['corp_name'] = $row->corp_name;
      $data_array[$x]['corp_addr'] = $row->corp_addr;
      $data_array[$x]['corp_addr_detail']	= $row->corp_addr_detail;
      $data_array[$x]['corp_img_path']	= $row->corp_img_path;
      $data_array[$x]['distance']	= $row->distance;

      $x++;
		}

    $response = new stdClass;

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;

			echo json_encode($response);
			exit;
		}else{
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

  //업체 상세 보기
	public function corp_detail(){
		header('Content-Type: application/json');

    $corp_idx = $this->_input_check('corp_idx',array());
    $lat = $this->_input_check('lat',array("ternary"=>"37.5662108"));
    $lng = $this->_input_check('lng',array("ternary"=>"126.976532"));

    $data['corp_idx']=$corp_idx;
    $data['lat']=$lat;
		$data['lng']=$lng;

    $result=$this->model_corp->corp_detail($data); //업체 상세 보기
    $resultList=$this->model_corp->corp_img_list($data); //업체 이미지 리스트

    $x=0;
		$data_array = array();
		foreach($resultList as $row){
      $data_array[$x]['corp_img_path']	= $row->corp_img_path;
      $x++;
		}

    $response = new stdClass;

		if(count($result)==0){
      $response->code = "-2"; //조회된 값이 없음
			$response->code_msg = $this->global_msg->code_msg('-2');

      echo json_encode($response);
			exit;
		}else{
      $response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

      $response->corp_idx = $result->corp_idx;
      $response->corp_lat = $result->corp_lat;
      $response->corp_lng = $result->corp_lng;
      $response->corp_name = $result->corp_name;
      $response->corp_tel = $result->corp_tel;
      $response->corp_open_time = $result->corp_open_time;
      $response->corp_close_time = $result->corp_close_time;
      $response->corp_addr = $result->corp_addr;
      $response->corp_addr_detail = $result->corp_addr_detail;
      $response->corp_contents = $result->corp_contents;
      $response->distance = $result->distance;

      $response->data_array = $data_array;

      echo json_encode($response);
			exit;
		}
	}

}
