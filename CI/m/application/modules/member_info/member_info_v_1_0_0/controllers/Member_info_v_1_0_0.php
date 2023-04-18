<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-10-28
| Memo : 회원정보
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

		$this->load->model(mapping('member_info').'/model_member_info');
	}

	// 인덱스
  public function index() {
    $this->member_info_mod();
  }

	// 회원 정보
  public function member_info_mod(){
		$member_idx = $this->member_idx; 
		
		$data['member_idx'] = $member_idx;
		
		$result = $this->model_member_info->member_info($data); // 회원 정보

		$response = new stdClass();

		$response->result = $result;

		$this->_view2(mapping('member_info').'/view_member_info_mod', $response);
  }

	// 회원 정보 수정
	public function member_info_mod_up(){
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>"회원 키가 누락되었습니다."));
		$member_img_path = $this->_input_check("member_img_path",array());
		$member_name = $this->_input_check("member_name",array("empty_msg"=>"본인인증을 진행해주세요."));
		$member_phone = $this->_input_check("member_phone",array("empty_msg"=>"본인인증을 진행해주세요."));
		$member_birth = $this->_input_check("member_birth",array("empty_msg"=>"본인인증을 진행해주세요."));
		$member_gender = $this->_input_check("member_gender",array("empty_msg"=>"본인인증을 진행해주세요."));
		$member_nickname = $this->_input_check("member_nickname",array("empty_msg"=>"닉네임을 입력해주세요."));
		$exercise_goal = $this->_input_check("exercise_goal",array());
		$exercise_part = $this->_input_check("exercise_part",array());
		$exercise_s_time = $this->_input_check("exercise_s_time",array());
		$exercise_e_time = $this->_input_check("exercise_e_time",array());
		$exercise_goal_type = $this->_input_check("exercise_goal_type",array());
		$exercise_part_type = $this->_input_check("exercise_part_type",array());
		$waist_measurement = $this->_input_check("waist_measurement",array());

		if (preg_match("/^.*[a-zA-Z가-힣]$/i", $member_nickname) == false || !(mb_strlen($member_nickname, "UTF-8")>=2 && mb_strlen($member_nickname, "UTF-8")<9)) {
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "닉네임은 2자~8자내로 입력해주세요.";
			
			echo json_encode($response);
			exit;
		}
		
		$data['member_idx'] = $member_idx;
		$data['member_img_path'] = $member_img_path;
		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_birth'] = $member_birth;
		$data['member_gender'] = $member_gender;
		$data['member_nickname'] = $member_nickname;
		$data['exercise_goal'] = $exercise_goal;
		$data['exercise_part'] = $exercise_part;
		$data['exercise_s_time'] = $exercise_s_time;
		$data['exercise_e_time'] = $exercise_e_time;
		$data['exercise_goal_type'] = $exercise_goal_type;
		$data['exercise_part_type'] = $exercise_part_type;
		$data['waist_measurement'] = $waist_measurement;

		$member_phone_check = $this->model_member_info->member_nickname_check($data); // 회원 아이디 중복체크

		if($member_phone_check > 0){
			$response->code = "-1";
			$response->code_msg = "닉네임이 중복됩니다. 다른 닉네임으로 입력해주세요.";

			echo json_encode($response);
			exit;
		}

		$check = $this->model_member_info->member_info_check($data); // 회원 정보 수정

		$response = new stdClass();

		if($check > 0){
			$response->code = '-1';
			$response->code_msg = '전화번호가 중복되었습니다.';

			echo json_encode($response);
			exit;
		}
		
		$result = $this->model_member_info->member_info_mod_up($data); // 회원 정보 수정

		if($result == '0'){
			$response->code = '0';
			$response->code_msg = '수정 실패. 잠시 후 다시 시도 해주세요.';
		} else {
			$response->code = '1';
			$response->code_msg = '수정 되었습니다.';
		}

		echo json_encode($response);
		exit;
	}

	// 닉네임 중복 체크
	function is_dup_nickname($data){
		$result = $this->model_member_info->nickname_check($data); // 닉네임 중복 체크
		
		if(!empty($result)){
			if(!($result->member_idx == $data['member_idx'])){
				if(count($result) == '1'){
					$response = new stdClass();
					
					$response->code = '-1';
					$response->code_msg = '이미 사용중인 닉네임 입니다.';
					
					echo json_encode($response);
					exit;
				}
			}
		}

	}
	
	// 닉네임 길이 체크
	function nickname_length_check($member_nickname){
		$str_len = mb_strlen($member_nickname, 'UTF-8');

		if($str_len < 2 || $str_len > 10){
			$response = new stdClass;

			$response->code = "-1";
			$response->code_msg = '닉네임은 2~10자 이내로 입력해 주세요.';

			echo json_encode($response);
			exit;
		}
		
	}

}// 클래스의 끝
?>
