-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2016 at 12:50 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nendos`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

DROP TABLE IF EXISTS `accessories`;
CREATE TABLE IF NOT EXISTS `accessories` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `box_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `main_color` varchar(30) NOT NULL,
  `main_color_hex` varchar(6) NOT NULL,
  `other_color` varchar(30) NOT NULL,
  `other_color_hex` varchar(6) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`),
  KEY `box_id` (`box_id`),
  KEY `nendoroid_id` (`nendoroid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `body_parts`
--

DROP TABLE IF EXISTS `body_parts`;
CREATE TABLE IF NOT EXISTS `body_parts` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `box_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `part` varchar(25) NOT NULL,
  `main_color` varchar(30) NOT NULL,
  `main_color_hex` varchar(6) NOT NULL,
  `second_color` varchar(30) NOT NULL,
  `second_color_hex` varchar(6) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`),
  KEY `box_id` (`box_id`),
  KEY `nendoroid_id` (`nendoroid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

DROP TABLE IF EXISTS `boxes`;
CREATE TABLE IF NOT EXISTS `boxes` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faces`
--

DROP TABLE IF EXISTS `faces`;
CREATE TABLE IF NOT EXISTS `faces` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `box_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `eyes` varchar(100) NOT NULL,
  `eyes_color` varchar(30) NOT NULL,
  `eyes_color_hex` varchar(6) NOT NULL,
  `mouth` varchar(100) NOT NULL,
  `skin_color` varchar(30) NOT NULL,
  `skin_color_hex` varchar(6) NOT NULL,
  `sex` varchar(10) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`),
  KEY `box_id` (`box_id`),
  KEY `nendoroid_id` (`nendoroid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hairs`
--

DROP TABLE IF EXISTS `hairs`;
CREATE TABLE IF NOT EXISTS `hairs` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `box_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `main_color` varchar(30) NOT NULL,
  `main_color_hex` varchar(6) NOT NULL,
  `other_color` varchar(30) NOT NULL,
  `other_color_hex` varchar(6) NOT NULL,
  `haircut` varchar(30) NOT NULL,
  `description` varchar(150) NOT NULL,
  `frontback` varchar(20) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`),
  KEY `box_id` (`box_id`),
  KEY `nendoroid_id` (`nendoroid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hands`
--

DROP TABLE IF EXISTS `hands`;
CREATE TABLE IF NOT EXISTS `hands` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `box_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nendoroid_id` bigint(20) UNSIGNED DEFAULT NULL,
  `skin_color` varchar(30) NOT NULL,
  `skin_color_hex` varchar(6) NOT NULL,
  `leftright` varchar(10) NOT NULL,
  `posture` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`),
  KEY `box_id` (`box_id`),
  KEY `nendoroid_id` (`nendoroid_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `nendoroids`
--

DROP TABLE IF EXISTS `nendoroids`;
CREATE TABLE IF NOT EXISTS `nendoroids` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `box_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `origin` varchar(150) NOT NULL,
  `version` varchar(100) NOT NULL,
  `editor` varchar(100) NOT NULL,
  `dominant_color` varchar(6) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`),
  KEY `boxid` (`box_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `internalid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `encpass` varchar(256) NOT NULL,
  PRIMARY KEY (`internalid`),
  UNIQUE KEY `internalid` (`internalid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_ibfk_1` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `accessories_ibfk_2` FOREIGN KEY (`nendoroid_id`) REFERENCES `nendoroids` (`internalid`);

--
-- Constraints for table `body_parts`
--
ALTER TABLE `body_parts`
  ADD CONSTRAINT `body_parts_ibfk_1` FOREIGN KEY (`internalid`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `body_parts_ibfk_2` FOREIGN KEY (`nendoroid_id`) REFERENCES `nendoroids` (`internalid`);

--
-- Constraints for table `faces`
--
ALTER TABLE `faces`
  ADD CONSTRAINT `faces_ibfk_1` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `faces_ibfk_2` FOREIGN KEY (`nendoroid_id`) REFERENCES `nendoroids` (`internalid`);

--
-- Constraints for table `hairs`
--
ALTER TABLE `hairs`
  ADD CONSTRAINT `hairs_ibfk_1` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `hairs_ibfk_2` FOREIGN KEY (`nendoroid_id`) REFERENCES `nendoroids` (`internalid`);

--
-- Constraints for table `hands`
--
ALTER TABLE `hands`
  ADD CONSTRAINT `hands_ibfk_1` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`internalid`),
  ADD CONSTRAINT `hands_ibfk_2` FOREIGN KEY (`nendoroid_id`) REFERENCES `nendoroids` (`internalid`);

--
-- Constraints for table `nendoroids`
--
ALTER TABLE `nendoroids`
  ADD CONSTRAINT `nendoroids_ibfk_1` FOREIGN KEY (`box_id`) REFERENCES `boxes` (`internalid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
