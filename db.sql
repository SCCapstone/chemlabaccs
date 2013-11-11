-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2013 at 08:08 PM
-- Server version: 5.5.33-31.1
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mscribel_csce490db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accidents`
--

CREATE TABLE IF NOT EXISTS `accidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `building` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `severity` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `root` text COLLATE utf8_unicode_ci NOT NULL,
  `prevention` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `accidents`
--

INSERT INTO `accidents` (`id`, `date`, `time`, `building`, `room`, `description`, `severity`, `root`, `prevention`) VALUES
(1, '0000-00-00', '12:15:00', 'a', 'b', 'c', 'low', 'd', 'e'),
(2, '0000-00-00', '12:15:00', 'a', 'b', 'c', 'low', 'd', 'e'),
(3, '1969-12-31', '12:15:00', 'a', 'b', 'c', 'low', 'd', 'e'),
(4, '2013-12-13', '12:15:00', 'a', 'b', 'c', 'low', 'd', 'e'),
(5, '2013-11-08', '12:15:00', 'a', 'b', 'c', 'low', 'd', 'e'),
(6, '2013-11-08', '12:00:00', 'a', 'b', 'c', 'low', 'd', 'e'),
(7, '2013-11-12', '00:00:00', 'a', 'b', 'c', 'low', 'e', 'f\n'),
(8, '2013-11-12', '13:45:00', 'a', 'b', 'c', 'low', 'e', 'f\n'),
(9, '2013-11-13', '18:45:00', 'a', 'b', 'c', 'low', 'd', 'e');

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
('4b4fa03f85f7c9155ee55446566130b7', '173.189.14.55', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1384135542, 'a:4:{s:9:"user_data";s:0:"";s:18:"AUTH_authenticated";b:1;s:12:"AUTH_user_id";i:1;s:14:"AUTH_user_name";s:8:"scribell";}'),
('ada46646ca844e7de4f2ce4b0a19f043', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.114 Safari/537.36', 1384135465, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(254) NOT NULL,
  `password_hash` varchar(40) NOT NULL,
  `salt` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `salt`) VALUES
(1, 'scribell@email.sc.edu', '314ad9e71da8e7406c3087c755af0cd17c62914d', '9812fe5cf3626343d6d43028ff410de1'),
(8, 'cieplows@email.sc.edu', 'b2f1b3f2a1c501efd618d26dd2460786a3eddd0b', '67bfe26db4b01a06d63b14b05d0f625d'),
(9, 'carrow@email.sc.edu', '4085938688d5e5975a1820a2989fc38670877efa', '7ebd480d796075e3276027b1625b4d00'),
(10, 'hamodm@email.sc.edu', '314c9a208f19dd6aae82665ac70c94ec47848a88', '397d1e1a879e1f0f87d14ed56e0ebeee');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
