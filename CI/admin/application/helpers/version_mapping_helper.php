<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('mapping')){

  function mapping($str = '' ){

    $CI = get_instance();
    $CI->load->library('session');
    $version_change = $CI->session->userdata('version_change');

    if(isset($_SESSION['version_change'])){
      return $str = $version_change[$str];
    }

    if($_SERVER['REMOTE_ADDR'] == '211.118.222.130'){
      //개발

      $return_arr =  array(
        'calculate' => 'calculate_v_1_0_0', // --------------------- 정산 관리
        'member' => 'member_v_1_0_0', // --------------------------- 회원 관리
        'news' => 'news_v_1_0_0', // ---------------------------  매거진 관리
        'exercise' => 'exercise_v_1_0_0', // ---------------------------  매거진 관리
        'program' => 'program_v_1_0_0', // ---------------------------  매거진 관리
        'product' => 'product_v_1_0_0', // ------------------------- 상품 관리
        'community' => 'community_v_1_0_0', // ------------------------- community
        'product_report' => 'product_report_v_1_0_0', // ------------------------- 신고관리 -> 게시글 신고관리
        'member_report' => 'member_report_v_1_0_0', // ------------------------- 신고관리 -> 사용자 신고관리
        'category_management' => 'category_management_v_1_0_0', // ------------------------- 카테고리 관리
        'board' => 'board_v_1_0_0', // ----------------------------- 자유게시판 관리
        'board_report' => 'board_report_v_1_0_0', // ----------------------------- 자유게시판 관리
        'board_reply_report' => 'board_reply_report_v_1_0_0', // ----------------------------- 자유게시판 관리
        'main_contents' => 'main_contents_v_1_0_0', // ----------- 컨텐츠 관리
        'banner' => 'banner_v_1_0_0', // --------------------------- 배너 관리
        'notice' => 'notice_v_1_0_0', // --------------------------- 공지사항 관리
        'faq' => 'faq_v_1_0_0', // --------------------------------- FAQ 관리
        'qa' => 'qa_v_1_0_0', // ----------------------------------- QA 관리
        'terms' => 'terms_v_1_0_0', // ----------------------------- 약관 관리
        'info' => 'info_v_1_0_0', // ----------------- 안내 관리
        'emails' => 'emails_v_1_0_0', // --------------------------- 이메일
        'smtp_email' => 'smtp_email_v_1_0_0', // --------------------------- SMTP 관리
  		);

    }else{
      //운영
      $return_arr =  array(
        'calculate' => 'calculate_v_1_0_0', // --------------------- 정산 관리
        'member' => 'member_v_1_0_0', // --------------------------- 회원 관리
        'news' => 'news_v_1_0_0', // ---------------------------  매거진 관리
        'exercise' => 'exercise_v_1_0_0', // ---------------------------  매거진 관리
        'program' => 'program_v_1_0_0', // ---------------------------  매거진 관리
        'product' => 'product_v_1_0_0', // ------------------------- 상품 관리
        'community' => 'community_v_1_0_0', // ------------------------- community
        'product_report' => 'product_report_v_1_0_0', // ------------------------- 신고관리 -> 게시글 신고관리
        'member_report' => 'member_report_v_1_0_0', // ------------------------- 신고관리 -> 사용자 신고관리
        'category_management' => 'category_management_v_1_0_0', // ------------------------- 카테고리 관리
        'board' => 'board_v_1_0_0', // ----------------------------- 자유게시판 관리
        'board_report' => 'board_report_v_1_0_0', // ----------------------------- 자유게시판 관리
        'board_reply_report' => 'board_reply_report_v_1_0_0', // ----------------------------- 자유게시판 관리
        'main_contents' => 'main_contents_v_1_0_0', // ----------- 컨텐츠 관리
        'banner' => 'banner_v_1_0_0', // --------------------------- 배너 관리
        'notice' => 'notice_v_1_0_0', // --------------------------- 공지사항 관리
        'faq' => 'faq_v_1_0_0', // --------------------------------- FAQ 관리
        'qa' => 'qa_v_1_0_0', // ----------------------------------- QA 관리
        'terms' => 'terms_v_1_0_0', // ----------------------------- 약관 관리
        'info' => 'info_v_1_0_0', // ----------------- 안내 관리
        'emails' => 'emails_v_1_0_0', // --------------------------- 이메일
        'smtp_email' => 'smtp_email_v_1_0_0', // --------------------------- SMTP 관리
  		);
    }

		return $str = $return_arr[$str];
  }
}
