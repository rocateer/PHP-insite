<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 김옥훈
| Create-Date : 2018-11-05
| Memo : 채팅
|------------------------------------------------------------------------
*/

Class Model_chatting extends MY_Model{

	//채팅방 오픈 여부
	public function chatting_room_check($data) {
		$order_schedule_idx = $data['order_schedule_idx'];

		$sql = "SELECT
						 a.chatting_room_idx,
						 a.order_schedule_idx,
						 a.state
						FROM   tbl_chatting_room as a
						WHERE	 a.del_yn ='N'
							 and a.order_schedule_idx=?
		";

			return $this->query_row($sql,
															array(
															$order_schedule_idx
															),
															$data);
	}

	//  방등록
	public function	chatting_room_reg_in($data){
		$member_idx     = $data['member_idx'];
		$partner_member_idx = $data['partner_member_idx'];
		$order_schedule_idx = $data['order_schedule_idx'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_chatting_room
							(
  							member_idx,
								partner_member_idx,
								order_schedule_idx,
								state,
								del_yn,
								ins_date,
								upd_date
							)VALUES (
								?,
								?,
								?,
								'N',
								NOW(),
								NOW()
							)
							ON DUPLICATE KEY UPDATE member_idx=?,partner_member_idx=?,order_schedule_idx=?,upd_date=NOW()
  ";
   $this->query($sql,
							array(
								$member_idx,
								$partner_member_idx,
								$order_schedule_idx,
								$member_idx,
								$partner_member_idx,
								$order_schedule_idx,
							),
							$data
							);
     $chatting_room_idx = $this->db->insert_id();


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return $chatting_room_idx;
		}
	}

  //채팅방정보
	public function chatting_room_detail($data) {
		$chatting_room_idx = $data['chatting_room_idx'];

		$sql = "SELECT
						 a.chatting_room_idx,
						 a.order_schedule_idx,
						 a.partner_member_idx,
						 a.state,
						 a.ins_date
						FROM   tbl_chatting_room as a
						WHERE	 a.del_yn ='N'
							 and a.chatting_room_idx=?
		";

			return $this->query_row($sql,
															array(
															$chatting_room_idx
															),
															$data);
	}


	// 1.  리스트
	public function chatting_list($data){
		$page_size = (int)$data['page_size'];
		$page_no = (int)$data['page_no'];

		$member_idx = $data['member_idx'];
		$chatting_room_idx = $data['chatting_room_idx'];

		$sql = "SELECT
							DATE_FORMAT(a.ins_date,'%Y-%m-%d') as st_date
						FROM
							tbl_chatting_list as a
						WHERE
							a.del_yn = 'N'
							and a.chatting_room_idx='$chatting_room_idx'
							group by DATE_FORMAT(a.ins_date,'%Y-%m-%d')
		";

		$sql .=" ORDER BY DATE_FORMAT(a.ins_date,'%Y-%m-%d') desc limit ?, ?";

		$result_list=	$this->query_result($sql,array($page_no,$page_size),$data);
		$data_array = array();

    if(count($result_list)>0){
			$x=count($result_list)-1;
			$data_arr = array();
			foreach($result_list as $row){
			 $data_arr[$x]['st_date']	= $row->st_date;
			 $st_date= $row->st_date;

			 $data_array2 = array();

			 $result_list2 = $this->chatting_selected_list($chatting_room_idx,$st_date,$member_idx);
			 $j=0;
			 foreach($result_list2 as $row2){
				$data_array2[$j]['ins_hi'] =  $row2->ins_hi;

				$data_array2[$j]['chat_writer_type'] =  $row2->chat_writer_type;
				if($row2->chat_writer_type =="0"){
					$data_array2[$j]['member_idx']	= $row2->member_idx;
					$data_array2[$j]['member_img']	= "";
					$data_array2[$j]['member_name']	= $row2->member_name;
				}else{
					//$data_array2[$j]['member_idx']	= $row2->partner_member_idx;
					$data_array2[$j]['member_idx']	= "0";
					$data_array2[$j]['member_img']	= $row2->corp_img_path;
					$data_array2[$j]['member_name']	= $row2->corp_name;
				}

				$data_array2[$j]['comment']	= $row2->comment;
				$data_array2[$j]['img_path']	= $row2->img_path;

				$j++;
			 }

			 $data_arr[$x]['day_list_array']	= $data_array2;
			 $x--;
			}

			for($i=0;$i<count($result_list);$i++){
				$data_array[$i]['st_date'] =$data_arr[$i]['st_date'];
				$data_array[$i]['day_list_array'] =$data_arr[$i]['day_list_array'];
			}
		}

		return $data_array;
	}


	// 1.  리스트
	public function chatting_selected_list($chatting_room_idx,$st_date){

		$sql = "SELECT
							a.chatting_list_idx,
							a.chat_writer_type,
							a.member_idx,
							b.member_img,
							CONCAT(FN_AES_DECRYPT(b.first_name),' ',FN_AES_DECRYPT(b.last_name)) AS member_name,
							b.first_name,
							b.last_name,
							a.partner_member_idx,
							c.corp_img_path,
							CONCAT(	c.corp_first_name,' ',LEFT(c.corp_second_name,1)) AS corp_name,
							c.corp_first_name,
							c.corp_second_name,
							a.comment,
							a.img_path,
							a.ins_date,
							DATE_FORMAT(a.ins_date,'%Y-%m-%d') as ins_day ,
							DATE_FORMAT(a.ins_date,'%H:%i') as ins_hi
						FROM
							tbl_chatting_list as a
							left join tbl_member as b on b.member_idx=a.member_idx
							left join tbl_corp as c on c.corp_idx=a.partner_member_idx
						WHERE
							a.del_yn = 'N'
							and a.chatting_room_idx='$chatting_room_idx'
							and DATE_FORMAT(a.ins_date,'%Y-%m-%d')='$st_date'
		        ORDER BY a.chatting_list_idx asc
		 ";

		return	$this->query_result($sql,array());

	}

	// 1-1.  리스트 총 카운트
	public function chatting_list_count($data){
		$member_idx = $data['member_idx'];
		$chatting_room_idx = $data['chatting_room_idx'];

		$sql = "SELECT
							COUNT(*) AS cnt
						FROM
            (
							SELECT
							 DATE_FORMAT(a.ins_date,'%Y-%m-%d'),
							 COUNT(*) AS cnt
						 FROM
							 tbl_chatting_list as a
						 WHERE
							 a.del_yn = 'N'
							 and a.chatting_room_idx='$chatting_room_idx'
							 group by DATE_FORMAT(a.ins_date,'%Y-%m-%d')
						) as ta

		";

		return	$this->query_cnt($sql,
															array(
															),$data
															);

	}

	// 등록
	public function	chatting_reg_in($data){
		$member_idx     = $data['member_idx'];
		$chatting_room_idx = $data['chatting_room_idx'];
		$img_path = $data['img_path'];
		$comment         = $data['comment'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_chatting_list
							(
								chatting_room_idx,
								chat_writer_type,
								member_idx,
								comment,
								img_path,
								del_yn,
								ins_date,
								upd_date
							) values (
								 ?,
								 0,
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
										$chatting_room_idx,
										$member_idx,
										$comment,
										$img_path,
									),
									$data
									);


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}


	// 등록
	public function	partner_chatting_reg_in($data){
		$member_idx     = $data['member_idx'];
		$chatting_room_idx = $data['chatting_room_idx'];
		$img_path = $data['img_path'];
		$comment         = $data['comment'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_chatting_list
							(
								chatting_room_idx,
								chat_writer_type,
								partner_member_idx,
								comment,
								img_path,
								del_yn,
								ins_date,
								upd_date
							) values (
								 ?,
								 1,
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
										$chatting_room_idx,
										$member_idx,
										$comment,
										$img_path,
									),
									$data
									);


		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "-1";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}


}	//클래스의 끝
?>
