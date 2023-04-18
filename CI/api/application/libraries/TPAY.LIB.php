<?
function encoding($s1, $s2, $arr) { // 인코딩변환
	while (list($key, $val) = each($arr)) {
		$arr[$key] = iconv($s1, $s2, $val);
	}
}

class ResultConfirm{
	static function send($tid, $result){
		$url = 'https://webtx.tpay.co.kr/resultConfirm';

		/*
		$data = http_build_query(array('tid'=>$tid, 'result'=>$result));

		$options = array(
			'http'=>array(
				'header'=>"Content-type:application/x-www-form-urlencoded\r\n"."Content-Length:".strlen($data)."\r\n",
				'method'=>'POST',
				'content'=>$data
			)
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		*/

		$param = array(
			"tid" => $tid,
			"result" => $result
		);

		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

		$contents = curl_exec($ch);
		curl_close($ch);

		return $result;
	}
}

class Encryptor{
	var $encKey;
	var $merchantKey;
	var $ediDate;

	var $key;
	var $iv;

	function Encryptor(){
		$arguments = func_get_args();
		$numberOfParameters = func_num_args();
		$constructorName = 'Encryptor' . $numberOfParameters;
		if (method_exists($this, $constructorName)) {
			call_user_func_array(array($this, $constructorName), $arguments);
		}
		else
		{
			throw new Exception('No constructor defined with ' . $numberOfParameters . ' arguments.');
		}
	}

	function Encryptor1($merchantKey){
		$this->merchantKey = $merchantKey;
		$this->ediDate = strftime('%Y%m%d%H%M%S');
		$this->encKey = md5($this->ediDate.$merchantKey);

		$this->key = $this->hex2bin($this->encKey);
		$this->iv = $this->hex2bin($this->strToHex(substr($this->merchantKey,0,16)));
	}

	function Encryptor2($merchantKey, $ediDate){
		$this->merchantKey = $merchantKey;
		$this->ediDate = $ediDate;
		$this->encKey = md5($this->ediDate.$merchantKey);

		$this->key = $this->hex2bin($this->encKey);
		$this->iv = $this->hex2bin($this->strToHex(substr($this->merchantKey,0,16)));
	}

	function Encryptor3($mid, $merchantKey, $amt){
		$this->merchantKey = $merchantKey;
		$this->ediDate = strftime('%Y%m%d%H%M%S');
		$this->encKey = md5($this->ediDate.$mid.$merchantKey.$amt);

		$this->key =  $this->hex2bin($this->encKey);
		$this->iv = $this->hex2bin($this->strToHex(substr($this->merchantKey,0,16)));
	}

	function Encryptor4($mid, $merchantKey, $amt, $ediDate){
		$this->merchantKey = $merchantKey;
		$this->ediDate = $ediDate;
		$this->encKey = md5($this->ediDate.$mid.$merchantKey.$amt);

		$this->key = $this->hex2bin($this->encKey);
		$this->iv = $this->hex2bin($this->strToHex(substr($this->merchantKey,0,16)));
	}

	function strToHex($string){
		$hex='';
		for ($i=0; $i < strlen($string); $i++){
			$hex .= dechex(ord($string[$i]));
		}
		return $hex;
	}

	function hexToStr($hex){
		$string='';
		for ($i=0; $i < strlen($hex)-1; $i+=2){
			$string .= chr(hexdec($hex[$i].$hex[$i+1]));
		}
		return $string;
	}

	function hex2bin($hexdata) {
			$bindata="";
			for ($i=0;$i<strlen($hexdata);$i+=2) {
					$bindata.=chr(hexdec(substr($hexdata,$i,2)));
			}
			return $bindata;
	}

	function toPkcs7 ($value){
			if ( is_null ($value) ){
					$value = "" ;
			}
			$padSize = 16 - (strlen ($value) % 16) ;
			return $value . str_repeat (chr ($padSize), $padSize) ;
	}

	function fromPkcs7 ($value){
			$valueLen = strlen ($value) ;
			if ( $valueLen % 16 > 0 ){
					$value = "";
			}
			$padSize = ord ($value{$valueLen - 1}) ;
			if ( ($padSize < 1) or ($padSize > 16) ){
					$value = "";
			}
			// Check padding.
			for ($i = 0; $i < $padSize; $i++){
					if ( ord ($value{$valueLen - $i - 1}) != $padSize ){
							$value = "";
					}
			}

			return substr ($value, 0, $valueLen - $padSize) ;
	}

	function encrypt ($key, $iv, $value){
			if ( is_null ($value) ){
					$value = "" ;
			}
			$value = $this->toPkcs7 ($value) ;

			$output = mcrypt_encrypt (MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_CBC, $iv) ;
			return base64_encode ($output) ;
	}

	function decrypt ($key, $iv, $value){
			if ( is_null ($value) ){
				$value = "" ;
			}
			$value = base64_decode ($value) ;
			$output = mcrypt_decrypt (MCRYPT_RIJNDAEL_128, $key, $value, MCRYPT_MODE_CBC, $iv) ;
			return $this->fromPkcs7 ($output) ;
	}

	function encData($data){
		$encryptedData = $this->encrypt ($this->key, $this->iv, $data);
		return $encryptedData;
	}

	function decData($data){
		$decryptedData = $this->decrypt ($this->key, $this->iv, $data);
		return $decryptedData;
	}


	function getEdiDate(){
		return $this->ediDate;
	}

	function getVBankExpDate(){
		return date("Ymd", strtotime('+1 day'));
	}

}

?>
