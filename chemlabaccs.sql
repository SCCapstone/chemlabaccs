-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2013 at 09:40 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chemlabaccs`
--
CREATE DATABASE IF NOT EXISTS `chemlabaccs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `chemlabaccs`;

-- --------------------------------------------------------

--
-- Table structure for table `accidents`
--

CREATE TABLE IF NOT EXISTS `accidents` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `revision_of` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `building` int(2) NOT NULL,
  `room` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `severity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `root` text COLLATE utf8_unicode_ci NOT NULL,
  `prevention` text COLLATE utf8_unicode_ci NOT NULL,
  `user` int(10) NOT NULL,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `accidents`
--

INSERT INTO `accidents` (`id`, `revision_of`, `date`, `time`, `building`, `room`, `description`, `severity`, `root`, `prevention`, `user`, `modified_by`, `created`) VALUES
(1, 1, '2013-11-15', '00:15:00', 2, '123', 'Something broke', 'low', 'Careless', 'be more careful', 1, 0, '2013-11-15 16:19:08'),
(2, 1, '2013-11-15', '00:15:00', 2, '123', 'Something broke', 'high', 'careless', 'be more careful!!!', 1, 1, '2013-11-15 16:29:36'),
(3, 3, '2013-11-12', '00:30:00', 3, 'abc123', 'asdf', 'medium', 'ttt', 'qq', 1, 0, '2013-11-15 16:32:34'),
(4, 4, '2013-11-10', '00:45:00', 1, '1', 'a', 'high', 'b', 'c', 1, 0, '2013-11-15 16:43:54'),
(5, 4, '2013-11-10', '00:45:00', 1, '1', 'aaaaaaaaaa', 'high', 'bbbbbbbbbbbbbbb', 'cccccccccccccccccc', 1, 1, '2013-11-15 16:44:50'),
(7, 4, '2013-11-10', '00:45:00', 1, '1', 'aaaaaaaaaa', 'high', 'bbbbbbbbbbbbbbb1', 'cccccccccccccccccc', 1, 14, '2013-11-15 20:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`) VALUES
(1, 'building 1'),
(2, 'building 2'),
(3, 'building 3'),
(4, 'building 4');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('4505ceb4681474d96968a48e49a94f1e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.57 Safari/537.36', 1384547756, 'a:4:{s:9:"user_data";s:0:"";s:18:"AUTH_authenticated";b:1;s:12:"AUTH_user_id";i:1;s:14:"AUTH_user_name";s:21:"scribell@email.sc.edu";}'),
('145ebc03acbf80efc4ecde87c933c604', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0', 1384546033, ''),
('065f2bf16ba2c3b53e956963d1b058fc', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:25.0) Gecko/20100101 Firefox/25.0', 1384547085, 'a:4:{s:9:"user_data";s:0:"";s:18:"AUTH_authenticated";b:1;s:12:"AUTH_user_id";i:14;s:14:"AUTH_user_name";s:12:"vidal@sc.edu";}');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `salt`, `theme`) VALUES
(1, 'scribell@email.sc.edu', '314ad9e71da8e7406c3087c755af0cd17c62914d', '9812fe5cf3626343d6d43028ff410de1', 0),
(14, 'vidal@sc.edu', 'c6b8d74a1ebebe7d3d577bc4b3bc154dbbc52f8b', '6f082771030027d09eecacef346e4516', 1),
(15, 'cieplows@email.sc.edu', '80736686f02e465441dec03bdb48073bb08bf756', '2a0454ec5ab734d2686656e009ef371c', 0),
(16, 'carrow@email.sc.edu', 'b9f5768a43390e7aeefff801dd7729c370e50e41', '1f80d69cb28ab0916868089dde525e93', 0),
(17, 'hamodm@email.sc.edu', 'b6c05b414a10e665798527c129bd9f101212202c', 'cba162aac634b02913386be6b4c08dca', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
