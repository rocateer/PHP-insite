<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-11-07
| Memo : 처음시작
|------------------------------------------------------------------------
*/

class Go_url extends MY_Controller {
  function __construct(){
    parent::__construct();

  }

  public function index(){
    $index = $this->_input_check("index",array());
    $qa_idx = $this->_input_check("qa_idx",array());
    $board_idx = $this->_input_check("board_idx",array());
    $member_idx = $this->_input_check("member_idx",array());

    $go_url ="/";
    switch($index){

      case "101": $go_url="/".mapping('community')."/community_detail?board_idx=".$board_idx;break;
      case "102": $go_url="/".mapping('community')."/community_detail?board_idx=".$board_idx;break;
      case "103": $go_url="/".mapping('main');break;
      case "104": $go_url="/".mapping('main');break;
      case "105": $go_url="/".mapping('qa')."/qa_detail?qa_idx=".$qa_idx;break;
    }

    redirect($go_url);
  }



}// 클래스의 끝
?>
