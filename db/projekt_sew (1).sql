-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 16. Mrz 2019 um 17:11
-- Server-Version: 10.1.26-MariaDB-0+deb9u1
-- PHP-Version: 7.0.33-0+deb9u3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `projekt_sew`
--
CREATE DATABASE IF NOT EXISTS `projekt_sew` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projekt_sew`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `prefix` varchar(100) DEFAULT NULL,
  `token` text NOT NULL,
  `name` text,
  `price` varchar(100) DEFAULT '',
  `isscanned` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` (`id`, `prefix`, `token`, `name`, `price`, `isscanned`) VALUES
(1, 'EAN_8', '54491472', 'Coca- Cola 0,5l ', '', 1),
(2, 'EAN_13', '4006341207012', 'REV- Ritter QSL 3- fach 3 m ', '', 1),
(3, 'EAN_8', '42332855', 'Beiersdorf AG NIVEA MEN Ultimate Protect Stick Anti- Transpirant, 40 ml', '', 1),
(7, 'EAN_13', '9015160100294', 'Almdudler Original 1L', '', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
