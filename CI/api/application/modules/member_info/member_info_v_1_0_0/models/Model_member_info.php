<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2018-02-11
| Memo : 회원 정보
|------------------------------------------------------------------------
*/
class Model_member_info extends MY_Model
{

//회원 정보 상세 보기
  public function member_info_detail($data) {

    $member_idx = $data['member_idx'];

    $sql = "SELECT
              member_idx,
              member_join_type,
              FN_AES_DECRYPT(member_id) AS member_id,
              FN_AES_DECRYPT(member_nickname) AS member_nickname,
              FN_AES_DECRYPT(member_name) AS member_name,
              FN_AES_DECRYPT(member_phone) AS member_phone,
              FN_AES_DECRYPT(member_birth) AS member_birth,
              member_gender,
              member_img,
              all_alarm_yn
            FROM
            tbl_member
            WHERE
              member_idx = ?
              AND del_yn ='N'
          ";

      return $this->query_row($sql,
                              array(
                              $member_idx
                              ),
                              $data);
  }

//회원 정보 수정
  public function member_info_mod_up($data) {

    $member_idx = $data['member_idx'];
		$member_img = $data['member_img'];
    $member_name = $data['member_name'];
    $member_nickname = $data['member_nickname'];
		$member_phone = $data['member_phone'];
		$member_birth = $data['member_birth'];
		$member_gender = $data['member_gender'];

    $sql = "UPDATE
          	 tbl_member
          	SET
            	member_img = ?,
              member_name = FN_AES_ENCRYPT(?),
              member_nickname = ?,
              member_phone = FN_AES_ENCRYPT(?),
              member_birth = FN_AES_ENCRYPT(?),
              member_gender = ?,
              upd_date = NOW()
          	WHERE
          	 member_idx = ?
          ";

      return $this->query($sql,
                          array(
                          $member_img,
                        	$member_name,
                        	$member_nickname,
                        	$member_phone,
                        	$member_birth,
                        	$member_gender,
                          $member_idx
                          ),
                          $data);
  }

  //프로필 이미지 수정
  public function profile_mod_up($data) {

		$member_idx = $data['member_idx'];
		$member_img = $data['member_img'];

    $sql = "UPDATE
          	 tbl_member
          	SET
              member_img = ?,
              upd_date = NOW()
          	WHERE
          	 member_idx = ?
          ";

      return $this->query($sql,
                          array(
                          $member_img,
                          $member_idx
                          ),
                          $data);
  }
}
?>
