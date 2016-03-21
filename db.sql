-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: admin_projectx
-- ------------------------------------------------------
-- Server version	5.5.43-0+deb7u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `nf_employee`
--

DROP TABLE IF EXISTS `nf_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nf_employee` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_group_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(32) NOT NULL,
  `last_type` int(3) unsigned zerofill DEFAULT NULL,
  `last_session_id` int(11) DEFAULT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `telephone` varchar(32) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(9) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `custom_field` text NOT NULL,
  `ip` varchar(40) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `waiting_session_id` int(11) DEFAULT NULL,
  `status_attendance` varchar(50) DEFAULT NULL,
  `status_type` varchar(255) DEFAULT NULL,
  `status_barcode` varchar(255) NOT NULL,
  `status_wo` varchar(255) NOT NULL,
  `status_custom` varchar(255) NOT NULL,
  `status_date` date NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `rate` decimal(15,4) NOT NULL,
  `pay_frequency` tinyint(1) NOT NULL,
  PRIMARY KEY (`employee_id`),
  KEY `last_type` (`last_type`),
  KEY `last_session_id` (`last_session_id`),
  KEY `waiting_session_id` (`waiting_session_id`)
) ENGINE=InnoDB AUTO_INCREMENT=90011 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nf_employee`
--

LOCK TABLES `nf_employee` WRITE;
/*!40000 ALTER TABLE `nf_employee` DISABLE KEYS */;
INSERT INTO `nf_employee` VALUES (3,1,'admin','John',001,NULL,'Smith','mr@netforge.pl','','','8b234d4a64fe7fa3cbc4833a01d073421683ec4f438eb7a4fac48e26b6b946de3dbad71a1d4a37f108d43dda3416bdf32e85daae8bdd9ff18368ce47bf1127d1j85o8M87PJVhSDhliCrQp1sorhZjHMTX0CVInNnEoxg=','8f8ee5802','job/rework','N;','10.1.2.77','',1,NULL,'onside',NULL,'','','IT Department','2016-02-09',1,'maciek','2014-05-08 09:49:31',10.0000,0);
/*!40000 ALTER TABLE `nf_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nf_employee_groups`
--

DROP TABLE IF EXISTS `nf_employee_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nf_employee_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nf_employee_groups`
--

LOCK TABLES `nf_employee_groups` WRITE;
/*!40000 ALTER TABLE `nf_employee_groups` DISABLE KEYS */;
INSERT INTO `nf_employee_groups` VALUES (1,'Default',NULL);
INSERT INTO `nf_employee_groups` VALUES (2,'Assembly',NULL);
INSERT INTO `nf_employee_groups` VALUES (3,'Shop Floor',NULL);
INSERT INTO `nf_employee_groups` VALUES (4,'Office',NULL);
/*!40000 ALTER TABLE `nf_employee_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nf_employee_groups_permission`
--

DROP TABLE IF EXISTS `nf_employee_groups_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nf_employee_groups_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `command` int(11) DEFAULT NULL,
  `mode` int(3) unsigned zerofill DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `command` (`command`),
  KEY `mode` (`mode`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nf_employee_groups_permission`
--

LOCK TABLES `nf_employee_groups_permission` WRITE;
/*!40000 ALTER TABLE `nf_employee_groups_permission` DISABLE KEYS */;
INSERT INTO `nf_employee_groups_permission` VALUES (1,1,1,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (3,1,5,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (4,1,6,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (5,1,7,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (6,1,8,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (7,1,NULL,001);
INSERT INTO `nf_employee_groups_permission` VALUES (8,1,NULL,002);
INSERT INTO `nf_employee_groups_permission` VALUES (9,1,3,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (10,2,2,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (12,1,9,NULL);
INSERT INTO `nf_employee_groups_permission` VALUES (13,1,10,009);
INSERT INTO `nf_employee_groups_permission` VALUES (14,1,4,003);
/*!40000 ALTER TABLE `nf_employee_groups_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nf_employee_groups_relation`
--

DROP TABLE IF EXISTS `nf_employee_groups_relation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nf_employee_groups_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nf_employee_groups_relation`
--

LOCK TABLES `nf_employee_groups_relation` WRITE;
/*!40000 ALTER TABLE `nf_employee_groups_relation` DISABLE KEYS */;
INSERT INTO `nf_employee_groups_relation` VALUES (71,1,3);
INSERT INTO `nf_employee_groups_relation` VALUES (72,2,3);
/*!40000 ALTER TABLE `nf_employee_groups_relation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nf_menu`
--

DROP TABLE IF EXISTS `nf_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nf_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `controller` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `is_page` tinyint(4) NOT NULL DEFAULT '1',
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nf_menu`
--

LOCK TABLES `nf_menu` WRITE;
/*!40000 ALTER TABLE `nf_menu` DISABLE KEYS */;
INSERT INTO `nf_menu` VALUES (1,'dashboard','Dashboard','icon-home',1,1,NULL);
/*!40000 ALTER TABLE `nf_menu` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-21 12:47:28
