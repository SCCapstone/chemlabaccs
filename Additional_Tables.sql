-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2014 at 02:20 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `revision_of` int(10) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `building` int(2) NOT NULL,
  `room` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `severity` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `root` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `prevention` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user` int(10) NOT NULL,
  `modified_by` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accidents`
--

INSERT INTO `accidents` (`id`, `revision_of`, `date`, `time`, `building`, `room`, `description`, `severity`, `root`, `prevention`, `user`, `modified_by`, `created`) VALUES
(3380163, 3380163, '2014-02-14', '00:45:00', 3, '900', 'A', 'high', 'B', 'C', 15, 0, '2014-02-14 23:20:03'),
(5547652, 5547652, '2014-02-14', '00:30:00', 2, '433', 'Something happened ', 'high', 'fire ', 'run ', 15, 0, '2014-02-14 23:18:47');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `institution_id` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `name`, `institution_id`) VALUES
(1, 'Jones Physical Science Center', 1),
(2, 'Graduate Science Center', 1),
(3, 'Coker Life Science Building', 1),
(4, 'Earth and Water Sciences Building', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `accident_id` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `image_url` varchar(250) DEFAULT NULL,
  `comment_date` date NOT NULL,
  `comment_time` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `accident_id` (`accident_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE IF NOT EXISTS `institution` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `join_date` date NOT NULL,
  `primary_admin` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id`, `name`, `join_date`, `primary_admin`) VALUES
(1, 'The Univeristy of South Carolina', '2014-02-11', 112233),
(2, 'Duke University', '2014-02-11', 445566);

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

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `user_id`, `accident_id`, `photo_abs_url`, `thumb_abs_url`, `comment`) VALUES
(2615471, 15, 3380163, 'accident_photos/13924200073_chemlabaccs.1392420006.jpg', 'accident_photos/thumbs/thumb_13924200073_chemlabaccs.1392420006.jpg', 'll'),
(5192924, 15, 3380163, 'accident_photos/13924200040_chemlabaccs.1392420003.jpg', 'accident_photos/thumbs/thumb_13924200040_chemlabaccs.1392420003.jpg', 'll'),
(6017136, 15, 3380163, 'accident_photos/13924200051_chemlabaccs.1392420004.jpg', 'accident_photos/thumbs/thumb_13924200051_chemlabaccs.1392420004.jpg', 'll'),
(7954638, 15, 3380163, 'accident_photos/13924200062_chemlabaccs.1392420005.jpg', 'accident_photos/thumbs/thumb_13924200062_chemlabaccs.1392420005.jpg', 'l');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(10) NOT NULL,
  `institution_id` int(10) NOT NULL,
  `building_id` int(10) NOT NULL,
  `room_num` varchar(10) DEFAULT NULL,
  `section_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `institution_id` (`institution_id`)
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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('fcb5a1e3f1b925386a73b5903efdee1e', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0', 1392425598, 'a:4:{s:9:"user_data";s:0:"";s:18:"AUTH_authenticated";b:1;s:12:"AUTH_user_id";i:15;s:14:"AUTH_user_name";s:21:"cieplows@email.sc.edu";}');

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
  `userlvl` varchar(32) NOT NULL,
  `institution_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `institute_id` (`institution_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `salt`, `theme`, `userlvl`, `institution_id`) VALUES
(1, 'scribell@email.sc.edu', '314ad9e71da8e7406c3087c755af0cd17c62914d', '9812fe5cf3626343d6d43028ff410de1', 0, '', 1),
(14, 'vidal@sc.edu', 'c6b8d74a1ebebe7d3d577bc4b3bc154dbbc52f8b', '6f082771030027d09eecacef346e4516', 1, '', 1),
(15, 'cieplows@email.sc.edu', '80736686f02e465441dec03bdb48073bb08bf756', '2a0454ec5ab734d2686656e009ef371c', 1, '', 1),
(16, 'carrow@email.sc.edu', 'b9f5768a43390e7aeefff801dd7729c370e50e41', '1f80d69cb28ab0916868089dde525e93', 0, '', 1),
(17, 'hamodm@email.sc.edu', 'b6c05b414a10e665798527c129bd9f101212202c', 'cba162aac634b02913386be6b4c08dca', 0, '', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `buildings_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`);

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
  ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institution` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
