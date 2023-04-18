<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2017-01-15
| Memo :  로그인
|------------------------------------------------------------------------
*/

class Model_login extends MY_Model{

// 로그인 시도
  public function login_action($data){

    $member_id = $data['member_id'];
    $member_pw = $data['member_pw'];

    $sql = "SELECT
              member_idx,
              member_nickname,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              member_img,
              member_join_type
            from tbl_member
            WHERE
              del_yn = 'N'
              AND member_id = FN_AES_ENCRYPT(?)
              AND member_pw = SHA2(?, 512)
    ";

    return $this->query_row($sql,
                              array(
                                $member_id,
                                $member_pw
                              ),$data
                            );
  }

  // 로그인 시도
  public function session_cart_update($data){

    $member_idx = $data['member_idx'];
    $cart_session_id = $data['cart_session_id'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_cart
            SET
              member_idx=?
            where cart_session_id=?

    ";

    return $this->query($sql,
                              array(
                                $member_idx,
                                $cart_session_id
                              ),$data
                            );


    if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		}else {
			$this->db->trans_commit();
			return "1";
		}


  }


// SNS로그인을 위한 ID 체크
  public function join_check($data) {

    $member_email = $data['member_email'];

    $sql = "SELECT
              COUNT(*) as cnt
            FROM
              tbl_member
            WHERE
              member_email = FN_AES_ENCRYPT(?)
            ";

    return $this->query_cnt($sql, array($member_email));
  }

// SNS 로그인 시 회원가입
  public function sns_join($data) {

    $member_email = $data['member_email'];
    $member_name = $data['member_name'];
    $member_join_type = $data['member_join_type'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_member
            (
              member_join_type,
              member_type,
              member_email,
              member_name,
              estimate_alarm,
              notice_alarm,
              subscribe_alarm,
              del_yn,
              ins_date,
              upd_date
            )VALUES (
              ?,
              'M',
              FN_AES_ENCRYPT(?),
              FN_AES_ENCRYPT(?),
              'Y',
              'Y',
              'Y',
              'N',
              NOW(),
              NOW()
            )
            ";

    $this->query($sql,
                  array(
                    $member_join_type,
                    $member_email,
                    $member_name
                  )
                );

    if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "0";
		}else {
			$this->db->trans_commit();
			return "1";
		}
  }

// 페이스북 로그인 시도
  public function facebook_login_action($data) {

    $member_email = $data['member_email'];

    $sql = "SELECT
              member_idx,
              member_nickname,
              FN_AES_DECRYPT(member_email) AS member_email,
              member_img,
              member_site,
              member_join_type
            FROM
              tbl_member
            WHERE
              del_yn = 'N'
              AND member_email = FN_AES_ENCRYPT(?)
            ";

    return $this->query_row($sql,
                              array(
                                $member_email
                              )
                            );
  }

// 카카오 로그인 시도
  public function kakao_login_action($data) {

    $member_email = $data['member_email'];

    $sql = "SELECT
              member_idx,
              member_nickname,
              FN_AES_DECRYPT(member_email) AS member_email,
              member_img,
              member_site,
              member_join_type
            FROM
              tbl_member
            WHERE
              del_yn = 'N'
              AND member_email = FN_AES_ENCRYPT(?)
            ";

    return $this->query_row($sql,
                              array(
                                $member_email
                              )
                            );
  }

// 네이버 로그인 시도
  public function naver_login_action($data) {

    $member_email = $data['member_email'];

    $sql = "SELECT
              member_idx,
              member_nickname,
              FN_AES_DECRYPT(member_email) AS member_email,
              member_img,
              member_site,
              member_join_type
            FROM
              tbl_member
            WHERE
              del_yn = 'N'
              AND member_email = FN_AES_ENCRYPT(?)
            ";

    return $this->query_row($sql,
                              array(
                                $member_email
                              )
                            );
  }





} // 클래스의 끝
?>
