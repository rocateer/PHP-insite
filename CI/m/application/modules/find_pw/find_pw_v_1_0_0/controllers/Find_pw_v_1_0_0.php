<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 최재명
| Create-Date : 2021-11-05
| Memo : 비밀번호 찾기
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

class Find_pw_v_1_0_0 extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model(mapping('find_pw').'/model_find_pw');
		
	}

	//인덱스
  public function index() {
    $this->find_pw_detail();
  }

	//메인 화면
  public function find_pw_detail(){
		$this->_view2(mapping('find_pw').'/view_find_pw_detail');
  }
	
	public function find_pw_member(){

    $response = new StdClass();

    $member_id = $this->_input_check("member_id",array("empty_msg"=>"아이디를 입력해주세요.","focus_id"=>"member_id"));
    $member_name = $this->_input_check("member_name",array("empty_msg"=>"이름을 입력해주세요","focus_id"=>"member_name"));
    $member_phone = $this->_input_check("member_phone",array("empty_msg"=>"전화번호를 입력해주세요","focus_id"=>"member_phone"));

		$data['member_id'] = $member_id;
    $data['member_name'] = $member_name;
    $data['member_phone'] = $member_phone;

    $member_check = $this->model_find_pw->member_check($data); // 회원 체크

    if(count($member_check) < 1) {
      $response->code = "-1";
      $response->code_msg = "일치하는 회원정보가 없습니다.";

      echo json_encode($response);
      exit;
    }
    
    # change_pw_key 생성
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $rendom_str = "";
    $loopNum = 32;
    
    while($loopNum--){
      $tmp = mt_rand(0, strlen($characters));
      $rendom_str .= substr($characters,$tmp,1);
    }
    
    $data['change_pw_key'] = $rendom_str;
    
    # model. 비밀번호 변경 인증키 발급
    $this->model_find_pw->pw_change_key_up_member($data);
    
    $data['member_email'] = $member_check->member_email;
		
    # 이메일 보내기
    $to = array();
    array_push($to, $member_check->member_email);
    
    $subject = "[".SERVICE_NAME."] 비밀번호 변경 메일입니다."; # 메일 제목
    $message = $this->load->view(mapping('find_pw').'/view_find_pw_to_email', array("data"=>$data), true);
    
    $result = $this->_web_sendmail($to, $subject, $message);
    
    if($result  === true){
			$response->code = "1000";
			$response->code_msg = "회원님의 E-mail 주소로 비밀번호 변경 메일이 발송되었습니다.";
      
		}else{
			$response->code = "0";
			$response->code_msg = "정보를 불러오지 못했습니다. 다시 한번 시도해주세요.";
		}

		echo json_encode($response);
		exit;
	}
	
	
	
}// 클래스의 끝
?>
