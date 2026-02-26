-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 25 feb 2026 om 15:42
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
-- Tabelstructuur voor tabel `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `recipe_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `ingredient`
--

INSERT INTO `ingredient` (`id`, `recipe_id`, `product_id`, `quantity`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 320),
(3, 1, 3, 30),
(4, 1, 4, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `kitchentype`
--

CREATE TABLE `kitchentype` (
  `id` int(11) NOT NULL,
  `record_type` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `kitchentype`
--

INSERT INTO `kitchentype` (`id`, `record_type`, `description`) VALUES
(1, 'K', 'American'),
(2, 'K', 'Italian'),
(3, 'K', 'Asian'),
(4, 'K', 'French'),
(5, 'T', 'Vegan'),
(6, 'T', 'Vegetarian'),
(7, 'T', 'Fish'),
(8, 'T', 'Meat');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `packaging` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `unit`, `packaging`) VALUES
(1, 'Vegan Burger Bun', 'Description Vegan Burger Bun', 7, 'pieces', 'paper bag'),
(2, 'Vegan Burger', 'Description Vegan Burger', 7, 'gram', 'paper bag'),
(3, 'Vegan Burger Sauce', 'Description Vegan Burger Sauce', 7, 'ml', 'bottle'),
(4, 'Avocado', 'Description Avocado', 7, 'pieces', 'no packaging');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `recipe`
--

CREATE TABLE `recipe` (
  `id` int(11) NOT NULL,
  `kitchen_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `titel` varchar(20) NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `recipe`
--

INSERT INTO `recipe` (`id`, `kitchen_id`, `type_id`, `user_id`, `date`, `titel`, `short_description`, `long_description`, `image`) VALUES
(1, 1, 5, 0, '0000-00-00', 'Vegan Burger', 'Description Vegan Burger', 'Long description Vegan Burger', ''),
(2, 4, 6, 0, '0000-00-00', 'Eggs & Veggies', 'Description Eggs & Veggies', 'Long description of Eggs & Veggies', ''),
(3, 3, 7, 0, '0000-00-00', 'Sushi Rolls', 'Description Sushi Rolls', 'Long description Sushi Rolls', ''),
(4, 2, 6, 0, '0000-00-00', 'Pizza Green', 'Description Pizza Green', 'Long description Pizza Green', '');

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `user_name`, `password`, `email`, `image`) VALUES
(1, 'Tommy Tuup', 'Tommytuup1', 'Tommytuup@gmail.com', ''),
(2, 'Bennie Blind', 'Bennieblind1', 'Bennieblind@gmail.com', ''),
(3, 'Sammy Suf', 'Sammysuf1', 'Sammysuf@gmail.com', ''),
(4, 'Katinka Cool', 'Katinkacool1', 'Katinkacool@gmail.com', '');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`),
  ADD KEY `ingredient_ibfk_1` (`product_id`);

--
-- Indexen voor tabel `kitchentype`
--
ALTER TABLE `kitchentype`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `recipe`
--
ALTER TABLE `recipe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `kitchen_id` (`kitchen_id`);

--
-- Indexen voor tabel `recipe_info`
--
ALTER TABLE `recipe_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `kitchentype`
--
ALTER TABLE `kitchentype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT voor een tabel `recipe`
--
ALTER TABLE `recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `recipe_info`
--
ALTER TABLE `recipe_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `ingredient_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`);

--
-- Beperkingen voor tabel `recipe`
--
ALTER TABLE `recipe`
  ADD CONSTRAINT `recipe_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `kitchentype` (`id`),
  ADD CONSTRAINT `recipe_ibfk_3` FOREIGN KEY (`kitchen_id`) REFERENCES `kitchentype` (`id`);

--
-- Beperkingen voor tabel `recipe_info`
--
ALTER TABLE `recipe_info`
  ADD CONSTRAINT `recipe_info_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
