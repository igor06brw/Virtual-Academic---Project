-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Mar 2016, 21:41
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
-- Struktura tabeli dla tabeli `nf_activities`
--

CREATE TABLE IF NOT EXISTS `nf_activities` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject_type` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `date_start` datetime NOT NULL,
  `date_stop` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_activities`
--

INSERT INTO `nf_activities` (`id`, `subject_id`, `subject_type`, `teacher_id`, `location_id`, `group_id`, `date_start`, `date_stop`, `status`) VALUES
(1, 12, 1, 5, 1, 1, '2016-03-04 12:00:00', '2016-03-04 18:00:00', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_activities_groups`
--

CREATE TABLE IF NOT EXISTS `nf_activities_groups` (
  `id` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `direction` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_activities_groups`
--

INSERT INTO `nf_activities_groups` (`id`, `sem`, `direction`, `name`) VALUES
(1, 3, 1, 'GĆW01-1a, 1b');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_activities_types`
--

CREATE TABLE IF NOT EXISTS `nf_activities_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_activities_types`
--

INSERT INTO `nf_activities_types` (`id`, `type`) VALUES
(1, 'Ćwiczenia'),
(2, 'Lektorat'),
(3, 'Laboratorium'),
(4, 'Wykład'),
(5, 'Praktyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_directions`
--

CREATE TABLE IF NOT EXISTS `nf_directions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_directions`
--

INSERT INTO `nf_directions` (`id`, `name`) VALUES
(1, 'Informatyka');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_locations`
--

CREATE TABLE IF NOT EXISTS `nf_locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_locations`
--

INSERT INTO `nf_locations` (`id`, `name`) VALUES
(1, '335'),
(2, '412 AUD');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_menu`
--

INSERT INTO `nf_menu` (`id`, `controller`, `name`, `icon`, `sort`, `is_page`, `parent_id`) VALUES
(1, 'dashboard', 'Twój panel', 'icon-home', 1, 1, NULL),
(2, 'scheduler', 'Plan zajęć', NULL, 2, 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_menu_permission`
--

CREATE TABLE IF NOT EXISTS `nf_menu_permission` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_menu_permission`
--

INSERT INTO `nf_menu_permission` (`id`, `menu_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_subjects`
--

CREATE TABLE IF NOT EXISTS `nf_subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_subjects`
--

INSERT INTO `nf_subjects` (`id`, `name`) VALUES
(1, 'Język angielski'),
(2, 'Sieci komputerowe'),
(3, 'Zasady realizacji projektów'),
(4, 'Współczesne społeczeństwo polskie'),
(5, 'Podstawy elektrotechniki i elektroniki'),
(6, 'Fizyka'),
(7, 'Algorytmy i struktury danych'),
(8, 'Inżynieria oprogramowania'),
(9, 'Sieci komputerowe'),
(10, 'Bazy danych'),
(11, 'Grafika komputerowa i multimedia'),
(12, 'Programowanie obiektowe'),
(13, 'Realizacja przedsięwzięcia projektowego');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_users`
--

CREATE TABLE IF NOT EXISTS `nf_users` (
  `user_id` int(11) NOT NULL,
  `user_group_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `email` varchar(96) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_users`
--

INSERT INTO `nf_users` (`user_id`, `user_group_id`, `username`, `firstname`, `lastname`, `email`, `password`, `status`) VALUES
(3, 1, 'admin', 'John', 'Smith', 'mr@netforge.pl', '8b234d4a64fe7fa3cbc4833a01d073421683ec4f438eb7a4fac48e26b6b946de3dbad71a1d4a37f108d43dda3416bdf32e85daae8bdd9ff18368ce47bf1127d1j85o8M87PJVhSDhliCrQp1sorhZjHMTX0CVInNnEoxg=', 1),
(4, 1, 'rdeja', 'Rafał', 'Deja', 'rdeja@deja.pl', '8b234d4a64fe7fa3cbc4833a01d073421683ec4f438eb7a4fac48e26b6b946de3dbad71a1d4a37f108d43dda3416bdf32e85daae8bdd9ff18368ce47bf1127d1j85o8M87PJVhSDhliCrQp1sorhZjHMTX0CVInNnEoxg=', 1),
(5, 3, 'mwarski', 'Michał', 'Warski', 'mwarski@test.com', '8b234d4a64fe7fa3cbc4833a01d073421683ec4f438eb7a4fac48e26b6b946de3dbad71a1d4a37f108d43dda3416bdf32e85daae8bdd9ff18368ce47bf1127d1j85o8M87PJVhSDhliCrQp1sorhZjHMTX0CVInNnEoxg=', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_users_groups`
--

CREATE TABLE IF NOT EXISTS `nf_users_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_users_groups`
--

INSERT INTO `nf_users_groups` (`id`, `name`, `icon`) VALUES
(1, 'Administrator', 'icon-user'),
(2, 'Prowadzący', ''),
(3, 'Student', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_users_students_data`
--

CREATE TABLE IF NOT EXISTS `nf_users_students_data` (
  `student_id` int(11) NOT NULL,
  `sem` int(11) NOT NULL,
  `direction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_users_students_data`
--

INSERT INTO `nf_users_students_data` (`student_id`, `sem`, `direction`) VALUES
(5, 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nf_users_teachers_data`
--

CREATE TABLE IF NOT EXISTS `nf_users_teachers_data` (
  `id_teacher` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `nf_users_teachers_data`
--

INSERT INTO `nf_users_teachers_data` (`id_teacher`, `title`) VALUES
(4, 'dr.inż');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `nf_activities`
--
ALTER TABLE `nf_activities`
  ADD PRIMARY KEY (`id`), ADD KEY `subject_id` (`subject_id`), ADD KEY `subject_type` (`subject_type`), ADD KEY `teacher_id` (`teacher_id`), ADD KEY `location_id` (`location_id`), ADD KEY `group_id` (`group_id`), ADD KEY `group_id_2` (`group_id`);

--
-- Indexes for table `nf_activities_groups`
--
ALTER TABLE `nf_activities_groups`
  ADD PRIMARY KEY (`id`), ADD KEY `direction` (`direction`);

--
-- Indexes for table `nf_activities_types`
--
ALTER TABLE `nf_activities_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nf_directions`
--
ALTER TABLE `nf_directions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nf_locations`
--
ALTER TABLE `nf_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nf_menu`
--
ALTER TABLE `nf_menu`
  ADD PRIMARY KEY (`id`), ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `nf_menu_permission`
--
ALTER TABLE `nf_menu_permission`
  ADD PRIMARY KEY (`id`), ADD KEY `menu_id` (`menu_id`), ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `nf_subjects`
--
ALTER TABLE `nf_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nf_users`
--
ALTER TABLE `nf_users`
  ADD PRIMARY KEY (`user_id`), ADD KEY `employee_group_id` (`user_group_id`);

--
-- Indexes for table `nf_users_groups`
--
ALTER TABLE `nf_users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nf_users_students_data`
--
ALTER TABLE `nf_users_students_data`
  ADD PRIMARY KEY (`student_id`), ADD KEY `direction` (`direction`);

--
-- Indexes for table `nf_users_teachers_data`
--
ALTER TABLE `nf_users_teachers_data`
  ADD PRIMARY KEY (`id_teacher`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `nf_activities`
--
ALTER TABLE `nf_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `nf_activities_groups`
--
ALTER TABLE `nf_activities_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `nf_activities_types`
--
ALTER TABLE `nf_activities_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `nf_directions`
--
ALTER TABLE `nf_directions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `nf_locations`
--
ALTER TABLE `nf_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `nf_menu`
--
ALTER TABLE `nf_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `nf_menu_permission`
--
ALTER TABLE `nf_menu_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `nf_subjects`
--
ALTER TABLE `nf_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT dla tabeli `nf_users`
--
ALTER TABLE `nf_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT dla tabeli `nf_users_groups`
--
ALTER TABLE `nf_users_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `nf_activities`
--
ALTER TABLE `nf_activities`
ADD CONSTRAINT `nf_activities_1` FOREIGN KEY (`subject_id`) REFERENCES `nf_subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nf_activities_2` FOREIGN KEY (`subject_type`) REFERENCES `nf_activities_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nf_activities_3` FOREIGN KEY (`teacher_id`) REFERENCES `nf_users` (`user_id`),
ADD CONSTRAINT `nf_activities_4` FOREIGN KEY (`location_id`) REFERENCES `nf_locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nf_activities_5` FOREIGN KEY (`group_id`) REFERENCES `nf_activities_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nf_activities_groups`
--
ALTER TABLE `nf_activities_groups`
ADD CONSTRAINT `nf_activities_groups_1` FOREIGN KEY (`direction`) REFERENCES `nf_directions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nf_menu_permission`
--
ALTER TABLE `nf_menu_permission`
ADD CONSTRAINT `nf_menu_permission_1` FOREIGN KEY (`menu_id`) REFERENCES `nf_menu` (`id`),
ADD CONSTRAINT `nf_menu_permission_2` FOREIGN KEY (`group_id`) REFERENCES `nf_users_groups` (`id`);

--
-- Ograniczenia dla tabeli `nf_users`
--
ALTER TABLE `nf_users`
ADD CONSTRAINT `nf_users_1` FOREIGN KEY (`user_group_id`) REFERENCES `nf_users_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nf_users_students_data`
--
ALTER TABLE `nf_users_students_data`
ADD CONSTRAINT `nf_users_students_data_1` FOREIGN KEY (`student_id`) REFERENCES `nf_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `nf_users_students_data_2` FOREIGN KEY (`direction`) REFERENCES `nf_directions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nf_users_teachers_data`
--
ALTER TABLE `nf_users_teachers_data`
ADD CONSTRAINT `nf_users_teachers_data_1` FOREIGN KEY (`id_teacher`) REFERENCES `nf_users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
