SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE IF NOT EXISTS `hybrida_dev` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hybrida_dev`;

CREATE TABLE IF NOT EXISTS `access_relations` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `type` enum('article','event','image','news','signup','album','forumthread') COLLATE utf8_unicode_ci NOT NULL,
  `super_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`type`,`access`,`super_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `album_image` (
  `image_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shorttitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articleTextId` int(11) DEFAULT NULL,
  `author` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=111 ;

CREATE TABLE IF NOT EXISTS `article_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `articleId` int(11) NOT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `phpFile` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=229 ;

CREATE TABLE IF NOT EXISTS `bk_company` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactorID` int(11) DEFAULT NULL,
  `companyName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateAdded` datetime DEFAULT NULL,
  `dateUpdated` datetime DEFAULT NULL,
  `dateAssigned` datetime DEFAULT NULL,
  `homepage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addedByID` int(11) DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updatedByID` int(11) DEFAULT NULL,
  `postbox` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postnumber` int(11) DEFAULT NULL,
  `postplace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Aktuell senere','Blir kontaktet','Ikke kontaktet','Uaktuell') COLLATE utf8_unicode_ci DEFAULT 'Ikke kontaktet',
  `phoneNumber` int(11) DEFAULT NULL,
  `subgroupOfID` int(11) DEFAULT NULL,
  `imageID` int(11) DEFAULT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`companyID`),
  KEY `contactorID` (`contactorID`,`addedByID`,`updatedByID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=219 ;

CREATE TABLE IF NOT EXISTS `bk_company_specialization` (
  `companyId` int(11) NOT NULL,
  `specializationId` int(11) NOT NULL,
  PRIMARY KEY (`companyId`,`specializationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `bk_company_update` (
  `updateId` int(11) NOT NULL AUTO_INCREMENT,
  `relevantForUserId` int(11) DEFAULT NULL,
  `companyId` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `addedById` int(11) DEFAULT NULL,
  `dateAdded` datetime DEFAULT NULL,
  `isDeleted` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`updateId`),
  KEY `relevantForUserId` (`relevantForUserId`,`companyId`,`addedById`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14610 ;

CREATE TABLE IF NOT EXISTS `bk_iktringen_information` (
  `companyID` int(11) NOT NULL,
  `relevance` enum('Høy','Middels','Lav') COLLATE utf8_unicode_ci DEFAULT 'Middels',
  `dateContacted` datetime DEFAULT NULL,
  PRIMARY KEY (`companyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `book_sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `price` int(6) NOT NULL,
  `status` int(1) NOT NULL,
  `author` int(11) NOT NULL,
  `imageID` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `parentType` enum('profile','gallery','image','group','company','news','bedpres') COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `authorId` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `isDeleted` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`,`authorId`),
  KEY `author` (`authorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=454 ;

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `location` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=151 ;

CREATE TABLE IF NOT EXISTS `event_company` (
  `eventID` int(11) NOT NULL,
  `companyID` int(11) DEFAULT NULL,
  `bpcID` int(11) NOT NULL,
  PRIMARY KEY (`eventID`),
  UNIQUE KEY `bpcID` (`bpcID`),
  KEY `companyID` (`companyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `event_company_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `fb_user` (
  `userId` int(11) NOT NULL,
  `fb_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postEvents` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `fieldtrip_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bpcId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bpcId` (`bpcId`,`userId`),
  KEY `user` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `forum` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `listorder` smallint(5) unsigned NOT NULL,
  `is_locked` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_forum_forum` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `forum_post` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(10) unsigned NOT NULL,
  `thread_id` int(10) unsigned NOT NULL,
  `editor_id` int(10) unsigned DEFAULT NULL,
  `content` text NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `updated` int(10) unsigned NOT NULL,
  `isDeleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_post_author` (`author_id`),
  KEY `FK_post_editor` (`editor_id`),
  KEY `FK_post_thread` (`thread_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `forum_thread` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` int(10) unsigned NOT NULL,
  `subject` varchar(120) NOT NULL,
  `is_sticky` tinyint(1) unsigned NOT NULL,
  `is_locked` tinyint(1) unsigned NOT NULL,
  `view_count` bigint(20) unsigned NOT NULL,
  `created` int(10) unsigned NOT NULL,
  `isDeleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_thread_forum` (`forum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `forum_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `siteid` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `signature` text,
  `firstseen` int(10) unsigned NOT NULL,
  `lastseen` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `siteid` (`siteid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `griff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `commentId` (`commentId`,`userId`,`isDeleted`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=87 ;

CREATE TABLE IF NOT EXISTS `griffgame_highscore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `score` double(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `group_membership` (
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comission` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` date NOT NULL DEFAULT '0000-00-00',
  `end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`userId`,`groupId`,`end`,`start`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(11) DEFAULT NULL,
  `committee` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'URLen til gruppen',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `members` (`admin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=84 ;

CREATE TABLE IF NOT EXISTS `iktringen_membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `invoiceContact` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organizationNumber` char(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoiceAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `membershipFee` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `organizationNumber` (`organizationNumber`),
  KEY `company` (`companyId`,`start`,`end`),
  KEY `fk_iktringen_membership_bk_company1_idx` (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oldName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `galleryId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `albumId` (`galleryId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

CREATE TABLE IF NOT EXISTS `job_announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `deadline` date NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `kilt_comment` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `time_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `kilt_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `kilt_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `image_id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=104 ;

CREATE TABLE IF NOT EXISTS `kilt_product_size` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `kilt_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `kilt_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `knights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `graduationYear` int(11) NOT NULL,
  `grantYear` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `parentType` enum('event','article','group', 'album') COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageId` int(11) DEFAULT NULL,
  `ingress` text COLLATE utf8_unicode_ci,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `authorId` int(11) DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`,`authorId`),
  KEY `author` (`authorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=713 ;

CREATE TABLE IF NOT EXISTS `news_group` (
  `newsId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `isRead` tinyint(1) NOT NULL DEFAULT '0',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `changedByUserID` int(11) DEFAULT NULL,
  `commentID` int(11) DEFAULT NULL,
  `statusCode` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS `notification_listener` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `parentType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentID` int(11) NOT NULL,
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `parentID` (`parentID`,`userID`,`parentType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

CREATE TABLE IF NOT EXISTS `quiz_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `responsibleQuizTeamId` int(11) NOT NULL,
  `eventSummary` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `eventDate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `responsibleQuizTeamId` (`responsibleQuizTeamId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `quiz_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `foundedDate` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `foundedDate` (`foundedDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

CREATE TABLE IF NOT EXISTS `quiz_team_member` (
  `userId` int(11) NOT NULL,
  `quizTeamId` int(11) NOT NULL,
  PRIMARY KEY (`userId`),
  KEY `quizTeamId` (`quizTeamId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `quiz_team_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quizEventId` int(11) NOT NULL,
  `quizTeamId` int(11) NOT NULL,
  `score` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `quizEventId` (`quizEventId`,`quizTeamId`),
  KEY `score` (`score`),
  KEY `quizTeamId` (`quizTeamId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `rbac_assignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `rbac_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `rbac_itemchild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `signup` (
  `eventId` int(11) NOT NULL DEFAULT '0',
  `spots` int(11) NOT NULL,
  `open` datetime NOT NULL,
  `close` datetime NOT NULL,
  `signoff` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`eventId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `signup_membership` (
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `signedOff` enum('true','false') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`eventId`,`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `signup_membership_anonymous` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventId` int(11) NOT NULL DEFAULT '0',
  `firstName` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `signedOff` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `specialization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteId` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteId` (`siteId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tracker_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `work_time` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`,`date`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tracker_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `middleName` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `specializationId` int(11) DEFAULT NULL,
  `graduationYear` year(4) DEFAULT NULL,
  `member` enum('true','false') COLLATE utf8_unicode_ci NOT NULL,
  `gender` enum('unknown','male','female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unknown',
  `imageId` int(11) DEFAULT NULL,
  `phoneNumber` int(11) DEFAULT NULL,
  `linkedin` varchar(75) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastLogin` datetime DEFAULT NULL,
  `cardHash` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `workDescription` text COLLATE utf8_unicode_ci,
  `workCompanyID` int(11) DEFAULT NULL,
  `workPlace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `altEmail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=762 ;

CREATE TABLE IF NOT EXISTS `user_password` (
  `userId` int(11) NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `expired` tinyint(1) NOT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `gossip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gossipText` text COLLATE utf8_unicode_ci NOT NULL,
  `submitDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;


ALTER TABLE `fieldtrip_support`
  ADD CONSTRAINT `fieldtrip_support_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `forum`
  ADD CONSTRAINT `FK_forum_forum` FOREIGN KEY (`parent_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE;

ALTER TABLE `forum_post`
  ADD CONSTRAINT `FK_post_author` FOREIGN KEY (`author_id`) REFERENCES `forum_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_post_editor` FOREIGN KEY (`editor_id`) REFERENCES `forum_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_post_thread` FOREIGN KEY (`thread_id`) REFERENCES `forum_thread` (`id`) ON DELETE CASCADE;

ALTER TABLE `forum_thread`
  ADD CONSTRAINT `FK_thread_forum` FOREIGN KEY (`forum_id`) REFERENCES `forum` (`id`) ON DELETE CASCADE;

ALTER TABLE `griffgame_highscore`
  ADD CONSTRAINT `griffgame_highscore_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `iktringen_membership`
  ADD CONSTRAINT `fk_iktringen_membership_bk_company1` FOREIGN KEY (`companyId`) REFERENCES `bk_company` (`companyID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `job_announcement`
  ADD CONSTRAINT `job_announcement_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `bk_company` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `quiz_event`
  ADD CONSTRAINT `quiz_event_ibfk_1` FOREIGN KEY (`responsibleQuizTeamId`) REFERENCES `quiz_team` (`id`);

ALTER TABLE `quiz_team_member`
  ADD CONSTRAINT `quiz_team_member_ibfk_2` FOREIGN KEY (`quizTeamId`) REFERENCES `quiz_team` (`id`),
  ADD CONSTRAINT `quiz_team_member_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `quiz_team_score`
  ADD CONSTRAINT `quiz_team_score_ibfk_1` FOREIGN KEY (`quizEventId`) REFERENCES `quiz_event` (`id`),
  ADD CONSTRAINT `quiz_team_score_ibfk_2` FOREIGN KEY (`quizTeamId`) REFERENCES `quiz_team` (`id`);

ALTER TABLE `rbac_assignment`
  ADD CONSTRAINT `rbac_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `rbac_itemchild`
  ADD CONSTRAINT `rbac_itemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_itemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `tracker_log`
  ADD CONSTRAINT `tracker_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tracker_user` (`user_id`);

ALTER TABLE `tracker_user`
  ADD CONSTRAINT `tracker_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
