/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.22-MariaDB : Database - invoicedemo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`invoicedemo` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `invoicedemo`;

/*Table structure for table `admin_master` */

DROP TABLE IF EXISTS `admin_master`;

CREATE TABLE `admin_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `admin_master` */

insert  into `admin_master`(`id`,`name`,`email`,`password`,`status`) values (1,'admin','admin@vh.com','admin',1);

/*Table structure for table `category_master` */

DROP TABLE IF EXISTS `category_master`;

CREATE TABLE `category_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `position` int(11) DEFAULT NULL,
  `images` text,
  `cat_icon` text,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  `status` int(1) DEFAULT '1',
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `category_master` */

insert  into `category_master`(`id`,`name`,`title`,`description`,`position`,`images`,`cat_icon`,`created_by`,`updated_by`,`created_date`,`updated_date`,`status`,`slug`) values (33,'test ff',NULL,NULL,NULL,'http://localhost/invoice/media/1529427987Lighthouse.jpg','http://localhost/invoice/media/1529427987Lighthouse1.jpg',1,1,'2018-06-19 19:06:27','2018-06-19 19:10:30',0,'test-ff'),(34,'ddd',NULL,NULL,1,'http://localhost/invoice/media/1529428291Lighthouse.jpg','http://localhost/invoice/media/1529428291Lighthouse1.jpg',1,NULL,'2018-06-19 19:11:31',NULL,1,'ddd'),(35,'rrrr',NULL,NULL,0,'http://localhost/invoice/media/1529428313Penguins.jpg','http://localhost/invoice/media/1529428313Penguins1.jpg',1,NULL,'2018-06-19 19:11:53',NULL,1,'rrrr');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `gstno` varchar(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer` */

/*Table structure for table `invoice_master` */

DROP TABLE IF EXISTS `invoice_master`;

CREATE TABLE `invoice_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `invoice_master` */

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(250) DEFAULT NULL,
  `class_fk` varchar(10) DEFAULT NULL,
  `price` int(255) DEFAULT NULL,
  `gst` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `product` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
