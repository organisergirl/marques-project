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
-- Table structure for table `australian_states`
--

DROP TABLE IF EXISTS `australian_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `australian_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'the unique identifier for a state',
  `shortname` varchar(3) CHARACTER SET latin1 NOT NULL COMMENT 'the short name for the state',
  `longname` varchar(30) CHARACTER SET latin1 NOT NULL COMMENT 'the long name for the state',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store details of australian states';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `film_weekly_archaeology`
--

DROP TABLE IF EXISTS `film_weekly_archaeology`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_weekly_archaeology` (
  `film_weekly_cinemas_id` int(11) NOT NULL COMMENT 'the unique identifier of a film weekly cinema id',
  `film_weekly_categories_id` int(11) NOT NULL COMMENT 'the unique identifier for a film weekly category',
  `cinema_name` varchar(512) NOT NULL COMMENT 'the name of the cinema',
  `exhibitor_name` varchar(512) NOT NULL COMMENT 'the name of the exhibitor',
  `capacity` smallint(6) NOT NULL COMMENT 'the capacity of the theatre',
  `film_weekly_cinema_types_id` int(11) NOT NULL COMMENT 'the type of cinema',
  PRIMARY KEY (`film_weekly_cinemas_id`,`film_weekly_categories_id`),
  KEY `film_weekly_cinemas_id` (`film_weekly_cinemas_id`),
  KEY `film_weekly_categories_id` (`film_weekly_categories_id`),
  KEY `film_weekly_cinema_types_id` (`film_weekly_cinema_types_id`),
  CONSTRAINT `fk_film_weekly_cinema_types_id` FOREIGN KEY (`film_weekly_cinema_types_id`) REFERENCES `film_weekly_cinema_types` (`id`),
  CONSTRAINT `fk_film_weekly_categories` FOREIGN KEY (`film_weekly_categories_id`) REFERENCES `film_weekly_categories` (`id`),
  CONSTRAINT `fk_film_weekly_cinemas_id` FOREIGN KEY (`film_weekly_cinemas_id`) REFERENCES `film_weekly_cinemas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `film_weekly_categories`
--

DROP TABLE IF EXISTS `film_weekly_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_weekly_categories` (
  `id` int(11) NOT NULL COMMENT 'the unique identifier for the film weekly category',
  `description` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'the description of this category',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store details of the film weekly categories';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `film_weekly_category_maps`
--

DROP TABLE IF EXISTS `film_weekly_category_maps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_weekly_category_maps` (
  `film_weekly_cinemas_id` int(11) NOT NULL COMMENT 'unique identifier of a film weekly cinema',
  `film_weekly_categories_id` int(11) NOT NULL COMMENT 'unique identifier of a film weekly category',
  PRIMARY KEY (`film_weekly_cinemas_id`,`film_weekly_categories_id`),
  KEY `idx_film_weekly_cinemas_id` (`film_weekly_cinemas_id`),
  KEY `idx_film_weekly_categories_id` (`film_weekly_categories_id`),
  CONSTRAINT `fk_film_weekly_categories_id_map` FOREIGN KEY (`film_weekly_categories_id`) REFERENCES `film_weekly_categories` (`id`),
  CONSTRAINT `fk_film_weekly_cinemas_id_map` FOREIGN KEY (`film_weekly_cinemas_id`) REFERENCES `film_weekly_cinemas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store details of the relationship between film weekly cinema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `film_weekly_cinema_types`
--

DROP TABLE IF EXISTS `film_weekly_cinema_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_weekly_cinema_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'the unique identifier for this cinema type',
  `description` varchar(256) CHARACTER SET latin1 NOT NULL COMMENT 'the description of this cinema type',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store details of the cinema types in the film weekly databas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `film_weekly_cinemas`
--

DROP TABLE IF EXISTS `film_weekly_cinemas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `film_weekly_cinemas` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique identifier for each film weekly cinema',
  `latitude` float NOT NULL COMMENT 'the latitude geographic coordinate in decimal degrees',
  `longitude` float NOT NULL,
  `australian_states_id` int(11) NOT NULL COMMENT 'the identifier for the state',
  `locality_types_id` int(11) NOT NULL COMMENT 'the identifier for the locality',
  `film_weekly_cinema_types_id` int(11) NOT NULL COMMENT 'the type of cinema',
  `street` varchar(512) CHARACTER SET latin1 NOT NULL COMMENT 'the street address for the cinema',
  `suburb_town` varchar(512) CHARACTER SET latin1 NOT NULL COMMENT 'suburb or town name',
  `postcode` varchar(4) CHARACTER SET latin1 NOT NULL COMMENT 'the postcode',
  `cinema_name` varchar(512) CHARACTER SET latin1 NOT NULL COMMENT 'the name of the cinema',
  `exhibitor_name` varchar(512) CHARACTER SET latin1 NOT NULL COMMENT 'the name of the exhibitor',
  `capacity` smallint(6) NOT NULL COMMENT 'the capacity of the theatre',
  PRIMARY KEY (`id`),
  KEY `idx_australian_states_id` (`australian_states_id`) USING BTREE,
  KEY `idx_locality_type_id` (`locality_types_id`) USING BTREE,
  KEY `idx_film_weekly_cinema_type_id` (`film_weekly_cinema_types_id`) USING BTREE,
  CONSTRAINT `fk_australian_states` FOREIGN KEY (`australian_states_id`) REFERENCES `australian_states` (`id`),
  CONSTRAINT `fk_film_weekly_cinema_types` FOREIGN KEY (`film_weekly_cinema_types_id`) REFERENCES `film_weekly_cinema_types` (`id`),
  CONSTRAINT `fk_locality_types` FOREIGN KEY (`locality_types_id`) REFERENCES `locality_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store details of cinemas referenced in the film weekly datas';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `locality_types`
--

DROP TABLE IF EXISTS `locality_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locality_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique identifier for the locality type',
  `description` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'description of the locality',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='store details of the different types of localities';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique primary id for the user',
  `username` varchar(25) CHARACTER SET latin1 NOT NULL COMMENT 'username for the user',
  `password` varchar(255) CHARACTER SET latin1 NOT NULL COMMENT 'password for the user',
  `firstname` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'first name of the user',
  `lastname` varchar(50) CHARACTER SET latin1 NOT NULL COMMENT 'last name of the user',
  `email` varchar(512) CHARACTER SET latin1 NOT NULL COMMENT 'email address of the user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='store details of users';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-09-02 16:33:24
