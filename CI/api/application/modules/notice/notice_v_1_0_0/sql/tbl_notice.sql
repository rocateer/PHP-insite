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

/*Table structure for table `tbl_notice` */

DROP TABLE IF EXISTS `tbl_notice`;

CREATE TABLE `tbl_notice` (
  `notice_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT '공지사항 키',
  `title` varchar(200) DEFAULT NULL COMMENT '제목\n',
  `contents` text COMMENT '내용\n',
  `img` varchar(200) DEFAULT NULL COMMENT '이미지 경로\n',
  `img_width` int(11) DEFAULT NULL COMMENT '이미지 가로\n',
  `img_height` int(11) DEFAULT NULL COMMENT '이미지 세로\n',
  `notice_type` varchar(1) DEFAULT NULL COMMENT '공지사항 타입 (0: 공지사항 1: 발표)',
  `notice_state` char(1) DEFAULT 'N' COMMENT '공지사항 상태 (N: 비활성화 Y: 활성화)',
  `view_cnt` int(11) DEFAULT '0' COMMENT '조회수',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제유무 (N: 정상 Y: 삭제)',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일자',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일자',
  PRIMARY KEY (`notice_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COMMENT='공지 사항\n';

/*Data for the table `tbl_notice` */

insert  into `tbl_notice`(`notice_idx`,`title`,`contents`,`img`,`img_width`,`img_height`,`notice_type`,`notice_state`,`view_cnt`,`del_yn`,`ins_date`,`upd_date`) values 
(1,'2424','342424','http://admin.bikenriders.com/media/commonfile/201811/15/97bbc4a4478b539e9721c23280bc8ca3.png',NULL,NULL,NULL,'Y',0,'N','2018-09-06 21:49:09','2019-01-10 11:20:28'),
(2,'11','22','http://p-admin.moaboom.site/media/commonfile/201901/10/adde347e4fb2698ce8e65b3a78674ca3.jpg',NULL,NULL,NULL,'Y',0,'N','2018-10-14 16:02:23','2019-03-04 11:36:55'),
(3,'가나다','가나다','http://admin.bikenriders.com/media/commonfile/201811/15/000c6cb4449ba53ee17812e27294a688.jpg',NULL,NULL,NULL,'Y',0,'N','2018-11-15 15:55:38','2019-04-08 13:59:01'),
(4,'11111',NULL,NULL,NULL,NULL,NULL,'Y',0,'Y','2018-12-14 22:47:10','2019-03-04 13:46:43'),
(5,'11222','111111',NULL,NULL,NULL,NULL,'N',0,'Y','2018-12-18 16:46:48','2019-01-10 11:28:58'),
(6,'ㄴ','ㅇㄹㄹ,',NULL,NULL,NULL,NULL,'N',0,'Y','2019-01-09 12:09:38','2019-01-10 11:52:23'),
(7,NULL,'ㅇㄹㅇㄹ',NULL,NULL,NULL,NULL,'N',0,'Y','2019-01-09 12:11:43','2019-01-10 11:53:02'),
(8,'ㅁㄴㅇㄹ','ㅀㅎㅎ',NULL,NULL,NULL,NULL,'N',0,'Y','2019-01-10 10:55:41','2019-01-10 11:24:31'),
(9,'ㅇㅎ','ㅎ',NULL,NULL,NULL,NULL,'N',0,'Y','2019-01-10 11:31:37','2019-01-10 11:46:03'),
(10,'ㅎ','ㅍ',NULL,NULL,NULL,NULL,'N',0,'Y','2019-01-10 11:32:04','2019-01-10 11:46:36'),
(11,'ㅓ','ㅓㅗ',NULL,NULL,NULL,NULL,'N',0,'Y','2019-01-10 11:33:55','2019-01-10 11:46:44'),
(12,'ㄴ','ㄴ',NULL,NULL,NULL,NULL,'N',0,'Y','2019-01-10 11:45:27','2019-01-10 11:51:21'),
(13,'\'','ㅣ',NULL,NULL,NULL,NULL,'N',0,'N','2019-03-04 12:19:13','2019-03-04 12:19:13'),
(14,NULL,'ㄹ',NULL,NULL,NULL,NULL,'Y',0,'N','2019-03-04 14:07:54','2019-04-08 13:59:04'),
(15,'44334535','ㄹㅇㅎㅇㅎ','http://p-admin.moaboom.site/media/commonfile/201903/29/7e571b7edb062724b0ec289b106872aa.png',NULL,NULL,NULL,'Y',0,'Y','2019-03-29 22:05:41','2019-05-22 20:23:00'),
(16,'22222','22222',NULL,NULL,NULL,'0','N',0,'N','2019-05-22 20:25:53','2019-05-22 20:25:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
