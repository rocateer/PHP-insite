<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|------------------------------------------------------------------------
| Author :	박수인
| Create-Date : 2022-11-01
| Memo : cron
|------------------------------------------------------------------------
*/

Class Model_cron extends MY_Model {

	//운동시간 알림
	public function minute_cron(){

		$this->db->trans_begin();

			$now=date('Y-m-d');
			$time=date('H:i');
	
			$this->db->trans_begin();
	
			$sql = "SELECT
						a.member_idx, 
						a.gcm_key, 
						a.device_os, 
						a.excercise_alarm_yn as alarm_yn, 
						a.excercise_alarm_time 
					FROM
						tbl_member as a
						JOIN 
						(
						SELECT
							member_idx
						FROM
							tbl_member_program_record
						WHERE
							del_yn='N'
							AND excercise_date = '$now'
							GROUP BY member_idx
						) as b ON b.member_idx=a.member_idx

					WHERE
						a.excercise_alarm_yn = 'Y'
						AND a.del_yn = 'N'
						AND a.excercise_alarm_time= '$time'
				";

			$member_list= $this->query_result($sql,array(
																)
															);
	
			//운동시간등록
		foreach($member_list as $row){

			$index="103";
			$msg="오늘 운동 스케줄이 있어요! 프로그램을 완료하고 커뮤니티에 자랑해 보세요.";

			$data['corp_idx'] = 0;
			$data['member_idx'] = $row->member_idx;
			$data['gcm_key'] = $row->gcm_key;
			$data['device_os'] = $row->device_os;
			$data['title']=$title= '';
			$data['msg']=$msg;
			$data["index"] =$index;
			$data["alarm_yn"] =$row->alarm_yn;

			$sql = "INSERT INTO
								tbl_alarm
							(
								member_idx,
								corp_idx,
								`data`,
								title,
								msg,
								`index`,
								device_os,
								gcm_key,
								alarm_yn,
								send_yn,
								read_yn,
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
								'N',
								'N',
								'N',
								NOW(),
								NOW()
							)
			";

			$this->query($sql,
						array(
						$row->member_idx,
						0,
						json_encode($data),
						$title,
						$msg,
						$index,
						$row->device_os,
						$row->gcm_key,
						$row->alarm_yn,
						)
						);
			}
		
	 if($this->db->trans_status() === FALSE){
		 $this->db->trans_rollback();
		 return "0";
	 } else {
		 $this->db->trans_commit();
		 return "1";
	 }
 }

	//6시 알림
	public function hour_cron(){

		$this->db->trans_begin();

			$now=date('Y-m-d');
			$time=date('H:i');
	
			$this->db->trans_begin();
	
			$sql = "SELECT
						a.member_idx, 
						a.gcm_key, 
						a.device_os, 
						a.excercise_alarm_yn as alarm_yn, 
						a.excercise_alarm_time 
					FROM
						tbl_member as a
						JOIN 
						(
						SELECT
							member_idx
						FROM
							tbl_member_program_record
						WHERE
							del_yn='N'
							AND excercise_date = '$now'
							GROUP BY member_idx
						) as b ON b.member_idx=a.member_idx

					WHERE
						a.excercise_alarm_yn = 'Y'
						AND a.del_yn = 'N'
						AND (a.excercise_alarm_time ='' OR a.excercise_alarm_time IS NULL)
				";

			$member_list= $this->query_result($sql,array(
																)
															);
	
			//운동시간등록
		foreach($member_list as $row){

			$index="104";
			$msg="오늘 운동 스케줄이 있어요! 프로그램을 완료하고 커뮤니티에 자랑해 보세요.";

			$data['corp_idx'] = 0;
			$data['member_idx'] = $row->member_idx;
			$data['gcm_key'] = $row->gcm_key;
			$data['device_os'] = $row->device_os;
			$data['title']=$title= '';
			$data['msg']=$msg;
			$data["index"] =$index;
			$data["alarm_yn"] =$row->alarm_yn;

			$sql = "INSERT INTO
								tbl_alarm
							(
								member_idx,
								corp_idx,
								`data`,
								title,
								msg,
								`index`,
								device_os,
								gcm_key,
								alarm_yn,
								send_yn,
								read_yn,
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
								'N',
								'N',
								'N',
								NOW(),
								NOW()
							)
			";

			$this->query($sql,
						array(
						$row->member_idx,
						0,
						json_encode($data),
						$title,
						$msg,
						$index,
						$row->device_os,
						$row->gcm_key,
						$row->alarm_yn,
						)
						);
			}
		
	 if($this->db->trans_status() === FALSE){
		 $this->db->trans_rollback();
		 return "0";
	 } else {
		 $this->db->trans_commit();
		 return "1";
	 }
 }


 //하루 클론
 public function day_cron(){

	$now=date('Y-m-d');
	$yesterday=date('Y-m-d', strtotime('-1 day'));

	$this->db->trans_begin();

	$sql = "SELECT
						member_program_idx, 
						member_idx, 
						program_idx, 
						yoil, 
						DATE_FORMAT(s_date, '%Y-%m-%d') AS s_date,
						DATE_FORMAT(e_date, '%Y-%m-%d') AS e_date,
						e_date_yn, 
						del_yn, 
						ins_date, 
						upd_date
					FROM
						tbl_member_program
					WHERE
						e_date_yn = 'N'
						AND del_yn = 'N'
						AND ( e_date_yn='N' AND DATE_FORMAT(s_date, '%Y-%m-%d')<='$now' OR e_date_yn='Y' AND DATE_FORMAT(s_date, '%Y-%m-%d')<='$now' AND DATE_FORMAT(e_date, '%Y-%m-%d')>='$now') 
				";

	$program_list= $this->query_result($sql,array(
														)
													);

	foreach($program_list as $row){

		$yoil_arr=explode(',',$row->yoil);

		$excercise_date =$now;
									
		$daily = date( 'w', strtotime($now) ) ;

			if(in_array($daily,$yoil_arr)){
				$sql = "INSERT INTO
									tbl_member_program_record
								(
									member_program_idx, 
									member_idx, 
									program_idx, 
									title, 
									img_path, 
									yoil, 
									s_date, 
									e_date, 
									excercise_date, 
									excercise_yn, 
									del_yn, 
									ins_date, 
									upd_date
								)SELECT 
									a.member_program_idx,
									a.member_idx,
									a.program_idx,
									b.title,
									b.img_path,
									a.yoil,
									DATE_FORMAT(a.s_date, '%Y-%m-%d'),
									DATE_FORMAT(a.e_date, '%Y-%m-%d'),
									?,
									'N',
									'N',
									NOW(),
									NOW()
								from
									tbl_member_program as a
									JOIN tbl_program as b on b.program_idx=a.program_idx
								where
									a.del_yn='N'
									and a.member_program_idx=?
									ON DUPLICATE KEY UPDATE member_idx=?,member_program_idx=?,upd_date=NOW()
								";

					$this->query($sql,
										array(
										$excercise_date,
										$row->member_program_idx,
										$row->member_idx,
										$row->member_program_idx
										)
										);
				}
				
			}
			
		$sql = "SELECT
							member_idx,
							COUNT(*) AS total_program_cnt,
							COUNT(CASE WHEN excercise_yn='Y' THEN 1 END) AS end_program_cnt,
							GROUP_CONCAT(program_idx) AS program_arr
						FROM
							tbl_member_program_record AS a
						WHERE
							a.del_yn='N'
							AND excercise_date='$yesterday'
							GROUP BY member_idx
				";

				$result_list= $this->query_result($sql,array(
																)
															);

				foreach($result_list as $row){
				
					$sql = "INSERT INTO tbl_member_program_date
										(
										member_idx,
										program_arr,
										excercise_date,
										total_program_cnt,
										end_program_cnt,
										del_yn,
										ins_date,
										upd_date
										)
										VALUES
										(
										?,
										?,
										?,
										?,
										?,
										'N',
										NOW(),
										NOW()
										)
										ON DUPLICATE KEY UPDATE total_program_cnt=?,end_program_cnt=?,upd_date=NOW()
					";

					$this->query($sql,array(
										$row->member_idx,
										$row->program_arr,
										$yesterday,
										$row->total_program_cnt,
										$row->end_program_cnt,
										$row->total_program_cnt,
										$row->end_program_cnt
										)
					);

			}
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		} else {
			$this->db->trans_commit();
			return "1";
		}
	}

	//알람발송
	public function alarm_send(){

		$sql ="SELECT
						 alarm_idx,
						 member_idx,
						 `index` as _index,
						 gcm_key,
						 device_os,
						 title,
						 msg,
						 alarm_yn,
						 data
					 FROM
						tbl_alarm
					 where
						del_yn='N'
						and alarm_yn='Y'
						and send_yn='N'
						order by 	alarm_idx asc limit 3
		";
		 $result_list=	$this->query_result($sql,array());


		$this->db->trans_begin();

		foreach($result_list as $row){

			$sql="UPDATE
						 tbl_alarm
						set
							send_yn='Y'
						where alarm_idx='$row->alarm_idx'
			";
			$this->query($sql,array());

	 }
	 
	 $this->alarm_push_send($result_list);


		if($this->db->trans_status() === FALSE){
		 $this->db->trans_rollback();
		 return "0";
		} else {
		 $this->db->trans_commit();
		 return "1";
		}
	}
	
	
	//알람발송
	public function alarm_push_send($result_list){
		header('Content-Type: application/json');

		$sgcm = new GCMPushMessage();
		$sgcm->setApiKey(GCM_KEY_1);

		foreach($result_list as $row){
			$data['member_idx'] = $row->member_idx;
			$data['gcm_key'] = $row->gcm_key;
			$data['device_os'] = $row->device_os;
			$data['msg']=  $row->msg;
			$data["index"] =$row->_index;
			$body_loc_key = "";
			$body_loc_args =[""];
			$alarm_idx=$row->alarm_idx;


			if($row->gcm_key !="" && $row->alarm_yn=="Y"){
					$sgcm->setDevices($row->gcm_key);
					$response = $sgcm->send($row->msg,$row->device_os,json_decode($row->data),$row->title,$body_loc_key,$body_loc_args,"");

			}

	 }
	
	}




}
?>
