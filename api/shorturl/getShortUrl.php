<?php header("Content-Type:text/html;charset=utf-8");

    //include "Snoopy.class.php";
    
    
    $url=$_REQUEST['url'];
    
  
    
    function file_get_contents_curl($url) {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url); 
      $data = curl_exec($ch);
      curl_close($ch); 
      return $data;
    }
    
    
    $bitly_login = "wildokid";
    $bitly_api_key = "R_b956505c136fc1f64886c5e2515528bb";
    $long_url = $url;
    $bitly_url = "http://api.bit.ly/v3/shorten";
    $request_url = $bitly_url . "?login=" . $bitly_login . "&apiKey=" . $bitly_api_key . "&longUrl=" . urlencode($long_url);
    $response = file_get_contents_curl($request_url);
    $response = json_decode($response);
    $short_url = $response->data->url;
    
    echo($short_url);   
    
?>