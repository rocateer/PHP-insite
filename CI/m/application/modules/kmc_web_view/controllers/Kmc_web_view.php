<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-10-31
| Memo : Kmc 본인인증 web_view
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

class Kmc_web_view extends MY_Controller {

	function __construct(){
		parent::__construct();

	}

	public function index(){
		$this->member_auth();
	}

//본인인증폼
 public function member_auth(){
	 $member_idx = $this->_input_check("member_idx",array());
  
   $data['CurTime'] = date('YmdHis');
   $data['RandNo'] = rand(100000, 999999);

   //요청 번호 생성
   $data['reqNum'] = $data['CurTime'].$data['RandNo'];

   //결과수신url
   $data['tr_url'] = THIS_DOMAIN.'/kmc_web_view/member_auth_apply';

   //모듈호출데이터
   $data['certMet'] = 'M'; // 본인확인 방법 'M': 휴대폰 본인확인, 'P': 공인인증서
   $data['cpId'] = 'TPDT1001'; // 회원사 ID
   $data['urlCode'] = '001002'; // 서비스 호출 웹 페이지마다 등록된 코드 정보, 등록 된 URL CODE만 서비스 호출이 가능
  //  $data['urlCode'] = '002001'; // https 업데이트시 

   $this->_view('kmc_web_view/view_member_auth',array("data"=>$data));

 }

 //본인인증
 public function member_auth_apply(){
	 $response = new stdClass();
	 $response->agent = $this->_user_agent();
   $this->_view('kmc_web_view/view_member_auth_apply',$response);
 }

} // end Controller
