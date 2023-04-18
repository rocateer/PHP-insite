<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김용덕
| Create-Date : 2016-06-23
| Memo : GCM
|------------------------------------------------------------------------
*/

Class Model_gcm extends MY_Model {

  //회원정보 가져오기
  public function member_search($data){
    $index=$data['index'];
    $member_idx=$data['member_idx'];

    if($index =="101" || $index =="102"){
      $sql = "SELECT
                a.member_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                a.all_alarm_yn as alarm_yn,
                a.device_os,
                a.gcm_key
              FROM
                tbl_member a
              WHERE
                a.del_yn='N'
      ";

    }

    if($index =="103"){
      $sql = "SELECT
                a.member_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                a.all_alarm_yn as alarm_yn,
                a.device_os,
                a.gcm_key
              FROM
                tbl_member a
              WHERE
                member_idx  ='$member_idx'
      ";
    }



    return $this->query_result($sql,
                            array(

                            ),$data
                            );
  }



  //회원 gcm 입력
  public function member_gcm_in($data) {
    $member_idx=$data['member_idx'];
    $title=$data['title'];
    $msg=$data['msg'];
    $index=$data['index'];
    $device_os=$data['device_os'];
    $gcm_key=$data['gcm_key'];
    $alarm_yn=$data['alarm_yn'];

    $del_yn =($index>=900)? "Y":"N";

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_alarm
            (
              member_idx,
              `data`,
              title,
              msg,
              `index`,
              device_os,
              gcm_key,
              alarm_yn,
              del_yn,
              send_yn,
              read_yn,
              ins_date,
              upd_date
            )VALUES (
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              'N',
              'N',
              NOW(),
              NOW()
            )
    ";
    $this->query($sql,
                array(
                $member_idx,
                json_encode($data),
                $title,
                $msg,
                $index,
                $device_os,
                $gcm_key,
                $alarm_yn,
                $del_yn,
                ),$data
                );

    $alarm_idx = $this->db-> insert_id() ;

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    }else{
      $this->db->trans_commit();
      return $alarm_idx;
    }
  }


  //smtp 회원정보 가져오기
  public function smtp_member_search($data){
    $index=$data['index'];
    $member_idx=$data['member_idx'];

    if($index =="101" || $index =="102"){
      $sql = "SELECT
                a.member_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name,
                FN_AES_DECRYPT(a.member_email) AS to_email
              FROM
                tbl_member a
              WHERE
                a.del_yn='N'
                AND a.member_idx = '$member_idx'
      ";

    }

    if($index =="103"){
      $sql = "SELECT
                a.member_idx,
                FN_AES_DECRYPT(a.member_name) AS member_name
              FROM
                tbl_member a
              WHERE
                member_idx  ='$member_idx'
      ";
    }



    return $this->query_result($sql,
                            array(

                            ),$data
                            );
  }



  //smtp 회원 gcm 입력
  public function smtp_member_gcm_in($data) {
    $member_idx=$data['member_idx'];
    $corp_idx=$data['corp_idx'];
    $index=$data['index'];
    $smtp_host=$data['smtp_host'];
    $smtp_user=$data['smtp_user'];
    $smtp_pass=$data['smtp_pass'];
    $smtp_port=$data['smtp_port'];
    $from_email=$data['from_email'];
    $from_name=$data['from_name'];
    $subject=$data['subject'];
    $to_email=$data['to_email'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_smtp
            (
              member_idx,
              corp_idx,
              `index`,
              `data`,
              smtp_host,
              smtp_user,
              smtp_pass,
              smtp_port,
              from_email,
              from_name,
              subject,
              to_email,
              send_yn,
              del_yn,
              ins_date,
              upd_date
            )VALUES (
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              ?,
              'N',
              'N',
              NOW(),
              NOW()
            )
    ";
    $this->query($sql,
                array(
                $member_idx,
                $corp_idx,
                $index,
                json_encode($data),
                $smtp_host,
                $smtp_user,
                $smtp_pass,
                $smtp_port,
                $from_email,
                $from_name,
                $subject,
                $to_email
                ),$data
                );

    $smtp_idx = $this->db-> insert_id() ;

    if($this->db->trans_status() === FALSE){
      $this->db->trans_rollback();
      return "0";
    }else{
      $this->db->trans_commit();
      return $smtp_idx;
    }
  }


}

?>
