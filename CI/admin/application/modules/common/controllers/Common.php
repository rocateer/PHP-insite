<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author : 박수인	
| Create-Date : 2023-04-19
| Memo : 공통모듈
|------------------------------------------------------------------------
*/

class Common extends MY_Controller {

	/* 생성자 영역 */
	function __construct(){
		parent::__construct();

		/* Library */
		$this->load->library('phpexcel');

		/* model */
		$this->load->model('common/model_common');

	}
	
	//선호지역 리스트 불러오기 
	public function region_list(){
		$city_name = $this->_input_check("city_name",array());

		$data['city_name'] = $city_name;

		$region_list = $this->model_common->region_list($data);

		echo json_encode($region_list);
	}

	// 주소 좌표 변환
	public function addr_to_coordinate(){

		$addr=($this->input->post("addr", TRUE) != "")	?	$this->_escstr($this->input->post("addr", TRUE)) : "";

		$url="https://apis.daum.net/local/geo/addr2coord?apikey=463c1243eb5acb83e3f746e9d28971e9&q=".urlencode($addr)."&output=json";

    $headers = array(
        'Content-Type: application/json'
    );

    // Open connection
    $ch = curl_init();

    // Set the url, number of POST vars, POST data
    curl_setopt( $ch, CURLOPT_URL, $url );

    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    // Execute post
    $result =	json_decode(curl_exec($ch));

    // Close connection
    curl_close($ch);

		$response = new stdClass;
		$response->code = "1000";
		$response->code_msg = "정상";
		$response->lng = $result->channel->item[0]->lng;
		$response->lat = $result->channel->item[0]->lat;

		echo json_encode($response);
		exit;
	}


	public function fileUpload(){
		$id     = $this->input->get("id",TRUE);
		$device = $this->input->get("device",TRUE);

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
		$config['max_size']	= 0;
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;

		$this->load->library('upload', $config);

		if($this->upload->do_upload('file')){


			$data=$this->upload->data();

			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = $data['full_path'];
			$image_config['new_image'] = $file_path.$data['file_name'];
			$image_config['maintain_ratio'] = TRUE;
			$image_config['width'] = 2000;
			$image_config['quality'] = "85%";

			if($device =="main"){
				$image_config['width'] = $data['image_width'];
				$image_config['height'] = $data['image_height'];
				$image_config['quality'] = "100%";
			}

			//$image_config['height'] = $data['image_height']/1.8;

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


	// 엑셀 업로드
	public function excel_upload(){
		$idx=($this->input->GET("idx", TRUE) != "")	?	$this->_escstr($this->input->GET("idx", TRUE)) : "";
		$url=($this->input->GET("url", TRUE) != "")	?	$this->_escstr($this->input->GET("url", TRUE)) : "";

		// $url = "/common/db_data_excel";

		$this->load->view('common/view_excelUpload_get',array("url"=>$url,"idx"=>$idx));

	}

	// 엑셀 업로드
	public function excel_upload_action() {

		date_default_timezone_set('Asia/Seoul');

		if(!is_dir("./media/upload/")){
			@mkdir("./media/upload/",0777);
		}
		if(!is_dir("./media/upload/excel/")){
			@mkdir("./media/upload/excel/",0777);
		}
		if(!is_dir("./media/upload/excel/".date("Ym")."/")){
			@mkdir("./media/upload/excel/".date("Ym")."/",0777);
		}
		if(!is_dir("./media/upload/excel/".date("Ym")."/".date("d")."/")){
			@mkdir("./media/upload/excel/".date("Ym")."/".date("d")."/",0777);
		}
		//$file_path=DIR_BASE."/media/commonfile/".date("Ym")."/".date("d")."/";
		$file_path=ABS_PATH."/media/upload/excel/".date("Ym")."/".date("d")."/";
		$file_url="/media/upload/excel/".date("Ym")."/".date("d")."/";

		//echo $file_path;

		$config['upload_path'] = $file_path;
		$config['max_size']	= '1000';
		$config['encrypt_name']  = 'true';
		$config['remove_spaces']  = 'true';
		$config['allowed_types'] = '*';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('file')){

			$data=$this->upload->data();

			// echo $data['file_ext'];
			// exit;
			$list = array(
				'orig_name'=>$data['orig_name'],
				'filename' =>$data['file_name'],
				'file_type'=>$data['file_type'],
				'file_ext' =>$data['file_ext'],
				'path'     =>$file_url.$data['file_name'],
				'path2'    =>$file_path,
				'url'      =>$file_url.$data['file_name'],
			 );

			$filecode=$file_url.$data['file_name'];

			$data1['filecode'] = $filecode;
			$data1['list'] = $list;
			$data1['filecode'] = $filecode;

			return json_encode($list);

		}else{
			$error = array('error' => $this->upload->display_errors());
			return json_encode($error);
			//$this->load->view('common/view_excelUpload_success', array("result"=>'1'));
		}
	}


	public function db_data_excel() {
  	header("Content-type: text/html; charset=utf-8");

	  $project_idx=($this->input->post("idx", TRUE) != "")	?	$this->_escstr($this->input->post("idx", TRUE)) : "";

    $data['project_idx'] = $project_idx;
		$data["admin_id"] = $this->admin_id;

		//
    // if($product_idx == "") {
		// 	$this->global_function->_alert("상품 키가 존재 하지 않습니다.");
		// 	exit;
    // }

	  //$common  = new Common();

  	$list = $this->excel_upload_action();

    $list = json_decode($list);
    $filecode = $list->url;

		$objPHPExcel = PHPExcel_IOFactory::load('..'.$filecode);


		$cnt=0;
		for($z=0;$z<1;$z++){
			$objPHPExcel->setActiveSheetIndex($z);

			$objWorksheet = $objPHPExcel->getActiveSheet();
			$rowIterator = $objWorksheet->getRowIterator();

			$i=0;
			$excel_data=array(); // 모든 데이터가 담긴다.
			foreach($rowIterator as $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false);

				$k=0;
				foreach ($cellIterator as $cell){
						$excel_data[$i][$k]=$cell->getValue();
				$k++;
				}
				$i++;
			}

      $data['excel_data'] = $excel_data;
			//
			// if($product_idx != $excel_data[1][0]) {
			// 	$this->global_function->_alert("상품 키가 일치 하지 않습니다.");
			// 	exit;
      // }

			$del_tables_list = $this->model_standard->del_tables_list($data); //삭제할 테이블 데이터리스트

			$data['del_tables_list'] = $del_tables_list;

      if(count($excel_data) > 0) {
        $this->model_standard->project_data_excel($data); //insert모델로 보내기
      }

			$cnt++;

		}


		$this->load->view('common/view_excelUpload_success', array("result"=>"0")); // result-> 0 정상

	}


	public function lang_data_excel() {
  	header("Content-type: text/html; charset=utf-8");

  	$list = $this->excel_upload_action();

    $list = json_decode($list);
    $filecode = $list->url;

		$objPHPExcel = PHPExcel_IOFactory::load('..'.$filecode);


		$cnt=0;
		for($z=0;$z<1;$z++){
			$objPHPExcel->setActiveSheetIndex($z);

			$objWorksheet = $objPHPExcel->getActiveSheet();
			$rowIterator = $objWorksheet->getRowIterator();

			$i=0;
			$excel_data=array(); // 모든 데이터가 담긴다.
			foreach($rowIterator as $row) {
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false);

				$k=0;
				foreach ($cellIterator as $cell){
					$excel_data[$i][$k]=$cell->getValue();
					$k++;
				}
				$i++;
			}

			$cnt++;

		}

		$lang = $excel_data[0][1];
		// $this->global_function->_alert($lang);

		$this->_list_view("hidden/view_text_form", array("result"=>$excel_data));

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
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']	= 0;
		$config['encrypt_name']  = true;
		$config['remove_spaces']  = true;

		$aee = $this->load->library('upload', $config);

		$files_count = count($files['name']);

		if ($files_count == "0") {
			$response = new stdClass;
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
					$exif = @exif_read_data($_FILES['userfile']['tmp_name']);
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

				ini_set("memory_limit" , '12800M');
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
				$image_config['rotation_angle'] = -360;
			}else {
				$image_config['rotation_angle'] = $rotate_data['image_rotate'][$i];
			}

			$image_config['quality'] = "70%";
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
				'filename' =>$data[$i]['orig_name'],
				// 'file_type'=>$data[$i]['file_type'],
				// 'file_ext' =>$data[$i]['file_ext'],
				// 'path'     =>$file_url.$data[$i]['file_name'],
				'path'      =>$file_url.$data[$i]['file_name'],
			 );
			
			$data[$i]['img_url']= $file_url.$data[$i]['file_name'];
			 //썸네일
			$thum_file_name = explode(".",$data[$i]['file_name']);
			$thum_file_name = $thum_file_name[0].'_s.'.$thum_file_name[1];
 
			$image_thum_config['image_library'] = 'gd2';
			$image_thum_config['source_image'] = $data[$i]['full_path'];
			$image_thum_config['new_image'] = $file_path.$thum_file_name;
			$image_thum_config['maintain_ratio'] = TRUE;
 
			if($data[$i]['image_width']>200){
					$image_thum_config['width'] = 200;
			}else{
				$image_thum_config['width'] = $data[$i]['image_width'];
			}
 
			$this->load->library('image_lib');
			$this->image_lib->initialize($image_thum_config);
			$this->image_lib->resize(); 
		}
		return $fileData;
		exit;
	}

	public function upload_file_json() {

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
		$config['max_size']	= '10000000';
		$config['encrypt_name']  = TRUE;
		$config['remove_spaces']  = TRUE;
		$this->load->library('upload', $config);

		if($this->upload->do_upload('file')){

			$data=$this->upload->data();

			$image_config['image_library'] = 'gd2';
			$image_config['source_image'] = $data['full_path'];
			$image_config['new_image'] = $file_path.$data['file_name'];
			$image_config['maintain_ratio'] = TRUE;
			$image_config['width'] = 640;
			$image_config['height'] = 420;
			//$image_config['height'] = $data['image_height']/1.8;
			$image_config['quality'] = "70%";
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
			'id'	  =>$id,
			'device'   =>$device
			  );
			echo json_encode($fileData);
			exit;

		}else{
			$error = array('error' => $this->upload->display_errors());
			echo json_encode($error);
			exit;
		}
	}

}
