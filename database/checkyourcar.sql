-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 27, 2022 at 09:23 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `checkyourcar`
--

-- --------------------------------------------------------

--
-- Table structure for table `recalls`
--

DROP TABLE IF EXISTS `recalls`;
CREATE TABLE IF NOT EXISTS `recalls` (
  `RC_ID` int(11) NOT NULL AUTO_INCREMENT,
  `VHCL_ID` int(11) NOT NULL,
  `RC_REPORT_DATE` date DEFAULT NULL,
  `RC_FAULT_TYPE` varchar(200) DEFAULT NULL,
  `RC_REPORTED_FAULTS` int(11) DEFAULT NULL,
  `RC_FAULT` text,
  `RC_CONSEQUENCE` text,
  `RC_SOLUTIONS` text,
  PRIMARY KEY (`RC_ID`),
  KEY `recall_vehicle` (`VHCL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_FIRST_NAME` text NOT NULL,
  `USER_LAST_NAME` text NOT NULL,
  `USER_EMAIL` text NOT NULL,
  `USER_PASS` text NOT NULL,
  `USER_COUNTRY` text NOT NULL,
  `USER_CITY` text NOT NULL,
  `USER_CONTACT` varchar(20) DEFAULT NULL,
  `USER_EMAIL_VERIFIED` tinyint(1) NOT NULL DEFAULT '0',
  `USER_VERI_CODE` int(11) DEFAULT NULL,
  `USER_VERI_ATEMPT` int(2) DEFAULT '0',
  `USER_VERI_DATE` datetime DEFAULT NULL,
  `USER_STATUS` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_vehicle`
--

DROP TABLE IF EXISTS `user_vehicle`;
CREATE TABLE IF NOT EXISTS `user_vehicle` (
  `UV_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `VHCL_ID` int(11) NOT NULL,
  `UV_DATE` datetime NOT NULL,
  `UV_STATUS` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UV_ID`),
  KEY `vehicle_user` (`USER_ID`),
  KEY `vehicle_vehicle` (`VHCL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `VHCL_ID` int(11) NOT NULL AUTO_INCREMENT,
  `VHCL_MAKE` varchar(200) NOT NULL,
  `VHCL_MODEL` varchar(200) NOT NULL,
  `VHCL_YEAR` year(4) NOT NULL,
  `VHCL_MANUFACTURER` varchar(200) NOT NULL,
  `VHCL_IMAGE` text,
  PRIMARY KEY (`VHCL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recalls`
--
ALTER TABLE `recalls`
  ADD CONSTRAINT `recall_vehicle` FOREIGN KEY (`VHCL_ID`) REFERENCES `vehicles` (`VHCL_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `user_vehicle`
--
ALTER TABLE `user_vehicle`
  ADD CONSTRAINT `vehicle_user` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `vehicle_vehicle` FOREIGN KEY (`VHCL_ID`) REFERENCES `vehicles` (`VHCL_ID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
