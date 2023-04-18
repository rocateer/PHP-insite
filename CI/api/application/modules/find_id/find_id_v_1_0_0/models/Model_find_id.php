<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
  .  ____  .    __________________________________________________________
  |/      \|   | Create-Date :  2018.05.31 | Author : 김광호
 [| ♥    ♥ |]  | Modify-Date :  2017.05.31 | Editor : 김광호
  |___==___|  V  Class-Name  :  Find_id
             / | Memo        :  아이디 찾기
               |__________________________________________________________
*/

Class Model_find_id extends MY_Model {

	// 아이디 찾기
	public function member_id_find($data) {

		$member_nickname = $data['member_nickname'];
		$member_phone = $data['member_phone'];

		$sql = "SELECT
							member_idx,
							FN_AES_DECRYPT(member_id) AS member_id
						FROM
							tbl_member
						WHERE
							member_nickname = ?
							AND member_phone = FN_AES_ENCRYPT(?)
					  ";

		return $this->query_row($sql,array(
														$member_nickname,
														$member_phone
														),$data
														);
	}

}
?>
