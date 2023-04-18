<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김민정
| Create-Date : 2018-11-22
| Memo : 알람
|------------------------------------------------------------------------
*/

Class Model_alarm extends MY_Model {

  // 알림 리스트
  public function alarm_list_get($data){

    $member_idx = $data['member_idx'];
    $page_size = (int)$data['page_size'];
    $page_no = (int)$data['page_no'];

		$sql = "SELECT
              alarm_idx,
              member_idx,
              msg,
              data,
              read_yn,
              del_yn,
              ins_date,
              upd_date
            FROM
              tbl_alarm
            WHERE
              member_idx = ?
              AND del_yn = 'N'
	          ";

    $sql .= "	ORDER BY ins_date DESC LIMIT ?,? ";

		return $this->query_result($sql,
                              array(
                              $member_idx,
                              $page_no,
                              $page_size
                              ),$data
                              );
  }

  // 알림 리스트 카운트
	public function alarm_list_count($data){

    $member_idx = (int)$data['member_idx'];

		$sql = "SELECT
            	count(*) as cnt
            FROM
            	tbl_alarm
            WHERE
            	del_yn = 'N'
              AND member_idx = ?
				  ";

		return $this->query_cnt($sql,array($member_idx),$data);

	}

  // 알림 읽음 상태변경 -> 전부 변경
	public function alarm_all_del($data){

	  $member_idx = (int)$data['member_idx'];

	  $this->db->trans_begin();

		$sql = "UPDATE
	          	tbl_alarm
	          SET
	          	del_yn = 'Y',
	          	upd_date =NOW()
	          WHERE
							member_idx = ?
	        	";


	  $this->query($sql,
                array(
                $member_idx
                ),$data
                );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}

	}

  // 알림 리스트 총 카운트
	public function new_alarm_count($data){

    $member_idx = (int)$data['member_idx'];

		$sql = "SELECT
            	count(*) as cnt
            FROM
            	tbl_alarm
            WHERE
            	del_yn = 'N'
            	AND read_yn = 'N'
              AND member_idx = ?
	          ";

		return $this->query_cnt($sql,array($member_idx));
	}

  // 알람 설정보기
  public function alarm_toggle_view($data){

    $member_idx = (int)$data['member_idx'];

      $sql = "SELECT
                alarm_yn
              FROM
                tbl_member
              WHERE
                member_idx = ?
              ";

    return $this->query_row($sql,
                            array(
                            $member_idx,
                            ),$data
                            );
	}

  // 알림 설정
  public function alarm_toggle($data){

    $member_idx = (int)$data['member_idx'];
    $alarm_yn = $data['alarm_yn'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
  					SET
              alarm_yn='$alarm_yn',
              upd_date = NOW()
  				  WHERE
  					  member_idx = ?
		";

    $this->query($sql,
                array(
                $member_idx
                ),$data
                );

    if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}

  }

  // 알림 삭제
	public function alarm_del($data){

	  $alarm_idx = (int)$data['alarm_idx'];

	  $this->db->trans_begin();

		$sql = "UPDATE
	          	tbl_alarm
	          SET
	          	del_yn = 'Y',
	          	upd_date =NOW()
	          WHERE
							alarm_idx = ?
	        	";

	  $this->query($sql,
                array(
                $alarm_idx
                ),$data
                );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}


}
?>
