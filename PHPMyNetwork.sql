-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: db673628946.db.1and1.com
-- Generation Time: May 10, 2017 at 02:25 PM
-- Server version: 5.5.54-0+deb7u2-log
-- PHP Version: 5.4.45-0+deb7u8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db673628946`
--
CREATE DATABASE IF NOT EXISTS `PHPMyNetwork` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_ci;
USE `db673628946`;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `ports` int(11) NOT NULL,
  `speed` varchar(45) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `location` varchar(255) DEFAULT 'Primary Rack',
  `position` int(11) DEFAULT NULL,
  `device_type` int(11) NOT NULL,
  `port_type` enum('Front','Back','Both','WirelessOnly') NOT NULL DEFAULT 'Front',
  `wireless` int(11) NOT NULL DEFAULT '0',
  `ip_address` varchar(36) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `position` (`position`),
  KEY `device_type` (`device_type`),
  KEY `ip_address` (`ip_address`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `name`, `ports`, `speed`, `active`, `location`, `position`, `device_type`, `port_type`, `wireless`, `ip_address`, `user_id`) VALUES
(1, 'GFiber Router', 8, '1000', 1, 'Closet', 1, 6, 'Front', 0, '192.168.0.1', 1),
(2, 'GFiber TV Switch', 8, '1000', 0, 'Closet', 2, 7, 'Front', 0, '', 1),
(3, 'Dell Managed Switch', 48, '1000', 1, 'Rack Slot 5', 6, 7, 'Front', 0, '192.168.0.12', 1),
(4, 'Cisco POE Switch', 24, '100', 1, 'Rack Slot 4', 5, 7, 'Front', 0, '192.168.0.11', 1),
(5, 'Dell Gigabit Switch', 24, '1000', 0, 'Rack (Slot 3)', NULL, 7, 'Front', 0, '', 1),
(6, 'Small POE Switch', 8, '1000', 0, 'Rack (Slot 4)', NULL, 7, 'Front', 0, '', 1),
(7, 'Patch Panel 1', 12, '1000', 1, 'Rack Slot 2', 3, 11, 'Both', 0, '', 1),
(8, 'Patch Panel 2', 24, '1000', 1, 'Rack Slot 3', 4, 11, 'Both', 0, '', 1),
(9, 'Intellinet Switch', 8, '1000', 1, 'Living Room', 7, 7, 'Front', 0, '', 1),
(10, 'BlackBox', 1, '1000', 1, 'Living Room', 13, 8, 'Back', 0, '192.168.0.63', 1),
(11, 'Silverbox', 1, '1000', 1, 'Living Room (Dad)', 15, 8, 'Back', 0, '192.168.0.62', 1),
(12, 'Sunba', 1, '1000', 1, 'Crown of House', 9, 9, 'Back', 0, '192.168.0.41', 1),
(13, 'BlueIris', 1, '100', 1, 'Front Yard Tree', 17, 8, 'Back', 0, '192.168.0.47', 1),
(14, 'Street Cam', 1, '100', 1, 'East At Street', 11, 8, 'Back', 0, '192.168.0.39', 1),
(15, 'Street Cam', 1, '100', 1, 'West At Street', 16, 8, 'Back', 0, '192.168.0.52', 1),
(16, 'Parrot', 1, '1000', 1, 'Mobile (Laptop)', 12, 8, 'Back', 0, '192.168.0.95', 1),
(17, 'TCP Lighting', 1, '1000', 1, 'Closet', 19, 10, 'Back', 0, '192.168.0.150', 1),
(19, 'Steamlink', 1, '100', 1, 'Jayden Room', 18, 8, 'WirelessOnly', 1, '192.168.0.181', 1),
(20, 'Porch Camera', 1, '1000', 1, 'Front Porch', 10, 9, 'Back', 0, '192.168.0.39', 1),
(21, 'TP Link', 1, '1000', 1, 'Front Room', 14, 8, 'Back', 0, '192.168.0.42', 1),
(23, 'Raspberry Pi 1', 1, '1000', 1, 'Closet', 21, 10, 'Back', 1, '192.168.0.82', 1),
(24, 'Raspberry Pi 2', 1, '1000', 1, 'Closet', 22, 10, 'Back', 1, '192.168.0.81', 1),
(25, 'Pine64', 1, '1000', 1, 'Closet', 25, 10, 'Back', 1, 'DHCP', 1),
(26, 'TP-Link AP', 5, '1000', 1, 'Kitchen', 26, 12, 'Back', 1, '192.168.0.2', 1),
(27, 'TP-Link AP', 1, '1000', 1, 'Front Porch', 27, 12, 'Back', 1, '192.168.0.10', 1),
(28, 'Basement Switch', 5, '1000', 1, 'Basement', 8, 7, 'Front', 0, '', 1),
(29, 'Projector', 1, '1000', 1, 'Basement', 23, 10, 'Back', 0, '', 1),
(30, 'Diamond Laptop', 1, '1000', 1, 'Living Room', 24, 8, 'Back', 0, '', 1),
(31, 'Mystery Device', 1, '1000', 1, 'Unknown', NULL, 8, 'Back', 0, '', 1),
(32, 'Master BR', 1, '1000', 1, 'Master Bedroom', NULL, 14, 'Back', 0, '', 1),
(33, 'Basement', 1, '1000', 1, 'Basement', NULL, 14, 'Back', 0, '', 1),
(34, 'Diamond Room', 1, '1000', 1, 'Diamond Room', NULL, 14, 'Back', 0, '', 1),
(35, 'Front Room', 1, '1000', 1, 'Front Room', NULL, 14, 'Back', 0, '', 1),
(36, 'Mojave Wasteland', 1, '1000', 1, 'Jayden Room', NULL, 14, 'Back', 0, '', 1),
(37, 'Living Room', 1, '1000', 1, 'Living Room', NULL, 14, 'Back', 0, '', 1),
(38, 'POE Switch', 5, '1000', 1, 'Tree', NULL, 7, 'Front', 0, '', 1),
(39, 'Sibell NVR', 1, '1000', 1, 'Rack Slot 1', NULL, 15, 'Back', 0, '192.168.0.58', 1),
(40, 'Driveway Camera', 1, '1000', 1, 'Front of house East side', NULL, 9, 'Back', 0, '', 1),
(41, 'Back Yard Facing North', 1, '100', 1, 'Front Porch', NULL, 9, 'Back', 0, '192.168.0.48', 1),
(42, 'Back Yard Facing West', 1, '100', 1, 'Back Yard ', NULL, 9, 'Back', 0, '192.168.0.44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

DROP TABLE IF EXISTS `device_type`;
CREATE TABLE IF NOT EXISTS `device_type` (
  `device_type` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`device_type`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`device_type`, `name`, `user_id`) VALUES
(0, 'Unspecified', NULL),
(6, 'Router', NULL),
(7, 'Switch', NULL),
(8, 'PC', NULL),
(9, 'Camera', NULL),
(10, 'Thin Client', NULL),
(11, 'Patch Panel', NULL),
(12, 'AP', NULL),
(14, 'Fiber TV Box', NULL),
(15, 'NVR', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patches`
--

DROP TABLE IF EXISTS `patches`;
CREATE TABLE IF NOT EXISTS `patches` (
  `user_id` mediumint(9) NOT NULL DEFAULT '1',
  `device 1` int(11) NOT NULL DEFAULT '0',
  `port 1` int(11) NOT NULL,
  `device 2` int(11) NOT NULL,
  `port 2` int(11) NOT NULL,
  `side 1` enum('Front','Back') NOT NULL DEFAULT 'Front',
  `side 2` enum('Front','Back') NOT NULL DEFAULT 'Front',
  PRIMARY KEY (`device 1`,`device 2`,`port 1`,`port 2`),
  KEY `dp2_idx` (`device 2`),
  KEY `dp3_idx` (`port 1`,`device 1`),
  KEY `dp4_idx` (`device 2`,`port 2`),
  KEY `dp1a_idx` (`device 1`,`port 1`),
  KEY `dp2a_idx` (`device 2`,`port 2`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patches`
--

INSERT INTO `patches` (`user_id`, `device 1`, `port 1`, `device 2`, `port 2`, `side 1`, `side 2`) VALUES
(1, 1, 8, 7, 12, 'Front', 'Front'),
(1, 1, 1, 8, 5, 'Front', 'Back'),
(1, 3, 1, 8, 3, 'Front', 'Front'),
(1, 3, 3, 8, 4, 'Front', 'Front'),
(1, 3, 5, 8, 5, 'Front', 'Front'),
(1, 3, 7, 8, 6, 'Front', 'Front'),
(1, 3, 9, 8, 7, 'Front', 'Front'),
(1, 3, 11, 8, 8, 'Front', 'Front'),
(1, 3, 13, 8, 9, 'Front', 'Front'),
(1, 3, 15, 8, 10, 'Front', 'Front'),
(1, 3, 17, 8, 11, 'Front', 'Front'),
(1, 3, 19, 8, 12, 'Front', 'Front'),
(1, 3, 21, 8, 13, 'Front', 'Front'),
(1, 3, 23, 8, 14, 'Front', 'Front'),
(1, 3, 25, 8, 15, 'Front', 'Front'),
(1, 4, 1, 7, 1, 'Front', 'Front'),
(1, 4, 3, 7, 2, 'Front', 'Front'),
(1, 4, 5, 7, 3, 'Front', 'Front'),
(1, 4, 13, 8, 16, 'Front', 'Front'),
(1, 4, 15, 8, 17, 'Front', 'Front'),
(1, 4, 17, 8, 18, 'Front', 'Front'),
(1, 4, 19, 8, 19, 'Front', 'Front'),
(1, 4, 21, 8, 20, 'Front', 'Front'),
(1, 7, 3, 40, 1, 'Back', 'Back'),
(1, 7, 2, 41, 1, 'Back', 'Back'),
(1, 7, 1, 42, 1, 'Back', 'Back'),
(1, 8, 1, 8, 2, 'Front', 'Front'),
(1, 8, 4, 9, 1, 'Back', 'Front'),
(1, 8, 6, 17, 1, 'Back', 'Back'),
(1, 8, 18, 20, 1, 'Back', 'Back'),
(1, 8, 3, 21, 1, 'Back', 'Back'),
(1, 8, 7, 28, 1, 'Back', 'Front'),
(1, 8, 8, 31, 1, 'Back', 'Back'),
(1, 8, 11, 32, 1, 'Back', 'Back'),
(1, 8, 10, 33, 1, 'Back', 'Back'),
(1, 8, 12, 34, 1, 'Back', 'Back'),
(1, 8, 9, 35, 1, 'Back', 'Back'),
(1, 8, 13, 36, 1, 'Back', 'Back'),
(1, 8, 14, 37, 1, 'Back', 'Back'),
(1, 8, 17, 38, 1, 'Back', 'Front'),
(1, 8, 20, 39, 1, 'Back', 'Back'),
(1, 10, 1, 8, 15, 'Back', 'Back'),
(1, 12, 1, 8, 16, 'Back', 'Back'),
(1, 13, 1, 38, 4, 'Back', 'Front'),
(1, 14, 1, 38, 3, 'Back', 'Front'),
(1, 15, 1, 38, 5, 'Back', 'Front');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'Admin', '$2y$08$6UQehnhsotRA4n6qh.a8yOSNvql4DA3dIkFpia0FcYA9OBLgiVXY6', '', 'admin@mail.com', '', NULL, NULL, 'aH8pCE1J2xjzMLVsdahQB.', 1268889823, 1494443714, 1, 'Admin', 'User', 'ADMIN', '1 800 555 1212');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(5, 1, 1),
(6, 1, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
