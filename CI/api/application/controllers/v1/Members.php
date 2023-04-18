<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';
/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Members extends REST_Controller {
    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // $this->load->library('rest');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['index_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['index_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['index_delete']['limit'] = 50; // 50 requests per hour per user/key

    		$this->load->helper('url');
    		$this->load->library('session');
    		$this->load->library('global_function');

        $this->load->model('member_used/model_member_used');
        $this->load->model('member_tag/model_member_tag');
        $this->load->model('member_stats/model_member_stats');
        $this->load->model('tag/model_tag');
    }

    public function used_get()
    {

        $used_date = $this->get("date") ? $this->get("date") : "";
        $member_idx = $this->get("id") ? $this->get("id") : "";

    		$data["member_idx"] = $member_idx;

    		$response = new stdClass;

        if(strlen($used_date) == "4"){

          $data["date_type"] = "0";
          $data["used_years"] = $used_date;

        }else if(strlen($used_date) == "7"){

          $data["date_type"] = "1";
          $data["used_month"] = $used_date;

        }else if(strlen($used_date) == "10"){

          $data["date_type"] = "2";
          $data["used_days"] = $used_date;

        }else{

      		$response->code = "404";
      		$response->code_msg = "잘못된 경로입니다.";
          echo json_encode($response);
          exit;

          // $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

        }

    		$result_list = $this->model_member_used->member_used_list($data);

        if(!empty($result_list)){

      		$response->code = "1000";
      		$response->code_msg = "성공";
          $response->data_array = $result_list;

          // echo json_encode($response);
          // exit;

        }else{

      		$response->code = "-1";
      		$response->code_msg = "리스트가 없습니다.";
          $response->date = $used_date;
          $response->member = $member_idx;


          // echo json_encode($response);
          // exit;

        }

        $this->set_response($response, REST_Controller::HTTP_CREATED); // OK (200) being the HTTP response code



    }


    public function used_post()
    {

      $category_idx= $this->post("category_idx")	?	$this->post("category_idx") : "";
      $category_name=$this->post("category_name")	?	$this->post("category_name") : "";
      $member_fixed_idx=$this->post("member_fixed_idx")	?	$this->post("member_fixed_idx") : "";
      $member_idx=$this->post("member_idx")	?	$this->post("member_idx") : "";
      $period_idx=$this->post("period_idx")	?	$this->post("period_idx") : "";
      $used_sort=$this->post("used_sort")	?	$this->post("used_sort") : "";
      $used_type=$this->post("used_type")	?	$this->post("used_type") : "";
      $used_pay_type=$this->post("used_pay_type")	?	$this->post("used_pay_type") : "";
      $used_value=$this->post("used_value")	?	$this->post("used_value") : "";
      $used_date=$this->post("used_date")	?	$this->post("used_date") : "";

      $tag_name=$this->post("tag_name")	?	$this->post("tag_name") : "";

      $data["category_idx"] = $category_idx;
      $data["category_name"] = $category_name;
      $data["member_fixed_idx"] = $member_fixed_idx;
      $data["member_idx"] = $member_idx;
      $data["period_idx"] = $period_idx;
      $data["used_sort"] = $used_sort;
      $data["used_type"] = $used_type;
      $data["used_pay_type"] = $used_pay_type;
      $data["used_value"] = $used_value;
      $data["used_date"] = $used_date;

      $data["tag_name"] = $tag_name;

      $tag_idx = $this->tag_reg_in($data); //해당 태그 인덱스 가져오기
      $data["tag_idx"] = $tag_idx;

  		$response = new stdClass;

      // echo "111";
      // exit;

      $member_used_reg_in = $this->model_member_used->member_used_reg_in($data); //사용자 지출/수입 등록 실행

      if($member_used_reg_in == "1"){ //사용자 지출/수입 등록 성공

        if($used_type == "1" || $used_pay_type == "0" || $used_pay_type == "1"){
          //stats_type 분류
          if($used_type == "1"){
            $data["stats_type"] = "0";
          }else if($used_pay_type = "0"){
            $data["stats_type"] = "1";
          }else if($used_pay_type = "1"){
            $data["stats_type"] = "2";
          }

          $member_stats_reg_in = $this->model_member_stats->member_stats_reg_in($data); //사용자 통계 등록

          if($member_stats_reg_in == "1"){ //사용자 등록 성공

            $response->code = "1000";
            $response->code_msg = "사용자 지출/수입 등록 성공";

            // echo json_encode($response);

          }else{

            $response->code = "-1";
            $response->code_msg = "사용자 통계 등록 실패";

            // echo json_encode($response);

          }

        }

        $response->code = "1000";
        $response->code_msg = "사용자 지출/수입 등록 성공";

        // echo json_encode($response);

      }else{ //사용자 지출/수입 등록 실패

        $response->code = "-1";
        $response->code_msg = "사용자 지출/수입 등록 실패";

        // echo json_encode($response);

      }


      $this->set_response($response, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code

    }


//태그 등록
  public function tag_reg_in($data){

		$response = new stdClass;

    $tag_filter = $this->model_tag->tag_filtering($data);

    if($tag_filter == "0"){ //태그 필터링 통과

      $tag_reg_in = $this->model_tag->tag_reg_in($data);

      if($tag_reg_in == "1"){

        $tag_name_check = $this->model_tag->tag_name_check($data);

        if(!empty($tag_name_check)){

          $data["tag_idx"] = $tag_name_check->tag_idx;

          $member_tag_reg_in = $this->model_member_tag->member_tag_reg_in($data);

          if($member_tag_reg_in == "1"){

            return $tag_name_check->tag_idx;

          }else{

      			$response->code = "-1";
      			$response->code_msg = "사용자 태그 등록 실패";

      			echo json_encode($response);
      			exit;

          }

          return $tag_name_check->tag_idx;

        }else{

    			$response->code = "-1";
    			$response->code_msg = "태그 찾기 실패";

    			echo json_encode($response);
    			exit;

        }

      }else{

  			$response->code = "-1";
  			$response->code_msg = "태그 등록 실패";

  			echo json_encode($response);
  			exit;

      }

    }else{ //태그 필터링에 걸린 경우

			$response->code = "-1";
			$response->code_msg = "부적절한 태그입니다.";

			echo json_encode($response);
			exit;

    }

  }

//태그 등록
  public function tag_modify_up($data){

		$response = new stdClass;

    $tag_filter = $this->model_tag->tag_filtering($data);

    if($tag_filter == "0"){ //태그 필터링 통과

      $member_tag_count_down = $this->model_member_tag->member_tag_count_down($data);

      if($member_tag_count_down == "1"){ //사용자 태그 카운트 다운

        $tag_count_down = $this->model_tag->tag_count_down($data);

        if($tag_count_down == "1"){ //태그 카운드 다운

          $tag_reg_in = $this->model_tag->tag_reg_in($data);

          if($tag_reg_in == "1"){ //태그 등록 성공

            $tag_name_check = $this->model_tag->tag_name_check($data);

            if(empty($tag_name_check)){ //태그 인덱스 찾기

              $member_tag_reg_in = $this->model_member_tag->member_tag_reg_in($data);

              if($member_tag_reg_in == "1"){ //사용자 태그 등록 성공

                return $tag_name_check->tag_idx;

              }else{

          			$response->code = "-1";
          			$response->code_msg = "사용자 태그 등록 실패";

          			echo json_encode($response);
          			exit;

              }

            }else{

              return $tag_name_check->tag_idx;

            }

          }else{

      			$response->code = "-1";
      			$response->code_msg = "태그 등록 실패";

      			echo json_encode($response);
      			exit;

          }

        }else{

          $response->code = "-1";
          $response->code_msg = "태그 수정 실패";

          echo json_encode($response);
          exit;

        }

      }else{

        $response->code = "-1";
        $response->code_msg = "사용자 태그 수정 실패";

        echo json_encode($response);
        exit;

      }

    }else{ //태그 필터링에 걸린 경우

			$response->code = "-1";
			$response->code_msg = "부적절한 태그입니다.";

			echo json_encode($response);
			exit;

    }

  }
}
