<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2023-04-19
| Memo : 안내관리
|------------------------------------------------------------------------

_input_check 가이드
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

class Info_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('info').'/model_info');
	}

 //인덱스
	public function index(){
		$this->info_list();
	}

//안내 리스트
	public function info_list(){
		
		$join_detail=$this->model_info->join_detail(); //안내 리스트
		$pay_detail=$this->model_info->pay_detail(); //안내 리스트

		$response = new stdClass();

		$response->join_detail = $join_detail;
		$response->pay_detail = $pay_detail;

		$this->_view(mapping('info').'/view_info_list',$response);
	}

//안내 저장
	public function info_mod_up(){

		$img = $this->_input_check("img",array());
		$info_idx = $this->_input_check("info_idx",array("empty_msg"=>"키를 입력해주세요."));

		$data['info_idx']=$info_idx;
		$data['img']=$img;

		$result=$this->model_info->info_mod_up($data);//안내 수정

		$response = new stdClass();

		if($result == "0") {
			$response->code = 0;
			$response->code_msg 	= "저장 실패하였습니다. 다시 시도 해주시기 바랍니다.";
		} else if($result == "1") {
			$response->code = 1;
			$response->code_msg 	= "저장 되었습니다.";
		}
		echo json_encode($response);
		exit;

	}
}	// 클래스의 끝
