<?php defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('mapping')) {

  function mapping($str = '')
  {

    $CI = get_instance();
    $CI->load->library('session');
    $version_change = $CI->session->userdata('version_change');

    if (isset($_SESSION['version_change'])) {
      return $str = $version_change[$str];
    }

    if ($_SERVER['REMOTE_ADDR'] == '211.118.222.130') {
      //개발

      $return_arr =  array(
        'guide' => 'guide_v_1_0_0', // ------------------------------- guide
        'main' => 'main_v_0_0_0', // ------------------------------- 홈
        'community' => 'community_v_0_0_0', // ------------------------------- 커뮤니티
        'profile' => 'profile_v_0_0_0', // ------------------------------- profile
        'alarm' => 'alarm_v_1_0_0', // ------------------------------- alarm
        'join' => 'join_v_1_0_0', // ------------------------------- 가입
        'sns_join' => 'sns_join_v_1_0_0', // ------------------------------- sns가입
        'login' => 'login_v_1_0_0', // ------------------------------- 로그인
        'logout' => 'logout', // ------------------------------- 로그아웃
        'find_id' => 'find_id_v_1_0_0', // ------------------------------- 아이디찾기
        'find_pw' => 'find_pw_v_1_0_0', // ------------------------------- 비밀번호찾기
        'search' => 'search_v_0_0_0', // ------------------------------- search
        'notice' => 'notice_v_1_0_0', // ------------------------------- 공지
        'faq' => 'faq_v_1_0_0', // ------------------------------- faq
        'qa' => 'qa_v_1_0_0', // ------------------------------- qa
        'member_pw_change' => 'member_pw_change_v_1_0_0', // ------------------------------- member_pw_change
        'terms' => 'terms_v_1_0_0', // ------------------------------- 이용약관
        'mypage' => 'mypage_v_0_0_0', // ------------------------------- 마이페이지
        'member_info' => 'member_info_v_0_0_0', // ------------------------------- 회원정보수정
        'setting' => 'setting_v_1_0_0', // ------------------------------- 알림세팅
        'member_out' => 'member_out_v_1_0_0', // ------------------------------- 회원탈퇴
        'my_scrap' => 'my_scrap_v_0_0_0', // ------------------------------- 커뮤니티
        'my_community' => 'my_community_v_0_0_0', // ------------------------------- 스크랩
        'my_recruit' => 'my_recruit_v_0_0_0', // ------------------------------- 나의 구인구직
        'my_order' => 'my_order_v_0_0_0', // ------------------------------- 나의 신청
        'board' => 'board_v_1_0_0', // ------------------------------- 커뮤니티
        'trade' => 'trade_v_0_0_0', // ------------------------------- 중고거래
        'recruit' => 'recruit_v_0_0_0', // ------------------------------- 구인구직
        'product' => 'product_v_0_0_0', // ------------------------------- product
        'edu' => 'edu_v_0_0_0', // ------------------------------- 교육
        'certification' => 'certification_v_0_0_0', // ------------------------------- 인증
      );
    } else {
      //운영
      $return_arr =  array(
        'guide' => 'guide_v_1_0_0', // ------------------------------- guide
        'main' => 'main_v_0_0_0', // ------------------------------- 홈
        'community' => 'community_v_0_0_0', // ------------------------------- 커뮤니티
        'profile' => 'profile_v_0_0_0', // ------------------------------- profile
        'alarm' => 'alarm_v_1_0_0', // ------------------------------- alarm
        'join' => 'join_v_1_0_0', // ------------------------------- 가입
        'sns_join' => 'sns_join_v_1_0_0', // ------------------------------- 가입
        'login' => 'login_v_1_0_0', // ------------------------------- 로그인
        'logout' => 'logout', // ------------------------------- 로그아웃
        'find_id' => 'find_id_v_1_0_0', // ------------------------------- 아이디찾기
        'find_pw' => 'find_pw_v_1_0_0', // ------------------------------- 비밀번호찾기
        'search' => 'search_v_0_0_0', // ------------------------------- search
        'notice' => 'notice_v_1_0_0', // ------------------------------- 공지
        'faq' => 'faq_v_1_0_0', // ------------------------------- faq
        'qa' => 'qa_v_1_0_0', // ------------------------------- qa
        'member_pw_change' => 'member_pw_change_v_1_0_0', // ------------------------------- member_pw_change
        'terms' => 'terms_v_1_0_0', // ------------------------------- 이용약관
        'mypage' => 'mypage_v_0_0_0', // ------------------------------- 마이페이지
        'member_info' => 'member_info_v_0_0_0', // ------------------------------- 회원정보수정
        'setting' => 'setting_v_1_0_0', // ------------------------------- 알림세팅
        'member_out' => 'member_out_v_1_0_0', // ------------------------------- 회원탈퇴
        'my_scrap' => 'my_scrap_v_0_0_0', // ------------------------------- 커뮤니티
        'my_community' => 'my_community_v_0_0_0', // ------------------------------- 스크랩
        'my_recruit' => 'my_recruit_v_0_0_0', // ------------------------------- 나의 구인구직
        'my_order' => 'my_order_v_0_0_0', // ------------------------------- 나의 신청
        'board' => 'board_v_1_0_0', // ------------------------------- 커뮤니티
        'trade' => 'trade_v_0_0_0', // ------------------------------- 중고거래
        'recruit' => 'recruit_v_0_0_0', // ------------------------------- 구인구직
        'product' => 'product_v_0_0_0', // ------------------------------- product
        'edu' => 'edu_v_0_0_0', // ------------------------------- 교육
        'certification' => 'certification_v_0_0_0', // ------------------------------- 인증
      );
    }

    return $str = $return_arr[$str];
  }
}
