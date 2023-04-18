<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-04-23
| Memo : sns 추가 정보 기입 후 가입
|------------------------------------------------------------------------
*/

class Sns_add_info_join extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('sns_add_info_join/model_sns_add_info_join');
	}

//SNS 가입 상세보기
  public function sns_reg_view(){
		$member_join_type = $this->_input_check("member_join_type",array());
		$member_id = $this->_input_check("sns_member_id",array());

		$response = new stdClass();

		$response->member_join_type = $member_join_type;
		$response->member_id = $member_id;

    $this->_view('sns_add_info_join/view_sns_reg_view',$response);
  }

//SNS 가입
  public function sns_reg_in(){

		$member_join_type = $this->_input_check("member_join_type",array("empty_msg"=>"회원구분자가 없습니다."));
		$member_id = $this->_input_check("member_id",array("empty_msg"=>"회원아이디를 입력해주세요."));
		$member_name = $this->_input_check("member_name",array("empty_msg"=>"이름을 입력해주세요.","focus_id"=>"member_name"));
		$member_phone = $this->_input_check("member_phone",array("empty_msg"=>"휴대폰 번호을 입력해주세요.","focus_id"=>"member_phone"));


		$data['member_email'] = $member_id;
		$data['member_name'] = $member_name;
		$data['member_phone'] = $member_phone;
		$data['member_join_type'] = $member_join_type;

		$member_id_check = $this->model_sns_add_info_join->join_check($data);

		$response = new stdClass();

		if((int)$member_id_check > 0){
			$response->code = "-1";
			$response->code_msg = "이미 사용중인 아이디입니다.";

			echo json_encode($response);
			exit;
		}

		# model. 회원 가입
		$result = $this->model_sns_add_info_join->sns_join($data);

		if($result == "0"){
			$response->code = "0";
			$response->code_msg = "정보를 불러오지 못했습니다. 잠시 후 다시 시도해주세요.";

		}else{
			$response->code = "1000";
			$response->code_msg = "회원가입이 완료되었습니다.";

			$result = $this->model_sns_add_info_join->sns_login_action($data);

			$member_data = array(
				"member_idx" => $result->member_idx,
				"member_id" => $result->member_id,
				"member_name" => $result->member_name,
				"member_join_type" => $member_join_type
			);

			$this->session->set_userdata($member_data);

		}

		echo json_encode($response);
		exit;
  }

	/*
	 --------------------------------------------------------
	| 2. SNS 로그인 : Facebook
	|________________________________________________________
	*/

	// 2. SNS 로그인 : Facebook
	public function Facebook_login_action() {

		$member_email = $this->_input_check("member_email",array());
		$member_name = $this->_input_check("member_name",array());
		$member_join_type = $this->_input_check("member_join_type",array());

	  $characters  = "0123456789";
	  $rendom_str = "";
	  $loopNum = 10;

	  while ($loopNum--) {
	    $tmp = mt_rand(0, strlen($characters));
	    $rendom_str .= substr($characters,$tmp,1);
	  }

	  $data['nickname_code'] = $rendom_str;

	  $response = new StdClass();

	  if($member_email == ""){

	    $response->code = "-1";
	    $response->code_msg = "존재하지 않는 페이스북 계정입니다.";

	    echo json_encode($response);
	    exit;

	  }

	  $data['member_email']     = $member_email;
	  $data['member_name']      = $member_name;
	  $data['member_join_type'] = $member_join_type;

	  $result = $this->model_sns_add_info_join->join_check($data);

	  if($result > 0) {

	    $login_result = $this->model_sns_add_info_join->facebook_login_action($data);

			if(!empty($login_result)){
				$member_data = array(
					"member_idx"    	  => $login_result->member_idx,
					"member_email"		  => $login_result->member_id,
					"member_name" 		  => $login_result->member_name,
					"member_nickname"   => $login_result->member_nickname,
					"member_img" 			  => $login_result->member_img,
					"member_join_type"  => $login_result->member_join_type
				);

				$this->session->set_userdata($member_data);

				$response->code = "1000";
				$response->code_msg = "성공";

				echo json_encode($response);
				exit;

			}else{

				$response->code = "-1";
				$response->code_msg = "로그인에 실패하였습니다.";

				echo json_encode($response);
				exit;
			}

		}else{

			$response->code = "-2";
			$response->code_msg = "추가정보가 필요합니다.";

			echo json_encode($response);
			exit;
		}
	}

	/*
	 --------------------------------------------------------
	| 3. SNS 로그인 : Kakao
	|________________________________________________________
	*/

	// 3. SNS 로그인 : Kakao
	public function kakao_login_action() {

		$member_email = $this->_input_check("member_email",array());
		$properties = $this->_input_check("properties",array());
	  $member_join_type = $this->_input_check("member_join_type",array());

		$data['member_email']     = $member_email;
		$data['member_name']      = $properties['nickname'];
		$data['member_join_type'] = $member_join_type;

		$characters  = "0123456789";
		$rendom_str = "";
		$loopNum = 10;

		while ($loopNum--) {
			$tmp = mt_rand(0, strlen($characters));
			$rendom_str .= substr($characters,$tmp,1);
		}

		$data['nickname_code'] = $rendom_str;

		$result = $this->model_sns_add_info_join->join_check($data);

		$response = new StdClass();

		if($result > 0) {

			$login_result = $this->model_sns_add_info_join->kakao_login_action($data);

			if(!empty($login_result)){
				$member_data = array(
					"member_idx"    	  => $login_result->member_idx,
					"member_email"		  => $login_result->member_id,
					"member_name" 		  => $login_result->member_name,
					"member_nickname"   => $login_result->member_nickname,
					"member_img" 			  => $login_result->member_img,
					"member_join_type"  => $login_result->member_join_type
				);

				$this->session->set_userdata($member_data);

				$response->code = "1000";
				$response->code_msg = "성공";

				echo json_encode($response);
				exit;

			}else{

				$response->code = "-1";
				$response->code_msg = "로그인에 실패하였습니다.";

				echo json_encode($response);
				exit;
			}

		}else{

			$response->code = "-2";
			$response->code_msg = "추가정보가 필요합니다.";

			echo json_encode($response);
			exit;
		}
	}

	/*
	 --------------------------------------------------------
	| 4. SNS 로그인 : naver
	|________________________________________________________
	*/

	// 4. SNS 로그인 : naver
	public function naver_login_action() {

		$member_email = $this->_input_check("member_email",array());
		$member_name = $this->_input_check("member_name",array());
		$member_join_type = $this->_input_check("member_join_type",array());

	  $data['member_email']     = $member_email;
	  $data['member_name']      = $member_name;
	  $data['member_join_type'] = $member_join_type;

	  $characters  = "0123456789";
	  $rendom_str = "";
	  $loopNum = 10;

	  while ($loopNum--) {
	    $tmp = mt_rand(0, strlen($characters));
	    $rendom_str .= substr($characters,$tmp,1);
	  }

	  $data['nickname_code'] = $rendom_str;

	  $result = $this->model_sns_add_info_join->join_check($data);

	  $response = new StdClass();

	  if($result > 0) {

	    $login_result = $this->model_sns_add_info_join->naver_login_action($data);

			if(!empty($login_result)){
				$member_data = array(
					"member_idx"    	  => $login_result->member_idx,
					"member_email"		  => $login_result->member_id,
					"member_name" 		  => $login_result->member_name,
					"member_nickname"   => $login_result->member_nickname,
					"member_img" 			  => $login_result->member_img,
					"member_join_type"  => $login_result->member_join_type
				);

				$this->session->set_userdata($member_data);

				$response->code = "1000";
				$response->code_msg = "성공";

				echo json_encode($response);
				exit;

			}else{

				$response->code = "-1";
				$response->code_msg = "로그인에 실패하였습니다.";

				echo json_encode($response);
				exit;
			}

		}else{

			$response->code = "-2";
			$response->code_msg = "추가정보가 필요합니다.";

			echo json_encode($response);
			exit;
		}
	}

	  // 5. 네이버 로그인 빈 페이지
	public function login_null() {
	  $this->_list_view("sns_add_info_join/view_naver_login_null_view");
	}

}// 클래스의 끝
?>
