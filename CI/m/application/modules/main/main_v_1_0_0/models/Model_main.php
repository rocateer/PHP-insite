<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|------------------------------------------------------------------------
| Author : 박수인
| Create-Date : 2022-09-27
| Memo : 메인
|------------------------------------------------------------------------
*/

class Model_main extends MY_Model{

	public function main_detail($data){
		$member_idx = $data['member_idx'];
		$date = date('Y-m-d');
		$yoil = date('w');

		$result=array();

		$sql = "SELECT
            	member_nickname
            FROM
							tbl_member
            WHERE
							member_idx = $member_idx
    ";

		$result['my'] = $this->query_row($sql,array());

		$sql = "SELECT
							a.member_program_idx,
							b.program_idx,
							b.title,
							b.img_path,
							b.exercise_time,
							c.excercise_yn,
							ifnull(c.member_program_record_idx,0) as complete,
							c.record_time
						FROM
							tbl_member_program as a
							JOIN tbl_program as b ON b.program_idx = a.program_idx and b.del_yn='N'
							left join tbl_member_program_record as c ON c.member_program_idx=a.member_program_idx and c.del_yn='N' and DATE_FORMAT(c.excercise_date, '%Y-%m-%d')='$date'
						WHERE
							a.del_yn='N'
							and a.member_idx= $member_idx
							and a.yoil LIKE '%$yoil%'
							AND ( a.e_date_yn='N' AND DATE_FORMAT(a.s_date, '%Y-%m-%d')<='$date' OR a.e_date_yn='Y' AND DATE_FORMAT(a.s_date, '%Y-%m-%d')<='$date' AND DATE_FORMAT(a.e_date, '%Y-%m-%d')>='$date') 
						ORDER BY a.ins_date
		";

		$result['my_program_list'] = $this->query_result($sql, array());

		$sql = "SELECT
							a.member_program_record_idx,
							a.member_program_idx,
							a.program_idx,
							b.title,
							b.img_path,
							b.exercise_time,
							a.excercise_yn,
							a.record_time
						FROM
							tbl_member_program_record as a
							JOIN tbl_program as b ON b.program_idx = a.program_idx and b.del_yn='N'
						WHERE
							a.del_yn='N'
							and a.member_idx= $member_idx
							and a.excercise_date= '$date'
							
						ORDER BY a.ins_date
		";

		$result['my_program_list1'] = $this->query_result($sql, array());

		$sql = "SELECT
            	main_news_title,
							main_program_title
            FROM
							tbl_setting
            WHERE
							setting_idx = 1
    ";

		$result['title'] = $this->query_row($sql,array());

		$sql = "SELECT
            	count(*) as cnt
            FROM
            	tbl_alarm
            WHERE
            	del_yn = 'N'
            	AND read_yn = 'N'
              AND member_idx = ?
    ";

		$result['new_alarm_cnt'] = $this->query_cnt($sql,array($member_idx));

		$sql = "SELECT
							main_section_idx,
							a.program_idx,
							b.title,
							b.img_path,
							b.level,
							b.view_cnt,
							ifnull(c.like_yn,'N') as like_yn,
							b.like_cnt
						FROM
							tbl_main_section as a
							JOIN tbl_program as b ON b.program_idx=a.program_idx and b.del_yn='N'
							left join tbl_program_like as c on c.program_idx=a.program_idx and c.member_idx=$member_idx and c.del_yn='N'
						WHERE
							menu_type = 0
							and a.display_yn='Y'
						ORDER BY main_section_idx
		";

		$result['program_list'] = $this->query_result($sql, array());

		$sql = "SELECT
							main_section_idx,
							a.news_idx,
							b.title,
							b.contents,
							ifnull(c.display_yn,'Y') as display_yn,
							b.img_path
						FROM
							tbl_main_section as a
							JOIN tbl_news as b ON b.news_idx=a.news_idx and b.del_yn='N' and b.display_yn='Y'
							left join tbl_news_display as c ON c.news_idx=b.news_idx and c.member_idx=$member_idx
						WHERE
							menu_type = 1
							and a.display_yn='Y'
						ORDER BY main_section_idx
		";

		$result['news_list'] = $this->query_result($sql, array());

		$sql = "SELECT
							a.board_idx,
							a.title,
							a.view_cnt,
							a.like_cnt,
							a.reply_cnt,
							b.category_name,
							ifnull(c.block_yn,'N') as block_yn,
							if(d.board_report_idx!='','Y','N') as report_yn
						FROM
							tbl_board as a
							JOIN tbl_category_management as b ON b.category_management_idx=a.category_idx and b.del_yn='N' and b.state=1
							left join tbl_board_block as c ON c.board_idx=a.board_idx and c.member_idx=$member_idx
							left join tbl_board_report as d ON d.board_idx=a.board_idx and d.member_idx=$member_idx
						WHERE
							a.del_yn = 'N'
							and a.display_yn='Y'
						ORDER BY a.ins_date DESC LIMIT 5
		";

		$result['board_list'] = $this->query_result($sql, array());









		return $result;
	}
	
	
	
	// 가이드
	public function guide_detail($data) {

		$guide_type = $data['guide_type'];
		
		$sql = "SELECT
							guide_idx,
							guide_type,
							img_path
						FROM
							tbl_guide
						WHERE
							del_yn = 'N'
							ANd guide_type = ?
		";

	  return	$this->query_row($sql
																,array(
																$guide_type
																)
																);
	}
	
	//새로운 멘토 목록 노출
	public function new_member_list_1(){
		
		$sql = "SELECT
							a.member_idx,
							a.member_nickname,
							a.member_img,
							a.member_detail_img,
							a.department_name,
							a.department_email,
							a.career,
							a.part,
							a.job,
							a.mento_part,
							a.member_memo,
							a.tag,
							a.del_yn,
							a.ins_date
						FROM
							tbl_member a
						WHERE
							a.del_yn = 'N'
							AND a.member_type = '1'
    ";

		$sql .= " ORDER BY a.accept_date DESC LIMIT 10 ";

  	return  $this->query_result($sql,array());
	}
	
	//이용 리뷰 목록 5개
	public function review_list() {

		$sql = "SELECT
							b.member_nickname,
							b.member_img,
							c.member_nickname as partner_member_nickname,
							c.member_img as partner_member_img,
							c.department_name,
							a.review_idx,
							a.member_idx,
							a.partner_member_idx,
							a.contents,
							DATE_FORMAT(a.ins_date,'%Y-%m-%d') AS ins_date
						FROM
							tbl_review a
							JOIN tbl_member b ON b.member_idx = a.member_idx
							JOIN tbl_member c ON c.member_idx = a.partner_member_idx AND c.del_yn ='N'
						WHERE
							a.del_yn ='N'
							AND a.state = 'Y'
						";

		$sql .= " ORDER BY a.review_idx DESC LIMIT 5 ";

		return $this->query_result($sql,array());
	}
	
	public function	mentor_reg_in($data){

		$department_name = $data['department_name'];
		$department_email = $data['department_email'];
		$part = $data['part'];
		$job = $data['job'];
		$career = $data['career'];
		$mento_part = $data['mento_part'];
		$member_memo = $data['member_memo'];
		$tag = $data['tag'];
		$member_intro = $data['member_intro'];
		$mento_enable_hour = $data['mento_enable_hour'];
		$file_img = $data['file_img'];

		$this->db->trans_begin();

		$sql = "INSERT INTO
							tbl_mento_auth
							(
								member_idx,
								department_name,
								department_email,
								part,
								job,
								career,
								mento_part,
								member_memo,
								tag,
								member_intro,
								mento_enable_hour,
								file_img,
								del_yn,
								ins_date,
								upd_date
							) values (
								 ?,
								 ?,
								 ?,
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
								NOW(),
								NOW()
							)
							";

			$this->query($sql,
									array(
										$this->member_idx,
										$department_name,
										$department_email,
										$part,
										$job,
										$career,
										$mento_part,
										$member_memo,
										$tag,
										$member_intro,
										$mento_enable_hour,
										$file_img,
									),
									$data
									);

		$mento_auth_idx = $this->db->insert_id();

		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return "0";
		}else{
			$this->db->trans_commit();
			return "1000";
		}
	}
	

} // 클래스의 끝
?>
