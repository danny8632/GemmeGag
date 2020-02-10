-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 10, 2020 at 12:15 PM
-- Server version: 10.4.12-MariaDB-1:10.4.12+maria~bionic
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gemmegag`
--
DROP DATABASE IF EXISTS `gemmegag`;
CREATE DATABASE IF NOT EXISTS `gemmegag` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_danish_ci */;
USE `gemmegag`;
-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(20000) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `postID` int(11) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commentvotes`
--

CREATE TABLE `commentvotes` (
  `id` int(11) NOT NULL,
  `vote` enum('Upvote','Downvote') COLLATE utf8_danish_ci NOT NULL,
  `commentID` int(11) NOT NULL DEFAULT 0,
  `userID` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `description` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `file` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `userID` int(11) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `postvotes`
--

CREATE TABLE `postvotes` (
  `id` int(11) NOT NULL,
  `vote` enum('Upvote','Downvote') COLLATE utf8_danish_ci NOT NULL,
  `postID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `trending_posts`
-- (See below for the actual view)
--
CREATE TABLE `trending_posts` (
`id` int(11)
,`title` varchar(255)
,`created` timestamp
,`Total` bigint(21)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8_danish_ci NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modifed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci;

-- --------------------------------------------------------

--
-- Structure for view `trending_posts`
--
DROP TABLE IF EXISTS `trending_posts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `trending_posts`  AS  select `posts`.`id` AS `id`,`posts`.`title` AS `title`,`posts`.`created` AS `created`,(select count(`postvotes`.`postID`) from `postvotes` where `posts`.`id` = `postvotes`.`postID` and `postvotes`.`vote` = 'Upvote') AS `Total` from `posts` where timestampdiff(HOUR,`posts`.`created`,current_timestamp()) < 2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CommentPostid` (`postID`),
  ADD KEY `commentUserID` (`userID`);

--
-- Indexes for table `commentvotes`
--
ALTER TABLE `commentvotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CommentVoteID` (`commentID`),
  ADD KEY `CommentVoteUserID` (`userID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userID`);

--
-- Indexes for table `postvotes`
--
ALTER TABLE `postvotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PostVoteID` (`postID`),
  ADD KEY `PostVoteUserID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commentvotes`
--
ALTER TABLE `commentvotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `postvotes`
--
ALTER TABLE `postvotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `CommentPostid` FOREIGN KEY (`postID`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `commentvotes`
--
ALTER TABLE `commentvotes`
  ADD CONSTRAINT `CommentVoteID` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `CommentVoteUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `postvotes`
--
ALTER TABLE `postvotes`
  ADD CONSTRAINT `PostVoteID` FOREIGN KEY (`postID`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `PostVoteUserID` FOREIGN KEY (`userID`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

