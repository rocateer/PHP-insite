<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('common/model_common');
	}

	//프로그램 담기
	public function block_reg_in(){
	
		$board_idx = $this->_input_check("board_idx",array("empty_msg"=>"커뮤니티 키가 누락되었습니다."));
		$board_reply_idx = $this->_input_check("board_reply_idx",array());
		$member_idx=$this->member_idx;
	
		$data['type'] = ($board_reply_idx>0)?'1':'0';
		$data['board_idx'] = $board_idx;
		$data['board_reply_idx'] = $board_reply_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_common->block_reg_in($data); // 1:1 질문 등록하기

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code ="1";
			$response->code_msg = "정상적으로 처리되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	//프로그램 담기
	public function program_reg_in(){
	
		$program_idx = $this->_input_check("program_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));
		$member_idx=$this->member_idx;
	
		$data['program_idx'] = $program_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_common->program_reg_in($data); // 1:1 질문 등록하기

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code ="1";
			$response->code_msg = "정상적으로 처리되었습니다.";
		}
		echo json_encode($response);
		exit;
	}

	//프로그램 담기
	public function like_reg_in(){
	
		$program_idx = $this->_input_check("program_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));
		$member_idx=$this->member_idx;
	
		$data['program_idx'] = $program_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_common->like_reg_in($data); // 1:1 질문 등록하기

		$response = new stdClass();

		if($result == "-1") {
			$response->code = "0";
			$response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code ="1";
			$response->code_msg = "적용되었습니다.";
			$response->like_cnt = $result;
		}
		echo json_encode($response);
		exit;
	}

	//프로그램 담기
	public function display_mod_up(){
	
		$news_idx = $this->_input_check("news_idx",array("empty_msg"=>"프로그램을 입력해 주세요."));
		$member_idx=$this->member_idx;
	
		$data['news_idx'] = $news_idx;
		$data['member_idx'] = $member_idx;

		$result = $this->model_common->display_mod_up($data); // 1:1 질문 등록하기

		$response = new stdClass();

		if($result == "0") {
			$response->code = "0";
			$response->code_msg = "문제가 발생하였습니다. 다시 시도 해주시기 바랍니다.";
		} else {
			$response->code ="1";
			$response->code_msg = "적용되었습니다.";
		}
		echo json_encode($response);
		exit;
	}


//메인 카테고리 리스트
	public function keyword_list(){
	//	$auto_yn=($this->input->post("auto_yn", TRUE) != "")	?	$this->escstr($this->input->post("auto_yn", TRUE)) : "";
	//	$data['auto_yn']=$auto_yn;
		header('Content-Type: application/json');
		$data_array=$this->model_common->keyword_list(); 	//메인 카테고리 리스트
		echo json_encode(array('list_data'=>$data_array));
		exit;
	}

//키워드 리스트
	public function keyword_sub_list(){
		header('Content-Type: application/json');
		$keyword_code=($this->input->post("keyword_code", TRUE) != "")	?	$this->escstr($this->input->post("keyword_code", TRUE)) : "";
		$auto_yn=($this->input->post("auto_yn", TRUE) != "")	?	$this->escstr($this->input->post("auto_yn", TRUE)) : "";
		$data['auto_yn']=$auto_yn;
		$data['keyword_code']=$keyword_code;

		$data_array=$this->model_common->keyword_sub_list($data); 	//키워드 리스트

		echo json_encode(array('list_data'=>$data_array));
		exit;
	}


	//파일 업로드(이미지)::api
	public function fileUpload_action(){

		$img_resize = $this->_input_check('img_resize',array());

		date_default_timezone_set('Asia/Seoul');
		ini_set("memory_limit" , -1);

		if(!is_dir("./media/commonfile/")){
			mkdir("./media/commonfile/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/")){
			mkdir("./media/commonfile/".date("Ym")."/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/".date("d")."/")){
			mkdir("./media/commonfile/".date("Ym")."/".date("d")."/",0777);
		}
		$file_path=ABS_PATH."/media/commonfile/".date("Ym")."/".date("d")."/";

		$file_url="/media/commonfile/".date("Ym")."/".date("d")."/";

		//업로드 파일 제한 조건
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= 0;
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;

		$this->load->library('upload', $config);

		if($this->upload->do_upload('file') ){
			$data=$this->upload->data();

			if (@exif_read_data($_FILES['file']['tmp_name'])) {
				// EXIF의 Orientation 데이터가 존재하면 필요에 따라 이미지 파일의 방향을 보정
				$exif = @exif_read_data($_FILES['file']['tmp_name']);

				if(!empty($exif['Orientation'])) {
					switch($exif['Orientation']) {
						case 8:
							$image_rotate = 90;
							$image_config['rotation_angle'] = $image_rotate;
						break;
						case 3:
							$image_rotate = 180;
							$image_config['rotation_angle'] = $image_rotate;
						break;
						case 6:
							$image_rotate = 270;
							$image_config['rotation_angle'] = $image_rotate;
						break;
				 }
				}
			}

			//파일 압축
			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = $data['full_path'];
			$image_config['new_image'] = $file_path.$data['file_name'];
			$image_config['maintain_ratio'] = TRUE;

			if($data['image_width'] > 1500 || $data['image_width'] > $img_resize ){
				if($img_resize == NULL){
					$image_config['width'] = 1024;
				}else{
					$image_config['width'] = $img_resize;
				}
			}

			$image_config['height'] = $data['image_height']/1.8;

			if (empty($image_rotate)) {
				$image_config['rotation_angle'] = -360;
			}else {
				$image_config['rotation_angle'] = $image_rotate;
			}
			$image_config['quality'] = "70%";
			
			$this->load->library('image_lib');
			$this->image_lib->initialize($image_config);
			$this->image_lib->resize();
			$this->image_lib->rotate();


			$fileData = array(
				//'orig_name'=>$data['orig_name'],
				//'filename' =>$data['file_name'],
				'image_width' =>$data['image_width'],
				'image_height' =>$data['image_height'],
				'orig_name'=>$data['orig_name'],
				'filename' =>$data['orig_name'],
				'file_type'=>$data['file_type'],
				'file_ext' =>$data['file_ext'],
				'path'     =>$file_url.$data['file_name'],
				'url'      =>$file_url.$data['file_name'],
			 );

			$data['img_url']= $file_url.$data['file_name'];

			//썸네일
			$thum_file_name = explode(".",$data['file_name']);
			$thum_file_name = $thum_file_name[0].'_s.'.$thum_file_name[1];

			$image_thum_config['image_library'] = 'gd2';
			$image_thum_config['source_image'] = $data['full_path'];
			$image_thum_config['new_image'] = $file_path.$thum_file_name;
			$image_thum_config['maintain_ratio'] = TRUE;

			if($data['image_width']>200){
				$image_thum_config['width'] = 150;
			}else{
				$image_thum_config['width'] = $data['image_width'];
			}
			$image_config['quality'] = "20%";

			$this->load->library('image_lib');
			$this->image_lib->initialize($image_thum_config);
			$this->image_lib->resize();
			//$result=$this->model_common->temp_img_in($data); //이미지 임시 저장
			ini_set("memory_limit" , '512M');

			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = "성공";
			$response->file_path = $file_url.$data['file_name'];
			$response->img_width = $fileData['image_width'];
			$response->img_height = $fileData['image_height'];

			echo json_encode($response);
			exit;
		}else{
			ini_set("memory_limit" , '512M');
			$response = new stdClass;

			$error = array('error' => $this->upload->display_errors());
			$response->error = $error ;
			log_message('error'," img_error_msg : '.$error \r\n' ");

			echo json_encode(	$response);
			exit;
		}

	}


	public function img_upload(){
		date_default_timezone_set('Asia/Seoul');

		$device=$this->input->post("device",TRUE);

		if(!is_dir("./media/commonfile/")){
			mkdir("./media/commonfile/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/")){
			mkdir("./media/commonfile/".date("Ym")."/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/".date("d")."/")){
			mkdir("./media/commonfile/".date("Ym")."/".date("d")."/",0777);
		}
		$file_path=ABS_PATH."/media/commonfile/".date("Ym")."/".date("d")."/";
		$file_url="/media/commonfile/".date("Ym")."/".date("d")."/";

		$config['upload_path'] = $file_path;
		$config['allowed_types'] = '*';
		$config['max_size']	= 0;
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$this->load->library('upload', $config);

		if($this->upload->do_upload('file')){

			$data=$this->upload->data();

			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = $data['full_path'];
			$image_config['new_image'] = $file_path.$data['file_name'];
			$image_config['maintain_ratio'] = TRUE;
			$image_config['create_thumb'] = FALSE;

      if($device =="C"){
				$image_config['width'] = 300;
				//$image_config['height'] = 300;
			}else{
				$image_config['width'] = 300;
				//$image_config['height'] = 300;
			}

			$image_config['quality'] = "75%";
			$this->load->library('image_lib');
			$this->image_lib->initialize($image_config);
			$this->image_lib->resize();

			$fileData = array(
				'orig_name'=>$data['orig_name'],
				'filename' =>$data['orig_name'],
				'file_type'=>$data['file_type'],
				'file_ext' =>$data['file_ext'],
				'path'     =>$file_url.$data['file_name'],
				'url'      =>$file_url.$data['file_name']
			 );

			echo $fileData['url'];

		}else{
			echo $this->upload->display_errors();
		}
	}

	//파일 다중 업로드
	public function multi_fileUpload(){
		// header('Content-Type: application/json');

		$files = $_FILES['file'];

		$file_list = $this->multi_fileUpload_action($files);
		echo json_encode($file_list);
		exit;
	}


	//파일 업로드
	public function multi_fileUpload_action($files){
		date_default_timezone_set('Asia/Seoul');

		if(!is_dir("./media/commonfile/")){
			mkdir("./media/commonfile/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/")){
			mkdir("./media/commonfile/".date("Ym")."/",0777);
		}
		if(!is_dir("./media/commonfile/".date("Ym")."/".date("d")."/")){
			mkdir("./media/commonfile/".date("Ym")."/".date("d")."/",0777);
		}
		$file_path=ABS_PATH."/media/commonfile/".date("Ym")."/".date("d")."/";

		$file_url="/media/commonfile/".date("Ym")."/".date("d")."/";

		//업로드 파일 제한 조건
		$config['upload_path'] = $file_path;
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= 0;
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$aee = $this->load->library('upload', $config);

		$files_count = count($files['name']);

		$response = new stdClass;
		if ($files_count == "0") {
			$response->code = "-1"; //성공
			$response->code_msg = "파일이 없습니다";
			var_dump(	$response);
			exit;
		}

		// Faking upload calls to $_FILE
		for ($i = 0; $i < $files_count; $i++) {
			ini_set("memory_limit" , -1);
			$_FILES['userfile']['type']     = $files['type'][$i];
			$_FILES['userfile']['name']     = $files['name'][$i];
			$_FILES['userfile']['tmp_name'] = $files['tmp_name'][$i];
			$_FILES['userfile']['error']    = $files['error'][$i];
			$_FILES['userfile']['size']     = $files['size'][$i];

			$this->upload->initialize($config);
			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$response->error = $error ;
				echo json_encode(	$response);
				exit;
			}else {
				$data[] = $this->upload->data();
				// 앱에서 등록한 사진 회전 확인
				$image_rotate="";
				if (@exif_read_data($_FILES['userfile']['tmp_name'])) {
					// EXIF의 Orientation 데이터가 존재하면 필요에 따라 이미지 파일의 방향을 보정
					$exif = exif_read_data($_FILES['userfile']['tmp_name']);
					if(!empty($exif['Orientation'])) {
						switch($exif['Orientation']) {
							case 8:
								$image_rotate = 90;
								$image_config['rotation_angle'] = $image_rotate;
							break;
							case 3:
								$image_rotate = 180;
								$image_config['rotation_angle'] = $image_rotate;
							break;
							case 6:
								$image_rotate = 270;
								$image_config['rotation_angle'] = $image_rotate;
							break;
						}
					}
				}
				$rotate_data['image_rotate'][$i]=$image_rotate;

				ini_set("memory_limit" , '512M');
			}
		}

		for ($i=0; $i < count($data) ; $i++) {
			//파일 압축
			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = $data[$i]['full_path'];
			$image_config['new_image'] = $file_path.$data[$i]['file_name'];
			$image_config['maintain_ratio'] = TRUE;
			$image_config['width'] = 1024;
			//$image_config['height'] = $data['image_height']/1.8;
			if (empty($rotate_data['image_rotate'][$i])) {
				$image_config['rotation_angle'] = 360;
			}else {
				$image_config['rotation_angle'] = $rotate_data['image_rotate'][$i];
			}

			$image_config['quality'] = "75%";
			$this->load->library('image_lib');
			$this->image_lib->initialize($image_config);
			$this->image_lib->resize();
			$this->image_lib->rotate();

			$fileData[$i] = array(
				//'orig_name'=>$data['orig_name'],
				//'filename' =>$data['file_name'],
				'image_width' =>$data[$i]['image_width'],
				'image_height' =>$data[$i]['image_height'],
				'orig_name'=>$data[$i]['orig_name'],
				// 'filename' =>$data[$i]['orig_name'],
				// 'file_type'=>$data[$i]['file_type'],
				// 'file_ext' =>$data[$i]['file_ext'],
				// 'path'     =>$file_url.$data[$i]['file_name'],
				'path'      =>$file_url.$data[$i]['file_name'],
			 );

		}
		return $fileData;
		exit;
	}

}
