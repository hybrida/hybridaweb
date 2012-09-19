-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Vert: localhost
-- Generert den: 19. Sep, 2012 20:24 PM
-- Tjenerversjon: 5.5.16
-- PHP-Versjon: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
-- Tabellstruktur for tabell `access_relations`
--

CREATE TABLE IF NOT EXISTS `access_relations` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `type` enum('article','event','image','news','signup') COLLATE utf8_unicode_ci NOT NULL,
  `sub_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`,`type`,`access`,`sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `access_relations`
--

INSERT INTO `access_relations` (`id`, `access`, `type`, `sub_id`) VALUES
(24, 4055, 'news', 0),
(40, 2, 'news', 0),
(41, 2, 'news', 0),
(85, 2014, 'signup', 1),
(85, 4055, 'signup', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `title` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shorttitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `phpFile` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=76 ;

--
-- Dataark for tabell `article`
--

INSERT INTO `article` (`id`, `parentId`, `title`, `shorttitle`, `content`, `phpFile`, `author`, `timestamp`) VALUES
(56, 1, 'Lenker', NULL, '<p>\n</p><table cellspacing="6"><tr><td width="150"><a href="http://www.ntnu.no/studier/ingeniorvitenskap-ikt">I &amp; IKT på ntnu.no</a>\n</td>\n<td>\nRekrutterings- og infosider.\n</td></tr><tr><td>\n<a href="http://www.ntnu.no/studieinformasjon/timeplan/">Timeplaner</a>\n</td><td>\nTimeplanene til alle klassetrinn.\n</td></tr><tr><td>\n<a href="http://www.ntnu.no/studentservice/">Studentservice</a>\n</td><td>\nSvarer på alle spørsmål du måtte ha som NTNU-student.\n</td></tr><tr><td>\n<a href="http://www.studweb.ntnu.no">ITEAs infoweb</a>\n</td><td>\nInformasjonsbase for IT-systemet\n</td></tr><tr><td>\n<a href="http://www.orakel.ntnu.no">Orakeltjenesten</a>\n</td><td>\nSupport for IT-systemer under NTNU\n</td></tr><tr><td>\n<a href="http://www.samfundet.no">\nStudentersamfundet i Trondhjem</a>\n</td><td>\nNorges største og studentersamfunn.\n</td></tr><tr><td>\n<a href="http://www.universitetsavisa.no">Universitesavisa</a>\n</td><td>\nNyheter fra campus.\n</td></tr><tr><td>\n<a href="http://www.underdusken.no">Under Dusken</a>\n</td><td>\nTrondheims studentavis\n</td></tr><tr><td>\n<a href="http://www.studentrad.no/">Studentrådene</a>\n</td><td>\nStudentrådene ved NTNU\n</td></tr></table>', NULL, 381, '2012-03-07'),
(53, 1, 'Updateᵏ', NULL, '<p>\n	ARKIV: <a href="http://folk.ntnu.no/eirikaho/Update%5Ek/">http://folk.ntnu.no/eirikaho/Update%5ek/</a></p>\n', NULL, 381, '2012-03-07'),
(75, NULL, '2012', NULL, '<p>\n	liste opp alle avisene</p>\n', NULL, 381, '2012-05-12'),
(54, NULL, '2007', NULL, '<table><tbody><tr><td>\n				<a href="http://www.hybrida.ntnu.no/filer/avis/Update-ikt-1.utg.pdf"><img alt="updateUtgave107" src="/bilder/update/update107.png" /></a><br /><a href="http://www.hybrida.ntnu.no/filer/avis/Update-ikt-1.utg.pdf">1. Utgave</a></td>\n		</tr><tr><td>\n				Ansvarlig redaktør 2007: <a href="mailto:thorvag%20%C3%A6%20stud.ntnu.no">Thorvald C Grindstad</a></td>\n		</tr></tbody></table><br />', NULL, 381, '2012-03-07'),
(55, 1, 'Kontaktinfo', NULL, '<p>\n	<b>Hovedstyret</b>: <a href="mailto:hybrida%20%C3%A6%20org.ntnu.no">hybrida æ org.ntnu.no</a> (også som msn)<br /><br /><b>Leder</b>: <a href="mailto:hybrida-leder@org.ntnu.no">Tor Kvestad Idland</a><br /><a href="mailto:hybrida-leder@org.ntnu.no">hybrida-leder@org.ntnu.no </a><br />\n	Tlf: +4748241251</p>\n<h3>\n	Kontor</h3>\n<p>\n	Kjelleren i Gamle Kjemi, rom 19<br />\n	Kolbjørn Hejes vei 4<br />\n	Tlf: 73 55 05 41</p>\n<h3>\n	Postadresse</h3>\n<p>\n	Linjeforeningen Hybrida</p>\n<p>\n	Alfred Getz'' vei 3<br />\n	SB 1<br />\n	7034 Trondheim</p>\n', NULL, 381, '2012-03-07'),
(57, 1, 'Sanger', NULL, '<h1>Nu klinger igjennom den gamle stad</h1>\n\n<p>Nu klinger igjennom den gamle stad<br /> \npå ny en studentersang,<br /> \nog alle mann alle i rekke og rad <br />\nsvinger op under begerklang, <br />\nOg mens borgerne våkner i køia <br />\nog hører den glade kang-kang, <br />\nsynger alle mann, alle mann, alle mann, <br />\nalle mann, alle mann, alle mann. <br /></p>\n<p>\nRefr : <br />\nStudenter i den gamle stad, <br />\nta vare på byens ry. (dunk, dunk)<br />\nHusk på at jenter, øl og dram <br />\nvar kjempernes meny. <br />\nOg faller I alle mann alle, <br />\nskal det gjalle fra alle mot sky: <br />\nLa´kke byen få ro, <br />\nmen la den få merke <br />\nden er en studenterby. <br />\nog øl og dram, og øl og dram,<br />\nog øl og dram, og øl og dram..<br /></p>\n\n<p>\nI den gamle staden satt <br />\nså mangen en konge stor <br />\nog hadde nok av øl fra fat,<br /> \nog piker ved sitt bord. <br />\nOg de laga bøljer i gata, <br />\nnår hjem i fra gilde de for, <br />\nog nu sitter de alle mann alle i Valhall og traller til oss i kor: <br /></p>\n<p>\nRefr: Studenter ..\n</p>\n\n<p>En mp3-versjon av denne sangen finnes også til nedlasting: <a href="http://www.hybrida.ntnu.no/filer/Studenter_i_den_gamle_stad.mp3">Studenter_i_den_gamle_stad.mp3</a></p>', NULL, 381, '2012-03-07'),
(2, NULL, 'Bedrift', NULL, '<h1>Bedriftskontakt</h1>\n<strong>Hybridas Bedriftskomite (Hybrida BedKom) har ansvaret for kontakten med bedriftene for sivilingeniørstudiet Ingeniørvitenskap og IKT (I &amp; IKT) ved NTNU. Vi ble etablert for å gi bedrifter informasjon om vårt studieprogram og hvilken kompetanse vi kan bidra med.</strong>\n<p>Hovedmålet vårt er at vi vil hjelpe studentene på linja med prosjektoppgaver, hovedoppgaver, sommerjobber og fast ansettelse. I tillegg kan bedriftsbesøk, ekskursjoner og temakvelder gi bedrifter og studenter mulighet til å snakke sammen.</p>\n<p>Arrangementer av denne typen krever samarbeid fra bedrifter. Hvis du kan bidra, kontakt oss gjerne via linken i menyen venstre. For en komplett liste med Hybrida Bedkoms oppgaver og gjøremål, se våre statutter i samme meny.</p>\n<h2>Bedriftsbesøk:</h2>\n<p>Et bedriftsbesøk går i hovedsak ut på at bedriften besøker NTNU for å presentere seg for studentene. Et typisk bedriftsbesøk innebærer først og fremst en presentasjon der bedriften holder \nforedrag for utvalgte studenter. I tillegg er det vanlig med påfølgende bespisning, og mange bedrifter velger å ha jobbsamtaler/intervjuer tilknyttet besøket.</p>\n<p>Hensikten er vanligvis først og fremst rekruttering, men et bedriftsbesøk gir også god markedsføring mot kommende sivilingeniører. Hybrida BedKom tar seg av all praktisk organisering  dere trenger kun å møte opp forberedt med presentasjon!</p>\n<h2>Presentasjon:</h2>\n<p>Presentasjonen varer vanligvis i én skoletime (45 minutter) og avholdes oftest i auditorium. Her er de fleste audiovisuelle hjelpemidler tilgjengelig (PC/projektor, mikrofoner, overhead osv), og dersom dere har spesielle ønsker vil vi selvsagt forsøke å etterkomme disse. De fleste presentasjoner begynner 17:15 eller 18:15, da dette passer godt med timeplanen til studentene.</p>\n<h2>Bespisning:</h2>\n<p>De aller fleste bedrifter velger å spandere mat og drikke etter presentasjonen. Her har vi flere samarbeidspartnere og kan blant annet tilby rimelige alternativer fra \nSiT (Studentsamskipnaden i Trondheim), som holder til på Gløshaugen. Noen bedrifter ønsker fri bar, andre vil ha et fast antall enheter i form av drikkebonger. Bespisningen gir bedriften en fin mulighet til å snakke direkte med studentene i uformelle omgivelser. Det er ofte i den forbindelse interesserte melder seg på til jobbsamtaler.</p>\n<h2>Tips:</h2>\n<p>Dette er tips basert på tilbakemeldinger vi har fått fra studenter over flere år:\n</p><ul><li>Husk at dere snakker for I &amp; IKT-studenter. Ikke vær redd for å bruke fagbegreper de burde kjenne til.</li>\n	<li>Forsøk å skille dere ut fra andre bedrifter  hva er det som gjør nettopp dere til den mest attraktive arbeidsgiveren?</li>\n	<li>Fokuser på hvordan det er å arbeide i deres bedrift  sosialt, arbeidsoppgaver, arbeidsmiljø, utfordringer Vis gjerne bilder fra arbeidsplassen.</li>\n	<li>Organisasjonsinndeling, økonomi og administrasjon er ofte mindre interessant når det kommer til å velge jobb. Forsøk å legg mindre vekt på dette enn de \novernevnte punkter.</li>\n	<li>Begrens presentasjonen til 45 minutter.</li>\n	<li>Ta med en nyutdannet sivilingeniør fra NTNU, samt en fra HR.</li>\n	<li>Still med flere personer, slik at dere er lette å komme i kontakt med under bespisningen.</li>\n</ul><h2>Priser:</h2>\n<p></p><p>Hybrida BedKom tar et honorar på kroner 10 000,- for en full bedriftspresentasjon som holdes for alle klassetrinn ved studiet. Dette inkluderer PR-kostnader og liknende. Mat og drikke kommer i tillegg. Priser fra ulike leverandører fåes ved forespørsel. Hvis bedriften ønsker en presentasjon for mindre grupper innenfor I &amp; IKT (typisk en av spesialiseringene), kan dette selvsagt ordnes etter avtale. Slike arrangement tar vi selvsagt et lavere honorar for.</p>', NULL, 331, '2011-11-01'),
(1, NULL, 'Hybrida', NULL, '<p>\n	<strong>Hybrida er linjeforeningen for studieprogrammet Ingeniørvitenskap og IKT ved NTNU i Trondheim.</strong></p>\n<p>\n	Foreningens formål er å fremme samhold og kameratskap innad på studieprogrammet ved bla.a. å avholde arrangementer av både sosial og faglig karakter. Mer informasjon om oss finner du under menyen til venstre.<br /><br /><img alt="Hybrida logo" src="http://www.hybrida.ntnu.no/filer/logo.png" /></p>\n<p>\n	Last ned logoen som <a href="http://www.hybrida.ntnu.no/filer/logo.psd">.psd</a> eller <a href="http://www.hybrida.ntnu.no/filer/logo.ai">.ai</a></p>\n', NULL, 0, '0000-00-00'),
(58, 1, 'Statutter', NULL, '<a href="http://folk.ntnu.no/bjorask/hybridaweb/statutter16112010.pdf">Hybridas Statutter</a><br /><br /><a href="http://folk.ntnu.no/bjorask/hybridaweb/StatutterBedKom.pdf">Bedriftskomiteens statutter</a>', NULL, 381, '2012-03-07'),
(59, 1, 'Styre og stell', 'Styret', '<p>\n	<strong>Dette er de syv styremedlemmene som per dags dato har hovedansvaret for å holde liv i linjeforeningen.</strong><br />\n	hybrida æ org.ntnu.no</p>\n<p>\n	<strong>LEDER:</strong><br /><a href="/profil/torkvest">Tor Kvestad Idland</a> 2. kl<br />\n	Har det overordnede ansvaret i Hybrida.</p>\n<p>\n	<strong>NESTLEDER:</strong><br /><a href="/profil/gurolar">Guro Larssen</a> 2. kl<br />\n	Samarbeider med lederen om det organisatoriske og administrative ansvaret i styret.</p>\n<p>\n	<strong>SKATTMESTER:</strong><br /><a href="/profil/tonjeseg">Tonje Seglem Sundstrøm</a> 2. kl<br />\n	Ansvaret for pengestrømmen inn og, sannsynligvis mest, ut.</p>\n<p>\n	<strong>FESTIVALUS:</strong><br /><a href="/profil/sigbja">Sigbjørn Aukland</a> 2. kl<br />\n	Ansvaret for det som blir arrangert av fester, turer og diverse andre arrangementer.</p>\n<p>\n	<strong>BEDRIFTSKOMITÉSJEF:</strong><br /><a href="/profil/aasmunph">Åsmund Pedersen Hugo</a> 1. kl<br />\n	Fikser og ordner med profileringen av linja og linjeforeningen utad til bedrifter og næringslivet generelt.</p>\n<p>\n	<strong>VEVSJEF:</strong><br /><a href="/profil/sigurhol">Sigurd Holsen</a> 2. kl<br />\n	Ansvar for utvikling og drift av nettsidene samt informasjonsflyten i linjeforeningen.</p>\n<p>\n	<strong>JENTEKOMITÉSJEF:</strong><br /><a href="/profil/andrewis">Andrea Sørdal Wist</a> 2. kl<br />\n	Sjef for jentekomiteen.</p>\n', NULL, 381, '2012-03-07'),
(64, 62, 'Visjon', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<p class="MsoQuote" style="margin-left:36pt;text-indent:-18pt;">\n	<span style="font-size:16pt;line-height:115%;"><span> </span><span> </span>-<span style="font-size:7pt;line-height:normal;font-family:''Times New Roman'';">        <em> </em></span></span><em><span style="font-size:16pt;line-height:115%;"><span> </span>Vi s</span></em><span style="font-size:16pt;line-height:115%;"><em>ikrer kvaliteten for næringslivet</em><span> </span><span> </span><span> </span></span></p>\n<h2>\n	<span class="apple-style-span"><span style="color:#000000;">Visjon for I&amp;IKT-ringen</span></span></h2>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">I&amp;IKT-ringen skal gjøre studiet I&amp;IKT bedre og sørge for en fremdeles sterk rekruttering av høy kvalitet til studiet og næringslivet. Dette gjøres ved å hindre frafall og ved å holde karaktersnittet for opptaksstudenter på et høyt nivå.</span></span></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Med bakgrunn i finansiering fra I&amp;IKT-ringen og målrettede handlinger fra styret i samarbeidet med innspill fra medlemmene skal dette bli en realitet.</span></span></p>\n<p class="MsoNormal">\n	Medlemsbedriftene får eksklusiv mulighet til å promotere seg ovenfor, og rekruttere studenter med bakgrunn fra tradisjonell ingeniørvitenskap med kunnskaper innenfor IKT.</p>\n<p>\n	 </p>\n', NULL, 293, '2012-05-05'),
(65, 62, 'Medlemmer', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h3>\n	Oversikt over bedriftene som er medlemmer i I&amp;IKT-ringen.</h3>\n<p>\n	 </p>\n<p>\n	Her skal det være:</p>\n<p>\n	Logo, navn og link til hjemmeside for hver av medlemsbedriftene</p>\n', NULL, 293, '2012-05-05'),
(66, 62, 'Årsmeldinger', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h3>\n	Årsmeldingene er en årlige rapporter levert av I&amp;IKT-ringen som oppsummerer årets aktiviteter i samarbeidet.</h3>\n<p>\n	 </p>\n<p>\n	Her skal det være en liste over og link til alle årsmeldingene som blir publisert av I&amp;IKT-ringen, med illustrasjonsbilde</p>\n', NULL, 293, '2012-05-05'),
(61, 55, 'Kontoret', NULL, '<table border="0" cellspacing="1"><tr><th>Fra hovedbygget:</th>\n<th></th>\n<th>Fra stripa, sentralbygget, realfagsbygget, lesesalen:</th>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/1a_fra_plenen.jpg" alt="1a_fra_plenen.jpg" /></td>\n<td></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/1b_fra_stripa.jpg" alt="1b_fra_stripa.jpg" /></td>\n\n</tr><tr><td>1a) Dette ser du når du kommer<br /> fra plenen bak hovedbygget.<br /></td>\n<td></td>\n<td>1b) Dette ser du når du kommer<br /> fra stripa/sentralbygget.<br /></td>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/2_dor_1.jpg" alt="2_dor_1.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/3_trapp.jpg" alt="3_trapp.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/4_dor_2.jpg" alt="4_dor_2.jpg" /></td>\n</tr><tr><td>2) Gå inn denne døra.<br /></td>\n<td>3) Gå ned denne trappa.<br /></td>\n<td>4) Ta til høyre og gå inn denne døra.<br /></td>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/5_dorhandtak.jpg" alt="5_dorhandtak.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/6_gang.jpg" alt="6_gang.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/7_kontoret.jpg" alt="7_kontoret.jpg" /></td>\n</tr><tr><td>5) Den er åpen frem til klokka 16.</td>\n<td>6) Gå inn denne gangen.</td>\n<td>7) Gå inn andre dør til høyre.</td>\n</tr></table>', NULL, 381, '2012-03-07'),
(60, 59, 'Referater', NULL, '<h1>Våren 2012</h1>\n<ul><li><a href="/upc/files/styret/referater/2012v/2012-05-04.pdf">2012-05-04.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2012v/2012.03.20.pdf">2012.03.20.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2012v/2012.03.06.pdf">2012.03.06.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2012v/2012.02.23.pdf">2012.02.23.pdf</a></li>\n</ul><h1>Høsten 2009</h1>\n<ul><li><a href="/upc/files/styret/referater/2009h/2009-11-23.pdf">2009-11-23.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009h/2009-11-09.pdf">2009-11-09.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009h/2009-10-26.pdf">2009-10-26.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009h/2009-10-21.pdf">2009-10-21.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009h/2009-10-14.pdf">2009-10-14.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009h/2009-09-07.pdf">2009-09-07.pdf</a></li>\n</ul><h1>Våren 2009</h1>\n<ul><li><a href="/upc/files/styret/referater/2009v/2009-05-06.pdf">2009-05-06.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009v/2009-04-24.pdf">2009-04-24.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009v/2009-03-27.pdf">2009-03-27.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009v/2009-03-13.pdf">2009-03-13.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009v/2009-02-27.pdf">2009-02-27.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009v/2009-02-13.pdf">2009-02-13.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2009v/2009-02-06.pdf">2009-02-06.pdf</a></li>\n</ul><h1>Høsten 2008</h1>\n<ul><li>	<a href="/upc/files/styret/referater/2008h/2008-11-18.pdf">2008-11-18.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-11-11.pdf">2008-11-11.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-11-10-genfors.pdf">2008-11-10-genfors.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-11-04.pdf">2008-11-04.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-10-30.pdf">2008-10-30.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-10-28.pdf">2008-10-28.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-10-21.pdf">2008-10-21.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-10-09.pdf">2008-10-09.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-10-07.pdf">2008-10-07.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2008h/2008-09-23.pdf">2008-09-23.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2008h/2008-08-27.pdf">2008-08-27.pdf</a></li>\n</ul><h1>Våren 2008</h1>\n<ul><li><a href="/upc/files/styret/referater/2008v/2008-05-13.pdf">2008-05-13.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2008v/2008-04-25.pdf">2008-04-25.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2008v/2008-04-16-genfors.pdf">2008-04-16-genfors.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2008v/2008-04-11.pdf">2008-04-11.pdf</a></li>\n	<li><a href="/upc/files/styret/referater/2008v/2008-04-04.pdf">2008-04-04.pdf</a></li>\n</ul><h1>Våren 2007</h1>\n<ul><li>	<a href="/upc/files/styret/referater/2007v/2007-24-04.pdf">2007-24-04.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2007v/2007-17-04.pdf">2007-17-04.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2007v/2007-14-01.pdf">2007-14-01.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2007v/2007-04-17.txt">2007-04-17.txt</a></li>\n	<li>	<a href="/upc/files/styret/referater/2007v/2007-03-27-genfors.pdf">2007-03-27-genfors.pdf</a></li>\n</ul><h1>Høsten 2006</h1>\n<ul><li>	<a href="/upc/files/styret/referater/2006h/2006-11-06.pdf">2006-11-06.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-10-30.pdf">2006-10-30.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-10-23.pdf">2006-10-23.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-10-16.pdf">2006-10-16.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-10-09.pdf">2006-10-09.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-10-02.pdf">2006-10-02.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-09-25.pdf">2006-09-25.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-09-18.pdf">2006-09-18.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-08-29.pdf">2006-08-29.pdf</a></li>\n	<li>	<a href="/upc/files/styret/referater/2006h/2006-08-10.pdf">2006-08-10.pdf</a></li>\n</ul>', NULL, 381, '2012-03-07'),
(62, NULL, 'I&amp;IKT-ringen', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h2>\n	<strong>Velkommen til I&amp;IKT-ringen</strong></h2>\n<p>\n	I&amp;IKT-ringen er et samarbeid mellom næringslivet og sivilingeniørstudiet Ingeniørvitenskap og IKT (I&amp;IKT) ved NTNU. Samarbeidet skal gjøre studiet bedre og sørge for en fremdeles sterk rekruttering av høy kvalitet til næringslivet.</p>\n<p>\n	 </p>\n<p>\n	 </p>\n<p>\n	 </p>\n<p>\n	Her skal det være en feed med innlegg som viser hva som er aktuelt i I&amp;IKT-ringen.</p>\n<p>\n	 </p>\n', NULL, 381, '2012-05-05'),
(63, 62, 'Styret', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<p>\n	Styret i er en samling av representanter fra NTNU og næringslivet og er det overordnede organet i I&amp;IKT-ringen.</p>\n<p>\n	 </p>\n<p>\n	<strong>Styreleder</strong></p>\n<p>\n	Navn, bakgrunnsorganisasjon</p>\n<p>\n	 </p>\n<p>\n	<strong>Representanter fra næringslivet</strong></p>\n<p>\n	Navn, bedrift</p>\n<p>\n	 </p>\n<p>\n	<strong>Representanter fra NTNU</strong></p>\n<p>\n	Navn, stilling</p>\n', NULL, 381, '2012-05-05'),
(67, 62, 'Kontaktinformasjon', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<p>\n	<strong>Daglig leder</strong></p>\n<p>\n	 </p>\n<p>\n	<strong>Studieprogramleder</strong></p>\n<p>\n	 </p>\n<p>\n	<strong>Studentenes bedriftskontakt</strong></p>\n<p>\n	Hybrida Bedriftskomité v/ Bedriftskomitésjef Åsmund Pedersen Hugo</p>\n<p>\n	Mail: <a href="mailto:hybrida-bedrift@list.stud.ntnu.no">hybrida-bedrift@list.stud.ntnu.no</a></p>\n<p>\n	Tlf: 98 60 42 66</p>\n<p>\n	 </p>\n<p>\n	<strong>Webansvarlig</strong></p>\n', NULL, 293, '2012-05-05'),
(68, 62, 'Om', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h2>\n	Om I&amp;IKT-ringen og partene i samarbeidet</h2>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span lang="no-nyn" style="color:#000000;" xml:lang="no-nyn">I&amp;IKT-ringen er et samarbeidsforum med partene: linjeforeningen Hybrida ved Hybrida Bedriftskomité, fakultet for Ingeniørvitenskap og Teknologi og bedriftene som er medlemmer i samarbeidet. Formålet med samarbeidet er å tilby bedrifter helhetlig kontakt med studenter fra sivilingeniørstudiet Ingeniørvitenskap og IKT (I&amp;IKT) ved NTNU og dets tilhørende fakultet.</span></span></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span lang="no-nyn" style="color:#000000;" xml:lang="no-nyn">Medlemskap i I&amp;IKT-ringen gir bedriften mulighet til å komme med innspill til faktultetet om studieformen ved I&amp;IKT, samtidig som bedriften oppnår fordeler med et slikt samarbeid med Hybrida Bedriftskomité. Blant disse fordelene er muligheten til å promotere seg særskilt ovenfor studenter på I&amp;IKT.</span></span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hybrida Bedriftskomité er en underkomité av linjeforeningen Hybrida. Komiteen har ansvaret for kontakten med bedrifter for I&amp;IKT. Komiteen ble etablert for å opprette kontakt mellom studentene og bedrifter og gi bedrifter informasjon om hvilken kompetanse våre studenter innehar.</span></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span lang="no-nyn" style="color:#000000;" xml:lang="no-nyn">Hovedmålet til komiteen er å hjelpe studentene på linjen til prosjektoppgaver, hovedoppgaver, sommerjobber og fast ansettelse i samarbeid med bedrifter. I tillegg kan bedriftsbesøk, ekskursjoner og lignende arrangert i samarbeid med komiteen gi bedrifter og studenter mulighet til å snakke sammen.</span></span></p>\n<p class="MsoNormal">\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" style="font-size:18pt;line-height:115%;" xml:lang="no-nyn">Om sivilingeniørstudiet Ingeniørvitenskap og IKT</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hvor ofte har ikke et systemutviklingsprosjekt gått i vasken, fordi utviklerne ikke kjente behovene til fagspesialistene som skulle bruke systemet? Hvem har ikke latt seg fascinere av hvordan gode IKT-verktøy effektiviserer, visualiserer og videreutvikler tradisjonelle ingeniørmetoder?</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">I&amp;IKT har som mål å utdanne sivilingeniører med en tverrfaglig kompetanse. Utvikling av fremtidens teknologi vil være avhengig av at vi samtidig kan utvikle nye IKT-løsninger. Dette krever at man kan bygge bro mellom datatekniske og ingeniørfaglige utfordringer, for å oppnå dette må man klare å ha oversikt over hele bildet.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Sivilingeniører fra Ingeniørvitenskap og IKT har den kunnskapen som kreves for å møte disse utfordringene, med solid kompetanse innen både den ingeniørfaglige og den datatekniske siden av sitt fagfelt. Studentene skal både kunne fylle rollen som fagspesialist og systemutvikler innen sitt fagområde.</span></p>\n<p class="MsoNormal">\n	<img alt="Skjermer" height="155" src="/upc/files/images/ringen/ikt_skjermer.jpg" width="229" /><span lang="no-nyn" xml:lang="no-nyn"> </span></p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Oppbygningen av studiet</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Studieløpet ved I&amp;IKT skiller seg fra andre sivilingeniørlinjer ved at den har et stort fokus på tverrfaglighet. I løpet av programmets to første år blir studentene introdusert til grunnleggende programmering og systemutvikling på lik linje med studenter fra rene IKT-rettede studieprogram. Samtidig blir studentene introdusert til ingeniørfag som mekanikk, fysikk og matematikk. Dette skal gi studentene en grundig innføring i fagområder knyttet til programmering, men samtidig et grunnlag til å bygge ut i fra når de velger spesialisering videre.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Etter fjerde semester velger studentene spesialisering blant Produkt og prosess, Marin teknikk, Konstruksjonsteknikk, Geomatikk og Petroleumsfag. Dette betyr i praksis at studenten følger det faglige løpet ved den respektive fordypningen, samtidig som man beholder en rekke IKT-fag ut studieløpet. Målet er at en student fra I&amp;IKT skal gå ut med samme dybde i faget som studenter fra samme fagfelt og kunnskap tilsvarende en IKT-utdanning på universitetsnivå.</span></p>\n<p>\n	 </p>\n<p>\n	 </p>\n', NULL, 293, '2012-05-05'),
(69, 62, 'Samarbeid', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h2>\n	Samarbeid gjennom I&amp;IKT-ringen</h2>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Bedriften oppnår en rekke fordeler gjennom et medlemskap i I&amp;IKT-ringen. En av disse er et involvert samarbeid med fakultetet og mulighet til å komme med innspill på studiets oppbygning og drift. En tettere involvering av næringslivet i studieprogrammet vil kunne sørge for økte søkertall av kvalifiserte søkere og redusert frafall på grunn av økt motivasjon blant studenter og dermed flere kompetente kandidater ut i arbeid.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Ved medlemskap blir det anledning for bedriften til å promotere seg særskilt ovenfor studenter ved I&amp;IKT. I&amp;IKT-ringen er den eneste som kan tilby eksklusiv kontakt med sivilingeniører med en slik kompetanse i Norge.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hybrida Bedriftskomité sørger for promotering av bedrifter opp mot studentene ved I&amp;IKT. Promoteringsmetoder som kan nevnes er blant annet:</span></p>\n<p>\n	 - Bedriftspresentasjoner</p>\n<p class="MsoNormal">\n	 - Annonser i linjeavis, på plakater og mail</p>\n<p class="MsoNormal">\n	 - Hjemmeside</p>\n<p>\n	 - Ekskursjoner</p>\n<p>\n	 - Stands</p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Ved medlemskap vil det også åpne seg mulighet for bedriften å bli sponsor av linjeforeningen Hybrida. Dette vil være god reklame og en mulighet for bedriften til å skille seg ut ovenfor studentene ved I&amp;IKT.</span></p>\n<p>\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Bedriftens bidrag</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Bedriften bidrar med en årlig medlemskapsavgift gjennom sitt medlemskap i I&amp;IKT-ringen. Styret i I&amp;IKT-ringen ivaretar inntektene fra avgiften og disse pengene brukes til å forbedre studieprogrammet I&amp;IKT. Denne medlemskapsavgiften avhenger selvsagt av bedriftens størrelse. En oversikt over bidraget fra hver størrelsesgruppe finnes i tabellen under.</span></p>\n<p>\n	 </p>\n<table border="1" cellpadding="0" cellspacing="0" class="MsoNormalTable" style="border-collapse:collapse;border:none;"><tbody><tr><td style="width:131.55pt;border:solid #4BACC6 1pt;border-bottom:solid #4BACC6 2.25pt;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="175">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					<b><span lang="no-nyn" style="font-family:Cambria, serif;" xml:lang="no-nyn">Bedriftens størrelse</span></b></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:157.15pt;border-top:solid #4BACC6 1pt;border-left:none;border-bottom:solid #4BACC6 2.25pt;border-right:solid #4BACC6 1pt;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="210">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					<b><span lang="no-nyn" style="font-family:Cambria, serif;" xml:lang="no-nyn">Antall ansatte i bedriften </span></b></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:175.7pt;border-top:solid #4BACC6 1pt;border-left:none;border-bottom:solid #4BACC6 2.25pt;border-right:solid #4BACC6 1pt;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="234">\n				<p class="MsoNormal">\n					<b><span lang="no-nyn" style="font-family:Cambria, serif;" xml:lang="no-nyn">Medlemskapsavgift</span></b></p>\n				<p>\n					 </p>\n			</td>\n		</tr><tr><td style="width:131.55pt;border:solid #4BACC6 1pt;border-top:none;background:#d2eaf1;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="175">\n				<p class="MsoNormal">\n					<span lang="no-nyn" style="font-family:Cambria, serif;" xml:lang="no-nyn">Mindre bedrifter</span></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:157.15pt;border-top:none;border-left:none;border-bottom:solid #4BACC6 1pt;border-right:solid #4BACC6 1pt;background:#d2eaf1;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="210">\n				<p class="MsoNormal">\n					<span lang="no-nyn" xml:lang="no-nyn">&lt; 500 </span></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:175.7pt;border-top:none;border-left:none;border-bottom:solid #4BACC6 1pt;border-right:solid #4BACC6 1pt;background:#d2eaf1;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="234">\n				<p class="MsoNormal">\n					<span lang="no-nyn" xml:lang="no-nyn">10 000 kr</span></p>\n				<p>\n					 </p>\n			</td>\n		</tr><tr><td style="width:131.55pt;border:solid #4BACC6 1pt;border-top:none;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="175">\n				<p class="MsoNormal">\n					<span lang="no-nyn" style="font-family:Cambria, serif;" xml:lang="no-nyn">Mellomstore bedrifter</span></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:157.15pt;border-top:none;border-left:none;border-bottom:solid #4BACC6 1pt;border-right:solid #4BACC6 1pt;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="210">\n				<p class="MsoNormal">\n					<span lang="no-nyn" xml:lang="no-nyn">500-2000</span></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:175.7pt;border-top:none;border-left:none;border-bottom:solid #4BACC6 1pt;border-right:solid #4BACC6 1pt;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="234">\n				<p class="MsoNormal">\n					<span lang="no-nyn" xml:lang="no-nyn">12 500 kr</span></p>\n				<p>\n					 </p>\n			</td>\n		</tr><tr><td style="width:131.55pt;border:solid #4BACC6 1pt;border-top:none;background:#d2eaf1;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="175">\n				<p class="MsoNormal">\n					<span lang="no-nyn" style="font-family:Cambria, serif;" xml:lang="no-nyn">Større bedrifter</span></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:157.15pt;border-top:none;border-left:none;border-bottom:solid #4BACC6 1pt;border-right:solid #4BACC6 1pt;background:#d2eaf1;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="210">\n				<p class="MsoNormal">\n					<span lang="no-nyn" xml:lang="no-nyn">2000 &lt;</span></p>\n				<p>\n					 </p>\n			</td>\n			<td style="width:175.7pt;border-top:none;border-left:none;border-bottom:solid #4BACC6 1pt;border-right:solid #4BACC6 1pt;background:#d2eaf1;padding:0cm 5.4pt 0cm 5.4pt;" valign="top" width="234">\n				<p class="MsoNormal">\n					<span lang="no-nyn" xml:lang="no-nyn">15 000 kr</span></p>\n				<p>\n					 </p>\n			</td>\n		</tr></tbody></table><p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn"> </span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Et samarbeid gjennom I&amp;IKT-ringen vil være avtalefestet gjennom en samarbeidsavtale som oppsummerer forpliktelsene til alle parter i samarbeidet.</span></p>\n<p>\n	 </p>\n', NULL, 293, '2012-05-05'),
(73, 2, 'Kontakt', NULL, '<h2>\n	Kontakt Hybrida Bedriftskomité</h2>\n<div class="artikkel" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:1.4em;color:rgb(0,0,0);text-align:left;">\n	<p>\n		Hvis din bedrift vil avholde et arrangement i samarbeid med oss, ta gjerne kontakt med oss via følgende kanaler:</p>\n	<h4 style="padding:0px;margin-bottom:5px;margin-left:0px;">\n		Felles e-postadresse for hele komiteen</h4>\n	<p style="padding:0px;margin-bottom:5px;margin-left:0px;">\n		<a href="mailto:hybrida-bed@org.ntnu.no" style="line-height:1.4em;">hybrida-bed@org.ntnu.no</a></p>\n	<h4 style="padding:0px;margin-bottom:5px;margin-left:0px;">\n		<span style="font-size:15px;line-height:1.4em;">Post</span></h4>\n	<p>\n		Linjeforeningen Hybrida</p>\n	<p>\n		Alfred Getz'' vei 3<br />\n		SB 1<br />\n		7034 Trondheim</p>\n	<h4>\n		<span style="line-height:1.4em;">Bedriftskomitésjef</span></h4>\n	<p>\n		<a href="http://hybrida.no/profil/aasmunph">Åsmund Pedersen Hugo</a></p>\n	<p>\n		E-post: <a href="mailto:hybrida-bedrift@list.stud.ntnu.no">hybrida-bedrift@list.stud.ntnu.no</a></p>\n	<p>\n		<span style="line-height:1.4em;">Tlf. 98 60 42 66</span></p>\n</div>\n<div>\n	 </div>\n', NULL, 293, '2012-05-08'),
(70, 62, 'Promotering', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h2>\n	Promoteringsmetoder</h2>\n<p>\n	<span style="color:rgb(0,0,0);font-family:Gill;font-size:medium;">Hybrida Bedriftskomité sørger for promotering av bedrifter opp mot studentene ved I&amp;IKT. Promoteringsmetoder som kan nevnes er blant annet:</span></p>\n<p style="margin-left:7px;color:rgb(0,0,0);font-family:Gill;font-size:medium;">\n	 - Bedriftspresentasjoner</p>\n<p style="margin-left:7px;color:rgb(0,0,0);font-family:Gill;font-size:medium;">\n	 - Annonser i linjeavis, på plakater, mail og hjemmeside</p>\n<p class="MsoNormal" style="margin-left:7px;color:rgb(0,0,0);font-family:Gill;font-size:medium;">\n	 - Hjemmeside</p>\n<p style="margin-left:7px;color:rgb(0,0,0);font-family:Gill;font-size:medium;">\n	 - Ekskursjoner</p>\n<p style="margin-left:7px;color:rgb(0,0,0);font-family:Gill;font-size:medium;">\n	 - Stands</p>\n', NULL, 293, '2012-05-08'),
(71, 70, 'Presentasjoner', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h2>\n	Bedriftspresentasjoner</h2>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hybrida Bedriftskomités primære metode for å promotere bedrifter ovenfor studenter er å arrangere bedriftspresentasjoner.</span></p>\n<p>\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Om bedriftspresentasjoner</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">En bedriftspresentasjon går i hovedsak ut på at bedriften besøker NTNU for å presentere seg for studentene. Et slikt besøk innebærer først og fremst en presentasjon der bedriften holder foredrag for utvalgte studenter. Det er også mulig å rette seg spesielt mot studenter fra en gitt fordypning. I tillegg er det vanlig med påfølgende bespisning, og mange bedrifter velger å ha jobbsamtaler/intervjuer tilknyttet besøket.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hensikten er først og fremst rekruttering, men en bedriftspresentasjon gir også god markedsføring mot kommende sivilingeniører. Hybrida Bedriftskomité tar seg av all praktisk organisering, bedriften trenger kun å møte opp forberedt med en presentasjon.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Presentasjonen varer vanligvis i én forelesingstime (45 minutter) og avholdes oftest i auditorium. Her er de fleste audiovisuelle hjelpemidler tilgjengelig (PC/projektor. Dersom bedriften har spesielle ønsker vil vi selvsagt forsøke å etterkomme disse. De fleste presentasjoner begynner 17:15 eller 18:15, da dette passer godt med timeplanen til studentene.</span></p>\n<p>\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Bespisning</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">De aller fleste bedrifter velger å spandere mat og drikke etter presentasjonen. Her har vi flere samarbeidspartnere og kan blant annet tilby rimelige alternativer fra SiT (Studentsamskipnaden i Trondheim), som holder til på Gløshaugen. I tillegg til SiT er også serveringsalternativer ved restauranter i Trondheim sentrum aktuelle.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Noen bedrifter ønsker fri bar, andre vil ha et fast antall enheter i form av drikkebonger. Bespisningen gir bedriften en fin mulighet til å snakke direkte med studentene i uformelle omgivelser. Det er ofte i den forbindelse interesserte melder seg til jobbsamtaler.</span></p>\n<p>\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Kostnadsinformasjon ved bedriftspresentasjon</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Fast honorar til Hybrida Bedriftskomité som arrangør, er 150 kr per besøkende gjest, honorargrensen er på 10 000 kr. Dette betyr at Hybrida Bedriftskomité ikke kommer til å kreve mer enn 10 000 kr totalt i honorar for et arrangement, uavhengig om antall besøkende tilsier mer. Dette honoraret er støtte til Hybrida som går til studentene på I&amp;IKT.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Kostnader knyttet til mat og drikke på serveringssteder kommer i tillegg til honoraret. Oppdaterte menyer og priser for ulike serveringssteder kan fåes av Hybrida Bedriftskomité på forespørsel, da de hele tiden er utsatt for endringer.</span></p>\n<p class="MsoNormal">\n	 </p>\n', NULL, 293, '2012-05-08'),
(72, 70, 'Update^k', NULL, '<p>\n	<img alt="Logo" height="191" src="/upc/files/ringen/images/iktlogo_planet.png" width="256" /></p>\n<h2>\n	Linjeforeningsavisen Update^k</h2>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Gjennom et samarbeid med linjeforeningens avis, Update<sup>K</sup>, kan Hybrida Bedriftskomité tilby annonsering og dekning av bedriften. Update<sup>K</sup> gis ut til alle studenter ved I&amp;IKT seks ganger årlig. Deadline for hver av avisens utgaver kan fåes ved etterspørsel.</span></span></p>\n<p>\n	<img alt="Update" height="270" src="/upc/files/ringen/images/update_fremsider.png" width="242" /></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Som medlem av I&amp;IKT-ringen vil bedriftene få sin logo trykt i avisen i hver utgave. I tillegg er det også mulig for bedriften å publisere informasjon gjennom intervjuer og artikler med mer. Skulle man ønske å utlyse sommerjobb/jobbannonser er dette selvfølgelig også mulig å gjøre.</span></span></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Hvis man ønsker annonsering i forbindelse med et spesielt arrangement kan avisen også tilby dekning av dette arrangement på forhånd. Dette kan for eksempel være en artikkel hvor man går kort inn på hva bedriften gjør, hvordan det er å jobbe der og informerer om kommende arrangementer.</span></span></p>\n<p class="MsoNormal">\n	 </p>\n', NULL, 293, '2012-05-08'),
(74, 2, 'Medlemmer', NULL, '<h2>\n	Medlemmer i Hybrida Bedriftskomité</h2>\n<p>\n	Hybrida Bedriftskomité jobber for å øke kontakten mellom bedrifter og studenter ved Ingeniørvitenskap og IKT. Vi har også som mål å gjøre linjen bedre kjent og spre kunnskap om hvilken kompetanse en I&amp;IKT-student innehar.</p>\n<p>\n	 </p>\n<p>\n	Liste med bilde, navn og stilling til alle i komiteen her</p>\n', NULL, 293, '2012-05-08');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bk_company`
--

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
  PRIMARY KEY (`companyID`),
  KEY `contactorID` (`contactorID`,`addedByID`,`updatedByID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=219 ;

--
-- Dataark for tabell `bk_company`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `bk_company_specialization`
--

CREATE TABLE IF NOT EXISTS `bk_company_specialization` (
  `companyId` int(11) NOT NULL,
  `specializationId` int(11) NOT NULL,
  PRIMARY KEY (`companyId`,`specializationId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `bk_company_specialization`
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
-- Tabellstruktur for tabell `bk_company_update`
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
-- Dataark for tabell `bk_company_update`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `book_sales`
--

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

--
-- Dataark for tabell `book_sales`
--

INSERT INTO `book_sales` (`id`, `title`, `content`, `price`, `status`, `author`, `imageID`, `timestamp`) VALUES
(5, 'Gult statistikkark', 'Det samme gule arket som jeg brukte under eksamen i Statistikk 2012', 5, 0, 381, 2, '2012-06-19 20:56:46');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `parentType` enum('profile','gallery','image','group','company','news') COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci,
  `authorId` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `isDeleted` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`id`),
  KEY `parentId` (`parentId`,`authorId`),
  KEY `author` (`authorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=446 ;

--
-- Dataark for tabell `comment`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `location` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

--
-- Dataark for tabell `event`
--

INSERT INTO `event` (`id`, `start`, `end`, `location`, `status`) VALUES
(71, '2012-01-29 07:00:00', '2012-02-02 20:00:00', 'Åre', 0),
(73, '2011-11-25 18:15:00', '2011-11-26 13:00:00', 'Gløs', 0),
(82, '2012-03-08 00:00:00', '2012-06-07 00:00:00', 'Åre', 2),
(83, '2012-12-01 00:00:00', '2013-04-06 00:00:00', 'Kontoret', 0),
(85, '2012-02-25 20:00:54', '2012-02-26 02:00:00', 'Lyche', 0),
(89, '2012-03-21 14:00:00', '2012-03-21 19:00:00', '', 0),
(91, '2012-04-19 18:15:00', '2012-04-19 18:15:00', NULL, 0),
(92, '2012-04-17 00:00:00', '2012-04-18 00:00:00', 'Kontoret', 0),
(93, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'NTNU', 0),
(94, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'Sted', 0),
(95, '2012-04-24 06:35:00', '2012-04-01 19:30:00', 'Her!', 0),
(97, '2012-08-01 00:00:00', '2012-08-31 00:00:00', 'arst', 0),
(99, '2012-09-01 00:00:00', '2015-09-01 00:00:00', 'Lesesalen', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `event_company`
--

CREATE TABLE IF NOT EXISTS `event_company` (
  `eventID` int(11) NOT NULL,
  `companyID` int(11) DEFAULT NULL,
  `bpcID` int(11) NOT NULL,
  PRIMARY KEY (`eventID`),
  UNIQUE KEY `bpcID` (`bpcID`),
  KEY `companyID` (`companyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `fb_user`
--

CREATE TABLE IF NOT EXISTS `fb_user` (
  `userId` int(11) NOT NULL,
  `fb_token` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `postEvents` enum('true','false') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `fb_user`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `gallery`
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
-- Dataark for tabell `gallery`
--

INSERT INTO `gallery` (`id`, `userId`, `title`, `imageId`, `timestamp`) VALUES
(22, 1, 'HELLO', NULL, '2011-04-03 23:24:42'),
(21, 1, 'hello', NULL, '2011-04-03 23:23:11'),
(20, 1, 'n', NULL, '2011-04-03 22:12:46'),
(19, 1, 'lol', NULL, '2011-04-03 21:37:07'),
(18, 1, 'lol', NULL, '2011-04-03 20:56:39'),
(23, 1, 'bears', NULL, '2011-04-03 23:39:46');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `groups`
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
-- Dataark for tabell `groups`
--

INSERT INTO `groups` (`id`, `menu`, `title`, `admin`, `committee`, `url`) VALUES
(58, 0, 'UpdateK', 381, 'false', 'updatek'),
(55, 0, 'Webkom', 381, 'true', 'webkom'),
(56, 0, 'Styret', 363, 'false', 'styret'),
(57, 0, 'Hybrida Bedriftskomité', 293, 'true', 'bk');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `group_membership`
--

CREATE TABLE IF NOT EXISTS `group_membership` (
  `groupId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `comission` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `start` date NOT NULL DEFAULT '0000-00-00',
  `end` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`groupId`,`userId`,`end`,`start`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `group_membership`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `iktringen_membership`
--

CREATE TABLE IF NOT EXISTS `iktringen_membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `company` (`companyId`,`start`,`end`),
  KEY `fk_iktringen_membership_bk_company1_idx` (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `image`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `job_announcement`
--

CREATE TABLE IF NOT EXISTS `job_announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyId` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `kilt_comment`
--

CREATE TABLE IF NOT EXISTS `kilt_comment` (
  `id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `time_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `kilt_order`
--

CREATE TABLE IF NOT EXISTS `kilt_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `time_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `kilt_product`
--

CREATE TABLE IF NOT EXISTS `kilt_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `model` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_id` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=114 ;

--
-- Dataark for tabell `kilt_product`
--

INSERT INTO `kilt_product` (`id`, `type`, `model`, `link`, `image_id`) VALUES
(1, 'Kilt', 'Gutt', '1111/Kilt---Irisher-Sport-Kilt.html', 'products/K_IRISHER.jpg'),
(2, 'Kilt', 'Jente', '4061/Irisher-Women%27s-Kilt.html', '2009093012423778237_med.jpg'),
(3, 'Kilt', 'Jente Mini', '4561/Irisher-Mini-Kilt.html', '2009101514272187719_med.jpg'),
(6, 'Sporran', 'Black Leather', '1911/Black-Leather-Sporran.html', '2009032717231692517_med.jpg'),
(7, 'Sporran', 'Thistle', '2151/Thistle-Sporran.html', '2009031615002744559_med.jpg'),
(8, 'Sporran', 'Black Rabbit', '1921/Black-Rabbit-Sporran.html', '2009032814104598125_med.jpg'),
(88, 'Sporran', 'Brown Embossed Leather', '9635/Brown-Embossed-Leather-Sporran.html', '2010102716562446500_med.jpg'),
(89, 'Sporran', 'Brown Saddle Leather', '9636/Brown-Saddle-Leather-Sporran.html', '2010102716592540116_med.jpg'),
(90, 'Sporran', 'Celtic Targe', '8891/Celtic-Targe.html', '2009082012450734919_med.jpg'),
(91, 'Sporran', 'Embossed Leather', '7791/Embossed-Leather-Sporran.html', '2009082013402527525_med.jpg'),
(92, 'Sporran', 'Gray Rabbit', '1981/Gray-Rabbit-Sporran.html', '2009032814214886947_med.jpg'),
(93, 'Sporran', 'Green Shamrock', '7751/Green-Shamrock-Sporran.html', '2009042115485662384_med.jpg'),
(94, 'Sporran', 'Scot Flag', '7631/Scot-Flag-Sporran.html', '2009113015520130428_med.jpg'),
(95, 'Sporran', 'Silver Shamrock', '7761/Silver-Shamrock-Sporran.html', '2009042116113679463_lrg.jpg'),
(96, 'Sporran', 'Silver Studded Dress', '2121/Silver-Studded-Dress-Sporran.html', '2009032813342330180_lrg.jpg'),
(97, 'Sporran', 'Studded Black', '2141/Studded-Black-Leather.html', '2009032814030513419_lrg.jpg'),
(98, 'Sporran', 'Studded White', '9101/Studded-White-Thistle.html', '2009113015542623397_lrg.jpg'),
(99, 'Sporran', 'White Rabbit', '2191/White-Rabbit-Sporran.html', '2009032717301821464_lrg.jpg'),
(100, 'Sporran', 'White Rabbit w/ Black Tassels', '9532/White-Rabbit-Sporran-with-Black-Tassels.html', '2010081811431185197_lrg.jpg'),
(101, 'Ekstra', 'Sokker', '721/Kilt-Hose---Regular.html', '2011091315270667842_med.jpg'),
(102, 'Ekstra', 'Flashes', '631/Flashes----Solid-Color.html', 'products/FL_SOL.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `kilt_product_size`
--

CREATE TABLE IF NOT EXISTS `kilt_product_size` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `kilt_product_size`
--

INSERT INTO `kilt_product_size` (`product_id`, `size_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 1),
(2, 2),
(2, 4),
(2, 5),
(3, 1),
(3, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `kilt_size`
--

CREATE TABLE IF NOT EXISTS `kilt_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dataark for tabell `kilt_size`
--

INSERT INTO `kilt_size` (`id`, `size`) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Medium Long'),
(4, 'Large'),
(5, 'XLarge'),
(6, 'XXLarge');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `kilt_time`
--

CREATE TABLE IF NOT EXISTS `kilt_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` date NOT NULL,
  `end` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `news`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=378 ;

--
-- Dataark for tabell `news`
--

INSERT INTO `news` (`id`, `parentId`, `parentType`, `title`, `imageId`, `ingress`, `content`, `authorId`, `timestamp`, `status`) VALUES
(40, 71, 'event', 'Åretur 2012', NULL, 'Hybrider! Da har det duket for årets høydepunkt, vinterens villeste eventyr: Åretur!!!', '<p>\n	Som de siste tre årene vil turen være i uke 5, eller for alle oss andre som hater ukesystemet: <strong>29. jan - 2. feb 2012. </strong> I år har vi fått boplass i Åre fjellby, rett ved trekket og utesteder, altså helt ypperlig!<br /><br />\n	Turen kommer på <strong> ca 2000kr </strong> per pers og inkluderer:<br />\n	 </p>\n<ul><li>\n		Tur/retur Åre sentrum</li>\n	<li>\n		4 netters opphold</li>\n	<li>\n		5 dagers skipass</li>\n	<li>\n		rabattkort</li>\n	<li>\n		mye fest og moro!</li>\n</ul><br /><p>\n	Vi har <strong>47 plasser </strong>, så her er det førstemann til mølla som gjelder!<br /><br />\n	 OBS! OBS! Videre info vil de påmeldte få via mail. Som tiden for avgang, når vi er tilbake, hytteoversikt, hyttefordeling, betalingsinfo med nøyaktig pris osv. Og for de som ikke vet det, her snakker vi helt bindende påmelding. <br />\n	 </p>\n', 326, '2011-07-17 22:34:51', 0),
(41, 73, 'event', 'Generalforsamling', NULL, 'Generalforsamling i Hybrida', '', 326, '2011-11-10 21:14:21', 0),
(56, NULL, NULL, 'Nytt styre', NULL, 'Vil gratulere de nye styremedlemmene med valget', '<p>\n   <strong>Festivalus</strong> - Sigbjørn Aukland\n</p>\n<p>\n   <strong>Skattemester</strong> - Tonje Sundstrøm\n</p>\n<p>\n   <strong>Vevsjef</strong> - Sigurd Holsen\n</p>\n<p>\n   <strong>SPR</strong> - Erik Aasmundrud\n</p>', 363, '2011-11-26 20:02:14', 0),
(364, 85, 'event', 'Halvingfest!', NULL, 'Tredje klasse feirer sin halvferdige universitetsutdannelse med en herlig middag på Lyche.', '<p>\n	Maten blir servert kl 20.00 (hver der ca en halvtime før) og de flotte tredjeklassingene dukker opp i relativt fin stas så koser vi oss!</p>\n<p>\n	Påmelding skjer her, husk at den er bindende. <u>Ved påmelding må du også sende en mail til halvingfest@gmail.com med menyen du ønsker.</u> Valg av hovedretter er:</p>\n<p>\n	<strong>Lycheburger </strong>Lyches ubestridte klassiker. Med aioli, pistou, bacon, cheddarost og paprikasalsa. Serveres med ovnsbakte mandelpoteter. kr 109.</p>\n<p>\n	<strong>Vegetarburger</strong> Lyches vegetarburger. Med aioli, pistou, cheddarost, salat og paprikasalsa. Serveres med ovnsbakte mandelpoteter.  kr 99</p>\n<p>\n	<strong>Confiterte andelår</strong> Langtidsstekt, sprøtt andelår. Serveres med ovnsbakte grønnsaker, pastinakkpuré, appelsinsaus og ovnsbakte mandelpoteter. kr 129</p>\n<p>\n	<strong>Ovnsbakt lakseloin</strong> Lakseloin med ovnsbakte grønnsaker og mandelpoteter, samt pastinakkpuré. Toppes med mandelvinaigrette. kr 129</p>\n<p>\n	<strong><em>Dessertvalg:</em></strong></p>\n<p>\n	<strong>Sjokoladelyche</strong><br />\n	Konfektkake av fyldig sjokolade, med pisket krem og bærsaus. kr 45</p>\n<p>\n	<strong>Panna cotta</strong><br />\n	Panna cotta med bærsaus. kr 35</p>\n<p>\n	 </p>\n<p>\n	Betaling skjer på Hybridas konto: 0539.26.44913 Prisen avhenger av hvilken rett du velger. Summer selv og overfør til konto merket med navn + halvingfest</p>\n<p>\n	 </p>\n', 367, '2012-02-17 19:09:39', 0),
(366, 89, 'event', 'Komitefest!', NULL, 'Det arrangeres komitefest for hybrida kommitémedlemmer 15. mars på kjellerne.', '', 381, '2012-02-28 13:23:04', 0),
(368, NULL, NULL, 'Den gamle siden', NULL, 'Den gamle siden vil ikke lenger bli vedlikeholdt, men finnes på <a href="http://www.hybrida.ntnu.no">http://www.hybrida.ntnu.no</a>', '<p>\n	 .</p>\n', 353, '2012-04-25 23:17:43', 0),
(369, NULL, NULL, 'Lesesal-IRC', NULL, 'Kjeder du deg på lesesalen? Skulle du ønske at det var mulig å snakke med andre hybrider på lesesalen? Da er lesesal-IRC noe for deg!', '<p>\n	 </p>\n<p>\n	Etter noe nedetid er IRC-serveren opp å går igjen. Koble deg på med:</p>\n<p>\n	Server: irc.hybrida.no</p>\n<p>\n	Port: 6667</p>\n<p>\n	Kanal: #lesesalen</p>\n<p>\n	De som ikke har brukt IRC før kan ta en titt her: <a href="https://cbe002.chat.mibbit.com/">https://cbe002.chat.mibbit.com/</a> (velg tilkobling med server)</p>\n', 331, '2012-05-02 12:09:02', 0),
(370, NULL, NULL, 'Reisebrev fra Asia', NULL, 'Her kommer Marius Røed sitt reisebrev fra Asia. Jeg fikk dette videresendt fra Update^K-redaktør, Eirik.', '<p>\n	Gå inn på <a href="/profil/mariuroe">bloggen til Marius</a> og se selv</p>\n', NULL, '2012-05-04 14:00:07', 0),
(371, 91, 'event', '17. mai-tog', NULL, '17. mai-toget begynner klokken 13.00 utenfor Nidarosdomen. Oppmøte: 12.45.\n\nVi går uansett vær!', '<p>\n	Møt opp og bli med i 17. mai-tog!</p>\n', 370, '2012-05-17 00:39:04', 0),
(373, NULL, NULL, 'Dette er bare en beta', NULL, 'Denne siden er bare en beta, gå <a href="http://hybrida.no">hit</a> for å komme til hovedsiden', '<p>\n	Ja</p>\n', 381, '2025-07-05 07:18:12', 0),
(375, 97, 'event', 'Testevent', NULL, 'oaietno', '<p>\n	awtaw</p>\n', 381, '2012-08-24 08:55:52', 0),
(377, 99, 'event', 'Evig event', NULL, 'Event som brukes til testing only', '<p>\n	Denne hendelsen med påmelding er åpen frem til 2015. Veldig nyttig til testing</p>\n', 381, '2012-09-11 13:39:55', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `news_group`
--

CREATE TABLE IF NOT EXISTS `news_group` (
  `newsId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `news_group`
--

INSERT INTO `news_group` (`newsId`, `groupId`) VALUES
(3, 56),
(38, 55);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `notification`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `notification_listener`
--

CREATE TABLE IF NOT EXISTS `notification_listener` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `parentType` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentID` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `parentID` (`parentID`,`userID`,`parentType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dataark for tabell `notification_listener`
--

INSERT INTO `notification_listener` (`id`, `userID`, `parentType`, `parentID`) VALUES
(33, 381, 'news', 370),
(32, 381, 'profile', 381);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `rbac_assignment`
--

CREATE TABLE IF NOT EXISTS `rbac_assignment` (
  `itemname` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userid` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `bizrule` text COLLATE utf8_unicode_ci,
  `data` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `rbac_assignment`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `rbac_item`
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
-- Dataark for tabell `rbac_item`
--

INSERT INTO `rbac_item` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, 'Administrator', '', 's:0:"";'),
('all', 2, 'Alle studenter har denne access som standard', NULL, NULL),
('createArticle', 0, 'Poste artikkel', '', 's:0:"";'),
('createNews', 0, 'Poste nyhet', '', 's:0:"";'),
('deleteComment', 2, NULL, NULL, NULL),
('deleteOwnComment', 1, NULL, 'return user()->id == $params["authorId"];', NULL),
('editor', 2, 'Kan redigere, men ikke lage noe nytt', '', 's:0:"";'),
('styret', 2, 'Medlemmer av styret', 'return Yii::app()->gatekeeper->hasGroupAccess(56);', NULL),
('updateArticle', 0, '', '', 's:0:"";'),
('updateGroup', 0, '', '', NULL),
('updateNews', 0, 'oppdatere nyhet', '', 's:0:"";'),
('updateOwnArticle', 1, '', 'return isset($params["id"]) && Article::model()->findByPk($params["id"])->author == user()->id;', 's:0:"";'),
('updateOwnGroup', 1, '', 'return isset($params["id"]) && Groups::model()->findByPk($params["id"])->admin == user()->id;', NULL),
('updateOwnNews', 1, '', 'return isset($params["id"]) && News::model()->findByPk($params["id"])->authorId == user()->id;', 's:0:"";'),
('updateOwnProfile', 1, '', 'return isset($params[''username'']) && isset(user()->name) && $params[''username''] == user()->name;\r\n', 's:0:"";'),
('updateProfile', 0, '', '', 's:0:"";'),
('webkom', 2, 'Medlemmer av webkom', 'return Yii::app()->gatekeeper->hasGroupAccess(55);', NULL),
('writer', 2, 'Kan publisere', '', 's:0:"";');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `rbac_itemchild`
--

CREATE TABLE IF NOT EXISTS `rbac_itemchild` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `rbac_itemchild`
--

INSERT INTO `rbac_itemchild` (`parent`, `child`) VALUES
('webkom', 'admin'),
('writer', 'createArticle'),
('writer', 'createNews'),
('admin', 'deleteComment'),
('deleteOwnComment', 'deleteComment'),
('all', 'deleteOwnComment'),
('admin', 'editor'),
('styret', 'editor'),
('all', 'styret'),
('editor', 'updateArticle'),
('updateOwnArticle', 'updateArticle'),
('admin', 'updateGroup'),
('editor', 'updateNews'),
('updateOwnNews', 'updateNews'),
('writer', 'updateOwnArticle'),
('writer', 'updateOwnNews'),
('all', 'updateOwnProfile'),
('admin', 'updateProfile'),
('updateOwnProfile', 'updateProfile'),
('all', 'webkom'),
('admin', 'writer'),
('styret', 'writer');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `signup`
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
-- Dataark for tabell `signup`
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
(94, 100, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'false', 0),
(98, 1, '2012-08-27 11:00:00', '2012-09-17 11:00:00', 'false', 2),
(97, 1, '2012-08-01 00:00:00', '2012-08-31 00:00:00', 'false', 0),
(99, 10000, '2012-09-01 00:00:00', '2015-09-01 00:00:00', 'true', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `signup_membership`
--

CREATE TABLE IF NOT EXISTS `signup_membership` (
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `signedOff` enum('true','false') COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`eventId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `signup_membership`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `specialization`
--

CREATE TABLE IF NOT EXISTS `specialization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `siteId` int(11) DEFAULT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `siteId` (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Dataark for tabell `specialization`
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
-- Tabellstruktur for tabell `user`
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=521 ;

--
-- Dataark for tabell `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `middleName`, `lastName`, `specializationId`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `lastLogin`, `cardHash`, `description`, `workDescription`, `workCompanyID`, `workPlace`, `birthdate`, `altEmail`) VALUES
(381, 'sigurhol', 'Sigurd', 'Andreas', 'Holsen ', 2, 2015, 'true', 'male', NULL, NULL, '2012-09-11 13:38:54', '276d89c72e366f3e72ce695fd7c9593f67ef3b76', '<h1 style="text-align:left;">\n	Hei eksamensbloggen min!</h1>\n<p style="text-align:left;">\n	Denne dagen har vært syyykt lang..har ikke gjort en dritt egentlig,men dagen har bare gått sykt sakte.. kjedelig! Så tenkte jeg! Blogg, det må jeg få meg. For det er jo bare så syykt kult lissom. Har prøvd og prøvd og prøvd sånn der blogg.no, men det funker ikke. MEN, så tenkte jeg! Jeg kan jo gjøre som mitt store forbilde SIGGE. For han er jo bare SÅ KUUUL! Å bruke denne hybsiden, jeg har laget til å BLOGGE på!</p>\n<p style="text-align:left;">\n	Forresten, hils på pusen min layla, det er min femine side og vi deler alt sammen lissom.</p>\n<p>\n	<img alt="cat.jpg" src="http://dl.dropbox.com/u/13200640/cat.jpg" width="400" /><br />\n	Meg og layla koser oss!</p>\n<p style="text-align:left;">\n	Jeg hadde et sånt påskeforsett og har begynt å trene syykt mye nå.. Og blitt kjempe sterk lissom!</p>\n<p>\n	<img alt="Jeg er digg" src="http://dl.dropbox.com/u/13200640/muscles.jpg" /><br />\n	Jeg som har trent</p>\n<p style="text-align:left;">\n	Etter jeg hadde tatt, sånn vanvittig mye i benk idag lissom, dro jeg hjem og spise 3 store kyllinger! Jeg ble helt latterlig mett, og gikk sikkert opp sånn 20 kilo på vekten lissom. Men det var veldig grisete, så jeg måtte vaske meg og layla også. Heldigvis har vi et sånn stort badekar, som jeg plutselig fikk av en gjeng ungdommer ved nidelven i høst, så det gikk fint!</p>\n<p style="text-align:left;">\n	Men jeg har ett stort problem da folkens! Har blitt så sykt hekta på Sigge sine pannekaker!! De er syykkt gode... Helt sant!! Så spiser det til frokost og kvelds HVER dag! Magen min den bare vokser og vokser og vokser og vokser.. Ser snart ut som en bjørn!</p>\n<p style="text-align:left;">\n	Men folkens! Jeg har ett stort mål! Å bli sånn som mitt store idol SIGGE :D:D Kanskje derfor jeg spiser så veldig mye... Jeg vil også bli så stor og så sterk og stor.. Men, men.. Nå kom layla og satt seg i fanget mitt, nyvasket og myk og da blir jeg så ukonsentrert. Så chill''an .. Så prates vi på trening lissom <img alt="blank.gif" class="emote_img" src="https://s-static.ak.facebook.com/images/blank.gif" style="border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;height:16px;vertical-align:top;width:16px;background-image:url(&quot;https://s-static.ak.fbcdn.net/rsrc.php/v1/yM/r/WlL6q4xDPOA.png&quot;);margin-bottom:-2px;color:rgb(51,51,51);font-family:''lucida grande'', tahoma, verdana, arial, sans-serif;font-size:11px;line-height:14px;background-position:-80px 0px;" title=";)" /></p>\n', '<br />', NULL, '', '1990-12-23', 'sighol@gmail.com'),
(466, 'admin', 'ad', 'm', 'in', NULL, 2000, 'true', 'unknown', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL);

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `iktringen_membership`
--
ALTER TABLE `iktringen_membership`
  ADD CONSTRAINT `fk_iktringen_membership_bk_company1` FOREIGN KEY (`companyId`) REFERENCES `bk_company` (`companyID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Begrensninger for tabell `job_announcement`
--
ALTER TABLE `job_announcement`
  ADD CONSTRAINT `job_announcement_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `bk_company` (`companyID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `rbac_assignment`
--
ALTER TABLE `rbac_assignment`
  ADD CONSTRAINT `rbac_assignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `rbac_itemchild`
--
ALTER TABLE `rbac_itemchild`
  ADD CONSTRAINT `rbac_itemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rbac_itemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `rbac_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
