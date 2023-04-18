<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	정수범
| Create-Date : 2017-01-15
| Memo : 로그인
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

class Login extends MY_Controller {
  function __construct(){
    parent::__construct();

    $this->load->model('login/model_login');
  }

	public function index(){
    $this->login_form();
	}

// 로그인 폼 이동
  public function login_form() {
    $cart_session_id = $this->_input_check("cart_session_id",array());
    $cart_type = $this->_input_check("cart_type",array());
    $return_url = $this->_input_check("return_url",array());

    if(empty($return_url)){
      $return_url="/";
    }

    $response = new stdClass();
    
    $response->cart_session_id = $cart_session_id;
    $response->cart_type = $cart_type;
    $response->return_url = $return_url;

    $this->_view("login/view_login_view",$response);
  }

// 로그인 시도
  public function login_action() {

  	$member_id = $this->_input_check("member_id",array());
  	$member_pw = $this->_input_check("member_pw",array());
  	$cart_session_id = $this->_input_check("cart_session_id",array());

    $data['member_id'] = $member_id;
    $data['member_pw'] = $member_pw;

    $login_result = $this->model_login->login_action($data);

    if(!empty($login_result)){

      $data['cart_session_id'] = $cart_session_id;
      $data['member_idx'] = $login_result->member_idx;
      $this->model_login->session_cart_update($data);

      $member_data = array(
        "member_idx"    	=>    $login_result->member_idx,
        "member_id"		=>    $login_result->member_id,
        "member_name" =>    $login_result->member_name,
        "member_nickname" =>    $login_result->member_nickname,
        "member_img" 			=>    $login_result->member_img,
        "member_join_type" 		=>    $login_result->member_join_type
      );

      $this->session->set_userdata($member_data);
      echo json_encode("1");
      exit;
    }else{
      echo json_encode("2");
      exit;
    }
  }

// 페이스북으로 로그인
  public function facebook_login_action() {

    $member_email = $this->_input_check("member_email",array());
    $member_name = $this->_input_check("member_name",array());
    $member_join_type = $this->_input_check("member_join_type",array());

    $data['member_email'] = $member_email;
    $data['member_name'] = $member_name;
    $data['member_join_type'] = $member_join_type;

    $result = $this->model_login->join_check($data);

    if($result>0) {
      $login_result = $this->model_login->facebook_login_action($data);

      if(!empty($login_result)){
        $member_data = array(
          "member_idx"    	=>    $login_result->member_idx,
          "member_email"		=>    $login_result->member_email,
          "member_nickname" =>    $login_result->member_nickname,
          "member_img" 			=>    $login_result->member_img,
          "member_site" 		=>    $login_result->member_site,
          "member_join_type" 		=>    $login_result->member_join_type
        );
        $this->session->set_userdata($member_data);
        echo json_encode("1");
        exit;
      }else{
        echo json_encode("2");
        exit;
      }
    }else {
      $join_result = $this->model_login->sns_join($data);
      if($join_result == '0') {
        echo json_encode("0");
        exit;
      }else {
        $login_result = $this->model_login->facebook_login_action($data);
        if(!empty($login_result)){
          $member_data = array(
            "member_idx"    	=>    $login_result->member_idx,
            "member_email"		=>    $login_result->member_email,
            "member_nickname" =>    $login_result->member_nickname,
            "member_img" 			=>    $login_result->member_img,
            "member_site" 		=>    $login_result->member_site,
            "member_join_type" 		=>    $login_result->member_join_type
          );
          $this->session->set_userdata($member_data);
          echo json_encode("1");
          exit;
        }else{
          echo json_encode("2");
          exit;
        }
      }
    }
  }

// 카카오로 로그인
  public function kakao_login_action() {

    $member_email = $this->_input_check("member_email",array());
    $properties = $this->_input_check("properties",array());
    $member_join_type = $this->_input_check("member_join_type",array());

    $data['member_email'] = $member_email;
    $data['member_name'] = $properties['nickname'];
    $data['member_join_type'] = $member_join_type;

    $result = $this->model_login->join_check($data);

    if($result>0) {
      $login_result = $this->model_login->kakao_login_action($data);
      if(!empty($login_result)){
        $member_data = array(
          "member_idx"    	=>    $login_result->member_idx,
          "member_email"		=>    $login_result->member_email,
          "member_nickname" =>    $login_result->member_nickname,
          "member_img" 			=>    $login_result->member_img,
          "member_site" 		=>    $login_result->member_site,
          "member_join_type" 		=>    $login_result->member_join_type
        );
        $this->session->set_userdata($member_data);
        echo json_encode("1");  // 로그인 성공
        exit;
      }else{
        echo json_encode("2");  // 로그인 실패
        exit;
      }
    }else {
      $join_result = $this->model_login->sns_join($data);
      if($join_result == '0') {
        echo json_encode("0");  // 가입 실패
        exit;
      }else {
        $login_result = $this->model_login->kakao_login_action($data);
        if(!empty($login_result)){
          $member_data = array(
            "member_idx"    	=>    $login_result->member_idx,
            "member_email"		=>    $login_result->member_email,
            "member_nickname" =>    $login_result->member_nickname,
            "member_img" 			=>    $login_result->member_img,
            "member_site" 		=>    $login_result->member_site,
            "member_join_type" 		=>    $login_result->member_join_type
          );
          $this->session->set_userdata($member_data);
          echo json_encode("1");
          exit;
        }else{
          echo json_encode("2");
          exit;
        }
      }
    }
  }

// 네이버로 로그인
  public function naver_login_action() {

    $member_email = $this->_input_check("member_email",array());
    $member_name = $this->_input_check("member_name",array());
    $member_join_type = $this->_input_check("member_join_type",array());

    $data['member_email'] = $member_email;
    $data['member_name'] = $member_name;
    $data['member_join_type'] = $member_join_type;

    $result = $this->model_login->join_check($data);

    if($result>0) {
      $login_result = $this->model_login->naver_login_action($data);
      if(!empty($login_result)){
        $member_data = array(
          "member_idx"    	=>    $login_result->member_idx,
          "member_email"		=>    $login_result->member_email,
          "member_nickname" =>    $login_result->member_nickname,
          "member_img" 			=>    $login_result->member_img,
          "member_site" 		=>    $login_result->member_site,
          "member_join_type" 		=>    $login_result->member_join_type
        );
        $this->session->set_userdata($member_data);
        echo json_encode("1");
        exit;
      }else{
        echo json_encode("2");
        exit;
      }
    }else {
      $join_result = $this->model_login->sns_join($data);
      if($join_result == '0') {
        echo json_encode("0");
        exit;
      }else {
        $login_result = $this->model_login->naver_login_action($data);
        if(!empty($login_result)){
          $member_data = array(
            "member_idx"    	=>    $login_result->member_idx,
            "member_email"		=>    $login_result->member_email,
            "member_nickname" =>    $login_result->member_nickname,
            "member_img" 			=>    $login_result->member_img,
            "member_site" 		=>    $login_result->member_site,
            "member_join_type" 		=>    $login_result->member_join_type
          );
          $this->session->set_userdata($member_data);
          echo json_encode("1");
          exit;
        }else{
          echo json_encode("2");
          exit;
        }
      }
    }
  }

// 빈 로그인 페이지
  public function login_null() {
    $this->_list_view("login/view_login_null_view");
  }

}// 클래스의 끝
?>
