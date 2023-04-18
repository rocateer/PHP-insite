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

/*Table structure for table `tbl_faq_category` */

DROP TABLE IF EXISTS `tbl_faq_category`;

CREATE TABLE `tbl_faq_category` (
  `faq_category_idx` int(11) NOT NULL AUTO_INCREMENT COMMENT 'faq 카테고리 키',
  `faq_category_name` varchar(45) DEFAULT NULL COMMENT '이름 ',
  `del_yn` char(1) DEFAULT NULL COMMENT '삭제유무 (N) 정상 ,(Y)삭제',
  `ins_date` datetime DEFAULT NULL COMMENT '등록일',
  `upd_date` datetime DEFAULT NULL COMMENT '수정일',
  PRIMARY KEY (`faq_category_idx`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='faq_category';

/*Data for the table `tbl_faq_category` */

insert  into `tbl_faq_category`(`faq_category_idx`,`faq_category_name`,`del_yn`,`ins_date`,`upd_date`) values 
(1,'고객정보','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(2,'주문/결제','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(3,'배송','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(4,'상품/상품리뷰','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(5,'취소','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(6,'반품','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(7,'교환','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(8,'이벤트/제휴/기타','N','2018-11-16 11:40:51','2018-11-16 11:40:51'),
(9,'쿠폰','N','2018-11-16 11:40:51','2018-11-16 11:40:51');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
