/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 5.5.48-log : Database - jeju_platform_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`jeju_platform_DB` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `jeju_platform_DB`;

/*Table structure for table `tbl_qa` */

DROP TABLE IF EXISTS `tbl_qa`;

CREATE TABLE `tbl_qa` (
  `qa_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'qa 키',
  `member_idx` int(11) DEFAULT NULL COMMENT '회원 키',
  `qa_title` varchar(200) DEFAULT NULL COMMENT '제목',
  `qa_contents` text COMMENT '내용',
  `reply_contents` text COMMENT '문의답변',
  `reply_yn` varchar(1) DEFAULT 'N' COMMENT '답변유무 (Y: 답변, N: 미답변)',
  `reply_date` datetime DEFAULT NULL COMMENT '답변일',
  `del_yn` varchar(1) DEFAULT 'N' COMMENT '삭제유무 (N: 활성, Y: 비활성)',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  PRIMARY KEY (`qa_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='qa테이블';

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
