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

/*Table structure for table `tbl_corp_img` */

DROP TABLE IF EXISTS `tbl_corp_img`;

CREATE TABLE `tbl_corp_img` (
  `corp_img_idx` int(11) NOT NULL AUTO_INCREMENT,
  `corp_idx` int(11) DEFAULT NULL COMMENT '업체키값',
  `corp_img_path` varchar(200) DEFAULT NULL COMMENT '이미지경로',
  `corp_img_order` int(11) DEFAULT NULL COMMENT '이미지순서',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제여부(Y/N)',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  `tbl_corp_corp_idx` int(11) DEFAULT NULL,
  PRIMARY KEY (`corp_img_idx`),
  KEY `fk_tbl_corp_img_tbl_corp1_idx` (`tbl_corp_corp_idx`),
  CONSTRAINT `fk_tbl_corp_img_tbl_corp1` FOREIGN KEY (`tbl_corp_corp_idx`) REFERENCES `tbl_corp` (`corp_idx`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_corp_img` */

insert  into `tbl_corp_img`(`corp_img_idx`,`corp_idx`,`corp_img_path`,`corp_img_order`,`del_yn`,`ins_date`,`upd_date`,`tbl_corp_corp_idx`) values 
(1,1,'http://ilmin.org/kr/wp-content/uploads/2016/03/EH_CAFE-IMA_151231_2905-1.jpg',1,'N','2018-02-17 15:33:45','2018-02-17 15:33:47',NULL),
(2,1,'http://www.peytonandbyrne.co.uk/wp-content/uploads/2017/02/170308_NationalGallery_AfternoonTea_38.jpg',2,'N','2018-02-17 15:35:22','2018-02-17 15:35:24',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
