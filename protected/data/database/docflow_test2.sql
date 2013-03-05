-- MySQL dump 10.13  Distrib 5.5.24, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: docflow_test2
-- ------------------------------------------------------
-- Server version	5.5.24-0ubuntu0.12.04.1

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
-- Table structure for table `adm_users`
--

DROP TABLE IF EXISTS `adm_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adm_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adm_users`
--

LOCK TABLES `adm_users` WRITE;
/*!40000 ALTER TABLE `adm_users` DISABLE KEYS */;
INSERT INTO `adm_users` VALUES (1,'petru','petru','123'),(2,'system','system','123'),(3,'demo','demo','demo'),(4,'admin','admin','admin');
/*!40000 ALTER TABLE `adm_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dt_letter_history`
--

DROP TABLE IF EXISTS `dt_letter_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dt_letter_history` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `DataTime` datetime NOT NULL,
  `Action_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Doc_version` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt_letter_history`
--

LOCK TABLES `dt_letter_history` WRITE;
/*!40000 ALTER TABLE `dt_letter_history` DISABLE KEYS */;
INSERT INTO `dt_letter_history` VALUES (1,'2012-12-03 11:44:25',2,1,1,21),(2,'2012-12-03 11:45:14',2,1,1,21),(3,'2012-12-03 11:45:36',1,1,1,33),(4,'2012-12-03 11:46:27',2,1,1,21),(5,'2012-12-03 11:47:15',2,1,1,25),(6,'2012-12-04 10:19:24',2,1,1,25),(7,'2012-12-04 11:52:49',2,1,1,21),(8,'2012-12-04 11:52:51',2,1,1,21),(9,'2012-12-04 06:43:42',2,1,1,21),(10,'2013-02-13 05:04:06',1,3,1,38);
/*!40000 ALTER TABLE `dt_letter_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dt_letters`
--

DROP TABLE IF EXISTS `dt_letters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dt_letters` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documentId` int(11) NOT NULL,
  `message` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `documentId` (`documentId`),
  CONSTRAINT `dt_letters_ibfk_1` FOREIGN KEY (`documentId`) REFERENCES `sys_documents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt_letters`
--

LOCK TABLES `dt_letters` WRITE;
/*!40000 ALTER TABLE `dt_letters` DISABLE KEYS */;
INSERT INTO `dt_letters` VALUES (14,21,'11112 34 tt'),(15,22,'222222'),(16,24,'gtgtgt'),(17,25,'phy rtti'),(18,26,'sql'),(19,28,'gwgswe'),(20,29,'54t vhy4b5 y'),(21,30,'fd4 t53t gd'),(22,33,'4567'),(23,38,'vbbbbbbbb');
/*!40000 ALTER TABLE `dt_letters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dt_letters_version`
--

DROP TABLE IF EXISTS `dt_letters_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dt_letters_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_format_id` int(11) DEFAULT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_id` int(11) DEFAULT NULL,
  `updateUserId` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_format_id` (`file_format_id`),
  KEY `updateUserId` (`updateUserId`),
  CONSTRAINT `dt_letters_version_ibfk_1` FOREIGN KEY (`file_format_id`) REFERENCES `sys_fileFormats` (`id`),
  CONSTRAINT `dt_letters_version_ibfk_2` FOREIGN KEY (`updateUserId`) REFERENCES `adm_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt_letters_version`
--

LOCK TABLES `dt_letters_version` WRITE;
/*!40000 ALTER TABLE `dt_letters_version` DISABLE KEYS */;
INSERT INTO `dt_letters_version` VALUES (14,6,'50b69b2d35afd.png',14,1,'2012-11-29 01:16:40'),(15,2,'50b69b585cd29.gif',14,1,'2012-11-29 23:40:08'),(16,5,'50b7d638e1631.jpg',14,1,'2013-02-10 23:45:39');
/*!40000 ALTER TABLE `dt_letters_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dt_notice_history`
--

DROP TABLE IF EXISTS `dt_notice_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dt_notice_history` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `DataTime` datetime NOT NULL,
  `Action_id` int(11) NOT NULL,
  `User_id` int(11) NOT NULL,
  `Doc_version` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt_notice_history`
--

LOCK TABLES `dt_notice_history` WRITE;
/*!40000 ALTER TABLE `dt_notice_history` DISABLE KEYS */;
INSERT INTO `dt_notice_history` VALUES (1,'2012-12-03 11:44:40',2,1,1,27),(2,'2012-12-03 11:44:46',2,1,1,27),(3,'2012-12-03 11:46:01',1,1,1,34),(4,'2012-12-04 11:01:04',2,1,1,27),(5,'2013-02-13 02:44:23',1,1,1,37),(6,'2013-02-13 02:44:47',2,1,1,37);
/*!40000 ALTER TABLE `dt_notice_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dt_notices`
--

DROP TABLE IF EXISTS `dt_notices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dt_notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `documentId` int(11) NOT NULL,
  `message` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `documentId` (`documentId`),
  CONSTRAINT `dt_notices_ibfk_1` FOREIGN KEY (`documentId`) REFERENCES `sys_documents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt_notices`
--

LOCK TABLES `dt_notices` WRITE;
/*!40000 ALTER TABLE `dt_notices` DISABLE KEYS */;
INSERT INTO `dt_notices` VALUES (6,23,'33333'),(7,27,'sssssss 22'),(8,31,'gxgs6 gc r htf'),(9,34,'5454334 43rt3'),(10,37,'qwwwwwwwwd 34');
/*!40000 ALTER TABLE `dt_notices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dt_notices_version`
--

DROP TABLE IF EXISTS `dt_notices_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dt_notices_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_format_id` int(11) DEFAULT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_id` int(11) DEFAULT NULL,
  `updateUserId` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `file_format_id` (`file_format_id`),
  KEY `updateUserId` (`updateUserId`),
  CONSTRAINT `dt_notices_version_ibfk_1` FOREIGN KEY (`file_format_id`) REFERENCES `sys_fileFormats` (`id`),
  CONSTRAINT `dt_notices_version_ibfk_2` FOREIGN KEY (`updateUserId`) REFERENCES `adm_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dt_notices_version`
--

LOCK TABLES `dt_notices_version` WRITE;
/*!40000 ALTER TABLE `dt_notices_version` DISABLE KEYS */;
INSERT INTO `dt_notices_version` VALUES (3,5,'50b69af7c78fe.jpg',6,1,'2012-11-29 23:35:09'),(4,5,'50b69cef8bc9f.jpg',7,1,'2013-02-15 12:09:30'),(5,4,'511e095b0902c.jpeg',7,1,'2013-02-15 12:12:21');
/*!40000 ALTER TABLE `dt_notices_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_documentCategories`
--

DROP TABLE IF EXISTS `sys_documentCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_documentCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_documentCategories`
--

LOCK TABLES `sys_documentCategories` WRITE;
/*!40000 ALTER TABLE `sys_documentCategories` DISABLE KEYS */;
INSERT INTO `sys_documentCategories` VALUES (1,'Input','input'),(2,'Intern','intern');
/*!40000 ALTER TABLE `sys_documentCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_documentTypes`
--

DROP TABLE IF EXISTS `sys_documentTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_documentTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instanceModelName` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `instanceModelName` (`instanceModelName`),
  UNIQUE KEY `route` (`route`),
  KEY `categoryId` (`categoryId`),
  CONSTRAINT `sys_documentTypes_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `sys_documentCategories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_documentTypes`
--

LOCK TABLES `sys_documentTypes` WRITE;
/*!40000 ALTER TABLE `sys_documentTypes` DISABLE KEYS */;
INSERT INTO `sys_documentTypes` VALUES (1,'Letter','letter','Letter',1),(2,'Notice','notice','Notice',2);
/*!40000 ALTER TABLE `sys_documentTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_documentaction`
--

DROP TABLE IF EXISTS `sys_documentaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_documentaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_documentaction`
--

LOCK TABLES `sys_documentaction` WRITE;
/*!40000 ALTER TABLE `sys_documentaction` DISABLE KEYS */;
INSERT INTO `sys_documentaction` VALUES (1,'Create'),(2,'Update'),(3,'MoveToOperativ'),(4,'MoveToArhiv'),(5,'Delete');
/*!40000 ALTER TABLE `sys_documentaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_documents`
--

DROP TABLE IF EXISTS `sys_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `file_format_id` int(11) DEFAULT NULL,
  `file` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instance_id` int(11) DEFAULT NULL,
  `checkOutUserId` int(11) DEFAULT NULL,
  `createUserId` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `updateUserId` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `file_format_id` (`file_format_id`),
  KEY `createUserId` (`createUserId`),
  KEY `updateUserId` (`updateUserId`),
  CONSTRAINT `sys_documents_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `sys_documentTypes` (`id`),
  CONSTRAINT `sys_documents_ibfk_2` FOREIGN KEY (`file_format_id`) REFERENCES `sys_fileFormats` (`id`),
  CONSTRAINT `sys_documents_ibfk_3` FOREIGN KEY (`createUserId`) REFERENCES `adm_users` (`id`),
  CONSTRAINT `sys_documents_ibfk_4` FOREIGN KEY (`updateUserId`) REFERENCES `adm_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_documents`
--

LOCK TABLES `sys_documents` WRITE;
/*!40000 ALTER TABLE `sys_documents` DISABLE KEYS */;
INSERT INTO `sys_documents` VALUES (21,'Letter 1418202408',1,6,'51181503dcdf8.png',14,NULL,1,'2012-11-29 01:14:36',1,'2013-02-10 23:45:39'),(22,'Letter 1671738273',1,5,'50b69aebc67d8.jpg',15,1,1,'2012-11-29 01:14:51',1,'2013-02-10 23:30:16'),(23,'Notice 112846788',2,5,'50b7d52954627.jpg',6,NULL,1,'2012-11-29 01:15:03',1,'2012-11-29 23:35:37'),(24,'Letter 2125594499',1,6,'50b69b8d25898.png',16,NULL,1,'2012-11-29 01:17:33',1,'2012-11-29 01:17:37'),(25,'Letter 1940980672',1,1,'50b69c62385b1.pdf',17,1,1,'2012-11-29 01:21:06',1,'2012-12-04 10:19:24'),(26,'Letter 1544097090',1,3,'50b69ccdefb87.sql',18,1,1,'2012-11-29 01:22:53',1,'2012-12-04 18:44:20'),(27,'Notice 679776724',2,6,'511e0a05e6a52.png',7,NULL,1,'2012-11-29 01:23:27',1,'2013-02-15 12:12:21'),(28,'Letter 1769654531',1,5,'50b7d555b4436.jpg',19,3,1,'2012-11-29 23:36:21',3,'2013-02-22 17:53:11'),(29,'Letter 2043573257',1,5,'50b7d5c14b80e.jpg',20,1,1,'2012-11-29 23:38:09',1,'2012-12-11 18:25:37'),(30,'Letter 2127341460',1,5,'50b7d5cf5cd6c.jpg',21,3,1,'2012-11-29 23:38:23',3,'2013-02-22 17:53:38'),(31,'Notice 15010308',2,2,'50b7d610746fb.gif',8,NULL,1,'2012-11-29 23:39:28',1,'2012-11-29 23:39:33'),(32,'Letter 1471286189',1,6,'50bbd2c227b49.png',NULL,NULL,1,'2012-12-03 00:14:26',NULL,NULL),(33,'Letter 694479262',1,6,'50bd1d7c6b12e.png',22,NULL,1,'2012-12-03 23:45:32',1,'2012-12-03 23:45:36'),(34,'Notice 1797393595',2,6,'50bd1d9409dc5.png',9,NULL,1,'2012-12-03 23:45:56',1,'2012-12-03 23:46:01'),(35,'Letter 123123',1,1,'123123.pdf',NULL,NULL,1,'2013-02-12 07:00:00',NULL,NULL),(36,'Letter 2013128_195025',1,1,'2013128_195025.pdf',22,NULL,1,'2013-01-28 19:50:25',NULL,NULL),(37,'Notice 1771101497',2,6,'511ae1e1927c2.png',10,NULL,1,'2013-02-13 02:44:17',1,'2013-02-13 02:44:47'),(38,'Letter 1464060756',1,4,'511bab617bb27.jpeg',23,NULL,3,'2013-02-13 17:04:01',3,'2013-02-13 17:04:06');
/*!40000 ALTER TABLE `sys_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_fileFormats`
--

DROP TABLE IF EXISTS `sys_fileFormats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_fileFormats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `extension` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `contentType` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_fileFormats`
--

LOCK TABLES `sys_fileFormats` WRITE;
/*!40000 ALTER TABLE `sys_fileFormats` DISABLE KEYS */;
INSERT INTO `sys_fileFormats` VALUES (1,'PDF','pdf','application/pdf','icons/objects/pdf.png'),(2,'GIF','gif','image/gif','icons/objects/image.png'),(3,'SQL','sql','text/plain','icons/objects/document.png'),(4,'JPEG','jpeg','image/jpeg','icons/objects/image.png'),(5,'JPG','jpg','image/jpeg','icons/objects/image.png'),(6,'PNG','png','image/png','icons/objects/image.png');
/*!40000 ALTER TABLE `sys_fileFormats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_folderContentTypes`
--

DROP TABLE IF EXISTS `sys_folderContentTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_folderContentTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `icon` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_folderContentTypes`
--

LOCK TABLES `sys_folderContentTypes` WRITE;
/*!40000 ALTER TABLE `sys_folderContentTypes` DISABLE KEYS */;
INSERT INTO `sys_folderContentTypes` VALUES (1,'model','folder-model.png'),(2,'search','folder-search.png'),(3,'sample','folder-sample.png');
/*!40000 ALTER TABLE `sys_folderContentTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_folderTypes`
--

DROP TABLE IF EXISTS `sys_folderTypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_folderTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_folderTypes`
--

LOCK TABLES `sys_folderTypes` WRITE;
/*!40000 ALTER TABLE `sys_folderTypes` DISABLE KEYS */;
INSERT INTO `sys_folderTypes` VALUES (2,'created'),(1,'system');
/*!40000 ALTER TABLE `sys_folderTypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_folders`
--

DROP TABLE IF EXISTS `sys_folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_folders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `route` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `contenttype_id` int(11) NOT NULL,
  `searchCriteria` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documenttype_id` int(11) DEFAULT NULL,
  `createUserId` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `updateUserId` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `route` (`route`),
  KEY `parentId` (`parentId`),
  KEY `type_id` (`type_id`),
  KEY `contenttype_id` (`contenttype_id`),
  KEY `documenttype_id` (`documenttype_id`),
  KEY `createUserId` (`createUserId`),
  KEY `updateUserId` (`updateUserId`),
  CONSTRAINT `sys_folders_ibfk_1` FOREIGN KEY (`parentId`) REFERENCES `sys_folders` (`id`),
  CONSTRAINT `sys_folders_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `sys_folderTypes` (`id`),
  CONSTRAINT `sys_folders_ibfk_3` FOREIGN KEY (`contenttype_id`) REFERENCES `sys_folderContentTypes` (`id`),
  CONSTRAINT `sys_folders_ibfk_4` FOREIGN KEY (`documenttype_id`) REFERENCES `sys_documentTypes` (`id`),
  CONSTRAINT `sys_folders_ibfk_5` FOREIGN KEY (`createUserId`) REFERENCES `adm_users` (`id`),
  CONSTRAINT `sys_folders_ibfk_6` FOREIGN KEY (`updateUserId`) REFERENCES `adm_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_folders`
--

LOCK TABLES `sys_folders` WRITE;
/*!40000 ALTER TABLE `sys_folders` DISABLE KEYS */;
INSERT INTO `sys_folders` VALUES (1,NULL,NULL,'Common',1,3,NULL,NULL,2,'0000-00-00 00:00:00',NULL,NULL),(2,1,NULL,'Input',1,3,NULL,NULL,2,'0000-00-00 00:00:00',NULL,NULL),(3,1,NULL,'Intern',1,3,NULL,NULL,2,'0000-00-00 00:00:00',NULL,NULL),(4,NULL,'favorites','Favorites',1,3,NULL,NULL,2,'0000-00-00 00:00:00',NULL,NULL),(5,2,'letter','Letters',2,1,NULL,1,1,'2012-08-21 12:00:00',NULL,NULL),(6,3,'notice','Notices',2,1,NULL,2,1,'2012-08-21 12:00:00',NULL,NULL),(7,NULL,'utils','Utils',2,3,NULL,NULL,1,'2012-08-21 12:00:00',NULL,NULL),(8,NULL,'testSearch','Test Search',2,2,'id > 1',1,1,'2012-08-21 12:00:00',NULL,NULL);
/*!40000 ALTER TABLE `sys_folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_foldersContents`
--

DROP TABLE IF EXISTS `sys_foldersContents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_foldersContents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `folderId` int(11) NOT NULL,
  `documentId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `folderId` (`folderId`),
  KEY `documentId` (`documentId`),
  CONSTRAINT `sys_foldersContents_ibfk_1` FOREIGN KEY (`folderId`) REFERENCES `sys_folders` (`id`),
  CONSTRAINT `sys_foldersContents_ibfk_2` FOREIGN KEY (`documentId`) REFERENCES `sys_documents` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_foldersContents`
--

LOCK TABLES `sys_foldersContents` WRITE;
/*!40000 ALTER TABLE `sys_foldersContents` DISABLE KEYS */;
INSERT INTO `sys_foldersContents` VALUES (33,4,21),(34,4,22),(35,4,25),(36,4,26),(37,4,27),(38,7,21),(39,7,25),(40,7,26),(41,7,28),(42,7,22),(43,7,24),(44,4,24),(45,4,28),(46,4,29),(47,4,30),(48,4,32),(49,4,33),(50,4,37),(51,7,27),(52,7,29),(53,7,30),(54,7,32);
/*!40000 ALTER TABLE `sys_foldersContents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_storagegeneralinfo`
--

DROP TABLE IF EXISTS `sys_storagegeneralinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_storagegeneralinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `createUserId` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `updateUserId` int(11) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_storagegeneralinfo`
--

LOCK TABLES `sys_storagegeneralinfo` WRITE;
/*!40000 ALTER TABLE `sys_storagegeneralinfo` DISABLE KEYS */;
INSERT INTO `sys_storagegeneralinfo` VALUES (0,'FormateAdmisibile','png,jpg,jpeg,gif,sql,pdf',0,'2012-10-16 00:16:29',NULL,NULL),(1,'minSize','100',0,'2012-10-16 00:17:14',NULL,NULL),(2,'maxSize','10485760',0,'2012-10-16 00:18:43',NULL,NULL);
/*!40000 ALTER TABLE `sys_storagegeneralinfo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-02-25 10:07:12
