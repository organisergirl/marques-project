-- MySQL dump 10.13  Distrib 5.1.57, for apple-darwin11.1.0 (i386)
--
-- Host: localhost    Database: marques
-- ------------------------------------------------------
-- Server version	5.1.57

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
-- Table structure for table `basic_markers`
--

DROP TABLE IF EXISTS `basic_markers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `basic_markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'the unique id for this marker',
  `title` varchar(255) NOT NULL COMMENT 'title of the marker',
  `description` text NOT NULL COMMENT 'the description for the marker',
  `latitude` float NOT NULL COMMENT 'the latitude geographic coordinate',
  `longitude` float NOT NULL COMMENT 'the longitude geographic coordinate',
  `created` datetime NOT NULL COMMENT 'the date and time this marker was created',
  `updated` datetime DEFAULT NULL COMMENT 'the date and time that this marker was updated',
  PRIMARY KEY (`id`),
  KEY `index_title` (`title`),
  FULLTEXT KEY `index_description` (`description`),
  FULLTEXT KEY `index_title_description` (`title`,`description`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='A table that represents a simple marker';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique primary id for the user',
  `username` varchar(25) NOT NULL COMMENT 'username for the user',
  `password` varchar(255) NOT NULL COMMENT 'password for the user',
  `firstname` varchar(50) NOT NULL COMMENT 'first name of the user',
  `lastname` varchar(50) NOT NULL COMMENT 'last name of the user',
  `email` varchar(512) NOT NULL COMMENT 'email address of the user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1 COMMENT='store details of users in the MARQues system';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-08-30 17:04:33
