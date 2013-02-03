-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 03, 2013 at 11:23 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emlv4`
--

-- --------------------------------------------------------

--
-- Table structure for table `j17_accessmanager_config`
--

CREATE TABLE IF NOT EXISTS `j17_accessmanager_config` (
  `id` varchar(255) NOT NULL,
  `config` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_accessmanager_map`
--

CREATE TABLE IF NOT EXISTS `j17_accessmanager_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `level_title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=577 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_accessmanager_parts`
--

CREATE TABLE IF NOT EXISTS `j17_accessmanager_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_accessmanager_rights`
--

CREATE TABLE IF NOT EXISTS `j17_accessmanager_rights` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(200) NOT NULL,
  `group` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `access` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=700 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_acl`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_acl` (
  `user_id` bigint(20) unsigned NOT NULL,
  `permissions` mediumtext,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_adminiplist`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_adminiplist` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_badwords`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_badwords` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_customperms`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_customperms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `perms` varchar(4) DEFAULT '0644',
  UNIQUE KEY `id` (`id`),
  KEY `path` (`path`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_filescache`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_filescache` (
  `admintools_filescache_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `path` varchar(2048) NOT NULL,
  `filedate` int(11) NOT NULL DEFAULT '0',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `data` blob,
  `checksum` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`admintools_filescache_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_ipautoban`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_ipautoban` (
  `ip` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT 'other',
  `until` datetime DEFAULT NULL,
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_ipblock`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_ipblock` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_log`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `logdate` datetime NOT NULL,
  `ip` varchar(40) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT 'other',
  `extradata` mediumtext,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_redirects`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_redirects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(255) DEFAULT NULL,
  `dest` varchar(255) DEFAULT NULL,
  `ordering` bigint(20) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_scanalerts`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_scanalerts` (
  `admintools_scanalert_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `path` varchar(2048) NOT NULL,
  `scan_id` bigint(20) NOT NULL DEFAULT '0',
  `diff` mediumtext,
  `threat_score` int(11) NOT NULL DEFAULT '0',
  `acknowledged` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`admintools_scanalert_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_scans`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_scans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `comment` longtext,
  `backupstart` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `backupend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('run','fail','complete') NOT NULL DEFAULT 'run',
  `origin` varchar(30) NOT NULL DEFAULT 'backend',
  `type` varchar(30) NOT NULL DEFAULT 'full',
  `profile_id` bigint(20) NOT NULL DEFAULT '1',
  `archivename` longtext,
  `absolute_path` longtext,
  `multipart` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(255) DEFAULT NULL,
  `filesexist` tinyint(3) NOT NULL DEFAULT '1',
  `remote_filename` varchar(1000) DEFAULT NULL,
  `total_size` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_fullstatus` (`filesexist`,`status`),
  KEY `idx_stale` (`status`,`origin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_storage`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_storage` (
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_admintools_wafexceptions`
--

CREATE TABLE IF NOT EXISTS `j17_admintools_wafexceptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option` varchar(255) DEFAULT NULL,
  `view` varchar(255) DEFAULT NULL,
  `query` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_advancedmodules`
--

CREATE TABLE IF NOT EXISTS `j17_advancedmodules` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`moduleid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_ak_acl`
--

CREATE TABLE IF NOT EXISTS `j17_ak_acl` (
  `user_id` bigint(20) unsigned NOT NULL,
  `permissions` mediumtext,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_ak_profiles`
--

CREATE TABLE IF NOT EXISTS `j17_ak_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `configuration` longtext,
  `filters` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_ak_stats`
--

CREATE TABLE IF NOT EXISTS `j17_ak_stats` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `comment` longtext,
  `backupstart` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `backupend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('run','fail','complete') NOT NULL DEFAULT 'run',
  `origin` varchar(30) NOT NULL DEFAULT 'backend',
  `type` varchar(30) NOT NULL DEFAULT 'full',
  `profile_id` bigint(20) NOT NULL DEFAULT '1',
  `archivename` longtext,
  `absolute_path` longtext,
  `multipart` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(255) DEFAULT NULL,
  `filesexist` tinyint(3) NOT NULL DEFAULT '1',
  `remote_filename` varchar(1000) DEFAULT NULL,
  `total_size` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_fullstatus` (`filesexist`,`status`),
  KEY `idx_stale` (`status`,`origin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=346 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_ak_storage`
--

CREATE TABLE IF NOT EXISTS `j17_ak_storage` (
  `tag` varchar(255) NOT NULL,
  `lastupdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data` longtext,
  PRIMARY KEY (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_api_keys`
--

CREATE TABLE IF NOT EXISTS `j17_api_keys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `published` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_api_logs`
--

CREATE TABLE IF NOT EXISTS `j17_api_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hash` varchar(20) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `time` int(11) NOT NULL,
  `request` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `search` (`hash`,`ip_address`,`time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_assets`
--

CREATE TABLE IF NOT EXISTS `j17_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=496 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_associations`
--

CREATE TABLE IF NOT EXISTS `j17_associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_banners`
--

CREATE TABLE IF NOT EXISTS `j17_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_banner_clients`
--

CREATE TABLE IF NOT EXISTS `j17_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_banner_tracks`
--

CREATE TABLE IF NOT EXISTS `j17_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_categories`
--

CREATE TABLE IF NOT EXISTS `j17_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned DEFAULT NULL,
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler` (
  `id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(100) DEFAULT NULL,
  `middlename` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `hits` int(11) NOT NULL DEFAULT '0',
  `message_last_sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `message_number_sent` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `avatarapproved` tinyint(4) NOT NULL DEFAULT '1',
  `approved` tinyint(4) NOT NULL DEFAULT '1',
  `confirmed` tinyint(4) NOT NULL DEFAULT '1',
  `lastupdatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `registeripaddr` varchar(50) NOT NULL DEFAULT '',
  `cbactivation` varchar(50) NOT NULL DEFAULT '',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `banneddate` datetime DEFAULT NULL,
  `unbanneddate` datetime DEFAULT NULL,
  `bannedby` int(11) DEFAULT NULL,
  `unbannedby` int(11) DEFAULT NULL,
  `bannedreason` mediumtext,
  `acceptedterms` tinyint(1) NOT NULL DEFAULT '0',
  `fbviewtype` varchar(255) NOT NULL DEFAULT '_UE_FB_VIEWTYPE_FLAT',
  `fbordering` varchar(255) NOT NULL DEFAULT '_UE_FB_ORDERING_OLDEST',
  `fbsignature` mediumtext,
  `cb_positiond` varchar(255) DEFAULT NULL,
  `cb_sites` mediumtext NOT NULL,
  `cb_undergrad` varchar(255) DEFAULT NULL,
  `cb_residency` varchar(255) DEFAULT NULL,
  `connections` varchar(255) DEFAULT NULL,
  `cb_univappt` varchar(255) DEFAULT NULL,
  `cb_mdcert` mediumtext NOT NULL,
  `cb_profint` mediumtext,
  `cb_outint` mediumtext,
  `cb_memmnt` mediumtext,
  `cb_phoneh` varchar(255) DEFAULT NULL,
  `cb_phonem` varchar(255) DEFAULT NULL,
  `cb_phoneo` varchar(255) DEFAULT NULL,
  `cb_pager` varchar(255) DEFAULT NULL,
  `cb_addrcity` varchar(255) DEFAULT NULL,
  `cb_addrpstcd` varchar(255) DEFAULT NULL,
  `cb_addrs1` varchar(255) DEFAULT NULL,
  `cb_addrs2` varchar(255) DEFAULT NULL,
  `cb_addrprov` varchar(255) DEFAULT NULL,
  `formatname` varchar(255) DEFAULT NULL,
  `cb_displayname` varchar(255) DEFAULT NULL,
  `cb_ohip` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `apprconfbanid` (`approved`,`confirmed`,`banned`,`id`),
  KEY `avatappr_apr_conf_ban_avatar` (`avatarapproved`,`approved`,`confirmed`,`banned`,`avatar`),
  KEY `lastupdatedate` (`lastupdatedate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_fields`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_fields` (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `tablecolumns` text NOT NULL,
  `table` varchar(50) NOT NULL DEFAULT '#__comprofiler',
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `type` varchar(50) NOT NULL DEFAULT '',
  `maxlength` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `required` tinyint(4) DEFAULT '0',
  `tabid` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `cols` int(11) DEFAULT NULL,
  `rows` int(11) DEFAULT NULL,
  `value` varchar(50) DEFAULT NULL,
  `default` mediumtext,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `registration` tinyint(1) NOT NULL DEFAULT '0',
  `profile` tinyint(1) NOT NULL DEFAULT '1',
  `displaytitle` tinyint(1) NOT NULL DEFAULT '1',
  `readonly` tinyint(1) NOT NULL DEFAULT '0',
  `searchable` tinyint(1) NOT NULL DEFAULT '0',
  `calculated` tinyint(1) NOT NULL DEFAULT '0',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `pluginid` int(11) NOT NULL DEFAULT '0',
  `params` mediumtext,
  PRIMARY KEY (`fieldid`),
  KEY `tabid_pub_prof_order` (`tabid`,`published`,`profile`,`ordering`),
  KEY `readonly_published_tabid` (`readonly`,`published`,`tabid`),
  KEY `registration_published_order` (`registration`,`published`,`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=83 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_field_values`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_field_values` (
  `fieldvalueid` int(11) NOT NULL AUTO_INCREMENT,
  `fieldid` int(11) NOT NULL DEFAULT '0',
  `fieldtitle` varchar(255) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`fieldvalueid`),
  KEY `fieldid_ordering` (`fieldid`,`ordering`),
  KEY `fieldtitle_id` (`fieldtitle`,`fieldid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=275 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_lists`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_lists` (
  `listid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `viewaccesslevel` int(10) unsigned NOT NULL DEFAULT '0',
  `usergroupids` varchar(255) DEFAULT NULL,
  `useraccessgroupid` int(9) NOT NULL DEFAULT '18',
  `sortfields` varchar(255) DEFAULT NULL,
  `filterfields` mediumtext,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `col1title` varchar(255) DEFAULT NULL,
  `col1enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col1fields` mediumtext,
  `col2title` varchar(255) DEFAULT NULL,
  `col2enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col1captions` tinyint(1) NOT NULL DEFAULT '0',
  `col2fields` mediumtext,
  `col2captions` tinyint(1) NOT NULL DEFAULT '0',
  `col3title` varchar(255) DEFAULT NULL,
  `col3enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col3fields` mediumtext,
  `col3captions` tinyint(1) NOT NULL DEFAULT '0',
  `col4title` varchar(255) DEFAULT NULL,
  `col4enabled` tinyint(1) NOT NULL DEFAULT '0',
  `col4fields` mediumtext,
  `col4captions` tinyint(1) NOT NULL DEFAULT '0',
  `params` mediumtext,
  PRIMARY KEY (`listid`),
  KEY `pub_ordering` (`published`,`ordering`),
  KEY `default_published` (`default`,`published`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_members`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_members` (
  `referenceid` int(11) NOT NULL DEFAULT '0',
  `memberid` int(11) NOT NULL DEFAULT '0',
  `accepted` tinyint(1) NOT NULL DEFAULT '1',
  `pending` tinyint(1) NOT NULL DEFAULT '0',
  `membersince` date NOT NULL DEFAULT '0000-00-00',
  `reason` mediumtext,
  `description` varchar(255) DEFAULT NULL,
  `type` mediumtext,
  PRIMARY KEY (`referenceid`,`memberid`),
  KEY `pamr` (`pending`,`accepted`,`memberid`,`referenceid`),
  KEY `aprm` (`accepted`,`pending`,`referenceid`,`memberid`),
  KEY `membrefid` (`memberid`,`referenceid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_plugin`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_plugin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `element` varchar(100) NOT NULL DEFAULT '',
  `type` varchar(100) DEFAULT '',
  `folder` varchar(100) DEFAULT '',
  `backend_menu` varchar(255) NOT NULL DEFAULT '',
  `access` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(3) NOT NULL DEFAULT '0',
  `iscore` tinyint(3) NOT NULL DEFAULT '0',
  `client_id` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_folder` (`published`,`client_id`,`access`,`folder`),
  KEY `type_pub_order` (`type`,`published`,`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=504 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_sessions`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_sessions` (
  `username` varchar(50) NOT NULL DEFAULT '',
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `ui` tinyint(4) NOT NULL DEFAULT '0',
  `incoming_ip` varchar(39) NOT NULL DEFAULT '',
  `client_ip` varchar(39) NOT NULL DEFAULT '',
  `session_id` varchar(33) NOT NULL DEFAULT '',
  `session_data` mediumtext NOT NULL,
  `expiry_time` int(14) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `expiry_time` (`expiry_time`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_tabs`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_tabs` (
  `tabid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `description` text,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `ordering_register` int(11) NOT NULL DEFAULT '10',
  `width` varchar(10) NOT NULL DEFAULT '.5',
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `pluginclass` varchar(255) DEFAULT NULL,
  `pluginid` int(11) DEFAULT NULL,
  `fields` tinyint(1) NOT NULL DEFAULT '1',
  `params` mediumtext,
  `sys` tinyint(4) NOT NULL DEFAULT '0',
  `displaytype` varchar(255) NOT NULL DEFAULT '',
  `position` varchar(255) NOT NULL DEFAULT '',
  `viewaccesslevel` int(10) unsigned NOT NULL DEFAULT '0',
  `useraccessgroupid` int(9) NOT NULL DEFAULT '-2',
  PRIMARY KEY (`tabid`),
  KEY `enabled_position_ordering` (`enabled`,`position`,`ordering`),
  KEY `orderreg_enabled_pos_order` (`enabled`,`ordering_register`,`position`,`ordering`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_userreports`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_userreports` (
  `reportid` int(11) NOT NULL AUTO_INCREMENT,
  `reporteduser` int(11) NOT NULL DEFAULT '0',
  `reportedbyuser` int(11) NOT NULL DEFAULT '0',
  `reportedondate` date NOT NULL DEFAULT '0000-00-00',
  `reportexplaination` text NOT NULL,
  `reportedstatus` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reportid`),
  KEY `status_user_date` (`reportedstatus`,`reporteduser`,`reportedondate`),
  KEY `reportedbyuser_ondate` (`reportedbyuser`,`reportedondate`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_comprofiler_views`
--

CREATE TABLE IF NOT EXISTS `j17_comprofiler_views` (
  `viewer_id` int(11) NOT NULL DEFAULT '0',
  `profile_id` int(11) NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  `lastview` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `viewscount` int(11) NOT NULL DEFAULT '0',
  `vote` tinyint(3) DEFAULT NULL,
  `lastvote` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`viewer_id`,`profile_id`,`lastip`),
  KEY `lastview` (`lastview`),
  KEY `profile_id_lastview` (`profile_id`,`lastview`,`viewer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_contact_details`
--

CREATE TABLE IF NOT EXISTS `j17_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned DEFAULT NULL,
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_content`
--

CREATE TABLE IF NOT EXISTS `j17_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `title_alias` varchar(255) NOT NULL DEFAULT '',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1150 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `j17_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_content_rating`
--

CREATE TABLE IF NOT EXISTS `j17_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `j17_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_extensions`
--

CREATE TABLE IF NOT EXISTS `j17_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned DEFAULT NULL,
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10496 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_faqbook_items`
--

CREATE TABLE IF NOT EXISTS `j17_faqbook_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `content` mediumtext NOT NULL,
  `creator` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `votes_up` int(11) NOT NULL DEFAULT '0',
  `votes_down` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_filters`
--

CREATE TABLE IF NOT EXISTS `j17_finder_filters` (
  `filter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY (`filter_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL DEFAULT '0',
  `sale_price` double unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms0`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms1`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms2`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms3`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms4`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms5`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms6`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms7`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms8`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_terms9`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_termsa`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_termsb`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_termsc`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_termsd`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_termse`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_links_termsf`
--

CREATE TABLE IF NOT EXISTS `j17_finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_taxonomy`
--

CREATE TABLE IF NOT EXISTS `j17_finder_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_taxonomy_map`
--

CREATE TABLE IF NOT EXISTS `j17_finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_terms`
--

CREATE TABLE IF NOT EXISTS `j17_finder_terms` (
  `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_terms_common`
--

CREATE TABLE IF NOT EXISTS `j17_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_tokens`
--

CREATE TABLE IF NOT EXISTS `j17_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '1',
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_tokens_aggregate`
--

CREATE TABLE IF NOT EXISTS `j17_finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL,
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_finder_types`
--

CREATE TABLE IF NOT EXISTS `j17_finder_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_gcalendar`
--

CREATE TABLE IF NOT EXISTS `j17_gcalendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` text NOT NULL,
  `name` text NOT NULL,
  `magic_cookie` text NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` text,
  `color` text NOT NULL,
  `access` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `access_content` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_cats`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_cats` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_dir` text NOT NULL,
  `parent_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `cat_alias` varchar(255) NOT NULL,
  `cat_description` text NOT NULL,
  `cat_pic` varchar(255) NOT NULL,
  `cat_access` varchar(3) NOT NULL DEFAULT '00',
  `cat_group_access` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `jaccess` tinyint(3) NOT NULL DEFAULT '0',
  `jlanguage` varchar(7) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=167 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_config`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(64) NOT NULL DEFAULT '',
  `setting_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=197 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_files`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_files` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `file_title` varchar(255) NOT NULL DEFAULT '',
  `file_alias` varchar(255) NOT NULL DEFAULT '',
  `description` longtext NOT NULL,
  `description_long` longtext NOT NULL,
  `file_pic` varchar(255) NOT NULL DEFAULT '',
  `thumbnail` varchar(255) NOT NULL DEFAULT '',
  `thumbnail2` varchar(255) NOT NULL DEFAULT '',
  `thumbnail3` varchar(255) NOT NULL DEFAULT '',
  `price` varchar(20) NOT NULL DEFAULT '',
  `release` varchar(255) NOT NULL DEFAULT '',
  `language` tinyint(2) NOT NULL DEFAULT '0',
  `system` tinyint(2) NOT NULL DEFAULT '0',
  `license` varchar(255) NOT NULL DEFAULT '',
  `url_license` varchar(255) NOT NULL DEFAULT '',
  `license_agree` tinyint(1) NOT NULL DEFAULT '0',
  `size` varchar(255) NOT NULL DEFAULT '',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `file_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_from` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_to` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `use_timeframe` tinyint(1) NOT NULL DEFAULT '0',
  `url_download` varchar(255) NOT NULL DEFAULT '',
  `extern_file` varchar(255) NOT NULL DEFAULT '',
  `extern_site` tinyint(1) NOT NULL DEFAULT '0',
  `mirror_1` varchar(255) NOT NULL DEFAULT '',
  `mirror_2` varchar(255) NOT NULL DEFAULT '',
  `extern_site_mirror_1` tinyint(1) NOT NULL DEFAULT '0',
  `extern_site_mirror_2` tinyint(1) NOT NULL DEFAULT '0',
  `url_home` varchar(255) NOT NULL DEFAULT '',
  `author` varchar(255) NOT NULL DEFAULT '',
  `url_author` varchar(255) NOT NULL DEFAULT '',
  `created_by` varchar(255) NOT NULL DEFAULT '',
  `created_id` int(11) NOT NULL DEFAULT '0',
  `created_mail` varchar(255) NOT NULL DEFAULT '',
  `modified_by` varchar(255) NOT NULL DEFAULT '',
  `modified_id` int(11) NOT NULL DEFAULT '0',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `submitted_by` int(11) NOT NULL DEFAULT '0',
  `set_aup_points` tinyint(1) NOT NULL DEFAULT '0',
  `downloads` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `update_active` tinyint(1) NOT NULL DEFAULT '0',
  `custom_field_1` tinyint(2) NOT NULL DEFAULT '0',
  `custom_field_2` tinyint(2) NOT NULL DEFAULT '0',
  `custom_field_3` tinyint(2) NOT NULL DEFAULT '0',
  `custom_field_4` tinyint(2) NOT NULL DEFAULT '0',
  `custom_field_5` tinyint(2) NOT NULL DEFAULT '0',
  `custom_field_6` varchar(255) NOT NULL DEFAULT '',
  `custom_field_7` varchar(255) NOT NULL DEFAULT '',
  `custom_field_8` varchar(255) NOT NULL DEFAULT '',
  `custom_field_9` varchar(255) NOT NULL DEFAULT '',
  `custom_field_10` varchar(255) NOT NULL DEFAULT '',
  `custom_field_11` date NOT NULL DEFAULT '0000-00-00',
  `custom_field_12` date NOT NULL DEFAULT '0000-00-00',
  `custom_field_13` text NOT NULL,
  `custom_field_14` text NOT NULL,
  `jaccess` tinyint(3) NOT NULL DEFAULT '0',
  `jlanguage` varchar(7) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=530 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_groups`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groups_name` text NOT NULL,
  `groups_description` longtext,
  `groups_access` tinyint(4) NOT NULL DEFAULT '1',
  `groups_members` text,
  `jlanguage` varchar(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_license`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_license` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license_title` varchar(64) NOT NULL DEFAULT '',
  `license_text` longtext NOT NULL,
  `license_url` varchar(255) NOT NULL DEFAULT '',
  `jlanguage` varchar(7) NOT NULL DEFAULT '',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_log`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `log_file_id` int(11) NOT NULL,
  `log_ip` varchar(25) NOT NULL DEFAULT '',
  `log_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `log_user` int(11) NOT NULL DEFAULT '0',
  `log_browser` varchar(255) NOT NULL DEFAULT '',
  `jlanguage` varchar(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15254 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_rating`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_rating` (
  `file_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(11) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(11) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  `jlanguage` varchar(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jdownloads_templates`
--

CREATE TABLE IF NOT EXISTS `j17_jdownloads_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(64) NOT NULL DEFAULT '',
  `template_typ` tinyint(2) NOT NULL DEFAULT '0',
  `template_header_text` longtext NOT NULL,
  `template_subheader_text` longtext NOT NULL,
  `template_footer_text` longtext NOT NULL,
  `template_text` longtext NOT NULL,
  `template_active` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `note` tinytext NOT NULL,
  `cols` tinyint(1) NOT NULL DEFAULT '1',
  `checkbox_off` tinyint(1) NOT NULL DEFAULT '0',
  `symbol_off` tinyint(1) NOT NULL DEFAULT '0',
  `jlanguage` varchar(7) NOT NULL DEFAULT '',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_bundles`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_bundles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `courses` text NOT NULL,
  `cost` float NOT NULL,
  `currency` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_course_applications`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_course_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `application_date` datetime NOT NULL,
  `confirmation_date` datetime NOT NULL,
  `motivation` text NOT NULL,
  `experience` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_course_forums`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_course_forums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moodle_forum_id` int(11) NOT NULL,
  `kunena_forum_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_course_groups`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_course_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_field_mappings`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_field_mappings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `joomla_app` varchar(45) NOT NULL,
  `joomla_field` varchar(45) NOT NULL,
  `moodle_field` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_mailinglists`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_mailinglists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `list_id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_profiletypes`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_profiletypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profiletype_id` int(11) NOT NULL,
  `create_on_moodle` int(11) NOT NULL,
  `moodle_role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_joomdle_purchased_courses`
--

CREATE TABLE IF NOT EXISTS `j17_joomdle_purchased_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jotcache`
--

CREATE TABLE IF NOT EXISTS `j17_jotcache` (
  `fname` varchar(76) NOT NULL,
  `com` varchar(100) NOT NULL,
  `view` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `ftime` datetime NOT NULL,
  `mark` tinyint(1) NOT NULL,
  `checked_out` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `uri` text NOT NULL,
  `language` varchar(5) NOT NULL,
  `browser` varchar(50) NOT NULL,
  `qs` text NOT NULL,
  PRIMARY KEY (`fname`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jotcache_exclude`
--

CREATE TABLE IF NOT EXISTS `j17_jotcache_exclude` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL DEFAULT '',
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_jumi`
--

CREATE TABLE IF NOT EXISTS `j17_jumi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `custom_script` text,
  `access` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `published` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunenaimporter_users`
--

CREATE TABLE IF NOT EXISTS `j17_kunenaimporter_users` (
  `extid` int(11) NOT NULL AUTO_INCREMENT,
  `extusername` varchar(150) NOT NULL DEFAULT '',
  `id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '',
  `username` varchar(150) DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `gid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `params` text NOT NULL,
  `conflict` text,
  `error` text,
  `migrated` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`extid`),
  KEY `extusername` (`extusername`),
  KEY `id` (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=329 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_aliases`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_aliases` (
  `alias` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `item` varchar(32) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  UNIQUE KEY `alias` (`alias`),
  KEY `state` (`state`),
  KEY `item` (`item`),
  KEY `type` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_announcement`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_announcement` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` tinytext NOT NULL,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `sdescription` text NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` tinyint(4) NOT NULL DEFAULT '0',
  `showdate` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_attachments`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mesid` int(11) NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0',
  `hash` char(32) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `folder` varchar(255) NOT NULL,
  `filetype` varchar(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mesid` (`mesid`),
  KEY `userid` (`userid`),
  KEY `hash` (`hash`),
  KEY `filename` (`filename`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_categories`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT '0',
  `name` tinytext,
  `alias` varchar(255) NOT NULL,
  `icon_id` tinyint(4) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `accesstype` varchar(20) NOT NULL DEFAULT 'joomla.level',
  `access` int(11) NOT NULL DEFAULT '0',
  `pub_access` int(11) NOT NULL DEFAULT '1',
  `pub_recurse` tinyint(4) DEFAULT '1',
  `admin_access` int(11) NOT NULL DEFAULT '0',
  `admin_recurse` tinyint(4) DEFAULT '1',
  `ordering` smallint(6) NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL DEFAULT '0',
  `channels` text,
  `checked_out` tinyint(4) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review` tinyint(4) NOT NULL DEFAULT '0',
  `allow_anonymous` tinyint(4) NOT NULL DEFAULT '0',
  `post_anonymous` tinyint(4) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `headerdesc` text NOT NULL,
  `class_sfx` varchar(20) NOT NULL,
  `allow_polls` tinyint(4) NOT NULL DEFAULT '0',
  `topic_ordering` varchar(16) NOT NULL DEFAULT 'lastpost',
  `numTopics` mediumint(8) NOT NULL DEFAULT '0',
  `numPosts` mediumint(8) NOT NULL DEFAULT '0',
  `last_topic_id` int(11) NOT NULL DEFAULT '0',
  `last_post_id` int(11) NOT NULL DEFAULT '0',
  `last_post_time` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published_pubaccess_id` (`published`,`pub_access`,`id`),
  KEY `category_access` (`accesstype`,`access`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_configuration`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_configuration` (
  `id` int(11) NOT NULL DEFAULT '0',
  `params` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_keywords`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `public_count` int(11) NOT NULL,
  `total_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `public_count` (`public_count`),
  KEY `total_count` (`total_count`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_keywords_map`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_keywords_map` (
  `keyword_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  UNIQUE KEY `keyword_user_topic` (`keyword_id`,`user_id`,`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `topic_user` (`topic_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_messages`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) DEFAULT '0',
  `thread` int(11) DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `name` tinytext,
  `userid` int(11) NOT NULL DEFAULT '0',
  `email` tinytext,
  `subject` tinytext,
  `time` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(128) DEFAULT NULL,
  `topic_emoticon` int(11) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `hold` tinyint(4) NOT NULL DEFAULT '0',
  `ordering` int(11) DEFAULT '0',
  `hits` int(11) DEFAULT '0',
  `moved` tinyint(4) DEFAULT '0',
  `modified_by` int(7) DEFAULT NULL,
  `modified_time` int(11) DEFAULT NULL,
  `modified_reason` tinytext,
  PRIMARY KEY (`id`),
  KEY `thread` (`thread`),
  KEY `ip` (`ip`),
  KEY `userid` (`userid`),
  KEY `time` (`time`),
  KEY `locked` (`locked`),
  KEY `hold_time` (`hold`,`time`),
  KEY `parent_hits` (`parent`,`hits`),
  KEY `catid_parent` (`catid`,`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=777 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_messages_text`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_messages_text` (
  `mesid` int(11) NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  PRIMARY KEY (`mesid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_polls`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_polls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `threadid` int(11) NOT NULL,
  `polltimetolive` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `threadid` (`threadid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_polls_options`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_polls_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) DEFAULT NULL,
  `text` varchar(100) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pollid` (`pollid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_polls_users`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_polls_users` (
  `pollid` int(11) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `votes` int(11) DEFAULT NULL,
  `lasttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvote` int(11) DEFAULT NULL,
  UNIQUE KEY `pollid` (`pollid`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_ranks`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_ranks` (
  `rank_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) NOT NULL DEFAULT '',
  `rank_min` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rank_image` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`rank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_sessions`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_sessions` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `allowed` text,
  `lasttime` int(11) NOT NULL DEFAULT '0',
  `readtopics` text,
  `currvisit` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`),
  KEY `currvisit` (`currvisit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_smileys`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_smileys` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `code` varchar(12) NOT NULL DEFAULT '',
  `location` varchar(50) NOT NULL DEFAULT '',
  `greylocation` varchar(60) NOT NULL DEFAULT '',
  `emoticonbar` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_thankyou`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_thankyou` (
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `targetuserid` int(11) NOT NULL,
  `time` datetime NOT NULL,
  UNIQUE KEY `postid` (`postid`,`userid`),
  KEY `userid` (`userid`),
  KEY `targetuserid` (`targetuserid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_topics`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `subject` tinytext,
  `icon_id` int(11) NOT NULL DEFAULT '0',
  `locked` tinyint(4) NOT NULL DEFAULT '0',
  `hold` tinyint(4) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `posts` int(11) NOT NULL DEFAULT '0',
  `hits` int(11) NOT NULL DEFAULT '0',
  `attachments` int(11) NOT NULL DEFAULT '0',
  `poll_id` int(11) NOT NULL DEFAULT '0',
  `moved_id` int(11) NOT NULL DEFAULT '0',
  `first_post_id` int(11) NOT NULL DEFAULT '0',
  `first_post_time` int(11) NOT NULL DEFAULT '0',
  `first_post_userid` int(11) NOT NULL DEFAULT '0',
  `first_post_message` text,
  `first_post_guest_name` tinytext,
  `last_post_id` int(11) NOT NULL DEFAULT '0',
  `last_post_time` int(11) NOT NULL DEFAULT '0',
  `last_post_userid` int(11) NOT NULL DEFAULT '0',
  `last_post_message` text,
  `last_post_guest_name` tinytext,
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `locked` (`locked`),
  KEY `hold` (`hold`),
  KEY `posts` (`posts`),
  KEY `hits` (`hits`),
  KEY `first_post_userid` (`first_post_userid`),
  KEY `last_post_userid` (`last_post_userid`),
  KEY `first_post_time` (`first_post_time`),
  KEY `last_post_time` (`last_post_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=776 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_users`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_users` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `view` varchar(8) NOT NULL DEFAULT '',
  `signature` text,
  `moderator` int(11) DEFAULT '0',
  `banned` datetime DEFAULT NULL,
  `ordering` int(11) DEFAULT '0',
  `posts` int(11) DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `karma` int(11) DEFAULT '0',
  `karma_time` int(11) DEFAULT '0',
  `group_id` int(4) DEFAULT '1',
  `uhits` int(11) DEFAULT '0',
  `personalText` tinytext,
  `gender` tinyint(4) NOT NULL DEFAULT '0',
  `birthdate` date NOT NULL DEFAULT '0001-01-01',
  `location` varchar(50) DEFAULT NULL,
  `icq` varchar(50) DEFAULT NULL,
  `aim` varchar(50) DEFAULT NULL,
  `yim` varchar(50) DEFAULT NULL,
  `msn` varchar(50) DEFAULT NULL,
  `skype` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `gtalk` varchar(50) DEFAULT NULL,
  `myspace` varchar(50) DEFAULT NULL,
  `linkedin` varchar(50) DEFAULT NULL,
  `delicious` varchar(50) DEFAULT NULL,
  `friendfeed` varchar(50) DEFAULT NULL,
  `digg` varchar(50) DEFAULT NULL,
  `blogspot` varchar(50) DEFAULT NULL,
  `flickr` varchar(50) DEFAULT NULL,
  `bebo` varchar(50) DEFAULT NULL,
  `websitename` varchar(50) DEFAULT NULL,
  `websiteurl` varchar(50) DEFAULT NULL,
  `rank` tinyint(4) NOT NULL DEFAULT '0',
  `hideEmail` tinyint(1) NOT NULL DEFAULT '1',
  `showOnline` tinyint(1) NOT NULL DEFAULT '1',
  `thankyou` int(11) DEFAULT '0',
  PRIMARY KEY (`userid`),
  KEY `group_id` (`group_id`),
  KEY `posts` (`posts`),
  KEY `uhits` (`uhits`),
  KEY `banned` (`banned`),
  KEY `moderator` (`moderator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_users_banned`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_users_banned` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) DEFAULT NULL,
  `ip` varchar(128) DEFAULT NULL,
  `blocked` tinyint(4) NOT NULL DEFAULT '0',
  `expiration` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `reason_private` text,
  `reason_public` text,
  `modified_by` int(11) DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `comments` text,
  `params` text,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `ip` (`ip`),
  KEY `expiration` (`expiration`),
  KEY `created_time` (`created_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_user_categories`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_user_categories` (
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `role` tinyint(4) NOT NULL DEFAULT '0',
  `allreadtime` datetime DEFAULT NULL,
  `subscribed` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  PRIMARY KEY (`user_id`,`category_id`),
  KEY `category_subscribed` (`category_id`,`subscribed`),
  KEY `role` (`role`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_user_read`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_user_read` (
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  UNIQUE KEY `user_topic_id` (`user_id`,`topic_id`),
  KEY `category_user_id` (`category_id`,`user_id`),
  KEY `time` (`time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_user_topics`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_user_topics` (
  `user_id` int(11) NOT NULL DEFAULT '0',
  `topic_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `posts` mediumint(8) NOT NULL DEFAULT '0',
  `last_post_id` int(11) NOT NULL DEFAULT '0',
  `owner` tinyint(4) NOT NULL DEFAULT '0',
  `favorite` tinyint(4) NOT NULL DEFAULT '0',
  `subscribed` tinyint(4) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  UNIQUE KEY `user_topic_id` (`user_id`,`topic_id`),
  KEY `topic_id` (`topic_id`),
  KEY `posts` (`posts`),
  KEY `owner` (`owner`),
  KEY `favorite` (`favorite`),
  KEY `subscribed` (`subscribed`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_kunena_version`
--

CREATE TABLE IF NOT EXISTS `j17_kunena_version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` varchar(20) NOT NULL,
  `versiondate` date NOT NULL,
  `installdate` date NOT NULL,
  `build` varchar(20) NOT NULL,
  `versionname` varchar(40) DEFAULT NULL,
  `state` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_languages`
--

CREATE TABLE IF NOT EXISTS `j17_languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_menu`
--

CREATE TABLE IF NOT EXISTS `j17_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned DEFAULT NULL,
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=647 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_menu_types`
--

CREATE TABLE IF NOT EXISTS `j17_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_messages`
--

CREATE TABLE IF NOT EXISTS `j17_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=153 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `j17_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_mj_amdd`
--

CREATE TABLE IF NOT EXISTS `j17_mj_amdd` (
  `ua` varchar(255) COLLATE utf8_bin NOT NULL,
  `group` varchar(32) COLLATE utf8_bin NOT NULL,
  `data` varchar(255) COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `ua` (`ua`),
  KEY `group` (`group`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `j17_mj_amdd_cache`
--

CREATE TABLE IF NOT EXISTS `j17_mj_amdd_cache` (
  `ua` varchar(255) COLLATE utf8_bin NOT NULL,
  `data` varchar(255) COLLATE utf8_bin NOT NULL,
  `time` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `j17_mj_modules`
--

CREATE TABLE IF NOT EXISTS `j17_mj_modules` (
  `id` int(10) unsigned NOT NULL,
  `markup` varchar(16) NOT NULL,
  PRIMARY KEY (`markup`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_mj_plugins`
--

CREATE TABLE IF NOT EXISTS `j17_mj_plugins` (
  `id` int(10) unsigned NOT NULL,
  `markup` varchar(16) NOT NULL,
  PRIMARY KEY (`markup`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_modules`
--

CREATE TABLE IF NOT EXISTS `j17_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) DEFAULT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned DEFAULT NULL,
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=291 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_modules_menu`
--

CREATE TABLE IF NOT EXISTS `j17_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `j17_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) unsigned DEFAULT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_ohipcodes`
--

CREATE TABLE IF NOT EXISTS `j17_ohipcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `notes` text NOT NULL,
  `value` int(10) NOT NULL,
  `tag` varchar(200) NOT NULL,
  `cat` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_oneclickaction_actions`
--

CREATE TABLE IF NOT EXISTS `j17_oneclickaction_actions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` bigint(20) unsigned NOT NULL,
  `actionurl` varchar(4000) NOT NULL,
  `otp` char(64) NOT NULL,
  `expiry` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_overrider`
--

CREATE TABLE IF NOT EXISTS `j17_overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_poweradmin_history`
--

CREATE TABLE IF NOT EXISTS `j17_poweradmin_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `object_key` varchar(255) NOT NULL,
  `object_id` int(11) NOT NULL,
  `component` varchar(255) NOT NULL,
  `list_page` varchar(255) NOT NULL,
  `list_page_params` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` tinytext NOT NULL,
  `form` text NOT NULL,
  `form_hash` varchar(32) NOT NULL,
  `params` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `css` varchar(100) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `visited` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2727 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_redirect_links`
--

CREATE TABLE IF NOT EXISTS `j17_redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(255) DEFAULT NULL,
  `new_url` varchar(255) DEFAULT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=137700 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rokadminaudit`
--

CREATE TABLE IF NOT EXISTS `j17_rokadminaudit` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `option` varchar(100) DEFAULT NULL,
  `task` varchar(100) DEFAULT NULL,
  `cid` int(50) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `title` text,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip` (`ip`),
  KEY `session_id` (`session_id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80420 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rokuserstats`
--

CREATE TABLE IF NOT EXISTS `j17_rokuserstats` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `session_id` varchar(50) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ip` (`ip`),
  KEY `session_id` (`session_id`),
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1178720 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_components`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_components` (
  `ComponentId` int(11) NOT NULL AUTO_INCREMENT,
  `FormId` int(11) NOT NULL DEFAULT '0',
  `ComponentTypeId` int(11) NOT NULL DEFAULT '0',
  `Order` int(11) NOT NULL DEFAULT '0',
  `Published` tinyint(1) NOT NULL DEFAULT '1',
  UNIQUE KEY `ComponentId` (`ComponentId`),
  KEY `ComponentTypeId` (`ComponentTypeId`),
  KEY `FormId` (`FormId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=105 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_component_types`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_component_types` (
  `ComponentTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `ComponentTypeName` text NOT NULL,
  PRIMARY KEY (`ComponentTypeId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_component_type_fields`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_component_type_fields` (
  `ComponentTypeFieldId` int(11) NOT NULL AUTO_INCREMENT,
  `ComponentTypeId` int(11) NOT NULL DEFAULT '0',
  `FieldName` text NOT NULL,
  `FieldType` enum('hidden','hiddenparam','textbox','textarea','select','emailattach') NOT NULL DEFAULT 'hidden',
  `FieldValues` text NOT NULL,
  `Ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ComponentTypeFieldId`),
  KEY `ComponentTypeId` (`ComponentTypeId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=183 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_config`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_config` (
  `ConfigId` int(11) NOT NULL AUTO_INCREMENT,
  `SettingName` varchar(64) NOT NULL DEFAULT '',
  `SettingValue` text NOT NULL,
  PRIMARY KEY (`ConfigId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_emails`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formId` int(11) NOT NULL,
  `from` varchar(255) NOT NULL,
  `fromname` varchar(255) NOT NULL,
  `replyto` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `cc` varchar(255) NOT NULL,
  `bcc` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mode` tinyint(1) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_forms`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_forms` (
  `FormId` int(11) NOT NULL AUTO_INCREMENT,
  `FormName` text NOT NULL,
  `FormLayout` longtext NOT NULL,
  `FormLayoutName` text NOT NULL,
  `FormLayoutAutogenerate` tinyint(1) NOT NULL DEFAULT '1',
  `CSS` text NOT NULL,
  `JS` text NOT NULL,
  `FormTitle` text NOT NULL,
  `Published` tinyint(1) NOT NULL DEFAULT '1',
  `Lang` varchar(255) NOT NULL DEFAULT '',
  `ReturnUrl` text NOT NULL,
  `ShowThankyou` tinyint(1) NOT NULL DEFAULT '1',
  `Thankyou` text NOT NULL,
  `ShowContinue` tinyint(1) NOT NULL DEFAULT '1',
  `UserEmailText` text NOT NULL,
  `UserEmailTo` text NOT NULL,
  `UserEmailCC` varchar(255) NOT NULL,
  `UserEmailBCC` varchar(255) NOT NULL,
  `UserEmailFrom` varchar(255) NOT NULL DEFAULT '',
  `UserEmailReplyTo` varchar(255) NOT NULL,
  `UserEmailFromName` varchar(255) NOT NULL DEFAULT '',
  `UserEmailSubject` varchar(255) NOT NULL DEFAULT '',
  `UserEmailMode` tinyint(4) NOT NULL DEFAULT '1',
  `UserEmailAttach` tinyint(4) NOT NULL,
  `UserEmailAttachFile` varchar(255) NOT NULL,
  `AdminEmailText` text NOT NULL,
  `AdminEmailTo` text NOT NULL,
  `AdminEmailCC` varchar(255) NOT NULL,
  `AdminEmailBCC` varchar(255) NOT NULL,
  `AdminEmailFrom` varchar(255) NOT NULL DEFAULT '',
  `AdminEmailReplyTo` varchar(255) NOT NULL,
  `AdminEmailFromName` varchar(255) NOT NULL DEFAULT '',
  `AdminEmailSubject` varchar(255) NOT NULL DEFAULT '',
  `AdminEmailMode` tinyint(4) NOT NULL DEFAULT '1',
  `ScriptProcess` text NOT NULL,
  `ScriptProcess2` text NOT NULL,
  `ScriptDisplay` text NOT NULL,
  `UserEmailScript` text NOT NULL,
  `AdminEmailScript` text NOT NULL,
  `AdditionalEmailsScript` text NOT NULL,
  `MetaTitle` tinyint(1) NOT NULL,
  `MetaDesc` text NOT NULL,
  `MetaKeywords` text NOT NULL,
  `Required` varchar(255) NOT NULL DEFAULT '(*)',
  `ErrorMessage` text NOT NULL,
  `MultipleSeparator` varchar(64) NOT NULL DEFAULT '\\n',
  `TextareaNewLines` tinyint(1) NOT NULL DEFAULT '1',
  `CSSClass` varchar(255) NOT NULL,
  `CSSId` varchar(255) NOT NULL DEFAULT 'userForm',
  `CSSName` varchar(255) NOT NULL,
  `CSSAction` text NOT NULL,
  `CSSAdditionalAttributes` text NOT NULL,
  `AjaxValidation` tinyint(1) NOT NULL,
  `ThemeParams` text NOT NULL,
  `Keepdata` tinyint(1) NOT NULL DEFAULT '1',
  `Backendmenu` tinyint(1) NOT NULL,
  `ConfirmSubmission` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FormId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_forms_BAK`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_forms_BAK` (
  `FormId` int(11) NOT NULL AUTO_INCREMENT,
  `FormName` text NOT NULL,
  `FormLayout` longtext NOT NULL,
  `FormLayoutName` text NOT NULL,
  `FormLayoutAutogenerate` tinyint(1) NOT NULL DEFAULT '1',
  `CSS` text NOT NULL,
  `JS` text NOT NULL,
  `FormTitle` text NOT NULL,
  `Published` tinyint(1) NOT NULL DEFAULT '1',
  `Lang` varchar(255) NOT NULL DEFAULT '',
  `ReturnUrl` text NOT NULL,
  `ShowThankyou` tinyint(1) NOT NULL DEFAULT '1',
  `Thankyou` text NOT NULL,
  `ShowContinue` tinyint(1) NOT NULL DEFAULT '1',
  `UserEmailText` text NOT NULL,
  `UserEmailTo` text NOT NULL,
  `UserEmailCC` varchar(255) NOT NULL,
  `UserEmailBCC` varchar(255) NOT NULL,
  `UserEmailFrom` varchar(255) NOT NULL DEFAULT '',
  `UserEmailReplyTo` varchar(255) NOT NULL,
  `UserEmailFromName` varchar(255) NOT NULL DEFAULT '',
  `UserEmailSubject` varchar(255) NOT NULL DEFAULT '',
  `UserEmailMode` tinyint(4) NOT NULL DEFAULT '1',
  `UserEmailAttach` tinyint(4) NOT NULL,
  `UserEmailAttachFile` varchar(255) NOT NULL,
  `AdminEmailText` text NOT NULL,
  `AdminEmailTo` text NOT NULL,
  `AdminEmailCC` varchar(255) NOT NULL,
  `AdminEmailBCC` varchar(255) NOT NULL,
  `AdminEmailFrom` varchar(255) NOT NULL DEFAULT '',
  `AdminEmailReplyTo` varchar(255) NOT NULL,
  `AdminEmailFromName` varchar(255) NOT NULL DEFAULT '',
  `AdminEmailSubject` varchar(255) NOT NULL DEFAULT '',
  `AdminEmailMode` tinyint(4) NOT NULL DEFAULT '1',
  `ScriptProcess` text NOT NULL,
  `ScriptProcess2` text NOT NULL,
  `ScriptDisplay` text NOT NULL,
  `UserEmailScript` text NOT NULL,
  `AdminEmailScript` text NOT NULL,
  `AdditionalEmailsScript` text NOT NULL,
  `MetaTitle` tinyint(1) NOT NULL,
  `MetaDesc` text NOT NULL,
  `MetaKeywords` text NOT NULL,
  `Required` varchar(255) NOT NULL DEFAULT '(*)',
  `ErrorMessage` text NOT NULL,
  `MultipleSeparator` varchar(64) NOT NULL DEFAULT '\\n',
  `TextareaNewLines` tinyint(1) NOT NULL DEFAULT '1',
  `CSSClass` varchar(255) NOT NULL,
  `CSSId` varchar(255) NOT NULL DEFAULT 'userForm',
  `CSSName` varchar(255) NOT NULL,
  `CSSAction` text NOT NULL,
  `CSSAdditionalAttributes` text NOT NULL,
  `AjaxValidation` tinyint(1) NOT NULL,
  `ThemeParams` text NOT NULL,
  `Keepdata` tinyint(1) NOT NULL DEFAULT '1',
  `Backendmenu` tinyint(1) NOT NULL,
  `ConfirmSubmission` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`FormId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_mappings`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_mappings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formId` int(11) NOT NULL,
  `connection` tinyint(1) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `database` varchar(255) NOT NULL,
  `method` tinyint(1) NOT NULL,
  `table` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `wheredata` text NOT NULL,
  `extra` text NOT NULL,
  `andor` text NOT NULL,
  `ordering` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_properties`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_properties` (
  `PropertyId` int(11) NOT NULL AUTO_INCREMENT,
  `ComponentId` int(11) NOT NULL DEFAULT '0',
  `PropertyName` text NOT NULL,
  `PropertyValue` text NOT NULL,
  UNIQUE KEY `PropertyId` (`PropertyId`),
  KEY `ComponentId` (`ComponentId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=885 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_submissions`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_submissions` (
  `SubmissionId` int(11) NOT NULL AUTO_INCREMENT,
  `FormId` int(11) NOT NULL DEFAULT '0',
  `DateSubmitted` datetime NOT NULL,
  `UserIp` varchar(15) NOT NULL DEFAULT '',
  `Username` varchar(255) NOT NULL DEFAULT '',
  `UserId` text NOT NULL,
  `Lang` varchar(255) NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  PRIMARY KEY (`SubmissionId`),
  KEY `FormId` (`FormId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=328 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_submission_columns`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_submission_columns` (
  `FormId` int(11) NOT NULL,
  `ColumnName` varchar(255) NOT NULL,
  `ColumnStatic` tinyint(1) NOT NULL,
  PRIMARY KEY (`FormId`,`ColumnName`,`ColumnStatic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_submission_values`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_submission_values` (
  `SubmissionValueId` int(11) NOT NULL AUTO_INCREMENT,
  `FormId` int(11) NOT NULL,
  `SubmissionId` int(11) NOT NULL DEFAULT '0',
  `FieldName` text NOT NULL,
  `FieldValue` text NOT NULL,
  PRIMARY KEY (`SubmissionValueId`),
  KEY `FormId` (`FormId`),
  KEY `SubmissionId` (`SubmissionId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7649 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_rsform_translations`
--

CREATE TABLE IF NOT EXISTS `j17_rsform_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `lang_code` varchar(32) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `reference_id` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_schemas`
--

CREATE TABLE IF NOT EXISTS `j17_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_session`
--

CREATE TABLE IF NOT EXISTS `j17_session` (
  `session_id` varchar(200) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` mediumtext,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  `usertype` varchar(50) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_button`
--

CREATE TABLE IF NOT EXISTS `j17_shell_button` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `who_created_this` int(11) NOT NULL,
  `command_task` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `update_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_component`
--

CREATE TABLE IF NOT EXISTS `j17_shell_component` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` tinytext NOT NULL,
  `type` varchar(50) NOT NULL,
  `alias` varchar(50) NOT NULL,
  `controller` varchar(100) NOT NULL,
  `primary` tinyint(4) NOT NULL,
  `connection_field` varchar(100) NOT NULL,
  `command_task` varchar(100) NOT NULL,
  `access` int(11) NOT NULL,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `update_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_connect_article`
--

CREATE TABLE IF NOT EXISTS `j17_shell_connect_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `target_component` varchar(200) NOT NULL,
  `target_id` int(11) NOT NULL,
  `view_id` int(100) NOT NULL,
  `item_id` int(11) NOT NULL,
  `when_show` varchar(50) NOT NULL,
  `update_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_connect_article_params`
--

CREATE TABLE IF NOT EXISTS `j17_shell_connect_article_params` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option` varchar(100) NOT NULL,
  `component_id` int(11) NOT NULL,
  `view` varchar(100) NOT NULL,
  `kind_connection` varchar(50) NOT NULL,
  `category_id` varchar(250) NOT NULL,
  `show_list` tinyint(4) NOT NULL,
  `text` varchar(100) NOT NULL,
  `when_show` varchar(50) NOT NULL,
  `primary` int(10) NOT NULL,
  `params` text NOT NULL,
  `params_view` text NOT NULL,
  `update_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_db`
--

CREATE TABLE IF NOT EXISTS `j17_shell_db` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `Field` varchar(100) NOT NULL,
  `Type` varchar(100) NOT NULL,
  `db` varchar(100) NOT NULL,
  `locked` tinyint(4) NOT NULL,
  `is_category` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_filter`
--

CREATE TABLE IF NOT EXISTS `j17_shell_filter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `access_component` varchar(100) NOT NULL,
  `access_site` varchar(50) NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `campo_db` varchar(100) NOT NULL,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `update_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_form`
--

CREATE TABLE IF NOT EXISTS `j17_shell_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL DEFAULT '0',
  `view_id` int(11) NOT NULL DEFAULT '0',
  `controller` varchar(100) NOT NULL DEFAULT 'shell_component',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL,
  `setChild` varchar(250) NOT NULL,
  `type` varchar(250) NOT NULL,
  `label` varchar(250) NOT NULL,
  `params` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `update_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=858 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_list`
--

CREATE TABLE IF NOT EXISTS `j17_shell_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `campo_db` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `parametri` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `update_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_shell_view`
--

CREATE TABLE IF NOT EXISTS `j17_shell_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `component_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `primary` int(11) NOT NULL DEFAULT '0',
  `is_module` tinyint(4) NOT NULL DEFAULT '0',
  `command_option` varchar(100) NOT NULL,
  `command_view` varchar(100) NOT NULL,
  `path` varchar(250) NOT NULL,
  `params` text NOT NULL,
  `params_helper` text NOT NULL,
  `ordering` int(11) NOT NULL,
  `update_id` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `component_view` (`command_option`,`command_view`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_template_styles`
--

CREATE TABLE IF NOT EXISTS `j17_template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurflCache`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurflCache` (
  `user_agent` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `cache_data` mediumtext NOT NULL,
  PRIMARY KEY (`user_agent`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurflIndex`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurflIndex` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `matcher` varchar(64) NOT NULL,
  PRIMARY KEY (`deviceID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurflMerge`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurflMerge` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurflSettings`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurflSettings` (
  `id` varchar(64) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Alcatel`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Alcatel` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Android`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Android` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Apple`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Apple` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_BenQ`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_BenQ` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_BlackBerry`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_BlackBerry` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Bot`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Bot` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_CatchAll`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_CatchAll` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Chrome`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Chrome` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_DoCoMo`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_DoCoMo` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Firefox`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Firefox` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Grundig`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Grundig` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_HTC`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_HTC` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_HTCMac`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_HTCMac` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_JavaMidlet`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_JavaMidlet` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Kddi`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Kddi` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Kindle`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Kindle` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Konqueror`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Konqueror` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Kyocera`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Kyocera` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_LG`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_LG` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_LGUPLUS`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_LGUPLUS` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Mitsubishi`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Mitsubishi` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Motorola`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Motorola` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_MSIE`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_MSIE` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Nec`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Nec` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Nintendo`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Nintendo` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Nokia`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Nokia` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_NokiaOviBrowser`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_NokiaOviBrowser` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Opera`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Opera` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_OperaMini`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_OperaMini` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Panasonic`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Panasonic` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Pantech`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Pantech` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Philips`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Philips` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Portalmmm`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Portalmmm` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Qtek`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Qtek` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Reksio`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Reksio` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Safari`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Safari` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Sagem`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Sagem` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Samsung`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Samsung` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Sanyo`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Sanyo` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Sharp`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Sharp` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Siemens`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Siemens` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_SmartTV`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_SmartTV` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_SonyEricsson`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_SonyEricsson` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_SPV`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_SPV` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Toshiba`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Toshiba` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_Vodafone`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_Vodafone` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_WebOS`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_WebOS` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_WindowsPhone`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_WindowsPhone` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_TeraWurfl_WindowsPhoneDesktop`
--

CREATE TABLE IF NOT EXISTS `j17_TeraWurfl_WindowsPhoneDesktop` (
  `deviceID` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_agent` varchar(255) DEFAULT NULL,
  `fall_back` varchar(64) DEFAULT NULL,
  `actual_device_root` tinyint(1) DEFAULT '0',
  `match` tinyint(1) DEFAULT '1',
  `capabilities` mediumtext,
  PRIMARY KEY (`deviceID`),
  KEY `fallback` (`fall_back`),
  KEY `useragent` (`user_agent`),
  KEY `dev_root` (`actual_device_root`),
  KEY `idxmatch` (`match`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_updates`
--

CREATE TABLE IF NOT EXISTS `j17_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Available Updates' AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_update_categories`
--

CREATE TABLE IF NOT EXISTS `j17_update_categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Update Categories' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_update_sites`
--

CREATE TABLE IF NOT EXISTS `j17_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Update Sites' AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_update_sites_extensions`
--

CREATE TABLE IF NOT EXISTS `j17_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

-- --------------------------------------------------------

--
-- Table structure for table `j17_usergroups`
--

CREATE TABLE IF NOT EXISTS `j17_usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_users`
--

CREATE TABLE IF NOT EXISTS `j17_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=370 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_user_notes`
--

CREATE TABLE IF NOT EXISTS `j17_user_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`catid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_user_profiles`
--

CREATE TABLE IF NOT EXISTS `j17_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';

-- --------------------------------------------------------

--
-- Table structure for table `j17_user_usergroup_map`
--

CREATE TABLE IF NOT EXISTS `j17_user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `j17_viewlevels`
--

CREATE TABLE IF NOT EXISTS `j17_viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_weblinks`
--

CREATE TABLE IF NOT EXISTS `j17_weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_wf_profiles`
--

CREATE TABLE IF NOT EXISTS `j17_wf_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `users` text NOT NULL,
  `types` text,
  `components` text NOT NULL,
  `area` tinyint(3) NOT NULL,
  `device` varchar(255) DEFAULT NULL,
  `rows` text NOT NULL,
  `plugins` text NOT NULL,
  `published` tinyint(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` tinyint(3) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `j17_widgetkit_widget`
--

CREATE TABLE IF NOT EXISTS `j17_widgetkit_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `style` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
