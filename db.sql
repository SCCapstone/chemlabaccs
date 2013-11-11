-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2013 at 08:40 PM
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
  `user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

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
('e0b4ea851b53f6d5a04d63c2198cf496', '173.189.14.55', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1384136899, 'a:4:{s:9:"user_data";s:0:"";s:18:"AUTH_authenticated";b:1;s:12:"AUTH_user_id";i:1;s:14:"AUTH_user_name";s:8:"scribell";}'),
('3bda21363a5a236b73e4f385f452be93', '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.114 Safari/537.36', 1384136024, 'a:1:{s:17:"flash:old:_danger";s:37:"Invalid username/password combination";}'),
('5d0ee2b66ff37a893b7489167bee798c', '174.107.168.86', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.101 Safari/537.36', 1384137306, 'a:5:{s:9:"user_data";s:0:"";s:18:"AUTH_authenticated";b:1;s:12:"AUTH_user_id";i:1;s:14:"AUTH_user_name";s:8:"scribell";s:18:"flash:old:_success";s:26:"Report successfully added.";}');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `salt`) VALUES
(1, 'scribell@email.sc.edu', '314ad9e71da8e7406c3087c755af0cd17c62914d', '9812fe5cf3626343d6d43028ff410de1'),
(8, 'cieplows@email.sc.edu', 'b2f1b3f2a1c501efd618d26dd2460786a3eddd0b', '67bfe26db4b01a06d63b14b05d0f625d'),
(9, 'carrow@email.sc.edu', '4085938688d5e5975a1820a2989fc38670877efa', '7ebd480d796075e3276027b1625b4d00'),
(10, 'hamodm@email.sc.edu', '314c9a208f19dd6aae82665ac70c94ec47848a88', '397d1e1a879e1f0f87d14ed56e0ebeee'),
(11, 'cieplows@email.sc.edu', '7e51ca7944fff5e0678728a534064a11eb273c56', '5433cf02ea30100f0bc9af345e2808fa'),
(12, 'carrow@email.sc.edu', '92bc93fb50081865a2739d4ebea177da40c4dfc4', 'ede8698b8bf6e4b32a6545bd4ea8bd8a'),
(13, 'hamodm@email.sc.edu', '53549ef8fe9b8151756066991e828e320499f792', '6a04f1aca44b0a3403acbcee349f06e5');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
