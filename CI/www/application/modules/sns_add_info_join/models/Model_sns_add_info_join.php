<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-04-23
| Memo : sns 추가 정보 기입 후 가입
|------------------------------------------------------------------------
*/

class Model_sns_add_info_join extends MY_Model{

// SNS로그인을 위한 ID 체크
  public function sns_login_action($data) {

    $member_id=$data['member_email'];
    $member_join_type = $data['member_join_type'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id,
              member_master_code,
							FN_AES_DECRYPT(member_name) AS member_name,
							del_yn
						FROM
							tbl_member
						WHERE
							FN_AES_DECRYPT(member_id) = ?
							AND del_yn='N'
							AND member_join_type=?
		       ";

		return $this->query_row($sql, array($member_id, $member_join_type));
  }

  // SNS로그인을 위한 ID 체크
  public function join_check($data) {

    $member_email     = $data['member_email'];
    $member_join_type = $data['member_join_type'];

    $sql = "SELECT
              COUNT(*) as cnt

            FROM
              tbl_member

            WHERE
              member_id = FN_AES_ENCRYPT(?)
              AND member_join_type = ?
              AND del_yn = 'N'
            ";

    return $this->query_cnt($sql
                               ,array(
                                      $member_email,
                                      $member_join_type
                                    )
                                  );
  }

  // 첫 SNS 로그인 시 회원가입
  public function sns_join($data) {

    $member_id = $data['member_email'];
    $member_name = $data['member_name'];
    $member_join_type = $data['member_join_type'];
    $member_phone  = $data['member_phone'];
    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_member
            (
              member_id,
              member_name,
              member_phone,
              member_join_type,
              member_master_code,
              del_yn,
              ins_date,
              upd_date

            )VALUES (
              FN_AES_ENCRYPT(?),
              FN_AES_ENCRYPT(?),
              FN_AES_ENCRYPT(?),
              ?,
              'MT01',
              'N',
              NOW(),
              NOW()
            )
            ";

    $this->query($sql
                      ,array(
                              $member_id,
                              $member_name,
                              $member_phone,
                              $member_join_type
                            )
                          );

    if($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return "-1";
		}else {
			$this->db->trans_commit();
			return "1000";
		}
  }

  // SNS 로그인 : Facebook
  public function facebook_login_action($data) {

    $member_email = $data['member_email'];

    $sql = "SELECT
              member_idx,
              member_nickname,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              member_img,
              member_join_type

            FROM
              tbl_member

            WHERE
              del_yn = 'N'
              AND member_id = FN_AES_ENCRYPT(?)
              AND member_join_type = 'F'
            ";

    return $this->query_row($sql
                                ,array(
                                        $member_email
                                      )
                                    );
  }

  // SNS 로그인 : kakao
  public function kakao_login_action($data) {

    $member_email = $data['member_email'];

    $sql = "SELECT
              member_idx,
              member_nickname,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              member_img,
              member_join_type

            FROM
              tbl_member

            WHERE
              del_yn = 'N'
              AND member_id = FN_AES_ENCRYPT(?)
              AND member_join_type = 'K'
            ";

    return $this->query_row($sql
                                ,array(
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
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_name) AS member_name,
              member_img,
              member_join_type

            FROM
              tbl_member

            WHERE
              del_yn = 'N'
              AND member_id = FN_AES_ENCRYPT(?)
              AND member_join_type = 'N'
            ";

    return $this->query_row($sql
                                ,array(
                                       $member_email
                                     )
                                   );
  }



}// 클래스의 끝
?>
