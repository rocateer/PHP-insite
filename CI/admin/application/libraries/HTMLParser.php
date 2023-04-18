<?php
/**
* @file HTMLParser.php
*
* @class HTMLParser
*
* @bref 웹사이트의 소스를 파싱하여 결과를 돌려줌
*
* @date 2014.01.23
*
* @author 너구리안주(impactlife@naver.com)
*
* @section MODIFYINFO
*     - 2014.05.20 - 기존은 지정된 행과 열의 결과만 추출하게 했는데 이제 그냥 다 저장한다
*
*/

class HTMLParser{

    private $url;
    private $refer;
    private $patterns;
    private $buffer;
    private $http_code;
    private $cookie_file;

    /**
    * @bref 생성자
    **/
    public function __construct(){
        $this->patterns = array();
        $this->buffer = '';
        $this->http_code = 0;
        $this->cookie_file = 'cookie.txt';
    }

    /**
    * @bref url 세팅
    * @param string URL
    **/
    public function setUrl($url){
        $this->url = $url;
    }

    /**
    * @bref 2014.01.28 추가 - REFERER 세팅 : refer없으면 내용이 안나오는 사이트가 있음
    * @param string URL
    **/
    public function setRefer($refer){
        $this->refer = $refer;
    }

    /**
    * @bref 패턴과 파싱결과의 row, col 세팅
    * @param string 패턴
    **/
    public function addPattern($pattern){
        $this->patterns[] = $pattern;
    }

    /**
    * @bref 쿠키파일을 지정한다
    * @param string
    **/
    public function setCookieFile($filepath){
        $this->cookie_file = $filepath;
    }

    /**
    * @bref 지정한 url의 컨텐츠를 불러들인다
    **/
    private function loadContent(){

        //$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)';
        $agent = 'Mozilla/5.0 (Windows NT 6.1; rv:26.0) Gecko/20100101 Firefox/26.0';
        $curlsession = curl_init();
        curl_setopt ($curlsession, CURLOPT_URL,            $this->url);
        curl_setopt ($curlsession, CURLOPT_HEADER,          1);

        //http 응답코드가 302일때 redirect_url 로 따라감
        curl_setopt ($curlsession, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt ($curlsession, CURLOPT_RETURNTRANSFER,  true);

        curl_setopt ($curlsession, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt ($curlsession, CURLOPT_SSLVERSION,4);

        curl_setopt ($curlsession, CURLOPT_POST,            0);
        curl_setopt ($curlsession, CURLOPT_USERAGENT,      $agent);
        curl_setopt ($curlsession, CURLOPT_REFERER,        $this->refer);
        curl_setopt ($curlsession, CURLOPT_TIMEOUT,        30000);
        curl_setopt ($curlsession, CURLOPT_COOKIEJAR, $this->cookie_file);
        curl_setopt ($curlsession, CURLOPT_COOKIEFILE, $this->cookie_file);

        $this->buffer = curl_exec ($curlsession);
        $cinfo = curl_getinfo($curlsession);

        $this->http_code = $cinfo['http_code'];
        curl_close($curlsession);

        if ($this->http_code != 200) {
            $this->buffer = '';
        }
    }

    /**
    * @bref 결과를 리턴한다
    * @return array 모든 결과가 담긴 배열
    **/
    public function getResult(){

        $result = array();

        $this->loadContent();

        foreach($this->patterns as $item){
            $result[] = $this->getParseResult($item);
        }

        return $result;
    }

    /**
    * @bref 파싱
    * @param string 패턴
    * @return array 하나의 정규식에 대한 파싱 결과가 담긴 배열
    **/
    private function getParseResult($pattern){
        $result = array();
        preg_match_all($pattern, $this->buffer, $matches);

        //첫번째 요소는 날린다
        if(count($matches) > 0)    array_splice($matches, 0, 1);

        return $matches;
    }
}
?>
