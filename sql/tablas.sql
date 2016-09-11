/*
SQLyog Community v12.2.1 (64 bit)
MySQL - 5.7.13-0ubuntu0.16.04.2 : Database - intelign_sidiscam
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/intelign_sidiscam /*!40100 DEFAULT CHARACTER SET utf8 */;

USE intelign_sidiscam;

/*Table structure for table status */

DROP TABLE IF EXISTS status;

CREATE TABLE status (
  id_status integer NOT NULL,
  name character varying(50) NOT NULL,
  date_created timestamp without time zone NOT NULL,
  date_updated timestamp without time zone  NOT NULL,

) 

/*Data for the table status */

insert  into status(id_status,name,date_created,date_updated) values 

(0,'DESACTIVADO','2016-04-05 16:40:19','2016-04-05 16:40:23'),

(1,'ACTIVO','2016-04-05 16:40:30','2016-04-05 16:40:33');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
