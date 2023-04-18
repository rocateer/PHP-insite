<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-02-17
| Memo : cron
|------------------------------------------------------------------------
*/
class Cron extends MY_Controller {

  function __construct(){
    parent::__construct();

    $this->load->model('cron/model_cron');

  }

  //1분클론
  // * * * * * /usr/bin/curl --silent --compressed pw.evescore.com/cron/minute_cron
  public function minute_cron(){
    $this->model_cron->minute_cron();
  }

  //6시 클론
  // 0 6 * * * /usr/bin/curl --silent --compressed pw.evescore.com/cron/hour_cron
  public function hour_cron(){
    $this->model_cron->hour_cron();
  }
  
  
  //매일자정시
  // 0 0 * * * /usr/bin/curl --silent --compressed pw.evescore.com/cron/day_cron
  public function day_cron(){
    $this->model_cron->day_cron();
  }

  //5초마다 실행
  /*
  * * * * * /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 5; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 10; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 15; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 20; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 25; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 30; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 35; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 40; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 45; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 50; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  * * * * * sleep 55; /usr/bin/curl --silent --compressed pw.evescore.com/cron/alarm_send
  */
  public function alarm_send(){
    $this->model_cron->alarm_send();
  }

}
