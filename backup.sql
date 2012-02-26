-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2012 at 11:46 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6-1+lenny16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hybrida`
--
CREATE DATABASE `hybrida` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hybrida`;

-- --------------------------------------------------------

--
-- Table structure for table `access_relations`
--

CREATE TABLE IF NOT EXISTS `access_relations` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `type` enum('article','event','image','news','signup') collate utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL default '1',
  PRIMARY KEY  (`id`,`type`,`access`,`sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_relations`
--

INSERT INTO `access_relations` (`id`, `access`, `type`, `sub_id`) VALUES
(24, 4055, 'news', 0),
(40, 2, 'news', 0),
(41, 2, 'news', 0),
(364, 2014, 'news', 0),
(364, 4055, 'news', 1);

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
(2, 'Bedrift', '<h1>Bedriftskontakt</h1>\r\n<b>Hybridas Bedriftskomite (Hybrida BedKom) har ansvaret for kontakten med bedriftene for sivilingeniørstudiet Ingeniørvitenskap og IKT (I & IKT) ved NTNU. Vi ble etablert for å gi bedrifter informasjon om vårt studieprogram og hvilken kompetanse vi kan bidra med.</b>\r\n<p>Hovedmålet vårt er at vi vil hjelpe studentene på linja med prosjektoppgaver, hovedoppgaver, sommerjobber og fast ansettelse. I tillegg kan bedriftsbesøk, ekskursjoner og temakvelder gi bedrifter og studenter mulighet til å snakke sammen.</p>\r\n<p>Arrangementer av denne typen krever samarbeid fra bedrifter. Hvis du kan bidra, kontakt oss gjerne via linken i menyen venstre. For en komplett liste med Hybrida Bedkoms oppgaver og gjøremål, se våre statutter i samme meny.</p>\r\n<h2>Bedriftsbesøk:</h2>\r\n<p>Et bedriftsbesøk går i hovedsak ut på at bedriften besøker NTNU for å presentere seg for studentene. Et typisk bedriftsbesøk innebærer først og fremst en presentasjon der bedriften holder
foredrag for utvalgte studenter. I tillegg er det vanlig med påfølgende bespisning, og mange bedrifter velger å ha jobbsamtaler/intervjuer tilknyttet besøket.</p>\r\n<p>Hensikten er vanligvis først og fremst rekruttering, men et bedriftsbesøk gir også god markedsføring mot kommende sivilingeniører. Hybrida BedKom tar seg av all praktisk organisering  dere trenger kun å møte opp forberedt med presentasjon!</p>\r\n<h2>Presentasjon:</h2>\r\n<p>Presentasjonen varer vanligvis i én skoletime (45 minutter) og avholdes oftest i auditorium. Her er de fleste audiovisuelle hjelpemidler tilgjengelig (PC/projektor, mikrofoner, overhead osv), og dersom dere har spesielle ønsker vil vi selvsagt forsøke å etterkomme disse. De fleste presentasjoner begynner 17:15 eller 18:15, da dette passer godt med timeplanen til studentene.</p>\r\n<h2>Bespisning:</h2>\r\n<p>De aller fleste bedrifter velger å spandere mat og drikke etter presentasjonen. Her har vi flere samarbeidspartnere og kan blant annet tilby rimelige alternativer fra
SiT (Studentsamskipnaden i Trondheim), som holder til på Gløshaugen. Noen bedrifter ønsker fri bar, andre vil ha et fast antall enheter i form av drikkebonger. Bespisningen gir bedriften en fin mulighet til å snakke direkte med studentene i uformelle omgivelser. Det er ofte i den forbindelse interesserte melder seg på til jobbsamtaler.</p>\r\n<h2>Tips:</h2>\r\n<p>Dette er tips basert på tilbakemeldinger vi har fått fra studenter over flere år:\r\n<ul>\r\n	<li>Husk at dere snakker for I & IKT-studenter. Ikke vær redd for å bruke fagbegreper de burde kjenne til.</li>\r\n	<li>Forsøk å skille dere ut fra andre bedrifter  hva er det som gjør nettopp dere til den mest attraktive arbeidsgiveren?</li>\r\n	<li>Fokuser på hvordan det er å arbeide i deres bedrift  sosialt, arbeidsoppgaver, arbeidsmiljø, utfordringer Vis gjerne bilder fra arbeidsplassen.</li>\r\n	<li>Organisasjonsinndeling, økonomi og administrasjon er ofte mindre interessant når det kommer til å velge jobb. Forsøk å legg mindre vekt på dette enn de
overnevnte punkter.</li>\r\n	<li>Begrens presentasjonen til 45 minutter.</li>\r\n	<li>Ta med en nyutdannet sivilingeniør fra NTNU, samt en fra HR.</li>\r\n	<li>Still med flere personer, slik at dere er lette å komme i kontakt med under bespisningen.</li>\r\n</ul>\r\n<h2>Priser:</h2>\r\n<p>Hybrida BedKom tar et honorar på kroner 10 000,- for en full bedriftspresentasjon som holdes for alle klassetrinn ved studiet. Dette inkluderer PR-kostnader og liknende. Mat og drikke kommer i tillegg. Priser fra ulike leverandører fåes ved forespørsel. Hvis bedriften ønsker en presentasjon for mindre grupper innenfor I & IKT (typisk en av spesialiseringene), kan dette selvsagt ordnes etter avtale. Slike arrangement tar vi selvsagt et lavere honorar for.</p>	', 331, '2011-11-01');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=219 ;

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

INSERT INTO `bk_company_specialization` (`companyId`, `specializationId`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(17, 4),
(17, 5),
(61, 1),
(61, 3),
(61, 4),
(61, 7),
(61, 8),
(75, 9),
(79, 2),
(108, 3),
(108, 4);

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
  `isDeleted` enum('true','false') collate utf8_unicode_ci NOT NULL default 'false',
  PRIMARY KEY  (`updateId`),
  KEY `relevantForUserId` (`relevantForUserId`,`companyId`,`addedById`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14593 ;

--
-- Dumping data for table `bk_company_update`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL auto_increment,
  `bpcID` int(11) default NULL,
  `start` datetime default NULL,
  `end` datetime default NULL,
  `location` varchar(30) collate utf8_unicode_ci default NULL,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `imageId` int(11) default NULL,
  `status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `bpcID` (`bpcID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=89 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `bpcID`, `start`, `end`, `location`, `title`, `imageId`, `status`) VALUES
(71, NULL, '2012-01-29 07:00:00', '2012-02-02 20:00:00', 'Åre', 'Åretur 2012', 0, 0),
(73, NULL, '2011-11-25 18:15:00', '2011-11-26 13:00:00', 'Gløs', 'GenFors', 4, 0),
(82, NULL, '2012-03-08 00:00:00', '2012-06-07 00:00:00', 'Åre', '', NULL, 2),
(83, NULL, '2012-12-01 00:00:00', '2013-04-06 00:00:00', 'Kontoret', '', NULL, 0),
(85, NULL, '2012-02-25 20:00:54', '2012-02-26 02:00:00', 'Lyche', '', NULL, 0);

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
-- Table structure for table `group_membership`
--

CREATE TABLE IF NOT EXISTS `group_membership` (
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comission` varchar(30) collate utf8_unicode_ci default NULL,
  `start` date default NULL,
  `end` date default NULL,
  PRIMARY KEY  (`userId`,`groupId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_membership`
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
  `url` varchar(255) collate utf8_unicode_ci NOT NULL COMMENT 'URLen til gruppen',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `members` (`admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `menu`, `title`, `admin`, `committee`, `url`) VALUES
(58, 0, 'UpdateK', 381, 'false', 'updatek'),
(55, 0, 'Webkom', 326, 'true', 'webkom'),
(56, 0, 'Styret', 363, 'false', 'styret'),
(57, 0, 'Hybrida Bedriftskomité', 293, 'true', 'bk');

-- --------------------------------------------------------

--
-- Table structure for table `hyb_comment`
--

CREATE TABLE IF NOT EXISTS `hyb_comment` (
  `id` int(11) NOT NULL auto_increment,
  `parentId` int(11) default NULL,
  `parentType` enum('profile','gallery','image','group','company','news') collate utf8_unicode_ci default NULL,
  `content` mediumtext collate utf8_unicode_ci,
  `authorId` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `parentId` (`parentId`,`authorId`),
  KEY `author` (`authorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=423 ;

--
-- Dumping data for table `hyb_comment`
--

INSERT INTO `hyb_comment` (`id`, `parentId`, `parentType`, `content`, `authorId`, `timestamp`) VALUES
(390, 1, 'company', 'Fakturaadresse 2012:\r\n\r\nAker Engineering & Technology AS\r\nPO Box 2030\r\nN-5409 STORD\r\nNorway\r\nAtt. Jon Østmoen\r\n\r\nTag:\r\nBedriftspresentasjon, NTNU\r\n70 deltakere\r\nHonorar og servering', 293, '2012-02-08 23:33:18'),
(389, 397, 'profile', '<u><strong>YO</strong></u>', 397, '0000-00-00 00:00:00'),
(388, 397, 'profile', '<u><strong>YO</strong></u>', 397, '0000-00-00 00:00:00'),
(387, 120, 'company', 'Fikk svar om kaffe nå:\r\n\r\n"Hei.\r\nKaffe høres ut som en god ide, så det tar vi gjerne..."\r\n\r\nså vi kjører kaffe!\r\n\r\n\r\n', 354, '2012-02-07 13:23:53'),
(386, 204, 'company', 'Den er grei, eg gav Nikolai i oppgåve å henge opp flyeren på lesesalen.', 293, '2012-02-06 17:06:39'),
(385, 204, 'company', 'Fått en flyer fra Jomar, lagt den til i ei ny mappe i dropbox.', 339, '2012-02-06 12:51:08'),
(33, 82, 'company', 'Ikkje kontakta i det heile tatt fordi GK ansetter folk fra Emil.', 339, '2010-09-22 13:22:07'),
(34, 83, 'company', 'Copypaste fra det andre forumet...\r\n\r\n"Hei,\r\n\r\nVi i Selvaag Bluethink har bestemt oss for å ikke delta denne gangen. Det kan godt hende vi vil være interessert i å presentere oss ved en senere anledning.\r\n \r\nMvh\r\nKristoffer Kvello\r\nSelvaag Bluethink\r\n"\r\n(kkv@selvaag.no)', 279, '2010-09-13 22:37:53'),
(35, 83, 'company', 'BlueThink som avdelingen heter er forøvrig nedlagt grunnet stort driftsunderskudd, og det er bare tre av de gamle ansatte som henger igjen og hjelper til med andre prosjekter.\r\n\r\nDisse er nok ikke spesielt aktuelle for BedPres med dagens situasjon.', 353, '2010-09-23 22:40:14'),
(36, 51, 'company', 'Sist prøvd å kontakte september 2010 av Daniel, bedrifta var ikkje mulig å finne', 293, '2010-09-24 22:42:20'),
(37, 45, 'company', 'Bravida Geomatikk er kjøpt pp av Geomatikk AS og eksisterer derfor ikkje lengre. Geomatikk ville ha bedpres-ane med Geomatikk AS for seg sjølv. ', 339, '2010-09-24 22:44:26'),
(38, 49, 'company', 'Kontaktperson:\r\n\r\nErik Myrind\r\nKontaktinfo:\r\nerik.myrind@pgs.com\r\n--------------------------------\r\nIkke noe svar enda…', 44, '2010-09-23 22:46:08'),
(39, 49, 'company', 'Svar fra PGS:\r\n”Vi har diskutert dette internt, og siden vi skal opp til NTNU 11.november og ha en bedriftspresentasjon nede på PTS, så ville det beste for oss være å slå sammen presentasjonen vi allerede har booket med SPE den 11.november. Ville det vært et alternativ for dere?”\r\n\r\nDe vil slå sammen presentasjonene. Det er det vel ikke mulighet til, eneste er om vi kan ta penger for de av IKT som møter opp?:)', 44, '2010-09-27 22:47:15'),
(40, 49, 'company', 'Eg prata med nokre som går petroleum i dag, dei er allereie invitert til presentasjonen med PGS via SPE.\r\n\r\nDermed slepp vi å reklamere for denne presentasjonen for våre studenter.\r\n\r\nSamtidig kan vi då ikkje køyre noko parallelt opplegg med SPE, fordi alle våre skal på presentasjonen med SPE.\r\n\r\nDerfor tenkjer eg at det greiaste er at vi heller høyrer med PGS om dei er interesserte i å komme tilbake til våren og halde ein presentasjon for I&IKT. Då typisk ikkje berre for dei på petroleum men også for andre spesialiseringer på I&IKT som dei kan ha i målgruppa, kanskje Geomatikk for eksempel. Gjerne nevn for dei kva kvalifikasjoner studenter frå I&IKT har.\r\n\r\nFor dei som lurer:\r\n\r\nSPE = Society of Petroleum Engineers, ein slags BedKom for petroleum\r\n\r\nPTS = PetroleumsTekniSk, borte på Valgrinda ein plass', 293, '2010-09-27 22:48:17'),
(41, 49, 'company', 'De skulle gi beskjed hvis de ville holde en egen bedriftspresentasjon for I&IKT ved en senere anledning. Vi får sende en mail neste semester...', 44, '2010-09-30 22:49:10'),
(42, 28, 'company', 'Etter det jeg kunne finne ut drev PLM Tech. primært med videresalg av programvare og noe mindre utvikling av mindre endringer på bestilling fra kundene.\r\n\r\nPå nettsidene sine søker de også kun etter selgere.\r\n\r\nDerfor konkluderte jeg med at det ikke var aktuelt for oss å få dem på besøk.', 353, '2010-10-03 22:52:56'),
(43, 57, 'company', 'Kontaktperson:\r\n\r\nÅge Torvund\r\nKontaktinfo:\r\naage.torvund@mscsoftware.com\r\n--------------------------------\r\nFeil mailadresse', 44, '2010-10-07 22:55:06'),
(44, 57, 'company', 'Sendt ny mail for å få tak den riktige mailadressen eller til en ny kontaktperson', 44, '2010-10-07 22:56:06'),
(45, 57, 'company', 'Åge Torvud sin nye mailadresse:\r\n\r\naage.torvund@simevolution.no\r\nÅge Torvund er nå Managing Director for SimEvolution AS. De er bare to ansatte og bedriftspresentasjon er uaktuelt. MSC Software har kontorer i Gøteborg og får dekket ressurs behov i Sverige.', 44, '2010-10-24 22:57:18'),
(46, 98, 'company', 'Studentkontakt for NTNU:\r\n\r\nJan Anton Sannes \r\nE-post: jss@grenlandgroup.com\r\nTlf.: +47 33 36 12 80\r\n\r\n___________________________\r\n\r\nHar forløpig bestemt seg for at presentasjon ved Karrieredagen samt Næringslivsdagen gir den nødvendige profileringen av selskapet mot studentene ved NTNU.\r\n\r\nHar orientert sine avdelingsledere om at de også har tilbudet om å komme opp og holde bedriftspresentasjoner for en eller flere \r\nlinjer av gangen dersom dette er ønskelig, men at det er opp til dem ut ifra situasjonen til enhver tid hvorvidt dette er ønskelig.\r\n\r\nHar for øyeblikket ingen umiddelbare behov for en bedriftspresentasjon, men vil ta kontakt når det blir aktuelt.', 314, '2010-10-25 22:59:27'),
(47, 17, 'company', 'Kontaktperson:  \r\n\r\nJohan Fredrik Bratt, HR O&G Reinertsen\r\n\r\nMail: johan.bratt@reinertsen.no\r\n\r\nTlf: 73 56 28 80\r\n\r\n-----------------------------------------------------------------\r\n\r\nSist kontaktet 28.10.10:\r\n\r\nSnakket med Johan Bratt over telefon, og fikk tilbakemelding at de bare hadde tillatelse fra høyere hold til å møte på større arr. som BM-dagen, Karrieredagen osv. og at det var dette de var mest interessert i. Men dersom de ombestemte seg skulle han ta kontakt, for de var veldig interessert i IKT-studenter, og særlig de innen petroleum, for dette var noe de trengte.', 198, '2010-10-28 23:01:48'),
(48, 52, 'company', 'Kontaktperson:\r\n\r\nBertil Nistad (usikker på om stavingen er riktig)\r\n\r\nMail: info@comsol.no\r\n\r\nTlf: 73 84 24 00 (sentralbord)\r\n\r\n-----------------------------------------------------------------\r\n\r\nSist kontaktet: 28.10.10\r\n\r\nSnakket med sentralbordsdamen, og ho gav meg navnet på denne kontaktpersonen. Han var dessverre ikke på jobb før neste torsdag, så skulle ringe da..', 198, '2010-10-28 23:04:04'),
(49, 53, 'company', 'Kontaktperson:\r\n\r\nLeiv Låte, Managing Director\r\n\r\nMail: leiv.late@fedem.com\r\n\r\nTlf: 72 90 03 00 (sentralbord)\r\n\r\n----------------------------------------------------\r\n\r\nSist kontaktet: 28.10.10\r\n\r\nHar sendt mail tidligere uten respons, ringte i dag og fikk vite at han var på møte men at jeg skulle prøve igjen i morgen. Det var iallefall riktig person å snakke med om dette sa resepsjonisten', 198, '2010-10-28 23:06:01'),
(50, 76, 'company', 'Kontaktperson:\r\n\r\nFrank Haugan\r\nSeniorrådgiver, Analyse og planlegging\r\n\r\nMob/dir: 97 50 47 73, Tlf: 73 94 97 97, Faks: 73 94 97 90\r\nfrank.haugan@asplanviak.no - www.asplanviak.no\r\nAsplan Viak AS, Tempevegen 22, Postboks 6723, 7490 Trondheim\r\n\r\n________\r\n\r\nVillige til å stille opp på bedpres:)\r\nSannsynligvis mest interessert i Geomatikk.\r\n\r\nJeg snakker med dem igjen til uka..', 314, '2010-09-12 23:07:52'),
(51, 76, 'company', 'Har fått oppdatert adressa til Asplan, den er:\r\n\r\nTempeveien 22\r\n\r\n7031 Trondheim', 314, '2010-10-23 23:08:53'),
(52, 76, 'company', 'Referat:\r\n\r\nBedriftens navn: Asplan Viak AS (Geomatikk) og Asplan Viak Internet AS / Avinet\r\nTid for bed.pres: 20.10.2010\r\nKontaktperson(er): Frank Haugan <frank.haugan@Asplanviak.no> \r\n                                  Tlf: 73 94 97 97   Mobil: 97 50 47 73\r\n\r\n                                 (Frode Wiseth Jørgensen <fwj@avinet.no>)\r\nTa i hovedsak kontakt med Frank Haugan, det var han som sto for all kontakt med Avinet denne gangen.\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\nAsplan Viak AS er et konsulentfirma som kombinerer teknisk og faglig kompetanse i forbindelse med løpende saksbehandling, planlegging, forvaltning, drift og vedlikehold.\r\nAvinet er et datterselskap av Asplan Viak AS, og antakelig det mest interessante for oss IKTere (i hovedsak geomatikk). De driver bl.a. med utvikling av ulike digitale kart og geografiske applikasjoner.\r\n\r\n"I Asplan Viak er vi opptatt av å kombinere vår tekniske kompetanse med fagkunnskap innen andre
kompetanseområder. \r\n\r\nAsplan Viak har både spisskompetanse innen GIS og 3D-visualisering og planleggere, landskapsarkitekter og arkitekter som har lang erfaring med bruk av verktøyene innen sitt fag. Denne allsidig og tverrfaglig kompetanse sikrer at vi kan nyttiggjøre teknologien som en integrert del av oppdragene, noe som etter vår erfaring også gir de beste resultatene." \r\n(asplanviak.no)\r\n\r\n"Avinet er ei konsulentverksemd spesialisert innan nettbaserte kart- og databaseløysingar og er aktive innan nasjonale og europeiske FoU-prosjekt. Vi leverar også kartbaserte applikasjonar for offentleg sektor, turisme og e-læring.\r\n\r\nVår visjon er å tilby smarte løysingar basert på innovasjon og erfaring. Slik håpar vi å betre arbeidsprosessar og informasjonsflyt hjå våre kundar. Namnet Asplan Viak Internet skal vere assosiert med god teknisk kompetanse, fagleg forståing og vellukka samarbeid.\r\n\r\nStyret er samansett av to representantar frå eigarselskapet, Asplan Viak A/S og eitt eksternt
styremedlem. Viktigaste oppgåva er å arbeide strategisk med marknadsgrunnlaget og selskapet for å styrke innteninga og utvikle kompetansen til dei tilsette."\r\n(avinet.no)\r\n\r\nSiste kontakt med bedriften:\r\n\r\n"Vi syntes vi fikk god kontakt med studentene og at de virket interesserte så vi er også fornøyde.\r\n\r\nTa bare kontakt med meg neste år om dere vil ha en ny presentasjon så får vi se om vi kan få det til på nytt."', 314, '2011-01-10 23:10:20'),
(53, 38, 'company', 'GBS data ble i 2003 slått sammen med mange andre til Norconsult Informasjonssystemer AS. Ingen grunn til å kontakte GBS data på egen hånd.', 306, '2010-11-04 23:12:45'),
(54, 48, 'company', 'Kontaktperson:\r\n\r\nKnut Åmdal\r\nKontaktinfo:\r\nKnut.Amdal@metronor.no\r\n--------------------------------\r\nIkke noe svar enda…', 44, '2010-09-23 23:14:18'),
(55, 48, 'company', 'Sist vi kontaktet Knut var de økonomiske betingelsene for høye, sendte en mail med prisene og nevnte at inngangspengene kan diskuteres.', 44, '2010-09-27 23:15:13'),
(56, 48, 'company', 'Bra løysing det der.\r\n\r\nEg meiner regelen var at det er 150 kr per person i honorar til BedKom, men viss den totale summen kjem over 10 000 kr stopper vi der.\r\n\r\nAltså blir maksimalprisen 10 000 kr. Stemmer dette? Hadde likt å få dette bekrefta frå nokon som har vert med i BedKom ei stund.\r\n\r\nEDIT: Dette stemmer, fekk vite dette av Daniel.\r\n\r\n"I fjor stadfesta vi at vi skulle holde oss til desse prisane så langt det var mulig. Prisene er da 150,- pr pers (+mat o.l) og maks 10.000,- som du skriver. Føler det blir dumt å operere med spesialpriser, da dette kan få negative konsekvenser dersom andre bedrifter får nyss i dette."', 293, '2010-09-28 23:16:28'),
(57, 48, 'company', 'Har ikke fått svar etter jeg sendte prisene, antar at de var for høye. Sendt ny mail for å få dette bekreftet.', 44, '2010-11-04 23:17:15'),
(58, 48, 'company', 'økonomiske betingelsene for høye', 44, '2010-11-19 23:18:06'),
(59, 84, 'company', 'Kontaktperson:\r\nTrond Hagen\r\nDaglig leder\r\n\r\nDr. Ing. A. Aas-Jakobsen AS, Lilleakerv. 4, 0283 Oslo\r\nTel: 22 51 31 00, Mob: 917 83 600, Faks: 22 51 30 01\r\nepost: tah@aaj.no, Web: www.aaj.no\r\n\r\n__________\r\nDe har allerede planlagt bedpres for bygg, men skal diskutere litt internt om de vil kjøre to parallelle opplegg på NTNU.', 314, '2010-09-12 23:19:48'),
(60, 84, 'company', 'Ønsker å holde presentasjon i mars (10.? Dato bekreftes 29.nov).\r\n\r\nSå tidlig som mulig, kl17? Skal rekke fly hjem.\r\n\r\nKonstruksjonsdelen av presentasjonen for Bygg i februar (repetisjon for de som har tilgang til begge).\r\n\r\n5.klassinger bes gå på Aarhønens presentasjon for ansettelse (som gjøres umiddelbart etter denne).\r\n\r\nÅpent for så mange vi vil (men kun relevant for konstruksjon).', 314, '2010-11-30 23:20:48'),
(61, 84, 'company', 'Dato: onsdag 16.mars', 314, '2010-11-30 23:22:13'),
(62, 104, 'company', 'Sendt mail til\r\n\r\nfirmapost@ramboll.no\r\n\r\nForhåpentligvis vil jeg få en kontaktperson', 44, '2010-10-24 23:23:43'),
(63, 104, 'company', 'Sendt ny mail', 44, '2010-11-04 23:24:39'),
(64, 104, 'company', 'Kontakt person:\r\n\r\nMarit Næss\r\nHR-Koordinator\r\n\r\nD +47 33 51 14 21\r\nmrtn@ramboll.com\r\n\r\n"Vi har dessverre kommet til at vi ikke ønsker dette og grunnen er at studiet ligger i grenseland av hva vi tradisjonelt rekrutterer hos oss, og vi har for lite ressurser til å ha så mange bedriftspresentasjoner som vi kunne ønsket oss. \r\n\r\nJeg håper imidlertid at vi kan nå flere av deres studenter på andre arrangementer som er felles for flere studieretninger på NTNU." ', 44, '2010-12-13 23:26:14'),
(65, 35, 'company', 'Sendt mail til:\r\n\r\nAndre Jåtog\r\n\r\nkonserndirektør\r\n \r\n91 37 22 43\r\nandre@dnc.no', 348, '2010-12-30 23:28:16'),
(66, 35, 'company', 'Hei Thor André\r\n\r\nTakk for hyggelig henvendelse. DnC er nå mitt lille holdingselskap og ikke noe interessant å høre om eller jobbe i, men takk for henvendelsen.\r\n\r\nAndré Jåtog\r\nDnC - Because we care\r\n\r\n\r\nMao vil ikke DnC holde bedriftspresentasjon.', 348, '2011-01-05 23:29:35'),
(67, 62, 'company', 'Sendt mail til:\r\n\r\nRune Waaler\r\n\r\nrune.waaler@raufossneuman.com', 348, '2010-12-30 23:31:02'),
(68, 62, 'company', 'Hei,\r\n\r\nVi takker for henvendelsen, men ser på nåværende tidspunkt at dette er lite aktuelt for oss.\r\nVi har normalt hatt god tilgang ved behov av nyansettelse ved normal søkning, samt sommerjobber.\r\nFor sommerjobb og forslag på oppgaver ser vi alltid positivt på eventuelle henvendelser fra studentene på linje med andre.\r\n\r\nBest regards\r\n-Rune Waaler\r\nProduct Manager\r\nRAUFOSS Technology AS, Box 77, N-2831 Raufoss, Norway \r\nPhone +47 61152581 \r\nCell Phone: +47 41548325 \r\nFax +47 61152372 \r\nRaufoss Technology AS phone +47 98281999\r\nEmail: rune.waaler@raufossneuman.com\r\n\r\n\r\nMao vil de ikke holde bedriftspresentasjon på nåværende tidspunkt.', 348, '2011-01-05 23:32:09'),
(69, 4, 'company', 'Mail sendt til postmottak@statsbygg.no \r\n\r\nSatser på at mailen blir videresendt til riktig person.', 348, '2011-01-05 23:34:17'),
(70, 4, 'company', 'Fikk svar:\r\n\r\nHei,\r\n\r\nTakk for din forespørsel. Statsbygg er til stede på NTNU tre ganger i året på karrieredagen, bygg - og miljødagene og IAESTEs karrieredager, og har av og til presentasjoner i forbindelse med disse dagene.\r\n\r\nVi ser oss for tiden ikke stand til å prioritere ytterligere tilstedeværelse på NTNU. Beklager dette. Vi ønsker dere uansett lykke til med bedriftspresentasjonene.\r\n\r\nSer ut som vi kan stryke de fra listen!', 348, '2011-01-06 23:35:15'),
(71, 100, 'company', 'Takk for invitasjon!\r\n\r\nVi har stort behov for kompetanse og kandidater innen en rekke fagområder, men må prioritere de fagene som er kritstisk for jernbanen i Norge. På bakgrunn av dette kan vi dessverre ikke stille på bedriftspresentasjon hos dere.\r\n\r\nLykke til i arbeidet!\r\n\r\nVennlig hilsen\r\n\r\nBente Tangen\r\n\r\nBente Tangen\r\nSenior HR rådgiver, rekruttering og kompetanse \r\nJernbaneverket\r\nTelefon: 911 35 941\r\nE-post : bente.tangen@jbv.no\r\nStrategisk stab Organisasjon og personal', 353, '2011-01-11 23:36:49'),
(72, 59, 'company', 'Ringte sentralbord og fikk kontakt med Kjell A. Bengtsson, kab@jotne.com. Sendte ham en mail for videresending.', 314, '2011-01-11 23:38:17'),
(73, 21, 'company', 'Sist kontakta september 2010 av Hege. Dei ville ikkje komme på besøk.', 293, '2010-09-12 23:39:58'),
(74, 21, 'company', 'Kontaktperson var Ellen Sæbbø Undset, kontaktinfo: \r\n\r\neMail ellen.undset@subsea7.com\r\nTel +(47) 51 72 51 92\r\nMobile +(47) 93 29 96 04\r\nFax +(47) 51 72 50 01\r\n\r\nde skulle ha bedpres med tp 2.nov og marintek-dag 28.okt.', 279, '2010-09-12 23:40:47'),
(75, 21, 'company', 'Subsea 7 har tatt over Acergy', 339, '2011-01-11 23:41:56'),
(76, 81, 'company', 'Acergy er kjøpt opp av Subsea 7', 339, '2011-01-11 23:43:48'),
(77, 90, 'company', 'Hei !\r\n\r\nTakk for invitasjonen.\r\nBackeGruppen har årlig presentasjon på Institutt for Bygg- og miljøteknikk samt at vi deltar på karrieredagen på NTNU.\r\n\r\nVi er av den oppfatning at vi gjennom disse presentasjonene treffer våre aktuelle målgrupper, og takker derfor nei til en presentasjon hos dere.\r\n\r\nMed hilsen\r\nfor Backe Entreprenør Holding AS\r\n\r\nArne Landmark\r\nOrganisasjonsdirektør\r\nWiderøeveien 1, 1360 Fornebu\r\nTlf: 40 60 87 15\r\nhttp://www.backe.no\r\n\r\n\r\nBacke Gruppen har altså takket nei.', 339, '2011-01-12 23:44:57'),
(78, 67, 'company', 'HR ansvarlige skulle ta kontakt om ca to uker, når hun var tilbake etter sykefravær.', 339, '2011-01-12 23:46:35'),
(79, 69, 'company', 'Hei,\r\n\r\nVi er nå inne i en fusjons prosess med ErgoGroup, og i den forbindelse er det mye som skal falle på plass. Vi har planlagt en del bedriftspresentasjoner i 2011, men vi ser oss dessverre ikke i stand til å besøke dere i år. \r\n\r\nVi hører imidlertid gjerne fra dere på et senere tidspunkt slik at en evt presentasjon hos dere kan planlegges som en del av det vi gjør i 2012. Kontaktperson vil da være Bjørn Schulstock som rekrutteringssjef i det nye selskapet.\r\n\r\nVennlig hilsen\r\nMari Stensholt, +47 41402135\r\nHR - Konsern\r\n\r\nEDB blir altså fusjonert med ErgoGroup.', 339, '2011-01-12 23:48:13'),
(80, 70, 'company', 'Sendt mail til daglig leder i Data Design Systems.', 279, '2011-01-10 23:49:29'),
(81, 70, 'company', 'DDS har nok folk for tiden og takker derfor nei.\r\n\r\nKontaktperson: \r\nSvein Inge Nærheim <sin@dds.no>', 279, '2011-01-13 23:50:51'),
(82, 39, 'company', 'yow. Har fått en milliard kontaktpersoner på denne bedriften.\r\n\r\ntormod.aurlien@byggforsk.no - jobber nå i Ås, drit i han tror jeg\r\n\r\nVivian.Meloysund@sintef.no - hun ga meg to nye kontakter, går sikkert ann å prøve henne om man trenger nye folk å snakke med.\r\n\r\nBerit Laanke (tlf.92808312, berit.laanke@sintef.no) har ikke kontaktet, ble kontaktet av elisabeth først uansett, går sikkert ann å teste denne dama i framtida\r\n\r\nLisbeth Alnæs (+47 73 59 49 22 | +47 930 58 535 | Lisbeth.alnas@sintef.no ) Har hatt en god kontakt med hun, hun sa først at hun takket "JA" til invitasjonen om  å komme og holde bedpres og lurte på mulige datoer, men så nevnte jeg det at det koster penger og tolker det sånn at hun ble litt usikker. \r\n\r\nHun har vært borte over høstferien så har ikke fått snakket med a'' på en stund. Har nå sendt en ny mail til henne og om jeg ikke får noe svar ringer jeg bare. Jeg er positiv.', 306, '2010-10-19 23:52:53'),
(83, 39, 'company', 'Ringte Lisbeth, hun hadde glemt meg og huska ikke hvorfor hun ikke svarte på mail, skulle se over.', 306, '2011-01-13 23:53:51'),
(84, 66, 'company', 'Fikk kontaktperson gjennom sentralbord:\r\n\r\npeter tubaas, Informasjonssjef\r\npeter.tubaas@no.abb.com\r\n\r\nsendt mail', 306, '2011-01-06 23:56:00'),
(85, 66, 'company', 'Hei Snorre, \r\n\r\nTakk for henvendelsen. Jeg er involvert i dette og skal ta det videre med rekrutteringsansvarlig. Vi tar kontakt om det er aktuelt, eller om vi trenger mer info. \r\n\r\nLinjen høres relevant ut. Men vi er allerede booket inn på en del tilsvarende presentasjoner, så det har også litt med kapasitet å gjøre. \r\n\r\nmvh \r\nPeter', 306, '2011-01-13 23:56:55'),
(86, 111, 'company', 'Fikk kontakt gjennom tidligere IKT-student Martin Vitsø: \r\n\r\nMartin Vitsø\r\nmartvits@gmail.com\r\n\r\nsom også er kontaktperson. De er muligens interessert i bedriftspresentasjon, har purret dem på mail i dag.', 279, '2011-01-10 23:58:59'),
(87, 111, 'company', 'De står over denne gang, men kan være interesserte senere. Kontaktperson er Martin Vitsø og evt:\r\n\r\nLasse Andreassen\r\nlasse.andreassen@trondheim.kommune.no', 279, '2011-01-13 00:00:18'),
(88, 12, 'company', 'Kontaktperson:\r\n\r\nJarle Matland, uteksaminert fra Ingeniørvitenskap og IKT\r\nKontaktinfo:\r\njarle.matland@gmail.com\r\n--------------------------------\r\nPrøver å få tak i den rette personen å kontakte gjennom Jarle Matland\r\nIkke noe svar enda…', 44, '2010-09-23 00:02:40'),
(89, 12, 'company', 'Sendt ny mail', 44, '2010-10-07 00:03:58'),
(90, 12, 'company', 'Jarle har gitt meg kontaktperson:\r\n\r\nelisabeth.currais@shell.com\r\n\r\nSendt mail', 44, '2010-10-24 00:04:56'),
(91, 12, 'company', 'Sendt ny mail', 44, '2010-11-04 00:05:50'),
(92, 12, 'company', 'Kontaktperson:\r\n\r\nAnna Ivanova\r\n\r\nAnna sin epost er: anna.ivanova@shell.com og mobilnr. +44 7779 136424.\r\n \r\nHusk å skriv mail på engelsk!', 44, '2010-11-19 00:06:47'),
(93, 12, 'company', 'De skal bruke Teknologiporten for bedriftspresentasjon nå på våren ved NTNU. Så får vi se til høsten igjen hvordan vi skal gjøre det for sept/okt.', 44, '2011-01-16 00:08:00'),
(94, 114, 'company', 'Ikke relevant, driver ikke med beregninger selv.\r\n\r\n(Har allikevel en student inne som driver med dette for å beregne litt)', 353, '2011-01-17 00:09:46'),
(95, 115, 'company', 'Relevant, men har nettopp ansatt mye nytt.\r\n\r\nVil gjerne gjenoppta kontakten til vårsemesteret 2012.\r\n\r\nernst@cfd.no - jobbet på SINTEF og har grei peiling på hva dette er for noe.', 353, '2011-01-17 00:11:13'),
(96, 73, 'company', 'jeg har ikke funnet noen kontaktadresse eller nettside på disse.', 353, '2011-01-11 00:13:17'),
(97, 73, 'company', 'Har blitt spist av noen som igjen er fusjonert med Norconsult IS, virker det som. Ikke mye spor å gå etter på nettet.', 353, '2011-01-17 00:13:55'),
(98, 93, 'company', 'Prioriterer Berg og Geotek, holder årlig presentasjon der. Har ikke kapasitet til mer.', 353, '2011-01-17 00:15:37'),
(99, 22, 'company', 'Var på BM-dagen og hadde bedpres i forbindelse med det. Ville allikevel se over vårt og gi meg en tilbakemelding, selv om de har ansatt mye nytt i det siste.', 353, '2011-01-17 00:16:51'),
(100, 108, 'company', 'Finner ikke mailadresse på deres hjemmeside. Prøvde å ringe, men fikk ikke svar.\r\n\r\nTel: +47 67 58 85 00\r\n\r\nPrøver igjen senere.', 348, '2011-01-05 00:18:14'),
(101, 108, 'company', 'Jeg sendte mail til Anders Lunde som er tidligere hybrid, og han ga meg kontaktperson: Lise Hjelle: LHjelle@technip.com. Han mente i tillegg at de passer best for marin teknikk, men at de også egner seg bra for konstruksjonsteknikk og maskin.', 279, '2011-01-11 00:20:09'),
(102, 108, 'company', 'Fantastisk! Tusen takk, skal sende en mail straks jeg har tid!', 348, '2011-01-11 00:21:16'),
(103, 108, 'company', 'Mail sendt!', 348, '2011-01-12 00:22:02'),
(104, 108, 'company', 'Hei igjen,\r\n\r\nHar nå fått tilbakemelding fra både HR og Engineering avdeling og\r\nde sier at det ikke vil være interessant med bedriftspresentasjon nå\r\ndette semester. Send gjerne info neste semester så kan vi vurdere\r\ndet pånytt da.\r\n\r\nLykke til med prosjektet!\r\n\r\nMvh\r\nLise\r\n\r\nSom det står er de uaktuelle dette semesteret, men vi kan sende ny mail til høsten.', 348, '2011-01-17 00:23:14'),
(105, 15, 'company', 'Ble kontaktet av Alf Kjøstvedt: Alf.Kjostvedt@akersolutions.com, som lurte på om vi hadde studenter som er interesserte i jobb. Sendte mail med info om profilering og bedpres i dag.', 279, '2011-01-13 00:25:24'),
(106, 15, 'company', 'Jeg tror de er mest interessert i å utlyse stilling til sommeren, både fast og sommerjobb. Tenkte høre om de er interessert i bedpres til høsten, for profileringens skyld. Evt så nevnte han at han muligens skulle en tur til Trondheim, men jeg tviler litt på om timingen passer.', 279, '2011-01-17 00:26:25'),
(107, 41, 'company', 'Kongsberg profilerer seg mot studenter under konsernet Kongsberg Gruppen. De hadde ikke kapasitet til å ha flere bedriftspresentasjoner i høst, men jeg har fått kontaktinformasjonen til den som er ansvarlig for slikt, slik at vi kan kontakte de senere.\r\n\r\nKontaktperson:\r\nHeidi.Nygard@kongsberg.com', 339, '2010-09-24 00:28:24'),
(108, 41, 'company', 'Hijacker denne tråden\r\n\r\nHar nå fått ny kontakt:\r\n\r\nHege Edvardsen\r\nHege.Edvardsen@kongsberg.com\r\n\r\nprøver rune sin kontakt om denne suger', 306, '2011-01-13 00:29:38'),
(109, 41, 'company', 'Ble videresendt til Heidi Nygard, ikke no grunn til å prøve noen av de andre.', 306, '2011-01-13 00:30:44'),
(110, 41, 'company', 'Hei Snorre!\r\n\r\nDet er meg som er kontaktpersonen deres i Kongsberg Gruppen.\r\nKongsberg Gruppen har meldt seg på flere karrieredager på NTNU nå i vårsemesteret og har dessverre ikke mulighet til å stille på enda flere arrangementer.\r\nVi håper å treffe studentene fra I & IKT på karrieredagene.\r\n\r\nMvh\r\nHeidi Nygård\r\nKONGSBERG GRUPPEN ASA', 306, '2011-01-21 00:31:36'),
(111, 87, 'company', 'Kontaktperson Frode Kaafjell\r\n\r\nSvar fra Frode:\r\n\r\nHei, og takk for forespørsel. \r\n\r\nVi har ikke mulighet for å presentere oss for dere i år. Vi har begrenset kapasitet til å håndtere hovedoppgaver og prosjekter for studenter, og rekrutterer i liten grad kandidater rett fra høyskolenen.\r\n\r\nMen det hørers ut som et interessant og aktuelt studium. \r\n\r\nBest Regards\r\nFrode Kaafjeld', 306, '2011-01-21 00:33:08'),
(112, 96, 'company', 'Hei Snorre,\r\n\r\nTakk for henvendelsen din. Studiet deres er absolutt aktuelt for vår Tech avdeling i Consulting. Vi vil holde bedriftspresentasjon på NTNU gjennom Bindeleddet, og har åpnet for at folk fra deres linje kan melde seg på her.\r\n\r\nUt over dette tror jeg dessverre ikke det er aktuelt å holde en presentasjon kun for deres studie i denne omgang. Kom gjerne bortom oss på stand når vi er der 26. januar. Ellers er vi også til stede på både IT dagene og IAESTEs karrieredager.\r\n\r\nMvh\r\nHelene Sillerud Cappelen\r\nRekrutteringsansvarlig | HR\r\nDeloitte \r\nMobile: +47 957 03 179\r\nwww.deloitte.no', 306, '2011-01-21 00:34:47'),
(113, 37, 'company', 'Kontaktet for 12. september på infomailen, ikke noe svar\r\n\r\nNy kontakt i dag, 19. september. Sendt mail til Kyrre Johansen, head of department her i Trondheim (kyrre.johansen@blomasa.com +47 91 15 84 71). Ikke fått svar enda men er HÅPEFULL', 306, '2010-10-19 00:36:19'),
(114, 37, 'company', 'fått to nye kontakter, en av dem skal kontakte meg videre, men begge kan vel brukes i framtida.\r\nHåkon Andresen\r\nhakon.andresen@blomasa.com\r\n\r\nAndreas Holter\r\nandreas.holter@blomasa.com', 306, '2010-10-20 00:37:43'),
(115, 37, 'company', 'Fikk aldri lyd fra de som skulle kontakte meg, har ikke nummeret deres så måtte bare sende dem en mail hver.', 306, '2011-01-13 00:39:06'),
(116, 37, 'company', 'svar fra Andreas Holter andreas.holter@blomasa.com \r\n\r\nFørst og fremst skjønner han ikke opplegget, virker som om han tror dette er en slags messe jeg invitert han til, så må sende en litt døll mail og forklare hvordan det skal funke.\r\n\r\nHan sier det ikke er mulig før høsten, og jeg svarer at det er np', 306, '2011-01-21 00:40:28'),
(117, 37, 'company', 'Den er grei, eg får seie i frå til folka på Geomatikk om at dei ikkje er interesserte før til hausten. Sidan vi tok denne bedrifta frå lista over bedrifter dei gjerne ville ha kontakt med.', 293, '2011-01-21 00:41:09'),
(118, 95, 'company', 'Har sendt mail til kontaktperson på deres hjemmesider: Vegar Paulsen:  vegar.paulsen@bearingpointconsulting.com', 279, '2011-01-12 00:42:14'),
(119, 95, 'company', 'De er ikke interesserte i flere bedpresser nå.', 279, '2011-01-24 00:43:17'),
(120, 124, 'company', 'Tok en telefon og traff riktig person. Dette var ikke så aktuelt nå, men vi måtte gjerne ta kontakt rundt sommeren.\r\n\r\ntds@tecas.no\r\n\r\nFikk ikke forklart noe rundt opplegget.', 314, '2011-01-27 00:45:05'),
(121, 107, 'company', 'Sendte mail til info.no@siriusit.com, men fikk feilmelding tilbake.', 339, '2011-01-11 00:46:39'),
(122, 107, 'company', 'Sirius IT er blitt en del av Visma', 339, '2011-01-28 00:47:16'),
(123, 75, 'company', 'Kontaktperson:\r\n\r\nKjell Erik Rian, Dr.ing.\r\nPrincipal Specialist\r\nComputational Industry Technologies AS (ComputIT)\r\nTrondheim, Norway\r\n\r\nE-mail: kjell.e.rian@computit.no\r\n_____________________\r\n\r\nVeldig positive til å holde en presentasjon på nyåret. Særlig interessert i Varme og strømning, men også lavere årstrinn (og forhåpentligvis noen andre retninger).\r\n\r\nTar opp igjen kontakten i slutten av januar da de har mye å gjøre nå på slutten av budsjettåret (og vi har eksamen, og jeg får ikke lov av Frans å gjøre noe). Da vet de også mer om ansettelsesbehov.', 314, '2010-11-17 00:48:52'),
(124, 75, 'company', 'Ser på nåværende tidspunkt ikke behov for en bedriftpresentasjon.\r\n\r\n"ComputIT er et forholdsvis lite spesialistselskap, og med to nyansettelser ifjor høst ser vi at vi har dekket vårt behov for\r\narbeidskraft i nærmeste framtid.\r\n\r\nI tillegg er ComputIT for tiden involvert i veiledningen av 3 masterstudenter og 3 doktorgradsstudenter fra NTNU, og vi inviteres\r\nårlig til å holde gjesteforelesninger i fag ved NTNU.\r\n\r\nVi har derfor vært i den gunstige situasjonen at vi stadig får studenthenvendelser om mulighetene for prosjektoppgave, masteroppgave, sommerjobb og jobb. Studenter ved I&IKT må gjerne ta kontakt med oss direkte."', 314, '2011-02-03 00:49:54'),
(125, 60, 'company', 'Hei,\r\n\r\nDette er vi absolutt interessert i. Kan du gi noe mer info om logistikken rundt en slik presentasjon (tidspunkt, varighet, osv)?\r\n\r\nMvh\r\nMagnus Normann\r\nMobil: +47 93 43 38 83\r\n\r\n-----Original Message-----\r\nFrom: Anne-Marie Stabb \r\nSent: 12. januar 2011 08:28\r\nTo: Magnus Normann; Helge Kjeilen\r\nSubject: FW: Bedriftspresentasjon\r\n\r\nHar sendt svar tilbake.', 339, '2011-01-12 00:54:42'),
(126, 60, 'company', 'Kopierer dette inn frå forrige posten vi hadde om Summit. Sjekk etter duplikater før du lager ein ny post. Eg sletta den forrige posten.\r\n\r\n""\r\nPrata med ein frå Summit Systems i dag og han tipsa om at vi kunne ta kontakt med Ole Skjølingstad for å prate om bedpreser.\r\n\r\nEin finner ikkje adressa hans på heimesida, men fekk tips om at ein kan bruke kontaktskjema på samme sida.\r\n""', 293, '2011-01-13 00:55:50'),
(127, 60, 'company', 'Summit ville ha bedpress den 16. mars, datoen er allerede tatt for bedpress. Foreslo å ha den uken før eller uken etter i stedet.', 339, '2011-01-28 00:56:31'),
(128, 60, 'company', 'Hei,\r\n\r\nEr onsdag 9. eller onsdag 23.ledig?\r\n\r\nMvh\r\nMagnus Normann\r\nMobil: +47 93 43 38 83\r\n\r\nBegge datoane var ledige, sendt spørsmål angåande størrelsen på presentasjonen ol.', 339, '2011-02-05 00:57:37'),
(129, 2, 'company', 'Har sendt mail til:\r\n\r\nBernt Saugen\r\n\r\nbernt.saugen@tomra.no', 348, '2010-12-30 21:45:09'),
(130, 2, 'company', 'Mailen kom ikke frem, prøver meg på info@tomra.com', 348, '2011-01-05 21:46:35'),
(131, 2, 'company', 'Fikk hyggelig svar fra denne damen:\r\n\r\nGitha Brusch Trapnes\r\nGroup HR Manager\r\nTomra Systems ASA\r\nPhone: + 47 66 79 92 21\r\nMobile: + 47 92 48 44 23\r\n\r\nHun spurte videre om priser, og jeg svarte henne på dette. Avventer svar.', 348, '2011-01-05 21:47:28'),
(132, 2, 'company', 'Har fortsatt ikke fått svar, purremail sendt.', 348, '2011-02-05 21:48:13'),
(133, 2, 'company', 'Hei\r\nVi har valgt å holde en bedriftspresentasjon for industri- design linjen denne gangen, og så kommer vi opp i september på karrieredagen. Tror det blir vår innsats i år, i tillegg til fire diplom oppgaver vi kjører for tiden.\r\nLykke til videre.\r\n\r\nmvh/br\r\nGitha B. Trapnes\r\n\r\nVi kan med andre ord stryke de fra listen for et års tid.', 348, '2011-02-05 21:49:02'),
(134, 25, 'company', 'Sist kontaktet mai 2010, de hadde allerede en deal med teknologiporten og så seg fornøyd med det., men de skulle ta kontakt om det var aktuelt neste gang...\r\n\r\nKontaktperson:\r\nNiklas Lindwall\r\nEngineering Data Resources as\r\n+47 982 982 52\r\nNiklas.Lindwall@edr.no ', 306, '2010-09-12 21:50:49'),
(135, 25, 'company', 'Legger til referatet frå 2008 angåande EDR\r\n\r\n""\r\nBedriftnavn: EDR Engineering Data Resources AS\r\n\r\nAvdeling:\r\n\r\nTid for bed.pres:\r\n\r\nKontaktperson(er): Niklas Lindwall        \r\n\r\nEpostadresse:Niklas.Lindwall@edr.no\r\n\r\nTlf: 67 57 31 34\r\n\r\nMobil: 982 982 52\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nEDR er en av skandinavias største leverandører av teknisk programvare for 3D-konstruksjon og FEM/CFD-beregninger.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordna bed.pres med dem:\r\n\r\nJeg ringte Niklas og fikk mailen hans, deretter sendte jeg en oversiktsmelding og fikk beskjed om å ringe han til høsten. Har kontaktet han og venter på å høre om de er interesserte.\r\n\r\nDitt navn: Jørund Johansen\r\n""', 293, '2011-02-05 21:51:57'),
(136, 14, 'company', 'Legger ved referatet frå 2008 med Aker Offshore Partner:\r\n\r\n""\r\nBedriftnavn: Aker Solutions\r\n\r\nAvdeling:\r\n\r\nTid for bed.pres: 23. Oktober 2008\r\n\r\nKontaktperson(er): Elena Silvanovich\r\n\r\nEpostadresse: elena.silvanovich@akersolutions.com\r\n\r\nTlf: 55 22 43 06\r\n\r\nMobil: 90 11 34 49\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?): Aker Solutions er en ledende global leverandør av ingeniør og konstruksjons tjenester, teknologi produkter og integrerte løsninger.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordna bed.pres med dem:\r\n\r\nLisa fikk kontakt ved mail. De trodde først vi var fra Marin teknikk som de hadde snakket med før. Da Lisa fikk oppklart misforståelsen var de fortsatt interesserte og Lisa avtalte en dato for presentasjon. Da Lisa sluttet tok jeg over og avtalte opplegget for presentasjonen over mail.\r\n\r\nDitt navn: Malene M. Saltnes\r\n""', 293, '2011-02-05 21:54:09'),
(137, 11, 'company', 'Norconsult Informasjonssystemer\r\n\r\nBård Hernes - Adm.Dir\r\n\r\n67 57 15 00 (Sentralbord)\r\n\r\nbard.sverre.hernes@norconsult.com', 353, '2010-09-23 21:56:10'),
(138, 11, 'company', 'Fikk ikke svar pr. e-post, sendt for lenge siden Hernes var på ferie.\r\n\r\nHan hadde ikke noen problemer med sist Bed.Pres og kunne godt tenkes at han ville gjenta det, men måtte ta det opp med ledelsen ved førstkommende møte. Dette er tidlig i Oktober, så for seg at litt uti November var et fint tidspunkt.\r\n\r\nSkulle sende epost med kontaktinfo o.l. til samme epostadresse.', 353, '2010-09-23 21:57:10'),
(139, 11, 'company', 'Fikk forresten oppgitt joobnummere til Bård Hernes på karrieredagen i dag, dersom du vil slippe å gå gjennom sentralbordet om du ringer:\r\n\r\nTlf: +47 67 57 15 05', 198, '2010-09-23 21:58:08'),
(140, 11, 'company', 'Hybrida fekk post i dag frå Norconsult: Dei har endra fakturaadresse som ein del av deira nye elektroniske fakturasystem.\r\n\r\nEg veit ikkje om det er fiksarane eller skattmester som har ansvaret for faktureringa, men tenker det er greitt å nemne det her.\r\n\r\nBrevet med den nye fakturaadressen er arkivert på hybridakontoret.', 293, '2010-10-04 21:59:20'),
(141, 11, 'company', 'Legger ved referat frå 2008 angåande Norconsult:\r\n\r\n""\r\nBedriftnavn:  Norconsult AS\r\n\r\nAvdeling:\r\n\r\nTid for bed.pres: 19. November 2008\r\n\r\nKontaktperson(er):  Bård Hernes\r\n\r\nEpostadresse:  Bard.Sverre.Hernes@norconsult.com\r\n\r\nTlf: 67571505\r\n\r\nMobil: 45401505\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nNorconsult er Norges største flerfaglige rådgivermiljø innen bygg, anlegg og samfunnsplanlegging, med over 1500 medarbeidere. I tillegg til tradisjonelle prosjekteringstjenester er også selskapet en ledende leverandør av IKT-løsninger innen Geografiske informasjonssystemer (GIS), forvaltning, drift og vedlikehold (FDV), kostnadsanalyser, prosjektstyring, konstruksjonsteknikk og DAK. Våre løsninger utvikles og markedsføres under merkenavnet ISY. Nærmere opplysninger finnes på våre internettsider www.norconsult.no og www.isy.no\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordna bed.pres med dem:\r\n\r\nSendte mail til listen
over bedrifter, der det jobber folk som har gått ut av I & Ikt. Fikk svar fra Norconsult  at de vil veldig gjerne har bedpress for oss.\r\n\r\nDitt navn: Brita Årvik\r\n""', 293, '2011-02-05 22:00:23'),
(142, 99, 'company', 'Ringte deres sentralbord og spurte etter mailadresse. Hun lurte da på hvilken av selskapene jeg var ute etter, og da ble jeg veldig usikker. Hvilket av deres selskaper er det som er relevante for oss?\r\n\r\nHun sa at Grieg Shipping bare ansatte folk fra Asia, så de var lite aktuelle for oss.', 348, '2011-01-05 22:01:38'),
(143, 99, 'company', 'Har nå sendt mail til personal@grieg.no\r\n\r\nVenter på svar!', 348, '2011-02-06 22:02:18'),
(144, 126, 'company', 'Ringte Erik Wold: 93 05 93 73.\r\nSendte ham en mail (som avtalt på telefon) -> erik.wold@rystadenergy.com.\r\nDe rekrutterer allerede fra IndØk, FysMat og Data.', 314, '2011-02-08 22:03:12'),
(145, 102, 'company', 'Har sendt mail til Marianne Valle etter telefonsamtale:\r\n\r\nmarianne.valle@nov.com', 348, '2011-01-05 22:04:22'),
(146, 102, 'company', 'Snakket i dag med NOV på stand på EL-bygget.\r\n\r\nPersonen jeg snakket med het Terje Korsnes og han skulle "purre" på Marianne og si at hun måtte svare meg.\r\n\r\nHar sendt ny mail til Marianne og håper på positiv respons denne gang.', 348, '2011-02-09 22:05:11'),
(147, 13, 'company', 'Fikk kontaktperson: Tone Kringstad:\r\n\r\ntone.kringstad@akersolutions.com\r\n\r\nHar sendt flere mail, men får ikke svar. Legger dette litt på is, da det allerede er mulighet for presentasjon med to avdelinger innen Aker Solutions.', 279, '2011-01-10 22:07:11'),
(148, 13, 'company', 'Snakket med en fra Aker Solutions i dag på stand på EL-bygget. Jeg etterlyste deler i Aker som har med konstruksjon/bygg å gjøre. Han ga meg følgende navn for kontaktpersoner vi kunne benytte oss av i Trondheim:\r\n\r\nHR: Sara Bavasi\r\n\r\nIngeniør, litt høyere i systemet: Eivind Rogstad\r\n\r\nFor å få mailadressene kan man ringe til sentralen deres: 51 89 89 00', 348, '2011-02-09 22:08:01'),
(149, 162, 'company', 'Legger ved utdrag frå CVen til Erlend Pedersen i Statnett\r\n\r\n""\r\nErlend Pedersen\r\n\r\nHR rådgiver, HR advisor, HR/Konserstab\r\n\r\nerlend.pedersen@statnett.no\r\n\r\nD: +47 23 90 43 53\r\nM: +47 48 89 97 96\r\nT: +47 23 90 30 00\r\nF: +47 22 52 70 01\r\n\r\nStatnett SF\r\nHusebybakken 28b\r\nPB 5192, Majorstuen\r\nNO-0302 Oslo\r\n""', 293, '2011-02-09 22:09:29'),
(150, 29, 'company', 'Kontaktperson:\r\n\r\nInger Johanne Aukland\r\nKontaktinfo:\r\niaukland@stavanger.oilfield.slb.com\r\n--------------------------------\r\nDe var her sist 17 februar 2010. Ville ikke komme tilbake i år.', 44, '2010-09-23 22:10:34'),
(151, 29, 'company', 'Får feilmelding når jeg sender mail og telefonnummeret jeg fant (51 94 64 24) er konstant opptatt. Kan prøve å ringe et par ganger til litt senere, men mistenker at vi må se etter ny kontaktperson..', 314, '2011-01-27 22:11:18'),
(152, 29, 'company', 'Legger ved referat frå 2008 med Schlumberger:\r\n\r\n""\r\nBedriftnavn: Schlumberger\r\n\r\nAvdeling: Hele\r\n\r\nTid for bed.pres: 06.11.08\r\n\r\nKontaktperson(er):  Erik Norgren , Inger Johanne Aukland\r\n\r\nEpostadresse: enorgren@slb.com , iaukland@stavanger.oilfield.slb.com\r\n\r\nTlf: 41 22 09 99, 51 94 64 24\r\nMobil: 51 94 60 01, 51 94 64 24\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nSchlumberger er en av de største bedrifter innen oljebransjen (de får oljen opp, men de eier den ikke).  De ansatter mye nyutdannede folk, bl.a fra IKT. Schlumberger har en spennede arbeidsplass hvos man må reise mye rundt i værden. Og de er kjukk av peng.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordna bed.pres med dem:\r\n\r\nJeg ble kontaktet av Inger Johanne, og vi avtalte bedriftpresentasjon. Erik holdte presentasjonen for oss.\r\n\r\nDitt navn: Per-Oddmund Korsnes\r\n""', 293, '2011-02-05 22:12:20'),
(153, 29, 'company', 'Ny kontaktperson:\r\nNavn:?\r\nEmail: shildal@slb.com\r\n\r\nedit: men nå får jeg feilmelding på denne også... (fungerte på første mail)', 314, '2011-03-22 22:13:18'),
(154, 110, 'company', 'Har sendt mail via kontaktskjema på deres hjemmeside: http://www.unit4agresso.no/\r\n\r\nHåper dette er bedriften jeg skulle kontakte. Er litt usikker på om UNIT4 R&D og UNIT4 Agresso er forskjellige bedrifter. Hadde satt pris på om noen korrigerte meg om dette er feil.', 348, '2011-01-05 22:14:28'),
(155, 110, 'company', 'UNIT4 R&D var dei som beslkte Trondheim på karrieredagen, og derfor kan vere aktuelle for oss. Både Agresso og R&D er undergrupper av samme bedrift, UNIT4 GROUP, i følge noko info som eg fant.\r\n\r\nhttp://www.karrierestart.no/bedrift.aspx?bid=331\r\n\r\nAgresso har underselskaper i Norge, så det er heilt greitt at du kontakta dei. Rekner med at mailen blir vidaresendt til rett instans/ undergruppe uansett om dei bestemmer seg for å følge det opp.', 293, '2011-01-06 22:15:14'),
(156, 110, 'company', 'Snakke med UNIT4 på IASTE sine næringlivdager. Han mente at linjen vår nok dessverre ikke var aktuell for deres firma. Da de er nærmest kun software utviklere av program rettet mot økonomi osv. De vil mao\r\n\r\nha reine programmerere. Altså kan nok UNIT4 strykes fra listen.', 348, '2011-02-14 22:16:17'),
(157, 58, 'company', 'Ringte sentralbord og fikk beskjed om å ringe igjen på fredag formiddag.  Tlf: 45 26 40 00', 314, '2011-01-11 22:17:48'),
(158, 58, 'company', 'Kontaktperson:\r\nPål Einar Berntsen\r\n90 54 20 08\r\npeb@dashsoftware.no\r\n\r\nHar vært gjennom mye, men er nå blitt en tredjepart i Visma med ansvar for produksjonsplanlegging. Jobber atm med å holde "hodet over vannet", men det ser lyst ut. Regner med å vite mer i mai. Går ting så bra som det ser ut nå holder de (Dash) gjerne en presentasjon neste semester. Sender en mail, så han kan ta kontakt om det skjer noe tidligere. Ellers kan vi ta kontakt til høsten.', 314, '2011-02-14 22:18:31'),
(159, 125, 'company', 'Fikk endelig kontakt på telefon:\r\n\r\nGunnar Birkeland\r\n90 98 10 29\r\ngunnar.birkeland@polytec.no\r\n\r\nVirka positiv. Allerede med i Haugesundregion-samarbeidet, så måtte sjekke opp det.\r\nFortsetter med mailkorrespondanse, så ser vi hva som skjer.', 314, '2011-02-14 22:19:45'),
(160, 125, 'company', '"Vi avventer til vi ser program for fellesmøter arrangert av regionen vår."', 314, '2011-02-16 22:20:27'),
(161, 122, 'company', 'Karl Otto Jansen <karl-otto.jansen@advansia.no>:\r\n\r\nAdvansia AS er et relativt lite selskap målt i antall ansatte, og alle våre\r\nmedarbeidere er tilknyttet gjennomføring av store viktige prosjekter så som\r\nTerminal-2 prosjektet ved Oslo Lufthavn Gardermoen, og Kulturbyggene i\r\nBjørvika med nytt Munch museet og nye Deichmanske bibliotek, og flere andre\r\nprosjekter.\r\n\r\nPå det nåværende tidspunkt ser vi derfor ingen mulighet til å gjennomføre en\r\nfirmapresentasjon for dere, og beklager dette, men ønsker å holde muligheten\r\nåpen for at vi evt. kan ta kontakt igjen om det skulle bli mulighet for å\r\nkomme og gi en slik presentasjon ved en senere anledning/semester.', 314, '2011-02-17 22:21:38'),
(162, 23, 'company', 'Kontaktperson:\r\n\r\nHanne Ottesen\r\nManager HR Recruitment\r\nhanne.ottesen@aibel.com\r\n\r\nAibel AS Vestre Svanholmen 14\r\nP.O. Box 300, Forus\r\nNO-4066 Stavanger\r\n\r\nTelefonnummer:\r\nDirect: 85 27 11 46\r\nMain: 85 27 00 00\r\nMobile: 91 52 44 40 ', 339, '2011-02-20 22:22:57'),
(163, 23, 'company', 'Aibel har erfart at de ikke har noe utbytte av å ha bedpresser og kommer derfor bare på karrieredager ol.', 339, '2011-02-20 22:23:47'),
(164, 78, 'company', 'Sendt mail til\r\n\r\ncontact@sptgroup.com\r\n\r\nForhåpentligvis vil jeg få utdelt en kontaktperson', 44, '2010-10-24 22:26:37'),
(165, 78, 'company', 'Sendt ny mail', 44, '2010-11-04 22:27:19'),
(166, 78, 'company', 'Kontaktperson:\r\n\r\nAslaug E. Thomassen\r\nHR Manager\r\nSPT Group Norway AS\r\nTel.  +47 63 89 04 57 / mob. +47 99 62 45 58\r\naslaug.thomassen@sptgroup.com \r\n\r\nVidrerformidler mailen. ', 44, '2010-12-13 22:28:02'),
(167, 78, 'company', 'Sendt ny mail, men ikke noe svar', 44, '2011-02-21 22:29:02'),
(168, 24, 'company', 'Kontaktpersoner:\r\n\r\nAstrid Hove -  astrid.hove@fks.fmcti.com\r\n\r\nTorgeir Lund Opgård - usikker på hvilken del av navnet som brukes i mailen, men er på samme måte som over.', 339, '2011-02-20 22:30:37'),
(169, 24, 'company', 'Legger til referatet frå 2008 angåande FMC\r\n\r\n""\r\nBedriftnavn: FMC\r\n\r\nAvdeling:\r\n\r\nTid for bed.pres:\r\n\r\nKontaktperson(er):  Kjersti Vinje\r\n\r\nEpostadresse:  Kjersti.Vinje@fks.fmcti.com\r\n\r\nTlf: +47 3228 7241\r\nMobil:\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nFMC Technologies er en av verdens ledende produsent og leverandør av subsea production systems.\r\n\r\nEier Kongsberg Subsea og SOFEC, og hjelper kunder å utnytte oljefelt ved å utvikle teknologi og/eller utføre kundestøtte.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordna bed.pres med dem:\r\n\r\nKom i kontakt ved mail, fikk beskjed om å ringe for å gi mer informasjon. De\r\n\r\nvar litt usikre på hybrida bedkoms stilling i forhold til f.eks TP,  men har hatt bra kontakt med dem siden skolestart 08. Ingen bedpres ennå, men de vet hvor de har oss, og sa de ville ta kontakt dersom de ville ta en ekstra tur høsten 08 (de hadde allerede ordnet et opplegg med TP >< )\r\n\r\
nDitt navn: Jørund Johansen \r\n""', 293, '2011-03-05 22:31:48'),
(170, 103, 'company', 'Gammel kontaktperson har visst sluttet, ringte sentralbord men hun visste ikke hvem jeg skulle settes over til, så jeg sendte til info@powel.no og satser på å få svar derfra inntil videre', 306, '2011-03-07 22:33:14'),
(171, 105, 'company', 'Bente Troen har sluttet i Schibsted, ringte sentralbord og fikk ny konaktperson som jeg har sendt mail.\r\n\r\nJonas Behrendt\r\n\r\nJonas.Behrendt@schibsted.no', 306, '2011-03-07 22:34:16'),
(172, 34, 'company', 'Vet ikke om det er riktig kontaktperson, men han svarte hvertfall (han var en av de som var med på presentasjonen for Aarhønen):\r\n\r\nPhilip Mitusch\r\nAvdelingsleder\r\nBygg og konstruksjonsteknikk\r\nTelefon: 67 12 84 32\r\nFaks: 67 12 81 45\r\nphilip.mitusch@sweco.no\r\n\r\n---------------------------------------------------------------------\r\n\r\nDe holdt som kjent en presentasjon for Aarhønen torsdag 21/10, representert med 5 personer fra konstruksjonsmiljøene på Lysaker (Oslo), Trondheim og Bergen. Der traff de også "enkelte studenter med studieretning Ingeniørvitenskap & IKT".\r\n\r\nDe vil ikke holde ny bedriftspresentasjon i år, men skal komme på Næringslivsdagene på vårparten.\r\n\r\nSiden han her bare jobba med bygg skal jeg skal sjekke med noen av de andre retningene før jeg legger Sweco helt død...', 314, '2011-01-11 22:35:17'),
(173, 34, 'company', 'Ringte personalsjefen (som tidligere ikke har svart på mail) og fikk beskjed om at nummeret ikke er i bruk.\r\nSer etter andre aktuelle kontaktpersoner.\r\n___\r\n\r\nKanskje Sweco MEC ( http://www.mec.no/ ) er interessant, særlig for marin og prosess (mulig også konstruksjon).\r\n\r\n"Det som i dag er SWECO MEC AS, ble startet i 1981, av 5 erfarne ingeniører fra Mandal. De første årene var det stor vekt på prosjekt og disiplinledelse, samt konstruksjon, mest rettet mot offshore og den maritime sektoren.\r\nI løpet av 90 tallet dreide oppgavene seg mer og mer om design, både innen mekanikk og prosessanlegg av alle slag. I de siste 10 årene, har SWECO MEC AS konsentrert seg om fagene prosess, styring og design, innen offshore og onshore prosessindustri. Vi har lang erfaring fra alle typer prosessanlegg, alt fra farmasi, via solcelle og metallurgi, til hydrokarbon anlegg."\r\n\r\n"SWECO MEC AS er også leverandør av designsoftware fra Bentley, og innehar alle nødvendige sertifiseringer for
levering, tilpassing og undervisning av programvaren, AutoPLANT "', 314, '2011-01-11 22:36:11'),
(174, 34, 'company', 'philip.pedersen@sweco.no står oppført som leder for Sweco Industry Norge samt som kontaktperson for Sweco MEC.\r\n\r\nSender ham en mail.', 314, '2011-01-11 22:37:08'),
(175, 34, 'company', 'Maste på sistnevnte, som nå svarte og sa han hadde videresendt dette til lysakerkontoret og kontaktperson Anne Sødem. Dette er samme personalsjef som nevnt i tidligere innlegg, så nå er jeg rundt.', 314, '2011-03-10 22:38:20'),
(176, 34, 'company', 'Virker som personalsjefen nå har sendt mailen min rundt til forskjellige avdelinger, så jeg fikk samme avslaget igjen fra bygg og konstruksjonsteknikk-avdelingen:\r\n\r\n******\r\nHei\r\n\r\nDe konstruksjonstekniske fagene i Sweco har bedriftspresentasjon hos linjeforeningen Århønen hver høst.\r\nVi er også representert på BM-Arena og Næringslivsdagene.\r\n\r\nVi har foreløpig ingen planer om å gjennomføre en bedriftspresentasjon for  masterstudiet Ingeniørvitenskap & IKT.\r\n\r\nMed Hilsen\r\n\r\nPhilip Mitusch\r\n*****\r\n\r\nHåper på å høre fra de andre avdelingene også, da det var de jeg var ute etter....', 314, '2011-03-11 22:39:09');
INSERT INTO `hyb_comment` (`id`, `parentId`, `parentType`, `content`, `authorId`, `timestamp`) VALUES
(177, 97, 'company', 'Kontaktperson Jan Petter Stenberg:\r\n\r\nJan.Petter.Stenberg@forsvarsbygg.no\r\n\r\ntlf: 924 25 576 \r\n\r\nHar snakket med han på tlf tidligere, sendte han mail, fikk ikke svar. RIngte på nytt i dag, han hadde ikke glemt oss og han hadde behandlet det men han som var ansvarlig var ikke på jobb atm.\r\n\r\nRinger meg i morra', 306, '2011-03-07 22:40:21'),
(178, 97, 'company', 'Kontaktperson er nå Terje Jensen\r\n\r\nTerje.Jensen@forsvarsbygg.no\r\n\r\ntlf: 91868601\r\n\r\nDe har gjort en avtale med Senter for eiendomsutvikling og -forvaltning her på NTNU, og mente det var tilstrekkelig inntill videre. De hadde behandlet det ganske seriøst og sa at de skulle ta kontakt om det skulle bli aktuelt seinere, så jeg tror ikke det er noe poeng å presse dem på en stund.', 306, '2011-03-16 22:41:11'),
(179, 72, 'company', 'Er litt usikker på hvor relevante de er for oss, men sendte mail til administrasjonsleder og håper på rett kontaktperson.', 279, '2011-01-10 22:42:52'),
(180, 72, 'company', 'Har ikke fått noe svar på mail, men ser at de har omtrent bare ingeniører som ansatte, og ingen utviklere... Tror derfor at vi er litt for flinke for dem...', 279, '2011-03-16 22:43:33'),
(181, 133, 'company', '4 Divisjoner: Infrastruktur, Industri, Energi, Teknologi. Særlig Industri og Teknologi virker veldig relevant for oss. Industri har blant annet et fagfelt som heter Industriell IT. (Divisjon Industry har en ledende posisjon innen prosessteknikk, automasjon, industriell IT, elektro og mekanisk engineering.)\r\n\r\nTre mulige måter å kontakte ÅF:\r\n\r\n(1)\r\nHvem har ansvar for rekruttering i ÅF i Norge?\r\n\r\nVi har ingen sentral rekrutteringsfunksjon i ÅF, da alle avdelingene rekrutterer sine konsulenter etter behov, med bistand fra HR. For alle henvendelser om rekruttering kan du kontakte vår HR-avdeling.\r\n\r\nHR-avdelingen kontaktes på: katarina.gutu@afconsult.com\r\n\r\n(2)\r\nÅF i Norge: http://www.afconsult.com/no/Kontakt/\r\n\r\n(3)\r\nPrate med folk på stand eller å være kreativ å finne på noe annet.\r\n\r\nAnbefaler å begynne med punkt 1.', 314, '2011-03-22 22:44:51'),
(182, 117, 'company', 'Har sendt mail til NECON via deres hjemmesider, og spurt om kontaktinformasjon til riktig person m.t.p. bedpress for oss. Venter på svar.', 354, '2011-03-20 22:45:59'),
(183, 117, 'company', 'Har sendt mail nå. venter på svar\r\n\r\nKontaktperson:\r\n\r\nEyvind Risnes\r\nRegional  Manager\r\n\r\nMobile: +47 99 08 58 00\r\nE-mail: eyvind.risnes@necon.no', 354, '2011-03-22 22:47:12'),
(184, 91, 'company', 'Den norske avdelingen er ikke relevant for oss.', 353, '2011-03-23 22:48:23'),
(185, 160, 'company', 'Fikk beskjed fra Skanska i dag:\r\n\r\n"Hei,\r\nVi skal ha bedriftspresentasjon på NTNU til høsten.\r\nDette kan være veldig aktuelt. Vi kan ta opp kontakten etter sommeren."\r\n\r\nKontaktperson:\r\n\r\nLiv Kluge Henriksen\r\nRekrutteringssjef\r\nSkanska Norge AS\r\nDrammensveien 60, PB 1175 Sentrum, 0107 Oslo\r\nMobil +47 98 21 09 85, faks +47 23 27 17 45\r\nE-post: liv.klugehenriksen@skanska.no', 357, '2011-03-24 22:49:52'),
(186, 157, 'company', 'Sendte mail til "christina.skorge@peab.no" og fikk dette svaret tilbake:\r\n\r\nHei igjen og takk for din forespørsel, tradisjonelt så rekrutterer vi kun fra Bygglinjene og har prioritert å holde bed.pres. for studentene på bygg og miljøteknikk. Det kan hende at det er tid for å utvide vår horisont litt. Jeg tar en runde på huset og kommer tilbake til deg om litt.\r\n\r\nMed vennlig hilsen\r\n________________________________________\r\n\r\nChristina Skorge\r\nPeab AS\r\nOpplæringsleder\r\nMobil:  +47 930 10 494\r\nBesøksadresse: Sørkedalsveien 148, 0754 Oslo\r\nPostadresse: Postboks 2909 Solli, 0230 Oslo\r\nSentralbord: +47 23 30 30 00 Faks: +47 23 30 30 01\r\nchristina.skorge@peab.no\r\nwww.peab.no\r\n________________________________________', 397, '2011-03-30 22:51:19'),
(187, 118, 'company', 'Vet ikke hvor aktuelle de er for oss, men har sendt mail til dem. Fant ikke mail til noen HR- og/eller administrasjonsansvarlige på deres hjemmesider, så sendte til deres hovedkontor. Venter på å få riktig kontaktperson.', 354, '2011-03-31 22:53:07'),
(188, 119, 'company', 'Har sendt mail til kontaktperson:\r\n\r\nHei,\r\n\r\nJeg er riktig kontaktperson for BedKom.\r\nDet er bare å sende informasjon til meg.\r\n\r\nJeg kan også nås på  92295220\r\n\r\nMvh\r\nBjarne Sanness \r\nSr. Rådgiver\r\nmail: bjarne.sanness@commitment.no', 354, '2011-04-01 22:54:24'),
(189, 158, 'company', 'Hei Kristian, \r\n\r\ntakk for tilbudet men det er dessverre ikke aktuelt for oss holde egen \r\nbedriftspresentasjon for dette studiet i denne omgang. \r\n\r\nVi ønsker dere lykke til videre. \r\n\r\nMed vennlig hilsen\r\nVy\r\n\r\nVy Mai ? Recruitment Senior Consultant ? PwC \r\nDronning Eufemiasgate 8 ? Postboks 748, Sentrum ? NO-0106 Oslo ? Norway\r\n( +47 95 26 03 16 * vy.mai@no.pwc.com \r\n\r\nPlease consider the impact on the environment before printing this e-mail \r\nand/or the attachment(s).', 397, '2011-04-01 22:55:40'),
(190, 151, 'company', '"Vi har bedrift presentasjon på NTNU gjennom Bindeleddet, og har dessverre ikke anledning til å holde flere i Trondheim.\r\n\r\nMvh Monica, HR"\r\n\r\nKontaktinfo:\r\nHR: HR@first.no', 357, '2011-04-04 22:57:20'),
(191, 151, 'company', 'Tror uansett ikke at First Securities er særlig relevante for oss i og med at de stort sett driver innen finans.', 357, '2011-04-04 22:58:36'),
(192, 131, 'company', 'Fikk svar i dag:\r\n\r\n"Hei\r\nTakk for henvendelsen. Vi har diskutert innholdet internt, og er på\r\ndette stadiet ikke interessert."', 356, '2011-04-04 22:59:42'),
(193, 128, 'company', 'Svar fra Siem WIS\r\n\r\n"Hei og takk for henvendelsen!\r\n\r\nJeg skal se på den, samt at jeg har videresendt den til sentrale personer innen salg og ledelse hos oss!\r\n\r\nHa en fin dag!"', 356, '2011-04-04 23:00:56'),
(194, 123, 'company', 'Ved kun forespørsel om kontaktperson, fikk jeg følgende svar idag fra Hamworthy idag:\r\n\r\nViser til din henvendelse vedr. bedriftspresentasjon.\r\nVi har gjennomført en bedriftspresentasjon for kjemilinjen på NTNU.\r\nVi har ingen planer om ytterligere presentasjon denne gangen.\r\n\r\nMed vennlig hilsen\r\nKarianne Ferstad \r\nemail: KFerstad@hamworthy.com', 354, '2011-04-04 23:02:18'),
(195, 89, 'company', 'Sendt mail til kontaktpersonen som stod på nettsidene.\r\n\r\nJørgen Hals\r\njorgen.hals@afgruppen.no', 279, '2011-01-10 23:03:42'),
(196, 89, 'company', 'De var muligens interessert i mailen jeg fikk for en stund siden, men svarte ikke på min. Har sendt purremail nå, hvor jeg hører om de er interessert i bedpres til høsten, og om vi skal ta kontakt med dem ijen da.', 279, '2011-03-16 23:04:38'),
(197, 89, 'company', 'Svar på purremail:\r\n\r\nJeg har sendt forespørsel internt om det er interesse for å være med på dette, og venter på svar. Dere skal få tilbakemelding såsnart vi har gjort en samlet vurdering.\r\n\r\nSamtidig kan jeg opplyse om at ny kontaktperson for dere i AF fremover vil være Sif Løvdal (sif.lovdal@afgruppen.no). ', 279, '2011-04-05 23:05:25'),
(198, 80, 'company', 'Kontaktperson:\r\n\r\nTor Andersen\r\nKontaktinfo:\r\ntor.andersen@ipres.com\r\nMobile +47  917 81 123\r\n--------------------------------\r\nVille ta en innledende prat, skal snakke med dem i dag 23. september.', 44, '2010-09-23 23:06:42'),
(199, 80, 'company', 'Snakket med Tor Andersen i dag og informerte han om linja, hvor mye penger vi tar og bespisning. IPRES er en liten bedrift så de ser for seg bare presentasjon for petroleum ca 20 stykker. Litt usikker på hvor mange vi er på petroleum nå? Han skulle sende meg en mail senere om de ville komme.', 44, '2010-09-23 23:07:35'),
(200, 80, 'company', 'Fekk oversikt frå Heine over fordelinga av studenter på dei ulike retningane no:\r\n\r\nPå petroleum har vi\r\n\r\n3. klasse: 12 personer\r\n4. klasse: 2 personer\r\n5. klasse: 1 person\r\n\r\nTil sammen 15 personer', 293, '2010-09-23 23:08:27'),
(201, 80, 'company', 'De vil gjerne komme i slutten av januar, men hadde muligheter i november. Skulle finne ut hvilke datoer det passer for oss? Når er det vi ikke kan?\r\n\r\nDet neste er at han gjerne vil ha en ny kontaktperson som faktisk holder til på NTNU fremover.', 44, '2010-09-30 23:09:09'),
(202, 80, 'company', 'Sidan dei gjerne ville ha kontaktperson på NTNU har eg latt Hege overta kontakta di med IPRES, sendte deg mail om dette.\r\n\r\nVidare held eg på å finne ledige datoa, men eg tenker vi heller har bedriftspresentasjon med dei i januar sidan dei helst ville dette.\r\n\r\nDermed får vi tid til 3 bedpressa no i haust, Asplan, Focus og Norconsult, viss alle svarer i tida og får tid til å booke dei.', 293, '2010-09-30 23:10:05'),
(203, 80, 'company', 'Den er god, sender Hege en mail med info i dag, godt jobba!', 44, '2010-09-30 23:10:42'),
(204, 80, 'company', 'De ønsker å ha presentasjon torsdag 20.januar. Prøver å få dem til å åpne for rundt 60stk, får se hva det blir til.', 279, '2010-11-24 23:11:34'),
(205, 80, 'company', 'Har ennå ikke fått bekreftet dato og antall, sendte mail i dag, ringer i morgen dersom ikke svar.', 279, '2011-01-10 23:12:36'),
(206, 80, 'company', 'De ønsker å ha presentasjon for petroleum og de som ikke har valgt ennå, altså 1. og 2. klasse, ca 60stk totalt. Deres AD holder foredraget, og det kommer i tillegg tre fra Trondheimkontoret. Datoen blir 27. januar.', 279, '2011-01-17 23:13:23'),
(207, 80, 'company', 'Utdrag frå visittkortet til Tor Andersen i IPRES:\r\n\r\n""\r\nTor Andersen, Manager IPRESOURCE\r\nIPRES Norway AS, Storgata 32, 0184 Oslo, Norway\r\n\r\nTelephone: +47 23 15 06 00\r\nTelefax: +47 23 15 06 01\r\nE-mail: ta@ipres.com\r\nMobile: +47 91 78 11 23\r\nwww.ipres.com\r\n\r\n----------------------------------------\r\n\r\nTor Andersen\r\nManager IPRESOURCE\r\nIPRES Norway AS, P.O.Box 1208 Pirsenteret, 7462 Trondheim, Norway\r\n\r\nTelephone: +47 73 54 64 34\r\nTelefax: +47 73 54 64 31\r\nE-mail: ta@ipres.com\r\nMobile: +47 91 78 11 23\r\nwww.ipres.com\r\n""', 293, '2011-01-27 23:14:43'),
(208, 80, 'company', 'Bedriftens navn:                            IPRES\r\nAvdeling:                                   Trondheim og hovedkontor\r\nTid for bed.pres:                           27.01.2011\r\n\r\nKontaktperson(er):                      Tor Andersen\r\nEpostadresse:                              tor.andersen@ipres.com\r\nTlf:                                                  +47 73 54 64 34 \r\nMobil:                                             +47  917 81 123\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nIPRES, Integrated Petroleum Resource and Economic Services, is an international company providing advanced software tools and services to the upstream petroleum industry.  We are focused on improvements to integrated decision support work processes for major upstream investments.\r\n\r\nLager programvare til oljeindustrien.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\n\r\nBle videresendt kontakten fra Anders da de var interessert. \r\n\r\
nDitt navn:\r\nHege Auglænd', 279, '2011-02-07 23:16:02'),
(209, 80, 'company', 'Svar på oppfølgingsmail: \r\n\r\nJo, vi var gått fornøyd med opplegget som sådan, men vi vil nok evaluere det litt senere på året når vi ser hva det eventuelt medfører av videre kontakt.\r\n\r\nUansett skalder det ikke å sende oss en forespørsel i neste runde og så tar vi det derfra.', 279, '2011-04-05 23:16:56'),
(210, 26, 'company', 'Fikk kontakt med tidligere IKT-student Knut Erik Teigen Giljarhus som mener at SINTEF Energi er interessert i bedpres. Han skal snakke med sin sjef og sender meg mail etterpå. ', 279, '2011-01-13 21:23:19'),
(211, 26, 'company', 'Ønsker bedpres før 1.mars, da har de frist for søknad til sommerjobb. Foreslo 22, 23 eller 24.feb. Ønsker å ha for produkt å prosess og 1. og 2.klasse.', 279, '2011-01-17 21:24:33'),
(212, 26, 'company', 'De ønsker presentasjon 22.feb med 70stk fra alle linjer. Har ikke noen preferanser ang mat, vil ha bonger til alkohol. Tidspunkt: 18.00, skal møte halvtime før.\r\n\r\nØnsker faktura til:\r\n\r\nSINTEF Energi, v/Mona J Mølnvik\r\n\r\nSem Sælandsvei 11\r\n\r\nPostboks 4761 Sluppen, 7465 Trondheim\r\n\r\nDe ønsker at vi informerer om at de har sommerjobbstillinger, og vil ha lagt til linken: http://www.sintef.no/Jobbe-i-SINTEF/Ledige-stillinger/SINTEF-Energi-Sommerjobbprosjektet-2011/\r\n\r\nSøknadsfristen har blitt endret til 21.02, men de tar også imot søknader etter fristen, ønsker å få dette uthevet i påmeldingen.', 279, '2011-02-09 21:25:15'),
(213, 26, 'company', 'Referat for kontakt med bedriftene\r\n\r\nBedriftens navn:  Sintef Energi\r\n\r\nTid for bed.pres: 22.02.2011\r\n\r\nKontaktperson(er): Knut Erik Teigen Giljarhus evt Mona J Mølnvik\r\n\r\nEpostadresse: knutert@gmail.com\r\nTlf: \r\nMobil:\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nVi utvikler løsninger knyttet til kraftproduksjon og omforming, overføring/distribusjon og sluttbruk av energi onshore og offshore/subsea.\r\n\r\nVi arbeider med alt fra innemiljø og energibruk i bygninger til gassteknologi, forbrenning, bioenergi, kuldeteknikk samt termisk prosessering av næringsmidler.\r\n \r\nBruker en del programmering for å simulere og regne på strømninger ol.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\n\r\nKnut Erik er tidligere IKT-er, og sa at de var interessert da jeg tok kontakt i forbindelse med Alumni-listene. \r\n\r\nDitt navn: Hege Auglænd', 279, '2011-03-16 21:26:10'),
(214, 26, 'company', 'Svar på oppfølgingsmail:\r\n\r\nTakk for tilbakemelding. Håper å se flere hybrider i SINTEF Energi\r\netterhvert!', 279, '2011-04-05 21:27:02'),
(215, 161, 'company', 'Kjerstin Bretteville-Jensen\r\nAvdelingsdirektør HR-seksjonen\r\nkjerstin.bretteville-jensen@vegvesen.no\r\n\r\nSvar:\r\n\r\n"\r\nHei Kristian!\r\nTakk for henvendelsen. Alltid morsomt når noen er opptatt av Statens vegvesen.\r\nJeg skal sjekke litt i vår organisasjon, så skal du høre fra oss.\r\n \r\nHilsen\r\nKjerstin\r\n"', 397, '2011-04-06 21:27:58'),
(216, 121, 'company', 'Sendte mail Aptomar den 3. april. Fikk svar idag:\r\n\r\nHei,\r\n\r\nDen er sendt videre til vår CFO men han er på to ukers reise.\r\n\r\nMvh / Best Regards\r\nAptomar AS\r\nLene K Vaagan \r\nOffice Manager', 354, '2011-04-07 21:29:33'),
(217, 135, 'company', 'Fikk følgende svar:\r\n\r\n"I''ll get back to you shortly but yes, we can see the advantages of this too.\r\nRegards\r\nDebra Page"', 356, '2011-04-07 21:30:28'),
(218, 71, 'company', 'Sendt mail til contact@conocophillips.com .Forhåpentligvis kommer jeg i kontakt med riktig person.', 44, '2010-11-04 21:31:27'),
(219, 71, 'company', 'Sendt purremail', 44, '2010-11-19 21:32:05'),
(220, 71, 'company', 'Ringt sentralbordet ble da satt over til Elsa kinstad. Hun var ikke tilstede. La derfor  igjen tlf melding om å kontakte meg på mail. Dette har da ikke skjedd.', 44, '2011-02-21 21:36:11'),
(221, 71, 'company', 'Andrea Sunde er kontaktperson for sommerprosjektet til conocophillips, det går kanskje an å prøve å sende til andrea.sunde@conocophillips.com ?', 279, '2011-04-07 21:37:47'),
(222, 154, 'company', 'Fikk følgende svar fra McKinsey idag:\r\n\r\nHei Erlend,\r\n\r\nTusen takk for henvendelsen.\r\nVi holder kun en presentasjon på NTNU nå og den holdes gjennom \r\nBindeleddet.\r\nDet er der mulig for en del andre sivilingeniør-linjer å melde seg opp på \r\nbedriftspresentasjon gjennom deres påmeldingssystem.\r\nVi har dessverre ikke mulighet til å arrangere flere \r\nbedriftspresentasjoner på NTNU, men ønsker dere lykke til med deres \r\narbeid. \r\n\r\nRegards,\r\nKaja Rutgerson\r\nRecruiter\r\n_________________________________\r\nPH. +4722862555  Mobile: +4790657507\r\nkaja_rutgerson@mckinsey.com', 354, '2011-04-11 21:39:58'),
(223, 148, 'company', 'Fikk svar fra BKK 26. april:\r\n\r\n"Hei!\r\nJeg har fått videresendt denne mailen fra Kjell Breisnes hos oss.\r\nVi må nok takke nei i denne omgang, da dere dessverre ikke er direkte i vår målgruppe.Vi samarbeider i hovedsak med EMIL og Næringslivsringen, men jeg vil ta vare på kontakt info deres, og evt gi et ord om det vil være av interesse for oss på et senere tidspunkt.\r\n\r\nMed vennlig hilsen\r\nTrude Kremner"\r\n\r\nTrude Kremner\r\nOrganisasjonskonsulent\r\nTrude.Kremner@bkk.no', 357, '2011-05-01 21:41:17'),
(224, 33, 'company', 'Har sendt forespørsel via et skjema for profilering på deres nettside. Sendte også en mail til tidligere IKT student Kjetil Bjørke som jobber i Statoil, og spurte om han trodde de ville være interesserte og litt om hva han gjorde i statoil. Han svarte og videresendte den mailen  til en som heter Berit Frantzen i Statoil.', 354, '2011-04-18 21:42:33'),
(225, 33, 'company', 'Fikk svar fra Statoil idag ang. bedriftspresentasjon fra mailadresse TONGR@statoil.com. Fra tidligere I&IKT student Kjetil Bjørke i Statoil fikk jeg mail om at det er en dame ved navn Anne Mari Berge Sperrevik som har med bedpress på universiteter å gjøre. \r\n\r\nHi,\r\n\r\nThank you for your invitation.\r\n\r\nStatoil receives numerous invitations for attending fairs, presentations and conferences. We would like to respond positively to your request; however, we are sorry to decline your invitation this time. We welcome you to invite us on another occasion, and kindly ask you to do so in due time before the event.\r\n\r\nKind regards,\r\nStatoil ASA', 354, '2011-05-02 21:43:23'),
(226, 102, 'company', 'Her er svaret jeg fikk fra NOV, etter å ha presentert resultatet fra interesseundersøkelsen.\r\n\r\n"\r\nHei,\r\n\r\nTakk for mail.\r\n\r\nJeg tror vi avventer dette litt pga behov for å se på en totaloversikt på hvor og når vi skal holde bedriftspresentasjoner.\r\nVi holder på å etablere oss i Trondheim og forhåpentligvis kan vi etterhvert få ansatte derfra til å ta presentasjoner mot utdanningsinstitusjoner i Trondheim.\r\n\r\nMvh\r\nMarianne Valle\r\n"', 356, '2011-06-22 21:44:45'),
(227, 88, 'company', 'Har sendt en e-post til HR. Fikk auto-post tilbake med melding om at dei kjem til å sjå på e-posten en gang.', 339, '2011-08-10 21:45:57'),
(228, 20, 'company', 'Sendte mail til email@odfjelldrilling.com, men fikk kun automail tilbake.', 339, '2011-01-11 21:47:08'),
(229, 20, 'company', 'Har prøvd å ringe, men har ikkje fått svar.', 339, '2011-04-06 21:48:34'),
(230, 20, 'company', 'Nettsida er nede.', 339, '2011-08-10 21:49:08'),
(231, 20, 'company', 'Nettsida er oppe igjen, mn får berre automail om at eg må ta kontakt på en anna plass.', 339, '2011-08-10 21:49:43'),
(232, 54, 'company', 'Fikk svar:\r\n\r\nJeg kan stille for å holde bedriftpresentasjon for I&IKT. Jeg er godt kjent med studieretningen fra min deltidsstilling på IPT hvor jeg bl.a. foreleser faget TPG4162 3D Visualisering av Petroleumsdata.\r\n\r\nMå finne tidspunkt som passer. Er det noe tidspunkt som du tenker på i så måte?\r\n\r\nMed hilsen\r\nStein Dale\r\n____________________________________________\r\nStein Dale, Technical Director\r\nCeetron AS\r\nP.O.Box 1247, Sluppen\r\nN-7462 Trondheim, Norway\r\nBusiness telephone: +47 7354 6150\r\nDirect telephone: +47 7354 6116\r\nFax: +47 7354 6144\r\nE-mail: stein.inge.dale@ceetron.com', 339, '2011-08-10 21:51:04'),
(233, 54, 'company', 'Tidspunkt for presentasjon tenker eg er som vanleg på kvelden, typisk kl. 18 om kvelden.\r\n\r\nBlant datoer vil nok datoer i veke 38 passe bra, til dømes 20., 21. og 22. september.\r\n\r\nI veke 37 er det karrieredag og i 36 er det planlagt galla for Hybrida. Den 27. september i veke 39 er det planlagt presentasjon med Capgemini.\r\n\r\nDu kan også følge opp med å spørre om kva opplegg han kan tenke seg for presentasjonen og om han er kjent med opplegget rundt ein presentasjon. Gjerne planlegg i forhold til sjekklista for kva som skal vere på plass før ein presentasjon.', 293, '2011-08-10 21:52:40'),
(234, 54, 'company', 'Sendt svar no', 339, '2011-08-11 21:53:25'),
(235, 63, 'company', 'Har sendt forespørsel på deres nettside, får forhåpentligvis kontaktperson.', 348, '2010-12-30 21:54:21'),
(236, 63, 'company', 'Glemte å oppdatere tidligere i vår. Sendte mail på deres hjemmesider i slutten av mars/start april, og fikk autosvar. Mailen fra dem sa bare at de skulle kontakte hvis beskjeden jeg skrev omhandlet noe annet enn en jobb i Hydro. Har ikke fått noen ny mail fra dem.', 354, '2011-08-14 21:55:00'),
(237, 92, 'company', 'Skulle sende mail fra nettsiden, men kontaktskjemaet deres ser ut til å være nede. Prøver igjen senere', 348, '2010-12-30 21:55:53'),
(238, 92, 'company', 'Mener jeg skal ha et visittkort liggende i Trondheim hvis du er interessert i en kontaktperson. Ikke sikkert det er rett person å kontakte, men kan være verdt et forsøk. Fikk det på BMdagen..', 314, '2010-12-30 21:56:29'),
(239, 92, 'company', 'Det hadde vært supert! Bare post det her når du finner det :)', 348, '2010-12-31 21:57:06'),
(240, 92, 'company', 'Øyvind Aass\r\noyvind.aass@karehagen.no\r\n67 58 18 70\r\n92 87 68 60', 314, '2011-01-08 21:57:38'),
(241, 92, 'company', 'Takk for kontaktinformasjon Ellen, mail er nå sendt! :)', 348, '2011-01-12 21:58:15'),
(242, 92, 'company', 'Glemte å oppdatere status i våres. Sendte en mail til mailadressen Ellen nevner over 6. april. Fikk ikke svar, og det funket ikke å sende beskjed via deres skjema på hjemmesiden. Men det funket nå.', 354, '2011-08-18 21:59:03'),
(243, 92, 'company', 'Fikk svar fra Øyvind Aass idag.\r\n\r\nHei Erlend\r\n\r\nVi har i dag et godt samarbeid med H.M. Aarhønen, og det er dette kontaktpunktet vi ønsker å bruke for å komme i kontakt med studentene ved NTNU. Det er linjene innenfor bygg- og anleggsteknikk, slik som prosjektledelse, som er mest relevante for Kåre Hagen. \r\n\r\nMed vennlig hilsen \r\nØyvind Aass\r\nE-post: oyvind.aass@karehagen.no\r\nTlf.: 928 76 860', 354, '2011-08-19 22:00:06'),
(244, 92, 'company', 'Så det var et høflig nei med andre ord?', 293, '2011-08-19 22:00:48'),
(245, 92, 'company', 'Ja, vil si det.', 354, '2011-08-19 22:01:35'),
(246, 142, 'company', 'Fikk svar fra Halliburton i dag:\r\n\r\n"\r\nTakk for forespørsel. Jeg sender din forespørsel videre til de enkelte avdelinger, så vil du bli kontaktet."\r\n\r\nKontaktinfo:\r\n\r\nAnita Molversmyr\r\nTalent Management & Acquisition Specialist\r\nHalliburton AS\r\nEldfiskvegen 1, 4056 Tananger- Norway\r\nP.b 200, 4065 Stavanger- Norway\r\nSentralbord 51 83 70 00\r\nDir  51 83 72 68\r\nMob +47 944 999 16\r\nFax 51 83 83 83\r\nMail: anita.molversmyr@halliburton.com', 357, '2011-04-04 22:07:53'),
(247, 142, 'company', 'Fikk svar fra Anita Molversmyr 8. april:\r\n\r\n"Business Development avdelingen hos oss er interessert i å komme i kontakt med dere for en eventuell bedriftspresentasjon."\r\n\r\nNy kontaktperson:\r\n\r\nJohn Jakobsen\r\njohn.jakobsen@halliburton.com\r\nTlf: 4751837647\r\nMobil: 4795103036\r\n\r\nSendte mail i dag og venter på svar.', 357, '2011-05-01 22:08:52'),
(248, 142, 'company', 'Positivt svar frå John Jakobsen i dag:\r\n\r\n"Vi har sett på forespørselen din og er åpne for å gå videre med saken. Jeg skal drøfte det litt mer internt, så kommer jeg tilbake til deg. \r\n\r\nMvh\r\nJohn Jakobsen\r\nSr. Market & Business Analyst\r\nHalliburton\r\nEldfiskveien 1\r\n4056 Tananger\r\nMob: +47 951 03 036\r\nOffice: +47 5183 7647"', 357, '2011-05-02 22:09:35'),
(249, 142, 'company', 'John Jacobsen har slutta i Halliburton.\r\n\r\nNy kontaktperson:\r\n\r\nBaiba Ozola\r\nMarket&Business Analyst\r\nHalliburton\r\nNorway\r\nPipeline & Process Services\r\nEldfiskveien 1, Tananger\r\nPostbox 200 4065 Stavanger\r\nOffice phone: +47 51 83 75 19\r\n\r\nHar sendt mail i dag etter at jeg fikk mail nå i august om de er veldig interesserte i en presentasjon i høst.', 357, '2011-08-19 22:10:16'),
(250, 85, 'company', 'Har sendt forespørsel på deres nettside, får forhåpentligvis kontaktperson.', 348, '2010-12-30 22:11:14'),
(251, 85, 'company', 'Fikk svar som sa at personen var borte fra kontoret frem til 03.01.11. Venter litt til før jeg sender ny mail.', 348, '2011-01-05 22:12:04'),
(252, 85, 'company', 'Har sendt ny mail til følgende person: \r\n\r\nThomas Aas Sæthre\r\nSAETHO@agr.com\r\n\r\nDette er personen Thor-Andre fikk autosvar fra tidligere', 354, '2011-04-18 22:12:35'),
(253, 85, 'company', 'Fikk svar idag:\r\n\r\n"Hei Erlend,\r\n\r\nVi kommer til å holde bedriftspresentasjon på NTNU i samarbeid med linjeforeningen for Marin teknikk denne høsten.\r\n\r\nTakk for din interesse.\r\n\r\nMvh\r\nThomas"\r\n\r\nM.a.o. et høflig nei.', 354, '2011-08-22 22:13:21'),
(254, 77, 'company', 'Først kontakt 12. oktober, sendt purremail 25. og har nå fått en ny kontaktperson.\r\n\r\nThorn Fredrik Hemsen (thorn.fredrik.hemsen@multiconsult.no +47 97166369)\r\n\r\nHan er fraværende atm, men leser mailz, så vi får se hvordan det blir.', 306, '2010-10-19 22:14:20'),
(255, 77, 'company', 'Han nekter å ta telefonen i lunch, ringer han i morra...', 306, '2011-01-13 22:15:07'),
(256, 77, 'company', 'Etter litt press har jeg fått noe kontakter, sendt dem mail.\r\n\r\nFredrik W. Thele og Erlend Bæra\r\n\r\nfredrik.w.thele@multiconsult.no,\r\neivind.j.baera@multiconsult.no', 306, '2011-04-06 22:15:46'),
(257, 77, 'company', 'Sendt ny mail til Fredrik', 353, '2011-09-08 22:16:23'),
(258, 74, 'company', 'Sendt mail til kontaktperson fra IAESTE-dagene\r\n\r\nKristina.Dahlberg@dnv.com', 353, '2011-09-08 22:17:54'),
(259, 9, 'company', 'Kontaktperson:\r\nDag-Olaf Ringe\r\ndag-olaf.ringe@ep.total.no\r\n\r\nHandlingsforløp:\r\n\r\nsendt mail 28. februar, fikk svar 30. mars(!) om at han har vært syk og at de var interesserte til høsten. I siste mailen jeg mottok sto det:\r\n\r\n"Ja , kom tilbake da det nærmer seg". \r\n\r\naltså bør han kontaktes rett etter sommerferien for å faktisk sette dato og ting.', 306, '2011-03-30 22:18:58'),
(260, 9, 'company', 'Sendt ny mail for å høre om han fortsatt er interessert.', 353, '2011-09-08 22:19:35'),
(261, 36, 'company', 'yo. Sendt mail 3. ganger til en kontaktperson, har ikke funnet en måte  å få tak i nummeret hans, så om jeg ikke får svar nå må jeg bare ringe sentralbordet og be om å bli satt over.\r\n\r\nSist kontaktet 19. okt\r\n\r\nPetter Andreas Berg (petter.berg@tieto.com)', 306, '2010-10-19 22:22:36'),
(262, 36, 'company', 'Ringt sentralbord, ny kontakt\r\n\r\nJarle Holtet\r\nJarle.Holtet@tieto.com ', 306, '2011-01-13 22:23:17'),
(263, 36, 'company', 'Svar fra Jarle, han sa det var litt mye akkurat nå også lurte han på om det var noen kostnad forbundet med en slik presentasjon. sendt mail med svar', 306, '2011-01-21 22:24:02'),
(264, 36, 'company', 'Sendt mail til Jarle en gang til.', 353, '2011-09-08 22:24:38'),
(265, 30, 'company', 'Ikke relevant atm., holder på å ta over minst en relevant bedrift nå. Tar opp igjen kontakt senere, når dette er gjennomført.', 353, '2011-01-17 22:25:36'),
(266, 30, 'company', 'Ikke relevant atm., holder på å  ta over minst en relevant bedrift nå. Tar opp igjen kontakt senere, når dette er gjennomført.', 353, '2011-09-08 22:26:07'),
(267, 30, 'company', 'Offisiell kontaktperson er:\r\n\r\nBjørn Schulstock\r\nbjorn.schulstock@ergogroup.no\r\n958 32 738', 353, '2011-09-08 22:27:13'),
(268, 86, 'company', 'kontaktperson Kjell Arne Danielsen\r\ntlf:95832023\r\nKAD@kgjs.no\r\n\r\nRingt han før, da sa han at han skulle se på mailen min. Tok ikke telefonen når jeg ringte i dag, prøver i morra og sender en ny mail nå. ', 306, '2011-03-07 22:28:04'),
(269, 86, 'company', 'Fått ordentlig svar, de kjente til prosessen og er interesserte, men lurte på om det var bortkasta mtp at det antakelig ikke ble noen nyansettelser i løpet av 2011.\r\n\r\nGa han et svar og han svarte:\r\n\r\n"Jeg skal drøfte det litt med vår prosjekt og IKT sjef og se om det kunne være av interesse å kjøre et felles opplegg. Kommer tilbake til deg på det."', 306, '2011-03-09 22:28:46'),
(270, 86, 'company', '"Hei igjen, \r\n\r\nDa har jeg drøftet dette nærmere med vår Prosjekt Direktør og vår IT Direktør. \r\n\r\nDe er enige om at det kunne vært interessant å kjørt et felles opplegg for begge grupper. Dersom dere kan komme tilbake med et forslag til tid og sted, så skal vi se litt nærmere på et program forslag samt grove trekk på hva innholdet i selve presentasjonen kan være."\r\n\r\nVel, forslag til hva jeg skal svare? Skal vi ta kontakt med Marin for å høre eller er det bare å avtale en tid som passer oss?', 306, '2011-04-07 22:29:36'),
(271, 86, 'company', 'Eigentleg skal eit slikt opplegg der presentasjonen holdast for begge linjene gjennomførast av Teknologiporten etter reglane vi har med dei per i dag. Den samme situasjonen har vi med ei anna bedrift no, Sub Sea Services, som Kristian kontakter. Saka no er at vi forhandler med TP om desse reglane no, og det er ein mulighet for at vi får anledning til å arrangere presentasjoner for 2 linjer uten at TP overtar kontrollen for oss. Desse reglane er som sagt under forhandling, men det vil vere dumt av oss å gje frå oss slike kontakter før reglane er ferdig forhandla.\r\n\r\nDet virker som verken vi eller KGJS har tatt kontakt med marin om denne presentasjon, vi venter med å ta kontakt med marin om dette til dei nye reglane er på plass. Vi blir desverre nødt til å sette vår kontakt med KGJS på vent inntil vidare. Dette liker eg sjølvsagt ikkje, for eg meiner vi må ta godt vare på slike kontakter vi har ein god dialog med. Vi blir altså nødt til å fortelle dei at vi setter dei på vent og marin
er i samme situasjon då dei også er ein del av TP, det er om å gjere å fortelle dette på ein måte som verken setter oss eller TP i eit dårleg lys.\r\n\r\nDu kan også fortelle dei at vi er i ein dialog med marin, då eg treffer bedriftskomitesjefen på marin på møta med TP. Eg kan ta kontakt med han og forklare situasjonen, då vi begge veit kva saka går i. Eg tenker han vil vere einig med meg om å sette kontakta på vent.', 293, '2011-04-07 22:30:22'),
(272, 86, 'company', 'Ok, det gjør det jo litt vanskeligere. Hvor lang tid vil forhandlingen med TP ta?\r\n\r\nDet er ikke noe problem å si til dem at vi må vente litt fordi vi ikke har noen klar avtale på hvordan vi skal gjøre det med linjesamarbeid, men jeg har ikke lyst til å få dem til å vurderer å droppe hos helt ved at de synes det blir for mye rot. Er det virkelig noen klar regel på at vi ikke har lov til dette? Vi hadde jo tidligere en bedpres der vi inviterte fra Ind.Design, maskin og bygg(?), og det gikk jo bra?', 306, '2011-04-07 22:31:02'),
(273, 86, 'company', 'Etter mykje fram og tilbake med KGJS har vi blitt einige om å reservere datoen 22.09. for ein presentasjon med dei.\r\n\r\nPresentasjonen blir avholdt i samarbeid med Marin Teknikk og skjer på Gløshaugen.\r\n \r\nKGJS kjem tilbake med forslag til opplegg.', 293, '2011-08-19 22:31:52'),
(274, 86, 'company', 'Referat for kontakt med bedriftene\r\n\r\nBedriftens navn: Kristian Gerhard Jebsen Skipsrederi (KGJS)\r\n\r\nAvdeling:\r\n\r\nTid for bed.pres: 22.09.2011 kl. 18.15\r\n\r\nKontaktperson(er): Kjell-Arne Danielsen, Vice President HR Shore\r\n\r\nEpostadresse: Kjell-Arne.Danielsen@kgjs.no\r\n\r\nTlf: + 47 55 17 53 13\r\n\r\nMobil: + 47 95 83 20 23\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nBedrifta passer for I&IKT-Marin. KGJS driver med rederivirksomhet, men har også avdeling for prosjektingeniører og ei IT-avdeling som driver med vedlikehold og utvikling for KGJS-konsernet, dette gjer den relevant for I&IKT.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\n\r\nBedrifta var henta frå kontaktlista til Marin Teknikk i 2009, dei hadde presentasjon med KGJS då. KGJS kjem regelmessig til Tyholt.\r\n\r\nSnorre hadde opprinnelig kontakta med dei og oppnådde dialog, men dato var ikkje spikra før han slutta i komiteen før sommeren.\r\n\r\
nDerfor tok eg over ansvaret for kontakta vidare, dette var eigentleg like greitt sidan eg også hadde kontakta med BK-Marin på Marin Teknikk.\r\n\r\nVed hjelp av BK-Marin vart dette ein felles presentasjon med I&IKT-Marin og Marin Teknikk. Deltakelsen frå Marin Teknikk gjorde at vi vart nok besøkande til å rettferdiggjøre ein presentasjon. \r\n\r\nVi deler inntektene frå presentasjonen likt med BK-Marin.\r\n\r\nFor å ordne bed.pres måtte eg sende ein god del mailer fram og tilbake og datoen vart til slutt satt i månedsskiftet august/september.\r\n\r\nDitt navn: Frans Erstad', 293, '2011-09-23 22:32:50'),
(275, 86, 'company', 'Utdrag frå visittkortet til Jan A. Berntzen i KGJS:\r\n\r\n""\r\nJan A. Berntzen, Vice President, Technical/ Project\r\nTel: 55 17 51 00\r\nDir: 55 17 51 57\r\nMob: 97 57 11 45\r\nE-mail: jab@kgjs.no\r\n\r\nKristian Gerhard Jebsen Skipsrederi A/S\r\nFolke Bernadottes Vei 38\r\n5147 Fyllingsdalen, Bergen, Norway\r\nTelefax: 55 17 53 95\r\nwww.kgjs.no\r\n""', 293, '2011-09-29 22:33:34'),
(276, 144, 'company', 'Rolls Royce var ikkje interessert akkurat nå, men vi kan kontakte dei på nytt seinare.\r\n\r\nKontakt:\r\n\r\nMonika Persson\r\nEarly Career Recruitment Advisor\r\nResourcing & Development Centre of Excellence\r\n\r\nRolls Royce Marine AS\r\nTel: +47 70235037 Fax: +47 70103703 \r\nMobile: +47 90890371\r\nEmail: monika.persson@rolls-royce,com\r\nMailing Address: Rolls-Royce Marine, Postboks 1522, N-6025 Ålesund', 357, '2011-10-06 22:34:33'),
(277, 3, 'company', 'Bedrifta tok kontakt med oss i jula 2010, det vil vere mest aktuelt for oss å ha besøk av dei høsten 2012 slik det ser ut i skrivende stund.\r\n\r\nKontaktinfo:\r\nMagnus Stoveland - Tidligere IKT-er\r\n\r\n""\r\nGrunnen til at jeg tar kontakt er at vi trenger flere IKTere der jeg jobber, i Star Information Systems.\r\n\r\nVi ser spesielt etter kandidater med spesialisering innenfor Marine Systemer.\r\nHvilken spesialisering er det du tar? Vet du om det er noen som går Marine Systemer i 4. eller 5. ?\r\n\r\nDet vil nok også være aktuelt å holde en presentasjon i regi av Hybrida.\r\nArtig å se at hybrida.no som jeg engang laget kjører enda.. \r\n\r\nStar Information Systems - Ship & Rig Management Software\r\nhttp://www.facebook.com/l/RAQEagSPDAQH3lLN3ntKEdx7tPRTfnGuojPykmEQe4v3FMw/www.sismarine.com\r\n""', 293, '2012-01-23 22:38:26'),
(278, 79, 'company', 'Hei, Rune!\r\n\r\nBeklager sent svar - har ventet på en anledning til å ta dette opp med hele ledelsen samlet, og i dag har vi hatt ledermøte og bl.a. diskutert høstens bed.pres.-aktiviteter. Vi skal til Trondheim i uke 39, og skal ha bed.pres. for Marin 27/7 og på Gløshaugen (fortrinnsvis for studenter på maskin, bygg (jeg bruker de gamle betegnelsene, jeg ;) og din linje) 29/7.\r\n\r\nDet kan godt hende at vi skal kjøre en separat for Ing.vitenskap og IKT, men før vi bestemmer oss for dette, kunne det være greit å få vite litt mer om hvor mange dere er. Kan du fortelle meg mer om dette?\r\n\r\nHvis du kan si noe om hvor mange det er på hvert kull, og hvor mange det er på de forskjellige spesialiseringene, ville det vært fint. Vi er jo primært interessert i dem som har en relevant ingeniørspesialisering i kombinasjon med IKT-delen, så som bygg, maskin, marin og evt. petroleumsfag og energi og miljø.\r\n\r\nHvis vi bestemmer oss for å kjøre en separat bed.pres. - ville da være mulig å
få den 28/9?\r\n\r\nVi snakkes, Bente\r\n\r\nBEST REGARDS/VENNLIG HILSEN FOR 4SUBSEA AS\r\nBENTE G. SOLBAKKEN ADMINISTRATION MANAGER SIV.ØK. [cid:image001.png@01CC673D.0A7BE720]\r\nBENTE.SOLBAKKEN@4SUBSEA.COM\r\nSMEDSVINGEN 4, N-1395 HVALSTAD NORWAY P.O. BOX 99, N-1378 NESBRU, NORWAY ', 339, '2011-08-31 10:47:30'),
(279, 79, 'company', 'Vi har planlagt en presentasjon med Capgemini den 27.09..\r\n\r\nI helga 30.09. - 02.10. har styret planlagt Rørostur for Hybrida med hovedvekt på 1. klasse.\r\n\r\nVi kan arrangere presentasjonen den 28.09., i så fall lar eg to ulike grupper personer ver på jobb dei to ulike dagane. Slik at ingen jobber to dager i strekk. Vi kan svare at det er mulig den 28.09.\r\n\r\nEit alternativ for oss hadde vore å slå oss sammen med Teknologiportens presentasjon den 29.09. som Bente nevner. Eg trur dette vil vere uheldig for oss, fordi vi som I&IKT studenter vil då forsvinne i mengden av Maskin og Bygg studenter, i tillegg til at presentasjonen har en fare for å bli for generell.\r\n\r\nDerfor meiner eg det er best vi arrangerer sjølve. 4Subsea har også bedt om å få holde for ei stor gruppe studenter og viss vi i tillegg får lov til å ta med 1. og 2. klasse er vi heilt sikkert mange nok.\r\n\r\nDu finner informasjon om fordelingane innanfor dei ulike spesialiseringane i klasselistene som nylig er
lagt ut på itsern. Der finner du antalla som dei spør etter.\r\n\r\nDu bør også svare dei med ei anmodning om at vi trenger ein bekreftelse nokså kjapt med tanke på bestillinger.\r\n\r\nGje beskjed så kjapt du får svar, men plx bruk fleire mellomrom i teksten ;)', 293, '2011-08-31 10:49:00'),
(280, 79, 'company', 'Sendt svar med en komplett liste over studenttala våre. Beklager mellomroms-mangel, men tok copy/paste, og slik kom da altså ut. Og umulig å endre det til noke bedre.', 339, '2011-08-31 10:50:00'),
(281, 79, 'company', 'Hei igjen, Rune!\r\n\r\nDa har vi tenkt, og bestemt oss for at vi kommer en tur den 28/9. Vi skal ha et planleggingsmøte på fredag, og jeg kommer tilbake til deg med detaljer etter det. OK?\r\n\r\nBente', 339, '2011-09-05 10:53:27'),
(282, 79, 'company', 'Meget bra, det er ok for meg vertfall.\r\n\r\nVi begynnner allerede å bestille nødvendigheter, eg har allereie bestilt auditorium for nokre dager sidan.\r\n\r\nPass på at du får med deg punkta som står på sjekklista når du går gjennom detaljane med bedrifta.\r\n\r\nEg fiksa mellomrom i det første innlegget ditt forresten ;)', 293, '2011-09-05 10:55:24'),
(283, 79, 'company', 'Hei, Rune!\r\n\r\nVi begynner nå å bli klare, og her kommer noen flere detaljer etter vårt planleggingsmøte:\r\n\r\nVi ønsker alle kull velkommen til vår bed.pres., men i den grad det kan styres, vil vi gjerne at deltagerne styres slik at 4. og 5. klasse har første prioritet, deretter 3., 2. og 1. Vi vil nødig at 4. og 5. klassinger ikke skal få plass pga sterk pågang fra 1. klassingene!\r\n\r\n· Av spesialiseringene er jo både bygg, maskin, marin og til dels petroleum (hvis ikke de bare er under havbunnen ;) - vi jobber stort sett ikke lenger ned enn til brønnhodet) - geomatikk er nok litt på siden av det vi driver med.\r\n\r\n· Vi holder nok fast ved pizza-alternativet uansett antall deltagere; det er enkelt og raskt å spise slik at vi kommer i gang med øvrige aktiviteter under samlingen etterpå ;). Øl og brus ønsker vi selvfølgelig også.\r\n\r\n· Vi kommer nok til å sende oppover egne plakater og flyers, og håper dere vil være behjelpelige med å distribuere dette.\r\n\r\n· Jeg kommer
til å trenge et grupperom til speedintervjuer dagen etter, og håper du kan hjelpe meg med det. Trenger det fra 7:30 til 16, tenker jeg.\r\n\r\nHåper dette var tilstrekkelig så langt - vi gleder oss til å komme på besøk!\r\n\r\nBente ', 339, '2011-09-05 10:56:33'),
(284, 79, 'company', 'Mailen eg sendte tebake...\r\n\r\nHei\r\n\r\nVi åpner da for 80 personer til presentasjonen. Dersom det skulle skje at noen i 4 eller 5 ikke kommer med som ønsker det, så skal vi sørge for at de gjør det.\r\n\r\nDu kan sende plakater og flyers til meg, så skal jeg sørge for at det kommer på plass. Adressen min er: Rune Lunde Heggebø, Nardovegen 6, 7032 Trondheim.\r\n\r\nVi trenger å vite hvordan dere ønsker å betale. Vi sender dere faktura for presentasjonen, men dere kan velge om dere vil betale for maten under presentasjonen, eller om vi skal inkludere den i fakturaen. Dersom dere betaler for maten under presentasjonen er den momsfri.\r\n\r\nPresentasjonen er i R2 i realfagsbygget. \r\nhttp://www.ntnu.no/kart/kart-over-ntnu/gloeshaugen/realfagbygget/del-c-u1/r2/\r\nVi starter 18.15 og folk begynner å komme 18.00. Vi har reservert rommet fra 17.00 og vil være der da, og dere kan komme fra da av for å gjøre klart det dere trenger. Det er fint om du kan gi et tidspunkt dere kommer på.\r\
n\r\nVi holder på å reservere rom til intervjuer og kommer tilbake til dere når dette er i orden.\r\n\r\nØnsker dere at vi skal informere om og/eller lage en event om at dere holder intervjuer dagen etterpå?\r\n\r\nDu nevnte at dere ønsker pizza slik at dere kan komme i gang med øvrige aktiviteter etterpå. Er det noe spesifikt du refererer til?\r\n\r\nDersom dere trenger hjelp til å finne fram eller noe annet så er telefonnummeret mitt 95167561, og telefonnummeret til Bedriftskomitesjef Frans Erstad 41200382.\r\n\r\nHåper dere får et fint besøk.\r\n\r\nMvh.\r\nRune Lunde Heggebø', 339, '2011-09-15 10:57:28'),
(285, 79, 'company', '- Vi skal prøve å få styrt det slik at 4. og 5. har første prioritet, vi opner presentasjonen for 80 personer. Dermed skal det vere plass til alle. Eg meiner det var plass til 240 i kantina.\r\n\r\n- Eg har prata med NIkolai, han ordner med distribuering av plakater og flyers\r\n\r\n- Grupperom for intervjuer er bestilt. Eg har bestilt Totalrommet i Hovedbygget. Det var det einaste rommet på Gløs som var ledig det tidspunktet, så eg håper vi får det. I tillegg burde vi stille med kaffi og vatn til intervjua for å yte betre service enn vi gjorde med KBe. I tillegg må vi spørre dei om vi skal lage intervjua som ein event eller om dei vil styre det sjølve, slik som KBe gjorde.\r\n\r\n- Vi bør og presisere for dei at vi tenker å begynne kl. 18.15. Auditoriet er bestilt frå kl. 17.15 så dei kan avtale med oss om når dei vil komme og forberede presentasjonen.\r\n\r\n- Betalingspreferansane må komme på plass. Enten kjem matserveringa på faktura, eller dei betaler momsfritt rett etter
serveringa.\r\n\r\n- Vi må og spørre dei kva dei meiner med øvrige aktiviteter under serveringa, det kan krasje med blant anna vinlotteriet vårt.', 293, '2011-09-15 10:58:34'),
(286, 79, 'company', 'Svar på våre sp.m:\r\n\r\nDei har sendt meg flyers no, venter på at dei skal komme.\r\n\r\n- Vi trenger å vite hvordan dere ønsker å betale. Vi sender dere faktura for presentasjonen, men dere kan velge om dere vil betale for maten under presentasjonen, eller om vi skal inkludere den i fakturaen. Dersom dere betaler for maten under presentasjonen er den momsfri.  \r\n\r\n- Vi vil gjerne ha faktura på hele beløpet tilsendt i etterkant.\r\nVi starter 18.15 og folk begynner å komme 18.00. Vi har reservert rommet fra 17.00 og vil være der da, og dere kan komme fra da av for å gjøre klart det dere trenger. Det er fint om du kan gi et tidspunkt dere kommer på.\r\n\r\n- Vi kommer senest kl. 17.- \r\n\r\n- Ønsker dere at vi skal informere om og/eller lage en event om at dere holder intervjuer dagen etterpå?\r\n\r\n- Ja, dette kan du gjerne markedsføre.\r\n\r\n- Du nevnte at dere ønsker pizza slik at dere kan komme i gang med øvrige aktiviteter etterpå. Er det noe spesifikt du refererer til?\r\n\
r\n- Vi kommer til å ha en praktisk oppgave rett etter at vi har spist; vi deler studentene inn i grupper på 8-10 (helst ikke større, men det avhenger jo av hvor mange studenter som kommer; det skal ikke være for mange grupper heller), gir dem en del materiell og ca. 20 min. til å løse oppgaven best mulig - og så kårer vi et vinnerlag som blir premiert.', 339, '2011-09-21 10:59:38'),
(287, 79, 'company', 'Den er grei, vi kjem nok til å marknadsføre intervjua med all nødvendig tilknytta informasjon, men vi lager ingen event av det.\r\n\r\nVi fyller heller ut eventbeskrivelsane på face og hybridaweb med det nødvendige.\r\n\r\nHar du informert om at vi har fått bestilt Totalrommet H226 frå 08.00 til 16.30 på torsdag 29.09 for intervjuer?\r\n\r\nVi kan stille med kaffi og anna drikke til intervjua.\r\n\r\nDet med aktivitetane ser greitt ut, men du kan informere at vi planlegger å avholde eit vinlotteri samme kveld. Med loddsalg og trekning.\r\n\r\nSjølve koordineringa av aktivitetane kan vi sikkert ta på sjølve dagen.', 293, '2011-09-21 11:00:24'),
(288, 79, 'company', 'Har sendt mail om rom til intervju.', 339, '2011-09-21 11:29:53'),
(289, 79, 'company', 'Hei, gode bed.pres.-hjelpere!\r\n\r\nKan dere hjelpe meg med noe ifm. presentasjonene denne uken? Vi trenger litt vekt ;) - og jeg lurer på om dere klarer å frembringe 5-10 pakker med printerpapir? Sånne med 500 ark i? Vi skal bare låne dem for å teste styrken på det som skal bygges etter maten, så de kan leveres tilbake i like god stand (i motsatt fall erstatter vi dem selvfølgelig!). det virker litt meningsløst å dra med seg 5000 ark på fly ....\r\n\r\nPå forhånd takk!\r\n\r\nBente ', 339, '2011-09-26 11:30:53'),
(290, 79, 'company', 'Eg og Nikolai fikser dette, tenker vi finner papir på Geologibygget.\r\n\r\nVi plasserer det på kontoret, så får heller kantinehjelpene hente det der før presentasjonen.', 293, '2011-09-26 11:31:36'),
(291, 79, 'company', '4Subsea vil gjerne komme tilbake på besøk i perioden veke 39-41 i 2012.\r\n\r\nVi må sende dei ein mail før sommaren.', 293, '2011-09-29 11:32:15'),
(292, 79, 'company', 'Utdrag frå visittkortet til Bente G. Solbakken i 4Subsea:\r\n\r\n""\r\nBente G. Solbakken, Administration Manager\r\nPhone: 91 39 53 54\r\ne-mail: bente.solbakken@4subsea.com\r\n\r\n4Subsea AS\r\nVisiting adress: Smedsvingen 4B, NO-1395 Hvalstad, Norway\r\nPostal adress: P.O:Box 99, NO-1378 Nesbru, Norway\r\nPhone: 66 98 27 00\r\nFax: 66 98 27 01\r\nwww.4subsea.com\r\n""', 293, '2011-09-29 11:33:11'),
(293, 79, 'company', 'Bedriftens navn: 4Subsea\r\n\r\nAvdeling:\r\n\r\nTid for bed.pres: 28.09.11\r\n\r\nKontaktperson(er): Bente G. Solbakken\r\n\r\nEpostadresse: bente.solbakken@4subsea.com\r\nTlf: 66 98 27 00\r\nMobil: 91 39 53 54 \r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nDriver med utvikling av utstyr og programvare. Har behov for marin, maskin, bygg og litt petroleum.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\n\r\nSendte mail.\r\n\r\nDitt navn: Rune Lunde Heggebø', 339, '2011-10-10 11:34:11'),
(294, 18, 'company', 'Kontaktperson:\r\n\r\nMarit Kjersti Berge, HR Manager\r\nJostein Kvamme, Assisterende adm. direktør\r\nMail: maritkjersti@subseaservices.no / jostein@subseaservices.no\r\nTilf: 99 24 61 40 (Marit)\r\n\r\n---------------------------------------------------------------------------------\r\n\r\nSist kontaktet: 28.10.10\r\n\r\nPrøvd å ringe flere ganger etter at Marit ikke har svart på mail eller purremail, så har sendt mail igjen og lagt ved kopi til Jostein Kvamme og satser på at de tar hintet.', 198, '2010-10-28 11:35:24'),
(295, 18, 'company', 'Hei!\r\n\r\nVi er blitt kontakta av Marius Kirkeeidet  Industrivinduet angående det samme. Har dere samarbeid eller er det forskjellige studieretninger? Vi er interessert i en presentasjon til høsten.\r\n\r\nMed hilsen\r\n\r\nMarit Kjersti Berge\r\nmaritkjersti@subseaservices.no\r\nHR Manager\r\nSub Sea Services\r\nTlf 51839530 / 99246140', 397, '2011-04-05 11:36:26'),
(296, 18, 'company', 'Marius Kirkeeide er btw  i smørekoppen (maskin)', 339, '2011-04-05 11:37:07'),
(297, 18, 'company', 'Hei!\r\n\r\nDa ønsker vi å holde bedriftspresentasjon i uke 44 , slik vi snakka om. Du har nevnt tirsdag eller onsdag som aktuelle dager, da kan du se hvordan det passer med en av disse dagene. \r\n\r\nHilsen\r\n\r\nMarit Kjersti Berge\r\nHR Manager\r\nSub Sea Services AS\r\n51839530/99246140', 397, '2011-08-29 11:38:01'),
(298, 18, 'company', 'Onsdag 02.11. i veke 44 meiner eg passer best. Dermed får folk ein dag etter UKA på å summe seg før presentasjon.\r\n\r\nEg har framleis ikkje fått svar på meldinga mi til Maskin om kva deira planer for Sub Sea er, eg ringer dei tidleg i morgon viss eg ikkje vår svar i kveld.', 293, '2011-08-29 11:38:44'),
(299, 18, 'company', 'I dag fekk eg svar frå Maskin om kva deira forhold til Sub Sea er.\r\n\r\nDei skal ha besøk av Sub Sea på PuP-dagane, som er først på våren. Derfor er dei interesserte i ein felles presentasjon no i november som det var snakk om.\r\n\r\nPresentasjonen blir då avholdt av Maskin og I&IKT i fellesskap og ikkje med TP, sjøvsagt om dei er interesserte i eit slikt opplegg. Det har vore mykje fram og tilbake i denne saka, så eg skjønner om dei gjerne heller vil holde det for ei linje, men det er ikkje lenger eit spørsmål om kven som arrangerer viss det blir eit felles opplegg.\r\n\r\nMaskin ønska i alle fall å samarbeide med oss. Dermed er det opp til Sub Sea kva dei vil.\r\n\r\nMaskin har ledig dato tirsdag 01.11., derfor foreslår vi denne datoen for Sub Sea og ikkje 02.11. som var foreslått i forrige innlegg.\r\n\r\nDå er det berre å sende svar til Sub Sea.', 293, '2011-09-05 11:39:28'),
(300, 18, 'company', 'Snakket med Marit på telefonen i dag. Hun skulle svare på mailen om antall personer og årskurs osv. i løpet av dagen eller morgendagen. De ønsker at vi inviterer maskin.', 397, '2011-09-20 11:40:09'),
(301, 18, 'company', 'Meget bra :)\r\n\r\nEg prata med Maskin, dei uttrykte tilfredsstillelse over å bli invitert.\r\n\r\nVi trenger den infoen ja, men dato og tidspunkt er vel satt? 01.11., kl. 18.15 slik vi prata om?', 293, '2011-09-20 11:41:07'),
(302, 18, 'company', 'Jepp 1/11 kl 18.15\r\n\r\nDe ønsker å invitere 3. - 5. årskurs, virker ikke som de vil ha begrensninger på retninger.', 397, '2011-09-21 11:41:57');
INSERT INTO `hyb_comment` (`id`, `parentId`, `parentType`, `content`, `authorId`, `timestamp`) VALUES
(303, 18, 'company', 'Utdrag frå visittkortet til Bernt Arne Breistein i Sub Sea Services:\r\n\r\n""\r\nBernt Arne Breistein\r\nChief Executive Officer\r\nMobile: +47 95 20 79 96\r\nEmail: bernt.arne@subseaservices.no\r\n\r\nSub Sea Services AS\r\nFinnestadsvingen 24, 4029 Stavanger\r\nPhone: +47 51 83 95 30\r\nWeb: subseaservices.no\r\n""', 293, '2011-11-05 11:42:50'),
(304, 18, 'company', 'Bedriftens navn:\r\nSub Sea Services\r\n\r\nAvdeling: Hele bedriften, men først og fremst kontoret i Stavanger\r\n\r\nTid for bed.pres: 1.11.2011 18.15\r\n\r\nKontaktperson(er): Marit Kjersti Berge, Julie Krause, Bernt Arne Breistein, Eirik Røysland\r\n\r\nEpostadresse: Marit: maritkjersti@subseaservices.no Julie: julie@subseaservices.no Eirik: eirik@subseaservices.no Bernt Arne: bernt.arne@subseaservices.no\r\n\r\nTlf: Sub Sea-resepsjon: 51839530 Marit: 99246140 Julie: 406 20 649 Eirik: 993 62 424 Bernt Arne: 952 07 996\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nLeverer spesialisert drillingutstyr til oljerigger. Trenger ingeniører med et bredt fagfelt, siden de er en ganske liten bedrift der ingeniørene er med i hele prossesen fra ide til vedlikehold\r\n\r\nHadde først og fremst kontakt med Marit for å avtale presentasjonen. Julie, Eirik og Bernt Arne var de som var på presentasjonen. Julie ordnet det praktiske på mail like før presentasjonen.\r\n\r\
nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\n\r\nSendte mail til Marit, hadde allerede blitt kontaktet av maskin. Etter mye om og men med Teknologiporten ble vi enige om felles presentasjon med Maskin.\r\n\r\nEirik Røysland\r\nDesign Engineer, M.Sc\r\nMob; +47 9936 24 24\r\neirik@subseaservices.no\r\n\r\nSub Sea Services\r\nFinnestadsvingen 24\r\n4029 Stavanger\r\nT +47 518 39 530 / F +47 518 39 541\r\nwww.subseaservices.no\r\n\r\nJulie Krause\r\nContract Lead\r\n+47 406 20 649\r\nwww.subseaservices.no\r\n\r\nHilsen\r\nMarit Kjersti Berge\r\nHR Manager\r\nSub Sea Services AS\r\n51839530/99246140\r\nBernt Arne Breistein e-post: berntarne@subseaservices.no  tlf 952 07 996', 397, '2011-11-08 11:44:52'),
(305, 1, 'company', 'Fikk kontakt med Andreas Gjærde gjennom Alumni-listene, han hadde en del spørsmål, har sendt svar og informasjon om profilering. Sendte mail igjen i dag for å høre om når de kan tenke seg å ha presentasjon.', 279, '2011-01-10 11:48:54'),
(306, 1, 'company', 'De ønsker bedpres i slutten av februar, da er det fullt, jeg foreslo 1-3 eller 8-10.mars.', 279, '2011-01-17 11:49:46'),
(307, 1, 'company', 'Vil ha bedpress 2.mars. Har spurt om auditorium med bra lyd og bilde og om vi kan reservere grupperom på realfagsbygget 3.mars for intervjuer.', 279, '2011-01-24 11:50:25'),
(308, 1, 'company', 'Referat for kontakt med bedriftene\r\n\r\nBedriftens navn: Aker Solutions KBe Design\r\nTid for bed.pres: 02.03.2011\r\n\r\nKontaktperson(er): Andreas Gjærde og Jon Østmoen\r\nEpostadresse: andreas.gjaerde@akersolutions.com og  jon.ostmoen@akersolutions.com\r\nTlf: 90 07 57 85 (Andreas Gjærde)\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\n\r\nKom i kontakt med Andreas via mail til Alumnilista.', 279, '2011-03-16 11:51:22'),
(309, 1, 'company', 'Svar på oppfølgingsmail:\r\n\r\nTakk for god feedback!\r\n\r\nIntervjuene gikk bra og vi ser frem til å få flere I&IKT''ere med i teamet.\r\nNoe man ofte trenger i fbm med intervjuer er et par kaffekanner og 4-5 flasker med vann - om dere uoppfordret skaffer dette til bedrifter som holder intervju, scorer dere nok enda ett par poeng for god service.', 279, '2011-04-05 11:52:08'),
(310, 1, 'company', 'Har kontaktet KBeDesign. Ønsker bedpress i begynnelsen av februar. Synes det var litt sent tidspunkt de hadde sist, ettersom flere av 5 klassingene, da allerede hadde fått jobb tilbud. Venter på svar om dato, og mer praktisk.\r\n\r\nNy kontaktperson er:\r\n\r\nMarthe Almeland (tidligere I&IKT)\r\nmarthe.almeland@akersolutions.com\r\ntlf: 00 47 67 59 52 25 (jobbtlf)', 356, '2011-10-31 11:53:33'),
(311, 1, 'company', 'KBeDesign ønsker Bedpress den 8. februar !! Så ingen ta den datoen !!\r\n\r\nEllers:\r\n\r\n"Vi ønsker alle trinn.\r\n\r\n(...)\r\n80 stk er bra, men vi setter allikevel en grense på 100 stk.\r\n\r\n(...)\r\nPresentasjonen blir på max en time. Antar matservering, men vi kom ikke så langt i planleggingen.\r\n\r\n(...)\r\nForetrekker andre auditorier enn i sentralbygget (vi har vel pleid å være i el-bygget)\r\n\r\n(...)\r\nVi har diskutert litt angående samtaler/intervjuer med 5. kl om fast ansettelse og 3.-4. kl om sommerjobb. Usikker på hvordan vi løser det enda, men vil komme tilbake til det senere.\r\n\r\n"\r\nKommer da tilbake senere med med detlajert informasjon', 356, '2011-11-14 11:54:44'),
(312, 205, 'company', 'Fått tilbakemelding fra Iterate i dag, etter de først kontaktet oss med etterspørsel om å få holde bedpress:\r\n\r\n"Hei!\r\n\r\nDa ønsker vi å ha en bed.pres torsdag 23. feb. Kl 17.00, og etterpå ta med\r\nstudentene på Credo, 2. etg."\r\n\r\nSender ut mail, ang. mer praktisk informasjon om hvem de vil invitere, og antall.\r\n\r\nMen altså IKKE TA DATO 23. FEBRUAR!!\r\n\r\nKontaktperson:\r\n\r\nIngrid Wigum Gjersvold\r\nMarkedskoordinator\r\n+47 97 70 48 45 | Iterate AS | www.iterate.no\r\nThe Lean Software Development Consultancy', 356, '2011-11-22 11:59:58'),
(313, 205, 'company', 'Mer info:\r\n\r\nMax antall personer: 50 stk - Ønsker prioritert på 4 og 5 klassinger, og etterhvert 3., så 2. og tilslutt 1.\r\n\r\nBespisning: Credo 2 etg. 2-retters meny. Ønsker bongsystem. Ca. 100 boenger, avhengig av antall påmeldte.', 356, '2011-12-05 12:00:35'),
(314, 5, 'company', 'Sendt mail til info1@capgemini.com\r\n\r\nSatser på at de videresender mailen til riktig person.', 348, '2011-01-05 12:01:52'),
(315, 5, 'company', 'Hei Thor-Andrè\r\n\r\nCapgemini kommer gjerne å holder en bedriftspresentasjon for masterstudiet Ingeniørvitenskap & IKT ved NTNU. Passer det\r\nonsdag. 9.2 eller 16.2. \r\n\r\nJa, passer det disse datoene? Jeg må presisere at jeg ikke har diskutert pris eller noe lignende med dem. Dette er deres svar på min første mail. Skal jeg anta at de vet at det koster, eller?', 348, '2011-01-11 12:02:36'),
(316, 5, 'company', '9. februar er alt for tett opp til Åre-turen, så 16. februar passer for oss. Prøv å avtale denne datoen med dei.\r\n\r\nDu må passe på å nemne pris for no når du svarer dei.\r\n\r\nBedrifta legger ut for maten, mellom 7000 og 10 000 typisk, avhengig av kor mange som kjem.\r\n\r\nI tillegg tar vi eit honorar på 150 kr for kvar besøkande, men med maxhonorar på 10 000.\r\n\r\nMed andre ord: viss det samla honoraret frå antall besøkande overskrider 10 000 kr, vil vi maksimalt kreve 10 000 kr frå dei.', 293, '2011-01-11 12:03:24'),
(317, 5, 'company', 'Done!', 348, '2011-01-11 12:04:10'),
(318, 5, 'company', 'Har nå fått følgende svar etter 2 mailer der jeg opplyste om priser og ba om bekreftelse på dato(16.2):\r\n\r\nHei\r\n\r\nVi bestiller pizza og brus :-)\r\n\r\nHilsen Siri Kielland\r\n\r\nSå da regner jeg med at de kommer her 16.2 og holder bedriftspresentasjon for oss, og de ønsker at pizza og brus blir servert til studentene.', 348, '2011-01-17 12:04:55'),
(319, 5, 'company', 'Legger ved utdrag frå visittkortet til Stian Myrland i Capgemini:\r\n\r\n""\r\nTechnology Services\r\nStian Myrland\r\nManaging Consultant\r\nCapgemini Norge AS\r\nBeddingen 10, N-7014 Trondheim, Norway\r\n\r\nTel: +47 90 56 33 22\r\nFax: +47 73 52 10 77\r\nstian.myrland@capgemini.com\r\nwww.no.capgemini.com\r\n""', 293, '2011-02-16 12:06:11'),
(320, 5, 'company', 'Bedriftens navn: Capgemini\r\nTid for bed.pres: 16.02.2011\r\n\r\nKontaktperson(er):\r\n\r\nTrondheimkontor: \r\nStian Myrland\r\nE-post: stian.myrland@capgemini.com, \r\nMobil: 90 56 33 22\r\n\r\nHR:\r\nSiri Kielland\r\nE-post: siri.kielland@capgemini.com \r\nTlf: 47 24 120 80 00\r\nMobil.: 41 41 42 94\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?\r\nIT konsulentfirma som trenger personer med en basis i IT.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\nSendte mail til Siri, fikk positivt svar. Ble etter hvert henvist til Stian som tok av seg det praktiske rundt presentasjonen.\r\n\r\nDitt navn: Thor-André Knutsen', 348, '2011-02-20 12:07:01'),
(321, 5, 'company', 'Fikk i midten av mai bekreftelse om at deres neste bedriftspresentasjon for oss holdes 27. september, og at vi skulle prates mer etter sommeren. Jeg har enda ikke opprettet etter-sommeren-kontakt, men skal gjøre det snart.', 354, '2011-08-14 12:07:42'),
(322, 5, 'company', 'Sendte mail med info om priser, mat osv. den 24. august, men fikk ikke svar. Sendte derfor en ny mail idag(2.september) for å høre om hun(Siri Kielland) hadde sett noe på den. Hun ringte da opp, og sa hun hadde ikke sett mailen, men fant den først nå. \r\n\r\nHun sa hun skulle forhøre seg mer med noen andre innad i bedriften om deres preferanser rundt bedpressen(mat, drikke, antall osv), og komme tilbake til meg så fort så mulig. Forresten, hvordan var opplegget på deres forrige bedpress? da tenker jeg på om det var åpent for alle retninger, antall, og alt det der...', 354, '2011-09-02 12:08:28'),
(323, 5, 'company', 'Informasjon frå sist presentasjon med Capgemini:\r\n\r\n- Antall besøkande: 62, påmeldinga var open for 80\r\n\r\n- Opent for alle linjer og alle klasser\r\n\r\n- Servering: Pizza og brus i SiT sin kantine\r\n\r\n- Ønsket betalingsform: Faktura\r\n\r\n- Dei sendte oss plakater som vi hengte opp på tavler rundt om kring på Gløs for å reklamere for dei i forkant av presentasjonen\r\n\r\n- Eg husker ikkje om dei ville ha med ekstra informasjon i påmeldinga til presentasjonen, eg rekner med dei hadde dette', 293, '2011-09-02 12:09:25'),
(324, 5, 'company', 'Snakket med Siri Kielland idag. Hun sa de tenker å kjøre samme opplegget som sist. Dvs.\r\n\r\nPizza med brus/mineralvann\r\nÅpent for alle(akkurat som sist)\r\nBetalingsform: Faktura\r\n\r\nMERK! Hun skulle sende mail med bekreftelse på dette etter telefonsamtalen, den har ikke kommet. Det er Stian som kjørte opplegget i fjor som skal gjøre det nå også. Men bør kanskje vente på bekreftelsen fra henne(satser på at kommer i morgen) før vi offentliggjør det på hybrida sidene(?).', 354, '2011-09-12 12:10:08'),
(325, 5, 'company', 'Dette ser bra ut, vi kan gjerne ta det safe og vente på bekreftelsen.\r\n\r\nSend bekreftelsen vidare til meg når du får den.', 293, '2011-09-12 12:10:46'),
(326, 5, 'company', 'Fikk mail nå:\r\n\r\n"Hei Erlend\r\n\r\nVi kjører som nevnt samme opplegg som sist\r\n\r\nMat: Vi varierer til pastabuffet denne gangen+  øl/min vann\r\n\r\nÅpent for samme publikum som sist\r\nFaktura sendes:"\r\n\r\nAltså, de bytter til Pastabuffet. istedenfor pizza', 354, '2011-09-12 12:11:28'),
(327, 5, 'company', 'Bedriftens navn: Capgemini\r\n\r\nTid for bed.pres: 16.02.2011\r\n\r\nKontaktperson(er):\r\n\r\nTrondheimkontor: \r\nStian Myrland\r\nE-post: stian.myrland@capgemini.com, \r\nMobil: 90 56 33 22\r\n\r\nHR:\r\nSiri Kielland\r\nE-post: siri.kielland@capgemini.com \r\nTlf: 47 24 120 80 00\r\nMobil.: 41 41 42 94\r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?\r\nIT konsulentfirma som trenger personer med en basis i IT.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\nOvertok som kontaktperson i vår. Var da allerede bestemt at det skulle holdes bedpres. 27.september. Jeg tok kontakt med Siri over sommeren for å planlegge nærmere. Det ble bestemt mat antall, osv. Ble deretter henvist til Stian Myrland som var ansvarlig for selve bedriftspresentasjonen.\r\n\r\nDitt navn: Erlend Orthe', 354, '2011-10-04 12:12:25'),
(328, 5, 'company', 'Sendte forresten tilbakemelding til Stian forrige uke. Spurte da samtidig om de hadde lyst til å holde en bedpres til våren 2012 også. Han svarte da:\r\n\r\n"Jeg har satt Siri Kielland på CC. Hun er deres kontaktpunkt i forhold til planlegging av evt. neste bedriftspresentasjon.\r\n\r\nMvh\r\nStian"\r\n\r\nLitt usikker på hva CC er...anyone? ', 354, '2011-10-04 12:13:08'),
(329, 5, 'company', 'CC = Carbon Copy. Det betyr at Siri fekk ein kopi av brevet du sendte til Stian.\r\n\r\nI motsetning til BCC, som er Blind Carbon Copy. Det betyr at Siri har fått ein kopi, men du fikk ikkje vite om det.', 293, '2011-10-04 12:13:45'),
(330, 5, 'company', 'Fikk tilbakemelding fra Siri Kielland idag vedrørende henvendelsen om de vil holde en bedpress til våren også. Hun skriver:\r\n\r\n"Hei Erlend\r\n\r\nTa kontakt så finne vi gjerne tid 2012 til bedriftspresentasjon:-)\r\n\r\nMvh Siri Kielland"\r\n\r\nEr det noen datoer på våren som er mer aktuelle enn andre?', 354, '2011-10-11 12:14:34'),
(331, 5, 'company', 'Bra vi får dei tilbake til våren igjen, eg rekner med datoer i februar vil vere mest aktuelt for dei.\r\n\r\nAlle datoer etter 06.02. vil vere aktuelle, kanskje ikkje 15.02. og 16.02. då har Kaizers konsert og ekstrakonsert.\r\n\r\nSom vi prata om på forrige møte, kjem ikkje Erlend til å ha ansvaret for Capgemini. Denne jobben går til Kristian.\r\n\r\nEg skal be Kristian sende ein mail til Capgemini og presentere seg som ny kontaktperson og foreslå dei gitte datoane.\r\n\r\nDermed slepper Erlend gjere noko meir.', 293, '2011-10-11 12:15:24'),
(332, 5, 'company', 'den er god:)', 354, '2011-10-11 12:16:06'),
(333, 5, 'company', 'Fikk en telefon fra Siri Kielland idag. Hun lurte på om det er noen andre som har tatt over ansvaret for CapGemini. Det er slik at Kristian er ny kontaktperson sant? \r\n\r\nJeg vet ikke om Kristian har presentert seg som ny kontaktperson enda, men Siri ville gjerne at han skal gjøre det til henne(og ikke via Stian). Er det mulig å få gjort det nå snart? ', 354, '2011-12-06 12:16:49'),
(334, 5, 'company', 'Kristian slutter i komiteen til jul, derfor fikk Fredrik jobben med Capgemini i oktober.\r\n\r\nHan har enno ikkje tatt kontakt med dei, men han skulle gjere da innan ein time. Eg ba han kontakte Siri.', 293, '2011-12-06 12:17:22'),
(335, 143, 'company', '"Henvendelsen er mottatt, og vi er i utgangspunktet veldig interessert. Kommer tilbake."\r\n\r\nKontaktperson:\r\nRoar Smelhus, direktør Bygg og Eiendom\r\nmail: ros@hjellnesconsult.no', 357, '2011-08-25 12:19:25'),
(336, 143, 'company', 'Hjellnes var i utgangspunktet interesserte i bed.press 18.10 eller 19.10, men vi vart enige om å ta den over å jul i staden. Prøvde å få med datterselskapet Johs. Holt (konstruksjon) for å få ein presentasjon som er relevant for fleire hybrider (enn dei 6 stk som fordjupar seg i varme- og strømning). Det viser seg at det kanskje er unødvendig, da Hjellnes har ein del konstruksjonsfolk likevel:\r\n\r\n"Takk for tilbakemeldingen.\r\n\r\nI HC har vi også en bygg seksjon på rundt 40 personer. Brorparten av disse har konstruksjonsbakgrunn som folkene i Johs Holt. Totalt med Johs Holt er vi rundt 60-70 personer med konstruksjonsbakgrunn. Ikke nok med det, vi trenger flere.\r\n\r\nDet er greit for oss å ta det etter nytt år. Gi meg gjerne tilbakemelding tidlig vedr. tidspunkt slik at vi kan forberede oss.\r\n\r\nHører fra deg etter hvert."\r\n\r\nMed vennlig hilsen\r\nfor Hjellnes Consult as\r\nRoar Smelhus\r\nDirektør Bygg og Eiendom, MRIF\r\n+47 950 70 594\r\n+47 225 74 800\r\nros@
hjellnesconsult.no', 357, '2011-09-10 12:20:10'),
(337, 143, 'company', 'Vi kan gjerne tenke framover og sette dato for dei med ein gong.\r\n\r\nVi begynner igjen på NTNU til våren den 9. januar. Då kan vi enten ha dei på besøk av dei 18. eller 19. januar i veke 3, eller 24., 25., 26. januar i veke 4.\r\n\r\nDei kan få lov til å velge datoer som passer best for dei, men dette er våre forslag, desse datoane krasjer ikkje med Åre-turen.\r\n\r\nVar dei positivt innstilt på ein presentasjon som både omfatta varme/strømning og konstruksjon?', 293, '2011-09-12 12:21:24'),
(338, 143, 'company', 'Ja, men Skiweek i Åre går frå 15. januar til 2. februar så vi bør vel holde oss unna den perioda? Eg foreslår 7., 8., 9. februar...', 357, '2011-10-04 12:22:03'),
(339, 143, 'company', 'Hjellnes kan tenke seg:\r\n\r\n# 3.- 5. klasse I&IKT, Konstruksjonsteknikk + 5. klasse Bygg & Miljø (evt. 1., 2. klasse I&IKT)\r\n\r\n# Presentasjon kl 18.00, varighet ca 1 time\r\n\r\n# maks 100 personer, kan fylle opp med 1. og 2. klassinger dersom det er ledig kapasitet\r\n\r\n# Tapas, øl/vin/mineralvann\r\n\r\n# muligens interessert i å få inn annonse i Update^k, de spør om prisen for annonse...\r\n\r\n# Linker på påmeldingssiden: www.hjellnesconsult.no og www.johsholt.no\r\n\r\nRepresentanter:\r\nJohs. Holt Arne Christensen\r\nHjellnes Consult Pål Erik Kind, alt. Harald Yggeseth\r\nHjellnes Consult Roar Smelhus', 357, '2011-12-04 12:22:50'),
(340, 143, 'company', 'Dette ser bra ut, men var ikkje området deira varme og strømning i tillegg til bygg?\r\n\r\nHar du prata med dei om denne I&IKT-spesialiseringa og om vi eventuelt kan ta dei med?\r\n\r\nElles har eg prata med Update^k, neste trykkdato er 12.02.2012, eg venter framleis på svar om pris.', 293, '2011-12-04 12:23:46'),
(341, 143, 'company', 'No har eg prata med Update^k, dei har planer om å øke trykkvaliteten på avisa og vil ha 700 for ei halvside og 1000 for ei heilside.\r\n\r\nDette kjem av trykkerikostnader, trykkdatoen er 12.02. som nevnt.\r\n\r\nEg rekner med at det er ein grei sum for at over 100 potensielle jobbsøkere leser navnet deira og veit kven dei er.', 293, '2011-12-05 12:24:24'),
(342, 143, 'company', 'Konstruksjonsteknikk var visst mest interessant for Hjellnes, men eg skal høyre om vi kan ta med dei få som går varme/strømning.\r\n\r\nTakk for annonsepriser :-)', 357, '2011-12-06 12:25:02'),
(343, 143, 'company', 'Fekk svar angåande varme/strømning i dag:\r\nHjellnes vil fokusere på konstruksjon på presentasjonen, men dei tar ein kort 5-minutter om VVS/energiavdelinga og vi kan invitere dei 5-6 personane på varme/strømning. \r\n\r\nDei vil gjerne ha ei halvside i Update, har sendt meg logo som vi skal bruke + at dei kanskje vil ha inn logo for Johs Holt (datterselskapet), den får eg evt. seinare...', 357, '2011-12-08 12:25:53'),
(344, 143, 'company', 'Det høyrast bra ut, bra dei er så flinke til å svare.\r\n\r\nVil dei kun bruke logo? Har dei ingen utkast til tekst i tillegg? Vi tar gjerne i mot utkast.\r\n\r\nDet er ikkje påkrevd å ha tekst i tillegg, men det er kanskje bra for konteksten.\r\n\r\nAnnonsen kjem til å vere i svart-kvitt forresten.', 293, '2011-12-08 12:26:46'),
(345, 143, 'company', 'Stussa litt på utkast eg og, ska høyre. Ellers er alt i boks nå trur eg :-)', 357, '2011-12-08 12:27:23'),
(346, 40, 'company', 'Focus Software var interresert i å ha bedpress. Dei er i ein vekstfase og planlegger å ansette 3-5 personar per år, dei kan kanskje også ha tilbud om masteroppgaver.\r\n\r\nKontaktperson:\r\nPål Eskerud - Daglig Leder - pe@focus.no og paal.eskerud@focus.no\r\n\r\nEr ikkje sikker på kva for ei epostadresse han bruker til vanlig. \r\n\r\nFocus vl ha bedpress 26.10.10 med studenter fra 3, 4 og 5 klasse Geomatikk og Konstruksjonsteknikk.', 339, '2010-10-06 12:28:43'),
(347, 40, 'company', 'Bedriftens navn: Focus Software\r\n\r\nAvdeling:\r\nTid for bed.pres: 26. oktober 2010\r\n\r\nKontaktperson(er): Pål Eskerud (Daglig Leder)\r\nEpostadresse: pe@focus.no og paal.eskerud@focus.no\r\nTlf:\r\nMobil: \r\n\r\nKort om bedriften/avdelingen (hvorfor passer den for I&IKT?):\r\n\r\nFocus er et ledende kompetansesenter innen IT-løsninger for bygg- og anleggsmarkedet.\r\n\r\nDe tar inn både bygg- og geomatikkingeniører.\r\n\r\nKort om hvordan du kom i kontakt, og fikk ordnet bed.pres med de:\r\n\r\nFikk rask kontakt via e-post, avtalte bedpress over mail.\r\n\r\nDitt navn: Rune Heggebø', 339, '2011-01-11 12:29:44'),
(348, 40, 'company', 'Utdrag frå visittkortet til Pål Eskerud i Focus Software:\r\n\r\n""\r\nPål Eskerud\r\nSiv.Ing / M.Sc\r\nDaglig leder / CEO\r\nMob +47 90 14 96 90\r\nE-mail: paal-eskerud@focus.no\r\n\r\n-----------------------------------------\r\n\r\nFocus Software AS\r\nBillingstadsletta 19a\r\nPb 66, 1375 Billingstad\r\nTel +47 66 77 84 00\r\nFax +47 66 77 84 01\r\nwww.focus.no\r\n""', 293, '2011-01-27 12:30:47'),
(349, 40, 'company', 'Dei ønsker å komme igjen etter jul, har vi noken passande datoa?', 339, '2011-10-28 12:31:31'),
(350, 40, 'company', 'Alle man-tors etter 06.02, med hensyn på at enkelte datoer blir opptatt ettersom andre bedrifter bookast.', 293, '2011-10-28 12:32:17'),
(351, 40, 'company', 'Focus har tirsdag 21. februar.\r\n\r\nJa, jeg mente tirsdag.\r\n\r\nI utgangspunktet så følger vi vel i store trekk slik det ble gjort i fjor. Vi inviterer 3, 4. og 5. klasse.Vi henvender oss til kandidater innen Byggeteknikk, Anleggsteknikk, IKT ( applikasjons-programmering og grafisk databehandling) så det er kanskje en ide og gjøre oppslaget tilgjengelig for flere linjer? Vi spanderer pizza og øl hvis det er mulig. Jeg kan lage litt info om oss som eventuelt kan legges ut med innbydelsen.\r\n\r\nMed hilsen\r\nFocus Software AS\r\nPål Eskerud Daglig Leder\r\nEpost: pe@focus.no\r\nMob: 901 49 690Tlf: 66 77 84 00\r\nWeb:www.focus.no', 339, '2012-01-06 12:33:15'),
(352, 40, 'company', 'I følge tilbakemeldinga vi fikk frå dei i fjor tenkte dei i etterkant at dei like greitt kunne invitert 1. og 2. klasse i tillegg for å skape interesse rundt bedrifta og konstruksjon generelt. Er dette framleis eit alternativ for dei?\r\n\r\nVi kan også invitere studenter frå 3.-5. klasse Bygg og Miljøteknikk (BM) for å dekke byggeteknikk og anleggsteknikkdelen, viss det er ønske om dette. Einaste ulempen er at Industrikontakten for BM tar 1000 kr i honorar for å promotere presentasjonen til deira studenter, denne ekstra utgiften kjem i så fall på fakturaen. Vil også gjerne vite kor mange studenter frå kvar linje dei tenker seg.\r\n\r\nFor byggeteknikk og IKT-delen er nok IKT-konstruksjon den mest dekkande å promotere seg ovenfor. Sist gang var presentasjonen open for alle på I&IKT sidan samtlige studenter har programmeringskunnskaper, men det vart reklamert med at den var mest relevant for IKT-konstruksjon og IKT-geomatikk. Vi kan gjerne følge samme opplegg som i fjor med tanke på
promotering ovenfor I&IKT.\r\n\r\nPizza og øl er ein mulighet. Informasjon til innbydelsen/ påmeldinga setter vi pris på.', 293, '2012-01-06 12:34:01'),
(353, 40, 'company', 'Sendt svar:\r\n\r\nHei\r\n\r\nEtter presentasjonen i fjor snakket dere om at dere tenkte å invitere 1. og 2. klasse også for å promotere bedriften, er dette ikke lenger aktuelt?\r\n\r\nVi kan også invitere studenter fra 3.-5. klasse Bygg og Miljøteknikk (BM) for å dekke byggeteknikk og anleggsteknikkdelen, dersom det er ønske om dette. Industrikontakten for BM tar 1000 kr i honorar for å promotere presentasjonen til deres studenter, og denne ekstra utgiften vil komme på fakturaen.Dersom dette er ønsket vil vi gjerne vite hvor mange studenter dere kunne tenke dere fra hver linje.\r\n\r\nKonstruksjonsteknikk og geomatikk er nok de mest aktuelle retningene på linjen vår for dere, men med tanke på at dere driver med IKT så er jo dette relevant for hele linjen. Ønsker dere å begrense dere til noen retninger, eller vil dere ha det åpent for hele linjen. De andre retningene på linjen er: Produkt og prosess, Marin teknikk og Petroleumsfag\r\n\r\nPizza og øl er en mulighet, dersom presentasjonen
holdes for mer enn 40 personer. Informasjon til innbydelsen setter vi pris på.\r\n\r\nMvh.\r\nRune Lunde Heggebø\r\nHybrida Bedriftskomité\r\nhttp://www.hybrida.ntnu.no/hybridaweb/bedrift ', 339, '2012-01-06 12:35:20'),
(354, 204, 'company', 'Rune\r\n\r\nKontoret her i Trondheim har en fra dere men spesialisering innen maskin/mekanikk.\r\n\r\nJeg avventer litt med hvem vi ønsker da det er mulig flere disipliner enn de som sitter her i Trondheim ønsker å presentere seg. Jeg har ikke fått noe svar enda.\r\n\r\nVi har bygg, marine, maskin og materialfolk i Trondheim. \r\n\r\nDe senere årskurs er mer aktuell enn de tidlige. \r\n\r\nRegards\r\nJomar Tørset\r\nDepartment Manager Trondheim\r\nGE Oil & Gas\r\n\r\nT +47 73832621\r\nM +47 91715189\r\njomar.torset@ge.com\r\nwww.geoilandgas.com/VetcoGray\r\n\r\nSluppenveien 12 B\r\n7037 Trondheim ', 339, '2012-01-09 13:07:37'),
(355, 204, 'company', 'GE Oil & Gas kontaktet oss i 2012 og inviterte oss på presentasjon og servering i deira lokaler på Sluppen i Trondheim.', 293, '2012-01-01 13:09:06'),
(356, 120, 'company', 'Tidligere IKT-student Solveig Fiskaa har begynt å jobbe hos Vianova Systems og har kontaktperson: \r\n\r\nMarkedsansvarlig Kristin Thygesen (kristin.thygesen@vianova.no, tlf dir 67 81 70 41)', 279, '2011-01-13 13:09:53'),
(357, 120, 'company', 'Har nå sendt mail til kontakpersonen nevnt i innlegget under. Venter på svar', 354, '2011-03-22 13:10:36'),
(358, 120, 'company', 'Har nå fått svar fra viianova systems. Her er det\r\n\r\nHei,\r\n\r\nBeklager at jeg ikke har kommet tilbake til deg tidligere.\r\nJeg skal sjekke internt og gi deg en tilbakemelding så fort jeg får svar.\r\n\r\nMed vennlig hilsen\r\nKristin Thygesen,\r\n\r\nTelephone    +47 67 81 70 00\r\nDirect line      +47 67 81 70 41\r\nMobile            +47 93 84 15 65\r\nkristin.thygesen@vianova.no\r\n\r\nVianova Systems AS\r\nLeif Tronstads plass 4, P.O. Box 434\r\nN-1302 Sandvika, Norway', 354, '2011-03-29 13:11:22'),
(359, 120, 'company', 'Fikk svar fra Kristin Lysebo, HR ansvarlig, produktleder Arealplan. Det er henne jeg ble henivst til av tidligere kontaktperson, Kristin Thygesen(se over).\r\n\r\n"...Jeg har ikke tenkt så mye rundt de praktiske tingen, det kan vi komme litt tilbake til. Det viktigste er kanskje å få rammen og en dato på plass. \r\n\r\nDato:\r\nJeg har foreløpig ingenting fra 13. februar og utover. Tirsdag til torsdag \r\npasser best for meg. Har dere booket noe de datoen fra den 14. februar? Ellers så passer både \r\n14, 15. og 16. februar for meg i tillegg til tirsdag til torsdag resten av \r\nfebruar.Jeg kan fint holde presentasjonen fra kl. 18 og utover om det passer best \r\nfor dere.\r\n\r\nVårt fagområde er samferdesel, men i forhold til dine kategorier så blir \r\ndet riktiste konstruksjon og geomatikk.....\r\n\r\n...\r\n\r\nMed vennlig hilsen\r\nKristin Lysebo"\r\n\r\nHvilken dato passer best for oss? Dessuten så er jeg litt usikker på hvor aktuell den delen hun er ansvarlig for(Arealplan) er
for oss. Jeg vet at Tidligere I&IKT student Solveig Fiskaa(geomatikk) jobber der innen Landskap, og er produktleder for Novapoint(programvare Terreng). Skal jeg høre om hun er keen på å komme opp å holde presentasjon også?', 354, '2011-11-07 13:12:20'),
(360, 120, 'company', 'Alle datoer etter 14.02. passer bra for oss, vi har ikkje booka noko på dei datoane enno.\r\n\r\nEtter det eg har lest om arealplan etter å ha googla det, virker det relevant for Geomatikk i alle fall, kanskje litt Konstruksjon i tillegg.\r\n\r\nVi har ikkje hatt nokon Geomatikkbedrifter enno i år, så dette kan vere ein god mulighet.\r\n\r\nVi kan gjerne foresl å invitere ein tidlegare I&IKT-student, men i så fall bør vi foreslå dette til Kristin Lysebo, slik at vi forholder oss til ein person i bedrifta og ikkje skaper rot rundt planlegginga av opplegget.', 293, '2011-11-07 13:13:13'),
(361, 120, 'company', 'Den er god:)', 354, '2011-11-07 13:13:48'),
(362, 120, 'company', 'Snakket med Lysebo idag. Hun sa at 15. februar passer godt for dem. Hun hørte med Solveig om hun ville være med og holde bedpres, og det blir hun.\r\n\r\nDermed:\r\n\r\nBedpress med Vianova Systems: 15. februar\r\nTidligere I&IKT student Solveig Fiskaa blir med.', 354, '2011-11-10 13:14:32'),
(363, 120, 'company', 'Fikk bekreftelsesmail fra Lysebo nå:\r\n\r\n"Hei.\r\n\r\nVille bare sende en mail for å bekrefte at Solveig Fiskaa og jeg kommer \r\ntil dere onsdag 15. februar kl. 18.\r\nJeg tar kontakt med deg i uke 4 for å avtale detaljene.\r\nVi gleder oss :-)\r\n\r\nMed vennlig hilsen\r\nKristin Lysebo"', 354, '2011-11-10 13:15:21'),
(364, 120, 'company', 'Kommer ikke på møtet tirsdag 24.januar, pga forelesning.\r\n\r\nMen status for Vianova er at jeg sendte mail til dem her om dagen, for å påminne om bedpress 15. februar, og at info må på plass nå snart. Kontaktperson er borte til 23. januar(i morra), så regner med å få på plass info i løpet av uka.(uke 4)', 354, '2012-01-22 13:16:10'),
(365, 71, 'company', 'Kontakt: andrea.sunde@conocophillips.com Fikk mailen fra Hege, svarte ikke på mine forespørsler', 397, '2012-01-24 13:25:18'),
(366, 78, 'company', 'Viste interesse, men takket nei for nå (for et par måneder siden) Kontakt: aslaug.thomassen@sptgroup.com', 397, '2012-01-24 13:26:18'),
(367, 55, 'company', 'Ikke fått kontakt', 397, '2012-01-24 13:26:58'),
(368, 18, 'company', 'Hintet til at de ville komme tilbake neste år da jeg sendte tilbakemeldingssskjemaet til dem.', 397, '2012-01-24 13:27:38'),
(369, 157, 'company', 'christina.skorge@peab.no Prioriterer bygg, var allikevel ikke helt avvisende, verdt et nytt forsøk.', 397, '2012-01-24 13:28:23'),
(370, 159, 'company', 'Ikke fått kontakt', 397, '2012-01-24 13:29:07'),
(371, 146, 'company', 'Kontakt: Charlotte.Nilsen.Fossli@solvea.no Var på BM-dagen, men var ikke interessert i bedpres da jeg var i kontakt med dem.', 397, '2012-01-24 13:29:49'),
(372, 161, 'company', 'Viste litt interesse, men det rant ut i sanden. Kontakt: kjerstin.bretteville-jensen@vegvesen.no', 397, '2012-01-24 13:30:31'),
(373, 171, 'company', 'Fikk ikke kontakt', 397, '2012-01-24 13:31:03'),
(374, 164, 'company', 'Ikke intressert', 397, '2012-01-24 13:31:36'),
(375, 155, 'company', 'Ikke fått kontakt', 397, '2012-01-24 13:32:12'),
(376, 59, 'company', 'Ikke fått kontakt', 397, '2012-01-24 13:32:50'),
(377, 143, 'company', 'Utdrag frå visittkortet til Roar Smelhus i Hjellnes Consult\r\n\r\n"\r\nRoar Smelhus\r\nRådgivende ingeniør, MRIF\r\nDirektør bygg og eiendom\r\nTlf.dir +47 95 07 05 94\r\nE-post: ros@hjellnesconsult.no\r\n\r\nHjellnes Consult AS\r\nPlogveien 1\r\nPostboks 91 Manglerud\r\n0612 Oslo\r\nTlf: +47 22 57 48 00\r\nwww.hjellnesconsult.no\r\n"', 293, '2012-01-27 16:08:32'),
(378, 120, 'company', 'Har nå fått på plass det meste vil jeg tro:\r\n\r\nVianova skal ha bedpress 15. februar kl. 1815. De vil ha:\r\n - Tacobuffet\r\n - brus/mineralvann og bongsystem for øl(2-3 stk hver)\r\n - Åpent for geomatikk og konstruksjon + 1. og 2. årstrinn\r\n\r\nHvor mange bør vi begrense antall studenter til? 50 stk ca? ', 354, '2012-01-31 14:01:34'),
(379, 120, 'company', '50 personer er eit bra antall, med mindre Vianova har preferanser?\r\n\r\nElles trur eg vi har all informasjon vi trenger.', 293, '2012-02-01 17:12:26'),
(380, 40, 'company', 'Hei igjen Rune.\r\n Tiden går jo fort  og du savner vel litt tilbakemelding.\r\n\r\n Vi konsentrerer oss om Hybrida og inviterer fra alle årstrinnene, alle retningene\r\n\r\n Vi vil gjerne invitere til pizza og øl etterpå og håper dere kan ordne dette.\r\n Jeg ser at dere opererer med maks 70 på andre tilsvarende presentasjoner og da setter vi det på samme nivå.\r\n\r\n Vi kommer til å stille med 4-5 personer fra vår side. \r\n\r\n Med tanke på innbydelsen så kommer her noen ord.\r\n\r\n Focus Software er et programvareselskap som utvikler og leverer programvare til norsk og internasjonal bygg-og anleggsnæring. \r\n Selskapets løsninger er i daglig bruk hos en rekke arkitekter og rådgivende ingeniørfirmaer.\r\n Løsningene dekker områdene konstruksjonsberegninger, anbudsbeskrivelser, BIM programvare(Autodesk Revit, Civil3D og Navisworks) og konsulenttjenester innen de samme områdene.\r\n Selskapet teller i dag 27 medarbeidere og er i vekst. Det skal rekrutteres 2-3 nyutdannede i
inneværende år innen område programutvikling og BIM konsulent.\r\n Vi ønsker også kontakt med mulige masterkandidater som ønsker å gjennomføre masteroppgaven hos oss, gjerne kombinert med sommerjobb.\r\n Etter presentasjonen blir det mulighet for å avtale nærmere tidspunkt for en-til en samtaler senere.\r\n For nærmere informasjon om firmaet se www.focus.no \r\n\r\n Håper dette gir svar på dine spørsmål. Er det noe uklart så vennligst gi beskjed.\r\n\r\n\r\n Med hilsen\r\n\r\n Pål Eskerud\r\n Daglig Leder\r\n\r\n Epost: pe@focus.no\r\n Mob: +4790149690\r\n www.focus.no', 339, '2012-02-03 09:44:15'),
(381, 204, 'company', 'Rune\r\n\r\n  \r\n\r\n Vi følger samme mønster som med Aarhønen. Dvs. at dere kommer ned hit ca. 18.30. Vi holder en presentasjon på ca. 1 time med servering av pizza og brus. \r\n\r\n  \r\n\r\n Dere kan bestille buss tilbake ca. 20.30 da vi setter av litt tid til å diskutere og tar en tur rundt i lokalet.\r\n\r\n  \r\n\r\n Alle er velkomne. Jeg tror agendaen styrer hvem som kommer. Vi trenger først og fremst folk med bygg, marin og maskinbakgrunn. Vi har plass til ca. 20 personer. \r\n\r\n  \r\n\r\n Agenda\r\n\r\n 1). GE et av verdens største selskaper  \r\n\r\n 2). Undervannskonstruksjoner , hva er det? 3). Piping vibrasjonsutfordringer  \r\n\r\n 4). Impact analyser på Manifold \r\n\r\n 5). Strømning i rørsystemer\r\n\r\n 6). Muligheter i GE og ansettelsesprosessen\r\n\r\n  \r\n\r\n  \r\n\r\n Regards\r\n\r\n Jomar Tørset\r\n\r\n Department Manager Trondheim\r\n\r\n GE Oil & Gas\r\n\r\n  \r\n\r\n T +47 73832621\r\n\r\n M +47 91715189\r\n\r\njomar.torset@ge.com\r\n\r\n www.geoilandgas.
com/VetcoGray\r\n\r\n  \r\n\r\n Sluppenveien 12 C\r\n\r\n 7037 Trondheim', 339, '2012-02-03 09:45:10'),
(382, 40, 'company', 'Det ser bra ut dette, vi har all nødvenig informasjon for påmeldinga.\r\n\r\nTo ting du gjerne kan spørre Focus om:\r\n\r\n- Kjem tidligere I&IKT-studenter til å vere blant dei besøkande?\r\n\r\n- Vil dei trenge intervjurom i etterkant for deira planlagte samtaler?', 293, '2012-02-03 15:40:41'),
(384, 40, 'company', 'Dei treng ikkje intervjurom. Daniel Aase kjem.', 339, '2012-02-06 12:50:12'),
(393, 381, 'profile', 'Hallo<br />', 370, '0000-00-00 00:00:00'),
(421, 120, 'company', 'Utdrag frå visittkortet til Kristin Lysebo i Vianova:\r\n\r\n""\r\nKristin Lysebo\r\nBachelor of Science\r\nHR Manager\r\n\r\nTelephone +47 67 81 70 00\r\nDirect line +47 67 81 70 69\r\nTelefax +47 67 81 70 01\r\nMobile +47 90 67 54 55\r\n\r\nkristin.lysebo@vianova.no\r\n""', 293, '2012-02-22 22:21:02'),
(396, 5, 'company', 'Capgemini har nå bestemt seg for å begrense antallet til 50 stk. Åpne for 3.-5. klasse først, deretter fylle på med 1. og 2. om det ikke er fullt. Tapas med øl/mineralvann/vin og to bonger per pers.\r\n\r\nDe har tre stillingsbeskrivelser de ønsker å få ut også, sikkert greit å slenge med i samme mailen.\r\n\r\nhttp://reca.nordic.capgemini.com/index.cfm?act=c.listAdDetail&cID=6&selAdID=2912\r\nhttp://reca.nordic.capgemini.com/index.cfm?act=c.listAdDetail&cID=6&selAdID=3082\r\n\r\nSummerinternship\r\nhttp://reca.nordic.capgemini.com/index.cfm?act=c.listAdDetail&cID=6&selAdID=3130', 353, '2012-02-10 15:05:59'),
(397, 326, 'profile', 'Hei, jeg lurer på hvordan dette ser ut', 353, '0000-00-00 00:00:00'),
(398, 66, 'company', 'Status: har ikke kontaktet bedriften pga full kapasitet på bedpresser våren 2012.', 357, '2012-02-16 22:28:33'),
(399, 145, 'company', 'Kontaktet på epost høsten 2011. Ingen respons.', 357, '2012-02-16 22:31:32'),
(400, 89, 'company', 'Status: har ikke kontaktet bedriften pga full kapasitet på bedpresser våren 2012.', 357, '2012-02-16 22:32:09'),
(401, 147, 'company', 'Kontaktet på mailskjema på hjemmesiden, høsten 2011. Nytteløst, bør kontakte HR eller ringe og få riktig kontaktinfo.', 357, '2012-02-16 22:33:43'),
(402, 149, 'company', 'Kontaktet Europa-representanten som er oppgitt på hjemmesiden, høsten 2011. Fikk ingen respons. BakerHughes har ingen oppgitte norske representanter på hjemmesiden, bør kontaktes når de er på NTNU i forbindelse med for eks IASTEs Næringslivsdager.', 357, '2012-02-16 22:38:07'),
(403, 141, 'company', 'Kontaktet en norsk representant for CERN, høsten 2011. Ingen respons. Et hett tips er å kontakte tidligere I&IKT-student Solveig Fiskaa, som nå jobber i Vianova og var på presentasjon hos oss i går. Hun har hatt sommerjobb, skrevet master og jobbet i CERN og kjenner nok til noen vi kan kontakte.', 357, '2012-02-16 22:41:22'),
(404, 140, 'company', 'Kontaktet informasjonssjef Torill Odden, høsten 2011. Ingen respons. Møtte på Torill på COWI-stand inne på stripa i september, men var ikke mulig å få noe fornuftig info ut av henne. COWI er en totalentreprenør og har kanskje ikke bruk for I&IKT-ere i stor grad, men de har IKT-avdeling og kan vær interessante.\r\n\r\nPå samme stand i september snakket jeg litt med Terje Dalheim og introduserte ham for I&IKT, han hadde ikke hørt om oss før. Terje er elektroingeniør og har derfor ikke så mye med IKT å gjøre, men kunne gjerne ta i mot mail og sende den videre til de riktige folka. \r\nReferer gjerne til samtalen vi hadde i høst, men ikke sikkert at han husker den.\r\n\r\nKontaktinfo:\r\nTerje Dalheim\r\nSiving. Elkraftteknikk\r\ntd[alfakrøll]cowi.no\r\nMobil: 97 04 40 15\r\nTlf: 73 89 60 19', 357, '2012-02-16 22:51:19'),
(405, 142, 'company', 'Status: prøvde å kontakte Baiba Ozola på nytt i høst, men da var han borte fra kontoret i flere uker så jeg fikk ingen respons. Bør kontaktes i og med at de har en interessant avdeling - "Landmark Software & Services" \r\nhttp://www.halliburton.no/newsread/index.aspx?nodeid=5128', 357, '2012-02-16 22:55:28'),
(406, 160, 'company', 'Status: Prøvde å kontakte Liv Henriksen i høst, men fikk ingen respons i august/september så fokus gikk over på andre bedrifter. Er ikke så relevante for I&IKT, bør ikke prioriteres så høyt.', 357, '2012-02-16 22:59:33'),
(407, 335, 'profile', 'Hei Filip!', 353, '0000-00-00 00:00:00'),
(408, 1, 'company', 'Oppdatert bedriftsinformasjon etter presentasjon per. 09.02.12\r\n\r\nKontaktperson:\r\nMarthe Almeland (tidligere IKT student)\r\nTel: +47 67 59 52 25  |  Mob: +47 990 30 331\r\nmarthe.almeland@akersolutions.com\r\n\r\nBedriftspresentasjonen som ble utført 09.02.12:\r\nFra KBe: Marthe, Jon og Jeanette\r\nAntall på presentasjon: 71\r\n', 356, '2012-02-20 13:02:49'),
(409, 29, 'company', 'Oppdatert kontaktinformasjon:\r\n\r\nArnulf Fuglestein \r\nmail: AFuglestein@slb.com\r\nHar ansvar for HR i stavanger (tror jeg)\r\n\r\nSnakket med han på Karrieredagene 2011. Han fikk min mail adresse, og sendte meg senere hans kontaktinformasjon. Han virket giret på bedpress, men svarte ikke på førte mail jeg sendte til han. Bedriften ble videre ikke fulgt opp ettersom vårsemesteret allerede var full av bedrifter, og jeg selv hadde 2 stk.\r\n', 356, '2012-02-20 13:06:59'),
(410, 128, 'company', 'Ikke noen svar etter siste mail, og ikke fulgt opp videre', 356, '2012-02-20 13:08:01'),
(411, 125, 'company', 'Ikke svart på intro mail, og ble ikke fulgt opp mer etter det', 356, '2012-02-20 13:08:54'),
(412, 135, 'company', 'Fikk aldri svar fra Debra Page. Bedriften ikke fulgt opp videre', 356, '2012-02-20 13:09:58'),
(413, 129, 'company', 'Skulle komme tilbake med svar, fikk aldri svar. Bedrift ikke fulgt opp videre', 356, '2012-02-20 13:10:58'),
(414, 84, 'company', 'Fikk beskjed før jul at vi kunne ta kontakt over nyåret. Dette er ikke gjort ennå.', 354, '2012-02-20 14:44:44'),
(415, 121, 'company', 'Har ikke blitt fulgt opp noe mer utover det som står i historikken.', 354, '2012-02-20 14:45:55'),
(416, 119, 'company', 'Ikke fått noe svar fra disse utover historikken.', 354, '2012-02-20 14:46:53'),
(417, 127, 'company', 'Sendt et par mailer, men aldri fått svar', 354, '2012-02-20 14:48:36'),
(418, 117, 'company', 'ikke blitt fulgt opp noe særlig utover historikken.', 354, '2012-02-20 14:51:14'),
(419, 126, 'company', 'Har sendt mail for en stund siden, men aldri fått svar. Ellers se historikk.', 354, '2012-02-20 14:52:43'),
(420, 61, 'company', 'Var opprinnelig negativ til konseptet bedriftspresentasjon, er ganske relevant for noen av oss. Ønsker ikke å betale så mye, hvertfall ikke ha mat. ', 353, '2012-02-21 12:46:46'),
(422, 56, 'news', 'rfpdrfp', 381, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hyb_gallery`
--

CREATE TABLE IF NOT EXISTS `hyb_gallery` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `imageId` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `hyb_gallery`
--

INSERT INTO `hyb_gallery` (`id`, `userId`, `title`, `imageId`, `timestamp`) VALUES
(22, 1, 'HELLO', NULL, '2011-04-03 23:24:42'),
(21, 1, 'hello', NULL, '2011-04-03 23:23:11'),
(20, 1, 'n', NULL, '2011-04-03 22:12:46'),
(19, 1, 'lol', NULL, '2011-04-03 21:37:07'),
(18, 1, 'lol', NULL, '2011-04-03 20:56:39'),
(23, 1, 'bjÃ¸rnar er bÃ¸g', NULL, '2011-04-03 23:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `hyb_rbac_assignment`
--

CREATE TABLE IF NOT EXISTS `hyb_rbac_assignment` (
  `itemname` varchar(64) collate utf8_unicode_ci NOT NULL,
  `userid` varchar(64) collate utf8_unicode_ci NOT NULL,
  `bizrule` text collate utf8_unicode_ci,
  `data` text collate utf8_unicode_ci,
  PRIMARY KEY  (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hyb_rbac_assignment`
--

INSERT INTO `hyb_rbac_assignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '367', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `hyb_rbac_item`
--

CREATE TABLE IF NOT EXISTS `hyb_rbac_item` (
  `name` varchar(64) collate utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text collate utf8_unicode_ci,
  `bizrule` text collate utf8_unicode_ci,
  `data` text collate utf8_unicode_ci,
  PRIMARY KEY  (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hyb_rbac_item`
--

INSERT INTO `hyb_rbac_item` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, '', '', 's:0:"";'),
('createNews', 0, 'Poste nyhet', '', 's:0:"";'),
('editor', 2, '', '', 's:0:"";'),
('updateNews', 0, '', '', 's:0:"";'),
('updateOwnNews', 1, '', 'return isset($params["id"]) && News::model()->findByPk($params["id"])->authorId == user()->id;', 's:0:"";'),
('updateOwnProfile', 1, '', 'return isset($params[''username'']) && isset(user()->name) && $params[''username''] == user()->name;\r\n', 's:0:"";'),
('updateProfile', 0, '', '', 's:0:"";'),
('webkom', 2, NULL, 'return Yii::app()->gatekeeper->hasGroupAccess(55);', NULL),
('writer', 2, '', '', 's:0:"";');

-- --------------------------------------------------------

--
-- Table structure for table `hyb_rbac_itemchild`
--

CREATE TABLE IF NOT EXISTS `hyb_rbac_itemchild` (
  `parent` varchar(64) collate utf8_unicode_ci NOT NULL,
  `child` varchar(64) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hyb_rbac_itemchild`
--

INSERT INTO `hyb_rbac_itemchild` (`parent`, `child`) VALUES
('webkom', 'admin'),
('writer', 'createNews'),
('admin', 'editor'),
('editor', 'updateNews'),
('updateOwnNews', 'updateNews'),
('writer', 'updateOwnNews'),
('admin', 'updateProfile'),
('updateOwnProfile', 'updateProfile'),
('admin', 'writer');

-- --------------------------------------------------------

--
-- Table structure for table `hyb_specialization`
--

CREATE TABLE IF NOT EXISTS `hyb_specialization` (
  `id` int(11) NOT NULL auto_increment,
  `siteId` int(11) default NULL,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `siteId` (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `hyb_specialization`
--

INSERT INTO `hyb_specialization` (`id`, `siteId`, `name`) VALUES
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
-- Table structure for table `hyb_user`
--

CREATE TABLE IF NOT EXISTS `hyb_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(10) collate utf8_unicode_ci NOT NULL,
  `firstName` varchar(75) collate utf8_unicode_ci NOT NULL,
  `middleName` varchar(75) collate utf8_unicode_ci default NULL,
  `lastName` varchar(75) collate utf8_unicode_ci NOT NULL,
  `specializationId` int(11) default NULL,
  `graduationYear` year(4) default NULL,
  `member` enum('true','false') collate utf8_unicode_ci NOT NULL,
  `gender` enum('unknown','male','female') collate utf8_unicode_ci NOT NULL default 'unknown',
  `imageId` int(11) default NULL,
  `phoneNumber` int(11) default NULL,
  `lastLogin` datetime default NULL,
  `cardinfo` varchar(10) collate utf8_unicode_ci default NULL,
  `description` text collate utf8_unicode_ci,
  `workDescription` text collate utf8_unicode_ci,
  `workCompanyID` int(11) default NULL,
  `workPlace` varchar(255) collate utf8_unicode_ci default NULL,
  `birthdate` date default NULL,
  `altEmail` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=469 ;

--
-- Dumping data for table `hyb_user`
--

INSERT INTO `hyb_user` (`id`, `username`, `firstName`, `middleName`, `lastName`, `specializationId`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `lastLogin`, `cardinfo`, `description`, `workDescription`, `workCompanyID`, `workPlace`, `birthdate`, `altEmail`) VALUES
(381, 'sigurhol', 'Sigurd', 'Andreas', 'Holsen ', NULL, 2015, 'true', 'male', NULL, NULL, '2012-02-25 14:47:19', '123123', '<br />', '<br />', NULL, '', '1990-12-23', 'sighol@gmail.com'),
(466, 'admin', 'ad', 'm', 'in', NULL, 2000, 'true', 'unknown', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) collate utf8_unicode_ci default NULL,
  `oldName` varchar(255) collate utf8_unicode_ci NOT NULL,
  `galleryId` int(11) default NULL,
  `userId` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `albumId` (`galleryId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `title`, `oldName`, `galleryId`, `userId`, `timestamp`) VALUES
(1, '', 'gtfo.jpg', -1, 1, '2011-02-26 18:34:29'),
(2, '', 'Untitled.jpg', -1, 1, '2011-02-26 21:07:15'),
(4, 'Koala!', 'Koala.jpg', -1, 327, '2011-03-21 18:39:21'),
(5, 'Sommer', 'sommer', -1, 327, '2011-07-21 21:04:59');

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
  `ingress` text collate utf8_unicode_ci,
  `content` mediumtext collate utf8_unicode_ci,
  `authorId` int(11) default NULL,
  `timestamp` datetime default NULL,
  `status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parentId` (`parentId`,`authorId`),
  KEY `author` (`authorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=365 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `parentId`, `parentType`, `title`, `imageId`, `ingress`, `content`, `authorId`, `timestamp`, `status`) VALUES
(40, 71, 'event', 'Åretur 2012', 0, 'Hybrider! Da har det duket for årets høydepunkt, vinterens villeste eventyr: Åretur!!!', 'Som de siste tre årene vil turen være i uke 5, eller for alle oss andre som hater ukesystemet: <strong>29. jan - 2. feb 2012. </strong> I år har vi fått boplass i Åre fjellby, rett ved trekket og utesteder, altså helt ypperlig!\n<br /><br />\nTuren kommer på <strong> ca 2000kr </strong> per pers og inkluderer:\n<br /><br /><ul><li>\nTur/retur Åre sentrum\n</li><li>\n4 netters opphold\n</li><li>\n5 dagers skipass \n</li><li>\nrabattkort</li><li>mye fest og moro!\n<br /></li></ul><br />\nVi har <strong>47 plasser </strong>, så her er det førstemann til mølla som gjelder! \n<br /><br /> OBS! OBS! Videre info vil de påmeldte få via mail. Som tiden for avgang, når vi er tilbake, hytteoversikt, hyttefordeling, betalingsinfo med nøyaktig pris osv. Og for de som ikke vet det, her snakker vi helt bindende påmelding. <br /><br />', 326, '2011-07-17 22:34:51', 0),
(41, 73, 'event', 'Generalforsamling', 4, 'Generalforsamling i Hybrida', '', 326, '2011-11-10 21:14:21', 0),
(56, NULL, NULL, 'Nytt styre', NULL, 'Vil gratulere de nye styremedlemmene med valget', '<p>\n   <strong>Festivalus</strong> - Sigbjørn Aukland\n</p>\n<p>\n   <strong>Skattemester</strong> - Tonje Sundstrøm\n</p>\n<p>\n   <strong>Vevsjef</strong> - Sigurd Holsen\n</p>\n<p>\n   <strong>SPR</strong> - Erik Aasmundrud\n</p>', 363, '2011-11-26 20:02:14', 0),
(362, 83, 'event', 'Eksempelarrangement', NULL, 'Dette skjer om veeldig lenge', 'BLa bla bla<br />', 381, '2012-02-09 11:41:25', 0),
(364, 85, 'event', 'Halvingfest!', NULL, 'Tredje klasse feirer sin halvferdige universitetsutdannelse med en herlig middag på Lyche.', '<p>Maten blir servert kl 20.00 (hver der ca en halvtime før) og de flotte\n	tredjeklassingene dukker opp i relativt fin stas så koser vi oss!</p>\n<p>Påmelding skjer her, husk at den er bindende. <u>Ved påmelding må du også sende en\n	mail til halvingfest@gmail.com med menyen du ønsker.</u> Valg av hovedretter er:</p>\n<p><strong>Lycheburger </strong>Lyches ubestridte klassiker. Med\n	aioli, pistou, bacon, cheddarost og paprikasalsa. Serveres med ovnsbakte mandelpoteter.\n	kr 109.</p>\n<p><strong>Vegetarburger</strong> Lyches vegetarburger. Med aioli,\n	pistou, cheddarost, salat og paprikasalsa. Serveres med ovnsbakte mandelpoteter.\n	 kr 99</p>\n<p><strong>Confiterte andelår</strong> Langtidsstekt, sprøtt andelår.\n	Serveres med ovnsbakte grønnsaker, pastinakkpuré, appelsinsaus og ovnsbakte\n	mandelpoteter. kr 129</p>\n<p><strong>Ovnsbakt lakseloin</strong> Lakseloin med
ovnsbakte\n	grønnsaker og mandelpoteter, samt pastinakkpuré. Toppes med mandelvinaigrette. kr\n	129</p>\n<p><strong><em>Dessertvalg:</em></strong></p>\n<p><strong>Sjokoladelyche</strong><br />\n	Konfektkake av fyldig sjokolade, med pisket krem og bærsaus. kr\n	45</p>\n<p><strong>Panna cotta</strong><br />\n	Panna cotta med bærsaus. kr 35</p>\n<p><br /></p>\n<p>Betaling skjer på Hybridas konto:\n	0539.26.44913 Prisen\n	avhenger av hvilken rett du velger. Summer selv og overfør til konto merket med navn +\n	halvingfest</p>\n<p><br /></p>', 367, '2012-02-17 19:09:39', 0);

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
  `status` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`eventId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`eventId`, `spots`, `open`, `close`, `signoff`, `status`) VALUES
(71, 47, '2011-12-07 22:25:40', '2012-01-01 22:35:00', 'false', 0),
(73, 200, '2011-11-20 00:00:00', '2011-11-24 17:00:00', 'false', 0),
(82, 510, '2011-10-12 00:00:00', '2012-05-11 00:00:00', 'true', 2),
(83, 1000, '2012-02-09 00:00:00', '2013-03-15 00:00:00', 'true', 0),
(85, 50, '2012-02-17 19:10:29', '2012-02-21 15:00:00', 'false', 0),
(86, 25, '2012-02-08 10:00:00', '2012-02-20 03:30:00', 'false', 0),
(87, 50, '2012-02-15 17:00:00', '2012-02-22 17:00:00', 'false', 0),
(88, 50, '2011-12-02 17:00:00', '2012-05-06 17:00:00', 'false', 0);

-- --------------------------------------------------------

--
-- Table structure for table `signup_membership`
--

CREATE TABLE IF NOT EXISTS `signup_membership` (
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `signedOff` enum('true','false') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`eventId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `signup_membership`
--

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hyb_rbac_assignment`
--
ALTER TABLE `hyb_rbac_assignment`
  ADD CONSTRAINT `hyb_rbac_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `hyb_rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hyb_rbac_itemchild`
--
ALTER TABLE `hyb_rbac_itemchild`
  ADD CONSTRAINT `hyb_rbac_itemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `hyb_rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hyb_rbac_itemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `hyb_rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
