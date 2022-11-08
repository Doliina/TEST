-- phpMyAdmin SQL Dump
-- version 5.1.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql-devwwm.alwaysdata.net
-- Generation Time: Nov 04, 2022 at 04:04 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devwwm_api`
--
CREATE DATABASE IF NOT EXISTS `devwwm_api` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `devwwm_api`;

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `code_formation` varchar(30) NOT NULL,
  `nom_formation` varchar(100) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `code_filiere_formation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONSHIPS FOR TABLE `formation`:
--

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`code_formation`, `nom_formation`, `date_debut`, `date_fin`, `code_filiere_formation`) VALUES
('aeb', 'Agent de maintenance du bâtiment', '2023-01-01', '2023-08-31', 3),
('d2wm', 'Développeur web et web mobile', '2022-03-27', '2022-11-25', 1),
('sca11606', 'Scaphandrier travaux publics', '2023-01-09', '2023-06-08', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `code_stgr` int(11) NOT NULL,
  `nom_stgr` varchar(30) NOT NULL,
  `prenom_stgr` varchar(30) NOT NULL,
  `date_naissance_stgr` date NOT NULL,
  `tel_fixe_stgr` varchar(30) DEFAULT NULL,
  `tel_portable_stgr` varchar(30) DEFAULT NULL,
  `email_stgr` varchar(30) NOT NULL,
  `code_formation_stgr` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- RELATIONSHIPS FOR TABLE `stagiaire`:
--

--
-- Dumping data for table `stagiaire`
--

INSERT INTO `stagiaire` (`code_stgr`, `nom_stgr`, `prenom_stgr`, `date_naissance_stgr`, `tel_fixe_stgr`, `tel_portable_stgr`, `email_stgr`, `code_formation_stgr`) VALUES
(12037861, 'Alibaud', 'David', '1985-02-02', '', '06.82.22.56.55', 'd.alibaud@dwwm.com', 'd2wm'),
(22015185, 'Margaryan', 'Arman', '1991-10-08', NULL, '06.28.02.03.04', 'a.margaryan@dwwm.com', 'd2wm'),
(22024201, 'Prillaud', 'Jean-Noël', '1998-09-02', '01.49.49.49.49', '07.00.11.22.33', 'jn.prillaud@dwwm.com', 'd2wm'),
(22024217, 'Niro', 'Jérémy', '1987-12-24', NULL, '06.01.02.03.04', 'j.niro@dwwm.com', 'd2wm'),
(22024226, 'Duprat', 'Matthieu', '1972-07-03', NULL, '06.82.22.56.55', 'm.duprat@dwwm.com', 'd2wm'),
(22024240, 'Niggel', 'Louis', '2001-08-21', '05.49.11.22.33', '07.36.48.24.12', 'l.niggel@dwwm.com', 'd2wm'),
(22024265, 'Larivière', 'Ophely', '1994-07-07', NULL, '06.12.21.12.21', 'o.lariviere@dwwm.com', 'd2wm'),
(22024271, 'Firmino', 'Jonathan', '1994-11-24', '05.49.49.45.49', '06.21.21.21.21', 'j.firmino@dwwm.com', 'd2wm'),
(22024287, 'Oury', 'Sylvie', '1979-05-31', '04.56.11.22.44', '06.12.342.56.78', 's.oury@dwwm.com', 'd2wm'),
(22024302, 'Métais', 'Florentin', '2001-02-01', '05.09.09.05.09', '06.01.01.01.01', 'f.metais@dwwm.com', 'd2wm'),
(22024751, 'Kwasie', 'Artwin', '2002-01-01', NULL, '07.36.95.66.23', 'a.kwasie@dwwm.com', 'd2wm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
