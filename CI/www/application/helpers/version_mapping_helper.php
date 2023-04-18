<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('mapping')){

  function mapping($str = '' ){

    $CI = get_instance();
    $CI->load->library('session');
    $version_change = $CI->session->userdata('version_change');

    if(isset($_SESSION['version_change'])){
      return $str = $version_change[$str];
    }

    if(strpos($_SERVER['REMOTE_ADDR'],'211.118.222.133')!== false){
      //개발

      $return_arr =  array(
        'main' => 'main_v_0_0_0', // ------------------------------- 대시보드
        'login' => 'login_v_0_0_0', // ------------------------------- login
        'find_pw' => 'find_pw_v_0_0_0', // --------------------------- find_pw
        'find_id' => 'find_id_v_0_0_0', // --------------------------- find_id
        'join' => 'join_v_0_0_0', // --------------------------- join
        'order' => 'order_v_0_0_0', // --------------------------- order
        'corp' => 'corp_v_0_0_0', // --------------------------- corp
        'board' => 'board_v_0_0_0', // --------------------------- board
        'mypage' => 'mypage_v_0_0_0', // --------------------------- mypage
        'member_info' => 'member_info_v_0_0_0', // --------------------------- member_info
        'notice' => 'notice_v_0_0_0', // --------------------------- 공지사항 관리
        'faq' => 'faq_v_0_0_0', // --------------------------------- FAQ 관리
        'qa' => 'qa_v_0_0_0', // ----------------------------------- QA 관리
        'terms' => 'terms_v_0_0_0', // ----------------------------- 약관 관리
  		);

    }else{
      //운영
      $return_arr =  array(
        'main' => 'main_v_0_0_0', // ------------------------------- 대시보드
        'login' => 'login_v_0_0_0', // ------------------------------- login
        'find_pw' => 'find_pw_v_0_0_0', // --------------------------- find_pw
        'find_id' => 'find_id_v_0_0_0', // --------------------------- find_id
        'join' => 'join_v_0_0_0', // --------------------------- join
        'order' => 'order_v_0_0_0', // --------------------------- order
        'corp' => 'corp_v_0_0_0', // --------------------------- corp
        'board' => 'board_v_0_0_0', // --------------------------- board
        'mypage' => 'mypage_v_0_0_0', // --------------------------- mypage
        'member_info' => 'member_info_v_0_0_0', // --------------------------- member_info
        'notice' => 'notice_v_0_0_0', // --------------------------- 공지사항 관리
        'faq' => 'faq_v_0_0_0', // --------------------------------- FAQ 관리
        'qa' => 'qa_v_0_0_0', // ----------------------------------- QA 관리
        'terms' => 'terms_v_0_0_0', // ----------------------------- 약관 관리
  		);
    }

		return $str = $return_arr[$str];
  }
}
