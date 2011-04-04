-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 01. April 2011 um 15:29
-- Server Version: 5.1.41
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `tournament`
--

-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `fifamanager`;
use `fifamanager`;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `tourn`
--

INSERT INTO `tourn` (`id`, `name`, `status`, `winnerid`, `autorid`) VALUES
(1, 'Turnier1', 'open', 0, 1),
(7, 'Turnier Super', 'open', 0, 1),
(6, 'Turnier2', 'open', 0, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `tourngame`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tournplayer`
--

CREATE TABLE IF NOT EXISTS `tournplayer` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `playerid` int(5) NOT NULL,
  `tournid` int(5) NOT NULL,
  `wins` int(3) NOT NULL,
  `loss` int(3) NOT NULL,
  `ties` int(3) NOT NULL,
  `team` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `tournplayer`
--


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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `nickname`, `avatar`) VALUES
(1, 'Gilles', '2eedd3b873e72e36b00e3512911868a0', 'Gilles', 'chopper.jpg'),
(2, 'Ruffy', '2eedd3b873e72e36b00e3512911868a0', 'Ruffy', 'ruffy.jpg'),
(10, 'Wurst', '2eedd3b873e72e36b00e3512911868a0', 'Wursti', 'default.jpg'),
(16, 'John', '2eedd3b873e72e36b00e3512911868a0', 'Johnny', 'Johnny.jpg'),
(17, 'Hans', '2eedd3b873e72e36b00e3512911868a0', 'Wurst', 'Wurst.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
