-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2013 at 11:11 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kitabalshifa`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountings`
--

CREATE TABLE IF NOT EXISTS `accountings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hour_of_week_start` int(11) NOT NULL,
  `hour_of_week_end` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `value` float NOT NULL,
  `updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `accountings_exceptions`
--

CREATE TABLE IF NOT EXISTS `accountings_exceptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `premium` float NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE IF NOT EXISTS `billings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `healthcare_provider` int(6) NOT NULL,
  `patient_birthdate` date NOT NULL,
  `payment_program` varchar(3) NOT NULL,
  `payee` varchar(1) NOT NULL,
  `referring` int(6) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=477645 ;

-- --------------------------------------------------------

--
-- Table structure for table `billings_items`
--

CREATE TABLE IF NOT EXISTS `billings_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_code` varchar(5) NOT NULL,
  `fee_submitted` int(11) NOT NULL,
  `number_of_services` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `billing_id` int(11) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=615413 ;

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE IF NOT EXISTS `calendars` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `usergroups_id` int(32) NOT NULL,
  `name` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `published` tinyint(1) NOT NULL,
  `comments` text,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `usergroups_id` int(11) NOT NULL,
  `acl` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `location` text NOT NULL,
  `abbreviated_name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE IF NOT EXISTS `shifts` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `user_id` int(32) NOT NULL,
  `date` date NOT NULL,
  `shifts_type_id` int(32) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12189 ;

-- --------------------------------------------------------

--
-- Table structure for table `shifts_types`
--

CREATE TABLE IF NOT EXISTS `shifts_types` (
  `id` int(32) NOT NULL AUTO_INCREMENT,
  `location_id` int(32) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL,
  `comment` text NOT NULL,
  `display_order` int(32) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE IF NOT EXISTS `trades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `user_status` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2028 ;

-- --------------------------------------------------------

--
-- Table structure for table `trades_considerations`
--

CREATE TABLE IF NOT EXISTS `trades_considerations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trade1` int(11) NOT NULL,
  `trade2` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trades_details`
--

CREATE TABLE IF NOT EXISTS `trades_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trade_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `status` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2024 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
