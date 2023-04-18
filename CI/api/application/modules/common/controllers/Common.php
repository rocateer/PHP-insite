<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 로켓티어
| Create-Date : 2018-06-15
| Memo : 공통모듈
|------------------------------------------------------------------------
*/
class Common extends MY_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('common/model_common');
	}

	//파일 업로드(기타파일)
	public function fileUpload_action_file(){
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
		$config['allowed_types'] = 'wav|mp3';
		$config['max_size']	= '3000';
		$config['encrypt_name']  = 'true';
		$config['remove_spaces']  = 'true';

		$aee = $this->load->library('upload', $config);

		if($this->upload->do_upload('file') ){
			$data=$this->upload->data();

			//파일 압축
			// $image_config['image_library'] = 'gd2';
			// $image_config['source_image'] = $data['full_path'];
			// $image_config['new_image'] = $file_path.$data['file_name'];
			// $image_config['maintain_ratio'] = TRUE;
			//$image_config['width'] = 640;
			//$image_config['height'] = $data['image_height']/1.8;
			// $image_config['quality'] = "85%";
			// $this->load->library('image_lib');
			// 	$this->image_lib->initialize($image_config);
			// $this->image_lib->resize();

			$fileData = array(
				//'orig_name'=>$data['orig_name'],
				//'filename' =>$data['file_name'],
				'img_width' =>$data['image_width'],
				'img_height' =>$data['image_height'],
				'orig_name'=>$data['orig_name'],
				'filename' =>$data['file_name'],
				'file_type'=>$data['file_type'],
				'file_ext' =>$data['file_ext'],
				'path'     =>$file_url.$data['file_name'],
				'url'      =>$file_url.$data['file_name'],
		   );

			$data['img_url']= $file_url.$data['file_name'];
		  //$result=$this->model_common->temp_img_in($data); //이미지 임시 저장

			$response = new stdClass;
			$response->code = "1000"; //성공
			$response->code_msg = "성공";
			$response->file_path = $file_url.$data['file_name'];
			// $response->img_width = $fileData['image_width'];
			// $response->img_height = $fileData['image_height'];
			echo json_encode($response);
			exit;

		}else{
			$error = array('error' => $this->upload->display_errors());
			$response->error = $error ;

			echo json_encode(	$response);
			exit;
		}

	}

	//파일 업로드(이미지)::api
	public function fileUpload_action(){
		header('Content-Type: application/json');

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

			// if($data['image_width'] > 500 || $data['image_width'] > $img_resize ){
			// 	if($img_resize == NULL){
			// 		$image_config['width'] = 500;
			// 	}else{
			// 		$image_config['width'] = $img_resize;
			// 	}
			// }
			//$image_config['height'] = $data['image_height']/1.8;

			if (empty($image_rotate)) {
				$image_config['rotation_angle'] = -360;
			}else {
				$image_config['rotation_angle'] = $image_rotate;
			}
			$image_config['quality'] = "85%";
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
 				$image_thum_config['width'] = 200;
			}else{
				$image_thum_config['width'] = $data[$i]['image_width'];
			}

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

			$error = array('error' => $this->upload->display_errors());
			$response->error = $error ;
			log_message('error'," img_error_msg : '.$error \r\n' ");

			echo json_encode(	$response);
			exit;
		}

	}

	//파일 업로드(이미지)
	// public function fileUpload_action(){
	// 	date_default_timezone_set('Asia/Seoul');
	// 	ini_set("memory_limit" , -1);
	//
	// 	if(!is_dir("./media/commonfile/")){
	// 		mkdir("./media/commonfile/",0777);
	// 	}
	// 	if(!is_dir("./media/commonfile/".date("Ym")."/")){
	// 		mkdir("./media/commonfile/".date("Ym")."/",0777);
	// 	}
	// 	if(!is_dir("./media/commonfile/".date("Ym")."/".date("d")."/")){
	// 		mkdir("./media/commonfile/".date("Ym")."/".date("d")."/",0777);
	// 	}
	// 	$file_path=ABS_PATH."/media/commonfile/".date("Ym")."/".date("d")."/";
	//
	// 	$file_url="/media/commonfile/".date("Ym")."/".date("d")."/";
	//
	// 	//업로드 파일 제한 조건
	// 	$config['upload_path'] = $file_path;
	// 	$config['allowed_types'] = 'gif|jpg|png|jpeg';
	// 	$config['max_size']	= 0;
	// 	$config['encrypt_name']  = TRUE;
	// 	$config['remove_spaces']  = TRUE;
	//
	// 	$this->load->library('upload', $config);
	//
	// 	if($this->upload->do_upload('file') ){
	// 		$data=$this->upload->data();
	// 		if (@exif_read_data($_FILES['file']['tmp_name'])) {
	// 			// EXIF의 Orientation 데이터가 존재하면 필요에 따라 이미지 파일의 방향을 보정
	// 			$exif = @exif_read_data($_FILES['file']['tmp_name']);
	//
	// 			if(!empty($exif['Orientation'])) {
	// 				switch($exif['Orientation']) {
	// 					case 8:
	// 						$image_rotate = 90;
	// 						$image_config['rotation_angle'] = $image_rotate;
	// 					break;
	// 					case 3:
	// 						$image_rotate = 180;
	// 						$image_config['rotation_angle'] = $image_rotate;
	// 					break;
	// 					case 6:
	// 						$image_rotate = 270;
	// 						$image_config['rotation_angle'] = $image_rotate;
	// 					break;
	// 			 }
	// 			}
	// 		}
	//
	// 		//파일 압축
	// 		$image_config['image_library'] = 'gd2';
	// 		$image_config['source_image'] = $data['full_path'];
	// 		$image_config['new_image'] = $file_path.$data['file_name'];
	// 		$image_config['maintain_ratio'] = TRUE;
	// 		//$image_config['width'] = 640;
	// 		//$image_config['height'] = $data['image_height']/1.8;
	//
	// 		if (empty($image_rotate)) {
	// 			$image_config['rotation_angle'] = 360;
	// 		}else {
	// 			$image_config['rotation_angle'] = $image_rotate;
	// 		}
	// 		$image_config['quality'] = "85%";
	// 		$this->load->library('image_lib');
	// 		$this->image_lib->initialize($image_config);
	// 		$this->image_lib->resize();
	// 		$this->image_lib->rotate();
	//
	// 		$fileData = array(
	// 			//'orig_name'=>$data['orig_name'],
	// 			//'filename' =>$data['file_name'],
	// 			'image_width' =>$data['image_width'],
	// 			'image_height' =>$data['image_height'],
	// 			'orig_name'=>$data['orig_name'],
	// 			'filename' =>$data['orig_name'],
	// 			'file_type'=>$data['file_type'],
	// 			'file_ext' =>$data['file_ext'],
	// 			'path'     =>$file_url.$data['file_name'],
	// 			'url'      =>$file_url.$data['file_name'],
	// 	   );
	//
	// 		$data['img_url']= $file_url.$data['file_name'];
	//
	// 	  //$result=$this->model_common->temp_img_in($data); //이미지 임시 저장
	// 		ini_set("memory_limit" , '512M');
	//
	// 		$response = new stdClass;
	// 		$response->code = "1000"; //성공
	// 		$response->code_msg = "성공";
	// 		$response->file_path = $file_url.$data['file_name'];
	// 		$response->img_width = $fileData['image_width'];
	// 		$response->img_height = $fileData['image_height'];
	//
	// 		echo json_encode($response);
	// 		exit;
	// 	}else{
	// 		ini_set("memory_limit" , '512M');
	//
	// 		$error = array('error' => $this->upload->display_errors());
	// 		$response->error = $error ;
	// 		log_message('error'," img_error_msg : '.$error \r\n' ");
	//
	// 		echo json_encode(	$response);
	// 		exit;
	// 	}
	//
	// }


	//파일 다중 업로드
	public function multi_fileUpload(){
		header('Content-Type: application/json');

		$i=0;
		$files = array();
		$files_arr = array();

		while (isset($_FILES['file'.$i]) && $_FILES['file'.$i]) {
			$file = $_FILES['file'.$i];
			array_push($files, $file);
			$i++;
		}

		$file_list = $this->multi_fileUpload_action($files);

		echo $file_list;
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

		$this->load->library('upload', $config);

		$files_count = count($files);

		if ($files_count == "0") {
			$response = new stdClass;
			$response->code = "-1"; //성공
			$response->code_msg = "파일이 없습니다";

			echo json_encode(	$response);
			exit;
		}

		// Faking upload calls to $_FILE
		for ($i = 0; $i < $files_count; $i++) {
			ini_set("memory_limit" , -1);
			$_FILES['userfile']['type']     = $files[$i]['type'];
			$_FILES['userfile']['name']     = $files[$i]['name'];
			$_FILES['userfile']['tmp_name'] = $files[$i]['tmp_name'];
			$_FILES['userfile']['error']    = $files[$i]['error'];
			$_FILES['userfile']['size']     = $files[$i]['size'];

			$this->upload->initialize($config);
			if (!$this->upload->do_upload()) {
				$error = array('error' => $this->upload->display_errors());
				$response->error = $error ;
				log_message('error'," img_error_msg :  '$i.' : '.$error \r\n' ");

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

			//파일 압축
			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = $data[$i]['full_path'];
			$image_config['new_image'] = $file_path.$data[$i]['file_name'];
			$image_config['maintain_ratio'] = TRUE;
			//$image_config['width'] = 640;
			//$image_config['height'] = $data['image_height']/1.8;
			if (empty($rotate_data['image_rotate'][$i])) {
				$image_config['rotation_angle'] = 360;
			}else {
				$image_config['rotation_angle'] = $rotate_data['image_rotate'][$i];
			}
			$image_config['quality'] = "85%";
			$this->load->library('image_lib');
			$this->image_lib->initialize($image_config);
			$this->image_lib->resize();
			$this->image_lib->rotate();

			$fileData[$i] = array(
				//'orig_name'=>$data['orig_name'],
				//'filename' =>$data['file_name'],
				'img_width' =>$data[$i]['image_width'],
				'img_height' =>$data[$i]['image_height'],
				// 'orig_name'=>$data[$i]['orig_name'],
				'filename' =>$data[$i]['file_name'],
				// 'file_type'=>$data[$i]['file_type'],
				// 'file_ext' =>$data[$i]['file_ext'],
				// 'path'     =>$file_url.$data[$i]['file_name'],
				'img_path'      =>$file_url.$data[$i]['file_name'],
			 );

		}

		$response = new stdClass;
		$response->code = "1000"; //성공
		$response->code_msg = "성공";
		$response->fileData = $fileData;

		return json_encode($response);
		exit;
	}

 //app 버전 가져오기
	public function app_version(){
		header('Content-Type: application/json');

		$device_os=($this->input->post("device_os", TRUE) != "")	?	$this->_escstr($this->input->post("device_os", TRUE)) : "";

		$data['device_os']=$device_os;

		$result=$this->model_common->app_version($data); 	//app 버전 가져오기

		if(count($result) == 0) {
			$response->code = "-1";
			$response->code_msg = "조회된 데이타가 없습니다.";

			echo json_encode($response);
			exit;
		}else{
			$response = new stdClass;
			$response->code = "1000";
			$response->code_msg = "정상";
			$response->version = $result->version;

			echo json_encode($response);
			exit;
		}
	}

}
