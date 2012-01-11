-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 10, 2012 at 06:02 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6-1+lenny13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `hybrida`
--
-- CREATE DATABASE `hybrida` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hybrida`;

-- --------------------------------------------------------

--
-- Table structure for table `access_definition`
--

CREATE TABLE IF NOT EXISTS `access_definition` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(20) collate utf8_unicode_ci NOT NULL default 'none',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `description` (`description`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4006 ;

--
-- Dumping data for table `access_definition`
--

INSERT INTO `access_definition` (`id`, `description`) VALUES
(2004, 'avgangskull_2004'),
(2003, 'avgangskull_2003'),
(2002, 'avgangskull_'),
(2001, 'avgangskull_2001'),
(1002, 'female'),
(1001, 'male'),
(2, 'registrert'),
(2005, 'avgangskull_2005'),
(2006, 'avgangskull_2006'),
(2007, 'avgangskull_2007'),
(2014, 'avgangskull_2014'),
(2013, 'avgangskull_2013'),
(2012, 'avgangskull_2012'),
(2011, 'avgangskull_2011'),
(2010, 'avgangskull_2010'),
(2009, 'avgangskull_2009'),
(2008, 'avgangskull_2008'),
(2015, 'avgangskull_2015'),
(2016, 'avgangskull_2016'),
(2017, 'avgangskull_2017'),
(2018, 'avgangskull_2018'),
(2019, 'avgangskull_2019'),
(2020, 'avgangskull_2020'),
(3001, 'geomatikk'),
(3002, 'marin_teknikk'),
(3003, 'produkt_og_prosess'),
(3004, 'kontruksjonsteknikk'),
(3005, 'petroleumsfag'),
(4001, 'webkom'),
(4002, 'bedkom'),
(4003, 'arrkom'),
(4004, 'styret'),
(4005, 'avisa');

-- --------------------------------------------------------

--
-- Table structure for table `access_relations`
--

CREATE TABLE IF NOT EXISTS `access_relations` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `type` enum('album','article','comment','event','group','image','news','poll','signup','site','slide','slideshow','user_info','vote') collate utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`,`type`,`access`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_relations`
--


-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `imageId` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `owner`, `title`, `imageId`, `timestamp`) VALUES
(22, 1, 'HELLO', NULL, '2011-04-03 23:24:42'),
(21, 1, 'hello', NULL, '2011-04-03 23:23:11'),
(20, 1, 'n', NULL, '2011-04-03 22:12:46'),
(19, 1, 'lol', NULL, '2011-04-03 21:37:07'),
(18, 1, 'lol', NULL, '2011-04-03 20:56:39'),
(23, 1, 'bjÃ¸rnar er bÃ¸g', NULL, '2011-04-03 23:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci default NULL,
  `content` mediumtext collate utf8_unicode_ci,
  `author` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author`, `timestamp`) VALUES
(1, 'Hybrida', '\r\n	Foreningens formål er å fremme samhold og kameratskap innad på studieprogrammet ved bla.a. å avholde arrangementer av både sosial og faglig karakter. Mer informasjon om oss finner du under menyen til venstre.<br/><br/>\r\n\r\n<img src="http://www.hybrida.ntnu.no/filer/logo.png" alt="Hybrida"/>\r\n\r\n<p>\r\nLast ned logoen som <a href="http://www.hybrida.ntnu.no/filer/logo.psd">.psd</a> eller <a href="http://www.hybrida.ntnu.no/filer/logo.ai">.ai</a>\r\n</p>\r\n', 0, '0000-00-00'),
(2, 'Bedrift', '<h1>Bedriftskontakt</h1>\r\n<b>Hybridas Bedriftskomite (Hybrida BedKom) har ansvaret for kontakten med bedriftene for sivilingeniørstudiet Ingeniørvitenskap og IKT (I & IKT) ved NTNU. Vi ble etablert for å gi bedrifter informasjon om vårt studieprogram og hvilken kompetanse vi kan bidra med.</b>\r\n<p>Hovedmålet vårt er at vi vil hjelpe studentene på linja med prosjektoppgaver, hovedoppgaver, sommerjobber og fast ansettelse. I tillegg kan bedriftsbesøk, ekskursjoner og temakvelder gi bedrifter og studenter mulighet til å snakke sammen.</p>\r\n<p>Arrangementer av denne typen krever samarbeid fra bedrifter. Hvis du kan bidra, kontakt oss gjerne via linken i menyen venstre. For en komplett liste med Hybrida Bedkoms oppgaver og gjøremål, se våre statutter i samme meny.</p>\r\n<h2>Bedriftsbesøk:</h2>\r\n<p>Et bedriftsbesøk går i hovedsak ut på at bedriften besøker NTNU for å presentere seg for studentene. Et typisk bedriftsbesøk innebærer først og fremst en presentasjon der bedriften holder foredrag for utvalgte studenter. I tillegg er det vanlig med påfølgende bespisning, og mange bedrifter velger å ha jobbsamtaler/intervjuer tilknyttet besøket.</p>\r\n<p>Hensikten er vanligvis først og fremst rekruttering, men et bedriftsbesøk gir også god markedsføring mot kommende sivilingeniører. Hybrida BedKom tar seg av all praktisk organisering  dere trenger kun å møte opp forberedt med presentasjon!</p>\r\n<h2>Presentasjon:</h2>\r\n<p>Presentasjonen varer vanligvis i én skoletime (45 minutter) og avholdes oftest i auditorium. Her er de fleste audiovisuelle hjelpemidler tilgjengelig (PC/projektor, mikrofoner, overhead osv), og dersom dere har spesielle ønsker vil vi selvsagt forsøke å etterkomme disse. De fleste presentasjoner begynner 17:15 eller 18:15, da dette passer godt med timeplanen til studentene.</p>\r\n<h2>Bespisning:</h2>\r\n<p>De aller fleste bedrifter velger å spandere mat og drikke etter presentasjonen. Her har vi flere samarbeidspartnere og kan blant annet tilby rimelige alternativer fra SiT (Studentsamskipnaden i Trondheim), som holder til på Gløshaugen. Noen bedrifter ønsker fri bar, andre vil ha et fast antall enheter i form av drikkebonger. Bespisningen gir bedriften en fin mulighet til å snakke direkte med studentene i uformelle omgivelser. Det er ofte i den forbindelse interesserte melder seg på til jobbsamtaler.</p>\r\n<h2>Tips:</h2>\r\n<p>Dette er tips basert på tilbakemeldinger vi har fått fra studenter over flere år:\r\n<ul>\r\n	<li>Husk at dere snakker for I & IKT-studenter. Ikke vær redd for å bruke fagbegreper de burde kjenne til.</li>\r\n	<li>Forsøk å skille dere ut fra andre bedrifter  hva er det som gjør nettopp dere til den mest attraktive arbeidsgiveren?</li>\r\n	<li>Fokuser på hvordan det er å arbeide i deres bedrift  sosialt, arbeidsoppgaver, arbeidsmiljø, utfordringer Vis gjerne bilder fra arbeidsplassen.</li>\r\n	<li>Organisasjonsinndeling, økonomi og administrasjon er ofte mindre interessant når det kommer til å velge jobb. Forsøk å legg mindre vekt på dette enn de overnevnte punkter.</li>\r\n	<li>Begrens presentasjonen til 45 minutter.</li>\r\n	<li>Ta med en nyutdannet sivilingeniør fra NTNU, samt en fra HR.</li>\r\n	<li>Still med flere personer, slik at dere er lette å komme i kontakt med under bespisningen.</li>\r\n</ul>\r\n<h2>Priser:</h2>\r\n<p>Hybrida BedKom tar et honorar på kroner 10 000,- for en full bedriftspresentasjon som holdes for alle klassetrinn ved studiet. Dette inkluderer PR-kostnader og liknende. Mat og drikke kommer i tillegg. Priser fra ulike leverandører fåes ved forespørsel. Hvis bedriften ønsker en presentasjon for mindre grupper innenfor I & IKT (typisk en av spesialiseringene), kan dette selvsagt ordnes etter avtale. Slike arrangement tar vi selvsagt et lavere honorar for.</p>	', 331, '2011-11-01');

-- --------------------------------------------------------

--
-- Table structure for table `bk_company`
--

CREATE TABLE IF NOT EXISTS `bk_company` (
  `companyID` int(11) NOT NULL auto_increment,
  `adress` varchar(255) collate utf8_unicode_ci default NULL,
  `contactorID` int(11) default NULL,
  `companyName` varchar(255) collate utf8_unicode_ci default NULL,
  `dateAdded` datetime default NULL,
  `dateUpdated` datetime default NULL,
  `dateAssigned` datetime default NULL,
  `homepage` varchar(255) collate utf8_unicode_ci default NULL,
  `addedByID` int(11) default NULL,
  `mail` varchar(255) collate utf8_unicode_ci default NULL,
  `updatedByID` int(11) default NULL,
  `postbox` varchar(255) collate utf8_unicode_ci default NULL,
  `postnumber` int(11) default NULL,
  `postplace` varchar(255) collate utf8_unicode_ci default NULL,
  `status` enum('Aktuell senere','Blir kontaktet','Ikke kontaktet','Uaktuell') collate utf8_unicode_ci default 'Ikke kontaktet',
  `phoneNumber` int(11) default NULL,
  `subgroupOfID` int(11) default NULL,
  PRIMARY KEY  (`companyID`),
  KEY `contactorID` (`contactorID`,`addedByID`,`updatedByID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `bk_company`
--

-- --------------------------------------------------------

--
-- Table structure for table `bk_company_specialization`
--

CREATE TABLE IF NOT EXISTS `bk_company_specialization` (
  `companyId` int(11) NOT NULL,
  `specializationId` int(11) NOT NULL,
  PRIMARY KEY  (`companyId`,`specializationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bk_company_specialization`
--


-- --------------------------------------------------------

--
-- Table structure for table `bk_company_update`
--

CREATE TABLE IF NOT EXISTS `bk_company_update` (
  `updateId` int(11) NOT NULL auto_increment,
  `relevantForUserId` int(11) default NULL,
  `companyId` int(11) default NULL,
  `description` text collate utf8_unicode_ci,
  `addedById` int(11) default NULL,
  `dateAdded` datetime default NULL,
  PRIMARY KEY  (`updateId`),
  KEY `relevantForUserId` (`relevantForUserId`,`companyId`,`addedById`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bk_company_update`
--


-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL auto_increment,
  `parentId` int(11) default NULL,
  `parentType` enum('profile','comment','album','image','article','event','group','company') collate utf8_unicode_ci default NULL,
  `content` mediumtext collate utf8_unicode_ci,
  `author` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `parentId` (`parentId`,`author`),
  KEY `author` (`author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `comment`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL auto_increment,
  `start` datetime default NULL,
  `end` datetime default NULL,
  `location` varchar(30) collate utf8_unicode_ci default NULL,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `imageId` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=82 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `start`, `end`, `location`, `title`, `imageId`) VALUES
(71, '2012-02-17 22:34:00', '2012-02-17 22:34:00', 'Åre', 'Åretur 2012', 0),
(73, '2011-11-25 18:15:00', '2011-11-26 13:00:00', 'Gløs', 'GenFors', 4);

-- --------------------------------------------------------

--
-- Table structure for table `fb_user`
--

CREATE TABLE IF NOT EXISTS `fb_user` (
  `userId` int(11) NOT NULL,
  `fb_token` varchar(100) collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL auto_increment,
  `menu` int(11) NOT NULL,
  `title` varchar(50) collate utf8_unicode_ci NOT NULL,
  `admin` int(11) default NULL,
  `committee` enum('true','false') collate utf8_unicode_ci NOT NULL default 'false',
  PRIMARY KEY  (`id`),
  KEY `members` (`admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `menu`, `title`, `admin`, `committee`) VALUES
(58, 0, 'UpdateK', 381, 'false'),
(55, 0, 'Webkom', 326, 'true'),
(56, 0, 'Styret', 363, 'false'),
(57, 0, 'Hybrida Bedriftskomité', 293, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci default NULL,
  `oldName` varchar(40) collate utf8_unicode_ci NOT NULL,
  `albumId` int(11) default NULL,
  `userId` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `albumId` (`albumId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `title`, `oldName`, `albumId`, `userId`, `timestamp`) VALUES
(1, '', 'gtfo.jpg', -1, 1, '2011-02-26 18:34:29'),
(2, '', 'Untitled.jpg', -1, 1, '2011-02-26 21:07:15'),
(4, 'Koala!', 'Koala.jpg', -1, 327, '2011-03-21 18:39:21'),
(5, 'Sommer', 'sommer', -1, 327, '2011-07-21 21:04:59');

-- --------------------------------------------------------

--
-- Table structure for table `membership_access`
--

CREATE TABLE IF NOT EXISTS `membership_access` (
  `accessId` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL default '0',
  PRIMARY KEY  (`accessId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `membership_access`
--


-- --------------------------------------------------------

--
-- Table structure for table `membership_group`
--

CREATE TABLE IF NOT EXISTS `membership_group` (
  `id` int(11) NOT NULL,
  `groupId` int(11) NOT NULL auto_increment,
  `userId` int(11) default NULL,
  `comission` varchar(30) collate utf8_unicode_ci NOT NULL,
  `start` date default NULL,
  `end` date NOT NULL,
  KEY `userId` (`userId`,`groupId`),
  KEY `groupId` (`groupId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `membership_group`
--

INSERT INTO `membership_group` (`id`, `groupId`, `userId`, `comission`, `start`, `end`) VALUES
(0, 57, 348, 'Nestsjef', '2010-11-15', '0000-00-00'),
(0, 57, 354, 'Bedriftskontakt', '2010-11-15', '0000-00-00'),
(0, 57, 357, 'Bedriftskontakt', '2010-11-15', '0000-00-00'),
(0, 57, 293, 'Bedriftskomitésjef', '2010-11-15', '0000-00-00'),
(0, 56, 361, 'Jentekomitésjef', '2010-11-15', '0000-00-00'),
(0, 56, 293, 'Bedriftskomitésjef', '2010-11-15', '0000-00-00'),
(0, 56, 383, 'Skattmester', '2010-11-15', '0000-00-00'),
(0, 56, 367, 'Festivalus', '2010-11-15', '0000-00-00'),
(0, 56, 326, 'Vevsjef', '2010-11-15', '2011-11-25'),
(0, 55, 326, 'Sjef', '2010-11-15', '0000-00-00'),
(0, 55, 353, 'Medlem', '2010-11-15', '0000-00-00'),
(0, 55, 358, 'Medlem', '2010-11-15', '0000-00-00'),
(0, 55, 331, 'Medlem', '2010-11-15', '0000-00-00'),
(0, 55, 380, 'Medlem', '2010-11-15', '0000-00-00'),
(0, 55, 381, 'Medlem', '2010-11-15', '0000-00-00'),
(0, 57, 343, 'Fikser', '2010-11-15', '0000-00-00'),
(0, 56, 363, 'Leder', '2010-11-15', '0000-00-00'),
(0, 56, 321, 'Nestleder', '2010-11-15', '0000-00-00'),
(0, 57, 339, 'Bedriftskontakt', '2010-11-15', '0000-00-00'),
(0, 57, 356, 'Bedriftskontakt', '2010-11-15', '0000-00-00'),
(0, 57, 386, 'Økonomiansvarlig', '2010-11-15', '0000-00-00'),
(0, 57, 370, 'Medlem', '2010-11-15', '0000-00-00'),
(0, 57, 353, 'Bedriftskontakt', '2010-11-15', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `membership_signup`
--

CREATE TABLE IF NOT EXISTS `membership_signup` (
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `signedOff` enum('true','false') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`eventId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `membership_signup`
--

INSERT INTO `membership_signup` (`eventId`, `userId`, `signedOff`) VALUES
(2, 326, 'false'),
(4, 326, 'false'),
(2, 1, 'false'),
(4, 1, 'false'),
(4, 0, 'false'),
(5, 1, 'false'),
(5, 326, 'false'),
(5, 354, 'false'),
(8, 326, 'true'),
(9, 326, 'true'),
(8, 1, 'false'),
(9, 1, 'false'),
(11, 326, 'true'),
(15, 15, 'false'),
(25, 15, 'false'),
(25, 326, 'false'),
(25, 1, 'false'),
(26, 326, 'false'),
(27, 326, 'false'),
(14, 406, 'false'),
(18, 406, 'false'),
(10, 406, 'false'),
(71, 326, 'false'),
(73, 326, 'false'),
(72, 326, 'false'),
(7, 326, 'false'),
(1, 326, 'false'),
(0, 381, 'true'),
(73, 381, 'false'),
(71, 381, 'false'),
(73, 282, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE IF NOT EXISTS `menu_group` (
  `group` int(11) NOT NULL,
  `site` int(11) NOT NULL,
  `contentId` int(11) default NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY  (`group`,`site`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`group`, `site`, `contentId`, `sort`) VALUES
(55, 447, NULL, 0),
(55, 448, NULL, 1),
(55, 449, 47, 2),
(55, 450, NULL, 3),
(56, 451, NULL, 0),
(56, 452, NULL, 1),
(56, 453, 48, 2),
(56, 454, NULL, 3),
(57, 455, NULL, 0),
(57, 456, NULL, 1),
(57, 457, 49, 2),
(57, 458, NULL, 3),
(58, 459, NULL, 0),
(58, 460, NULL, 1),
(58, 461, 50, 2),
(58, 462, NULL, 3),
(1, 2, 3, 4),
(57, 463, NULL, 5),
(56, 464, NULL, 5),
(57, 465, NULL, 6),
(57, 466, NULL, 7),
(57, 467, NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `menu_top`
--

CREATE TABLE IF NOT EXISTS `menu_top` (
  `menu` int(11) NOT NULL auto_increment,
  `site` int(11) NOT NULL,
  `id` int(11) default NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY  (`menu`,`site`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `menu_top`
--

INSERT INTO `menu_top` (`menu`, `site`, `id`, `sort`) VALUES
(1, 1, NULL, 1),
(2, 2, NULL, 2),
(3, 3, NULL, 3),
(4, 4, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `menu_top_sub`
--

CREATE TABLE IF NOT EXISTS `menu_top_sub` (
  `menuId` int(11) NOT NULL,
  `site` int(11) NOT NULL,
  `id` int(11) default NULL,
  `sort` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_top_sub`
--

INSERT INTO `menu_top_sub` (`menuId`, `site`, `id`, `sort`) VALUES
(2, 2, NULL, 1),
(1, 1, NULL, 1),
(3, 3, NULL, 1),
(4, 194, NULL, 1),
(5, 4, NULL, 1),
(6, 194, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `parentId` int(11) default NULL,
  `parentType` enum('event','article','group') collate utf8_unicode_ci default NULL,
  `title` varchar(50) collate utf8_unicode_ci default NULL,
  `imageId` int(11) default NULL,
  `content` mediumtext collate utf8_unicode_ci,
  `author` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `parentId` (`parentId`,`author`),
  KEY `author` (`author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=210 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `parentId`, `parentType`, `title`, `imageId`, `content`, `author`, `timestamp`) VALUES
(24, 1, '', 'Nyhet for webkomgruppen!', 4, '<p>Dette er en nyhet postet i webkomgruppen!!</p><p><br /></p><p>TADA!</p>', 326, '2011-04-12 00:06:33'),
(40, 71, 'event', 'Åretur 2012', 0, '	Hybrider! Da har det duket for årets høydepunkt, vinterens villeste eventyr: <b> Åretur!!! </b>\r\n\r\n<br>\r\n\r\n<br>\r\n\r\nSom de siste tre årene vil turen være i uke 5, eller for alle oss andre som hater ukesystemet: <b>29. jan - 2. feb 2012. </b> I år har vi fått boplass i Åre fjellby, rett ved trekket og utesteder, altså helt ypperlig!\r\n\r\n<br>\r\n\r\n<br>\r\n\r\nTuren kommer på <b> ca 2000kr </b> per pers og inkluderer:\r\n\r\n<br>\r\n\r\n<br>\r\n\r\n-Tur/retur Åre sentrum\r\n\r\n<br>\r\n\r\n-4 netters opphold\r\n\r\n<br>\r\n\r\n-5 dagers skipass \r\n\r\n<br>\r\n\r\n-rabattkort\r\n\r\n<br>\r\n\r\n+ mye fest og moro!\r\n\r\n<br>\r\n\r\n<br>\r\n\r\nVi har <b>47 plasser </b>, så her er det førstemann til mølla som gjelder! \r\n\r\n<br>\r\n\r\n<br>\r\n\r\nOBS! OBS! Videre info vil de påmeldte få via mail. Som tiden for avgang, når vi er tilbake, hytteoversikt, hyttefordeling, betalingsinfo med nøyaktig pris osv. Og for de som ikke vet det, her snakker vi helt bindende påmelding\r\n\r\n<br>\r\n\r\n<br>\r\n', 326, '2011-07-17 22:34:51'),
(41, 73, 'event', 'GenFors', 4, 'Generalforsamling i Hybrida', 326, '2011-11-10 21:14:21'),
(56, NULL, NULL, 'Nytt styre', NULL, '<p>Vil gratulere de nye styremedlemmene med valget!</p><p>Sigbjørn Aukland - Festivalus</p><p>Tonje Sundstrøm - Skattemester</p><p>Sigurd Holsen - Vevsjef</p><p>Erik Aasmundrud - SPR</p>', 363, '2011-11-26 20:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `news_group`
--

CREATE TABLE IF NOT EXISTS `news_group` (
  `newsId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news_group`
--

INSERT INTO `news_group` (`newsId`, `groupId`) VALUES
(3, 56),
(38, 55);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) default NULL,
  `order` mediumtext character set utf8 collate utf8_unicode_ci,
  `timestamp` datetime default NULL,
  `paid` enum('true','false') character set utf8 collate utf8_unicode_ci NOT NULL default 'false',
  PRIMARY KEY  (`id`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `order`
--


-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `title`) VALUES
(1, 'Lommelerke');

-- --------------------------------------------------------

--
-- Table structure for table `poll_option`
--

CREATE TABLE IF NOT EXISTS `poll_option` (
  `id` int(11) NOT NULL auto_increment,
  `pollId` int(11) default NULL,
  `name` varchar(30) collate utf8_unicode_ci default NULL,
  `color` char(6) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pollId` (`pollId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `poll_option`
--

INSERT INTO `poll_option` (`id`, `pollId`, `name`, `color`) VALUES
(1, 1, 'Ja takk!', 'FF0000'),
(2, 1, 'mesa be gay', '4A7F6B');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `eventId` int(11) NOT NULL default '0',
  `spots` int(11) NOT NULL,
  `open` datetime NOT NULL,
  `close` datetime NOT NULL,
  `signoff` enum('true','false') collate utf8_unicode_ci NOT NULL default 'false',
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`eventId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`eventId`, `spots`, `open`, `close`, `signoff`, `active`) VALUES
(71, 40, '2011-07-17 22:34:00', '2012-07-17 22:34:00', '', 1),
(73, 200, '2011-11-20 00:00:00', '2011-11-24 17:00:00', 'false', 0);

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `siteId` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `path` varchar(60) collate utf8_unicode_ci NOT NULL,
  `id` int(11) default NULL,
  `subId` int(11) default NULL,
  PRIMARY KEY  (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=469 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`siteId`, `title`, `path`, `id`, `subId`) VALUES
(1, 'Hjem', 'newsfeed', NULL, NULL),
(2, 'Profil', 'profile', NULL, NULL),
(4, 'Om Oss', 'article', 3, NULL),
(6, 'Personer', 'article', NULL, NULL),
(3, 'Grupper', 'group', NULL, NULL),
(462, 'Medlemmer', 'group', NULL, 4),
(461, 'Info', 'group', NULL, 3),
(460, 'Nyheter', 'group', NULL, 2),
(459, 'Kommentarer', 'group', NULL, 1),
(458, 'Medlemmer', 'group', NULL, 4),
(457, 'Info', 'group', NULL, 3),
(456, 'Nyheter', 'group', NULL, 2),
(455, 'Kommentarer', 'group', NULL, 1),
(454, 'Medlemmer', 'group', NULL, 4),
(453, 'Info', 'group', NULL, 3),
(452, 'Nyheter', 'group', NULL, 2),
(451, 'Kommentarer', 'group', NULL, 1),
(450, 'Medlemmer', 'group', NULL, 4),
(449, 'Info', 'group', NULL, 3),
(448, 'Nyheter', 'group', NULL, 2),
(447, 'Kommentarer', 'group', NULL, 1),
(463, 'Kalender', 'group', NULL, 5),
(464, 'Kalender', 'group', NULL, 5),
(465, 'Bedrifter', 'group', NULL, 6),
(466, 'Alumni', 'group', NULL, 7),
(467, 'Oppdateringer', 'group', NULL, 8),
(468, 'Bedrift', 'group', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_content`
--

CREATE TABLE IF NOT EXISTS `site_content` (
  `id` int(11) NOT NULL auto_increment,
  `filename` varchar(20) collate utf8_unicode_ci NOT NULL,
  `description` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `site_content`
--

INSERT INTO `site_content` (`id`, `filename`, `description`) VALUES
(1, 'comments', 'Side med kommentarer'),
(2, 'news', 'Side med nyheter'),
(3, 'article', 'Artikkelside'),
(4, 'members', 'Side med medlemmer'),
(5, 'calendar', 'Kalenderside'),
(6, 'companies', 'Side med bedrifter'),
(7, 'graduates', 'Alumniside'),
(8, 'updates', 'Side med oppdateringer');

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE IF NOT EXISTS `slide` (
  `id` int(11) NOT NULL auto_increment,
  `slideshowId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL,
  `message` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `slideshowId`, `imageId`, `message`) VALUES
(1, 1, 1, 'Slide 1'),
(2, 1, 1, 'Postmann Pat, Postmann Pat,  med sin svarte og hvite katt Alltid tidlig ute  på sin postmanns rute  har han all posten med seg i sin bil'),
(3, 1, 1, 'BLABLALBA');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`) VALUES
(1, 'index slide');

-- --------------------------------------------------------

--
-- Table structure for table `spesialization`
--

CREATE TABLE IF NOT EXISTS `spesialization` (
  `id` int(11) NOT NULL auto_increment,
  `siteId` int(11) default NULL,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `siteId` (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `spesialization`
--

INSERT INTO `spesialization` (`id`, `siteId`, `name`) VALUES
(1, 10, 'Geomatikk'),
(2, 11, 'Marin Teknikk'),
(3, 12, 'Produkt og Prosess'),
(4, 13, 'Konstruksjonsteknikk'),
(5, 14, 'Petroleumsfag'),
(6, NULL, 'Produksjon og Ledelse'),
(7, NULL, 'Integrerte Operasjoner'),
(8, NULL, 'Produktutvikling og Materialer'),
(9, NULL, 'Varme- og Strømningsteknikk');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `contentType` enum('news','article') collate utf8_unicode_ci NOT NULL,
  `tagType` enum('wiki','group') collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `ownerId`, `contentType`, `tagType`) VALUES
(48, 0, 'article', ''),
(49, 0, 'article', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(10) collate utf8_unicode_ci NOT NULL,
  `password` varchar(32) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=407 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(381, 'sigurhol', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(75) collate utf8_unicode_ci default NULL,
  `middleName` varchar(75) collate utf8_unicode_ci default NULL,
  `lastName` varchar(75) collate utf8_unicode_ci default NULL,
  `specialization` int(11) default NULL,
  `graduationYear` year(4) default NULL,
  `member` enum('true','false') collate utf8_unicode_ci NOT NULL default 'false',
  `gender` enum('unknown','male','female') collate utf8_unicode_ci NOT NULL default 'unknown',
  `imageId` int(11) default NULL,
  `phoneNumber` int(11) default NULL,
  `lastLogin` datetime default NULL,
  `cardinfo` varchar(10) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `birthdate` date default NULL,
  `altEmail` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`userId`),
  KEY `spesialization` (`specialization`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`userId`, `firstName`, `middleName`, `lastName`, `specialization`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `lastLogin`, `cardinfo`, `description`, `birthdate`, `altEmail`) VALUES
(381, 'Sigurd', 'Andreas', 'Holsen', 0, 2015, 'false', 'unknown', -1, NULL, '2011-05-09 18:36:35', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_new`
--

CREATE TABLE IF NOT EXISTS `user_new` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(10) collate utf8_unicode_ci NOT NULL,
  `firstName` varchar(75) collate utf8_unicode_ci NOT NULL,
  `middleName` varchar(75) collate utf8_unicode_ci default NULL,
  `lastName` varchar(75) collate utf8_unicode_ci NOT NULL,
  `specialization` int(11) default NULL,
  `graduationYear` year(4) default NULL,
  `member` enum('true','false') collate utf8_unicode_ci NOT NULL,
  `gender` enum('unknown','male','female') collate utf8_unicode_ci NOT NULL default 'unknown',
  `imageId` int(11) default NULL,
  `phoneNumber` int(11) default NULL,
  `lastLogin` datetime default NULL,
  `cardinfo` varchar(10) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `workDescription` text collate utf8_unicode_ci NOT NULL,
  `workCompanyID` int(11) default NULL,
  `workPlace` varchar(255) collate utf8_unicode_ci default NULL,
  `birthdate` date default NULL,
  `altEmail` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=466 ;

--
-- Dumping data for table `user_new`
--

INSERT INTO `user_new` (`id`, `username`, `firstName`, `middleName`, `lastName`, `specialization`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `lastLogin`, `cardinfo`, `description`, `workDescription`, `workCompanyID`, `workPlace`, `birthdate`, `altEmail`) VALUES
(381, 'sigurhol', 'Sigurd', 'Andreas', 'Holsen ', 0, 2015, 'true', 'unknown', NULL, NULL, NULL, 'NTNU457028', '', '', NULL, NULL, '1990-12-23', 'sighol@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `pollId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `choice` int(11) NOT NULL,
  PRIMARY KEY  (`pollId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`pollId`, `userId`, `choice`) VALUES
(1, 1, 1),
(1, 327, 2),
(380, 1, 2),
(15, 1, 1);

