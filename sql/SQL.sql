-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 22 mei 2013 om 11:10
-- Serverversie: 5.5.25
-- PHP-versie: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Databank: `project`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `punt` int(11) NOT NULL,
  `vriend` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Gegevens worden uitgevoerd voor tabel `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `password`, `punt`, `vriend`) VALUES
(8, 'ik', 'ik@ik.ik', 'ff1685ebf6a0a0407f4e6519e08d1fdc', 13, 0),
(16, 'wij', 'wij@wij.wij', 'f70b7df4146cdd16d4c6591ac5884f7e', 4, 1),
(17, 'hij', 'hij@hij.hij', 'dea085b87b5255d642884d94464385c8', 1, 0),
(19, 'yannick', 'yy@yy.yy', 'de95784dbf7d9fd1338f5a52f16ebd1d', 25, 1),
(20, 'tatjana', 'tv@de.be', '0fbaab71147cfcd762422be08d2f3478', 2, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `promoot`
--

CREATE TABLE `promoot` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `fk_user_id` int(11) DEFAULT NULL,
  `date_posted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=190 ;

--
-- Gegevens worden uitgevoerd voor tabel `promoot`
--

INSERT INTO `promoot` (`id`, `text`, `fk_user_id`, `date_posted`) VALUES
(189, 'Kinepolis Antwerpen\r\nDelicious Movie Night: Man of Steel\r\n20/05/2013 \r\n\r\n', 19, '2013-05-20 13:30:41');
