/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 5.7.17-log : Database - krakenbeat_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`krakenbeat_DB` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `krakenbeat_DB`;

/*Table structure for table `tbl_admin` */

DROP TABLE IF EXISTS `tbl_admin`;

CREATE TABLE `tbl_admin` (
  `admin_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '관리자 키',
  `admin_id` varchar(100) DEFAULT NULL COMMENT '관리자 아이디',
  `admin_pwd` varchar(200) DEFAULT NULL COMMENT '비밀번호',
  `admin_name` varchar(100) DEFAULT NULL COMMENT '이름',
  `admin_state` char(1) DEFAULT NULL COMMENT '상태 : Y:사용,N:사용 안함',
  `del_yn` varchar(1) DEFAULT NULL COMMENT '삭제유무 (N) 정상 ,(Y)삭제',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  PRIMARY KEY (`admin_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='관리자 테이블';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
