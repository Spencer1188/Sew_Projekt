-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 23. Mrz 2019 um 11:30
-- Server-Version: 10.1.35-MariaDB
-- PHP-Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `projekt_sew`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL,
  `prefix` varchar(100) DEFAULT NULL,
  `token` text NOT NULL,
  `name` text,
  `price` varchar(100) DEFAULT '',
  `isscanned` tinyint(1) NOT NULL DEFAULT '1',
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `items`
--

INSERT INTO `items` (`id`, `usr_id`, `prefix`, `token`, `name`, `price`, `isscanned`, `date`) VALUES
(1, 1, 'EAN_8', '54491472', 'Coca- Cola 0,5l ', '', 1, '20032019'),
(2, 1, 'EAN_13', '4006341207012', 'REV- Ritter QSL 3- fach 3 m ', '', 1, '20032019'),
(3, 0, 'EAN_8', '42332855', 'Beiersdorf AG NIVEA MEN Ultimate Protect Stick Anti- Transpirant, 40 ml', '', 1, '20032019'),
(7, 0, 'EAN_13', '9015160100294', 'Almdudler Original 1L', '', 1, '21032019'),
(17, 0, 'EAN_13', '9009504000364', 'Kinderstrumpfhose ', '', 1, '20032019'),
(18, 0, 'EAN_13', '4009900426039', 'Airwaves Menthol And Eucalyptus Gum Bottle 46 Pieces', '', 1, '20032019'),
(19, 0, 'EAN_8', '54491472', 'Coca- Cola 0,5l', '', 1, '21032019'),
(20, 0, 'EAN_13', '4019313000276', 'Frucade', '', 1, '22032019'),
(21, 0, 'EAN_8', '90020865', 'Test Fl', '', 1, '22032019'),
(22, 0, 'EAN_13', '4019313000276', 'Frucade', '', 1, '22032019'),
(23, 1, 'EAN_13', '4019313000276', 'Frucade', '', 1, '22032019'),
(24, 0, 'EAN_13', '4019313000276', 'Frucade', '', 1, '22032019'),
(25, 0, 'EAN_13', '4019313000276', 'Frucade', '', 1, '22032019');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `usr_id` int(11) NOT NULL,
  `password` text NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`usr_id`, `password`, `mail`) VALUES
(0, 'c13d35852f6c00caf2ab27f605b4f1a65ddaf979c56a999aa0c7dede8f07e126', 'max@a.a');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
