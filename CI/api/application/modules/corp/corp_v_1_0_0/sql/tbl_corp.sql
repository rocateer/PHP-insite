/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 5.7.17-log : Database - turtlesmiracle_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`turtlesmiracle_DB` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `turtlesmiracle_DB`;

/*Table structure for table `tbl_corp` */

DROP TABLE IF EXISTS `tbl_corp`;

CREATE TABLE `tbl_corp` (
  `corp_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '업체 키',
  `corp_id` varchar(200) DEFAULT NULL COMMENT '아이디',
  `corp_pwd` varchar(200) DEFAULT NULL COMMENT '패스워드',
  `corp_name` varchar(200) DEFAULT NULL COMMENT '회사명',
  `corp_tel` varchar(30) DEFAULT NULL COMMENT '회사전화번호',
  `corp_phone` varchar(30) DEFAULT NULL COMMENT '업체 휴대폰 번호',
  `corp_worker` varchar(200) DEFAULT NULL COMMENT '담당자',
  `corp_worker_tel` varchar(200) DEFAULT NULL COMMENT '담당자전화번호',
  `corp_addr` varchar(200) DEFAULT NULL COMMENT '업체 주소',
  `corp_addr_detail` varchar(200) DEFAULT NULL COMMENT '업체 주소 상세',
  `corp_addr_postcode` varchar(50) DEFAULT NULL COMMENT '업체 우편 번호',
  `corp_lat` decimal(15,7) DEFAULT NULL COMMENT '위도',
  `corp_lng` decimal(15,7) DEFAULT NULL COMMENT '경도',
  `corp_img_path` varchar(200) DEFAULT NULL COMMENT '회사대표이미지',
  `corp_open_time` varchar(20) DEFAULT NULL COMMENT '영업시작시간',
  `corp_close_time` varchar(20) DEFAULT NULL COMMENT '영업종료시간',
  `corp_state` int(1) DEFAULT '1' COMMENT '0:운영중,1:운영정지',
  `corp_state_memo` text COMMENT '업에 운영 정지 사유',
  `corp_contents` text COMMENT '업체설명',
  `used_seat` int(3) DEFAULT NULL COMMENT '현재 이용 좌석 수',
  `max_seat` int(3) DEFAULT NULL COMMENT '최대 좌석 수',
  `del_yn` char(1) DEFAULT 'N',
  `ins_date` datetime DEFAULT NULL,
  `upd_date` datetime DEFAULT NULL,
  PRIMARY KEY (`corp_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='업체';

/*Data for the table `tbl_corp` */

insert  into `tbl_corp`(`corp_idx`,`corp_id`,`corp_pwd`,`corp_name`,`corp_tel`,`corp_phone`,`corp_worker`,`corp_worker_tel`,`corp_addr`,`corp_addr_detail`,`corp_addr_postcode`,`corp_lat`,`corp_lng`,`corp_img_path`,`corp_open_time`,`corp_close_time`,`corp_state`,`corp_state_memo`,`corp_contents`,`used_seat`,`max_seat`,`del_yn`,`ins_date`,`upd_date`) values 
(1,'314A51167F20F7CE2588F8FB58F478A5','3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2','테스트 업체','010-201-20-2',NULL,NULL,NULL,'서울 성동구 마조로1길 42 (행당동)','1층',NULL,37.5611235,127.0394145,NULL,'10:00','23:00',1,NULL,'조용 한 분위기 속 성적은 쑥쑥 ',40,100,'N','2018-01-13 21:36:29','2018-01-13 21:44:58');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
