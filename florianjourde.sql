-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 oct. 2022 à 00:41
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
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `content`, `status`, `creation_date`) VALUES
(138, 1, 41, 'Commentaire #1', 1, '2022-10-13 02:35:47'),
(139, 1, 41, 'Commentaire #2', 1, '2022-10-13 02:35:52'),
(140, 1, 41, 'Commentaire #3', 1, '2022-10-13 02:35:58'),
(141, 1, 41, 'Commentaire #4', 1, '2022-10-13 02:36:04'),
(142, 1, 42, 'Commentaire #5', 1, '2022-10-13 02:36:17'),
(143, 1, 42, 'Commentaire #6', 1, '2022-10-13 02:36:23'),
(144, 1, 45, 'Commentaire #7', 1, '2022-10-13 02:36:35'),
(145, 1, 45, 'Commentaire #8', 0, '2022-10-13 02:36:40'),
(146, 1, 45, 'Commentaire #9', 1, '2022-10-13 02:36:46'),
(147, 1, 44, 'Commentaire #10', 1, '2022-10-13 02:36:57'),
(148, 1, 44, 'Commentaire #11', 0, '2022-10-13 02:37:04'),
(149, 1, 47, 'Commentaire #12', 0, '2022-10-13 02:37:14'),
(150, 2, 47, 'Commentaire #13', 1, '2022-10-13 02:37:38'),
(151, 2, 44, 'Commentaire #14', 0, '2022-10-13 02:37:49'),
(152, 2, 42, 'Commentaire #15', 1, '2022-10-13 02:38:00'),
(153, 2, 42, 'Commentaire #16', 1, '2022-10-13 02:38:04'),
(154, 2, 41, 'Commentaire #17', 1, '2022-10-13 02:38:12'),
(155, 2, 47, 'Commentaire #18', 1, '2022-10-13 02:38:23');

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
  `status` tinyint(1) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `creation_date`, `update_date`, `status`, `image`) VALUES
(41, 1, 'Titre #1', 'Contenu #1', '2022-10-13 02:31:21', '2022-10-13 02:31:21', 1, '63475c593bb0e1.27094960.jpg'),
(42, 1, 'Titre #2', 'Contenu #2', '2022-10-13 02:32:58', '2022-10-13 02:32:58', 1, '63475cba4bfbe2.50801012.jpg'),
(44, 1, 'Titre #3', 'Contenu #3', '2022-10-13 02:34:03', '2022-10-13 02:34:03', 1, NULL),
(45, 1, 'Titre #4', 'Contenu #4', '2022-10-13 02:34:30', '2022-10-13 02:34:30', 1, '63475d16523fc2.63648119.jpg'),
(47, 1, 'Titre #5', 'Contenu #5', '2022-10-13 02:35:17', '2022-10-13 02:35:17', 1, NULL);

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
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `password`, `token`) VALUES
(1, 'Thierry', 'email@email.com', 'Admin', 'e10adc3949ba59abbe56e057f20f883e', '57dfc5e6cfc43bedb99876e5edf70373'),
(2, 'Robert', 'test@test.com', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(3, 'Christophe', 'email@email.fr', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL),
(4, 'Gérard', 'test@test.fr', 'User', 'e10adc3949ba59abbe56e057f20f883e', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
