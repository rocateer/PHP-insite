<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
| Memo : 알람
|------------------------------------------------------------------------
*/

Class Model_alarm extends MY_Model {

  // 알림 리스트
  public function alarm_list($data){
    $page_size = (int)$data['page_size'];
    $page_no = (int)$data['page_no'];

    $member_idx = (int)$this->member_idx;

    $this->all_alarm_read_mod_up();

		$sql = "SELECT
              alarm_idx,
              member_idx,
              msg,
              data,
              read_yn,
              del_yn,
              DATE_FORMAT(ins_date,'%Y.%m.%d') as ins_date,
              DATE_FORMAT(ins_date,'%H:%i') as ins_date_hm,
              upd_date
            FROM
              tbl_alarm
            WHERE
              member_idx = ?
              AND del_yn = 'N'
	  ";

    $sql .= "	ORDER BY alarm_idx DESC LIMIT ?,? ";

		return $this->query_result($sql,
                              array(
                              $member_idx,
                              $page_no,
                              $page_size
                              ),$data
                              );
  }

  // 알림 리스트 카운트
	public function alarm_list_count(){

    $member_idx = (int)$this->member_idx;

		$sql = "SELECT
            	count(*) as cnt
            FROM
            	tbl_alarm
            WHERE
            	del_yn = 'N'
              AND member_idx = ?
				  ";

		return $this->query_cnt($sql,array($member_idx));

	}

  // 알림읽음표시
  public function alarm_read_mod_up($data){

    $alarm_idx = (int)$data['alarm_idx'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_alarm
            SET
              read_yn = 'Y',
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

  // 알림읽음표시
  public function all_alarm_read_mod_up(){

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_alarm
            SET
              read_yn = 'Y',
              upd_date =NOW()
            WHERE
              member_idx = ?
              AND read_yn = 'N'
    ";

    $this->query($sql,
                array(
                $this->member_idx
                )
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

  // 전체삭제
	public function all_alarm_del(){

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
                $this->member_idx
                )
                );

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
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
                all_alarm_yn,
                excercise_alarm_yn,
                substr(excercise_alarm_time,1,2) AS alarm_time,
                substr(excercise_alarm_time, 4) AS alarm_min
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
  public function all_alarm_yn_mod_up($data){

    $member_idx = (int)$data['member_idx'];
    $type = $data['type'];
    $alarm_yn = $data['alarm_yn'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
  					SET
              all_alarm_yn=if($type=0,'$alarm_yn',all_alarm_yn),
              excercise_alarm_yn=if($type=1,'$alarm_yn',excercise_alarm_yn),
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
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}

  }

  // 알림 설정
  public function alarm_reg_in($data){

    $member_idx = (int)$data['member_idx'];
    $excercise_alarm_time = $data['excercise_alarm_time'];

    $this->db->trans_begin();

    $sql = "UPDATE
              tbl_member
  					SET
            excercise_alarm_time=?,
              upd_date = NOW()
  				  WHERE
  					  member_idx = ?
		";

    $this->query($sql,
                array(
                $excercise_alarm_time,
                $member_idx
                ),$data
                );

    if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}

  }


}
?>
