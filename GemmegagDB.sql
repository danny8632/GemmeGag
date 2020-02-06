-- --------------------------------------------------------
-- Vært:                         127.0.0.1
-- Server-version:               10.1.34-MariaDB - mariadb.org binary distribution
-- ServerOS:                     Win32
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for gemmegag
DROP DATABASE IF EXISTS `gemmegag`;
CREATE DATABASE IF NOT EXISTS `gemmegag` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_danish_ci */;
USE `gemmegag`;

-- Dumping structure for tabel gemmegag.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(20000) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `postID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `CommentPostid` (`postID`),
  KEY `commentUserID` (`userID`),
  CONSTRAINT `CommentPostid` FOREIGN KEY (`postID`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `commentUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- Data exporting was unselected.

-- Dumping structure for tabel gemmegag.commentvotes
DROP TABLE IF EXISTS `commentvotes`;
CREATE TABLE IF NOT EXISTS `commentvotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote` enum('Upvote','Downvote') COLLATE utf8_danish_ci NOT NULL,
  `commentID` int(11) NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `CommentVoteID` (`commentID`),
  KEY `CommentVoteUserID` (`userID`),
  CONSTRAINT `CommentVoteID` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CommentVoteUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- Data exporting was unselected.

-- Dumping structure for tabel gemmegag.posts
DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `file` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `userid` (`userID`),
  CONSTRAINT `userid` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- Data exporting was unselected.

-- Dumping structure for tabel gemmegag.postvotes
DROP TABLE IF EXISTS `postvotes`;
CREATE TABLE IF NOT EXISTS `postvotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vote` enum('Upvote','Downvote') COLLATE utf8_danish_ci NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `PostVoteID` (`postID`),
  KEY `PostVoteUserID` (`userID`),
  CONSTRAINT `PostVoteID` FOREIGN KEY (`postID`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `PostVoteUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- Data exporting was unselected.

-- Dumping structure for tabel gemmegag.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modifed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
