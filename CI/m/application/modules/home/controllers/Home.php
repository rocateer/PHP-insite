<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2019-04-09
| Memo : HOME
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

class Home extends MY_Controller {
  function __construct(){
    parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('global_function');
    $this->load->model('home/model_home');

  }

  //인덱스
  public function index() {
    $this->main();
  }

  //메인 화면
  public function main(){
    $app_yn = $this->_input_check("app_yn",array());
    $member_idx = $this->_input_check("user_idx",array());

    set_cookie('app_yn', $app_yn, 3600*24*365);
    if($app_yn=="Y"){
      if($member_idx>0){
        $data['member_idx'] = $member_idx;
        $result=$this->model_home->member_detail($data);
        if(count($result)>0){
          if($result->del_yn =="N"){
            $member_data = array(
              "app_yn" => $app_yn,
              "member_idx" => $member_idx,
              "member_id" => $result->member_id,
              // "member_name" => $result->member_name,
            );
            $this->session->set_userdata($member_data);

            set_cookie('member_idx', $member_idx, 3600*24*365);
            set_cookie('member_id', $result->member_id, 3600*24*365);
            // set_cookie('member_name', $result->member_name, 3600*24*365);

          }
        }
      }else{
        $member_data = array(
          "app_yn" => $app_yn,
          "member_idx" => "",
          "member_id" =>  "",
          // "member_name" => "",
        );
        $this->session->set_userdata($member_data);

        set_cookie('member_idx', "", 3600*24*365);
        set_cookie('member_id', "", 3600*24*365);
        // set_cookie('member_name', "", 3600*24*365);

      }

    }

    redirect('/'.mapping('main'));
  }

}// 클래스의 끝
?>
