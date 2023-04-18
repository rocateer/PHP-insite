<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2020-10-19
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

class Login extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('login/model_login');

	}

	public function index(){

		if($this->session->userdata('admin_idx')){
			$this->load->helper('url');
			redirect('/'.mapping('member'));
			exit;
		}
		$this->load->view('login/view_login');
	}

  //로그인
	public function login_action(){
		$admin_id	= $this->_input_check('admin_id',array());
		$admin_pw	= $this->_input_check('admin_pw',array());

		$data['admin_id']=$admin_id;
		$data['admin_pw']=$admin_pw;

		$login_check=$this->model_login->login_check($data);

		if(count($login_check)>0){//로그인성공

			$admin_data = array(
					'admin_idx'			=>$login_check->admin_idx,
					'admin_id'			=>$login_check->admin_id,
					'admin_name'    =>$login_check->admin_name,
					'admin_right'   =>$login_check->admin_right
			);

			$this->session->set_userdata($admin_data);

			echo json_encode(1);
			exit;

		}else{//로그인실패
			echo json_encode(0);
			exit;
		}

	}

}
