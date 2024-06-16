-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 jun 2024 om 16:33
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bas_database`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `artId` int(11) NOT NULL,
  `artOmschrijving` varchar(50) NOT NULL,
  `artInkoop` decimal(5,2) DEFAULT NULL,
  `artVerkoop` decimal(5,2) DEFAULT NULL,
  `artVoorraad` int(11) NOT NULL,
  `artMinVoorraad` int(11) NOT NULL,
  `artMaxVoorraad` int(11) NOT NULL,
  `artLocatie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `artikel`
--

INSERT INTO `artikel` (`artId`, `artOmschrijving`, `artInkoop`, `artVerkoop`, `artVoorraad`, `artMinVoorraad`, `artMaxVoorraad`, `artLocatie`) VALUES
(1, 'Bakje Yoghurt', 1.19, 2.39, 300, 10, 600, 1),
(2, 'Sinaasappelsap', 2.99, 5.49, 150, 5, 300, 2),
(3, 'Mueslireep', 0.89, 1.79, 400, 20, 800, 3),
(4, 'Kaasplankje', 4.29, 8.59, 100, 15, 200, 4),
(5, 'Brood', 1.49, 2.99, 250, 10, 500, 5),
(6, 'Appel', 0.59, 1.19, 500, 25, 1000, 6),
(7, 'Melk', 1.09, 2.19, 350, 30, 700, 7),
(8, 'Wortels', 0.99, 1.99, 600, 40, 1200, 8);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `inkoop`
--

CREATE TABLE `inkoop` (
  `inkOrdId` int(11) NOT NULL,
  `levId` int(11) DEFAULT NULL,
  `artId` int(11) DEFAULT NULL,
  `inkOrdDatum` date DEFAULT NULL,
  `inkOrdBestAantal` int(11) DEFAULT NULL,
  `inkOrdStatus` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `inkoop`
--

INSERT INTO `inkoop` (`inkOrdId`, `levId`, `artId`, `inkOrdDatum`, `inkOrdBestAantal`, `inkOrdStatus`) VALUES
(1, 1, 2, '2024-05-14', 50, 0),
(2, 2, 3, '2024-05-14', 25, 1),
(3, 3, 1, '2024-05-14', 30, 1),
(4, 4, 2, '2024-05-14', 50, 1),
(5, 3, 2, '2024-05-14', 50, 0),
(6, 4, 4, '2024-05-14', 30, 0),
(7, 1, 2, '2024-05-14', 25, 0),
(8, 2, 3, '2024-05-14', 50, 1),
(9, 1, 4, '2024-05-14', 50, 0),
(10, 3, 1, '2024-05-14', 25, 1),
(11, 1, 1, '2024-06-03', 5, 1),
(12, 1, 1, '2024-06-15', 5, 1),
(13, 1, 1, '2024-06-23', 5, 1),
(14, 1, 1, '2024-06-23', 5, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `klantId` int(11) NOT NULL,
  `klantNaam` varchar(50) NOT NULL,
  `klantEmail` varchar(50) NOT NULL,
  `klantAdres` varchar(50) NOT NULL,
  `klantPostcode` varchar(6) DEFAULT NULL,
  `klantWoonplaats` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`klantId`, `klantNaam`, `klantEmail`, `klantAdres`, `klantPostcode`, `klantWoonplaats`) VALUES
(1, 'Peter van Dijk', 'peter.dijk1@example.com', 'Parklaan 12', '1234AB', 'Groningen'),
(2, 'Sophie Vermeulen', 'sophie.vermeulen@example.com', 'Breestraat 34', '5678CD', 'Maastricht'),
(3, 'Liam de Boer', 'liam.boer@example.com', 'Zeeweg 56', '9012EF', 'Leiden'),
(4, 'Noah Bakker', 'noah.bakker@example.com', 'Dijkstraat 78', '3456GH', 'Arnhem'),
(5, 'Emma Visser', 'emma.visser@example.com', 'Boslaan 90', '7890IJ', 'Zwolle');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leveranciers`
--

CREATE TABLE `leveranciers` (
  `levId` int(11) NOT NULL,
  `levNaam` varchar(50) NOT NULL,
  `levContact` varchar(50) DEFAULT NULL,
  `levEmail` varchar(50) NOT NULL,
  `levAdres` varchar(50) DEFAULT NULL,
  `levPostcode` varchar(6) DEFAULT NULL,
  `levWoonplaats` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leveranciers`
--

INSERT INTO `leveranciers` (`levId`, `levNaam`, `levContact`, `levEmail`, `levAdres`, `levPostcode`, `levWoonplaats`) VALUES
(1, 'FoodSupplier', 'Karel Janssen', 'karel.janssen@foodsupplier.com', 'Industrieweg 10', '1234AB', 'Rotterdam'),
(2, 'FreshFruits', 'Marie de Wit', 'marie.dewit@freshfruits.com', 'Laan van West 23', '5678CD', 'Amsterdam'),
(3, 'GreenGrocers', 'Pieter Groen', 'pieter.groen@greengrocers.com', 'Natuurstraat 45', '9012EF', 'Utrecht'),
(4, 'DairyDelight', 'Anna Veenstra', 'anna.veenstra@dairydelight.com', 'Melkweg 67', '3456GH', 'Den Haag');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkoop`
--

CREATE TABLE `verkoop` (
  `verkOrdId` int(11) NOT NULL,
  `klantId` int(11) DEFAULT NULL,
  `artId` int(11) DEFAULT NULL,
  `verkOrdDatum` date DEFAULT NULL,
  `verkOrdBestAantal` int(11) DEFAULT NULL,
  `verkOrdStatus` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verkoop`
--

INSERT INTO `verkoop` (`verkOrdId`, `klantId`, `artId`, `verkOrdDatum`, `verkOrdBestAantal`, `verkOrdStatus`) VALUES
(1, 2, 1, '2024-05-31', 10, 1),
(2, 3, 4, '2024-05-14', 20, 1),
(3, 1, 3, '2024-05-14', 15, 1),
(4, 4, 5, '2024-05-14', 25, 1),
(5, 5, 6, '2024-05-14', 30, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `verkordstatus`
--

CREATE TABLE `verkordstatus` (
  `verkOrdStatusId` int(11) NOT NULL,
  `verkOrdStatus` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `verkordstatus`
--

INSERT INTO `verkordstatus` (`verkOrdStatusId`, `verkOrdStatus`) VALUES
(4, 'afgeleverd'),
(3, 'bij bezorger'),
(1, 'genoteerd'),
(2, 'verzamelt');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artId`);

--
-- Indexen voor tabel `inkoop`
--
ALTER TABLE `inkoop`
  ADD PRIMARY KEY (`inkOrdId`),
  ADD KEY `levId` (`levId`),
  ADD KEY `artId` (`artId`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`klantId`);

--
-- Indexen voor tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  ADD PRIMARY KEY (`levId`);

--
-- Indexen voor tabel `verkoop`
--
ALTER TABLE `verkoop`
  ADD PRIMARY KEY (`verkOrdId`),
  ADD KEY `klantId` (`klantId`),
  ADD KEY `artId` (`artId`);

--
-- Indexen voor tabel `verkordstatus`
--
ALTER TABLE `verkordstatus`
  ADD PRIMARY KEY (`verkOrdStatusId`),
  ADD KEY `verkOrdStatus` (`verkOrdStatus`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `inkoop`
--
ALTER TABLE `inkoop`
  MODIFY `inkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `klantId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT voor een tabel `leveranciers`
--
ALTER TABLE `leveranciers`
  MODIFY `levId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `verkoop`
--
ALTER TABLE `verkoop`
  MODIFY `verkOrdId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `inkoop`
--
ALTER TABLE `inkoop`
  ADD CONSTRAINT `inkoop_ibfk_1` FOREIGN KEY (`levId`) REFERENCES `leveranciers` (`levId`),
  ADD CONSTRAINT `inkoop_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikel` (`artId`);

--
-- Beperkingen voor tabel `verkoop`
--
ALTER TABLE `verkoop`
  ADD CONSTRAINT `verkoop_ibfk_1` FOREIGN KEY (`klantId`) REFERENCES `klant` (`klantId`),
  ADD CONSTRAINT `verkoop_ibfk_2` FOREIGN KEY (`artId`) REFERENCES `artikel` (`artId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
