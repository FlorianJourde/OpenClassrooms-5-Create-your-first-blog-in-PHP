-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 09 sep. 2022 à 14:18
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `florianjourde`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `author` varchar(100) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `author`, `post_id`, `content`, `status`, `comment_date`) VALUES
(2, 0, 'Sam', 1, 'Quelqu\'un a un avis là-dessus ? Je ne sais pas quoi en penser.', 0, '2022-03-03 13:01:42'),
(3, 0, 'Sam', 2, 'Commentaire', 0, '2022-05-26 18:52:27'),
(4, 0, 'Sam', 1, 'J\'écris un nouveau commentaire', 0, '2022-05-26 18:52:38'),
(5, 0, 'Sam', 1, 'Sympa ce blog !', 0, '2022-05-26 18:53:56'),
(6, 0, 'Sam', 2, 'Je suis passé hier', 0, '2022-05-26 18:55:36'),
(7, 0, 'Sam', 2, 'Tu joues toujours à Geogussr ?', 0, '2022-05-26 19:01:25'),
(8, 0, 'Sam', 2, 'dc', 0, '2022-06-03 15:33:45'),
(9, 0, 'Sam', 2, 'Bonjour, mon nom est Joseph', 0, '2022-06-12 00:41:34'),
(10, 0, 'Sam', 1, 'Test de commentaire\r\n', 0, '2022-06-17 15:29:54'),
(11, 0, 'Diane', 1, '\r\n  $commentRepository->connection = new DatabaseConnection();', 0, '2022-06-22 23:08:46'),
(12, 0, 'Sam', 1, 'Oui voila', 0, '2022-06-22 23:10:09'),
(13, 0, 'John', 2, 'Je suis createComment', 0, '2022-06-22 23:10:29'),
(14, 0, 'Sam', 2, 'Namespace', 0, '2022-06-22 23:36:18'),
(15, 0, 'John', 1, 'Use', 0, '2022-06-22 23:36:30'),
(16, 0, 'Sam', 2, 'Use', 0, '2022-06-22 23:43:29'),
(17, 0, 'Sam', 1, 'Code refactorisé', 0, '2022-06-22 23:52:15'),
(18, 0, 'John', 1, 'Au revoir', 0, '2022-06-27 20:20:39'),
(19, 0, 'Tom', 2, 'Okokokokok', 0, '2022-06-27 20:47:23'),
(20, 0, 'Tom', 2, 'Test', 0, '2022-06-27 20:48:01'),
(21, 0, 'Tom', 2, 'Hello', 0, '2022-06-27 20:49:12'),
(22, 0, 'Tom', 2, 'Hiqsxs', 0, '2022-06-27 20:49:51'),
(23, 0, 'Tom', 1, 'Hello!', 0, '2022-06-27 21:04:38'),
(24, 0, 'Tom', 1, 'COUC', 0, '2022-06-27 21:05:58'),
(25, 0, 'Tom', 2, 'Salutttssss', 0, '2022-06-27 21:10:42'),
(26, 0, 'Sam', 2, 'dfvdfvdfv', 0, '2022-06-27 21:51:17'),
(27, 0, 'Diane', 2, 'dfvdfv', 0, '2022-06-27 22:09:33'),
(28, 0, 'Tom', 2, 'dfvdfv', 0, '2022-06-27 22:11:09'),
(29, 0, 'Diane', 1, 'COUCOU', 0, '2022-06-27 22:12:32'),
(30, 0, 'Diane', 2, 'loul', 0, '2022-06-27 22:34:24'),
(35, 0, 'Diane', 1, 'Preum\'s', 0, '2022-03-03 13:00:42'),
(36, 0, 'Diane', 2, 'blablavdfv\r\ndfvdfdfsddd', 0, '2022-06-30 17:28:42'),
(37, 1, 'aut', 2, 'comd', 1, '2022-09-09 15:51:37'),
(38, 1, 'aut', 2, 'com', 1, '2022-09-09 15:51:45'),
(39, 1, 'aut', 2, 'com', 1, '2022-09-09 15:51:49'),
(40, 1, 'aut', 2, 'com', 1, '2022-09-09 15:52:00');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `update_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `creation_date`, `update_date`) VALUES
(1, 0, 'Bienvenue sur le blog de l\'AVBN !', 'Je vous souhaite à toutes et à tous la bienvenue sur le blog qui parlera de... l\'Association de VolleyBall de Nuelly !', '2022-02-17 16:28:41', '2022-09-08 14:31:41'),
(2, 0, 'L\'AVBN à la conquête du monde !', 'C\'est officiel, le club a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"Association de VolleyBall de Nuelly\". Pas dur, ceci dit entre nous...', '2022-02-17 16:28:42', '2022-09-08 14:31:41');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
