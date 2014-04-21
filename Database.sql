-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 24, 2014 at 04:13 AM
-- Server version: 5.5.34-0ubuntu0.13.04.1
-- PHP Version: 5.4.9-4ubuntu2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chemlabaccs`
--

-- --------------------------------------------------------

--
-- Table structure for table `accidents`
--

CREATE TABLE IF NOT EXISTS `accidents` (
  `id` int(10) NOT NULL,
  `section_id` int(10) NOT NULL,
  `revision_of` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `severity` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `root` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prevention` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user` int(10) NOT NULL,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `accident_id` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `comment_date` date NOT NULL,
  `comment_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accident_id` (`accident_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Table structure for table `institution`
--

CREATE TABLE IF NOT EXISTS `institution` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id`, `name`, `join_date`) VALUES
(1, 'The Univeristy of South Carolina', '2014-02-11'),
(2, 'Duke University', '2014-02-11');

-- --------------------------------------------------------

--
-- Table structure for table `lab_user`
--

CREATE TABLE IF NOT EXISTS `lab_user` (
  `user_id` int(10) NOT NULL,
  `section_id` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `accident_id` int(10) NOT NULL,
  `photo_abs_url` varchar(250) NOT NULL,
  `thumb_abs_url` varchar(250) NOT NULL,
  `comment` varchar(240) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(10) NOT NULL,
  `password` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `admin_id` int(10) NOT NULL,
  `institution_id` int(10) NOT NULL,
  `Term` enum('Fall','Spring','Summer 1','Summer 2','Summer 3','Other') NOT NULL,
  `Year` varchar(10) NOT NULL,
  `building_name` varchar(60) NOT NULL,
  `room_num` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institution_id` (`institution_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password_hash` varchar(40) NOT NULL,
  `salt` varchar(32) NOT NULL,
  `theme` int(1) NOT NULL DEFAULT '0',
  `userlvl` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accidents`
--
ALTER TABLE `accidents`
  ADD CONSTRAINT `accidents_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`);

--
-- Constraints for table `lab_user`
--
ALTER TABLE `lab_user`
  ADD CONSTRAINT `lab_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `lab_user_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`);

--
-- Constraints for table `section`
--
ALTER TABLE `section`
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`),
  ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
