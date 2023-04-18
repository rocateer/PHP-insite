<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 조다솜
| Create-Date : 2018-10-05
| Memo : 상품
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

class Product extends MY_Controller{
	function __construct(){
		parent::__construct();

		$this->load->model('product/model_product');
	}

	// 인덱스
  public function index() {
    $this->product_list();
  }

	//주문번호
	function set_cart_session_id() {
		$str ="C_".time()."_";
		$characters  = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$rendom_str = "";
		$loopNum = 10;
		while ($loopNum--) {
			$rendom_str .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $str.$rendom_str;
	}


	// 상품 리스트
  public function product_list(){
		$category_b = $this->_input_check("category_b",array());
		$category_m = $this->_input_check("category_m",array());
		$category_s = $this->_input_check("category_s",array());

		$data['category_b'] = $category_b;
		$data['category_m'] = $category_m;
		$data['category_s'] = $category_s;

		$product_m_category_list = $this->model_product->product_m_category_list($data);
		$product_s_category_list = $this->model_product->product_s_category_list($data);
		$get_location = $this->model_product->get_location($data);

		$response = new stdClass();

		$response->product_m_category_list = $product_m_category_list;
		$response->product_s_category_list = $product_s_category_list;
		$response->get_location = $get_location;
		$response->category_b = $category_b;
		$response->category_m = $category_m;
		$response->category_s = $category_s;

		$this->_view('product/view_product_list', $response);
  }

  //상품리스트get
	public function product_list_get(){
		$page_num = $this->_input_check("page_num",array("ternary"=>'1'));
		$page_size = PAGESIZE_12 ;
		$category_b = $this->_input_check("category_b",array());
		$category_m = $this->_input_check("category_m",array());
		$category_s = $this->_input_check("category_s",array());
		$orderby = $this->_input_check("orderby",array());

		$data['category_b'] = $category_b;
		$data['category_m'] = $category_m;
		$data['category_s'] = $category_s;
		$data['orderby'] = $orderby;

		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_product->product_list($data);
		$result_list_count = $this->model_product->product_list_count($data);
		$no = $result_list_count-($page_size*($page_num-1));
		$paging = $this->global_function->paging($result_list_count, $page_size, $page_num, "page_go");

		$response = new stdClass();

		$response->result_list = $result_list;
		$response->result_list_count = $result_list_count;
		$response->no = $no;
		$response->paging = $paging;

		$this->_list_view('product/view_product_list_get',$response);
	}

	// 상품 상세
	public function product_detail(){
		$product_idx = $this->_input_check("product_idx",array());

		$data['product_idx'] = $product_idx;

		$result = $this->model_product->product_detail($data);
		$data['product_code'] = $result->product_code;
		$product_option_list = $this->model_product->product_option_list($data);
		$product_img_list = $this->model_product->product_img_list($data);
		$cart_session_id = $this->set_cart_session_id();

		$response = new stdClass();

		$response->result = $result;
		$response->product_option_list = $product_option_list;
		$response->product_img_list = $product_img_list;
		$response->cart_session_id = $cart_session_id;

		$this->_view('product/view_product_detail',$response);
	}

	 /*
	 |------------------------------------------------------------------------
	 | Memo : 옵션관리
	 |------------------------------------------------------------------------
	 */

	// 옵션등록
	public function cart_option_reg_in(){
		$product_idx = $this->_input_check("product_idx",array());
		$product_price = $this->_input_check("product_price",array());
		$cart_session_id = $this->_input_check("cart_session_id",array());
		$option_count = $this->_input_check("option_count",array());
		$opt_1 = $this->_input_check("opt_1",array());
		$opt_2 = $this->_input_check("opt_2",array());

		$data['product_idx'] = $product_idx;
		$data['product_price'] = $product_price;
		$data['cart_session_id'] = $cart_session_id;
		$data['option_count'] = $option_count;
		$data['opt_1'] = $opt_1;
		$data['opt_2'] = $opt_2;

		$result = $this->model_product->cart_option_reg_in($data);

		if($result != "0"){
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = "성공";

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "실패";

			echo json_encode($response);
			exit;
		}
	}

	// 옵션리스트
	public function cart_option_list_get(){
		$product_idx = $this->_input_check("product_idx",array());
		$cart_session_id = $this->_input_check("cart_session_id",array());

		$data['product_idx'] = $product_idx;
		$data['cart_session_id'] = $cart_session_id;

		$result_list = $this->model_product->cart_option_list_get($data); // 옵션리스트

		$response = new stdClass();

		$response->result_list = $result_list;

		$this->_list_view('product/view_cart_option_list_get',$response);

	}


	// 옵션::수정
	public function cart_option_mod_up(){
		$cart_session_id = $this->_input_check("cart_session_id",array());
		$cart_idx = $this->_input_check("cart_idx",array());
		$cart_ea = $this->_input_check("cart_ea",array());

		$data['cart_session_id'] = $cart_session_id;
		$data['cart_idx'] = $cart_idx;
		$data['cart_ea'] = $cart_ea;

		$result = $this->model_product->cart_option_mod_up($data);	// 옵션::수정

		if($result != "0"){
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = "성공";

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "실패";

			echo json_encode($response);
			exit;
		}

	}

	// 옵션::삭제
	public function cart_option_del(){
		$cart_session_id = $this->_input_check("cart_session_id",array());
		$cart_idx = $this->_input_check("cart_idx",array());

		$data['cart_session_id'] = $cart_session_id;
		$data['cart_idx'] = $cart_idx;

		$result = $this->model_product->cart_option_del($data);	// 옵션::삭제

		if($result != "0"){
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = "성공";

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "-1";
			$response->code_msg = "실패";

			echo json_encode($response);
			exit;
		}
	}

}// 클래스의 끝
?>
