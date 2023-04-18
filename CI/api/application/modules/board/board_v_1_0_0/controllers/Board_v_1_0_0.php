<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-11-05
| Memo : 자유 게시판 관리
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

class Board_v_1_0_0 extends MY_Controller{

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

		$this->load->model('board_v_1_0_0/model_board');
	}

	/* Index */
	public function index(){
		$this->board_list();
	}

/*
   --------------------------------------------------------
  | 1. 포토게시판리스트
  |________________________________________________________
*/

	// 1-1. 포토게시판리스트
	public function board_list(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check('member_idx', array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$category = $this->_input_check('category',array("empty_msg"=>"카테고리을 입력해주세요.","focus_id"=>"category"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_idx'] = $member_idx;
		$data['category'] = $category;
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_board->board_list($data);//model 1. 포토게시판리스트
		$result_list_count = $this->model_board->board_list_count($data);//model 1-1. 포토게시판리스트 총 카운트
		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['board_idx']	= $row->board_idx;
			$data_array[$x]['member_idx']	= $row->member_idx;
			$data_array[$x]['member_nickname']	= $row->member_nickname;
			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['member_img_width']	= (int)$this->global_function->get_images_width($row->member_img);
			$data_array[$x]['member_img_height']	= (int)$this->global_function->get_images_height($row->member_img);
			$data_array[$x]['board_img']	= $row->board_img;
			$data_array[$x]['img_width']	= (int)$this->global_function->get_images_width($row->board_img);
			$data_array[$x]['img_height']	= (int)$this->global_function->get_images_height($row->board_img);
			$data_array[$x]['category']	= $this->global_function->get_board_category($row->category);
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['contents']	= $row->contents;
			$data_array[$x]['like_cnt']	= $row->like_cnt;
			$data_array[$x]['reply_cnt']	= $row->reply_cnt;
			$data_array[$x]['scrap_cnt']	= $row->scrap_cnt;
			$data_array[$x]['my_like_yn']	= $row->my_like_yn;
			$data_array[$x]['my_scrap_yn']	= $row->my_scrap_yn;
      $data_array[$x]['ins_date'] = $this->global_function->date_ymd_comma($row->ins_date);
		  $x++;
		}

		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
  }

	// 2. 포토게시판상세
	public function board_detail(){
		header('Content-Type: application/json');
		$board_idx = $this->_input_check('board_idx', array("empty_msg"=>"게시판키를 입력해주세요.","focus_id"=>"board_idx"));
		$member_idx = $this->_input_check('member_idx', array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_board->board_detail($data);

		$response = new stdClass();


		if(count($result)==0){
				$response->code = "-2"; //조회된 값이 없음
				$response->code_msg = $this->global_msg->code_msg('-2');
			}else{
				$response->code = "1000";
				$response->code_msg = $this->global_msg->code_msg('1000');

				$response->board_idx = $result->board_idx;
				$response->member_idx = $result->member_idx;
				$response->member_nickname = $result->member_nickname;
				$response->title = $result->title;
				$response->contents = $result->contents;
				$response->member_img = $result->member_img;
				$response->img_width = (int)$this->global_function->get_images_width($result->member_img);
				$response->img_height = (int)$this->global_function->get_images_height($result->member_img);
				$response->board_img = $result->board_img;
				$response->board_img_width = (int)$this->global_function->get_images_width($result->board_img);
				$response->board_img_height = (int)$this->global_function->get_images_height($result->board_img);
				$response->ins_date = $this->global_function->date_ymd_comma($result->ins_date);
				$response->reply_cnt = $result->reply_cnt;
				$response->scrap_cnt = $result->scrap_cnt;
				$response->like_cnt = $result->like_cnt;
				$response->my_like_yn = $result->my_like_yn;

				if($result->member_idx ==$member_idx){
					$response->btn_mod_yn = "Y";
					$response->btn_del_yn = "Y";
					$response->btn_report_yn = "N";
				}else{
					$response->btn_mod_yn = "N";
					$response->btn_del_yn = "N";
					if($result->my_report_cnt>0){
						$response->btn_report_yn = "N";
					}else{
						$response->btn_report_yn = "Y";
					}
				}

			}
			echo json_encode($response);
			exit;
	}

	// 2-1. 포토게시판댓글 리스트
	public function board_comment_list(){
		header('Content-Type: application/json');

		$board_idx = $this->_input_check('board_idx', array("empty_msg"=>"게시판키를 입력해주세요.","focus_id"=>"board_idx"));
		$member_idx = $this->_input_check('member_idx', array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
    $page_size = 10;

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;

		$data['page_size'] = $page_size;//
	  $data['page_no'] = ($page_num-1)*$page_size;//

		$comment_list_array  = $this->model_board->board_comment_list_get($data);
		$result_list_count = $this->model_board->board_comment_list_count($data);//
	  $total_page = ceil($result_list_count/$page_size);//

		$comment_reply_array = $this->model_board->board_comment_reply_list_get($data);
		$board_check = $this->model_board->board_check($data);

		$response = new stdClass();

		$x = 0;
		$data_array = array();
		foreach($comment_list_array as $row){

			$data_array[$x]['board_reply_idx']	= $row->board_reply_idx;
			$data_array[$x]['parent_board_reply_idx']	= "";
			$data_array[$x]['depth']	= $row->depth;
			$data_array[$x]['btn_comment_yn']	= "Y";
			$data_array[$x]['ins_date'] = $this->global_function->date_ymd_comma($row->ins_date);
			$data_array[$x]['member_nickname']	= $row->member_nickname;
		  $data_array[$x]['my_like_yn']	= $row->my_like_yn;

			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['img_width']	= (int)$this->global_function->get_images_width($row->member_img);
			$data_array[$x]['img_height']	= (int)$this->global_function->get_images_height($row->member_img);
			if($row->member_idx ==$member_idx){
				$data_array[$x]['btn_report_yn']	= "N";
				$data_array[$x]['btn_del_yn']	= "Y";
			}else{
				if($row->my_report_cnt>0){
					$data_array[$x]['btn_report_yn']	= "N";
				}else{
					$data_array[$x]['btn_report_yn']	= "Y";
				}
				$data_array[$x]['btn_del_yn']	= "N";


			}
			if($row->del_yn =="N"){
				if($row->display_yn =="Y"){
					$data_array[$x]['reply_comment']	= $row->reply_comment;
				}else{
					$data_array[$x]['reply_comment']	= "다수의 신고에 의해 블라인드 처리된 댓글입니다.";
					$data_array[$x]['btn_report_yn']	= "N";
					$data_array[$x]['btn_comment_yn']	= "N";
          $data_array[$x]['btn_del_yn']	= "N";
				}
			}else{
				$data_array[$x]['reply_comment']	= "삭제된 댓글 입니다.";
				$data_array[$x]['btn_report_yn']	= "N";
				$data_array[$x]['btn_del_yn']	= "N";
				$data_array[$x]['btn_comment_yn']	= "N";
			}

			$filter_array = array_filter($comment_reply_array, function ($item) use ($row) {
				return $item->grand_parent_board_reply_idx === $row->board_reply_idx;
			});

			$data_array2 = array();
			$j=0;
		  foreach($filter_array as $row2) {
				$data_array2[$j]['board_reply_idx']	= $row2->board_reply_idx;
				$data_array2[$j]['parent_board_reply_idx']	= $row2->parent_board_reply_idx;
				$data_array2[$j]['depth']	= $row2->depth;
				if($row2->depth =="2"){
					$data_array2[$j]['btn_comment_yn']	= "N";
				}else{
					$data_array2[$j]['btn_comment_yn']	= "Y";
				}
				$data_array2[$j]['ins_date'] = $this->global_function->date_ymd_comma($row2->ins_date);
				$data_array2[$j]['member_nickname']	= $row2->member_nickname;
				$data_array2[$j]['my_like_yn']	= $row2->my_like_yn;

				$data_array2[$j]['member_img']	= $row2->member_img;
				$data_array2[$j]['img_width']	= (int)$this->global_function->get_images_width($row2->member_img);
				$data_array2[$j]['img_height']	= (int)$this->global_function->get_images_height($row2->member_img);
				if($row2->member_idx ==$member_idx){
					$data_array2[$j]['btn_report_yn']	= "N";
					$data_array2[$j]['btn_del_yn']	= "Y";
				}else{

					if($row2->my_report_cnt>0){
						$data_array2[$j]['btn_report_yn']	= "N";
					}else{
						$data_array2[$j]['btn_report_yn']	= "Y";
					}

					$data_array2[$j]['btn_del_yn']	= "N";
				}
				if($row2->del_yn =="N"){
					if($row2->display_yn =="Y"){
						$data_array2[$j]['reply_comment']	= $row2->reply_comment;
					}else{
						$data_array2[$j]['reply_comment']	= "다수의 신고에 의해 블라인드 처리된 댓글입니다.";
						$data_array2[$j]['btn_report_yn']	= "N";
						$data_array2[$j]['btn_comment_yn']	= "N";
            $data_array2[$j]['btn_del_yn']	= "N";
					}
				}else{
					$data_array2[$j]['reply_comment']	= "삭제된 댓글 입니다.";
					$data_array2[$j]['btn_report_yn']	= "N";
					$data_array2[$j]['btn_del_yn']	= "N";
					$data_array2[$j]['btn_comment_yn']	= "N";
				}

				$j++;
		  }
			$data_array[$x]['reply_cnt']	= $j;
			$data_array[$x]['reply_arr']	= $data_array2;
		  $x++;
		}

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
      $response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;

	}

	// 2-2. 포토게시판댓글 등록
	public function board_comment_reg_in(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$board_idx = $this->_input_check('board_idx',array("empty_msg"=>"게시판키을 입력해주세요.","focus_id"=>"board_idx"));
		$reply_comment = $this->_input_check('reply_comment',array("empty_msg"=>"댓글을 입력해주세요.","focus_id"=>"reply_comment"));
		$member_nickname = $this->_input_check('member_nickname',array("empty_msg"=>"회원닉네임를 입력해주세요.","focus_id"=>"member_nickname"));
		$board_reply_idx = $this->_input_check('board_reply_idx',array());

		if($board_reply_idx == ""){
      $depth=0;
      $reply_depth=0;
			$board_reply_idx=0;
      $parent_board_reply_idx=0;
      $grand_parent_board_reply_idx=0;
		}else{
			$data['board_reply_idx']  = $board_reply_idx;
			$check = $this->model_board->board_reply_detail($data);
			$depth=$check->next_depth;
			if($depth=="1"){
				$parent_board_reply_idx=$board_reply_idx;
				$grand_parent_board_reply_idx=$board_reply_idx;
				$reply_depth=$check->next_reply_depth;
			}else{
				$parent_board_reply_idx=$board_reply_idx;
				$grand_parent_board_reply_idx=$check->grand_parent_board_reply_idx;
				$reply_depth=$check->reply_depth;
			}

		}

		$data['member_idx'] = $member_idx;
		$data['board_idx'] = $board_idx;
		$data['reply_comment'] = $reply_comment;
		$data['parent_board_reply_idx'] = $parent_board_reply_idx;
		$data['grand_parent_board_reply_idx'] = $grand_parent_board_reply_idx;
		$data['depth']  = $depth;
		$data['reply_depth']  = $reply_depth;
		$data['board_reply_idx']  = $board_reply_idx;


		$result = $this->model_board->board_comment_reg_in($data);//# model 5. 포토게시판댓글 등록

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = "댓글(답글)등록 실패하였습니다. 관리자에게 문의해주세요.";
		}else{

			//댓글
			$check0 = $this->model_board->board_detail($data);
			if($board_reply_idx == ""){

				$index="102";
				$alarm_yn=($check0->member_idx ==$member_idx)?"N":"Y";
				$member_idx = $check0->member_idx;
				$alarm_data['title'] = mb_substr($reply_comment,0,10);

			}else{
					$index="103";
					$alarm_yn="Y";
					$member_idx = $check->member_idx;
					$alarm_data['title'] =  mb_substr($reply_comment,0,10);
			}
      $alarm_data['member_nickname'] = $member_nickname;
      $alarm_data['board_idx'] = $board_idx;

			$this->_alarm_action($member_idx,$index, $alarm_data);

			$response->code = "1000";
			$response->code_msg = "댓글등록 성공하였습니다.";
		}

		echo json_encode($response);
		exit;
	}

	// 2-3. 포토게시판댓글 삭제
	public function reply_comment_del(){
		header('Content-Type: application/json');

		$board_reply_idx = $this->_input_check('board_reply_idx',array());
		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));

		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_board->reply_comment_del($data);//# model 6. 포토게시판댓글 삭제

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = "댓글삭제 처리 중 오류가 발생했습니다. 관리자에게 문의해주세요.";
		}else{
			$response->code = "1000";
			$response->code_msg = "댓글삭제 성공하였습니다. ";
		}

		echo json_encode($response);
		exit;
	}

	// 2-4. 게시물 삭제
	public function board_del(){
		header('Content-Type: application/json');

		$board_idx = $this->_input_check('board_idx',array());
		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_board->board_del($data);//# model 7. 게시물 삭제

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = "게시물 삭제중 오류가 발생했습니다. 관리자에게 문의해주세요.";
		}else{
			$response->code = "1000";
			$response->code_msg = "게시물 삭제 성공하였습니다.";
		}

		echo json_encode($response);
		exit;
	}


	// 2-2. 포토게시판등록
	public function board_reg_in(){
		header('Content-Type: application/json');

		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$category = $this->_input_check('category',array("empty_msg"=>"카테고리을 입력해주세요.","focus_id"=>"category"));
		$title = $this->_input_check('title',array("empty_msg"=>"제목을 입력해주세요.","focus_id"=>"title"));
		$contents = $this->_input_check('contents',array("empty_msg"=>"내용을 입력해주세요.","focus_id"=>"contents"));
	  $board_img = $this->_input_check('board_img',array("empty_msg"=>"이미지를 입력해주세요.","focus_id"=>"board_img"));

		$data['member_idx'] = $member_idx;
		$data['title'] = $title;
		$data['contents'] = $contents;
		$data['board_img']  = $board_img;
		$data['category']  = $category;

		$result = $this->model_board->board_reg_in($data);

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
		 $response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}


	// 수정하기
	public function board_mod_up(){
		header('Content-Type: application/json');

		$board_idx = $this->_input_check('board_idx',array("empty_msg"=>"게시판키를 입력해주세요.","focus_id"=>"board_idx"));
		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$title = $this->_input_check('title',array("empty_msg"=>"제목을 입력해주세요.","focus_id"=>"title"));
		$contents = $this->_input_check('contents',array("empty_msg"=>"내용을 입력해주세요.","focus_id"=>"contents"));
		$board_img = $this->_input_check('board_img',array("empty_msg"=>"이미지를 입력해주세요.","focus_id"=>"board_img"));
		$repliable_yn = $this->_input_check('repliable_yn',array());

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;
		$data['title'] = $title;
		$data['contents'] = $contents;
		$data['board_img']  = $board_img;
		$data['repliable_yn']  = $repliable_yn;

		$result = $this->model_board->board_mod_up($data);

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
				$response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}


	// 댓글 기능 해제 / 설정
	public function board_repliable_mod_up(){
		header('Content-Type: application/json');

		$board_idx = $this->_input_check('board_idx',array("empty_msg"=>"게시판키를 입력해주세요.","focus_id"=>"board_idx"));
		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$repliable_yn = $this->_input_check('repliable_yn',array());

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;
		$data['repliable_yn']  = $repliable_yn;

		$result = $this->model_board->board_repliable_mod_up($data);

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
				$response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}


	// 게시물신고
	public function board_report_reg_in(){
		header('Content-Type: application/json');

		$board_idx = $this->_input_check('board_idx',array("empty_msg"=>"게시판키를 입력해주세요.","focus_id"=>"board_idx"));
		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$report_contents = $this->_input_check('report_contents',array("empty_msg"=>"신고내용를 입력해주세요.","focus_id"=>"report_contents"));
		$report_type = $this->_input_check('report_type',array("empty_msg"=>"신고유형을 선택해주세요.","focus_id"=>"report_type"));
		$img_path = $this->_input_check('img_path',array());

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;
		$data['report_contents'] = $report_contents;
		$data['img_path'] = $img_path;
		$data['report_type'] = $report_type;

		$result = $this->model_board->board_report_reg_in($data);//

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}


	// 댓글신고
	public function board_reply_report_reg_in(){
		header('Content-Type: application/json');

		$board_reply_idx = $this->_input_check('board_reply_idx',array("empty_msg"=>"댓글키를 입력해주세요.","focus_id"=>"board_idx"));
		$member_idx = $this->_input_check('member_idx',array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$report_type = $this->_input_check('report_type',array("empty_msg"=>"신고유형을 선택해주세요.","focus_id"=>"report_type"));
		$report_position = $this->_input_check('report_position',array());
		$report_contents = $this->_input_check('report_contents',array("empty_msg"=>"신고내용를 입력해주세요.","focus_id"=>"report_contents"));
		$img_path = $this->_input_check('img_path',array());

		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $member_idx;
		$data['report_type'] = $report_type;
		$data['report_position'] = $report_position;
		$data['report_contents'] = $report_contents;
		$data['img_path'] = $img_path;

		$result = $this->model_board->board_reply_report_reg_in($data);//

		$response = new stdClass();

		if($result < 0){
			$response->code = "-1";
			$response->code_msg = $this->global_msg->code_msg('-1');
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
		}

		echo json_encode($response);
		exit;
	}

	/*
	   --------------------------------------------------------
	  |  내작성글
	  |________________________________________________________
	*/

	// 리스트
	public function my_board_list(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check('member_idx', array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_idx'] = $member_idx;
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_board->my_board_list($data);
		$result_list_count = $this->model_board->my_board_list_count($data);
		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['board_idx']	= $row->board_idx;
			$data_array[$x]['member_idx']	= $row->member_idx;
			$data_array[$x]['member_nickname']	= $row->member_nickname;
			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['member_img_width']	= (int)$this->global_function->get_images_width($row->member_img);
			$data_array[$x]['member_img_height']	= (int)$this->global_function->get_images_height($row->member_img);
			$data_array[$x]['board_img']	= $row->board_img;
			$data_array[$x]['img_width']	= (int)$this->global_function->get_images_width($row->board_img);
			$data_array[$x]['img_height']	= (int)$this->global_function->get_images_height($row->board_img);
			$data_array[$x]['category']	= $this->global_function->get_board_category($row->category);
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['contents']	= $row->contents;
			$data_array[$x]['like_cnt']	= $row->like_cnt;
			$data_array[$x]['scrap_cnt']	= $row->scrap_cnt;
			$data_array[$x]['reply_cnt']	= $row->reply_cnt;
			$data_array[$x]['my_like_yn']	= $row->my_like_yn;
			$data_array[$x]['my_scrap_yn']	= $row->my_scrap_yn;
      $data_array[$x]['ins_date'] = $this->global_function->date_ymd_comma($row->ins_date);

		  $x++;
		}

		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
  }

	/*
	   --------------------------------------------------------
	  |  댓글 단 포토
	  |________________________________________________________
	*/

	// 리스트
	public function my_reply_board_list(){
		header('Content-Type: application/json');
		$member_idx = $this->_input_check('member_idx', array("empty_msg"=>"회원키를 입력해주세요.","focus_id"=>"member_idx"));
		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$page_size = PAGESIZE;

		$data['member_idx'] = $member_idx;
		$data['page_size'] = $page_size;
		$data['page_no'] = ($page_num-1)*$page_size;

		$result_list = $this->model_board->my_reply_board_list($data);
		$result_list_count = $this->model_board->my_reply_board_list_count($data);
		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['board_idx']	= $row->board_idx;
			$data_array[$x]['member_idx']	= $row->member_idx;
			$data_array[$x]['member_nickname']	= $row->member_nickname;
			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['member_img_width']	= (int)$this->global_function->get_images_width($row->member_img);
			$data_array[$x]['member_img_height']	= (int)$this->global_function->get_images_height($row->member_img);
			$data_array[$x]['board_img']	= $row->board_img;
			$data_array[$x]['img_width']	= (int)$this->global_function->get_images_width($row->board_img);
			$data_array[$x]['img_height']	= (int)$this->global_function->get_images_height($row->board_img);
			$data_array[$x]['category']	= $this->global_function->get_board_category($row->category);
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['contents']	= $row->contents;
			$data_array[$x]['like_cnt']	= $row->like_cnt;
			$data_array[$x]['scrap_cnt']	= $row->scrap_cnt;
			$data_array[$x]['reply_cnt']	= $row->reply_cnt;
			$data_array[$x]['my_like_yn']	= $row->my_like_yn;
			$data_array[$x]['my_scrap_yn']	= $row->my_scrap_yn;
      $data_array[$x]['ins_date'] = $this->global_function->date_ymd_comma($row->ins_date);
		  $x++;
		}

		$response = new stdClass();

		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
  }

	/*
	   --------------------------------------------------------
	  |  나의 위시리스트
	  |________________________________________________________
	*/
	//나의 위시리스트
  public function board_like_list(){
    header('Content-Type: application/json');
		$response = new stdClass();

		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>" 회원키를 입력해주세요."));
    $page_size = PAGESIZE;

		$data['member_idx'] = $member_idx;
		$data['page_size'] = $page_size;
		$data['page_no']   = ($page_num-1)*$page_size;

		$result_list = $this->model_board->board_like_list($data);
		$result_list_count = $this->model_board->board_like_list_count($data);//리스트 총 개수

		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['board_idx']	= $row->board_idx;
			$data_array[$x]['member_idx']	= $row->member_idx;
			$data_array[$x]['member_nickname']	= $row->member_nickname;
			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['member_img_width']	= (int)$this->global_function->get_images_width($row->member_img);
			$data_array[$x]['member_img_height']	= (int)$this->global_function->get_images_height($row->member_img);
			$data_array[$x]['board_img']	= $row->board_img;
			$data_array[$x]['img_width']	= (int)$this->global_function->get_images_width($row->board_img);
			$data_array[$x]['img_height']	= (int)$this->global_function->get_images_height($row->board_img);
			$data_array[$x]['category']	= $this->global_function->get_board_category($row->category);
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['contents']	= $row->contents;
			$data_array[$x]['like_cnt']	= $row->like_cnt;
			$data_array[$x]['scrap_cnt']	= $row->scrap_cnt;
			$data_array[$x]['reply_cnt']	= $row->reply_cnt;
			$data_array[$x]['my_like_yn']	= $row->my_like_yn;
			$data_array[$x]['my_scrap_yn']	= $row->my_scrap_yn;
      $data_array[$x]['ins_date'] = $this->global_function->date_ymd_comma($row->ins_date);

		  $x++;
		}


		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
		  $response->total_cnt = (int)$result_list_count;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
		  $response->total_cnt = (int)$result_list_count;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
  }


	//wish 등록및 취소
	public function board_like_reg_in(){
		header('Content-Type: application/json');

		$board_idx =  $this->_input_check("board_idx",array("empty_msg"=>" 키를 입력해주세요."));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>" 회원키를 입력해주세요."));

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_board->board_like_reg_in($data);

		$response = new stdClass;

		if($result == 0) {
			$response->code = "-1";
			$response->code_msg = " 실패 하였습니다. 다시 한번 시도해주세요.";
		}else{
			$response->code = "1000";
			$response->code_msg = " 성공 하였습니다.";
		}

		echo json_encode($response);
		exit;
	}

	//wish 등록및 취소
	public function board_reply_like_reg_in(){
		header('Content-Type: application/json');

		$board_reply_idx =  $this->_input_check("board_reply_idx",array("empty_msg"=>" 키를 입력해주세요."));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>" 회원키를 입력해주세요."));

		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_board->board_reply_like_reg_in($data);

		$response = new stdClass;

		if($result == 0) {
			$response->code = "-1";
			$response->code_msg = " 실패 하였습니다. 다시 한번 시도해주세요.";
		}else{
			$response->code = "1000";
			$response->code_msg = " 성공 하였습니다.";
		}

		echo json_encode($response);
		exit;
	}



	/*
		 --------------------------------------------------------
		|  나의 scrap
		|________________________________________________________
	*/
	//나의 위시리스트
	public function board_scrap_list(){
		header('Content-Type: application/json');
		$response = new stdClass();

		$page_num = $this->_input_check('page_num',array("ternary"=>'1'));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>" 회원키를 입력해주세요."));
		$page_size = PAGESIZE;

		$data['member_idx'] = $member_idx;
		$data['page_size'] = $page_size;
		$data['page_no']   = ($page_num-1)*$page_size;

		$result_list = $this->model_board->board_scrap_list($data);
		$result_list_count = $this->model_board->board_scrap_list_count($data);//리스트 총 개수

		$total_page = ceil($result_list_count/$page_size);

		$x = 0;
		$data_array = array();

		foreach($result_list as $row){
			$data_array[$x]['board_idx']	= $row->board_idx;
			$data_array[$x]['member_idx']	= $row->member_idx;
			$data_array[$x]['member_nickname']	= $row->member_nickname;
			$data_array[$x]['member_img']	= $row->member_img;
			$data_array[$x]['member_img_width']	= (int)$this->global_function->get_images_width($row->member_img);
			$data_array[$x]['member_img_height']	= (int)$this->global_function->get_images_height($row->member_img);
			$data_array[$x]['board_img']	= $row->board_img;
			$data_array[$x]['img_width']	= (int)$this->global_function->get_images_width($row->board_img);
			$data_array[$x]['img_height']	= (int)$this->global_function->get_images_height($row->board_img);
			$data_array[$x]['category']	= $this->global_function->get_board_category($row->category);
			$data_array[$x]['title']	= $row->title;
			$data_array[$x]['contents']	= $row->contents;
			$data_array[$x]['like_cnt']	= $row->like_cnt;
			$data_array[$x]['scrap_cnt']	= $row->scrap_cnt;
			$data_array[$x]['reply_cnt']	= $row->reply_cnt;
			$data_array[$x]['my_like_yn']	= $row->my_like_yn;
			$data_array[$x]['my_scrap_yn']	= $row->my_scrap_yn;
			$data_array[$x]['ins_date'] = $this->global_function->date_ymd_comma($row->ins_date);

			$x++;
		}


		if($x==0){
			$response->code = "2000";
			$response->code_msg = $this->global_msg->code_msg('2000');
			$response->list_cnt = $x;
			$response->total_cnt = (int)$result_list_count;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}else{
			$response->code = "1000";
			$response->code_msg = $this->global_msg->code_msg('1000');
			$response->list_cnt = $x;
			$response->total_cnt = (int)$result_list_count;
			$response->page_num = (int)$page_num;
			$response->total_page =	$total_page;
			$response->data_array = $data_array;
		}
		echo json_encode($response);
		exit;
	}


	//scrap 등록및 취소
	public function board_scrap_reg_in(){
		header('Content-Type: application/json');

		$board_idx =  $this->_input_check("board_idx",array("empty_msg"=>" 키를 입력해주세요."));
		$member_idx = $this->_input_check("member_idx",array("empty_msg"=>" 회원키를 입력해주세요."));

		$data['board_idx'] = $board_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_board->board_scrap_reg_in($data);

		$response = new stdClass;

		if($result == 0) {
			$response->code = "-1";
			$response->code_msg = " 실패 하였습니다. 다시 한번 시도해주세요.";
		}else{
			$response->code = "1000";
			$response->code_msg = " 성공 하였습니다.";
		}

		echo json_encode($response);
		exit;
	}




}
