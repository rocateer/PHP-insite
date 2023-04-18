<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  function __construct(){
    parent::__construct();

    /* Helper */
    $this->load->helper('url');
    $this->load->helper('empty_message');

    /* Library */
		$this->load->library('global_function');
    $this->load->library('global_msg');
    $this->load->library('session');
		$this->load->library('email');
    $this->load->library('Phpmailer');
    $this->load->library('Smtp');
    $this->load->library('GCMPushMessage');

    /* Model */
		$this->load->model('gcm/model_gcm');

		$seg1 = $this->uri->segment(1);
		$seg2 = $this->uri->segment(2);
		$seg3 = $this->uri->segment(3);

		$version_manage = array(
			"v1",
			"v2"
		);

    $ver_check = false;

    for($i=0; $i<count($version_manage); $i++){
      if($version_manage[$i] == $seg1){
        $ver_check = true;
      }
    }

    // if(!$ver_check){
		// 	redirect("http://".$_SERVER["HTTP_HOST"]."/v1/".$seg1."/".$seg2);
		// 	exit;
    // }

    $this->member_idx = $this->session->userdata("member_idx");
    $this->member_email = $this->session->userdata("member_email");
    $this->member_name = $this->session->userdata("member_name");
    $this->login_date = $this->session->userdata("login_date");
  }

  //기본 화면 세팅
  function _view($view, $array=""){
    $this->load->view("common/inc/header");
    $this->load->view($view, $array);
    $this->load->view("common/inc/footer");
  }

  //리스트 불러올때 화면 세팅
  function _list_view($view, $array=""){
    $this->load->view($view, $array);
  }

  //웹뷰용 화면 세팅
  function _webview($view, $array=""){
    $this->load->view($view, $array);
  }

  //엔터리인 제거
  function _escstr($str){
    $str=str_replace("\r\n","",$str);
    return trim($str);
  }

  // 알림 등록
  function _alarm_action($member_idx,$index,$alarm_data) {
   //$sgcm = new GCMPushMessage();
   //$sgcm->setApiKey(GCM_KEY_1);

   $data['member_idx']=$member_idx;
   $data['index']=$index;

   $member_search  = $this->model_gcm->member_search($data);//회원정보 가져오기

   foreach($member_search as $row){
     $data['member_idx'] = $row->member_idx;
     $data['gcm_key'] = $row->gcm_key;
     $data['device_os'] = $row->device_os;

     switch ($index) {
       case '100' : $title ='이성에게 높은 평가를 받았습니다.';$msg ='프로필을 확인하고 마음을 전해 보세요.';$alarm_yn=$row->high_rate_alarm_yn;  $data['partner_member_idx']=$alarm_data['partner_member_idx'];break;
			 case '101' : $title =$alarm_data['member_nickname'].'님이 호감을 보냈습니다.';$msg ='호감을 수락하면 서로 대화를 나누실 수 있습니다.';$alarm_yn=$row->like_alarm_yn;$data['partner_member_idx']=$alarm_data['partner_member_idx']; break;
			 case '102' : $title ='축하합니다! '.$alarm_data['member_nickname'].'님이 호감을 수락하였습니다.';$msg ='이제 서로 일대일 대화를 나눠 보세요~'; $alarm_yn=$row->like_alarm_yn;$data['partner_member_idx']=$alarm_data['partner_member_idx'];break;

			 case '103' : $title =$alarm_data['member_nickname'].'님이 회원님의 포토에 댓글을 남겼습니다.';$msg ='"'.$alarm_data['title'].'"'; $alarm_yn=$row->reply_alarm_yn; $data['board_idx']=$alarm_data['board_idx']; break;
			 case '104' : $title =$alarm_data['member_nickname'].'님이 포토에서 회원님의 댓글에 답글을 남겼습니다.';$msg ='"'.$alarm_data['title'].'"';$alarm_yn=$row->reply_alarm_yn; $data['board_idx']=$alarm_data['board_idx']; break;
			 case '105' : $title =$alarm_data['member_nickname'].'님이 포토에서 회원님의 답글에 답글을 남겼습니다.';$msg ='"'.$alarm_data['title'].'"';$alarm_yn=$row->reply_alarm_yn;  $data['board_idx']=$alarm_data['board_idx'];break;

			 case '106' : $title ='회원님이 작성한 자유톡 게시글에 댓글이 달렸습니다.';$msg ='"'.$alarm_data['title'].'"';$alarm_yn=$row->reply_alarm_yn; $data['board_idx']=$alarm_data['board_idx']; break;
			 case '107' : $title ='자유톡의 "'.$alarm_data['title'].'"' ;$msg = '글에서 회원이 남긴 댓글에 답글이 달렸습니다.'; $alarm_yn=$row->reply_alarm_yn; $data['board_idx']=$alarm_data['board_idx']; break;
			 case '108' : $title ='자유톡의 "'.$alarm_data['title'].'"'  ;$msg = '글에서 회원이 남긴 답글에 답글이 달렸습니다.';$alarm_yn=$row->reply_alarm_yn; $data['board_idx']=$alarm_data['board_idx'];  break;

			 case '109' : $title =$alarm_data['category_name'].' 벙개 참석신청이 수락되었습니다.';$msg ='벙개 등록자와 대화를 나눠 보세요.';$alarm_yn=$row->chat_alarm_yn; break;
			 case '110' : $title ='벙개 참석 신청';$msg =$alarm_data['member_nickname'].'님이 회원님의 벙개에 참석신청을 했습니다.';$alarm_yn=$row->chat_alarm_yn; break;
			 case '111' : $title ='벙개 신청 거절';$msg =$alarm_data['category_name'].' 벙개 참석 신청이 거절되었으며, 보석 일부가 환급되었습니다.';$alarm_yn=$row->chat_alarm_yn; break;

       case '112' : $title ='가입 승인 요청이 반려 되었습니다.';$msg ='인증 또는 프로필 사진을 수정 바랍니다.'; $alarm_yn='Y';break;
       case '113' : $title ='가입이 승인되었습니다.';$msg ='노블클럽에 오신것을 환영합니다.';$alarm_yn='Y'; break;
       case '114' : $title ='인증 반려!';$msg ='프로필 사진 변경이 반려 되었습니다.';$msg ='반려 사유를 확인 하시고 프로필을 다시 변경해주세요.';$alarm_yn='Y'; break;
       case '115' : $title ='프로필 사진 승인';$msg ='프로필 사진 변경이 승인 되었습니다.'; $alarm_yn='Y';break;
       case '116' : $title ='직장 인증 승인';$msg ='직장 신규 인증이 승인되어 일대일 대화 이용권이 지급되었습니다.';$alarm_yn=$row->free_ticket_alarm_yn; break;
       case '117' : $title ='학교 인증 승인';$msg ='학교 신규 인증이 승인되어 일대일 대화 이용권이 지급되었습니다.';$alarm_yn=$row->free_ticket_alarm_yn;break;
       case '118' : $title ='인증 승인!';$msg ='인증 변경이 승인되었습니다.';$alarm_yn='Y'; break;
       case '119' : $title ='인증 반려!';$msg ='인증 변경이 반려되었습니다.';$alarm_yn='Y'; break;
       case '120' : $title ='답변 알림';$msg ='회원님께서 남기신 문의에 대한 답변이 도착했습니다.';$alarm_yn='Y'; break;
       case '121' : $title ='친구 초대 가입';$msg ='초대받은 친구가 가입이 승인되어 회원님께 일대일 대화 이용권이 지급 되었습니다.'; $alarm_yn=$row->free_ticket_alarm_yn; break;

       case '900' : $title ='채팅 대화 알림';$msg =$alarm_data['member_nickname'].'님의 새로운 메시지가 도착하였습니다.'; $alarm_yn=$row->chat_alarm_yn;$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
       case '901' : $title ='벙개 대화 알림';$msg =$alarm_data['member_nickname'].'님의 새로운 메시지가 도착하였습니다.'; $alarm_yn=$row->chat_alarm_yn;$data['chatting_room_idx']=$alarm_data['chatting_room_idx']; break;
     }

     $data['title']=  $title;
     $data['msg']=  $msg;
     $data["index"] =$index;
     $body_loc_key = $index;
     $body_loc_args =[""];

    if($row->deactivated_yn=="Y"){
      $data["alarm_yn"] ="N";
    }else{
      $data["alarm_yn"] =$alarm_yn;
      $this->model_gcm->member_gcm_in($data); //회원 gcm 입력
    }

     //$this->model_gcm->member_gcm_in($data); //회원 gcm 입력

     // if($data['gcm_key']){
     //   if($alarm_yn=="Y"){
     //     $sgcm->setDevices($data['gcm_key']);
     //     $response = $sgcm->send($data['msg'],$data['device_os'],$data,"",$body_loc_key,$body_loc_args,"");
     //   }
     // }
   }
  }

  // 알림 등록
  function _smtp_action($member_idx,$index,$smtp_data) {

    $data['member_idx']=$member_idx;
    $data['corp_idx']=$smtp_data['corp_idx'];
    $data['index']=$index;
    $data['smtp_host'] = SMTP_HOST;
    $data['smtp_user'] = SMTP_USER;
    $data['smtp_pass'] = SMTP_PASS;
    $data['smtp_port'] = SMTP_PORT;
    $data['from_email'] = FROM_EMAIL;
    $data['from_name'] = FROM_NAME;

    $member_search  = $this->model_gcm->smtp_member_search($data);//회원정보 가져오기

    foreach($member_search as $row){

      switch ($index) {
       case '101' : $subject = '비밀번호 변경 메일입니다.'; break;
      }

      $data['subject'] = $subject;
      $data['to_email'] = $row->to_email;
      $data['member_name'] = $row->member_name; // data에 저장했다가 메일 발송 시 사용

      $result = $this->model_gcm->smtp_member_gcm_in($data); //회원 gcm 입력

      $response = new stdClass;

      if($result == '0'){
  			$response->code = "-1";
  			$response->code_msg = "정보를 불러오지 못했습니다. 다시 한번 시도해주세요.";

        echo json_encode($response);
        exit;
  		}

    }
  }

  // 웹뷰에서 메일 보내기
  function _web_sendmail($to,$subject,$message,$from_email="",$from_name=""){

    $config = array();
    $config['useragent'] = 'CodeIgniter';
    $config['mailpath']  = '/usr/sbin/sendmail';
    $config['protocol']  = 'smtp';
    $config['smtp_host'] = SMTP_HOST;
    $config['smtp_user'] = SMTP_USER;
    $config['smtp_pass'] = SMTP_PASS;
    $config['smtp_port'] = SMTP_PORT;
    $config['smtp_crypto'] = 'ssl';
    $config['mailtype'] = 'html';
    $config['charset'] = 'utf-8';
    $config['newline'] = "\r\n";
    $config['wordwrap'] = TRUE;



    $this->email->initialize($config);
    $this->email->clear(TRUE);
    if($from_email ==""){
      $this->email->from(FROM_EMAIL, FROM_NAME);
    }else{
      $this->email->from($from_email, $from_name);
    }
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message($message);

    $result=$this->email->send(FALSE);

    $aaaa = $this->email->print_debugger(array('headers', 'subject', 'body'));
    var_dump($aaaa);
    exit;
    return $result;
  }

  // API에서 메일 보내기
  function _smtp_sendmail($to,$subject,$message){
		header('Content-Type: application/json');

		$config = array();
		$config['useragent']           = 'CodeIgniter';
		$config['mailpath']            = '/usr/sbin/sendmail';
		$config['protocol']            = 'IMAP';
		$config['smtp_host']           = 'imap.gmail.com';
		$config['smtp_user']           = 'nesh@rocateer.com';
		$config['smtp_pass']           = '@^djffpdl6';
		$config['smtp_port']           = '993';
		$config['mailtype'] = 'html';
		$config['charset']  = 'utf-8';
		$config['newline']  = "\r\n";
		$config['wordwrap'] = TRUE;

		$this->email->initialize($config);

		$this->email->from('nesh@rocateer.com' , '임시메일');
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		if(!$this->email->send()){

      $response = new stdClass;
      $response->code = "-1"; //실패
      $response->code_msg = "메일 전송에 실패 하였습니다.";

      echo json_encode($response);
      exit;
    }else{
      $response = new stdClass;
      $response->code = "1000"; //성공
      $response->code_msg = "성공";

      echo json_encode($response);
      exit;
    }
	}

  /*
	- PHPMailer, SMTP 라이브러리 로드 후 사용
	- sendMail(발신자주소, 발신자이름, 제목, 내용, 수신자주소, 수신자이름)
		(string, string, string, string, string, string)
	*/
	function _sendMail($EMAIL, $NAME, $SUBJECT, $CONTENT, $MAILTO, $MAILTONAME) {
    $mail             = new PHPMailer();
    $body             = $CONTENT;

    $mail->IsSMTP(); // telling the class to use SMTP
    //$mail->SMTPDebug  = '';                     	// enables SMTP debug information (for testing)
                                               			// 1 = errors and messages
                                               			// 2 = messages only
    $mail->CharSet    = "utf-8";
    $mail->SMTPAuth   = true;                 			// enable SMTP authentication
    $mail->SMTPSecure = "ssl";                			// sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";     			// sets GMAIL as the SMTP server
    $mail->Port       = 465;                  			// set the SMTP port for the GMAIL server
    $mail->Username   = "sjeong922@rocateer.com";   // GMAIL username
    $mail->Password   = "Subeom09@@";               // GMAIL password
    $mail->SetFrom($EMAIL, $NAME);
    $mail->AddReplyTo($EMAIL, $NAME);
    $mail->Subject    = $SUBJECT;
    $mail->MsgHTML($body);
    $address = $MAILTO;
    $mail->AddAddress($address, $MAILTONAME);

		// 메일 전송 함수
		$result = $mail->Send();
		return $result;
	}

	/*
	- cafe24 SMS 호스팅서비스 모듈
	- cafe24 SMS 호스팅서비스 가입 후 사용
	- 사용 전 가입자 아이디 / 인증키 / 발신번호등록 필수!
	- sendSMS(보낼메시지, 받는사람번호)
		(string, string)
	*/
	function _sendSMS_cafe24($msg, $tel_num){

		$userid = "";	// SMS 아이디
		$passwd = ""; // 인증키

    $msg_byte = $this->global_function->str_to_byte($msg); // B0 A1 (2 bytes)

    if($msg_byte <= 90){
      $smsType ='S';
    }else{
      $smsType ='L';
    }

		$oCurl = curl_init();
		$url =  "https://sslsms.cafe24.com/smsSenderPhone.php";
		$aPostData['userId'] = $userid;
		$aPostData['passwd'] = $passwd;
		curl_setopt($oCurl, CURLOPT_URL, $url);
		curl_setopt($oCurl, CURLOPT_POST, 1);
		curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($oCurl, CURLOPT_POSTFIELDS, $aPostData);
		curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, 0);
		$ret = curl_exec($oCurl);
		$ret = json_decode($ret);
		$sphone = explode('-',$ret->list[0]);

		$sms_url = "https://sslsms.cafe24.com/sms_sender.php";
		$sms['user_id'] = base64_encode($userid);
		$sms['secure'] = base64_encode($passwd);
		$sms['msg'] = base64_encode(stripslashes($msg)); // 보낼 메시지
		$sms['rphone'] = base64_encode($tel_num); // 받는사람 번호
		$sms['sphone1'] = base64_encode($sphone[0]);
		$sms['sphone2'] = base64_encode($sphone[1]);
		$sms['sphone3'] = base64_encode($sphone[2]);
		$sms['mode'] = base64_encode("1");
    $sms['smsType'] = base64_encode($smsType); // LMS일경우 L
		$returnurl = "";
		$host_info = explode("/", $sms_url);
		$host = $host_info[2];
		$path = $host_info[3];
		srand((double)microtime()*1000000);
		$boundary = "---------------------".substr(md5(rand(0,32000)),0,10);
		$header = "POST /".$path ." HTTP/1.0\r\n";
		$header .= "Host: ".$host."\r\n";
		$header .= "Content-type: multipart/form-data, boundary=".$boundary."\r\n";
		$data1 = "";
		foreach($sms AS $index => $value){
			$data1 .="--$boundary\r\n";
			$data1 .= "Content-Disposition: form-data; name=\"".$index."\"\r\n";
			$data1 .= "\r\n".$value."\r\n";
			$data1 .="--$boundary\r\n";
		}
		$header .= "Content-length: " . strlen($data1) . "\r\n\r\n";
		$fp = fsockopen($host, 80);
		fputs($fp, $header.$data1);
		$rsp = '';
		while(!feof($fp)) {
			$rsp .= fgets($fp,8192);
		}
		fclose($fp);
	}


  	// method 타입 자동 구별
  	/*	function _input_check($data, $msg=["빈값체크 메세지", "정규표현식 메세지"], $esc=true, $empty=false, $type="default", $custom = ""){ */
  	function _input_check($key,$data){

  		/*
  		.  ____  .    ____________________________
  		|/      \|   | 유효성검사를 응원합니다.         |
  	 [| ♥    ♥ |]  | ver 0.1                    |
  		|___==___|  /          written by JAZZ.   |
  								 |____________________________|
  			 ---------------------------------------------------------------------------------
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
  			|             price    : 숫자에 3자리 마다 콤마표기
  			|            	default  : default, 검사를 안합니다.
  			| $custom 	: 유효성검사 custom으로 진행 시 받을 값 (정규표현식)
  			|
  			|  !!!. 값이 array형태로 들어올 경우
  			| $this->_input_check("파라미터로 받을 변수명[]");
  			| 형태로 받는다.
  			|_________________________________________________________________________________|
  		*/

  		// 빈값 메시지
  		if(array_key_exists('empty_msg',$data)){
  			$empty_msg = $data['empty_msg'];
  			$empty = TRUE;
  		}else{
  			$empty_msg = "";
  			$empty = FALSE;
  		}
  		// 포커스 ID
  		if(array_key_exists('focus_id',$data)){
  			$focus_id = $data['focus_id'];
  		}else{
  			$focus_id = "";
  		}
  		// 정규식 메시지
  		if(array_key_exists('regular_msg',$data)){
  			$regular_msg = $data['regular_msg'];
  		}else{
  			$regular_msg = "";
  		}
  		// 개행 문자 체크
  		if(array_key_exists('esc',$data)){
  			$esc = $data['esc'];
  		}else{
  			$esc = TRUE;
  		}
  		//정규식 타입
  		if(array_key_exists('type',$data)){
  			$type = $data['type'];
  		}else{
  			$type = "default";
  		}
  		// 정규식 커스텀 체크
  		if(array_key_exists('custom',$data)){
  			$custom = $data['custom'];
  		}else{
  			$custom = "custom";
  		}
  		// 삼항 연산자 체크
  		if(array_key_exists('ternary',$data)){
  			$ternary = $data['ternary'];
  		} else{
  			$ternary = "";
  		}
  	//	$key = $key;

  		# method 확인
  		$key = trim($key);

  		# 1. post 타입인가?
  		$method = "post";
  		$var = $this->input->post($key, true) ? $this->input->post($key, true) : $ternary;

  		if($var == ""){
  			$var = array_key_exists($key,$_POST)? $_POST[$key] : "";
  		}

  		# 2. get 타입인가?
  		if($var == ""){
  			$method = "get";
  			$var = $this->input->get($key, true) ? $this->input->get($key, true) : $ternary;

  			if($var == ""){
  				$var = array_key_exists($key,$_GET)? $_GET[$key] : "";
  			}
  		}



  		/* 보류

  		# 3. 다른 타입인가?
  		if($var == ""){
  			$method = $_SERVER['REQUEST_METHOD'];
  			$method = strtolower($method);

  			$var2 = parse_str(file_get_contents('php://input'), $put);
  			var_dump($var2);
  			exit;


  			$var = array_key_exists($key,$_PUT)? $_PUT[$key] : "";

  			vardump($_PUT);
  		}
  		*/
  		/* 삼항 연산자 체크 */

  		# -. 모두 찾을수 없는가?
  		if($method == ""){
  			$method = "not found";
  			$message = "요청한 method type을 확인하세요.";
  			$var = "찾을수 없습니다.";
  			goto input_echo;
  		}

  		# 개행문자 제거 요청일 시
  		if($esc){
  			$var = str_replace("/\r|\n/","", $var);
  			if(!is_array($var)){
  				$var = trim($var);
  			}
  		}



  		# 빈값 체크를 할 경우
  		if($empty == true){
  			if($var == ""){
  				$message = $empty_msg;
  				goto input_echo;
  			}
  		}else{
  			if(is_array($var) == true){
  				$x = 0;
  				$var_arr = array();

  				foreach ($var as $row) {
  					if($row ==""){
  						$var_arr[$x] = NULL;
  					}else{
  						$var_arr[$x] = $row;
  					}
  					$x++;
  				}

  				$var = $var_arr;
  			}else{
  				if($var == ""){
  					$var = NULL;
  				}
  			}
  		}

  		# 유효성검사 타입 확인
  		$validate_check = true;

  		$type = strtolower($type);
  		switch($type){
  			# 숫자 유효성 검사
  			case "number" :
  				// if(!preg_match("/^\d+$/", $var)){
  				if(!is_numeric($var)){
  					$validate_check = false;
  				}
  				break;

  			# 이메일 양식 유효성 검사
  			case "email" :
  				if(!preg_match("/([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $var)){
  					$validate_check = false;
  				}
  				break;

  			# 비밀번호 양식 유효성 검사
  			case "password" :
  				if(!preg_match("/^.*(?=.{6,12})(?=.*[0-9])(?=.*[a-zA-Z]).*$/", $var)){
  					$validate_check = false;
  				}
  				break;

  			# 전화번호 양식1 : (- 미포함)
  			case "tel1" :
  				break;

  			# 전화번호 양식2 : (- 포함)
  			case "tel2" :
  				break;

  			case "phone":
  				if(!preg_match("/^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/", $var)){
  				$validate_check = false;
  				}
  				break;
  			# 숫자에 3자리 마다 콤마표기
  			case "price":
  				$var = str_replace(',','',$var);
  			break;
  			# custom 요청 일 시.
  			case "custom" :
  				if(!preg_match($custom, $var)){
  					$validate_check = false;
  				}
  				break;

  			case "default" :
  			default :
  				break;

  		}

  		if(!$validate_check){
  			$message = $regular_msg;
  			goto input_echo;
  		}

  		# 모두 통과
  		return $var;

  		# input 검사 실패 시 나오는 메세지. label
  		input_echo:

  		$response['code'] = "-1";
  		$response['code_msg'] = $message;
  		$response['method'] = $method;
  		$response['focus_id'] = $focus_id;
  		$response[$key] = $var;

  		echo json_encode($response);
  		exit;

  	} // end input check

  // 접속 기기 확인
  function _user_agent(){
    $iPod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
    $iPhone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
    $iPad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
    $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
    //file_put_contents('./public/upload/install_log/agent',$_SERVER['HTTP_USER_AGENT']);
    if($iPad||$iPhone||$iPod){
      return 'ios';
    }else if($android){
      return 'android';
    }else{
      return 'pc';
    }
  }
}


?>
