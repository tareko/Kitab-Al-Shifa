-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2016 at 06:43 PM
-- Server version: 5.6.30
-- PHP Version: 5.6.23-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `kitab`
--
USE `kitab`;

-- --------------------------------------------------------

--
-- Table structure for table `accountings`
--

CREATE TABLE IF NOT EXISTS `accountings` (
  `id` varchar(5) NOT NULL,
  `id2` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE IF NOT EXISTS `billings` (
`id` int(11) NOT NULL,
  `healthcare_provider` int(6) NOT NULL,
  `patient_birthdate` date NOT NULL,
  `payment_program` varchar(3) NOT NULL,
  `payee` varchar(1) NOT NULL,
  `referring` int(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=477645 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `billings_items`
--

CREATE TABLE IF NOT EXISTS `billings_items` (
`id` int(11) NOT NULL,
  `service_code` varchar(5) NOT NULL,
  `fee_submitted` int(11) NOT NULL,
  `number_of_services` int(11) NOT NULL,
  `service_date` date NOT NULL,
  `billing_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=615413 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE IF NOT EXISTS `calendars` (
`id` int(32) NOT NULL,
  `usergroups_id` int(32) NOT NULL,
  `name` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `published` tinyint(1) NOT NULL,
  `comments` text,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(4) NOT NULL,
  `usergroups_id` int(11) NOT NULL,
  `acl` varchar(256) NOT NULL,
  `tradeable` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
`id` int(32) NOT NULL,
  `location` text NOT NULL,
  `abbreviated_name` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
`id` int(16) NOT NULL,
  `user_id` int(8) NOT NULL,
  `field` varchar(64) NOT NULL,
  `value` varchar(256) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE IF NOT EXISTS `shifts` (
`id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `date` date NOT NULL,
  `shifts_type_id` int(32) NOT NULL,
  `marketplace` tinyint(1) NOT NULL DEFAULT '0',
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=50715 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shifts_types`
--

CREATE TABLE IF NOT EXISTS `shifts_types` (
`id` int(32) NOT NULL,
  `location_id` int(32) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL,
  `comment` text NOT NULL,
  `display_order` int(32) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE IF NOT EXISTS `trades` (
`id` int(11) NOT NULL,
  `confirmed` tinyint(4) NOT NULL DEFAULT '0',
  `message` text,
  `consideration` tinyint(4) NOT NULL DEFAULT '1',
  `submitted_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `token` varchar(64) DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=16892 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trades_details`
--

CREATE TABLE IF NOT EXISTS `trades_details` (
`id` int(11) NOT NULL,
  `trade_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=21164 DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `billings_items`
--
ALTER TABLE `billings_items`
 ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts_types`
--
ALTER TABLE `shifts_types`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trades_details`
--
ALTER TABLE `trades_details`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=477645;
--
-- AUTO_INCREMENT for table `billings_items`
--
ALTER TABLE `billings_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=615413;
--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
MODIFY `id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
MODIFY `id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
MODIFY `id` int(16) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
MODIFY `id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50715;
--
-- AUTO_INCREMENT for table `shifts_types`
--
ALTER TABLE `shifts_types`
MODIFY `id` int(32) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=103;
--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16892;
--
-- AUTO_INCREMENT for table `trades_details`
--
ALTER TABLE `trades_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21164;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
