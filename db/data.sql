-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 29, 2013 at 06:55 PM
-- Server version: 5.1.66
-- PHP Version: 5.3.3-7+squeeze14

SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hybrida_dev`
--
USE `hybrida_dev`;

--
-- Dumping data for table `access_relations`
--

INSERT INTO `access_relations` (`id`, `access`, `type`, `super_id`) VALUES
(24, 4055, 'news', 0),
(40, 2, 'news', 0),
(41, 2, 'news', 0),
(85, 2014, 'signup', 1),
(85, 4055, 'signup', 0);

--
-- Dumping data for table `album`
--


--
-- Dumping data for table `album_image`
--


--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `parentId`, `title`, `shorttitle`, `articleTextId`, `author`, `timestamp`, `weight`) VALUES
(1, NULL, 'Hybrida', NULL, 124, 0, '0000-00-00', 0),
(2, NULL, 'Bedrift', NULL, 7, 331, '2011-11-01', 0),
(53, 1, 'Updateᵏ', NULL, 215, 381, '2012-03-07', 0),
(54, NULL, '2007', NULL, 4, 381, '2012-03-07', 0),
(55, 1, 'Kontaktinfo', NULL, 120, 381, '2012-03-07', 0),
(56, 1, 'Lenker', NULL, 105, 381, '2012-03-07', 0),
(57, 1, 'Sanger', NULL, 82, 381, '2012-03-07', 0),
(58, 1, 'Statutter', NULL, 9, 381, '2012-03-07', 0),
(59, 1, 'Styre og stell', 'Styret', 10, 381, '2012-03-07', 0),
(60, 59, 'Referater', NULL, 213, 381, '2012-03-07', 0),
(61, 55, 'Kontoret', NULL, 14, 381, '2012-03-07', 0),
(62, NULL, 'I&amp;IKT-ringen', NULL, 210, 381, '2012-05-05', 0),
(63, 62, 'Styret', NULL, 211, 381, '2012-05-05', 7),
(64, 62, 'Visjon', NULL, 191, 293, '2012-05-05', 9),
(65, 62, 'Medlemmer', NULL, 196, 293, '2012-05-05', 6),
(66, 62, 'Årsmeldinger', NULL, 197, 293, '2012-05-05', 1),
(67, 62, 'Kontaktinformasjon', NULL, 165, 293, '2012-05-05', 0),
(68, 62, 'Om', NULL, 205, 293, '2012-05-05', 10),
(69, 62, 'Bedriftens bidrag', NULL, 204, 293, '2012-05-05', 3),
(70, 62, 'Promotering', NULL, 200, 293, '2012-05-08', 6),
(71, 70, 'Bedriftspresentasjoner', NULL, 206, 293, '2012-05-08', 5),
(72, 70, 'Update^K', NULL, 207, 293, '2012-05-08', 4),
(73, 2, 'Kontakt', NULL, 27, 293, '2012-05-08', 0),
(74, 2, 'Medlemmer', NULL, 33, 293, '2012-05-08', 0),
(75, NULL, '2012', NULL, 3, 381, '2012-05-12', 0),
(76, 1, 'Tillitsvalgte', 'Tillitsvalgte', 85, 317, '2012-09-04', 0),
(77, 76, 'SPR', 'SPR', 212, 317, '2012-09-04', 1),
(78, 76, 'KTR', 'KTR', 35, 317, '2012-09-04', 0),
(80, 1, 'Lesesalen', NULL, 40, 381, '2012-09-06', 0),
(81, 62, 'I&amp;IKT-studenter', NULL, 199, 317, '2012-11-02', 4),
(82, 81, 'Geomatikk', NULL, 160, 317, '2012-11-02', 0),
(83, 81, 'Produkt og prosess', NULL, 164, 317, '2012-11-02', 0),
(84, 81, 'Konstruksjonsteknikk', NULL, 161, 317, '2012-11-02', 0),
(85, 81, 'Petroleumsfag', NULL, 163, 317, '2012-11-02', 0),
(86, 81, 'Marin teknikk', NULL, 162, 317, '2012-11-02', 0),
(87, 70, 'Andre promoteringsmetoder', NULL, 175, 317, '2012-11-02', 0),
(88, 70, 'Ekskursjoner', NULL, 208, 317, '2012-11-02', 3),
(89, 70, 'Stands', NULL, 209, 317, '2012-11-02', 2),
(91, 65, 'Focus Software AS', NULL, 169, 317, '2012-11-02', 0),
(92, 65, 'Norkart AS', NULL, 170, 317, '2012-11-02', 0),
(93, 65, 'Aker Solutions KBe Design', NULL, 168, 317, '2013-01-19', 0),
(95, 94, 'Progam', NULL, 47, 381, '2013-01-29', 0),
(96, NULL, 'Guide til tilgangssystemet', 'Tilgang', 109, 504, '2013-01-29', 0),
(97, NULL, 'Jubileum', NULL, 81, 370, '2013-02-03', 0),
(99, 1, 'Griffens Orden', 'Griffens Orden', 219, 356, '2013-02-04', 0),
(102, 80, 'Lesesal-IRC', NULL, 83, 380, '2013-02-06', 0);

--
-- Dumping data for table `article_text`
--

INSERT INTO `article_text` (`id`, `articleId`, `content`, `phpFile`, `timestamp`) VALUES
(1, 56, '<p>\n</p><table cellspacing="6"><tr><td width="150"><a href="http://www.ntnu.no/studier/ingeniorvitenskap-ikt">I &amp; IKT på ntnu.no</a>\n</td>\n<td>\nRekrutterings- og infosider.\n</td></tr><tr><td>\n<a href="http://www.ntnu.no/studieinformasjon/timeplan/">Timeplaner</a>\n</td><td>\nTimeplanene til alle klassetrinn.\n</td></tr><tr><td>\n<a href="http://www.ntnu.no/studentservice/">Studentservice</a>\n</td><td>\nSvarer på alle spørsmål du måtte ha som NTNU-student.\n</td></tr><tr><td>\n<a href="http://www.studweb.ntnu.no">ITEAs infoweb</a>\n</td><td>\nInformasjonsbase for IT-systemet\n</td></tr><tr><td>\n<a href="http://www.orakel.ntnu.no">Orakeltjenesten</a>\n</td><td>\nSupport for IT-systemer under NTNU\n</td></tr><tr><td>\n<a href="http://www.samfundet.no">\nStudentersamfundet i Trondhjem</a>\n</td><td>\nNorges største og studentersamfunn.\n</td></tr><tr><td>\n<a href="http://www.universitetsavisa.no">Universitesavisa</a>\n</td><td>\nNyheter fra campus.\n</td></tr><tr><td>\n<a href="http://www.underdusken.no">Under Dusken</a>\n</td><td>\nTrondheims studentavis\n</td></tr><tr><td>\n<a href="http://www.studentrad.no/">Studentrådene</a>\n</td><td>\nStudentrådene ved NTNU\n</td></tr></table>', NULL, '2012-12-11'),
(2, 53, '<p>\n	ARKIV: <a href="http://folk.ntnu.no/eirikaho/Update%5Ek/">http://folk.ntnu.no/eirikaho/Update%5ek/</a></p>\n', 'updatek', '2012-12-11'),
(3, 75, '<p>\n	liste opp alle avisene</p>\n', NULL, '2012-12-11'),
(4, 54, '<table><tbody><tr><td>\n				<a href="http://www.hybrida.ntnu.no/filer/avis/Update-ikt-1.utg.pdf"><img alt="updateUtgave107" src="/bilder/update/update107.png" /></a><br /><a href="http://www.hybrida.ntnu.no/filer/avis/Update-ikt-1.utg.pdf">1. Utgave</a></td>\n		</tr><tr><td>\n				Ansvarlig redaktør 2007: <a href="mailto:thorvag%20%C3%A6%20stud.ntnu.no">Thorvald C Grindstad</a></td>\n		</tr></tbody></table><br />', NULL, '2012-12-11'),
(5, 55, '<p>\n	<b>Hovedstyret</b>: <a href="mailto:hybrida%20%C3%A6%20org.ntnu.no">hybrida æ org.ntnu.no</a> <br /><br /><b>Leder</b>: <a href="mailto:hybrida-leder@org.ntnu.no">Tor Kvestad Idland</a><br /><a href="mailto:hybrida-leder@org.ntnu.no">hybrida-leder@org.ntnu.no </a><br />\n	Tlf: +4748241251</p>\n<h3>\n	Kontor</h3>\n<p>\n	Kjelleren i Gamle Kjemi, rom 19<br />\n	Kolbjørn Hejes vei 4<br />\n	Tlf: 73 55 05 41</p>\n<h3>\n	Postadresse</h3>\n<p>\n	Linjeforeningen Hybrida</p>\n<p>\n	Alfred Getz'' vei 3<br />\n	SB 1<br />\n	7034 Trondheim</p>\n', '', '2012-12-11'),
(6, 57, '<h1>\n	Nu klinger igjennom den gamle stad</h1>\n<div>\n	Nu klinger igjennom den gamle stad, påny en studentersang, </div>\n<div>\n	og alle mann alle i rekker og rad, svinger opp under begerklang! </div>\n<div>\n	Og mens borgerne våkner i køia og hører det glade "kang-kang", </div>\n<div>\n	synger alle mann, alle mann, alle mann, alle mann, alle mann, alle mann ann; </div>\n<div>\n	 </div>\n<div>\n	Refreng: </div>\n<div>\n	Studenter i den gamle stad, ta vare på byens ry! (klapp x2) </div>\n<div>\n	Husk på at jenter, øl og dram var kjempenes meny. </div>\n<div>\n	Og faller I alle mann alle, skal det gjalle fra alle mot sky. </div>\n<div>\n	La''kke byen få ro, men la den få merke det er en studenterby! </div>\n<div>\n	Og øl og dram, og øl og dram, og øl og dram, og øl og dram. </div>\n<div>\n	 </div>\n<div>\n	I denne gamle staden satt så mangen en konge stor, </div>\n<div>\n	og hadde nok av øl fra fat og piker ved sitt bord. </div>\n<div>\n	De laga bøljer i gata når hjem ifra gildet de fór. </div>\n<div>\n	Og nu sitter de alle mann alle i valhall og traller til oss i kor: </div>\n<div>\n	 </div>\n<div>\n	Refreng: </div>\n<div>\n	På Elgeseter var det liv i klosteret dag og natt! </div>\n<div>\n	Der hadde de sin kagge og der hadde de sin skatt. </div>\n<div>\n	De herjet i Nonnenes gate og rullet og tullet og datt. </div>\n<div>\n	Og nu skuer de fra himmelen ned og griper sin harpe fatt. </div>\n<div>\n	 </div>\n<div>\n	Refreng: </div>\n<div>\n	(Adagio) </div>\n<div>\n	Når vi er vandret hen og staden hviler et øyeblikk, (kraftig klapp x2) </div>\n<div>\n	så kommer våre sønner og tar opp den gamle skikk; </div>\n<div>\n	En lek mellom muntre butuljer, samt aldri så lit'' erotikk. </div>\n<div>\n	(Accelerando) </div>\n<div>\n	Også sitter vi i himmelen og stemmer i vår replikk; </div>\n<div>\n	 </div>\n<div>\n	Refreng: </div>\n<div>\n	(Tramp/klapp hele siste refreng) </div>\n<div>\n	Studenter i den gamle stad, ta vare på byens ry! (markant klapp x2) </div>\n<div>\n	Husk på at jenter, øl og dram var kjempenes meny. </div>\n<div>\n	Og faller I alle mann alle, skal det gjalle fra alle mot sky. </div>\n<div>\n	La''kke byen få ro, men la den få merke det er en studenterby!¨ </div>\n<div>\n	(INGEN ØL OG DRAM ETTER SISTE REFRENG!) </div>\n<div>\n	 </div>\n', '', '2012-12-11'),
(7, 2, '<h1>Bedriftskontakt</h1>\n<strong>Hybridas Bedriftskomite (Hybrida BedKom) har ansvaret for kontakten med bedriftene for sivilingeniørstudiet Ingeniørvitenskap og IKT (I &amp; IKT) ved NTNU. Vi ble etablert for å gi bedrifter informasjon om vårt studieprogram og hvilken kompetanse vi kan bidra med.</strong>\n<p>Hovedmålet vårt er at vi vil hjelpe studentene på linja med prosjektoppgaver, hovedoppgaver, sommerjobber og fast ansettelse. I tillegg kan bedriftsbesøk, ekskursjoner og temakvelder gi bedrifter og studenter mulighet til å snakke sammen.</p>\n<p>Arrangementer av denne typen krever samarbeid fra bedrifter. Hvis du kan bidra, kontakt oss gjerne via linken i menyen venstre. For en komplett liste med Hybrida Bedkoms oppgaver og gjøremål, se våre statutter i samme meny.</p>\n<h2>Bedriftsbesøk:</h2>\n<p>Et bedriftsbesøk går i hovedsak ut på at bedriften besøker NTNU for å presentere seg for studentene. Et typisk bedriftsbesøk innebærer først og fremst en presentasjon der bedriften holder \nforedrag for utvalgte studenter. I tillegg er det vanlig med påfølgende bespisning, og mange bedrifter velger å ha jobbsamtaler/intervjuer tilknyttet besøket.</p>\n<p>Hensikten er vanligvis først og fremst rekruttering, men et bedriftsbesøk gir også god markedsføring mot kommende sivilingeniører. Hybrida BedKom tar seg av all praktisk organisering  dere trenger kun å møte opp forberedt med presentasjon!</p>\n<h2>Presentasjon:</h2>\n<p>Presentasjonen varer vanligvis i én skoletime (45 minutter) og avholdes oftest i auditorium. Her er de fleste audiovisuelle hjelpemidler tilgjengelig (PC/projektor, mikrofoner, overhead osv), og dersom dere har spesielle ønsker vil vi selvsagt forsøke å etterkomme disse. De fleste presentasjoner begynner 17:15 eller 18:15, da dette passer godt med timeplanen til studentene.</p>\n<h2>Bespisning:</h2>\n<p>De aller fleste bedrifter velger å spandere mat og drikke etter presentasjonen. Her har vi flere samarbeidspartnere og kan blant annet tilby rimelige alternativer fra \nSiT (Studentsamskipnaden i Trondheim), som holder til på Gløshaugen. Noen bedrifter ønsker fri bar, andre vil ha et fast antall enheter i form av drikkebonger. Bespisningen gir bedriften en fin mulighet til å snakke direkte med studentene i uformelle omgivelser. Det er ofte i den forbindelse interesserte melder seg på til jobbsamtaler.</p>\n<h2>Tips:</h2>\n<p>Dette er tips basert på tilbakemeldinger vi har fått fra studenter over flere år:\n</p><ul><li>Husk at dere snakker for I &amp; IKT-studenter. Ikke vær redd for å bruke fagbegreper de burde kjenne til.</li>\n	<li>Forsøk å skille dere ut fra andre bedrifter  hva er det som gjør nettopp dere til den mest attraktive arbeidsgiveren?</li>\n	<li>Fokuser på hvordan det er å arbeide i deres bedrift  sosialt, arbeidsoppgaver, arbeidsmiljø, utfordringer Vis gjerne bilder fra arbeidsplassen.</li>\n	<li>Organisasjonsinndeling, økonomi og administrasjon er ofte mindre interessant når det kommer til å velge jobb. Forsøk å legg mindre vekt på dette enn de \novernevnte punkter.</li>\n	<li>Begrens presentasjonen til 45 minutter.</li>\n	<li>Ta med en nyutdannet sivilingeniør fra NTNU, samt en fra HR.</li>\n	<li>Still med flere personer, slik at dere er lette å komme i kontakt med under bespisningen.</li>\n</ul><h2>Priser:</h2>\n<p></p><p>Hybrida BedKom tar et honorar på kroner 10 000,- for en full bedriftspresentasjon som holdes for alle klassetrinn ved studiet. Dette inkluderer PR-kostnader og liknende. Mat og drikke kommer i tillegg. Priser fra ulike leverandører fåes ved forespørsel. Hvis bedriften ønsker en presentasjon for mindre grupper innenfor I &amp; IKT (typisk en av spesialiseringene), kan dette selvsagt ordnes etter avtale. Slike arrangement tar vi selvsagt et lavere honorar for.</p>', NULL, '2012-12-11'),
(8, 1, '<p>\n	<strong>Hybrida er linjeforeningen for studieprogrammet Ingeniørvitenskap og IKT ved NTNU i Trondheim.</strong></p>\n<p>\n	Foreningens formål er å fremme samhold og kameratskap innad på studieprogrammet ved bla.a. å avholde arrangementer av både sosial og faglig karakter. Mer informasjon om oss finner du under menyen til høyre.</p>\n<div>\n<center>\n	<img alt="Hybrida logo" src="/images/logo_big.png" style="margin:0 auto;" width="400" /></center>\n</div>\n', '', '2012-12-11'),
(9, 58, '<a href="http://folk.ntnu.no/bjorask/hybridaweb/statutter16112010.pdf">Hybridas Statutter</a><br /><br /><a href="http://folk.ntnu.no/bjorask/hybridaweb/StatutterBedKom.pdf">Bedriftskomiteens statutter</a>', NULL, '2012-12-11'),
(10, 59, '', 'styret_om_oss', '2012-12-11'),
(11, 64, '<p class="MsoQuote" style="margin-left:36pt;text-indent:-18pt;">\n	<span style="font-size:16pt;line-height:115%;"><span> </span><span> </span>-<span style="font-size:7pt;line-height:normal;font-family:''Times New Roman'';">        <em> </em></span></span><em><span style="font-size:16pt;line-height:115%;"><span> </span>Vi s</span></em><span style="font-size:16pt;line-height:115%;"><em>ikrer kvaliteten for næringslivet</em><span> </span><span> </span><span> </span></span></p>\n<h2>\n	<span class="apple-style-span"><span style="color:#000000;">Visjon for I&amp;IKT-ringen</span></span></h2>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">I&amp;IKT-ringen skal gjøre studiet I&amp;IKT bedre og sørge for en fremdeles sterk rekruttering av høy kvalitet til studiet og næringslivet. Dette gjøres ved å hindre frafall og ved å holde karaktersnittet for opptaksstudenter på et høyt nivå.</span></span></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Med bakgrunn i finansiering fra I&amp;IKT-ringen og målrettede handlinger fra styret i samarbeidet med innspill fra medlemmene skal dette bli en realitet.</span></span></p>\n<p class="MsoNormal">\n	Medlemsbedriftene får eksklusiv mulighet til å promotere seg ovenfor, og rekruttere studenter med bakgrunn fra tradisjonell ingeniørvitenskap med kunnskaper innenfor IKT.</p>\n<p>\n	 </p>\n', 'ringen_base', '2012-12-11'),
(12, 65, '<h3>\n	Oversikt over bedriftene som er medlemmer i I&amp;IKT-ringen.</h3>\n<p>\n	 </p>\n<p>\n	Her skal det være:</p>\n<p>\n	Logo, navn og link til hjemmeside for hver av medlemsbedriftene</p>\n', 'ringen_base', '2012-12-11'),
(13, 66, '<h3>\n	Årsmeldingene er en årlige rapporter levert av I&amp;IKT-ringen som oppsummerer årets aktiviteter i samarbeidet.</h3>\n<p>\n	 </p>\n<p>\n	Her skal det være en liste over og link til alle årsmeldingene som blir publisert av I&amp;IKT-ringen, med illustrasjonsbilde</p>\n<p>\n	 </p>\n', 'ringen_base', '2012-12-11'),
(14, 61, '<table border="0" cellspacing="1"><tr><th>Fra hovedbygget:</th>\n<th></th>\n<th>Fra stripa, sentralbygget, realfagsbygget, lesesalen:</th>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/1a_fra_plenen.jpg" alt="1a_fra_plenen.jpg" /></td>\n<td></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/1b_fra_stripa.jpg" alt="1b_fra_stripa.jpg" /></td>\n\n</tr><tr><td>1a) Dette ser du når du kommer<br /> fra plenen bak hovedbygget.<br /></td>\n<td></td>\n<td>1b) Dette ser du når du kommer<br /> fra stripa/sentralbygget.<br /></td>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/2_dor_1.jpg" alt="2_dor_1.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/3_trapp.jpg" alt="3_trapp.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/4_dor_2.jpg" alt="4_dor_2.jpg" /></td>\n</tr><tr><td>2) Gå inn denne døra.<br /></td>\n<td>3) Gå ned denne trappa.<br /></td>\n<td>4) Ta til høyre og gå inn denne døra.<br /></td>\n</tr><tr><td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/5_dorhandtak.jpg" alt="5_dorhandtak.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/6_gang.jpg" alt="6_gang.jpg" /></td>\n<td><img src="http://www.hybrida.ntnu.no/bilder/til_kontoret/7_kontoret.jpg" alt="7_kontoret.jpg" /></td>\n</tr><tr><td>5) Den er åpen frem til klokka 16.</td>\n<td>6) Gå inn denne gangen.</td>\n<td>7) Gå inn andre dør til høyre.</td>\n</tr></table>', NULL, '2012-12-11'),
(15, 60, '<p>\n	Her kommer alle referatene fra styremøter og generalforsamlinger i Hybrida.</p>\n<p>\n	Disse referatene er hentet fra forskjellige steder, så det kan hende at datoen ikke stemmer overens med datoen i dokumentet. Hvis du ser eksempler på dette er vi veldig takknemlige hvis du bruker Feedback-knappen til venstre og sier ifra.</p>\n', 'styret_referater', '2012-12-11'),
(16, 62, '<h2>\n	<strong>Velkommen til I&amp;IKT-ringen</strong></h2>\n<p>\n	I&amp;IKT-ringen er et samarbeid mellom næringslivet og sivilingeniørstudiet Ingeniørvitenskap og IKT (I&amp;IKT) ved NTNU. Samarbeidet skal gjøre studiet bedre og sørge for en fremdeles sterk rekruttering av høy kvalitet til næringslivet.</p>\n<p>\n	 </p>\n<h3>\n	<strong>Nylig aktivitet:</strong></h3>\n<p>\n	Aktivitet</p>\n', 'ringen_base', '2012-12-11'),
(17, 63, '\n<p>\n	Styret i er en samling av representanter fra NTNU og næringslivet og er det overordnede organet i I&amp;IKT-ringen.</p>\n<p>\n	 </p>\n<p>\n	<strong>Styreleder</strong></p>\n<p>\n	Ole Ivar Sivertsen</p>\n<p>\n	Mail: ole.ivar.sivertsen (at) ntnu.no</p>\n<p>\n	 </p>\n<p>\n	<strong>Leder for I&amp;IKT-ringen</strong></p>\n<p>\n	Ola Westby</p>\n<p>\n	Mail: ola.westby (at) bntv.no</p>\n<p>\n	 </p>\n<p>\n	<strong>Representanter fra næringslivet</strong></p>\n<p>\n	Aker Solutions KBe Design: Jon Østmoen</p>\n<p>\n	Mail: jon.ostmoen (at) akersolutions.com</p>\n<p>\n	 </p>\n<p>\n	Focus Software AS: Pål Eskerud</p>\n<p>\n	Mail: pe (at) focus.no</p>\n<p>\n	 </p>\n<p>\n	Logica: Odd Jøran Sagegg</p>\n<p>\n	Mail: odd.joran.sagegg (at) logica.com</p>\n<p>\n	 </p>\n<p>\n	Norkart AS: Sverre Wisløff</p>\n<p>\n	Mail: sverre (at) norkart.no</p>\n<p>\n	 </p>\n<p>\n	Statoil ASA: Jens Grimsgaard</p>\n<p>\n	Mail: jegri (at) statoil.com</p>\n<p>\n	 </p>\n<p>\n	<strong>Representanter fra NTNU</strong></p>\n<p>\n	Asbjørn Rolstadås</p>\n<p>\n	Mail: asbjorn.rolstadas (at) ntnu.no</p>\n<p>\n	 </p>\n<p>\n	Heine Larsen Nersund</p>\n<p>\n	Mail: heine.nersund (at) ntnu.no</p>\n<p>\n	 </p>\n<p>\n	Jon Atle Gulla</p>\n<p>\n	Mail: jag (at) idi.ntnu.no</p>\n<p>\n	 </p>\n<p>\n	<strong>Studentrepresentanter fra NTNU</strong></p>\n<p>\n	Erik Aasmundrud</p>\n<p>\n	Mail: erikaasm (at) stud.ntnu.no</p>\n<p>\n	 </p>\n<p>\n	Jakob Haug Oftebro</p>\n<p>\n	Mail: jakobhau (at) stud.ntnu.no</p>\n<p>\n	 </p>\n', 'ringen_base', '2012-12-11'),
(18, 67, '<p>\n	<strong>Leder for I&amp;IKT-ringen</strong></p>\n<p>\n	Ola Westby</p>\n<p>\n	Mail: <a href="mailto:ola.westby@bntv.no">ola.westby@bntv.no</a></p>\n<p>\n	 </p>\n<p>\n	<strong>Studieprogramleder I&amp;IKT</strong></p>\n<p>\n	Ole Ivar Sivertsen</p>\n<p>\n	Mail: <a href="mailto:ole.ivar.sivertsen@ntnu.no">ole.ivar.sivertsen@ntnu.no</a></p>\n<p>\n	 </p>\n<p>\n	<strong>Studentenes bedriftskontakt</strong></p>\n<p>\n	Hybrida Bedriftskomité v/ Bedriftskomitésjef Åsmund Pedersen Hugo</p>\n<p>\n	Mail: <a href="mailto:hybrida-bedrift@list.stud.ntnu.no">hybrida-bedrift@list.stud.ntnu.no</a></p>\n<p>\n	Tlf: 98 60 42 66</p>\n<p>\n	 </p>\n', 'ringen_base', '2012-12-11'),
(19, 68, '<h2>\n	Om I&amp;IKT-ringen og partene i samarbeidet</h2>\n<p>\n	I&amp;IKT-ringen er et samarbeidsforum med partene: linjeforeningen Hybrida ved Hybrida Bedriftskomité, fakultet for Ingeniørvitenskap og Teknologi og bedriftene som er medlemmer i samarbeidet. Formålet med samarbeidet er å tilby bedrifter helhetlig kontakt med studenter fra sivilingeniørstudiet Ingeniørvitenskap og IKT (I&amp;IKT) ved NTNU og dets tilhørende fakultet.</p>\n<p>\n	Medlemskap i I&amp;IKT-ringen gir bedriften mulighet til å komme med innspill til faktultetet om studieformen ved I&amp;IKT, samtidig som bedriften oppnår fordeler med et slikt samarbeid med Hybrida Bedriftskomité. Blant disse fordelene er muligheten til å promotere seg særskilt ovenfor studenter på I&amp;IKT.</p>\n<p>\n	Hybrida Bedriftskomité er en underkomité av linjeforeningen Hybrida. Komiteen har ansvaret for kontakten med bedrifter for I&amp;IKT. Komiteen ble etablert for å opprette kontakt mellom studentene og bedrifter og gi bedrifter informasjon om hvilken kompetanse våre studenter innehar.</p>\n<p>\n	Hovedmålet til komiteen er å hjelpe studentene på linjen til prosjektoppgaver, hovedoppgaver, sommerjobber og fast ansettelse i samarbeid med bedrifter. I tillegg kan bedriftsbesøk, ekskursjoner og lignende arrangert i samarbeid med komiteen gi bedrifter og studenter mulighet til å snakke sammen.</p>\n<p>\n	 </p>\n<h3>\n	Om sivilingeniørstudiet Ingeniørvitenskap og IKT</h3>\n<p>\n	Hvor ofte har ikke et systemutviklingsprosjekt gått i vasken, fordi utviklerne ikke kjente behovene til fagspesialistene som skulle bruke systemet? Hvem har ikke latt seg fascinere av hvordan gode IKT-verktøy effektiviserer, visualiserer og videreutvikler tradisjonelle ingeniørmetoder?</p>\n<p>\n	I&amp;IKT har som mål å utdanne sivilingeniører med en tverrfaglig kompetanse. Utvikling av fremtidens teknologi vil være avhengig av at vi samtidig kan utvikle nye IKT-løsninger. Dette krever at man kan bygge bro mellom datatekniske og ingeniørfaglige utfordringer, og for å oppnå dette må man klare å ha oversikt over hele bildet.</p>\n<p>\n	Sivilingeniører fra Ingeniørvitenskap og IKT har den kunnskapen som kreves for å møte disse utfordringene, med solid kompetanse innen både den ingeniørfaglige og den datatekniske siden av sitt fagfelt. Studentene skal både kunne fylle rollen som fagspesialist og systemutvikler innen sitt fagområde.</p>\n<p>\n	<img alt="Skjermer" src="/upc/files/ringen/images/ikt_skjermer.jpg" /></p>\n<h3>\n	Oppbygningen av studiet</h3>\n<p>\n	Studieløpet ved I&amp;IKT skiller seg fra andre sivilingeniørlinjer ved at den har et stort fokus på tverrfaglighet. I løpet av programmets to første år blir studentene introdusert for grunnleggende programmering og systemutvikling på lik linje med studenter fra rene IKT-rettede studieprogram. Samtidig blir studentene introdusert til ingeniørfag som mekanikk, fysikk og matematikk. Dette skal gi studentene en grundig innføring i fagområder knyttet til programmering, men samtidig et grunnlag til å bygge ut i fra når de velger spesialisering videre.</p>\n<p>\n	Etter fjerde semester velger studentene spesialisering blant Produkt og prosess, Marin teknikk, Konstruksjonsteknikk, Geomatikk og Petroleumsfag. Dette betyr i praksis at studenten følger det faglige løpet ved den respektive fordypningen, samtidig som man beholder en rekke IKT-fag ut studieløpet. Målet er at en student fra I&amp;IKT skal gå ut med samme dybde i faget som studenter fra samme fagfelt og kunnskap tilsvarende en IKT-utdanning på universitetsnivå.</p>\n<p>\n	 </p>\n', 'ringen_base', '2012-12-11'),
(20, 69, '<h2>\n	Bedriftens bidrag gjennom medlemskap i I&amp;IKT-ringen</h2>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Bedriften bidrar med en årlig medlemskapsavgift gjennom sitt medlemskap i I&amp;IKT-ringen. Styret i I&amp;IKT-ringen ivaretar inntektene fra avgiften og disse pengene brukes til å forbedre studieprogrammet I&amp;IKT. Denne medlemskapsavgiften avhenger selvsagt av bedriftens størrelse. En oversikt over bidraget fra hver størrelsesgruppe finnes i tabellen under.</span></p>\n<p class="MsoNormal">\n	 </p>\n<table border="1" cellpadding="0" cellspacing="0" class="MsoTable15List2Accent5" style="border-collapse:collapse;border:none;"><tbody><tr><td style="width:139.5pt;border-top:solid #8EAADB 1pt;border-left:none;border-bottom:solid #8EAADB 1pt;border-right:none;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="186">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					<b>Antall ansatte i bedriften</b></p>\n			</td>\n			<td style="width:105pt;border-top:solid #8EAADB 1pt;border-left:none;border-bottom:solid #8EAADB 1pt;border-right:none;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="140">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					<b>Medlemskapsavgift</b></p>\n			</td>\n		</tr><tr><td style="width:139.5pt;border:none;border-bottom:solid #8EAADB 1pt;background:#d9e2f3;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="186">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					&lt; 500</p>\n			</td>\n			<td style="width:105pt;border:none;border-bottom:solid #8EAADB 1pt;background:#d9e2f3;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="140">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					10 000 kr</p>\n			</td>\n		</tr><tr><td style="width:139.5pt;border:none;border-bottom:solid #8EAADB 1pt;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="186">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					500 – 2000</p>\n			</td>\n			<td style="width:105pt;border:none;border-bottom:solid #8EAADB 1pt;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="140">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					12 500 kr</p>\n			</td>\n		</tr><tr><td style="width:139.5pt;border:none;border-bottom:solid #8EAADB 1pt;background:#d9e2f3;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="186">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					&gt; 2000</p>\n			</td>\n			<td style="width:105pt;border:none;border-bottom:solid #8EAADB 1pt;background:#d9e2f3;padding:1.45pt 5.4pt 1.45pt 5.4pt;" valign="top" width="140">\n				<p class="MsoNormal" style="margin-bottom:.0001pt;">\n					15 000 kr</p>\n			</td>\n		</tr></tbody></table><p class="MsoNormal">\n	<br /><span lang="no-nyn" xml:lang="no-nyn">Et samarbeid gjennom I&amp;IKT-ringen vil være avtalefestet gjennom en samarbeidsavtale som oppsummerer forpliktelsene til alle parter i samarbeidet. </span></p>\n<p class="MsoNormal">\n	 </p>\n', 'ringen_base', '2012-12-11'),
(21, 73, '<h2>\n	Kontakt Hybrida Bedriftskomité</h2>\n<div class="artikkel" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:1.4em;color:rgb(0,0,0);text-align:left;">\n	<p>\n		Hvis din bedrift vil avholde et arrangement i samarbeid med oss, ta gjerne kontakt med oss via følgende kanaler:</p>\n	<h4 style="padding:0px;margin-bottom:5px;margin-left:0px;">\n		Felles e-postadresse for hele komiteen</h4>\n	<p style="padding:0px;margin-bottom:5px;margin-left:0px;">\n		<a href="mailto:hybrida-bed@org.ntnu.no" style="line-height:1.4em;">hybrida-bed@org.ntnu.no</a></p>\n	<h4 style="padding:0px;margin-bottom:5px;margin-left:0px;">\n		<span style="font-size:15px;line-height:1.4em;">Post</span></h4>\n	<p>\n		Linjeforeningen Hybrida</p>\n	<p>\n		Alfred Getz'' vei 3<br />\n		SB 1<br />\n		7034 Trondheim</p>\n	<h4>\n		<span style="line-height:1.4em;">Bedriftskomitésjef</span></h4>\n	<p>\n		<a href="http://hybrida.no/profil/aasmunph">Åsmund Pedersen Hugo</a></p>\n	<p>\n		E-post: <a href="mailto:hybrida-bedrift@list.stud.ntnu.no">hybrida-bedrift@list.stud.ntnu.no</a></p>\n	<p>\n		<span style="line-height:1.4em;">Tlf. 98 60 42 66</span></p>\n</div>\n<div>\n	 </div>\n', NULL, '2012-12-11'),
(22, 76, '<h1>\n	Studieprogramsrepresentanter (SPRer):</h1>\n<p>\n	SPRene skal ivareta studentenes interesser og er fremstre representant for studetene ved studieprogrammet og opp mot studieprogrammet ledelse. SPRene er:</p>\n<p>\n	   - Erik Aasmundrud (5. klasse): <a href="mailto:erikaasm@stud.ntnu.no">erikaasm@stud.ntnu.no</a></p>\n<p>\n	   - Jakob Haug Oftebro (3. klasse): <a href="mailto:jakobhau@stud.ntnu.no">jakobhau@stud.ntnu.no</a></p>\n<p>\n	 </p>\n<h2>\n	Klassetillitsrepresentanter (KTRer):</h2>\n<p>\n	KTRene er i hovedsak kontaktperson for studenten ei sin klasse. Som KTR skal man være tilgengelig for den enkelte student og hjelpe han/henne med problemer som angår studiet og klassesituasjonen, evt. henvise videre til instanser som kan gi hjelp. KTRene er:</p>\n<h3>\n	1. klasse:</h3>\n<p>\n	   - William Knudtzon: <a href="mailto:williawk@stud.ntnu.no">williawk@stud.ntnu.no</a></p>\n<p>\n	   - Aase Melaaen: <a href="mailto:aasesm@stud.ntnu.no">aasesm@stud.ntnu.no</a></p>\n<h3>\n	2. klasse:</h3>\n<p>\n	   - Marius Eek: <a href="mailto:mariusee@stud.ntnu.no">mariusee@stud.ntnu.no</a></p>\n<p>\n	   - Karoline L. Rykkelid: <a href="mailto:karolinr@stud.ntnu.no">karolinr@stud.ntnu.no</a></p>\n<div>\n	<h3>\n		3. klasse:</h3>\n	<p>\n		   - Andrè Mruz: <a href="mailto:mruz@stud.ntnu.no">mruz@stud.ntnu.no</a></p>\n	<p>\n		   - Sibjørn Aukland: <a href="mailto:sibja@stud.ntnu.no">sibja@stud.ntnu.no</a></p>\n	<h3>\n		4. klasse:</h3>\n	<p>\n		   - Ole Magnus Urdahl: <a href="mailto:olemagu@stud.ntnu.no">olemagu@stud.ntnu.no</a></p>\n	<p>\n		   - Tone Wermundsen: <a href="mailto:wermunds@stud.ntnu.no">wermunds@stud.ntnu.no</a></p>\n	<div>\n		<h3>\n			5. klasse:</h3>\n	</div>\n</div>\n<div>\n	<div>\n		<p>\n			   - Dag Morten Stensholt: <a href="mailto:dagmors@stud.ntnu.no">dagmors@stud.ntnu.no</a></p>\n		<p>\n			   - Marianne Hønsi: <a href="mailto:mariahon@stud.ntnu.no">mariahon@stud.ntnu.no</a></p>\n	</div>\n</div>\n<p>\n	 </p>\n', '', '2012-12-11'),
(23, 70, '<h2>\n	Promoteringsmetoder</h2>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Ved medlemskap blir det anledning for bedriften til å promotere seg særskilt ovenfor studenter ved I&amp;IKT. I&amp;IKT-ringen er den eneste som kan tilby eksklusiv kontakt med sivilingeniører med en slik kompetanse i Norge.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hybrida Bedriftskomité sørger for promotering av bedrifter opp mot studentene ved I&amp;IKT. Promoteringsmetoder som kan nevnes er blant annet:</span></p>\n<p>\n	 - Bedriftspresentasjoner</p>\n<p class="MsoNormal">\n	 - Annonser og intervjuer i linjeforeningsavis</p>\n<p class="MsoNormal">\n	 - Plakater hengt opp på campus</p>\n<p class="MsoNormal">\n	 - Hjemmeside</p>\n<p>\n	 - Ekskursjoner</p>\n<p>\n	 - Mail til studenter angående stillingsannonser, sommerjobber o.l.</p>\n<p>\n	 - Stands</p>\n<p>\n	 </p>\n', 'ringen_base', '2012-12-11'),
(24, 71, '<h2>\n	Bedriftspresentasjoner</h2>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hybrida Bedriftskomités primære metode for å promotere bedrifter ovenfor studenter er å arrangere bedriftspresentasjoner.</span></p>\n<p>\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Om bedriftspresentasjoner</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">En bedriftspresentasjon går i hovedsak ut på at bedriften besøker NTNU for å presentere seg for studentene. Et slikt besøk innebærer først og fremst en presentasjon der bedriften holder foredrag for utvalgte studenter. Det er også mulig å rette seg spesielt mot studenter fra en gitt fordypning. I tillegg er det vanlig med påfølgende bespisning, og mange bedrifter velger å ha jobbsamtaler/intervjuer tilknyttet besøket.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Hensikten er først og fremst rekruttering, men en bedriftspresentasjon gir også god markedsføring mot kommende sivilingeniører. Hybrida Bedriftskomité tar seg av all praktisk organisering, bedriften trenger kun å møte opp forberedt med en presentasjon.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Presentasjonen varer vanligvis i én forelesingstime (45 minutter) og avholdes oftest i auditorium. Her er de fleste audiovisuelle hjelpemidler tilgjengelig (PC/projektor). Dersom bedriften har spesielle ønsker vil vi selvsagt forsøke å etterkomme disse. De fleste presentasjoner begynner 17:15 eller 18:15, da dette passer godt med timeplanen til studentene.</span></p>\n<p>\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Bespisning</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">De aller fleste bedrifter velger å spandere mat og drikke etter presentasjonen. Her har vi flere samarbeidspartnere og kan blant annet tilby rimelige alternativer fra SiT (Studentsamskipnaden i Trondheim), som holder til på Gløshaugen. I tillegg til SiT er også serveringsalternativer ved restauranter i Trondheim sentrum aktuelle. Restauranter er ikke nøvdendigvis dyrere enn SiT.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Noen bedrifter ønsker fri bar, andre vil ha et fast antall enheter i form av drikkebonger. Bespisningen gir bedriften en fin mulighet til å snakke direkte med studentene i uformelle omgivelser. Det er ofte i den forbindelse interesserte melder seg til jobbsamtaler.</span></p>\n<p>\n	 </p>\n<p class="MsoNormal">\n	<b><span lang="no-nyn" xml:lang="no-nyn">Kostnadsinformasjon ved bedriftspresentasjon</span></b></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Fast honorar til Hybrida Bedriftskomité som arrangør, er 150 kr per besøkende gjest, honorargrensen er på 10 000 kr. Dette betyr at Hybrida Bedriftskomité ikke kommer til å kreve mer enn 10 000 kr totalt i honorar for et arrangement, uavhengig om antall besøkende tilsier mer. Dette honoraret er bidrag til Hybrida som går til studentene på I&amp;IKT.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">For medlemmer av I&amp;IKT-ringen følger det derimot rabatter ved bedriftspresentasjoner med i medlemskapet. Rabattene inluderer 25 % avslag på honoraret, i tilegg til 25 % på maksimalt honorar. Dette tilsier 112,50 kr per besøkende gjest, og maksimalt 7500 kr.</span></p>\n<p class="MsoNormal">\n	<span lang="no-nyn" xml:lang="no-nyn">Kostnader knyttet til mat og drikke på serveringsstedet kommer i tillegg til honoraret. Oppdaterte menyer og priser for ulike serveringssteder kan fåes av Hybrida Bedriftskomité på forespørsel, da de hele tiden er utsatt for endringer.</span></p>\n<p class="MsoNormal">\n	 </p>\n', 'ringen_base', '2012-12-11'),
(25, 72, '<h2>\n	Linjeforeningsavisen Update^k</h2>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Gjennom et samarbeid med linjeforeningens avis, Update<sup>K</sup>, kan Hybrida Bedriftskomité tilby annonsering og dekning av bedriften. Update<sup>K</sup> gis ut til alle studenter ved I&amp;IKT seks ganger årlig. Deadline for hver av avisens utgaver kan fås ved etterspørsel.</span></span></p>\n<p>\n	<img alt="Update" height="270" src="/upc/files/ringen/images/update_fremsider.png" width="242" /></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Som medlem av I&amp;IKT-ringen vil bedriftene få sin logo trykt i avisen i hver utgave. I tillegg er det også mulig for bedriften å publisere informasjon gjennom intervjuer og artikler med mer. Skulle man ønske å utlyse sommerjobb/jobbannonser er dette selvfølgelig også mulig å gjøre.</span></span></p>\n<p class="MsoNormal">\n	<span class="apple-style-span"><span style="color:#000000;">Hvis man ønsker annonsering i forbindelse med et spesielt arrangement kan avisen også tilby dekning av dette arrangement på forhånd. Dette kan for eksempel være en artikkel hvor man går kort inn på hva bedriften gjør, hvordan det er å jobbe der og informerer om kommende arrangementer.</span></span></p>\n<p class="MsoNormal">\n	 </p>\n', 'ringen_base', '2012-12-11'),
(26, 74, '<h2>\n	Medlemmer i Hybrida Bedriftskomité</h2>\n<p>\n	Hybrida Bedriftskomité jobber for å øke kontakten mellom bedrifter og studenter ved Ingeniørvitenskap og IKT. Vi har også som mål å gjøre linjen bedre kjent og spre kunnskap om hvilken kompetanse en I&amp;IKT-student innehar.</p>\n<p>\n	 </p>\n<p>\n	Liste med bilde, navn og stilling til alle i komiteen her</p>\n', NULL, '2012-12-11'),
(27, 77, '<p>\n	<b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Formålet med studieprogramrepresentanter (SPR).</b><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">SPR skal ivareta studentenes interesser og er fremste representant for studentene ved studieprogrammet og opp mot studieprogrammets ledelse.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Hvem er vi?</b></p>\n<p>\n	<span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Erik Aasmundrud (5. klasse): (<a class="linkclass" href="mailto:erikaasm@stud.ntnu.no" style="font-size:11pt;color:rgb(51,102,153);">erikaasm@stud.ntnu.no</a>)</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Jakob Haug Oftebro (3. klasse): (<a class="linkclass" href="mailto:jakobhau@stud.ntnu.no" style="font-size:11pt;color:rgb(51,102,153);">jakobhau@stud.ntnu.no</a>)</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Arbeidsoppgaver:</b><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;"> </span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Kontakt med studentdemokratiet:</b><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• SPR skal ha dialog med KTRer eller tilsvarende og de Studenttillitsvalgte ved fakultetet.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• SPR skal arrangere møter med KTRer (anslagsvis 1 i semesteret).</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• SPR skal møte på studentrådsmøtene (opptil hver mandag).</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• SPR skal holde allmøte minst en gang per semester.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• SPR bør møte på Studenttingets møter.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• SPR skal delta på seminarer som blir holdt i regi av Studentrådet.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Kontakt med studieprogrammet:</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• Møte på møtene i Studieprogramutvalget.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• Møte på møtene i Studieprogramrådet.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">• Avtroppende SPR må sørge for forsvarlig overlapp og opplæring av ny SPR.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Hvor finner du oss?</b><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Studentrådskontoret rett over SiT Kiosken på Stripa.</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Når har vi kontortid?</b><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Vi befinner oss på Studentrådskontoret hver tirsdag mellom klokken 1500 og 1700. Vi svarer også på mail!</span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Myndighet</b><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><span style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">SPR er valgt av allmøtet ved Studieprogrammet og representerer studentene ved studieprogrammet mellom allmøtene. SPR sitter i et år av gangen. </span><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><br style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;" /><b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:20.516666412353516px;">Det viktigste er: Er det noe du ikke er fornøyd med i din studiehverdag, så kom til oss!</b></p>\n', NULL, '2012-12-11'),
(28, 78, '<p>\n	<b style="color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:1.4em;">Formålet med klassetillitsvalgt (KTR) </b></p>\n<p style="margin-top:0px;color:rgb(0,0,0);font-family:Verdana, Arial, Helvetica, sans-serif;">\n	<span style="font-size:15px;line-height:1.4em;">KTR er i hovedsak kontaktperson for studentene i sin klasse. Som KTR skal du være tilgjengelig for den enkelte student og hjelpe han/henne med problemer som angår studiet og klassesituasjonen, evt. henvise videre til instanser som kan gi hjelp. Det er KTR sin oppgave å ta opp saker som angår klassen internt, enten dette er rettet mot faglærer eller klassen i sin helhet.</span></p>\n<p class="artikkel" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:1.4em;color:rgb(0,0,0);">\n	<br /><b>Arbeidsoppgaver: </b></p>\n<p class="artikkel" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:1.4em;color:rgb(0,0,0);">\n	Skal møte på de møter SPR arrangerer (anslagsvis 1 i semesteret).<br />\n	Møte på allmøte i studieprogrammet.<br />\n	Informere klassen når det er allmøte, og gjerne "blæste" litt. <br />\n	KTR skal engasjere seg i kvalitetssikringen av fagene som klassen har.<br />\n	KTR skal sjekke ut at det opprettes referansegrupper i alle obligatoriske fag i de tre første årstrinn av studieprogrammet. Hvis referansegruppe ikke opprettes innen rimelig tid etter semesterstart skal dette meldes videre til SPR.<br />\n	Delta på møtet som arrangeres for alle KTRer en gang i semesteret ai regi av SPRene.<br />\n	Rapportere eventuelle klagesaker som angår det berørte årstrinnet til SPRene.<br /><br /><b>Myndighet</b></p>\n<div class="artikkel" style="font-family:Verdana, Arial, Helvetica, sans-serif;font-size:15px;line-height:1.4em;color:rgb(0,0,0);">\n	KTR er valgt av allmøtet i klassen og representerer studentene i klassen mellom allmøtene. De er i utgangspunktet valgt for et år av gangen, men er selv ansvarlig å avholde nyvalg, anslagsvis hver høst, når de selv har sittet et år. Det er mulig, og ønskelig, at de selv stiller til gjenvalg. Når SPR har sendt ut påminnelse om dette etter sommerferien, forventes det at valg holdes, og hvis ikke SPR får tilbakemelding om valg, antas det at KTR fortsetter et år til.</div>\n<p>\n	 </p>\n', NULL, '2012-12-11');
INSERT INTO `article_text` (`id`, `articleId`, `content`, `phpFile`, `timestamp`) VALUES
(29, 80, '<h2>\n	<span class="mw-headline">Informasjon om lesesalen</span></h2>\n<h3>\n	<span class="mw-headline">IT-reglement for lesesalen til I &amp; IKT </span></h3>\n<ul><li>\n		Ikke la maskinen stå uten tilsyn, da en bærbar maskin er lett å ta med seg.</li>\n	<li>\n		Det trådløse nettverket får kun brukes til lettere oppgaver (lesing av e-post o.l.). Til tyngre oppgaver (installasjon av programvare o.l.) skal den faste nettverkstilkoblingen benyttes.</li>\n	<li>\n		Skriv ut minst mulig. Ikke skriv ut mer enn ca 200 sider pr. semester. Da belastes skriveren for hardt.</li>\n	<li>\n		Programvaren er kopibeskyttet. Det er ikke tillatt å gi den videre til personer utenfor studieprogrammet.</li>\n	<li>\n		Rydd pulten før du går.</li>\n</ul><p>\n	 </p>\n<h3>\n	<span class="mw-headline">Generelle regler for lesesalen </span></h3>\n<ul><li>\n		Husk at dette er en lesesal.</li>\n	<li>\n		Snakking holdes lavt og faglig relatert.</li>\n	<li>\n		Filmvisning og fyllasnakk holdes til kantiner og anna.</li>\n	<li>\n		I eksamensperioden skal det være STILLE!</li>\n</ul><p>\n	 </p>\n<h3>\n	<span class="mw-headline">Hva er adressen til programvaren? </span></h3>\n<p>\n	Adressen til programvaren er \\\\diger\\ikt$ Hvis du ikke sitter på NTNU sitt nett må du bruke adressen \\\\diger.ivt.ntnu.no\\ikt$ Hvis dette ikke virker, kan du prøve å velge different user name og skrive inn ditt brukernavn slik: win-ntnu-no\\brukernavn</p>\n<p>\n	 </p>\n<h3>\n	<span class="mw-headline">Hvordan kan jeg koble til M: og Q:? </span></h3>\n<ul><li>\n		Start Windows Explorer og velg Tools og Map Network Drive</li>\n	<li>\n		Velg riktig bokstav (M/Q)</li>\n	<li>\n		Skriv inn stien\n		<ul><li>\n				M: skal ha stien</li>\n			<li>\n				\\\\sambaad.stud.ntnu.no\\brukernavn</li>\n			<li>\n				Q: skal ha stien</li>\n			<li>\n				\\\\sambaad.stud.ntnu.no\\www</li>\n		</ul></li>\n	<li>\n		Velg å bruke et annet brukernavn</li>\n	<li>\n		Skriv inn ditt brukernavn slik: win-ntnu-no\\brukernavn</li>\n	<li>\n		Skriv inn passord og trykk OK</li>\n	<li>\n		Trykk Finish</li>\n</ul><h4>\n	<span class="mw-headline">Hvor finnes det mer papir til skriveren? </span></h4>\n<p>\n	<b>A4-156:</b> Morten Kvamme, Institutt for Produktdesign Hvis de går tom for toner, kontakt oss på ikt-drift@ivt.ntnu.no.</p>\n<p>\n	 </p>\n<h3>\n	<span class="mw-headline">Hvordan får jeg satt riktige rettigheter på filene i public_html katalogen (Q:)</span></h3>\n<ul><li>\n		Start F-secure SSH</li>\n	<li>\n		Hvis det er første gangen du starter programmet vi det be deg om å røre på muspekeren over et vindu tils fdet lukker seg.</li>\n	<li>\n		Trykk på mellomromstasten.</li>\n	<li>\n		Skriv inn login.stud.ntnu.no i feltet for Host name or IP address.</li>\n	<li>\n		Skriv inn ditt brukernavn i feltet for User Name og trykk connect.</li>\n	<li>\n		Du blir nå spurt om du vil lagre konfigurasjonen, klikk Yes.</li>\n	<li>\n		Skriv inn ditt passord og trykk OK.</li>\n	<li>\n		Skriv kommandoen: cd public_html og trykk Enter.</li>\n	<li>\n		Skriv kommandoen: chmod 644 * og trykk Enter</li>\n	<li>\n		Skriv kommandoen: ls -l og sjekk at det forran hver fil står slik:</li>\n</ul><pre>\n      -rw-r--r--\n</pre>\n<p>\n	Den siste r''en betyr at alle kan lese filen. Det er nå mulig å få tak i filene via Internett på adressen: www.stud.ntnu.no\\~brukernavn. Hvis du vil at alle fremtidige filer også skal få riktige rettigheter må du da du lagrer/kopierer dem velge Q: og ikke public_html under M:.</p>\n<p>\n	 </p>\n<h3>\n	<span class="mw-headline">Hvordan får jeg koblet til skriveren?</span></h3>\n<p>\n	IKTSTUD2 (Printeren på lesesalen)</p>\n<ul><li>\n		Gå til Start --&gt; Printers and Faxes</li>\n	<li>\n		Trykk Add a printer</li>\n	<li>\n		Trykk Next</li>\n	<li>\n		Merk A network printer...</li>\n	<li>\n		Trykk Next</li>\n	<li>\n		Merk Connect to this printer...</li>\n	<li>\n		Skriv inn \\\\printhost\\iktstud2</li>\n	<li>\n		Trykk Next</li>\n	<li>\n		Velg No</li>\n	<li>\n		Trykk Finish</li>\n</ul><p>\n	<br />\n	Nødløsning (hvis ingen annen metode virker):</p>\n<ul><li>\n		Gå til Start --&gt; Printers and Faxes</li>\n	<li>\n		Klikk Add Printer</li>\n	<li>\n		Trykk Next for å fortsette</li>\n	<li>\n		Merk ''Local printer attached to this computer''. Ta vekk avmerkingen for ''Automatically detect...''</li>\n	<li>\n		Merk ''Create a new port'' og velg Standard TCP/IP Port. Trykk Next</li>\n	<li>\n		Trykk Next</li>\n	<li>\n		Skriv inn: IP-nummeret (129.241.68.41 eller 129.241.91.33) og trykk Next</li>\n	<li>\n		Trykk Finish</li>\n	<li>\n		Trykk Back slik at du kommer tilbake til Select the Printer Port</li>\n	<li>\n		Velg porten IP_129.241.68.41 (eller IP_129.241.91.33) og trykk Next</li>\n	<li>\n		Velg HP under Manufacturers og HP LaserJet 4100 Series PS under Printers. Trykk Next</li>\n	<li>\n		Gi skriveren et navn som gjør at du husker hvilken skriver det er, f.eks. iktstud</li>\n	<li>\n		Velg om du vil ha den som standadrskriver eller ikke. Trykk Next</li>\n	<li>\n		La det stå som Do not share this printer og trykk Next</li>\n	<li>\n		Valg om du vil skrive ut en testside og trykk Next</li>\n	<li>\n		Trykk Finish</li>\n</ul><p>\n	 </p>\n<h3>\n	<span class="mw-headline">Hvem skal jeg kontakte hvis det er feil på maskinvare (harddisk, batteri og lignende) </span></h3>\n<p>\n	Informasjon kommer</p>\n<p>\n	 </p>\n<h3>\n	<span class="mw-headline">Hvordan kan jeg beskytte min skjerm under transport? </span></h3>\n<p>\n	Dette kan du gjøre ved å legge et A4 papir eller noe annet tynt og mykt mellom tastaturet før du legger maskinen i ryggsekken.</p>\n<p>\n	 </p>\n<h3>\n	<span class="mw-headline">Hvordan oppdaterer jeg Windows? </span></h3>\n<p>\n	Start Internet Explorer, gå til Tools på menyen, velg Windows Update. Svar ja, hvis den vil laste ned ny programvare. Trykk på "Søk etter oppdateringer". Legg til anbefalte oppdateringer og annet du vil ha under "Windows XP" og "Driveroppdateringer". Trykk "Se gjennom og installer oppdateringer". Trykk "Installer nå". Velg Godta på de spørsmål som kommer opp.</p>\n<p>\n	 </p>\n<h3>\n	<span class="mw-headline">Flere spørsmål om IT ?? </span></h3>\n<p>\n	Gå til:</p>\n<p>\n	<a class="external text" href="http://www.ivt.ntnu.no/itdrift/ikt/index.html" title="http://www.ivt.ntnu.no/itdrift/ikt/index.html">IKT-Drift</a></p>\n<p>\n	<a class="external text" href="http://www.ntnu.no/adm/it/brukerstotte" title="http://www.ntnu.no/adm/it/brukerstotte">Orakelkontoret</a></p>\n<p>\n	<a class="external text" href="http://infoweb.ntnu.no/" title="http://infoweb.ntnu.no/">InfoWeb</a></p>\n', NULL, '2012-12-11'),
(30, 81, '<p>\n	Testing testing</p>\n', NULL, '2013-01-29'),
(31, 82, '', NULL, '2013-01-29'),
(32, 83, '', NULL, '2013-01-29'),
(33, 82, '<p>\n	Det har ikke kommet noe program enda </p>\n', NULL, '2013-01-29');

--
-- Dumping data for table `bk_company`
--

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

--
-- Dumping data for table `bk_company_update`
--

--
-- Dumping data for table `bk_iktringen_information`
--


--
-- Dumping data for table `book_sales`
--

INSERT INTO `book_sales` (`id`, `title`, `content`, `price`, `status`, `author`, `imageID`, `timestamp`) VALUES
(5, 'Gult statistikkark', 'Det samme gule arket som jeg brukte under eksamen i Statistikk 2012', 5, 0, 381, 2, '2012-06-20 00:56:46');

--
-- Dumping data for table `comment`
--

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `start`, `end`, `location`, `status`) VALUES
(71, '2012-01-29 07:00:00', '2012-02-02 20:00:00', 'Åre', 0),
(73, '2011-11-25 18:15:00', '2011-11-26 13:00:00', 'Gløs', 0),
(82, '2012-03-08 00:00:00', '2012-06-07 00:00:00', 'Åre', 2),
(83, '2012-12-01 00:00:00', '2013-04-06 00:00:00', 'Kontoret', 0),
(85, '2012-02-25 20:00:54', '2012-02-26 02:00:00', 'Lyche', 0),
(89, '2012-03-21 14:00:00', '2012-03-21 19:00:00', '', 0),
(91, '2012-04-19 18:15:00', '2012-04-19 18:15:00', '', 0),
(92, '2012-04-17 00:00:00', '2012-04-18 00:00:00', 'Kontoret', 0),
(93, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'NTNU', 0),
(94, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'Sted', 0),
(95, '2012-04-24 06:35:00', '2012-04-01 19:30:00', 'Her!', 0),
(97, '2012-08-01 00:00:00', '2012-08-31 00:00:00', 'arst', 0),
(99, '2013-09-01 00:00:00', '2015-09-01 00:00:00', 'Lesesalen', 0),
(100, '2012-10-02 18:15:00', '2012-10-02 18:15:00', 'S4', 0),
(101, '2012-10-15 18:15:00', '2012-10-15 18:15:00', 'R2', 0),
(102, '2012-10-23 18:15:00', '2012-10-23 18:15:00', 'R2', 0),
(103, '2012-10-04 17:15:00', '2012-10-04 17:15:00', 'R2', 0),
(108, '2012-10-24 00:00:00', '2012-10-27 00:00:00', 'R61', 0),
(109, '2021-06-05 17:00:00', '2021-06-05 17:00:00', 'R7', 0),
(110, '2015-02-03 17:00:00', '2015-02-03 17:00:00', 'R7', 0);

--
-- Dumping data for table `event_company`
--

INSERT INTO `event_company` (`eventID`, `companyID`, `bpcID`) VALUES
(100, NULL, 411),
(101, NULL, 415),
(102, NULL, 416),
(103, NULL, 438),
(104, NULL, 120),
(105, NULL, 122),
(109, NULL, 98),
(110, NULL, 92);

--
-- Dumping data for table `event_company_old`
--


--
-- Dumping data for table `fb_user`
--

--
-- Dumping data for table `fieldtrip_support`
--

INSERT INTO `fieldtrip_support` (`id`, `bpcId`, `userId`) VALUES
(1, 98, 381);

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `parent_id`, `title`, `description`, `listorder`, `is_locked`) VALUES
(1, NULL, 'Hybrida', '', 1, 0);

--
-- Dumping data for table `forum_post`
--


--
-- Dumping data for table `forum_thread`
--


--
-- Dumping data for table `forum_user`
--


--
-- Dumping data for table `gallery`
--


--
-- Dumping data for table `griff`
--


--
-- Dumping data for table `griffgame_highscore`
--


--
-- Dumping data for table `group_membership`
--

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `menu`, `title`, `admin`, `committee`, `url`) VALUES
(55, 0, 'Webkom', 381, 'true', 'webkom'),
(56, 0, 'Styret', 363, 'false', 'styret'),
(57, 0, 'Hybrida Bedriftskomité', 293, 'true', 'bk'),
(58, 0, 'UpdateK', 381, 'false', 'updatek');

--
-- Dumping data for table `iktringen_membership`
--


--
-- Dumping data for table `image`
--


--
-- Dumping data for table `job_announcement`
--

--
-- Dumping data for table `kilt_comment`
--


--
-- Dumping data for table `kilt_order`
--


--
-- Dumping data for table `kilt_product`
--

INSERT INTO `kilt_product` (`id`, `type`, `model`, `image_id`, `link`) VALUES
(1, 'Kilt', 'Gutt', 'K_IRISHER.jpg', '1111/Kilt---Irisher-Sport-Kilt.html'),
(2, 'Kilt', 'Jente', '2009093012423778237_med.jpg', '4061/Irisher-Women%27s-Kilt.html'),
(3, 'Kilt', 'Jente Mini', '2009101514272187719_med.jpg', '4561/Irisher-Mini-Kilt.html'),
(4, 'Kilt', 'Jente Ultra Mini', '2009110513225539131_med.jpg', '5061/Irisher-Ultra-Mini-Kilt.html'),
(6, 'Sporran', 'Black Leather', '2009032717231692517_med.jpg', '1911/Black-Leather-Sporran.html'),
(7, 'Sporran', 'Thistle', '2009031615002744559_med.jpg', '2151/Thistle-Sporran.html'),
(8, 'Sporran', 'Black Rabbit', '2009032814104598125_med.jpg', '1921/Black-Rabbit-Sporran.html'),
(88, 'Sporran', 'Brown Embossed Leather', '2010102716562446500_med.jpg', '9635/Brown-Embossed-Leather-Sporran.html'),
(89, 'Sporran', 'Brown Saddle Leather', '2010102716592540116_med.jpg', '9636/Brown-Saddle-Leather-Sporran.html'),
(90, 'Sporran', 'Celtic Targe', '2009082012450734919_med.jpg', '8891/Celtic-Targe.html'),
(91, 'Sporran', 'Embossed Leather', '2009082013402527525_med.jpg', '7791/Embossed-Leather-Sporran.html'),
(92, 'Sporran', 'Gray Rabbit', '2009032814214886947_med.jpg', '1981/Gray-Rabbit-Sporran.html'),
(93, 'Sporran', 'Green Shamrock', '2009042115485662384_med.jpg', '7751/Green-Shamrock-Sporran.html'),
(94, 'Sporran', 'Scot Flag', '2009113015520130428_med.jpg', '7631/Scot-Flag-Sporran.html'),
(95, 'Sporran', 'Silver Shamrock', '2009042116113679463_lrg.jpg', '7761/Silver-Shamrock-Sporran.html'),
(96, 'Sporran', 'Silver Studded Dress', '2009032813342330180_lrg.jpg', '2121/Silver-Studded-Dress-Sporran.html'),
(97, 'Sporran', 'Studded Black', '2009032814030513419_lrg.jpg', '2141/Studded-Black-Leather.html'),
(98, 'Sporran', 'Studded White', '2009113015542623397_lrg.jpg', '9101/Studded-White-Thistle.html'),
(99, 'Sporran', 'White Rabbit', '2009032717301821464_lrg.jpg', '2191/White-Rabbit-Sporran.html'),
(100, 'Sporran', 'White Rabbit w/ Black Tassels', '2010081811431185197_lrg.jpg', '9532/White-Rabbit-Sporran-with-Black-Tas'),
(101, 'Ekstra', 'Sokker', '2011091315270667842_med.jpg', '721/Kilt-Hose---Regular.html'),
(102, 'Ekstra', 'Flashes', 'FL_SOL.jpg', '631/Flashes----Solid-Color.html'),
(103, 'Ekstra', 'Women''s Knee-Hi', '2009031615001048102_med.jpg', '1451/Women''s-Knee-Hi-Socks.html');

--
-- Dumping data for table `kilt_product_size`
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
(3, 4),
(4, 1),
(4, 2),
(4, 4),
(4, 5),
(3, 5),
(103, 2),
(103, 4),
(103, 5);

--
-- Dumping data for table `kilt_size`
--

INSERT INTO `kilt_size` (`id`, `size`) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Medium Long'),
(4, 'Large'),
(5, 'XLarge'),
(6, 'XXLarge');

--
-- Dumping data for table `kilt_time`
--


--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `parentId`, `parentType`, `title`, `imageId`, `ingress`, `content`, `authorId`, `weight`, `timestamp`, `status`) VALUES
(40, 71, 'event', 'Åretur 2012', NULL, 'Hybrider! Da har det duket for årets høydepunkt, vinterens villeste eventyr: Åretur!!!', '<p>\n	Som de siste tre årene vil turen være i uke 5, eller for alle oss andre som hater ukesystemet: <strong>29. jan - 2. feb 2012. </strong> I år har vi fått boplass i Åre fjellby, rett ved trekket og utesteder, altså helt ypperlig!<br /><br />\n	Turen kommer på <strong> ca 2000kr </strong> per pers og inkluderer:<br />\n	 </p>\n<ul><li>\n		Tur/retur Åre sentrum</li>\n	<li>\n		4 netters opphold</li>\n	<li>\n		5 dagers skipass</li>\n	<li>\n		rabattkort</li>\n	<li>\n		mye fest og moro!</li>\n</ul><br /><p>\n	Vi har <strong>47 plasser </strong>, så her er det førstemann til mølla som gjelder!<br /><br />\n	 OBS! OBS! Videre info vil de påmeldte få via mail. Som tiden for avgang, når vi er tilbake, hytteoversikt, hyttefordeling, betalingsinfo med nøyaktig pris osv. Og for de som ikke vet det, her snakker vi helt bindende påmelding. <br />\n	 </p>\n', 326, 0, '2011-07-17 22:34:51', 0),
(41, 73, 'event', 'Generalforsamling', NULL, 'Generalforsamling i Hybrida', '', 326, 0, '2011-11-10 21:14:21', 0),
(56, NULL, NULL, 'Nytt styre', NULL, 'Vil gratulere de nye styremedlemmene med valget', '<p>\n   <strong>Festivalus</strong> - Sigbjørn Aukland\n</p>\n<p>\n   <strong>Skattemester</strong> - Tonje Sundstrøm\n</p>\n<p>\n   <strong>Vevsjef</strong> - Sigurd Holsen\n</p>\n<p>\n   <strong>SPR</strong> - Erik Aasmundrud\n</p>', 363, 0, '2011-11-26 20:02:14', 0),
(364, 85, 'event', 'Halvingfest!', NULL, 'Tredje klasse feirer sin halvferdige universitetsutdannelse med en herlig middag på Lyche.', '<p>\n	Maten blir servert kl 20.00 (hver der ca en halvtime før) og de flotte tredjeklassingene dukker opp i relativt fin stas så koser vi oss!</p>\n<p>\n	Påmelding skjer her, husk at den er bindende. <u>Ved påmelding må du også sende en mail til halvingfest@gmail.com med menyen du ønsker.</u> Valg av hovedretter er:</p>\n<p>\n	<strong>Lycheburger </strong>Lyches ubestridte klassiker. Med aioli, pistou, bacon, cheddarost og paprikasalsa. Serveres med ovnsbakte mandelpoteter. kr 109.</p>\n<p>\n	<strong>Vegetarburger</strong> Lyches vegetarburger. Med aioli, pistou, cheddarost, salat og paprikasalsa. Serveres med ovnsbakte mandelpoteter.  kr 99</p>\n<p>\n	<strong>Confiterte andelår</strong> Langtidsstekt, sprøtt andelår. Serveres med ovnsbakte grønnsaker, pastinakkpuré, appelsinsaus og ovnsbakte mandelpoteter. kr 129</p>\n<p>\n	<strong>Ovnsbakt lakseloin</strong> Lakseloin med ovnsbakte grønnsaker og mandelpoteter, samt pastinakkpuré. Toppes med mandelvinaigrette. kr 129</p>\n<p>\n	<strong><em>Dessertvalg:</em></strong></p>\n<p>\n	<strong>Sjokoladelyche</strong><br />\n	Konfektkake av fyldig sjokolade, med pisket krem og bærsaus. kr 45</p>\n<p>\n	<strong>Panna cotta</strong><br />\n	Panna cotta med bærsaus. kr 35</p>\n<p>\n	 </p>\n<p>\n	Betaling skjer på Hybridas konto: 0539.26.44913 Prisen avhenger av hvilken rett du velger. Summer selv og overfør til konto merket med navn + halvingfest</p>\n<p>\n	 </p>\n', 367, 0, '2012-02-17 19:09:39', 0),
(366, 89, 'event', 'Komitefest!', NULL, 'Det arrangeres komitefest for hybrida kommitémedlemmer 15. mars på kjellerne.', '', 381, 0, '2012-02-28 13:23:04', 0),
(368, NULL, NULL, 'Den gamle siden', NULL, 'Den gamle siden vil ikke lenger bli vedlikeholdt, men finnes på <a href="http://www.hybrida.ntnu.no">http://www.hybrida.ntnu.no</a>', '<p>\n	 .</p>\n', 353, 0, '2012-04-25 23:17:43', 0),
(369, NULL, NULL, 'Lesesal-IRC', NULL, 'Kjeder du deg på lesesalen? Skulle du ønske at det var mulig å snakke med andre hybrider på lesesalen? Da er lesesal-IRC noe for deg!', '<p>\n	 </p>\n<p>\n	Etter noe nedetid er IRC-serveren opp å går igjen. Koble deg på med:</p>\n<p>\n	Server: irc.hybrida.no</p>\n<p>\n	Port: 6667</p>\n<p>\n	Kanal: #lesesalen</p>\n<p>\n	De som ikke har brukt IRC før kan ta en titt her: <a href="https://cbe002.chat.mibbit.com/">https://cbe002.chat.mibbit.com/</a> (velg tilkobling med server)</p>\n', 331, 0, '2012-05-02 12:09:02', 0),
(370, NULL, NULL, 'Reisebrev fra Asia', NULL, 'Her kommer Marius Røed sitt reisebrev fra Asia. Jeg fikk dette videresendt fra Update^K-redaktør, Eirik.', '<p>\n	Gå inn på <a href="/profil/mariuroe">bloggen til Marius</a> og se selv</p>\n', NULL, 0, '2012-05-04 14:00:07', 0),
(371, 91, 'event', '17. mai-tog', NULL, '17. mai-toget begynner klokken 13.00 utenfor Nidarosdomen. Oppmøte: 12.45.\n\nVi går uansett vær!', '<p>\n	Møt opp og bli med i 17. mai-tog!</p>\n', 370, 0, '2012-05-17 00:39:04', 0),
(373, NULL, NULL, 'Dette er bare en beta', NULL, 'Denne siden er bare en beta, gå til <a href="http://hybrida.no">hybrida.no</a> for å komme til hovedsiden', '', 381, 2147483647, '2025-07-05 07:18:12', 0),
(375, 97, 'event', 'Testevent', NULL, 'oaietno', '<p>\n	awtaw</p>\n', 381, 0, '2012-08-24 08:55:52', 0),
(377, 99, 'event', 'Evig event', NULL, 'Event som kun brukes til testing', '<p>\n	Denne hendelsen med påmelding er åpen frem til 2015. Veldig nyttig til testing</p>\n', 381, 0, '2012-09-11 13:39:55', 0),
(382, NULL, NULL, 'Trenger ikke nytt passord likevel', NULL, '<p>\nNTNU har nettopp gått tilbake på deres beslutning om å stenge ned den gamle innloggingstjenesten, så det er ikke lenger noe akutt behov for å legge inn nytt passord.\n\nDe har gitt beskjed om at de kommer til å  videreføre den nåværende tjenesten intil videre, så da kommer vi til å benytte den.\n</p>\n\n<p>\nBeklager alt maset.\n</p>', '<p>\n	Hvis det skulle være at NTNU etter en tid velger å avslutte innloggingstjenesten, som opprinnelig var planen, kan det hende vi kommer til å gå over til å bruke eget hybrida-passord, slik som er praksis hos en del andre linjeforeninger, men det er altså ikke vits i å styre med dette lenger nå.</p>\n<p>\n	Vi kommer ikke til å slette de nye passordene på grunn av dette.</p>\n<p>\n	Om NTNU gjør en ny beslutning vil vi gi beskjed om dette i god tid.</p>\n', 381, 0, '2012-09-28 00:30:22', 0),
(386, NULL, NULL, 'Lipsum', NULL, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pretium fermentum augue, eget fermentum neque venenatis et. Donec mollis tristique sagittis. Fusce quis sapien non felis aliquet suscipit. In id odio nisi, non sodales ipsum. Duis at est nunc, ut tincidunt nunc. Duis quis orci lectus. Fusce lobortis, diam dapibus condimentum lobortis, leo orci blandit dolor, quis suscipit massa mi nec ligula. Nunc ligula tellus, ultrices a vehicula sed, pretium quis velit. Pellentesque tellus odio, consectetur dapibus sodales ac, luctus nec enim.', '<p>\n	Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pulvinar ipsum in odio accumsan sit amet tincidunt mauris posuere. Aliquam mollis luctus risus eget posuere. Donec eleifend purus id arcu consectetur eget tempor felis euismod. Nam tempus gravida justo, sit amet imperdiet libero tristique nec. Donec varius eleifend fermentum. Aenean sit amet sapien diam. Sed dolor orci, pharetra vel volutpat non, ornare nec orci.</p>\n<p>\n	Duis eget arcu sed quam cursus placerat a non leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla facilisi. Mauris eget orci vitae ante imperdiet rhoncus. Integer id nisi magna. Donec sagittis ornare dolor. Morbi id purus non felis adipiscing molestie.</p>\n<p>\n	Phasellus nec leo elit. Praesent lectus metus, rhoncus euismod gravida eu, venenatis a sapien. Praesent at lectus ipsum. Curabitur tempor odio sit amet dui fringilla imperdiet. Vestibulum vehicula eleifend elit eget consequat. Phasellus hendrerit velit eget dolor convallis eu tincidunt lorem tristique. Etiam odio dui, rutrum id molestie ut, egestas vitae velit.</p>\n<p>\n	Proin nisl dolor, imperdiet non eleifend eget, euismod vel sem. Nulla at nibh eget quam gravida convallis in nec dolor. Nullam odio magna, ullamcorper ac tempor sed, dignissim at mi. In bibendum mauris vitae massa tempus ac auctor neque varius. Aenean tincidunt dolor euismod nisi molestie quis placerat mi placerat. Mauris libero dolor, mollis in consectetur nec, fringilla et arcu. Sed scelerisque sodales augue et placerat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut lobortis laoreet tortor nec venenatis. Fusce lobortis pharetra libero, ut accumsan urna venenatis eu. Mauris non nisi magna. Vivamus condimentum feugiat congue. Suspendisse bibendum molestie augue non molestie.</p>\n', 381, 0, '2012-09-27 17:05:35', 0),
(387, 108, 'event', 'Møte', NULL, '', '<p>\n	For webkom</p>\n', 380, 0, '2012-10-23 19:42:05', 0),
(388, 109, 'event', 'Bedpres: Iterate', NULL, 'Hei hei', '<p>Hei hei</p>\n', NULL, 0, '2013-02-01 13:35:17', 0),
(389, 110, 'event', 'Bedpres: Geomatikk IKT', NULL, 'In eleifend nisl vel libero lacinia in ultricies felis sagittis. Sed eu urna tristique metus dapibus elementum. Nunc sed sem id nulla feugiat fermentum. In hendrerit sollicitudin lorem pellentesque egestas. Sed lobortis felis sed nibh pellentesque id consectetur est facilisis. Duis non sapien a orci faucibus sodales non at purus. Phasellus rutrum ultricies fermentum. Phasellus in diam et nisl sollicitudin vulputate ut et mi. Aenean ultrices lobortis tincidunt. Aenean rhoncus, arcu id feugiat semper, quam felis consequat augue, nec condimentum mi turpis sit amet purus. Ut molestie sapien nec er...', '<p>In eleifend nisl vel libero lacinia in ultricies felis sagittis. Sed eu urna tristique metus dapibus elementum. Nunc sed sem id nulla feugiat fermentum. In hendrerit sollicitudin lorem pellentesque egestas. Sed lobortis felis sed nibh pellentesque id consectetur est facilisis. Duis non sapien a orci faucibus sodales non at purus. Phasellus rutrum ultricies fermentum. Phasellus in diam et nisl sollicitudin vulputate ut et mi. Aenean ultrices lobortis tincidunt. Aenean rhoncus, arcu id feugiat semper, quam felis consequat augue, nec condimentum mi turpis sit amet purus. Ut molestie sapien nec eros volutpat et porta nisi mollis.</p>\n', NULL, 0, '2013-02-01 13:35:17', 0),
(632, NULL, NULL, 'GryphusRegnatorImmortalis the game', NULL, 'Prøv det <a style="font-size:100px;" href="/game/griff">her</a>', '<p>\n	Tomt</p>\n', 381, 100, '2013-02-20 14:02:49', 0);

--
-- Dumping data for table `news_group`
--

INSERT INTO `news_group` (`newsId`, `groupId`) VALUES
(3, 56),
(38, 55);

--
-- Dumping data for table `notification`
--


--
-- Dumping data for table `notification_listener`
--

INSERT INTO `notification_listener` (`id`, `userID`, `parentType`, `parentID`, `isDeleted`) VALUES
(32, 381, 'profile', 381, 0),
(33, 381, 'news', 370, 0),
(34, 381, 'news', 386, 0);

--
-- Dumping data for table `quiz_event`
--


--
-- Dumping data for table `quiz_team`
--


--
-- Dumping data for table `quiz_team_member`
--


--
-- Dumping data for table `quiz_team_score`
--


--
-- Dumping data for table `rbac_assignment`
--

--
-- Dumping data for table `rbac_item`
--

INSERT INTO `rbac_item` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, 'Administrator', '', 's:0:"";'),
('all', 2, 'Alle studenter har denne access som standard', NULL, NULL),
('bk', 1, NULL, 'return Yii::app()->gatekeeper->hasGroupAccess(57);', NULL),
('createArticle', 0, 'Poste artikkel', '', 's:0:"";'),
('createNews', 0, 'Poste nyhet', '', 's:0:"";'),
('deleteComment', 2, NULL, NULL, NULL),
('deleteOwnComment', 1, NULL, 'return user()->id == $params["authorId"];', NULL),
('editor', 2, 'Kan redigere, men ikke lage noe nytt', '', 's:0:"";'),
('styret', 2, 'Medlemmer av styret', 'return Yii::app()->gatekeeper->hasGroupAccess(56);', NULL),
('updateArticle', 0, '', '', 's:0:"";'),
('updateBedpres', 2, NULL, NULL, NULL),
('updateGroup', 0, '', '', NULL),
('updateNews', 0, 'oppdatere nyhet', '', 's:0:"";'),
('updateOwn', 1, NULL, NULL, NULL),
('updateOwnArticle', 1, '', 'return isset($params["id"]) && Article::model()->findByPk($params["id"])->author == user()->id;', 's:0:"";'),
('updateOwnGroup', 1, '', 'return isset($params["id"]) && Groups::model()->findByPk($params["id"])->admin == user()->id;', NULL),
('updateOwnNews', 1, '', 'return isset($params["id"]) && News::model()->findByPk($params["id"])->authorId == user()->id;', 's:0:"";'),
('updateOwnProfile', 1, '', 'return isset($params[''username'']) && isset(user()->name) && $params[''username''] == user()->name;\r\n', 's:0:"";'),
('updateProfile', 0, '', '', 's:0:"";'),
('webkom', 2, 'Medlemmer av webkom', 'return Yii::app()->gatekeeper->hasGroupAccess(55);', NULL),
('writer', 2, 'Kan publisere', '', 's:0:"";');

--
-- Dumping data for table `rbac_itemchild`
--

INSERT INTO `rbac_itemchild` (`parent`, `child`) VALUES
('webkom', 'admin'),
('all', 'bk'),
('writer', 'createArticle'),
('writer', 'createNews'),
('deleteOwnComment', 'deleteComment'),
('all', 'deleteOwnComment'),
('admin', 'editor'),
('styret', 'editor'),
('all', 'styret'),
('editor', 'updateArticle'),
('updateOwnArticle', 'updateArticle'),
('admin', 'updateBedpres'),
('bk', 'updateBedpres'),
('admin', 'updateGroup'),
('bk', 'updateNews'),
('editor', 'updateNews'),
('updateOwnNews', 'updateNews'),
('all', 'updateOwn'),
('updateOwn', 'updateOwnArticle'),
('writer', 'updateOwnArticle'),
('updateOwn', 'updateOwnGroup'),
('updateOwn', 'updateOwnNews'),
('writer', 'updateOwnNews'),
('updateOwn', 'updateOwnProfile'),
('admin', 'updateProfile'),
('updateOwnProfile', 'updateProfile'),
('all', 'webkom'),
('admin', 'writer'),
('styret', 'writer'),
('webkom', 'writer');

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
(94, 100, '2012-04-01 00:00:00', '2012-04-30 00:00:00', 'false', 0),
(97, 1, '2012-08-01 00:00:00', '2012-08-31 00:00:00', 'false', 0),
(98, 1, '2012-08-27 11:00:00', '2012-09-17 11:00:00', 'false', 2),
(99, 10000, '2012-09-01 00:00:00', '2015-09-01 00:00:00', 'true', 0),
(100, 30, '2012-09-24 11:00:00', '2012-10-01 11:00:00', 'false', 2),
(101, 1, '2012-08-31 11:00:00', '2012-10-15 11:00:00', 'false', 2),
(102, 1, '2012-08-31 11:00:00', '2012-10-23 11:00:00', 'false', 2),
(103, 50, '2012-09-27 15:00:00', '2012-10-04 11:00:00', 'false', 2),
(107, 50, '2011-12-02 17:00:00', '2012-05-06 17:00:00', 'false', 2),
(108, 500, '2012-10-15 00:00:00', '2012-10-31 00:00:00', 'true', 0),
(109, 110, '2012-02-01 15:00:00', '2016-11-04 17:00:00', 'false', 2),
(110, 50, '2011-12-02 17:00:00', '2012-05-06 17:00:00', 'false', 2);

--
-- Dumping data for table `signup_membership`
--

--
-- Dumping data for table `signup_membership_anonymous`
--


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

--
-- Dumping data for table `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1355256725),
('m121209_184746_move_from_article_content_to_article_text', 1355256727);

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `middleName`, `lastName`, `specializationId`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `linkedin`, `lastLogin`, `cardHash`, `description`, `workDescription`, `workCompanyID`, `workPlace`, `birthdate`, `altEmail`) VALUES
(381, 'sigurhol', 'Sigurd', 'Andreas', 'Holsen', 2, 2015, 'true', 'male', NULL, 12345678, 'pub/sigurd-holsen/4b/636/582/', '2013-08-29 16:14:40', '276d89c72e366f3e72ce695fd7c9593f67ef3b76', '<h1 style="text-align:left;">\n	Hei eksamensbloggen min!</h1>\n<p style="text-align:left;">\n	Denne dagen har vært syyykt lang..har ikke gjort en dritt egentlig,men dagen har bare gått sykt sakte.. kjedelig! Så tenkte jeg! Blogg, det må jeg få meg. For det er jo bare så syykt kult lissom. Har prøvd og prøvd og prøvd sånn der blogg.no, men det funker ikke. MEN, så tenkte jeg! Jeg kan jo gjøre som mitt store forbilde SIGGE. For han er jo bare SÅ KUUUL! Å bruke denne hybsiden, jeg har laget til å BLOGGE på!</p>\n<p style="text-align:left;">\n	Forresten, hils på pusen min layla, det er min femine side og vi deler alt sammen lissom.</p>\n<p>\n	<img alt="cat.jpg" src="http://dl.dropbox.com/u/13200640/cat.jpg" width="400" /><br />\n	Meg og layla koser oss!</p>\n<p style="text-align:left;">\n	Jeg hadde et sånt påskeforsett og har begynt å trene syykt mye nå.. Og blitt kjempe sterk lissom!</p>\n<p>\n	<img alt="Jeg er digg" src="http://dl.dropbox.com/u/13200640/muscles.jpg" /><br />\n	Jeg som har trent</p>\n<p style="text-align:left;">\n	Etter jeg hadde tatt, sånn vanvittig mye i benk idag lissom, dro jeg hjem og spise 3 store kyllinger! Jeg ble helt latterlig mett, og gikk sikkert opp sånn 20 kilo på vekten lissom. Men det var veldig grisete, så jeg måtte vaske meg og layla også. Heldigvis har vi et sånn stort badekar, som jeg plutselig fikk av en gjeng ungdommer ved nidelven i høst, så det gikk fint!</p>\n<p style="text-align:left;">\n	Men jeg har ett stort problem da folkens! Har blitt så sykt hekta på Sigge sine pannekaker!! De er syykkt gode... Helt sant!! Så spiser det til frokost og kvelds HVER dag! Magen min den bare vokser og vokser og vokser og vokser.. Ser snart ut som en bjørn!</p>\n<p style="text-align:left;">\n	Men folkens! Jeg har ett stort mål! Å bli sånn som mitt store idol SIGGE :D:D Kanskje derfor jeg spiser så veldig mye... Jeg vil også bli så stor og så sterk og stor.. Men, men.. Nå kom layla og satt seg i fanget mitt, nyvasket og myk og da blir jeg så ukonsentrert. Så chill''an .. Så prates vi på trening lissom <img alt="blank.gif" class="emote_img" src="https://s-static.ak.facebook.com/images/blank.gif" style="border-top-width:0px;border-right-width:0px;border-bottom-width:0px;border-left-width:0px;height:16px;vertical-align:top;width:16px;background-image:url(&quot;https://s-static.ak.fbcdn.net/rsrc.php/v1/yM/r/WlL6q4xDPOA.png&quot;);margin-bottom:-2px;color:rgb(51,51,51);font-family:''lucida grande'', tahoma, verdana, arial, sans-serif;font-size:11px;line-height:14px;background-position:-80px 0px;" title=";)" /></p>\n', '<br />', NULL, '', '1990-12-23', 'sighol@gmail.com'),
(466, 'admin', 'ad', 'm', 'in', NULL, 2000, 'true', 'unknown', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL);

--
-- Dumping data for table `user_password`
--

INSERT INTO `user_password` (`userId`, `password`, `expired`) VALUES
(293, '3a6ecb8517060495cfaa4585d617b3ee6cdefa88', 0);

SET FOREIGN_KEY_CHECKS=1;
