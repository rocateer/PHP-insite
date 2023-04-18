<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-24
| Memo : 운동관리
|------------------------------------------------------------------------
*/

Class Model_exercise extends MY_Model{

	// 운동관리 리스트
	public function exercise_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							exercise_idx,
							title,
							display_yn,
							DATE_FORMAT(exercise_time, '%i') AS exercise_min,
							DATE_FORMAT(exercise_time, '%s') AS exercise_sec,
							exercise_time,
							DATE_FORMAT(ins_date, '%Y-%m-%d') AS ins_date
						FROM
							tbl_exercise
						WHERE
							del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND title LIKE '%$title%' ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND display_yn = '$display_yn' ";
		}

		$sql .= " ORDER BY ins_date DESC LIMIT ?, ?";

  	return  $this->query_result($sql,
																array(
																$page_no,
																$page_size
																),
																$data
																);
	}

	// 운동관리 카운트
  public function exercise_list_count($data){
		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_exercise
						WHERE
							del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND title LIKE '%$title%' ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND display_yn = '$display_yn' ";
		}

  	return  $this->query_cnt($sql,
														array(
														),
														$data
														);
  }

	// 운동관리 상세
	public function exercise_detail($data){

		$exercise_idx = $data['exercise_idx'];

		$sql = "SELECT
							exercise_idx,
							display_yn,
							url_link,
							sports_equipment,
							DATE_FORMAT(exercise_time, '%i') AS exercise_min,
							DATE_FORMAT(exercise_time, '%s') AS exercise_sec,
							exercise_time,
							img_path,
							title,
							ins_date,
							contents
						FROM
							tbl_exercise
						WHERE
							exercise_idx = ?
		";

		return  $this->query_row($sql,
														array(
														$exercise_idx
														),$data
														);
	}
	
	// 운동관리 상태 변경
	public function exercise_state_mod_up($data){

		$exercise_idx  = $data['exercise_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_exercise
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							exercise_idx = ?
						";

		$this->query($sql,array(
								 $display_yn,
								 $exercise_idx
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
	
	// 운동관리 등록하기
	public function exercise_reg_in($data){
		$title = $data['title'];
		$img_path = $data['img_path'];
		$contents = $data['contents'];
		$url_link = $data['url_link'];
		$sports_equipment = $data['sports_equipment'];
		$exercise_time = $data['exercise_time'];
		
		$this->db->trans_begin();
		
		$sql = "INSERT INTO
							tbl_exercise
							(			
								title,
								img_path,
								url_link,
								sports_equipment,
								exercise_time,
								contents,
								display_yn,
								ins_date,
								upd_date,
								del_yn
							)
						VALUES
							(
								?,
								?,
								?,
								?,
								?,
								?,
								'Y',
								NOW(),
								NOW(),
								'N'
							)							
		";
		
		$this->query($sql,
								array(
								$title,
								$img_path,
								$url_link,
								$sports_equipment,
								$exercise_time,
								$contents
								),
								$data
							);
							
		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}
	
	// 운동관리 수정
	public function exercise_mod_up($data){
		$exercise_idx = $data['exercise_idx'];
		$title = $data['title'];
		$img_path = $data['img_path'];
		$contents = $data['contents'];
		$url_link = $data['url_link'];
		$sports_equipment = $data['sports_equipment'];
		$exercise_time = $data['exercise_time'];
		
		$this->db->trans_begin();
		
		$sql = "UPDATE
							tbl_exercise
						SET
							img_path = ?,
							title = ?,
							contents = ?,
							url_link = ?,
							sports_equipment = ?,
							exercise_time = ?,
							upd_date = NOW()
						WHERE
						 exercise_idx = ?
							";
		
		$this->query($sql,
								array(
								$img_path,
								$title,
								$contents,
								$url_link,
								$sports_equipment,
								$exercise_time,
								$exercise_idx
								),
								$data
							);
							
		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}

	// 운동관리 삭제
	public function exercise_del($data){

		$exercise_idx = $data['exercise_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_exercise
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							exercise_idx IN ($exercise_idx)
						";

		$this->query($sql,array(),$data);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
		  return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
	}

}	// 클래스의 끝

?>
