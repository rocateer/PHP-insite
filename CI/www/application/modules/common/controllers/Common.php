<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('common/model_common');
	}


//메인 카테고리 리스트
	public function keyword_list(){
	//	$auto_yn=($this->input->post("auto_yn", TRUE) != "")	?	$this->_escstr($this->input->post("auto_yn", TRUE)) : "";
	//	$data['auto_yn']=$auto_yn;
		header('Content-Type: application/json');
		$data_array=$this->model_common->keyword_list(); 	//메인 카테고리 리스트
		echo json_encode(array('list_data'=>$data_array));
		exit;
	}

//키워드 리스트
	public function keyword_sub_list(){
		header('Content-Type: application/json');
		$keyword_code=($this->input->post("keyword_code", TRUE) != "")	?	$this->_escstr($this->input->post("keyword_code", TRUE)) : "";
		$auto_yn=($this->input->post("auto_yn", TRUE) != "")	?	$this->_escstr($this->input->post("auto_yn", TRUE)) : "";
		$data['auto_yn']=$auto_yn;
		$data['keyword_code']=$keyword_code;

		$data_array=$this->model_common->keyword_sub_list($data); 	//키워드 리스트

		echo json_encode(array('list_data'=>$data_array));
		exit;
	}


	public function fileUpload(){

		$id=$this->input->get("id",TRUE);
		$device=$this->input->get("device",TRUE);

		$this->load->view('common/view_fileUpload_get',array("id"=>$id,"device"=>$device));
	}

	public function fileUpload_action(){
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

		$id=$this->input->post("id",TRUE);


		$config['upload_path'] = $file_path;
		$config['allowed_types'] = '*';

		$config['max_size']	= '2048';
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;


		$this->load->library('upload', $config);

		if($this->upload->do_upload('file')){


			$data=$this->upload->data();

			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = $data['full_path'];
			$image_config['new_image'] = $file_path.$data['file_name'];
			$image_config['maintain_ratio'] = TRUE;
		//	$image_config['width'] = 320;
		//	$image_config['height'] = 240;
			//$image_config['height'] = $data['image_height']/1.8;
			$image_config['quality'] = "85%";
			$this->load->library('image_lib');
			$this->image_lib->initialize($image_config);
			$this->image_lib->resize();


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
				'id'	   =>$id,
				'device'   =>$device
		   );

			$this->load->view("common/view_fileUpload_success",$fileData);

		}else{

			$error = array('error' => $this->upload->display_errors());
			$this->load->view('common/view_fileUpload_success', $error);
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

			$image_config['quality'] = "85%";
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
