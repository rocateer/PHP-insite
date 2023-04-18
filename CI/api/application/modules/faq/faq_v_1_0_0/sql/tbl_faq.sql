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

/*Table structure for table `tbl_faq` */

DROP TABLE IF EXISTS `tbl_faq`;

CREATE TABLE `tbl_faq` (
  `faq_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'faq 키',
  `faq_category_idx` int(11) DEFAULT NULL COMMENT 'faq 카테고리 키',
  `title` varchar(100) DEFAULT NULL COMMENT '제목',
  `contents` text COMMENT '내용',
  `ref` int(11) DEFAULT '0' COMMENT '조회수',
  `del_yn` char(1) DEFAULT 'N' COMMENT '삭제유무 (N) 정상 ,(Y)삭제',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일 ',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일 ',
  `tbl_faq_category_faq_catgegory_idx` int(11) DEFAULT NULL,
  PRIMARY KEY (`faq_idx`),
  KEY `fk_tbl_faq_tbl_faq_category1_idx` (`tbl_faq_category_faq_catgegory_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='faq';

/*Data for the table `tbl_faq` */

insert  into `tbl_faq`(`faq_idx`,`faq_category_idx`,`title`,`contents`,`ref`,`del_yn`,`ins_date`,`upd_date`,`tbl_faq_category_faq_catgegory_idx`) values 
(1,1,'test','test21312313',0,'N','2018-11-19 16:39:38','2018-11-19 16:39:38',NULL),
(2,2,'test','test',1,'N','2018-11-19 16:39:41','2018-11-19 16:39:41',NULL),
(3,2,'test','wwwww',0,'Y','2018-11-19 16:39:42','2019-03-04 14:15:43',NULL),
(4,4,'test','test',0,'Y','2018-11-19 16:39:42','2019-01-10 13:15:16',NULL),
(5,1,'test','test',0,'N','2018-11-19 16:39:42','2018-11-19 16:39:42',NULL),
(6,3,'ㄹ','ㄹ',0,'Y','2018-12-17 21:50:02','2019-01-10 13:14:45',NULL),
(7,1,'wwww','2222',0,'N','2019-03-29 22:09:33','2019-04-01 11:48:15',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
