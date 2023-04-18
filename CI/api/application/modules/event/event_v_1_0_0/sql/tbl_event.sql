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

/*Table structure for table `tbl_event` */

DROP TABLE IF EXISTS `tbl_event`;

CREATE TABLE `tbl_event` (
  `event_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '이벤트 키',
  `event_type` char(1) DEFAULT NULL COMMENT '이벤트 종류',
  `title` varchar(45) DEFAULT NULL COMMENT '제목',
  `contents` text COMMENT '내용',
  `start_date` varchar(10) DEFAULT NULL COMMENT '시작일',
  `end_date` varchar(10) DEFAULT NULL COMMENT '종료일',
  `img_url` varchar(200) DEFAULT NULL COMMENT '이미지 경로',
  `img_width` int(11) DEFAULT NULL COMMENT '이미지 넓이',
  `img_height` int(11) DEFAULT NULL COMMENT '이미지 높이',
  `state` char(1) DEFAULT NULL COMMENT '상태 0:비활성화, 1:활성화',
  `link_url` varchar(200) DEFAULT NULL COMMENT '링크',
  `target` char(1) DEFAULT NULL COMMENT 'S:self,B:blank',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제유무 (N) 정상 ,(Y)삭제',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일 ',
  PRIMARY KEY (`event_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tbl_event` */

insert  into `tbl_event`(`event_idx`,`event_type`,`title`,`contents`,`start_date`,`end_date`,`img_url`,`img_width`,`img_height`,`state`,`link_url`,`target`,`del_yn`,`ins_date`,`upd_date`) values 
(1,'I','이벤트 내요','내용 이구요','2017-12-24','2018-12-24',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2017-12-24 15:55:00',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
