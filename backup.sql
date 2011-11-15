-- phpMyAdmin SQL Dump
-- version 2.11.8.1deb5+lenny9
-- http://www.phpmyadmin.net
--
-- Vert: localhost
-- Generert den: 15. Nov, 2011 klokka 15:57 PM
-- Tjenerversjon: 5.0.51
-- PHP-Versjon: 5.2.6-1+lenny13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hybrida`
--
DROP DATABASE `hybrida`;
CREATE DATABASE `hybrida` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `hybrida`;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `access_definition`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `access_definition`;
CREATE TABLE `access_definition` (
  `id` int(11) NOT NULL auto_increment,
  `description` varchar(20) collate utf8_unicode_ci NOT NULL default 'none',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `description` (`description`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=109 ;

--
-- Dataark for tabell `access_definition`
--

INSERT INTO `access_definition` (`id`, `description`) VALUES
(1, 'all'),
(2, 'logged_in'),
(3, 'member'),
(4, 'genderMale'),
(5, 'genderFemale'),
(6, '1.Klasse'),
(108, 'UpdateK'),
(105, 'Webkom'),
(106, 'Styret'),
(107, 'Bedriftskomit');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `access_relations`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `access_relations`;
CREATE TABLE `access_relations` (
  `id` int(11) NOT NULL,
  `access` int(11) NOT NULL,
  `type` enum('album','article','comment','event','group','image','news','poll','signup','site','slide','slideshow','user_info','vote') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`,`type`,`access`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `access_relations`
--

INSERT INTO `access_relations` (`id`, `access`, `type`) VALUES
(0, 1, 'comment'),
(0, 0, 'site'),
(0, 1, 'site'),
(0, 2, 'site'),
(1, 1, 'comment'),
(1, 0, 'group'),
(1, 1, 'group'),
(1, 1, 'image'),
(1, 2, 'news'),
(1, 6, 'news'),
(1, 8, 'site'),
(2, 1, 'comment'),
(2, 1, 'news'),
(3, 1, 'comment'),
(3, 4, 'news'),
(3, 1, 'site'),
(4, 1, 'comment'),
(4, 1, 'image'),
(4, 2, 'image'),
(4, 2, 'news'),
(5, 1, 'comment'),
(5, 1, 'event'),
(5, 1, 'image'),
(5, 4, 'news'),
(6, 1, 'comment'),
(6, 1, 'event'),
(6, 4, 'news'),
(7, 1, 'comment'),
(7, 1, 'news'),
(7, 2, 'news'),
(7, 5, 'news'),
(8, 1, 'comment'),
(8, 1, 'event'),
(8, 1, 'news'),
(8, 3, 'signup'),
(9, 1, 'comment'),
(9, 1, 'event'),
(9, 1, 'news'),
(9, 1, 'signup'),
(10, 1, 'comment'),
(10, 1, 'event'),
(10, 1, 'news'),
(10, 1, 'signup'),
(11, 1, 'comment'),
(11, 1, 'event'),
(11, 1, 'news'),
(11, 1, 'signup'),
(12, 1, 'comment'),
(12, 1, 'event'),
(12, 3, 'news'),
(13, 1, 'comment'),
(13, 1, 'event'),
(13, 1, 'news'),
(14, 1, 'comment'),
(14, 2, 'event'),
(14, 4, 'news'),
(14, 5, 'signup'),
(15, 1, 'comment'),
(15, 1, 'event'),
(15, 1, 'news'),
(15, 1, 'signup'),
(16, 1, 'comment'),
(16, 1, 'event'),
(16, 1, 'news'),
(16, 1, 'signup'),
(17, 1, 'comment'),
(17, 1, 'event'),
(17, 1, 'news'),
(17, 1, 'signup'),
(18, 1, 'album'),
(18, 1, 'comment'),
(18, 2, 'event'),
(18, 1, 'news'),
(18, 4, 'signup'),
(19, 1, 'album'),
(19, 1, 'comment'),
(19, 1, 'event'),
(19, 1, 'news'),
(20, 1, 'comment'),
(20, 1, 'event'),
(20, 1, 'news'),
(20, 1, 'signup'),
(21, 1, 'comment'),
(21, 1, 'event'),
(21, 5, 'news'),
(22, 1, 'comment'),
(22, 2, 'event'),
(22, 1, 'news'),
(22, 1, 'signup'),
(23, 1, 'comment'),
(23, 4, 'event'),
(23, 0, 'news'),
(23, 6, 'signup'),
(24, 1, 'comment'),
(24, 2, 'event'),
(24, 0, 'news'),
(24, 6, 'signup'),
(25, 1, 'comment'),
(25, 1, 'event'),
(25, 1, 'news'),
(25, 1, 'signup'),
(26, 1, 'comment'),
(26, 1, 'event'),
(26, 1, 'news'),
(26, 1, 'signup'),
(27, 1, 'comment'),
(27, 1, 'event'),
(27, 2, 'news'),
(27, 1, 'signup'),
(28, 1, 'comment'),
(28, 1, 'event'),
(28, 1, 'signup'),
(29, 1, 'comment'),
(29, 1, 'event'),
(29, 1, 'signup'),
(30, 1, 'comment'),
(30, 1, 'event'),
(30, 1, 'news'),
(30, 1, 'signup'),
(31, 1, 'comment'),
(31, 1, 'event'),
(31, 1, 'news'),
(31, 1, 'signup'),
(32, 1, 'comment'),
(32, 2, 'comment'),
(32, 41, 'comment'),
(32, 1, 'event'),
(32, 1, 'news'),
(32, 1, 'signup'),
(33, 1, 'event'),
(33, 0, 'news'),
(33, 1, 'news'),
(33, 2, 'news'),
(33, 3, 'news'),
(33, 4, 'news'),
(33, 5, 'news'),
(33, 6, 'news'),
(33, 7, 'news'),
(33, 8, 'news'),
(33, 9, 'news'),
(33, 10, 'news'),
(33, 1, 'signup'),
(34, 1, 'event'),
(34, 0, 'news'),
(34, 1, 'news'),
(34, 2, 'news'),
(34, 3, 'news'),
(34, 4, 'news'),
(34, 5, 'news'),
(34, 6, 'news'),
(34, 7, 'news'),
(34, 8, 'news'),
(34, 9, 'news'),
(34, 10, 'news'),
(34, 1, 'signup'),
(35, 1, 'event'),
(35, 1, 'news'),
(35, 3, 'news'),
(35, 5, 'news'),
(35, 6, 'news'),
(35, 1, 'signup'),
(36, 1, 'event'),
(36, 2, 'news'),
(36, 1, 'signup'),
(37, 1, 'event'),
(37, 1, 'news'),
(37, 2, 'news'),
(37, 3, 'news'),
(37, 6, 'news'),
(37, 35, 'news'),
(37, 36, 'news'),
(37, 37, 'news'),
(37, 38, 'news'),
(37, 39, 'news'),
(37, 40, 'news'),
(37, 41, 'news'),
(37, 1, 'signup'),
(38, 1, 'event'),
(38, 1, 'news'),
(38, 2, 'news'),
(38, 3, 'news'),
(38, 4, 'news'),
(38, 5, 'news'),
(38, 6, 'news'),
(38, 42, 'news'),
(38, 43, 'news'),
(38, 1, 'signup'),
(39, 3, 'event'),
(39, 1, 'news'),
(39, 2, 'news'),
(39, 3, 'news'),
(39, 4, 'news'),
(39, 5, 'news'),
(39, 6, 'news'),
(39, 42, 'news'),
(39, 43, 'news'),
(40, 4, 'event'),
(40, 1, 'news'),
(40, 2, 'news'),
(40, 3, 'news'),
(40, 4, 'news'),
(41, 4, 'event'),
(41, 1, 'news'),
(42, 2, 'event'),
(43, 1, 'event'),
(44, 5, 'event'),
(45, 1, 'event'),
(46, 1, 'event'),
(47, 1, 'event'),
(48, 1, 'event'),
(49, 1, 'event'),
(50, 2, 'event'),
(50, 4, 'signup'),
(51, 6, 'event'),
(51, 1, 'signup'),
(51, 3, 'signup'),
(52, 1, 'event'),
(53, 1, 'event'),
(54, 1, 'event'),
(54, 1, 'signup'),
(55, 1, 'event'),
(56, 1, 'event'),
(57, 1, 'event'),
(58, 1, 'event'),
(59, 2, 'event'),
(59, 5, 'signup'),
(60, 2, 'event'),
(60, 5, 'signup'),
(61, 1, 'event'),
(62, 1, 'event'),
(63, 1, 'event'),
(64, 1, 'event'),
(65, 1, 'event'),
(66, 1, 'event'),
(67, 1, 'event'),
(68, 1, 'event'),
(68, 1, 'signup'),
(69, 3, 'event'),
(69, 5, 'event'),
(70, 1, 'event'),
(70, 1, 'signup'),
(71, 1, 'event'),
(71, 1, 'signup'),
(71, 2, 'signup'),
(71, 3, 'signup'),
(71, 4, 'signup'),
(71, 5, 'signup'),
(71, 6, 'signup'),
(71, 43, 'signup'),
(72, 1, 'event'),
(267, 1, 'site'),
(267, 2, 'site'),
(267, 60, 'site'),
(268, 1, 'site'),
(268, 2, 'site'),
(268, 60, 'site'),
(269, 1, 'site'),
(269, 2, 'site'),
(269, 60, 'site'),
(270, 1, 'site'),
(270, 2, 'site'),
(270, 60, 'site'),
(271, 1, 'site'),
(271, 2, 'site'),
(271, 61, 'site'),
(272, 1, 'site'),
(272, 2, 'site'),
(272, 61, 'site'),
(273, 1, 'site'),
(273, 2, 'site'),
(273, 61, 'site'),
(274, 1, 'site'),
(274, 2, 'site'),
(274, 61, 'site'),
(275, 1, 'site'),
(275, 2, 'site'),
(275, 62, 'site'),
(276, 1, 'site'),
(276, 2, 'site'),
(276, 62, 'site'),
(277, 1, 'site'),
(277, 2, 'site'),
(277, 62, 'site'),
(278, 1, 'site'),
(278, 2, 'site'),
(278, 62, 'site'),
(279, 1, 'site'),
(279, 2, 'site'),
(279, 63, 'site'),
(280, 1, 'site'),
(280, 2, 'site'),
(280, 63, 'site'),
(281, 1, 'site'),
(281, 2, 'site'),
(281, 63, 'site'),
(282, 1, 'site'),
(282, 2, 'site'),
(282, 63, 'site'),
(283, 1, 'site'),
(283, 2, 'site'),
(283, 64, 'site'),
(284, 1, 'site'),
(284, 2, 'site'),
(284, 64, 'site'),
(285, 1, 'site'),
(285, 2, 'site'),
(285, 64, 'site'),
(286, 1, 'site'),
(286, 2, 'site'),
(286, 64, 'site'),
(287, 1, 'site'),
(287, 2, 'site'),
(287, 65, 'site'),
(288, 1, 'site'),
(288, 2, 'site'),
(288, 65, 'site'),
(289, 1, 'site'),
(289, 2, 'site'),
(289, 65, 'site'),
(290, 1, 'site'),
(290, 2, 'site'),
(290, 65, 'site'),
(291, 1, 'site'),
(291, 2, 'site'),
(291, 66, 'site'),
(292, 1, 'site'),
(292, 2, 'site'),
(292, 66, 'site'),
(293, 1, 'site'),
(293, 2, 'site'),
(293, 66, 'site'),
(294, 1, 'site'),
(294, 2, 'site'),
(294, 66, 'site'),
(295, 1, 'site'),
(295, 2, 'site'),
(295, 67, 'site'),
(296, 1, 'site'),
(296, 2, 'site'),
(296, 67, 'site'),
(297, 1, 'site'),
(297, 2, 'site'),
(297, 67, 'site'),
(298, 1, 'site'),
(298, 2, 'site'),
(298, 67, 'site'),
(299, 1, 'site'),
(299, 2, 'site'),
(299, 68, 'site'),
(300, 1, 'site'),
(300, 2, 'site'),
(300, 68, 'site'),
(301, 1, 'site'),
(301, 2, 'site'),
(301, 68, 'site'),
(302, 1, 'site'),
(302, 2, 'site'),
(302, 68, 'site'),
(303, 1, 'site'),
(303, 2, 'site'),
(303, 69, 'site'),
(304, 1, 'site'),
(304, 2, 'site'),
(304, 69, 'site'),
(305, 1, 'site'),
(305, 2, 'site'),
(305, 69, 'site'),
(306, 1, 'site'),
(306, 2, 'site'),
(306, 69, 'site'),
(307, 1, 'site'),
(307, 2, 'site'),
(307, 70, 'site'),
(308, 1, 'site'),
(308, 2, 'site'),
(308, 70, 'site'),
(309, 1, 'site'),
(309, 2, 'site'),
(309, 70, 'site'),
(310, 1, 'site'),
(310, 2, 'site'),
(310, 70, 'site'),
(311, 1, 'site'),
(311, 2, 'site'),
(311, 71, 'site'),
(312, 1, 'site'),
(312, 2, 'site'),
(312, 71, 'site'),
(313, 1, 'site'),
(313, 2, 'site'),
(313, 71, 'site'),
(314, 1, 'site'),
(314, 2, 'site'),
(314, 71, 'site'),
(315, 1, 'site'),
(315, 2, 'site'),
(315, 72, 'site'),
(316, 1, 'site'),
(316, 2, 'site'),
(316, 72, 'site'),
(317, 1, 'site'),
(317, 2, 'site'),
(317, 72, 'site'),
(318, 1, 'site'),
(318, 2, 'site'),
(318, 72, 'site'),
(319, 1, 'site'),
(319, 2, 'site'),
(319, 73, 'site'),
(320, 1, 'site'),
(320, 2, 'site'),
(320, 73, 'site'),
(321, 1, 'site'),
(321, 2, 'site'),
(321, 73, 'site'),
(322, 1, 'site'),
(322, 2, 'site'),
(322, 73, 'site'),
(323, 1, 'site'),
(323, 2, 'site'),
(323, 74, 'site'),
(324, 1, 'site'),
(324, 2, 'site'),
(324, 74, 'site'),
(325, 1, 'site'),
(325, 2, 'site'),
(325, 74, 'site'),
(326, 1, 'site'),
(326, 2, 'site'),
(326, 74, 'site'),
(327, 1, 'site'),
(327, 2, 'site'),
(327, 75, 'site'),
(328, 1, 'site'),
(328, 2, 'site'),
(328, 75, 'site'),
(329, 1, 'site'),
(329, 2, 'site'),
(329, 75, 'site'),
(330, 1, 'site'),
(330, 2, 'site'),
(330, 75, 'site'),
(331, 1, 'site'),
(331, 2, 'site'),
(331, 76, 'site'),
(332, 1, 'site'),
(332, 2, 'site'),
(332, 76, 'site'),
(333, 1, 'site'),
(333, 2, 'site'),
(333, 76, 'site'),
(334, 1, 'site'),
(334, 2, 'site'),
(334, 76, 'site'),
(335, 1, 'site'),
(335, 2, 'site'),
(335, 77, 'site'),
(336, 1, 'site'),
(336, 2, 'site'),
(336, 77, 'site'),
(337, 1, 'site'),
(337, 2, 'site'),
(337, 77, 'site'),
(338, 1, 'site'),
(338, 2, 'site'),
(338, 77, 'site'),
(339, 1, 'site'),
(339, 2, 'site'),
(339, 78, 'site'),
(340, 1, 'site'),
(340, 2, 'site'),
(340, 78, 'site'),
(341, 1, 'site'),
(341, 2, 'site'),
(341, 78, 'site'),
(342, 1, 'site'),
(342, 2, 'site'),
(342, 78, 'site'),
(343, 1, 'site'),
(343, 2, 'site'),
(343, 79, 'site'),
(344, 1, 'site'),
(344, 2, 'site'),
(344, 79, 'site'),
(345, 1, 'site'),
(345, 2, 'site'),
(345, 79, 'site'),
(346, 1, 'site'),
(346, 2, 'site'),
(346, 79, 'site'),
(347, 1, 'site'),
(347, 2, 'site'),
(347, 80, 'site'),
(348, 1, 'site'),
(348, 2, 'site'),
(348, 80, 'site'),
(349, 1, 'site'),
(349, 2, 'site'),
(349, 80, 'site'),
(350, 1, 'site'),
(350, 2, 'site'),
(350, 80, 'site'),
(351, 1, 'site'),
(351, 2, 'site'),
(351, 81, 'site'),
(352, 1, 'site'),
(352, 2, 'site'),
(352, 81, 'site'),
(353, 1, 'site'),
(353, 2, 'site'),
(353, 81, 'site'),
(354, 1, 'site'),
(354, 2, 'site'),
(354, 81, 'site'),
(355, 1, 'site'),
(355, 2, 'site'),
(355, 82, 'site'),
(356, 1, 'site'),
(356, 2, 'site'),
(356, 82, 'site'),
(357, 1, 'site'),
(357, 2, 'site'),
(357, 82, 'site'),
(358, 1, 'site'),
(358, 2, 'site'),
(358, 82, 'site'),
(359, 1, 'site'),
(359, 2, 'site'),
(359, 83, 'site'),
(360, 1, 'site'),
(360, 2, 'site'),
(360, 83, 'site'),
(361, 1, 'site'),
(361, 2, 'site'),
(361, 83, 'site'),
(362, 1, 'site'),
(362, 2, 'site'),
(362, 83, 'site'),
(363, 1, 'site'),
(363, 2, 'site'),
(363, 84, 'site'),
(364, 1, 'site'),
(364, 2, 'site'),
(364, 84, 'site'),
(365, 1, 'site'),
(365, 2, 'site'),
(365, 84, 'site'),
(366, 1, 'site'),
(366, 2, 'site'),
(366, 84, 'site'),
(367, 1, 'site'),
(367, 2, 'site'),
(367, 85, 'site'),
(368, 1, 'site'),
(368, 2, 'site'),
(368, 85, 'site'),
(369, 1, 'site'),
(369, 2, 'site'),
(369, 85, 'site'),
(370, 1, 'site'),
(370, 2, 'site'),
(370, 85, 'site'),
(371, 1, 'site'),
(371, 2, 'site'),
(371, 86, 'site'),
(372, 1, 'site'),
(372, 2, 'site'),
(372, 86, 'site'),
(373, 1, 'site'),
(373, 2, 'site'),
(373, 86, 'site'),
(374, 1, 'site'),
(374, 2, 'site'),
(374, 86, 'site'),
(375, 1, 'site'),
(375, 2, 'site'),
(375, 87, 'site'),
(376, 1, 'site'),
(376, 2, 'site'),
(376, 87, 'site'),
(377, 1, 'site'),
(377, 2, 'site'),
(377, 87, 'site'),
(378, 1, 'site'),
(378, 2, 'site'),
(378, 87, 'site'),
(379, 1, 'site'),
(379, 2, 'site'),
(379, 88, 'site'),
(380, 1, 'site'),
(380, 2, 'site'),
(380, 88, 'site'),
(381, 1, 'site'),
(381, 2, 'site'),
(381, 88, 'site'),
(382, 1, 'site'),
(382, 2, 'site'),
(382, 88, 'site'),
(383, 1, 'site'),
(383, 2, 'site'),
(383, 89, 'site'),
(384, 1, 'site'),
(384, 2, 'site'),
(384, 89, 'site'),
(385, 1, 'site'),
(385, 2, 'site'),
(385, 89, 'site'),
(386, 1, 'site'),
(386, 2, 'site'),
(386, 89, 'site'),
(387, 1, 'site'),
(387, 2, 'site'),
(387, 90, 'site'),
(388, 1, 'site'),
(388, 2, 'site'),
(388, 90, 'site'),
(389, 1, 'site'),
(389, 2, 'site'),
(389, 90, 'site'),
(390, 1, 'site'),
(390, 2, 'site'),
(390, 90, 'site'),
(391, 1, 'site'),
(391, 2, 'site'),
(391, 91, 'site'),
(392, 1, 'site'),
(392, 2, 'site'),
(392, 91, 'site'),
(393, 1, 'site'),
(393, 2, 'site'),
(393, 91, 'site'),
(394, 1, 'site'),
(394, 2, 'site'),
(394, 91, 'site'),
(395, 1, 'site'),
(395, 2, 'site'),
(395, 92, 'site'),
(396, 1, 'site'),
(396, 2, 'site'),
(396, 92, 'site'),
(397, 1, 'site'),
(397, 2, 'site'),
(397, 92, 'site'),
(398, 1, 'site'),
(398, 2, 'site'),
(398, 92, 'site'),
(399, 1, 'site'),
(399, 2, 'site'),
(399, 93, 'site'),
(400, 1, 'site'),
(400, 2, 'site'),
(400, 93, 'site'),
(401, 1, 'site'),
(401, 2, 'site'),
(401, 93, 'site'),
(402, 1, 'site'),
(402, 2, 'site'),
(402, 93, 'site'),
(403, 1, 'site'),
(403, 2, 'site'),
(403, 94, 'site'),
(404, 1, 'site'),
(404, 2, 'site'),
(404, 94, 'site'),
(405, 1, 'site'),
(405, 2, 'site'),
(405, 94, 'site'),
(406, 1, 'site'),
(406, 2, 'site'),
(406, 94, 'site'),
(407, 1, 'site'),
(407, 2, 'site'),
(407, 95, 'site'),
(408, 1, 'site'),
(408, 2, 'site'),
(408, 95, 'site'),
(409, 1, 'site'),
(409, 2, 'site'),
(409, 95, 'site'),
(410, 1, 'site'),
(410, 2, 'site'),
(410, 95, 'site'),
(411, 1, 'site'),
(411, 2, 'site'),
(411, 96, 'site'),
(412, 1, 'site'),
(412, 2, 'site'),
(412, 96, 'site'),
(413, 1, 'site'),
(413, 2, 'site'),
(413, 96, 'site'),
(414, 1, 'site'),
(414, 2, 'site'),
(414, 96, 'site'),
(415, 1, 'site'),
(415, 2, 'site'),
(415, 97, 'site'),
(416, 1, 'site'),
(416, 2, 'site'),
(416, 97, 'site'),
(417, 1, 'site'),
(417, 2, 'site'),
(417, 97, 'site'),
(418, 1, 'site'),
(418, 2, 'site'),
(418, 97, 'site'),
(419, 1, 'site'),
(419, 2, 'site'),
(419, 98, 'site'),
(420, 1, 'site'),
(420, 2, 'site'),
(420, 98, 'site'),
(421, 1, 'site'),
(421, 2, 'site'),
(421, 98, 'site'),
(422, 1, 'site'),
(422, 2, 'site'),
(422, 98, 'site'),
(423, 1, 'site'),
(423, 2, 'site'),
(423, 99, 'site'),
(424, 1, 'site'),
(424, 2, 'site'),
(424, 99, 'site'),
(425, 1, 'site'),
(425, 2, 'site'),
(425, 99, 'site'),
(426, 1, 'site'),
(426, 2, 'site'),
(426, 99, 'site'),
(427, 1, 'site'),
(427, 2, 'site'),
(427, 100, 'site'),
(428, 1, 'site'),
(428, 2, 'site'),
(428, 100, 'site'),
(429, 1, 'site'),
(429, 2, 'site'),
(429, 100, 'site'),
(430, 1, 'site'),
(430, 2, 'site'),
(430, 100, 'site'),
(431, 1, 'site'),
(431, 2, 'site'),
(431, 101, 'site'),
(432, 1, 'site'),
(432, 2, 'site'),
(432, 101, 'site'),
(433, 1, 'site'),
(433, 2, 'site'),
(433, 101, 'site'),
(434, 1, 'site'),
(434, 2, 'site'),
(434, 101, 'site'),
(435, 1, 'site'),
(435, 2, 'site'),
(435, 102, 'site'),
(436, 1, 'site'),
(436, 2, 'site'),
(436, 102, 'site'),
(437, 1, 'site'),
(437, 2, 'site'),
(437, 102, 'site'),
(438, 1, 'site'),
(438, 2, 'site'),
(438, 102, 'site'),
(439, 1, 'site'),
(439, 2, 'site'),
(439, 103, 'site'),
(440, 1, 'site'),
(440, 2, 'site'),
(440, 103, 'site'),
(441, 1, 'site'),
(441, 2, 'site'),
(441, 103, 'site'),
(442, 1, 'site'),
(442, 2, 'site'),
(442, 103, 'site'),
(443, 1, 'site'),
(443, 2, 'site'),
(443, 104, 'site'),
(444, 1, 'site'),
(444, 2, 'site'),
(444, 104, 'site'),
(445, 1, 'site'),
(445, 2, 'site'),
(445, 104, 'site'),
(446, 1, 'site'),
(446, 2, 'site'),
(446, 104, 'site'),
(447, 1, 'site'),
(447, 2, 'site'),
(447, 105, 'site'),
(448, 1, 'site'),
(448, 2, 'site'),
(448, 105, 'site'),
(449, 1, 'site'),
(449, 2, 'site'),
(449, 105, 'site'),
(450, 1, 'site'),
(450, 2, 'site'),
(450, 105, 'site'),
(451, 1, 'site'),
(451, 2, 'site'),
(451, 106, 'site'),
(452, 1, 'site'),
(452, 2, 'site'),
(452, 106, 'site'),
(453, 1, 'site'),
(453, 2, 'site'),
(453, 106, 'site'),
(454, 1, 'site'),
(454, 2, 'site'),
(454, 106, 'site'),
(455, 1, 'site'),
(455, 2, 'site'),
(455, 107, 'site'),
(456, 1, 'site'),
(456, 2, 'site'),
(456, 107, 'site'),
(457, 1, 'site'),
(457, 2, 'site'),
(457, 107, 'site'),
(458, 1, 'site'),
(458, 2, 'site'),
(458, 107, 'site'),
(459, 1, 'site'),
(459, 2, 'site'),
(459, 108, 'site'),
(460, 2, 'site'),
(460, 108, 'site'),
(461, 108, 'site'),
(462, 2, 'site'),
(462, 108, 'site');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `album`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `album`;
CREATE TABLE `album` (
  `id` int(11) NOT NULL auto_increment,
  `owner` int(11) NOT NULL,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `imageId` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dataark for tabell `album`
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
-- Tabellstruktur for tabell `alumni`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `alumni`;
CREATE TABLE `alumni` (
  `userId` int(11) NOT NULL,
  `email` varchar(255) collate utf8_unicode_ci NOT NULL,
  `company` varchar(200) collate utf8_unicode_ci NOT NULL,
  `occupation` text collate utf8_unicode_ci NOT NULL,
  `city` varchar(50) collate utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `alumni`
--


-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `article`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci default NULL,
  `content` mediumtext collate utf8_unicode_ci,
  `author` int(11) NOT NULL,
  `timestamp` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=51 ;

--
-- Dataark for tabell `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author`, `timestamp`) VALUES
(1, 'Dette er faktisk en test :D', 'girllkull er smart og er et ord med fire "l"''er', 0, '0000-00-00'),
(50, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(49, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(48, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(47, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(46, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(45, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(44, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(43, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(42, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(41, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(40, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(39, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(38, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(37, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(36, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(35, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(34, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(33, 'Info', 'Informasjon om gruppen', 0, '0000-00-00'),
(32, 'Info', 'Informasjon om gruppen', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `comment`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL auto_increment,
  `parentId` int(11) default NULL,
  `parentType` enum('profile','comment','album','image','article','event','group') collate utf8_unicode_ci default NULL,
  `content` mediumtext collate utf8_unicode_ci,
  `author` int(11) default NULL,
  `timestamp` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `parentId` (`parentId`,`author`),
  KEY `author` (`author`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dataark for tabell `comment`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `event`
--
-- Opprettet: 18. Okt, 2011 klokka 18:22 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:22 PM
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(11) NOT NULL auto_increment,
  `start` datetime default NULL,
  `end` datetime default NULL,
  `location` varchar(30) collate utf8_unicode_ci default NULL,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `imageId` int(11) default NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=73 ;

--
-- Dataark for tabell `event`
--

INSERT INTO `event` (`id`, `start`, `end`, `location`, `title`, `imageId`, `content`) VALUES
(1, '2010-12-18 00:00:00', '2010-12-18 23:59:59', 'Eirik''s crib', 'Bursdag!', NULL, 'Eirik blir 20 år, hurra :D'),
(2, '2011-01-30 18:00:00', '2011-02-03 18:00:00', 'Åre', 'Åre 2011', NULL, '<p><b>Hybrider! Da har det duket for årets høydepunkt, vinterens villeste eventyr: Åretur!!!</b></p>\r\n\r\n\r\n<p>Som de siste to årene vil turen være i <b>uke 5</b>, eller for alle oss andre som hater ukesystemet: <b>30. jan - 3. feb 2011</b></p>\r\n\r\n\r\n\r\n<p>I år som i fjor, får vi ikke info om eksakt bosted før 4-5 uker før avreise, men hyttene skal befinne seg i Klockstälpeln/Torvtaket/Åregårdarna. Alle disse stedene er sentrale, og om jeg husker riktig innen 100-200m fra hverandre.</p>\r\n\r\n\r\n\r\n<p><b>Påmeldingen til turen åpner kl 17.00, søndag 17. oktober!</b> Det er <b>50 ledige plasser</b>, og i fjor gikk alle 50 på <u>25 min</u>! Så pass på å være klar til å melde deg på, søndag 17. oktober kl 17.00!!</p>\r\n\r\n<p>Prisen på årets tur vil være <b>1950,- for medlemmer</b> og <u>2150,- for ikke-medlemmer.</u> Betalingen skal inn på kontonr: 0539 26 44913, innen 7. november. HUSK å merke innbetalinga med Navn + Åre 2011. </p>\r\n\r\n\r\n\r\n<p>Det som inngår i prisen er:</p>\r\n<ul>\r\n\r\n	<li> Buss tur/retur Åre </li>\r\n\r\n	<li> Opphold på hytter i Klockstälpeln/Torvtaket/Åregårdarna</li>\r\n\r\n	<li> 5-dagers skikort</li>\r\n\r\n</ul>\r\n\r\n\r\n<p>OBS! OBS! Videre info vil de påmeldte få via mail. Som tiden for avgang, når vi er tilbake, hytteoversikt, hyttefordeling, etc.</p>'),
(3, '2010-12-24 00:00:00', '2010-12-24 23:59:59', 'Earth', 'Julaften!', NULL, 'Vi gleder oss'),
(4, '2011-03-02 13:00:00', '2011-03-02 14:00:00', '???', 'stearinlys', NULL, 'wtf?'),
(5, '2011-03-17 16:16:15', '2011-03-16 16:16:21', 'Moholt', 'Komitéfest', 2, 'Hybrida arrangerer fest for alle komiténe\r\n<br>Det blir pizza\r\n'),
(6, '2011-04-15 17:00:06', '2011-03-25 17:00:16', NULL, 'Påskeferie', 2, 'Påskeferie!!'),
(8, '2012-10-03 00:00:00', '2012-10-03 00:00:00', 'VM-brakka', 'Legg til nyhet', 0, ''),
(9, '2012-10-03 00:00:00', '2012-10-03 00:00:00', 'hahaha', 'afehøa', 0, ''),
(10, '2012-10-03 00:00:00', '2012-10-03 00:00:00', 'sted', 'Spam', 0, ''),
(11, '2012-10-03 00:00:00', '2012-10-03 00:00:00', 'hahaha', 'spam2', 0, ''),
(12, '2012-11-03 00:00:00', '2012-11-03 00:00:00', 'EL5', 'SPAAAMM', 0, ''),
(13, '2012-11-03 00:00:00', '2013-02-03 00:00:00', 'partybyenYEAH', 'SPAAAMAMAMA', 0, 'long info'),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'GlÃ¸s EL 5', 'bla bla bla', NULL, ''),
(15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'jepp', NULL, ''),
(16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'jepp', NULL, ''),
(17, '2011-03-30 15:50:00', '2011-03-30 15:50:00', 'NYtt sted YEAH', 'FREESHt', NULL, 'logged_in har tilgang'),
(18, '2011-03-18 00:58:00', '2011-03-31 00:58:00', 'GlÃ¸shaugen', 'Ny Test', NULL, ''),
(19, '2011-03-17 02:27:00', '2011-03-31 02:27:00', '', 'SPAM', NULL, ''),
(20, '2011-03-31 02:29:00', '2011-03-31 02:29:00', '', 'SPAM', NULL, ''),
(21, '2011-03-31 02:30:00', '2011-03-31 02:30:00', '', 'SPAM', NULL, ''),
(22, '2011-03-31 02:30:00', '2011-03-31 02:30:00', 'FJÃ˜Ã˜S', 'Halla Ã¦Ã¸Ã¥Ã¦Ã¸Ã¥Ã¦Ã¸Ã¥', NULL, 'yeah yeah Ã¦Ã¸Ã¥Ã¦Ã¸Ã¥Ã¦Ã¸Ã¥'),
(23, '2011-03-31 02:41:00', '2011-03-31 02:41:00', '', 'Fett as', NULL, 'eventInnhold'),
(24, '2011-03-31 02:41:00', '2011-03-31 02:41:00', '', 'Supaa', NULL, ''),
(25, '2011-06-08 13:08:00', '2011-09-29 13:08:00', '', 'Sommerferie!!!!', NULL, ''),
(26, '2011-04-20 19:31:00', '2011-04-28 15:37:00', '', '', NULL, ''),
(27, '2011-04-04 01:17:00', '2011-04-04 01:17:00', '', 'blÃ¥bÃ¦rsyltetÃ¸y!!', NULL, ''),
(28, '2011-04-04 01:20:00', '2011-04-04 01:20:00', '', 'Ã¦Ã¸Ã¥Ã¸Ã¥Ã¸Ã¦', NULL, ''),
(29, '2011-04-04 01:26:00', '2011-04-04 01:26:00', '', 'blÃ¦Ã¥bÃ¦Ã¥r', NULL, ''),
(30, '2011-04-04 01:31:00', '2011-04-04 01:31:00', '', 'lÃ¸k er Ã¥some', NULL, ''),
(31, '2011-04-04 01:34:00', '2011-04-04 01:34:00', '', 'sÃ¸pper er rÃ¥tt og Ã¦rlig', NULL, ''),
(32, '2011-04-04 02:19:00', '2011-04-04 02:19:00', '', 'blÃ¥Ã¦', NULL, ''),
(33, '2011-04-04 02:27:00', '2011-04-04 02:27:00', '', 'blÃ¥Ã¥Ã¥Ã¥', NULL, ''),
(34, '2011-04-04 02:28:00', '2011-04-04 02:28:00', '', 'blÃ¥Ã¥Ã¥Ã¥', NULL, ''),
(35, '2011-04-04 02:28:00', '2011-04-04 02:28:00', '', 'blÃ¥Ã¥Ã¥Ã¥', NULL, ''),
(36, '2011-04-04 02:48:00', '2011-04-04 02:48:00', '', 'jeg er blæ og lillæ', NULL, ''),
(37, '2011-04-04 02:49:00', '2011-04-04 02:49:00', '', 'jeg er blÃ¦ og lillÃ¦Ã¦Ã¦Ã¦Ã¦', NULL, ''),
(38, '2011-04-04 03:02:00', '2011-04-04 03:02:00', 'Nytt sted', 'blåbærtest', NULL, ''),
(39, '2011-04-19 01:09:00', '2011-04-05 01:09:00', 'YEAHssss', '', 0, ''),
(40, '2011-04-05 01:34:00', '2011-04-05 01:34:00', 'Nytt sted!', '', 0, ''),
(41, '2011-04-05 01:34:00', '2011-04-05 01:34:00', 'Nytt sted!', '', 0, ''),
(42, '2011-04-05 17:29:00', '2011-04-05 17:29:00', 'SUUUPER', '', 0, 'YEAH as'),
(43, '2011-04-05 18:01:00', '2011-04-05 18:01:00', '', '', 0, ''),
(44, '2011-04-05 18:01:00', '2011-04-21 18:01:00', 'Her', '', 0, 'jaa'),
(45, '2011-04-06 09:35:00', '2011-04-06 09:35:00', '', '', 0, ''),
(46, '2011-04-06 10:07:00', '2011-04-06 10:07:00', 'event!>', '', 0, ''),
(47, '2011-04-06 10:15:00', '2011-04-06 10:15:00', '', '', 0, ''),
(48, '2011-04-06 10:15:00', '2011-04-06 10:15:00', '', '', 0, ''),
(49, '2011-04-06 10:15:00', '2011-04-06 10:15:00', '', '', 0, ''),
(50, '2011-04-06 12:52:00', '2011-04-06 12:52:00', 'Bakkelandet', '', 0, 'info ass'),
(51, '2011-04-07 00:16:00', '2011-04-07 00:16:00', 'Greit as', '', 0, ''),
(52, '2011-04-07 09:38:00', '2011-04-07 09:38:00', '', '', 0, ''),
(53, '2011-04-07 09:38:00', '2011-04-07 09:38:00', '', '', 0, ''),
(54, '2011-04-07 17:33:00', '2011-04-07 17:33:00', '', '', 0, ''),
(55, '2011-04-07 21:01:00', '2011-04-07 21:01:00', '', '', 0, ''),
(56, '2011-04-07 21:01:00', '2011-04-07 21:01:00', '', '', 0, ''),
(57, '2011-04-14 17:11:00', '2011-04-14 17:11:00', '', '', 0, ''),
(58, '2011-04-14 17:11:00', '2011-04-14 17:11:00', '', '', 0, ''),
(59, '2011-04-14 17:11:00', '2011-04-14 17:11:00', '', '', 0, ''),
(60, '2011-04-14 17:16:00', '2011-04-14 17:16:00', '', '', 0, ''),
(61, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(62, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(63, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(64, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(65, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(66, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(67, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(68, '2011-04-14 18:11:00', '2011-04-14 18:11:00', '', '', 0, ''),
(69, '2011-05-19 11:51:00', '2011-05-19 11:51:00', 'yess', '', 0, ''),
(70, '2011-07-17 22:31:00', '2011-07-17 22:31:00', '', '', 0, ''),
(71, '2011-07-17 22:34:00', '2011-07-17 22:34:00', '', '', 0, 'Dette er lenger info'),
(72, '2011-08-10 21:14:00', '2011-08-10 21:14:00', '', '', 0, '');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `groups`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL auto_increment,
  `menu` int(11) NOT NULL,
  `title` varchar(20) collate utf8_unicode_ci NOT NULL,
  `admin` int(11) default NULL,
  `committee` enum('true','false') collate utf8_unicode_ci NOT NULL default 'false',
  PRIMARY KEY  (`id`),
  KEY `members` (`admin`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dataark for tabell `groups`
--

INSERT INTO `groups` (`id`, `menu`, `title`, `admin`, `committee`) VALUES
(58, 0, 'UpdateK', 382, 'false'),
(55, 0, 'Webkom', 327, 'false'),
(56, 0, 'Styret', 363, 'false'),
(57, 0, 'Bedriftskomit', 294, 'false');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `image`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE `image` (
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
-- Dataark for tabell `image`
--

INSERT INTO `image` (`id`, `title`, `oldName`, `albumId`, `userId`, `timestamp`) VALUES
(1, '', 'gtfo.jpg', -1, 1, '2011-02-26 18:34:29'),
(2, '', 'Untitled.jpg', -1, 1, '2011-02-26 21:07:15'),
(3, '', 'Untitled.jpg', -1, 1, '2011-02-27 23:10:36'),
(4, 'Koala!', 'Koala.jpg', -1, 327, '2011-03-21 18:39:21'),
(5, 'Sommer', 'sommer', -1, 327, '2011-07-21 21:04:59');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `membership_access`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:11 PM
--

DROP TABLE IF EXISTS `membership_access`;
CREATE TABLE `membership_access` (
  `accessId` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL default '0',
  PRIMARY KEY  (`accessId`,`userId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=367 ;

--
-- Dataark for tabell `membership_access`
--

INSERT INTO `membership_access` (`accessId`, `userId`) VALUES
(0, 406),
(1, 327),
(1, 406),
(2, 327),
(2, 406),
(3, 327),
(3, 406),
(52, 1),
(52, 327),
(52, 332),
(52, 380),
(52, 381),
(52, 382),
(53, 294),
(53, 322),
(53, 327),
(53, 361),
(53, 363),
(53, 367),
(53, 383),
(54, 294),
(54, 349),
(54, 354),
(54, 357),
(55, 382),
(56, 1),
(56, 327),
(56, 332),
(56, 380),
(56, 381),
(56, 382),
(57, 294),
(57, 322),
(57, 327),
(57, 361),
(57, 363),
(57, 367),
(57, 383),
(58, 294),
(58, 349),
(58, 354),
(58, 357),
(59, 382),
(60, 1),
(60, 327),
(60, 332),
(60, 380),
(60, 381),
(60, 382),
(61, 294),
(61, 322),
(61, 327),
(61, 361),
(61, 363),
(61, 367),
(61, 383),
(62, 294),
(62, 349),
(62, 354),
(62, 357),
(63, 382),
(64, 1),
(64, 327),
(64, 332),
(64, 380),
(64, 381),
(64, 382),
(65, 294),
(65, 322),
(65, 327),
(65, 361),
(65, 363),
(65, 367),
(65, 383),
(66, 294),
(66, 349),
(66, 354),
(66, 357),
(67, 382),
(68, 1),
(68, 327),
(68, 332),
(68, 380),
(68, 381),
(68, 382),
(69, 294),
(69, 322),
(69, 327),
(69, 361),
(69, 363),
(69, 367),
(69, 383),
(70, 294),
(70, 349),
(70, 354),
(70, 357),
(71, 382),
(72, 1),
(72, 327),
(72, 332),
(72, 380),
(72, 381),
(72, 382),
(73, 294),
(73, 322),
(73, 327),
(73, 361),
(73, 363),
(73, 367),
(73, 383),
(74, 294),
(74, 349),
(74, 354),
(74, 357),
(75, 382),
(76, 1),
(76, 327),
(76, 332),
(76, 380),
(76, 381),
(76, 382),
(77, 294),
(77, 322),
(77, 327),
(77, 361),
(77, 363),
(77, 367),
(77, 383),
(78, 294),
(78, 349),
(78, 354),
(78, 357),
(79, 382),
(90, 1),
(90, 327),
(90, 332),
(90, 354),
(90, 380),
(90, 381),
(90, 382),
(97, 1),
(97, 327),
(97, 332),
(97, 354),
(97, 380),
(97, 381),
(97, 382),
(98, 294),
(98, 322),
(98, 327),
(98, 361),
(98, 363),
(98, 367),
(98, 383),
(99, 294),
(99, 349),
(99, 354),
(99, 357),
(100, 382),
(101, 1),
(101, 327),
(101, 332),
(101, 354),
(101, 380),
(101, 381),
(101, 382),
(102, 294),
(102, 322),
(102, 327),
(102, 361),
(102, 363),
(102, 367),
(102, 383),
(103, 294),
(103, 349),
(103, 354),
(103, 357),
(104, 382),
(105, 1),
(105, 327),
(105, 332),
(105, 354),
(105, 380),
(105, 381),
(105, 382),
(106, 294),
(106, 322),
(106, 327),
(106, 361),
(106, 363),
(106, 367),
(106, 383),
(107, 294),
(107, 349),
(107, 354),
(107, 357),
(366, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `membership_group`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `membership_group`;
CREATE TABLE `membership_group` (
  `groupId` int(11) NOT NULL auto_increment,
  `userId` int(11) default NULL,
  `comission` varchar(30) collate utf8_unicode_ci NOT NULL,
  KEY `userId` (`userId`,`groupId`),
  KEY `groupId` (`groupId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

--
-- Dataark for tabell `membership_group`
--

INSERT INTO `membership_group` (`groupId`, `userId`, `comission`) VALUES
(57, 349, 'Medlem'),
(57, 354, 'Medlem'),
(57, 357, 'Medlem'),
(57, 294, 'BedriftskomSjef'),
(56, 361, 'JentekomSjef'),
(56, 294, 'BedriftskomSjef'),
(56, 383, 'Skattemester'),
(56, 367, 'Festivalus'),
(56, 327, 'Vevsjef'),
(55, 327, 'Sjef'),
(55, 354, 'Medlem'),
(55, 1, 'Medlem'),
(55, 332, 'Medlem'),
(55, 380, 'Medlem'),
(55, 381, 'Medlem'),
(55, 382, 'Medlem'),
(56, 363, 'Leder'),
(56, 322, 'Nestleder');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `membership_signup`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `membership_signup`;
CREATE TABLE `membership_signup` (
  `eventId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `signedOff` enum('true','false') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`eventId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `membership_signup`
--

INSERT INTO `membership_signup` (`eventId`, `userId`, `signedOff`) VALUES
(2, 327, 'true'),
(4, 327, 'false'),
(2, 1, 'false'),
(4, 1, 'false'),
(4, 0, 'false'),
(5, 1, 'false'),
(5, 327, 'false'),
(5, 354, 'false'),
(8, 327, 'false'),
(9, 327, 'false'),
(8, 1, 'false'),
(9, 1, 'false'),
(11, 327, 'false'),
(15, 15, 'false'),
(25, 15, 'false'),
(25, 327, 'false'),
(25, 1, 'false'),
(26, 327, 'false'),
(27, 327, 'false'),
(14, 406, 'false'),
(18, 406, 'false'),
(10, 406, 'false');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `menu_group`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:08 PM
--

DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group` (
  `group` int(11) NOT NULL,
  `site` int(11) NOT NULL,
  `contentId` int(11) default NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY  (`group`,`site`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `menu_group`
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
(1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `menu_top`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `menu_top`;
CREATE TABLE `menu_top` (
  `menu` int(11) NOT NULL auto_increment,
  `site` int(11) NOT NULL,
  `id` int(11) default NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY  (`menu`,`site`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dataark for tabell `menu_top`
--

INSERT INTO `menu_top` (`menu`, `site`, `id`, `sort`) VALUES
(1, 1, NULL, 1),
(2, 2, NULL, 2),
(3, 3, NULL, 3),
(4, 4, 1, 5);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `menu_top_sub`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `menu_top_sub`;
CREATE TABLE `menu_top_sub` (
  `menuId` int(11) NOT NULL,
  `site` int(11) NOT NULL,
  `id` int(11) default NULL,
  `sort` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `menu_top_sub`
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
-- Tabellstruktur for tabell `news`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=42 ;

--
-- Dataark for tabell `news`
--

INSERT INTO `news` (`id`, `parentId`, `parentType`, `title`, `imageId`, `content`, `author`, `timestamp`) VALUES
(1, 42, 'event', 'Vi tester på nytt!!', NULL, '', 15, '2011-04-04 03:02:17'),
(2, 43, 'event', 'ÆÆØØÅÅ', NULL, 'ÆÆØØÅÅ', 0, '2011-04-04 03:11:53'),
(3, 44, 'event', 'Hasda', NULL, 'ÆÆØØÅÅsadfaew', 0, '2011-04-04 03:12:12'),
(4, 39, 'event', 'æøåæøåæ', 0, 'INNHPOLLLD', NULL, NULL),
(5, 40, 'event', 'JADDDA', 0, '', NULL, NULL),
(6, 41, 'event', 'JADDDA', 0, '', NULL, NULL),
(7, 0, '', 'SPAMMA', 0, 'Ren nyhet!', NULL, NULL),
(8, 0, '', 'SPAMMA', 0, 'Ren nyhet!', NULL, NULL),
(9, 0, '', 'stor nyhet', 0, 'langt innhold', NULL, NULL),
(10, 0, '', 'stor nyhet', 0, 'langt innhold', NULL, NULL),
(11, 0, '', 'stor nyhet', 0, 'langt innhold', NULL, NULL),
(12, 60, 'event', 'stor nyhet as', 0, 'langt innhold', 406, '2011-04-06 09:57:08'),
(13, 45, 'event', 'æpå', 0, 'langt innhold', 406, '2011-04-06 09:58:05'),
(14, 46, 'event', 'Tullebukk!', 0, '', 406, '2011-04-06 10:04:22'),
(15, 54, 'event', '', 0, '', 406, '2011-04-06 10:16:41'),
(16, 49, 'event', '', 0, '', 406, '2011-04-06 10:17:05'),
(17, 0, '', '', 0, '', 406, '2011-04-06 11:20:49'),
(18, 0, '', 'OVERSKRIFT', 0, 'LAAAANGT INNHOLD', 406, '2011-04-06 12:11:49'),
(19, 0, '', 'OVERSKRIFT', 0, 'LAAAANGT INNHOLD', 406, '2011-04-06 12:12:27'),
(20, 0, '', 'OVERSKRIFT', 0, 'LAAAANGT INNHOLD', 406, '2011-04-06 12:12:32'),
(21, 51, 'event', 'test æøå', 0, 'LAAAANGT INNHOLD', 406, '2011-04-06 12:12:38'),
(22, 0, '', 'Lorem Ipsum', 0, '', 406, '2011-04-07 19:33:38'),
(23, NULL, NULL, 'Nyhet for gjest', 4, 'Dette er en nyhet for gjester...', 327, NULL),
(24, 1, '', 'Nyhet for webkomgruppen!', 4, 'Dette er en nyhet postet i webkomgruppen!!', 327, '2011-04-12 00:06:33'),
(25, 0, '', 'Halla', 0, '', 406, '2011-04-14 18:15:06'),
(26, 0, '', '', 0, '', 406, '2011-05-06 20:40:30'),
(27, 0, '', '', 0, '', 406, '2011-05-06 20:41:00'),
(28, 0, '', '', 0, '', 406, '2011-05-06 20:41:59'),
(29, 0, '', '', 0, '', 406, '2011-05-06 20:44:02'),
(30, 0, '', '', 0, '', 406, '2011-05-06 21:29:34'),
(31, 0, '', 'yess', 0, '', 406, '2011-05-06 21:29:39'),
(32, 0, '', 'yess', 0, '', 406, '2011-05-06 21:31:06'),
(33, 0, '', 'tittel', 0, 'content', 0, '2011-05-06 22:21:40'),
(34, 0, '', 'tittel', 0, 'content', 0, '2011-05-06 22:54:09'),
(35, 0, '', 'Yeah!', 0, '', 381, '2011-05-09 18:37:20'),
(36, 69, 'event', 'halla', 0, 'neida!', 406, '2011-05-19 11:51:41'),
(37, 0, 'event', 'Sommernyhet', 4, 'Dette er en sommernyhet.\r\n', 406, '2011-07-17 17:40:17'),
(38, 0, '', 'En lang sommernyhet', 4, 'Lang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\nLang nyhet\r\n', 327, '2011-07-17 21:31:22'),
(39, 70, 'event', 'SommerHendelse', 0, 'Langt innhold!', 327, '2011-07-17 22:32:33'),
(40, 71, 'event', 'Sommerhendelse 2', 0, 'Dette er innhold', 327, '2011-07-17 22:34:51'),
(41, 72, 'event', '', 0, '', 327, '2011-08-10 21:14:21');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `news_group`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `news_group`;
CREATE TABLE `news_group` (
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
-- Tabellstruktur for tabell `order`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) default NULL,
  `order` mediumtext character set utf8 collate utf8_unicode_ci,
  `timestamp` datetime default NULL,
  `paid` enum('true','false') character set utf8 collate utf8_unicode_ci NOT NULL default 'false',
  PRIMARY KEY  (`id`),
  KEY `userId` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dataark for tabell `order`
--


-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `poll`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `poll`;
CREATE TABLE `poll` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dataark for tabell `poll`
--

INSERT INTO `poll` (`id`, `title`) VALUES
(1, 'Lommelerke');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `poll_option`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `poll_option`;
CREATE TABLE `poll_option` (
  `id` int(11) NOT NULL auto_increment,
  `pollId` int(11) default NULL,
  `name` varchar(30) collate utf8_unicode_ci default NULL,
  `color` char(6) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pollId` (`pollId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dataark for tabell `poll_option`
--

INSERT INTO `poll_option` (`id`, `pollId`, `name`, `color`) VALUES
(1, 1, 'Ja takk!', 'FF0000'),
(2, 1, 'mesa be gay', '4A7F6B');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `signup`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `signup`;
CREATE TABLE `signup` (
  `eventId` int(11) NOT NULL default '0',
  `spots` int(11) NOT NULL,
  `open` datetime NOT NULL,
  `close` datetime NOT NULL,
  `signoff` enum('true','false') collate utf8_unicode_ci NOT NULL default 'false',
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY  (`eventId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `signup`
--

INSERT INTO `signup` (`eventId`, `spots`, `open`, `close`, `signoff`, `active`) VALUES
(2, 60, '2011-01-11 17:22:46', '2011-01-29 17:22:56', 'true', 0),
(4, 20, '2011-01-28 15:05:24', '2011-02-16 15:05:28', 'false', 0),
(5, 8, '2011-03-02 17:44:19', '2011-03-16 17:44:24', 'false', 0),
(8, 0, '2012-10-03 00:00:00', '2012-10-03 00:00:00', 'true', 0),
(9, 2, '2012-10-03 00:00:00', '2012-10-03 00:00:00', 'true', 0),
(10, 2, '2012-10-03 00:00:00', '2012-10-03 00:00:00', 'true', 0),
(11, 0, '2012-10-03 00:00:00', '2012-10-03 00:00:00', '', 0),
(14, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'true', 0),
(15, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0),
(16, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 0),
(17, 100, '2011-03-30 15:50:00', '2011-03-30 15:50:00', 'false', 0),
(18, 0, '2011-03-31 00:58:00', '2011-10-21 00:58:00', 'true', 0),
(0, 0, '2011-04-14 17:11:00', '2011-04-14 17:11:00', '', 0),
(20, 0, '2011-03-31 02:29:00', '2011-03-31 02:29:00', '', 0),
(22, 0, '2011-03-31 02:30:00', '2011-03-31 02:30:00', '', 0),
(23, 0, '2011-03-31 02:41:00', '2011-03-31 02:41:00', '', 0),
(24, 0, '2011-03-31 02:41:00', '2011-03-31 02:41:00', '', 0),
(25, 500, '2011-04-03 13:08:00', '2011-09-08 13:08:00', 'true', 0),
(26, 0, '2011-04-03 15:33:00', '2011-04-03 15:33:00', '', 0),
(27, 0, '2011-04-04 01:17:00', '2011-04-04 01:17:00', '', 0),
(28, 0, '2011-04-04 01:20:00', '2011-04-04 01:20:00', '', 0),
(29, 0, '2011-04-04 01:26:00', '2011-04-04 01:26:00', '', 0),
(30, 0, '2011-04-04 01:31:00', '2011-04-04 01:31:00', '', 0),
(31, 0, '2011-04-04 01:34:00', '2011-04-04 01:34:00', '', 0),
(32, 0, '2011-04-04 02:19:00', '2011-04-04 02:19:00', '', 0),
(33, 0, '2011-04-04 02:27:00', '2011-04-04 02:27:00', '', 0),
(34, 0, '2011-04-04 02:28:00', '2011-04-04 02:28:00', '', 0),
(35, 0, '2011-04-04 02:28:00', '2011-04-04 02:28:00', '', 0),
(36, 0, '2011-04-04 02:48:00', '2011-04-04 02:48:00', '', 0),
(37, 0, '2011-04-04 02:49:00', '2011-04-04 02:49:00', '', 0),
(38, 0, '2011-04-04 03:02:00', '2011-04-04 03:02:00', '', 0),
(50, 50, '2011-04-07 00:09:00', '2011-04-07 00:09:00', 'true', 0),
(51, 0, '2011-04-07 00:16:00', '2011-04-07 00:16:00', 'true', 0),
(48, 0, '2011-04-07 17:33:00', '2011-04-07 17:33:00', '', 0),
(54, 0, '2011-04-07 17:33:00', '2011-04-07 17:33:00', '', 0),
(59, 50, '2011-04-04 17:11:00', '2011-04-15 17:11:00', '', 0),
(60, 100, '2015-04-03 17:16:00', '2011-04-14 17:16:00', 'true', 0),
(68, 0, '2023-04-14 18:11:00', '2011-04-14 18:11:00', '', 1),
(70, 50, '2011-07-17 22:31:00', '2011-07-17 22:31:00', '', 1),
(71, 40, '2011-07-17 22:34:00', '2012-07-17 22:34:00', '', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `site`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `siteId` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  `path` varchar(60) collate utf8_unicode_ci NOT NULL,
  `id` int(11) default NULL,
  `subId` int(11) default NULL,
  PRIMARY KEY  (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=463 ;

--
-- Dataark for tabell `site`
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
(447, 'Kommentarer', 'group', NULL, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `site_content`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `site_content`;
CREATE TABLE `site_content` (
  `id` int(11) NOT NULL auto_increment,
  `filename` varchar(20) collate utf8_unicode_ci NOT NULL,
  `description` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dataark for tabell `site_content`
--

INSERT INTO `site_content` (`id`, `filename`, `description`) VALUES
(1, 'comments', 'Side med kommentarer'),
(2, 'news', 'Side med nyheter'),
(3, 'article', 'artikkelside'),
(4, 'members', 'Side med medlemmer');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `slide`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `slide`;
CREATE TABLE `slide` (
  `id` int(11) NOT NULL auto_increment,
  `slideshowId` int(11) NOT NULL,
  `imageId` int(11) NOT NULL,
  `message` varchar(200) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dataark for tabell `slide`
--

INSERT INTO `slide` (`id`, `slideshowId`, `imageId`, `message`) VALUES
(1, 1, 1, 'Slide 1'),
(2, 1, 1, 'Postmann Pat, Postmann Pat,  med sin svarte og hvite katt Alltid tidlig ute  på sin postmanns rute  har han all posten med seg i sin bil'),
(3, 1, 1, 'BLABLALBA');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `slideshow`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `slideshow`;
CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dataark for tabell `slideshow`
--

INSERT INTO `slideshow` (`id`, `title`) VALUES
(1, 'index slide');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `spesialization`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `spesialization`;
CREATE TABLE `spesialization` (
  `id` int(11) NOT NULL auto_increment,
  `siteId` int(11) default NULL,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `siteId` (`siteId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dataark for tabell `spesialization`
--

INSERT INTO `spesialization` (`id`, `siteId`, `name`) VALUES
(1, 10, 'Geomatikk'),
(2, 11, 'Marin Teknikk'),
(3, 12, 'Produkt og Prosess'),
(4, 13, 'Konstruksjonsteknikk'),
(5, 14, 'Petroleumsfag');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `tag`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `contentType` enum('news','article') collate utf8_unicode_ci NOT NULL,
  `tagType` enum('wiki','group') collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `tag`
--

INSERT INTO `tag` (`id`, `ownerId`, `contentType`, `tagType`) VALUES
(48, 0, 'article', 'wiki'),
(49, 0, 'article', 'wiki');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(10) collate utf8_unicode_ci NOT NULL,
  `password` varchar(32) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=407 ;

--
-- Dataark for tabell `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(381, 'sigurhol', '');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_info`
--
-- Opprettet: 18. Okt, 2011 klokka 18:23 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:23 PM
-- Sist kontrollert: 18. Okt, 2011 klokka 18:23 PM
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
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
-- Dataark for tabell `user_info`
--

INSERT INTO `user_info` (`userId`, `firstName`, `middleName`, `lastName`, `specialization`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `lastLogin`, `cardinfo`, `description`, `birthdate`, `altEmail`) VALUES
(381, 'Sigurd', 'Andreas', 'Holsen', 0, 2015, 'false', 'unknown', -1, NULL, '2011-05-09 18:36:35', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_new`
--
-- Opprettet: 18. Okt, 2011 klokka 18:52 PM
-- Sist oppdatert: 22. Okt, 2011 klokka 22:15 PM
--

DROP TABLE IF EXISTS `user_new`;
CREATE TABLE `user_new` (
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
  `birthdate` date default NULL,
  `altEmail` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=408 ;

--
-- Dataark for tabell `user_new`
--

INSERT INTO `user_new` (`id`, `username`, `firstName`, `middleName`, `lastName`, `specialization`, `graduationYear`, `member`, `gender`, `imageId`, `phoneNumber`, `lastLogin`, `cardinfo`, `description`, `birthdate`, `altEmail`) VALUES
(381, 'sigurhol', 'Sigurd', 'Andreas', 'Holsen', 0, 2015, 'false', 'unknown', -1, NULL, '2011-05-09 18:36:35', '', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `vote`
--
-- Opprettet: 18. Okt, 2011 klokka 18:03 PM
-- Sist oppdatert: 18. Okt, 2011 klokka 18:03 PM
--

DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `pollId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `choice` int(11) NOT NULL,
  PRIMARY KEY  (`pollId`,`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dataark for tabell `vote`
--

INSERT INTO `vote` (`pollId`, `userId`, `choice`) VALUES
(1, 1, 1),
(1, 327, 2),
(380, 1, 2),
(15, 1, 1);
