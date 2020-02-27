-- MariaDB dump 10.17  Distrib 10.4.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: gemmegag
-- ------------------------------------------------------
-- Server version	10.4.12-MariaDB-1:10.4.12+maria~bionic

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `gemmegag`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `gemmegag` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `gemmegag`;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Funny',NULL,'Dette er rigtig sjovt','2020-02-25 20:39:57','2020-02-25 20:39:57'),(2,'Dankmark',NULL,'Fuck svensken','2020-02-25 20:40:36','2020-02-25 20:40:36'),(3,'Animals',NULL,'Funny af cats','2020-02-26 07:16:55','2020-02-26 07:16:55'),(4,'Gaming',NULL,'GG','2020-02-26 07:17:07','2020-02-26 07:17:07'),(5,'Awesome',NULL,'This is nice','2020-02-26 07:17:17','2020-02-26 07:17:17'),(6,'Meme',NULL,'Migmiger','2020-02-26 07:17:27','2020-02-26 07:17:27'),(7,'UnixPorn',NULL,'Style your linux','2020-02-26 07:17:48','2020-02-26 07:17:48'),(8,'TechTips',NULL,'Linus Tech Tips','2020-02-26 07:18:01','2020-02-26 07:18:01'),(9,'Wauw',NULL,'Wauw this is so wauw','2020-02-26 07:18:28','2020-02-26 07:18:28'),(10,'NSFW',NULL,'Not Safe For Work','2020-02-26 07:19:51','2020-02-26 07:19:51'),(11,'Christian Minecraft',NULL,'Holy bible','2020-02-26 07:20:15','2020-02-26 07:20:15');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(20000) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `postID` int(11) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `CommentPostid` (`postID`),
  KEY `commentUserID` (`userID`),
  CONSTRAINT `CommentPostid` FOREIGN KEY (`postID`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `commentUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commentvotes`
--

DROP TABLE IF EXISTS `commentvotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commentvotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote` enum('Upvote','Downvote') COLLATE utf8_danish_ci NOT NULL,
  `commentID` int(11) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `CommentVoteID` (`commentID`),
  KEY `CommentVoteUserID` (`userID`),
  CONSTRAINT `CommentVoteID` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CommentVoteUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commentvotes`
--

LOCK TABLES `commentvotes` WRITE;
/*!40000 ALTER TABLE `commentvotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `commentvotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postCategoryRelation`
--

DROP TABLE IF EXISTS `postCategoryRelation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postCategoryRelation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `postRelation` (`postID`),
  KEY `cateRelation` (`categoryID`),
  CONSTRAINT `cateRelation` FOREIGN KEY (`categoryID`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `postRelation` FOREIGN KEY (`postID`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postCategoryRelation`
--

LOCK TABLES `postCategoryRelation` WRITE;
/*!40000 ALTER TABLE `postCategoryRelation` DISABLE KEYS */;
/*!40000 ALTER TABLE `postCategoryRelation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `file` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `userid` (`userID`),
  CONSTRAINT `userid` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postvotes`
--

DROP TABLE IF EXISTS `postvotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postvotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote` enum('Upvote','Downvote') COLLATE utf8_danish_ci NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `PostVoteID` (`postID`),
  KEY `PostVoteUserID` (`userID`),
  CONSTRAINT `PostVoteID` FOREIGN KEY (`postID`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `PostVoteUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postvotes`
--

LOCK TABLES `postvotes` WRITE;
/*!40000 ALTER TABLE `postvotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `postvotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `trending_posts`
--

DROP TABLE IF EXISTS `trending_posts`;
/*!50001 DROP VIEW IF EXISTS `trending_posts`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `trending_posts` (
  `id` tinyint NOT NULL,
  `title` tinyint NOT NULL,
  `description` tinyint NOT NULL,
  `file` tinyint NOT NULL,
  `created` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `username` tinyint NOT NULL,
  `TotalVotes` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ben','bensand','1234','2020-02-11 07:41:10','2020-02-11 07:41:10'),(2,'troels','troels_larsen','$2y$10$whnSrsViolDaueAzTB.dLOcGWqfQ2vYH4Vs4D13Uft1uX/fm/thsW','2020-02-13 07:43:55','2020-02-13 07:43:55'),(3,'danny','danny8632','$2y$10$VqoNHdlUlnVswIISuLKy7.QKUin/mHCUQx8XHXFbOEZLx0PGDznv6','2020-02-25 08:15:16','2020-02-25 08:15:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `gemmegag`
--

USE `gemmegag`;

--
-- Final view structure for view `trending_posts`
--

/*!50001 DROP TABLE IF EXISTS `trending_posts`*/;
/*!50001 DROP VIEW IF EXISTS `trending_posts`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `trending_posts` AS select `posts`.`id` AS `id`,`posts`.`title` AS `title`,`posts`.`description` AS `description`,`posts`.`file` AS `file`,`posts`.`created` AS `created`,`users`.`name` AS `name`,`users`.`username` AS `username`,sum(case when `postvotes`.`vote` is not null then if(`postvotes`.`vote` = 'Upvote',1,-1) end) AS `TotalVotes` from ((`posts` left join `users` on(`posts`.`userID` = `users`.`id`)) left join `postvotes` on(`posts`.`id` = `postvotes`.`postID`)) where timestampdiff(HOUR,`posts`.`created`,current_timestamp()) < 5 group by `posts`.`id`,`postvotes`.`postID` order by sum(case when `postvotes`.`vote` is not null then if(`postvotes`.`vote` = 'Upvote',1,-1) end) desc */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-27  8:20:39
