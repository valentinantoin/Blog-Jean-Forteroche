-- *********************************
-- ***** DATABASE JEANFORTEROCHE *****
-- *********************************



-- Drops the old database before creates a new one
DROP DATABASE IF EXISTS jeanforteroche;

-- Creates the database jeanforteroche
CREATE DATABASE jeanforteroche CHARACTER SET 'utf8';

-- Uses the database jeanforteroche
USE jeanforteroche;



SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------


--
-- Creates 'chapters' table
--

CREATE TABLE `chapters` (
  `id` smallint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(70) NOT NULL,
  `content` text NOT NULL,
  `creation_date` date NOT NULL,
  `state` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `chapters` (`id`, `title`, `content`, `creation_date`, `state`) VALUES
(1, 'Votre présentation', 'Cliquez sur modifier la présentation, et personnalisez celle-ci.', '2019-05-27', 'ok'),
(2, 'Chapitre test', 'Contenu du chapitre de test...', '2019-05-28', 'ok');



--
-- Creates 'users' table
--

CREATE TABLE `users` (
  `id` smallint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `pseudo` varchar(70) UNIQUE NOT NULL,
  `mail` varchar(70) NOT NULL,
  `pass` varchar(70) NOT NULL,
  `creation_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Creates 'comments' table
--

CREATE TABLE `comments` (
  `id` smallint UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  `chapter_id` smallint UNSIGNED NOT NULL,
  CONSTRAINT fk_chapter_id FOREIGN KEY (chapter_id) REFERENCES chapters(id),
  `user_pseudo` varchar(70)  NOT NULL,
  CONSTRAINT fk_user_pseudo FOREIGN KEY (user_pseudo) REFERENCES users(pseudo),
  `content` varchar(255) NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `report` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
