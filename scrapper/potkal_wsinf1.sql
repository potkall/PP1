-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 13 Cze 2020, 00:54
-- Wersja serwera: 10.4.7-MariaDB
-- Wersja PHP: 7.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `potkal_wsinf1`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pp_otomoto`
--

CREATE TABLE `pp_otomoto` (
  `id` varchar(36) NOT NULL,
  `otomotoid` bigint(20) DEFAULT NULL,
  `otomotolink` varchar(2048) NOT NULL,
  `marka` varchar(128) NOT NULL,
  `nazwa_krotka` varchar(256) NOT NULL,
  `opis` varchar(1024) NOT NULL,
  `rocznik` int(4) NOT NULL,
  `przebieg` int(11) NOT NULL,
  `pojemnosc` int(11) NOT NULL,
  `paliwo` varchar(32) NOT NULL,
  `cena` int(8) NOT NULL,
  `waluta` varchar(3) NOT NULL,
  `miasto` varchar(96) NOT NULL,
  `wojewodztwo` varchar(96) NOT NULL,
  `insertdate` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pp_stats`
--

CREATE TABLE `pp_stats` (
  `id` int(11) NOT NULL,
  `counter` int(11) NOT NULL,
  `countername` varchar(50) DEFAULT NULL,
  `adddate` timestamp(3) NOT NULL DEFAULT current_timestamp(3) ON UPDATE current_timestamp(3),
  `countertype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `pp_otomoto`
--
ALTER TABLE `pp_otomoto`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indeksy dla tabeli `pp_stats`
--
ALTER TABLE `pp_stats`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `pp_stats`
--
ALTER TABLE `pp_stats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
