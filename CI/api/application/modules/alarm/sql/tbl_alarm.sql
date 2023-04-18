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

/*Table structure for table `tbl_alarm` */

DROP TABLE IF EXISTS `tbl_alarm`;

CREATE TABLE `tbl_alarm` (
  `alarm_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '알람키 ',
  `member_idx` int(11) DEFAULT NULL COMMENT '회원키',
  `msg` varchar(200) DEFAULT NULL COMMENT '메세지 ',
  `data` text COMMENT '데이타 ',
  `read_yn` char(1) DEFAULT 'N' COMMENT '읽음 유무 (N)읽지 않음 ,(Y)읽음',
  `crontab_idx` int(11) NOT NULL DEFAULT '0' COMMENT '크론탭 idx',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제유무 (N) 정상 ,(Y)삭제',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일 ',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일 ',
  PRIMARY KEY (`alarm_idx`,`crontab_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='알람';

/*Data for the table `tbl_alarm` */

insert  into `tbl_alarm`(`alarm_idx`,`member_idx`,`msg`,`data`,`read_yn`,`crontab_idx`,`del_yn`,`ins_date`,`upd_date`) values 
(1,1,'알림리스트 입니다. ','알림리스트 json 이에요 ','Y',0,'Y','2017-12-24 17:46:33','2017-12-24 18:03:55');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
