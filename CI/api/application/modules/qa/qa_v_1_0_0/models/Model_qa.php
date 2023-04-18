<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	김옥훈
| Create-Date : 2019-06-10
| Memo : QA
|------------------------------------------------------------------------
*/

Class Model_qa extends MY_Model {

	// QA 리스트
	public function qa_list($data){
		$member_idx=$data['member_idx'];
		$page_size=(int)$data['page_size'];
		$page_no=(int)$data['page_no'];

		$sql = "SELECT
							qa_idx,
							qa_title,
							reply_yn,
							ins_date
						FROM
							tbl_qa
						WHERE
							del_yn='N'
							AND member_idx=?
						";

		$sql.=" ORDER BY ins_date DESC";

		$sql.="	limit ?,? ";

		return $this->query_result($sql,
															array(
															$member_idx,
															$page_no,
															$page_size
															),
															$data
															);
	}

	// QA 리스트 카운트
	public function qa_list_count($data){
		$member_idx=$data['member_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
							tbl_qa
						WHERE
							del_yn='N'
							AND member_idx=?
		";
		
		return $this->query_cnt($sql,
														array(
														$member_idx,
														),
														$data
														);
	}

	// QA 상세 보기
  public function qa_detail($data){
    $qa_idx=$data['qa_idx'];

    $sql = "SELECT
							qa_idx,
							qa_title,
							qa_contents,
							reply_yn,
							reply_contents,
							reply_date,
							ins_date
						FROM
							tbl_qa
						WHERE
							qa_idx=?
            ";

    return $this->query_row($sql,
														array(
														$qa_idx
														),
														$data
														);
  }

  //문의등록
  public function qa_reg_in($data){
    $member_idx = $data['member_idx'];
    $qa_title = $data['qa_title'];
    $qa_contents = $data['qa_contents'];

    $this->db->trans_begin();

    $sql = "INSERT INTO
              tbl_qa
            (
							member_idx,
							qa_title,
							qa_contents,
							reply_yn,
              ins_date,
              upd_date
						)VALUES(
							?,
							?,
							?,
							'N',
							NOW(),
							NOW()
						)
            ";

    $this->query($sql,
								array(
								$member_idx,
								$qa_title,
								$qa_contents
								),
								$data
								);

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1";
		}
  }

  //문의등록
  public function qa_del($data){
    $qa_idx = $data['qa_idx'];

    $this->db->trans_begin();

    $sql = "UPDATE
	            tbl_qa
						SET
							del_yn='Y',
	            upd_date=NOW()
						WHERE
							qa_idx=?
            ";

    $this->query($sql,
								array(
								$qa_idx
								),
								$data
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
