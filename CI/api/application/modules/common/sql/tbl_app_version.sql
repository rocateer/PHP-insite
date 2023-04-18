/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 5.1.73-log : Database - stockking
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`stockking` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `stockking`;

/*Table structure for table `tbl_app_version` */

DROP TABLE IF EXISTS `tbl_app_version`;

CREATE TABLE `tbl_app_version` (
  `app_version_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '앱 버전 키',
  `device_os` varchar(1) DEFAULT NULL COMMENT '디바이스 종류 (A:안드로이드, I: IOS)',
  `version` varchar(20) DEFAULT NULL COMMENT '버전',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일자',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일자',
  PRIMARY KEY (`app_version_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
