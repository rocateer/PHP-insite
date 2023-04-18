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

/*Table structure for table `tbl_banner` */

DROP TABLE IF EXISTS `tbl_banner`;

CREATE TABLE `tbl_banner` (
  `banner_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '배너 키',
  `title` varchar(45) DEFAULT NULL COMMENT '제목',
  `contents` text COMMENT '내용',
  `img_url` varchar(200) DEFAULT NULL COMMENT '이미지 경로',
  `img_width` int(11) DEFAULT NULL COMMENT '이미지 넓이',
  `img_height` int(11) DEFAULT NULL COMMENT '이미지 높이',
  `state` char(1) DEFAULT '1' COMMENT '상태 0:비활성화, 1:활성화',
  `link_url` varchar(200) DEFAULT NULL COMMENT '타켓 링크',
  `target` char(1) DEFAULT NULL COMMENT 'S:self,B:blank',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제유무 (N) 정상 ,(Y)삭제',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일 ',
  PRIMARY KEY (`banner_idx`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='배너 관리';

/*Data for the table `tbl_banner` */

insert  into `tbl_banner`(`banner_idx`,`title`,`contents`,`img_url`,`img_width`,`img_height`,`state`,`link_url`,`target`,`del_yn`,`ins_date`,`upd_date`) values 
(1,'배너에요','배너 내용은 뭐가 좋을 까요? ','http://cfs7.tistory.com/upload_control/download.blog?fhandle=YmxvZzgyMzM1QGZzNy50aXN0b3J5LmNvbTovYXR0YWNoLzAvMDYwMDAwMDAwMDAwLmpwZw%3D%3D',500,200,'1',NULL,NULL,'N',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
