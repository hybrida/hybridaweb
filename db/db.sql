-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2012 at 09:25 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.3-7+squeeze8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hybrida_dev`
--
CREATE DATABASE `hybrida_dev` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hybrida_dev`;

-- --------------------------------------------------------

--
-- Table structure for table `access_relations`
--

CREATE TABLE IF NOT EXISTS `access_relations` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `type` enum('article','event','image','news','signup') COLLATE utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`type`,`access`,`sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `access_relations`
--

INSERT INTO `access_relations` (`id`, `access`, `type`, `sub_id`) VALUES
(24, 4055, 'news', 0),
(40, 2, 'news', 0),
(41, 2, 'news', 0),
(85, 2014, 'signup', 1),
(85, 4055, 'signup', 0);

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shorttitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `author` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=62 ;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `parentId`, `title`, `shorttitle`, `content`, `author`, `timestamp`) VALUES
(1, NULL, 'Hybrida', NULL, '<p>\n	Foreningens formål er å fremme samhold og kameratskap innad på studieprogrammet ved bla.a. å avholde arrangementer av både sosial og faglig karakter. Mer informasjon om oss finner du under menyen til venstre.<br /><br /><img alt="Hybrida logo" src="http://www.hybrida.ntnu.no/filer/logo.png" /></p>\n<p>\n	Last ned logoen som <a href="http://www.hybrida.ntnu.no/filer/logo.psd">.psd</a> eller <a href="http://www.hybrida.ntnu.no/filer/logo.ai">.ai</a></p>\n', 0, '0000-00-00'),
(2, NULL, 'Bedrift', NULL, '<h1>Bedriftskontakt</h1>\n<strong>Hybridas Bedriftskomite (Hybrida BedKom) har ansvaret for kontakten med bedriftene for sivilingeniørstudiet Ingeniørvitenskap og IKT (I &amp; IKT) ved NTNU. Vi ble etablert for å gi bedrifter informasjon om vårt studieprogram og hvilken kompetanse vi kan bidra med.</strong>\n<p>Hovedmålet vårt er at vi vil hjelpe studentene på linja med prosjektoppgaver, hovedoppgaver, sommerjobber og fast ansettelse. I tillegg kan bedriftsbesøk, ekskursjoner og temakvelder gi bedrifter og studenter mulighet til å snakke sammen.</p>\n<p>Arrangementer av denne typen krever samarbeid fra bedrifter. Hvis du kan bidra, kontakt oss gjerne via linken i menyen venstre. For en komplett liste med Hybrida Bedkoms oppgaver og gjøremål, se våre statutter i samme meny.</p>\n<h2>Bedriftsbesøk:</h2>\n<p>Et bedriftsbesøk går i hovedsak ut på at bedriften besøker NTNU for å presentere seg for studentene. Et typisk bedriftsbesøk innebærer først og fremst en presentasjon der bedriften holder \nforedrag for utvalgte studenter. I tillegg er det vanlig med påfølgende bespisning, og mange bedrifter velger å ha jobbsamtaler/intervjuer tilknyttet besøket.</p>\n<p>Hensikten er vanligvis først og fremst rekruttering, men et bedriftsbesøk gir også god markedsføring mot kommende sivilingeniører. Hybrida BedKom tar seg av all praktisk organisering  dere trenger kun å møte opp forberedt med presentasjon!</p>\n<h2>Presentasjon:</h2>\n<p>Presentasjonen varer vanligvis i én skoletime (45 minutter) og avholdes oftest i auditorium. Her er de fleste audiovisuelle hjelpemidler tilgjengelig (PC/projektor, mikrofoner, overhead osv), og dersom dere har spesielle ønsker vil vi selvsagt forsøke å etterkomme disse. De fleste presentasjoner begynner 17:15 eller 18:15, da dette passer godt med timeplanen til studentene.</p>\n<h2>Bespisning:</h2>\n<p>De aller fleste bedrifter velger å spandere mat og drikke etter presentasjonen. Her har vi flere samarbeidspartnere og kan blant annet tilby rimelige alternativer fra \nSiT (Studentsamskipnaden i Trondheim), som holder til på Gløshaugen. Noen bedrifter ønsker fri bar, andre vil ha et fast antall enheter i form av drikkebonger. Bespisningen gir bedriften en fin mulighet til å snakke direkte med studentene i uformelle omgivelser. Det er ofte i den forbindelse interesserte melder seg på til jobbsamtaler.</p>\n<h2>Tips:</h2>\n<p>Dette er tips basert på tilbakemeldinger vi har fått fra studenter over flere år:\n</p><ul><li>Husk at dere snakker for I &amp; IKT-studenter. Ikke vær redd for å bruke fagbegreper de burde kjenne til.</li>\n	<li>Forsøk å skille dere ut fra andre bedrifter  hva er det som gjør nettopp dere til den mest attraktive arbeidsgiveren?</li>\n	<li>Fokuser på hvordan det er å arbeide i deres bedrift  sosialt, arbeidsoppgaver, arbeidsmiljø, utfordringer Vis gjerne bilder fra arbeidsplassen.</li>\n	<li>Organisasjonsinndeling, økonomi og administrasjon er ofte mindre interessant når det kommer til å velge jobb. Forsøk å legg mindre vekt på dette enn de \novernevnte punkter.</li>\n	<li>Begrens presentasjonen til 45 minutter.</li>\n	<li>Ta med en nyutdannet sivilingeniør fra NTNU, samt en fra HR.</li>\n	<li>Still med flere personer, slik at dere er lette å komme i kontakt med under bespisningen.</li>\n</ul><h2>Priser:</h2>\n<p></p><p>Hybrida BedKom tar et honorar på kroner 10 000,- for en full bedriftspresentasjon som holdes for alle klassetrinn ved studiet. Dette inkluderer PR-kostnader og liknende. Mat og drikke kommer i tillegg. Priser fra ulike leverandører fåes ved forespørsel. Hvis bedriften ønsker en presentasjon for mindre grupper innenfor I &amp; IKT (typisk en av spesialiseringene), kan dette selvsagt ordnes etter avtale. Slike arrangement tar vi selvsagt et lavere honorar for.</p>', 331, '2011-11-01'),
(56, 1, 'Lenker', NULL, '<p>\n</p><table cellspacing="6"><tr><td width="150"><a href="http://www.ntnu.no/studier/ingeniorvitenskap-ikt">I &amp; IKT på ntnu.no</a>\n</td>\n<td>\nRekrutterings- og infosider.\n</td></tr><tr><td>\n<a href="http://www.ntnu.no/studieinformasjon/timeplan/">Timeplaner</a>\n</td><td>\nTimeplanene til alle klassetrinn.\n</td></tr><tr><td>\n<a href="http://www.ntnu.no/studentservice/">Studentservice</a>\n</td><td>\nSvarer på alle spørsmål du måtte ha som NTNU-student.\n</td></tr><tr><td>\n<a href="http://www.studweb.ntnu.no">ITEAs infoweb</a>\n</td><td>\nInformasjonsbase for IT-systemet\n</td></tr><tr><td>\n<a href="http://www.orakel.ntnu.no">Orakeltjenesten</a>\n</td><td>\nSupport for IT-systemer under NTNU\n</td></tr><tr><td>\n<a href="http://www.samfundet.no">\nStudentersamfundet i Trondhjem</a>\n</td><td>\nNorges største og studentersamfunn.\n</td></tr><tr><td>\n<a href="http://www.universitetsavisa.no">Universitesavisa</a>\n</td><td>\nNyheter fra campus.\n</td></tr><tr><td>\n<a href="http://www.underdusken.no">Under Dusken</a>\n</td><td>\nTrondheims studentavis\n</td></tr><tr><td>\n<a href="http://www.studentrad.no/">Studentrådene</a>\n</td><td>\nStudentrådene ved NTNU\n</td></tr></table>', 381, '2012-03-07'),
(53, 1, 'Internavis', NULL, '<p>Her finner du oversikt over alle utgaver av Hybridas egen internavis, Update<sup>k</sup>.</p><p>\n<a href="http://www.hybrida.ntnu.no/hybridaweb/hybrida/Internavis/2007">2007</a><br /><a href="http://www.hybrida.ntnu.no/hybridaweb/hybrida/Internavis/2008">2008</a><br /><a href="http://www.hybrida.ntnu.no/hybridaweb/hybrida/Internavis/2009">2009</a><br /><a href="http://www.hybrida.ntnu.no/hybridaweb/hybrida/Internavis/2010">2010</a><br /><a href="http://www.hybrida.ntnu.no/hybridaweb/hybrida/Internavis/2011">2011</a><br /></p>', 381, '2012-03-07'),
(54, 53, '2007', NULL, '<table><tr><td>\n		<a href="http://www.hybrida.ntnu.no/filer/avis/Update-ikt-1.utg.pdf"><img src="/bilder/update/update107.png" alt="updateUtgave107" /></a><br /><a href="http://www.hybrida.ntnu.no/filer/avis/Update-ikt-1.utg.pdf">1. Utgave</a>\n		</td>\n	</tr><tr><td>\nAnsvarlig redaktør 2007: <a href="mailto:thorvag%20%C3%A6%20stud.ntnu.no">Thorvald C Grindstad</a> \n</td>\n</tr></table><br />', 381, '2012-03-07'),
(55, 1, 'Kontaktinfo', NULL, '<p><b>Hovedstyret</b>: <a href="mailto:hybrida%20%C3%A6%20org.ntnu.no">hybrida æ org.ntnu.no</a> (også som msn)\n<br /><br /><b>Leder</b>: <a href="mailto:hybrida-leder@org.ntnu.no">Ole Magnus Urdahl </a>\n<br /><a href="mailto:hybrida-leder@org.ntnu.no">hybrida-leder@org.ntnu.no </a>\n<br />\nTlf: +4748241251\n</p>\n\n<h3>Kontor</h3> \nKjelleren i Gamle Kjemi, rom 19<br />\nKolbjørn Hejes vei 4<br />\nTlf: 73 55 05 41\n\n<h3>Postadresse</h3>\nAlfred Getz'' vei 3<br />\nSB 1<br />\n7034 Trondheim<br />', 381, '2012-03-07'),
(57, 1, 'Sanger', NULL, '<h1>Nu klinger igjennom den gamle stad</h1>\n\n<p>Nu klinger igjennom den gamle stad<br /> \npå ny en studentersang,<br /> \nog alle mann alle i rekke og rad <br />\nsvinger op under begerklang, <br />\nOg mens borgerne våkner i køia <br />\nog hører den glade kang-kang, <br />\nsynger alle mann, alle mann, alle mann, <br />\nalle mann, alle mann, alle mann. <br /></p>\n<p>\nRefr : <br />\nStudenter i den gamle stad, <br />\nta vare på byens ry. (dunk, dunk)<br />\nHusk på at jenter, øl og dram <br />\nvar kjempernes meny. <br />\nOg faller I alle mann alle, <br />\nskal det gjalle fra alle mot sky: <br />\nLa´kke byen få ro, <br />\nmen la den få merke <br />\nden er en studenterby. <br />\nog øl og dram, og øl og dram,<br />\nog øl og dram, og øl og dram..<br /></p>\n\n<p>\nI den gamle staden satt <br />\nså mangen en konge stor <br />\nog hadde nok av øl fra fat,<br /> \nog piker ved sitt bord. <br />\nOg de laga bøljer i gata, <br />\nnår hjem i fra gilde de for, <br />\nog nu sitter de alle mann alle i Valhall og traller til oss i kor: <br /></p>\n<p>\nRefr: Studenter ..\n</p>\n\n<p>En mp3-versjon av denne sangen finnes også til nedlasting: <a href="http://www.hybrida.ntnu.no/filer/Studenter_i_den_gamle_stad.mp3">Studenter_i_den_gamle_stad.mp3</a></p>', 381, '2012-03-07'),
(58, 1, 'Statutter', NULL, '<a href="http://folk.ntnu.no/bjorask/hybridaweb/statutter16112010.pdf">Hybridas Statutter</a><br /><br /><a href="http://folk.ntnu.no/bjorask/hybridaweb/StatutterBedKom.pdf">Bedriftskomiteens statutter</a>', 381, '2012-03-07'),
(59, 1, 'Styret og stell', NULL, '<strong>Dette er de syv styremedlemmene som pr dags dato har hovedansvaret for å holde liv i linjeforeningen</strong>\nStyrets mailadresse: <a href="mailto:hybrida%20%C3%A6%20org.ntnu.no">hybrida æ org.ntnu.no</a>\n<p>\n<strong>LEDER:</strong> <br /><a href="mailto:urdahl%20%C3%A6%20stud.ntnu.no">Ole Magnus Urdahl</a> 3. kl<br />\nHar det overordnede ansvaret i Hybrida. \n</p><p>\n<strong>NESTLEDER:</strong> <br /><a href="mailto:oysteith%20%C3%A6%20stud.ntnu.no">Øystein Sunde Thomassen</a> 3. kl<br />\nSamarbeider med lederen om det organisatoriske og administrative ansvaret i styret.\n</p><p>\n<strong>SKATTMESTER:</strong><br /><a href="mailto:torkvest%20%C3%A6%20stud.ntnu.no">Tor Kvestad Idland\n</a>2. kl<br />\nAnsvaret for pengestrømmen inn og, sannsynligvis mest, ut.\n</p><p>\n<strong>FESTIVALUS:</strong> <br /><a href="mailto:wermunds%20%C3%A6%20stud.ntnu.no">Tone Wermundsen\n</a> 2. kl<br />\nAnsvaret for det som blir arrangert av fester, turer og diverse andre arrangementer.\n</p><p>\n<strong>BK-SJEF:</strong> <br /><a href="mailto:franse%20%C3%A6%20stud.ntnu.no">Frans Erstad</a> 3. kl<br />\nFikser og ordner med profileringen av linja og linjeforeningen utad til bedrifter og næringslivet generelt.\n</p><p>\n<strong>VEVSJEF:</strong><br /><a href="mailto:bjorask%20%C3%A6%20stud.ntnu.no">Bjørnar Askevold</a> 2.kl<br />\nAnsvar for utvikling og drift av nettsidene samt informasjonsflyten i linjeforeningen.\n</p><p>\n<strong>JENTEKOMITÉSJEF:</strong> <br /><a href="mailto:gurikaro%20%C3%A6%20stud.ntnu.no">Guri Karoline Sørbø</a> 2. kl<br />\nSjef for jentekomiteen.</p>', 381, '2012-03-07'),
(61, 55, 'Kontoret', NULL, '<table border="0" cellspacing="1"><tr><th>Fra hovedbygget:</th>\n<th></th>\n<th>Fra stripa, sentralbygget, realfagsbygget, lesesalen:</th>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/1a_fra_plenen.jpg" alt="1a_fra_plenen.jpg" /></td>\n<td></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/1b_fra_stripa.jpg" alt="1b_fra_stripa.jpg" /></td>\n\n</tr><tr><td>1a) Dette ser du når du kommer<br /> fra plenen bak hovedbygget.<br /></td>\n<td></td>\n<td>1b) Dette ser du når du kommer<br /> fra stripa/sentralbygget.<br /></td>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/2_dor_1.jpg" alt="2_dor_1.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/3_trapp.jpg" alt="3_trapp.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/4_dor_2.jpg" alt="4_dor_2.jpg" /></td>\n</tr><tr><td>2) Gå inn denne døra.<br /></td>\n<td>3) Gå ned denne trappa.<br /></td>\n<td>4) Ta til høyre og gå inn denne døra.<br /></td>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/5_dorhandtak.jpg" alt="5_dorhandtak.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/6_gang.jpg" alt="6_gang.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/7_kontoret.jpg" alt="7_kontoret.jpg" /></td>\n</tr><tr><td>5) Den er åpen frem til klokka 16.</td>\n<td>6) Gå inn denne gangen.</td>\n<td>7) Gå inn andre dør til høyre.</td>\n</tr></table>', 381, '2012-03-07'),
(60, 59, 'Referater', NULL, '<h3>\n	Høstsemesteret 2009</h3>\n<ul><li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h09/Referat_23_november_2009.pdf">Møte 23.november</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h09/Referat_09_november_2009.pdf">Møte 09.november</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h09/Referat_26_oktober_2009.pdf">Møte 26.oktober</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h09/Referat_14_oktober_2009.pdf">Møte 14.oktober</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h09/Referat_21_september_2009.pdf">Møte 21.september</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h09/Referat_07_september_2009.pdf">Møte 07.september</a></li>\n</ul><h3>\n	Vårsemesteret 2009</h3>\n<ul><li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v09/Referat_06_mai_2009.pdf">Møte 06. mai</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v09/Referat_24_april_2009.pdf">Møte 24. april</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v09/Referat_27_mars_2009.pdf">Møte 27. mars</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v09/Referat_13_mars_2009.pdf">Møte 13. mars</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v09/Referat_27_februar_2009.pdf">Møte 27. februar</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v09/Referat_13_februar_2009.pdf">Møte 13. februar</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v09/Referat_06_februar_2009.pdf">Møte 06. februar</a></li>\n</ul><h3>\n	Høstsemesteret 2008</h3>\n<ul><li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_18_november_2008.pdf">Møte 18. november</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_11_november_2008.pdf">Møte 11. november</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Generalforsamling_10_november_2008.pdf">Generalforsamling 10. november</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_4_november_2008.pdf">Møte 4. november</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_28_oktober_2008.pdf">Møte 28. oktober</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_21_oktober_2008.pdf">Møte 21. oktober</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_%207_oktober_2008.pdf">Møte 7. oktober</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_30_september_2008.pdf">Møte 30. september</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_23_september_2008.pdf">Møte 23. september</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_9_september_2008.pdf">Møte 9. september 2008</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h08/Referat_27_august_2008.pdf">Møte 27. august 2008</a></li>\n</ul><h3>\n	Vårsemesteret 2008</h3>\n<ul><li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v08/Referat_13_mai_2008.pdf">Møte 13. mai 2008</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v08/Referat_25_april_2008.pdf">Møte 25. april 2008</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v08/Referat_Generalforsamling_16_april_2008.pdf">Generalforsamling 16. april 2008</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v08/Referat_11_april_2008.pdf">Møte 11. april 2008</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v08/Referat_4_april_2008.pdf">Møte 4. april 2008</a></li>\n</ul><h3>\n	Høstsemesteret 2007</h3>\n<h3>\n	Vårsemesteret 2007</h3>\n<ul><li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v07/hybrida_mote_24-04-2007.pdf">Møte 24. april 2007</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v07/hybrida_mote_17-04-2007.pdf">Møte 17. april 2007</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v07/hybrida_genfors_27-03-2007.pdf">Generalforsamling 27. mars 2007</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/v07/hybrida_mote_14-01-2007.pdf">Møte 14. januar 2007</a></li>\n</ul><h3>\n	Høstsemesteret 2006</h3>\n<ul><li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_06-11-2006.pdf">Møte 06. november 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_30-10-2006.pdf">Møte 30. oktober 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_23-10-2006.pdf">Møte 23. oktober 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_16-10-2006.pdf">Møte 16. oktober 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_09-10-2006.pdf">Møte 09. oktober 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_02-10-2006.pdf">Møte 02. oktober 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_25-09-2006.pdf">Møte 25. september 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_18-09-2006.pdf">Møte 18. september 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_29-08-2006.pdf">Møte 29. august 2006</a></li>\n	<li>\n		<a href="http://www.hybrida.ntnu.no/filer/referater/h06/hybrida_mote_10-08-2006.pdf">Møte 10. august 2006</a></li>\n</ul>', 381, '2012-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `bk_company`
--

CREATE TABLE IF NOT EXISTS `bk_company` (
  `companyID` int(11) NOT NULL AUTO_INCREMENT,
  `adress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  PRIMARY KEY (`companyID`),
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
  PRIMARY KEY (`companyId`,`specializationId`)
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

--
-- Dumping data for table `bk_company_update`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `parentType` enum('profile','gallery','image','group','company','news') COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `authorId` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`,`authorId`),
  KEY `author` (`authorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=434 ;

--
-- Dumping data for table `comment`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bpcID` int(11) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `location` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bpcID` (`bpcID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=96 ;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `bpcID`, `start`, `end`, `location`, `status`) VALUES
(71, NULL, '2012-01-29 07:00:00', '2012-02-02 20:00:00', 'Åre', 0),
(73, NULL, '2011-11-25 18:15:00', '2011-11-26 13:00:00', 'Gløs', 0),
(82, NULL, '2012-03-08 00:00:00', '2012-06-07 00:00:00', 'Åre', 2),
(83, NULL, '2012-12-01 00:00:00', '2013-04-06 00:00:00', 'Kontoret', 0),
(85, NULL, '2012-02-25 20:00:54', '2012-02-26 02:00:00', 'Lyche', 0),
(89, NULL, '2012-03-21 14:00:00', '2012-03-21 19:00:00', '', 0),
(90, NULL, '2012-03-28 11:15:42', '2012-03-29 00:00:00', '', 0),
(91, 378, '2012-04-19 18:15:00', '2012-04-19 18:15:00', NULL, 0),
(92, NULL, '2012-04-17 00:00:00', '2012-04-18 00:00:00', 'Kontoret', 0),
(93, NULL, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'NTNU', 0),
(94, NULL, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'Sted', 0),
(95, NULL, '2012-04-01 06:35:00', '2012-04-01 19:30:00', 'Her!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fb_user`
--

CREATE TABLE IF NOT EXISTS `fb_user` (
  `userId` int(11) NOT NULL,
  `fb_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postEvents` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `imageId` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `userId`, `title`, `imageId`, `timestamp`) VALUES
(22, 1, 'HELLO', NULL, '2011-04-03 23:24:42'),
(21, 1, 'hello', NULL, '2011-04-03 23:23:11'),
(20, 1, 'n', NULL, '2011-04-03 22:12:46'),
(19, 1, 'lol', NULL, '2011-04-03 21:37:07'),
(18, 1, 'lol', NULL, '2011-04-03 20:56:39'),
(23, 1, 'bjÃ¸rnar er bÃ¸g', NULL, '2011-04-03 23:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `group_membership`
--

CREATE TABLE IF NOT EXISTS `group_membership` (
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comission` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`userId`,`groupId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_membership`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

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
-- Table structure for table `image`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `title`, `oldName`, `galleryId`, `userId`, `timestamp`) VALUES
(21, 'zombie.jpg', 'zombie.jpg', NULL, 397, '2012-04-24 16:24:56'),
(20, 'Lyche-thumb.jpg', 'Lyche-thumb.jpg', NULL, 381, '2012-04-23 22:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE IF NOT EXISTS `menu_group` (
  `group` int(11) NOT NULL,
  `site` int(11) NOT NULL,
  `contentId` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`group`,`site`)
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
  `menu` int(11) NOT NULL AUTO_INCREMENT,
  `site` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`menu`,`site`)
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
  `id` int(11) DEFAULT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `parentType` enum('event','article','group') COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imageId` int(11) DEFAULT NULL,
  `ingress` text COLLATE utf8_unicode_ci,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `authorId` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`,`authorId`),
  KEY `author` (`authorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=373 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `parentId`, `parentType`, `title`, `imageId`, `ingress`, `content`, `authorId`, `timestamp`, `status`) VALUES
(40, 71, 'event', 'Åretur 2012', NULL, 'Hybrider! Da har det duket for årets høydepunkt, vinterens villeste eventyr: Åretur!!!', '<p>\n	Som de siste tre årene vil turen være i uke 5, eller for alle oss andre som hater ukesystemet: <strong>29. jan - 2. feb 2012. </strong> I år har vi fått boplass i Åre fjellby, rett ved trekket og utesteder, altså helt ypperlig!<br /><br />\n	Turen kommer på <strong> ca 2000kr </strong> per pers og inkluderer:<br />\n	 </p>\n<ul><li>\n		Tur/retur Åre sentrum</li>\n	<li>\n		4 netters opphold</li>\n	<li>\n		5 dagers skipass</li>\n	<li>\n		rabattkort</li>\n	<li>\n		mye fest og moro!</li>\n</ul><br /><p>\n	Vi har <strong>47 plasser </strong>, så her er det førstemann til mølla som gjelder!<br /><br />\n	 OBS! OBS! Videre info vil de påmeldte få via mail. Som tiden for avgang, når vi er tilbake, hytteoversikt, hyttefordeling, betalingsinfo med nøyaktig pris osv. Og for de som ikke vet det, her snakker vi helt bindende påmelding. <br />\n	 </p>\n', 326, '2011-07-17 22:34:51', 0),
(41, 73, 'event', 'Generalforsamling', NULL, 'Generalforsamling i Hybrida', '', 326, '2011-11-10 21:14:21', 0),
(56, NULL, NULL, 'Nytt styre', NULL, 'Vil gratulere de nye styremedlemmene med valget', '<p>\n   <strong>Festivalus</strong> - Sigbjørn Aukland\n</p>\n<p>\n   <strong>Skattemester</strong> - Tonje Sundstrøm\n</p>\n<p>\n   <strong>Vevsjef</strong> - Sigurd Holsen\n</p>\n<p>\n   <strong>SPR</strong> - Erik Aasmundrud\n</p>', 363, '2011-11-26 20:02:14', 0),
(362, 83, 'event', 'Eksempelarrangement', NULL, 'Dette skjer om veeldig lenge', 'BLa bla bla<br />', 381, '2012-02-09 11:41:25', 0),
(364, 85, 'event', 'Halvingfest!', 20, 'Tredje klasse feirer sin halvferdige universitetsutdannelse med en herlig middag på Lyche.', '<p>\n	Maten blir servert kl 20.00 (hver der ca en halvtime før) og de flotte tredjeklassingene dukker opp i relativt fin stas så koser vi oss!</p>\n<p>\n	Påmelding skjer her, husk at den er bindende. <u>Ved påmelding må du også sende en mail til halvingfest@gmail.com med menyen du ønsker.</u> Valg av hovedretter er:</p>\n<p>\n	<strong>Lycheburger </strong>Lyches ubestridte klassiker. Med aioli, pistou, bacon, cheddarost og paprikasalsa. Serveres med ovnsbakte mandelpoteter. kr 109.</p>\n<p>\n	<strong>Vegetarburger</strong> Lyches vegetarburger. Med aioli, pistou, cheddarost, salat og paprikasalsa. Serveres med ovnsbakte mandelpoteter.  kr 99</p>\n<p>\n	<strong>Confiterte andelår</strong> Langtidsstekt, sprøtt andelår. Serveres med ovnsbakte grønnsaker, pastinakkpuré, appelsinsaus og ovnsbakte mandelpoteter. kr 129</p>\n<p>\n	<strong>Ovnsbakt lakseloin</strong> Lakseloin med ovnsbakte grønnsaker og mandelpoteter, samt pastinakkpuré. Toppes med mandelvinaigrette. kr 129</p>\n<p>\n	<strong><em>Dessertvalg:</em></strong></p>\n<p>\n	<strong>Sjokoladelyche</strong><br />\n	Konfektkake av fyldig sjokolade, med pisket krem og bærsaus. kr 45</p>\n<p>\n	<strong>Panna cotta</strong><br />\n	Panna cotta med bærsaus. kr 35</p>\n<p>\n	 </p>\n<p>\n	Betaling skjer på Hybridas konto: 0539.26.44913 Prisen avhenger av hvilken rett du velger. Summer selv og overfør til konto merket med navn + halvingfest</p>\n<p>\n	 </p>\n', 367, '2012-02-17 19:09:39', 0),
(365, 89, 'event', 'Event bare for Facebook', NULL, 'Testevent for facebook posting.', '<p>\n	sdfghjklø</p>\n', 347, '2012-03-19 17:10:36', 0),
(366, 90, 'event', 'TestEvent', NULL, '', '<p>\n	Testing testing, 1 2 3</p>\n', 347, '2012-03-23 11:17:41', 0),
(367, 91, 'event', 'Bedpres: Aker Solutions MMO', NULL, '', '<p>http://www.akersolutions.com/</p>\n', NULL, '2012-04-07 17:08:20', 0),
(368, 92, 'event', 'Facebook-testing', NULL, '', '<p>\n	Testevent</p>\n<p>\n	<img alt="" src="http://farm6.staticflickr.com/5340/6934930078_763319e3bf.jpg" /> Dette er et bilde fra http://www.flickr.com/photos/oscarvaladares/6934930078/</p>\n', 347, '2012-04-16 17:14:09', 0),
(369, 93, 'event', 'Facebooktesting 2', NULL, 'Liten ingress', '<p>\n	Testevent</p>\n<p>\n	<img alt="" src="http://farm6.staticflickr.com/5340/6934930078_763319e3bf.jpg" /></p>\n<p>\n	Dette bildet er tatt fra <a href="">http://www.flickr.com/photos/oscarvaladares/6934930078/</a></p>\n', 381, '2012-04-16 18:43:00', 0),
(370, 94, 'event', 'Beklager all spammingen', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas facilisis vulputate magna at ultricies. Aliquam in massa ut mi sodales imperdiet tempor ac mauris. Nulla facilisi. Mauris vitae dolor odio. Aenean sodales congue sodales. Sed id libero metus. Vivamus magna mauris, dictum et consequat mattis, bibendum non metus. Fusce eu neque lacus. Suspendisse sollicitudin mi at felis sollicitudin dapibus.', '<p>\n	aw</p>\n', 381, '2012-04-16 19:06:38', 0),
(371, NULL, NULL, 'Testing testing', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas facilisis vulputate magna at ultricies. Aliquam in massa ut mi sodales imperdiet tempor ac mauris. Nulla facilisi. Mauris vitae dolor odio. Aenean sodales congue sodales. Sed id libero metus. Vivamus magna mauris, dictum et consequat mattis, bibendum non metus. Fusce eu neque lacus. Suspendisse sollicitudin mi at felis sollicitudin dapibus.', '<p>\n	Heisann df</p>\n', 381, '2012-04-22 19:58:57', 0),
(372, 95, 'event', 'TITITKTITITKTITITIEL', NULL, 'Dette er en fin ingress! Lkaslødaslødkjasldkjasdkløj', '<p>\n	økladjflksdjfgaklsgjølksafjghdfjklsghadfjklhgdfjklshgølkdsfjgølkdsfjg</p>\n<p>\n	sfg</p>\n<p>\n	dafgljkdfsnglkdsfjgn</p>\n<p>\n	 </p>\n', 353, '2012-04-23 21:31:27', 0);

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `order` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `timestamp` datetime DEFAULT NULL,
  `paid` enum('true','false') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`),
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollId` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` char(6) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
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
-- Table structure for table `rbac_assignment`
--

CREATE TABLE IF NOT EXISTS `rbac_assignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbac_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `rbac_item`
--

CREATE TABLE IF NOT EXISTS `rbac_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbac_item`
--

INSERT INTO `rbac_item` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, '', '', 's:0:"";'),
('createArticle', 0, 'Poste artikkel', '', 's:0:"";'),
('createNews', 0, 'Poste nyhet', '', 's:0:"";'),
('editor', 2, '', '', 's:0:"";'),
('updateArticle', 0, '', '', 's:0:"";'),
('updateNews', 0, '', '', 's:0:"";'),
('updateOwnArticle', 1, '', 'return isset($params["id"]) && Article::model()->findByPk($params["id"])->author == user()->id;', 's:0:"";'),
('updateOwnNews', 1, '', 'return isset($params["id"]) && News::model()->findByPk($params["id"])->authorId == user()->id;', 's:0:"";'),
('updateOwnProfile', 1, '', 'return isset($params[''username'']) && isset(user()->name) && $params[''username''] == user()->name;\r\n', 's:0:"";'),
('updateProfile', 0, '', '', 's:0:"";'),
('webkom', 2, NULL, 'return Yii::app()->gatekeeper->hasGroupAccess(55);', NULL),
('writer', 2, '', '', 's:0:"";');

-- --------------------------------------------------------

--
-- Table structure for table `rbac_itemchild`
--

CREATE TABLE IF NOT EXISTS `rbac_itemchild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rbac_itemchild`
--

INSERT INTO `rbac_itemchild` (`parent`, `child`) VALUES
('webkom', 'admin'),
('writer', 'createArticle'),
('writer', 'createNews'),
('admin', 'editor'),
('editor', 'updateArticle'),
('updateOwnArticle', 'updateArticle'),
('editor', 'updateNews'),
('updateOwnNews', 'updateNews'),
('writer', 'updateOwnArticle'),
('writer', 'updateOwnNews'),
('admin', 'updateProfile'),
('updateOwnProfile', 'updateProfile'),
('admin', 'writer');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE IF NOT EXISTS `signup` (
  `eventId` int(11) NOT NULL DEFAULT '0',
  `spots` int(11) NOT NULL,
  `open` datetime NOT NULL,
  `close` datetime NOT NULL,
  `signoff` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`eventId`)
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
(88, 50, '2011-12-02 17:00:00', '2012-05-06 17:00:00', 'false', 0),
(89, 45, '2012-03-19 17:10:23', '2012-03-19 19:10:24', 'false', 0),
(90, 10, '2012-03-23 11:20:10', '2012-04-30 10:00:00', 'true', 0),
(91, 1, '2012-04-12 12:00:00', '2012-04-19 12:00:00', 'false', 0),
(92, 20, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'true', 0),
(93, 100, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'true', 0),
(94, 100, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'false', 0);

-- --------------------------------------------------------

--
-- Table structure for table `signup_membership`
--

CREATE TABLE IF NOT EXISTS `signup_membership` (
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `signedOff` enum('true','false') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`eventId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `signup_membership`
--

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `siteId` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) DEFAULT NULL,
  `subId` int(11) DEFAULT NULL,
  PRIMARY KEY (`siteId`)
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
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
-- Table structure for table `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteId` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteId` (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`id`, `siteId`, `name`) VALUES
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
  `contentType` enum('news','article') COLLATE utf8_unicode_ci NOT NULL,
  `tagType` enum('wiki','group') COLLATE utf8_unicode_ci NOT NULL
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=469 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `middleName`, `lastName`, `specializationId`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `lastLogin`, `cardHash`, `description`, `workDescription`, `workCompanyID`, `workPlace`, `birthdate`, `altEmail`) VALUES
(381, 'sigurhol', 'Sigurd', 'Andreas', 'Holsen ', NULL, 2015, 'true', 'male', NULL, NULL, '2012-04-24 11:16:35', '123123', '', '<br />', NULL, '', '1990-12-23', 'sighol@gmail.com'),
(466, 'admin', 'ad', 'm', 'in', NULL, 2000, 'true', 'unknown', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `pollId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `choice` int(11) NOT NULL,
  PRIMARY KEY (`pollId`,`userId`)
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
-- Constraints for table `rbac_assignment`
--
ALTER TABLE `rbac_assignment`
  ADD CONSTRAINT `rbac_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rbac_itemchild`
--
ALTER TABLE `rbac_itemchild`
  ADD CONSTRAINT `rbac_itemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_itemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
