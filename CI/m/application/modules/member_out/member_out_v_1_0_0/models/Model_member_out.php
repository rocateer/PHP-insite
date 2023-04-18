<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-09-05
| Memo : 회원탈퇴
|------------------------------------------------------------------------
*/

Class Model_member_out extends MY_Model{

	// 주문 접수, 배달준비 , 배달중인 건이 1건이라도 있으면 탈퇴 할 수 없다
	public function my_project_cnt(){

		$sql="SELECT
						count(*) as cnt
					FROM
						tbl_order a
					WHERE
						a.member_idx = '$this->member_idx'
						AND a.del_yn ='N'
						AND a.order_state IN (0,1,2)
   			 ";

		return $this->query_cnt($sql,array());
	}


	// 회원탈퇴시 데이타 삭제
	public function member_out_mod_up($data){

		$member_idx = $data['member_idx'];
		$member_leave_reason = $data['member_leave_reason'];

		$this->db->trans_begin();

		$sql = "UPDATE
              tbl_member
            SET
              member_leave_reason = ?,
							member_leave_date = NOW(),
							member_state = 3,
							del_yn = 'Y',
              upd_date = NOW()
            WHERE
              member_idx = ?
            ";

    $this->query($sql, array(
								$member_leave_reason,
                $member_idx),
                $data
                );

		//커뮤니티 블라인드
		$sql = "UPDATE 
							tbl_board 
						SET 
							display_yn='N',
							upd_date = now()
						WHERE 
							member_idx = $member_idx
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


}	//클래스의 끝
?>
