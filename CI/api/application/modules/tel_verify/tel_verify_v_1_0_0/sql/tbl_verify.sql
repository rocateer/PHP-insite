/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 5.7.17-log : Database - Empo_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`Empo_DB` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `Empo_DB`;

/*Table structure for table `tbl_verify` */

DROP TABLE IF EXISTS `tbl_verify`;

CREATE TABLE `tbl_verify` (
  `verify_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '휴대폰 번호 인증 키',
  `member_idx` int(11) DEFAULT NULL COMMENT '회원 키',
  `member_phone` varchar(100) DEFAULT NULL COMMENT '회원 핸드폰',
  `verify_num` varchar(45) DEFAULT NULL COMMENT '인증번호\n',
  `verify_yn` varchar(4) DEFAULT NULL COMMENT '인증성공여부 (N실패 / Y성공)\n',
  `verify_cnt` int(11) DEFAULT NULL COMMENT '인증횟수\n',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일\n',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일\n',
  `tbl_member_member_idx` int(11) DEFAULT NULL,
  PRIMARY KEY (`verify_idx`),
  KEY `fk_tbl_verify_tbl_member1_idx` (`tbl_member_member_idx`),
  CONSTRAINT `fk_tbl_verify_tbl_member1` FOREIGN KEY (`tbl_member_member_idx`) REFERENCES `tbl_member` (`member_idx`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='회원 휴대폰인증\n'


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
