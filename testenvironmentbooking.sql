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

-- Dumping database structure for testenvironmentbooking
DROP DATABASE IF EXISTS `testenvironmentbooking`;
CREATE DATABASE IF NOT EXISTS `testenvironmentbooking` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `testenvironmentbooking`;


-- Dumping structure for table testenvironmentbooking.calendar
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

-- Dumping data for table testenvironmentbooking.calendar: 6 rows
DELETE FROM `calendar`;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` (`calendarid`, `reservename`, `reservetype`, `envid`, `starttime`, `endtime`, `status`, `createdon`, `createdby`) VALUES
	(18, 'Release2.0', 'generic', 6, '2015-03-17', '2015-03-19', 'approved', '2015-03-15 06:40:07', 4),
	(15, 'Reservation1', 'generic', 6, '2015-03-18', '2015-03-19', 'approved', '2015-03-15 06:39:21', 4),
	(16, 'Release1.0', 'generic', 6, '2015-03-15', '2015-03-16', 'in-progress', '2015-03-15 06:39:36', 4),
	(14, 'New Reservation', 'release', 5, '2015-03-24', '2015-03-17', 'in-progress', '2015-03-14 12:26:58', 4),
	(19, 'Reservation22323', 'release', 6, '2015-03-18', '2015-03-20', 'approved', '2015-03-15 06:40:31', 4),
	(20, 'Deployment Jabbix', 'maintainance', 12, '2015-03-22', '2015-03-24', 'approved', '2015-03-22 05:59:44', 6);
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;


-- Dumping structure for table testenvironmentbooking.environment
DROP TABLE IF EXISTS `environment`;
CREATE TABLE IF NOT EXISTS `environment` (
  `envid` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Environment id',
  `envname` varchar(100) NOT NULL COMMENT 'Environment Name',
  `envtype` varchar(100) NOT NULL COMMENT 'Environment Type',
  `createdon` date NOT NULL,
  `createdby` int(10) NOT NULL,
  PRIMARY KEY (`envid`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table testenvironmentbooking.environment: 9 rows
DELETE FROM `environment`;
/*!40000 ALTER TABLE `environment` DISABLE KEYS */;
INSERT INTO `environment` (`envid`, `envname`, `envtype`, `createdon`, `createdby`) VALUES
	(6, 'Joomla', 'development', '2015-03-12', 4),
	(5, 'Drupal', 'development', '2015-03-12', 4),
	(7, 'Drupal', 'non-production', '2015-03-12', 4),
	(8, 'Drupal', 'production', '2015-03-12', 4),
	(9, 'Joomla', 'non-production', '2015-03-12', 4),
	(11, 'Joomla', 'production', '2015-03-12', 4),
	(12, 'WordPress', 'development', '2015-03-12', 4),
	(13, 'WordPress', 'non-production', '2015-03-12', 4),
	(14, 'WordPress', 'production', '2015-03-12', 4);
/*!40000 ALTER TABLE `environment` ENABLE KEYS */;


-- Dumping structure for table testenvironmentbooking.users
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

-- Dumping data for table testenvironmentbooking.users: 3 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userid`, `username`, `password`, `firstname`, `lastname`, `usertype`, `organization`, `designation`, `securityquestion`, `securityanswer`, `phone`, `createdby`, `createdon`) VALUES
	(1, 'admin@localhost.com', '*89FA6EAF8B6264AC8D6E84759027252505A3EAEE', 'Administrator', 'Administrator', 'admin', 'Nemu Hengsu Technologies', 'CEO', 'What is your first pet name?', 'Rocky', 2147483647, 0, '2015-03-17 16:26:12');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
