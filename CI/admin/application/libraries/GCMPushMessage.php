<?php
/*
    Class to send push notifications using Google Cloud Messaging for Android

    Example usage
    -----------------------
    $an = new GCMPushMessage($apiKey);
    $an->setDevices($devices);
    $response = $an->send($message);
    -----------------------

    $apiKey Your GCM api key
    $devices An array or string of registered device tokens
    $message The mesasge you want to push out

    @author Matt Grundy

    Adapted from the code available at:
    http://stackoverflow.com/questions/11242743/gcm-with-php-google-cloud-messaging

*/
class GCMPushMessage {

    var $url = 'https://fcm.googleapis.com/fcm/send';
    // var $url = 'https://android.googleapis.com/gcm/send';
    var $serverApiKey = "";
    var $TITLE ="";

    var $devices = array();


    function setApiKey($apiKeyIn){
        $this->serverApiKey = $apiKeyIn;
    }

    function setDevices($deviceIds){
      /*
      if(is_array($deviceIds)){
         $this->devices = $deviceIds;
      } else {
         $this->devices = array($deviceIds);
      }
      */
      $this->devices = $deviceIds;
      //$this->devices = $deviceIds;
      //echo $deviceIds;

    }

    function send($MESSAGE,$DEVICE_TYPE,$DATA,$TITLE="",$body_loc_key,$body_loc_args,$img_path=""){
        /*
        if(!is_array($this->devices) || count($this->devices) == 0){
            $this->error("No devices set");
        }
        */

      if(strlen($this->serverApiKey) < 8){
          $this->error("Server API Key not set");
      }

      if($DEVICE_TYPE =='A'){
        $fields = array(
           "to"                => $this->devices,
           "content-available" => true,
           "mutable_content"   => true,
           "priority"          => "high",
           "data"              => array('data'=>$DATA,"img_path"=>$img_path,"media_type"=>"image"),
           //"notification"      => array('title'=>$TITLE,'body'=>$MESSAGE,'sound'=>'default','body_loc_key'=>$body_loc_key,'body_loc_args'=>$body_loc_args)
       );

      }else{
         $fields = array(
            "to"                => $this->devices,
            "content-available" => true,
            "mutable_content"   => true,
            "priority"          => "high",
            "data"              => array('data'=>$DATA,"img_path"=>$img_path,"media_type"=>"image"),
            "notification"      => array('title'=>$TITLE,'body'=>$MESSAGE,'sound'=>'default','body_loc_key'=>$body_loc_key,'body_loc_args'=>$body_loc_args)
        );
      }

      $headers = array(
          'Authorization: key=' . $this->serverApiKey,
          'Content-Type: application/json'
      );

      // Open connection
      $ch = curl_init();

      // Set the url, number of POST vars, POST data
      curl_setopt( $ch, CURLOPT_URL, $this->url );
      curl_setopt( $ch, CURLOPT_POST, true );
      curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );


      $result = curl_exec($ch);
      // Close connection
      curl_close($ch);

      return $result;
    }

    function error($msg){
        echo "Android send notification failed with error:";
        echo "\t" . $msg;
        exit(1);
    }
}

?>
