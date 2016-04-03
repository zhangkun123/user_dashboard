CREATE DATABASE  IF NOT EXISTS `dashboard` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `dashboard`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: 127.0.0.1    Database: dashboard
-- ------------------------------------------------------
-- Server version	5.5.38

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
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created_by` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES (1,13,'9','Hello first','2015-02-27 22:29:12','2015-02-27 22:29:12'),(2,13,'9','Second post','2015-02-27 22:34:11','2015-02-27 22:34:11'),(3,9,'9','Another post','2015-02-27 22:37:02','2015-02-27 22:37:02'),(4,13,'9','ss','2015-02-27 22:41:06','2015-02-27 22:41:06'),(5,9,'9','s','2015-02-27 22:46:23','2015-02-27 22:46:23'),(6,9,'9','aother','2015-02-27 22:46:41','2015-02-27 22:46:41'),(7,13,'9','sss','2015-02-27 22:55:47','2015-02-27 22:55:47'),(8,13,'9','sss','2015-02-27 22:56:34','2015-02-27 22:56:34'),(9,13,'9','ss','2015-02-27 22:57:04','2015-02-27 22:57:04'),(10,13,'9','ss','2015-02-27 22:59:55','2015-02-27 22:59:55'),(11,9,'9','ss','2015-02-27 23:40:31','2015-02-27 23:40:31'),(12,9,'9','ss','2015-02-27 23:41:35','2015-02-27 23:41:35'),(13,9,'9','ss','2015-02-27 23:42:22','2015-02-27 23:42:22'),(14,9,'9',',adfs','2015-02-27 23:44:10','2015-02-27 23:44:10'),(15,9,'9',',adfs','2015-02-27 23:46:36','2015-02-27 23:46:36'),(16,9,'9','ss','2015-02-27 23:46:39','2015-02-27 23:46:39'),(17,9,'9','ss','2015-02-27 23:48:34','2015-02-27 23:48:34'),(18,9,'9','ss','2015-02-27 23:48:56','2015-02-27 23:48:56'),(19,9,'9','ss','2015-02-27 23:49:33','2015-02-27 23:49:33'),(20,9,'9','ss','2015-02-27 23:49:53','2015-02-27 23:49:53'),(21,13,'9','comment for raj','2015-02-27 23:56:47','2015-02-27 23:56:47'),(22,13,'9','comment for raj','2015-02-27 23:57:45','2015-02-27 23:57:45'),(23,13,'9','Another for raj','2015-02-28 00:21:20','2015-02-28 00:21:20'),(24,13,'13','<dl>\n  <dt>Coffee</dt>\n  <dd>Black hot drink</dd>\n  <dt>Milk</dt>\n  <dd>White cold drink</dd>\n</dl>\n\n</body>\n</html>','2015-02-28 00:39:51','2015-02-28 00:39:51'),(25,13,'9','ss','2015-02-28 20:23:42','2015-02-28 20:23:42'),(26,13,'9','d','2015-02-28 20:24:37','2015-02-28 20:24:37'),(27,9,'9','ffas','2015-03-01 08:41:27','2015-03-01 08:41:27'),(28,13,'9','dD','2015-03-02 23:07:17','2015-03-02 23:07:17'),(29,13,'9','kl','2015-03-02 23:17:53','2015-03-02 23:17:53'),(30,13,'9','ss','2015-03-02 23:29:24','2015-03-02 23:29:24'),(31,9,'9','asdasd','2015-03-02 23:45:43','2015-03-02 23:45:43'),(32,13,'9','asd','2015-03-02 23:47:09','2015-03-02 23:47:09'),(33,13,'9','asdsA','2015-03-02 23:49:50','2015-03-02 23:49:50'),(34,13,'9','SS','2015-03-02 23:51:53','2015-03-02 23:51:53'),(35,13,'9','SSSS','2015-03-02 23:52:20','2015-03-02 23:52:20'),(36,13,'9','ASDA','2015-03-02 23:52:51','2015-03-02 23:52:51'),(37,14,'9','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,','2015-03-03 01:04:22','2015-03-03 01:04:22'),(38,14,'9','ss','2015-03-03 01:17:00','2015-03-03 01:17:00'),(39,14,'16','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the','2015-03-03 01:26:04','2015-03-03 01:26:04');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `user_level` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'Simi','Raj','simi.tresa.antony@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','admin','2015-02-27 18:39:40','2015-02-27 18:39:40'),(14,'Rajamani','Josey','rajmjss83@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','user','2015-03-03 00:52:38','2015-03-03 00:52:38'),(16,'Ravi','Sholk','raj@gmail.com','81dc9bdb52d04dc20036dbd8313ed055','user','2015-03-03 01:25:34','2015-03-03 01:25:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `created_by` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,'9','ss','2015-02-28 20:19:29','2015-02-28 20:19:29'),(2,4,'9','dAD','2015-02-28 20:19:49','2015-02-28 20:19:49'),(3,7,'9','dd','2015-02-28 20:21:47','2015-02-28 20:21:47'),(4,8,'9','ss','2015-02-28 20:22:55','2015-02-28 20:22:55'),(5,2,'9','s','2015-02-28 20:23:04','2015-02-28 20:23:04'),(6,2,'9','ss','2015-02-28 20:23:26','2015-02-28 20:23:26'),(7,25,'9','ss','2015-02-28 20:23:52','2015-02-28 20:23:52'),(8,2,'9','DDD','2015-02-28 20:24:59','2015-02-28 20:24:59'),(9,2,'9','adadas','2015-03-01 08:27:16','2015-03-01 08:27:16'),(10,1,'9','d','2015-03-01 08:27:28','2015-03-01 08:27:28'),(11,1,'9','dqq','2015-03-01 08:27:37','2015-03-01 08:27:37'),(12,26,'9','ss','2015-03-01 08:28:04','2015-03-01 08:28:04'),(13,26,'9','hello new','2015-03-01 08:28:19','2015-03-01 08:28:19'),(14,7,'9','dqwd','2015-03-01 08:40:48','2015-03-01 08:40:48'),(15,1,'9','ssa','2015-03-02 22:59:24','2015-03-02 22:59:24'),(16,1,'9','fefqwef','2015-03-02 23:12:20','2015-03-02 23:12:20'),(17,37,'9','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the ','2015-03-03 01:04:30','2015-03-03 01:04:30'),(18,37,'9','saS','2015-03-03 01:10:30','2015-03-03 01:10:30'),(19,37,'9','sad','2015-03-03 01:16:01','2015-03-03 01:16:01'),(20,37,'9','hello howdy','2015-03-03 01:16:32','2015-03-03 01:16:32'),(21,37,'9','ss','2015-03-03 01:17:04','2015-03-03 01:17:04'),(22,37,'9','ss','2015-03-03 01:18:00','2015-03-03 01:18:00'),(23,37,'9','ss','2015-03-03 01:18:41','2015-03-03 01:18:41'),(24,37,'9','hello how r u','2015-03-03 01:19:12','2015-03-03 01:19:12'),(25,37,'9','hello how r u','2015-03-03 01:19:38','2015-03-03 01:19:38'),(26,37,'9','howdasd','2015-03-03 01:20:46','2015-03-03 01:20:46'),(27,37,'9','dsfasdf','2015-03-03 01:20:59','2015-03-03 01:20:59'),(28,38,'9','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the','2015-03-03 01:22:21','2015-03-03 01:22:21'),(29,39,'16','Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the','2015-03-03 01:26:14','2015-03-03 01:26:14');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-03-02 23:29:08
