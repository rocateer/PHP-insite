/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 5.6.32 : Database - tableorder_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tableorder_DB` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tableorder_DB`;

/*Table structure for table `tbl_member` */

DROP TABLE IF EXISTS `tbl_member`;

CREATE TABLE `tbl_member` (
  `member_idx` int(11) NOT NULL AUTO_INCREMENT,
  `member_join_type` char(1) DEFAULT NULL COMMENT '회원가입타입(C:일반,K:카카오톡,F:페이스북,N:네이버\n',
  `member_type` varchar(1) DEFAULT NULL COMMENT '회원타입',
  `member_email` varchar(200) DEFAULT NULL COMMENT '회원 이메일\n',
  `member_pwd` varchar(200) DEFAULT NULL COMMENT '회원 비밀번호\n',
  `member_nickname` varchar(200) DEFAULT NULL COMMENT '회원 별병\n',
  `alram_notice` varchar(1) DEFAULT 'Y' COMMENT '알람수신여부(공지) : Y수신 N수신안함',
  `alram_beacon` varchar(1) DEFAULT 'Y' COMMENT '알람수신여부(비콘) : Y수신 N수신안함',
  `alram_order` varchar(1) DEFAULT 'Y' COMMENT '알람수신여부(주문서) : Y수신 N수신안함',
  `gcm_key` varchar(200) DEFAULT NULL COMMENT 'gcm_key',
  `device_os` char(1) DEFAULT NULL COMMENT '디바이스os(A:안드로이드,I:ios)',
  `del_yn` varchar(1) DEFAULT 'N' COMMENT '삭제유무 (N: 활성, Y: 비활성)',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  `pwd_key` varchar(200) DEFAULT NULL COMMENT '비밀번호 재설정키',
  PRIMARY KEY (`member_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='회원테이블';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
