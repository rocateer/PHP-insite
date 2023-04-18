<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  .  ____  .    __________________________________________________________
  |/      \|   | Create-Date :  2017.08.05 | Author : 서민규
 [| ♥    ♥ |]  | Modify-Date :  2017.??.?? | Editor : 서민규
  |___==___|  V  Class-Name  :  Main
             / | Memo        :  대시보드
               |__________________________________________________________
*/

Class Model_main extends MY_Model {

	// 전체 회원 수
	public function member_total_count(){

		$sql="SELECT
						count(*) AS cnt
					FROM
					  tbl_member
					WHERE
						del_yn = 'N'
   			 ";

		return $this->query_cnt($sql,array());
	}

	// 금일 가입 회원 수
	public function today_member_count(){

		$sql="SELECT
						count(*) AS cnt
					FROM
					  tbl_member
					WHERE
						del_yn = 'N'
						AND DATE_FORMAT(ins_date, '%Y-%m-%d') = DATE_FORMAT(NOW(), '%Y-%m-%d')
   			 ";

		return $this->query_cnt($sql,array());
	}

	// 신규 회원 리스트
	public function member_list_get(){

		$sql = "SELECT
							a.member_idx,
							FN_AES_DECRYPT(a.member_id) AS member_id,
							FN_AES_DECRYPT(a.member_name) AS member_name,
							FN_AES_DECRYPT(a.member_phone) AS member_phone,
							a.member_nickname,
							a.member_state,
							a.member_join_type,
							a.ins_date,
							b.city_name
						FROM
							tbl_member a
							LEFT JOIN tbl_city b ON b.city_code = a.city_code
						WHERE
							a.del_yn = 'N'
						ORDER BY a.ins_date DESC LIMIT 10
        	";

  	return $this->query_result($sql,array());
	}

}
?>
