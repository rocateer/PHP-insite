<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2023-04-27
| Memo : 회원가입
|------------------------------------------------------------------------
*/

class Join_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('join').'/model_join');
		$this->load->model('common/model_common');
	}

	//인덱스
  public function index() {
    $this->join_reg();
  }

	//메인 화면
  public function join_reg(){

		$this->_view(mapping('join').'/view_join_reg');
  }

	//메인 화면
  public function join_reg2(){
		$terms_list = $this->model_common->terms_list();
		$city_list=$this->model_common->city_list();

		$response = new stdClass();

		$response->city_list = $city_list;
		$response->terms_list = $terms_list;
		$response->agent = $this->_user_agent();

		$this->_view(mapping('join').'/view_join_reg2', $response);
  }

	//메인 화면
  public function join_reg3(){
		$work_list = $this->model_common->work_list();
		$info_detail = $this->model_common->info_detail();

		$response = new stdClass();

		$response->info_detail = $info_detail;
		$response->work_list = $work_list;

		$this->_view(mapping('join').'/view_join_reg3', $response);
  }

	//메일 확인
	public function join_reg_in(){
		$member_email = $this->_input_check("member_email",array("regular_msg" => "이메일 형식으로 입력해주세요.", "focus_id"=>"member_email", "type" => "email"));
		$member_pw = $this->_input_check("member_pw",array("empty_msg"=>"비밀번호를 입력해주세요.","regular_msg" => "비밀번호는 영문, 숫자, 특수문자 조합 8~15자리로 입력해 주세요.","type" => "custom","custom" => "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,15}$/","focus_id"=>"member_pw"));
		
		$data['member_email'] = $member_email;
		$data['member_pw'] = $member_pw;
		
		$member_email_check = $this->model_join->member_email_check($data); // 회원 아이디 중복체크
		$response = new stdClass();
		
		if($member_email_check > 0){
			$response->code = "0";
			$response->code_msg = "이메일이 중복됩니다. 다른 이메일으로 입력해주세요.";
		}else{
			$response->code = "1";
			$response->code_msg = "회원가입이 완료되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	//닉네임 중복
	public function join_reg_in2(){
		$member_name = $this->_input_check("member_name",array("empty_msg"=>"이름을 입력해주세요."));
		$member_nickname = $this->_input_check("member_nickname",array("empty_msg"=>"닉네임을 입력해주세요."));
		$region_code = $this->_input_check("region_code",array("empty_msg"=>"지역을 선택해주세요."));

		if (preg_match("/^.*[a-zA-Z가-힣]$/i", $member_nickname) == false || !(mb_strlen($member_nickname, "UTF-8")>=2 && mb_strlen($member_nickname, "UTF-8")<9)) {
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "닉네임은 2자~8자내로 입력해주세요.";
			
			echo json_encode($response);
			exit;
		}
		
		$data['member_nickname'] = $member_nickname;
		$data['region_code'] = $region_code;
		$data['member_name'] = $member_name;
		
		$member_nickname_check = $this->model_join->member_nickname_check($data); // 회원 아이디 중복체크
		$response = new stdClass();
		
		if($member_nickname_check > 0){
			$response->code = "0";
			$response->code_msg = "닉네임이 중복됩니다. 다른 닉네임으로 입력해주세요.";
		}else{
			$response->code = "1";
			$response->code_msg = "회원가입이 완료되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	//메인 화면
	public function join_reg_in3(){
		$member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","regular_msg" => "아이디는 이메일로 입력해주세요.", "focus_id"=>"member_id", "type" => "email"));
		$member_pw = $this->_input_check("member_pw",array("empty_msg"=>"비밀번호를 입력해주세요.","regular_msg" => "비밀번호는 영문, 숫자, 특수문자 조합 8~15자리로 입력해 주세요.","type" => "custom","custom" => "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,15}$/","focus_id"=>"member_pw"));
		$member_pw_confirm = $this->_input_check("member_pw_confirm",array("empty_msg"=>"비밀번호 확인을 입력해주세요."));
		$member_nickname = $this->_input_check("member_nickname",array("empty_msg"=>"닉네임을 입력해주세요."));
		$member_name = $this->_input_check("member_name",array("empty_msg"=>"본인인증을 진행해주세요."));
		$member_phone = $this->_input_check("member_phone",array("empty_msg"=>"본인인증을 진행해주세요."));
		$member_gender = $this->_input_check("member_gender",array("empty_msg"=>"본인인증을 진행해주세요."));
		$member_birth = $this->_input_check("member_birth",array("empty_msg"=>"본인인증을 진행해주세요."));
		$email_recieved_agree_yn = $this->_input_check("email_recieved_agree_yn",array());

		if (preg_match("/^.*[a-zA-Z가-힣]$/i", $member_nickname) == false || !(mb_strlen($member_nickname, "UTF-8")>=2 && mb_strlen($member_nickname, "UTF-8")<9)) {
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "닉네임은 2자~8자내로 입력해주세요.";
			
			echo json_encode($response);
			exit;
		}

		$response = new stdClass();

		# 비밀번호와 비밀번호확인
		if($member_pw_confirm != $member_pw){
			$response->code = "-1";
			$response->code_msg = "비밀번호와 비밀번호 확인이 일치하지 않습니다. 다시 확인해 주세요.";

			echo json_encode($response);
			exit;
		}
		
		$data['member_id'] = $member_id;
		$data['member_email'] = $member_id;
		$data['member_pw'] = $member_pw;
		$data['member_nickname'] = $member_nickname;
		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_gender'] = $member_gender;
		$data['member_birth'] = $member_birth;
		$data['email_recieved_agree_yn'] = ($email_recieved_agree_yn=='P')?'Y':'N';

		$member_nickname_check = $this->model_join->member_nickname_check($data); // 회원 아이디 중복체크

		if($member_nickname_check > 0){
			$response->code = "-1";
			$response->code_msg = "닉네임이 중복됩니다. 다른 닉네임으로 입력해주세요.";

			echo json_encode($response);
			exit;
		}
		
		$member_id_check = $this->model_join->member_id_check($data); // 회원 아이디 중복체크

		if($member_id_check > 0){
			$response->code = "-1";
			$response->code_msg = "이미 가입된 아이디 입니다. 확인 후 다시 진행 해 주세요.";

			echo json_encode($response);
			exit;
		}

		$member_phone_check = $this->model_join->member_phone_check($data); // 회원 아이디 중복체크

		if($member_phone_check > 0){
			$response->code = "-1";
			$response->code_msg = "이미 가입된 전화번호 입니다. 확인 후 다시 진행 해 주세요.";

			echo json_encode($response);
			exit;
		}


		# model. 회원 가입
		$result = $this->model_join->member_reg_in($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "회원가입이 완료되었습니다.";
		}

		echo json_encode($response);
		exit;
	}

	// 약관 상세
	public function terms_detail(){

    $type = $this->_input_check("type",array());

		$data['type'] = $type;

		$result=$this->model_join->terms_detail($data);//약관 상세 보기

		$response = new stdClass();

    if(empty($result)){
			$response->code = "0";
			$response->code_msg = "정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "성공";
			$response->title = $result->title;
			$response->contents = $result->contents;
		}

		echo json_encode($response);
		exit;
  }

	// join
	public function add_info_reg(){
		$member_id = $this->_input_check("member_id",array());
		$member_join_type = $this->_input_check("member_join_type",array());
		$gcm_key = $this->_input_check("gcm_key",array());
		$device_os = $this->_input_check("device_os",array());

		$result_list=$this->model_join->terms_list();//약관 상세 보기

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->member_id = $member_id;
		$response->member_join_type = $member_join_type;
		$response->gcm_key = $gcm_key;
		$response->device_os = $device_os;

		$this->_view2(mapping('join').'/view_add_info_reg',$response);
	}


}// 클래스의 끝
?>
