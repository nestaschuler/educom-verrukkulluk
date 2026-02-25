-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 25 feb 2026 om 15:30
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `verrukkulluk`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipe_info`
--

CREATE TABLE `recipe_info` (
  `id` int(11) NOT NULL,
  `record_type` varchar(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `numeric_field` int(11) NOT NULL,
  `text_field` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `recipe_info`
--

INSERT INTO `recipe_info` (`id`, `record_type`, `recipe_id`, `user_id`, `date`, `numeric_field`, `text_field`) VALUES
(1, 'P', 1, 0, '2026-02-25', 1, 'Description step '),
(2, 'P', 1, 0, '2026-02-25', 2, 'Description step '),
(3, 'P', 1, 0, '2026-02-25', 3, 'Description step '),
(4, 'P', 1, 0, '2026-02-25', 4, 'Description step '),
(5, 'C', 1, 1, '2026-02-25', 0, 'Comment '),
(6, 'C', 1, 2, '2026-02-25', 0, 'Comment '),
(7, 'C', 1, 3, '2026-02-25', 0, 'Comment '),
(8, 'C', 1, 4, '2026-02-25', 0, 'Comment '),
(9, 'R', 1, 0, '2026-02-25', 1, 'stars'),
(10, 'R', 1, 0, '2026-02-25', 2, 'stars'),
(11, 'R', 1, 0, '2026-02-25', 3, 'stars'),
(12, 'R', 1, 0, '2026-02-25', 4, 'stars'),
(13, 'R', 1, 0, '2026-02-25', 5, 'stars'),
(14, 'F', 1, 1, '2026-02-25', 0, 'Favorite: yes/no'),
(15, 'F', 1, 2, '2026-02-25', 0, 'Favorite: yes/no'),
(16, 'F', 1, 3, '2026-02-25', 0, 'Favorite: yes/no'),
(17, 'F', 1, 4, '2026-02-25', 0, 'Favorite: yes/no');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `recipe_info`
--
ALTER TABLE `recipe_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `recipe_info`
--
ALTER TABLE `recipe_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `recipe_info`
--
ALTER TABLE `recipe_info`
  ADD CONSTRAINT `recipe_info_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
