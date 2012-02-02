-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 02. Feb 2012 um 01:01
-- Server Version: 5.5.16
-- PHP-Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fifa`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `config`
--

INSERT INTO `config` (`id`, `name`, `value`) VALUES
(1, 'delete_role', '3');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teams`
--

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

CREATE TABLE IF NOT EXISTS `tourn` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `status` varchar(50) NOT NULL,
  `winnerid` int(5) NOT NULL,
  `autorid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Daten für Tabelle `tourn`
--

INSERT INTO `tourn` (`id`, `name`, `status`, `winnerid`, `autorid`) VALUES
(21, 'Encarnium Turnier', 'open', 0, 1),
(17, 'Das Super Turnier', 'open', 0, 18),
(26, 'Gilles2', 'open', 0, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tourngame`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tournplayer`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Daten für Tabelle `tournplayer`
--

INSERT INTO `tournplayer` (`id`, `playerid`, `tournid`, `wins`, `loss`, `ties`, `team`, `points`) VALUES
(35, 1, 17, 0, 0, 0, '', 0),
(36, 2, 17, 0, 0, 0, '', 0),
(37, 18, 17, 0, 0, 0, '', 0),
(44, 2, 21, 0, 0, 0, '4', 0),
(45, 17, 21, 0, 0, 0, '1', 0),
(46, 1, 21, 0, 0, 0, '5', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nickname` varchar(50) NOT NULL,
  `avatar` text NOT NULL,
  `roleid` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `nickname`, `avatar`, `roleid`) VALUES
(1, 'Gilles', '2eedd3b873e72e36b00e3512911868a0', 'Gilles', 'chopper.jpg', 3),
(2, 'Ruffy', '2eedd3b873e72e36b00e3512911868a0', 'Ruffy', 'ruffy.jpg', 0),
(10, 'Wurst', '2eedd3b873e72e36b00e3512911868a0', 'Wursti', 'default.jpg', 0),
(16, 'John', '2eedd3b873e72e36b00e3512911868a0', 'Johnny', 'Johnny.jpg', 0),
(17, 'Hans', '2eedd3b873e72e36b00e3512911868a0', 'Wurst', 'Wurst.jpg', 0),
(18, 'Maurice', 'dd099c2f017f990e68f5c90a413abc5d', 'Flitzerice', 'Flitzerice.png', 0),
(20, 'Test', '098f6bcd4621d373cade4e832627b4f6', 'Tester', 'default.jpg', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
