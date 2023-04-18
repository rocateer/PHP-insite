<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 조다솜
| Create-Date : 2018-10-11
| Memo : 장바구니
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

class Cart extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('cart/model_cart');
	}

	// 인덱스
  public function index() {
    $this->cart_list();
  }

  //카트 등록
  public function	cart_reg_in(){
    header('Content-Type: application/json');

    $cart_session_id = $this->_input_check("cart_session_id",array());
    $option_count = $this->_input_check("option_count",array());
    $product_ea = $this->_input_check("product_ea",array());
		$product_idx = $this->_input_check("product_idx",array());
		$product_price = $this->_input_check("product_price",array());
		$cart_type = $this->_input_check("cart_type",array());

		$data['member_idx'] =$this->member_idx;
		$data['cart_session_id'] =$cart_session_id;
		$data['option_count'] =$option_count;
		$data['product_ea'] =$product_ea;
		$data['product_idx'] =$product_idx;
		$data['product_price'] =$product_price;
		$data['cart_type'] =$cart_type;

    $check = $this->model_cart->cart_session_count($data); //session_id로 옵션 장박구니 수 체크

    if($option_count>0){
			if($check>0){
				$response = new stdClass;
				$response->code = "1000";
				$response->code_msg = "성공";

				echo json_encode($response);
				exit;
			}else{
				$response = new stdClass;
				$response->code = "-1";
				$response->code_msg = "옵션을 선택해 주세요";

				echo json_encode($response);
				exit;
			}
	  }

		$result = $this->model_cart->cart_reg_in($data);//장박구니 입력

		if($result == '0') {
      $response = new stdClass;
      $response->code = "-1"; //저장에 실패 하였습니다.
      $response->code_msg = "저장에 실패 하였습니다.";

      echo json_encode($response);
      exit;
    } else{
      $response = new stdClass;
      $response->code = "1000"; //성공
      $response->code_msg = "성공";

      echo json_encode($response);
      exit;
    }

  } // end 배송완료 상태변경


	// 장바구니 리스트
  public function cart_list(){
    $this->_view('cart/view_cart_list');
  }


	// 장바구니 리스트 가져오기
  public function cart_list_get(){
		$data['member_idx'] = $this->member_idx;

		$result_list = $this->model_cart->cart_list_get($data);// 장바구니 리스트 가져오기

		$response = new stdClass();
		$response->result_list = $result_list;

    $this->_list_view('cart/view_cart_list_get',$response);
  }

	// 장바구니 수량 수정
	public function cart_ea_up(){
		$cart_idx = $this->_input_check("cart_idx",array());
		$cart_ea = $this->_input_check("cart_ea",array());

		$data['member_idx'] = $this->member_idx;
		$data['cart_idx'] = $cart_idx;
		$data['cart_ea'] = $cart_ea;

		$result=$this->model_cart->cart_ea_up($data);// 장바구니 수량 수정

		if($result == '0') {

			$response = new stdClass;
			$response->code = "-1"; //저장에 실패 하였습니다.
			$response->code_msg = "저장에 실패 하였습니다.";

			echo json_encode($response);
			exit;

		} else if($result == '1') {

			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = "성공";

			echo json_encode($response);
			exit;
		}
	}


	// 장바구니 삭제
	public function cart_del(){
		$cart_idx = $this->_input_check("cart_idx",array());

		$data['member_idx']       = $this->member_idx;
		$data['cart_idx'] =  $cart_idx;

		$result=$this->model_cart->cart_del_up($data);

		if($result == '0') {

			$response = new stdClass;
			$response->code = "-1"; //저장에 실패 하였습니다.
			$response->code_msg = "저장에 실패 하였습니다.";

			echo json_encode($response);
			exit;

		} else if($result == '1') {

			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = "성공";

			echo json_encode($response);
			exit;
		}
	}
}// 클래스의 끝
?>
