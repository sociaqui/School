-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 02 Kwi 2016, 13:21
-- Wersja serwera: 5.5.44-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `test2`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Classes`
--

CREATE TABLE IF NOT EXISTS `Classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_id` (`teacher_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=10 ;

--
-- Zrzut danych tabeli `Classes`
--

INSERT INTO `Classes` (`id`, `teacher_id`, `name`, `description`) VALUES
(1, 1, 'Biologia', 'Inne zajÄ™cia teÅ¼ z biologii'),
(2, 1, 'Biologia', 'ZajÄ™cia z biologii'),
(4, 1, 'Matematyka', 'ZajÄ™cia z matematyki'),
(5, 1, 'Fizyka', 'ZajÄ™cia z fizyki'),
(6, 1, 'Astronomia', 'nauka Kopernika'),
(7, 1, 'Algebra', 'ooooo Cyferka!');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Marks`
--

CREATE TABLE IF NOT EXISTS `Marks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `mark` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=7 ;

--
-- Zrzut danych tabeli `Students`
--

INSERT INTO `Students` (`id`, `name`, `surname`, `birth_date`) VALUES
(1, 'Bogdan', 'Zmieniony', '1986-05-05'),
(2, 'Alec', 'Baldwin', '1999-04-25'),
(5, 'Adam', 'Spadam', '1986-05-05'),
(6, 'Maniek', 'Kaniek', '1988-07-27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `students_classes`
--

CREATE TABLE IF NOT EXISTS `students_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=12 ;

--
-- Zrzut danych tabeli `students_classes`
--

INSERT INTO `students_classes` (`id`, `student_id`, `class_id`) VALUES
(1, 1, 1),
(2, 5, 1),
(3, 6, 4),
(6, 1, 6),
(8, 1, 5),
(11, 6, 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Teachers`
--

CREATE TABLE IF NOT EXISTS `Teachers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_polish_ci DEFAULT NULL,
  `wage_per_hour` float(5,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci AUTO_INCREMENT=5 ;

--
-- Zrzut danych tabeli `Teachers`
--

INSERT INTO `Teachers` (`id`, `name`, `surname`, `wage_per_hour`) VALUES
(1, 'Zgred', 'Nudny', 55.00),
(2, 'Alfred', 'Papla', 47.00),
(3, 'Dawid', 'Usypiacz', 51.00);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Classes`
--
ALTER TABLE `Classes`
  ADD CONSTRAINT `Classes_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `Teachers` (`id`);

--
-- Ograniczenia dla tabeli `Marks`
--
ALTER TABLE `Marks`
  ADD CONSTRAINT `Marks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Students` (`id`),
  ADD CONSTRAINT `Marks_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `Classes` (`id`);

--
-- Ograniczenia dla tabeli `students_classes`
--
ALTER TABLE `students_classes`
  ADD CONSTRAINT `students_classes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `Students` (`id`),
  ADD CONSTRAINT `students_classes_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `Classes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
