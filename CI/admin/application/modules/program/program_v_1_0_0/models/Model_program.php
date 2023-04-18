<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2021-11-24
| Memo : 운동관리
|------------------------------------------------------------------------
*/

Class Model_program extends MY_Model{

	// 운동관리 리스트
	public function category_list(){

		$sql = "SELECT
							a.category_management_idx,
							a.category_name
						FROM
							tbl_category_management as a
						WHERE
							a.del_yn = 'N'
							and type=0
    ";

		$sql .= " ORDER BY a.order_no ASC";

  	return  $this->query_result($sql,
																array(
															
																)
																);
	}

	public function exercise_list(){

		$sql = "SELECT
							a.exercise_idx,
							a.title
						FROM
							tbl_exercise as a
						WHERE
							a.del_yn = 'N'
    ";

		$sql .= " ORDER BY a.title ASC";

  	return  $this->query_result($sql,
																array(
															
																)
																);
	}

	// 운동관리 리스트
	public function program_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$category_management_idx = $data['category_management_idx'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							a.program_idx,
							a.title,
							a.category_management_idx,
							b.category_name,
							a.display_yn,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS ins_date
						FROM
							tbl_program as a
							JOIN tbl_category_management as b ON a.category_management_idx=b.category_management_idx
						WHERE
							a.del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND a.title LIKE '%$title%' ";
    }
    if($category_management_idx != ""){
      $sql .= " AND a.category_management_idx = $category_management_idx ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(a.ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(a.ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}

		$sql .= " ORDER BY a.ins_date DESC LIMIT ?, ?";

  	return  $this->query_result($sql,
																array(
																$page_no,
																$page_size
																),
																$data
																);
	}

	// 운동관리 카운트
  public function program_list_count($data){
		$title = $data['title'];
		$display_yn = $data['display_yn'];
		$category_management_idx = $data['category_management_idx'];
		$s_date = $data['s_date'];
		$e_date = $data['e_date'];

		$sql = "SELECT
							COUNT(1) AS cnt
						FROM
							tbl_program as a
							JOIN tbl_category_management as b ON a.category_management_idx=b.category_management_idx
						WHERE
							a.del_yn = 'N'
    ";

    if($title != ""){
      $sql .= " AND a.title LIKE '%$title%' ";
    }
    if($category_management_idx != ""){
      $sql .= " AND a.category_management_idx = $category_management_idx ";
    }
		if($s_date != ""){
			$sql .= " AND DATE(a.ins_date) >= '$s_date' ";
		}
		if($e_date != ""){
			$sql .= " AND DATE(a.ins_date) <= '$e_date' ";
		}
		if($display_yn != ""){
			$sql .= " AND a.display_yn = '$display_yn' ";
		}

  	return  $this->query_cnt($sql,
														array(
														),
														$data
														);
  }

	// 운동관리 상세
	public function program_detail($data){

		$program_idx = $data['program_idx'];

		$sql = "SELECT
							program_idx, 
							category_management_idx, 
							level, 
							title, 
							contents, 
							img_path, 
							url_link,
							DATE_FORMAT(exercise_time, '%i') AS exercise_min,
							DATE_FORMAT(exercise_time, '%s') AS exercise_sec,
							exercise_time, 
							display_yn, 
							view_cnt, 
							like_cnt, 
							del_yn, 
							ins_date, 
							upd_date
						FROM
							tbl_program
						WHERE
							program_idx = ?
		";

		return  $this->query_row($sql,
														array(
														$program_idx
														),$data
														);
	}
	
	// 운동관리 상태 변경
	public function program_state_mod_up($data){

		$program_idx  = $data['program_idx'];
		$display_yn = $data['display_yn'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_program
						SET
							display_yn = ?,
							upd_date = NOW()
						WHERE
							program_idx = ?
						";

		$this->query($sql,array(
								 $display_yn,
								 $program_idx
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

	// 운동관리 리스트
	public function program_reg_list_get($data){
		$program_idx = $data['program_idx'];

		$sql = "SELECT
							a.program_exercise_idx,
							a.program_idx,
							a.exercise_idx,
							b.title,
							DATE_FORMAT(b.exercise_time, '%i') AS exercise_min,
							DATE_FORMAT(b.exercise_time, '%s') AS exercise_sec,
							b.exercise_time,
							DATE_FORMAT(a.ins_date, '%Y-%m-%d') AS ins_date
						FROM
							tbl_program_exercise as a
							JOIN tbl_exercise as b on b.exercise_idx=a.exercise_idx and b.del_yn='N'
						WHERE
							a.del_yn = 'N'
							and a.program_idx=$program_idx
    ";

		$sql .= " ORDER BY a.ins_date ASC";

  	return  $this->query_result($sql,
																array(
																),
																$data
																);
	}

	
	// 운동 등록하기
	public function exercise_reg($data){
		$program_idx = $data['program_idx'];
		$exercise_idx = $data['exercise_idx'];
		
		$this->db->trans_begin();
		
		$sql = "INSERT INTO
							tbl_program_exercise
							(			
								program_idx,
								exercise_idx,
								ins_date,
								upd_date,
								del_yn
							)
						VALUES
							(
								?,
								?,
								NOW(),
								NOW(),
								'N'
							)							
		";
		
		$this->query($sql,
								array(
								$program_idx,
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

			$program_exercise_idx = $data['program_exercise_idx'];
	
			$this->db->trans_begin();
	
			$sql = "UPDATE
								tbl_program_exercise
							SET
								del_yn = 'Y',
								upd_date = NOW()
							WHERE
								program_exercise_idx = $program_exercise_idx
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

	// 운동관리 등록하기
	public function program_reg_in($data){
		$title = $data['title'];
		$img_path = $data['img_path'];
		$url_link = $data['url_link'];
		$contents = $data['contents'];
		$category_management_idx = $data['category_management_idx'];
		$level = $data['level'];
		$exercise_time = $data['exercise_time'];
		$temporary_idx = $data['temporary_idx'];
		
		$this->db->trans_begin();
		
		$sql = "INSERT INTO
							tbl_program
							(			
								category_management_idx,
								level,
								title,
								img_path,
								url_link,
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
								?,
								'Y',
								NOW(),
								NOW(),
								'N'
							)							
		";
		
		$this->query($sql,
								array(
								$category_management_idx,
								$level,
								$title,
								$img_path,
								$url_link,
								$exercise_time,
								$contents
								),
								$data
							);

		$program_idx = $this->db->insert_id();

		$sql = "UPDATE
								tbl_program_exercise
							SET
								program_idx = $program_idx,
								upd_date = NOW()
							WHERE
								program_idx = $temporary_idx
							";
	
		$this->query($sql,array(),$data);
							
		if($this->db->trans_status() === FALSE) {
      $this->db->trans_rollback();
      return "0";
    } else {
      $this->db->trans_commit();
      return "1";
    }
	}
	
	// 운동관리 수정
	public function program_mod_up($data){
		$program_idx = $data['program_idx'];
		$title = $data['title'];
		$img_path = $data['img_path'];
		$contents = $data['contents'];
		$category_management_idx = $data['category_management_idx'];
		$level = $data['level'];
		$exercise_time = $data['exercise_time'];
		$url_link = $data['url_link'];
		
		$this->db->trans_begin();
		
		$sql = "UPDATE
							tbl_program
						SET
							img_path = ?,
							title = ?,
							contents = ?,
							category_management_idx = ?,
							level = ?,
							exercise_time = ?,
							url_link = ?,
							upd_date = NOW()
						WHERE
							program_idx = ?
							";
		
		$this->query($sql,
								array(
								$img_path,
								$title,
								$contents,
								$category_management_idx,
								$level,
								$exercise_time,
								$url_link,
								$program_idx
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
	public function program_del($data){

		$program_idx = $data['program_idx'];

		$this->db->trans_begin();

		$sql = "UPDATE
							tbl_program
						SET
							del_yn = 'Y',
							upd_date = NOW()
						WHERE
							program_idx =$program_idx
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
