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


-- --------------------------------------------------------


--
-- Creates 'chapters' table
--

CREATE TABLE `chapters` (
  `id` smallint PRIMARY KEY NOT NULL,
  `title` varchar NOT NULL,
  `content` text NOT NULL,
  `creation_date` date DEFAULT NULL,
  `state` varchar NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Creates 'comments' table
--

CREATE TABLE `comments` (
  `id` smallint PRIMARY KEY NOT NULL,
  `chapter_id` smallint NOT NULL,
  `user_pseudo` varchar NOT NULL,
  `content` varchar NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `report` varchar DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Creates 'users' table
--

CREATE TABLE `users` (
  `id` smallint PRIMARY KEY NOT NULL,
  `pseudo` varchar UNIQUE KEY NOT NULL,
  `mail` varchar NOT NULL,
  `pass` varchar NOT NULL,
  `creation_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
