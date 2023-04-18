<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-02-11
| Memo : 회원 정보
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

class Member_info_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

    $this->load->model('member_info_v_1_0_0/model_member_info');
	}

//회원 정보 상세 보기
  public function member_info_detail(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));

		$data['member_idx']=$member_idx;

		$result=$this->model_member_info->member_info_detail($data);//회원 정보 상세 보기

		$response = new stdClass;

		if(count($result)==0){
			$response = new stdClass;
			$response->code = "-2"; //조회된 값이 없음
			$response->code_msg = $this->global_msg->code_msg('-2');

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');

			$response->member_idx = $result->member_idx;
			$response->member_join_type = $result->member_join_type;
			$response->member_id = $result->member_id;
			$response->member_nickname = $result->member_nickname;
			$response->member_name = $result->member_name;
			$response->member_phone = $result->member_phone;
			$response->member_img = $result->member_img;
			$response->all_alarm_yn = $result->all_alarm_yn;
			$response->member_birth = $result->member_birth;
			$response->member_gender = $result->member_gender;

			echo json_encode($response);
			exit;
		}
  }

//회원 정보 수정
  public function member_info_mod_up(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$member_img = $this->_input_check("member_img",array());
		$member_name = $this->_input_check("member_name",array());
		$member_nickname = $this->_input_check("member_nickname",array("empty_msg"=>"닉네임은 입력해주세요.","regular_msg" => "닉네임는 한글,영어 조합으로 2자~10자내로 입력해주세요.","type" => "custom","custom" => "/^[a-zA-Z가-힣]{2,10}$/"));
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"핸드폰번호를 입력해주세요."));
    $member_birth = $this->_input_check("member_birth",array("empty_msg"=>"출생년도를 입력해주세요."));
    $member_gender = $this->_input_check("member_gender",array("empty_msg"=>"성별을 입력해주세요."));

		$data['member_idx']=$member_idx;
		$data['member_img']=$member_img;
		$data['member_name'] = $member_name;
		$data['member_nickname'] = $member_nickname;
		$data['member_phone'] = $member_phone;
		$data['member_birth'] = $member_birth;
		$data['member_gender'] = $member_gender;

		$result=$this->model_member_info->member_info_mod_up($data); //회원 정보 수정

		if($result =='0'){
			$response = new stdClass;
			$response->code = "-1"; //변경에 실패 하였습니다.
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}else if( $result =='1'){
			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;
		}
  }
	
	//프로필 이미지 수정
	public function profile_mod_up(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"키가 누락되었습니다."));
		$member_img = $this->_input_check("member_img",array("empty_msg"=>"프로필 이미지가 누락되었습니다."));

		$data['member_idx'] = $member_idx;
		$data['member_img'] = $member_img;

		$result=$this->model_member_info->profile_mod_up($data); //프로필 이미지 수정

		if($result =='0'){
			$response = new stdClass;
			$response->code = "-1"; //변경에 실패 하였습니다.
			$response->code_msg = $this->global_msg->code_msg('-1');

			echo json_encode($response);
			exit;
		}else if( $result =='1'){
			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = $this->global_msg->code_msg('1000');

			echo json_encode($response);
			exit;
		}
	}
}
