/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 5.6.14 : Database - platform_DB
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`platform_DB` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `platform_DB`;

/*Table structure for table `tbl_start_popup` */

DROP TABLE IF EXISTS `tbl_start_popup`;

CREATE TABLE `tbl_start_popup` (
  `start_popup_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '앱 시작시 팝업 키',
  `title` varchar(100) DEFAULT NULL COMMENT '제목',
  `contents` text COMMENT '내용',
  `state` char(1) DEFAULT NULL COMMENT '상태 0:비활성화, 1:활성화',
  `img_url` varchar(200) DEFAULT NULL COMMENT '이미지 경로',
  `link_url` varchar(200) DEFAULT NULL COMMENT '링크',
  `start_date` varchar(10) DEFAULT NULL COMMENT '시작일',
  `end_date` varchar(10) DEFAULT NULL COMMENT '종료일',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제유무 (N) 정상 ,(Y)삭제',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  PRIMARY KEY (`start_popup_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='스플래쉬 관리';

/*Data for the table `tbl_start_popup` */

insert  into `tbl_start_popup`(`start_popup_idx`,`title`,`contents`,`state`,`img_url`,`link_url`,`start_date`,`end_date`,`del_yn`,`ins_date`,`upd_date`) values 
(1,'테스트','ㅁ','1','http://p-admin.moaboom.site/media/commonfile/201904/01/1a4ba8e8a44e503bd462eb69d737ae4a.png',NULL,'2019-03-07','2019-12-22','N','2017-12-24 15:39:29','2019-04-01 17:20:52');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
