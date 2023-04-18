<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-03-17
| Memo : 업무 완료 체크
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
class Work_check_api extends MY_Controller
{
	/* 생성자 영역 */
	function __construct()
	{
		parent::__construct();

	}
	//워크 체크 위치 저장
	function work_state_check_memo_xy_up(){
		$work_state_check_memo_x = $this->_input_check("work_state_check_memo_x",array());
		$work_state_check_memo_y = $this->_input_check("work_state_check_memo_y",array());
		$work_memo_view_yn = $this->_input_check("work_memo_view_yn",array());
		$admin_data = array(
			'work_state_check_memo_x'	=> $work_state_check_memo_x,
			'work_state_check_memo_y'	=> $work_state_check_memo_y,
			'work_memo_view_yn'	=> $work_memo_view_yn
		);
		$this->session->set_userdata($admin_data);
	}
  //업무 완료 체크 등록
	function work_check_reg_in(){
		$url = $this->_input_check("url",array());
		$full_url = $this->_input_check("full_url",array());
		$state = $this->_input_check("state",array());
		$memo = $this->_input_check("memo",array());
		$menu_name = $this->_input_check("menu_name",array());

		$data["project_idx"] = PROJECT_IDX;
		$data["url"] = $url;
		$data["full_url"] = $full_url;
		$data["state"] = $state;
		$data["memo"] = $memo;
		$data["menu_name"] = $menu_name;
		$api_url = 'http://p.admin.rocateerdev.co.kr/work_check/work_check_reg_in';
		$userAgent=$_SERVER['HTTP_USER_AGENT'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt ($ch, CURLOPT_URL,$api_url); //접속할 URL 주소
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
		// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_SSLVERSION,0); // SSL 버젼 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
		curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
		$exec = curl_exec ($ch);
		curl_close ($ch);
		echo $exec;
		exit;
	}
  //업무 완료 유무
	function work_check_state(){
		$url = $this->_input_check("url",array());
		$data["project_idx"] = PROJECT_IDX;
		$data["url"] = $url;
		$api_url = 'http://p.admin.rocateerdev.co.kr/work_check/work_check_state';
		$userAgent=$_SERVER['HTTP_USER_AGENT'];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt ($ch, CURLOPT_URL,$api_url); //접속할 URL 주소
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
		// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_SSLVERSION,0); // SSL 버젼 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
		curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
		$exec = curl_exec ($ch);
		curl_close ($ch);
		echo $exec;
		exit;
	}
	//메모 리스트
	function work_memo_list(){
		$work_check_idx = $this->_input_check("work_check_idx",array());
		$data["work_check_idx"] = $work_check_idx;
		$api_url = 'http://p.admin.rocateerdev.co.kr/work_check/work_memo_list';
		$userAgent=$_SERVER['HTTP_USER_AGENT'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt ($ch, CURLOPT_URL,$api_url); //접속할 URL 주소
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
		// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_SSLVERSION,0); // SSL 버젼 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
		curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
		$exec = curl_exec ($ch);
		curl_close ($ch);
		echo $exec;
		exit;
	}
	// 메모 등록
	function memo_add_reg_in(){
		$new_memo = $this->_input_check("new_memo",array("empty_msg"=>"코멘트를 등록해주세요."));
		$work_check_idx = $this->_input_check("work_check_idx",array());
		$work_check_member_idx = $this->session->userdata("work_check_member_idx");
		$tag = $this->_input_check("tag",array());

		$data["new_memo"] = $new_memo;
		$data["work_check_idx"] = $work_check_idx;
		$data["work_check_member_idx"] = $work_check_member_idx;
		$data["tag"] = $tag;

		$api_url = 'http://p.admin.rocateerdev.co.kr/work_check/memo_add_reg_in';
		$userAgent=$_SERVER['HTTP_USER_AGENT'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt ($ch, CURLOPT_URL,$api_url); //접속할 URL 주소
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
		// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_SSLVERSION,0); // SSL 버젼 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
		curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
		$exec = curl_exec ($ch);
		curl_close ($ch);
		echo $exec;
		exit;
	}
	// 워크쳇 메모 삭제
	function work_check_memo_del(){

		$work_check_memo_idx = $this->_input_check("work_check_memo_idx",array());
		$data["work_check_memo_idx"] = $work_check_memo_idx;

		$api_url = 'http://p.admin.rocateerdev.co.kr/work_check/work_check_memo_del';
		$userAgent=$_SERVER['HTTP_USER_AGENT'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt ($ch, CURLOPT_URL,$api_url); //접속할 URL 주소
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
		// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_SSLVERSION,0); // SSL 버젼 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
		curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
		$exec = curl_exec ($ch);
		curl_close ($ch);
		echo $exec;
		exit;
	}

	public function login_action(){
		$work_check_member_id = $this->_input_check("work_check_member_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"work_check_member_id"));
		$work_check_member_pw = $this->_input_check("work_check_member_pw",array("empty_msg"=>"패스워드를 입력해주세요.","focus_id"=>"work_check_member_pw"));

		$data['work_check_member_id'] = $work_check_member_id;
		$data['work_check_member_pw'] = $work_check_member_pw;

		$api_url = 'http://p.admin.rocateerdev.co.kr/work_check/login_action';
		$userAgent=$_SERVER['HTTP_USER_AGENT'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt ($ch, CURLOPT_URL,$api_url); //접속할 URL 주소
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 인증서 체크같은데 true 시 안되는 경우가 많다.
		// default 값이 true 이기때문에 이부분을 조심 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_SSLVERSION,0); // SSL 버젼 (https 접속시에 필요)
		curl_setopt ($ch, CURLOPT_HEADER, 0); // 헤더 출력 여부
		curl_setopt ($ch, CURLOPT_POST, 1); // Post Get 접속 여부
		curl_setopt ($ch, CURLOPT_POSTFIELDS, http_build_query($data)); // Post 값 Get 방식처럼적는다.
		curl_setopt ($ch, CURLOPT_TIMEOUT, 30); // TimeOut 값
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); // 결과값을 받을것인지
		$exec = curl_exec ($ch);
		curl_close ($ch);

		$result = json_decode($exec);

		$response = new stdClass();

		if(!empty($result)){

			$response->code = "1000";
			$response->code_msg = "로그인되었습니다.";

			$member_data = array(
				"work_check_member_idx" => $result->work_check_member_idx,
				"work_check_member_id" => $result->work_check_member_id,
				"work_check_member_name" => $result->work_check_member_name
			);
			$this->session->set_userdata($member_data);

		}else{
			$response->code = "0";
			$response->code_msg = "비밀번호를 다시 확인해주세요.";
		}

		echo json_encode($response);
		exit;
  }
	public function login_out(){

		$member_data = array(
			"work_check_member_idx" => "",
			"work_check_member_id" =>  "",
			"work_check_member_name" =>  "",
		);
		$this->session->set_userdata($member_data);
		$url = $_SERVER['HTTP_REFERER'];
		redirect($url);
	}

}
