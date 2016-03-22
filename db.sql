-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Mar 2016, 20:10
-- Wersja serwera: 5.6.24
-- Wersja PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `admin_projectx`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_menu`
--

CREATE TABLE IF NOT EXISTS `nf_menu` (
  `id` int(11) NOT NULL,
  `controller` varchar(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(20) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `is_page` tinyint(4) NOT NULL DEFAULT '1',
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_menu`
--

INSERT INTO `nf_menu` (`id`, `controller`, `name`, `icon`, `sort`, `is_page`, `parent_id`) VALUES
(1, 'dashboard', 'Dashboard', 'icon-home', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_users`
--

CREATE TABLE IF NOT EXISTS `nf_users` (
  `employee_id` int(11) NOT NULL,
  `employee_group_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_users`
--

INSERT INTO `nf_users` (`employee_id`, `employee_group_id`, `username`, `firstname`, `lastname`, `email`, `password`, `status`) VALUES
(3, 1, 'admin', 'John', 'Smith', 'mr@netforge.pl', '8b234d4a64fe7fa3cbc4833a01d073421683ec4f438eb7a4fac48e26b6b946de3dbad71a1d4a37f108d43dda3416bdf32e85daae8bdd9ff18368ce47bf1127d1j85o8M87PJVhSDhliCrQp1sorhZjHMTX0CVInNnEoxg=', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_users_groups`
--

CREATE TABLE IF NOT EXISTS `nf_users_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_users_groups`
--

INSERT INTO `nf_users_groups` (`id`, `name`, `color`) VALUES
(1, 'Administratorzy', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `nf_menu`
--
ALTER TABLE `nf_menu`
  ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `nf_users`
--
ALTER TABLE `nf_users`
  ADD PRIMARY KEY (`employee_id`), ADD KEY `employee_group_id` (`employee_group_id`);

--
-- Indexes for table `nf_users_groups`
--
ALTER TABLE `nf_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `nf_menu`
--
ALTER TABLE `nf_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `nf_users`
--
ALTER TABLE `nf_users`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `nf_users_groups`
--
ALTER TABLE `nf_users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `nf_users`
--
ALTER TABLE `nf_users`
ADD CONSTRAINT `nf_users_1` FOREIGN KEY (`employee_group_id`) REFERENCES `nf_users_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
