-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Ven 07 Février 2014 à 00:47
-- Version du serveur: 5.5.32
-- Version de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `quizzooo_api`
--
CREATE DATABASE IF NOT EXISTS `quizzooo_api` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `quizzooo_api`;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quizz_id` int(11) NOT NULL,
  `question` text,
  `answer` varchar(255) DEFAULT NULL,
  `background_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `question`
--

INSERT INTO `question` (`id`, `quizz_id`, `question`, `answer`, `background_id`) VALUES
(1, 32, 'qzdzqadq', 'zdqd', 1),
(2, 32, 'zqdzqd', 'zdza', 1),
(3, 32, 'qzdqzd', 'zqdzqd', 1),
(4, 32, 'zqdqz', 'qzdqzdzq', 1),
(5, 32, 'qzdqzd', 'qzdqzdqzd', 1);

-- --------------------------------------------------------

--
-- Structure de la table `quizz`
--

CREATE TABLE IF NOT EXISTS `quizz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `quizz`
--

INSERT INTO `quizz` (`id`, `theme`, `name`) VALUES
(1, 1, 'Test'),
(2, 1, 'Test'),
(3, 1, 'Test'),
(4, 1, 'Test'),
(5, 1, 'Test'),
(6, 1, 'Test'),
(7, 1, 'Test'),
(8, 1, 'Test'),
(9, 1, 'Test'),
(10, 1, 'Test'),
(11, 1, 'Test'),
(12, 1, 'Test'),
(13, 1, 'Test'),
(14, 1, 'Test'),
(15, 1, 'Test'),
(16, 1, 'Test'),
(17, 1, 'Test'),
(18, 1, 'Test'),
(19, 1, 'Test'),
(20, 1, 'Test'),
(21, 1, 'Test'),
(22, 1, 'Test'),
(23, 1, 'Test'),
(24, 1, 'Test'),
(25, 1, 'Test'),
(26, 1, 'Test'),
(27, 1, 'Test'),
(28, 1, 'Test'),
(29, 1, 'Test'),
(30, 1, 'Test'),
(31, 1, 'Test'),
(32, 4, 'Mon Quizz'),
(33, 4, 'Mon Quizz'),
(34, 4, 'Mon Quizz'),
(35, 4, 'Mon Quizz');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
