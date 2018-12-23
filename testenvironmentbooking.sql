-- --------------------------------------------------------
-- Host:                         192.168.33.12
-- Server version:               5.1.73 - Source distribution
-- Server OS:                    redhat-linux-gnu
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for environmentbooking

DROP DATABASE IF EXISTS `environmentbooking`;
CREATE DATABASE IF NOT EXISTS `environmentbooking` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `environmentbooking`;


-- Dumping structure for table environmentbooking.calendar
DROP TABLE IF EXISTS `calendar`;
CREATE TABLE IF NOT EXISTS `calendar` (
  `calendarid` int(10) NOT NULL AUTO_INCREMENT,
  `reservename` varchar(100) NOT NULL,
  `reservetype` varchar(100) NOT NULL,
  `envid` int(10) NOT NULL,
  `starttime` date NOT NULL,
  `endtime` date NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `createdon` datetime NOT NULL,
  `createdby` int(10) NOT NULL,
  PRIMARY KEY (`calendarid`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Dumping data for table environmentbooking.calendar: 6 rows
DELETE FROM `calendar`;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;


-- Dumping structure for table environmentbooking.environment
DROP TABLE IF EXISTS `environment`;
CREATE TABLE IF NOT EXISTS `environment` (
  `envid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Environment id',
  `envname` varchar(100) NOT NULL COMMENT 'Environment Name',
  `envtype` varchar(100) NOT NULL COMMENT 'Environment Type',
  `component` varchar(100) NOT NULL COMMENT 'Component',
  `createdon` date NOT NULL,
  `createdby` int(10) NOT NULL,
  PRIMARY KEY (`envid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table environmentbooking.environment: 9 rows
DELETE FROM `environment`;
/*!40000 ALTER TABLE `environment` DISABLE KEYS */;
/*!40000 ALTER TABLE `environment` ENABLE KEYS */;


-- Dumping structure for table environmentbooking.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL DEFAULT '0',
  `firstname` varchar(250) NOT NULL DEFAULT '0',
  `lastname` varchar(250) NOT NULL DEFAULT '0',
  `usertype` varchar(100) NOT NULL DEFAULT '0',
  `organization` varchar(250) NOT NULL DEFAULT '0',
  `designation` varchar(250) NOT NULL DEFAULT '0',
  `securityquestion` varchar(250) NOT NULL DEFAULT '0',
  `securityanswer` varchar(250) NOT NULL DEFAULT '0',
  `phone` int(10) NOT NULL DEFAULT '0',
  `createdby` int(10) NOT NULL,
  `createdon` datetime NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table environmentbooking.users: 3 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userid`, `username`, `password`, `firstname`, `lastname`, `usertype`, `organization`, `designation`, `securityquestion`, `securityanswer`, `phone`, `createdby`, `createdon`) VALUES
	(1, 'admin@localhost.com', '*89FA6EAF8B6264AC8D6E84759027252505A3EAEE', 'Administrator', 'Administrator', 'admin', 'Nemu Hengsu Technologies', 'CEO', 'What is your first pet name?', 'Rocky', 2147483647, 0, '2015-03-17 16:26:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
