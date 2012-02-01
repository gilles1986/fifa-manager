-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 28. Mai 2011 um 10:46
-- Server Version: 5.1.41
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fifamanager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teams`
--

DROP TABLE IF EXISTS `teams`;
CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `teams`
--

INSERT INTO `teams` (`id`, `name`) VALUES
(1, 'Chelsea'),
(2, 'Arsenal'),
(5, 'Bayern Muenchen'),
(4, 'Real Madrid');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tourn`
--

DROP TABLE IF EXISTS `tourn`;
CREATE TABLE IF NOT EXISTS `tourn` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `status` varchar(50) NOT NULL,
  `winnerid` int(5) NOT NULL,
  `autorid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Daten für Tabelle `tourn`
--

INSERT INTO `tourn` (`id`, `name`, `status`, `winnerid`, `autorid`) VALUES
(21, 'Encarnium Turnier', 'open', 0, 1),
(20, 'Test', 'open', 0, 1),
(9, 'Super Turnier', 'started', 0, 1),
(17, 'Das Super Turnier', 'open', 0, 18),
(22, 'Spadaddel', 'started', 0, 10);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tourngame`
--

DROP TABLE IF EXISTS `tourngame`;
CREATE TABLE IF NOT EXISTS `tourngame` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `player1` int(5) NOT NULL,
  `player2` int(5) NOT NULL,
  `status` varchar(40) NOT NULL,
  `p1goals` int(3) NOT NULL,
  `p2goals` int(3) NOT NULL,
  `tournid` int(5) NOT NULL,
  `winner` int(5) NOT NULL,
  `order` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Daten für Tabelle `tourngame`
--

INSERT INTO `tourngame` (`id`, `player1`, `player2`, `status`, `p1goals`, `p2goals`, `tournid`, `winner`, `order`) VALUES
(23, 18, 2, 'open', 0, 0, 22, 0, 0),
(22, 18, 10, 'open', 0, 0, 22, 0, 0),
(21, 18, 17, 'open', 0, 0, 22, 0, 0),
(20, 16, 1, 'open', 0, 0, 22, 0, 0),
(19, 16, 2, 'open', 0, 0, 22, 0, 0),
(18, 16, 10, 'open', 0, 0, 22, 0, 0),
(17, 16, 17, 'open', 0, 0, 22, 0, 0),
(16, 16, 18, 'open', 0, 0, 22, 0, 0),
(24, 18, 1, 'open', 0, 0, 22, 0, 0),
(25, 17, 10, 'open', 0, 0, 22, 0, 0),
(26, 17, 2, 'open', 0, 0, 22, 0, 0),
(27, 17, 1, 'open', 0, 0, 22, 0, 0),
(28, 10, 2, 'open', 0, 0, 22, 0, 0),
(29, 10, 1, 'open', 0, 0, 22, 0, 0),
(30, 2, 1, 'open', 0, 0, 22, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tournplayer`
--

DROP TABLE IF EXISTS `tournplayer`;
CREATE TABLE IF NOT EXISTS `tournplayer` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `playerid` int(5) NOT NULL,
  `tournid` int(5) NOT NULL,
  `wins` int(3) NOT NULL DEFAULT '0',
  `loss` int(3) NOT NULL DEFAULT '0',
  `ties` int(3) NOT NULL DEFAULT '0',
  `team` varchar(80) NOT NULL,
  `points` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Daten für Tabelle `tournplayer`
--

INSERT INTO `tournplayer` (`id`, `playerid`, `tournid`, `wins`, `loss`, `ties`, `team`, `points`) VALUES
(30, 2, 9, 2, 3, 1, '5', 7),
(35, 1, 17, 0, 0, 0, '', 0),
(31, 17, 9, 0, 0, 0, '1', 0),
(27, 10, 9, 0, 0, 0, '2', 0),
(34, 1, 9, 0, 0, 0, '4', 0),
(36, 2, 17, 0, 0, 0, '', 0),
(37, 18, 17, 0, 0, 0, '', 0),
(41, 16, 20, 0, 0, 0, '2', 0),
(40, 1, 20, 0, 0, 0, '4', 0),
(42, 16, 9, 0, 0, 0, '1', 0),
(43, 18, 9, 0, 0, 0, '5', 0),
(44, 2, 21, 0, 0, 0, '4', 0),
(45, 17, 21, 0, 0, 0, '1', 0),
(46, 1, 21, 0, 0, 0, '5', 0),
(47, 10, 22, 0, 0, 0, '5', 0),
(48, 1, 22, 0, 0, 0, '5', 0),
(49, 2, 22, 0, 0, 0, '2', 0),
(50, 17, 22, 0, 0, 0, '1', 0),
(51, 16, 22, 0, 0, 0, '4', 0),
(52, 18, 22, 0, 0, 0, '2', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `avatar` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `nickname`, `avatar`) VALUES
(1, 'Gilles', '2eedd3b873e72e36b00e3512911868a0', 'Gilles', 'chopper.jpg'),
(2, 'Ruffy', '2eedd3b873e72e36b00e3512911868a0', 'Ruffy', 'ruffy.jpg'),
(10, 'Wurst', '2eedd3b873e72e36b00e3512911868a0', 'Wursti', 'default.jpg'),
(16, 'John', '2eedd3b873e72e36b00e3512911868a0', 'Johnny', 'Johnny.jpg'),
(17, 'Hans', '2eedd3b873e72e36b00e3512911868a0', 'Wurst', 'Wurst.jpg'),
(18, 'Maurice', 'dd099c2f017f990e68f5c90a413abc5d', 'Flitzerice', 'Flitzerice.png'),
(20, 'Test', '098f6bcd4621d373cade4e832627b4f6', 'Tester', 'default.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





ALTER TABLE  `user` ADD  `roleid` INT( 2 ) NOT NULL